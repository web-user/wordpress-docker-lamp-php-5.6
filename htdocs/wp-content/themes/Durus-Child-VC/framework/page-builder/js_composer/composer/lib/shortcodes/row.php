<?php
/**
 * WPBakery Visual Composer row
 *
 * @package WPBakeryVisualComposer
 *
 */
 
 /**
 */



class WPBakeryShortCode_VC_Row extends WPBakeryShortCode {
    protected $predefined_atts = array(
        'el_class' => '',
    );



    /* This returs block controls
   ---------------------------------------------------------- */
    public function getColumnControls($controls, $extended_css = '') {
        global $vc_row_layouts;
        $controls_start = '<div class="controls controls_row clearfix">';
        $controls_end = '</div>';

        $right_part_start = '';//'<div class="controls_right">';
        $right_part_end = '';//'</div>';

        //Create columns
        $controls_center_start = '<span class="vc_row_layouts">';
        $controls_layout = '';
        foreach($vc_row_layouts as $layout) {
            $controls_layout .= '<a class="set_columns '.$layout['icon_class'].'" data-cells="'.$layout['cells'].'" data-cells-mask="'.$layout['mask'].'" title="'.$layout['title'].'"></a> ';
        }
        $controls_layout .= '<br/><a class="set_columns custom_columns" data-cells="custom" data-cells-mask="custom" title="'.__('Custom layout', "brad-framework").'">'.__('Custom layout', "brad-framework").'</a> ';
        $controls_move = ' <a class="column_move" href="#" title="'.__('Drag row to reorder', "brad-framework").'"></a>';
        $controls_delete = '<a class="column_delete" href="#" title="'.__('Delete this row', "brad-framework").'"></a>';
        $controls_edit = ' <a class="column_edit" href="#" title="'.__('Edit this row', "brad-framework").'"></a>';
        $controls_clone = ' <a class="column_clone" href="#" title="'.__('Clone this row', "brad-framework").'"></a>';
        $controls_center_end = '</span>';

        $row_edit_clone_delete = '<span class="vc_row_edit_clone_delete">';
        $row_edit_clone_delete .=  $controls_edit . $controls_clone . $controls_delete ;
        $row_edit_clone_delete .= '</span>';

        //$column_controls_full =  $controls_start. $controls_move . $controls_center_start . $controls_layout . $controls_delete . $controls_clone . $controls_edit . $controls_center_end . $controls_end;
        $column_controls_full =  $controls_start. $controls_move . $controls_center_start . $controls_layout . $controls_center_end . $row_edit_clone_delete . $controls_end;

        return $column_controls_full;
    }

    public function contentAdmin($atts, $content = null , $helper = false) {
        $width = $el_class = '';
        extract(shortcode_atts($this->predefined_atts, $atts));

        $output = '';

        $column_controls = $this->getColumnControls($this->settings('controls'));

        for ( $i=0; $i < count($width); $i++ ) {
            $output .= '<div'.$this->customAdminBockParams().' data-element_type="'.$this->settings["base"].'" class="wpb_'.$this->settings['base'].' wpb_sortable">';
            $output .= str_replace("%column_size%", 1, $column_controls);
            $output .= '<div class="wpb_element_wrapper">';
            $output .= '<div class="vc_row-fluid wpb_row_container vc_container_for_children">';
            if($content=='' && !empty($this->settings["default_content_in_template"])) {
                $output .= do_shortcode( shortcode_unautop($this->settings["default_content_in_template"]) );
            } else {
                $output .= do_shortcode( shortcode_unautop($content) );

            }
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
            $output .= '</div>';
        }

        return $output;
    }
    public function customAdminBockParams() {
        return '';
    }
	
	protected function content($atts , $content = null , $helper = false) {
		$output = $el_class = '';
        extract(shortcode_atts(array('el_class' => '','bottom_margin' => 'no'), $atts));
        $el_class = $this->getExtraClass($el_class);
        $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'row-fluid bottom-margin-'.$bottom_margin.' '.$el_class, $this->settings['base']);
        $output .= '<div class="'.$css_class.'">';
        $output .= wpb_js_remove_wpautop($content);
        $output .= '</div>'.$this->endBlockComment('row');
		return $output;
	}
}


class WPBakeryShortCode_VC_Row_Inner extends WPBakeryShortCode_VC_Row {
  
    public function template($content = '') {
        return $this->contentAdmin($this->atts);
    }
	protected function content($atts , $content = null , $helper = false) {
		$output = $el_class = '';
        extract(shortcode_atts(array('el_class' => '','bottom_margin' => 'no'), $atts));
        $el_class = $this->getExtraClass($el_class);
        $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'row-fluid inner-row bottom-margin-'.$bottom_margin.' '.$el_class, $this->settings['base']);
        $output .= '<div class="'.$css_class.'">';
        $output .= wpb_js_remove_wpautop($content);
        $output .= '</div>'.$this->endBlockComment('row');
		return $output;
	}
}



