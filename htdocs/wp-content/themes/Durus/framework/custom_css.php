<?php 
function brad_custom_css_styles(){
	global $brad_data;
	
	if( is_home() && get_option('page_for_posts') ){
		$brad_page_id = get_option('page_for_posts');
	}
	else{
		$brad_page_id = get_the_ID();
	}
	?>
   <!-- Custom Stylesheet -->
  <style type="text/css">
  <?php
	if(
		!empty($brad_data['custom_font_woff_1']['url'])  && !empty($brad_data['custom_font_ttf_1']['url'])  &&
		!empty($brad_data['custom_font_svg_1']['url'])  && !empty($brad_data['custom_font_eot_1']['url'])
	):
	?>
  @font-face {
	font-family: 'Custom Font One';
	src: url('<?php echo $brad_data['custom_font_eot_1']['url']; ?>');
	src:
		url('<?php echo $brad_data['custom_font_eot_1']['url']; ?>?#iefix') format('eot'),
		url('<?php echo $brad_data['custom_font_woff_1']['url']; ?>') format('woff'),
		url('<?php echo $brad_data['custom_font_ttf_1']['url']; ?>') format('truetype'),
		url('<?php echo $brad_data['custom_font_svg_1']['url']; ?>#MyFontOne') format('svg');
	font-weight: normal;
	font-style: normal;
	}
  <?php endif; ?>

  <?php
	if(
		!empty($brad_data['custom_font_woff_2']['url'])  && !empty($brad_data['custom_font_ttf_2']['url'])  &&
		!empty($brad_data['custom_font_svg_2']['url'])  && !empty($brad_data['custom_font_eot_2']['url'])
	):
	?>
  @font-face {
	font-family: 'Custom Font Two';
	src: url('<?php echo $brad_data['custom_font_eot_2']['url']; ?>');
	src:
		url('<?php echo $brad_data['custom_font_eot_2']['url']; ?>?#iefix') format('eot'),
	    url('<?php echo $brad_data['custom_font_woff_2']['url']; ?>') format('woff'),
		url('<?php echo $brad_data['custom_font_ttf_2']['url']; ?>') format('truetype'),
		url('<?php echo $brad_data['custom_font_svg_2']['url']; ?>#MyFontTwo') format('svg');
	font-weight: normal;
	font-style: normal;
 }
<?php endif; ?>	

	 body{	
      <?php if($brad_data['layout'] == 'boxed' ) { ?>
			<?php 
			if( get_post_meta( get_the_ID(), 'brad_bg_image', true ) != '' ) {
		
				if(get_post_meta( get_the_ID(), 'brad_bg_color', true )) { echo 'background-color: '.get_post_meta( get_the_ID(), 'brad_bg_color', true ).';';}
				if(get_post_meta( get_the_ID(), 'brad_bg_image', true )) { 
				$img_id =   preg_replace('/[^\d]/', '',get_post_meta(get_the_ID(),'brad_bg_image',true));
		        $img = wp_get_attachment_image_src ( $img_id ,'');
				echo 'background-image: url('.$img[0].');';
				}
				if(get_post_meta( get_the_ID(), 'brad_bg_style', true ) != 'stretch') { 
					echo 'background-repeat: '.get_post_meta( get_the_ID(), 'brad_bg_style', true ).';'; 
				} else { 
					echo '-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;'; 
				}
				
			} 
			else {
				
				if($brad_data['bg_pattern'] && $brad_data['bg_patterns'] != "") { ?>
			    background-image:url('<?php echo get_template_directory_uri().'/images/patterns/'.$brad_data['bg_patterns']?>');
				background-repeat:repeat;
				background-position:left top;
				background-attachment: fixed;
				<?php } else { ?>
				 background-color:<?php echo $brad_data['bg_style']['background-color']?>;
				 <?php if(!empty($brad_data['bg_style']['background-image'])) : ?>
				 background-image:url("<?php echo $brad_data['bg_style']['background-image']?>");
				 <?php endif; ?>
				 background-repeat:<?php echo $brad_data['bg_style']['background-repeat']?>;
				 background-position:<?php echo $brad_data['bg_style']['background-position']?>;
				-webkit-background-size: <?php echo $brad_data['bg_style']['background-size']?>; 
				-moz-background-size: <?php echo $brad_data['bg_style']['background-size']?>; 
				-o-background-size: <?php echo $brad_data['bg_style']['background-size']?>; 
				background-size: <?php echo $brad_data['bg_style']['background-size']?>;
				background-attachment:<?php echo $brad_data['bg_style']['background-attachment']?>;
				<?php } 
			}
	  }
	  ?>
	  
      font-family: <?php echo $brad_data['font_body']['font-family'] ?> ;
      font-size: <?php echo $brad_data['font_body']['font-size']?>;
      font-weight: <?php echo $brad_data['font_body']['font-weight']?>;
	  line-height:<?php echo $brad_data['font_body']['line-height'];?>;
      color: <?php echo $brad_data['font_body_color']?>;
      }


  .search-form input[type=text]:focus {
	  border-color:<?php echo $brad_data['color_hover']; ?>;
  }

/*-----------------------------------------------------*/
/* Heading Styles
/*-----------------------------------------------------*/
   h1{
    font-family: <?php echo $brad_data['font_h1']['font-family'] ?> ;
    font-size: <?php echo $brad_data['font_h1']['font-size']?>;
    font-weight: <?php echo $brad_data['font_h1']['font-weight']?>;
	line-height:<?php echo $brad_data['font_h1']['line-height'];?>;
	letter-spacing:<?php echo $brad_data['font_h1']['letter-spacing'];?>;
    color: <?php echo $brad_data['font_h1_color']?>;
	}

  h2{
    font-family: <?php echo $brad_data['font_h2']['font-family'] ?> ;
    font-size: <?php echo $brad_data['font_h2']['font-size']?>;
    font-weight: <?php echo $brad_data['font_h2']['font-weight']?>;
	line-height:<?php echo $brad_data['font_h2']['line-height'];?>;
	letter-spacing:<?php echo $brad_data['font_h2']['letter-spacing'];?>;
    color: <?php echo $brad_data['font_h2_color']?>;
   }

   h3{
    font-family: <?php echo $brad_data['font_h3']['font-family'] ?> ;
    font-size: <?php echo $brad_data['font_h3']['font-size']?>;
    font-weight: <?php echo $brad_data['font_h3']['font-weight']?>;
	line-height:<?php echo $brad_data['font_h3']['line-height'];?>;
	letter-spacing:<?php echo $brad_data['font_h3']['letter-spacing'];?>;
    color: <?php echo $brad_data['font_h3_color']?>; 
   }

  h4{
    font-family: <?php echo $brad_data['font_h4']['font-family'] ?>;
    font-size: <?php echo $brad_data['font_h4']['font-size']?>;
    font-weight: <?php echo $brad_data['font_h4']['font-weight']?>;
	line-height:<?php echo $brad_data['font_h4']['line-height'];?>;
	letter-spacing:<?php echo $brad_data['font_h4']['letter-spacing'];?>;
    color: <?php echo $brad_data['font_h4_color']?>;
   } 

  h5{
    font-family: <?php echo $brad_data['font_h5']['font-family'] ?>;
    font-size: <?php echo $brad_data['font_h5']['font-size']?>;
    font-weight: <?php echo $brad_data['font_h5']['font-weight']?>;
	line-height:<?php echo $brad_data['font_h5']['line-height'];?>;
	letter-spacing:<?php echo $brad_data['font_h5']['letter-spacing'];?>;
    color: <?php echo $brad_data['font_h5_color']?>;
   }

  h6{
    font-family: <?php echo $brad_data['font_h6']['font-family'] ?>;
    font-size: <?php echo $brad_data['font_h6']['font-size']?>;
    font-weight: <?php echo $brad_data['font_h6']['font-weight']?>;
	line-height:<?php echo $brad_data['font_h6']['line-height'];?>;
	letter-spacing:<?php echo $brad_data['font_h6']['letter-spacing'];?>;
    color: <?php echo $brad_data['font_h6_color']?>; 
   }
   
   a{
	   color:<?php echo $brad_data['color_link'];?>;
   }
    a:hover{
		color:<?php echo $brad_data['color_hover'];?>;
	}
   
   h1 a:hover , h2 a:hover , h3 a:hover , h4 a:hover , h5 a:hover, h6 a:hover{
	   color:<?php echo $brad_data['color_primary'];?>;
   }
  
/*----------------------------------------------*/ 
/* Topbar 
/*----------------------------------------------*/
  #top_bar {
	background-color:<?php echo $brad_data['topbar_bg_color'];?>;
	border-bottom-color:<?php echo $brad_data['topbar_border_color'];?>;
  }
  #top_bar .social-icons li{
     border-color:<?php echo $brad_data['topbar_ci_divi'];?>;
  }
  
  #top_bar .social-icons li a {
	  color:<?php echo $brad_data['top_social_color'];?>;
  }
  #top_bar .social-icons li a:hover {
	  color:<?php echo $brad_data['top_social_color_hover'];?>;
  }
  #top_bar .contact-info span {
	  color:<?php echo $brad_data['topbar_ci_font'];?>;
	  border-right-color:<?php echo $brad_data['topbar_ci_divi'];?>;
  }
  
  #top_bar .top-menu > li{
	  border-right-color:<?php echo $brad_data['topbar_menu_divi'];?>;
  }
  
  #top_bar .top-menu > li a{
	  color:<?php echo $brad_data['topbar_menu_font'];?>;
  }
  
  #top_bar .top-menu > li a:hover{
	  color:<?php echo $brad_data['topbar_menu_font_hover'];?>;
  }

/*----------------------------------------------*/
/* Main Navigation Styles
/*----------------------------------------------*/
  
  #main_navigation {
      background:<?php echo $brad_data['nav_background_color']?>;
  }
  ul.main_menu > li > a { 
      color:<?php echo $brad_data['font_nav_color'];?>;
      font-size:<?php echo $brad_data['font_nav']['font-size'];?>;
      font-weight: <?php echo $brad_data['font_nav']['font-weight'];?>;
	  letter-spacing: <?php echo $brad_data['font_nav']['letter-spacing'];?>;
      font-family:<?php echo $brad_data['font_nav']['font-family']?>;
	  text-transform:<?php echo $brad_data['font_nav']['text-transform']?>;
   }
  .main_menu > li:hover > a,
  .main_menu > li > a:hover  {
	  color: <?php echo $brad_data['nav_font_hover_color'];?>
  }

  ul.main_menu > li > a:after{
	  background-color:<?php echo $brad_data['nav_font_hover_color'];?>;
  }

  .main_menu > li.current-menu-item a:after,
  .main_menu > li.current-page-ancestor a:after,
  .main_menu > li.current-menu-ancestor a:after,
  .main_menu > li.current-menu-parent a:after,
  .main_menu > li.current_page_ancestor a:after,
  .main_menu > li.current-menu-item > a:after,
  .main_menu > li.current-menu-parent > a:after{
	  background-color:<?php echo $brad_data['nav_font_active_color'];?>;
	
  }

  .main_menu > li.current-menu-item a,
  .main_menu > li.current-menu-item a:hover,
  .main_menu > li.current-page-ancestor a,
  .main_menu > li.current-page-ancestor a:hover,
  .main_menu > li.current-menu-ancestor a,
  .main_menu > li.current-menu-ancestor a:hover,
  .main_menu > li.current-menu-parent a,
  .main_menu > li.current-menu-parent a:hover,
  .main_menu > li.current_page_ancestor a,
  .main_menu > li.current_page_ancestor a:hover
  .main_menu > li.current-menu-item > a,
  .main_menu > li.current-menu-parent > a  {
	   color: <?php echo $brad_data['nav_font_active_color'];?>;
}
<?php 
   $rgb  = brad_hex2rgb($brad_data['dropdown_background_color']);
   $rgba = 'rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].','.$brad_data['dropdown_background_opacity'].')'; 
?>
  .main_menu ul.sub-menu {
	background-color:<?php echo $brad_data['dropdown_background_color']?>;
	background-color:<?php echo $rgba;?>;
}
 .main_menu ul.sub-menu li{
	 border-bottom-color:<?php echo $brad_data['dropdown_menu_border_color'];?>
 }
 .main_menu ul.sub-menu li a {
	color:<?php echo $brad_data['font_dropdown_color'];?>;
    font-size:<?php echo $brad_data['font_nav_dropdown']['font-size'];?>;
    font-weight:<?php echo $brad_data['font_nav_dropdown']['font-weight']; ?>; 
    font-family:<?php echo $brad_data['font_nav_dropdown']['font-family'];?>;
	text-transform:<?php echo $brad_data['font_nav_dropdown']['text-transform'];?>;
  }

  .main_menu .sub-menu li.current-menu-item > a,
  .main_menu .sub-menu li.current-menu-item > a:hover,
  .main_menu .sub-menu li.current_page_item > a,
  .main_menu .sub-menu li.current_page_item > a:hover{
	 color:<?php echo $brad_data['font_dropdown_active_color'];?>;
  }

  .brad-mega-menu .brad-megamenu-title{
	  color:<?php echo $brad_data['megamenu_title_color'];?>
  }
  .main_menu .sub-menu li a:hover {
	 color:<?php echo $brad_data['dropdown_font_hover_color'];?>;
	 background-color:<?php echo $brad_data['dropdown_bg_color_hover'];?>;
}

  .search-button,
  #toggle-menu .toggle-menu{
	 color:<?php echo $brad_data['search_button_color'];?>
  }

  .search-button:hover ,
  #toggle-menu .toggle-menu:hover{
	 color:<?php echo $brad_data['search_button_color_hover'];?>
  }

  #logo,
  ul.main_menu > li{
	  height:<?php echo $brad_data['header_height'];?>px;
	  max-height:<?php echo $brad_data['header_height'];?>px;
	  line-height:<?php echo $brad_data['header_height'];?>px;
 }


/*----------------------------------------------*/
/* titlebar Style
/*----------------------------------------------*/

 #titlebar {
	 <?php if( get_post_meta($brad_page_id,'brad_titlebar_bg_color',true) !== "") { echo ' background-color:'.get_post_meta($brad_page_id,'brad_titlebar_bg_color',true).';'; } else if ( isset($brad_data['titlebar_bg']['background-color'])) { echo ' background-color:'.$brad_data['titlebar_bg']['background-color']; } ?> ;
     <?php 
	  if( get_post_meta($brad_page_id,'brad_bg_image_titlebar',true) !== ''){
		  $img_id =   preg_replace('/[^\d]/', '',get_post_meta($brad_page_id,'brad_bg_image_titlebar',true));
		  $img = wp_get_attachment_image_src ( $img_id ,'');?>
	  background-image:url("<?php echo $img[0];?>");
	  <?php } else if( $brad_data['titlebar_bg']['background-image'] != '') { ?>
	  background-image:url("<?php echo $brad_data['titlebar_bg']['background-image'];?>");
      <?php } ?>
	  background-attachment: <?php echo $brad_data['titlebar_bg']['background-attachment'];?>;
	  -webkit-background-size: <?php echo $brad_data['titlebar_bg']['background-size'];?>;
	  -moz-background-size: <?php echo $brad_data['titlebar_bg']['background-size'];?>;
	  -o-background-size: <?php echo $brad_data['titlebar_bg']['background-size'];?>;
	  background-size: <?php echo $brad_data['titlebar_bg']['background-size'];?>;
	  background-repeat: <?php echo $brad_data['titlebar_bg']['background-repeat'];?>;
	  background-position:<?php echo $brad_data['titlebar_bg']['background-position'];?>;
	  border-top:<?php echo $brad_data['border_titlebar_top']['border-top'];?> <?php echo $brad_data['border_titlebar_top']['border-style'];?> <?php echo $brad_data['border_titlebar_top']['border-color'];?>;
	  border-bottom:<?php echo $brad_data['border_titlebar_bottom']['border-top'];?> <?php echo $brad_data['border_titlebar_bottom']['border-style'];?> <?php echo $brad_data['border_titlebar_bottom']['border-color'];?>;
	  padding-top:<?php echo $brad_data['titlebar-padding-top'];?>px;
	  padding-bottom:<?php echo $brad_data['titlebar-padding-bottom'];?>px;
   }
   
 #titlebar.style2 .container > .row-fluid{
	  <?php if(get_post_meta(get_the_ID(),'brad_title_height',true) !== ''): ?>height:<?php echo get_post_meta(get_the_ID(),'brad_title_height',true);?>;
	  min-height:<?php echo get_post_meta(get_the_ID(),'brad_title_height',true);?>;
	<?php endif; ?>  
  }
  
 #titlebar .titlebar-content > h1 {
	  font-family:<?php echo $brad_data['font_titlebarheadline']['font-family']; ?>;
	  font-weight:<?php echo $brad_data['font_titlebarheadline']['font-weight']; ?>;
	  font-size:<?php echo $brad_data['font_titlebarheadline']['font-size'];?>;
	  color:<?php  echo $brad_data['font_titlebarheadline']['color'];?>
  }
 
 #titlebar.style2 .titlebar-content > h1{
	  font-family:<?php echo $brad_data['font_titlebarheadline_style2']['font-family']; ?>;
	  font-weight:<?php echo $brad_data['font_titlebarheadline_style2']['font-weight']; ?>;
	  font-size:<?php echo $brad_data['font_titlebarheadline_style2']['font-size'];?>;
	  line-height:<?php echo $brad_data['font_titlebarheadline_style2']['line-height'];?>;
	  color:<?php echo $brad_data['font_titlebarheadline_style2']['color'];?>
 }
 
<?php $rgb  = brad_hex2rgb($brad_data['titlebar_oc']);
      $rgba = 'rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].','.$brad_data['titlebar_oco'].')'; ?>  
 #titlebar .titlebar-overlay {
	 background-color:<?php echo $rgba;?>;
 }
  #titlebar #breadcrumbs {
	  color:<?php echo $brad_data['font_breadcrumb']['color'];?>;
	  font-size:<?php echo $brad_data['font_breadcrumb']['font-size'];?>;
  }
  #titlebar #breadcrumbs a{
	  color:<?php echo $brad_data['font_breadcrumb_link_color'];?>;
  }
  #titlebar #breadcrumbs a:hover{
	  color:<?php echo $brad_data['font_breadcrumb_link_color_hover'];?>;
  }
  

/*----------------------------------------------*/
/* Sidebar Healine
/*----------------------------------------------*/
  .sidebar .widget > h3{
     color:<?php echo $brad_data['sidebar_headline_font_color']?>;
     font-size:<?php echo $brad_data['sidebar_headline_font']['font-size']?>;
     font-family:<?php echo $brad_data['sidebar_headline_font']['font-family']?>,sans-serif;
     font-weight:<?php echo $brad_data['sidebar_headline_font']['font-weight']?>;
	 letter-spacing:<?php echo $brad_data['sidebar_headline_font']['letter-spacing']?>;
  }


/*-------------------------------------------------*/
/* Overlay and buttons
*---------------------------------------------------*/
<?php $rgb = brad_hex2rgb($brad_data['color_bgoverlay']); $rgba = 'rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].','.$brad_data['opacity_bgoverlay'].')'; ?>
  .overlay{
	  background-color:<?php echo $brad_data['color_bgoverlay']?>;
	  background-color:<?php echo $rgba;?>;
}

  .button , input[type="submit"] {
	  background-color:<?php echo $brad_data['color_buttonbg']['from'];?>;
	  color:<?php echo $brad_data['color_buttontext'];?>;
 	  background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, <?php echo $brad_data['color_buttonbg']['from'];?>), color-stop(100%, <?php echo $brad_data['color_buttonbg']['to'];?>));
      background-image: -webkit-linear-gradient(<?php echo $brad_data['color_buttonbg']['from'];?>,<?php echo $brad_data['color_buttonbg']['to'];?>);
      background-image: -moz-linear-gradient(<?php echo $brad_data['color_buttonbg']['from'];?>,<?php echo $brad_data['color_buttonbg']['to'];?>);
      background-image: -o-linear-gradient(<?php echo $brad_data['color_buttonbg']['from'];?>,<?php echo $brad_data['color_buttonbg']['to'];?>);
      background-image: linear-gradient(<?php echo $brad_data['color_buttonbg']['from'];?>,<?php echo $brad_data['color_buttonbg']['to'];?>);
}

   a.readmore{
	  font-family:<?php echo $brad_data['font_readmore']['font-family'];?>;
	  font-weight:<?php echo $brad_data['font_readmore']['font-weight'];?>;
	  letter-spacing:<?php echo $brad_data['font_readmore']['letter-spacing'];?>;
	  font-size:<?php echo $brad_data['font_readmore']['font-size'];?>;
}

/*---------------------------------------------------*/
/* Footer Styles
/*---------------------------------------------------*/

  #footer{
    color: <?php echo $brad_data['color_footertext'] ?>;
    background-color:<?php echo $brad_data['color_footerbg'] ?>;
    border-bottom: <?php echo $brad_data['border_footerbottom']['border-top'] ?> <?php echo $brad_data['border_footerbottom']['border-style'] ?> <?php echo $brad_data['border_footerbottom']['border-color'] ?>;
    border-top:<?php echo $brad_data['border_footertop']['border-top'] ?> <?php echo $brad_data['border_footertop']['border-style'] ?> <?php echo $brad_data['border_footertop']['border-color'] ?>;
	font-size:<?php echo $brad_data['fontsize_footer'];?>px;
}

 #copyright{
	 font-size:<?php echo $brad_data['fontsize_footer'];?>px;
 }
  #footer .widget_tag_cloud a ,
  #footer .social-icons a{
	 color: <?php echo $brad_data['color_footerlink']?>;
	 border-color: <?php echo $brad_data['color_footerlink']?>;
  }
 
  #footer .widget_tag_cloud a:hover,
  #footer .social-icons a:hover{
	 color:<?php echo $brad_data['color_footerlinkhover']?>;
	 border-color:<?php echo $brad_data['color_footerlinkhover']?>;
  }
  #footer .widget > ul > li ,
  #footer .widget_nav_menu ul li {
      border-bottom:1px solid <?php echo $brad_data['color_footerdivider'];?>;
  }
  #footer  .widget_nav_menu ul ul{
	  border-top:1px solid <?php echo $brad_data['color_footerdivider'];?>;
  }
  
  .footer-menu > li{
	  border-right:1px solid <?php echo $brad_data['color_footerdivider'];?>;
  }
  #footer .widget-posts li .date {
      color : <?php echo $brad_data['color_footertext'] ?>;
  }
  #footer a:link, #footer a, #footer a:visited, #footer a:active{
      color:<?php echo $brad_data['color_footerlink']?>;
  }
  #footer a:hover, #footer .widget_tag_cloud a:hover, .widget_tag_cloud a:hover{
      color:<?php echo $brad_data['color_footerlinkhover']?>;
  }
  #footer .widget_tag_cloud a:hover{
      color:<?php echo $brad_data['color_footerlinkhover']?>;
  }
  #footer .widget h4 {
     color:<?php echo $brad_data['font_footerheadline']['color'] ?>!important;
     font-family:<?php echo $brad_data['font_footerheadline']['font-family'] ?>,sans-serif;
     font-weight:<?php echo $brad_data['font_footerheadline']['font-weight'] ?>;
     font-size:<?php echo $brad_data['font_footerheadline']['font-size'] ?>;
	 letter-spacing:<?php echo $brad_data['font_footerheadline']['letter-spacing'] ?>;
	 text-transform:<?php echo $brad_data['font_footerheadline']['text-transform'] ?>;
  }
  #copyright {
	 background:<?php echo $brad_data['bg_color_copyright']?>;
	 color: <?php echo $brad_data['color_copyright']?>;
  }
  #copyright a ,
  .footer-menu > li a {
	  color:<?php echo $brad_data['color_copyrightlink']?>;
  }
  #copyright a:hover ,
  .footer-menu > li a:hover ,
  {
	 color: <?php echo $brad_data['color_copyrightlinkhover']?>;
  }
  #copyright .social-icons li a ,
  .footer-menu > li a{
	 color: <?php echo $brad_data['color_copyright']?>;
 }
 #copyright .social-icons li a:hover,
 .footer-menu > li a:hover {
	 color:<?php echo $brad_data['color_copyrightlinkhover']?>!important;
 }


/*--------------------------------------------*/
/* Color Primary
/*--------------------------------------------*/

  .special_amp,
  .side-navigation > li.current_page_item > a,
  .side-navigation > li > a:hover,
  ul.styled-list li i ,
  .single-image .image-lightbox:hover .brad-icon,
  .toggle .toggle-title a:hover ,
  .accordion .accordion-title a:hover,
  .highlighted,
  .latest-posts > li .latest-posts-content h5 a:hover,
  .page-nav a.next:hover ,
  .page-nav a.prev:hover ,
  .social-icons a:hover,
  .products .product .price,
  .woocommerce-pagination .page-numbers li a.next:hover, .woocommerce-pagination .page-numbers li a.prev:hover,
  .star-rating,
  .shop_table .remove:hover,
  .form-row label .required,
  .single-product-tabset .comment-form label .required,
  ul.product_list_widget li .amount,
  ul.product_list_widget li a:hover
  {
	  color:<?php echo $brad_data['color_primary'];?>;
  }
  
  
  .portfolio-tabs ul li.sort-item.active a ,
  .toggle .toggle-title.active a,
  .accordion .accordion-title.active a,
  .post-meta-data span a:hover,
  .color-primary,
  .primary-color{
	  color:<?php echo $brad_data['color_primary'];?>!important;
  }
  
  .portfolio-tabs ul li.sort-item.active a:after
  {
	  background-color:<?php echo $brad_data['color_primary'];?>!important;
  }
  
  .pricing-table .pricing-column .title-box {
	  border-top-color:<?php echo $brad_data['color_primary'];?>
  }
  .tooltips a{
	  border-bottom-color:<?php echo $brad_data['color_primary'];?>
  }
  ul.styled-list li i,
  ul.styled-list.style2 li i,
  .highlighted.style2,
  .social-icons a:hover,
  .shop_table .remove:hover
  {
	  border-color:<?php echo $brad_data['color_primary'];?>;
  }
  
  ul.styled-list.style2 li i,
  .progress .bar,
  .page-nav  a:hover,
  .css_spinner .side .fill,
  .button.button_alternateprimary:after,
  .product-wrapper .onsale ,
  .single-product-wrapper .onsale,
  .widget_price_filter .price_slider_wrapper .price_slider .ui-slider-handle{
	  background-color:<?php echo $brad_data['color_primary'];?>;
  }

<?php echo $brad_data['custom_css']; ?>
</style>

<?php
}
add_action( 'wp_head', 'brad_custom_css_styles', 100 );