<?php
/**
 * WPBakery Visual Composer shortcodes
 *
 * @package WPBakeryVisualComposer
 *
 */

class WPBakeryShortCode_VC_Accordion_tab extends WPBakeryShortCode_VC_Tab {
    
	protected  $predefined_atts = array(
        'el_class' => '',
        'width' => '',
        'title' => ''
    );
	
    public function contentAdmin($atts, $content = null) {
        $width = $el_class = $title = '';
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
        }
        else {
            $width = array('');
        }


        for ( $i=0; $i < count($width); $i++ ) {
            $output .= '<div class="group wpb_sortable">';
                $output .= '<h3><span class="tab-label"><%= params.title %></span></h3>';
                $output .= '<div '.$this->mainHtmlBlockParams($width, $i).'>';
                    $output .= str_replace("%column_size%", wpb_translateColumnWidthToFractional($width[$i]), $column_controls);
                    $output .= '<div class="wpb_element_wrapper">';
                        $output .= '<div '.$this->containerHtmlBlockParams($width, $i).'>';
                            $output .= do_shortcode( shortcode_unautop($content) );
                            $output .= WPBakeryVisualComposer::getInstance()->getLayout()->getContainerHelper();
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
            $output .= '</div>';
        }
        return $output;
    }

    public function mainHtmlBlockParams($width, $i) {
        return 'data-element_type="'.$this->settings["base"].'" class=" wpb_'.$this->settings['base'].'"'.$this->customAdminBlockParams();
    }
    public function containerHtmlBlockParams($width, $i) {
        return 'class="wpb_column_container vc_container_for_children"';
    }

    public function contentAdmin_old($atts, $content = null) {
        $width = $el_class = $title = '';
        extract(shortcode_atts($this->predefined_atts, $atts));
        $output = '';
        $column_controls = $this->getColumnControls($this->settings('controls'));
        for ( $i=0; $i < count($width); $i++ ) {
            $output .= '<div class="group wpb_sortable">';
            $output .= '<div class="wpb_element_wrapper">';
            $output .= '<div class="vc_row-fluid wpb_row_container">';
            $output .= '<h3><a href="#">'.$title.'</a></h3>';
            $output .= '<div '.$this->customAdminBockParams().' data-element_type="'.$this->settings["base"].'" class=" wpb_'.$this->settings['base'].' wpb_sortable">';
            $output .= '<div class="wpb_element_wrapper">';
            $output .= '<div class="vc_row-fluid wpb_row_container">';
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
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
        }

        return $output;
    }

    protected function outputTitle($title) {
        return  '';
    }

    public function customAdminBlockParams() {
        return '';
    }
	
	protected function content ( $atts , $content = null , $helper = false ) {
	 $output = '';	
	 extract(shortcode_atts(array(
       'title' => __('Section','brad'),
	   'icon' => '' ,
       'el_class' => ''), $atts));

       $el_class = $this->getExtraClass($el_class);
       $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'accordion '.$el_class.' not-column-inherit', $this->settings['base']);
      $output .= "\n\t".'<div class="'.$css_class.'">';       //data-interval="'.$interval.'"
      $output .= "\n\t\t".'<div class="accordion-title"><a href="#">'.brad_icon($icon).$title.'<span class="plus"></span></a></div>';
      $output .= "\n\t\t\t".'<div class="accordion-inner">'. wpb_js_remove_wpautop($content) .'</div>';
      $output .= "\n\t".'</div> '.$this->endBlockComment('.accordion');
      return $output;	
	}
}

class WPBakeryShortCode_VC_Accordion extends WPBakeryShortCode {

    public function __construct($settings) {
        parent::__construct($settings);
        // WPBakeryVisualComposer::getInstance()->addShortCode( array( 'base' => 'vc_accordion_tab' ) );
    }



    public function contentAdmin( $atts, $content ) {
        $width = $custom_markup = '';
        $shortcode_attributes = array('width' => '1/1');
        foreach ( $this->settings['params'] as $param ) {
            if ( $param['param_name'] != 'content' ) {
                if (isset($param['value']) && is_string($param['value']) ) {
                    $shortcode_attributes[$param['param_name']] = $param['value'];
                } elseif(isset($param['value'])) {
                    $shortcode_attributes[$param['param_name']] = $param['value'];
                }
            } else if ( $param['param_name'] == 'content' && $content == NULL ) {
                $content = __($param['value'], "brad-framework");
            }
        }
        extract(shortcode_atts(
            $shortcode_attributes
            , $atts));

        $output = '';

        $elem = $this->getElementHolder($width);

        $inner = '';
        foreach ($this->settings['params'] as $param) {
            $param_value = '';
            $param_value = isset($$param['param_name']) ? $$param['param_name'] : '';
            if ( is_array($param_value)) {
                // Get first element from the array
                reset($param_value);
                $first_key = key($param_value);
                $param_value = $param_value[$first_key];
            }
            $inner .= $this->singleParamHtmlHolder($param, $param_value);
        }
        //$elem = str_ireplace('%wpb_element_content%', $iner, $elem);
        $tmp = '';
        // $template = '<div class="wpb_template">'.do_shortcode('[vc_accordion_tab title="New Section"][/vc_accordion_tab]').'</div>';

        if ( isset($this->settings["custom_markup"]) && $this->settings["custom_markup"] != '' ) {
            if ( $content != '' ) {
                $custom_markup = str_ireplace("%content%", $tmp.$content, $this->settings["custom_markup"]);
            } else if ( $content == '' && isset($this->settings["default_content_in_template"]) && $this->settings["default_content_in_template"] != '' ) {
                $custom_markup = str_ireplace("%content%", $this->settings["default_content_in_template"], $this->settings["custom_markup"]);
            } else {
                $custom_markup =  str_ireplace("%content%", '', $this->settings["custom_markup"]);
            }
            //$output .= do_shortcode($this->settings["custom_markup"]);
            $inner .= do_shortcode($custom_markup);
        }
        $elem = str_ireplace('%wpb_element_content%', $inner, $elem);
        $output = $elem;

        return $output;
    }
	
 protected function content ( $atts , $content = null , $helper = false){
       
	   $output  = '';
       extract(shortcode_atts(array(
	       'active_tab' => '1' ,
	       'style' => 'style1' ,
		   'el_class' => '' ,
             ), $atts));
			 
       $el_class = $this->getExtraClass($el_class);
	   $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'accordions '.$style.''.$el_class, $this->settings['base']);
	   $output .= "\n\t" . '<div class="'.$css_class.'" data-active-tab="'.$active_tab.'">';
       $output .= "\n\t\t" . wpb_js_remove_wpautop($content);
       $output .= "\n\t" . '</div>' . $this->endBlockComment('.accordions') . "\n";
	   return $output;
	}
}

