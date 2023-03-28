<?php
 $show_front_page = get_post_meta($post->ID, 'show_front_page', true);
?>
<input type="hidden" name="custom_data_flg" value="1">
<input type="hidden" name="custom_data[show_front_page]" value="">
<ul>
  <li><label><input type="checkbox" name="custom_data[show_front_page]" value="1"<?php if( !empty($show_front_page) ){ echo ' checked'; } ?>>トップページに表示する</label></li>
</ul>
