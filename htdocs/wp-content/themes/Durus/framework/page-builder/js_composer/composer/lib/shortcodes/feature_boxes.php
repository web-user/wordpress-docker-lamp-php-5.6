<?php

/*Feature Boxes
------------------------------------------------*/

class WPBakeryShortCode_VC_Feature_Boxes extends WPBakeryShortCode {
	
	 protected $predefined_atts = array(
        'el_class' => '',
    );

 public function addNewButton() {
	 return '<a class="wpb_add_button" href="#" title="'.( $this->settings('add_title') ? $this->settings('add_title') : __('Add New',"brad-framework") ).'"><i class="icon"></i>'.( $this->settings('add_title') ? $this->settings('add_title') : __('Add New',"brad-framework") ) .'</a>';
	 }	
	 
 public function getColumnControls($controls, $extended_css = '') {
	     
     $controls_start = '<div class="controls controls_row clearfix">';
        $controls_end = '</div>';

       $controls_title = '<span class="title">'.$this->settings('name').'</span>';
		
        $controls_delete = '<a class="column_delete" href="#" title="'.sprintf(__('Delete these %s', "brad-framework"), strtolower($this->settings('name'))).'"></a>';
        $controls_edit = ' <a class="column_edit" href="#" title="'.sprintf(__('Edit these %s', 'js_composer'), strtolower($this->settings('name'))).'"></a>';
        $controls_clone = ' <a class="column_clone" href="#" title="'.sprintf(__('Clone these %s', 'js_composer'), strtolower($this->settings('name'))).'"></a>';

        $row_edit_clone_delete = '<span class="vc_row_edit_clone_delete">';
        $row_edit_clone_delete .= $controls_delete . $controls_clone . $controls_edit;
        $row_edit_clone_delete .= '</span>';

        //$column_controls_full =  $controls_start. $controls_move . $controls_center_start . $controls_layout . $controls_delete . $controls_clone . $controls_edit . $controls_center_end . $controls_end;
        $column_controls_full =  $controls_start. $controls_title . $row_edit_clone_delete . $controls_end;

        return $column_controls_full;
    }

    public function contentAdmin($atts, $content = null) {
        $width = $el_class = '';
        extract(shortcode_atts($this->predefined_atts, $atts));

        $output = '';

        $column_controls = $this->getColumnControls($this->settings('controls'));
		$add_new_button = $this->addNewButton($this->settings('controls'));

        for ( $i=0; $i < count($width); $i++ ) {
            $output .= '<div'.$this->customAdminBockParams().' data-element_type="'.$this->settings["base"].'" class="wpb_'.$this->settings['base'].' wpb_custom_element wpb_sortable">';
            $output .= str_replace("%column_size%", 1, $column_controls.$add_new_button);
            $output .= '<div class="wpb_element_wrapper">';

            $output .= '<div class="vc_container_for_children wpb_custom_content_holder clearfix">';
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
	 static $fbox_id = 1 ; 
	 $output = ''; 
     extract(shortcode_atts(array(
	  'columns' => '2' , 
	  'style' => 'style1' ,  
	  'padding' => '' ,
	  'show_divider' => 'yes' ,
	  'divider_style' => 'default',
	  'divider_color' => 'dark',
	  'fc_align' => 'no' ,
	  'fi_align' => 'no',
	  'bg_color' => '#ffffff' , 
	  'inner_vpadding' => "default" ,
	  'inner_hpadding' => "default" ,
	  'border_color' => '' ,
	  'border_opacity' => '' ,
	  'bg_opacity' => "1",
	  "bg_shadow" => "no" ,
	  'bg_radius' => 'yes' , 
	  'box_style' => 'style1' , 
	  'icon_size' => 'normal' ,  
	  'icon_style' => 'style1' ,  
	  'icon_c' => '' ,
	  'icon_c_opc' => '1' ,
	  'icon_bc' => '' ,
	  'icon_bc_opacity' => '1' ,
	  'icon_bgc' => '' ,
	  'icon_bgc_opacity' => '1' ,
	  'icon_c_hover' => '' ,
	  'icon_c_opc_hover' => '' , 
	  'icon_bgc_hover' => '' ,
	  'icon_bgc_opacity_hover' => '1' ,
	  'enable_crease' => 'no' , 
	  'el_class' => '',
	  'bottom_margin' => '0'),$atts));

     if($columns == '' || empty($columns)) { $columns = 2; }

	 $bottom_margin = $bottom_margin == 0 ? 0 : $bottom_margin.'px';
	 
	 /* Css Styles for feature box */
	 $output .= "<style type='text/css'>#feature_boxes_{$fbox_id} .feature_box > .brad-icon{";
	 if( $icon_c != '' ){
		 $rgb = brad_hex2rgb($icon_c);
		 $rgba = "rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},{$icon_c_opc})";
		 $output .=  "color:{$icon_c};color:{$rgba};";
	 }
	 if( $icon_bc != '' && $icon_style == 'style2' ){
		  $rgb = brad_hex2rgb($icon_bc);
	     $rgba = "rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},{$icon_bc_opacity})";
		 $output .=  "border-color:{$icon_bc};border-color:{$rgba};";
	 }
	 if( $icon_bgc != '' && $icon_style == 'style3' ){
		  $rgb = brad_hex2rgb($icon_bgc);
	     $rgba = "rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},{$icon_bgc_opacity})";
		 $output .=  "background-color:{$rgba};";
	 }
	 $output .= "}";
	 
	 if( ( $icon_bgc_hover != '' || $icon_c_hover != '' ) && ( $icon_style == 'style3' || $icon_style == 'style2')){
		 $output .= "#feature_boxes_{$fbox_id} .feature_box:hover > .brad-icon{";
		 if( $icon_bgc_hover != ''){
			 $rgb = brad_hex2rgb($icon_bgc_hover);
			 $rgba = "rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},$icon_bgc_opacity_hover)";
			 $output .=  "background-color:{$rgba};border-color:{$rgba};";
		 }
		 if($icon_c_hover != '' ){
			 $rgb = brad_hex2rgb($icon_c_hover);
		     $rgba = "rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},{$icon_c_opc_hover})";
			 $output .=  "color:{$icon_c_hover};color:{$rgba};";
		 }
		 $output .=  "}";
	 }
	 
	 if( ( $bg_color != '' || $border_color != '' ) && $style == 'style3' ){
		 $output .= "#feature_boxes_{$fbox_id} .span .inner-content{";
		 if( $bg_color != '' ){
		     $rgb = brad_hex2rgb($bg_color);
		     $rgba = "rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},{$bg_opacity})";
		     $output .= "background-color:{$bg_color};background-color:{$rgba};";
		 }
		 if( $border_color != '' ){
			 $rgb = brad_hex2rgb($border_color);
		     $rgba = "rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},{$border_opacity})";
		     $output .= "border-color:{$border_color};border-color:{$rgba};";
			}
		 $output .= "}";
	 }
	 
	 $output .= "</style>";
	 
	 $el_class = $this->getExtraClass($el_class);
	 $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'row-fluid '.$style.' background-shadow-'.$bg_shadow.' background-radius-'.$bg_radius.' feature_boxes box-'.$box_style.' '.$icon_size.'-size element-inner-vertical-padding-'.$inner_vpadding.' element-inner-horizental-padding-'.$inner_hpadding.'  iconbox-'.$icon_style.' title-divider-'.$show_divider.' title-divider-'.$divider_color.' title-divider-'.$divider_style.' align-content-center-'. $fc_align.' align-icon-center-'.$fi_align.' columns-'.$columns.' crease-background-'.$enable_crease.' element-padding-'.$padding.' '.$el_class.' ', $this->settings['base']);

	 $output .= "\n\t".'<div id="feature_boxes_container_'.$fbox_id.'" class="clearfix" style="margin-bottom:'.$bottom_margin.'">';
     $output .= "\n\t\t".'<div id="feature_boxes_'.$fbox_id.'" class="'.$css_class.'">';
     $output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
	 $output .= "\n\t\t".'</div>';
     $output .= "\n\t".'</div>'.$this->endBlockComment('feature_boxes')."\n";
	 $fbox_id++;
     return $output;	
	} 
}

/*Feature Box
--------------------------------------------------------------*/

class WPBakeryShortCode_VC_Feature_Box extends WPBakeryShortCode {
 
 public function outputTitle($title) {
        return '';
    }  	
	
 protected function content ( $atts , $content = null , $helper = false ) {
        global $ss_air , $ss_social , $fa_icons ;	 
		$output = $title = $description = $readmore = $readmore_link = $icon = $image = '';
        extract(shortcode_atts(array(
		'title' =>  '' , 
		'description' =>  '' ,    
		'icon' =>  '' , 
		'text' => '' ,
		'image' =>  '' ,
		'css_animation' => '' ,
	    'css_animation_delay' => '0' ,
	    'css_animation_type' => 'box'),$atts));
         $before_title = '';
		 
		 if($css_animation_type == 'iconbox'){
			 $el_class1 =  $this->getCSSAnimation($css_animation);
			 $el_class2 = '';
		 }
		 else{
			 $el_class1 = '';
			 $el_class2 = $this->getCSSAnimation($css_animation);
		 }
		 
		 if( $text != '') { 
		     $before_title = '<span class="brad-icon icon-text '.$el_class1.'" data-animation-delay="'.$css_animation_delay.'" data-animation-effect="'.$css_animation.'">'.$text.'</span>';
		 }
		 
         else if($icon != "") {
			 $before_title = brad_icon($icon,$el_class1,'',true, 'data-animation-delay="'. $css_animation_delay .'" data-animation-effect="'. $css_animation.'"');
		 }
		 
		 else if( $image != "" ) { 
		     $img_id = preg_replace('/[^\d]/', '', $image);
             $img_src =  wp_get_attachment_image_src( $img_id , 'mini');
	         $before_title = '<div class="blandes-image '.$el_class1.'" data-animation-delay="'.$css_animation_delay.'" data-animation-effect="'.$css_animation.'"><img src="'.$img_src[0].'" alt="" /></div>';
		 }
		 
		 
		 
         $output = '<div class="span"><div class="inner-content '. $el_class2 . '" data-animation-delay="'.$css_animation_delay.'" data-animation-effect="'.$css_animation.'"><div class="feature_box">';
		 
         $output .= $before_title;
         if( $title != '' ) { 
		     $output .= '<h4>'.$title.'</h4>';
		 }
         if( $content != '' ) { 
		     $output .= '<div class="feature-content">'.wpb_js_remove_wpautop($content).'</div>';
		 }
         $output .= '</div></div></div>';
         return $output;
       }
}