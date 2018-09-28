<?php
class WPBakeryShortCode_VC_Box extends WPBakeryShortCode_VC_Column {
	 
	 public function getColumnControls($controls, $extended_css = '') {
        $controls_start = '<div class="controls controls_column'.(!empty($extended_css) ? " {$extended_css}" : '').'">';
        $controls_end = '</div>';
        
        if ($extended_css=='bottom-controls') $control_title = sprintf(__('Append to this %s', "brad-framework"), strtolower($this->settings('name')));
        else $control_title = sprintf(__('Prepend to this %s', "brad-framework"), strtolower($this->settings('name')));
        
        $controls_add = ' <a class="column_add" href="#" title="'.$control_title.'"></a>';
        $controls_edit = ' <a class="column_edit" href="#" title="'.sprintf(__('Edit this %s', "brad-framework"), strtolower($this->settings('name'))).'"></a>';
        $controls_clone = '<a class="column_clone" href="#" title="'.sprintf(__('Clone this %s', "brad-framework"), strtolower($this->settings('name'))).'"></a>';

        $controls_delete = '<a class="column_delete" href="#" title="'.sprintf(__('Delete this %s', "brad-framework"), strtolower($this->settings('name'))).'"></a>';
        return $controls_start .  $controls_add . $controls_edit . $controls_clone . $controls_delete . $controls_end;
    }
	
	 public function mainHtmlBlockParams($width, $i) {
        return 'data-element_type="'.$this->settings["base"].'" class="wpb_'.$this->settings['base'].' wpb_sortable wpb_content_holder"'.$this->customAdminBlockParams();
    }
	
	
	protected function content( $atts , $content = null , $helper = false){
		static $brad_box_id = 1;
		$output =  $style = '';
		extract(shortcode_atts(array(
		    'bg_color' => '' ,
			'opacity' => '1' ,
			'br_color' => '' ,
			'br_width' => 1 ,
			'br_top' => 'no' ,
			'br_bottom' => 'no' ,
			'padding' => '20',
			'color_scheme' => '',
			'hide_under' => '' ,
			'el_class' => ''
		),$atts));
		
		$el_class = $this->getExtraClass($el_class);
		$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'box '.$color_scheme.' border-bottom-radius-'.$br_bottom.' border-top-radius-'.$br_top.' '.$el_class , $this->settings['base']);
		
	    $style = "padding:{$padding};";
		$hidden_class = '';
		
		if(!empty($hide_under)){
		  $hide_under = explode(",",$hide_under);
		  foreach($hide_under as $v){
			  $hidden_class .= ' hidden-'.$v;
		  }
		}
		if( $bg_color != ''){
			$rgb = brad_hex2rgb($bg_color);
			$rgba = "rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},{$opacity})";
		    $style .= "background-color:{$bg_color};background-color:{$rgba};";
		}
		if( $br_color != ''){
		    $style .= "border:{$br_width}px solid {$br_color};";
		}
		
		$output .= "\n\t".'<div id="brad_box_'.$brad_box_id.'" class="'.$css_class.$hidden_class.' " style="'.$style.'">';
		$output .= "\n\t\t".wpb_js_remove_wpautop($content); 
		$output .= "\n\t".'</div>';
		$brad_box_id++;
		return $output;
	}
}
?>