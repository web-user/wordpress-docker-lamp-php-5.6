<?php
/**
 *
 * RS Slider
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_slider( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'       => '',
    'class'    => '',
    'autoplay' => '5000',
    'loop'     => '1'

  ), $atts ) );

  wp_enqueue_script('swiper');
  wp_enqueue_style('swiper'); 

  $id     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class  = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $output = '<div '.$id.' class="tt-post-img tt-slider-content swiper-container'.$class.'" data-autoplay="'.esc_attr($autoplay).'" data-loop="'.esc_attr($loop).'" data-speed="500" data-center="0" data-slides-per-view="1" data-sm-slides="1" data-md-slides="1" data-xs-slides="1">';
  $output .=  '<div class="swiper-wrapper">';
  $output .=  do_shortcode(wp_kses_data($content));
  $output .=  '</div>';
  $output .=  '<div class="pagination c-pagination hidden-lg"></div>';
  $output .=  '<div class="swiper-arrow-left-content c-arrow left hidden-xs hidden-sm"><i class="fa fa-angle-left" aria-hidden="true"></i></div>';
  $output .=  '<div class="swiper-arrow-right-content c-arrow right hidden-xs hidden-sm"><i class="fa fa-angle-right" aria-hidden="true"></i></div>';
  $output .=  '</div>';

  return $output;
}

add_shortcode('rs_slider', 'rs_slider');

function rs_slider_item($atts, $content = '') {
  global $is_container;

  $output  = '<div class="swiper-slide">';
  $output .=  do_shortcode($content);
  $output .=  '</div>';

  return $output;
}
add_shortcode('rs_slider_item', 'rs_slider_item');
