<?php
/**
 *
 * RS Space
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_divider( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'border_color'  => '',
    'margin_top'    => '',
    'margin_bottom' => '',
  ), $atts ) );

  $id            = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class         = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';
  $margin_top    = ( $margin_bottom ) ? ' margin-top:'.$margin_top.';':'';
  $margin_bottom = ( $margin_bottom ) ? ' margin-bottom:'.$margin_bottom.';':'';
  $border_color  = ( $border_color ) ? ' border-color:'.$border_color.';':'';
  $el_style      = ( $margin_top || $margin_bottom || $border_color ) ? ' style="'.esc_attr($margin_bottom.$margin_top.$border_color).'"':'';
  
  return '<div class="tt-devider'.$class.'"'.$id.$el_style.'></div>';
}

add_shortcode('rs_divider', 'rs_divider');
