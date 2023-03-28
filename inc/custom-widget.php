<?php

// widgetの登録
add_action('widgets_init', function(){
	register_sidebar(array(
		'name' => 'サイドバー',
		'description' => 'サイドバーのウィジットエリアです。表示する場合はテーマ設定でサイドバーを有効にしてください。',
		'id' => 'widget_aside',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
	));
});

// widgetのタイプ
add_action( 'after_setup_theme', function(){
	$custom_wrt_data = get_option('custom_wrt_data');
	if( empty($custom_wrt_data['setting']['widget']) || $custom_wrt_data['setting']['widget'] !== 'block' ){
		// widgetの設定画面をブロックエディターからクラシックに
		remove_theme_support( 'widgets-block-editor' );
	}
}, PHP_INT_MAX);
// タグクラウドのカスタマイズ
add_filter( 'widget_tag_cloud_args', function($args){
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
});

// ギャラリーのカスタマイズ
add_filter( "widget_media_gallery_instance_schema", function($schema){
	$schema['link_type']['enum'] = ['file', 'none'];
	$schema['link_type']['default'] = 'file';
	return $schema;
});
add_filter( 'media_view_settings', function($settings){
	$settings['galleryDefaults']['link'] = 'file';
	return $settings;
});
