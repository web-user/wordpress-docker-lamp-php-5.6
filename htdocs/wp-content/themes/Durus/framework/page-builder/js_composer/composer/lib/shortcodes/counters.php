<?php

/*Feature Boxes
------------------------------------------------*/

class WPBakeryShortCode_VC_Counters extends WPBakeryShortCode_VC_Feature_Boxes {
	
  protected function content($atts , $content = null , $helper = false) {
	$output = $columns = $style = $bg_type = '';
	static $counter_id = 1;
    extract(shortcode_atts(array(
	  'columns' => '2' , 
	  'style' => 'style1',
	  'bottom_margin' => '',  
	  'bg_color' => '#ffffff' , 
	  'bg_opacity' => "1",
	  "bg_shadow" => "no" ,
	  'inner_vpadding' => "default" ,
	  'inner_hpadding' => "default" ,
	  'border_color' => '' ,
	  'bg_radius' => 'yes' ,
	  'bg_radius_full' => 'no' ,
	  'padding' => ''
	   ),$atts));

     if($columns == '' || empty($columns)) { $columns = 2; }
	 $bottom_margin = $bottom_margin == 0 ? 0 : $bottom_margin.'px';
	 
	 
	 if( ( $bg_color != '' || $border_color != '' ) && $style == 'style3' ){
	        $output .= "<style type='text/css'>#counter_{$counter_id} .span .inner-content{";
			if( $bg_color != '' ){
		        $rgb = brad_hex2rgb($bg_color);
		        $rgba = "rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},{$bg_opacity})";
		        $output .= "background-color:{$rgba};";
			}
			if( $border_color != '' ){
		        $output .= "border-color:{$border_color};";
			}
			$output .= "}</style>";	
	     }
	 
	
	 
     $output .= '<div id="counter_'.$counter_id.'" class="row-fluid counters element-inner-vertical-padding-'.$inner_vpadding.' element-inner-horizental-padding-'.$inner_hpadding.'  '.$style.' element-padding-'.$padding.' '.$bg_type.' columns-'.$columns.' background-shadow-'.$bg_shadow.' background-radius-'.$bg_radius.' background-radius-full-'.$bg_radius_full.'" style="margin-bottom:'.$bottom_margin.'">';
     $output .= wpb_js_remove_wpautop($content);
     $output .= '</div>'.$this->endBlockComment('counters')."\n";
	 $counter_id++;
     return $output;	
	} 
}

/*Feature Box
--------------------------------------------------------------*/

class WPBakeryShortCode_VC_Counter extends WPBakeryShortCode {
	
 protected function content ( $atts , $content = null , $helper = false ) {
		$output = $title = $value = $unit = '';
        extract(shortcode_atts(array(
		'title' =>  '' , 
		'value' =>  '' , 
		'value_color' => '',
		'icon' => '' ,
		'icon_color' => '',
		'css_animation' => '' ,
	    'css_animation_delay' => '0' , 
		'unit' =>  '' ,  
		 ),$atts));
		 $icon = brad_icon($icon , 'color-'.$icon_color);
         $output = '<div class="span"><div class="inner-content '.$this->getCSSAnimation($css_animation).'" data-animation-delay="'. $css_animation_delay .'" data-animation-effect="'. $css_animation.'"><div class="counter-box">';
		 $output .= $icon ;
		 $output .= '<div class="counter-title">';
		 $output .= '<span class="color-'.$value_color.'"><span data-percentage="'.trim($value).'">'.$value.'</span>'.$unit.'</span>';
		 if($title != '') {
	       $output .= '<p>'.$title.'</p>';
		 }
         $output .= '</div></div></div></div>';
         return $output;
 }
    
}