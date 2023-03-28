<div class="postbox custom_meta_box top_contents_meta">
	<div class="postbox-header">
		<?php if( !empty($content['type']) ): ?>
			<button type="button" class="btn lh-1 handle-collapse-toggle" data-bs-toggle="collapse" data-bs-target="#topContens<?= $index; ?>" aria-expanded="false" aria-controls="topContens<?= $index; ?>">
				<span class="dashicons dashicons-plus-alt2"></span>
			</button>
		<?php endif; ?>
		<h2 class="hndle">コンテンツ <span class="add_title_num"><?= ( $index + 1 ); ?></span></h2>
		<div class="handle-actions hide-if-no-js d-inline-flex align-items-center py-1 pe-2">
			<button type="button" class="handle-order-higher" aria-disabled="false" aria-describedby="postexcerpt-handle-order-higher-description">
				<span class="screen-reader-text">上に移動</span><span class="order-higher-indicator" aria-hidden="true"></span>
			</button>
			<span class="hidden" id="postexcerpt-handle-order-higher-description">抜粋 ボックスを上に移動</span>
			<button type="button" class="handle-order-lower" aria-disabled="false" aria-describedby="postexcerpt-handle-order-lower-description">
				<span class="screen-reader-text">下に移動</span><span class="order-lower-indicator" aria-hidden="true"></span>
			</button>
			<span class="hidden" id="postexcerpt-handle-order-lower-description">抜粋 ボックスを下に移動</span>
			<button type="button" class="btn btn-danger btn-sm ms-2 handle-box-delete">削除</button>
		</div>
	</div>
	<div class="inside">
		<select name="custom_wrt_data[top][contents][<?= $index; ?>][type]" class="form-control contents_select" style="max-width:360px;">
			<option value=""></option>
			<?php
				$type = ['postlist' => '投稿を表示', 'introduction' => '紹介コンテンツ', 'columns' => 'カラムコンテンツ', 'youtube' => 'Youtubeを表示'];
				foreach( $type as $name => $view ){
					$selected = ( !empty($content['type']) && $content['type'] == $name )? ' selected': '';
					echo '<option value="'.$name.'"'.$selected.'>'.$view.'</option>';
				}
			?>
		</select>
		<div class="contents_select_box <?= ( !empty($content['type']) )? 'collapse': ''; ?>" id="topContens<?= $index; ?>">
			<?php
				if( !empty($content['type']) ){
					require get_theme_file_path('admin/field/'.$content['type'].'.php');
				}
			?>
		</div>
	</div>
</div>
