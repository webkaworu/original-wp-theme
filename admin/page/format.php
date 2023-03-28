<?php

// ユーザーが必要な権限を持つか確認する必要がある
if(!current_user_can('manage_categories'))
{
	wp_die( __('このページにアクセスする権限がありません。') );
}

$option = get_option( 'custom_wrt_data', array() );
$saved = false;
if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
	$custom_wrt_data = $_POST['custom_wrt_data'];
	$column_names = ['setting', 'logo', 'post', 'top', '404'];
	foreach( $column_names as $column_name ){
		if( isset($custom_wrt_data[$column_name]) ){
			$option[$column_name] = $custom_wrt_data[$column_name];

			// only free or simple
			if( $column_name == 'post' ){
				$option[$column_name]['default']['label'] = 'お知らせ';
				$option[$column_name]['default']['slug'] = 'news';
				if( count($option[$column_name]['custom']) > 4 ){
					array_splice($option[$column_name]['custom'], 4);
				}
			}
			// top contents limit
			if( $column_name == 'top' ){
				if( count($option[$column_name]['contents']) > 8 ){
					array_splice($option[$column_name]['contents'], 8);
				}
				// column limit
				foreach( $option[$column_name]['contents'] as $index => $contents ){
					if( $contents['type'] === 'columns' ){
						if( count($contents['columns']) > 8 ){
							array_splice($option[$column_name]['contents'][$index]['columns'], 8);
						}
					}
				}
			}
			update_option( 'custom_wrt_data', $option, true );
			if( $column_name == 'post' ){
				flush_rewrite_rules();
			}
			$saved = true;
		}
	}
}
?>

<div class="wrap">
	<h1 class="wp-heading-inline"><?= get_admin_page_title(); ?></h1>
	<hr class="wp-header-end">
	<?php if($saved): ?>
		<div class="updated notice notice-success is-dismissible inline">
			<p><?= get_admin_page_title(); ?>を更新しました。</p>
		</div>
	<?php endif; ?>
	<form name="post" action="" method="post" id="theme_settings_form">
		<input type="hidden" name="<?= $hidden_field_name; ?>" value="Y" />
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<div id="postbox-container-1" class="postbox-container postbox-side-container">
					<div id="side-sortables" class="meta-box-sortables">
						<div class="save_box">
							<?php if( $_GET['page'] === 'custom_top_page' ): ?>
								<button type="button" class="button me-3" data-bs-toggle="modal" data-bs-target="#topContentsPreview">プレビュー</button>
							<?php endif; ?>
							<input name="save" type="submit" class="button button-primary button-large" id="publish" value="保存する">
						</div>
					</div>
				</div>
				<div id="postbox-container-2" class="postbox-container">
					<div class="meta-box-sortables">

						<?php do_action('custom_field_contents', $opt_name, $option); ?>

					</div>
				</div>
			</div>
			<br class="clear" />
		</div>
		<div class="footer_save_box">
			<input name="save" type="submit" class="button button-primary button-large" value="保存する">
		</div>
	</form>
</div>

<div class="modal fade" id="topContentsPreview">
	<div class="modal-dialog modal-fullscreen">
		<div class="modal-content">
			<div class="modal-header bg-dark">
				<h2 class="modal-title text-white mt-0">プレビュー画面</h2>
				<button type="button" class="btn lh-1 text-white" data-bs-dismiss="modal"><span class="dashicons dashicons-no-alt"></span></button>
			</div>
			<div class="modal-body">
				<div class="spinner-border text-info position-absolute top-0 start-0 bottom-0 end-0 m-auto"></div>
			</div>
		</div>
	</div>
</div>
