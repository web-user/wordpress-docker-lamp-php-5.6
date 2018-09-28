<?php

global $brad_data;

/* Portfolio post types
--------------------------------------------------------------------------*/


add_action('init', 'portfolio_register');
    
function portfolio_register() {  
   global $brad_data;
   
   
   $args = array(
       "label" 						   => _x("Portfolio Categories","category label","brad-framework"), 
       "singular_label" 			   => _x("Portfolio Category","category_singular_label","brad-framework"), 
       'public'                        => true,
       'hierarchical'                  => true,
       'show_ui'                       => true,
       'show_in_nav_menus'             => false,
       'args'                          => array( 'orderby' => 'term_order' ),
       'rewrite'                       => array(
					    					'slug'         => _x( 'portfolio-category', 'slug', 'brad-framework') ,
					    					'with_front'   => false,
					    					'hierarchical' => true,
					    	            ),
       'query_var'                     => true
      );
     register_taxonomy( 'portfolio_category', 'portfolio', $args );
	 
    //portfolio slug 
     $portfolio_slug = !empty($brad_data['portfolio_rewriteslug']) ? $brad_data['portfolio_rewriteslug'] : null ;
   
	 $labels = array(
        'name' => _x('Portfolio', 'post type general name', "brad-framework"),
        'singular_name' => _x('Portfolio Item', 'post type singular name', "brad-framework"),
        'add_new' => _x('Add New','portfolio item', "brad-framework"),
        'add_new_item' => __('Add New Portfolio Item', "brad-framework"),
        'edit_item' => __('Edit Portfolio Item', "brad-framework"),
        'new_item' => __('New Portfolio Item', "brad-framework"),
        'view_item' => __('View Portfolio Item', "brad-framework"),
        'search_items' => __('Search Portfolio', "brad-framework"),
        'not_found' =>  __('No portfolio items have been added yet', "brad-framework"),
        'not_found_in_trash' => __('Nothing found in Trash', "brad-framework"),
        'parent_item_colon' => ''
      );
     $args = array(  
        'labels' => $labels,  
        'public' => true,  
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'rewrite' => array('slug' => $portfolio_slug,'with_front' => false),
        'supports' => array('title', 'thumbnail'),
        'has_archive' => true,
        'taxonomies' => array('portfolio_category')
       );  
    register_post_type( 'portfolio' , $args );  
}  






add_filter("manage_edit-portfolio_columns", "portfolio_edit_columns");   
  
  
function portfolio_edit_columns($columns){  
        $columns = array(  
            "cb" => "<input type=\"checkbox\" />",
		    "title" => __('Title', 'brad-framework'),
		    "portfolio_thumbnail" => __('Thumbnail', 'brad-framework'),
		    "portfolio_category" => __('Category', 'brad-framework'),
		    "author" => __('Author', 'brad-framework'),
		    "comments" => __('Comments', 'brad-framework'),
		    "date" => __('Date', 'brad-framework'),
        );  
       $columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
        return $columns;  
}  


add_action("manage_posts_custom_column",  "posts_custom_columns" , 10 , 2); 

function posts_custom_columns($column){  
	    global $post;  
		$post_id =  $post->ID ;
	    switch ($column)  
	    {  
	        case "description":  
	            the_excerpt();  
	            break;
				
			case "portfolio_thumbnail":
			$width = (int) 50;
			$height = (int) 50;
			$thumbnail_id = get_post_meta( $post_id , '_thumbnail_id', true );
			
			// Display the featured image in the column view if possible
			if ( $thumbnail_id ) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( !empty( $thumb )  ) {
				echo $thumb;
			} else {
				echo __('None', 'brad-framework');
			}
			break;
			
			case "client_thumbnail":
			$width = (int) 50;
			$height = (int) 50;
			$thumbnail_id = get_post_meta( $post_id , 'brad_client_image', true );
			
			// Display the featured image in the column view if possible
			if ( $thumbnail_id ) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( !empty( $thumb ) ) {
				echo $thumb;
			} else {
				echo __('None', 'brad-framework');
			}
			break;
			
			case "bradslider_thumbnail":
			$width = (int) 50;
			$height = (int)50;
			$thumbnail_id = get_post_meta( $post_id , 'brad_slider_image', true );
			// Display the featured image in the column view if possible
			if ( $thumbnail_id ) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( isset( $thumb ) ) {
				echo $thumb;
			} else {
				echo '<img src="'.get_template_directory_uri().'/framework/images/no-slider-image.jpg" width="50" height="50" />';
			}
			break;
			
			case "bradslider_caption":
			$title = get_post_meta( $post_id , 'brad_slider_title', true );
			$sub_title = get_post_meta( $post_id , 'brad_slider_caption', true );
			if( $title != '' || $sub_title != ''){
			 echo '<h4>'.$title.'</h4><p>'.$sub_title.'</p>';
			}
			else{
				echo __('None','brad-framework');
			}
			break;
			
	
	        case "thumbnail":  
	            the_post_thumbnail('thumbnail');  
	            break;
	        case "portfolio_category":
	          if ( $category_list = get_the_term_list( $post_id , 'portfolio_category', '', ' , ', '' ) ) {
			      echo $category_list;
		       } else {
			      echo __('None', 'brad-framework');
		       }
			   break;
	        case "testimonials-category":
	           if ( $category_list = get_the_term_list( $post_id , 'testimonials-category', '', ' , ', '' ) ) {
			      echo $category_list;
		       } else {
			      echo __('None', 'brad-framework');
		       }
	          break;
			case "bradslider-category":
	           if ( $category_list = get_the_term_list( $post_id , 'bradslider-category', '', ' , ', '' ) ) {
			      echo $category_list;
		       } else {
			      echo __('None', 'brad-framework');
		       }
	          break;  
	        case "clients-category":
	            if ( $category_list = get_the_term_list( $post_id , 'clients-category', '', ' , ', '' ) ) {
			      echo $category_list;
		       } else {
			      echo __('None', 'brad-framework');
		       }
			   break;
	    }  
	}  
	



/* Testimonials Type
---------------------------------------------------------------------*/
	
	add_action('init', 'testimonials_register');  
	  
	function testimonials_register() {  
	
	   //Register Testimonial Category
	   	$args = array(
	    "label" 						=> _x('Testimonial Categories', 'category label', "brad-framework"), 
	    "singular_label" 				=> _x('Testimonial Category', 'category singular label', "brad-framework"), 
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => false,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => false,
	    'query_var'                     => true
	    );
	
	    register_taxonomy( 'testimonials-category', 'testimonials', $args );
	
	    $labels = array(
	        'name' => _x('Testimonials', 'post type general name', "brad-framework"),
	        'singular_name' => _x('Testimonial', 'post type singular name', "brad-framework"),
	        'add_new' => _x('Add New', 'Testimonial', "brad-framework"),
	        'add_new_item' => __('Add New Testimonial', "brad-framework"),
	        'edit_item' => __('Edit Testimonial', "brad-framework"),
	        'new_item' => __('New Testimonial', "brad-framework"),
	        'view_item' => __('View Testimonial', "brad-framework"),
	        'search_items' => __('Search Testimonials', "brad-framework"),
	        'not_found' =>  __('No testimonials have been added yet', "brad-framework"),
	        'not_found_in_trash' => __('Nothing found in Trash', "brad-framework"),
	        'parent_item_colon' => ''
	    );
	
	    $args = array(  
	        'labels' => $labels,  
	        'public' => true,  
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'show_in_nav_menus' => false,
	        'rewrite' => false,
	        'supports' => array('title', 'editor'),
	        'has_archive' => true,
	        'taxonomies' => array('testimonials-category')
	       );  
	  
	    register_post_type( 'testimonials' , $args );  
	}  
	
	add_filter("manage_edit-testimonials_columns", "testimonials_edit_columns");   
	
	function testimonials_edit_columns($columns){  
	        $columns = array(  
	            "cb" => "<input type=\"checkbox\" />",  
	            "title" => __("Testimonial", "brad-framework"),
	            "testimonials-category" => __("Categories", "brad-framework")
	        );  
	  
	        return $columns;  
	}



/* Clients
/*------------------------------------------------------------*/
	      
   
	
	add_action('init', 'clients_register');  
	  
	function clients_register() {  
	
	//Register Clients Category
	$args = array(
		"label" 						=> _x('Client Categories', 'category label', "brad-framework"), 
		"singular_label" 				=> _x('Client Category', 'category singular label', "brad-framework"), 
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => false,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => false,
	    'query_var'                     => true
	);
	
	    register_taxonomy( 'clients-category', 'clients', $args );
	
	
	    $labels = array(
	        'name' => _x('Clients', 'post type general name', "brad-framework"),
	        'singular_name' => _x('Client', 'post type singular name', "brad-framework"),
	        'add_new' => _x('Add New', 'Client', "brad-framework"),
	        'add_new_item' => __('Add New Client', "brad-framework"),
	        'edit_item' => __('Edit Client', "brad-framework"),
	        'new_item' => __('New Client', "brad-framework"),
	        'view_item' => __('View Client', "brad-framework"),
	        'search_items' => __('Search Clients', "brad-framework"),
	        'not_found' =>  __('No clients have been added yet', "brad-framework"),
	        'not_found_in_trash' => __('Nothing found in Trash', "brad-framework"),
	        'parent_item_colon' => ''
	    );
	
	    $args = array(  
	        'labels' => $labels,  
	        'public' => true,  
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'show_in_nav_menus' => false,
	        'rewrite' => false,
	        'supports' => array('title'),
	        'has_archive' => true,
	        'taxonomies' => array('clients-category')
	       );  
	  
	    register_post_type( 'clients' , $args );  
	}  
	
	add_filter("manage_edit-clients_columns", "clients_edit_columns");   
	  
	function clients_edit_columns($columns){  
	        $columns = array(  
	            "cb" => "<input type=\"checkbox\" />",  
	            "client_thumbnail" => __("Client Logo","brad-framework"),
	            "title" => __("Client", "brad-framework"),
	            "clients-category" => __("Categories", "brad-framework")  
	        );  
	  
	        return $columns;  
	} 