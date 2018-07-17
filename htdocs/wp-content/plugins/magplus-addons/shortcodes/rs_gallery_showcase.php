<?php
/**
 *
 * RS Image Block
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_gallery_showcase( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'     => '',
    'class'  => '',
    'images' => '',
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : '';


  $output = '';
  if(!empty($images)) {

    wp_enqueue_script('swiper');
    wp_enqueue_style('swiper');

    $images = explode(',', $images);
    $output .= '<div '.$id.' class="tt-post-img swiper-container'.$class.'" data-autoplay="5000" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">';
    $output .=  '<div class="swiper-wrapper">';

    foreach ($images as $key => $image) {
      $image_src = wp_get_attachment_image_src( $image, 'full' );
      if(isset($image_src[0])) {
        $output .=  '<div class="swiper-slide active" data-val="'.esc_attr($key).'">';
        $output .=  '<a class="custom-hover" href="#">';
        $output .=  '<img class="img-responsive" src="'.esc_url($image_src[0]).'" height="465" width="823" alt="">';
        $output .=  '</a>';
        $output .=  '</div>';
      }
    }
                                      
    $output .=  '</div>';
    $output .=  '<div class="pagination c-pagination"></div>';
    $output .=  '<div class="swiper-arrow-left c-arrow size-2 left hidden-xs hidden-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>';
    $output .=  '<div class="swiper-arrow-right c-arrow size-2 right hidden-xs hidden-sm"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>';
    $output .=  '</div>';    
  }

  return $output;
}

add_shortcode('rs_gallery_showcase', 'rs_gallery_showcase');
