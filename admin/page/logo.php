<?php global $wrt_images_size; ?>
<div class="postbox custom_meta_box">
	<div class="postbox-header">
		<h2 class="hndle">ヘッダーロゴの設定</h2>
	</div>
	<div class="inside">
		<div class="form-group d-sm-flex">
			<div class="w-100">
				<div class="mediaupload">
					<p>画像をアップロード（画像推奨サイズ <?= implode('×', $wrt_images_size['hlogo']); ?>）</p>
					<div class="mb-3">
						<button type="button" class="select_btn" data-type="image">画像を選択</button>
						<button type="button" class="clear_btn">クリア</button>
					</div>
					<input type="hidden" name="custom_wrt_data[logo][header-img]" value="<?= $option['logo']['header-img']?? ''; ?>" id="logo_img">
					<div class="img_box logo <?php if(empty($option['logo']['header-img'])){ echo 'noselect'; } ?>">
						<?php
							if( !empty($option['logo']['header-img']) ){
								echo wp_get_attachment_image( $option['logo']['header-img'], array(180, 150) );
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="postbox custom_meta_box">
	<div class="postbox-header">
		<h2 class="hndle">フッターロゴの設定</h2>
	</div>
	<div class="inside">
		<div class="form-group d-sm-flex">
			<div class="w-100">
				<div class="mediaupload">
					<p>画像をアップロード（画像推奨サイズ <?= implode('×', $wrt_images_size['flogo']); ?>）</p>
					<div class="mb-3">
						<button type="button" class="select_btn" data-type="image">画像を選択</button>
						<button type="button" class="clear_btn">クリア</button>
					</div>
					<input type="hidden" name="custom_wrt_data[logo][footer-img]" value="<?= $option['logo']['footer-img']?? ''; ?>" id="logo_img">
					<div class="img_box logo <?php if(empty($option['logo']['footer-img'])){ echo 'noselect'; } ?>">
						<?php
							if( !empty($option['logo']['footer-img']) ){
								echo wp_get_attachment_image( $option['logo']['footer-img'], array(180, 150) );
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
