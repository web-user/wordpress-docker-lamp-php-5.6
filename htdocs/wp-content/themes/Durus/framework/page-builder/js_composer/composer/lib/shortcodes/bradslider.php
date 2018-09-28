<?php

/* Testimonials
-----------------------------------------------*/

class WPBakeryShortCode_VC_Bradslider extends WPBakeryShortCode {
	
 protected function content( $atts, $content = null , $helper = false) {
	 global $post , $brad_includes;
	 $output = '';
	 extract(shortcode_atts(array(
	  'categories'  =>  '' , 
	  'height'      =>  '500' ,  
	  'fullheight'  =>  'no' ,  
	  'parallax'    =>  'no' ,
	  'count'       =>  '8' ,
	  'navigation'  => 'yes',
	  'pagination'  => 'yes',
	  'autoplay'    => 'no',
	  'order'       => 'DESC' ,
	  'orderby'     => 'date'
	  ),$atts));
	  
	
	 if(!empty($categories)):
		 
		 $args = array(
		'post_type' => 'bradslider',
		'post_status' => 'publish',
		'posts_per_page' => (int)$count,
		'orderby' => $orderby ,
		'order' => $order
		 );
	 
	     $cat_ids = explode(',', $categories );
	     $args['tax_query'] = array(
			array(
			  'taxonomy' => 'carousel_category',
			  'field' => 'id',
			  'terms' => $cat_ids
			    )
			  );
	 
	 $carousels = new WP_Query($args);
	 if( $carousels -> have_posts()):
	 while($carousels->have_posts()): $carousels->the_post();
	 
	 $slider_image =  get_post_meta($post->ID,'brad_slider_image',true);
	 $slider_video_mp4 =  get_post_meta($post->ID,'brad_slider_video_mp4',true);
	 $slider_video_ogv =  get_post_meta($post->ID,'brad_slider_video_ogv',true);
	 $slider_video_webm =  get_post_meta($post->ID,'brad_slider_video_webm',true);
	 $caption_align = get_post_meta($post->ID,'brad_slider_caption_align',true);
	 $img_align = get_post_meta($post->ID,'brad_slider_caption_align',true);
	 
	 endwhile;
	 $brad_includes['load_bxslider'] = true;
	 endif;
	 endif;
	 

			  
			  
 }
}