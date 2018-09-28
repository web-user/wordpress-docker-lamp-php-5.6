<?php

/**
 * WPBakery Visual Composer shortcodes
 *
 * @package WPBakeryVisualComposer
 *
 */
 
class WPBakeryShortCode_VC_Cta_button extends WPBakeryShortCode {
	
   protected function content ( $atts , $content = null , $helper = false ) {
	$output = $color = $icon = $size = $target = $href = $title = $call_text = $position = $el_class = '';
    extract(shortcode_atts(array(
	 'color' => 'default',
	 'align' => 'center',
     'icon' => '',
     'size' => '',
     'target' => '',
     'href' => '',
     'title' => __('Text on the button', "brad-framework") ,
	 'second_color' => 'medium',
     'second_icon' => '',
     'second_size' => '',
     'second_target' => '',
     'second_href' => '',
     'second_title' => '',
     'call_text' => '',
     'el_class' => ''
      ), $atts));

     $el_class = $this->getExtraClass($el_class);


     if ( $target == 'same' || $target == '_self' ) { $target = ''; }
     if ( $target != '' ) { $target = ' target="'.$target.'"'; }	 
     $color = ( $color != '' ) ? ' button_'.$color : '';
     $size = ( $size != '' && $size != 'button_large' ) ? ' button_'.$size : ' '.$size;
	 
	 if($second_title != ""){
		 if ( $second_target == 'same' || $second_target == '_self' ) { $second_target = ''; }
         if ( $second_target != '' ) { $second_target = ' target="'.$second_target.'"'; }	 
         $second_color = ( $second_color != '' ) ? ' button_'.$second_color : '';
         $second_size = ' button_'.$second_size ;
	 }
	 
	 if( $title != ''){
     if ( $href != '' ) {
      $button = '<a class="button '.$color.$size.'" href="'.$href.'"'.$target.'>' . brad_icon($icon,'','',false).$title . '</a>';
     } else {
      $button = '<span class="button '.$color.$size.'">'.brad_icon($icon,'','',false).$title.'</span>';
     }
	 }
	 else
	 {
	 $button = '';
	 }
	 
	 
	 if( $second_title != ''){
     if ( $second_href != '' ) {
        $second_button = '<a class="button '.$second_color.$second_size.'" href="'.$second_href.'"'.$second_target.'>' . brad_icon($second_icon,'','',false).$second_title . '</a>';
     }
	 else {
        $second_button = '<span class="button '.$second_color.$second_size.'">'.brad_icon($second_icon,'','',false).$second_title.'</span>';
        }
	 }
	 else{
	   $second_button = '';
	 }
   
    $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'callout callout-align-'.$align.' '.$el_class, $this->settings['base']);
	
    $output .= "\n\t".'<div class="'.$css_class.'">';
	if( $align == 'justify'){
		$output .= $second_button.$button;
		if( $call_text != ''){
		$output .= '<h2>'. $call_text . '</h2>';
		}
	}
	else{
		$output .= '<h2>'. $call_text . $second_button  .$button .'</h2>';
	}
	if( $content != '') { $output .= '<div>'. wpb_js_remove_wpautop($content) .'</div>';}
    $output .= "\n\t".'</div>' . $this->endBlockComment('.call-to-action') . "\n";
    return $output;	
	}
}