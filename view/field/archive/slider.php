<div class="swiper_box <?= ($the_query->found_posts > 2 && $contents['pages'] > 2)? 'swiper_true': ''; ?>">
	<div class="swiper_view">
		<div class="swiper <?= ($the_query->found_posts > 2 && $contents['pages'] > 2)? 'swipe_section_slider': ''; ?>">
			<div class="swiper-wrapper">
				<?php while ($the_query->have_posts() ) : $the_query->the_post(); ?>
					<?php $img = ( has_post_thumbnail($post->ID) )? wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'thumb1' ): get_theme_file_uri('src/img/dummy/noimage.jpg'); ?>
					<div class="swiper-slide">
						<div class="swipe_img" style="background-image:url('<?= $img; ?>');"></div>
						<h3 class="archive_title"><?php the_title(); ?></h3>
						<div class="metas d-flex flex-wrap align-items-center">
							<time class="archive_time" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
							<?php
								$cat = get_the_category_layer(get_the_ID());
								if( !empty($cat) ){
									echo '<span class="badge archive_badge">'.$cat->name.'</span>';
								}
							?>
						</div>
						<div class="swipe_link">
							<a href="<?php the_permalink(); ?>" class="btn btn-outline-light">READ MORE</a>
						</div>
					</div>
				<?php endwhile;wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
	<div class="swiper-pagination"></div>
</div>
