<?php

/******************************************************
*
* SEO関連
*
*******************************************************/

//meta 設定
function description_tag() {
	global $post;

	$rel = "\n";

	$aioseop_options = get_option( 'aioseop_options' );
	$description = get_bloginfo('description');

	if ( is_home() || is_front_page() ) {

		if( empty( $aioseop_options['aiosp_home_description'] ) ){
			$rel .= '<meta name="description" content="'.$description.'">'."\n";
		}

	} else {

		$as_d = ( !empty($post->ID) && !empty( get_post_meta($post->ID, '_aioseop_description', true) ) )? get_post_meta($post->ID, '_aioseop_description', true): '';

		if( empty($as_d) && empty( $post->post_excerpt ) ){
			$rel .= '<meta name="description" content="'.$description.'">'."\n";
		}

	}

	echo $rel;
}
add_action('wp_head', 'description_tag');
