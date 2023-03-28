<?php global $wrt_images_size, $wrt_catch_copy; ?>
<div class="postbox custom_meta_box">
	<div class="postbox-header">
		<h2>メインビジュアルの設定</h2>
	</div>
	<div class="inside">
		<div class="form-group d-sm-flex">
			<label>画像</label>
			<div class="">
				<div class="mediaupload">
					<p class="font-weight-bold">■PC</p>
					<p>画像推奨サイズ <?= implode('×', $wrt_images_size['mv']); ?></p>
					<div class="mb-3">
						<button type="button" class="select_btn" data-type="image">画像を選択</button>
						<button type="button" class="clear_btn">クリア</button>
					</div>
					<input type="hidden" name="custom_wrt_data[top][main-img]" value="<?php if(!empty($option['top']['main-img'])){ echo $option['top']['main-img']; } ?>" id="main_img">
					<div class="img_box main <?php if(empty($option['top']['main-img'])){ echo 'noselect'; } ?>">
						<?php
							if( !empty($option['top']['main-img']) ){
								echo wp_get_attachment_image( $option['top']['main-img'], array(240, 99999) );
							}
						?>
					</div>
				</div>
				<div class="mediaupload">
					<p class="font-weight-bold">■SP</p>
					<p>画像推奨サイズ <?= implode('×', $wrt_images_size['mvsp']); ?></p>
					<div class="mb-3">
						<button type="button" class="select_btn" data-type="image">画像を選択</button>
						<button type="button" class="clear_btn">クリア</button>
					</div>
					<input type="hidden" name="custom_wrt_data[top][main-img-sp]" value="<?php if(!empty($option['top']['main-img-sp'])){ echo $option['top']['main-img-sp']; } ?>" id="main_img_sp">
					<div class="img_box main <?php if(empty($option['top']['main-img-sp'])){ echo 'noselect'; } ?>">
						<?php
							if( !empty($option['top']['main-img-sp']) ){
								echo wp_get_attachment_image( $option['top']['main-img-sp'], array(240, 99999) );
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group d-sm-flex">
			<label>キャッチコピー</label>
			<div class="w-100">
				<p>メインビジュアルの画像の上に配置される文章です。（20文字以内）</p>
				<div class="border-top py-2">
					<p class="font-weight-bold">■ キャッチコピー(small)</p>
					<p>テキスト</p>
					<textarea name="custom_wrt_data[top][catch_s]" class="form-control" rows="2"><?= $option['top']['catch_s']?? ''; ?></textarea>
					<div class="d-flex mt-3">
						<div class="me-4">
							<p class="mt-0">文字色</p>
							<input type="text" name="custom_wrt_data[top][catch_s_color]" class="add-color-picker-number-field" value="<?= $option['top']['catch_s_color']?? $wrt_catch_copy['small']['color']; ?>">
						</div>
						<div>
							<p class="mt-0">背景色</p>
							<input type="text" name="custom_wrt_data[top][catch_s_back]" class="add-color-picker-number-field" value="<?= $option['top']['catch_s_back']?? $wrt_catch_copy['small']['back']; ?>">
						</div>
					</div>
				</div>
				<div class="border-top py-2">
					<p class="font-weight-bold">■ キャッチコピー(strong)</p>
					<p>テキスト</p>
					<textarea name="custom_wrt_data[top][catch_l]" class="form-control" rows="2"><?= $option['top']['catch_l']?? ''; ?></textarea>
					<div class="d-flex mt-3">
						<div class="me-4">
							<p class="mt-0">文字色</p>
							<input type="text" name="custom_wrt_data[top][catch_l_color]" class="add-color-picker-number-field" value="<?= $option['top']['catch_l_color']?? $wrt_catch_copy['strong']['color']; ?>">
						</div>
						<div>
							<p class="mt-0">背景色</p>
							<input type="text" name="custom_wrt_data[top][catch_l_back]" class="add-color-picker-number-field" value="<?= $option['top']['catch_l_back']?? $wrt_catch_copy['strong']['back']; ?>">
						</div>
					</div>
				</div>
				<div class="border-top py-2">
					<p class="font-weight-bold">■ 表示位置</p>
					<table class="table table-bordered d-position-table">
						<tr>
							<td>
								<input type="radio" name="custom_wrt_data[top][catch_position]" value="left-top" id="leftTop"<?php if(!empty($option['top']['catch_position']) && $option['top']['catch_position'] == 'left-top'){ echo ' checked';} ?>><label for="leftTop"></label>
							</td>
							<td>
								<input type="radio" name="custom_wrt_data[top][catch_position]" value="center-top" id="centerTop"<?php if(!empty($option['top']['catch_position']) && $option['top']['catch_position'] == 'center-top'){ echo ' checked';} ?>><label for="centerTop"></label>
							</td>
							<td>
								<input type="radio" name="custom_wrt_data[top][catch_position]" value="right-top" id="rightTop"<?php if(!empty($option['top']['catch_position']) && $option['top']['catch_position'] == 'right-top'){ echo ' checked';} ?>><label for="rightTop"></label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="radio" name="custom_wrt_data[top][catch_position]" value="left-center" id="leftCenter"<?php if(empty($option['top']['catch_position']) || $option['top']['catch_position'] == 'left-center'){ echo ' checked';} ?>><label for="leftCenter"></label>
							</td>
							<td>
								<input type="radio" name="custom_wrt_data[top][catch_position]" value="center-center" id="centerCenter"<?php if(!empty($option['top']['catch_position']) && $option['top']['catch_position'] == 'center-center'){ echo ' checked';} ?>><label for="centerCenter"></label>
							</td>
							<td>
								<input type="radio" name="custom_wrt_data[top][catch_position]" value="right-center" id="rightCenter"<?php if(!empty($option['top']['catch_position']) && $option['top']['catch_position'] == 'right-center'){ echo ' checked';} ?>><label for="rightCenter"></label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="radio" name="custom_wrt_data[top][catch_position]" value="left-bottom" id="leftBottom"<?php if(!empty($option['top']['catch_position']) && $option['top']['catch_position'] == 'left-bottom'){ echo ' checked';} ?>><label for="leftBottom"></label>
							</td>
							<td>
								<input type="radio" name="custom_wrt_data[top][catch_position]" value="center-bottom" id="centerBottom"<?php if(!empty($option['top']['catch_position']) && $option['top']['catch_position'] == 'center-bottom'){ echo ' checked';} ?>><label for="centerBottom"></label>
							</td>
							<td>
								<input type="radio" name="custom_wrt_data[top][catch_position]" value="right-bottom" id="rightBottom"<?php if(!empty($option['top']['catch_position']) && $option['top']['catch_position'] == 'right-bottom'){ echo ' checked';} ?>><label for="rightBottom"></label>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="custom_sortable">
	<?php
		$contents = ( !empty($option['top']['contents']) )? $option['top']['contents']: array();
		$count = ( !empty($option['top']['contents']) )? count($option['top']['contents']): 1;
		for( $index = 0; $index < $count; $index++ ){
			$content = $contents[$index]?? [];
			require get_theme_file_path('admin/field/top-contents.php');
		}
	?>

	<div class="add_box text-right mt-2">
		<button type="button" class="btn btn-success btn-sm handle-box-add">追加</button>
	</div>
</div>
