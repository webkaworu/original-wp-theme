<?php get_header(); ?>

<?php
$sidebarclass = '';
$option = get_option( 'custom_wrt_data', array() );
if( isset($option['404']['side']) && $option['404']['side'] !== 'none' ){
	$sidebarclass = 'sidebar sidebar_'.$option['404']['side'];
}
?>
<main class="sub_main error_404 <?= $sidebarclass; ?>">
	<div class="main_title_box"<?= ( !empty($option['setting']['under-img']) )? ' style="background-image:url(\''.wp_get_attachment_url( $option['setting']['under-img'], 'full' ).'\');"': ''; ?>>
		<h1 class="main_title" style="color: <?= $option['setting']['under-title-color']?? '#fff'; ?>;" data-aos="fade">
			<?= $option['404']['title']?? '404 NOT FOUND'; ?><small><?= $option['404']['subtitle']?? 'ページがみつかりません'; ?></small>
		</h1>
	</div>
	<section class="page_default_section" data-aos="fade-up">
		<div class="container">
			<?php if ( is_active_sidebar( 'widget_404_error' ) ) : ?>
				<div class="widget_404_error mb-5">
					<?php dynamic_sidebar( 'widget_404_error' ); ?>
				</div>
			<?php else: ?>
				<p class="text-center lh-lg mb-5">見つからない場合は<br class="d-sm-none">準備中のページの可能性がございます。<br>更新されるまでしばらくお待ち下さい。</p>
			<?php endif; ?>
			<a href="<?= esc_url(home_url('/')); ?>" class="btn btn-dark btn_back">TOP</a>
		</div>
	</section>
	<?php
		if ( !empty($sidebarclass) ){
			get_sidebar();
		}
	?>
</main>

<?php get_footer(); ?>
