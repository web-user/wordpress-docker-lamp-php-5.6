<?php global $brad_data , $woocommerce; ?>
<?php
if( @$brad_data['show_topbar'] == true ) :
    get_template_part('framework/headers/header-topbar');
endif;
?>

<div id="header" class="header-v1 <?php if( $brad_data['disable_fixednav'] == false) echo 'sticky-nav';?>">
  <section id="main_navigation" class="<?php if( $brad_data['disable_shrinknav'] == false) echo 'shrinking-nav';?>">
    <div class="container">
      <div id="main_navigation_container" class="row-fluid">
        <div class="row-fluid"> 
          <!-- logo -->
          <div class="logo-container"> <a href="<?php echo home_url(); ?>" id="logo" class="clearfix">
            <?php if( isset($brad_data['media_logo']['url'])){ ?>
            <img src="<?php echo $brad_data['media_logo']['url']; ?>" alt="<?php bloginfo('name'); ?>">
            <?php } else { echo bloginfo('name'); }?>
            </a> </div>
          <!-- Tooggle Menu will displace on mobile devices -->
          <div id="toggle-menu"> <a class="toggle-menu" href="#"><i class="fa-list"></i></a>
            <div class="clear"></div>
          </div>
          <?php if($woocommerce && $brad_data['check_cartmobile'] == true):?>
              <div class="carticon-mobile"><a href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><i class="fa-shopping-cart"></i></a></div>
          <?php endif; ?>
          
          <nav class="nav-container">
                <ul id="main_menu" class="main_menu">
                <!-- Main Navigation Menu -->
                <?php get_template_part('framework/headers/nav-bar'); ?>
                <!-- en nav --> 
                             
                <?php if ($woocommerce && $brad_data['check_cartheader'] == true) { ?>
                <li class="cart-container"> 
                   <!-- Cart Icons -->
                <a class="cart-icon-wrapper" href="<?php echo $woocommerce->cart->get_cart_url(); ?>">
<span class="cart-icon"><i class="fa-shopping-cart"></i></span></a>
               <!-- Cart Menu Start --> 
               <?php
               // Check for WooCommerce 2.0 and display the cart widget
	          if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
	                the_widget( 'WC_Widget_Cart', 'title= ' );
	          } else {
		         the_widget( 'WooCommerce_Widget_Cart', 'title= ' );
	         }
	         ?>
                </li>
                <?php }  ?>
                
                <?php  if($brad_data['check_searchform'] == true) : ?>
                <!-- Header Search Button -->
                <li id="header-search-button"> <a href="#"  class="search-button"><i class="fa-search"></i></a> </li>
                <?php endif; ?>
                
             
               </ul>
               </nav>
               
       
        </div>
      </div>
    </div>
  </section>
  <?php  if($brad_data['check_searchform'] == true) : 
            get_template_part('framework/headers/header-search');
        endif; ?>
</div>
