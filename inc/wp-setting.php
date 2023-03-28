<?php

/******************************************************
*
* 管理バーを非表示にする
*
*******************************************************/
function my_function_admin_bar(){
	return false;
}
add_filter( 'show_admin_bar' , 'my_function_admin_bar');


/******************************************************
*
* 特定のテーマ機能をサポートする
*
*******************************************************/
function original_theme_setup() {
	// コメントフォーム、検索フォーム等をHTML5のマークアップに
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	// タイトルタグ追加
	add_theme_support( 'title-tag' );
	// 投稿キャプチャー画像を追加。
	add_theme_support('post-thumbnails');
	global $wrt_images_size;
	if(!is_null($wrt_images_size)){
		add_image_size('thumb1', $wrt_images_size['capture'][0], $wrt_images_size['capture'][1], true);// アイキャッチ
		add_image_size('thumb2', $wrt_images_size['column'][0], $wrt_images_size['column'][1], true);// カラムコンテンツ
		add_image_size('mvsp', $wrt_images_size['mvsp'][0], $wrt_images_size['mvsp'][1], true);// スマホ用MV
		add_image_size('detail', $wrt_images_size['detail'][0], $wrt_images_size['detail'][1], false);// 投稿詳細
	}
}
add_action( 'after_setup_theme', 'original_theme_setup', PHP_INT_MAX );

/******************************************************
*
* 本文からの抜粋機能
*
*******************************************************/
// 抜粋字数を指定する
function custom_excerpt_length( $length ) {

	if( is_home() || is_front_page() ){
		$return = 45;
	}else{
		$return = 150;
	}
		return $return;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// 本文からの抜粋末尾の文字列を指定する
function custom_excerpt_more($more) {
		return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');

/******************************************************
*
* wordpressの不要な記述を削除
*
*******************************************************/
function disable_emoji() {
		// 特殊記号　画像変換を停止
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_head', 'rest_output_link_wp_head' );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		// 短縮URLの表示を停止
		remove_action('wp_head', 'wp_shortlink_wp_head');
		// 前後の記事URLの表示を停止
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
		// Windows Live Writer とのリンクを停止
		remove_action('wp_head', 'wlwmanifest_link');
		// RSDのリンクを停止
		remove_action('wp_head', 'rsd_link');
		// DNSプリフェッチのリンクを停止
		remove_action( 'wp_head', 'wp_resource_hints', 2 );
}
add_action( 'init', 'disable_emoji' );

/******************************************************
*
* 投稿画面のカテゴリの順番を変えない
*
*******************************************************/
function my_wp_terms_checklist_args( $args, $post_id ){
	$args['checked_ontop'] = false;
	return $args;
}
add_filter('wp_terms_checklist_args', 'my_wp_terms_checklist_args',10,2);


/******************************************************
*
* クエリ書き換え
*
*******************************************************/
function my_default_query( $query ) {
		if ( is_admin() || ! $query->is_main_query() ){
			return;
		}
		if( is_post_type_archive() && !is_post_type_archive('post') ){
			$option = get_option( 'custom_wrt_data', array() );
			$post_type = get_query_var('post_type');
			$obj = get_post_type_object( $post_type );
			$settings = [];
			if( !empty($obj->rewrite['slug']) && isset($option['post']['custom']) ){
				foreach( $option['post']['custom'] as $custom ){
					if( isset($custom['slug']) && $custom['slug'] === $obj->rewrite['slug'] ){
						$settings = $custom;
						break;
					}
				}
			}
			if( !empty($settings) ){
				$query->set( 'posts_per_page', $settings['pages']?? get_option('posts_per_page', 10) );
			}
		}
		if( is_post_type_archive( 'default' ) ){
			$query->set( 'nopaging', true );
		}
}
add_action( 'pre_get_posts', 'my_default_query', 1 );

/******************************************************
*
* キーワード検索にカテゴリ、タグ、メタを含める
*
*******************************************************/
add_filter('posts_search', function($search, $wp_query){
	if ( is_admin() || !is_search() ){ return $search; }
	$search_words = explode(' ', str_replace('　', ' ', get_search_query()));
	$search = " AND post_type = 'post' ";
	if ( count($search_words) > 0 ) {
		global $wpdb;
		foreach ( $search_words as $word ) {
			$search_word = '%' . esc_sql( $word ) . '%';
			$meta_query = "
				SELECT DISTINCT post_id
				FROM {$wpdb->postmeta}
				WHERE meta_value LIKE '{$search_word}'
			";
			$term_query = "
				SELECT DISTINCT tr.object_id
				FROM {$wpdb->term_relationships} AS tr
				JOIN {$wpdb->term_taxonomy} AS tt
					ON tr.term_taxonomy_id = tt.term_taxonomy_id
				JOIN {$wpdb->terms} AS t
					ON tt.term_id = t.term_id
				WHERE t.name LIKE '{$search_word}'
				GROUP BY tr.object_id
			";
			$search .= "AND (
				{$wpdb->posts}.post_title LIKE '{$search_word}'
				OR {$wpdb->posts}.post_content LIKE '{$search_word}'
				OR {$wpdb->posts}.ID IN ($meta_query)
				OR {$wpdb->posts}.ID IN ($term_query)
			) ";
		}
	}
	return $search;
}, PHP_INT_MAX, 2);


/******************************************************
*
* 自動保存機能無効
*
*******************************************************/
function disable_autosave() {
	wp_deregister_script('autosave');
}
add_action( 'wp_print_scripts', 'disable_autosave' );
function disable_quickpress() {
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
}
add_action('wp_dashboard_setup', 'disable_quickpress');
if ( ! defined( 'WP_POST_REVISIONS' ) ) {
	define('WP_POST_REVISIONS', false );
}


/******************************************************
*
* セキュリティ関連
*
*******************************************************/
// WordPressバージョン情報を消す
function remove_wp_version() {
		remove_action('wp_head','wp_generator');
}
add_action( 'init', 'remove_wp_version' );

// 不要なページを無効化
function remove_page_view( $query ) {
	if( !is_admin() ){
		if ( is_author() || is_attachment() ){
			$query->set_404();
			status_header( 404 );
			nocache_headers();
		}
	}
}
add_filter( 'parse_query', 'remove_page_view' );

/******************************************************
*
* テキストエディタカスタマイズ
*
*******************************************************/
// テキストエディタにスタイルを指定
/*add_editor_style( get_template_directory_uri().'/src/css/editor.css' );

// テキストエディタにフォントサイズ変更ボタン追加
function editor_add_buttons($array) {
	array_push($array, 'fontsizeselect');
	array_push($array, 'styleselect');
	return $array;
}
add_filter('mce_buttons', 'editor_add_buttons');

function custom_editor_settings( $initArray ) {
		$class = array(
			array(
				'title' => 'フレックス',
				'block' => 'div',
				'classes' => 'flex'
			)
		);
		$initArray['body_class'] = 'editor';
		$initArray['wpautop'] = false;
		$initArray['indent'] = true;
		$initArray['fontsize_formats'] = '10px 12px 14px 16px 18px 24px 36px';
		//$initArray['style_formats'] = json_encode($class);
		$initArray['valid_elements'] = '*[*]';
		$initArray['extended_valid_elements'] = '*[*]';
		return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );
*/
/******************************************************
*
* その他
*
*******************************************************/
// 管理画面の表示設定にセクションとフィールドを追加
function eg_settings_api_init() {

	// セクションを追加
	add_settings_section( 'eg_setting_section', '', '', 'reading' );

	// その新しいセクションの中に
	// 新しい設定の名前と関数を指定しながらフィールドを追加
	add_settings_field(
		'download_btn',
		'アプリ一覧ページのダウンロードボタン',
		'eg_setting_callback_function',
		'reading',
		'eg_setting_section'
	);
	// 新しい設定が $_POST で扱われ、コールバック関数が <input> を
	// echo できるように、新しい設定を登録
	register_setting( 'reading', 'download_btn' );
}
function eg_setting_callback_function() {
	echo '<label><input name="download_btn" id="download_btn" type="checkbox" value="1"' . checked( 1, get_option( 'download_btn' ), false ) . ' /> 表示しない</label>';
}
//add_action( 'admin_init', 'eg_settings_api_init' );

//テーマ有効時 自動で固定ページ作成
function auto_create_page(){
	// 親ページ登録
	$new_page_args=array(
		'slug' => 'ページタイトル',
	);

	foreach($new_page_args as $slug => $title){
		$check=get_page_by_path($slug);
		$new_page = array(
			'post_type' => 'page',
			'post_title' => $title,
			'post_name' => $slug,
			'post_status' => 'publish',
			'post_author' => 1,
		);
		if(empty($check->ID)){
			$new_page_id = wp_insert_post($new_page);
		}
	}

}
//add_action( 'after_switch_theme', 'auto_create_page' );

// テーマ有効時にデフォルトのセッティングを保存
add_action( 'after_switch_theme', function(){
	if( get_option('custom_wrt_data') === false ){
		$custom_wrt_data = wrt_import_initial_setting();
		update_option( 'custom_wrt_data', $custom_wrt_data, true );
		flush_rewrite_rules();
		insert_contact_meta();
	}
});

//ページ表示前
function read_page_variable(){
	// スタイル・スクリプトの不要な記述を消す
	ob_start( function( $buffer ){
		$buffer = str_replace( array( ' type="text/javascript"', " type='text/javascript'" ), '', $buffer );
		$buffer = str_replace( array( ' type="text/css"', " type='text/css'" ), '', $buffer );
		// 画像の参照をURL参照に変更
		$buffer = str_replace( array('src="src/','src="/src/'), 'src="'.get_stylesheet_directory_uri().'/src/', $buffer );
		$buffer = str_replace( array('href="src/','href="/src/'), 'href="'.get_stylesheet_directory_uri().'/src/', $buffer );
		return $buffer;
	});
}
add_action( 'template_redirect', 'read_page_variable' );

// 読み込むページテンプレートを変更する
add_filter('template_include', function ($template) {
	if ($template == get_template_directory().'/index.php' || $template == get_stylesheet_directory().'/index.php'){
		$template =get_theme_file_path('view/layout.php');
	}
	return $template;
}, PHP_INT_MAX);

// ホームURLのショートコードを作成
function shortcode_home_url() {
	return home_url( '/' );
}
add_shortcode('home_url', 'shortcode_home_url');
add_action( 'wpcf7_init', function(){
	wpcf7_add_form_tag( 'home_url', 'shortcode_home_url' );
});
/*
// テーマのライセンス認証がされていない場合に通知を表示
add_action( 'all_admin_notices', function(){
	global $pagenow;

	require_once get_theme_file_path('inc/license-checker.php');
	$license_checker = new LicenseChecker();
	$status = $license_checker->validate_status();

	if( $status['is_valid'] !== true && (!isset($_GET['page']) || $_GET['page'] !== 'custom_license') ){
		$notice = '<div class="notice notice-warning settings-error is-dismissible" id="license_no"><p><strong>テーマのライセンスが認証されていません。ライセンス認証することでテーマの更新通知を受け取ることができます。</strong>%s</p></div>';
		$btn = '<br><a href="'.admin_url('admin.php?page=custom_license').'" class="button mt-2">ライセンスを認証する</a>';
		printf($notice, $btn);
	}
});

// テーマ有効時にライセンス認証のスケジュールを登録
add_action('wrt_theme_license_validity', function(){
	require_once get_theme_file_path('inc/license-checker.php');
	$license_checker = new LicenseChecker();
	$status = $license_checker->validate_status();
  return $valid_status['is_valid'];
});
add_action( 'after_switch_theme', function(){
	if( !wp_next_scheduled( 'wrt_theme_license_validity' ) ) {
		wp_schedule_event( time(), 'daily', 'wrt_theme_license_validity' );
	}
});

// テーマ無効時にライセンス認証のスケジュールを削除
add_action( 'switch_theme', function(){
	$timestamp = wp_next_scheduled( 'wrt_theme_license_validity' );
	wp_unschedule_event( $timestamp, 'wrt_theme_license_validity' );
});
*/
