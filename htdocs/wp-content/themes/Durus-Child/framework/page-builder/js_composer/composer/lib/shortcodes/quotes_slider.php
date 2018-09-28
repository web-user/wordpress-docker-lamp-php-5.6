<?php
/**
 */

class WPBakeryShortCode_VC_Quotes_Slider extends WPBakeryShortCode_VC_Tabs {
	
	function content( $atts , $content = null , $helper = false ){
		global $brad_includes;
		$output = '';
		extract(shortcode_atts(array(
	        'el_class'  =>  '',
			'autoplay' => 'no',
			'hide_icon' => 'no',
			'navigation' => 'yes' ,
			'navigation_align' => 'side' ,
			'interval' => '5000' ,
			'effect' => 'fade' 
	       ),$atts));
	    
		$output .= "\n\t".'<div class="quotes-slider-container navigation-align-'.$navigation_align.' hide-quote-icon-'.$hide_icon.'" data-navigation="'.$navigation.'" data-effect="'.$effect.'" data-autoplay="'.$autoplay.'" data-interval='.$interval.'>';
		$output .= "\n\t\t".'<span class="carousel-next"></span><span class="carousel-prev"></span>';
		$output .= "\n\t\t\t".'<ul class="quotes-slider" >';
		$output .= "\n\t\t\t\t".wpb_js_remove_wpautop($content);
		$output .= "\n\t\t\t".'</ul>';
		$output .= "\n\t".'</div>';
		$brad_includes['load_bxslider'] = true;
		return $output;
	}
 
}


class WPBakeryShortCode_VC_Quote extends WPBakeryShortCode{
	function content( $atts , $content = null , $helper = false ){
		$output = '';
		extract(shortcode_atts(array(
	        'logo'  =>  '',
			'person_name' => 'john doe',
			'person_desc' => '',
			'img_size' => '',
			'custom_img_size' => ''
	       ),$atts));
		   
		$output .= "\n\t".'<li class="quote-slider-item">';
		$output .= "\n\t\t".'<span class="quote-sign"><i class="ss-air ss-quote"></i></span><blockquote>'.wpb_js_remove_wpautop($content).'</blockquote>';
		
		if( $logo != ''){
			$img_id = preg_replace('/[^\d]/', '', $logo);
	        if($custom_img_size != '') {
		        $img_size = $custom_img_size;
	        }
           $img = wpb_getImageBySize(array( 'attach_id' => $img_id, 'thumb_size' => $img_size ));
           if ( $img == NULL ) $img['thumbnail'] = '<img src="http://placekitten.com/g/400/300" /> <small>'.__('This is image placeholder, edit your page to replace it.', "brad-framework").'</small>';
			$output .= '<div class="quote-logo">'.$img['thumbnail'].'</div>';
		}
		
		if( $person_name != '' || $person_desc != ''){
			$output .= '<cite>';
			if( $person_name != ''){
			    $output .= "\n\t\t\t".'<span class="quote-name">'.$person_name.'</span>';
			}
			if( $person_desc != ''){
			    $output .= "\n\t\t\t\t".'<span class="divider">&nbsp;'.__('-','brad').'&nbsp;</span><span class="quote-desc">'.$person_desc.'</span>';
			}
			$output .= '</cite>';
		}
		
		$output .= "\n\t".'</li>';  
		return $output;
	}
 
}