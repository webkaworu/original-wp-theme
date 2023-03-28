<div class="form-group d-sm-flex">
	<label>タイトル</label>
	<input type="text" name="custom_wrt_data[top][contents][<?= $index; ?>][title]" class="form-control" value="<?php if(!empty($content['title'])){ echo $content['title']; } ?>">
</div>
<div class="form-group d-sm-flex">
	<label>サブタイトル</label>
	<input type="text" name="custom_wrt_data[top][contents][<?= $index; ?>][subtitle]" class="form-control" value="<?php if(!empty($content['subtitle'])){ echo $content['subtitle']; } ?>">
</div>
<div class="form-group d-sm-flex">
	<label>紹介文</label>
	<textarea name="custom_wrt_data[top][contents][<?= $index; ?>][text]" class="form-control" rows="10"><?php if(!empty($content['text'])){ echo $content['text']; } ?></textarea>
</div>
<div class="form-group d-sm-flex">
	<label for="youtube">YouTube URL</label>
	<div class="w-100">
		<p>YouTubeのURLを入力してください。</p>
		<input type="url" name="custom_wrt_data[top][contents][<?= $index; ?>][youtube]" class="form-control" value="<?php if(!empty($content['youtube'])){ echo $content['youtube']; } ?>" placeholder="例：https://www.youtube.com/watch?v=××××××">
	</div>
</div>
<div class="form-group d-sm-flex">
	<label for="youtube">YouTube channel</label>
	<div class="w-100">
		<p>YouTubeチャンネルへのリンクを設置したい場合にURLを入力してください。</p>
		<input type="url" name="custom_wrt_data[top][contents][<?= $index; ?>][account]" class="form-control" value="<?php if(!empty($content['account'])){ echo $content['account']; } ?>" placeholder="例：https://www.youtube.com/channel/アカウント">
	</div>
</div>
