<?php
class WPBakeryShortCode_VC_gallery extends WPBakeryShortCode {

    public function singleParamHtmlHolder($param, $value) {
        $output = '';
		
        // Compatibility fixes
        $old_names = array('yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange');
        $new_names = array('alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning');
        $value = str_ireplace($old_names, $new_names, $value);
        //$value = __($value, "brad-framework");
   
        $param_name = isset($param['param_name']) ? $param['param_name'] : '';
        $type = isset($param['type']) ? $param['type'] : '';
        $class = isset($param['class']) ? $param['class'] : '';

        if ( isset($param['holder']) == true && $param['holder'] !== 'hidden' ) {
            $output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">'.$value.'</'.$param['holder'].'>';
        }
        if($param_name == 'images') {
            $images_ids = empty($value) ? array() : explode(',', trim($value));
            $output .= '<ul class="attachment-thumbnails'.( empty($images_ids) ? ' image-exists' : '' ).'" data-name="' . $param_name . '">';
            foreach($images_ids as $image) {
                $img = wpb_getImageBySize(array( 'attach_id' => (int)$image, 'thumb_size' => 'thumbnail' ));
                $output .= ( $img ? '<li>'.$img['thumbnail'].'</li>' : '<li><img width="150" height="150" test="'.$image.'" src="' . WPBakeryVisualComposer::getInstance()->assetURL('vc/blank.gif') . '" class="attachment-thumbnail" alt="" title="" /></li>');
            }
            $output .= '</ul>';
            $output .= '<a href="#" class="column_edit_trigger' . ( !empty($images_ids) ? ' image-exists' : '' ) . '">' . __( 'Add images', "brad-framework" ) . '</a>';

        }
        return $output;
    }
	
	protected function content ( $atts , $content = null , $helper = false ){
		
		$output = '';
        extract(shortcode_atts(array(
		    'type' => 'slider' ,
			'columns' => '6',
			'padding' => 'default',
            'onclick' => 'link_image',
            'custom_links' => '',
            'custom_links_target' => '',
			'hide_lbi' => 'no',
            'img_size' => '',
			'custom_img_size' => '' ,
            'images' => '',
            'el_class' => '',
            'autoplay' => 'no'
			), $atts));
        
		if($custom_img_size != '') {
		    $img_size = $custom_img_size;
	    }

	   $gal_images = '';
	   $link_start = '';
	   $link_end = '';
	   $el_start = '';
	   $el_end = '';
	   $slides_wrap_start = '';
	   $slides_wrap_end = '';

	   $el_class = $this->getExtraClass($el_class);
	   $class = $type == 'slider' ? 'slide' : 'span';

       $el_start = '<li class="'.$class.'">';
       $el_end = '</li>';
       $slides_wrap_start = '<ul class="slides">';
       $slides_wrap_end = '</ul>';
	   
      //if ( $images == '' ) return null;
      if ( $images == '' ) $images = '-1,-2,-3';
      $pretty_rel_random = ' rel="prettyPhoto[gallery]"'; //rel-'.rand();
      if ( $onclick == 'custom_link' ) { $custom_links = explode( ',', $custom_links); }
      $images = explode( ',', $images);
      $i = -1;

    foreach ( $images as $attach_id ) {
    $i++;
    if ($attach_id > 0) {
        $post_thumbnail = wpb_getImageBySize(array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ));
    }
    else {
        $different_kitten = 400 + $i;
        $post_thumbnail = array();
        $post_thumbnail['thumbnail'] = '<img src="http://placekitten.com/g/'.$different_kitten.'/300" />';
        $post_thumbnail['p_img_large'][0] = 'http://placekitten.com/g/1024/768';
    }

    $thumbnail = $post_thumbnail['thumbnail'];
    $p_img_large = $post_thumbnail['p_img_large'];
    $link_start = $link_end = '';

    if ( $onclick == 'link_image' ) {
        $link_start = '<a class="lightbox-icon" href="'.$p_img_large[0].'"'.$pretty_rel_random.'>';
        $link_end = '</a>';
    }
    else if ( $onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != '' ) {
        $link_start = '<a href="'.$custom_links[$i].'"' . (!empty($custom_links_target) ? ' target="'.$custom_links_target.'"' : '') . '>';
        $link_end = '</a>';
    }
	if( $hide_lbi != 'yes' &&  $onclick == 'link_image' ){
		$gal_images .= $el_start .'<div class="hoverlay">'. $thumbnail . '<div class="overlay"><div class="overlay-content">'. $link_start .'<i class="fa-search"></i>'. $link_end .'</div></div></div>'. $el_end;
	}
	else{
     $gal_images .= $el_start . $link_start . $thumbnail . $link_end . $el_end;
	}
}
   

   if($type == 'grid'){
	     $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'brad-gallery row-fluid columns-'.$columns.' element-padding-'.$padding.' '.$el_class, $this->settings['base']);
	    $output .= '<ul class="'.$css_class.'">'.$gal_images.'</ul>';
   }
   else{
	   $css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'gallery-container '.$el_class.' clearfix', $this->settings['base']);
       $output .= "\n\t".'<div class="'.$css_class.'">';
       $output .= '<div class="flexslider" data-autoplay="'.$autoplay.'">'.$slides_wrap_start.$gal_images.$slides_wrap_end.'</div>';
       $output .= "\n\t".'</div> '.$this->endBlockComment('.wpb_gallery');
   }
   return $output;
	}
}