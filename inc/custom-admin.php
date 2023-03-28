<?php

//管理画面にメニュー追加
function custom_admin_menu() {
	add_menu_page( 'テーマ設定', 'テーマ設定', 'manage_categories', 'custom_setting', '', 'dashicons-desktop', '4.9');
	add_submenu_page( 'custom_setting', '基本設定', '基本設定', 'manage_categories', 'custom_setting', 'custom_admin_page');
	add_submenu_page( 'custom_setting', 'ロゴ設定', 'ロゴ設定', 'manage_categories', 'custom_logo', 'custom_admin_page');
	add_submenu_page( 'custom_setting', '投稿設定', '投稿設定', 'manage_categories', 'custom_post', 'custom_admin_page');
	add_submenu_page( 'custom_setting', 'トップページ', 'トップページ', 'manage_categories', 'custom_top_page', 'custom_admin_page');
	add_submenu_page( 'custom_setting', '404ページ', '404ページ', 'manage_categories', 'custom_404_page', 'custom_admin_page');
	add_submenu_page( 'custom_setting', 'インポート', 'インポート', 'manage_categories', 'custom_import', 'custom_admin_page');
	add_submenu_page( 'custom_setting', 'ライセンス認証', 'ライセンス認証', 'manage_categories', 'custom_license', 'custom_admin_page');
}
add_action( 'admin_menu', 'custom_admin_menu' );
function custom_admin_page() {
	$hidden_field_name = 'mt_submit_hidden';
	$opt_name = $_GET['page'];

	add_action( 'custom_field_contents', function($opt_name, $option){
		switch( $opt_name ){
			case 'custom_setting':
				require_once get_theme_file_path('admin/page/setting.php');
				break;
			case 'custom_logo':
				require_once get_theme_file_path('admin/page/logo.php');
				break;
			case 'custom_post':
				require_once get_theme_file_path('admin/page/post.php');
				break;
			case 'custom_top_page':
				require_once get_theme_file_path('admin/page/top.php');
				break;
			case 'custom_404_page':
				require_once get_theme_file_path('admin/page/404.php');
				break;
		}
	}, 10, 2);

	if( $opt_name === 'custom_import' ){
		require_once get_theme_file_path('admin/page/import.php');
	}elseif( $opt_name === 'custom_license' ){
		require_once get_theme_file_path('admin/page/license.php');
	}else{
		require_once get_theme_file_path('admin/page/format.php');
	}


}

function get_top_contents_field(){
	$index = $_GET['index'];
	$option = get_option( 'custom_wrt_data', array() );
	require_once get_theme_file_path('admin/field/top-contents.php');
	die;
}
add_action( 'wp_ajax_get_top_contents_field', 'get_top_contents_field' );
add_action( 'wp_ajax_nopriv_get_top_contents_field', 'get_top_contents_field' );

function get_top_contents_type(){
	$index = $_GET['index'];
	$option = get_option( 'custom_wrt_data', array() );
	require_once get_theme_file_path('admin/field/'.$_GET['type'].'.php');
	die;
}
add_action( 'wp_ajax_get_top_contents_type', 'get_top_contents_type' );
add_action( 'wp_ajax_nopriv_get_top_contents_type', 'get_top_contents_type' );

function get_top_contents_preview(){
	$setting = $_REQUEST['setting'];
	parse_str($setting, $settings);
	$option = $settings['custom_wrt_data'];
	ob_start();
	require_once get_theme_file_path('admin/field/preview.php');
	$main = ob_get_contents();
	ob_end_clean();

	$main = esc_html(preg_replace(['/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s'], ['>', '<', '\\1'], $main));
	echo str_replace('&lt;', "<",$main);
	die;
}
add_action( 'wp_ajax_get_top_contents_preview', 'get_top_contents_preview' );
add_action( 'wp_ajax_nopriv_get_top_contents_preview', 'get_top_contents_preview' );

function set_demo_import(){
	$custom_wrt_data = wrt_import_demo_setting();
	if( is_wp_error($custom_wrt_data) ){
		echo 'error';
		die;
	}
	update_option( 'custom_wrt_data', $custom_wrt_data, true );
	flush_rewrite_rules();
	echo 'success';
	die;
}
add_action( 'wp_ajax_set_demo_import', 'set_demo_import' );
add_action( 'wp_ajax_nopriv_set_demo_import', 'set_demo_import' );
