<div class="archive_list">
	<?php while ($the_query->have_posts() ) : $the_query->the_post(); ?>
		<a href="<?php the_permalink(); ?>" class="archive_list_item">
			<time class="archive_time" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
			<?php
				$cat = get_the_category_layer(get_the_ID());
				if( !empty($cat) ){
					echo '<span class="badge archive_badge">'.$cat->name.'</span>';
				}
			?>
			<span class="archive_title"><?php the_title(); ?></span>
		</a>
	<?php endwhile;wp_reset_postdata(); ?>
</div>
