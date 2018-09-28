<?php
/**
 * WPBakery Visual Composer shortcodes
 *
 * @package WPBakeryVisualComposer
 *
 */

class WPBakeryShortCode_VC_Button extends WPBakeryShortCode {
    public function outputTitle($title) {
        return '';
    }
	
	protected function content ( $atts , $content = null , $helper = false) {
	static $button_id = 1;	
	$output = $color = $size = $icon = $target = $href = $title = $position = '';
    extract(shortcode_atts(array(
       'style' => 'default',
	   'align' => '',
       'size' => '',
       'icon' => '',
	   'icon_style' => '',
	   'icon_align' => 'left',
	   'icon_size' => 'normal',
       'target' => '_self',
       'href' => '',
	   'icon_c' => '' ,
	   'icon_c_hover' => '' ,
	   'icon_bc' => '' ,
	   'icon_bgc' => '' ,
	   'icon_bgc_hover' => '' ,
       'title' => __('Text on the button', "brad-framework"),
       'position' => '' ), $atts));
        $a_class = '';

       if ( $target == 'same' || $target == '_self' ) { 
	       $target = '';
	   }
	   
	   $close_p = true;
	   $open_p = true;
	   
	   if(is_array($helper) && !empty($helper)){
		   if( isset($helper['next']['shortcode']) && $helper['next']['shortcode'] == 'vc_button' ){
			   $close_p = false ;
		   }
		   if( isset($helper['prev']['shortcode']) && $helper['prev']['shortcode'] == 'vc_button' ){
			   $open_p = false ;
		   }   
	   }
	   
       $target = ( $target != '' ) ? ' target="'.$target.'"' : '';
       $color = ( $style != '' ) ? 'button_'.$style : '';
       $size = ( $size != '' && $size != 'default' ) ? ' button_'.$size : ' '.$size;
       $icon =  ( $style == 'readmore' ) ? brad_icon($icon , $icon_style.' size-'.$icon_size.' icon-'.$icon_align ) : brad_icon($icon , '' , '' , false );
	   
	   if( $style == 'readmore'){
		   $class = 'readmore';
	   }
	   else {
		   $class = 'button button_'.$style.' '.$size.' '.$color.' icon-align-'.$icon_align ;
	   }
	   
	   if( $style == 'readmore' && ( $icon_bc != '' || $icon_c != '' || $icon_c_hover != '' || $icon_bgc != '' || $icon_bgc_hover != '' )){
		   $output .= "<style type='text/css'>";
		   
		   if( $icon_c_hover != '' || ( $icon_bgc_hover != "" && ( $icon_style == 'style2' || $icon_style == 'style3')) ){
		       $output .= "#brad_button_{$button_id}:hover .brad-icon{ ";
			   if( $icon_c_hover != '' ):
			       $output .= "color:{$icon_c_hover};";
			   endif;
			   if( $icon_bgc_hover != "" && ( $icon_style == 'style2' || $icon_style == 'style3')):
			        $output .= "background-color:{$icon_bgc_hover};border-color:{$icon_bgc_hover};";
			   endif;
			$output .= "}";
	     }
		   
		   if($icon_bc != '' || $icon_c != '' || $icon_bgc != '' ):
		       $output .= "#brad_button_{$button_id} .brad-icon{";
		       if( $icon_c != ''){
			       $output .= "color:{$icon_c};";
		       }
		       if( $icon_bc != '' && $icon_style == 'style2'){
			      $output .= "border-color:{$icon_bc};";
	           }
		       if( $icon_bgc != '' && $icon_style == 'style3'){
			       $output .= "background-color:{$icon_bgc};";
	           }
		      $output .= "}";
		   endif;
		   $output .= "</style>";
	   }
	   
	   if( $align == 'center' && $open_p == true ){ $output .= '<p class="sp-container aligncenter">'; }
	  
       if ( $href != '' ) {
           $output .= '<a id="brad_button_'.$button_id.'" class="'.$class.'" title="'.$title.'" href="'.$href.'"'.$target.'>';
		   if( $icon_align != 'right' ) {
			   $output .= $icon;
		   }
		   $output .= $title;
		   if( $icon_align == 'right'){
			   $output .= $icon;
		   }
		   $output .= '</a>';
       } 
       else {
          $output .= '<span id="brad_button_'.$button_id.'" class="'.$class.'">';
		   if( $icon_align != 'right' ) {
			   $output .= $icon;
		   }
		   $output .= $title;
		   if( $icon_align == 'right'){
			   $output .= $icon;
		   }
		   $output .= '</span>';
	   }
	   if( $align == 'center'  && $close_p == true){ $output .= '</p>'; }
       $output .= $this->endBlockComment('button') . "\n";
	   $button_id++;
       return $output;
  }
}