<?php
/* Toggle
------------------------------------------------------------*/

class WPBakeryShortCode_VC_Toggle extends WPBakeryShortCode {
    public function outputTitle($title) {
        return '';
    }
	
   protected function content ( $atts , $content = null , $helper = false){
     $output = $title = $el_class = $open = $css_animation = '';
       extract(shortcode_atts(array(
         'title' => __("Click to toggle", "brad-framework"),
         'el_class' => '',
		 'style' => 'style1',
		 'icon' => '' ,
         'open' => 'false',
         'css_animation' => ''
         ), $atts));
     $el_class = $this->getExtraClass($el_class);
     $open = ( $open == 'true' ) ? ' active' : '';
     $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'toggle '.$style.''.$el_class, $this->settings['base']);
     $css_class .= $this->getCSSAnimation($css_animation);
     $output .= '<div class="'.$css_class.'"><div class="toggle-title '.$open.'"><a href="#">'.brad_icon($icon).$title.'<span class="plus"></span></a></div>';
     $output .= '<div class="toggle-inner">'.wpb_js_remove_wpautop($content).'</div></div>'.$this->endBlockComment('toggle')."\n";
     return $output;
   }
   
}