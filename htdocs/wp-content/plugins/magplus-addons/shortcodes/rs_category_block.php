<?php
/**
 *
 * RS Space
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_category_block( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'     => '',
    'class'  => '',
    'cats'   => 0,
    'image'  => '',
    'style'  => 'style1'
  ), $atts ) );

  $id     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class  = ( $class ) ? ' '. magplus_sanitize_html_classes($class) : ''; 

  $image_url        = rs_get_image_src($image);
  $id_cat_name      = get_cat_name($cats);
  $id_category_link = get_category_link($cats);
  $category_link    = (empty($id_category_link)) ? '#':$id_category_link;
  $category_name    = (empty($id_cat_name)) ? 'Category Block':$id_cat_name;

  $output = '';
  switch ($style) {
    case 'style1':
      if(is_numeric($cats) && !empty($image)):
        $output .=  '<div '.$id.' class="tt-category-block custom-hover-image tt-category-block-style1'.$class.'">';
        $output .=  '<div class="tt-category-block-inner bg" style="background-image:url('.esc_url($image_url).');">';
        $output .=  '<a href="'.esc_url($category_link).'"></a>';
        $output .=  '<div class="tt-category-text-style1">';
        $output .= '<h5 class="tt-category-title c-h5">'.esc_html($category_name).'</h5>';
        $output .=  '</div>';
        $output .=  '</div>';
        $output .=  '</div>';
        $output .=  '<div class="empty-space marg-xs-b15"></div>';
      endif;
      # code...
      break;

    case 'style2':
      if(is_numeric($cats)  && !empty($image)):
        $output .=  '<div '.$id.' class="tt-category-block custom-hover-image tt-category-block-style2'.$class.'">';
        $output .=  '<div class="tt-category-block-inner bg" style="background-image:url('.esc_url($image_url).');">';
        $output .=  '<a href="'.esc_url($category_link).'"></a>';
        $output .=  '<div class="tt-category-text-style2">';
        $output .=  '<h5 class="tt-category-title c-h5">'.esc_html($category_name).'</h5>';
        $output .=  '</div>';
        $output .=  '</div>';
        $output .=  '</div>';
        $output .=  '<div class="empty-space marg-xs-b15"></div>';
      endif;
      break;
    
    default:
      # code...
      break;
  }


  return $output;
}

add_shortcode('rs_category_block', 'rs_category_block');
