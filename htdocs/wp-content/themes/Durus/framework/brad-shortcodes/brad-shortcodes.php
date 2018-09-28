<?php
/*
Plugin Name: Brad Shortcodes
Plugin URI: http://themeforest.net/user/bradweb
Description: Shortcode Generator Plugin For Bradweb Themes
Version: 1.0
Author: bradweb
Author URI: http://themeforest.net/user/bradweb
*/

class bradShortcodes {

    function __construct()
    {
    	require_once( get_template_directory() .'/framework/brad-shortcodes/shortcodes.php' );
    	define('BRAD_TINYMCE_URI', get_template_directory_uri() .'/framework/brad-shortcodes/tinymce');
		define('BRAD_TINYMCE_DIR', get_template_directory() .'/framework/brad-shortcodes/tinymce');

        add_action('init', array( &$this, 'init' ));
		add_action('admin_print_scripts', array( &$this, 'brad_quicktags' ));
        add_action('admin_init', array(&$this, 'admin_init'));
	}
	
	function init(){
		/*
		if( ! is_admin() ){
		wp_enqueue_style( 'shortcodes', plugin_dir_url( __FILE__ ).'shortcodes.css', array(), '1', 'all' );
		}
		*/
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
	
		if ( get_user_option('rich_editing') == 'true' )
		{
			add_filter( 'mce_external_plugins', array( &$this, 'brad_add_rich_plugins' ) );
			add_filter( 'mce_buttons', array( &$this, 'brad_register_rich_buttons' ) );
		}
		
	}
	 /**
	 * Enqueue Scripts and Styles
	 *
	 * @return	void
	 */
	function admin_init()
	{
		$brad_data;
		
		// css
		wp_enqueue_style( 'brad-popup', BRAD_TINYMCE_URI . '/css/popup.css', false, '1.0', 'all' );
		wp_enqueue_style( 'icons-css', get_template_directory_uri().'/css/icons.css', false, '1.0', 'all' );
		wp_enqueue_style( 'ss-icons-css', get_template_directory_uri().'/css/ss-icons.css', false, '1.0', 'all' );
		wp_enqueue_style( 'icon-picker', get_template_directory_uri().'/framework/css/icon-picker.css', false, '1.0', 'all' );
		
		if(!empty($brad_data['custom_iconfont']['name'])){
		    wp_enqueue_style( $brad_data['custom_iconfont']['name'] , $brad_data['custom_iconfont']['css-url'] , false, null, '' );
		}
		
		wp_enqueue_style( 'wp-color-picker' );

		// js
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-livequery', BRAD_TINYMCE_URI . '/js/jquery.livequery.js', false, '1.1.1', false );
		wp_enqueue_script( 'jquery-appendo', BRAD_TINYMCE_URI . '/js/jquery.appendo.js', false, '1.0', false );
		wp_enqueue_script( 'base64', BRAD_TINYMCE_URI . '/js/base64.js', false, '1.0', false );
    	wp_enqueue_script( 'wp-color-picker' );

		wp_enqueue_script( 'brad-popup', BRAD_TINYMCE_URI . '/js/popup.js', false, '1.0', false );

		
	}
	
	

	// --------------------------------------------------------------------------
	
	/**
	 * Defins TinyMCE rich editor js plugin
	 *
	 * @return	void
	 */
	function brad_add_rich_plugins( $plugin_array )
	{
		$plugin_array['bradShortcodes'] = BRAD_TINYMCE_URI . '/plugin.js';
		return $plugin_array;
	}
	
	// --------------------------------------------------------------------------
	
	/**
	 * Adds TinyMCE rich editor buttons
	 *
	 * @return	void
	 */
	function brad_register_rich_buttons( $buttons )
	{
		array_push( $buttons, "|", 'brad_button' );
		return $buttons;
	}
	
	// --------------------------------------------------------------------------
	
	/**
	 * Registers TinyMCE HTML editor quicktags buttons
	 *
	 * @return	void
	 */
	function brad_quicktags() {
		// wp_enqueue_script( 'brad_quicktags', BRAD_TINYMCE_URI . '/plugins/wizylabs_quicktags.js', array('quicktags') );
	}
	

}

// Intialiaze Shortcodes

new bradShortcodes();

?>
