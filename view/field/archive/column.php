<div class="archive_column">
	<?php while ($the_query->have_posts() ) : $the_query->the_post(); ?>
		<a href="<?php the_permalink(); ?>" class="archive_column_item">
			<?php $img = ( has_post_thumbnail($post->ID) )? wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'thumb1' ): get_theme_file_uri('src/img/dummy/noimage.jpg'); ?>
			<div class="archive_img" style="background-image:url('<?= $img; ?>');"></div>
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
		</a>
	<?php endwhile;wp_reset_postdata(); ?>
</div>
