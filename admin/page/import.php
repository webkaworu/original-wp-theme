<?php

// ユーザーが必要な権限を持つか確認する必要がある
if(!current_user_can('manage_categories'))
{
	wp_die( __('このページにアクセスする権限がありません。') );
}

global $wrt_demo_url;
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
	<h2>デモデータインポート</h2>
	<p>デモサイト（<a href="<?= $wrt_demo_url; ?>" target="_blank"><?= $wrt_demo_url; ?></a>）と同じ設定をインポートします。</p>
	<p>項目:</p>
	<div class="p-3 bg-white">
		<ul style="list-style-type: disc;padding-inline-start: 40px;">
			<li>サイトカラー</li>
			<li>テキストの大きさ</li>
			<li>固定ページのサイドバー</li>
			<li>下層ページのタイトル背景</li>
			<li>下層ページのタイトル文字色</li>
			<li>ヘッダーロゴ</li>
			<li>フッターロゴ</li>
			<li>メインビジュアルの画像</li>
			<li>メインビジュアルのキャッチコピー</li>
			<li>トップページの各コンテンツ</li>
			<li>固定ページ「会社案内」追加</li>
			<li>固定ページ「よくある質問」追加</li>
			<li>グローバルナビ</li>
			<li>フッターメニュー</li>
		</ul>
	</div>
	<p>デモデータをインポートすると上記設定が上書きされます。</p>
	<p>
		投稿・カスタム投稿に関してはインポートしません。<br>
		TOPページに表示したい投稿がある場合は記事を作成し、<br>
		投稿編集画面にある「トップページに表示する」にチェックをいれていただければトップページの各コンテンツに表示されます。
	</p>
	<p class="my-4">
		<button class="button button-primary" id="importButton" data-bs-target="#confirmModal" data-bs-toggle="modal">デモデータをインポート</button>
	</p>
</div>
<div class="modal fade" id="confirmModal" aria-hidden="true" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				インポートによって上書きされたデータをもとに戻すことはできません。<br>
				本当によろしいですか？
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger" data-bs-dismiss="modal">取り消す</button>
				<button class="btn btn-primary ms-3" data-bs-target="#importModal" data-bs-toggle="modal">インポートを開始する</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="importModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<div class="mb-3 text-center text-info display-6">
					<i class="fas fa-spinner fa-spin"></i>
				</div>
				<p class="mb-4 text-danger text-center" id="coution">
					ブラウザの操作をしないでください。インポートが失敗します。
				</p>
				<div class="text-center">
					<button class="btn btn-outline-danger disabled">
						<i class="fas fa-exclamation-circle"></i> データをインポートしています
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="successModal" aria-hidden="true" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body text-center text-success">
				<div class="mb-3 display-6">
					<i class="fa-solid fa-circle-check"></i>
				</div>
				インポートが完了しました。
			</div>
			<div class="modal-footer">
				<button class="btn btn-success" data-bs-dismiss="modal">閉じる</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="errorModal" aria-hidden="true" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body text-center text-danger">
				<div class="mb-3 display-6">
					<i class="fa-solid fa-circle-xmark"></i>
				</div>
				インポートに失敗しました。
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger" data-bs-dismiss="modal">閉じる</button>
			</div>
		</div>
	</div>
</div>
