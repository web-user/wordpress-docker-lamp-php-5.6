<?php
/**
 *
 * RS Space
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_wp_post_gallery_video( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'widget_title' => '',
    'post_id'      => '',
  ), $atts ) );

  ob_start();
  the_widget('magplus_WP_Post_Gallery_Widget', array('title' => $widget_title, 'category' => $post_id)); 
  $output = ob_get_clean();

  return $output;
  
}

add_shortcode('rs_wp_post_gallery_video', 'rs_wp_post_gallery_video');
