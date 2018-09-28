<?php 

function brad_styles_basic()  
{  
	global $brad_data , $woocommerce;
	/* ------------------------------------------------------------------------ */
	/* Register Stylesheets */
	/* ------------------------------------------------------------------------ */
	wp_dequeue_style('style-css');
    wp_deregister_style( 'style-css' );
	wp_register_style( 'layout', get_template_directory_uri() . '/css/layout.css', array(), '1', 'all' );
	wp_register_style( 'main', get_template_directory_uri() . '/css/main.css', array(), '1', 'all' );
	wp_register_style( 'shortcodes', get_template_directory_uri() . '/css/shortcodes.css', array(), '1', 'all' );
	wp_register_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css', array(), '1', 'all' );
	wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', array(), '1', 'all' );
	wp_register_style( 'mediaelement', get_template_directory_uri() . '/css/mediaelementplayer.css', array(), '1', 'all' );
	wp_register_style( 'durus-style',  get_stylesheet_directory_uri() . '/style.css', array(), NULL, 'all');
	wp_deregister_style( 'woocommerce');
	wp_register_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce.css', array(), '1', 'all' );
	wp_register_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array(), '1', 'all' );
	
	
	/* ------------------------------------------------------------------------ */
	/* Enqueue Stylesheets */
	/* ------------------------------------------------------------------------ */

	wp_enqueue_style( 'layout');
	wp_enqueue_style( 'main');
	wp_enqueue_style( 'shortcodes');
	wp_enqueue_style( 'flexslider');
	wp_enqueue_style( 'mediaelement');
	wp_enqueue_style( 'prettyPhoto' ); 
	if($woocommerce){
		wp_enqueue_style( 'woocommerce' ); 
	}
    wp_enqueue_style( 'durus-style' ); 
    wp_enqueue_style( 'responsive' ); 
	
}  

add_action( 'wp_enqueue_scripts', 'brad_styles_basic' ); 


?>