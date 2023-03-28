<?php

/******************************************************
*
* 管理画面で使用したいcss・jsを読み込む
*
*******************************************************/
function custom_admin_enqueue_scripts() {
	wp_enqueue_style( 'admin', get_theme_file_uri( 'src/css/admin.css' ), false, '0.0.2' );
	wp_add_inline_style( 'admin', wrt_get_inline_style() );

	if( !empty($_GET['page']) && strpos($_GET['page'], 'custom')!==false ){
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_media();
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'admin', get_theme_file_uri('src/js/admin.js'), array( 'jquery' ), '0.0.2', true );
	}
}
add_action('admin_enqueue_scripts', 'custom_admin_enqueue_scripts');

/******************************************************
*
* フロント画面で使用したいcss・jsを読み込む
*
*******************************************************/
function custom_wp_enqueue_scripts(){
	global $wrt_google_fonts;
	if( !is_null($wrt_google_fonts) ){
		wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?'.$wrt_google_fonts.'&display=swap', false );
	}
	wp_enqueue_style( 'core', get_theme_file_uri('src/css/style.css'), false, '0.0.2' );
	wp_add_inline_style( 'core', wrt_get_inline_style() );
	if(is_page() || is_single()){
		$object = get_post_type_object( get_post_type() );
		if($object->show_in_rest){
			// ブロックエディタの場合
		}else{
			// クラシックエディタの場合
		}
	}
	wp_enqueue_script( 'app', get_theme_file_uri('src/js/app.js'), array('jquery'), '0.0.2' );
	wp_localize_script('app', 'DATA',
		array(
			'template' => get_stylesheet_directory_uri().'/',
			'ajax' => admin_url('admin-ajax.php')
		)
	);
	$option = get_option( 'custom_wrt_data', array() );
	if( isset($option['setting']['animation']) && $option['setting']['animation'] === 'true' && !is_admin() ){
		wp_enqueue_style( 'animate', get_theme_file_uri('src/css/animate.css'), false, '0.0.2' );
		wp_enqueue_script( 'animate', get_theme_file_uri('src/js/animate.js'), array('jquery'), '0.0.2' );
	}

	//wp_add_inline_script( $handle, $inline_script );
}
add_action( 'wp_enqueue_scripts', 'custom_wp_enqueue_scripts' );

/******************************************************
*
* JavaScriptでtype属性を消してdeferを追加
*
*******************************************************/
function replace_script_tag ( $tag ) {
	if( is_admin() ){
		return $tag;
	}
	if ( strpos( $tag, 'app.js' ) ){
		return str_replace( " src", ' defer src', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'replace_script_tag' );
