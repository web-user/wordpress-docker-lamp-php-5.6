<?php
class WPBakeryShortCode_VC_Gmaps extends WPBakeryShortCode {
	
	protected function content( $atts , $content = null , $helper = false) {
		static $map_id = 1;
		global $brad_data , $brad_includes;
		$output = $el_class = '';
		
        extract(shortcode_atts(array(
		      'style' => 'default' ,
		      'address' => '',
			  'width' => '100%',
		      'height' => '300px',
		      'zoom' => '14',
		      'scrollwheel' => 'yes',
		      'scale' => 'yes',
			  'infowindow' => '',
			  'maptype' => 'roadmap',
			  'marker' => 'no',
		      'markerimage' => '',
			  'markers' => '',
			  'el_class' => ''
	           ), $atts));
		
		if($scrollwheel == 'yes') {
		     $scrollwheel = 'true';
	    } elseif($scrollwheel == 'no') {
		     $scrollwheel = 'false';
	    }
		
	  if ($markerimage !=''){
		   $img_id = preg_replace('/[^\d]/', '', $markerimage);
           $img_src =  wp_get_attachment_image_src( $img_id , '');				
		   $image = $img_src[0];
	  }
	  else{
		 $image = '';
	  }
	  
	  $global_markers = array();
	  
	  if($markers != ''){
		  $markers_array = explode("\n", $markers);	
		  $i = 1 ;
		  foreach($markers_array as $marker_array){
			  $global_markers[$i] = array(); 
			  $new_marker_array =  explode('|', $marker_array);
			  $global_markers[$i] = array();
			  $global_markers[$i]['lat'] = !empty($new_marker_array[0]) ? $new_marker_array[0] : null;
			  $global_markers[$i]['lon'] = !empty($new_marker_array[1]) ? $new_marker_array[1] : null;
			  $global_markers[$i]['desc'] = !empty($new_marker_array[2]) ? $new_marker_array[2] : null;
			  $i++;
		  }
		  
		  $brad_includes['global_mapData'] =  $global_markers;
		  
	  }
		   
	  $output.= '<div id="map_' .$map_id . '" style="width:' . $width . ';height:' . $height . '" class="google_map" data-address="'. sanitize_text_field($address) .'"  data-maptype="'.$maptype.'" data-scrollwheel="'.$scrollwheel.'" data-zoom="'. $zoom .'" data-marker="'. $marker .'" data-markerimage="'.$image.'" data-style="'.$style.'" data-infowindow="'.$infowindow.'" data-color="'.$brad_data['color_primary'].'" ></div>';
	  $map_id++;
	  
	  $brad_includes['load_gmap'] = true;
	  
	  return $output;
	}
}