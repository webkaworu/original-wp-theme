<?php

/**
 *
 * テーマの更新処理
 *
 */

if ( !class_exists('ThemeUpdateChecker') ){

	class ThemeUpdateChecker {

		protected $filterSuffix = 'theme';
		protected $updateTransient = 'update_themes';
		protected $translationType = 'theme';
		public $debugMode = null;
		public $optionName = '';
		public $metadataUrl = '';
		public $directoryName = '';
		public $slug = '';
		protected $package;
		public $scheduler;
		protected $upgraderStatus;
		protected $updateState;
		protected $lastRequestApiErrors = array();
		protected $cachedMetadataHost = 0;
		protected $debugBarExtension = null;
		protected $stylesheet;

		public function __construct($stylesheet = null, $customSlug = null, $checkPeriod = 12, $optionName = '') {
			if ( $stylesheet === null ) {
				$stylesheet = get_stylesheet();
			}
			$this->stylesheet = basename(get_template_directory());

			$this->debugMode = (bool)(constant('WP_DEBUG'));
			$this->metadataUrl = 'https://webrabbit.xsrv.jp/theme-updates/download.json';
			$this->directoryName = basename(get_template_directory());
			$this->slug =  $this->directoryName;
			$this->optionName = 'external_updates-' . $this->slug;


			$this->scheduler = $this->createScheduler($checkPeriod);
			$this->upgraderStatus = new Wrt_Tuc_UpgraderStatus();
			$this->updateState = new Wrt_Tuc_StateStore($this->optionName);

			// if ( did_action('init') ) {
			// 	$this->loadTextDomain();
			// } else {
			// 	add_action('init', array($this, 'loadTextDomain'));
			// }

			$this->installHooks();
		}

		protected function installHooks() {
			// WordPressによって維持されている更新リストに更新情報を挿入します
			add_filter('site_transient_' . $this->updateTransient, array($this,'injectUpdate'));

			// 翻訳の更新を更新リストに挿入します
			add_filter('site_transient_' . $this->updateTransient, array($this, 'injectTranslationUpdates'));

			// WordPressが更新キャッシュをクリアするときに、翻訳の更新をクリアします
			add_action('delete_site_transient_' . $this->updateTransient, array($this, 'clearCachedTranslationUpdates'));

			// 更新ディレクトリの名前を既存のディレクトリと同じになるように変更します
			// if ( $this->directoryName !== '.' ) {
			// 	add_filter('upgrader_source_selection', array($this, 'fixDirectoryName'), 10, 3);
			// }

			// ローカルホスト上にある場合でも、メタデータURLへのHTTPリクエストを許可します
			add_filter('http_request_host_is_external', array($this, 'allowMetadataHost'), 10, 2);

			// DebugBarの統合
			if ( did_action('plugins_loaded') ) {
				$this->maybeInitDebugBar();
			} else {
				add_action('plugins_loaded', array($this, 'maybeInitDebugBar'));
			}
		}

		/**
		 * WordPressが管理する更新リストに最新の更新（ある場合）を挿入します
		 *
		 * @param stdClass $updates Update list.
		 * @return stdClass Modified update list.
		 */
		public function injectUpdate($updates) {
			$update = $this->getUpdate();

			// if ( !$this->shouldShowUpdates() ) {
			// 	$update = null;
			// }

			if ( !empty($update) ) {
				$updates = $this->addUpdateToList($updates, $update->toWpFormat());
			} else {
				// 古い更新情報をクリーンアップします。
				$updates = $this->removeUpdateFromList($updates);
				// 自動更新サポートを有効にするには、プレースホルダー項目を「no_update」リストに追加します。
				// これを行わないと、自動更新を有効にするオプションは、更新が利用可能な場合にのみ表示されます。
				$updates = $this->addNoUpdateItem($updates);
			}

			return $updates;
		}

		/**
		 * 現在利用可能なアップデートがある場合は、その詳細を取得します。
		 *
		 * 利用可能な更新がない場合、または最後の既知の更新バージョンが現在インストールされているバージョン以下である場合、このメソッドはNULLを返します。
		 *
		 * キャッシュされた更新データを使用します。 メタデータURLから直接更新情報を取得するには、代わりにrequestUpdate（）を呼び出します。
		 *
		 */
		public function getUpdate() {
			$update = $this->updateState->getUpdate();

			// 利用可能なアップデートがある場合
			if ( isset($update) ) {
				// アップデートが実際に現在インストールされているバージョンよりも新しいかどうかを確認します。
				$installedVersion = $this->getInstalledVersion();
				if ( ($installedVersion !== null) && version_compare($update->version, $installedVersion, '>') ){
					return $update;
				}
			}
			return null;
		}

		/**
		 * 現在インストールされているバージョンを取得します。
		 *
		 * @return string|null Version number.
		 */
		public function getInstalledVersion() {
			$theme = wp_get_theme($this->stylesheet);
			return $theme->get('Version');
		}

		/**
		 * @param stdClass|null $updates
		 * @param stdClass|array $updateToAdd
		 * @return stdClass
		 */
		protected function addUpdateToList($updates, $updateToAdd) {
			if ( !is_object($updates) ) {
				$updates = new stdClass();
				$updates->response = array();
			}
			// テーマの場合、更新配列はテーマディレクトリ名でインデックス付けされます。
			$updates->response[$this->directoryName] = $updateToAdd;
			return $updates;
		}

		/**
		 * @param stdClass|null $updates
		 * @return stdClass|null
		 */
		protected function removeUpdateFromList($updates) {
			if ( isset($updates, $updates->response) ) {
				unset($updates->response[$this->directoryName]);
			}
			return $updates;
		}

		/**
		 * 詳細については、この投稿を参照。
		 * @link https://make.wordpress.org/core/2020/07/30/recommended-usage-of-the-updates-api-to-support-the-auto-updates-ui-for-plugins-and-themes-in-wordpress-5-5/
		 *
		 * @param stdClass|null $updates
		 * @return stdClass
		 */
		protected function addNoUpdateItem($updates) {
			if ( !is_object($updates) ) {
				$updates = new stdClass();
				$updates->response = array();
				$updates->no_update = array();
			} else if ( !isset($updates->no_update) ) {
				$updates->no_update = array();
			}

			$updates->no_update[$this->directoryName] = (object) $this->getNoUpdateItemFields();

			return $updates;
		}

		protected function getNoUpdateItemFields() {
			return array(
				'new_version'   => $this->getInstalledVersion(),
				'url'           => '',
				'package'       => '',
				'requires_php'  => '',
				'theme'         => $this->directoryName,
				'requires'      => '',
			);
		}

		/**
		 * WordPressが管理するリストに翻訳の更新を挿入します。
		 *
		 * @param stdClass $updates
		 * @return stdClass
		 */
		public function injectTranslationUpdates($updates) {
			$translationUpdates = $this->getTranslationUpdates();
			if ( empty($translationUpdates) ) {
				return $updates;
			}

			if ( !is_object($updates) ) {
				$updates = new stdClass();
			}
			if ( !isset($updates->translations) ) {
				$updates->translations = array();
			}

			// wordpress.orgでホストされているプラグインまたはテーマと名前が衝突した場合は、私たちのものと一致する既存の更新をすべて削除してください。
			$updates->translations = array_values(array_filter(
				$updates->translations,
				array($this, 'isNotMyTranslation')
			));

			// 更新をリストに追加します。
			foreach($translationUpdates as $update) {
				$convertedUpdate = array_merge(
					array(
						'type' => $this->translationType,
						'slug' => $this->directoryName,
						'autoupdate' => 0,
						// WordPressは実際には「バージョン」フィールドを何にも使用しません。 ただし、万が一の場合に備えて、そこにあることを確認しましょう。
						'version' => isset($update->version) ? $update->version : ('1.' . strtotime($update->updated)),
					),
					(array)$update
				);

				$updates->translations[] = $convertedUpdate;
			}

			return $updates;
		}

		/**
		 * 利用可能な翻訳アップデートのリストを取得します。
		 *
		 * 更新がない場合、このメソッドは空の配列を返します。
		 * キャッシュされた更新データを使用します。
		 *
		 * @return array
		 */
		public function getTranslationUpdates() {
			return $this->updateState->getTranslations();
		}

		/**
		 * このテーマと*一致しない*翻訳のみを保持します。
		 *
		 * @param array $translation
		 * @return bool
		 */
		protected function isNotMyTranslation($translation) {
			$isMatch = isset($translation['type'], $translation['slug']) && ($translation['type'] === $this->translationType) && ($translation['slug'] === $this->directoryName);

			return !$isMatch;
		}

		/**
		 * キャッシュされた翻訳の更新をすべて削除します。
		 *
		 * @see wp_clean_update_cache
		 */
		public function clearCachedTranslationUpdates() {
			$this->updateState->setTranslations(array());
		}

		/**
		 * メタデータURLへのHTTPリクエストを明示的に許可します。
		 *
		 * WordPressには、ホストが現在のサイトと完全に一致しない限り、HTTP APIが現在のサイト（IP一致）、ローカルホスト、またはローカルIPと同じサーバーでホストされている別のサイトに送信されるすべてのリクエストを拒否するセキュリティ機能があります 。
		 *
		 * この機能はオプトインです（少なくともWP 4.4では）。 どうやら何人かの人々はそれを可能にします。
		 *
		 * プラグインを開発していて、テストサイトと同じサーバーで更新情報をホストすることにした場合、これは問題になる可能性があります。 更新要求は不思議なことに失敗します。
		 *
		 * メタデータホストの例外を追加することで、これを修正します。
		 *
		 * @param bool $allow
		 * @param string $host
		 * @return bool
		 */
		public function allowMetadataHost($allow, $host) {
			if ( $this->cachedMetadataHost === 0 ) {
				$this->cachedMetadataHost = parse_url($this->metadataUrl, PHP_URL_HOST);
			}

			if ( is_string($this->cachedMetadataHost) && (strtolower($host) === strtolower($this->cachedMetadataHost)) ) {
				return true;
			}
			return $allow;
		}

		/* -------------------------------------------------------------------
		 * DebugBar統合
		 * -------------------------------------------------------------------
		 */

		/**
		 * アップデートチェッカーのデバッグバー plugin/add-on を初期化します。
		 */
		public function maybeInitDebugBar() {
			if ( class_exists('Debug_Bar', false) && file_exists(dirname(__FILE__) . '/DebugBar') ) {
				$this->debugBarExtension = $this->createDebugBarExtension();
			}
		}

		// /**
		//  * For themes, the update array is indexed by theme directory name.
		//  *
		//  * @return string
		//  */
		// protected function getUpdateListKey() {
		// 	return $this->directoryName;
		// }

		protected function createScheduler($checkPeriod) {
			return new Wrt_Tuc_Scheduler($this, $checkPeriod, array('load-themes.php'));
		}

		protected function createDebugBarExtension() {
			return new Wrt_Tuc_DebugBar_Extension($this, 'Wrt_Tuc_DebugBar_ThemePanel');
		}

	}

}
