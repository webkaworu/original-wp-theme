<div class="postbox custom_meta_box">
	<div class="postbox-header">
		<h2 class="hndle">投稿の設定</h2>
	</div>
	<div class="inside">
		<div class="form-group d-sm-flex">
			<label class="me-2">投稿の名前</label>
			<div class="form-inline">
				<input type="text" name="custom_wrt_data[post][default][label]" class="form-control" value="<?= $option['post']['default']['label']?? 'お知らせ'; ?>" maxlength="20" disabled>
			</div>
		</div>
		<div class="form-group d-sm-flex">
			<label class="me-2">スラッグ</label>
			<div class="form-inline">
				<input type="text" name="custom_wrt_data[post][default][slug]" class="form-control" value="<?= $option['post']['default']['slug']?? 'news'; ?>" maxlength="20" disabled>
			</div>
		</div>
		<div class="form-group d-sm-flex">
			<label class="me-2">一覧の表示</label>
			<input type="hidden" name="custom_wrt_data[post][default][archive]" value="list">
			<div class="d-flex">
				<div class="form-check">
					<label class="form-check-label font-weight-bold d-flex align-items-center flex-wrap">
						<input type="radio" class="form-check-input" name="custom_wrt_data[post][default][archive]" value="list"<?php if( empty($option['post']['default']['archive']) || !in_array($option['post']['default']['archive'], ['article', 'column']) ){ echo ' checked'; } ?>> リスト
						<span class="d-block mt-2 w-100">
							<img src="<?= get_theme_file_uri( 'src/img/admin/icon-list.jpg' ) ?>" alt="" class="img-fluid">
						</span>
					</label>
				</div>
				<div class="form-check ms-4">
					<label class="form-check-label font-weight-bold d-flex align-items-center flex-wrap">
						<input type="radio" class="form-check-input" name="custom_wrt_data[post][default][archive]" value="article"<?php if( isset($option['post']['default']['archive']) && $option['post']['default']['archive'] === 'article' ){ echo ' checked'; } ?>> アーティクル
						<span class="d-block mt-2 w-100">
							<img src="<?= get_theme_file_uri( 'src/img/admin/icon-article.jpg' ) ?>" alt="" class="img-fluid">
						</span>
					</label>
				</div>
				<div class="form-check ms-4">
					<label class="form-check-label font-weight-bold d-flex align-items-center flex-wrap">
						<input type="radio" class="form-check-input" name="custom_wrt_data[post][default][archive]" value="column"<?php if( isset($option['post']['default']['archive']) && $option['post']['default']['archive'] === 'column' ){ echo ' checked'; } ?>> カラム
						<span class="d-block mt-2 w-100">
							<img src="<?= get_theme_file_uri( 'src/img/admin/icon-column.jpg' ) ?>" alt="" class="img-fluid">
						</span>
					</label>
				</div>
			</div>
		</div>
<?php /*
		<div class="form-group d-sm-flex">
			<label class="me-2">1ページに表示する最大投稿数</label>
			<div class="form-inline">
				<input type="number" name="custom_wrt_data[post][default][pages]" class="form-control" value="<?= $option['post']['default']['pages']?? 10; ?>" min="1" pattern="^¥d+$">
			</div>
		</div>
*/ ?>
		<div class="form-group d-sm-flex">
			<label class="me-2">サイドバーの設定</label>
			<div class="w-100">
				<div class="d-flex">
					<p class="small align-self-center my-0 me-4">■ 一覧ページ</p>
					<div class="form-check">
						<label>
							<input type="radio" class="form-check-input" name="custom_wrt_data[post][default][side]" value="none"<?php if( empty($option['post']['default']['side']) || !in_array($option['post']['default']['side'], ['left', 'right']) ){ echo ' checked'; } ?>> なし
						</label>
					</div>
					<div class="form-check ms-4">
						<label>
							<input type="radio" class="form-check-input" name="custom_wrt_data[post][default][side]" value="left"<?php if( isset($option['post']['default']['side']) && $option['post']['default']['side'] === 'left' ){ echo ' checked'; } ?>> 左
						</label>
					</div>
					<div class="form-check ms-4">
						<label>
							<input type="radio" class="form-check-input" name="custom_wrt_data[post][default][side]" value="right"<?php if( isset($option['post']['default']['side']) && $option['post']['default']['side'] === 'right' ){ echo ' checked'; } ?>> 右
						</label>
					</div>
				</div>
				<div class="d-flex mt-3">
					<p class="small align-self-center my-0 me-4">■ 詳細ページ</p>
					<div class="form-check">
						<label>
							<input type="radio" class="form-check-input" name="custom_wrt_data[post][default][single_side]" value="none"<?php if( empty($option['post']['default']['single_side']) || !in_array($option['post']['default']['single_side'], ['left', 'right']) ){ echo ' checked'; } ?>> なし
						</label>
					</div>
					<div class="form-check ms-4">
						<label>
							<input type="radio" class="form-check-input" name="custom_wrt_data[post][default][single_side]" value="left"<?php if( isset($option['post']['default']['single_side']) && $option['post']['default']['single_side'] === 'left' ){ echo ' checked'; } ?>> 左
						</label>
					</div>
					<div class="form-check ms-4">
						<label>
							<input type="radio" class="form-check-input" name="custom_wrt_data[post][default][single_side]" value="right"<?php if( isset($option['post']['default']['single_side']) && $option['post']['default']['single_side'] === 'right' ){ echo ' checked'; } ?>> 右
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="postbox custom_meta_box">
	<div class="postbox-header">
		<h2 class="hndle">カスタム投稿の設定</h2>
	</div>
	<div class="inside">
		<?php
			$custom = $option['post']['custom']?? [];
			$count = ( !empty($option['post']['custom']) )? count($option['post']['custom']): 1;
			for( $i = 0; $i < $count; $i++ ):
		?>
			<div class="form-group-box add_to">
				<h3 class="add_title">カスタム投稿 <span class="add_title_num"><?= ($i + 1); ?></span></h3>
				<div class="form-group d-sm-flex">
					<label class="me-2">名前</label>
					<div class="form-inline">
						<input type="text" name="custom_wrt_data[post][custom][<?= $i; ?>][label]" class="form-control" value="<?= $custom[$i]['label']?? ''; ?>" maxlength="20">
					</div>
				</div>
				<div class="form-group d-sm-flex">
					<label class="me-2">スラッグ</label>
					<div class="form-inline">
						<input type="text" name="custom_wrt_data[post][custom][<?= $i; ?>][slug]" class="form-control" value="<?= $custom[$i]['slug']?? ''; ?>" maxlength="20">
					</div>
				</div>
				<div class="form-group d-sm-flex">
					<label class="me-2">一覧の表示</label>
					<input type="hidden" name="custom_wrt_data[post][custom][<?= $i; ?>][archive]" value="list">
					<div class="d-flex">
						<div class="form-check">
							<label class="form-check-label font-weight-bold d-flex align-items-center flex-wrap">
								<input type="radio" class="form-check-input" name="custom_wrt_data[post][custom][<?= $i; ?>][archive]" value="list"<?php if( empty($custom[$i]['archive']) || !in_array($custom[$i]['archive'], ['article', 'column']) ){ echo ' checked'; } ?>> リスト
								<span class="d-block mt-2 w-100">
									<img src="<?= get_theme_file_uri( 'src/img/admin/icon-list.jpg' ) ?>" alt="" class="img-fluid">
								</span>
							</label>
						</div>
						<div class="form-check ms-4">
							<label class="form-check-label font-weight-bold d-flex align-items-center flex-wrap">
								<input type="radio" class="form-check-input" name="custom_wrt_data[post][custom][<?= $i; ?>][archive]" value="article"<?php if( isset($custom[$i]['archive']) && $custom[$i]['archive'] === 'article' ){ echo ' checked'; } ?>> アーティクル
								<span class="d-block mt-2 w-100">
									<img src="<?= get_theme_file_uri( 'src/img/admin/icon-article.jpg' ) ?>" alt="" class="img-fluid">
								</span>
							</label>
						</div>
						<div class="form-check ms-4">
							<label class="form-check-label font-weight-bold d-flex align-items-center flex-wrap">
								<input type="radio" class="form-check-input" name="custom_wrt_data[post][custom][<?= $i; ?>][archive]" value="column"<?php if( isset($custom[$i]['archive']) && $custom[$i]['archive'] === 'column' ){ echo ' checked'; } ?>> カラム
								<span class="d-block mt-2 w-100">
									<img src="<?= get_theme_file_uri( 'src/img/admin/icon-column.jpg' ) ?>" alt="" class="img-fluid">
								</span>
							</label>
						</div>
					</div>
				</div>
				<div class="form-group d-sm-flex">
					<label class="me-2">1ページに表示する最大投稿数</label>
					<div class="form-inline">
						<input type="number" name="custom_wrt_data[post][custom][<?= $i; ?>][pages]" class="form-control" value="<?= $custom[$i]['pages']?? 10; ?>" min="1" pattern="^¥d+$">
					</div>
				</div>
				<div class="form-group d-sm-flex">
					<label class="me-2">サイドバーの設定</label>
					<div class="w-100">
						<div class="d-flex">
							<p class="small align-self-center my-0 me-4">■ 一覧ページ</p>
							<div class="form-check">
								<label>
									<input type="radio" class="form-check-input" name="custom_wrt_data[post][custom][<?= $i; ?>][side]" value="none"<?php if( empty($custom[$i]['side']) || !in_array($custom[$i]['side'], ['left', 'right']) ){ echo ' checked'; } ?>> なし
								</label>
							</div>
							<div class="form-check ms-4">
								<label>
									<input type="radio" class="form-check-input" name="custom_wrt_data[post][custom][<?= $i; ?>][side]" value="left"<?php if( isset($custom[$i]['side']) && $custom[$i]['side'] === 'left' ){ echo ' checked'; } ?>> 左
								</label>
							</div>
							<div class="form-check ms-4">
								<label>
									<input type="radio" class="form-check-input" name="custom_wrt_data[post][custom][<?= $i; ?>][side]" value="right"<?php if( isset($custom[$i]['side']) && $custom[$i]['side'] === 'right' ){ echo ' checked'; } ?>> 右
								</label>
							</div>
						</div>
						<div class="d-flex mt-3">
							<p class="small align-self-center my-0 me-4">■ 詳細ページ</p>
							<div class="form-check">
								<label>
									<input type="radio" class="form-check-input" name="custom_wrt_data[post][custom][<?= $i; ?>][single_side]" value="none"<?php if( empty($custom[$i]['single_side']) || !in_array($custom[$i]['single_side'], ['left', 'right']) ){ echo ' checked'; } ?>> なし
								</label>
							</div>
							<div class="form-check ms-4">
								<label>
									<input type="radio" class="form-check-input" name="custom_wrt_data[post][custom][<?= $i; ?>][single_side]" value="left"<?php if( isset($custom[$i]['single_side']) && $custom[$i]['single_side'] === 'left' ){ echo ' checked'; } ?>> 左
								</label>
							</div>
							<div class="form-check ms-4">
								<label>
									<input type="radio" class="form-check-input" name="custom_wrt_data[post][custom][<?= $i; ?>][single_side]" value="right"<?php if( isset($custom[$i]['single_side']) && $custom[$i]['single_side'] === 'right' ){ echo ' checked'; } ?>> 右
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endfor; ?>
		<div class="add_box text-right mt-4">
			<button type="button" class="btn btn-danger btn-sm d-none delete_btn">削除</button>
			<button type="button" class="btn btn-success btn-sm add_btn" data-limit="4">追加</button>
		</div>
	</div>
</div>
