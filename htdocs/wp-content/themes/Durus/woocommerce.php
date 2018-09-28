<?php get_header();
global $brad_data;

if(is_shop() || is_tax('product_cat') || is_tax('product_tag')) {
	$brad_page_id = get_option('woocommerce_shop_page_id');
}
else{
	$brad_page_id = get_the_ID();
}

if( get_post_meta( $brad_page_id , 'brad_page_layout' , true ) == 'sidebar'){
   $woocommerce_loop['columns'] = 3;
}
?>

<?php if(get_post_meta( $brad_page_id , 'brad_page_layout' , true ) == 'sidebar') { 
 if(get_post_meta($post->ID, 'brad_sidebar_position', true) == 'left') {
		$content_css = 'content-right';
		$sidebar_css = 'sidebar-left';
	} else {
		$content_css = 'content-left';
		$sidebar_css = 'sidebar-right';
	}
?>
<section class="section-with-sidebar">
  <div class="container">
    <div class="row-fluid">
      <div class="row-fluid">
        <div id="content" class="content span9  <?php echo $content_css;?>">
            <div class="inner-content">
               <?php  woocommerce_content(); ?>
             </div>
           </div>
          <div id="sidebar" class="span3 sidebar <?php echo $sidebar_css; ?>" style="">
          <div class="inner-content">
          <?php dynamic_sidebar('WooCommerce Sidebar'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php } else { ?>
<section id="section_0" class="section">
  <div class="container">
    <div class="row-fluid">
       <?php  woocommerce_content(); ?>
      </div>
    </div>
</section>
<?php } ?>

<?php get_footer(); ?>
