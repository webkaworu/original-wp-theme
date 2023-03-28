<div class="archive_article">
	<?php while ($the_query->have_posts() ) : $the_query->the_post(); ?>
		<a href="<?php the_permalink(); ?>" class="archive_article_item">
			<div class="archive_img">
				<?= custom_get_post_capture($post->ID, 'thumb1', ['class'=>'img-fluid'], 'noimage.jpg'); ?>
			</div>
			<div class="archive_contents">
				<div class="metas d-flex flex-wrap align-items-center">
					<time class="archive_time" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
					<?php
						$cat = get_the_category_layer(get_the_ID());
						if( !empty($cat) ){
							echo '<span class="badge archive_badge">'.$cat->name.'</span>';
						}
					?>
				</div>
				<span class="archive_title"><?php the_title(); ?></span>
			</div>
		</a>
	<?php endwhile;wp_reset_postdata(); ?>
</div>
