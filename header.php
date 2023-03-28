<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="format-detection" content="telephone=no" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php wp_head();$option = get_option( 'custom_wrt_data', array() ); ?>
</head>

<body <?php body_class(); ?>>
<header class="global_header hum_parent">
	<div class="container">
		<?= (is_home() || is_front_page())? '<h1 class="logo_box">': '<div class="logo_box">'; ?>
			<span class="logo_link <?= ( empty($option['logo']['header-img']) )? 'no_image': ''; ?>">
				<a href="<?= esc_url(home_url('/')); ?>">
					<?php
						if( empty($option['logo']['header-img']) ){
							echo get_bloginfo('name');
						}else{
							echo wp_get_attachment_image( $option['logo']['header-img'], 'full', false, ['class'=>'img-fluid', 'alt'=>get_bloginfo('name')] );
						}
					?>
				</a>
			</span>
		<?= (is_home() || is_front_page())? '</h1>': '</div>'; ?>
		<nav class="global_nav">
			<?php if ( has_nav_menu('global-menu') ): ?>
				<?php
					wp_nav_menu([
						'menu_class' => 'global_menu',
						'theme_location' => 'global-menu',
						'container_class' => 'global_menu_box',
						'menu_id' => ''
					]);
				?>
				<div class="golobal_nav_paging">
					<i class="fa-solid fa-angle-up prev"></i>
					<i class="fa-solid fa-angle-down next"></i>
				</div>
			<?php endif; ?>
		</nav>
		<nav class="hum_navigation">
			<div class="hum_contents">
				<?php if ( has_nav_menu('global-menu') ): ?>
					<div class="hum_main_nav">
						<?php
							wp_nav_menu([
								'menu_class' => 'navbar-nav',
								'theme_location' => 'global-menu',
								'container' => false,
								'menu_id' => ''
							]);
						?>
					</div>
				<?php endif; ?>
				<div class="hum_sub_nav">
					<?php if( !empty($option['setting']['contact']) && $option['setting']['contact'] === 'set' ): ?>
						<a href="<?= $option['setting']['contact-url']?? ''; ?>" class="btn btn-base contact_link"<?= (!empty($option['setting']['contact-url']) && strpos($option['setting']['contact-url'], home_url()) === false)? ' target="_blank" rel="noopener noreferrer"': ''; ?> id="follow_contact">CONTACT</a>
					<?php endif; ?>
					<?php if( !empty($option['setting']['facebook']) || !empty($option['setting']['twitter']) || !empty($option['setting']['insta']) || !empty($option['setting']['youtube']) ): ?>
						<ul class="sns_link">
							<?php if( !empty($option['setting']['facebook']) ): ?>
								<li>
									<a href="<?= $option['setting']['facebook']; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a>
								</li>
							<?php endif; ?>
							<?php if( !empty($option['setting']['insta']) ): ?>
								<li>
									<a href="<?= $option['setting']['insta']; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a>
								</li>
							<?php endif; ?>
							<?php if( !empty($option['setting']['twitter']) ): ?>
								<li>
									<a href="<?= $option['setting']['twitter']; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-twitter"></i></a>
								</li>
							<?php endif; ?>
							<?php if( !empty($option['setting']['youtube']) ): ?>
								<li>
									<a href="<?= $option['setting']['youtube']; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-youtube"></i></a>
								</li>
							<?php endif; ?>
							<?php if( !empty($option['setting']['line']) ): ?>
								<li>
									<a href="<?= $option['setting']['line']; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-line"></i></a>
								</li>
							<?php endif; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</nav>
		<button type="button" class="hum_toggle">
			<span class="hum_toggle_icon"></span>
		</button>
	</div>
</header>
