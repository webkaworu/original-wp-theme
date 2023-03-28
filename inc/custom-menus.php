<?php

// カスタムメニューの設定
register_nav_menu( 'global-menu', 'グローバルメニュー' );
register_nav_menu( 'footer-menu', 'フッターメニュー' );

add_action( 'wp_nav_menu_item_custom_fields', function($item_id, $item, $depth, $args, $id){
	$menu_item_strong = get_post_meta($item_id, '_menu_item_strong', true);
	$checked = (!empty($menu_item_strong))? ' checked': '';
	echo '<p><input type="hidden" name="menu-item-strong['.$item_id.']" value="0"><label><input type="checkbox" name="menu-item-strong['.$item_id.']" value="1"'.$checked.'>強調表示</label></p>';
}, PHP_INT_MAX, 5);

add_action('save_post', function($post_id){
	if( isset($_POST['menu-item-strong']) ){
		if( isset($_POST['menu-item-strong'][$post_id]) && $_POST['menu-item-strong'][$post_id] === '1' ){
			update_post_meta( $post_id, '_menu_item_strong', 1 );
		}else{
			delete_post_meta( $post_id, '_menu_item_strong');
		}
	}
});

add_filter( 'wp_nav_menu_objects', function ( $items ) {
	$parents = array();
	// foreach ( $items as $item ) {
	// 	if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
	// 		$parents[] = $item->menu_item_parent;
	// 	}
	// }

	foreach ( $items as $item ) {
		$menu_item_strong = get_post_meta($item->ID, '_menu_item_strong', true);
		if ( !empty($menu_item_strong) && $menu_item_strong === '1' ) {
			$item->classes[] = 'strong';
		}
		if( ctype_alnum($item->post_title) ){
			$item->classes[] = 'alnum_only';
		}
		// if ( in_array( $item->ID, $parents ) ) {
		// 	$item->classes[] = 'dropdown';
		// }
	}

	return $items;
});

// add_filter( 'nav_menu_submenu_css_class', function($classes){
// 	$classes[] = 'dropdown-menu';
// 	return $classes;
// });
