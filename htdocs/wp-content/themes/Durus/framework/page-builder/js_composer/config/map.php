<?php
/**
 * WPBakery Visual Composer Shortcodes settings
 *
 * @package VPBakeryVisualComposer
 *
 */
global $data;
$vc_is_wp_version_3_6_more = version_compare(preg_replace('/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo('version')), '3.6') >= 0;
// Used in "Button", "Call to Action", "Pie chart" blocks
$colors_arr = array(__("Default", "brad-framework") => "default" ,  __("Grey Button", "brad-framework") => "grey",  __("White Button", "brad-framework") => "white" , __("Green Button", "brad-framework") => "green",__("Sea Green Button", "brad-framework") => "seagreen", __("Orange Button", "brad-framework") => "orange", __("Red Button", "brad-framework") => "red", __("Black Button", "brad-framework") => "black" , __("Purple Button", "brad-framework") => "purple" , __("Yellow Button", "brad-framework") => "yellow" , __('Alternate Button','brad-framework') => 'alternate',__('Alternate Light Button','brad-framework') => 'alternatelight' , __('Alternate Transparent Button','brad-framework') => 'alternatewhite' );

$button_colors_arr = $colors_arr;

$button_colors_arr[__('Read More Button','brad-framework')] =  'readmore';

// Used in "Button" and "Call to Action" blocks
$size_arr = array(__("Regular size", "brad-framework") => "default", __("Large", "brad-framework") => "large", __("Small", "brad-framework") => "small");

$target_arr = array(__("Same window", "brad-framework") => "_self", __("New window", "brad-framework") => "_blank");

$add_order_by = array(
                  "type" => "dropdown",
                  "heading" => __("Order by", "brad-framework"),
                  "param_name" => "orderby",
                  "value" => array(  __("Date", "brad-framework") => "date", __("ID", "brad-framework") => "ID",  __("Title", "brad-framework") => "title", __("Modified", "brad-framework") => "modified", __("Random", "brad-framework") => "rand", __("Menu order", "brad-framework") => "menu_order" ),
                  "description" => sprintf(__('Select how to sort retrieved posts. More at %s.', 'brad-framework'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
    );
	
$add_order =  array(
                 "type" => "dropdown",
                 "heading" => __("Order", "brad-framework"),
                 "param_name" => "order",
                 "value" => array( __("Descending", "brad-framework") => "DESC", __("Ascending", "brad-framework") => "ASC" ),
                 "description" => sprintf(__('Designates the ascending or descending order. More at %s.', 'brad-framework'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
    );
	
$add_bottom_margin = array(
                  "type" => "textfield",
                  "heading" => __("Bottom Margin", "brad-framework"),
                  "param_name" => "bottom_margin",
	              "value" => 0 ,
				  "description" => __("Default Bottom Margin in px . Do't Included px just numbers",'brad-framework')
     );	
	
$add_css_animation = array(
                     "type" => "dropdown",
                     "heading" => __("CSS Animation", "brad-framework"),
                     "param_name" => "css_animation",
                     "admin_label" => true,
                     "value" => array(__("No", "brad-framework") => '', __("Left to Right", "brad-framework") => "fadeInLeft", __("Right to Left", "brad-framework") => "fadeInRight", __("Bottom to top", "brad-framework") => "fadeInTop", __("Top to Bottom", "brad-framework") => "fadeInBottom", __("Appear from center", "brad-framework") => "appearFromCenter" , __("Fade In", "brad-framework") => "fadeIn"),
                     "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "brad-framework")
);

$add_hidden_array = array(
                        "type" => "checkbox",
                        "heading" => __("Hide Under", "brad-framework"),
                        "param_name" => "hide_under",
                        "value" => array(__("Dektop", "brad-framework") => 'desktop', __("Tablet", "brad-framework") => 'tablet' , __("Smartphones", "brad-framework") => 'mobile')
);

$add_css_animation_delay = array(
                        "type" => "dropdown",
                        "heading" => __("CSS Animation Delay", "brad-framework"),
                        "param_name" => "css_animation_delay",
                        "value" => array(__("No Delay", "brad-framework") => '0', '100' => '100' , '200' => '200', '300' => '300' , '400' => '400' , '500' => '500' ,'600' => '600' , '700' => '700' , '800' => '800','1000' => '1000' , '1200' => '1200' , '1400' => '1400' , '1600' => '1600' , '1800' => '1800' , '2000' => '2000')
);

$add_img_size = array(
      "type" => "dropdown",
      "heading" => __("Image size", "brad-framework"),
      "param_name" => "img_size",
	  "value" => Array( 
	     __("Default","brad-framework") => "" ,
		 __("Large","brad-framework") => "thumb-large" ,
		 __("Medium","brad-framework") => "thumb-medium" ,
		 __("Small","brad-framework") => "thumb-normal" ,
		 __("Thumbnail","brad-framework") => "thumbnail" ,
		 __("Mini","brad-framework") => "mini" ,	 	 
		 __("Custom","brad-framework") => "custom" )
		 );
		 
$add_box_padding = array(
      "type" => "dropdown",
      "heading" => __("Whitespace Between Elements ? ", "brad-framework"),
      "param_name" => "padding",
	  "value" => Array( 
	     "Default (Medium)" => "medium" ,
		 "Narrow" => "narrow" ,
		 "Small" => "small" ,
		 "Large" => "large" ,
		 "Zero" => "no" ) 	 
	);
		 
		 
$add_inner_vpadding = array(
      "type" => "dropdown",
      "heading" => __("Box Inner Vertical Padding ? ", "brad-framework"),
      "param_name" => "inner_vpadding",
	  "value" => Array( 
	     "Default (Medium)" => "medium" ,
		   "Narrow Padding" => "narrow" ,
		    "Large Padding" => "large"	 ) ,
	 "dependency" => array("element" => "style" , "value" => array("style3"))
	);
	
$add_inner_hpadding = array(
      "type" => "dropdown",
      "heading" => __("Box Inner horizental Padding ? ", "brad-framework"),
      "param_name" => "inner_hpadding",
	  "value" => Array( 
	     "Default (Medium)" => "medium" ,
		   "Narrow Padding" => "narrow" ,
		    "Large Padding" => "large"	 ) ,
	 "dependency" => array("element" => "style" , "value" => array("style3"))
	);
		 
		 		 		 
$add_custom_img_size = array(
	  "type" => "textfield",
	  "heading" => __("Custom Image size", "brad-framework"),
      "param_name" => "custom_img_size",	  	 
      "description" => __("Enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size.", "brad-framework"),
	   "dependency" => Array('element' => "img_size", "value" => array("custom"))
	   );


$add_box_bgcolor =  array(
      "type" => "colorpicker",
      "heading" => __("Background Color for box", "brad-framework"),
      "param_name" => "bg_color",
      "value" => "#ffffff",
	  "dependency" => Array('element' => "style", 'value' => array('style3'))
    ) ; 
	
$add_box_bgcolor_hover =  array(
      "type" => "colorpicker",
      "heading" => __("Background Color for box : hover", "brad-framework"),
      "param_name" => "bg_color_hover",
      "value" => "",
	  "dependency" => Array('element' => "style", 'value' => array('style3'))
    ) ; 	
	
$add_box_stroke_color =  array(
      "type" => "colorpicker",
      "heading" => __("Border Color for Box", "brad-framework"),
      "param_name" => "border_color",
      "value" => "",
	  "description" => __("Border color of box or leave blank for no border","brad-framework"),
	  "dependency" => Array('element' => "style", 'value' => array('style3'))
    ) ;
	
$add_box_stroke_color_hover =  array(
      "type" => "colorpicker",
      "heading" => __("Border Color for Box : hover", "brad-framework"),
      "param_name" => "border_color_hover",
      "value" => "",
	  "description" => __("Border color of box or leave blank for no border","brad-framework"),
	  "dependency" => Array('element' => "style", 'value' => array('style3'))
    ) ;	
	
$add_box_stroke_opacity =  array(
      "type" => "colorpicker",
      "heading" => __("Border Opacity", "brad-framework"),
      "param_name" => "border_opacity",
      "value" => "1",
	  "dependency" => Array('element' => "style", 'value' => array('style3'))
    ) ; 
	
$add_box_stroke_opacity_hover =  array(
      "type" => "colorpicker",
      "heading" => __("Border Opacity", "brad-framework"),
      "param_name" => "border_opacity_hover",
      "value" => "1",
	  "dependency" => Array('element' => "style", 'value' => array('style3'))
    ) ; 		

$add_box_opacity_hover =  array(
      "type" => "textfield",
      "heading" => __("Opacity for Box", "brad-framework"),
      "param_name" => "bg_opacity_hover",
      "value" => "1",
	  "description" => __("Insert a value between o and 1 , for ex. 0.755","brad-framework"),
	  "dependency" => Array('element' => "style", 'value' => array('style3'))
    ) ;
	  
$add_box_opacity =  array(
      "type" => "textfield",
      "heading" => __("Opacity for Box", "brad-framework"),
      "param_name" => "bg_opacity",
      "value" => "1",
	  "description" => __("Insert a value between o and 1 , for ex. 0.755","brad-framework"),
	  "dependency" => Array('element' => "style", 'value' => array('style3'))
    ) ;
  
$add_box_shadow =  array(
      "type" => "checkbox",
      "heading" => __("Box Outer Shadow? ", "brad-framework"),
      "param_name" => "bg_shadow",
	  "value" => array(__("Yes","brad-framework") => "yes"),
	  "dependency" => Array('element' => "style", 'value' => array('style3'))
  );
 
  
$add_box_radius =  array(
      "type" => "dropdown",
      "heading" => __("Box Container Border Radius ?", "brad-framework"),
      "param_name" => "bg_radius",
	  "value" => array(__("Yes","brad-framework") => "yes" , __("No","brad-framework") => "no"),
	  "dependency" => Array('element' => "style", 'value' => array('style3'))
  );
  
$add_box_radius_round =  array(
      "type" => "checkbox",
      "heading" => __("Totally Round the Border Radius? ", "brad-framework"),
      "param_name" => "bg_radius_full",
	  "value" => array(__("Yes","brad-framework") => "yes" ),
	  "dependency" => Array('element' => "bg_radius", 'value' => array('yes'))
  );
  
  
  
vc_map( array(
  "name" => __("Row", "brad-framework"),
  "base" => "vc_row",
  "is_container" => true,
  "icon" => "vc_icon_row",
  "show_settings_on_create" => false,
  "category" => __('Content', "brad-framework"),
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => __("Enable Bottom Margin ?", "brad-framework"),
      "param_name" => "bottom_margin",
	  "value" => array(__('Yes',"brad-framework") => 'yes' , __('No',"brad-framework") => 'no' )
    ),		
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    ) 
  ),
  "js_view" => 'VcRowView'
) );





/* Testimonials
---------------------------------------------------------------*/

vc_map( array(
  "name"  => __("Testimonials", "brad-framework"),
  "add_title" => __("Add New Testimonial", "brad-framework") ,
  "base" => "vc_testimonials",
  "show_settings_on_create" => true ,
  "is_container" => true,
  "icon" => "vc_icon_testimonials",
  "class" => "vc_testimonials",
  "category" => __('Content', "brad-framework"),
  "params" => array(
  
   array(
      "type" => "taxonomy",
      "heading" => __("Testimonial Category", "brad-framework"),
      "param_name" => "categories",
      "value" => "" ,
	  "taxonomy" => "testimonials-category"
	),
	
	$add_order,
	$add_order_by,
	
	array(
      "type" => "textfield",
      "heading" => __("Testimonials Count", "brad-framework"),
	  "param_name" => "count",
      "value" => 5
    )
	,
	
	 array(
      "type" => "dropdown",
      "heading" => __("Testimonial Background Scheme", "brad-framework"),
      "param_name" => "testimonial_bg",
      "value" => array( __('White Smoke',"brad-framework") => '' , __('Light',"brad-framework") => 'light' )
    )  
   , 
   
    array(
      "type" => "dropdown",
      "heading" => __("Testimonials Appearance", "brad-framework"),
	  "param_name" => "appearance",
      "value" => Array ( __("Columns","brad-framework") => "columns"  ,__("Carousel") => "carousel")
    )
	,
    array(
      "type" => "dropdown",
      "heading" => __("Columns", "brad-framework"),
      "param_name" => "columns",
      "value" => array( 2 ,3 , 4 ),
      "description" => __("Set the number of Columns.", "brad-framework"),
	  "dependency" => Array('element' => "appearance", 'value' => array('columns'))
	  )
	 ,
	
   /* 
   array(
      "type" => "dropdown",
      "heading" => __("Carousel Columns", "brad-framework"),
      "param_name" => "carousel_columns",
      "value" => array( 1 , 2 , 3 , 4 ),
      "description" => __("Set the number of Columns.", "brad-framework"),
	  "dependency" => Array('element' => "appearance", 'value' => array('carousel'))
	  )
	  , 
	 */  
   
   array(
      "type" => "checkbox",
      "heading" => __("Autoplay", "brad-framework"),
      "param_name" => "autoplay",
      "value" => array( __('Yes',"brad-framework") => 'yes'),
	  "dependency" => Array('element' => "appearance", 'value' => array('carousel'))
    )  
   , 
   array(
      "type" => "dropdown",
      "heading" => __("Display Navigation", "brad-framework"),
      "param_name" => "navigation",
      "value" => array( __('Yes',"brad-framework") => 'yes' , __('No',"brad-framework") => 'no' ),
	  "dependency" => Array('element' => "appearance", 'value' => array('carousel'))
    )  
   , 
   
   array(
      "type" => "dropdown",
      "heading" => __("Navigation Align", "brad-framework"),
      "param_name" => "navigation_align",
      "value" => array( __('Side',"brad-framework") => '' , __('Bottom',"brad-framework") => 'bottom' ),
	  "dependency" => Array('element' => "navigation", 'value' => array('yes'))
    )  
   , 
   
   array(
      "type" => "dropdown",
      "heading" => __("Columns Style", "brad-framework"),
      "param_name" => "style",
      "value" => array( 'No divider' => 'default' ,'With Fancy Divider' => 'style2' )   ,
      "description" => __("Default Style for Feature Box Container.", "brad-framework"),
	  "dependency" => Array('element' => "appearance", 'value' => array('columns'))
    ) 
	,
   $add_img_size,
   $add_custom_img_size,
   array(
      "type" => "checkbox",
	  "heading" => __("Rounded Image","brad-framework"),
	  "param_name" => "rounded_image",
	  "value" => array(__("Yes","brad-framework") => "yes")
	  ),		
   $add_bottom_margin,
   array(
       "type" => "dropdown",
       "heading" => __("CSS Animation", "brad-framework"),
       "param_name" => "css_animation",
       "admin_label" => true,
       "value" => array(__("No", "brad-framework") => '', __("Left to Right", "brad-framework") => "fadeInLeft", __("Right to Left", "brad-framework") => "fadeInRight", __("Bottom to top", "brad-framework") => "fadeInTop", __("Top to Bottom", "brad-framework") => "fadeInBottom", __("Appear from center", "brad-framework") => "appearFromCenter" , __("Fade In", "brad-framework") => "fadeIn"),
       "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "brad-framework"),
	   "dependency" => Array('element' => "appearance", 'value' => array('columns'))
) ,

    array(
        "type" => "dropdown",
        "heading" => __("CSS Animation Delay", "brad-framework"),
		"description" => __("Css Animation delay between elements in milseconds","brad_framework"),
        "param_name" => "css_animation_delay",
        "value" => array(__("No Delay", "brad-framework") => '0', '100' => '100' , '200' => '200', '300' => '300' , '400' => '400' , '500' => '500' ,'600' => '600' , '700' => '700' , '800' => '800'),
		"dependency" => Array('element' => "appearance", 'value' => array('columns'))
),
   array(
      "type" => "dropdown",
      "heading" => __("Apply Css Animation to ?", "brad-framework"),
      "param_name" => "css_animation_type",
	  "value" => array(__('Whole Testimonial Content',"brad-framework") => 'box' , __('Only Testimonial Image',"brad-framework") => 'iconbox' ),
	  "dependency" => Array('element' => "appearance", 'value' => array('columns'))
  ),  
   array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )	 
   
  )
 )
);


/* Features Boxes
---------------------------------------------------*/

vc_map( array(
  "name"  => __("Feature Boxes", "brad-framework"),
  "base" => "vc_feature_boxes",
  "show_settings_on_create" => true ,
  "is_container" => true , 
  "add_title" => __("Add New Feature Box", "brad-framework") ,
  "icon" => "vc_icon_features",
  "category" => __('Content', "brad-framework"),
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => __("Columns Count", "brad-framework"),
      "param_name" => "columns",
      "value" => array( "Default Two Columns" => 2 , " Single Column" => 1 , "Three columns" => 3 ,"Four Columns" => 4 ,"Five Columns" => 5  ),
      "description" => __("Set the number of Columns.", "brad-framework")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Feature Box Container Style", "brad-framework"),
      "param_name" => "style",
      "value" => array( 'Style 1 (Default)' => 'style1' ,'Style 2 (Fancy Divider)' => 'style2' ,'Style 3 (Box Type)' => 'style3' ),
      "description" => __("Default Style for Feature Box Container.", "brad-framework")
    ),
	
  $add_box_padding,
  $add_box_bgcolor,
  $add_box_bgcolor_hover,
  $add_box_opacity,
  $add_inner_hpadding,
  $add_inner_vpadding,
  $add_box_shadow,
  $add_box_radius,
  $add_box_stroke_color,
  $add_box_stroke_opacity,
 
  array(
      "type" => "dropdown",
      "heading" => __("Feature Box Style ", "brad-framework"),
      "param_name" => "box_style",
      "value" => array( 'Style 1' => 'style1' , 'Style 2' =>  'style2' , 'Style 3' => 'style3' )
    ),

  array(
      "type" => "checkbox",
      "heading" => __("Align Feature Box Content to Center", "brad-framework"),
      "param_name" => "fc_align",
      "value" => array( __('Yes' , 'brad-framework') => 'yes'),
	  "dependency" => Array('element' => "box_style", 'value' => array('style3'))
    ),
	array(
      "type" => "checkbox",
      "heading" => __("Align Feature Box Icon to Center", "brad-framework"),
      "param_name" => "fi_align",
      "value" => array( __('Yes' , 'brad-framework') => 'yes'),
	  "dependency" => Array('element' => "box_style", 'value' => array('style3'))
    ),
   array(
      "type" => "dropdown",
      "heading" => __("Show Divider After Title", "brad-framework"),
      "param_name" => "show_divider",
      "value" => array( __('Yes' , 'brad-framework') => 'yes' , __('No') => 'no')
    ), 
	
   array(
      "type" => "dropdown",
      "heading" => __("Divider Size", "brad-framework"),
      "param_name" => "divider_style",
      "value" => array( __('Default','brad-framework') => 'default' ,  __('Thin',"brad-framework") => 'style2' , __('Small',"brad-framework") => 'style3' , __('Small Thin',"brad-framework") => "style4"),
	  "dependency" => array("element" => "show_divider" , "value" => array("yes"))
    ), 
	
	 array(
      "type" => "dropdown",
      "heading" => __("Divider Color", "brad-framework"),
      "param_name" => "divider_color",
      "value" => array( __('Dark','brad-framework') => 'dark' ,  __('Light',"brad-framework") => 'light'),
	  "dependency" => array("element" => "show_divider" , "value" => array("yes"))
    ), 
		
   array(
        "type" => "dropdown",
        "heading" => __("Feature Box Icon Style", "brad-framework"),
        "param_name" => "icon_style",
        "value" => array( 'Style 1' => 'style1' , 'Style 2' =>  'style2' , 'Style 3' => 'style3'),
		
	   ), 
  array(
      "type" => "dropdown",
      "heading" => __("Feature Box Icon Size", "brad-framework"),
      "param_name" => "icon_size",
      "value" => array( __('Normal',"brad-framework") => 'normal' , __('Large',"brad-framework") =>  'large' , __('Extra Large',"brad-framework") =>  'ex-large' ),
	  "dependency" => Array('element' => "box_style", 'value' => array('style3','style2'))
    ),	   
  array(
      "type" => "colorpicker",
      "heading" => __("Feature Box Icon Color", "brad-framework"),
	  "description" => __("Leave Blank for default color","brad-framework"),
      "param_name" => "icon_c",
      "value" => ''
      ),
	  
	array(
      "type" => "textfield",
      "heading" => __("Feature Box Icon Color Opacity", "brad-framework"),
      "param_name" => "icon_c_opc",
      "value" => '1'
      ),  
	  
  array(
      "type" => "colorpicker",
      "heading" => __("Feature Box Icon  Color on hover", "brad-framework"),
	  "description" => __("Leave Blank for Same","brad-framework"),
      "param_name" => "icon_c_hover",
	  "dependency" => Array('element' => "icon_style", 'value' => array('style3','style2')) ,
      "value" => ''
      ),	

 array(
      "type" => "textfield",
      "heading" => __("Feature Box Icon Color Opacity on hover", "brad-framework"),
      "param_name" => "icon_c_hover_opc",
	  "dependency" => Array('element' => "icon_style", 'value' => array('style3','style2')) ,
      "value" => '1'
      ),  
	  	  	  
  array(
      "type" => "colorpicker",
      "heading" => __("Feature Box Icon Border Color", "brad-framework"),
	  "description" => __("Leave Blank for default border color","brad-framework"),
      "param_name" => "icon_bc",
	  "dependency" => Array('element' => "icon_style", 'value' => array('style2')),
      "value" => ''
      ),
	  
 array(
      "type" => "textfield",
      "heading" => __("Feature Box Icon Border Opacity", "brad-framework"),
      "param_name" => "icon_bc_opacity",
	  "dependency" => Array('element' => "icon_style", 'value' => array('style2')),
      "value" => '1'
      ),	  
	  	  	  
  array(
      "type" => "colorpicker",
      "heading" => __("Feature Box Icon Background Color", "brad-framework"),
	  "description" => __("Leave Blank for default background color","brad-framework"),
      "param_name" => "icon_bgc",
      "value" => '',
	  "dependency" => Array('element' => "icon_style", 'value' => array('style3'))
      ),
  
  array(
      "type" => "textfield",
      "heading" => __("Feature Box Icon Bg Color Opacity", "brad-framework"),
      "param_name" => "icon_bgc_opacity",
	  "dependency" => Array('element' => "icon_style", 'value' => array('style3')),
      "value" => '1'
      ),
	  	  
  array(
      "type" => "checkbox",
      "heading" => __("Enable Crease Backgound", "brad-framework"),
      "param_name" => "enable_crease",
	  "description" => __('Enable this if you want to show a Crease image for Feature Icon (Note : Crease background will shown on hover for icon style2 and on both states for icon style3 )','brad-framework'),
      "value" => array(__('Yes','brad-framework') => 'yes'),
	  "dependency" => Array('element' => "icon_style", 'value' => array('style3','style2'))
      ),	  
	  
  
  array(
      "type" => "colorpicker",
      "heading" => __("Feature Box Icon Background Color on hover", "brad-framework"),
	  "description" => __("Leave Blank for Same","brad-framework"),
      "param_name" => "icon_bgc_hover",
      "value" => '',
	  "dependency" => Array('element' => "icon_style", 'value' => array('style3','style2'))
      ),	
	  
 array(
      "type" => "textfield",
      "heading" => __("Feature Box Icon Bg Color Opacity on hover", "brad-framework"),
      "param_name" => "icon_bgc_opacity_hover",
	  "dependency" => Array('element' => "icon_style", 'value' => array('style2','style3')),
      "value" => '1'
      ),	    	  
  
  
  $add_bottom_margin,
   array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )	 	    	  
  ),
  'default_content' => '
  [vc_feature_box icon="0|fontawesome"]
  [vc_feature_box icon="0|fontawesome"]
  ',
  "js_view" => 'VcFeaturesView'
  )
  );

  // Feature Box
  vc_map( array(
   "name"  => __("Feature Box", "brad-framework"),
   "base" => "vc_feature_box",
   "show_settings_on_create" => false ,
   "is_container" => false ,
   "class" => "vc_custom_content_element vc_sc_feature",
   "content_element" => false ,
   "category" => __('Content', "brad-framework"),
   "params" => array(
   array(
      "type" => "icon",
      "heading" => __("Feature Icon", "brad-framework"),
      "param_name" => "icon" ,
	  "holder" => "icon" 
    ),
	
   array(
      "type" => "textfield",
      "heading" => __("Feature Alphabet", "brad-framework"),
	  "description" => __("Feature Alphabet text if you want display text inplace of icon. <strong>Note:</strong>If this field has some value then icon will not be display and also you should use max 2 or 3 Words.", "brad-framework" ),
      "param_name" => "text" ,
    ),	
	
  array(
      "type" => "textfield",
      "heading" => __("Title", "brad-framework"),
      "param_name" => "title",
	  "value" => __("Your Title Here ...","brad-framework"),
	  "holder" => "h4"
	),  
	  
   array(
      "type" => "textarea_html",
      "heading" => __("Content", "brad-framework"),
      "param_name" => "content",
	  "value" => __("You can put any Content Here...","brad-framework"), 
	  "holder" => "div"
    )
  ,
  $add_css_animation, 
  $add_css_animation_delay, 
  array(
      "type" => "dropdown",
      "heading" => __("Apply Css Animation to ?", "brad-framework"),
      "param_name" => "css_animation_type",
	  "value" => array(__('Whole Box',"brad-framework") => 'box' , __('Only Icons and Images',"brad-framework") => 'iconbox' )
  )	
 
  )	
 ));



/* clients
---------------------------------------------------------------*/

vc_map( array(
  "name"  => __("Clients", "brad-framework"),
  "base" => "vc_clients",
  "show_settings_on_create" => true ,
  "is_container" => true,
  "add_title" => __("Add New Client", "brad-framework") ,  
  "icon" => "vc_icon_clients",
  "category" => __('Content', "brad-framework"),
  "params" => array(
   array(
      "type" => "taxonomy",
      "heading" => __("Clients Category", "brad-framework"),
      "param_name" => "categories",
      "value" => "" ,
	  "taxonomy" => "clients-category",
	  "description" => __("Narrow your output by selecting desired categories","brad-framework")
	),
	
	$add_order,
	$add_order_by,
	
	array(
      "type" => "textfield",
      "heading" => __("Clients Max Count", "brad-framework"),
	  "param_name" => "count",
      "value" => 5
    )
	,
	$add_img_size,
	$add_custom_img_size,
    array(
      "type" => "dropdown",
      "heading" => __("Clients Appearance", "brad-framework"),
	  "param_name" => "appearance",
      "value" => Array ( __("Columns","brad-framework") => "columns"  ,__("Carousel") => "carousel"),
	  "admin_label" => true
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Columns Count", "brad-framework"),
      "param_name" => "columns",
      "value" => array( 2 ,3 , 4 , 5 , 6 ),
      "description" => __("Set the number of Columns.", "brad-framework"),
	  "admin_label" => true
	  )
	 ,
	 
	 array(
      "type" => "dropdown",
      "heading" => __("Container Style", "brad-framework"),
      "param_name" => "style",
      "value" => array('No divider' => 'style1','With Fancy Divider' => 'style2','Box Type' => 'style3'),
      "description" => __("Default Style for Clients  Container", "brad-framework")
    )  
  ,
  $add_box_bgcolor,
  $add_box_opacity,
  $add_box_bgcolor_hover,
  $add_box_opacity_hover,
  $add_box_radius,
  $add_box_stroke_color,
  $add_box_stroke_color_hover,
  $add_box_padding ,
  $add_inner_vpadding ,
  $add_inner_hpadding ,
  array(
      "type" => "checkbox",
      "heading" => __("Autoplay", "brad-framework"),
      "param_name" => "autoplay",
      "value" => array( __('Yes',"brad-framework") => 'yes'),
	  "dependency" => Array('element' => "appearance", 'value' => array('carousel'))
   )  
  , 
  array(
      "type" => "dropdown",
      "heading" => __("Display Navigation", "brad-framework"),
      "param_name" => "navigation",
      "value" => array( __('Yes',"brad-framework") => 'yes' , __('No',"brad-framework") => 'no' ),
	  "dependency" => Array('element' => "appearance", 'value' => array('carousel'))
    )  
  , 
  array(
       "type" => "dropdown",
       "heading" => __("CSS Animation", "brad-framework"),
       "param_name" => "css_animation",
       "admin_label" => true,
       "value" => array(__("No", "brad-framework") => '', __("Left to Right", "brad-framework") => "fadeInLeft", __("Right to Left", "brad-framework") => "fadeInRight", __("Bottom to top", "brad-framework") => "fadeInTop", __("Top to Bottom", "brad-framework") => "fadeInBottom", __("Appear from center", "brad-framework") => "appearFromCenter" , __("Fade In", "brad-framework") => "fadeIn"),
       "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "brad-framework"),
	   "dependency" => Array('element' => "appearance", 'value' => array('columns'))
) ,

    array(
        "type" => "dropdown",
        "heading" => __("CSS Animation Delay", "brad-framework"),
		"description" => __("Css Animation delay between elements in milseconds","brad_framework"),
        "param_name" => "css_animation_delay",
        "value" => array(__("No Delay", "brad-framework") => '0', '100' => '100' , '200' => '200', '300' => '300' , '400' => '400' , '500' => '500' ,'600' => '600' , '700' => '700' , '800' => '800'),
		"dependency" => Array('element' => "appearance", 'value' => array('columns'))
), 
  array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )	 
 )
) );



/* Counters
---------------------------------------------------------------*/

vc_map( array(
  "name"  => __("Counters", "brad-framework"),
  "base" => "vc_counters",
  "show_settings_on_create" => true ,
  "is_container" => true,
  "add_title" => __("Add New Counter", "brad-framework") ,  
  "icon" => "vc_icon_counters",
  "category" => __('Content', "brad-framework"),
  "params" => array(
   
    array(
      "type" => "dropdown",
      "heading" => __("Columns Count", "brad-framework"),
      "param_name" => "columns",
      "value" => array( 2 ,3 , 4 , 5 , 6 ),
      "description" => __("Set the number of Columns.", "brad-framework"),
	  "admin_label" => true
	  )
	 ,
	 
	array(
      "type" => "dropdown",
      "heading" => __("Counter Box Container Style", "brad-framework"),
      "param_name" => "style",
      "value" => array( 'Style 1 (Default)' => 'style1' ,'Style 2 (Fancy Divider)' => 'style2' ,'Style 3 (Box Type)' => 'style3' ),
      "description" => __("Default Style for Counter Box Container.", "brad-framework")
    ),
	
  $add_box_padding ,
  $add_inner_hpadding,
  $add_inner_vpadding,
  $add_box_bgcolor,
  $add_box_opacity,
  $add_box_radius,
  $add_box_radius_round,
  $add_box_shadow,
  $add_box_stroke_color,  
  $add_bottom_margin,
  array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )	 
  ),
   'default_content' => '
  [vc_counter]
  [vc_counter]
  ',
  "js_view" => 'VcCountersView'
) );

vc_map( array(
  "name" => __("Counter", "brad-framework"),
  "base" => "vc_counter",
  "class" => "vc_sc_counter vc_custom_content_element",
  "is_container" => false ,
  "content_element" => false,
  "params" => array(
   
   array(
      "type" => "icon",
      "heading" => __("Counter Icon", "brad-framework"),
      "param_name" => "icon"
    )
  ,
  
  array(
      "type" => "dropdown",
      "heading" => __("Counter Icon Color", "brad-framework"),
      "param_name" => "icon_color" ,
	  "value" => array(
	       __("Default","brad-framework") => "" ,
		   __("Primary Color","brad-framework") => "primary"
		   )
    ),
	
	
   array(
      "type" => "textfield",
      "heading" => __("Value to Count", "brad-framework"),
      "param_name" => "value" ,
	  "description" => __("This value must be an integer","brad-framework"),
	  "admin_label" => true
    ),
	
	 
    array(
      "type" => "textfield",
      "heading" => __("Unit", "brad-framework"),
      "param_name" => "unit",
	  "description" => __('You can use any text such as % , cm or any other . Leave Blank if you do not want to display any unit value',"brad-framework")
    )
	,
	array(
      "type" => "dropdown",
      "heading" => __("Value Color", "brad-framework"),
      "param_name" => "value_color" ,
	  "value" => array(
	       __("Default","brad-framework") => "" ,
		   __("Primary Color","brad-framework") => "primary"
		   )
    ),
	

    array(
      "type" => "textfield",
      "heading" => __("Counter Title", "brad-framework"),
      "param_name" => "title" ,
	  "value" => __("Your Title Goes Here...","brad-framework"),
    ),
	$add_css_animation,
	$add_css_animation_delay
  )
    ,
  "js_view" => 'VcFeatureView'
) );



vc_map( array(
  "name" => __("Teaser Box", "brad-framework"),
  "base" => "vc_teaser_box",
  "class" => "vc_sc_teaser_box",
  "is_container" => false,
  "content_element" => true ,
  "params" => array(
  
   array(
      "type" => "attach_image",
      "heading" => __("Image", "brad-framework"),
      "param_name" => "image",
	  "holder" => "img"
    ),
	
	array(
      "type" => "dropdown",
      "heading" => __("Text Scheme", "brad-framework"),
      "param_name" => "text_scheme" ,
	  "value" => array(
	       __("Default","brad-framework") => "default" ,
		   __("White","brad-framework") => "scheme1")
    ),
	
    array(
      "type" => "textfield",
      "heading" => __("Teaser Heading", "brad-framework"),
      "param_name" => "title"
    ),
	
	array(
      "type" => "textarea_html",
      "heading" => __("Teaser Content", "brad-framework"),
      "param_name" => "content",
	  "value" => __('That Should be any Description',"brad-framework"),
	  "hover" => "div"
    )
  )

) );



/* Team member
-------------------------------------------------------------*/
vc_map( array(
  "name" => __("Person", "brad-framework"),
  "base" => "vc_person",
  "icon" => "vc_icon_person",
  "class" => "vc_sc_person",
  "is_container" => false ,
  "content_element" => true,
  "params" => array(
   
	array(
      "type" => "attach_image",
      "heading" => __("Person Image", "brad-framework"),
      "param_name" => "image" 
    ),
    array(
      "type" => "textfield",
      "heading" => __("Person name", "brad-framework"),
      "param_name" => "name",
	  "admin_label" => true
    ),
    array(
      "type" => "textfield",
      "heading" => __("Person Role", "brad-framework"),
      "param_name" => "role",
	  "admin_label" => true
    ),
    array(
      "type" => "exploded_textarea",
      "heading" => __("Biography", "brad-framework"),
      "param_name" => "bio",
	  "description" => __('Leave Blank if you do not want to display biography',"brad-framework"),
	  "dependency" => Array('element' => "style", 'value' => array('style1'))	 
    ),
	array(
      "type" => "checkbox",
      "heading" => __("Social Links", "brad-framework"),
      "param_name" => "social_links" ,
	  "value" => Array('Twitter'=>'twitter' ,'Facebook'=>'facebook','Linkedin'=>'linkedin','Youtube'=>'youtube','Google plus'=>'google','Behance'=>'behance','Dribbble'=>'dribbble','Pinterest'=>'pinterest')
    ),
	array(
      "type" => "textfield",
      "heading" => __("Twitter link", "brad-framework"),
      "param_name" => "twitter" ,
	  "dependency" => Array('element' => "social_links", 'value' => array('twitter'))
    ),
	array(
      "type" => "textfield",
      "heading" => __("Facebook link", "brad-framework"),
      "param_name" => "facebook" ,
	  "dependency" => Array('element' => "social_links", 'value' => array('facebook'))
    ),
	array(
      "type" => "textfield",
      "heading" => __("linkedin link", "brad-framework"),
      "param_name" => "linkedin" ,
	  "dependency" => Array('element' => "social_links", 'value' => array('linkedin'))
    ),
	array(
      "type" => "textfield",
      "heading" => __("youtube link", "brad-framework"),
      "param_name" => "youtube" ,
	  "dependency" => Array('element' => "social_links", 'value' => array('youtube'))
    ),
	array(
      "type" => "textfield",
      "heading" => __("google link", "brad-framework"),
      "param_name" => "google" ,
	  "dependency" => Array('element' => "social_links", 'value' => array('google'))
    ),
	array(
      "type" => "textfield",
      "heading" => __("behance link", "brad-framework"),
      "param_name" => "behance" ,
	  "dependency" => Array('element' => "social_links", 'value' => array('behance'))
    ),
	array(
      "type" => "textfield",
      "heading" => __("dribbble link", "brad-framework"),
      "param_name" => "dribbble" ,
	  "dependency" => Array('element' => "social_links", 'value' => array('dribbble'))
    ),
	array(
      "type" => "textfield",
      "heading" => __("pinterest link", "brad-framework"),
      "param_name" => "pinterest" ,
	  "dependency" => Array('element' => "social_links", 'value' => array('pinterest'))
    )
  )
) );



/* inner Row
--------------------------------------------------------*/

vc_map( array(
  "name" => __("Row", "brad-framework"), //Inner Row
  "base" => "vc_row_inner",
  "content_element" => false,
  "is_container" => true,
  "icon" => "icon-wpb-row",
  "show_settings_on_create" => false,
  "params" => array(
   array(
      "type" => "checkbox",
      "heading" => __("Enable Bottom Margin ?", "brad-framework"),
      "param_name" => "bottom_margin",
	  "value" => array(__('Yes',"brad-framework") => 'yes'  )
   ),		
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )
  ),
  "js_view" => 'VcRowView'
) );


/* Inner Column
--------------------------------------------------------*/
vc_map( array(
  "name" => __("Column", "brad-framework"),
  "base" => "vc_column",
  "is_container" => true,
  "content_element" => false,
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    ),
	$add_hidden_array
  ),
  "js_view" => 'VcColumnView'
) );


/* Box
---------------------------------------------------------------*/

vc_map( array(
  "name" => __("Box", "brad-framework"),
  "base" => "vc_box",
  "is_container" => true,
  "class" => "clearfix",
  "icon" => "vc_icon_box",
  "show_settings_on_create" => true ,
  "category" => __('Content', "brad-framework"),
  "params" => array(
   array(
      "type" => "colorpicker",
      "heading" => __("Box Background color", "brad-framework"),
      "param_name" => "bg_color",
	  "value" => "" ,
	  "description" => __('Leave blank for transparent background','brad-framework')
	  ),
	  
  array(
      "type" => "textfield",
      "heading" => __("Background Opacity", "brad-framework"),
      "param_name" => "opacity",
	  "value" => "1",
	  "description" => __("The value should be in betweem 0 and 1 , for ex. 0.755","brad-framework")
	  ),	
	  
array(
      "type" => "colorpicker",
      "heading" => __("Box Border color", "brad-framework"),
      "param_name" => "br_color",
	  "value" => "" ,
	  "description" => __('Leave blank for transparent border','brad-framework')
	  ),
	  
  
  array(
      "type" => "textfield",
      "heading" => __("Border Width", "brad-framework"),
      "param_name" => "br_width",
	  "value" => "1"
   ),	 	    

  array(
      "type" => "checkbox",
      "heading" => __("Enable Top Radius", "brad-framework"),
      "param_name" => "br_top",
	  "value" => array(__("Yes","brad-framework") => "yes" )
	  ),
	  
  array(
      "type" => "checkbox",
      "heading" => __("Enable Bottom Radius", "brad-framework"),
      "param_name" => "br_bottom",
	  "value" => array(__("Yes","brad-framework") => "yes" )
	  ),
	  
   array(
      "type" => "textfield",
      "heading" => __("Padding", "brad-framework"),
      "param_name" => "padding",
	  "value" => "20px" ,
	  "description" => __("Default padding in px . You can put formats like '20px' or '10px 20px 10px' or any css padding pattern.","brad-framework")
	  ),	  	  
	  	  
   array(
      "type" => "dropdown",
      "heading" => __("box Text color Scheme ?", "brad-framework"),
      "param_name" => "color_scheme",
	  "value" => array(
	               __('Default Text',"brad-framework") => '' , 
	               __('All text to White',"brad-framework") => 'scheme1' 
				   )			   
    ),
	$add_hidden_array,		
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    ) 
  ),
   "js_view" => 'VcColumnView'
) );



/* Section 
--------------------------------------------------------*/
vc_map( array(
  "name" => __("Section", "brad-framework"),
  "base" => "vc_section",
  "is_container" => true,
  "icon" => "icon-wpb-row",
  "content_element" => false ,
  "show_settings_on_create" => false,
  "category" => __('Content', "brad-framework"),
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => __("Section Type","brad-framework"),
      "param_name" => "section_type",
	  "value" => array(
		"Default" => "",
		"Full Width" => "full-width",
		"Full Width With Padding" => "full-width-with-padding",
		"940 Grid" => "grid-940"
	   )
    )
	,
	array(
	  "type" => "textfield",
	  "heading" => __("Padding Top","brad-framework"),
	  "value" => "60",
	  "param_name" => "sp_top",
	  "description" => __("Do't Include px ( in numbers only)","brad-framework")
	  )
	,
	array(
	  "type" => "textfield",
	  "heading" => __("Padding Bottom","brad-framework"),
	  "value" => "60",
	  "param_name" => "sp_bottom",
	  "description" => __("Do't Include px (in numbers only)","brad-framework")
	  )
	,
	array(
      "type" => "checkbox",
      "heading" => __("Enable Border","brad-framework"),
      "param_name" => "enable_border",
	  "value" => Array(__("Yes", "brad-framework") => 'yes') ,
      "description" => ""
    )
	,
   array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => __("Background color","brad-framework"),
	"param_name" => "bg_color",
	"value" => "" 
	)
   ,
   array(
	"type" => "dropdown" , 
	"heading" => __("Background Type","brad-framework"),
	"param_name" => "bg_type",
	"value" => array(__("Image","brad-framework") => "image", __('Video','brad-framework') => 'video')
	) 
	,
   
   array(
	"type" => "attach_image", 
	"class" => "bg_image",
	"heading" => __("Background image","brad-framework"),
	"param_name" => "bg_image",
    "dependency" => array("element" => "bg_type" , "value" => array("image") )
	),
   
	array(
      "type" => "dropdown",
      "heading" => __("Background Style","brad-framework"),
      "param_name" => "bg_style",
	  "value" => Array(__('Stretch','brad-framework') => 'stretch' , __('Repeat','brad-framework') => 'repeat' ,  __('No Repeat','brad-framework') => 'norepeat' ),
      "description" => "",
	  "dependency" => array("element" => "bg_type" , "value" => array("image") )
    )
	,
    array(
      "type" => "dropdown",
      "heading" => __("Fixed Background","brad-framework"),
      "param_name" => "fixed_bg",
	  "value" => Array(__('Yes','brad-framework') => 'yes' , __('No','brad-framework') => 'no' ),
      "description" => "",
	  "dependency" => array("element" => "bg_type" , "value" => array("image") )
    ),
	
	 array(
      "type" => "checkbox",
      "heading" => __("Enable Parallax","brad-framework"),
      "param_name" => "enable_parallax",
	  "value" => Array(__("Yes","brad-framework") => 'yes'),
	  "dependency" => array("element" => "bg_type" , "value" => array("image") )
    )
	,
    array(
	  "type" => "textfield", 
	  "heading" => __("Parallax Speed","brad-framework"),
	  "param_name" => "parallax_speed",
	  "description" => __("Default parallax speed in seconds" ,"brad-framework" ),
	  "value" => "0.8" ,
	  "dependency" => Array('element' => "enable_parallax", "value" => array("yes"))
	  )	,

    
   array(
	"type" => "attach_image", 
	"heading" => __("Fallback image for video","brad-framework"),
	"param_name" => "fb_image" ,
	"dependency" => array("element" => "bg_type" , 'value' => array('video'))
	)
	,
	
	array(
	"type" => "textfield", //attach_video
	//"holder" => "img",
	"heading" => __("Background Video mp4","brad-framework"),
	"param_name" => "bg_video_mp4",
	"dependency" => array("element" => "bg_type" , 'value' => array('video'))
	)
	,
	array(
	"type" => "textfield", //attach_video
	//"holder" => "img",
	"heading" => __("Background Video ogg","brad-framework"),
	"param_name" => "bg_video_ogg",
	"dependency" => array("element" => "bg_type" , 'value' => array('video'))
	)
	,
	array(
	"type" => "textfield", //attach_video
	//"holder" => "img",
	"heading" => __("Background Video WebM","brad-framework"),
	"param_name" => "bg_video_webm",
	"dependency" => array("element" => "bg_type" , 'value' => array('video'))
	 )
	 ,
	array(
	"type" => "dropdown",
	"value" => array(
	            __("According to Content height","brad-framework") => "content",
				__("According to Video height","brad-framework") => "video"
				),
	"heading" => __("Section height","brad-framework"),
	"param_name" => "height",
	"dependency" => array("element" => "bg_type" , 'value' => array('video'))
	 )
	 ,
	 
	 
	 array(
	"type" => "dropdown",
	"value" => array(
	            __("Default","brad-framework") => "",
				__("16:9","brad-framework") => "16:9",
				__("4:3","brad-framework") => "4:3"
				),
	"heading" => __("Video Aspect Ratio","brad-framework"),
	"param_name" => "video_ratio",
	"dependency" => array("element" => "bg_type" , 'value' => array('video'))
	 )
	 ,


   		
	array(
	"type" => "checkbox",
	"value" => array(__("Yes","brad-framework") => "yes"),
	"heading" => __("Enable Background Overlay","brad-framework"),
	"param_name" => "bg_overlay") 
	,
	array(
	"type" => "colorpicker",
	"value" => "",
	"heading" => __("Background Overlay Color","brad-framework"),
	"param_name" => "bg_overlay_color",
	"dependency" => Array('element' => "bg_overlay", "value" => array("yes"))
	)
	,
	
	array(
	"type" => "textfield",
	"value" => "0.4",
	"heading" => __("Background Overlay Color Opacity","brad-framework"),
	"param_name" => "bg_overlay_opacity",
	"dependency" => Array('element' => "bg_overlay", "value" => array("yes"))
	)
	,
	
	
	array(
      "type" => "dropdown",
      "heading" => __("Background Overlay Dots","brad-framework"),
      "param_name" => "bg_overlay_dot",
	  "value" => Array(__('No Dots','brad-framework') => 'no' , __('1x1 px','brad-framework') => 'style1',__('3x3 px','brad-framework') => 'style2'  ,__('White 1x1 px','brad-framework') => 'style3',__('White 3x3 px','brad-framework') => 'style4' ),
      "description" => "",
	  "dependency" => Array('element' => "bg_overlay", "value" => array("yes"))
    ),

	
	   array(
      "type" => "checkbox",
      "heading" => __("Enable Divider Triangle","brad-framework"),
      "param_name" => "enable_triangle",
	  "value" => Array(__("Yes","brad-framework") => 'yes')
    )
	,
	
	array(
      "type" => "colorpicker",
      "heading" => __("Divider triangle color","brad-framework"),
      "param_name" => "triangle_color",
	  "dependency" => array("element" => "enable_trianle", "value" => array("yes")),
	  "value" => ''
    )	
	,
  array(
      "type" => "dropdown",
      "heading" => __("Triangle Location","brad-framework"),
      "param_name" => "triangle_location",
	  "dependency" => array("element" => "enable_trianle", "value" => array("yes")),
	  "value" => array(
		__("Top","brad-framework") => "top",
		__("Bottom","brad-framework")  => "bottom",
	   )
    )
	,	
	
	array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )
  ),
  "js_view" => 'VcSectionView'
  )
);



/* Double Section
--------------------------------------------------------*/
vc_map( array(
  "name" => __("Double Section", "brad-framework"),
  "base" => "vc_double_section",
  "is_container" => true,
  "icon" => "icon-wpb-row",
  "content_element" => false ,
  "show_settings_on_create" => false,
  "category" => __('Content', "brad-framework"),
  "params" => array(
array(
      "type" => "checkbox",
      "heading" => __("Enable Border","brad-framework"),
      "param_name" => "enable_border",
	  "value" => Array(__("Yes", "brad-framework") => 'yes') ,
      "description" => ""
    )
	,
   array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => __("Background color","brad-framework"),
	"param_name" => "bg_color",
	"value" => "" 
	)
   ,
   array(
	"type" => "dropdown" , 
	"heading" => __("Background Type","brad-framework"),
	"param_name" => "bg_type",
	"value" => array(__("Image","brad-framework") => "image", __('Video','brad-framework') => 'video')
	) 
	,
   
   array(
	"type" => "attach_image", 
	"class" => "bg_image",
	"heading" => __("Background image","brad-framework"),
	"param_name" => "bg_image",
    "dependency" => array("element" => "bg_type" , "value" => array("image") )
	),
   
	array(
      "type" => "dropdown",
      "heading" => __("Background Style","brad-framework"),
      "param_name" => "bg_style",
	  "value" => Array(__('Stretch','brad-framework') => 'stretch' , __('Repeat','brad-framework') => 'repeat' ,  __('No Repeat','brad-framework') => 'norepeat' ),
      "description" => "",
	  "dependency" => array("element" => "bg_type" , "value" => array("image") )
    )
	,
    array(
      "type" => "dropdown",
      "heading" => __("Fixed Background","brad-framework"),
      "param_name" => "fixed_bg",
	  "value" => Array(__('Yes','brad-framework') => 'yes' , __('No','brad-framework') => 'no' ),
      "description" => "",
	  "dependency" => array("element" => "bg_type" , "value" => array("image") )
    ),
	
    
   array(
	"type" => "attach_image", 
	"heading" => __("Fallback image for video","brad-framework"),
	"param_name" => "fb_image" ,
	"dependency" => array("element" => "bg_type" , 'value' => array('video'))
	)
	,
	
	array(
	"type" => "textfield", //attach_video
	//"holder" => "img",
	"heading" => __("Background Video mp4","brad-framework"),
	"param_name" => "bg_video_mp4",
	"dependency" => array("element" => "bg_type" , 'value' => array('video'))
	)
	,
	array(
	"type" => "textfield", //attach_video
	//"holder" => "img",
	"heading" => __("Background Video ogg","brad-framework"),
	"param_name" => "bg_video_ogg",
	"dependency" => array("element" => "bg_type" , 'value' => array('video'))
	)
	,
	array(
	"type" => "textfield", //attach_video
	//"holder" => "img",
	"heading" => __("Background Video WebM","brad-framework"),
	"param_name" => "bg_video_webm",
	"dependency" => array("element" => "bg_type" , 'value' => array('video'))
	 )
	 ,
	
	   array(
      "type" => "checkbox",
      "heading" => __("Enable Divider Triangle","brad-framework"),
      "param_name" => "enable_triangle",
	  "value" => Array(__("Yes","brad-framework") => 'yes')
    )
	,
	
	
	array(
      "type" => "colorpicker",
      "heading" => __("Divider triangle color","brad-framework"),
      "param_name" => "triangle_color",
	  "dependency" => array("element" => "enable_trianle", "value" => array("yes")),
	  "value" => ''
    )	
	,
	
  array(
      "type" => "dropdown",
      "heading" => __("Triangle Location","brad-framework"),
      "param_name" => "triangle_location",
	  "value" => array(
		__("Top","brad-framework") => "top",
		__("Bottom","brad-framework")  => "bottom",
	   )
    )
	,	
	 array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )

  ),
  "js_view" => 'VcSectionView'
) );



/* Section  Container
--------------------------------------------------------*/

vc_map( array(
  "name" => __("Section Container", "brad-framework"),
  "base" => "vc_section_container",
  "is_container" => true,
  "icon" => "icon-wpb-row",
  "content_element" => false,
  "show_settings_on_create" => false,
  "category" => __('Content', "brad-framework"),
  "params" => array(),
  "js_view" => 'VcSectionContainerView'
) );


/* Double Section Container
---------------------------------------------------------*/

vc_map( array(
  "name" => __("Double Section Container", "brad-framework"),
  "base" => "vc_double_section_container",
  "is_container" => true,
  "content_element" => false,
  "show_settings_on_create" => false,
  "category" => __('Content', "brad-framework"),
  "params" => array(
      
array(
	  "type" => "textfield",
	  "heading" => __("Padding Top","brad-framework"),
	  "value" => "60",
	  "param_name" => "sp_top",
	  "description" => __("Do't Include px ( in numbers only)","brad-framework")
	  )
	,
	array(
	  "type" => "textfield",
	  "heading" => __("Padding Bottom","brad-framework"),
	  "value" => "60",
	  "param_name" => "sp_bottom",
	  "description" => __("Do't Include px (in numbers only)","brad-framework")
	  )
	,
	
	array(
	"type" => "checkbox", 
	"value" => array(__("Yes","brad-framework") => "yes" ),
	"heading" => __("Wrap to full width","brad-framework"),
	"param_name" => "fullwidth"
	),
	
	array(
	"type" => "checkbox", 
	"value" => array(__("Yes","brad-framework") => "yes" ),
	"heading" => __("Remove Horizental Padding or Whitespace","brad-framework"),
	"param_name" => "rm_padding"
	),
	
	
   array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => __("Background color","brad-framework"),
	"param_name" => "bg_color",
	"value" => "" 
	)
  
	,
	
	array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Background color Opacity","brad-framework"),
	"param_name" => "bg_color_opacity",
	"value" => "1" 
	)
  
	,
	
   
   array(
	"type" => "attach_image", 
	"class" => "bg_image",
	"heading" => __("Background image","brad-framework"),
	"param_name" => "bg_image"
	),
   
	array(
      "type" => "dropdown",
      "heading" => __("Background Style","brad-framework"),
      "param_name" => "bg_style",
	  "value" => Array(__('Stretch','brad-framework') => 'stretch' , __('Repeat','brad-framework') => 'repeat' ,  __('No Repeat','brad-framework') => 'norepeat' ),
      "description" => ""
    )
	,
	
	array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )
	 
  ),
  "js_view" => 'VcColumnView'
 ) 
);




/* Text Block
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Text Block", "brad-framework"),
  "base" => "vc_column_text",
  "icon" => "icon-wpb-layer-shape-text",
  "content_element" => true ,
  "wrapper_class" => "clearfix",
  "category" => __('Content', "brad-framework"),
  "params" => array(
    array(
      "type" => "textarea_html",
      "holder" => "div",
      "heading" => __("Text", "brad-framework"),
      "param_name" => "content",
      "value" => __("<p>I am text block. Click edit button to change this text.</p>", "brad-framework")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )
  )
) );

/* Separator (Divider)
---------------------------------------------------------- */
vc_map( array(
  "name"		=> __("Separator", "brad-framework"),
  "base"		=> "vc_separator",
  'icon'		=> 'icon-wpb-ui-separator',
  "show_settings_on_create" =>true,
  "category"    => __('Content', "brad-framework"),
  "params" => array(
	 array(
      "type" => "dropdown",
      "heading" => __( "Border Type" ,"brad-framework"),
      "param_name" => "type",
	  "value" => array(
	    "100% Border"        => "large",
		"Medium Border"      => "medium",
		"Small Border"       => "small",
		"Extra Small Border" => "tiny", )
	),
	
	array(
      "type" => "dropdown",
      "heading" => __( "Border Style" ,"brad-framework"),
      "param_name" => "style",
	  "value" => array(
	    "Normal Border" => "normal",
		"Thick Border"  => "double" )
	),
	
	array(
      "type" => "dropdown",
      "heading" => __( "Border Color" ,"brad-framework"),
      "param_name" => "color",
	  "value" => array(
	    "Light" => "light",
		"Dark"  => "dark" )
	),
	

	 array(
      "type" => "dropdown",
      "heading" => __('Separator Align', "brad-framework"),
      "param_name" => "align",
	  "value" => array(
		__("Align Center ( Default )", "brad-framework") => "center" ,
		__("Align Left", "brad-framework")   => "left",
		__("Align Right", "brad-framework")  => "right" ,
		 )
	),
	
	array(
      "type" => "icon",
      "heading" => __( "Icon" ,"brad-framework"),
      "param_name" => "icon",
	  "value" => ""
	),
	
	
    array(
      "type" => "textfield",
      "heading" => __("Margin Top","brad-framework"),
      "param_name" => "margin_top",
	  "value" =>  '5' ,
	  "description" => __('Default Top Margin in "px"',"brad-framework")
	),
	array(
      "type" => "textfield",
      "heading" => __("Margin Bottom","brad-framework"),
      "param_name" => "margin_bottom",
	  "value" =>  '25' ,
	  "description" => __('Default Bottom Margin in "px"',"brad-framework")
	)	
   )	
 ) 
);


/* Separator with text
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Separator with Text", "brad-framework"),
  "base" => "vc_text_separator",
  "icon" => "icon-wpb-ui-separator-label",
  "category" => __('Content', "brad-framework"),
  "params" => array(
	 array(
      "type" => "dropdown",
      "heading" => __("Style","brad-framework"),
      "param_name" => "style",
	  "value" => array(
		"Style 1" => "style1",
		"Style 2" => "style2"
	),
      "description" => ""
    ) 
	,
    array(
      "type" => "textfield",
      "heading" => __("Main Title", "brad-framework"),
      "param_name" => "title",
      "holder" => "div",
      "value" => __("Title", "brad-framework")
    ),
	
    array(
      "type" => "checkbox",
      "heading" => __("Extra Large Title ? ", "brad-framework"),
      "param_name" => "extra_large_title",
	  "value" => Array("" => 'yes'),
	  "description" => __("Enable this if you want a large title", "brad-framework")
    ),
		
	array(
      "type" => "textfield",
      "heading" => __("First Subtitle", "brad-framework"),
      "param_name" => "top_subtitle",
      "value" => ""
    ),
	
	array(
      "type" => "textfield",
      "heading" => __("Second Title", "brad-framework"),
      "param_name" => "bottom_subtitle",
      "value" => '' ,
	   "dependency" => Array('element' => "style", 'value' => array('style1'))
    ),
	
	array(
      "type" => "textarea_html",
      "heading" => __("Description", "brad-framework"),
      "param_name" => "content",
      "value" => ""
    ),
	
    array(
      "type" => "dropdown",
      "heading" => __("Description position", "brad-framework"),
      "param_name" => "description_align",
      "value" => array(__('Align center', "brad-framework") => "center", __('Align left', "brad-framework") => "left", __('Align right', "brad-framework") => "right")
    )
   ) 
 ) 
);


/* Gap
--------------------------------------------*/
vc_map( array(
	"name" => __("Gap","brad-framework"),
	"base" => "vc_gap",
	"icon" => "vc_icon_gap",
	"class" => "vc_sc_gap",
	"category" => __('Content',"brad-framework"),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap height","brad-framework"),
			"param_name" => "height",
			"value" => "20",
			"description" => __("In pixels.","brad-framework")
		),
		
		$add_hidden_array
	
	)
  ) 
);


/* Special Title
-----------------------------------------------------------*/
vc_map( array(
  "name"		=> __("Special Heading", "brad-framework"),
  "base"		=> "vc_heading",
  'icon'		=> 'vc_icon_heading',
  'class'		=> 'vc_sc_heading',
  "show_settings_on_create" => true ,
  "category"  => __('Content', "brad-framework"),
  "params" => array(
   
   array(
      "type" => "textarea",
      "heading" => __("Title","brad-framework"),
      "param_name" => "title",
	  "value" =>  'Your Title Here' ,
	  "holder" => "h4"
	),
	
   array(
      "type" => "dropdown",
      "heading" => __( "Heading Type" ,"brad-framework"),
      "param_name" => "type",
	  "value" => array(
	    "heading 1" => "h1",
		"heading 2" => "h2",
		"heading 3" => "h3",
		"heading 4" => "h4",
		"heading 5" => "h5",
		"heading 6" => "h6",
		 )
    ),
	
	array(
      "type" => "dropdown",
      "heading" => __( "Heading Divider" ,"brad-framework"),
      "param_name" => "style",
	  "value" => array(
	    __("No Divider" ,"brad-framework") => "default" ,
	    __("Divider at the bottom","brad-framework") => "style1",
		__("Divider in Center","brad-framework") => "style2",
		__("Divider in center with outer box" ,"brad-framework") => "style3" )
	),
	
   
   array(
      "type" => "dropdown",
      "heading" => __( "Divider Width" ,"brad-framework"),
      "param_name" => "divider_width",
	  "dependency" => array("element" => "style" , "value" => array("style1","style2","style3")),
	  "value" => array(
	    __("Default","brad-framework") => "default",
		__("Full","brad-framework") => "full" ,
		__("Small","brad-framework") => "small" )
	),
	
	array(
      "type" => "dropdown",
      "heading" => __( "Divider Color" ,"brad-framework"),
      "param_name" => "divider_color",
	  "dependency" => array("element" => "style" , "value" => array("style1","style2","style3")),
	  "value" => array(
	    __("Dark","brad-framework") => "dark",
		__("Light","brad-framework") => "light" )
	),
	
	
   array(
      "type" => "dropdown",
      "heading" => __( "Text Transform" ,"brad-framework"),
      "param_name" => "text_transform",
	  "value" => array(
	    "Default" => "Default",
		"Uppercase" => "uppercase" ,
		"lowercase" => "lowercase" )
	),
	
	array(
      "type" => "dropdown",
      "heading" => __( "Color" ,"brad-framework"),
      "param_name" => "color",
	  "value" => array(
	    "Default" => "default",
		"Primary Color" => "primary" )
	),
	
   array(
      "type" => "dropdown",
      "heading" => __('Heading Align', "brad-framework"),
      "param_name" => "align",
	  "value" => array(
		__("Align Left", "brad-framework") => "left",
		__("Align Center", "brad-framework") => "center" ,
		__("Align Right", "brad-framework") => "right" ,
		 ),
	 "dependency" => Array('element' => "style", 'value' => array('style1','style2','default'))	 
	),
   
   array(
      "type" => "textfield",
      "heading" => __("Margin Bottom","brad-framework"),
      "param_name" => "margin_bottom",
	  "value" =>  '20' ,
	  "description" => __("Default Margin From Bottom in px","brad-framework")
	 )	
   ),
   "js_view" => 'VcHeadingView'	
 ) 
);


/* Contact Form
-----------------------------------------------------------*/

vc_map( array(
	"name" => __("Contact Form","brad-framework"),
	"base" => "vc_contact_form",
	"icon" => "vc_icon_contact_form",
	"class" => "vc_sc_contact_form",
	"category" => __('Content', "brad-framework"),
	"params" => array(
	   
		array( 
	       "type" => "dropdown",
		   "heading" => __("Email Address","brad-framework"),
		   "param_name" => "email",
		   "description" => __("Email address where you want to send emails . You must need to fill your email address in Blandes Options -> General -> Email Address. If the given field is empty then contact form send all emails to your wordpress admin email ","brad-framework"),
		   "value" => array(
		       __("Default Email Address","brad-framework" ) => '',
			   __("Alternate Email Address" , "brad-framework" ) => 'alternate')
			   ),
		
		/*
		array(
		    "type" => "dropdown",
			"class" => "",
			"heading" => __("Contact form style","brad-framework"),
			"param_name" => "style" ,
			"value" => array(
			     __("Custom Style","brad-framework") => "" ,
				 __("Align Messgae box on right Side","brad-framework") => "style2"
			   )
			),
		*/	
		   
	  array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Form fields","brad-framework"),
			"param_name" => "fields",
			"value" => array(
				"name" => "name",
				"email" => "email",
				"telephone" => "telephone",
				"website" => "website",
				"country" => "country",
				"city" => "city",
				"company" => "company",
				"message" => "message"
			),
			"description" => __("At least One field  is required to show thw form .","brad-framework")
		),
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Message textarea height","brad-framework"),
			"param_name" => "message_height",
			"value" => "6",
			"description" => __("Number of lines.","brad-framework"),
			"dependency" => array("element" => "fields","value" => array("message"))
		),
		
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Required fields","brad-framework"),
			//"admin_label" => true,
			"param_name" => "required",
			"value" => array(
				"name" => "name",
				"email" => "email",
				"telephone" => "telephone",
				"website" => "website",
				"country" => "country",
				"city" => "city",
				"company" => "company",
				"message" => "message"
			)
		),
		

			
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Half width Fields","brad-framework"),
			//"admin_label" => true,
			"param_name" => "half_width",
			"description" => __("If you want two form fields in a single row","brad-framework"),
			"value" => array(
				"name" => "name",
				"email" => "email",
				"telephone" => "telephone",
				"website" => "website",
				"country" => "country",
				"city" => "city",
				"company" => "company",
				"message" => "message"
			)
		),
		
		
		array(
			"type" => "checkbox",
			"heading" => __('Show fancy icons ? ',"brad-framework"),
			"param_name" => "show_icons",
			"description" => __("Enable this if you want to show fancy icons in different form fields","brad-framework"),
			"value" => Array(__("Yes","brad-framework") => "yes" ),
		),
		
		
		array(
			"type" => "textfield",
			"heading" => __('Success Message',"brad-framework"),
			"param_name" => "success_message",
			"value" => __("<strong>Success!</strong> Your Message has been Sent","brad-framework"),
		),
		
		array(
			"type" => "textfield",
			"heading" => __('Error Message',"brad-framework"),
			"param_name" => "error_message",
			"value" => __("<strong>Error!</strong> An Error Occured While Sending your Message","brad-framework"),
		),
	
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __('Submit button text',"brad-framework"),
			"param_name" => "button_title",
			"value" => "Send message",
		),
		
		array(
		"type" => "dropdown",
		"param_name" => "style" ,
		"value" => 	$colors_arr,
		"heading" => __("Submit Button Style","brad-framework")
		)
		,
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Submit button size","brad-framework"),
			"param_name" => "button_size",
			"value" => array(
			    "Default" => "default",
				"Small" => "small",
				"Large" => "large",
			)
		)
	)
) );



/* Portfolio
-----------------------------------------------------------*/

vc_map( array(
  "name"  => __("Portfolio", "brad-framework"),
  "base" => "vc_portfolio",
  "show_settings_on_create" => true ,
  "is_container" => true ,
  "icon" => "vc_icon_portfolio",
  "class" => "vc_sc_portfolio",
  "category" => __('Content', "brad-framework"),
  "params" => array(
   array(
      "type" => "taxonomy",
      "heading" => __("Portfolio Category", "brad-framework"),
      "param_name" => "categories",
      "value" => "" ,
	  "taxonomy" => "portfolio_category"
	),
	
    array(
      "type" => "dropdown",
      "heading" => __("Columns Count", "brad-framework"),
      "param_name" => "columns",
      "value" => array(
	               "Two" => 2 ,
				   "Three" => 3 ,
				   "Four" => 4 ,
				   "Five" => 5), 
      "description" => __("Set the number of Columns.", "brad-framework")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Portfolio Style", "brad-framework"),
      "param_name" => "portfolio_style",
      "value" => array(
	         'With Fancy Divider'  => 'style1',
			 'Box Style with Info' => 'style2',
			 'Simple Grid Style'   => 'style3',
			// 'Masonry Portfolios'  => 'style4'
			),
      "description" => __("Default Style for Portfolio", "brad-framework")
    )  
   ,
   
   $add_box_padding
   ,
   
    array(
      "type" => "checkbox",
      "heading" => __("Optimize For FullWidth ? ", "brad-framework"),
      "param_name" => "fullwidth",
	  "value" => Array("Yes"=>"yes"),
	  "description" => __("Check this option if you are placing the portfolio in a section that is using full width of browser. This will optimize the images and add more responsive behavior according to browser width","js_compser")
	)
   ,
   
   array(
      "type" => "dropdown",
      "heading" => __("Portfolio Image Size ? ", "brad-framework"),
      "param_name" => "img_size",
	  "value" => Array("Automatc ( Will get the best image size according to columns width)"=>"automatic",__("Custom Image Size","brad_framework") => "custom"),
	  "description" => __("if you choose custom image size the portfolio image width will be still 100% to fill the container.","brad-framework"),
	  "dependency" => array("element" => "portfolio_style" , "value" => array("style1","style2","style3"))
	)
   ,

  array(
      "type" => "textfield",
      "heading" => __("Custom Image Size", "brad-framework"),
      "param_name" => "custom_img_size",
	  "value" => "",
	  "description" => __("Custom image size in width X Height. For ex. 570x400 <strong>note:</strong>Do't include px or any whitespace."),
	  "dependency" => array("element" => "img_size" , "value" => array("custom"))
	)
   ,   
   
   array(
      "type" => "dropdown",
      "heading" => __("Portfolio Overlay Style ? ", "brad-framework"),
      "param_name" => "overlay_style",
	  "value" => Array(
	               "style1" => "style1",
				   "style2" => "style2"
				   ),
	  "dependency" => Array('element' => "portfolio_style", 'value' => array('style3','style4'))
	)
   ,
   array(
      "type" => "checkbox",
      "heading" => __("Is Sortable ", "brad-framework"),
	  "description" => __("Check this if you want to show sortable tabs for portfolio","brad-framework"),
      "param_name" => "sortable",
	  "value" => Array("Yes"=>'yes')
	)
   ,
   
   array(
      "type" => "dropdown",
      "heading" => __("Sortable Tabs Align ? ", "brad-framework"),
      "param_name" => "sortable_align",
	  "value" => Array(
	               "Center (Default)" => "",
	               "Left" => "left",
				   "Right" => "right"
				   ),
	  "dependency" => Array('element' => "sortable", 'value' => array('yes') )
	)
   ,
   
   array(
      "type" => "checkbox",
      "heading" => __("Show Sortable Label ?", "brad-framework"),
      "param_name" => "sortable_label",
	  "description" => __("check this if you want to have sortable tabs a label","brad-framework"),
	  "value" => Array("Yes"=>'yes'),
	  "dependency" => Array('element' => "sortable", 'value' => array('yes') )
	)
	,
	
  /*	
   array(
      "type" => "dropdown",
      "heading" => __("Sortable Tabs Color Scheme ? ", "brad-framework"),
      "param_name" => "sortable_color_scheme",
	  "value" => Array(
	               "Default Scheme ( Black Text )" => "",
				   "light Scheme ( All text to White )" => "light"
				   ),
	  "dependency" => Array('element' => "sortable", 'value' => array('yes') )
	)
   ,
   
   array(
      "type" => "dropdown",
      "heading" => __("Sortable Tabs Container Type ? ", "brad-framework"),
      "param_name" => "sortable_container",
	  "value" => Array(
	               "Transparent Container ( Default )" => "",
				   "Box Container" => "box"
				   ),
	  "dependency" => Array('element' => "sortable", 'value' => array('yes') )
	)
   ,
   
   
   
   array(
      "type" => "colorpicker",
      "heading" => __("Sortable Tabs Container Background Color ? ", "brad-framework"),
      "param_name" => "sortable_bg_color",
	  "value" => "",
	  "description" => __("Leave Blank for Default : transparent","brad-framework"),
	  "dependency" => Array('element' => "sortable_container", "value" => "box" )
	)
   ,
  */
   
    array(
      "type" => "checkbox",
      "heading" => __("Show Categories ?", "brad-framework"),
      "param_name" => "show_categories",
	  "description" => __("Show categories in portfolio info","brad-framework"),
	  "value" => Array("Yes"=>'yes')
	)
	,
   array(
      "type" => "checkbox",
      "heading" => __("Disable Lightbox icon ?", "brad-framework"),
      "param_name" => "disable_lb_icon",
	  "value" => Array("Yes"=>'yes'),
	  "description" => __("hide the  lightbox icon used to view large portfolio image","brad-framework")
	),
	
	array(
      "type" => "checkbox",
      "heading" => __("Disable Link icon ?", "brad-framework"),
      "param_name" => "disable_li_icon",
	  "value" => Array("Yes"=>'yes'),
	  "description" => __("hide link icon that wil be displaced when mouseover portfolio image","brad-framework")
	)
    ,
	
	array(
      "type" => "checkbox",
      "heading" => __("Disable Link on Title ?", "brad-framework"),
      "param_name" => "disable_li_title",
	  "value" => Array("Yes"=>'yes'),
	  "description" => __("disable the portfolio detail page link on title","brad-framework")
	)
    ,
	
   array(
       "type" => "dropdown",
       "heading" => __("CSS Animation", "brad-framework"),
       "param_name" => "css_animation",
       "value" => array(__("No", "brad-framework") => '', __("Left to Right", "brad-framework") => "fadeInLeft", __("Right to Left", "brad-framework") => "fadeInRight", __("Bottom to top", "brad-framework") => "fadeInTop", __("Top to Bottom", "brad-framework") => "fadeInBottom", __("Appear from center", "brad-framework") => "appearFromCenter" , __("Fade In", "brad-framework") => "fadeIn" ,  __("Fall 3D", "brad-framework") => "fallPerspective" ,  __("Fly 3D", "brad-framework") => "fly" ,  __("Flip", "brad-framework") => "flip" ),
  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "brad-framework")
  ),
  $add_css_animation_delay ,
  array(
      "type" => "textfield",
      "heading" => __("Maximun Number of Portfolio Items to Show", "brad-framework"),
      "param_name" => "max_items",
      "value" => 8 
    )
	,
	$add_order_by,
	$add_order,
	$add_bottom_margin
  ,
  
  array(
      "type" => "dropdown",
      "heading" => __("Pagination", "brad-framework"),
      "param_name" => "pagination",
      "value" => array( __('Standard Pagination','brad-framework') => 'default' ,
	                    __('Infinite Scroll','brad-framework') => 'ifscroll' ,
						__('Load More Button','brad-framework') => 'loadmore' ,
						__('No Pagination','brad-framework') => 'no' )
						)
   ,
   
     array(
      "type" => "dropdown",
      "heading" => __("Button Style", "brad-framework"),
      "param_name" => "button_style",
      "value" => $button_colors_arr,
      "description" => __("Select the default style for your Load More button.", "brad-framework"),
	  'dependency' => array("element" => "pagination" , 'value' => array('loadmore'))
    ),
	/*
    array(
      "type" => "textfield",
      "heading" => __("Text on the button", "brad-framework"),
      "param_name" => "lm_title",
      "value" => __("Load More", "brad-framework"),
      "description" => __("Text on the load More button.", "brad-framework"),
	  'dependency' => array("element" => "pagination" , 'value' => array('loadmore'))
    ),
 */
   array(
      "type" => "icon",
      "heading" => __("Icon", "brad-framework"),
      "param_name" => "icon",
      "value" => "" ,
	  "description" => __("Select the icon for your Button. Click an icon to select it and again click the same icon to deselect it", "brad-framework"),
	  'dependency' => array("element" => "pagination" , 'value' => array('loadmore'))
    ),
   
   array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )		
   )
  )
 );


/* Portfolio Carousel
-----------------------------------------------------------*/

vc_map( array(
  "name"  => __("Portfolio Carousel", "brad-framework"),
  "base" => "vc_portfolio_carousel",
  "show_settings_on_create" => true ,
  "is_container" => true,
  "icon" => "vc_icon_portfolio_carousel",
  "class" => "vc_sc_portfolio_carousel",
  "category" => __('Content', "brad-framework"),
  "params" => array(
   array(
      "type" => "taxonomy",
      "heading" => __("Portfolio Category", "brad-framework"),
      "param_name" => "category",
      "value" => "" ,
	  "taxonomy" => "portfolio_category"
	  ),
    array(
      "type" => "dropdown",
      "heading" => __("Columns Count", "brad-framework"),
      "param_name" => "columns",
      "value" => array( "Two" => 2 ,"Three" => 3 ,"Four" => 4 , "Five" => 5 ),
      "description" => __("Set the number of Columns.", "brad-framework")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Portfolio Style", "brad-framework"),
      "param_name" => "portfolio_style",
      "value" => array( 'With Info at the Bottom' => 'style1' , 'With  Info on hoverlay' => 'style2' ),
      "description" => __("Default Style for Portfolio Carousel", "brad-framework")
    )  
   ,
   
    array(
      "type" => "dropdown",
      "heading" => __("Portfolio Image Size ? ", "brad-framework"),
      "param_name" => "img_size",
	  "value" => Array("Automatc ( Will get the best image size according to columns width)"=>"automatic",__("Custom Image Size","brad_framework") => "custom"),
	  "description" => __("if you choose custom image size the portfolio image width will be still 100% to fill the container.","brad-framework"),
	  "dependency" => array("element" => "portfolio_style" , "value" => array("style1","style2","style3"))
	)
   ,

  array(
      "type" => "textfield",
      "heading" => __("Custom Image Size", "brad-framework"),
      "param_name" => "custom_img_size",
	  "value" => "",
	  "description" => __("Custom image size in width X Height. For ex. 570x400 <strong>note:</strong>Do't include px or any whitespace."),
	  "dependency" => array("element" => "img_size" , "value" => array("custom"))
	)
   ,   
   
   array(
      "type" => "dropdown",
      "heading" => __("Portfolio Overlay Style ? ", "brad-framework"),
      "param_name" => "overlay_style",
	  "value" => Array(
	               "style1" => "style1",
				   "style2" => "style2"
				   ),
	  "dependency" => Array('element' => "portfolio_style", 'value' => array('style2'))
	)
   ,
   
   $add_box_padding,
   array(
      "type" => "checkbox",
      "heading" => __("Optimize FullWidth ? ", "brad-framework"),
      "param_name" => "fullwidth",
	  "value" => Array("Yes"=>'yes'),
	  "description" => __("Enable this if you want to use fullwidth of your browser . <strong>Note:</strong> To work this option you must have selected the section type to fullwidth or fullwidth with padding.","js_compser")
	)
   ,
    array(
      "type" => "checkbox",
      "heading" => __("Show Categories in Info ?", "brad-framework"),
      "param_name" => "show_categories",
	  "value" => Array("Yes"=>'yes')
	)
	, 	
      array(
      "type" => "checkbox",
      "heading" => __("Disable Lightbox icon ?", "brad-framework"),
      "param_name" => "disable_lb_icon",
	  "value" => Array("Yes"=>'yes'),
	  "description" => __("hide the  lightbox icon used to view large portfolio image","brad-framework")
	),
	
	array(
      "type" => "checkbox",
      "heading" => __("Disable Link icon ?", "brad-framework"),
      "param_name" => "disable_li_icon",
	  "value" => Array("Yes"=>'yes'),
	  "description" => __("hide link icon that wil be displaced when mouseover portfolio image","brad-framework")
	)
    ,
	
	array(
      "type" => "checkbox",
      "heading" => __("Disable Link on Title ?", "brad-framework"),
      "param_name" => "disable_li_title",
	  "value" => Array("Yes"=>'yes'),
	  "description" => __("disable the portfolio detail page link on title","brad-framework")
	)
    ,

  array(
      "type" => "textfield",
      "heading" => __("Maximun Number of Portfolio Items to Show", "brad-framework"),
      "param_name" => "max_items",
      "value" => 8 ,

    )
  ,
    array(
      "type" => "dropdown",
      "heading" => __("Show Navigation Icons ?", "brad-framework"),
      "param_name" => "navigation",
	  "value" => Array(
	         "Yes"=>'yes' , 
			 "No" => "no" ),
	)
   ,
  array(
      "type" => "checkbox",
      "heading" => __("Autoplay Slides ?", "brad-framework"),
      "param_name" => "autoplay",
	  "description" => __("Check this if you want to play the carousel Slides Automatically","brad-framework"),
	  "value" => Array("Yes"=>'yes'),
	),
	
    $add_order_by,
	$add_order
   )
 )
);


/* Portfolio Carousel
-----------------------------------------------------------*/

vc_map( array(
  "name"  => __("Blog", "brad-framework"),
  "base" => "vc_blog",
  "show_settings_on_create" => true ,
  "is_container" => true,
  "icon" => "vc_icon_blog",
  "class" => "vc_sc_blog",
  "category" => __('Content', "brad-framework"),
  "params" => array(
   array(
      "type" => "taxonomy",
      "heading" => __("Blog Category", "brad-framework"),
      "param_name" => "category",
      "value" => "" ,
	  "taxonomy" => "category"
	  ),
	    	
    $add_order_by,
	$add_order
  , 
	array(
      "type" => "dropdown",
      "heading" => __("Blog Type ?", "brad-framework"),
      "param_name" => "blog_type",
	  "value" => Array(
	       __( "Grid Blog" , "brad-framework" ) => "grid" ,
		   __( "Standard Blog" , "brad-framework" )  => "standard" ,
		  // __( "Timeline Blog" , "brad-framework" )  => "timeline" ,
		  // __( "Fullwidth Alternate" , "brad-framework" )  => "fullwidth"
		   )
	)
	,
	 
	 array(
      "type" => "dropdown",
      "heading" => __("Columns Count", "brad-framework"),
      "param_name" => "columns",
      "value" => array( "Two" => 2 ,"Three" => 3 ,"Four" => 4 ),
      "description" => __("Set the number of Columns.", "brad-framework"),
	  "dependency" => array("element" => "blog_type", "value" => array("grid"))
    ),
	  
   
   array(
      "type" => "dropdown",
      "heading" => __("Background Style ?", "brad-framework"),
      "param_name" => "bg_style",
	  "description" => __("This will help you to match  background color blog item with parent","brad-framework"),
	  "value" => Array(
	       __( "Transparent" , "brad-framework" ) => "" ,
		   __( "Transparent With Stroke" , "brad-framework" )  => "stroke",
		   __( "White" , "brad-framework" )  => "white",
		   __("White Smoke" , "brad-framework") => "grey"),
	  "dependency" => array("element" => "blog_type", "value" => array("grid"))	   
	)
	,

    array(
      "type" => "dropdown",
      "heading" => __("Show Author Name ?", "brad-framework"),
      "param_name" => "show_author",
	  "value" => Array(
	       __( "Yes" , "brad-framework" ) => "1" ,
		   __( "No" , "brad-framework" )  => "0" )
	)
	,
	
	array(
      "type" => "dropdown",
      "heading" => __("Show Date ?", "brad-framework"),
      "param_name" => "show_date",
	  "value" => Array(
	       __( "Yes" , "brad-framework" ) => "1" ,
		   __( "No" , "brad-framework" )  => "0" )
	)
	,
	
	array(
      "type" => "dropdown",
      "heading" => __("Show Categories ?", "brad-framework"),
      "param_name" => "show_categories",
	  "value" => Array(
	       __( "Yes" , "brad-framework" ) => "1" ,
		   __( "No" , "brad-framework" )  => "0" )
	)
	,
	
	array(
      "type" => "dropdown",
      "heading" => __("Enable Lightbox Icon ?", "brad-framework"),
      "param_name" => "show_lightbox",
	  "value" => Array(
	       __( "Yes" , "brad-framework" ) => "1" ,
		   __( "No" , "brad-framework" )  => "0" )
	)
	,
	
	/*
    array(
      "type" => "dropdown",
      "heading" => __("Show Excerpt ?", "brad-framework"),
      "param_name" => "show_excerpt",
	  "value" => Array(
	       __( "Yes" , "brad-framework" ) => "yes" ,
		   __( "No" , "brad-framework" ) => "no" )
	),
 */
    array(
      "type" => "textfield",
      "class" => "",
	  "heading" => __("Excerpt Length","brad-framework"),
      "param_name" => "excerpt_length",
	  "value" => "35"
	 ),
		  
  
  array(
      "type" => "textfield",
      "heading" => __("Maximun Number of Posts  to Show", "brad-framework"),
      "param_name" => "max_items",
      "value" => 8 
    ),

 
  
  array(
      "type" => "dropdown",
      "heading" => __("Pagination", "brad-framework"),
      "param_name" => "pagination",
      "value" => array( __('Standard Pagination','brad-framework') => 'default' ,
	                    __('Infinite Scroll','brad-framework') => 'ifscroll' ,
						__('Load More Button','brad-framework') => 'loadmore' ,
						__('No Pagination','brad-framework') => 'no' ) ,
	  "dependency" => array("element" => "blog_type", "value" => array("grid"))
	  )					
	 							
   ,
  
   array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )			
   )
 )
);





/* Portfolio Carousel
-----------------------------------------------------------*/

vc_map( array(
  "name"  => __("Posts Carousel", "brad-framework"),
  "base" => "vc_posts_carousel",
  "show_settings_on_create" => true ,
  "is_container" => true,
  "icon" => "vc_icon_posts_carousel",
  "class" => "vc_sc_posts_carousel",
  "category" => __('Content', "brad-framework"),
  "params" => array(
   array(
      "type" => "taxonomy",
      "heading" => __("Posts Category", "brad-framework"),
      "param_name" => "category",
      "value" => "" ,
	  "taxonomy" => "category"
	  ),
	  
    array(
      "type" => "dropdown",
      "heading" => __("Columns Count", "brad-framework"),
      "param_name" => "columns",
      "value" => array( "Two" => 2 ,"Three" => 3 ,"Four" => 4 ),
      "description" => __("Set the number of Columns.", "brad-framework")
    ),
	
  
    array(
      "type" => "dropdown",
      "heading" => __("Show Author Name ?", "brad-framework"),
      "param_name" => "show_author",
	  "value" => Array(
	       __( "Yes" , "brad-framework" ) => "yes" ,
		   __( "No" , "brad-framework" )  => "no" )
	)
	,
	

	array(
      "type" => "dropdown",
      "heading" => __("Show Categories ?", "brad-framework"),
      "param_name" => "show_categories",
	  "value" => Array(
	       __( "Yes" , "brad-framework" ) => "yes" ,
		   __( "No" , "brad-framework" )  => "no" )
	)
	,
	
	

    array(
      "type" => "dropdown",
      "heading" => __("Show Excerpt ?", "brad-framework"),
      "param_name" => "show_excerpt",
	  "value" => Array(
	       __( "Yes" , "brad-framework" ) => "yes" ,
		   __( "No" , "brad-framework" ) => "no" )
	),
 
    array(
      "type" => "textfield",
      "class" => "",
	  "heading" => __("Excerpt Length","brad-framework"),
      "param_name" => "excerpt_length",
	  "value" => "20"
	  ),
		   
    array(
      "type" => "checkbox",
      "heading" => __("Autoplay ?", "brad-framework"),
      "param_name" => "autoplay",
	  "description" => __("Check this if you want to play the carousel Slides Automatically","brad-framework"),
	  "value" => Array("Yes"=>'yes'),
	)
	, 
    array(
      "type" => "dropdown",
      "heading" => __("Show Navigation Icons ?", "brad-framework"),
      "param_name" => "navigation",
	  "value" => Array(
	         "Yes"=>'yes' , 
			 "No" => "no" ),
	)
   ,
  
  array(
      "type" => "textfield",
      "heading" => __("Maximun Number of Posts  to Show", "brad-framework"),
      "param_name" => "max_items",
      "value" => 8 
    )
   )
 )
);


// ! Mini Blog
vc_map( array(
	"name" => __("Mini Blog","brad-framework"),
	"base" => "vc_blog_list",
	"icon" => "vc_icon_blog_list",
	"class" => "vc_sc_blog_list",
	"category" => __('Content',"brad-framework"),
	"params" => array(
		array(
			"type" => "taxonomy",
			"taxonomy" => "category",
			"class" => "",
			"heading" => __("Categories","brad-framework"),
			"param_name" => "category",
			"description" => __("Note: By default, all your posts will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.","brad-framework")
		)
		,
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Layout Type","brad-framework"),
			"param_name" => "type",
			"value" => array(
				"With Images on Left Side" => "1",
				"With Fancy Date on Left" =>  "2"
			),
			"description" => ""
		),
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Excerpt Length","brad-framework"),
			"param_name" => "excerpt_length",
			"value" => "20"
		),
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Maxmium Number of posts to show","brad-framework"),
			"param_name" => "max_items",
			"value" => "6"
		),
		
	
		
	)
) );


/* Message box
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Message Box", "brad-framework"),
  "base" => "vc_message",
  "icon" => "vc_icon_message",
  "wrapper_class" => "alert",
  "category" => __('Content', "brad-framework"),
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => __("Message box type", "brad-framework"),
      "param_name" => "color",
      "value" => array(__('Informational', "brad-framework") => "alert-info", __('Warning', "brad-framework") => "alert-block", __('Success', "brad-framework") => "alert-success", __('Error', "brad-framework") => "alert-error"),
      "description" => __("Select message type.", "brad-framework")
    ),
    array(
      "type" => "textarea_html",
      "holder" => "div",
      "class" => "messagebox_text",
      "heading" => __("Message Content", "brad-framework"),
      "param_name" => "content",
      "value" => __("I am message box. Click edit button to change this text.", "brad-framework")
    ),
	 array(
      "type" => "checkbox",
      "heading" => __("Close Icon ?", "brad-framework"),
      "param_name" => "close",
	  "value" => Array(__("Yes","brad-framework") => "yes"),
      "description" => __("Check this if you want to show close button to hide Message Box.", "brad-framework")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )
  ),
  "js_view" => 'VcMessageView'
) );


/* Tabs
---------------------------------------------------------- */
$tab_id_1 = time().'-1-'.rand(0, 100);
$tab_id_2 = time().'-2-'.rand(0, 100);
vc_map( array(
  "name"  => __("Tabs", "brad-framework"),
  "base" => "vc_tabs",
  "show_settings_on_create" => false,
  "is_container" => true,
  "icon" => "vc_icon_tabs",
  "category" => __('Content', "brad-framework"),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "brad-framework"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "brad-framework")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Auto rotate tabs", "brad-framework"),
      "param_name" => "interval",
      "value" => array(__("Disable", "brad-framework") => 0, 3, 5, 10, 15),
      "description" => __("Auto rotate tabs each X seconds.", "brad-framework")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )
  ),
  "custom_markup" => '
  <div class="wpb_tabs_holder wpb_holder vc_container_for_children">
  <ul class="tabs_controls">
  </ul>
  %content%
  </div>'
  ,
  'default_content' => '
  [vc_tab title="'.__('Tab 1',"brad-framework").'" tab_id="'.$tab_id_1.'"][/vc_tab]
  [vc_tab title="'.__('Tab 2',"brad-framework").'" tab_id="'.$tab_id_2.'"][/vc_tab]
  ',
  "js_view" => ($vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35')
) );



/* Brad Slider */
/*---------------------------------------------------------*/
/*
vc_map( array(
  "name"  => __("Brad Slider", "brad-framework"),
  "base" => "vc_bradslider",
  "show_settings_on_create" => true ,
  "is_container" => false,
  "icon" => "vc_icon_bradslider",
  "class" => "vc_sc_bradslider",
  "category" => __('Content', "brad-framework"),
  "params" => array(
   
    array(
      "type" => "taxonomy",
      "heading" => __("Slider location", "brad-framework"),
      "param_name" => "categories",
      "value" => "" ,
	  "taxonomy" => "bradslider-category",
	  "description" => __("You must selected at lease one slider location to display slider.","brad-framework")
	  ),
	 
	$add_order,
	$add_order_by,
	
	array(
      "type" => "textfield",
      "heading" => __("Slides Count", "brad-framework"),
      "param_name" => "count",
      "value" => "5",
	  "description" => __("Max Number of Slides to show.")
    )  
   ,
     
	array(
      "type" => "textfield",
      "heading" => __("Slider Height", "brad-framework"),
      "param_name" => "height",
      "value" => "500",
	  "description" => __("Slider height in \"px\" . Do't included px just numbers.")
    )  
   ,
   
    array(
      "type" => "checkbox",
      "heading" => __("Full Screen Height ?", "brad-framework"),
      "param_name" => "fullheight",
	  "value" => Array("Yes"=>'yes'),
	  "dependency" => array("element" => "height","is_empty" => true)
	)
   ,
   
   
   array(
      "type" => "checkbox",
      "heading" => __("Enable Parallax ?", "brad-framework"),
      "param_name" => "parallax",
	  "description" => __("Check this option if you want to enable parallax scrolling for this slider","brad-framework"),
	  "value" => Array("Yes"=>'yes'),
	  "dependency" => array("element" => "height","is_empty" => true)
	)
	,
	
	
	array(
      "type" => "checkbox",
      "heading" => __("Autoplay Slider ?", "brad-framework"),
	  "description" => __("Check this option if you want to autoplay slides","brad-framework"),
      "param_name" => "autoplay",
	  "value" => Array("Yes"=>'yes')
	)
	,
	
	
	array(
      "type" => "dropdown",
      "heading" => __("Show Navigation ?", "brad-framework"),
      "param_name" => "navigation",
	  "value" => Array(
	       "Yes"=>'yes',
		   "No" => "no" ) ,
	)
  ,
   array(
      "type" => "dropdown",
      "heading" => __("Show Pagination ?", "brad-framework"),
      "param_name" => "pagination",
	  "value" => Array(
	       "Yes"=>'yes',
		   "No" => "no" ) 
	   )
    )
  )
);
  
 */  
 
/* Full Width Carousel
-----------------------------------------------------------*/
/*
$tab_id_1 = time().'-1-'.rand(0, 100);
$tab_id_2 = time().'-2-'.rand(0, 100);
vc_map( array(
  "name"  => __("Content Carousels", "brad-framework"),
  "base" => "vc_content_carousel",
  "show_settings_on_create" => true ,
  "is_container" => true,
  "icon" => "vc_icon_content_carousels",
  "class" => "vc_sc_content_carousels",
  "category" => __('Content', "brad-framework"),
  "params" => array(
   
    array(
      "type" => "taxonomy",
      "heading" => __("Carousel Category", "brad-framework"),
      "param_name" => "categories",
      "value" => "" ,
	  "taxonomy" => "carousel_category"
	  ),
	array(
      "type" => "dropdown",
      "heading" => __("Carousel Style", "brad-framework"),
      "param_name" => "carousel_style",
      "value" => array( 'Simply Just Images' => '' , 'With An Ipad Frame' => 'ipad' , 'With An Iphone Frame' => 'iphone' ),
      "description" => "This will automatically resize you image according to select style . For ex if you are suing an iphone frame use a longer image and if you are using ipad frame use a wider image."
    )  
   ,
   array(
      "type" => "dropdown",
      "heading" => __("Image size", "brad-framework"),
      "param_name" => "img_size",
	  "value" => Array( 
	     "default" => "" ,
		 "large" => "large" ,
		 "medium" => "medium" ,
		 "long" => "long" ,
		 "wide" => "wide",
		 "full" => "full" , 	 
		 "custom" => "custom" ),
	   "dependency" => Array('element' => "carousel_style", "is_empty" => true)	 
		 ),
	$add_custom_img_size,
   array(
      "type" => "checkbox",
      "heading" => __("Autoplay Carousel slides ?", "brad-framework"),
      "param_name" => "autoplay",
	  "value" => Array("Yes"=>'yes'),
	)
   ,
   array(
      "type" => "dropdown",
      "heading" => __("Show Pagination ?", "brad-framework"),
      "param_name" => "pagination",
	  "value" => Array(
	       "Yes"=>'yes',
		   "No" => "no" ) ,
	)
   ,
   
    array(
      "type" => "dropdown",
      "heading" => __("Show Navigation Icons ?", "brad-framework"),
      "param_name" => "navigation",
	  "value" => Array(
	         "Yes"=>'yes' , 
			 "No" => "no" ),
	) 
   ),
   
  "custom_markup" => '
  <div class="wpb_tabs_holder wpb_holder vc_container_for_children">
  <ul class="tabs_controls">
  </ul>
  %content%
  </div>'
  ,
  'default_content' => '
  [vc_carousel_item title="'.__('Slide 1',"brad-framework").'" tab_id="'.$tab_id_1.'"][/vc_carousel_item]
  [vc_carousel_item title="'.__('Slide 2',"brad-framework").'" tab_id="'.$tab_id_2.'"][/vc_carousel_item]
  ',
  "js_view" => ($vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35')
  
  )
 );


vc_map( array(
  "name" => __("Content Carousel Slide", "brad-framework"),
  "base" => "vc_carousel_item",
  "is_container" => false,
  "content_element" => false,
  "params" => array(
	array(
      "type" => "attach_image",
      "heading" => __("Slide Image", "brad-framework"),
	  "description" => __('Pickup the image for current slide','brad-framework'),
      "param_name" => "image"
    ),
    array(
      "type" => "tab_id",
      "heading" => __("Tab ID", "brad-framework"),
      "param_name" => "tab_id"
    )
  ),
  'js_view' => ($vc_is_wp_version_3_6_more ? 'VcTabView' : 'VcTabView35')
) );

*/

/* Quotes Slider
---------------------------------------------------------- */
$tab_id_1 = time().'-1-'.rand(0, 100);
$tab_id_2 = time().'-2-'.rand(0, 100);
vc_map( array(
  "name"  => __("Quotes Slider", "brad-framework"),
  "base" => "vc_quotes_slider",
  "show_settings_on_create" => false ,
  "is_container" => true ,
  "class" => "wpb_vc_tabs" ,
  "icon" => "vc_icon_quotes",
  "category" => __('Content', "brad-framework"),
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => __("Enable Navigation Icons ?", "brad-framework"),
      "param_name" => "navigation",
	  "value" => array(__('Yes','brad-framework') => 'yes',__('No','brad-framework') => 'no') ,

    ),
	
	array(
      "type" => "dropdown",
      "heading" => __(" Navigation Icons Align ?", "brad-framework"),
      "param_name" => "navigation_align",
	  "value" => array(__('Side','brad-framework') => 'side',__('Bottom','brad-framework') => 'bottom') ,

    ),
	
	
	array(
      "type" => "dropdown",
      "heading" => __("slider Effect ?", "brad-framework"),
      "param_name" => "effect",
	  "value" => array(__('Fade','brad-framework') => 'fade',__('Slide Horizontal','brad-framework') => 'horizontal' , __('Slide Vertical','brad-framework') => 'vertical') ,

    ),
	
	array(
      "type" => "checkbox",
      "heading" => __("Autoplay ?", "brad-framework"),
      "param_name" => "autoplay",
	  "value" => array(__('Yes','brad-framework') => 'yes') ,

    ),
	
	
	array(
      "type" => "textfield",
      "heading" => __("Autoplay Interval ?", "brad-framework"),
      "param_name" => "interval",
	  "value" => "5000",
	  "dependency" => array("element" => "autoplay" , "value" => array("yes"))

    ),
	
	array(
      "type" => "checkbox",
      "heading" => __("Hide Quote Icon on Top ?", "brad-framework"),
      "param_name" => "hide_icon",
	  "value" => array(__('Yes','brad-framework') => 'yes') 

    ),
	
	
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )
  ),
  "custom_markup" => '
  <div class="wpb_tabs_holder wpb_holder vc_container_for_children">
  <ul class="tabs_controls">
  </ul>
  %content%
  </div>'
  ,
  'default_content' => '
  [vc_quote title="'.__('Quote','brad-framework').'" tab_id="'.$tab_id_1.'"][/vc_quote]
  [vc_quote title="'.__('Quote','brad-framework').'" tab_id="'.$tab_id_2.'"][/vc_quote]
  ',
  "js_view" => ($vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35')
) );


vc_map( array(
  "name" => __("Quote", "brad-framework"),
  "base" => "vc_quote",
  "class" => "wpb_vc_tabbed_content",
  "is_container" => false,
  "content_element" => false,
  "params" => array(
	array(
      "type" => "attach_image",
      "heading" => __("Person or Company Logo ", "brad-framework"),
      "param_name" => "logo"
    ),
   $add_img_size,
   $add_custom_img_size,
	array(
      "type" => "textfield",
      "heading" => __("Person Name", "brad-framework"),
      "param_name" => "person_name",
	  "value" => 'john doe' ,
	  "admin_label" => true
    ),
	array(
      "type" => "textfield",
      "heading" => __("Person Description", "brad-framework"),
      "param_name" => "person_desc"
    ),
	
	array(
      "type" => "textarea_html",
      "heading" => __("Quote Content", "brad-framework"),
      "param_name" => "content",
	  "value" => __("Your Content Goes Here...","brad-framework")
    ),
    array(
      "type" => "tab_id",
      "heading" => __("Tab ID", "brad-framework"),
      "param_name" => "tab_id"
    )
  ),
  'js_view' => ($vc_is_wp_version_3_6_more ? 'VcTabView' : 'VcTabView35')
) );


/* Tour section
---------------------------------------------------------- */
$tab_id_1 = time().'-1-'.rand(0, 100);
$tab_id_2 = time().'-2-'.rand(0, 100);
WPBMap::map( 'vc_tour', array(
  "name" => __("Tour Section", "brad-framework"),
  "base" => "vc_tour",
  "show_settings_on_create" => false,
  "is_container" => true,
  "container_not_allowed" => true,
  "icon" => "vc_icon_tour",
  "category" => __('Content', "brad-framework"),
  "wrapper_class" => "clearfix",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "brad-framework"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "brad-framework")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Auto rotate slides", "brad-framework"),
      "param_name" => "interval",
      "value" => array(__("Disable", "brad-framework") => 0, 3, 5, 10, 15),
      "description" => __("Auto rotate slides each X seconds.", "brad-framework")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )
  ),
  "custom_markup" => '  
  <div class="wpb_tabs_holder wpb_holder clearfix vc_container_for_children">
  <ul class="tabs_controls">
  </ul>
  %content%
  </div>'
  ,
  'default_content' => '
  [vc_tab title="'.__('Slide 1',"brad-framework").'" tab_id="'.$tab_id_1.'"][/vc_tab]
  [vc_tab title="'.__('Slide 2',"brad-framework").'" tab_id="'.$tab_id_2.'"][/vc_tab]
  ',
  "js_view" => ($vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35')
) );


vc_map( array(
  "name" => __("Tab", "brad-framework"),
  "base" => "vc_tab",
  "allowed_container_element" => 'vc_row',
  "is_container" => true,
  
  "content_element" => false,
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Title", "brad-framework"),
      "param_name" => "title",
      "description" => __("Tab title.", "brad-framework")
    ),
    array(
      "type" => "tab_id",
      "heading" => __("Tab ID", "brad-framework"),
      "param_name" => "tab_id"
    )
  ),
  'js_view' => ($vc_is_wp_version_3_6_more ? 'VcTabView' : 'VcTabView35')
) );

/* Accordion block
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Accordion", "brad-framework"),
  "base" => "vc_accordion",
  "show_settings_on_create" => false,
  "is_container" => true,
  "icon" => "vc_icon_accordion",
  "category" => __('Content', "brad-framework"),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Active tab", "brad-framework"),
      "param_name" => "active_tab",
	  "value" => "1" ,
      "description" => __("Enter tab number to be active on load or enter false to collapse all tabs.", "brad-framework")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Accordion Style", "brad-framework"),
      "value" => Array(
	    "Style 1" => 'style1' ,
		"Style 2" => 'style2') ,
	    "param_name" => 'style',
    ),
	array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )
  ),
  "custom_markup" => '
  <div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
  %content%
  </div>
  <div class="tab_controls">
  <button class="add_tab" title="'.__("Add accordion section", "brad-framework").'">'.__("Add accordion section", "brad-framework").'</button>
  </div>
  ',
  'default_content' => '
  [vc_accordion_tab title="'.__('Section 1', "brad-framework").'"][/vc_accordion_tab]
  [vc_accordion_tab title="'.__('Section 2', "brad-framework").'"][/vc_accordion_tab]
  ',
  'js_view' => 'VcAccordionView'
  )
 );

vc_map( array(
  "name" => __("Accordion Section", "brad-framework"),
  "base" => "vc_accordion_tab",
  "allowed_container_element" => 'vc_row',
  "is_container" => true,
  "content_element" => false,
  "params" => array(
  
    array(
      "type" => "textfield",
      "heading" => __("Title", "brad-framework"),
      "param_name" => "title",
      "description" => __("Accordion section title.", "brad-framework")
    ),
	
	array(
      "type" => "icon",
      "heading" => __("Accordion Icon", "brad-framework"),
      "param_name" => "icon",
      "description" => __("Select an icon for this tab.", "brad-framework")
    ),
	
	
	array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )
  ),
  'js_view' => 'VcAccordionTabView'
) );

/* Toggle (FAQ)
---------------------------------------------------------- */
vc_map( array(
  "name" => __("FAQ", "brad-framework"),
  "base" => "vc_toggle",
  "icon" => "vc_icon_toggle",
  "category" => __('Content', "brad-framework"),
  "params" => array(
   array(
      "type" => "dropdown",
      "heading" => __("Toggle Style", "brad-framework"),
      "value" => Array(
	    "Style 1" => 'style1' ,
		"Style 2" => 'style2') ,
	    "param_name" => 'style',
    ),
    array(
      "type" => "textfield",
      "holder" => "h4",
      "class" => "toggle_title",
      "heading" => __("Toggle title", "brad-framework"),
      "param_name" => "title",
      "value" => __("Toggle title", "brad-framework"),
      "description" => __("Toggle block title.", "brad-framework")
    ),
	
	array(
      "type" => "icon",
      "heading" => __("Toggle Icon", "brad-framework"),
      "param_name" => "icon",
      "description" => __("Select an icon for this tab.", "brad-framework")
    ),
	
	
    array(
      "type" => "textarea_html",
      "holder" => "div",
      "class" => "toggle_content",
      "heading" => __("Toggle content", "brad-framework"),
      "param_name" => "content",
      "value" => __("<p>Toggle content goes here, click edit button to change this text.</p>", "brad-framework"),
      "description" => __("Toggle block content.", "brad-framework")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Default state", "brad-framework"),
      "param_name" => "open",
      "value" => array(__("Closed", "brad-framework") => "false", __("Open", "brad-framework") => "true"),
      "description" => __('Select "Open" if you want toggle to be open by default.', "brad-framework")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )
  ),
  "js_view" => 'VcToggleView'
) );



/* Facebook like button
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Facebook Like", "brad-framework"),
  "base" => "vc_facebook",
  "icon" => "vc_icon_facebook",
  "category" => __('Social', "brad-framework"),
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => __("Button type", "brad-framework"),
      "param_name" => "type",
      "value" => array(__("Standard", "brad-framework") => "standard", __("Button count", "brad-framework") => "button_count", __("Box count", "brad-framework") => "box_count"),
      "description" => __("Select button type.", "brad-framework")
    )
  )
) );

/* Tweetmeme button
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Tweetmeme Button", "brad-framework"),
  "base" => "vc_tweetmeme",
  "icon" => "vc_icon_tweetmeme",
  "category" => __('Social', "brad-framework"),
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => __("Button type", "brad-framework"),
      "param_name" => "type",
      "value" => array(__("Horizontal", "brad-framework") => "horizontal", __("Vertical", "brad-framework") => "vertical", __("None", "brad-framework") => "none"),
      "description" => __("Select button type.", "brad-framework")
    )
  )
) );

/* Google+ button
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Google+ Button", "brad-framework"),
  "base" => "vc_googleplus",
  "icon" => "vc_icon_googleplus",
  "category" => __('Social', "brad-framework"),
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => __("Button size", "brad-framework"),
      "param_name" => "type",
      "value" => array(__("Standard", "brad-framework") => "", __("Small", "brad-framework") => "small", __("Medium", "brad-framework") => "medium", __("Tall", "brad-framework") => "tall"),
      "description" => __("Select button size.", "brad-framework")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Annotation", "brad-framework"),
      "param_name" => "annotation",
      "value" => array(__("Inline", "brad-framework") => "inline", __("Bubble", "brad-framework") => "", __("None", "brad-framework") => "none"),
      "description" => __("Select annotation type.", "brad-framework")
    )
  )
) );

/*Pinterest button
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Pinterest Button", "brad-framework"),
  "base" => "vc_pinterest",
  "icon" => "vc_icon_pinterest",
  "category" => __('Social', "brad-framework"),
  "params"	=> array(
    array(
      "type" => "dropdown",
      "heading" => __("Button layout", "brad-framework"),
      "param_name" => "type",
      "value" => array(__("Horizontal", "brad-framework") => "", __("Vertical", "brad-framework") => "vertical", __("No count", "brad-framework") => "none"),
      "description" => __("Select button layout.", "brad-framework")
    )
  )
) );


/* Single Image
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Single Image", "brad-framework"),
  "base" => "vc_single_image",
  "icon" => "vc_icon_single_image",
  "category" => __('Content', "brad-framework"),
  "params" => array(
   
    array(
      "type" => "attach_image",
      "heading" => __("Image", "brad-framework"),
      "param_name" => "image",
      "value" => "",
      "description" => __("Select image from media library.", "brad-framework")
    ),
	
	$add_img_size,
	$add_custom_img_size,
    array(
      "type" => "dropdown",
      "heading" => __("CSS Animation", "brad-framework"),
      "param_name" => "css_animation",
      "value" => array(__("No", "brad-framework") => '', __("Left to Right", "brad-framework") => "fadeInLeft", __("Right to Left", "brad-framework") => "fadeInRight", __("Bottom to top", "brad-framework") => "fadeInTop", __("Top to Bottom", "brad-framework") => "fadeInBottom",__("Left to Right Big", "brad-framework") => "fadeInLeftBig", __("Right to Big big", "brad-framework") => "fadeInRightBig", __("Bottom to Top Big", "brad-framework") => "fadeInTopBig", __("Top to Bottom Big", "brad-framework") => "fadeInBottomBig" , __("Appear from center", "brad-framework") => "appearFromCenter" , __("Fade In", "brad-framework") => "fadeIn"),
     "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "brad-framework")),
	 
	  array(
      "type" => "dropdown",
      "heading" => __("Image Align", "brad-framework"),
      "param_name" => "img_align",
      "value" => array(__("None", "brad-framework") => 'none', __("Left", "brad-framework") => "left", __("Right", "brad-framework") => "right", __("Center", "brad-framework") => "center")
	  ),
	 
	 
	$add_css_animation_delay,
 
	  array(
      "type" => 'checkbox',
      "heading" => __("Enable Lightbox Link Icon?", "brad-framework"),
      "param_name" => "img_lightbox",
      "description" => __("If selected there will be lightbox Icon", "brad-framework"),
      "value" => Array(__("Yes, please", "brad-framework") => 'yes')
    ),
	
	 array(
      "type" => 'icon',
      "heading" => __("Lightbox Icon?", "brad-framework"),
      "param_name" => "icon_lightbox",
      "value" => '118|ss-air' ,
	   "dependency" => array("element" => "img_lightbox" , "value" => array("yes") )
    ),
	
    array(
      "type" => 'checkbox',
      "heading" => __("Lightbox Link to large image?", "brad-framework"),
      "param_name" => "img_link_large",
      "description" => __("If selected, image will be linked to the bigger image through lightbox.", "brad-framework"),
      "value" => Array(__("Yes, please", "brad-framework") => 'yes'),
	   "dependency" => array("element" => "img_lightbox" , "value" => array("yes") )
    ),
    array(
      "type" => "textfield",
      "heading" => __("Custom Image link for Lightbox", "brad-framework"),
      "param_name" => "img_link",
      "description" => __("Enter url if you want this image to have link. You can also enter youtube or vimeo video link . Video will be shown in lightbox.", "brad-framework"),
      "dependency" => Array('element' => "img_link_large", 'is_empty' => true, 'callback' => 'wpb_single_image_img_link_dependency_callback')
    ),
  
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )
  )
));

/* Gallery/Slideshow
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Image Gallery", "brad-framework"),
  "base" => "vc_gallery",
  "icon" => "vc_icon_gallery",
  "category" => __('Content', "brad-framework"),
  "params" => array(
  
    array(
      "type" => "dropdown",
      "heading" => __("Gallery type", "brad-framework"),
      "param_name" => "type",
      "value" => array( __("Slider", "brad-framework") => "slider", __("Grid", "brad-framework") => "grid" ),
      "description" => __("Select gallery type.", "brad-framework")
   ),
   
    array(
      "type" => "dropdown",
      "heading" => __("Whitespace Between Elements ? ", "brad-framework"),
      "param_name" => "padding",
	  "value" => Array( 
	     "Default (Medium)" => "medium" ,
		 "Small Padding" => "small" ,
		 "Narrow Padding" => "narrow" ,
		 "Large Padding" => "large" ,
		 "No Padding" => "no" ) ,
		 "dependency" => array("element" => "type" , "value" => array("grid"))	 
	),
	
	
	array(
      "type" => "dropdown",
      "heading" => __("Grid Columns ? ", "brad-framework"),
      "param_name" => "columns",
	  "value" => Array( 
	     __("Default (Six)","brad-framework") => "6" ,
		__("Two","brad-framework") => "2" ,
		 __("Three","brad-framework") => "3" ,
		 __("Four","brad-framework") => "4" ,
		 __("Five","brad-framework") => "5" ) ,
		 "dependency" => array("element" => "type" , "value" => array("grid"))	 
	),
	
	
    array(
      "type" => "checkbox",
      "heading" => __("Auto Play slides", "brad-framework"),
      "param_name" => "autoplay",
      "value" => array( __("Yes", "brad-framework") => 'yes'),
	  "dependency" => array("element" => "type" , "value" => array("slider"))
    ),
	
   
	
	
    array(
      "type" => "attach_images",
      "heading" => __("Images", "brad-framework"),
      "param_name" => "images",
      "value" => "",
      "description" => __("Select images from media library.", "brad-framework")
    ),
   $add_img_size,
   $add_custom_img_size ,
    array(
      "type" => "dropdown",
      "heading" => __("On click", "brad-framework"),
      "param_name" => "onclick",
      "value" => array(__("Open prettyPhoto", "brad-framework") => "link_image", __("Do nothing", "brad-framework") => "link_no", __("Open custom link", "brad-framework") => "custom_link"),
      "description" => __("What to do when slide is clicked?", "brad-framework")
    ),
	array( 
	   "type" => "checkbox",
	   "heading" => __("Hide Overlay and Lightbox Icon","brad-framework"),
	   "param_name" => "hide_lbi",
	   "value" => array(__("Yes","brad-framework") => "yes"),
	   "dependency" => array("element" => "onclick" , "value" => array("link_image"))
	  
	   ),
    array(
      "type" => "exploded_textarea",
      "heading" => __("Custom links", "brad-framework"),
      "param_name" => "custom_links",
      "description" => __('Enter links for each slide here. Divide links with linebreaks (Enter).', "brad-framework"),
      "dependency" => Array('element' => "onclick", 'value' => array('custom_link'))
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Custom link target", "brad-framework"),
      "param_name" => "custom_links_target",
      "description" => __('Select where to open  custom links.', "brad-framework"),
      "dependency" => Array('element' => "onclick", 'value' => array('custom_link')),
      'value' => $target_arr
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )
  )
) );




/* Button
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Button", "brad-framework"),
  "base" => "vc_button",
  "icon" => "vc_icon_box",
  "category" => __('Content', "brad-framework"),
  "params" => array(
   array(
      "type" => "dropdown",
      "heading" => __("Style", "brad-framework"),
      "param_name" => "style",
      "value" => $button_colors_arr,
      "description" => __("Select the default style for your button.", "brad-framework")
    ),
   array(
	  "type" => "dropdown",
	  "heading" => __("Align","brad-framework"),
	  "param_name" => "align" ,
	  "value" => array(
	              __("Justify","brad-framework") => "none" ,
				  __("Align Center","brad-framework") => "center"
				  )
	  ),
    array(
      "type" => "textfield",
      "heading" => __("Text on the button", "brad-framework"),
      "holder" => "button",
      "class" => "wpb_button",
      "param_name" => "title",
      "value" => __("Text on the button", "brad-framework"),
      "description" => __("Text on the button.", "brad-framework")
    ),
   array(
      "type" => "textfield",
      "heading" => __("URL (Link)", "brad-framework"),
      "param_name" => "href",
      "description" => __("Enter the Button link. Do't forget to include http:// ", "brad-framework")
    ),
   array(
      "type" => "dropdown",
      "heading" => __("Target", "brad-framework"),
      "param_name" => "target",
      "value" => $target_arr,
      "dependency" => Array('element' => "href", 'not_empty' => true)
    ),
   array(
      "type" => "icon",
      "heading" => __("Icon", "brad-framework"),
      "param_name" => "icon",
      "value" => "" ,
	  "description" => __("Select the icon for your Button. Click an icon to select it and again click the same icon to deselecct it", "brad-framework")
    ),
	
   array(
	  "type" => "dropdown",
	  "heading" => __("Icon Align","brad-framework"),
	  "param_name" => "icon_align" ,
	  "value" => array(
	              __("Align Left","brad-framework") => "left" ,
				  __("Align Right","brad-framework") => "right" ,
				  )
   ),
   
   array(
	  "type" => "dropdown",
	  "heading" => __("Icon Size","brad-framework"),
	  "param_name" => "icon_size" ,
	  "value" => array(
	              __("Normal","brad-framework") => "normal" ,
				  __("Medium","brad-framework") => "medium" 
				  ),
	 "dependency" => Array('element' => "style", 'value' => array('readmore'))			  			  
   ),
   
   
   array(
	  "type" => "dropdown",
	  "heading" => __("Icon Style","brad-framework"),
	  "param_name" => "icon_style" ,
	  "value" => array(
	              __("Default","brad-framework") => "" ,
				  __("With Border","brad-framework") => "style2",
				   __("With Background","brad-framework") => "style3"
				  ),
	"dependency" => Array('element' => "style", 'value' => array('readmore'))			  
	  ),  
   array(
      "type" => "colorpicker",
      "heading" => __("Button  Icon Color", "brad-framework"),
	  "description" => __("Leave Blank for default color","brad-framework"),
      "param_name" => "icon_c",
      "value" => '' ,
	  "dependency" => Array('element' => "style", 'value' => array('readmore')),
      ),
	  
	  array(
      "type" => "colorpicker",
      "heading" => __("Button Icon Color Hover", "brad-framework"),
	  "description" => __("Leave Blank for default color","brad-framework"),
      "param_name" => "icon_c_hover",
      "value" => '' ,
	  "dependency" => Array('element' => "style", 'value' => array('readmore')),
      ),  
   array(
      "type" => "colorpicker",
      "heading" => __("Button  Icon Border Color", "brad-framework"),
	  "description" => __("Leave Blank for default border color","brad-framework"),
      "param_name" => "icon_bc",
	  "dependency" => Array('element' => "icon_style", 'value' => array('style2')),
      "value" => ''
      ),	  
   array(
      "type" => "colorpicker",
      "heading" => __("Button  Icon Background Color", "brad-framework"),
	  "description" => __("Leave Blank for default background color","brad-framework"),
      "param_name" => "icon_bgc",
      "value" => '',
	  "dependency" => Array('element' => "icon_style", 'value' => array('style3'))
      ),
	  
    array(
      "type" => "colorpicker",
      "heading" => __(" Button Icon Background and border Color:hover", "brad-framework"),
	  "description" => __("Leave Blank for default","brad-framework"),
      "param_name" => "icon_bgc_hover",
      "value" => '',
	  "dependency" => Array('element' => "icon_style", 'value' => array('style2','style3'))
      ),
	  	  	  
   array(
      "type" => "dropdown",
      "heading" => __("Size", "brad-framework"),
      "param_name" => "size",
      "value" => $size_arr,
      "description" => __("Select the Button size.", "brad-framework")
    )
  ),
  "js_view" => 'VcButtonView'
) );


/* Call to Action Button
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Call to Action Button", "brad-framework"),
  "base" => "vc_cta_button",
  "icon" => "vc_icon_cta",
  "class" => "vc_sc_cta",
  "category" => __('Content', "brad-framework"),
  "params" => array(
   
	array(
      "type" => "textarea",
      "heading" => __("Callout Heading", "brad-framework"),
      "param_name" => "call_text",
      "value" => "" ,
      "description" => __("Enter your content.", "brad-framework")
    ),
	
	
	 array(
      "type" => "textarea_html",
      "heading" => __("Content", "brad-framework"),
      "param_name" => "content",
	  "value" => ""
    )
	,
	
	array(
      "type" => "dropdown",
      "heading" => __("Call text and buttons align", "brad-framework"),
      "param_name" => "align",
      "value" => array(__("Align Center", "brad-framework") => "center" , __("Justify", "brad-framework") => "justify"),
    ),
    array(
      "type" => "textfield",
      "heading" => __("Text on the first button", "brad-framework"),
      "param_name" => "title",
      "value" => __("Text on the button", "brad-framework"),
      "description" => __("Text on the button or Leave Blank if you do't want to show Button.", "brad-framework")
    ),
    array(
      "type" => "textfield",
      "heading" => __("URL (Link)", "brad-framework"),
      "param_name" => "href",
      "description" => __("First button link.", "brad-framework")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("First Button Target", "brad-framework"),
      "param_name" => "target",
      "value" => $target_arr,
      "dependency" => Array('element' => "href", 'not_empty' => true)
    ),
    array(
      "type" => "dropdown",
      "heading" => __(" First Button Color", "brad-framework"),
      "param_name" => "color",
      "value" => $button_colors_arr,
      "description" => __("Button color.", "brad-framework")
    ),
    array(
      "type" => "icon",
      "heading" => __("First Button Icon", "brad-framework"),
      "param_name" => "icon",
      "description" => __("Button icon.", "brad-framework")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("First Button Size", "brad-framework"),
      "param_name" => "size",
      "value" => $size_arr,
      "description" => __("Button size.", "brad-framework")
    ),
   
   
   array(
      "type" => "textfield",
      "heading" => __("Text on the second button", "brad-framework"),
      "param_name" => "second_title",
      "value" => "",
      "description" => __("Text on the button or Leave Blank if you do't want to show this Button.", "brad-framework")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Second Button URL (Link)", "brad-framework"),
      "param_name" => "second_href",
      "description" => __("First button link.", "brad-framework")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Second Button Target", "brad-framework"),
      "param_name" => "second_target",
      "value" => $target_arr,
      "dependency" => Array('element' => "href", 'not_empty' => true)
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Second Button Color", "brad-framework"),
      "param_name" => "second_color",
      "value" => $button_colors_arr,
      "description" => __("Button color.", "brad-framework")
    ),
    array(
      "type" => "icon",
      "heading" => __("Second Button Icon", "brad-framework"),
      "param_name" => "second_icon",
      "description" => __("Button icon.", "brad-framework")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Second Button Size", "brad-framework"),
      "param_name" => "second_size",
      "value" => $size_arr,
      "description" => __("Button size.", "brad-framework")
    )
	,
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )
  ),
  "js_view" => 'VcCallToActionView'
)
);

/* Google maps element
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Google Maps", "brad-framework"),
  "base" => "vc_gmaps",
  "icon" => "vc_icon_map",
  "class" => "vc_sc_map",
  "category" => __('Content', "brad-framework"),
  "params" => array(
     array(
      "type" => "dropdown",
      "heading" => __("Style", "brad-framework"),
      "param_name" => "style",
	  "value" => array(__('Default','brad-framework') => 'default',__('Fully Saturated','brad-framework') => 'style1' , __('Dark Style','brad-framework') => 'style2' , __('Map Color Match with Primary Color','brad-framework') => 'style3')
     ),
	
	array(
      "type" => "textfield",
      "heading" => __("Address", "brad-framework"),
      "param_name" => "address",
	  "value" => ''
    ),
	array(
      "type" => "textfield",
      "heading" => __("Map Width", "brad-framework"),
      "param_name" => "width",
	  "value" => '100%' ,
      "description" => __('Enter map Width . Example: 500px or  50%.', "brad-framework")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Map height", "brad-framework"),
      "param_name" => "height",
	  "value" => '300px' ,
      "description" => __('Enter map height in pixels. Example: 200px.', "brad-framework")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Map Zoom", "brad-framework"),
      "param_name" => "zoom",
      "value" => array(__("14 - Default", "brad-framework") => 14, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20)
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Scrollwheel", "brad-framework"),
      "param_name" => "scrollwheel",
	  "value" => Array(__("Yes",'brad-framework') => 'yes' ,  __("No",'brad-framework') => 'no'),
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Map type", "brad-framework"),
      "param_name" => "maptype",
      "value" => array(__("Map", "brad-framework") => "roadmap", __("Satellite", "brad-framework") => "satellite", __("Hybrid Map", "brad-framework") => "hybrid" , __("Map + Terrain", "brad-framework") => "terrain"),
      "description" => __("Select map type.", "brad-framework")
    ),
	array(
      "type" => "checkbox",
      "heading" => __("Show Marker", "brad-framework"),
      "param_name" => "marker",
	  "value" => Array(__("Yes",'brad-framework') => 'yes' ),
    ),
	array(
      "type" => "attach_image",
      "heading" => __("Marker Image", "brad-framework"),
      "param_name" => "markerimage",
	  "dependency" => Array('element' => "marker", 'value' => array('yes'))
    ),
	array(
      "type" => "textarea",
      "heading" => __("Info window Text", "brad-framework"),
      "param_name" => "infowindow",
	  "value" => "",
	  "dependency" => Array("element" => "marker" , "value" => array("yes"))
    ),
	
	array(
      "type" => "textarea",
      "heading" => __("Additonal Markes", "brad-framework"),
      "param_name" => "markers",
	  "value" => "",
	  "description" => __('Place additional Markes for the map in the format like lat|lon|description. Please add a line break for another marker', "brad-framework"),
	  "dependency" => Array("element" => "marker" , "value" => array("yes"))
    ),
	
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )
  )
) );

/* Raw HTML
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Raw HTML", "brad-framework"),
	"base" => "vc_raw_html",
	"icon" => "vc_icon_raw_html",
	"category" => __('Structure', "brad-framework"),
	"wrapper_class" => "clearfix",
	"params" => array(
		array(
  		"type" => "textarea_raw_html",
			"holder" => "div",
			"heading" => __("Raw HTML", "brad-framework"),
			"param_name" => "content",
			"value" => base64_encode("<p>I am raw html block.<br/>Click edit button to change this html</p>"),
			"description" => __("Enter your HTML content.", "brad-framework")
		),
	)
) );

/* Raw JS
---------------------------------------------------------- */
vc_map( array(
	"name" => __("Raw JS", "brad-framework"),
	"base" => "vc_raw_js",
	"icon" => "vc_icon_raw_js",
	"category" => __('Structure', "brad-framework"),
	"wrapper_class" => "clearfix",
	"params" => array(
  	array(
  		"type" => "textarea_raw_html",
			"holder" => "div",
			"heading" => __("Raw js", "brad-framework"),
			"param_name" => "content",
			"value" => __(base64_encode("<script type='text/javascript'> alert('Enter your js here!'); </script>"), "brad-framework"),
			"description" => __("Enter your JS code.", "brad-framework")
		),
	)
) );


/* Graph
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Progress Bar", "brad-framework"),
  "base" => "vc_progress_bar",
  "icon" => "vc_icon_progress",
  "class" => "vc_sc_progress",
  "category" => __('Content', "brad-framework"),
  "params" => array(
    
    array(
      "type" => "exploded_textarea",
      "heading" => __("Graphic values", "brad-framework"),
      "param_name" => "values",
      "description" => __('Input graph values here. Divide values with linebreaks (Enter). Example: 90|Development', "brad-framework"),
      "value" => "90|Development,80|Design,70|Marketing"
    ),
	
    array(
      "type" => "textfield",
      "heading" => __("Units", "brad-framework"),
      "param_name" => "units",
      "description" => __("Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.", "brad-framework")
    ),
	
    array(
      "type" => "dropdown",
      "heading" => __("Bar color", "brad-framework"),
      "param_name" => "bar_color",
      "value" => $colors_arr ,
      "description" => __("Select bar background color.", "brad-framework"),
    ),
	
    array(
      "type" => "checkbox",
      "heading" => __("Options", "brad-framework"),
      "param_name" => "options",
      "value" => array(__("Add Stripes?", "brad-framework") => "striped", __("Add animation? Will be visible with striped bars.", "brad-framework") => "animated")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "brad-framework"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
    )
  )
) );

/**
 * Pic chat
 */
vc_map( array(
    "name" => __("Pie chart", 'vc_extend'),
    "base" => "vc_pie",
    "class" => "vc_sc_pie",
    "icon" => "vc_icon_pie",
    "category" => __('Content', "brad-framework"),
    "params" => array(
       
        array(
            "type" => "textfield",
            "heading" => __("Pie value", "brad-framework"),
            "param_name" => "value",
            "description" => __('Input graph value here. Witihn a range 0-100.', "brad-framework"),
            "value" => "50",
 
        ),
		 array(
            "type" => "icon",
            "heading" => __("Pie Icon", "brad-framework"),
            "param_name" => "icon",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Pie label value", "brad-framework"),
            "param_name" => "label_value",
            "description" => __('If you use this field then the Pie icon will not be shown', "brad-framework"),
            "value" => ""
        ),
		
		/*
		array(
            "type" => "checkbox",
            "heading" => __("Enable Subtitle", "brad-framework"),
            "param_name" => "subtitle",
			"description" => __("Check if you want to have another description field in pie chart this will descrease the font size to fit text","brad-framework"),
            "value" => Array(__("Yes","brad-framework") => "yes")
			) ,
			
		array(
            "type" => "textfield",
            "heading" => __("Pie Sub label value", "brad-framework"),
            "param_name" => "sub_label_value",
			"dependency" => array("element" => "subtitle" , "value" => array("yes")),
            "value" => ""
        ),
		*/
        array(
            "type" => "checkbox",
            "heading" => __("Place in Center", "brad-framework"),
            "param_name" => "placeincenter",
            "value" => Array(__("Yes","brad-framework") => "yes")
			) ,
	   array(
            "type" => "colorpicker",
            "heading" => __("Track color", "brad-framework"),
            "param_name" => "track_color",
            "description" => __("Select pie chart Track color <b>Note:</b> If not selected then default color will be used.", "brad-framework")
			),
		
	    array(
            "type" => "colorpicker",
            "heading" => __("Bar color", "brad-framework"),
            "param_name" => "bar_color",
            "description" => __("Select pie chart bar color <b>Note:</b>. If not selected then default color will be used.", "brad-framework"),		
 
        ),	
        array(
            "type" => "dropdown",
            "heading" => __("Size", "brad-framework"),
            "param_name" => "size",
            "value" => Array(__('Standard',"brad-framework") => 'standard' , __('Medium',"brad-framework") => 'medium' , __('Large',"brad-framework") => 'large'),
       
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "brad-framework"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
        ),

    )
) );


/* Support for 3rd Party plugins
---------------------------------------------------------- */
// Contact form 7 plugin
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
  global $wpdb;
  $cf7 = $wpdb->get_results( 
  	"
  	SELECT ID, post_title 
  	FROM $wpdb->posts
  	WHERE post_type = 'wpcf7_contact_form' 
  	"
  );
  $contact_forms = array();
  if ($cf7) {
    foreach ( $cf7 as $cform ) {
      $contact_forms[$cform->post_title] = $cform->ID;
    }
  } else {
    $contact_forms["No contact forms found"] = 0;
  }
  vc_map( array(
    "base" => "contact-form-7",
    "name" => __("Contact Form 7", "brad-framework"),
    "icon" => "vc_icon_contact7_form",
    "category" => __('Content', "brad-framework"),
    "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Form title", "brad-framework"),
        "param_name" => "title",
        "admin_label" => true,
        "description" => __("What text use as form title. Leave blank if no title is needed.", "brad-framework")
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Select contact form", "brad-framework"),
        "param_name" => "id",
        "value" => $contact_forms,
        "description" => __("Choose previously created contact form from the drop down list.", "brad-framework")
      )
    )
  ) );
} // if contact form7 plugin active

if (is_plugin_active('LayerSlider/layerslider.php')) {
  global $wpdb;
  $ls = $wpdb->get_results( 
  	"
  	SELECT id, name, date_c
  	FROM ".$wpdb->prefix."layerslider
  	WHERE flag_hidden = '0' AND flag_deleted = '0'
  	ORDER BY date_c ASC LIMIT 100
  	"
  );
  $layer_sliders = array();
  if ($ls) {
    foreach ( $ls as $slider ) {
      $layer_sliders[$slider->name] = $slider->id;
    }
  } else {
    $layer_sliders["No sliders found"] = 0;
  }
  vc_map( array(
    "base" => "layerslider_vc",
    "name" => __("Layer Slider", "brad-framework"),
    "icon" => "vc_icon_layer_slider",
    "category" => __('Content', "brad-framework"),
    "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Widget title", "brad-framework"),
        "param_name" => "title",
        "description" => __("What text use as a widget title. Leave blank if no title is needed.", "brad-framework")
      ),
      array(
        "type" => "dropdown",
        "heading" => __("LayerSlider ID", "brad-framework"),
        "param_name" => "id",
        "admin_label" => true,
        "value" => $layer_sliders,
        "description" => __("Select your LayerSlider.", "brad-framework")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "brad-framework"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
      )
    )
  ) );
} // if layer slider plugin active

if (is_plugin_active('revslider/revslider.php')) {
  global $wpdb;
  $rs = $wpdb->get_results( 
  	"
  	SELECT id, title, alias
  	FROM ".$wpdb->prefix."revslider_sliders
  	ORDER BY id ASC LIMIT 100
  	"
  );
  $revsliders = array();
  if ($rs) {
    foreach ( $rs as $slider ) {
      $revsliders[$slider->title] = $slider->alias;
    }
  } else {
    $revsliders["No sliders found"] = 0;
  }
  vc_map( array(
    "base" => "rev_slider_vc",
    "name" => __("Revolution Slider", "brad-framework"),
    "icon" => "vc_icon_rev_slider",
    "category" => __('Content', "brad-framework"),
    "params"=> array(
      array(
        "type" => "textfield",
        "heading" => __("Widget title", "brad-framework"),
        "param_name" => "title",
        "description" => __("What text use as a widget title. Leave blank if no title is needed.", "brad-framework")
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Revolution Slider", "brad-framework"),
        "param_name" => "alias",
        "admin_label" => true,
        "value" => $revsliders,
        "description" => __("Select your Revolution Slider.", "brad-framework")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "brad-framework"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "brad-framework")
      )
    )
  ) );
} // if revslider plugin active




/* Product Carousel ( if Woocommerce Activated) */
/*
if(class_exists('Woocommerce')):
vc_map( array(
    "name" => __("Product Carousel", 'vc_extend'),
    "base" => "vc_product_carousel",
    "icon" => "vc_icon_portfolio_carousel",
    "class" => "vc_sc_portfolio_carousel",
    "category" => __('Content', "brad-framework"),
    "params" => array(
array(
      "type" => "taxonomy",
      "heading" => __("Product Category", "brad-framework"),
      "param_name" => "category",
      "value" => "" ,
	  "taxonomy" => "product_cat"
	  ),
    array(
      "type" => "dropdown",
      "heading" => __("Columns Count", "brad-framework"),
      "param_name" => "columns",
      "value" => array( "Two" => 2 ,"Three" => 3 ,"Four" => 4 , "Five" => 5 ),
      "description" => __("Set the number of Columns.", "brad-framework")
    ),
	
   $add_box_padding,
   array(
      "type" => "checkbox",
      "heading" => __("Optimize FullWidth ? ", "brad-framework"),
      "param_name" => "fullwidth",
	  "value" => Array("Yes"=>'yes'),
	  "description" => __("Enable this if you want to use fullwidth of your browser . <strong>Note:</strong> To work this option you must have selected the section type to fullwidth or fullwidth with padding.","js_compser")
	)
   ,
    array(
      "type" => "checkbox",
      "heading" => __("Show Categories in Info ?", "brad-framework"),
      "param_name" => "show_categories",
	  "value" => Array("Yes"=>'yes')
	)
	, 	
	
	 array(
      "type" => "checkbox",
      "heading" => __("Disable Price in Info ?", "brad-framework"),
      "param_name" => "disable_price",
	  "value" => Array("Yes"=>'yes')
	)
	,
	
	array(
      "type" => "checkbox",
      "heading" => __("Disable Button at Bottom ?", "brad-framework"),
      "param_name" => "disable_button",
	  "value" => Array("Yes"=>'yes')
	)
	, 	

  array(
      "type" => "textfield",
      "heading" => __("Maximun Number of Products  to Show", "brad-framework"),
      "param_name" => "max_items",
      "value" => 8 ,

    )
  ,
    array(
      "type" => "dropdown",
      "heading" => __("Show Navigation Icons ?", "brad-framework"),
      "param_name" => "navigation",
	  "value" => Array(
	         "Yes"=>'yes' , 
			 "No" => "no" ),
	)
   ,
  array(
      "type" => "checkbox",
      "heading" => __("Autoplay Slides ?", "brad-framework"),
      "param_name" => "autoplay",
	  "description" => __("Check this if you want to play the carousel Slides Automatically","brad-framework"),
	  "value" => Array("Yes"=>'yes'),
	),
	
    $add_order_by,
	$add_order
  
    )
  ) 
);

endif;
*/

if (is_plugin_active('gravityforms/gravityforms.php')) {
  $gravity_forms_array[__("No Gravity forms found.", "brad-framework")] = '';
  if ( class_exists('RGFormsModel') ) {
    $gravity_forms = RGFormsModel::get_forms(1, "title");
    if ($gravity_forms) {
      $gravity_forms_array = array(__("Select a form to display.", "brad-framework") => '');
      foreach ( $gravity_forms as $gravity_form ) {
        $gravity_forms_array[$gravity_form->title] = $gravity_form->id;
      }
    }
  }
  vc_map( array(
    "name" => __("Gravity Form", "brad-framework"),
    "base" => "gravityform",
    "icon" => "vc_icon_gravity_form",
    "category" => __("Content", "brad-framework"),
    "params" => array(
      array(
        "type" => "dropdown",
        "heading" => __("Form", "brad-framework"),
        "param_name" => "id",
        "value" => $gravity_forms_array,
        "description" => __("Select a form to add it to your post or page.", "brad-framework"),
        "admin_label" => true
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Display Form Title", "brad-framework"),
        "param_name" => "title",
        "value" => array( __("No", "brad-framework") => 'false', __("Yes", "brad-framework") => 'true' ),
        "description" => __("Would you like to display the forms title?", "brad-framework"),
        "dependency" => Array('element' => "id", 'not_empty' => true)
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Display Form Description", "brad-framework"),
        "param_name" => "description",
        "value" => array( __("No", "brad-framework") => 'false', __("Yes", "brad-framework") => 'true' ),
        "description" => __("Would you like to display the forms description?", "brad-framework"),
        "dependency" => Array('element' => "id", 'not_empty' => true)
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Enable AJAX?", "brad-framework"),
        "param_name" => "ajax",
        "value" => array( __("No", "brad-framework") => 'false', __("Yes", "brad-framework") => 'true' ),
        "description" => __("Enable AJAX submission?", "brad-framework"),
        "dependency" => Array('element' => "id", 'not_empty' => true)
      ),
      array(
        "type" => "textfield",
        "heading" => __("Tab Index", "brad-framework"),
        "param_name" => "tabindex",
        "description" => __("(Optional) Specify the starting tab index for the fields of this form. Leave blank if you're not sure what this is.", "brad-framework"),
        "dependency" => Array('element' => "id", 'not_empty' => true)
      )
    )
  ) 
);
} // if gravityforms active

