<?php
/**
 * WPBakery Visual Composer shortcodes
 *
 * @package WPBakeryVisualComposer
 *
 */

class WPBakeryShortCode_VC_Column extends WPBakeryShortCode {
    protected  $predefined_atts = array(
        'el_class' => '',
        'el_position' => '',
        'width' => '1/1'
    );
    public function getColumnControls($controls, $extended_css = '') {
        $controls_start = '<div class="controls controls_column'.(!empty($extended_css) ? " {$extended_css}" : '').'">';
        $controls_end = '</div>';
        
        if ($extended_css=='bottom-controls') $control_title = sprintf(__('Append to this %s', "brad-framework"), strtolower($this->settings('name')));
        else $control_title = sprintf(__('Prepend to this %s', "brad-framework"), strtolower($this->settings('name')));
        
        $controls_add = ' <a class="column_add" href="#" title="'.$control_title.'"></a>';
        $controls_edit = ' <a class="column_edit" href="#" title="'.sprintf(__('Edit this %s', "brad-framework"), strtolower($this->settings('name'))).'"></a>';

       return $controls_start .  $controls_add . $controls_edit . $controls_end;
    }
    public function singleParamHtmlHolder($param, $value) {
        $output = '';
        // Compatibility fixes.
        $old_names = array('yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange');
        $new_names = array('alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning');
        $value = str_ireplace($old_names, $new_names, $value);
        //$value = __($value, "brad-framework");
        //
        $param_name = isset($param['param_name']) ? $param['param_name'] : '';
        $type = isset($param['type']) ? $param['type'] : '';
        $class = isset($param['class']) ? $param['class'] : '';

        if ( isset($param['holder']) == true && $param['holder'] != 'hidden' ) {
            $output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">'.$value.'</'.$param['holder'].'>';
        }
        return $output;
    }

    public function contentAdmin($atts, $content = null) {
        $width = $el_class = '';
        extract(shortcode_atts($this->predefined_atts, $atts));
        $output = '';

        $column_controls = $this->getColumnControls($this->settings('controls'));
        $column_controls_bottom =  $this->getColumnControls('add', 'bottom-controls');

        if ( $width == 'column_14' || $width == '1/4' ) {
            $width = array('vc_span3');
        }
        else if ( $width == 'column_14-14-14-14' ) {
            $width = array('vc_span3', 'vc_span3', 'vc_span3', 'vc_span3');
        }

        else if ( $width == 'column_13' || $width == '1/3' ) {
            $width = array('vc_span4');
        }
        else if ( $width == 'column_13-23' ) {
            $width = array('vc_span4', 'vc_span8');
        }
        else if ( $width == 'column_13-13-13' ) {
            $width = array('vc_span4', 'vc_span4', 'vc_span4');
        }

        else if ( $width == 'column_12' || $width == '1/2' ) {
            $width = array('vc_span6');
        }
        else if ( $width == 'column_12-12' ) {
            $width = array('vc_span6', 'vc_span6');
        }

        else if ( $width == 'column_23' || $width == '2/3' ) {
            $width = array('vc_span8');
        }
        else if ( $width == 'column_34' || $width == '3/4' ) {
            $width = array('vc_span9');
        }
        else if ( $width == 'column_16' || $width == '1/6' ) {
            $width = array('vc_span2');
        } else if ( $width == 'column_56' || $width == '5/6' ) {
            $width = array('vc_span10');
        } else {
            $width = array('');
        }
        for ( $i=0; $i < count($width); $i++ ) {
            $output .= '<div '.$this->mainHtmlBlockParams($width, $i).'>';
            $output .= str_replace("%column_size%", wpb_translateColumnWidthToFractional($width[$i]), $column_controls);
            $output .= '<div class="wpb_element_wrapper">';
            $output .= '<div '.$this->containerHtmlBlockParams($width, $i).'>';
            $output .= do_shortcode( shortcode_unautop($content) );
            $output .= '</div>';
            if ( isset($this->settings['params']) ) {
                $inner = '';
                foreach ($this->settings['params'] as $param) {
                    $param_value = isset($$param['param_name']) ? $$param['param_name'] : '';
                    if ( is_array($param_value)) {
                        // Get first element from the array
                        reset($param_value);
                        $first_key = key($param_value);
                        $param_value = $param_value[$first_key];
                    }
                    $inner .= $this->singleParamHtmlHolder($param, $param_value);
                }
                $output .= $inner;
            }
            $output .= '</div>';
            $output .= str_replace("%column_size%", wpb_translateColumnWidthToFractional($width[$i]), $column_controls_bottom);
            $output .= '</div>';
        }
        return $output;
    }
    public function customAdminBlockParams() {
        return '';
    }

    public function mainHtmlBlockParams($width, $i) {
        return 'data-element_type="'.$this->settings["base"].'" data-vc-column-width="'.wpb_vc_get_column_width_indent($width[$i]).'" class="wpb_'.$this->settings['base'].' wpb_sortable '.$this->templateWidth().' wpb_content_holder"'.$this->customAdminBlockParams();
    }

    public function containerHtmlBlockParams($width, $i) {
        return 'class="wpb_column_container vc_container_for_children clearfix"';
    }

    public function template($content = '') {
        return $this->contentAdmin($this->atts);
    }

    protected function templateWidth() {
        return '<%= window.vc_convert_column_size(params.width) %>';
    }
	
	protected function content ( $atts , $content = null , $helper = false) {
      $output = $el_class = $width = '';
      extract(shortcode_atts(array(
         'el_class' => '',
		 'hide_under' => '',
         'width' => '1/1' ), $atts));

     $el_class = $this->getExtraClass($el_class);
     $width = str_replace('vc_' , '' , wpb_translateColumnWidthToSpan($width));
	 $hidden_class = '';
		if(!empty($hide_under)){
		  $hide_under = explode(",",$hide_under);
		  foreach($hide_under as $v){
			  $hidden_class .= ' hidden-'.$v;
		  }
		}
     $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width.$el_class.$hidden_class, $this->settings['base']);
     $output .= "\n\t".'<div class="'.$css_class.'">';
     $output .= "\n\t\t".'<div class="inner-content">';
     $output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
     $output .= "\n\t\t".'</div> '.$this->endBlockComment('.inner-content');
     $output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";
     return  $output;
	}
}


class WPBakeryShortCode_VC_Column_Inner extends WPBakeryShortCode_VC_Column {
    protected function getFileName() {
        return 'vc_column';
    }
}

vc_map( array(
  "name" => __("Column", "brad-framework"),
  "base" => "vc_column_inner",
  "class" => "",
  "icon" => "",
  "wrapper_class" => "",
  "controls"	=> "full",
  "allowed_container_element" => false,
  "content_element" => false,
  "is_container" => true,
  "params"=> array(
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "value" => "",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )
  ),
  "js_view" => 'VcColumnView'
) );