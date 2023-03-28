<?php
	$post_type = $contents['post_type']?? 'post';

	$the_query = new WP_Query([
		'post_status' => 'publish',
		'post_type' => $post_type,
		'posts_per_page' => $contents['pages']?? 6,
		'meta_query' => [
			[
				'key' => 'show_front_page',
				'compare' => 'EXISTS'
			]
		],
	]);

	$categories = get_categories(['hide_empty' => false]);
	$current = (!empty($categories))? $categories[0]: [];
	foreach( $categories as $category ){
		if( $category->parent === 0 ){
			$current = $category;
			break;
		}
	}

	if ( $the_query->have_posts() ) :
?>
<section class="post_section <?= $contents['archive']; ?>_archive_section container" id="home_section_<?= ($sort + 1); ?>">
	<div class="d-flex">
		<div class="section_head">
			<h2 class="section_title"><?= $contents['title']?? ''; ?></h2>
			<p class="section_explain"><?= $contents['subtitle']?? ''; ?></p>
		</div>
		<?php require get_theme_file_path('view/field/archive/'.$contents['archive'].'.php'); ?>
	</div>
	<?php if($post_type === 'post'): ?>
		<?php if(!empty($current)): ?>
			<a href="<?= get_category_link( $current->term_id ) ?>" class="btn btn-outline-light">READ MORE</a>
		<?php endif; ?>
	<?php else: ?>
		<a href="<?= get_post_type_archive_link($contents['post_type']); ?>" class="btn btn-outline-light">READ MORE</a>
	<?php endif; ?>
</section>
<?php endif; ?>
