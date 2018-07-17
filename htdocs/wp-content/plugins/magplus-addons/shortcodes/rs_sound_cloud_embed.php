<?php
/**
 *
 * RS Image Block
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_sound_cloud_embed( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'              => '',
    'class'           => '',
    'sound_cloud_url' => ''
  ), $atts ) );

  $id     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class  = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';
  $output = '';

  if(!empty($sound_cloud_url)){
    $output .=  '<div '.$id.' class="sound-cloud-embed'.$class.'">';
    $output .=  '<iframe height="166" src="'.esc_url($sound_cloud_url).'"></iframe>';
    $output .=  '</div>';
  }

  return $output;
}

add_shortcode('rs_sound_cloud_embed', 'rs_sound_cloud_embed');
