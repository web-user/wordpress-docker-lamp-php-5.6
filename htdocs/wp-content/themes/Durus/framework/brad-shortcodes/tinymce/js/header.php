<?php global $brad_data; ?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>

<!-- Meta Tags -->
<meta charset="utf-8">


<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title><?php bloginfo('name'); ?><?php wp_title(' - ', true, 'left'); ?></title>

<!--[if lte IE 8]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->



<?php if( isset($brad_data['media_favicon']['url'] )) { ?>
    <link rel="shortcut icon" href="<?php echo $brad_data['media_favicon']['url']; ?>">
<?php } ?>

<?php if( isset($brad_data['media_favicon_iphone']['url'] )) { ?>
    <link rel="apple-touch-icon" href="<?php echo $brad_data['media_favicon_iphone']['url']; ?>">
<?php } ?>

<?php if( isset($brad_data['media_favicon_iphone_retina']['url'] )) { ?>
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $brad_data['media_favicon_iphone_retina']['url']; ?>">
<?php } ?>

<?php if( isset($brad_data['media_favicon_ipad']['url'] )) { ?>
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $brad_data['media_favicon_ipad']['url']; ?>">
<?php } ?>

<?php if( isset($brad_data['media_favicon_ipad_retina']['url'] )) { ?>
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $brad_data['media_favicon_ipad_retina']['url']; ?>">
<?php } ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
<!--[if IE]>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ie.css">
<![endif]-->
<!--[if lte IE 8]>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
<![endif]-->
    
</head>

<body <?php body_class();?>>

<!-- mobile menu Starts Here-->
<div id="mobile_navigation">
  <?php wp_nav_menu(array('theme_location' => 'main_navigation','depth' => 3 , 'container' => false, 'menu_id' => 'mobile_menu','menu_class' => 'mobile_menu')); ?>
</div>
<!-- End Mobile Navigation -->

<?php if( $brad_data['layout'] == 'boxed') { ?>
    <!-- Boxed Layout -->
    <div class="boxed-layout">
<?php  } ?>

<!-- Header -->
<?php get_template_part('framework/headers/header'); ?>
<!--End Header -->


<?php 
   if( is_search() || is_archive() || is_404() || is_home() ) {
		$brad_page_id = -1 ;
	}
	else {
		$brad_page_id = get_the_ID();
	}
?>


<?php if( is_home() && $brad_data['text_blogtitle'] ) { ?>
<!-- blog Titlebar -->
    <section id="titlebar" class="titlebar">
      <div class="container">
        <div class="row-fluid">
        <div class="titlebar-content">
          <h1><?php echo $brad_data['text_blogtitle']; ?></h1>
          <?php brad_breadcrumb(); ?>
        </div>
        </div>
      </div>
    </section>

<?php }
else if(((is_page() || is_single() || is_singular('portfolio')) && get_post_meta($brad_page_id, 'brad_titlebar', true) != 'no')) { ?>
    <!-- Static Page Titlebar -->
    <section id="titlebar" class="titlebar <?php echo get_post_meta($brad_page_id,'brad_titlebar_style',true);?> box <?php echo get_post_meta($brad_page_id,'brad_title_color_scheme',true);?>" data-height="<?php echo get_post_meta(get_the_ID(),'brad_title_height',true);?>" data-parallax="<?php echo get_post_meta(get_the_ID(),'brad_titlebar_parallax',true);?>">
      <?php if(get_post_meta($brad_page_id, 'brad_title_bg_overlay', true) === "yes" && get_post_meta($brad_page_id, 'brad_titlebar_style', true) == 'style2'):?>
          <!-- titlebar Overlay -->
          <div class="titlebar-overlay"></div>
      <?php endif; ?>
      <div class="container">
        <div class="row-fluid">
          <div class="titlebar-content">
           <?php if( get_post_meta($brad_page_id, 'brad_page_title', true) != "hide"): ?>
            <h1><?php if(get_post_meta($brad_page_id, 'brad_page_title', true) != "" ){ echo get_post_meta($brad_page_id, 'brad_page_title', true);} else {the_title();} ?></h1>
            <?php endif; ?>
            <?php if( get_post_meta($brad_page_id,'brad_titlebar_style',true) == 'style2' && get_post_meta($brad_page_id,'brad_add_content',true) != ''):
			echo '<div class="titlebar-subcontent">';
			echo parse_shortcode_content(get_post_meta($brad_page_id,'brad_add_content',true));  
			echo '</div>';
			endif ; ?>	
            <?php 
	        if( get_post_meta($brad_page_id, 'brad_titlebar', true) == 'breadcrumb' || get_post_meta($brad_page_id, 'brad_titlebar', true) == 'all') { 
			    brad_breadcrumb(); 
			} ?>
          </div>
        </div>
      </div>
    </section>
    
<?php } 
else if( is_search() || is_archive() || is_404() ) { // for all other especially Archives		
	if(is_day()) : 
		$title = sprintf( __( '%s', 'brad' ), get_the_date() );		
	elseif(is_month()) : 
		$title = sprintf( __( '%s', 'brad' ), get_the_date('F Y') );					
	elseif(is_year()) : 
		$title = sprintf( __( '%s', 'brad' ), get_the_date('Y') );				
	elseif( is_category() ) :
		$title = sprintf( __( '%s', 'brad' ), single_cat_title( '', false ) );	
	elseif( is_search() && !have_posts() ) : 
		$title = __( 'Nothing Found', 'brad' );
	elseif( is_search() ) : 
		$title = __( 'Search Results', 'brad' );
	elseif( is_404() ) : 
		$title = __( 'Error 404', 'brad' );					
	elseif(!is_page() && (!is_home() && !is_front_page())) : 
		$title = __( 'Archives', 'brad' );
	endif; ?>
    <!-- Titlebar for archibes -->
    <section id="titlebar" class="titlebar">
      <div class="container">
        <div class="row-fluid">
        <div class="titlebar-content">
          <h1><?php echo $title; ?></h1>
          <?php brad_breadcrumb(); ?>
        </div>
        </div>
      </div>
    </section>
<?php } ?>
    
<?php
	if( get_post_meta( $brad_page_id , 'brad_rev_slider', true)   && function_exists('putRevSlider')) {
		echo '<!-- Rev Slider Start -->';
		putRevSlider(get_post_meta(get_the_ID(), 'brad_rev_slider', true));
		echo '<!-- Rev Slider End -->';
	}
 ?>