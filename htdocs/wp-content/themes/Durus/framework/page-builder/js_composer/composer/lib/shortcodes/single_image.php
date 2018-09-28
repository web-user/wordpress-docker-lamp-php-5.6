<?php
class WPBakeryShortCode_VC_Single_image extends WPBakeryShortCode {
    public function singleParamHtmlHolder($param, $value) {
        $output = '';
        // Compatibility fixes
        $old_names = array('yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange');
        $new_names = array('alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning');
        $value = str_ireplace($old_names, $new_names, $value);
        //$value = __($value, "brad-framework");
        //
        $param_name = isset($param['param_name']) ? $param['param_name'] : '';
        $type = isset($param['type']) ? $param['type'] : '';
        $class = isset($param['class']) ? $param['class'] : '';

        if ( isset($param['holder']) == false || $param['holder'] == 'hidden' ) {
            $output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" />';
            if(($param['type'])=='attach_image') {
                $img = wpb_getImageBySize(array( 'attach_id' => (int)preg_replace('/[^\d]/', '', $value), 'thumb_size' => 'thumbnail' ));
                $output .= ( $img ? $img['thumbnail'] : '<img width="150" height="150" src="' . WPBakeryVisualComposer::getInstance()->assetURL('vc/blank.gif') . '" class="attachment-thumbnail"  data-name="' . $param_name . '" alt="" title="" style="display: none;" />') . '<img src="' . WPBakeryVisualComposer::getInstance()->assetURL('images/picture.png') . '" class="no_image_image' . ( $img && !empty($img['p_img_large'][0]) ? ' image-exists' : '' ) . '" /><a href="#" class="column_edit_trigger' . ( $img && !empty($img['p_img_large'][0]) ? ' image-exists' : '' ) . '">' . __( 'Add image', "brad-framework" ) . '</a>';
            }
        }
        else {
            $output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">'.$value.'</'.$param['holder'].'>';
        }
        return $output;
    }
	
     public function outputTitle($title) {
        return '';
    }
		
  function content ( $atts , $content = null , $helper = false){
	$output =  '';
    extract(shortcode_atts(array(
      'image' => '' ,
      'img_size'  => '',
	  'custom_img_size' => '',
	  'img_align' => 'none' ,
	  'img_lightbox' => false,
	  'icon_lightbox' => '118|ss-air',
      'img_link_large' => false,
      'img_link' => '',
      'img_link_target' => '_self',
      'el_class' => '',
      'css_animation' => '',
	  'css_animation_delay' => 0
       ), $atts));
 
	$img_id = preg_replace('/[^\d]/', '', $image);
	if($custom_img_size != '') {
		$img_size = $custom_img_size;
	}

    $img = wpb_getImageBySize(array( 'attach_id' => $img_id, 'thumb_size' => $img_size ));
    if ( $img == NULL ) $img['thumbnail'] = '<img src="http://placekitten.com/g/400/300" /> <small>'.__('This is image placeholder, edit your page to replace it.', "brad-framework").'</small>';
    $el_class = $this->getExtraClass($el_class);

    $link_to = '';
	$icon = brad_icon($icon_lightbox);
    if ($img_lightbox == 'yes') {
		if($img_link_large == 'yes'){
            $img_src = wp_get_attachment_image_src( $img_id, 'large');
            $link_to = '<a href="'.$img_src[0].'" class="icon image-lightbox" rel="prettyPhoto[singleImage'. rand() .']">'.$icon.'</a>';
		}
		else if(!empty($img_link)){
			$link_to = '<a href="'.$img_link.'" class="icon image-lightbox" rel="prettyPhoto[singleImage'. rand() .']">'.$icon.'</a>';
		}
   }
   
    $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'single-image', $this->settings['base']);
    $css_class .= $this->getCSSAnimation($css_animation);
	
    $output .= "\n\t".'<div class="single-image-container img-align-'.$img_align.' '.$el_class.'"><div class="'.$css_class.'" data-animation-delay="'.$css_animation_delay.'" data-animation-effect="'.$css_animation.'">';
    $output .= "\n\t\t". $img['thumbnail'];
	$output .= "\n\t\t\t".$link_to;
    $output .= "\n\t".'</div></div>'.$this->endBlockComment('.image');
    return $output;	
	}
}