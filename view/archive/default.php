<?php
	$option = get_option( 'custom_wrt_data', array() );
	if (is_post_type_archive() ){
		$title = post_type_archive_title('', false);
		$slug = get_query_var('post_type');

		$settings = get_custom_post_theme_settings($slug);
		if( !empty($settings) ){
			$title = $settings['label'];
			$slug = $settings['slug'];
			$type =  (!empty($settings['archive']))? $settings['archive']: 'list';
		}
		$article = $title;
	}else{
		if( !empty($option['post']['default']['label']) ){
			$title = $option['post']['default']['label'];
		}elseif( is_category() || is_tag() || is_tax() ){
			$title = single_tag_title('', false);
		}elseif( is_day() ){
			$title = get_the_time('Y年m月d日');
		}elseif( is_month() ){
			$title = get_the_time('Y年m月');
		}elseif( is_year() ){
			$title = get_the_time('Y年');
		}elseif( is_search() ){
			$title = '検索結果';
		}else{
			$title = '投稿';
		}
		$slug = ( !empty($option['post']['default']['slug']) )? $option['post']['default']['slug']: $title;
		if( $title == $slug ){
			$title = '';
		}
		$type =  ( !empty($option['post']['default']['archive']) )? $option['post']['default']['archive']: 'list';
		$article = ( !empty($option['post']['default']['label']) )? $option['post']['default']['label']: '投稿';
	}
?>
<div class="main_title_box"<?= ( !empty($option['setting']['under-img']) )? ' style="background-image:url(\''.wp_get_attachment_url( $option['setting']['under-img'], 'full' ).'\');"': ''; ?>>
	<h1 class="main_title" style="color: <?= $option['setting']['under-title-color']?? '#fff'; ?>;">
		<?=  str_replace('-', '&nbsp;',mb_strtoupper($slug)); ?><small><?= $title; ?></small>
	</h1>
</div>
<section class="archive_section">
	<div class="container">
		<?php
			if( is_category() ):
				$categories = get_categories([
					'parent' => 0,
					'hide_empty' => 0,
				]);
				if( count($categories) > 1 ):
		?>
				<ul class="nav nav-pills category_nav">
					<?php foreach( $categories as $category ): ?>
						<li class="nav-item">
							<a href="<?= get_category_link( $category->term_id ); ?>" class="nav-link <?= (is_category($category->term_id) || in_category($category->term_id))? 'active': ''; ?>"><?= $category->name; ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		<?php elseif( is_tag() || is_tax() ): ?>
			<h2 class="archive_section_title">「<?= single_term_title('', false); ?>」の<?= $article; ?>一覧</h2>
		<?php elseif( is_date() ): ?>
			<?php if ( is_day() ): ?>
				<h2 class="archive_section_title"><?= get_the_time('Y年m月d日'); ?>の<?= $article; ?>一覧</h2>
			<?php elseif ( is_month() ): ?>
				<h2 class="archive_section_title"><?= get_the_time('Y年m月'); ?>の<?= $article; ?>一覧</h2>
			<?php elseif ( is_year() ): ?>
				<h2 class="archive_section_title"><?= get_the_time('Y年'); ?>の<?= $article; ?>一覧</h2>
			<?php endif; ?>
		<?php elseif( is_search() ): $search_query = trim(strip_tags(get_search_query())); ?>
			<?php if( !empty($search_query) ): ?>
				<h2 class="archive_section_title">「<?= $search_query; ?>」の検索結果</h2>
			<?php endif; ?>
		<?php endif; ?>
		<?php if ( have_posts() ) : ?>
			<?php
				if( file_exists(get_theme_file_path('view/field/archive/'.$type.'.php')) ){
					global $wp_query;
					$the_query = $wp_query;
					require( get_theme_file_path('view/field/archive/'.$type.'.php') );
				}
			?>
			<?= wp_pagination(); ?>
		<?php else: ?>
			<?php if( is_category() || is_tag() || is_tax() ): ?>
				<p class="h5 d-flex justify-content-center">「<?= single_term_title('', false); ?>」に関連する<?= $article; ?>はありません</p>
			<?php elseif( is_day() ): ?>
				<p class="h5 d-flex justify-content-center"><?= get_the_time('Y年m月d日'); ?>に公開された<?= $article; ?>はありません</p>
			<?php elseif( is_month() ): ?>
				<p class="h5 d-flex justify-content-center"><?= get_the_time('Y年m月'); ?>に公開された<?= $article; ?>はありません</p>
			<?php elseif( is_year() ): ?>
				<p class="h5 d-flex justify-content-center"><?= get_the_time('Y年'); ?>に公開された<?= $article; ?>はありません</p>
			<?php elseif( is_search() ): ?>
				<p class="h5 d-flex justify-content-center">「<?= get_search_query(); ?>」に関連する<?= $article; ?>はありません</p>
			<?php else: ?>
				<p class="h5 d-flex justify-content-center">公開中の<?= $article; ?>はありません</p>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</section>
