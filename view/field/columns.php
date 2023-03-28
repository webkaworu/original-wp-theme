<section class="column_section" id="home_section_<?= ($sort + 1); ?>">
	<div class="container">
		<div class="section_head">
			<h2 class="section_title"><?= $contents['title']?? ''; ?></h2>
			<p class="section_explain"><?= $contents['subtitle']?? ''; ?></p>
		</div>
		<?php if( !empty($contents['columns']) ): ?>
			<div class="contents_column <?= (count($contents['columns']) > 4)? 'justify-content-start': ''; ?>">
				<?php foreach( $contents['columns'] as $key => $column ): ?>
					<?php if( empty(array_filter($column)) ){ continue; } ?>
					<?php if(!empty($column['link'])): ?>
						<a href="<?= $column['link']; ?>" class="contents_box"<?= (strpos($column['link'], home_url()))? 'target="_blank" rel="noopener noreferrer"': ''; ?>>
					<?php else: ?>
						<div class="contents_box">
					<?php endif; ?>
						<?php $img = ( !empty($column['img']) )? wp_get_attachment_url( $column['img'], 'thumb2' ): get_theme_file_uri('src/img/dummy/noimage-column.jpg'); ?>
						<div class="contents_img" style="background-image:url('<?= $img; ?>');"></div>
						<?php
							if( !empty($column['title']) ){
								echo '<h3 class="contents_title">'.$column['title'].'</h3>';
							}
						?>
						<p class="contents_text"><?= $column['subtitle']?? ''; ?></p>
					<?= (!empty($column['link']))? '</a>': '</div>'; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
