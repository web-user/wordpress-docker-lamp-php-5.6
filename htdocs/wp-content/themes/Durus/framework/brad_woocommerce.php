<?php

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action('woocommerce_before_shop_loop_item_title', 'brad_template_loop_product_thumbnail', 10 );

function brad_template_loop_product_thumbnail() { 
   global $brad_data,$product, $post , $woocommerce;
   $output = '';
   $cart_items = array();

	if($woocommerce->cart->get_cart() && is_array($woocommerce->cart->get_cart())) {
		foreach($woocommerce->cart->get_cart() as $cart) {
			$cart_items[] = $cart['product_id'];
		}
	}
   ?>

  <div class="product-wrap">
    <div class="product-images <?php if( in_array($post->ID, $cart_items) == true ) { echo ' in-cart-yes';} ?> image product-transition-<?php if($brad_data['check_shoprollover']) { echo 'yes';}?>">
        <span class="icon-cartloading"><i class="fa-spin fa-spinner"></i></span>
        <span class="icon-addedtocart"><i class="ss-air ss-check"></i></span>
        <div class="product-image">
            <?php echo  woocommerce_get_product_thumbnail(); ?>
        </div>
        <?php
	    if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
		    $thumbnails = $product->get_gallery_attachment_ids();
		    $img_count = 0;
		    if ($thumbnails) {
		        foreach ($thumbnails as $thumbnail ) {
			    echo '<div class="product-image product-image-secondary">'.wp_get_attachment_image( $thumbnail, 'shop_catalog' ).'</div>';	
				$img_count++;
				if( $img_count == 1){ break; }
			}
		 }
		}
		else {
		    $thumbnails = get_posts( array(
			   'post_type' 	=> 'attachment',
		   	   'numberposts' 	=> -1,
			   'post_status' 	=> null,
			   'post_parent' 	=> $post->ID,
			   'post__not_in'	=> array( get_post_thumbnail_id() ),
			   'post_mime_type'=> 'image',
			   'orderby'		=> 'menu_order',
			   'order'			=> 'ASC'
			) );
					
			
			if ($thumbnails) {
				$img_count = 0;
			   foreach ( $thumbnails as $key => $thumbnail ) {
				   echo '<div class="product-image product-image-secondary">'.wp_get_attachment_image( $thumbnail->ID, 'shop_catalog' ).'</div>';	
				   $img_count++;
				   if ($img_count == 1) break;
		      }	
		}
	}
  ?>
 </div>
</div>
<?php 
}

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_after_shop_loop_item', 'brad_loop_add_to_cart', 10);

function brad_loop_add_to_cart(){
	 global  $product; ?>
     
     <div class="product-overlay-buttons">			
     <?php 
     ob_start();
     woocommerce_get_template( 'loop/add-to-cart.php' ); 
     $output = ob_get_clean();
  
     if(!empty($output)){
	     $output = str_replace("button","button ",$output);
         $str_pos = strpos($output, ">");
	     if ($str_pos !== false) {
	         $output = substr_replace($output,'><i class="ss-air ss-shoppingbag"></i>', $str_pos , strlen(1));
	     }
      }
	
      if($product->product_type == 'variable' && empty($output)) {
           $output = "<a class='button product_type_variable' href='".get_permalink($product->id)."'><i class='ss-air ss-columns'></i>".__('Select options','woocommerce')."</a>";
      }
  
    if($product->product_type == 'simple') {
        $output .= "<a class='button show-detail-button' href='".get_permalink($product->id)."'><i class='ss-air ss-columns'></i> ".__('Show Details','woocommerce')."</a>";
}
     echo $output; ?>
     </div>

<?php 
}





/*-------------------------------------------------------*/
/* Woo commerence single product 
/*-------------------------------------------------------*/


add_action( 'woocommerce_before_single_product_summary', 'brad_woo_summary_div', 35);
add_action( 'woocommerce_after_single_product_summary',  'brad_woo_close_double_div', 4);
function brad_woo_summary_div() {
	echo "<div class='span6 single-product-summary'>";
}
function brad_woo_close_div() {
	echo "</div>";
}
function brad_woo_close_double_div() {
	echo "</div></div>";
}

//change tab position to be inside summary
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 1);	


//wrap single product image in an extra div
add_action( 'woocommerce_before_single_product_summary', 'brad_woo_images_div', 2);
add_action( 'woocommerce_before_single_product_summary',  'brad_woo_close_double_div', 20);

function brad_woo_images_div(){
	echo "<div class='row-fluid'><div class='span6 single-product-main-image'><div class='single-product-wrapper'>";
}

// display upsells and related products within dedicated div with different column and number of products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products',10);
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

function woocommerce_output_related_products() {
	$output = null;

	ob_start();
	woocommerce_related_products(array(4,4)); 
	$content = ob_get_clean();
	if($content) { $output .= $content; }

	echo '<div class="clear"></div>' . $output;
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display',10);
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 21);

function woocommerce_output_upsells() {

	$output = null;

	ob_start();
	woocommerce_upsell_display(4,4); 
	$content = ob_get_clean(); 
	if($content) { $output .= $content; }

	echo $output;
}





?>
