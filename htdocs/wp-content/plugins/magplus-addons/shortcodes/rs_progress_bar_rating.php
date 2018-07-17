<?php
/**
 *
 * RS Progress Rating bar
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_progress_bar_rating( $atts, $content = '', $id = '' ) {
  
  global $rs_progress_bar_rating;
  $rating_total           = '';
  $rs_progress_bar_rating = array();

  extract( shortcode_atts( array(
    'id'           => '',
    'class'        => '',
    'summary_text' => ''
  ), $atts ) );

  do_shortcode( $content );

  if( empty( $rs_progress_bar_rating ) ) { return; }
  $count   = count( $rs_progress_bar_rating );

  $output          = '';
  $progress_output = array();
  $id     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class  = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  foreach ($rs_progress_bar_rating as $key => $bar) {
    $rating_label  = (isset($bar['atts']['rating_label'])) ? $bar['atts']['rating_label']:'';
    $rating_number = (isset($bar['atts']['rating_number'])) ? $bar['atts']['rating_number']:'0';
    $percent       = ($rating_number * 10);

    $progress_output[$key]  = '<div class="tt-progress-title">'.esc_html($rating_label).' </div>';
    $progress_output[$key] .= '<div class="tt-progress-number">'.esc_html($rating_number).'</div>';
    $progress_output[$key] .=  '<div class="progress tpl-progress">';
    $progress_output[$key] .=  '<div class="progress-bar" role="progressbar" aria-valuenow="'.esc_attr($percent).'" aria-valuemin="0" aria-valuemax="100">';
    $progress_output[$key] .=  '</div>';
    $progress_output[$key] .=  '</div>';

    $rating_total += $rating_number;
  }


  $output .=  '<div '.$id.' class="tt-rating'.$class.'">';

  $output .=  '<div class="tt-rating-progress">';
  if(is_array($progress_output) && !empty($progress_output)) {
    for($i = 0; $i < count($progress_output); $i++) {
      $output .= $progress_output[$i];
    }
  }
  $output .=  '</div>';

  $output .= '<div class="tt-rating-content">';

  $output .= '<div class="row">';  


  $output .= '<div class="col-md-10 col-xs-12">';  
  $output .= '<div class="tt-summary-title"><h4 class="c-h5">'.esc_html__('Summary', 'magplus-pro-addons').'</h4></div><div class="empty-space marg-lg-b5"></div>';
  $output .= '<div class="tt-summary-text simple-text"><p>'.wp_kses_post($summary_text).'</p></div>';
  $output .=  '</div>';

  $output .= '<div class="col-md-2 text-right col-xs-12">';
  $output .= '<div class="empty-space marg-xs-b15"></div>';  
  $output .= '<div class="tt-rating-title"><h4 class="c-h5">'.esc_html__('Total Rating', 'magplus-pro-addons').'</h4></div><div class="empty-space marg-lg-b10"></div>';
  $output .=  '<div class="tt-rating-text">'.number_format(($rating_total / $count), 1).'</div>'; 
  $output .=  '</div>';  

  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '</div>';

  return $output;

}
add_shortcode('rs_progress_bar_rating', 'rs_progress_bar_rating');

/**
 *
 * RS Progress Bar Item
 * @version 1.0.0
 * @since 1.0.0
 *
 */
function rs_progress_bar_rating_item( $atts, $content = '', $id = '' ) {
  global $rs_progress_bar_rating;
  $rs_progress_bar_rating[]  = array( 'atts' => $atts, 'content' => $content );
  return;
}
add_shortcode('rs_progress_bar_rating_item', 'rs_progress_bar_rating_item');
