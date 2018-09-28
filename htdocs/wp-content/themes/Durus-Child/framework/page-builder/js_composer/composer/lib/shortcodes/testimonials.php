<?php 

/* Testimonials
-----------------------------------------------*/

class WPBakeryShortCode_VC_Testimonials extends WPBakeryShortCode {

   protected function content( $atts, $content = null , $helper = false ) { 
   global $post , $brad_includes;
   $output = $return = '';

	extract(shortcode_atts(array(
	    'appearance' => 'columns' , 
		'columns' => '2' , 
		'carousel_columns' => '1',
		'autoplay' => 'no',
		'navigation' => 'yes' ,
		'testimonial_bg' => 'default' ,
		'navigation_align' => 'side' ,
		//'style' => 'default',
		'categories' => '' ,
		'orderby' => 'date',
		'order' => 'DESC',
		'img_size' => '',
		'custom_img_size' => '' ,
		'count' => 5 ,
		'rounded_image' => '' ,
		'el_class' => '',
        'css_animation' => '' ,
		'css_animation_delay' => '0' ,
	    'css_animation_type' => 'box' ,
	    'bottom_margin' => 'yes'),$atts));

	$query_args = array(
		'post_type' => 'testimonials',
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
				'taxonomy' => 'testimonials-category',
				'field' => 'id',
				'terms' => $categories
				 )
			  );
	}
	
	
	$testimonials = new WP_Query( $query_args );
	
	// check if testimonials  exists
    if( $testimonials -> have_posts() ) :
	
	if($img_size == 'custom' && $custom_img_size != '') {
		$img_size = $custom_img_size;
	}
	
	if($css_animation_type == 'iconbox'){
			 $el_class1 =  $this->getCSSAnimation($css_animation);
			 $el_class2 = '';
		 }
        else{
			 $el_class1 = '';
			 $el_class2 = $this->getCSSAnimation($css_animation);
          }
	
	 $i = 1 ;
	   	 
	 while ( $testimonials -> have_posts() ) : 
         $testimonials -> the_post();
		 $person = get_post_meta($post->ID, 'brad_testimonial_name',true);
		 $company = get_post_meta($post->ID, 'brad_testimonial_company',true);
		 $person_role = get_post_meta($post->ID, 'brad_testimonial_role',true);
		 $company_link = get_post_meta($post->ID, 'brad_testimonial_company_link',true);
		 $testimonial_content = get_the_content($post->ID);
		 $img_id = preg_replace('/[^\d]/', '',get_post_meta(get_the_ID(),'brad_testimonial_image',true));
		 $return .= '<div class="testimonial-item span"><div class="inner-content '.$el_class2.'" data-animation-delay="'.intval($i*$css_animation_delay).'" data-animation-effect="'.$css_animation.'"><div class="testimonial animated-box "><div class="testimonial-content-wrapper">';
		 $return .= '<div class="testimonial-content"><blockquote><q>'. do_shortcode($testimonial_content) .'</q></blockquote></div>';
		 $return .= '<div class="author-info"><div class="clearfix">';
		 if( $person != ''){
			 $return .= '<span class="author-name">'. $person .'</span>';
		 }
		 if( $company != '' ){
			 $person_role = $person_role != '' ? $person_role.' '.__('of','brad').' ' : '' ;
			 if( $company_link != ''){
			     $return .= '<span class="author-desc">'.$person_role.'<a href="'.$company_link.'">'.$company.'</a></span>';
			 }
			 else{
				 $return .= '<span class="author-desc">'.$person_role.$company.'</span>';
			 }
		 }
		 $return .= '</div></div></div>';
		 if( $img_id != '' ){
			 $img = wpb_getImageBySize(array( 'attach_id' => $img_id, 'thumb_size' => $img_size ));
			 if ( $img == NULL ) $img['thumbnail'] = '<img src="http://placekitten.com/g/400/300" /> <small>'.__('This is image placeholder, edit your page to replace it.', "brad-framework").'</small>';
			 $return .= '<div class="author-avatar '.$el_class1.'" data-animation-delay="'.intval($i*$css_animation_delay).'" data-animation-effect="'.$css_animation.'">'.$img['thumbnail'].'</div>';
		 }
		 $return .= '</div></div></div>';
		 $i++;
	endwhile;		
		
	if($columns == '' || empty($columns)) { $columns = 2; }	
	$el_class = $this->getExtraClass($el_class);
	if( $appearance === 'carousel'){
	  $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' row-fluid testimonials-carousel-container testimonials-bg-'.$testimonial_bg.' navigation-align-'.$navigation_align.' clearfix rounded-image-'.$rounded_image.''.$el_class, $this->settings['base']);
	  $output .= "\n\t".'<div class="'.$css_class.'" data-navigation="'.$navigation.'" data-autoplay="'.$autoplay.'">';
	  $output .= "\n\t\t".'<span class="carousel-next"></span><span class="carousel-prev"></span>';
	  $output .= "\n\t\t\t".'<div class=" testimonials-carousel" >';
	  $output .= "\n\t\t\t\t".$return ;
	  $output .= "\n\t\t\t".'</div>';
	  $output .= "\n\t".'</div>';
	  $brad_includes['load_bxslider'] = true;
	}
	else{
	$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'row-fluid testimonials-grid columns-'.$columns.' rounded-image-'.$rounded_image.'  testimonials-bg-'.$testimonial_bg.'  '.$el_class, $this->settings['base']);
    $output .= "\n\t".'<div class="'.$css_class.'" >';
	$output .= "\n\t\t".$return;
    $output .= "\n\t".'</div>'.$this->endBlockComment('testimonials')."\n";
	}
    endif;
	wp_reset_query();	
	return $output;
   }
}
?>