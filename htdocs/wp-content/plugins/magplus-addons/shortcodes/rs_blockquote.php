<?php
/**
 *
 * RS Space
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_blockquote( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'    => '',
    'class' => '',
    'cite'  => '',
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';
  
  $output  =  '<div class="simple-text">';
  $output .=  '<blockquote '.$id.' class="magplus-pro-quote'.$class.'">';
  $output .=  '<p>“'.esc_html($content).'”</p>';
  $output .=  '<footer><cite title="'.esc_html($cite).'">'.esc_html($cite).'</cite></footer>';
  $output .=  '</blockquote>';
  $output .=  '</div>';

  return $output;
}

add_shortcode('rs_blockquote', 'rs_blockquote');
