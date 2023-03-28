<section class="wrap_service img_position_<?= $contents['img_position']?? 'left'; ?>" id="home_section_<?= ($sort + 1); ?>">
	<div class="container">
		<div class="section_head">
			<h2 class="section_title"><?= $contents['title']?? ''; ?></h2>
			<p class="section_explain"><?= $contents['subtitle']?? ''; ?></p>
		</div>
		<div class="section_img">
			<div class="img_box">
				<?php
					if( !empty($contents['img']) ){
						echo wp_get_attachment_image( $contents['img'], 'full', false, ['class'=>'img-fluid'] );
					}else{
						echo '<img src="'.get_theme_file_uri('src/img/dummy/noimage-introduction.jpg').'" alt="" width="1080" height="500" class="img-fluid">';
					}
				?>
			</div>
		</div>
		<div class="section_text">
			<p class="mb-0"><?= nl2br($contents['text']?? ''); ?></p>
			<?php if(!empty($contents['link'])): ?>
				<a href="<?= $contents['link']; ?>" class="btn btn-outline-light"<?= (strpos($contents['link'], home_url()))? 'target="_blank" rel="noopener noreferrer"': ''; ?>>VIEW MORE</a>
			<?php endif; ?>
		</div>
	</div>
</section>
