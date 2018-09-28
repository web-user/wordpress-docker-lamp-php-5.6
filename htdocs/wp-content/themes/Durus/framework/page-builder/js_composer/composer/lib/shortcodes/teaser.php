<?php
class WPBakeryShortCode_VC_Teaser_Box extends WPBakeryShortCode {
  	
  function content ( $atts , $content = null , $helper = false){
	$output =  '';
    extract(shortcode_atts(array(
      'image' => '' ,
      'title'  => '',
	  'text_scheme' => 'default' 
       ), $atts));
 
	$img_id = preg_replace('/[^\d]/', '', $image);
	$img = wpb_getImageBySize(array( 'attach_id' => $img_id, 'thumb_size' => '' ));
 
   
    $output .= "\n\t".'<div class="teaser">';
    $output .= "\n\t\t".'<div class="image hoverlay">'. $img['thumbnail'];
	$output .= "\n\t\t\t".'<div class="overlay"></div><div class="box '.$text_scheme.'">';
	if($title != ''){
		$output .= '<h2 class="teaser-heading"><span>'. $title .'</span></h2>';
	}
	if( $content != ''){
	    $output .= "\n\t\t\t\t".'<div class="teaser-content">'. wpb_js_remove_wpautop($content) .'</div>';
	}
    $output .= "\n\t".'</div></div></div> '.$this->endBlockComment('.image');
    return $output;	
	}
}