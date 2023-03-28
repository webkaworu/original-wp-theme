<div class="postbox custom_meta_box">
	<div class="postbox-header">
		<h2 class="hndle">タイトルの設定</h2>
	</div>
	<div class="inside">
		<div class="form-group d-sm-flex">
			<label>タイトル</label>
			<input type="text" name="custom_wrt_data[404][title]" class="form-control" value="<?= (!empty($option['404']['title']))? $option['404']['title']: '404 NOT FOUND'; ?>">
		</div>
		<div class="form-group d-sm-flex">
			<label>サブタイトル</label>
			<input type="text" name="custom_wrt_data[404][subtitle]" class="form-control" value="<?= (!empty($option['404']['subtitle']))? $option['404']['subtitle']: 'ページがみつかりません'; ?>">
		</div>
	</div>
</div>
