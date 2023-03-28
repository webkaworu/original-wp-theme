<?php
$option = get_option( 'custom_wrt_data', array() );
if( is_singular('post') ){
	$cat = get_the_category_layer(get_the_ID());
	$ancestors = get_ancestors( $cat->term_id, $cat->taxonomy );
	if( !empty($ancestors) ){
		$link = get_term_link($ancestors[array_key_last($ancestors)], $cat->taxonomy);
	}else{
		$link = get_term_link($cat->term_id, $cat->taxonomy);
	}
	$title = ( !empty($option['post']['default']['label']) )? $option['post']['default']['label']: $cat->name;
	$slug = ( !empty($option['post']['default']['slug']) )? $option['post']['default']['slug']: $title;
	if( $title == $slug ){
		$title = '';
	}
}else{
	$slug = get_query_var('post_type');
	$obj = get_post_type_object( $slug );
	$title = $obj->label;
	$link = get_post_type_archive_link($slug);

	$settings = get_custom_post_theme_settings($slug);
	if( !empty($settings) ){
		$title = $settings['label'];
		$slug = $settings['slug'];
	}
}
?>
<div class="main_title_box"<?= ( !empty($option['setting']['under-img']) )? ' style="background-image:url(\''.wp_get_attachment_url( $option['setting']['under-img'], 'full' ).'\');"': ''; ?>>
	<div class="main_title" style="color: <?= $option['setting']['under-title-color']?? '#fff'; ?>;">
		<?=  str_replace('-', '&nbsp;',mb_strtoupper($slug)); ?><small><?= $title; ?></small>
	</div>
</div>
<section class="page_default_section single_section container-fluid">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php if( !empty(get_post_meta($post->ID, 'show_capture_single', true)) && has_post_thumbnail() ): ?>
			<div class="capture mb-4">
				<?php the_post_thumbnail( 'detail', ['class' => 'img-fluid'] ); ?>
			</div>
		<?php endif; ?>
		<?php
			$cat = get_the_category_layer(get_the_ID());
			if ( !empty($cat) && ! is_wp_error( $cat ) ) :
		?>
			<h1 class="single_title"><?php echo esc_html( get_the_title() ); ?></h1>
			<div class="metas d-flex flex-wrap align-items-center mb-4">
				<span class="badge archive_badge"><?= $cat->name; ?></span>
				<time datetime="<?php the_time('Y-m-d'); ?>" class="archive_time"><?php the_time('Y.m.d'); ?></time>
			</div>
		<?php else: ?>
			<time datetime="<?php the_time('Y-m-d'); ?>" class="archive_time"><?php the_time('Y.m.d'); ?></time>
			<h1 class="single_title mt-4"><?php echo esc_html( get_the_title() ); ?></h1>
		<?php endif; ?>

		<?php the_content(); ?>

		<hr>

		<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();

				echo '<hr>';
			}
		?>

		<div class="back_btn_area">
			<a href="<?= $link; ?>" class="btn btn-outline-light"><?= $title; ?>一覧に戻る</a>
		</div>

	<?php endwhile; endif; ?>
</section>
