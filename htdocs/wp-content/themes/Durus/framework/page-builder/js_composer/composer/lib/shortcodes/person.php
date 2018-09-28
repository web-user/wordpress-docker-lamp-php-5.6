<?php

/* Person
--------------------------------------------------*/

class WPBakeryShortCode_VC_Person extends WPBakeryShortCode {
	
	protected function content ( $atts , $content = null , $helper = false ){
		 $output = $social = '';
		 extract(shortcode_atts(array(
		   'image' => '' ,
		   'name' => '',
		   'role' => '',
		   'bio'  => '',
		   'social_links' => '',
		   'twitter' => '',
           'facebook' => '',
           'youtube' => '',
           'google' => '',
           'linkedin' => '',
		   'behance' => '',
		   'dribbble' => '' ,
		   'pinterest' => ''
	        ),$atts));
		 
		 $social_links = explode ("," , $social_links);
		 
		 if( in_array('facebook',$social_links) || in_array('twitter',$social_links) || in_array('youtube',$social_links) || in_array('dribbble',$social_links) || in_array('linkedin',$social_links) || in_array('pinterest',$social_links) || in_array('behance',$social_links) || in_array('google',$social_links) ) {
		 $social = '<ul class="social-icons">';
		 if( in_array('facebook',$social_links) && $facebook != '') {
			 $social .= '<li > <a class="facebook" href="' .$facebook. '" target="_blank" title="Facebook"><i class="fa-facebook"></i></a></li>';
		 }
		 
		 if( in_array('twitter',$social_links) && $twitter != '') {
			 $social .= '<li > <a class="twitter" href="' .$twitter. '" target="_blank" title="twitter"><i class="fa-twitter"></i></a></li>';
		 }
		 
		 if( in_array('linkedin',$social_links) && $linkedin != '') {
			 $social .= '<li > <a class="linkedin" href="' .$linkedin. '" target="_blank" title="linkedin"><i class="fa-linkedin"></i></a></li>';
		 }
		 
		 if( in_array('dribbble',$social_links) && $dribbble != '') {
			 $social .= '<li > <a class="dribbble" href="' .$dribbble. '" target="_blank" title="dribbble"><i class="fa-dribbble"></i></a></li>';
		 }
		 
		  if( in_array('behance',$social_links) && $behance != '') {
			 $social .= '<li><a class="behance" href="' .$behance. '" target="_blank" title="behance"><i class="ss-social ss-behance"></i></a></li>';
		 }
		 
		  if( in_array('youtube',$social_links) && $youtube != '') {
			 $social .= '<li><a class="youtube" href="' .$youtube. '" target="_blank" title="youtube"><i class="fa-youtube"></i></a></li>';
		 }
		 
		  if( in_array('pinterest',$social_links) && $pinterest != '') {
			 $social .= '<li > <a class="pinterest" href="' .$pinterest. '" target="_blank" title="pinterest"><i class="fa-pinterest"></i></a></li>';
		 }
		 
		  if( in_array('google',$social_links) && $google != '') {
			 $social .= '<li > <a class="google" href="' .$google. '" target="_blank" title="google plus"><i class="fa-google-plus"></i></a></li>';
		 }
		$social .= '</ul>';
		 }
		 
		$output .= "\n\t".'<div class="person">';
		if($image != ''){
		$img_id = preg_replace('/[^\d]/', '', $image);
		$img =   wp_get_attachment_image_src( $img_id , '');
		$output .= '<div class="image"><img src="'.$img[0].'" alt="'.$name.'" /></div>';
		}
		$output .= "\n\t\t".'<div class="person-info">';
		if($name != '' ) { $output .= "\n\t\t\t".'<h4>'.$name.'</h4>';}
		if($role != '' ) { $output .= "\n\t\t\t\t".'<h6>'.$role.'</h6>';}
		$output .= "\n\t\t".'</div>';
		if($bio != '') { $output .= '<p>'.$bio.'</p>';}
		$output .=  $social ;
		$output .= "\n\t".'</div>';
		return $output;
	}
}