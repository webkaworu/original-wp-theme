<?php
/**
 * This file loads theme Functions and definitions.
 * @link		http://worldagent.jp/
 * @author		World agent
 * @copyright	Copyright (c) World agent
**/

/******************************************************
*
* カスタムフィールド
*
*******************************************************/

//カスタムフィールドを追加
add_action('admin_menu', 'add_mycustom_fields');
add_action('save_post', 'save_mycustom_fields');

//カスタム投稿タイプでカスタムフィールドを表示
function add_mycustom_fields() {
	$metas = array(
		'front_view' => ['title'=>'トップページの表示', 'context'=>'side', 'priority'=>'low'],
		'capture_view' => ['title'=>'アイキャッチ画像の表示', 'context'=>'side', 'priority'=>'low'],
	);
	$screen = array('post');
	$custom_wrt_data = get_option('custom_wrt_data');
	if( !empty($custom_wrt_data['post']['custom']) ){
		$customs = $custom_wrt_data['post']['custom'];
		$i = 1;
		foreach( $customs as $key => $custom ){
			if( empty($custom['label']) || empty($custom['slug']) ){
				continue;
			}
			$screen[] = 'custom_post_'.$i;
			$i++;
		}
	}
	foreach( $metas as $id => $meta ){
		add_meta_box( $id, $meta['title'], 'my_custom_fields', $screen, $meta['context'], $meta['priority'] );
		add_filter( 'postbox_classes_store_'.$id, function($classes){
			$classes[] = 'custom_meta_box';
			return $classes;
		});
	}
}


//カスタムフィールドの値をチェック
function save_mycustom_data($key, $post_id) {
	if(isset($_POST["custom_data"][$key])) {
		$data = $_POST["custom_data"][$key];
	}else {
		$data = '';
	}

	//-1になると項目が変わったことになるので、項目を更新する
	if( empty($data) ) {
		delete_post_meta($post_id, $key);
	}elseif( strcmp($data, get_post_meta($post_id, $key, true)) != 0 ) {
		update_post_meta($post_id, $key, $data);
	}
}

//カスタムフィールドの値を保存
function save_mycustom_fields($post_id) {
	global $post;

	if (isset($_POST['custom_data']) && $_POST['custom_data_flg'] == 1) {
		foreach ($_POST['custom_data'] as $key => $value) {
			if(is_array($value)){
				update_post_meta( $post_id, $key, array_merge(array_filter($value,'custom_array_filter')) );
			}else{
				save_mycustom_data($key, $post_id);
			}
		}
	}
	$extend_edit_field_noncename = filter_input ( INPUT_POST , 'extend_edit_field_noncename' );
	if ( isset( $post->ID ) && !wp_verify_nonce( $extend_edit_field_noncename , plugin_basename(__FILE__) )) {
		return $post->ID;
	}
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
}

// カスタムフィールドの表示テンプレート指定
function my_custom_fields ( $post, $metabox ) {
	require_once get_theme_file_path('admin/field/'.$metabox['id'].'.php');
	// switch( $metabox['id'] ){
	// 	case 'front_view':
	// 		require_once( dirname(__DIR__).'/admin/field/front_view.php' );
	// 		break;
	// }
}


/******************************************************
*
* 投稿の名称変更
*
*******************************************************/

function change_post_menu_label() {
	global $menu;
	global $submenu;
	$custom_wrt_data = get_option('custom_wrt_data');
	if( !empty($_POST['custom_wrt_data']['post']) ){
		$custom_wrt_data = $_POST['custom_wrt_data'];
	}
	if( !empty($custom_wrt_data['post']['default']['label']) ){
		$label = $custom_wrt_data['post']['default']['label'];
		$menu[5][0] = $label;
		$submenu['edit.php'][5][0] = $label.' 一覧';
	}
}
function change_post_object_label() {
	global $wp_post_types;
	$custom_wrt_data = get_option('custom_wrt_data');
	if( !empty($custom_wrt_data['post']['default']['label']) ){
		$label = $custom_wrt_data['post']['default']['label'];
		global $wp_post_types;
		$labels = &$wp_post_types['post']->labels;

		$labels->name = $label;
		$labels->singular_name = $label;
		$labels->add_new = _x('新規追加', $label);
		$labels->add_new_item = $label.'の新規追加';
		$labels->edit_item = $label.'の編集';
		$labels->new_item = '新規'.$label;
		$labels->view_item = $label.'を表示';
		$labels->search_items = $label.'を検索';
		$labels->not_found = '記事が見つかりませんでした';
		$labels->not_found_in_trash = 'ゴミ箱に記事は見つかりませんでした';
}
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );

/******************************************************
*
* カスタム投稿追加
*
*******************************************************/

add_action('init', function(){
	$custom_wrt_data = get_option('custom_wrt_data');
	if( !empty($_POST['custom_wrt_data']['post']) ){
		$custom_wrt_data = $_POST['custom_wrt_data'];
	}
	if( !empty($custom_wrt_data['post']['custom']) ){
		$customs = $custom_wrt_data['post']['custom'];
		$i = 1;
		foreach( $customs as $key => $custom ){
			if( empty($custom['label']) || empty($custom['slug']) ){
				continue;
			}
			register_post_type( 'custom_post_'.$i,
				array(
					'labels' => array(
						'name' => $custom['label'],
						'singular_name' => $custom['label']
					),
					'public' => true,
					'has_archive' => true,
					'menu_position' => 5,
					'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' ),
					'taxonomies'    => array(),
					'show_in_rest' => true,
					'rewrite' => array( 'slug' => $custom['slug'] ),
				)
			);
			$i++;
		}
	}
});

// 一覧にカラムを追加する
function custom_manage_posts_columns($post_columns, $post_type) {
	$screen = array('post');
	$custom_wrt_data = get_option('custom_wrt_data');
	if( !empty($customs = $custom_wrt_data['post']['custom']) ){
		$i = 1;
		foreach( $customs as $key => $custom ){
			if( empty($custom['label']) || empty($custom['slug']) ){
				continue;
			}
			$screen[] = 'custom_post_'.$i;
			$i++;
		}
	}
	if ( in_array($post_type, $screen) ) {
		$post_columns['show_front_page'] = 'トップページの表示';
	}
	uksort($post_columns, function($a, $b){
		$slugs = array( 'cb', 'title', 'author', 'categories', 'tags', 'show_front_page', 'comments', 'date' );
		if( array_search($b, $slugs) !== false ){
			return array_search($a, $slugs) > array_search($b, $slugs);
		}
		return -1;
	});
	return $post_columns;
}
add_filter('manage_posts_columns' , 'custom_manage_posts_columns', PHP_INT_MAX, 2 );

// カスタムフィールドの内容を表示
function custom_manage_posts_custom_column($column_name, $post_id) {
		if ( $column_name == 'show_front_page' ) {
			$payment = get_post_meta( $post_id, 'show_front_page', true );
			if( $payment === '1' ){
				echo '表示する';
			}
		}
}
add_action( 'manage_posts_custom_column', 'custom_manage_posts_custom_column', 10, 2 );
