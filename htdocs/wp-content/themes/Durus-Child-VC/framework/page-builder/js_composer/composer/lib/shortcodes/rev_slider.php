<?php
class WPBakeryShortCode_Rev_Slider_Vc extends WPBakeryShortCode {
	
	protected function content ( $atts , $content = null, $helper = false ){
		$output = $title = $alias = $el_class = '';
        extract( shortcode_atts( array(
                'title' => '',
                'alias' => '',
                'el_class' => ''
               ), $atts ) );

         $el_class = $this->getExtraClass($el_class);
         $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'rev-slider-wrapper'.$el_class, $this->settings['base']);
         $output .= '<div class="'.$css_class.'">';
         $output .= do_shortcode('[rev_slider '.$alias.']');
         $output .= '</div>'.$this->endBlockComment('wpb_revslider_element')."\n";
		 return $output;
	}
}