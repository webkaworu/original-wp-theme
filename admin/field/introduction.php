<?php global $wrt_images_size; ?>
<div class="form-group d-sm-flex">
	<label>タイトル</label>
	<input type="text" name="custom_wrt_data[top][contents][<?= $index; ?>][title]" class="form-control" value="<?php if(!empty($content['title'])){ echo $content['title']; } ?>">
</div>
<div class="form-group d-sm-flex">
	<label>サブタイトル</label>
	<input type="text" name="custom_wrt_data[top][contents][<?= $index; ?>][subtitle]" class="form-control" value="<?php if(!empty($content['subtitle'])){ echo $content['subtitle']; } ?>">
</div>
<div class="form-group d-sm-flex">
	<label>画像</label>
	<div class="d-flex align-items-center">
		<div class="mediaupload">
			<p>画像推奨サイズ <?= implode('×', $wrt_images_size['introduction']); ?></p>
			<div class="mb-3">
				<button type="button" class="select_btn" data-type="image">画像を選択</button>
				<button type="button" class="clear_btn">クリア</button>
			</div>
			<input type="hidden" name="custom_wrt_data[top][contents][<?= $index; ?>][img]" value="<?php if(!empty($content['img'])){ echo $content['img']; } ?>" id="main_img">
			<div class="img_box main <?php if(empty($content['img'])){ echo 'noselect'; } ?>">
				<?php
					if( !empty($content['img']) ){
						echo wp_get_attachment_image( $content['img'], array(240, 99999) );
					}
				?>
			</div>
		</div>
		<div class="ms-3">
			<p>■ 画像の表示位置</p>
			<div class="form-check">
				<label>
					<input type="radio" class="form-check-input" name="custom_wrt_data[top][contents][<?= $index; ?>][img_position]" value="left"<?php if( empty($content['img_position']) || !in_array($content['img_position'], ['right']) ){ echo ' checked'; } ?>> 左に表示
				</label>
			</div>
			<div class="form-check">
				<label>
					<input type="radio" class="form-check-input" name="custom_wrt_data[top][contents][<?= $index; ?>][img_position]" value="right"<?php if( !empty($content['img_position']) && $content['img_position'] === 'right' ){ echo ' checked'; } ?>> 右に表示
				</label>
			</div>
		</div>
	</div>
</div>
<div class="form-group d-sm-flex">
	<label>紹介文</label>
	<textarea name="custom_wrt_data[top][contents][<?= $index; ?>][text]" class="form-control" rows="10"><?php if(!empty($content['text'])){ echo $content['text']; } ?></textarea>
</div>
<div class="form-group d-sm-flex">
	<label>リンク先</label>
	<input type="text" name="custom_wrt_data[top][contents][<?= $index; ?>][link]" class="form-control" value="<?= $content['link']?? ''; ?>">
</div>
