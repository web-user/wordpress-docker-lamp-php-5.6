<?php

/* Overwritting Custom Visual Composer (Brad Page Builder) */

if (!class_exists('WPBakeryVisualComposerAbstract')) {
	$dir = dirname(__FILE__) . '/framework/page-builder/';
    $vc_as_theme = true;
	global $composer_settings , $wpVC_setup;
	$composer_settings = Array(
		'APP_ROOT'      => $dir . '/js_composer',
		'WP_ROOT'       => dirname( dirname( dirname( dirname($dir ) ) ) ). '/',
		'APP_DIR'       => basename( $dir ) . '/js_composer/',
		'CONFIG'        => $dir . '/js_composer/config/',
		'ASSETS_DIR'    => 'assets/',
		'COMPOSER'      => $dir . '/js_composer/composer/',
		'COMPOSER_LIB'  => $dir . '/js_composer/composer/lib/',
		'SHORTCODES_LIB'  => $dir . '/js_composer/composer/lib/shortcodes/',
		'USER_DIR_NAME'  => '', /* Path relative to your current theme, where VC should look for new shortcode templates */

		//for which content types Visual Composer should be enabled by default
		'default_post_types' => Array('page' )
	);

	require_once locate_template('/framework/page-builder/js_composer/js_composer.php');
	$wpVC_setup->init($composer_settings);
	
}

?>