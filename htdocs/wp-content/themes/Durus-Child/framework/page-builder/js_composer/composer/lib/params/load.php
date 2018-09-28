<?php
/**
 * Loads attributes hooks.
 */
$dir = dirname(__FILE__);

require_once $dir.'/textarea_html/textarea_html.php';
require_once $dir.'/colorpicker/colorpicker.php';
require_once $dir.'/options/options.php';
require_once $dir.'/icon/icon.php';
require_once $dir.'/taxonomy/taxonomy.php';
global $vc_params_list;
$vc_params_list = array('textarea_html', 'colorpicker', 'options','icon','taxonomy');
