<?php 


/* Gap 
----------------------------------------------------*/

  class WPBakeryShortCode_VC_Gap extends WPBakeryShortCode {

    protected function content( $atts, $content = null , $helper = false) {
	$output = '';
	extract(shortcode_atts(array('height' => '20','hide_under' => ''),$atts));
	$hidden_class = '';
		if(!empty($hide_under)){
		  $hide_under = explode(",",$hide_under);
		  foreach($hide_under as $v){
			  $hidden_class .= ' hidden-'.$v;
		  }
		}
	$output .= "<div class=\"gap {$hidden_class}\" style=\"height:{$height}px;line-height:{$height}px;\" ></div>".$this->endBlockComment('.gap')."\n";
	return $output;
  }
}


/* Heading
----------------------------------------------------*/

  class WPBakeryShortCode_VC_Heading extends WPBakeryShortCode {
	
	 public function outputTitle($title) {
        return '';
    }  

    protected function content( $atts, $content = null , $helper = false ) { 
	extract(shortcode_atts(array('type' => 'h1' ,'style'=>'' , 'color' => 'default' , 'text_transform' => 'default' , 'align' => 'left' , 'title' => 'Your title here' , 'margin_bottom' => '20px' , 'divider_color' => 'dark' , 'divider_width' => 'default'),$atts));
	$output = "\n\t".'<'.$type.' class="title text'.$align.' '.$style.' divider-'.$divider_color.' divider-'.$divider_width.' text'.$text_transform.' color-'.$color.'" style="margin-bottom:'.$margin_bottom.'px">';
	$output .= '<span>'.$title.'</span>';
	$output .= "\n\t".'</'.$type.'>'.$this->endBlockComment('heading')."\n";
	return $output;
 
	}
}

?>