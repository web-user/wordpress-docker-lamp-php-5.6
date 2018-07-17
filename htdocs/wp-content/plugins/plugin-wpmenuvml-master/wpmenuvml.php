<?php
/*
		Plugin Name: Wpmenuvml
		Plugin URI: https://github.com/web-user/plugin-wpmenuvml.git
		Tags: jquery, flyout, mega, menu, vertical,navigation, widget, background-color
		Description: Creates a widget, which allows you to add vertical menus to your side columns using any Wordpress custom menu.
		Author: 
		Version: 1.0
		Author URI: 
*/

global $registered_skins;

class wpmenu_vml {


	function wpmenu_vml(){
		global $registered_skins;
	
		if(!is_admin()){
			// Header styles
			add_action( 'wp_head', array('wpmenu_vml', 'header') );
			
		}
		add_action( 'wp_footer', array('wpmenu_vml', 'footer') );
		
		$registered_skins = array();
	}

	function header(){
		echo "\n\t<link rel=\"stylesheet\" type=\"text/css\" href=\"".wpmenu_vml::get_plugin_directory()."/css/wpmenuvmlmenu.css\" media=\"screen\" />";
		
		// Scripts
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jqueryhoverintent', wpmenu_vml::get_plugin_directory() . '/js/jquery.hoverIntent.minified.js', array('jquery') );
			wp_enqueue_script( 'custom' );
			wp_enqueue_script( 'custom', wpmenu_vml::get_plugin_directory() . '/js/custom.js', array('jquery') );
			wp_enqueue_script( 'wpmenuvml', wpmenu_vml::get_plugin_directory() . '/js/jquery.wpmenuvml.1.3.js', array('jquery') );
			
	}
	
	function footer(){
		//echo "\n\t";
	}
	
	function options(){}

	function get_plugin_directory(){
		return WP_PLUGIN_URL . '/wpmenuvml';	
	}

};

// Include the widget
include_once('wpmenuvml_widget.php');

// Initialize the plugin.
$wpmenuvmlmenu = new wpmenu_vml();



// Register the widget
add_action('widgets_init', create_function('', 'return register_widget("wpmenuvml");'));

