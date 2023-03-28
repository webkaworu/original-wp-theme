<?php
/******************************************************
 *
 * グローバル変数
 *
 *******************************************************/
global $wrt_default_color, $wrt_site_colors, $wrt_site_fsizes, $wrt_google_fonts, $wrt_images_size, $wrt_catch_copy, $wrt_demo_url, $wrt_product_id;

if (is_null($wrt_default_color)){
	$wrt_default_color = 'green';
}

if (is_null($wrt_site_colors)){
	$wrt_site_colors = [
		'green' => ['label' => 'GREEN', 'basic' => '84, 142, 127', 'dark' => '69, 116, 104', 'light' => '102, 165, 148'],
		'red' => ['label' => 'RED', 'basic' => '239, 111, 108', 'dark' => '235, 75, 71', 'light' => '243, 147, 145'],
		'purple' => ['label' => 'PURPLE', 'basic' => '103, 97, 168', 'dark' => '85, 80, 145', 'light' => '128, 123, 182'],
		'orange' => ['label' => 'ORANGE', 'basic' => '244, 159, 10', 'dark' => '205, 133, 8', 'light' => '247, 175, 48'],
	];
}

if (is_null($wrt_site_fsizes)){
	$wrt_site_fsizes = [
		'small' => ['label' => '小さい', 'size' => 12],
		'normal' => ['label' => '標準', 'size' => 14],
		'large' => ['label' => '大きい', 'size' => 16],
	];
}

if (is_null($wrt_google_fonts)){
	$wrt_google_fonts = 'family=Lato:wght@300';
}

if (is_null($wrt_images_size)){
	$wrt_images_size = [
		'hlogo' => [210, 26],
		'flogo' => [210, 26],
		'mv' => [1920, 850],
		'mvsp' => [790, 960],
		'introduction' => [640, 640],
		'column' => [260, 460],
		'underimg' => [1920, 200],
		'capture' => [640, 420],
		'detail' => [940, 9999],
	];
}

if (is_null($wrt_catch_copy)){
	$wrt_catch_copy = [
		'small' => ['color' => '#333', 'back' => ''],
		'strong' => ['color' => '#333', 'back' => ''],
		'under' => ['color' => '#333', 'back' => ''],
	];
}

if (is_null($wrt_demo_url)){
	$wrt_demo_url = 'https://hwebsystem.com/chameleon/';
}

if (is_null($wrt_product_id)){
	$wrt_product_id = 20;
}

/******************************************************
 *
 * インクルード
 *
 *******************************************************/
add_action( 'after_setup_theme', function(){
	$files = [
		'function',// 独自関数の設定
		'wp-setting',// Wordpressの基本設定
		'insert-src',// style・script読み込み
		'custom-post',// カスタム投稿タイプ
		'custom-admin',// 管理画面の設定
		'custom-menus',// ナビゲーションの設定
		'custom-gutenberg',// Gutenbergの設定
		'custom-widget',// widgetの設定
		'pagenation',// ページネーションの設定
		'seo',// SEOの設定
		'breadcrumb',// パンくずの設定
		'import-setting',// サイト設定のインポート
		// 'theme-update-checker',// テーマの更新処理
	];
	foreach($files as $file){
		require_once get_theme_file_path('inc/'.$file.'.php');
	}
}, PHP_INT_MIN);
