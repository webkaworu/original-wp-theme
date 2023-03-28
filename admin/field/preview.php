<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="format-detection" content="telephone=no" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;700&family=Noto+Serif+JP:wght@300;400;700&display=swap">
	<?php wp_head(); ?>
	<style>
		a{
			pointer-events:none !important;
		}
	</style>
</head>

<body>
<main class="top_main">
<?php
$mv = ( !empty($option['top']['main-img']) )? wp_get_attachment_url( $option['top']['main-img'], 'full' ): get_template_directory_uri().'/src/img/top/sample-mv.jpg';
?>
<div class="mv container">
	<?php if( !empty($option['top']['catch_s']) || !empty($option['top']['catch_l']) ): ?>
		<div class="mv_text <?= $option['top']['catch_position']?? 'left-center'; ?>">
			<div class="catchcopy_box">
				<?php if( !empty($option['top']['catch_l']) ): ?>
					<p class="catchcopy <?= (!empty($option['top']['catch_l_back']))? 'has_bg': ''; ?>" style="color: <?= $option['top']['catch_l_color']?? '#fff'; ?>;<?= (!empty($option['top']['catch_s_back']))? 'background-color: '.$option['top']['catch_l_back'].';': ''; ?>">
						<?= nl2br($option['top']['catch_l']); ?>
					</p>
				<?php endif; ?>
				<?php if( !empty($option['top']['catch_s']) ): ?>
					<p class="catchcopy_sub <?= (!empty($option['top']['catch_s_back']))? 'has_bg': ''; ?>" style="color: <?= $option['top']['catch_s_color']?? '#fff'; ?>;<?= (!empty($option['top']['catch_s_back']))? 'background-color: '.$option['top']['catch_s_back'].';': ''; ?>">
						<?= nl2br($option['top']['catch_s']); ?>
					</p>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
	<div class="mv_img">
		<img src="<?= $mv; ?>" alt="" class="img-fluid d-none d-md-block">
		<?php if( !empty($option['top']['main-img-sp']) ): ?>
			<img src="<?= wp_get_attachment_url( $option['top']['main-img-sp'], 'full' ); ?>" alt="" class="img-fluid d-block d-md-none">
		<?php elseif( !empty($option['top']['main-img']) ): ?>
			<img src="<?= wp_get_attachment_url( $option['top']['main-img'], 'mvsp' ); ?>" alt="" class="img-fluid d-block d-md-none">
		<?php else: ?>
			<img src="<?= get_template_directory_uri(); ?>/src/img/top/sample-mv.jpg" alt="" class="img-fluid d-block d-md-none">
		<?php endif; ?>
	</div>
</div>

<?php
	if( !empty($option['top']['contents']) ){
		foreach( $option['top']['contents'] as $sort => $contents ){
			require get_theme_file_path('view/field/'.$contents['type'].'.php');
		}
	}
?>
</main>

<?php wp_footer(); ?>
</body>

</html>
