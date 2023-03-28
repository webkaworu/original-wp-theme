<?php

// ユーザーが必要な権限を持つか確認する必要がある
if(!current_user_can('manage_categories'))
{
	wp_die( __('このページにアクセスする権限がありません。') );
}

$saved = '';
$wrt_license_key = get_option( 'wrt_license_key', '' );
require_once get_theme_file_path('inc/license-checker.php');
$license_checker = new LicenseChecker();

if( empty($wrt_license_key) ){
	$message = '<p class="description">ライセンスキーを入力してください。</p>';
}else{
	$status = $license_checker->validate_status($wrt_license_key);
	if( $status['is_valid'] === true ){
		$message = '<p class="description text-success">ライセンス認証に成功しました。</p>';
	}else{
		$message = '<p class="description text-danger">'.$status['error'].'</p>';
	}
}

if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
	if( empty($_POST['license_key']) ){
		delete_option('wrt_license_key');
		if( !empty($wrt_license_key) ){
			$license_checker->deactivate($wrt_license_key);
		}
		$message = '<p class="description">ライセンスキーを入力してください。</p>';
	}else{
		if( $wrt_license_key != $_POST['license_key'] ){
			update_option( 'wrt_license_key', $_POST['license_key'] );
			$license_checker->deactivate($wrt_license_key);
			$status = $license_checker->validate_status($_POST['license_key']);
			if( $status['is_valid'] === true ){
				$license_checker->activate($_POST['license_key']);
				$message = '<p class="description text-success">ライセンス認証に成功しました。</p>';
			}else{
				$message = '<p class="description text-danger">'.$status['error'].'</p>';
			}
		}
		$saved = true;
	}
	$wrt_license_key = $_POST['license_key'];
}

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
	<h2>ライセンス認証</h2>
	<?php if($saved === true): ?>
		<div class="updated notice notice-success is-dismissible inline">
			<p>ライセンスを更新しました。</p>
		</div>
	<?php elseif($saved === false): ?>
		<div class="error notice notice-error is-dismissible inline">
			<p><?= $err_msg; ?></p>
		</div>
	<?php endif; ?>
	<form action="" method="post" novalidate="novalidate">
		<input type="hidden" name="<?= $hidden_field_name; ?>" value="Y">
		<table class="form-table" role="presentation">
			<tr>
				<th scope="row">
					<label for="license_key">ライセンスキー</label>
				</th>
				<td>
					<input type="text" name="license_key" class="regular-text" id="license_key" value="<?= $wrt_license_key; ?>">
					<?= $message; ?>
				</td>
			</tr>
		</table>
		<?php if( is_multisite() ): ?>
			<p class="fw-bold text-danger">※マルチサイトでご利用の場合は正常に更新通知がこない場合がございます。<br>最新のテーマをダウンロードして手動で更新していただく必要がございます。</p>
		<?php endif; ?>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="変更を保存"></p>
	</form>
</div>
