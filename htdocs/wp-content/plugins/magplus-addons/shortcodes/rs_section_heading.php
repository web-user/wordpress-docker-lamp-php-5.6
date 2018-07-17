<?php
/**
 *
 * RS Space
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_section_heading( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                     => '',
    'class'                  => '',
    'heading'                => '',
    'style'                  => 'style1',
    'primary_border_color'   => '',
    'secondary_border_color' => '',
    'background_color'       => '',
    'text_color'             => '',
    'link'                   => '',
  ), $atts ) );

  if (function_exists('vc_parse_multi_attribute')) {
    $parse_args = vc_parse_multi_attribute($link);
    $href       = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
    $title      = ( isset($parse_args['title']) ) ? $parse_args['title'] : 'button';
    $target     = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
  }

  $id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class        = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';
  $customize    = ( $primary_border_color || $secondary_border_color || $background_color || $text_color ) ? true:false;
  $output       = '';
  $uniqid_class = '';

  if( $customize ) {

    $uniqid       = magplus_tabindex();
    $custom_style = '';

    $custom_style .=  '.custom-color-properties-'.$uniqid.':after {';
    $custom_style .=  ($secondary_border_color) ? 'background:'.$secondary_border_color.' !important;':'';
    $custom_style .= '}';


    $custom_style .=  '.custom-color-properties-'.$uniqid.' .tt-title-text {';
    $custom_style .=  ($primary_border_color && $style == 'style2') ? 'border-color:'.$primary_border_color.' !important;':'';
    $custom_style .=  ($text_color) ? 'color:'.$text_color.' !important;':'';
    $custom_style .=  ($background_color && $style == 'style4' || $style == 'style5' || $style == 'style6') ? 'background:'.$background_color.' !important;':'';
    $custom_style .= '}';


    if($primary_border_color && $style == 'style1') {
      $custom_style .=  '.custom-color-properties-'.$uniqid.' .tt-title-text:after,
      .custom-color-properties-'.$uniqid.' .tt-title-text:before {';
      $custom_style .=  ($primary_border_color) ? 'background:'.$primary_border_color.' !important;':'';
      $custom_style .= '}';
    }

    if($style == 'style5') {
      $custom_style .=  '.custom-color-properties-'.$uniqid.' .tt-title-text:after {';
      $custom_style .=  ($background_color) ? 'border-color:transparent transparent transparent '.$background_color.' !important;':'';
      $custom_style .= '}';
    }

    if($primary_border_color && $style == 'style3' || $style == 'style4' || $style == 'style5') {
      $custom_style .=  '.custom-color-properties-'.$uniqid.' {';
      $custom_style .=  ($primary_border_color) ? 'border-color:'.$primary_border_color.' !important;':'';
      $custom_style .=  ($background_color && $style == 'style3') ? 'background:'.$background_color.' !important;':'';
      $custom_style .= '}';
    }

    magplus_add_inline_style( $custom_style );

    $uniqid_class = ' custom-color-properties-'. $uniqid;

  }

  $output .=  '<div '.$id.' class="tt-title-block'.$uniqid_class.' '.$style.$class.'">';
  $output .=  '<h3 class="tt-title-text">';
  $output .=  (!empty($href)) ? '<a href="'.esc_url($href).'" target="'.esc_attr($target).'">':'';
  $output .=  esc_html($heading);
  $output .=  (!empty($href)) ? '</a>':'';
  $output .=  '</h3></div><div class="empty-space  marg-lg-b25">';
  $output .=  '</div>';

  return $output;
}

add_shortcode('rs_section_heading', 'rs_section_heading');
