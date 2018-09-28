<?php

/* Posts Carousel
--------------------------------------------------*/

class WPBakeryShortCode_VC_Posts_Carousel extends WPBakeryShortCode {
	
 protected function content ( $atts , $content = null , $helper = false){
   global $brad_includes , $post;
   
   $output = '';
   
   extract(shortcode_atts(array(
    'category'=> '' ,
	'columns' => 2 , 
	'show_author' => 'yes' ,
	'show_excerpt' => 'yes' ,
	'show_categories' => 'yes' ,
	'show_date' => 'yes' ,  
	'excerpt_length' => 'no' ,   
	'autoplay' => 'no' , 
	'navigation' => 'yes' , 
	'max_items' => 8 ),$atts));

	$args = array(
	    'post_type' => 'post',
	    'post_status' => 'publish',
	    'posts_per_page' => (int) $max_items
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
    $blog_items = query_posts($args);
		
	if(  have_posts() ) :
	$output .= '<div class="carousel-container posts-carousel-container">';
	
	if( $navigation == 'yes') :
	    $output .=  '<a class="carousel-next" href="#"></a><a class="carousel-prev" href="#"></a>';
	endif;
	
	$output .= '<div class="carouel-outer clearfix"><div class="carousel-wrapper carousel-with-padding-yes"><ul class="carousel-items posts-carousel row" data-columns="'.$columns.'" data-navigation="'.$navigation.'" data-autoplay="'.$autoplay.'">';
	
	while ( have_posts() ) : the_post();

         
         $comments ='';
          if ( comments_open() ) {
			  $num_comments = get_comments_number(); // get_comments_number returns only a numeric value
	          if ( $num_comments == 0 ) {
		          $comments = '<i class="ss-air ss-chat"></i> 0';
	           } elseif ( $num_comments > 1 ) {
		          $comments = '<a href="' . get_comments_link() .'"><i class="ss-air ss-chat"></i> '.$num_comments.'</a>';
	          }
			}
		  
	     //$img_list = get_post_meta( get_the_ID( ), 'brad_slideshow', false );
			    //if ( !is_array( $img_list ) )
			    	//$img_list = ( array ) $img_list;
			    //if ( !empty( $img_list ) ) {
			    	//$img_list = implode( ',', $img_list );
			    	//$images = $wpdb->get_col( "
			    	//SELECT ID FROM $wpdb->posts
			    	//WHERE post_type = 'attachment'
			    	//AND ID IN ( $img_list )
			    	//ORDER BY menu_order ASC
			    	//" );
				//}
				//else{
					//$images = false;
				//}
					
	$output .= '<li class="carousel-item span">';
	if( has_post_thumbnail() || !empty($images) ):
	$output .= '<div class="flexslider floated-slideshow"><ul class="slides">';
	if(has_post_thumbnail()){
		$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID) , brad_get_img_size($columns) );
		$src2= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID) , '');
		$output .= '<li>
		             <div class="image hoverlay">
		                <img src="'.$src[0].'" alt="'.get_the_title().'" />
					    <div class="overlay"><div class="overlay-content"><a href="'. $src2[0] . '" rel="prettyPhoto[posts]" class="prettyPhoto icon"><i class="fa-search"></i></a></div></div>
					 </div>
				   </li>';
	}
	//if(!empty($images)){
	//foreach($images as $image ){
			//$src = wp_get_attachment_image_src( $image , 'large' );
			//$src2 = wp_get_attachment_image_src( $image , '' );
			//$output .= '<div class="image">
			              //<img src="'.$src[0].'" alt="'.get_the_title().'" />
						  //<div class="overlay"><a href="'. $src2[0] . '" rel="prettyPhoto[slides]" class="prettyPhoto"><i class="icon-blandes-search"></i></a></div>
						//</div>';
		// }	
		//}
	$output .= '</ul></div>';				 
	endif;
	
	$output .= '<h5><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
	
	if( $show_categories == 'yes' || $show_author == 'yes'):
	$output .= '<div class="post-meta-data">';
	
	if( $show_author == 'yes'):
		$output .= '<span>'.get_the_author().'</span>';
	endif;
	
	//If categories are enabled by default
	if($show_categories == 'yes'){
		$category_list = '';
		$categories = get_the_category($post->ID);
		$separator = '';
		foreach( $categories as $category){
			$category_list .= $separator.'<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>' ;
			$separator = ' , ';
		}
		$output .= '<span class="divider">|</span><span>'.$category_list.'</span>';
	}
	
	if( $comments != ''):
	    $output .= '<span class="divider">|</span><span>'. $comments .'</span>';
	endif;
	
	//End post meta
	$output .= '</div>';
	endif;

	
	//If Expert is showm
	if( $show_excerpt == 'yes'){
		$output .= '<p class="excerpt">'.brad_limit_words(get_the_excerpt(), $excerpt_length).'[...]</p>';
	}
	
	
	$output .= '</li>';
	
	endwhile;
    wp_reset_query();
	$output .= '</ul></div></div></div>'.$this->endBlockComment('Posts Carousel')."\n";
	
    $brad_includes['load_caroufred'] = true;	
	
	endif;
	return $output;

 }
}