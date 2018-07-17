<?php
/**
 *
 * RS Tabs
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_tabs( $atts, $content = '', $id = '' ) {

  global $rs_tabs;
  $rs_tabs = array();

  extract( shortcode_atts( array(
    'id'           => '',
    'class'        => '',
    'active'       => 1,
    'active_color' => '',
    'text_color'   => '',
  ), $atts ) );

  do_shortcode( $content );

  if( empty( $rs_tabs ) ) { return; }

  $output       = '';
  $id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class        = ( $class ) ? ' '. marketing_sanitize_html_classes($class) : '';
  $customize    = ( $active_color || $text_color ) ? true:false;
  $uniqid_class = '';


  if($customize) {
    $uniqid       = magplus_tabindex();
    $custom_style = '';

    $custom_style .=  '.custom-color-properties-'.$uniqid.' .tt-nav-tab-item.active {';
    $custom_style .=  ($active_color) ? 'background:'.$active_color.' !important;':'';
    $custom_style .=  ($text_color) ? 'color:'.$text_color.' !important;':'';
    $custom_style .= '}';

    magplus_add_inline_style( $custom_style );

    $uniqid_class = ' custom-color-properties-'. $uniqid;
  }

  $output .=  '<div '.$id.' class="tt-tab-wrapper'.$uniqid_class.' tt-blog-tab '.$class.'">';
  $output .=  '<div class="tt-tab-nav-wrapper">';

  $output .=  '<div class="tt-nav-tab mbottom50">';
  $output .=  '<div class="empty-space marg-lg-b25">';
  foreach( $rs_tabs as $key => $tab) {
    $title      = esc_html($tab['atts']['title']);
    $active_nav = ( ( $key + 1 ) == $active ) ? ' active ' : '';
    $output     .=  '<div class="tt-nav-tab-item'.$active_nav.'">';
    $output     .=  '<span class="tt-analitics-text">'.esc_html($title).'</span>';
    $output     .=  '</div>';
  }

  $output .=  '</div>';
  $output .=  '</div>';

  $output .=  '<div class="tt-tabs-content clearfix">';

  foreach( $rs_tabs as $key => $tab) {
    $active_nav = ( ( $key + 1 ) == $active ) ? ' active ' : '';
    $output .=  '<div class="tt-tab-info'.$active_nav.'">';
    $output .= do_shortcode(wp_kses_post($tab['content']));
    $output .=  '</div>';
  }

  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '</div>';



  return $output;

}
add_shortcode('vc_tta_tabs', 'rs_tabs');

/**
 *
 * RS Tab
 * @version 1.0.0
 * @since 1.0.0
 *
 */
function rs_tab( $atts, $content = '', $id = '' ) {
  global $rs_tabs;
  $rs_tabs[]  = array( 'atts' => $atts, 'content' => $content );
  return;
}
add_shortcode('vc_tta_section', 'rs_tab');
