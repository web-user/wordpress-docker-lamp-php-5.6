<?php
/**
 *
 * RS Image Block
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_image_block( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'           => '',
    'class'        => '',
    'image'        => '',
    'align'        => '',
    'photo_credit' => ''
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';
  $align = ($align) ? ' align="'.magplus_sanitize_html_classes($align).'"':'';

  $output = '';
  if ( is_numeric( $image ) && !empty( $image ) ) {
    $image_src = wp_get_attachment_image_src( $image, 'full' );
    if(isset($image_src[0])) {
      $output  =  '<div '.$id.' class="simple-img'.$class.'"'.$align.'>';
      $output .=  '<img class="img-responwsive" src="'.esc_url($image_src[0]).'" height="440" width="392" alt="">';
      $output .=  '<div class="simple-img-desc">';
      if(!empty($photo_credit)):
        $output .=  '<span>'.esc_html__('Photo Credit:', 'magplus-pro-addons').'</span>';
        $output .=  '<a href="#"> '.esc_html($photo_credit).'</a>';
      endif;
      $output .=  '</div>';
      $output .=  '</div>';
    }
  }

  return $output;
}

add_shortcode('rs_image_block', 'rs_image_block');
