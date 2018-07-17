<?php
/**
 *
 * RS Image Block
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_about_us_block( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'        => '',
    'class'     => '',
    'style'     => 'style1',
    'image'     => '',
    'signature' => '',
    'heading'   => '',
    'link'      => '',
    'height'    => ''
  ), $atts ) );

  $id     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class  = ( $class ) ? ' '. videoly_sanitize_html_classes($class) : '';
  $height = ( !empty($height) ) ? 'height:'.esc_html($height).';':'';

  if (function_exists('vc_parse_multi_attribute')) {
    $parse_args = vc_parse_multi_attribute($link);
    $href       = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
    $title      = ( isset($parse_args['title']) ) ? $parse_args['title'] : 'button';
    $target     = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
  }

  $output = '';

  if ( is_numeric( $image ) && !empty( $image ) ) {
  $image_src = wp_get_attachment_image_src( $image, 'full' );
  if(isset($image_src[0])) {
      $output .=  '<div '.$id.' class="tt-border-block about-us-block '.$style.$class.'">';
      if(!empty($heading)):
        $output .=  '<div class="tt-title-block type-2">';
        $output .=  '<h3 class="tt-title-text">'.esc_html($heading).'</h3>';
        $output .=  '</div>';
        $output .=  '<div class="empty-space marg-lg-b15"></div>';
      endif;

      $output .=  '<div class="tt-about">';
      $output .=  '<div class="tt-about-block custom-hover-image">';
      $output .=  '<a class="img-border custom-hover bg" href="'.esc_url($href).'" target="'.esc_attr($target).'" style="background-image:url('.esc_url($image_src[0]).');'.$height.'">';
      $output .=  '</a>';
      $output .=  '</div>';
      $output .=  '<div class="simple-text">';
      $output .=  '<p>'.esc_html($content).'</p>';
      $output .=  '</div>';
      if(is_numeric($signature) && !empty($signature)) {
        $signature_src = wp_get_attachment_image_src( $signature, 'full' );
        if(isset($signature_src[0])) {
          $output .=  '<img class="img-responsive center-block" src="'.esc_url($signature_src[0]).'" height="67" width="104" alt="">';
        }
      }
      $output .=  '</div>';
      $output .=  '</div>';
    }
  }

  return $output;
}

add_shortcode('rs_about_us_block', 'rs_about_us_block');
