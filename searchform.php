<form role="search" method="get" class="search-form" action="<?= esc_url( home_url( '/' ) ) ?>">
	<div class="input-group">
		<button type="submit" class="btn search-submit"><i class="fas fa-search"></i></button>
		<input type="search" name="s" class="form-control search-field" value="<?= get_search_query(); ?>" placeholder="サイト内を検索">
	</div>
</form>
