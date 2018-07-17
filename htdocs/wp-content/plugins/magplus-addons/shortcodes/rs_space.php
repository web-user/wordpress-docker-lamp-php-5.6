<?php
/**
 *
 * RS Space
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_space( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'        => '',
    'class'     => '',
    'lg_device' => '',
    'md_device' => '',
    'sm_device' => '',
    'xs_device' => '',
  ), $atts ) );

  $id              = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class           = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';
  $lg_device_class = ($lg_device) ? ' marg-lg-b'.$lg_device:'';
  $md_device_class = ($md_device) ? ' marg-md-b'.$md_device:'';
  $sm_device_class = ($sm_device) ? ' marg-sm-b'.$sm_device:'';
  $xs_device_class = ($xs_device) ? ' marg-xs-b'.$xs_device:'';

  return '<div '.$id.' class="empty-space '.$lg_device_class.$md_device_class.$sm_device_class.$xs_device_class.$class.'"></div>';
}

add_shortcode('rs_space', 'rs_space');
