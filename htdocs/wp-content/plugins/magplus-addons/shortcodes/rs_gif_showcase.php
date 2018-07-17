<?php
/**
 *
 * RS Image Block
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_gif_showcase( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'      => '',
    'class'   => '',
    'gif_url' => ''
  ), $atts ) );

  $id     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class  = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';
  $output = '';

  if(!empty($gif_url)){
    $output .=  '<div '.$id.' class="gif-showcase'.$class.'" style="background:#111;width:100%;position:relative; height:0; padding-bottom:99%;">';
    $output .=  '<iframe class="giphy-embed" width="100%"; height="100%" style="position:absolute;" src="'.esc_url($gif_url).'"></iframe>';
    $output .=  '</div><div class="marg-lg-b15"></div>';
  }

  return $output;
}

add_shortcode('rs_gif_showcase', 'rs_gif_showcase');
