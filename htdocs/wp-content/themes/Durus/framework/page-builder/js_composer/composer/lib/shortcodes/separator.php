<?php
class WPBakeryShortCode_VC_Separator extends WPBakeryShortCode {

   public function outputTitle($title) {
        return '';
    }

  protected function content( $atts , $content = null , $helper = false) {

	$output = '';
    extract(shortcode_atts(array(
	    'type'  => 'large' , 
		'style' => 'normal' ,
		'align' => 'center' , 
		'color' => 'light',
		'icon' => '' ,
		'margin_top' => 2 , 
		'margin_bottom' => 25 ),
		$atts));

	$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'hr border-'.$type.' '.$style.'-border align'.$align.' hr-border-'.$color.'', $this->settings['base']);
	
	if($icon != '' ){
		$css_class .= ' hr-with-icon';
	}
	
	$style = "margin-top:{$margin_top}px;margin-bottom:{$margin_bottom}px;";
				
	$output .= '<div  class="'.$css_class.'" style="'.$style.'"><span>'.brad_icon($icon,'','',false).'</span></div>'.$this->endBlockComment('separator')."\n";
	return $output;	
  }	
  	
 
}



class WPBakeryShortCode_VC_Text_separator extends WPBakeryShortCode {

  public function outputTitle($title) {
        return '';
    }
	
 protected function content( $atts , $content = null,$helper = false){
	$output = $title = $style = $description_align = $top_subtitle = $bottom_subtitle = $el_class = $extra_large_text = '';
    extract(shortcode_atts(array(
      'title' => 'Title',
      'description_align' => 'align_center',
	  'top_subtitle' => '' ,
	  'bottom_subtitle' => '' ,
	  'style' => 'style1' ,
	  'excerpt' => '' ,
	  'extra_large_title' => 'no' ,
      'el_class' => ''
       ), $atts));
   
   $el_class = $this->getExtraClass($el_class);
   $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'separator_text clearfix '.$style.$el_class, $this->settings['base']);
   $output .= '<div class="'.$css_class.'"><div class="big-title extra-large-text-'.$extra_large_title.'"><div>';
   if($top_subtitle != '') { $output .= '<h4 class="first-title"><span>'.$top_subtitle.'</span></h4>';}
   $output .= '<span>'.$title.'</span>';
   if($bottom_subtitle != '' && $style == 'style1') { $output .= '<h4 class="last-title"><span>'.$bottom_subtitle.'</span></h4>';}
   $output .= '</div></div>';
   if( $content != "") {$output .= '<p class="'.$description_align.'">'.wpb_js_remove_wpautop($content).'</p>';}
   $output .= '</div>'.$this->endBlockComment('separator')."\n";
   return $output;
  }	

}