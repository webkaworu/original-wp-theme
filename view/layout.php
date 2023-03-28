<?php
$folder = 'view/';
$mainclass = '';
$sidebarclass = '';

if ( get_option('show_on_front', 'posts') !== 'posts' || (!is_home() && !is_front_page()) ){
	$option = get_option( 'custom_wrt_data', array() );
	if( isset($option['setting']['side']) && $option['setting']['side'] !== 'none' ){
		$sidebarclass = 'sidebar sidebar_'.$option['setting']['side'];
	}
}

if ( is_home() || is_front_page() ){
	$folder .= 'page/';
	$slug = ( get_option('show_on_front', 'posts') === 'posts' )? 'home': 'default';
	$mainclass = ( get_option('show_on_front', 'posts') === 'posts' )? 'top_main': 'sub_main editor';
} elseif (is_page()) {
	$folder .= 'page/';
	$slug = $post->post_name;
	$mainclass = 'sub_main editor '.$slug;

	$parent=is_subpage();

	if (!empty($parent)) {
		$ancestors = array_reverse(get_post_ancestors($post->ID));
		foreach ($ancestors as $ancestor) {
			$parent_slug = get_post($ancestor)->post_name;
			if (!in_array($parent_slug, array('mypage'))) {
				$folder.=$parent_slug.'/';
			}
		}
	}
} elseif (is_single()) {
	$folder .= 'single/';
	$slug = get_post_type();
	$mainclass = 'sub_main editor '.$slug;
	$settings = get_custom_post_theme_settings($slug);
	if( empty($settings['single_side']) || $settings['single_side'] === 'none' ){
		$sidebarclass = '';
	}else{
		$sidebarclass = 'sidebar sidebar_'.$settings['single_side'];
	}
} elseif (is_archive()) {
	$folder .= 'archive/';
	$slug = ( is_post_type_archive() )? get_query_var('post_type'): 'post';
	$mainclass = 'sub_main editor '.$slug;
	$settings = get_custom_post_theme_settings($slug);
	if( empty($settings['side']) || $settings['side'] === 'none' ){
		$sidebarclass = '';
	}else{
		$sidebarclass = 'sidebar sidebar_'.$settings['side'];
	}
} elseif (is_search()) {
	$folder .= 'archive/';
	$slug = 'search';
	$mainclass = 'sub_main editor '.$slug;
}

$file=$folder.$slug;

if (locate_template($file.'.php')=='') {
		$file = $folder.'default';
}
?>

<?php get_header(); ?>

<main class="<?= $mainclass; ?> <?= $sidebarclass; ?>">

<?php get_template_part($file); ?>

<?php
	if ( !empty($sidebarclass) ){
		get_sidebar();
	}
?>

</main>

<?php get_footer(); ?>
