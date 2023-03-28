<section class="youtube_section" id="home_section_<?= ($sort + 1); ?>">
	<div class="container">
		<div class="section_head">
			<h2 class="section_title"><?= $contents['title']?? ''; ?></h2>
			<p class="section_explain"><?= $contents['subtitle']?? ''; ?></p>
			<?php if(!empty($contents['text'])): ?>
				<p class="section_text" data-inverted="<?= $contents['text']; ?>"><?= nl2br($contents['text']); ?></p>
			<?php endif; ?>
		</div>
		<div class="box_youtube">
			<?= (!empty($contents['youtube']))? wp_oembed_get($contents['youtube']): ''; ?>
		</div>
		<div class="section_foot">
			<?php if(!empty($contents['account'])): ?>
				<a href="<?= $contents['account']; ?>" class="btn btn-outline-light" target="_blank" rel="noopener noreferrer">動画一覧（外部サイト）<span class="arrow"></span></a>
			<?php endif; ?>
		</div>
	</div>
</section>
