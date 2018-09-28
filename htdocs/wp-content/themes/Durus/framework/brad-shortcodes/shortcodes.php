<?php 

/*--------------------------------------------------*/
/* Single Image 
/*--------------------------------------------------*/
add_shortcode('image','brad_image');
function brad_image( $atts , $content = null) {
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
      'css_animation' => '',
	  'css_animation_delay' => 0
       ), $atts));
 
	$img_id = preg_replace('/[^\d]/', '', $image);
	if($custom_img_size != '') {
		$img_size = $custom_img_size;
	}

    $img = wpb_getImageBySize(array( 'attach_id' => $img_id, 'thumb_size' => $img_size ));
    if ( $img == NULL ) $img['thumbnail'] = '<img src="http://placekitten.com/g/400/300" /> <small>'.__('This is image placeholder, edit your page to replace it.', "brad-framework").'</small>';


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
   
    $css_class =  'single-image img-align-'.$img_align ;
	
	if( $css_animation != ''){
		$css_class .= ' animate-when-visible';
	}
	
	
    $output .= "\n\t".'<div class="'.$css_class.'" data-animation-delay="'.$css_animation_delay.'" data-animation-effect="'.$css_animation.'">';
    $output .= "\n\t\t". $img['thumbnail'];
	$output .= "\n\t\t\t".$link_to;
    $output .= "\n\t".'</div>';
    return $output;	
}



/*---------------------------------------------------*/
/* button
/*---------------------------------------------------*/
add_shortcode('button','brad_shortcode_button');
function brad_shortcode_button( $atts , $content = null) {
	static $button_id = 1;	
	$output = $color = $size = $icon = $target = $href = $el_class = $title = $position = '';
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
	   'icon_bc' => '' ,
	   'icon_bgc' => '' ,
	   'icon_bgc_hover' => '' ,
       'title' => __('Text on the button', "brad-framework"),
       'position' => '' ), $atts));
        $a_class = '';

       if ( $target == 'same' || $target == '_self' ) { 
	       $target = '';
	   }
       $target = ( $target != '' ) ? ' target="'.$target.'"' : '';
       $color = ( $style != '' ) ? 'button_'.$style : '';
       $size = ( $size != '' && $size != 'default' ) ? ' button_'.$size : ' '.$size;
	   $icon_size = ( $style == 'readmore') ? $icon_size : 'normal';
	   
       $icon =  brad_icon($icon , $icon_style.' size-'.$icon_size.' icon-'.$icon_align );
	   
	   if( $style == 'readmore'){
		   $class = 'readmore';
	   }
	   else {
		   $class = 'button button_'.$style.' '.$size ;
	   }
	   
	   if( $style == 'readmore' && ( $icon_bc != '' || $icon_c != '' || $icon_bgc != '' || $icon_bgc_hover != '' )){
		   $output .= "<style type='text/css'>";
		   
		   if( $icon_bgc_hover != ""):
		       $output .= "#brad_shortcode_button_{$button_id}:hover .brad-icon{ background-color:{$icon_bgc_hover};border-color:{$icon_bgc_hover};}";
		   endif;
		   
		   if($icon_bc != '' || $icon_c != '' || $icon_bgc != '' ):
		       $output .= "#brad_shortcode_button_{$button_id} .brad-icon{";
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
	   
	   if( $align == 'center'){ $output .= '<p class="sp-container aligncenter">'; }
	  
       if ( $href != '' ) {
           $output .= '<a id="brad_shortcode_button_'.$button_id.'" class="'.$class.' align'.$align.'" title="'.$title.'" href="'.$href.'"'.$target.'>';
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
          $output .= '<span id="brad_shortcode_button_'.$button_id.'" class="'.$class.'">';
		   if( $icon_align != 'right' ) {
			   $output .= $icon;
		   }
		   $output .= $title;
		   if( $icon_align == 'right'){
			   $output .= $icon;
		   }
		   $output .= $title;
		   $output .= '</span>';
	   }
	   if( $align == 'center'){ $output .= '</p>'; }
	   $button_id++;
       return $output;
  }
  
	
/*---------------------------------------------------*/
/* Gap
/*---------------------------------------------------*/

add_shortcode('gap', 'brad_gap');
	function brad_gap($atts, $content = null) {
		$output = '';
		extract(shortcode_atts(array(
		   'height' => '20'
         ), $atts));
		$output .= '<div class="gap" style="height:'.$height.'px"></div>';
		return $output;
	}



/*---------------------------------------------------*/
/* Pricing Table
/*---------------------------------------------------*/

add_shortcode('pricing_table', 'brad_pricing_table');
	function brad_pricing_table($atts, $content = null) {
		$output = '';
		extract(shortcode_atts(array(
		   'columns' => '3'
         ), $atts));
		$output .= "\n\t".'<div class="pricing-table row-fluid columns-'.$columns.'">';
		$output .= "\n\t\t".do_shortcode($content);
		$output .= "\n\t".'</div>';
		return $output;
	}


// Pricing Column
add_shortcode('pricing_column', 'brad_pricing_column');
	function brad_pricing_column($atts, $content = null) {
		$output = '';
		extract(shortcode_atts(array(
		   'title' => '' ,
		   'icon' => '' ,
		   'title_bgcolor' => '',
		   'title_textcolor' => '',
       	   'price' => '10', 
		   'price_top_left' => '$',
		   'price_bottom_right' => '/Month',
		   'price_subtext' => '' ,
		   'button_text' => 'Sign Up' ,
		   'button_url' => '' , 
		   'button_icon' => ''
    ), $atts));
	
	  if($icon != '' ){ $icon = '<span class="icon"><i class="'.$icon.'"></i></span>'; }
	  if($button_icon != '' ){ $button_icon = '<i class="'.$button_icon.'"></i>'; }
	  $style = '';
	  if($title_bgcolor != '') { $style .= 'background-color:'.$title_bgcolor.';'; }
	  if($title_textcolor != '') { $style .= 'color:'.$title_textcolor.';'; }
	  $style = ' style="'.$style.'"';
	  $output .= "\n\t".'<div class="span"><div class="pricing-column">';
	  $output .= "\n\t\t".'<div class="title-box">'. brad_icon($icon,'','',false) .'<h2>'. $title .'</h2>';
	  $output .= "\n\t\t\t".'<div class="pricing-box"><div><span class="price"><span class="dollor">'.$price_top_left.'</span>'.$price.'</span><span class="month">'.$price_bottom_right.'</span></div><div class="price-info">'.$price_subtext.'</div></div>';
	  $output .= "\n\t\t".'</div>';
	  $output .= "\n\t\t\t\t".'<ul class="feature-list">' .do_shortcode($content). '</ul>';
      $output .= "\n\t\t\t\t\t".'<div class="pricing-signup"><a class="button button-large" href="'.$button_url.'">'.$button_icon.$button_text.'</a></div>';
	  $output .= "\n\t".'</div></div>';
	  return $output;
	}

// Pricing Row
add_shortcode('pricing_feature', 'brad_pricing_feature');
	function brad_pricing_feature($atts, $content = null) {
		$str = '';
		$str .= "\n\t".'<li class="included-text">';
		$str .= "\n\t\t".do_shortcode($content);
		$str .= "\n\t".'</li>';
		return $str;
	}


/*------------------------------------------------------*/
/* Compare Table
/*------------------------------------------------------*/

add_shortcode('compare_table','brad_compare_table');
function brad_compare_table($atts, $content = null) {
	$output = '';
	static $compare_table_id = 1;
    extract(shortcode_atts(array(
        'title'      => '' ,
		'title_bg' => '' ,
		'title_color' => '' ,
		'element'    => '3',
		'e1_title'      => '' ,
		'e1_icon'      => '' ,
		'e2_title'      => '' ,
		'e2_icon'      => '' ,
		'e3_title'      => '' ,
		'e3_icon'      => '' ,
		'e4_title'      => '' ,
		'e4_icon'      => '' ,
		'e5_title'      => '' ,
		'e5_icon'      => '' ,
		'sign_color' => '' ,
		'c_sign'      => 'dot' ,
		'i_sign'      => 'none'
    ), $atts));
	
	if( $sign_color != '' || $title_bg != '' || $title_color != '' ):
	
	   $output .= "<style type='text/css'>";
	   if( $title_bg != ''){
		   $output .= "#compare_table_{$compare_table_id}.compare-table .table-heading{background-color:{$title_bg};}";
	   }
	   if( $title_color != ''){
		   $output .= "#compare_table_{$compare_table_id}.compare-table .table-heading-title h4,#compare_table_{$compare_table_id}.compare-table .table-element h4,#compare_table_{$compare_table_id}.compare-table .table-element .brad-icon{color:{$title_color};}";
	   }
	   if( $sign_color != ''){
		   $output .= "#compare_table_{$compare_table_id}.compare-table .table-feature .feature-element span{color:{$sign_color};}";
	   }
	   $output .= "</style>";
	   
	endif;
	
	$output .= '<div id="compare_table_'.$compare_table_id.'" class="compare-table elements-'. $element .' included-sign-'.$c_sign.' sign-'.$i_sign.' clearfix"><div class="table-heading clearfix"><div class="table-left table-heading-title"><h4>'.$title.'</h4></div><div class="table-elements table-right">';
	if($e1_title != ''){
		$output .= '<div class="table-element">';
		$output .= brad_icon($e1_icon);
		$output .= '<h4>'.$e1_title.'</h4>';
		$output .= '</div>';
	}
	
	if($e2_title != ''){
		$output .= '<div class="table-element">';
		$output .= brad_icon($e2_icon);
		$output .= '<h4>'.$e2_title.'</h4>';
		$output .= '</div>';
	}
	
	if($e3_title != ''){
		$output .= '<div class="table-element">';
		$output .= brad_icon($e3_icon);
		$output .= '<h4>'.$e3_title.'</h4>';
		$output .= '</div>';
	}
	
	if($e4_title != ''){
		$output .= '<div class="table-element">';
		$output .= brad_icon($e4_icon);
		$output .= '<h4>'.$e4_title.'</h4>';
		$output .= '</div>';
	}
	
	if($e5_title != ''){
		$output .= '<div class="table-element">';
		$output .= brad_icon($e5_icon);
		$output .= '<h4>'.$e5_title.'</h4>';
		$output .= '</div>';
	}
	
	$output .= '</div></div>';
	$output .= '<div class="table-features">';
	$output .= do_shortcode($content);
	$output .= '</div></div>';
	$compare_table_id++;
    return $output;
}


add_shortcode('compare_feature','brad_compare_feature');
function brad_compare_feature($atts, $content = null) {
	$output = '';
	extract(shortcode_atts(array(
        'title'      => '' ,
		'e1_included' => true ,
		'e2_included' => false ,
		'e3_included' => false ,
		'e4_included' => false ,
		'e5_included' => false ,
    ), $atts));
	
	$f1_in = $e1_included == "yes" ? '<span class="feature-included-yes">&nbsp;</span>' : '<span class="feature-included-no"></span>';
	$f2_in = $e2_included == "yes" ? '<span class="feature-included-yes">&nbsp;</span>' : '<span class="feature-included-no"></span>';
	$f3_in = $e3_included == "yes" ? '<span class="feature-included-yes">&nbsp;</span>' : '<span class="feature-included-no"></span>';
	$f4_in = $e4_included == "yes" ? '<span class="feature-included-yes">&nbsp;</span>' : '<span class="feature-included-no"></span>';
	$f5_in = $e5_included == "yes" ? '<span class="feature-included-yes">&nbsp;</span>' : '<span class="feature-included-no"></span>';
	
	
	$output .= "\n\t".'<div class="table-feature clearfix"><div class="table-left table-feature-title"><p>'.$title.'</p></div><div class="table-right table-feature-elements"><div class="table-element feature-element">'.$f1_in.'</div><div class="table-element feature-element">'.$f2_in.'</div><div class="table-element  feature-element">'.$f3_in.'</div><div class="table-element  feature-element">'.$f4_in.'</div><div class="table-element  feature-element">'.$f5_in.'</div></div></div>';
	
	return $output;
}






/*-----------------------------------------------------------------------------------*/
/*	Icon Lists
/*-----------------------------------------------------------------------------------*/
add_shortcode('iconlist','brad_iconlist');
function brad_iconlist( $atts, $content = null ) {
	extract( shortcode_atts( array(
           'size' => 'small'
           ), $atts ) );
    return '<ul class="icon-list size-'. $size .'">'. do_shortcode($content) .'</ul>';
}

add_shortcode('listitem','brad_listitem');
function brad_listitem( $atts, $content = null ) {
	extract( shortcode_atts( array(
           'icon' => ''
           ), $atts ) );
		   
	return '<li>'.brad_icon($icon). do_shortcode($content) . '</li>';
}



/*-----------------------------------------------------------------------------------*/
/* List Item
/*-----------------------------------------------------------------------------------*/

add_shortcode('checklist','brad_list');
function brad_list( $atts, $content = null ) {
   extract(shortcode_atts(array(
       	'icon'      =>  '' ,
		'style'     =>  'style1'
    ), $atts));
	
	$out = '<ul class="styled-list '.$style.'">';
	if($icon != "")
	{ $icon = brad_icon($icon,'','',false);}
	$content = str_replace ( '<i class="icon-to-replace"></i>',$icon , do_shortcode($content) );
	$out .= $content.'</ul>';
    return $out;
}

function brad_item( $atts, $content = null ) {
	return '<li><i class="icon-to-replace"></i>'. do_shortcode($content) . '</li>';
}
add_shortcode('item','brad_item');




/*------------------------------------------------------*/
/*Dropcap
/*------------------------------------------------------*/

add_shortcode('dropcap','brad_dropcap');
function brad_dropcap($atts, $content = null) {
    extract(shortcode_atts(array(
        'style'      =>  'default' ,
		'color' => 'default' 
    ), $atts));
	
	$out = "<span class='dropcap ". $style ." color-".$color."'>" .$content. "</span>";
    return $out;
}


/*-----------------------------------------------------------------------------------*/
/* Media */
/*-----------------------------------------------------------------------------------*/
add_shortcode('video','brad_video');
function brad_video($atts) {
	extract(shortcode_atts(array(
		'type' 	=> '',
		'id' 	=> '',
		'width' 	=> false,
		'height' 	=> false,
		'autoplay' 	=> ''
	), $atts));
	
	if ($height && !$width) $width = intval($height * 16 / 9);
	if (!$height && $width) $height = intval($width * 9 / 16);
	if (!$height && !$width){
		$height = 320;
		$width = 560;
	}
	
	$autoplay = ($autoplay == 'yes' ? '1' : false);
		
	if($type == "vimeo") $return = "<div class='video'><iframe src='http://player.vimeo.com/video/$id?autoplay=$autoplay&amp;title=0&amp;byline=0&amp;portrait=0' width='$width' height='$height' class='iframe'></iframe></div>";
	
	else if($type == "youtube") $return = "<div class='video'><iframe src='http://www.youtube.com/embed/$id?HD=1;rel=0;showinfo=0' width='$width' height='$height' class='iframe'></iframe></div>";
	
	else if($type == "dailymotion") $return ="<div class='video'><iframe src='http://www.dailymotion.com/embed/video/$id?width=$width&amp;autoPlay={$autoplay}&foreground=%23FFFFFF&highlight=%23CCCCCC&background=%23000000&logo=0&hideInfos=1' width='$width' height='$height' class='iframe'></iframe></div>";
		
	if (!empty($id)){
		return $return;
	}
}



/*-----------------------------------------------------------------------------*/
/* Icons
/*-----------------------------------------------------------------------------*/

add_shortcode('icon','brad_sh_icon');

function brad_sh_icon( $atts, $content = null ) {
	static $brad_icon_id = 1 ;
	$out = '';
	extract(shortcode_atts(array(
       	'icon'      => '' ,'size' => 'small' ,'style' => 'style1' , 'align' => '' , 'color' => '' , 'color_hover' => '' ,'bg_color' => '', 'bg_opacity' => '','bg_color_hover' => '', 'bg_opacity_hover' => '','border_color' =>'', 'border_opacity' => '' , 'enable_crease' => 'no' 
    ), $atts));
	
	if( $color != '' || $color_hover != '' || $bg_color != '' || $bg_color_hover != '' || $border_color != '' ){
		$out .= "<style type='text/css'>#brad_icon_{$brad_icon_id}{";
		if( $color != ''){
			$out .= "color:{$color};";
		}
		if( $bg_color != '' && $style == 'style3'){
			$rgb = brad_hex2rgb($bg_color);
			$rgba = "rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},{$bg_opacity})";
			$out .= "background-color:{$bg_color};background-color:{$rgba};";
		}
		if( $border_color != '' && $style == 'style2'){
			$rgb = brad_hex2rgb($border_color);
			$rgba = "rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},{$border_opacity})";
			$out .= "border-color:{$border_color};border-color:{$rgba};";
		}
		$out .= "}";
		
		if( $bg_color_hover != '' || $color_hover != ''){
			$out .= "#brad_icon_{$brad_icon_id}:hover{";
			if($bg_color_hover != '' || ( $style == 'style2' || $style == 'style3') ){
				$rgb = brad_hex2rgb($bg_color_hover);
			    $rgba = "rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},{$bg_opacity_hover})";
				$out .= "background-color:{$bg_color_hover};background-color:{$rgba};border-color:{$bg_color_hover};border-color:{$rgba};";
			}
			if($color_hover){
				$out .= "color:{$color_hover};";
			}
			$out .= "}";
		}
		$out .= "</style>";
	}
    $class = ' enable-crease-'.$enable_crease.' size-'.$size.' '.$style.' '.$color.' ';
	if( $align == 'center'){ 
	     $out .= "\n\t".'<p class="sp-container textcenter">'.brad_icon($icon,$class,"brad_icon_{$brad_icon_id}").'</p>';
	}
	else{
	   $out .= "\n\t".brad_icon($icon,$class,"brad_icon_{$brad_icon_id}");
	}
	$brad_icon_id++;
    return $out;
}



/*-----------------------------------------------------------------------------------*/
/* Social Icons 
/*-----------------------------------------------------------------------------------*/
add_shortcode('social','brad_social');

function brad_social( $atts, $content = null) {
	$output = '';
	static $si_id = 1;
	  extract( shortcode_atts( array(
           'size'=>'','icon_c' => '', 'icon_bgc' => '', 'icon_bc' => '', 'icon_c_hover' => '','icon_bgc_hover' => '', 'icon_bc_hover' => ''
      ), $atts ) );
	  if( $icon_bc != '' || $icon_bgc != '' || $icon_c != '' || $icon_c_hover != '' || $icon_bc_hover != '' || $icon_bgc_hover != '' ){
		  $output .= "<style type='text/css'>";
		  if( $icon_bc != '' || $icon_bgc != '' || $icon_c != '' ):
		  $output .= "#social_icons_{$si_id} li a{";
		  if( $icon_c != '') { $output .= "color:{$icon_c};";}
		  if( $icon_bc != '') { $output .= "border-color:{$icon_bc};";}
		  if( $icon_bgc != '') { $output .= "background-color:{$icon_bgc};";}
		  $output .= "}";
		  endif;
		  
		  if( $icon_bc_hover != '' || $icon_bgc_hover != '' || $icon_c_hover != '' ):
		  $output .= "#social_icons_{$si_id} li a:hover{";
		  if( $icon_c_hover != '') { $output .= "color:{$icon_c_hover};";}
		  if( $icon_bc_hover != '') { $output .= "border-color:{$icon_bc_hover};";}
		  if( $icon_bgc_hover != '') { $output .= "background-color:{$icon_bgc_hover};";}
		  $output .= "}";
		  endif;
		  
		  $output .= "</style>";
	  }
      $output .=  "\n\t".'<ul id="social_icons_'.$si_id.'" class="social-icons '.$size.'">';
	  $output .= "\n\t\t".do_shortcode($content); 
	  $output .= "\n\t".'</ul>';
	  $si_id++;
	  return $output;
}


add_shortcode('social_icon','brad_social_icon');
function brad_social_icon($atts,$content){
	
	extract( shortcode_atts( array(
      'icon' 	=> '',
      'url'		=> '#',
	  'title'   => '' ,
      'target' 	=> '_blank'
      ), $atts ) );
	 
	   
	 return "\n\t".'<li><a href="' . $url . '" title="' . $title . '" target="' . $target . '">'. brad_icon($icon , '' , '' , false) .'</a></li>'; 
	
	
	}
	
	
/*-----------------------------------------------------------------------------------*/
/* Tooltip */
/*-----------------------------------------------------------------------------------*/
add_shortcode('tooltip','brad_tooltip');

function brad_tooltip( $atts, $content = null){
	extract(shortcode_atts(array(
        'text' => '',
		'align' => 'top'
    ), $atts));

return '<span class="tooltips" data-align="'.$align.'"><a href="#"  title="'.$text.'" rel="tooltip" >'. do_shortcode($content) . '</a></span>';

}

/*-----------------------------------------------------------------------------------*/
/* Heading */
/*-----------------------------------------------------------------------------------*/
function brad_heading( $atts, $content = null){
	extract(shortcode_atts(array('type' => 'h1' ,'style'=>'' , 'text_transform' => 'default' , 'align' => 'left' , 'title' => 'Your title here' , 'margin_bottom' => '20px'),$atts));
	
	$output = "\n\t".'<'.$type.' class="title text'.$align.' '.$style.' text'.$text_transform.'" style="margin-bottom:'.$margin_bottom.'px">';
	$output .= "\n\t\t".'<span>'.$title.'</span>';
	$output .= "\n\t".'</'.$type.'>'."\n";
	return $output;
	
}

add_shortcode('heading','brad_heading');

/*-----------------------------------------------------------------------------------*/
/* Separator */
/*-----------------------------------------------------------------------------------*/

function brad_separator( $atts, $content = null){
    $output = '';
     extract(shortcode_atts(array(
	    'type'=>'default' , 
		'style' => 'normal' ,
		'align' => 'left' , 
		'margin_top' => 2 , 
		'margin_bottom' => 25 ),
		$atts));

	$output .= '<div class="hr border-'.$type.' '.$style.'-border align'.$align.'" style=" margin-bottom:'.$margin_bottom.'px;margin-top:'.$margin_top.'px"></div>'."\n";
	return $output;	
	
  }	
add_shortcode('separator','brad_separator');



/*---------------------------------------------------*/
/* highlight
/*---------------------------------------------------*/
function brad_highlighted($atts, $content = null) {

 $output = '';
 extract(shortcode_atts(array(
  'style' => 'style1'
  ), $atts));
  $output .= "\n\t".'<span class="highlighted '.$style.'">';
  $output .= "\n\t\t". do_shortcode($content);
  $output .= "\n\t".'</span>';
  return $output;
}
	
add_shortcode('highlighted','brad_highlighted');




/*-----------------------------------------------------*/
/*	Columns
/*-----------------------------------------------------*/


function brad_columns($atts , $content = null){
	
	return '<div class="row-fluid">' . do_shortcode($content) . '</div>';
	
	}
	add_shortcode('columns','brad_columns');
	
	
// 6
function brad_one_sixth( $atts, $content = null ) {
   return '<div class="span2">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'brad_one_sixth');



// 4
function brad_one_fourth( $atts, $content = null ) {
   return '<div class="span3">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fourth', 'brad_one_fourth');

// 5
function brad_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'brad_one_fifth');


// 3
function brad_one_third( $atts, $content = null ) {
   return '<div class="span4">'.do_shortcode($content).'</div>';
}
add_shortcode('one_third', 'brad_one_third');


// 2
function brad_one_half( $atts, $content = null ) {
   return '<div class="span6">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'brad_one_half');


// 2/3
function brad_two_thirds( $atts, $content = null ) {
   return '<div class="span8">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_thirds', 'brad_two_thirds');

//3/4
function brad_three_fourths( $atts, $content = null ) {
   return '<div class="span9">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourths', 'brad_three_fourths');



/*-----------------------------------------------------*/
/*	code
/*-----------------------------------------------------*/
function brad_code( $atts, $content=null ) {
	$content = str_replace('<br />', '', $content);
	$content = str_replace('<p>', '', $content);
	$content = str_replace('</p>', '', $content);
    $code = '<pre class="">'.htmlentities($content).'</pre>';
	return $code;
}

add_shortcode('code', 'brad_code');


/*-----------------------------------------------------*/
/* button
/*-----------------------------------------------------*/
function brad_button($atts, $content = null){
	static $sh_button_id = 1;	
	$output = $color = $size = $icon = $target = $href = $title = $position = '';
    extract(shortcode_atts(array(
       'style' => 'default',
	   'align' => '',
       'size' => '',
       'icon' => '',
	   'icon_style' => '',
	   'icon_align' => 'left',
       'target' => '_self',
       'href' => '',
	   'icon_c' => '' ,
	   'icon_bc' => '' ,
	   'icon_bgc' => '' ,
       'title' => __('Text on the button', "brad-framework"),
       'position' => '' ), $atts));
        $a_class = '';

       if ( $target == 'same' || $target == '_self' ) { 
	       $target = '';
	   }
       $target = ( $target != '' ) ? ' target="'.$target.'"' : '';
       $color = ( $style != '' ) ? 'button_'.$style : '';
       $size = ( $size != '' && $size != 'default' ) ? ' button_'.$size : ' '.$size;
       $icon =  brad_icon($icon , $icon_style.' icon-'.$icon_align );
	   
	   if( $style == 'readmore'){
		   $class = 'readmore';
	   }
	   else {
		   $class = 'button '.$color.' '.$size ;
	   }
	   
	   if( $style == 'readmore'){
		   $output .= "<style type='text/css'>#sh_button{$sh_button_id} .brad-icon{";
		   if( $icon_c != ''){
			   $output .= "color:{$icon_c};}";
		   }
		   if( $icon_bc != '' && $icon_style == 'style2'){
			   $output .= "border-color:{$icon_bc};}";
	       }
		   if( $icon_bgc != '' && $icon_style == 'style3'){
			   $output .= "background-color:{$icon_bgc};}";
	       }
		   $output .= "}</style>";
	   }
	   
	   if( $align == 'center'){ $output .= '<p class="sp-container aligncenter">'; }
	  
       if ( $href != '' ) {
           $output .= '<a id="sh_button_'.$sh_button_id.'" class="'.$class.' align'.$align.'" title="'.$title.'" href="'.$href.'"'.$target.'>';
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
          $output .= '<span id="sh_button_'.$sh_button_id.'" class="'.$class.'">';
		   if( $icon_align != 'right' ) {
			   $output .= $icon;
		   }
		   $output .= $title;
		   if( $icon_align == 'right'){
			   $output .= $icon;
		   }
		   $output .= $title;
		   $output .= '</span>';
	   }
	   if( $align == 'center'){ $output .= '</p>'; }
       $output .= $this->endBlockComment('button') . "\n";
	   $sh_button_id++;
       return $output;

}

?>