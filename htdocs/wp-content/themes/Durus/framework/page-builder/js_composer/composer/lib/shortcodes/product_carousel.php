<?php
/* Posts Carousel
--------------------------------------------------*/

class WPBakeryShortCode_VC_Product_Carousel extends WPBakeryShortCode {
	
 protected function content ( $atts , $content = null , $helper = false){
   global $brad_includes , $post , $woocommerce;
   
   $output = '';
   
   extract(shortcode_atts(array(
    'category'=> '' ,
	'columns' => 2 , 
	'padding' => '' ,
	'show_categories' => 'yes' ,
	'disable_button' => 'no' ,
	'disable_price' => 'no' ,    
	'autoplay' => 'no' , 
	'navigation' => 'yes' , 
	'max_items' => 8 ),$atts));

	$args = array(
		'post_type' => 'product',
		'posts_per_page' => (int) $max_items,
		'meta_key' => '_featured',
		'meta_value' => 'yes',
	);
	
	if(!empty($category)){
		$cat_id = explode(',', $category);
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'id',
				'terms' => $cat_id
			)
		);
	}

   query_posts($args);
		
	if(  have_posts() ) :
	$output .= '<div class="carousel-container">';
	
	if( $navigation == 'yes') :
	    $output .=  '<a class="carousel-next" href="#"></a><a class="carousel-prev" href="#"></a>';
	endif;
	
	$output .= '<div class="carousel-wrapper carousel-with-padding-yes"><ul class="carousel-items posts-carousel row element-padding-'.$padding.'" data-columns="'.$columns.'" data-navigation="'.$navigation.'" data-autoplay="'.$autoplay.'">';
	
	while ( have_posts() ) : the_post();
	if( has_post_thumbnail() ) :		
	    $output .= '<li class="carousel-item span">';
		$output .= '<div class="image">'.get_the_post_thumbnail(get_the_ID(), 'shop_catalog').'<div class="overlay"></div>';
		if( $show_categories == 'yes'):
		     $output .= '<div class="prdocut-categories">'.get_the_term_list(get_the_ID(), 'product_cat', '', ' , ', '').'</div>';
		endif;
		$output .= '<h5><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
		if( $disable_price != 'yes'):
		     ob_start();
			 woocommerce_get_template('loop/price.php');
			 $price = ob_get_contents();
			 ob_end_clean();
			 $output .= $price;
		endif;	 
		
		if( $disable_button != 'yes'):
		     ob_start();
			 woocommerce_get_template('loop/add-to-cart.php');
			 $cart_buttons = ob_get_contents();
			 ob_end_clean();
			 $output .= $cart_buttons;
		endif;	 
		
		$output .= '</div></li>';
		
	endif;
	endwhile;
    wp_reset_query();
	$output .= '</ul></div></div>'.$this->endBlockComment('Products Carousel')."\n";
    $brad_includes['load_caroufred'] = true;	
	endif;
	return $output;

 }
}