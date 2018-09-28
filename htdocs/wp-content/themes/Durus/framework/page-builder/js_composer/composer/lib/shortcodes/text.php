<?php
class WPBakeryShortCode_VC_Column_text extends WPBakeryShortCode {
	protected function outputTitle($title) {
        return  '';
    }
	
	protected function content ( $atts , $content = null , $helper = false) {
	    $output = $el_class = $css_animation = '';
        extract(shortcode_atts(array(
		        'el_class' => '',
		        'css_animation' => '' ), $atts));
        $el_class = $this->getExtraClass($el_class);
        $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'column-text clearfix'.$el_class, $this->settings['base']);
        $css_class .= $this->getCSSAnimation($css_animation);
        $output .= "\n\t".'<div class="'.$css_class.'">';
        $output .= "\n\t\t".wpb_js_remove_wpautop($content);
        $output .= "\n\t".'</div> ' . $this->endBlockComment('.column-text');
        return $output;	
	}
}