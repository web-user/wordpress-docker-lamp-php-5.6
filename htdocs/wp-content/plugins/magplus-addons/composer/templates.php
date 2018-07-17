<?php

/**
 *
 * VC Custom Templates
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_vc_templates() {
  
  $templates = array();
  
  $data = array();
  $data['name'] = esc_html__( 'Post Slider 1', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0011_12.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post-slider';
  $data['content'] = <<<CONTENT
  [vc_row][vc_column][rs_slider][rs_slider_item][rs_post_grid_series style="style3" orderby="title" post_per_page="5"][/rs_slider_item][/rs_slider][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data; 


  $data = array();
  $data['name'] = esc_html__( 'Post Slider 2', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0003_4.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post-slider';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_slider][rs_slider_item][rs_featured_blog style="style2" post_per_page="3"][/rs_slider_item][/rs_slider][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Post Slider 3', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0005_6.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post-slider';
  $data['content'] = <<<CONTENT
[vc_row  class="tt-post-card-slider"][vc_column][rs_slider][rs_slider_item][rs_post_card][/rs_slider_item][/rs_slider][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;
    

  $data = array();
  $data['name'] = esc_html__( 'Post Style 1', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0012_13.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_hand_picked_blog post_per_page="4"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;

  $data = array();
  $data['name'] = esc_html__( 'Post Style 2', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0009_10.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post';
  $data['content'] = <<<CONTENT
[vc_row][vc_column width="1/2"][rs_section_heading style="style4" heading="Travel & Beyond" primary_border_color="#4cd964" secondary_border_color="#4cd964" text_color="#ffffff" background_color="#4cd964"][rs_post_grid_series style="style2" post_per_page="3"][/vc_column][vc_column width="1/2"][rs_section_heading style="style4" heading="Culture & Arts" primary_border_color="#8e8e93" secondary_border_color="#8e8e93" text_color="#ffffff" background_color="#8e8e93"][rs_post_grid_series style="style2" post_per_page="3"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Post Style 3', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0007_8.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_post_grid_series style="style3" post_per_page="5"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;



  $data = array();
  $data['name'] = esc_html__( 'Post Style 4', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0006_7.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_featured_blog style="style2" orderby="title"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Post Style 5', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0005_6.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_post_card][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;

  $data = array();
  $data['name'] = esc_html__( 'Post Style 6', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0004_5.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_recent_news post_per_page="3"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Post Style 7', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0001_2.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_featured_blog orderby="modified" post_per_page="3"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Post Style 8', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0002_3.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_post_grid orderby="author" post_per_page="4"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;  

  $data = array();
  $data['name'] = esc_html__( 'Post Style 9', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0000_1.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_featured_blog orderby="title" post_per_page="1"][rs_hand_picked_blog post_per_page="4"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Post Style 10', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  //$data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0006_7.png' );
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0020_20.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_hand_picked_blog style="style2"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;

  $data = array();
  $data['name'] = esc_html__( 'Post Style 11', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0016_29.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_weekly_7_blog ][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Post Style 12', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0013_14.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_post_movie][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Post Style 13', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0022_22.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_hand_picked_blog post_per_page="4"][rs_hand_picked_blog post_per_page="4"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Post Tab 1', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0008_9.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post-tab';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][vc_tta_tabs active_color="#b5b5b5" text_color="#ffffff"][vc_tta_section title="All"][rs_hand_picked_blog style="style2" orderby="title" post_per_page="5"][/vc_tta_section][vc_tta_section title="Celebrity "][rs_hand_picked_blog style="style2" orderby="title" post_per_page="5"][/vc_tta_section][vc_tta_section title="Lifestyle "][rs_hand_picked_blog style="style2" orderby="title" post_per_page="5"][/vc_tta_section][vc_tta_section title="Travel"][rs_hand_picked_blog style="style2" orderby="title" post_per_page="5"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Post Tab 2', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0018_18.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general post-tab';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][vc_tta_tabs active_color="#01bd5d" text_color="#ffffff"][vc_tta_section title="Anroid"][rs_post_grid ][rs_space lg_device="60" md_device="" sm_device="30" xs_device=""][/vc_tta_section][vc_tta_section title="iOS"][rs_post_grid ][rs_space lg_device="60" md_device="" sm_device="30" xs_device=""][/vc_tta_section][vc_tta_section title="Samsung"][rs_post_grid ][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Newsletter', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0010_11.png' );
  $data['sort_name'] = 'Post';
  $data['custom_class'] = 'general newsletter';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_newsletter style="style2" image="1115" heading="We send Love Letters — Weekly." email_placeholder="Email" btn_placeholder="Sign Up Now" background_color="#eaeaea"]Get your inbox filled with best contents all around the globe. Be blessed.[/rs_newsletter][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;

  $data = array();
  $data['name'] = esc_html__( 'Category Block 1', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0021_17.png' );
  $data['sort_name'] = 'Category Block';
  $data['custom_class'] = 'general category-block';
  $data['content'] = <<<CONTENT
[vc_row][vc_column width="1/4"][rs_category_block image="http://themebubble.com/demo/magpluspro/foodpro/wp-content/uploads/sites/6/2017/04/8.png"][/vc_column][vc_column width="1/4"][rs_category_block image="http://themebubble.com/demo/magpluspro/foodpro/wp-content/uploads/sites/6/2017/04/8.png"][/vc_column][vc_column width="1/4"][rs_category_block image="http://themebubble.com/demo/magpluspro/foodpro/wp-content/uploads/sites/6/2017/04/8.png"][/vc_column][vc_column width="1/4"][rs_category_block image="http://themebubble.com/demo/magpluspro/foodpro/wp-content/uploads/sites/6/2017/04/8.png"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;

  $data = array();
  $data['name'] = esc_html__( 'Category Block 2', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0015_28.png' );
  $data['sort_name'] = 'Category Block';
  $data['custom_class'] = 'general category-block';
  $data['content'] = <<<CONTENT
[vc_row][vc_column width="1/4"][rs_category_block style="style2" image="http://themebubble.com/demo/magpluspro/blogpro/wp-content/uploads/sites/11/2017/06/Death_to_Stock_Tactile_3.jpg"][/vc_column][vc_column width="1/4"][rs_category_block style="style2" image="http://themebubble.com/demo/magpluspro/blogpro/wp-content/uploads/sites/11/2017/07/magnus-lindvall-4407-min.jpg"][/vc_column][vc_column width="1/4"][rs_category_block style="style2" image="http://themebubble.com/demo/magpluspro/blogpro/wp-content/uploads/sites/11/2017/03/instax-1.png"][/vc_column][vc_column width="1/4"][rs_category_block style="style2" image="http://themebubble.com/demo/magpluspro/blogpro/wp-content/uploads/sites/11/2017/06/Death_to_stock_BMX1_8.jpg"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Youtube Video Playist', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0019_19.png' );
  $data['sort_name'] = 'Video Playlist';
  $data['custom_class'] = 'general video-playist';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_youtube_video_playlist channel_id="UC1aJuxLHlw8bBV6mfCqVfog"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Post Video Playist', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0014_15.png' );
  $data['sort_name'] = 'Video Playlist';
  $data['custom_class'] = 'general video-playist';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_post_video_playlist post_per_page="6"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Heading 1', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0028_27.png' );
  $data['sort_name'] = 'Heading';
  $data['custom_class'] = 'general heading';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_section_heading style="style1" heading="Heading Style One"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Heading 2', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0027_21.png' );
  $data['sort_name'] = 'Heading';
  $data['custom_class'] = 'general heading';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_section_heading style="style2" heading="Heading Style Two"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Heading 3', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0026_23.png' );
  $data['sort_name'] = 'Heading';
  $data['custom_class'] = 'general heading';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_section_heading style="style3" heading="Heading Style Three"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Heading 4', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0025_24.png' );
  $data['sort_name'] = 'Heading';
  $data['custom_class'] = 'general heading';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_section_heading style="style4" heading="Heading Style Four"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Heading 5', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0024_25.png' );
  $data['sort_name'] = 'Heading';
  $data['custom_class'] = 'general heading';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_section_heading style="style5" heading="Heading Style Five"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Heading 6', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0023_26.png' );
  $data['sort_name'] = 'Heading';
  $data['custom_class'] = 'general heading';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_section_heading style="style6" heading="Heading Style Six"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;

  $data = array();
  $data['name'] = esc_html__( 'Video Block', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/_0055_56.jpg' );
  $data['sort_name'] = 'Misc';
  $data['custom_class'] = 'general misc';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_video_block video_url="https://player.vimeo.com/video/171807697?color=f561af&badge=0"][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;


  $data = array();
  $data['name'] = esc_html__( 'Space', 'magplus-pro-addons' );
  $data['disabled'] = true; 
  $data['image_path'] = preg_replace( '/\s/', '%20',  plugins_url('/assets/img/templates', __FILE__) . '/36.jpg' );
  $data['sort_name'] = 'Misc';
  $data['custom_class'] = 'general misc';
  $data['content'] = <<<CONTENT
[vc_row][vc_column][rs_space lg_device="35" md_device="" sm_device="" xs_device=""][/vc_column][/vc_row]
CONTENT;
  $templates[] = $data;

  return $templates;
}

/**
 *
 * Remove All VC Templates
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_reset_default_templates( $data ) {
  return array(); 
}
add_filter( 'vc_load_default_templates', 'rs_reset_default_templates' );

/**
 *
 * Load Templates
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_add_default_templates() {
  $templates = rs_vc_templates();
  return array_map( 'vc_add_default_templates', $templates );
}
rs_add_default_templates();