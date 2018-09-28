<?php


/* Clients
------------------------------------------------------------------*/

class WPBakeryShortCode_VC_Clients extends WPBakeryShortCode {
  
   protected function content( $atts, $content = null , $helper = false ) {
	$output = ''; 
	global $post , $brad_includes;
	static $clients_id = 0;   
	extract(shortcode_atts(array(
	   'appearance' => 'columns' ,
	   'orderby' => 'date',
	   'order' => 'DESC',
	   'count' => 5 ,
	   'categories' => '', 
	   'columns' => '2' , 
	   'style' => 'style1' ,
	   'bg_color' => '#ffffff' ,
	   'bg_color_hover' => '' , 
	   'border_color' => '' , 
	   'border_color_hover' => '' , 
	   'bg_opacity' => "1",
	   'bg_opacity_hover' => "1",
	   'bg_shadow' => 'no' ,
	   'bg_radius' => 'yes' ,
	   'bg_radius_full' => 'no' ,
	   'padding' => '' ,
	   'inner_vpadding' => "default" ,
	   'inner_hpadding' => "default" ,
	   'autoplay' => 'no' , 
	   'navigation' => 'yes' ,
	   'img_size' => '' ,
	   'custom_img_size' => '' , 
	   'css_animation' => '' ,
	   'el_class' => '',
	   'css_animation_delay' => '0'),$atts));
	   
	$output = '';
	
	$query_args = array(
		'post_type' => 'clients',
		'posts_per_page' => (int)$count,
		'order'          => $order,
		'orderby'        => $orderby,
		'post_status'    => 'publish'
     );
	
	// Narrow by categories
    if ( $categories != '' ) {
    $categories = explode(",", $categories);
    $query_args['tax_query'] = array(
			array(
				'taxonomy' => 'clients-category',
				'field' => 'id',
				'terms' => $categories
				 )
			  );
	}
	
	
	$clients = new WP_Query( $query_args );
	
	// check if testimonials  exists
    if( $clients -> have_posts() ) : 

	    $el_class = $this->getExtraClass($el_class);
	    if($columns == '' || empty($columns)) {
		    $columns = 2;
		}
	
	    if($img_size == 'custom' && $custom_img_size != '') {
		   $img_size = $custom_img_size;
	    }
	
	    if( ( $bg_color != '' || $bg_color_hover != '' || $border_color != '' || $border_color_hover != '' ) && $style == 'style3' ){
	        $output .= "<style type='text/css'>";
			if( $bg_color != '' || $border_color != ''){
				$output .= "#clients_{$clients_id} .span .inner-content{";
			if( $bg_color != '' ){
		        $rgb = brad_hex2rgb($bg_color);
		        $rgba = "rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},{$bg_opacity})";
		        $output .= "background-color:{$bg_color};background-color:{$rgba};";
			}
			if( $border_color != '' ){
		        $output .= "border-color:{$border_color};";
			}
			$output .= "}";
			}
			if( $bg_color_hover != '' || $border_color_hover != ''){
				$output .= "#clients_{$clients_id} .span .inner-content:hover{";
				if( $bg_color_hover != '' ){
		           $rgb = brad_hex2rgb($bg_color_hover);
		           $rgba = "rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},{$bg_opacity_hover})";
		           $output .= "background-color:{$bg_color_hover};background-color:{$rgba};";
			    }
				if( $border_color_hover != '' ){
		           $output .= "border-color:{$border_color_hover};";
			    }
				$output .= "}";	
			}
			$output .= "</style>";	
	     }
	 
	$clients_loop = '';
	$i = 1;
	while ( $clients -> have_posts() ) :
	    $clients -> the_post();
		$title = get_the_title($post->ID);
		$link = get_post_meta($post->ID,'brad_client_link',true);
		$logo_id = preg_replace('/[^\d]/', '' , get_post_meta($post->ID,'brad_client_image',true) );
		if( $logo_id != '' ){
			 $logo = wpb_getImageBySize(array( 'attach_id' => $logo_id, 'thumb_size' => '' ));
		     $clients_loop .= '<div class="span"><div class="inner-content '.$this->getCSSAnimation($css_animation ).'" data-animation-delay="'.intval($css_animation_delay*$i).'" data-animation-effect="'.$css_animation.'">';
			 if( $link != ''){
				 $clients_loop .= '<a href="'.$link.'" title="'.$title.'">'.$logo['thumbnail'].'</a>';
			 }
			 else{
				 $clients_loop .= $logo['thumbnail'];
			 }
			 $clients_loop .= '</div></div>';
		}
		$i++;
	endwhile; 
	
	if($appearance == 'carousel') {
		$brad_includes['load_caroufred'] = true;
	    $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'clients  '.$style.' carousel-items row element-inner-vertical-padding-'.$inner_vpadding.' element-inner-horizental-padding-'.$inner_hpadding.' element-padding-'.$padding.' columns-'.$columns.' background-shadow-'.$bg_shadow.' background-radius-'.$bg_radius.' background-radius-full-'.$bg_radius_full.' '.$el_class, $this->settings['base']);	
	    $output .= '<div class="carousel-container">';
	    if( $navigation == 'yes') {
	        $output .= '<a class="carousel-next" href="#"></a><a class="carousel-prev" href="#"></a>';
	    }
	    $output .= '<div class="carouel-outer clearfix"><div class="carousel-wrapper clients-wrapper carousel-padding-'.$padding.'"><div id="clients_'.$clients_id.'" class="'.$css_class.'" data-columns="'.$columns.'" data-autoplay="'.$autoplay.'">';
	    $output .= $clients_loop;
        $output .= '</div></div></div></div>'.$this->endBlockComment('clients')."\n";
    }
    else {
	    $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'row-fluid element-inner-vertical-padding-'.$inner_vpadding.' element-inner-horizental-padding-'.$inner_hpadding.' clients-grid '.$style.' element-padding-'.$padding.' columns-'.$columns.' '.$el_class, $this->settings['base']);
    $output .= '<div id="clients_'.$clients_id.'" class="'.$css_class.'" >';
    $output .= $clients_loop;
    $output .= '</div>'.$this->endBlockComment('clients')."\n";
   }
   endif;
   wp_reset_query();	
   $clients_id++;
   return $output;
  }   
}
