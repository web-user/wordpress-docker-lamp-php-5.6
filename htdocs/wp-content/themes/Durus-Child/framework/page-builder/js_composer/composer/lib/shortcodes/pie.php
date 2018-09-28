<?php
class WPBakeryShortCode_Vc_Pie extends WPBakeryShortCode {
	
	protected function content ( $atts , $content = null , $helper = false) {
	        
	      global $brad_data ;	
          extract(shortcode_atts(array(
			"value" => '50',
			"size" => 'standard',
			"color" => '',
			"label_value" => '',
			"icon" => '' ,
			"placeincenter" => 'no' ,
			//'subtitle' => 'no',
			//"sub_label_value" => '',
			"el_class" => '' ,
			"track_color" => '',
			"bar_color" => ''
			), $atts));

         $el_class = $this->getExtraClass( $el_class );
		 $output = $linewidth = '';
		 $bar_color = $bar_color != '' ? $bar_color : $brad_data['color_primary'] ; 
		 $track_color = $track_color != '' ? $track_color : '#f4f4f4';
		 if ($size == "standard") { 
		    $linewidth = 4;
			 $pie_size = 80; 
			} 
		 else if ($size == "large") { 
		    $linewidth = 8; 
			 $pie_size = 280;
			}
		 else { 
		    $linewidth = 5;
		    $pie_size = 180; }
		  
         $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' chart-shortcode chart-'.$size.' chart-center-'.$placeincenter.'" data-linewidth="'.$linewidth.'" data-percent="0" data-animatepercent="'.$value.'" data-size="'.$pie_size.'" data-barcolor="'.$bar_color.'" data-trackcolor="'.$track_color.'"'.$el_class, $this->settings['base']);
    $output = "\n\t".'<div class="'.$css_class.'">';
	/*
	if( $subtitle != 'yes'){
		$sub_label_value = '';
	}
	else if( $subtitle == 'yes' && $sub_label_value != ''){
		$sub_label_value = '<span class="pie-subtitle">'.$sub_label_value.'</span>';
	}
	*/
	if( $label_value != '' ) { $output .= '<div class="pie-title">'.$label_value.'</div>' ; }
	else if ($icon != '') { $output .= '<div class="pie-title">'.brad_icon($icon,'','',false).'</div>'; }
	else { $output .= $sub_label_value; }
    $output .=  "\n\t".'</div>'.$this->endBlockComment('Pie chart')."\n";
    return $output;
   }
 }