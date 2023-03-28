<?php global $wrt_images_size; ?>
<div class="form-group d-sm-flex">
	<label>タイトル</label>
	<input type="text" name="custom_wrt_data[top][contents][<?= $index; ?>][title]" class="form-control" value="<?php if(!empty($content['title'])){ echo $content['title']; } ?>">
</div>
<div class="form-group d-sm-flex">
	<label>サブタイトル</label>
	<input type="text" name="custom_wrt_data[top][contents][<?= $index; ?>][subtitle]" class="form-control" value="<?php if(!empty($content['subtitle'])){ echo $content['subtitle']; } ?>">
</div>
<div class="form-group">
	<label class="d-block">コンテンツ<small class="ms-3 fw-normal">画像推奨サイズ <?= implode('×', $wrt_images_size['column']); ?></small></label>
	<div class="row">
		<?php
			$columns = ( !empty($content['columns']) )? $content['columns']: array();
			$total = ( !empty($content['columns']) )? count($content['columns']): 1;
			for( $i = 0; $i < $total; $i++ ):
		?>
			<div class="col-md-3 mb-4 add_to">
				<div class="border p-3">
					<div class="mediaupload">
						<div class="mb-3">
							<button type="button" class="select_btn" data-type="image">画像を選択</button>
							<button type="button" class="clear_btn">クリア</button>
						</div>
						<input type="hidden" name="custom_wrt_data[top][contents][<?= $index; ?>][columns][<?= $i; ?>][img]" value="<?php if(!empty($content['columns'][$i]['img'])){ echo $content['columns'][$i]['img']; } ?>">
						<div class="img_box square <?php if(empty($content['columns'][$i]['img'])){ echo 'noselect'; } ?>">
							<?php
								if( !empty($content['columns'][$i]['img']) ){
									echo wp_get_attachment_image( $content['columns'][$i]['img'], 'thumb2' );
								}
							?>
						</div>
					</div>
					<p class="mb-1">タイトル</p>
					<input type="text" name="custom_wrt_data[top][contents][<?= $index; ?>][columns][<?= $i; ?>][title]" class="form-control" value="<?= $content['columns'][$i]['title']?? ''; ?>">
					<p class="mb-1">サブタイトル</p>
					<input type="text" name="custom_wrt_data[top][contents][<?= $index; ?>][columns][<?= $i; ?>][subtitle]" class="form-control" value="<?= $content['columns'][$i]['subtitle']?? ''; ?>">
					<p class="mb-1">リンク先</p>
					<input type="text" name="custom_wrt_data[top][contents][<?= $index; ?>][columns][<?= $i; ?>][link]" class="form-control" value="<?= $content['columns'][$i]['link']?? ''; ?>">
				</div>
			</div>
		<?php endfor; ?>
		<div class="col-md-3 add_box d-flex align-items-center">
			<button type="button" class="btn btn-danger btn-sm delete_btn d-none me-2 lh-1"><span class="dashicons dashicons-minus"></span></button>
			<button type="button" class="btn btn-success btn-sm add_btn lh-1" data-limit="8"><span class="dashicons dashicons-plus-alt2"></span></button>
		</div>
	</div>
</div>
