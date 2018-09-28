<!doctype html>
<html class="" <?php language_attributes(); ?>>
<head>

<!-- Meta Tags -->
<meta charset="utf-8">


<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title><?php bloginfo('name'); ?><?php wp_title(' - ', true, 'left'); ?></title>

<!--[if lte IE 8]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->


<?php global $brad_data; ?>
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

<?php 
global $brad_data;

$default_fonts = array( 'Custom Font One', 'Custom Font Two', 'Arial' , "'Arial Black'", "'Bookman Old Style'" , "'Comic Sans MS'" ,'Courier', 'Garamond' ,'Georgia' , 'Impact', "'Lucida Console'" , "'Lucida Sans Unicode'" , "'MS Sans Serif'" , 
"'MS Serif'", "'Palatino Linotype'" , "Tahoma" , "'Times New Roman'", "'Trebuchet MS'", 'Verdana' ,    
 );	
 
$gfonts = array( $brad_data['font_body']['font-family'] , $brad_data['font_h1']['font-family'] , $brad_data['font_h2']['font-family'] , $brad_data['font_h3']['font-family'] , $brad_data['font_h4']['font-family'], $brad_data['font_h5']['font-family'] , $brad_data['font_h6']['font-family'] , $brad_data['font_titlebarheadline']['font-family'] , $brad_data['font_titlebarheadline_style2']['font-family'] , $brad_data['font_nav']['font-family'] , $brad_data['font_nav_dropdown']['font-family'], $brad_data['font_footerheadline']['font-family'], $brad_data['sidebar_headline_font']['font-family'] ); 

$google_fonts = array();		   

/* Now Load Google Fonts */
 foreach($gfonts as $gfont) {
	  //Remove the Backup font Family
	   $gfonts_array = explode(", ", $gfont );
	   $font = $gfonts_array[0];
	   //If not a Default Font
	   if( !empty($font) && !in_array($font , $default_fonts) ) {
		$google_fonts[urlencode($font)] = '"' . urlencode($font) . ':300,400,400italic,600,700,700italic:latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese"';
	}
 }

?>
<?php
	if(is_array($google_fonts) && !empty($google_fonts)) {
		$google_fonts = implode($google_fonts, ', ');
	}
	?>
	<script type="text/javascript">
	WebFontConfig = {
		<?php if(!empty($google_fonts)): ?>google: { families: [ <?php echo $google_fonts; ?> ] },<?php endif; ?>
		custom: { families: ['durus' , 'SSAir' , 'SSSocialRegular' <?php if(!empty($brad_data['custom_iconfont']['name'])) echo ' , "'.$brad_data['custom_iconfont']['name'].'"';?> ], urls: ['<?php bloginfo('template_directory'); ?>/css/icons.css', '<?php bloginfo('template_directory'); ?>/css/ss-icons.css' <?php if(!empty($brad_data['custom_iconfont']['css-url'])) echo ' , "'.$brad_data['custom_iconfont']['css-url'].'"';?>] }
	};
	(function() {
		var wf = document.createElement('script');
		wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
		  '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
		wf.type = 'text/javascript';
		wf.async = 'true';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(wf, s);
	})();
	</script>

	<?php
	wp_deregister_style( 'style-css' );
	wp_register_style( 'style-css', get_stylesheet_uri() );
	wp_enqueue_style( 'style-css' );
	?>

<?php wp_head(); ?>

<!--[if IE]>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ie.css">
<![endif]-->
<!--[if lte IE 8]>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
<![endif]-->

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/custom.css">
    
</head>

<body <?php body_class();?>>

<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-WFVGX9"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WFVGX9');</script>
<!-- End Google Tag Manager -->

<!-- mobile menu Starts Here-->
<div id="mobile_navigation">
  <?php wp_nav_menu(array('theme_location' => 'main_navigation','depth' => 3 , 'container' => false, 'menu_id' => 'mobile_menu','menu_class' => 'mobile_menu')); ?>

<a class="toggle-menu close-m-menu" href="#"><i class="fa-list"></i> Lukk</a>

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
   if( is_search() || is_archive() || is_404()  ) {
		$brad_page_id = -1 ;
	}
	else if( is_home() && get_option('page_for_posts')){
		$brad_page_id = get_option('page_for_posts');
	}
	else {
		$brad_page_id = get_the_ID();
	}
	
	if(class_exists('Woocommerce')) {
			if(is_shop() || is_tax('product_cat') || is_tax('product_tag')) {
				$brad_page_id = get_option('woocommerce_shop_page_id');
	    }
	}

?>

<?php if(class_exists('Woocommerce') && is_woocommerce() && (is_product() || is_shop()) && !is_search() && get_post_meta($brad_page_id, 'brad_titlebar', true) != 'no' ){?>
          <section id="titlebar" class="titlebar <?php echo get_post_meta($brad_page_id,'brad_titlebar_style',true);?> box <?php echo get_post_meta($brad_page_id,'brad_title_color_scheme',true);?>" data-height="<?php echo get_post_meta(get_the_ID(),'brad_title_height',true);?>" data-parallax="<?php echo get_post_meta(get_the_ID(),'brad_titlebar_parallax',true);?>">
      <?php if(get_post_meta($brad_page_id, 'brad_title_bg_overlay', true) === "yes" && get_post_meta($brad_page_id, 'brad_titlebar_style', true) == 'style2'):?>
      <!-- titlebar Overlay -->
      <div class="titlebar-overlay"></div>
      <?php endif; ?>
      <div class="container">
        <div class="row-fluid">
          <div class="titlebar-content">
           <?php if( get_post_meta($brad_page_id, 'brad_page_title', true) != "hide"): ?>
            <h1><?php if(is_product()) { if(get_post_meta($brad_page_id, 'brad_page_title', true) != "" ){ echo get_post_meta($brad_page_id, 'brad_page_title', true);} else {the_title();}
			}
			else{
				woocommerce_page_title();
			}?></h1>
            <?php endif; ?>
            <?php if( get_post_meta($brad_page_id,'brad_titlebar_style',true) == 'style2' && get_post_meta($brad_page_id,'brad_add_content',true) != ''):
			echo '<div class="titlebar-subcontent">';
			echo parse_shortcode_content(get_post_meta($brad_page_id,'brad_add_content',true));  
			echo '</div>';
			endif ; ?>	
            <?php 
	        if( is_product() || get_post_meta($brad_page_id, 'brad_titlebar', true) == 'breadcrumb' || get_post_meta($brad_page_id, 'brad_titlebar', true) == 'all') { 
			woocommerce_breadcrumb(array(
				'wrap_before' => '<div id="breadcrumbs"><span class="breadcrumb-title">'.__('You are Here:','brad-framework').'</span>',
				'wrap_after' => '</div>',
				'before' => '<span>',
				'after' => '</span>',
				'delimiter' => '<span class="separator">/</span>'
			));
			} ?>
          </div>
        </div>
      </div>
    </section>


<?php }
else if((( is_home() || is_page() || is_single() || is_singular('portfolio')) && get_post_meta($brad_page_id, 'brad_titlebar', true) != 'no')) { ?>
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
            <h1><?php if(get_post_meta($brad_page_id, 'brad_page_title', true) != "" ){ echo get_post_meta($brad_page_id, 'brad_page_title', true);} else { if(is_home() && !empty($brad_data['text_blogtitle'])){ echo $brad_data['text_blogtitle']; } else { echo the_title();}} ?></h1>
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