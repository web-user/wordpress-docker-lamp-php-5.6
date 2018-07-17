<?php
/**
 *
 * RS Space
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_button( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
  'id'               => '',
  'class'            => '',
  'size'             => 'v-large',
  'btn_text'         => '',
  'btn_link'         => '',
  'bg_color'         => '',
  'bg_hover_color'   => '',
  'text_color'       => '',
  'font_size'        => '',
  'text_hover_color' => ''
  ), $atts ) );

  $id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class        = ( $class ) ? ' '. marketing_sanitize_html_classes($class) : '';
  $customize    = ($bg_color || $bg_hover_color || $text_color || $text_hover_color || $font_size) ? true:false;
  $uniqid_class = '';
  if (function_exists('vc_parse_multi_attribute')) {
    $parse_args = vc_parse_multi_attribute($btn_link);
    $href       = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
    $title      = ( isset($parse_args['title']) ) ? $parse_args['title'] : 'button';
    $target     = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
  }

  if($customize) {
    $uniqid       = magplus_tabindex();
    $custom_style = '';

    $custom_style .=  '.custom-btn-properties-'.$uniqid.'{';
    $custom_style .=  ($font_size) ? 'font-size:'.$font_size.' !important;':'';
    $custom_style .=  ($text_color) ? 'color:'.$text_color.' !important;':'';
    $custom_style .=  ($bg_color) ? 'background:'.$bg_color.' !important;':'';
    $custom_style .=  ($bg_color) ? 'border-color:'.$bg_color.' !important;':'';
    $custom_style .= '}';

    if($text_hover_color || $bg_hover_color) {
      $custom_style .=  '.custom-btn-properties-'.$uniqid.':hover {';
      $custom_style .=  ($text_hover_color) ? 'color:'.$text_hover_color.' !important;':'';
      $custom_style .=  ($bg_hover_color) ? 'border-color:'.$bg_hover_color.' !important;':'';
      $custom_style .= '}';
    }

    if($bg_hover_color) {
      $custom_style .=  '.custom-btn-properties-'.$uniqid.':before {';
      $custom_style .=  ($bg_hover_color) ? 'background:'.$bg_hover_color.' !important;':'';
      $custom_style .= '}';
    }

    magplus_add_inline_style( $custom_style );

    $uniqid_class = ' custom-btn-properties-'. $uniqid;
  }

  return '<a '.$id.' class="c-btn type-1 c-btn-auto '.$size.' style-2 color-2'.$uniqid_class.'" target="'.esc_attr($target).'" title="'.esc_attr($title).'" href="'.esc_html($href).'"><span>'.esc_html($btn_text).'</span></a>';
}

add_shortcode('rs_button', 'rs_button');
