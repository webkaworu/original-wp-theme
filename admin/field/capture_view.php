<?php
	$show_capture_single = get_post_meta($post->ID, 'show_capture_single', true);
?>
<input type="hidden" name="custom_data_flg" value="1">
<input type="hidden" name="custom_data[show_capture_single]" value="">
<ul>
  <li><label><input type="checkbox" name="custom_data[show_capture_single]" value="1"<?php if( !empty($show_capture_single) ){ echo ' checked'; } ?>>詳細ページに表示する</label></li>
</ul>
