<?php

/* Portfolio
--------------------------------------------------*/

class WPBakeryShortCode_VC_Portfolio_Carousel extends WPBakeryShortCode {
	
 protected function content ( $atts , $content = null , $helper = false){
   global $post , $brad_includes ;
   
   $output = '';
   
   extract(shortcode_atts(array(
    'category' => '' ,
	'columns' => 2 , 
	'padding' => 'default' ,   
	'fullwidth' => 'no' , 
	'portfolio_style' => 'style1' ,  
	'overlay_style' => 'style1' ,
	'max_items' => 8 ,
	'disable_lb_icon' => 'no' ,
	'disable_li_icon' => 'no' , 
	'disable_li_title' => 'no',
	'navigation'  => 'yes' ,
	'img_size' => '',
	'custom_img_size' => '' ,
	'orderby' => 'date',
	'order'   => 'DESC',
	'autoplay' => 'no' , 
	'show_categories' => 'no'),$atts));

   $args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => (int)$max_items,
		'order'          =>  $order,
		'orderby'        => $orderby ,
		'post_status'    => 'publish'
    );

   // Narrow by categories
    if ( $category != '' ) {
    $category_query = explode(",", $category);
    $args['tax_query'] = array(
			array(
				'taxonomy' => 'portfolio_category',
				'field' => 'id',
				'terms' => $category_query
				 )
			  );
	}
	
   $portfolios = new WP_Query( $args );
   
   // check if portfolios  exists
    if( $portfolios->have_posts() ) :
	$brad_includes['load_caroufred'] = true;
    $portfolio_style = ($portfolio_style == 'style1') ? 'style2' : 'style3';

    $output .= '<div class="carousel-container">';
	if( $navigation == 'yes') :
	$output .=  '<a class="carousel-next" href="#"></a><a class="carousel-prev" href="#"></a>';
	endif;
	$output .= '<div class="carouel-outer clearfix"><div class="carousel-wrapper carousel-padding-'.$padding.'">
				<div class="row carousel-items portfolio-items portfolio-'.$portfolio_style.' overlay-'.$overlay_style.' element-padding-'.$padding.' columns-'.$columns.'" data-columns="'.$columns.'" data-fullwidth="'.$fullwidth.'" data-autoplay="'.$autoplay.'">';
    
	//Build Default argument for portfolio loop
	$args = array(
	       'portfolio_style' => $portfolio_style ,
		   'class'  => 'span' ,
		   'img_size' => ($img_size == 'custom' && $custom_img_size != '' ) ? trim($custom_img_size) : brad_get_img_size( $columns , $fullwidth) ,
		   'disable_lb_icon' => $disable_lb_icon ,
		   'disable_li_icon' => $disable_li_icon,
		   'disable_li_title' => $disable_li_title ,
		   'show_categories' => $show_categories ,
		   'overlay_style' => $overlay_style
		   );
		   
	while ( $portfolios -> have_posts() ) : $portfolios ->the_post();
	    //if portfolio has featured image or additional images
	    $output .= brad_portfolio_loop_style1( $portfolios , $args);
    endwhile;	

    $output .= '</div></div></div></div>';
    endif;
	wp_reset_query();
    return $output;  
  }   
}
