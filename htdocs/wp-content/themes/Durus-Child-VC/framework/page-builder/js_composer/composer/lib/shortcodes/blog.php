<?php

/* Blog List
-----------------------------------------------------------------*/

class WPBakeryShortCode_VC_Blog extends WPBakeryShortCode {
	
 protected function content( $atts, $content = null, $helper = false ) {
	 $output = '';
	 
     extract( shortcode_atts( array(
            'category'        =>  '',
			'order'           => 'date',
			'orderby'         => 'DESC',
            'blog_type'       =>  'grid',
            'bg_style'        =>  '',
			'columns'         => '3' ,
			'show_author'     => 1 ,
			'show_date'       => 1,
			'show_categories' => 1 ,
			'show_lightbox'   => 1 ,
			//'show_excerpt'    => '1' ,
			'excerpt_length'  => '20' ,
			'max_items'       => '8',
            'pagination'      => 'default',
		  	//'button_style' => '' ,
		    //'lm_title' => __('Load More','brad-framework'),
		    //'nomore_posts_txt' => __('No More Projects','brad-framework'),
		    'icon' => '',
        ), $atts ) ); 
	
	global $post  , $brad_data ;
	
	$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
	if(!$page) $page = 1;
	
	$args = array(
	    'post_type' => 'post',
	    'post_status' => 'publish',
	    'posts_per_page' => (int)$max_items,
		'paged'          => $page,
		'order'          => $order,
		'orderby'        => $orderby
         );
		 
	 if(!empty($category)){
			$cat_id = explode(',', $category );
			$args['tax_query'] = array(
				array(
				 'taxonomy' => 'category',
				 'field' => 'id',
				 'terms' => $cat_id
				     )
			     );
		      }
      
	  query_posts($args);	
	  
	  if(  have_posts() ) :
	  $brad_data['grid_blog_columns'] = $columns;
	  $brad_data['grid_blog_style'] = $bg_style;
	  $brad_data['check_blog_categories'] = $show_categories ;
	  $brad_data['check_author'] = $show_author;
	  $brad_data['check_blog_date'] = $show_date;
	  $brad_data['text_excerptlength'] = $excerpt_length;
	  $brad_data['blog_pagination'] = $pagination;
	  $brad_data['blog_lightbox'] = $show_lightbox;
	  
      ob_start();
	  get_template_part( 'framework/templates/blog/posts/posts', $blog_type );
	  $output .= ob_get_clean();
	  endif;
	  wp_reset_query();
      return $output;	
   }
}