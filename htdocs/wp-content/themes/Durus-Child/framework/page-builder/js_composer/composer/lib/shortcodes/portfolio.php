<?php

/* Portfolio
--------------------------------------------------*/

class WPBakeryShortCode_VC_Portfolio extends WPBakeryShortCode {
	
 protected function content ( $atts , $content = null , $helper = false){
   
   //global Variables
   global $post , $brad_includes ;
   
   //Portfolio Id
   static $portfolio_id = 1 ;
   
   //Output Buffer
   $output =  $style = '';
   extract(shortcode_atts(array(
        'categories' => '' ,
	    'columns' => 2 , 
	    'portfolio_style' => 'style1' ,  
		'overlay_style' => 'style1' ,
	    'padding' => '' ,  
	    'sortable' => 'no' , 
		//'sortable_style' => 'style1' , 
		'sortable_align' => '' ,
		'sortable_label' => 'no',
		//'sortable_color_scheme' => '',
		//'sortable_container' => '' ,
		//'sortable_bg_color' => '' ,
	    'fullwidth' => 'no' , 
	    'disable_lb_icon' => 'no' ,
		'disable_li_icon' => 'no' , 
		'disable_li_title' => 'no',
	    'css_animation' => '',
	    'css_animation_delay' => '0', 
	    'max_items' => 8 , 
	    'orderby' => 'date',
	    'order' => 'DESC',
	    'pagination' => 'default', 
		'img_size' => '' ,
		'custom_img_size' => '' ,
		'button_style' => '' ,
		'lm_title' => __('Load More','brad-framework'),
		//'nomore_posts_txt' => __('No More Projects','brad-framework'),
		'icon' => '',
	    'show_categories' => 'no',
	    'el_class' => ''
	         ),$atts));
	 

   //Change style only on portfolio style1
   $style = ( $portfolio_style == 'style1' ) ?  'style2' : '' ;
   $el_class = $this->getExtraClass($el_class);
   $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'general-items '.$style.' portfolio-items filterable-items portfolio-'.$portfolio_style.' overlay-'.$overlay_style.' columns-'.$columns.' element-padding-'.$padding.' '.$el_class, $this->settings['base']);
   $css_class .= $this->getCSSAnimation($css_animation);
	
	$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
	if(!$page) $page = 1;
		 
	$query_args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => (int)$max_items,
		'paged'          => $page,
		'order'          => $order,
		'orderby'        => $orderby,
		'post_status'    => 'publish'
		
    );
	
	// Narrow by categories
    if ( $categories != '' ) {
    $category_query = explode(",", $categories);
    $query_args['tax_query'] = array(
			array(
				'taxonomy' => 'portfolio_category',
				'field' => 'id',
				'terms' => $category_query
				 )
			  );
	}
	
    $portfolios = new WP_Query( $query_args );
	//check if already ready a infinite scroll post or portfolio in this page 
	
	if( $brad_includes['load_infiniteScroll'] == true && ( $pagination == 'if_scroll' || $pagination == 'loadmore' )) {
	   $output .= '<p>'. __('Sorry You cannot create more than 1 infinite scroll or Load More Posts ( Portfolios ) per page . Please change this in page builder ','brad') .'</p>';
	}
	
	else {
		
    // check if portfolios  exists
    if( $portfolios -> have_posts() ) :
  
	   
	 // Show Sortable Container If enabled by default
	   if($sortable == 'yes') :
	       $terms = array();
	        if ( $categories != '' ) {
		        foreach ( explode( ',', $categories ) as $term_id ) {
			    $terms[] = get_term_by( 'id', $term_id , 'portfolio_category' );
		    }
	        } else {
	           $terms = get_terms('portfolio_category','hide_empty=1');
		    }
	        if($terms):
	           $output .=  '<div class="portfolio-tabs  portfolio-tabs-align-'.$sortable_align.' clearfix"><ul class="clearfix">';
			   if( $sortable_label == 'yes') : 
			       $output .= '<li class="sort-label">'.__("Sort Portfolios :","brad-framework").'</li>';
			   endif;
			   $output .= '<li class="sort-item active"><a data-filter="*" href="#">'. __('All', 'brad') .'</a></li>';
	           foreach($terms as $term){
			       $output .=  '<li class="sort-item"><a data-filter=".'.$term->slug.'" href="#">'.$term->name.'</a></li>';
			    }
	           $output .= ' </ul></div>';
	        endif;
	    endif;

		$ex_class = ($pagination == 'ifscroll' || $pagination == 'loadmore' ) ? 'posts-with-infinite' : '' ;
		
		// Portfolio output starts here..
	    $output .= '<div id="portfolio_'.$portfolio_id.'" class="portfolio '. $ex_class .'" ><div class="'.$css_class.'" data-columns="'.$columns.'" data-fullwidth="'.$fullwidth.'" data-animation-delay="'.$css_animation_delay.'" data-animation-effect="'.$css_animation.'">';
	   
	   //Build Default argument for portfolio loop
	   $args = array(
	       'portfolio_style' => $portfolio_style ,
		   'class'  => 'span' ,
		   'img_size' => ($img_size == 'custom' && $custom_img_size != '' ) ? trim($custom_img_size) : brad_get_img_size($columns) ,
		   'disable_lb_icon' => $disable_lb_icon ,
		   'disable_li_icon' => $disable_li_icon,
		   'disable_li_title' => $disable_li_title ,
		   'show_categories' => $show_categories ,
		   'overlay_style' => $overlay_style
		   );
	   
	    while ( $portfolios -> have_posts() ) :  $portfolios -> the_post();
	        $output .= brad_portfolio_loop_style1( $portfolios , $args);
        endwhile;	
		   	
	   $output .= '</div></div>';
		   
		   
			//only included script if portfolio post exists
			$brad_includes['load_isotope'] = true ;
			
            if( $pagination == 'ifscroll' || $pagination == 'loadmore'){
				  $output .= '<div id="infinite_scroll_loading" class="clearfix margin-on-'.$padding.' '.$portfolio_style.'"></div>';
	              $brad_includes['load_infiniteScroll'] = true ;
             }
              
			endif;
			//End posts if exist;
            
			 if( $pagination == 'default' || $pagination == 'ifscroll' || $pagination == 'loadmore'):
			   $p_class =  $pagination == 'default' ? '' : 'hidden';
               $output .= brad_pagination($portfolios->max_num_pages , $range = 2 , false , $p_class);
            endif;
            
		   if( $pagination == 'loadmore' ):
                $output .= '<p id="load_more" class="sp-container aligncenter"><a  href="#" class="button button_'.$button_style.' icon-align-left" title="'.$lm_title.'">'.brad_icon($icon,'','',false).$lm_title.'</a></p>';
           endif;
  
			wp_reset_query();	
			
			  
            }
     
            $portfolio_id++;
            return $output;  
        }
    
}
