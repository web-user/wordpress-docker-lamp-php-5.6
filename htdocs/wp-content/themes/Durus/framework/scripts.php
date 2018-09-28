<?php

function brad_scripts_basic() {  
    global $brad_includes;

    if(!is_admin()  && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ):
	 
	 wp_reset_query();
	/* ------------------------------------------------------------------------ */
	/* Register Scripts */
	/* ------------------------------------------------------------------------ */
	wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', '', '1.0', TRUE);
	wp_register_script('prettyPhoto', get_template_directory_uri() . '/js/prettyPhoto.js', 'jquery', '3.1', TRUE);
	wp_register_script('flexslider', get_template_directory_uri() . '/js/flexslider.js', 'jquery', '2.0', TRUE);
	wp_register_script('waypoints', get_template_directory_uri() . '/js/jquery.waypoints.js', 'jquery', '1.5', TRUE);
	wp_register_script('isotope', get_template_directory_uri() . '/js/isotope.js', 'jquery', '1.5', TRUE);
	wp_register_script('infiniteScroll', get_template_directory_uri() . '/js/jquery.infinitescroll.js', 'jquery', '', TRUE);
	wp_register_script('fitvids', get_template_directory_uri() . '/js/fitvids.js', 'jquery', '1.5', TRUE);
	wp_register_script('bxslider', get_template_directory_uri() . '/js/bxslider.js', 'jquery', '1.5', TRUE);
	wp_register_script('caroufred', get_template_directory_uri() . '/js/caroufred.js', 'jquery', '1.0', TRUE);
    wp_register_script('mediaelement', get_template_directory_uri() . '/js/mediaelement-and-player.min.js', 'jquery', '', TRUE);
	wp_register_script('plugins', get_template_directory_uri() . '/js/plugins.js', 'jquery', '1.0', TRUE);
    wp_register_script('gmaps', 'http://maps.google.com/maps/api/js?sensor=false', 'jquery', NULL, TRUE);
	wp_register_script('bradgmaps', get_template_directory_uri() . '/js/gmap.js', 'jquery', NULL, TRUE);
	wp_register_script('main', get_template_directory_uri() . '/js/main.js', 'jquery', '1.0', TRUE);

    /* -----------------------------------------------------------------S------- */
	/* Enqueue Scripts */
	/* ------------------------------------------------------------------------ */
	wp_enqueue_script('jquery',false, array(), false, true);
	wp_enqueue_script('modernizr');
	wp_enqueue_script('flexslider');
	wp_enqueue_script('fitvids');
	wp_enqueue_script('prettyPhoto');
	wp_enqueue_script('plugins');
	wp_enqueue_script('waypoints');
	
	if( is_array($brad_includes)){
		
		if( $brad_includes['load_gmap'] == true ) {
			wp_print_scripts('gmaps');
			wp_enqueue_script('bradgmaps');
			if(!empty($brad_includes["global_mapData"])){
			    wp_localize_script('bradgmaps', 'global_mapData', $brad_includes["global_mapData"]);
		    }
		}
		if( $brad_includes['load_isotope'] == true ) {
			wp_enqueue_script('isotope');
		}
		if( $brad_includes['load_infiniteScroll'] == true ) {
			wp_enqueue_script('infiniteScroll');
		}
		if( $brad_includes['load_caroufred'] == true ){
			wp_enqueue_script('caroufred');
		}
		if( $brad_includes['load_bxslider'] == true ){
			wp_enqueue_script('bxslider');
		}
		if( $brad_includes['load_mediaelement'] == true ){
			wp_enqueue_script('mediaelement');
		}
	}
	
  	wp_enqueue_script('main');
	// add some additional data
    wp_localize_script( 'main', 'main', array(
			'url' => get_template_directory_uri() ,
			'nomoreposts' => __('No more Posts to Load','brad-framework') ,
			'nomoreprojects' => __('No more Projects to Load','brad-framework') ,
			'ajaxurl'	=> admin_url( 'admin-ajax.php' ) ,
			'contactNonce' => wp_create_nonce( 'brad_contact_form' )
		) );
	 //comments
	if ( is_singular() && comments_open()  )
	    wp_enqueue_script('comment-reply');	
		
    endif;
			
  } 
	

 add_action( 'wp_footer' , 'brad_scripts_basic' ); 

function brad_google_analytics() {	
   global $brad_data; 
   echo $brad_data['google_analytics'];
}

add_action( 'wp_head', 'brad_google_analytics' , 100 );

?>