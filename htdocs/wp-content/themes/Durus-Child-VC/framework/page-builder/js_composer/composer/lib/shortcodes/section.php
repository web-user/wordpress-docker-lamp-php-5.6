<?php

// Vc Section Container

class WPBakeryShortCode_VC_Section_Container extends WPBakeryShortCode_VC_Column {
 
    public function mainHtmlBlockParams($width, $i) {
        return 'data-element_type="'.$this->settings["base"].'" class="wpb_'.$this->settings['base'].' wpb_sortable wpb_content_holder"';
    }
	
    public function containerHtmlBlockParams($width, $i) {
        return 'class="wpb_column_container vc_container_for_children clearfix"';
    }
	
    public function getColumnControls($controls, $extended_css = '') {
        $controls_start = '<div class="controls controls_column'.(!empty($extended_css) ? " {$extended_css}" : '').'">';
        $controls_end = '</div>';
        
        if ($extended_css=='bottom-controls') $control_title = sprintf(__('Append to this %s', 'js_composer'), strtolower($this->settings('name')));
        else $control_title = sprintf(__('Prepend to this %s', 'js_composer'), strtolower($this->settings('name')));
        
        $controls_add = ' <a class="column_add" href="#" title="'.$control_title.'"></a>';
        return $controls_start .  $controls_add . $controls_end;
    }
	
   protected function content ( $atts , $content = null , $helper = false ) {
             $output =  '';
             $output .= wpb_js_remove_wpautop($content);
             return $output;
	}
}


//Section

class WPBakeryShortCode_VC_Section extends WPBakeryShortCode {
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

        $title = '<span class="title">'.$this->settings('name').'</span>';
        $controls_delete = '<a class="column_delete" href="#" title="'.__('Delete this section', 'js_composer').'"></a>';
        $controls_edit = ' <a class="column_edit" href="#" title="'.__('Edit this Section', 'js_composer').'"></a>';
        $controls_clone = ' <a class="column_clone" href="#" title="'.__('Clone this Section', 'js_composer').'"></a>';

        $row_edit_clone_delete = '<span class="vc_row_edit_clone_delete">';
        $row_edit_clone_delete .=  $controls_edit . $controls_clone . $controls_delete;
        $row_edit_clone_delete .= '</span>';

        //$column_controls_full =  $controls_start. $controls_move . $controls_center_start . $controls_layout . $controls_delete . $controls_clone . $controls_edit . $controls_center_end . $controls_end;
        $column_controls_full =  $controls_start. $title . $row_edit_clone_delete . $controls_end;

        return $column_controls_full;
    }

    public function contentAdmin($atts, $content = null) {
        $width = $el_class = '';
        extract(shortcode_atts($this->predefined_atts, $atts));

        $output = '';

        $column_controls = $this->getColumnControls($this->settings('controls'));

        for ( $i=0; $i < count($width); $i++ ) {
            $output .= '<div'.$this->customAdminBockParams().' data-element_type="'.$this->settings["base"].'" class="wpb_'.$this->settings['base'].' wpb_sortable">';
            $output .= str_replace("%column_size%", 1, $column_controls);
            $output .= '<div class="wpb_element_wrapper">';
            $output .= '<div class="wpb_section_container vc_row-fluid vc_container_for_children">';
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
	
protected function content ( $atts , $content = null , $helper = false) {
	$output = $el_class = $style = '';
	global $brad_includes;
    extract(shortcode_atts(array(
        'section_type' => '',  
	    'sp_top' => '60' ,
		'sp_bottom' => '60' ,
	    'enable_border' => 'no' ,
	    'bg_color'=>'',
	    'bg_image'=>'',
		'bg_type' => '',
		'fb_image' => '',
		'bg_video_mp4' => '',
		'bg_video_ogg' => '',
		'bg_video_webm' => '',
		'bg_style'=>'stretch',
		'fixed_bg'=>'yes',
		'video_ratio'=>'',
	    'enable_parallax'=>'no',
		'parallax_speed' => '0.8' ,
		'bg_overlay' => 'no' ,
		'height' => 'content',
		'bg_overlay_color' => '',
		'bg_overlay_opacity' => '0.4',
		'bg_overlay_dot' => 'no',
		'enable_triangle' => 'no',
		'triangle_color' => '' ,
		'triangle_location' => 'top' ,
		'el_class' => '' ), $atts));
	
	$next_sc = $prev_sc = false ;
	if(is_array($helper) && !empty($helper)){
	if( isset($helper['next']['shortcode']) && in_array($helper['next']['shortcode'] , array('vc_section','vc_double_section'))){
		$next_sc = true;
	  }
	if( isset($helper['prev']['shortcode']) && in_array($helper['prev']['shortcode'] , array('vc_section','vc_double_section'))){
		$prev_sc = true;
	  }  
	}
    $el_class = $this->getExtraClass($el_class);
	
    $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'section '.$section_type.' section-border-'.$enable_border.' section-height-'.$height.' section-parallax-'.$enable_parallax.' section-bgtype-'.$bg_type.' section-fixed-background-'.$fixed_bg.'  section-bgstyle-'.$bg_style.' section-triangle-'.$enable_triangle.' triangle-location-'.$triangle_location.' section-overlay-'.$bg_overlay.' section-overlay-dot-'.$bg_overlay_dot.' '.$el_class, $this->settings['base']);
	
	$section_id = brad_shortcodeHelper::$section_count;
	
	$sp_top = ($sp_top == '0' || $sp_top == 0 ) ? 0 : $sp_top.'px';
	$sp_bottom = ($sp_bottom == '0' || $sp_bottom == 0 ) ? 0 : $sp_bottom.'px'; 
	$style .= "padding-top:{$sp_top};padding-bottom:{$sp_bottom};";
	
	if( $bg_color != ''){
		$style .= "background-color:{$bg_color};";
	}
	if( $bg_image != '' ){
		 $img_id = preg_replace('/[^\d]/', '', $bg_image);
         $img_src =  wp_get_attachment_image_src( $img_id , '');
         if( is_array($img_src) ) {
			 $img_src = $img_src[0];
			} 
	     else {
			 $img_src = '';
			 }
		$style .= "background-image:url({$img_src});";
	}
	
	
	  
	// Close the Prev Section if  open
	if( $prev_sc == false && brad_shortcodeHelper::$section_count > 0){
		$output .= '</div></div></section>';
	}
	
	
	if( ( $bg_overlay == 'yes' && $bg_overlay_color != '' ) ||  ( $enable_triangle == 'yes' &&  $triangle_color != '')){
		$output .= '<style type="text/css">';
		
		if( $enable_triangle == 'yes' &&  $triangle_color != '' ) {
			$output .= "#section_{$section_id}:after{border-top-color:{$triangle_color}}#section_{$section_id}.triangle-location-bottom:after{border-bottom-color:{$triangle_color}}";
		}
		
		if( $bg_overlay == 'yes' && $bg_overlay_color != '' ):
		    $rgb = brad_hex2rgb($bg_overlay_color);
		    $overlay_rgb = 'rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].','.$bg_overlay_opacity.')';
	        $output .= "#section_{$section_id} .section-overlay{ background-color:{$overlay_rgb}}>";
		endif;
		$output .= '</style>';
	}


    $output .= '<section id="section_'.$section_id.'" class="'.$css_class.'" data-parallax_speed="'.$parallax_speed.'" style="'.$style.'" data-video-ratio="'.$video_ratio.'">';
	
	if ($bg_type == "video" ) {
		$brad_includes['load_mediaelement'] = true;
		if( $fb_image != '' ){
		    $img_id = preg_replace('/[^\d]/', '', $fb_image);
            $img_src =  wp_get_attachment_image_src( $img_id , '');
		    $img_src = $img_src[0];
		} 
	    else {
		   $img_src = '';
		}
	$output .= '<video class="section-bg-video" poster="'.$img_src.'"  preload="auto" autoplay loop="loop" muted="muted">';	
		if($bg_video_mp4 != ""){
		    $output .= '<source src="'.$bg_video_mp4.'" type="video/mp4">';
	    }
	    if ($bg_video_webm != "") {
	        $output .= '<source src="'.$bg_video_webm.'" type="video/webm">';
	    }
	    if ($bg_video_ogg != "") {
			$output .= '<source src="'.$bg_video_ogg.'" type="video/ogg">';
	    }
	$output .= '</video>';
	}

    $output .= '<div class="section-overlay"></div>';
	$output .= '<div class="container section-content"><div class="row-fluid">';
    $output .= wpb_js_remove_wpautop($content);
	//Close the section otherwise leave it open
	if( $next_sc == true || empty($helper['next']['shortcode']) ) {
	$output .= '</div></div>';
    $output .= '</section>'.$this->endBlockComment('section');
	}
	brad_shortcodeHelper::$section_count++;
    return $output;
	}
}




//Double Section Container

class WPBakeryShortCode_VC_Double_Section_Container extends WPBakeryShortCode_VC_Column {
	
  protected function content ( $atts , $content = null , $helper = false ) {
	 $output = '';
	 extract(shortcode_atts(array(
	    'sp_top' => '60',
		'sp_bottom' => '60',
		'rm_padding' => 'no',
		'fullwidth' => 'no',
	    'enable_border' => 'no' ,
	    'bg_color'=>'',
		'bg_color_opacity' => '1',
	    'bg_image'=>'',
		'bg_style'=>'stretch',
		'fixed_bg'=>'yes',
		'el_class'=>''), $atts));
		   
	 $el_class = $this->getExtraClass($el_class);
     $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'section-container section-fixed-background-'.$fixed_bg.'  section-bgstyle-'.$bg_style.' rm-padding-'.$rm_padding.' fullwidth-'.$fullwidth.' '.$el_class, $this->settings['base']);
	 $style = '';
	 
	$sp_top = ($sp_top == '0' || $sp_top == 0 ) ? 0 : $sp_top.'px';
	$sp_bottom = ($sp_bottom == '0' || $sp_bottom == 0 ) ? 0 : $sp_bottom.'px'; 
	$style .= "padding-top:{$sp_top};padding-bottom:{$sp_bottom};";
	
	if( $bg_color != ''){
		$rgb = brad_hex2rgb($bg_color);
		$rgba = "rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},{$bg_color_opacity})";
		$style .= "background-color:{$bg_color}; background-color:{$rgba};";
	}
	if( $bg_image != '' ){
		 $img_id = preg_replace('/[^\d]/', '', $bg_image);
         $img_src =  wp_get_attachment_image_src( $img_id , '');
         if( is_array($img_src) ) {
			 $img_src = $img_src[0];
			} 
	     else {
			 $img_src = '';
			 }
		$style .= "background-image:url({$img_src});";
	}
	
	

     $output .= '<div class="'.$css_class.'" style="'.$style.'"><div class="inner-content">';
     $output .= wpb_js_remove_wpautop($content);
     $output .= '</div></div>';
     return $output;
	}	
	
}


//Double Section
class WPBakeryShortCode_VC_Double_Section extends WPBakeryShortCode_VC_Section{
	
 protected function content ( $atts , $content = null , $helper = false) {
	$output = $el_class = '';
    extract(shortcode_atts(array(
	    'enable_border' => 'no' ,
	    'bg_color'=>'',
		'bg_image' => '',
		'bg_type' => '',
		'enable_triangle' => 'no' ,
		'triangle_color' => '' ,
		'triangle_location' => 'top',
		'fb_image' => '',
		'bg_video_mp4' => '',
		'bg_video_ogg' => '',
		'bg_video_webm' => '',
		'el_class' => '' )
		, $atts));
	
	$next_sc = $prev_sc = false ;
	if(is_array($helper) && !empty($helper)){
	if( $helper['next']['shortcode'] && in_array($helper['next']['shortcode'] , array('vc_section','vc_double_section'))){
		$next_sc = true;
	  }
	if( $helper['prev']['shortcode'] && in_array($helper['prev']['shortcode'] , array('vc_section','vc_double_section'))){
		$prev_sc = true;
	  }  
	}
		
    $el_class = $this->getExtraClass($el_class);
    $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'section  double-section section-border-'.$enable_border.' section-triangle-'.$enable_triangle.' triangle-location-'.$triangle_location.' '.$el_class , $this->settings['base']);

	
	// Close the Prev Section if  open
	if( $prev_sc == false && brad_shortcodeHelper::$section_count > 0){
		$output .= '</div></div></section>';
	}
		$style = '';
    if($bg_color != '') { $style = 'background-color:'.$bg_color.''; }
	
	if( $bg_image != '' ){
		 $img_id = preg_replace('/[^\d]/', '', $bg_image);
         $img_src =  wp_get_attachment_image_src( $img_id , '');
         if( is_array($img_src) ) {
			 $img_src = $img_src[0];
			} 
	     else {
			 $img_src = '';
			 }
		$style .= "background-image:url({$img_src});";
	}
	
	if( $enable_triangle == 'yes' &&  $triangle_color != '' ) {
			$output .= "<style type='text/css'>#section_{$section_id}:after{border-top-color:{$triangle_color}}#section_{$section_id}.triangle-location-bottom:after{border-bottom-color:{$triangle_color}}</style>";
		}
	
    $output .= "\n\t".'<section id="section_'.brad_shortcodeHelper::$section_count.'" class="'.$css_class.'" style="'.$style.'">';
	if ($bg_type == "video" ) {
		$brad_includes['load_mediaelement'] = true;
		if( $fb_image != '' ){
		    $img_id = preg_replace('/[^\d]/', '', $fb_image);
            $img_src =  wp_get_attachment_image_src( $img_id , '');
		    $img_src = $img_src[0];
		} 
	    else {
		   $img_src = '';
		}
	$output .= '<video class="section-bg-video" poster="'.$img_src.'"  preload="auto" autoplay loop="loop" muted="muted">';	
		if($bg_video_mp4 != ""){
		    $output .= '<source src="'.$bg_video_mp4.'" type="video/mp4">';
	    }
	    if ($bg_video_webm != "") {
	        $output .= '<source src="'.$bg_video_webm.'" type="video/webm">';
	    }
	    if ($bg_video_ogg != "") {
			$output .= '<source src="'.$bg_video_ogg.'" type="video/ogg">';
	    }
	$output .= '</video>';
	}
	
	$output .= "\n\t\t".'<div class="container"><div class="row-fluid">';
    $output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
	//Close the section otherwise leave it open
	if( $next_sc == true || empty($helper['next']['shortcode']) ) {
	$output .= "\n\t\t".'</div></div>';
    $output .= "\n\t".'</section>'.$this->endBlockComment('section');
	}
	brad_shortcodeHelper::$section_count++ ;
    return $output;
	}	
}

