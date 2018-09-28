<?php

/* Blog List
-----------------------------------------------------------------*/

class WPBakeryShortCode_VC_Blog_List extends WPBakeryShortCode {
	
 protected function content( $atts, $content = null, $helper = false ) {
	 $output = '';
     extract( shortcode_atts( array(
            'category'        =>  '',
            'type'            =>  '1',
            'max_items'       =>  '6',
			'excerpt_length'  => '20'
        ), $atts ) ); 
	
	global $post , $wpdb;
	
	$args = array(
	    'post_type' => 'post',
	    'post_status' => 'publish',
	    'posts_per_page' => (int)$max_items
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
	  if( have_posts() ) :
        $output .= '<div class="latest-posts-wrapper"><ul class="latest-posts style'.$type.' clearfix">';
    	while ( have_posts() ) : the_post();
		 
		 $num_comments = get_comments_number(); // get_comments_number returns only a numeric value
         $comments ='';
          if ( comments_open() ) {
	      if ( $num_comments == 0 ) {
		     $comments = __('No Comment','brad');
	      } elseif ( $num_comments > 1 ) {
		     $comments = $num_comments . __(' Comments','brad');
	      } else {
		    $comments = __('1 Comment','brad');
	      } }
	    $img_list = get_post_meta( get_the_ID( ), 'brad_image_list', false );
			    if ( !is_array( $img_list ) )
			    	$img_list = ( array ) $img_list;
			    if ( !empty( $img_list ) ) {
			    	$img_list = implode( ',', $img_list );
			    	$images = $wpdb->get_col( "
			    	SELECT ID FROM $wpdb->posts
			    	WHERE post_type = 'attachment'
			    	AND ID IN ( $img_list )
			    	ORDER BY menu_order ASC
			    	" );
				}
				else{
					$images = false;
				}
		if( $type == 1){
		$output .= '<li class="latest-posts-item clearfix">';
		if( has_post_thumbnail() || !empty($images)):
		$output .= '<div class="flexslider-container"><div class="flexslider mini-slideshow"><ul class="slides">';
		
		 if(!empty($images)){
		 foreach($images as $image ){
			$src = wp_get_attachment_image_src( $image , 'thumb-normal' );
			$src2 = wp_get_attachment_image_src( $image , '' );
			$src_info = wp_get_attachment_metadata( $image ) ;
			if( is_array($src_info) && !empty($src_info)){
			   $meta_img = ' width="'.$src_info['width'].'" height="'.$src_info['height'].'" ';
		    }
		    else {
			    $meta_img = '';
		    }
			$output .= '<li><div class="images"><a href="'. $src2[0] . '" rel="prettyPhoto[slides]" class="block prettyPhoto"><img src="'.$src[0].'"  '.$meta_img.' alt="'.get_the_title().'" /></a></div></li>';
		 }
	    }
		if(has_post_thumbnail()){
		$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID) , 'thumb-normal' );
		$src2= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID) , '');
		$src_info = wp_get_attachment_metadata( get_post_thumbnail_id($post->ID) ) ;
		if( is_array($src_info) && !empty($src_info)){
			$meta_img = ' width="'.$src_info['width'].'" height="'.$src_info['height'].'" ';
		}
		else {
			$meta_img = '';
		}
		$output .= '<li><div class="image"><a href="'. $src2[0] . '" rel="prettyPhoto[slides]" class="block prettyPhoto"><img src="'.$src[0].'" '.$meta_img.' alt="'.get_the_title().'" /></a></div></li>';
		}
		$output .= '</ul></div></div>';
		endif;
		$output .= '<div class="latest-posts-content">
		               <h5><a class="title" href="'. get_permalink() .'">'.get_the_title().'</a></h5>
					   <p class="post-meta-data"><span>'.get_the_date().'</span>'. ( $comments != '' ? '<span class="divider">|</span><span>'.$comments.'</span>' : '' ) .'</p>
					   <p class="excerpt"> '.brad_limit_words(get_the_excerpt(),$excerpt_length). '[...]</p>
					</div>';
		$output .= '</li>';			
		}
		else
		{
		$output .= '<li class="latest-posts-item clearfix">';
		$output .= '<div class="date"> <span class="day"><span>'. get_the_time('d') .'<span class="th">' .__('th','brad').'</span></span></span> <span class="month">'.get_the_time('M').'</span> </div>';
		$output .= '<div class="latest-posts-content">
		               <h5><a class="title" href="'. get_permalink() .'">'.get_the_title().'</a></h5>
					   '.( $comments != '' ? '<div class="post-meta-data"><span>'.$comments.'</span></div>' : '' ) .'
					   <p class="excerpt"> '.brad_limit_words(get_the_excerpt(), $excerpt_length). '[...]</p>
					 </div>';	
		$output .= '</li>';	
		}
		endwhile;
		wp_reset_query();
		$output .= '</ul></div>'.$this->endBlockComment('Blog List')."\n";
	    endif;
    return $output;	
 }
}