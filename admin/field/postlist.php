<div class="form-group d-sm-flex">
	<label>投稿タイプ</label>
	<select name="custom_wrt_data[top][contents][<?= $index; ?>][post_type]" class="form-control">
		<?php
			$obj = get_post_type_object( 'post' );
			$post_name = $obj->label;
			if( !empty($option['post']['default']['label']) ){
				$post_name = $option['post']['default']['label'];
			}
			$selected = ( !empty($content['post_type']) && $content['post_type'] == 'post' )? ' selected': '';
			echo '<option value="post"'.$selected.'>'.$post_name.'</option>';
			$customs = $option['post']['custom'];
			if( !empty($customs) ){
				$i = 1;
				foreach( $customs as $key => $custom ){
					if( empty($custom['label']) || empty($custom['slug']) ){
						continue;
					}
					$selected = ( !empty($content['post_type']) && $content['post_type'] == 'custom_post_'.$i )? ' selected': '';
					echo '<option value="custom_post_'.$i.'"'.$selected.'>'.$custom['label'].'</option>';
					$i++;
				}
			}
		?>
	</select>
</div>
<div class="form-group d-sm-flex">
	<label>タイトル</label>
	<input type="text" name="custom_wrt_data[top][contents][<?= $index; ?>][title]" class="form-control" value="<?php if(!empty($content['title'])){ echo $content['title']; } ?>">
</div>
<div class="form-group d-sm-flex">
	<label>サブタイトル</label>
	<input type="text" name="custom_wrt_data[top][contents][<?= $index; ?>][subtitle]" class="form-control" value="<?php if(!empty($content['subtitle'])){ echo $content['subtitle']; } ?>">
</div>
<div class="form-group d-sm-flex">
	<label>表示する最大投稿数</label>
	<div class="form-inline">
		<input type="number" name="custom_wrt_data[top][contents][<?= $index; ?>][pages]" class="form-control" value="<?= $content['pages']?? 3; ?>" min="1" pattern="^¥d+$">
	</div>
</div>
<div class="form-group d-sm-flex">
	<label>一覧の表示</label>
	<input type="hidden" name="custom_wrt_data[top][contents][<?= $index; ?>][archive]" value="list">
	<div class="d-flex">
		<div class="form-check">
			<label class="form-check-label font-weight-bold d-flex align-items-center flex-wrap">
				<input type="radio" class="form-check-input" name="custom_wrt_data[top][contents][<?= $index; ?>][archive]" value="list"<?php if( empty($content['archive']) || !in_array($content['archive'], ['article', 'column']) ){ echo ' checked'; } ?>> リスト
				<span class="d-block mt-2 w-100">
					<img src="<?= get_template_directory_uri(); ?>/src/img/admin/icon-list.jpg" alt="" class="img-fluid">
				</span>
			</label>
		</div>
		<div class="form-check ms-4">
			<label class="form-check-label font-weight-bold d-flex align-items-center flex-wrap">
				<input type="radio" class="form-check-input" name="custom_wrt_data[top][contents][<?= $index; ?>][archive]" value="article"<?php if( isset($content['archive']) && $content['archive'] === 'article' ){ echo ' checked'; } ?>> アーティクル
				<span class="d-block mt-2 w-100">
					<img src="<?= get_template_directory_uri(); ?>/src/img/admin/icon-article.jpg" alt="" class="img-fluid">
				</span>
			</label>
		</div>
		<div class="form-check ms-4">
			<label class="form-check-label font-weight-bold d-flex align-items-center flex-wrap">
				<input type="radio" class="form-check-input" name="custom_wrt_data[top][contents][<?= $index; ?>][archive]" value="column"<?php if( isset($content['archive']) && $content['archive'] === 'column' ){ echo ' checked'; } ?>> カラム
				<span class="d-block mt-2 w-100">
					<img src="<?= get_template_directory_uri(); ?>/src/img/admin/icon-column.jpg" alt="" class="img-fluid">
				</span>
			</label>
		</div>
		<div class="form-check ms-4">
			<label class="form-check-label font-weight-bold d-flex align-items-center flex-wrap">
				<input type="radio" class="form-check-input" name="custom_wrt_data[top][contents][<?= $index; ?>][archive]" value="slider"<?php if( isset($content['archive']) && $content['archive'] === 'slider' ){ echo ' checked'; } ?>> スライダー
				<span class="d-block mt-2 w-100">
					<img src="<?= get_template_directory_uri(); ?>/src/img/admin/icon-slider.jpg" alt="" class="img-fluid">
				</span>
			</label>
		</div>
	</div>
</div>
