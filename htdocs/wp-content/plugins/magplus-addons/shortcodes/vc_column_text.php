<?php
/**
 *
 * VC Column Text
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function vc_column_text( $atts, $content = '', $id = '' ){

  extract( shortcode_atts( array(
    'id'              => '',
    'class'           => '',
    'dp_text_size'    => '',
    'wrap_with_class' => 'yes',
    
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';
  
  $output = '';
  $output .= ($wrap_with_class == 'yes') ? '<div class="text-block'.$class.'" '.$id.'>':'';
  $output .= ($wrap_with_class == 'yes') ? '<div class="simple-text '.sanitize_html_class($dp_text_size).'">':'';
  $output .= rs_set_wpautop($content);
  $output .=  ($wrap_with_class == 'yes') ? '</div></div>':'';

  return $output;
}
add_shortcode( 'vc_column_text', 'vc_column_text');

