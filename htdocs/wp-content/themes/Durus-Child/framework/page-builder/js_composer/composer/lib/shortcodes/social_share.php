<?php
class WPBakeryShortCode_VC_Pinterest extends WPBakeryShortCode {
	protected function content ( $atts , $content = null , $helper = false ){
		$type = $params = $annotation = '';
        extract(shortcode_atts(array(
	           'type' => 'horizontal'
                ), $atts));

       $params .= ( $type != '' ) ? ' size="'.$type.'" ' : '';
       $params .= ( $annotation != '' ) ? ' annotation="'.$annotation.'"' : '';
       $url = rawurlencode(get_permalink());
       if ( has_post_thumbnail() ) {
	   $img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
	   $media = ( is_array($img_url) ) ? '&amp;media='.rawurlencode($img_url[0]) : '';
       } else {
	   $media = '';
       }
       
	   $description = ( get_the_excerpt() != '' ) ? '&amp;description='.rawurlencode(strip_tags(get_the_excerpt())) : '';
       $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'share-box '.$type, $this->settings['base']);
       $output .=  '<div class="'.$css_class.'">';
       $output .= '<a href="http://pinterest.com/pin/create/button/?url='.$url.$media.$description.'" class="pin-it-button" count-layout="'.$type.'"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>';
       $output .= '</div>'.$this->endBlockComment('pinterestShare')."\n";
       return $output;	
	}
}


class WPBakeryShortCode_VC_Tweetmeme extends WPBakeryShortCode {
	protected function content ( $atts , $content = null , $helper = false ){
		$type = '';
        extract(shortcode_atts(array(
		     'type' => 'horizontal'//horizontal, vertical, none
              ), $atts));

       $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'twitter-share-button', $this->settings['base']);
       $output = '<a href="http://twitter.com/share" class="'.$css_class.'" data-count="'.$type.'">'. __("Tweet", "brad-framework") .'</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>'.$this->endBlockComment('tweetmeme')."\n";
	   return $output;
	}
}

class WPBakeryShortCode_VC_Facebook extends WPBakeryShortCode {
	protected function content ( $atts , $content = null , $helper = false ){
		$type = $url = '';
       extract(shortcode_atts(array(
              'type' => 'standard',//standard, button_count, box_count
              'url' => ''
               ), $atts));
       if ( $url == '') $url = get_permalink();
       $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'fb_like wpb_content_element fb_type_'.$type, $this->settings['base']);
       $output = '<div class="'.$css_class.'"><iframe src="http://www.facebook.com/plugins/like.php?href='.$url.'&amp;layout='.$type.'&amp;show_faces=false&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div>'.$this->endBlockComment('fb_like')."\n";
        return $output;
	}
}

class WPBakeryShortCode_VC_GooglePlus extends WPBakeryShortCode {
	protected function content ( $atts , $content = null , $helper = false ){
	$type = $annotation = '';
    extract(shortcode_atts(array(
            'type' => '',
            'annotation' => ''
            ), $atts));

    $params = '';
    $params .= ( $type != '' ) ? ' size="'.$type.'" ' : '';
    $params .= ( $annotation != '' ) ? ' annotation="'.$annotation.'"' : '';

    if ( $type == '' ) $type = 'standard';
    $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_googleplus wpb_content_element wpb_googleplus_type_'.$type, $this->settings['base']);
    $output = '<div class="'.$css_class.'"><g:plusone'.$params.'></g:plusone></div>'.$this->endBlockComment('wpb_googleplus')."\n";
	return $output;

	}

}