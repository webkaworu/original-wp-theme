
<?php global $wrt_default_color, $wrt_site_colors, $wrt_site_fsizes, $wrt_images_size, $wrt_catch_copy; ?>
<div class="postbox custom_meta_box">
	<div class="postbox-header">
		<h2 class="hndle">色の設定</h2>
	</div>
	<div class="inside">
		<div class="form-group d-sm-flex">
			<span class="label" for="color">サイトカラー</span>
			<div class="d-flex flex-wrap setting_color_radio">
				<?php
					foreach( $wrt_site_colors as $color => $values ):
						if (!isset($option['setting']['color'])){
							$checked = ($color == $wrt_default_color)? ' checked': '';
						}else{
							$checked = ($option['setting']['color'] == $color)? ' checked': '';
						}
				?>
				<label class="form-check-label" data-bs-toggle="tooltip" title="<?= $values['label']; ?>">
					<input type="radio" name="custom_wrt_data[setting][color]" value="<?= $color; ?>"<?= $checked; ?> style="background-color:rgb(<?= $values['basic'] ?>);">
				</label>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>

<div class="postbox custom_meta_box">
	<div class="postbox-header">
		<h2 class="hndle">テキストの設定</h2>
	</div>
	<div class="inside">
		<div class="form-group d-sm-flex">
			<span class="label">テキストの大きさ</span>
			<div class="">
				<?php
					foreach( $wrt_site_fsizes as $size => $values ):
						if (!isset($option['setting']['font-size'])){
							$checked = ($size == 'normal')? ' checked': '';
						}else{
							$checked = ($option['setting']['font-size'] == $size)? ' checked': '';
						}
				?>
					<div class="form-check">
						<label>
							<input type="radio" class="form-check-input" name="custom_wrt_data[setting][font-size]" value="<?= $size; ?>"<?= $checked; ?>> <?= $values['label']; ?> <span style="font-size:<?= $values['size']; ?>px;display:inline-block;margin-left:10px;font-weight:normal;">この大きさで表示されます。</span>
						</label>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>

<div class="postbox custom_meta_box">
	<div class="postbox-header">
		<h2 class="hndle">サイトの設定</h2>
	</div>
	<div class="inside">
		<div class="form-group d-sm-flex">
			<span class="label">固定ページのサイドバー</span>
			<div class="d-flex">
				<div class="form-check">
					<label>
						<input type="radio" class="form-check-input" name="custom_wrt_data[setting][side]" value="none"<?php if( empty($option['setting']['side']) || !in_array($option['setting']['side'], ['left', 'right']) ){ echo ' checked'; } ?>> なし
					</label>
				</div>
				<div class="form-check ms-4">
					<label>
						<input type="radio" class="form-check-input" name="custom_wrt_data[setting][side]" value="left"<?php if( isset($option['setting']['side']) && $option['setting']['side'] === 'left' ){ echo ' checked'; } ?>> 左
					</label>
				</div>
				<div class="form-check ms-4">
					<label>
						<input type="radio" class="form-check-input" name="custom_wrt_data[setting][side]" value="right"<?php if( isset($option['setting']['side']) && $option['setting']['side'] === 'right' ){ echo ' checked'; } ?>> 右
					</label>
				</div>
			</div>
		</div>
		<div class="form-group d-sm-flex">
			<span class="label auto">お問い合わせページへのリンク表示</span>
			<div class="d-flex flex-grow-1">
				<div class="form-check">
					<label>
						<input type="radio" class="form-check-input" name="custom_wrt_data[setting][contact]" value="none"<?php if( empty($option['setting']['contact']) || $option['setting']['contact'] != 'set' ){ echo ' checked'; } ?>> なし
					</label>
				</div>
				<div class="ms-4 w-100 d-flex flex-column align-items-start">
					<div class="form-check">
						<label>
							<input type="radio" class="form-check-input" name="custom_wrt_data[setting][contact]" value="set"<?php if( isset($option['setting']['contact']) && $option['setting']['contact'] === 'set' ){ echo ' checked'; } ?>> 設置する
						</label>
					</div>
					<div class="collapse w-100 mt-2 <?php if( isset($option['setting']['contact']) && $option['setting']['contact'] === 'set' ){ echo 'show'; } ?>" id="contact_url_box">
						<input type="text" name="custom_wrt_data[setting][contact-url]" class="form-control" value="<?= $option['setting']['contact-url']?? ''; ?>" placeholder="例：<?= home_url(); ?>/contact/">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="postbox custom_meta_box">
	<div class="postbox-header">
		<h2 class="hndle">ソーシャルリンクの設定</h2>
	</div>
	<div class="inside">
		<p class="small">各ソーシャルサービスのボタンを表示する場合にURLを入力して下さい。</p>
		<div class="form-group d-sm-flex">
			<label for="facebook">Facebook</label>
			<input type="url" name="custom_wrt_data[setting][facebook]" class="form-control" id="facebook" value="<?php if( !empty($option['setting']['facebook']) ){ echo $option['setting']['facebook']; } ?>" placeholder="例：https://www.facebook.com/アカウント">
		</div>
		<div class="form-group d-sm-flex">
			<label for="twitter">Twitter</label>
			<input type="url" name="custom_wrt_data[setting][twitter]" class="form-control" id="twitter" value="<?php if( !empty($option['setting']['twitter']) ){ echo $option['setting']['twitter']; } ?>" placeholder="例：https://twitter.com/アカウント">
		</div>
		<div class="form-group d-sm-flex">
			<label for="insta">Instagram</label>
			<input type="url" name="custom_wrt_data[setting][insta]" class="form-control" id="insta" value="<?php if( !empty($option['setting']['insta']) ){ echo $option['setting']['insta']; } ?>" placeholder="例：https://www.instagram.com/アカウント">
		</div>
		<div class="form-group d-sm-flex">
			<label for="youtube">YouTube</label>
			<input type="url" name="custom_wrt_data[setting][youtube]" class="form-control" id="youtube" value="<?php if( !empty($option['setting']['youtube']) ){ echo $option['setting']['youtube']; } ?>" placeholder="例：https://www.youtube.com/channel/アカウント">
		</div>
		<div class="form-group d-sm-flex">
			<label for="line">LINE</label>
			<input type="url" name="custom_wrt_data[setting][line]" class="form-control" id="line" value="<?php if( !empty($option['setting']['line']) ){ echo $option['setting']['line']; } ?>" placeholder="例：https://line.me/en/アカウント">
		</div>
	</div>
</div>

<div class="postbox custom_meta_box">
	<div class="postbox-header">
		<h2 class="hndle">下層ページの設定</h2>
	</div>
	<div class="inside">
		<div class="form-group d-sm-flex">
			<span class="label">タイトル背景</span>
			<div class="w-100">
				<div class="mediaupload">
					<p>画像推奨サイズ <?= implode('×', $wrt_images_size['underimg']); ?></p>
					<div class="mb-3">
						<button type="button" class="select_btn" data-type="image">画像を選択</button>
						<button type="button" class="clear_btn">クリア</button>
					</div>
					<input type="hidden" name="custom_wrt_data[setting][under-img]" value="<?php if(!empty($option['setting']['under-img'])){ echo $option['setting']['under-img']; } ?>">
					<div class="img_box under <?php if(empty($option['setting']['under-img'])){ echo 'noselect'; } ?>">
						<?php
							if( !empty($option['setting']['under-img']) ){
								echo wp_get_attachment_image( $option['setting']['under-img'], array(99999, 220) );
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group d-sm-flex">
			<label>タイトル文字色</label>
			<input type="text" name="custom_wrt_data[setting][under-title-color]" class="add-color-picker-number-field" value="<?= $option['setting']['under-title-color']?? $wrt_catch_copy['under']['color']; ?>">
		</div>
	</div>
</div>

<div class="postbox custom_meta_box">
	<div class="postbox-header">
		<h2 class="hndle">ウィジェットの設定</h2>
	</div>
	<div class="inside">
		<div class="form-group d-sm-flex">
			<label>ウィジェットのタイプ</label>
			<div class="d-flex">
				<div class="form-check">
					<label>
						<input type="radio" class="form-check-input" name="custom_wrt_data[setting][widget]" value="classic"<?php if( empty($option['setting']['widget']) || $option['setting']['widget'] !== 'block' ){ echo ' checked'; } ?>> クラシック
					</label>
				</div>
				<div class="form-check ms-4">
					<label>
						<input type="radio" class="form-check-input" name="custom_wrt_data[setting][widget]" value="block"<?php if( isset($option['setting']['widget']) && $option['setting']['widget'] === 'block' ){ echo ' checked'; } ?>> ブロック
					</label>
				</div>
			</div>
		</div>
	</div>
</div>
