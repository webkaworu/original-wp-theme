<?php $option = get_option( 'custom_wrt_data', array() ); ?>

<footer class="global_footer">
	<div class="container">
		<div class="footer_contents">
			<div class="footer_contents_left">
				<a href="<?= esc_url(home_url('/')); ?>" class="footer_logo">
					<?php
						if( empty($option['logo']['footer-img']) ){
							echo get_bloginfo('name');
						}else{
							echo wp_get_attachment_image( $option['logo']['footer-img'], 'full', false, ['class'=>'img-fluid', 'alt'=>get_bloginfo('name')] );
						}
					?>
				</a>
				<?php if ( has_nav_menu('footer-menu') ): ?>
					<?php wp_nav_menu( array( 'menu_class' => 'footer_nav', 'theme_location' => 'footer-menu' , 'container' => '' ) ); ?>
				<?php endif; ?>
			</div>
			<div class="footer_contents_right">
				<?php if( !empty($option['setting']['contact']) && $option['setting']['contact'] === 'set' ): ?>
					<a href="<?= $option['setting']['contact-url']?? ''; ?>" class="btn btn-outline-light contact_link"<?= (!empty($option['setting']['contact-url']) && strpos($option['setting']['contact-url'], home_url()) === false)? ' target="_blank" rel="noopener noreferrer"': ''; ?>>CONTACT</a>
				<?php endif; ?>
			</div>
		</div>
		<?php if( !empty($option['setting']['facebook']) || !empty($option['setting']['twitter']) || !empty($option['setting']['insta']) || !empty($option['setting']['youtube']) ): ?>
			<div class="footer_middle">
				<p class="follow_us">Follow us</p>
				<ul class="sns_link">
					<?php if( !empty($option['setting']['facebook']) ): ?>
						<li>
							<a href="<?= $option['setting']['facebook']; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i>Facebook</a>
						</li>
					<?php endif; ?>
					<?php if( !empty($option['setting']['insta']) ): ?>
						<li>
							<a href="<?= $option['setting']['insta']; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i>Instagram</a>
						</li>
					<?php endif; ?>
					<?php if( !empty($option['setting']['twitter']) ): ?>
						<li>
							<a href="<?= $option['setting']['twitter']; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-twitter"></i>Twitter</a></a>
						</li>
					<?php endif; ?>
					<?php if( !empty($option['setting']['youtube']) ): ?>
						<li>
							<a href="<?= $option['setting']['youtube']; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-youtube"></i>YouTube</a>
						</li>
					<?php endif; ?>
					<?php if( !empty($option['setting']['line']) ): ?>
						<li>
							<a href="<?= $option['setting']['line']; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-line"></i>LINE</a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		<?php endif; ?>
		<div class="footer_bottom">
			<?php if(!empty(get_privacy_policy_url())): ?>
				<a href="<?= get_privacy_policy_url(); ?>" class="text_link">PRIVACY POLICY</a>
			<?php endif; ?>
			<p class="copy">COPYRIGHT <?= date_i18n('Y'); ?> &copy; <?= get_bloginfo('name'); ?>. ALL RIGHTS RESERVED.</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
