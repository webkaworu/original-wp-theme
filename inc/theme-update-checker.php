<?php

spl_autoload_register(function ($className) {
	if (strpos($className, 'Wrt_Tuc_') === 0) {
		$path = substr($className, strlen('Wrt_Tuc_'));
		$path = str_replace('_', '/', $path);
		$path = get_theme_file_path('inc/theme-update-checker/'.$path.'.php');

		if (file_exists($path)) {
			include $path;
		}
	}
});

require_once get_theme_file_path('inc/license-checker.php');
$license_checker = new LicenseChecker();
$status = $license_checker->validate_status();
if( $status['is_valid'] === true ){
	new Wrt_Tuc_Theme_UpdateChecker(
		$license_checker->get_url('licenses/'.$license_checker->get_stored_license()),
		basename(get_template_directory()),
		basename(get_template_directory())
	);
}
