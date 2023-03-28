<aside id="sidebar" role="complementary" data-aos="fade" data-aos-delay="500">
	<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! is_active_sidebar('widget_aside') ): ?>
		<div class="widget">
			<?php get_search_form(); ?>
		</div>

		<?php
			$categories = get_categories([
				'parent' => 0,
				'hide_empty' => 0,
			]);
			if( !empty($categories) ):
		?>
			<div class="widget widget_categories">
				<h2>カテゴリー</h2>
				<ul class="category_list">
					<?php foreach( $categories as $category ): ?>
						<li>
							<a href="<?= get_category_link( $category->term_id ); ?>" class="<?= (is_category($category->term_id))? 'active': ''; ?>">
								<?= $category->name; ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
		<?php
			$tags = get_tags(['orderby'=>'count', 'order'=>'DESC', ]);
			if( !empty($tags) ):
		?>
			<div class="widget widget_tag_cloud">
				<h2>タグ</h2>
				<ul class="tag_list">
					<?php foreach( $tags as $tag ): ?>
						<li><a href="<?= get_tag_link( $tag->term_id ); ?>" class="<?= (is_tag($tag->term_id))? 'active': ''; ?>"><?= $tag->name; ?></a></li>
						<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
		<?php
			$archives = wp_get_archives(['type' => 'monthly', 'echo' => false]);
			if( !empty($archives) ):
		?>
			<div class="widget widget_archive">
				<h2>アーカイブ</h2>
				<ul class="archive_list">
					<?= $archives; ?>
				</ul>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<?php dynamic_sidebar( 'widget_aside' ); ?>
	<?php endif ?>
</aside>
