<?php

/* File Security Check */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Load Default theme text domain */
load_theme_textdomain( 'brad', get_template_directory() . '/languages' );
load_theme_textdomain( 'brad-framework', get_template_directory() . '/languages' );	
$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
if ( is_readable($locale_file) ) { require_once($locale_file); }  


// Default custom header
add_theme_support( 'custom-header' );

// Default custom backgrounds
add_theme_support( 'custom-background' );


/* Set the content width based on the theme's design and stylesheet. */
if ( ! isset( $content_width ) ) {
	$content_width = 1200; /* pixels */
}
/* Default RSS feed links */
add_theme_support('automatic-feed-links');

/* Register Navigations */
register_nav_menu('main_navigation', 'Main Navigation');
register_nav_menu('top_navigation', 'Top Bar Navigation');
register_nav_menu('footer_navigation', 'Footer Navigation');

/* Theme options */
require_once (get_template_directory().'/framework/options.php');
$brad_data =  get_option('brad_options'); 

include_once(get_template_directory().'/framework/brad_iconfont.php');

/*--------------------------------------------------------------------------------------------------
	All Required Files
--------------------------------------------------------------------------------------------------*/
include_once(get_template_directory().'/framework/custom-posts.php');
include_once(get_template_directory().'/framework/brad_functions.php');
include_once(get_template_directory().'/framework/multiple_sidebars.php');
include_once(get_template_directory().'/framework/brad-megamenu/brad-megamenu.php');
include_once(get_template_directory().'/framework/brad-shortcodes/brad-shortcodes.php');



/* Reqister and eneque styles and scripts */
require_once (get_template_directory().'/framework/scripts.php');
require_once (get_template_directory().'/framework/styles.php');
require_once (get_template_directory().'/framework/custom_css.php');
require_once (get_template_directory().'/framework/custom_js.php');



/* Include Meta Box */
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/framework/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/framework/meta-box' ) );
// Include the meta box script
require_once RWMB_DIR . 'meta-box.php';
include get_template_directory().'/framework/metabox.php';

/* Load Widgets */
include_once(get_template_directory().'/framework/widgets/flickr_widget.php'); 
include_once(get_template_directory().'/framework/widgets/facebook_widget.php');
include_once(get_template_directory().'/framework/widgets/twitter_widget.php');
include_once(get_template_directory().'/framework/widgets/banner_125_widget.php');
include_once(get_template_directory().'/framework/widgets/portfolios_widget.php');
include_once(get_template_directory().'/framework/widgets/recent_posts.php');
include_once(get_template_directory().'/framework/widgets/embed_video.php');	

/* Automatic Plugin Activation */
require_once(get_template_directory().'/framework/plugin-activation.php');

/*-------------------------------------------------------------------------------------------------*/
/* Woocommerce setup
/*-------------------------------------------------------------------------------------------------*/
add_theme_support( 'woocommerce' );
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
require_once(get_template_directory().'/framework/brad_woocommerce.php');


/*--------------------------------------------------------------------------------------------------
	add theme update class
--------------------------------------------------------------------------------------------------*/

// Get user envato license as provided in theme panel
$brad_envato_license_key = trim($brad_data['envato_license_key']);

// If envato license is defined load the auto update class and pass the license to it
if ( !empty($brad_envato_license_key) ) {
	require_once( get_template_directory() .'/framework/wp-updates-theme.php');
	new WPUpdatesThemeUpdater_1012( 'http://wp-updates.com/api/2/theme', basename(get_template_directory()) , $brad_envato_license_key );
}


#-----------------------------------------------------------------#
# Plug Activation Configurations
#-----------------------------------------------------------------#
	
add_action('tgmpa_register', 'brad_register_required_plugins');
	function brad_register_required_plugins() {
			$plugins = array(
		array(
		    'name'     		    => 'Slider Revolution', // The plugin name
		    'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri()  . '/framework/plugins/revslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> false, // If set, overrides default API URL and points to an external URL
		)
		
		,
		
	 array(
			'name'		=> 'oAuth Twitter Feed for Developers',
			'slug'		=> 'oauth-twitter-feed-for-developers',
			'required' 	=> false,
		)	
		
	);
	
	// Change this to your theme text domain, used for internationalising strings
		$theme_text_domain = 'brad-framework';
	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	
	
	$config = array(
			'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
			'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
				'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
				'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
				'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);
	
		tgmpa($plugins, $config);
		
	}


#-----------------------------------------------------------------#
# Custom Images
#-----------------------------------------------------------------#

add_theme_support('post-thumbnails');
if ( function_exists( 'add_image_size' ) ) {
	   add_image_size( 'thumb-large-fullwidth' , 800 , 547 , true );
	   add_image_size( 'thumb-medium-fullwidth', 534 , 364 , true );
	   add_image_size( 'thumb-normal-fullwidth', 400 , 274 , true );
	   add_image_size( 'thumb-large' , 580 , 397 , true );
	   add_image_size( 'thumb-medium', 386 , 264 , true );
	   add_image_size( 'thumb-normal', 290 , 198 , true );
	   add_image_size( 'post-wide', 800 , 450 , true );
	   add_image_size( 'post-fullwidth', 1160 , 640 , true );
	   add_image_size( 'mini', 80 , 80 , true );	
	}
	


global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
	add_action( 'init', 'brad_woocommerce_image_dimensions', 1 );
}
 

// Define Woocommerce image sizes 
function brad_woocommerce_image_dimensions() {
	$catalog = array(
		'width' => '386',	
		'height'	=> '411',	
		'crop'	=> 1 
	);
	 
	$single = array(
		'width' => '696',	
		'height'	=> '727',	
		'crop'	=> 1 
	);
	 
	$thumbnail = array(
		'width' => '100',	
		'height'	=> '100',	
		'crop'	=> 1 
	);
	 
	
	update_option( 'shop_catalog_image_size', $catalog ); // Product category thumbs
	update_option( 'shop_single_image_size', $single ); // Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs
}
	

#-----------------------------------------------------------------#
# Post formats and Widgets
#-----------------------------------------------------------------#

add_theme_support( 'post-formats', array('video','gallery','link','quote') );


/* Register widgetized locations */
if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Blog Sidebar',
		'before_widget' => '<div id="%1$s" class="widget widget_meta %2$s">',
		'after_widget' => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
		'name' => 'Woocommerce Sidebar',
		'before_widget' => '<div id="%1$s" class="widget widget_meta %2$s">',
		'after_widget' => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	));
	
	
	register_sidebar(array(
	   'name' => 'Footer Widgets',
	   'id'   => 'footer-widgets',
		'description'   => __( 'These are widgets for the Footer.','brad-framework' ),
		'before_widget' => '<div id="%1$s" class="widget widget_meta %2$s '.brad_get_class_name($brad_data['footer_columns']).'">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
   	));
}


/*--------------------------------------------------------------------------------------------------
	All the small fixers for theme
--------------------------------------------------------------------------------------------------*/

 
add_filter('the_content', 'brad_content_filter');
add_filter('widget_text', 'brad_content_filter');
 
function brad_content_filter($content) {
 
	// array of custom shortcodes requiring the fix 
	$block = join("|",array("button","gap","pricing_table","pricing_column","pricing_feature","compare_table","compare_feature","iconlist","listitem","checklist","item","dropcap","video","icon","social","social_icon","tooltip","heading","separator","highlighted","columns","one_sixth","one_fifth","one_fourth","one_third","one_half","three_fourths","two_thirds","code"));
 
	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
		
	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
 
	return $rep;
 
}

/* Add permissios to upload font */
add_filter('upload_mimes', 'brad_font_mime_types');
function brad_font_mime_types($mimes)
{
	$mimes['ttf'] = 'font/ttf';
	$mimes['woff'] = 'font/woff';
	$mimes['svg'] = 'font/svg';
	$mimes['eot'] = 'font/eot';

	return $mimes;
}

/* Set the Image qulaity to 100% */
add_filter('jpeg_quality', 'brad_image_quality');
add_filter('wp_editor_set_quality', 'brad_image_quality');
function brad_image_quality($quality) {
    return 100;
}



/* Fix category and Archives span count */
add_filter('get_archives_link', 'brad_fix_category_span');
add_filter('wp_list_categories', 'brad_fix_category_span');
function brad_fix_category_span($links) {
	$get_count = preg_match_all('#\((.*?)\)#', $links, $matches);

	if($matches) {
		$i = 0;
		foreach($matches[0] as $val) {
			$links = str_replace('</a> '.$val, ' '.$val.'</a>', $links);
			$links = str_replace('</a>&nbsp;'.$val, ' '.$val.'</a>', $links);
			$i++;
		}
	}

	return $links;
}

/* Allow shortcodes in widget text */
add_filter('widget_text', 'do_shortcode');


/*--------------------------------------------------------------------------------------------------
	Enable custom Version of visual composer (Commented by Thiago Moreno)
--------------------------------------------------------------------------------------------------*/

if (!class_exists('WPBakeryVisualComposerAbstract')) {
//	$dir = dirname(__FILE__) . '/framework/page-builder/';
//    $vc_as_theme = true;
//	global $composer_settings , $wpVC_setup;
//	$composer_settings = Array(
//		'APP_ROOT'      => $dir . '/js_composer',
//		'WP_ROOT'       => dirname( dirname( dirname( dirname($dir ) ) ) ). '/',
//		'APP_DIR'       => basename( $dir ) . '/js_composer/',
//		'CONFIG'        => $dir . '/js_composer/config/',
//		'ASSETS_DIR'    => 'assets/',
//		'COMPOSER'      => $dir . '/js_composer/composer/',
//		'COMPOSER_LIB'  => $dir . '/js_composer/composer/lib/',
//		'SHORTCODES_LIB'  => $dir . '/js_composer/composer/lib/shortcodes/',
//		'USER_DIR_NAME'  => '', /* Path relative to your current theme, where VC should look for new shortcode templates */
//
//		//for which content types Visual Composer should be enabled by default
//		'default_post_types' => Array('page' )
//	);
//
//	require_once locate_template('/framework/page-builder/js_composer/js_composer.php');
//	$wpVC_setup->init($composer_settings);
//	
}