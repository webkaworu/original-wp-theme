<?php
	$option = get_option( 'custom_wrt_data', array() );
	if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<div class="main_title_box"<?= ( !empty($option['setting']['under-img']) )? ' style="background-image:url(\''.wp_get_attachment_url( $option['setting']['under-img'], 'full' ).'\');"': ''; ?>>
	<h1 class="main_title" style="color: <?= $option['setting']['under-title-color']?? '#fff'; ?>;">
		<?= str_replace('-', '&nbsp;',mb_strtoupper(preg_replace('/-(\d)/', '', get_post_field( 'post_name', get_the_ID() )))); ?><small><?php the_title(); ?></small>
	</h1>
</div>
<section class="page_default_section container-fluid">
	<?php the_content(); ?>
	<?php
		if ( comments_open() || get_comments_number() ) {
			echo '<hr class="my-5">';

			comments_template();

			echo '<hr class="my-5">';
		}
	?>
</section>
<?php endwhile;endif; ?>
