<?php
/**
	ReduxFramework Sample Config File
	For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
**/

 if( file_exists( dirname( __FILE__ ) . '/ReduxCore/framework.php' ) ) {
                require_once( dirname( __FILE__ ) . '/ReduxCore/framework.php' );
            }
			
			
if ( !class_exists( "ReduxFramework" ) ) {
	return;
} 

if ( !class_exists( "Redux_Framework_config" ) ) {
	class Redux_Framework_config {

		public $args = array();
		public $sections = array();
		public $ReduxFramework;

		public function __construct( ) {

			// Just for demo purposes. Not needed per say.
			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();
			
			// Create the sections and fields
			$this->setSections();
			
			if ( !isset( $this->args['opt_name'] ) ) { // No errors please
				return;
			}
			
		
			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);

		}
	
		
	
  public function setSections() {
	  
	 global $wp_registered_sidebars; 
  // ACTUAL DECLARATION OF SECTIONS
    $sidebars = array();
    $sidebars[] = __("Select a Sidebar","brad-framework");
	$sbg_sidebars = get_option('sbg_sidebars');
	
	if( is_array($wp_registered_sidebars) && !empty($wp_registered_sidebars)){
		foreach($wp_registered_sidebars as $sidebar){
			$sidebars[$sidebar['name']] = $sidebar['name'];
		}
	}
	
	
	if(is_array($sbg_sidebars)){
			foreach($sbg_sidebars as $sbg_sidebar){
				$sidebars[$sbg_sidebar] = $sbg_sidebar;
			}
		}
	
    $this->sections[] = array(
		'icon' => 'el-icon-cog',
		'icon_class' => 'icon-small',
        'title' => __('General Settings', "brad-framework"),
        'desc' => __('<p class="description">Customize the main settings for theme . </p>', "brad-framework"),
        'fields' => array(
		/*
        array( "title" => __( "Enable Responsive Layout" , "brad-framework") ,
				"subtitle" => __( "Check this option to if you want responsive layout." , "brad-framework"),
				 "id" => "check_responsive",
				 "default" => 1,
				 "type" => "switch" 
				 ),  
		 */  
		array( "title" => __( "Disable Comments for all Content Pages ", "brad-framework"),
			   "subtitle" => __( "Check this option to disable comments for all pages ", "brad-framework"),
			   "id" => "check_disablecomments",
			   "default" => 1,
			   "type" => "switch" ,
			), 
				
		  array( "title" => "Default Email Address for Contact Form",
				 "sub_desc" => "Default Email address where you want to send user feedback",
				 "id" => "contact_form_email",
				 "std" => get_option('admin_email') ,
				 "type" => "text"
				 ), 
				 
		array( "title" => "Alternate Email Address For Contact Form",
			   "sub_desc" => "Alternate Email address where you want to send user feedback ( you can use speical email address page builder where you want to send emails)",
			   "id" => "contact_form_email_alternate",
			   "std" => '' ,
			   "type" => "text"
			), 		 
				 
				 				 
	   array( 'type' => 'divide',
		      'id' => 'divider_after_comments'
			 ) ,
		  					
	   array( "title" => __( "Layout", "brad-framework"),
              "subtitle" => __( "Select boxed or wide layout.", "brad-framework"),
			  "multiselect" => false ,
              "id" => "layout",
              "default" => 'wide' ,
              "type" => "select",
              "options" => array(
                'boxed' => 'Boxed',
                'wide' => 'Wide',
            )),


     array( "title" => __(  "Background Style for Body", "brad-framework"),
            "subtitle" => __( "Select a background color (Only work if  Boxed Layout is selected above).", "brad-framework"),
            "id" => "bg_style",
			'required' => array('layout','=','boxed'),	
            "default" =>array( "background-color" => "#f5f5f5" , "background-position" => "center center" , "background-repeat" => "no-repeat","background-size" => "cover" , "background-attachment" => "fixed" ,"background-image" => false),
            "type" => "background"),

     array( "title" => __( "Background Pattern", "brad-framework"),
            "subtitle" => __( "Enable Background pattern for boxed layout and then select the pattern below (Only Boxed Layout) . ", "brad-framework"),
            "id" => "bg_pattern",
            "default" => 0,
			'required' => array('layout','=','boxed'),	
            "type" => "checkbox"),

     array( "title" => __( "Select a Background Pattern", "brad-framework"),
            "id" => "bg_patterns",
			'required' => array('bg_pattern','=', 1 ),	
            "default" => "pattern1",
            "type" => "image_select",
            "options" => array(
                "pattern1.png" => array( "title" => __( "Pattern 1", "brad-framework") , "img" => get_template_directory_uri()."/images/patterns/patt01.jpg"),
                "pattern2.png" => array( "title" => __( "Pattern 2", "brad-framework") , "img" => get_template_directory_uri()."/images/patterns/patt02.jpg"),
                "pattern3.png" => array( "title" => __( "Pattern 3", "brad-framework") , "img" => get_template_directory_uri()."/images/patterns/patt03.jpg"),
                "pattern4.png" => array( "title" => __( "Pattern 4", "brad-framework") , "img" => get_template_directory_uri()."/images/patterns/patt04.jpg"),
                "pattern5.png" => array( "title" => __( "Pattern 5", "brad-framework") , "img" => get_template_directory_uri()."/images/patterns/patt05.jpg"),
                "pattern6.png" => array( "title" => __( "Pattern 6", "brad-framework") , "img" => get_template_directory_uri()."/images/patterns/patt06.jpg"),
                "pattern7.png" => array( "title" => __( "Pattern 7", "brad-framework") , "img" => get_template_directory_uri()."/images/patterns/patt07.jpg"),
                "pattern8.png" => array( "title" => __( "Pattern 8", "brad-framework") , "img" => get_template_directory_uri()."/images/patterns/patt08.jpg"),
				"pattern9.jpg" => array( "title" => __( "Pattern 9", "brad-framework") , "img" => get_template_directory_uri()."/images/patterns/patt09.jpg"),
				"pattern10.png" => array( "title" => __( "Pattern 10", "brad-framework") , "img" => get_template_directory_uri()."/images/patterns/patt10.jpg"),
				"pattern11.jpg" => array( "title" => __( "Pattern 11", "brad-framework") , "img" => get_template_directory_uri()."/images/patterns/patt11.jpg"),
				"pattern12.jpg" => array( "title" => __( "Pattern 12", "brad-framework") , "img" => get_template_directory_uri()."/images/patterns/patt12.jpg"),
				"pattern13.jpg" => array( "title" => __( "Pattern 13", "brad-framework") , "img" => get_template_directory_uri()."/images/patterns/patt13.jpg"),
				"pattern14.png" => array( "title" => __( "Pattern 14", "brad-framework") , "img" => get_template_directory_uri()."/images/patterns/patt14.jpg"),
				"pattern15.png" => array( "title" => __( "Pattern 15", "brad-framework") , "img" => get_template_directory_uri()."/images/patterns/patt15.jpg")
            )),
			
		 array( "title" => __( "Custom CSS", "brad-framework"),
                "subtitle" => __( "Quickly add some CSS to your theme by adding it to this block. Do't Included ( <style type=\"text/css\"></style> ) Code", "brad-framework"),
                "id" => "custom_css",
                "default" => "",
                "type" => "textarea"
				),

        array( "title" => __( "Tracking Code", "brad-framework"),
		       "subtitle" => __( "Paste your Google Analytics (or other) tracking code here. This will be added into the  template of your theme.", "brad-framework"),
		       "id" => "google_analytics",
		       "default" => "",
		       "type" => "textarea"
			   ),  
			   
		array( "title" => __( "Custom font icon file", "brad-framework"),
			   "subtitle" => 'You can upload here a zip file containing css and icon font files. Use the <a href="http://icomoon.io/app/" target="_top">Icomoon</a> app to create icon font. Only zip files optained from icomoon application are supported. ' ,
			   "id" => "custom_iconfont",
			   "type" => "file" 
			)		    							 
        )
    );
    
$this->sections[] =  array(
		'icon' => 'el-icon-livejournal',
		'icon_class' => 'icon-small',
        'title' => __('Logo and Favicons', "brad-framework"),
		'desc' => '<p>Upload the Main  Logo and Favicons with  Retina Versions </p>' ,
        'fields' => array( 
					
             array( "title" => __( "Logo Upload", "brad-framework"),
					"subtitle" => __( "Upload your Logo", "brad-framework"),
					"id" => "media_logo",
					"default" => array( "url" =>  get_template_directory_uri()."/images/logo.png" ),
					'type' => 'media',
					'mode' => 'image'
					),
						
	         array( "title" => __( "Logo Top Margin", "brad-framework"),
					"subtitle" => __( "Enter your Top margin value for the Logo in pixels (Default: 31px)", "brad-framework"),
					"id" => "style_logotopmargin",
					"default" => "0px",
					"type" => "text"),
					
             array( "title" => __( "Logo left Margin", "brad-framework"),
					"subtitle" => __( "Enter your Bottom margin value for the Logo in pixels (Default: 0px)", "brad-framework"),
					"id" => "style_logoleftmargin",
					"default" => "0px",
					"type" => "text"), 	
					
					
             array( "title" => __( "Logo Upload Retina", "brad-framework"),
					"subtitle" => __( "Upload your Retina Logo.", "brad-framework"),
					"id" => "media_logo_retina",
					"default" => array( "url" => get_template_directory_uri()."/images/logo_2x.png" ),
					"type" => "media",
					'mode' => 'image'),
					
             array( "title" => __( "Original Logo Width", "brad-framework"),
					"subtitle" => __( "Width of Standard Logo in px ", "brad-framework"),
					"id" => "logo_width",
					"default" => "105px",
					"type" => "text"),
												
			
             array( "title" => __( "Custom Favicon (16x16)", "brad-framework"),
					"subtitle" => __( "Upload a 16px x 16px Png/ico image that will represent your website's favicon - use <a href='http://www.favicon.cc/' target='_blank'>favicon.cc</a> to make sure it's fully compatible)", "brad-framework"),
					"id" => "media_favicon",
					"default" => "",
					"type" => "media",
					'mode' => 'image'),
					
             array( "title" => __( "Apple iPhone Custom Icon (57x57)", "brad-framework"),
					"subtitle" => __( "Upload your Apple Touch Icon (57x57px png)", "brad-framework"),
					"id" => "media_favicon_iphone",
					"default" => "",
					"type" => "media",
					'mode' => 'image'),
					
            array( "title" => __( "Apple iPhone Custom Retina Icon  (114x114)", "brad-framework"),
					"subtitle" => __( "Upload your Apple Touch Retina Icon (114x114px png)", "brad-framework"),
					"id" => "media_favicon_iphone_retina",
					"default" => "",
					"type" => "media",
					'mode' => 'image'),
					
             array( "title" => __( "Apple iPad Custom Icon (72x72)", "brad-framework"),
					"subtitle" => __( "Upload your Apple Touch Retina Icon (144x144px png)", "brad-framework"),
					"id" => "media_favicon_ipad",
					"default" => "",
					"type" => "media",
					'mode' => 'image'),
					
             array( "title" => __( "Apple iPad Custom Retina Icon  (144x144px)", "brad-framework"),
					"subtitle" => __( "Upload your Apple Touch Retina Icon (144x144px png)", "brad-framework"),
					"id" => "media_favicon_ipad_retina",
					"default" => "",
					"type" => "media",
					'mode' => 'image') )) ;
					
					
								
$this->sections[] = array(
		'icon' => 'el-icon-text-width',
		'icon_class' => 'icon-small',
        'title' => __('Typography', "brad-framework"),
		'desc' => '<p>Customize the fonts for body , headings etc.</p><p>Use the below uploader fields to upload your fonts.To use the uploaded font please select the desired custom font from the select menu for font properties</p>' ,
        'fields' => array(
	        array( 
		            "title" => __( "Custom Font WOFF 1", "brad-framework"),
					"subtitle" => "",
					"id" => "custom_font_woff_1",
					'compiler'  => 'true',
                    'mode'      => false,
					"default" => array("url" => false) ,
					"type" => "media" ,
					"subtitle" => __("Upload your .woff font file","brad-framework")),

			array( 
		            "title" => __( "Custom Font TTF 1", "brad-framework"),
					"subtitle" => "",
					"id" => "custom_font_ttf_1",
					'compiler'  => 'true',
                    'mode'      => false,
					"default" => array("url" => false) ,
					"type" => "media",
					"subtitle" => __("Upload your .ttf font file","brad-framework") ),
				
			array( 
		            "title" => __( "Custom Font EOT 1", "brad-framework"),
					"subtitle" => "",
					"id" => "custom_font_eot_1",
					'compiler'  => 'true',
                    'mode'      => false,
					"default" => array("url" => false) ,
					"type" => "media",
					"subtitle" => __("Upload your .eot font file","brad-framework") ),
					
			array( 
		            "title" => __( "Custom Font SVG 1", "brad-framework"),
					"subtitle" => "",
					"id" => "custom_font_svg_1",
					'compiler'  => 'true',
                    'mode'      => false,
					"default" => array("url" => false) ,
					"type" => "media",
					"subtitle" => __("Upload your .svg font file","brad-framework") ),
					
		  array( 
		            "title" => __( "Custom Font WOFF 2", "brad-framework"),
					"subtitle" => "",
					"id" => "custom_font_woff_2",
					'compiler'  => 'true',
                    'mode'      => false,
					"default" => array("url" => false) ,
					"type" => "media",
					"subtitle" => __("Upload your .woff font file","brad-framework") ),

			array( 
		            "title" => __( "Custom Font TTF 2", "brad-framework"),
					"subtitle" => "",
					"id" => "custom_font_ttf_2",
					'compiler'  => 'true',
                    'mode'      => false,
					"default" => array("url" => false) ,
					"type" => "media",
					"subtitle" => __("Upload your .ttf font file","brad-framework") ),
				
			array( 
		            "title" => __( "Custom Font EOT 2", "brad-framework"),
					"subtitle" => "",
					"id" => "custom_font_eot_2",
					'compiler'  => 'true',
                    'mode'      => false,
					"default" => array("url" => false) ,
					"type" => "media",
					"subtitle" => __("Upload your .eot font file","brad-framework") ),
					
			array( 
		            "title" => __( "Custom Font SVG 2", "brad-framework"),
					"subtitle" => "",
					"id" => "custom_font_svg_2",
					'compiler'  => 'true',
                    'mode'      => false,
					"default" => array("url" => false) ,
					"type" => "media",
					"subtitle" => __("Upload your .svg font file","brad-framework") ),									
					
			array(  "title" => __( "Main Body  Font", "brad-framework"),
					"subtitle" => __( "Specify the Body font properties", "brad-framework"),
					"id" => "font_body",
					"color" => false ,
					"preview" => false ,
					"font-style" => false ,
					"font-backup" => true ,
					"text-align" => false ,
					"google" => true ,
					"default" => array('font-family' => 'Open Sans','font-weight' => '400' , 'font-size' => '14px' , 'line-height' => '23px'),
					"type" => "typography" ),
									
					
            array( "type" => "divide" ,
			       "id"   => "typography_divider"),
				
            array(  "title" => __( "H1 - Headline Font", "brad-framework"),
					"subtitle" => __( "Specify the H1 Headline font properties", "brad-framework"),
					"id"       => "font_h1",
					"color" => false ,
					"preview" => false ,
					"font-style" => false ,
					"font-backup" => true ,
					'letter-spacing' => true ,
					"text-align" => false ,
					"default" => array('font-family' => 'Open Sans',"font-backup"=> "Arial, Helvetica, sans-serif" , 'font-weight' => '300' , 'font-size' => '45px' , 'line-height' => '55px' , 'letter-spacing' => '-1px'),
					"type"     => "typography" ),  
					
        
					
			 array( "title" => __( "H2 - Headline Font", "brad-framework"),
					"subtitle" => __( "Specify the H2 Headline font properties", "brad-framework"),
					"id" => "font_h2",
					"color" => false ,
					"preview" => false ,
					"font-style" => false ,
					"font-backup" => true ,
					'letter-spacing' => true ,
					"text-align" => false ,
					"default" => array('font-family' => 'Open Sans', 'font-backup' => 'Arial, Helvetica, sans-serif' , 'font-weight' => '400' , 'font-size' => '32px' , 'line-height' => '42px','letter-spacing' => '-1px'),
					"type" => "typography"),  
					
						
					
             array( "title" => __( "H3 - Headline Font", "brad-framework"),
					"subtitle" => __( "Specify the H3 Headline font properties", "brad-framework"),
					"id" => "font_h3",
					"color" => false ,
					"preview" => false ,
					"font-style" => false ,
					"font-backup" => true ,
					"text-align" => false ,
					'letter-spacing' => true ,
					"default" => array('font-family' => 'Montserrat',"font-backup"=> "Arial, Helvetica, sans-serif" , 'font-weight' => '400' , 'font-size' => '21px' , 'line-height' => '31px' , 'letter-spacing' => '0'),
					"type" => "typography"),  
				

             array( "title" => __( "H4 - Headline Font", "brad-framework"),
					"subtitle" => __( "Specify the H4 Headline font properties", "brad-framework"),
					"id" => "font_h4",
					"color" => false ,
					"preview" => false ,
					"font-style" => false ,
					"font-backup" => true ,
					"text-align" => false ,
					'letter-spacing' => true ,
					"default" => array('font-family' => 'Montserrat',"font-backup"=> "Arial, Helvetica, sans-serif" , 'font-weight' => '400' , 'font-size' => '15px' , 'line-height' => '23px' , 'letter-spacing' => '0'),
					"type" => "typography"),  
					
				
					
			array( "title" => __( "H5 - Headline Font", "brad-framework"),
					"subtitle" => __( "Specify the H5 Headline font properties", "brad-framework"),
					"id" => "font_h5",
					"color" => false ,
					"preview" => false ,
					"font-style" => false ,
					"font-backup" => true ,
					"text-align" => false ,
					'letter-spacing' => true ,
					"default" => array('font-family' => 'Open Sans',"font-backup"=> "Arial, Helvetica, sans-serif" , 'font-weight' => '300' , 'font-size' => '24px' , 'line-height' => '32px' , 'letter-spacing' => '0'),
					"type" => "typography"),  
	

            array( "title" => __( "H6 - Headline Font", "brad-framework"),
					"subtitle" => __( "Specify the H6 Headline font properties", "brad-framework"),
					"id" => "font_h6",
					"color" => false ,
					"preview" => false ,
					"font-style" => false ,
					"font-backup" => true ,
					"text-align" => false ,
					'letter-spacing' => true ,
					"default" => array('font-family' => 'Open Sans',"font-backup"=> "Arial, Helvetica, sans-serif" , 'font-weight' => '300' , 'font-size' => '16px' , 'line-height' => '23px' , 'letter-spacing' => '0'),
					"type" => "typography"), 
					
		
		 array( "title" => __( "Read More Font", "brad-framework"),
					"subtitle" => __( "Specify the read More Button font", "brad-framework"),
					"id" => "font_readmore",
					"color" => false ,
					"preview" => false ,
					"font-style" => false ,
					"font-backup" => true ,
					"text-align" => false ,
					'letter-spacing' => true ,
					'line-height' => false ,
					"default" => array('font-family' => 'Open Sans',"font-backup"=> "Arial, Helvetica, sans-serif" , 'font-weight' => '400' , 'font-size' => '13px'  , 'letter-spacing' => '0.9'),
					"type" => "typography"), 	
					
		
		array( "title" => __( "Buttons Font", "brad-framework"),
					"subtitle" => __( "Specify the Button font", "brad-framework"),
					"id" => "font_button",
					"color" => false ,
					"preview" => false ,
					"font-style" => false ,
					"font-backup" => true ,
					"text-align" => false ,
					'letter-spacing' => true ,
					'line-height' => false ,
					"default" => array('font-family' => 'Open Sans',"font-backup"=> "Arial, Helvetica, sans-serif" , 'font-weight' => '600' , 'font-size' => '13px'  , 'letter-spacing' => '0'),
					"type" => "typography"), 						
		
			
					         
            array( "title" => __( "Sidebar Headline Font", "brad-framework"),
					"id" => "sidebar_headline_font",
					"color" => false ,
					"preview" => false ,
					"font-style" => false ,
					"font-backup" => true ,
					'letter-spacing' => true ,
					"text-align" => false ,
					"default" => array('font-family' => 'Montserrat','font-weight' => '400' , 'font-size' => '15px' , 'line-height' => '23px' , 'letter-spacing' => '1'),
					"type" => "typography")   ,
					
		     array( "title" => __("Enable Divider for sidebar font", "brad-framework"),
				   "id"=>"check_sidebar_divider",
                   "default"=>1,
				   "type"=>"switch"),			                                                  
								
			) 	
    );
    
	
 $this->sections[] = array(
	'icon' => 'el-icon-minus' ,
	'icon-class' => 'icon-small' ,
	'title' => __('Header Options', "brad-framework") ,
	'desc' => '<p>Customize the main Header Options .</p>' ,
	'fields' => array(
	      /*
	       array( 
		    "title" => __( "Header Type", "brad-framework") ,
	        "subtitle" => __( "Select the default header type and modify the selected header below", "brad-framework"),
            "id" => "header_type",
            "default" => "type1",
            "type" => "select",
			"multiselect" => false ,
            "options" => array (
			      "type1" => __("Header Type 1","brad-framework"), 
				  "type2" => __("Header Type 2","brad-framework")
            )),
		  */ 
		 
			 array( "title" => __( "Disable Fixed Nav", "brad-framework"),
					"id" => "disable_fixednav",
					"default" => false ,
					"type" => "switch" ),
					
			array( "title" => __( "Disable Shrinking of Nav", "brad-framework"),
					"subtitle" => __( "disable shrinking of nav during scroll ( If Nav type is fixed)", "brad-framework"),
					"id" => "disable_shrinknav",
					"default" => false ,
					"type" => "switch" ),	
			
		    
			 array( "title" => __( "Enable Divider on hover for Nav menu Items", "brad-framework"),
					"subtitle" => __( "Check to show Topbar (Callus Text & Social Media)", "brad-framework"),
					"id" => "show_nav_divi",
					"default" => 1,
					"type" => "switch" ), 
			
			array( "title" => "Header Height",
					"sub_desc" => " Default Header Height in px, Do't include px just numbers",
					"id" => "header_height",
					"default" => '100',
					"min" => '40' ,
					"max" => '400' ,
					"type" => "slider"
					),
							
							
             array( "title" => __( "Nav Menu font - first level", "brad-framework"),
					"subtitle" => __( "Navigation Menu - first Level Font Settings", "brad-framework"),
					"id"         => "font_nav",
					"color" => false ,
					"preview" => false ,
					"font-style" => false ,
					"font-backup" => true ,
					'letter-spacing' => true ,
					"text-transform" => true ,
					"text-align" => false ,
					"line-height" => false ,
					"default" => array('font-family' => 'Noto Sans',"font-backup"=> "Arial, Helvetica, sans-serif" , 'font-weight' => '400' , 'font-size' => '14px' , 'letter-spacing' => '0' ,"text-transform" => ""),
					"type"       => "typography"),	
							
          																	
             array( "title" => __( "Nav Menu font Level 2nd & 3rd", "brad-framework"),
					"subtitle" => __( "Navigation Menu - 2nd & 3rd Level Font Settings", "brad-framework"),
					"id" => "font_nav_dropdown",
					"color" => false ,
					"preview" => false ,
					"font-style" => false ,
					"font-backup" => true ,
					"text-align" => false ,
					'letter-spacing' => true ,
					"text-transform" => true ,
					"line-height" => false ,
					"default" => array('font-family' => 'Open Sans',"font-backup"=> "Arial, Helvetica, sans-serif" , 'font-weight' => '400' , 'font-size' => '13px' , 'letter-spacing' => '0' , "text-transform" => "uppercase"),
					"type" => "typography"),	
									
	
            array( "title" => __("Show Search Form in Header", "brad-framework"),
				   "id"=>"check_searchform",
                   "default"=>1,
				   "type"=>"switch"),

            array( "type" => "divide",
			       "id" => "topbar_settings_divider") ,
            
			 array( "title" => __( "Show Topbar", "brad-framework"),
					"subtitle" => __( "Check to show Topbar (Callus Text & Social Media)", "brad-framework"),
					"id" => "show_topbar",
					"default" => 1,
					"type" => "switch" ), 
			
			
			array( "title" => __( "Top Bar left content", "brad-framework"),
					"subtitle" => __( "Select content type form the list you want to display on left side of topbar", "brad-framework"),
					"id" => "topbar_left_content",
					"default" => 'contactinfo' ,
					"required" => array("show_topbar","=",1),
					"type" => "select",
					'multiselect' => false ,
					"options" => array(
					    "contactinfo" => 'Contact Info' ,
						"topmenu" => 'Top Navigation Menu' ,
						"socialicons" => 'Social Icons',
						'none' => 'Nothing' )
						),
						
			array( "title" => __( "Top Bar Right content", "brad-framework"),
					"subtitle" => __( "Select content type form the list you want to display on right side of topbar", "brad-framework"),
					"id" => "topbar_right_content",
					"default" => 'socialicons',
					"required" => array("show_topbar","=",1),
					"type" => "select",
					'multiselect' => false ,
					"options" => array(
					    "contactinfo" => 'Contact Info' ,
						"topmenu" => 'Top Navigation Menu' ,
						"socialicons" => 'Social Icons',
						'none' => 'Nothing' )
						),			 
			
			
             array( "title" => __( "Phone Number", "brad-framework"),
					"subtitle" => __( "Phone number to show in Topbar", "brad-framework"),
					"id" => "phone_topbar",
					"required" => array("show_topbar","=",1),
					"default" => "(+91) 9876543210",
					"type" => "text",
					), 
			
			 array( "title" => __( "Email Id", "brad-framework"),
					"subtitle" => __( "Email Id or Link to show in Topbar", "brad-framework"),
					"id" => "email_topbar",
					"required" => array("show_topbar","=",1),
					"default" => "no-reply@envato.com",
					"type" => "text"), 	
			
			/*		
			array( "title" => __( "Location", "brad-framework"),
					"subtitle" => __( "Location", "brad-framework"),
					"id" => "location_topbar",
					"required" => array("show_topbar","=",1),
					"default" => "no-reply@envato.com",
					"type" => "text"), 				
			*/	
			
			 array( "type" => "divide",
			       "id" => "titlebar_settings_divider") ,
				   		
             array( "title" => __( "Title Bar Padding Top (Classic Titlebar)", "brad-framework"),
			        "subtitle" => __( "Do't Include px only just numbers", "brad-framework"),
					"id" => "titlebar-padding-top",
					"default" => "30",
					"type" => "text"), 	
		
			 array( "title" => __( "Title Bar Padding Bottom (Classic Titlebar)", "brad-framework"),
					"id" => "titlebar-padding-bottom" ,
					"subtitle" => __( "Do't Include px only just numbers", "brad-framework"),
					"default" => "25",
					"type" => "text"), 								
	
             array( "title" => __( "Title Bar  Background Style", "brad-framework"),
					"subtitle" => __( "Default Titlebar Background Styles For Classic and Modern Titlebar ( You can also change this in page settings for each page)", "brad-framework"),
					"id" => "titlebar_bg",
					"default" => array("background-color"=>"#f7f7f7","background-repeat"=>"no-repeat","background-size"=>"cover","background-attachment" => "fixed","background-position"=>"center center","background-image" => false),
					"type" => "background"), 
																		
							
	        array( "title" => __( "Title Bar Border top ", "brad-framework"),
					"subtitle" => __( "Titlebar top Border For Both Versions", "brad-framework"),
					"id" => "border_titlebar_top",
					"default" => array('border-top' => '0','border-style' => 'solid','border-color' => ''),
					"type" => "border"), 

             array( "title" => __( "Title Bar Container Border bottom ", "brad-framework"),
					"subtitle" => __( "Titlebar Bottom Color For Both Versions", "brad-framework"),
					"id" => "border_titlebar_bottom",
					"default" => array('border-top' => '1px','border-style' => 'solid','border-color' => '#e5e5e5'),
					"type" => "border"), 
																	
	        array( "title" => __( "Title Bar Background Overlay Color (Modern Titlebar)", "brad-framework"),
					"id" => "titlebar_oc",
					"default" => "#788991",
					"type" => "color"), 
					
			array( "title" => __( "Title Bar Background Overlay opacity (Modern Titlebar)", "brad-framework"),
					"id" => "titlebar_oco",
					"default" => "0.5",
					"type" => "text"), 		
					
					
             array( "title" => __( "Title Font (Classic Titlebar)", "brad-framework"),
					"subtitle" => __( "Titlebar title Font Settings for Classic Titlebar", "brad-framework"),
					"id" => "font_titlebarheadline",
					"preview" => false ,
					"font-style" => false ,
					"line-height" => false ,
					"text-align" => false ,
					"default" => array('font-family' => 'Open Sans','font-weight' => '400','color' => '#999999' , 'font-size' => '18px' ),
					"type" => "typography"), 

						
			array( "title" => __( "Title Font (Modern Titlebar)", "brad-framework"),
					"subtitle" => __( "Titlebar title Font Settings for Modern titlebar", "brad-framework"),
					"id" => "font_titlebarheadline_style2",
					"preview" => false ,
					"font-style" => false ,
					"text-align" => false ,
					"letter-spacing" => true ,
					"default" => array('font-family' => 'Open Sans','font-weight' => '300','color' => '#444444' , 'font-size' => '49px' , 'line-height' => '60px' , 'letter-spacing' => '-1px' ),
					"type" => "typography"), 
					
	     
			/*		
			array( "title" => __( "Subtitle Font", "brad-framework"),
					"id" => "font_titlebarsubtitle",
					"preview" => false ,
					"font-style" => false ,
					"line-height" => false ,
					"default" => array('font-family' => 'Open Sans','font-weight' => '400','color' => '#aaaaaa' , 'font-size' => '18px' ),
					"type" => "typography"), 
			*/			
           		

             array( "title" => __( "Breadcrumb  Font", "brad-framework"),
					"id" => "font_breadcrumb",
					"preview" => false ,
					"font-style" => false ,
					"line-height" => false ,
					"text-align" => false ,
					"font-family" => false ,
					"default" => array('color' => '#999999' , 'font-size' => '13px' ),
					"type" => "typography"), 	
				
					
			array( "title" => __( "Breadcrumb Link Font Color", "brad-framework"),
					"subtitle" => __( "Default: #666666", "brad-framework"),
					"id" => "font_breadcrumb_link_color",
					"default" => '#666666',
					"type" => "color"), 
					
			array( "title" => __( "Breadcrumb Link Font Color:hover", "brad-framework"),
					"subtitle" => __( "Default: #444444", "brad-framework"),
					"id" => "font_breadcrumb_link_color_hover",
					"default" => '#444444',
					"type" => "color"), 						
	       )
		  );

$this->sections[] = array(
	'icon' => 'el-icon-error-alt' ,
	'icon-class' => 'icon-small' ,
	'title' => __('Footer Options', "brad-framework") ,
	'desc' => '<p>Customize The Main Footer Options</p>' ,
	'fields' => array(
			array( "title" => __( "Footer Background Color", "brad-framework"),
			        "id" => "color_footerbg",
			        "default" => "#2a2a2a",
			        "type" => "color"), 
					
		array( "title" => __( "Footer Font Size (in px)", "brad-framework"),
			        "id" => "fontsize_footer",
			        "default" => 13,
					"min" => 10,
					"max" => 20 ,
			        "type" => "slider"), 					
			
					
	        array( "title" => __( "Footer Text Color", "brad-framework"),
			       "id" => "color_footertext",
			       "default" => "#888888",
			       "type" => "color"), 
				   
		   array( "title" => __( "Footer Divider Color", "brad-framework"),
			       "id" => "color_footerdivider",
			       "default" => "#555555",
				   "subtitle" => __("Footer Divider Color Used In various widget places","brad-framework"),
			       "type" => "color"), 		   
				   
             array( "title" => __( "Footer Border Top", "brad-framework"),
					"id" => "border_footertop",
					"default" => array('border-top' => '0','border-style' => '','border-color' => ''),
					"type" => "border"), 
					
             array( "title" => __( "Footer Border Bottom", "brad-framework"),
					"id" => "border_footerbottom",
					"default" => array('border-top' => '0','border-style' => '','border-color' => ''),
					"type" => "border"), 					
								
	         array( "title" => __( "Enable  Footer widgets", "brad-framework"),
					"subtitle" => __( "Check to show widgetized Footer.", "brad-framework"),
					"id" => "check_footerwidgets",
					"default" => 1,
					"type" => "switch" ),
			
			
			 array( 
		          "title" => __( "Footer Columns", "brad-framework") ,
                  "id" => "footer_columns",
                  "default" => "4",
                  "type" => "select",
			      "multiselect" => false ,
                  "options" => array (
			            "2" => __("Two","brad-framework"), 
				        "3" => __("Three","brad-framework"),
						"4" => __("Four","brad-framework")
            )),
			
			
			 array( "title" => __( "Footer Widget Headline", "brad-framework"),
					"id" => "font_footerheadline",
					"preview" => false ,
					"font-style" => false ,
					"font-backup" => true ,
					'letter-spacing' => true ,
					"text-align" => false ,
					"line-height" => false ,
					'text-transform' => true ,
					"default" => array('font-family' => 'Montserrat','font-weight' => '400', 'font-size' => '16px' ,'letter-spacing'=> '1px','font-backup' => 'Arial, Helvetica, sans-serif' , 'color' => '#999999' , 'text-transform' => 'uppercase' ),
					"type" => "typography"),

					
       
					
	        array( "title" => __( "Footer Link Color", "brad-framework"),
			       "id" => "color_footerlink",
			       "default" => "#bbbbbb",
			       "type" => "color"), 
					
            array( "title" => __( "Footer Link Hover Color", "brad-framework"),
	    	       "id" => "color_footerlinkhover",
			       "default" => "#dddddd",
			       "type" => "color"), 					
								
             array( "title" => __( "Footer Copyright Section right content", "brad-framework"),
					"id" => "footer_rightcontent",
					 "multiselect" => false ,
					 "default" => "menu" ,
                     "options" => array (
			            "menu" => __("Menu","brad-framework"), 
				        "social" => __("Social Ions","brad-framework"),
						"none" => __("None","brad-framework") ) ,
					"type" => "select" ) 
			,
					
			array( "title" => __( "Copyright Background color", "brad-framework"),
			       "subtitle" => __( "Default: #1a1a1a", "brad-framework"),
			       "id" => "bg_color_copyright",
			       "default" => "#222222",
			       "type" => "color"), 
			
			  array( "title" => __( "Copyright Text Color", "brad-framework"),
			       "subtitle" => __( "Default: #777777", "brad-framework"),
			       "id" => "color_copyright",
			       "default" => "#777777",
			       "type" => "color"), 
				   
			  array( "title" => __( "Copyright Link Color", "brad-framework"),
			       "subtitle" => __( "Default: #999999", "brad-framework"),
			       "id" => "color_copyrightlink",
			       "default" => "#999999",
			       "type" => "color"), 
				   	   		
            array( "title" => __( "Copyright Link Hover Color", "brad-framework"),
			       "subtitle" => __( "Default: #ffffff", "brad-framework"),
	    	       "id" => "color_copyrightlinkhover",
			       "default" => "#ffffff",
			       "type" => "color"), 				
					
            array( "title" => __( "Copyright Text", "brad-framework"),
					"subtitle" => __( "Enter your Copyright Text (HTML allowed)", "brad-framework"),
					"id" => "textarea_copyright",
					"default" => "Durus v1.0 by <a href='http://themeforest.net/user/bradweb'>bradweb</a>",
					"type" => "textarea")
					)
				);
	
$this->sections[] = array(
		'icon' => 'el-icon-brush',
		'icon_class' => 'icon-small',
        'title' => __('Styling', "brad-framework"),
		'desc' => '<p>Customize  the Colors for body , menu , headings Etc.</p>' ,
        'fields' => array(
		     array( "title" => __( "Primary Color", "brad-framework"),
					"id" => "color_primary",
					"default" => "#2996cc",
					"type" => "color"), 

 		     array( "title" => __( "Link Color", "brad-framework"),
					"id" => "color_link",
					"default" => "#2996cc",
					"type" => "color"), 
					
 		     array( "title" => __( "Link Hover Color", "brad-framework"),
					"id" => "color_hover",
					"default" => "#2d2d2d",
					"type" => "color"), 
	
		     array( "title" => __( "Main Body  Font Color", "brad-framework"),
					"id" => "font_body_color",
					"default" => '#777777',
					"type" => "color"),
			
			 array( "title" => __( "H1 Color", "brad-framework"),
					"id" => "font_h1_color",
					"default" => '#444444',
					"type" => "color"),		
			
			 array( "title" => __( "H2 Color", "brad-framework"),
					"id" => "font_h2_color",
					"default" => '#444444',
					"type" => "color"),					
			
			 array( "title" => __( "H3 Color", "brad-framework"),
					"id" => "font_h3_color",
					"default" => '#333333',
					"type" => "color"),	
					
			array( "title" => __( "H4 Color", "brad-framework"),
					"id" => "font_h4_color",
					"default" => '#3d3d3d',
					"type" => "color"),
					
			array( "title" => __( "H5 Color", "brad-framework"),
					"id" => "font_h5_color",
					"default" => '#444444',
					"type" => "color"),
					
			array( "title" => __( "H6 Color", "brad-framework"),
					"id" => "font_h6_color",
					"default" => '#6d7579',
					"type" => "color"),												
					
		  array( "title" => __( "Sidebar Headline color", "brad-framework"),
			     "id" => "sidebar_headline_font_color",
				 "default" => '#454545' ,
				 "type" => "color"),   
					
		
	
	   array( "type" => "divide",
		         "id" => 'style_nav_divider') ,
				 
		 
		array( "title" => __( "Topbar Background color", "brad-framework"),
				"id" => "topbar_bg_color",
				"default" => '#f5f5f5',
				"type" => "color"),	 
				
		array( "title" => __( "Topbar Border color", "brad-framework"),
				"id" => "topbar_border_color",
				"default" => 'transparent',
				"type" => "color"),	 		
	   
	   array( "title" => __( "Topbar Font color", "brad-framework"),
				"id" => "topbar_font_color",
				"default" => '#bbbbbb',
				"type" => "color"),	 
				
	    array( "title" => __( "Topbar Social Links  color", "brad-framework"),
				"id" => "top_social_color",
				"default" => '#bbbbbb',
				"type" => "color"),	 
				
				
	array( "title" => __( "Topbar Social Links  color:hover", "brad-framework"),
				"id" => "top_social_color_hover",
				"default" => '#2996cc',
				"type" => "color"),	 
				
			
				
		array( "title" => __( "Topbar Contact info divider color", "brad-framework"),
				"id" => "topbar_ci_divi",
				"default" => '#dddddd',
				"type" => "color"),	
				
		array( "title" => __( "Topbar Contact info font color", "brad-framework"),
				"id" => "topbar_ci_font",
				"default" => '#bbbbbb',
				"type" => "color"),		
		
		
		array( "title" => __( "Topbar Menu divider color", "brad-framework"),
				"id" => "topbar_menu_divi",
				"default" => '#dddddd',
				"type" => "color"),	
				
						
		array( "title" => __( "Topbar Menu Font color", "brad-framework"),
				"id" => "topbar_menu_font",
				"default" => '#bbbbbb',
				"type" => "color"),		
		
		array( "title" => __( "Topbar Menu Font color:hover", "brad-framework"),
				"id" => "topbar_menu_font_hover",
				"default" => '#2996cc',
				"type" => "color"),		
									 		
				 
	    array( "type" => "divide",
		      "id" => "topbar_style_divider") ,
	 	 
		array( "title" => __( "Header Nav Background color", "brad-framework"),		
					"id"       => "nav_background_color",
					"default"  => "#ffffff",
					"type"     => "color" ),	
															
															
															
		 array( "title" => __( "Nav Menu font color - first level", "brad-framework"),
				"id" => "font_nav_color",
				"default" => '#555555',
				"type" => "color"),	  
										
 		  array( "title" => __( " Nav Menu font Color on hover", "brad-framework"),		
				 "id" => "nav_font_hover_color",
				 "default" => "#2996cc",
				 "type" => "color"),	
				 
		array( "title" => __( " Nav Active Menu font Color", "brad-framework"),		
				 "id" => "nav_font_active_color",
				 "default" => "#2996cc",
				 "type" => "color"),
		/*		 
		array( "title" => __( " Nav Active Menu Border Color", "brad-framework"),
				 "id" => "nav_font_active_border",
				 "default" => "#2996cc",
				 "type" => "color"),		 			 								
			*/							
         array( "title" => __( "Nav Dropdown  Background color", "brad-framework"),		
				"id" => "dropdown_background_color",
				"default" => "#ffffff",
				"type" => "color"),	
				
		array( "title" => __( "Nav Dropdown  Background Opacity", "brad-framework"),		
				"id" => "dropdown_background_opacity",
				"default" => "0.987",
				"type" => "text" ),				
		
		/*				
		 array( "title" => __( "Nav Dropdown  Top Border color", "brad-framework"),		
				"id" => "dropdown_border_top_color",
				"default" => "#eeeeee",
				"type" => "color"),				
		*/		
       array( "title" => __( "Nav Dropdown Menu font Color", "brad-framework"),
			  "id" => "font_dropdown_color",
			  "default" => '#777777',
			  "type" => "color"),
			  
	  array( "title" => __( "Nav Dropdown MegaMenu Title Color", "brad-framework"),
			  "id" => "megamenu_title_color",
			  "default" => '#555555',
			  "type" => "color"),		  
			  
	  array( "title" => __( "Nav Dropdown Menu Bottom Border Color", "brad-framework"),
			  "id" => "dropdown_menu_border_color",
			  "default" => '#f1f1f1',
			  "type" => "color"),
	
		  		  	
			  
	   array( "title" => __( "Nav Dropdown Active Menu font Color", "brad-framework"),
			  "id" => "font_dropdown_active_color",
			  "default" => '#444444',
			  "type" => "color"),			  
							
       array( "title" => __( "Nav Dropdown Menu font Color : hover", "brad-framework"),		
			  "id" => "dropdown_font_hover_color",
			  "default" => "#2996cc",
			  "type" => "color"),	
			  
	  	array( "title" => __( "Nav Dropdown  Menu Background Color : hover", "brad-framework"),
			  "id" => "dropdown_bg_color_hover",
			  "default" => 'transparent',
			  "type" => "color"),
			  
	   array( "title" => __( "Header Search and Mobile Menu Toggle Button Color", "brad-framework"),
			  "id" => "search_button_color",
			  "default" => '#666666',
			  "type" => "color"),
			  
	  array( "title" => __( "Header Search and Mobile Menu Toggle Button Color:hover", "brad-framework"),
			  "id" => "search_button_color_hover",
			  "default" => '#2996cc',
			  "type" => "color"),		  		  	
			  
									
	   array( "type" => "divide",
		      "id" => "dropdown_style_divider") ,
	
	
	array( "title" => __( "Overlay Background Color", "brad-framework"),
	       "id" => "color_bgoverlay",
		   "default" => "#000000",
 		   "type" => "color"), 
		   
  array( "title" => __( "Overlay Opacity", "brad-framework"),
	       "id" => "opacity_bgoverlay",
		   "default" => "0.65",
 		   "type" => "text"), 		   
		   
		   	
	array( "title" => __( "Primary Button Background Color", "brad-framework"),
	       "id" => "color_buttonbg",
		   "default" => array("from" => "#2892c6", "to" => "#2186b8"),
 		   "type" => "color_gradient"), 
							
	array( "title" => __( "Primary Button Text color", "brad-framework"),
		   "id" => "color_buttontext",
		   "default" => "#ffffff",
		   "type" => "color"), 
		  ));
	
$this->sections[] = array(
	'icon' => 'el-icon-comment',
	'icon_class' => 'icon-small',
    'title' => __('Blog settings', "brad-framework"),
	'desc' => '<p>Customize the Blog settings .</p>' ,
	'fields' => array(
	   array( "title" => __( "Blog Title", "brad-framework"),
			  "id" => "text_blogtitle",
			  "default" => "Latest News",
			  "type" => "text"),
					
         array( "title" => __( "Blog Type", "brad-framework"),
				"id" => "blog_type",
				"default" => "standard",
				"type" => "select",
				"multiselect" => false ,
				"options" => array(
				  'standard' => 'Standard Blog',
				  //'fullwidthAlternate' =>  'Blog Full Width Alternate', 
				  'grid' =>  'Grid Blog'
				 // 'timeline' =>  'Blog Timeline'
				  )
				  ),	
				  
	   array( "title" => __( "Default Blog Layout", "brad-framework"),
			  "subtitle" => __( "Select the default layout . This will be same for post display page", "brad-framework"),
			  "id" => "blog_layout",
			  "default" => "sidebar",
		      "type" => "select",
			  "multiselect" => false ,
			  "options" => array(
				    'sidebar'   => 'Blog With Sidebar', 
					'fullwidth' =>  'Blog Without Sidebar' )
					),	
	              
         array( "title" => __( "Blog Sidebar Position", "brad-framework"),
				"subtitle" => __( "Blog Listing Sidebar Position if Blog Layout Selected to Blog With Sidebar", "brad-framework"),
				"id" => "select_blogsidebar",
			    "default" => "sidebar-right",
				'required' => array('blog_layout','=','sidebar'),
				"type" => "select",
				"multiselect" => false ,
				"options" => array( 
				     'sidebar-right'=>'sidebar-right' , 
					 'sidebar-left' => 'sidebar-left'
					 )
				),	
						  
		 array( "title" => __( "Grid Blog Columns ?", "brad-framework"),
				"subtitle" => __( "If Blog Type selected to Grid Blog", "brad-framework"),
				"id" => "grid_blog_columns",
				"default" => "3",
				"type" => "select",
				"multiselect" => false ,
				'required' => array('blog_type','=','grid'),
				"options" => array(
				    '2' => 'Two columns',
				    '3' => 'Three Columns', 
				    '4' => 'Four Columns')
				  ),
	
		
	  array(
        "type" => "select",
        "title" =>  __("Blog Pagination", "brad-framework"),
        "id" => "blog_pagination",
	    "multiselect" => false ,
	    "required" => array("blog_type","=","grid"),
	    "default" => "default",
        "options" => array(
		             'default' => __('Standard Pagination','brad-framework') ,
	                 'ifscroll' => __('Infinite Scroll','brad-framework') ,
					 'loadmore' => __('Load More Button','brad-framework') ,
					 'no' => __('No Pagination','brad-framework') )
			     )
      ,
	  
	  array(
        "type"     => "select",
        "title" =>  __("Background Style for Grid Blog ?", "brad-framework"),
        "id"       => "grid_blog_style",
	    "subtitle" => __("This will help you to match  background color blog item with parent","brad-framework"),
	    "options"  => Array(
	                  "" => __( "Transparent" , "brad-framework" ) ,
				"stroke" => __( "Transparent with Stroke" , "brad-framework" )  ,
		         "white" => __( "White" , "brad-framework" ) ,
		          "grey" => __("White Smoke" , "brad-framework") ),
	   "required"  => array("blog_type", "=" ,"grid")	   
	  )
	  ,
	  
	  

			  
	
	  array(  "title" => __( "Enable Automatic Excerpts", "brad-framework"),
			   "subtitle" => __( "Check to create automatically excerpt for Standard Blog Type. This options is not available for except standard blog", "brad-framework"),
			   "id" => "check_excerpts",
			   "default" => 1 ,
			   "type" => "switch",
			   'required' => array('blog_type','=','standard')),   
	 
	 
	 array(
        "title" =>  __("Enable Lightbox Icon on Blog entries", "brad-framework"),
        "default" => 1 ,
		"id" => "blog_lightbox",
		"type" => "switch"
	    )
      ,
	
	  array(  "title" => __( "Enable 'Read More' Button", "brad-framework"),
			   "subtitle" => __( "Check to enable 'Read More' button on blog entries if automatic experts are on", "brad-framework"),
			   "id" => "check_readmore",
			   "required" => array('blog_type','=','standard'),
			   "default" => 1,
			   "type" => "switch"), 		   	
			   			    			 
       array( "title" => __( "Blog Excerpt Length", "brad-framework"),
			  "subtitle" => __( "Default: 40. Used for blog entries page , archives & search results.", "brad-framework"),
			  "id" => "text_excerptlength",
			  "default" => "40",
			  "type" => "text"), 				
					
       array( "title" => __( "Show Categories", "brad-framework"),
			  "subtitle" => __( "Check to show 'Categories' on blog entries.", "brad-framework"),
			  "id" => "check_blog_categories",
			  "default" => 1,
			  "type" => "switch"),
		
	  		  
	  array( "title" => __( "Show Author in Blog Entries", "brad-framework"),
			  "subtitle" => __( "Check to show 'Author' on blog entries.", "brad-framework"),
			  "id" => "check_author",
			  "default" => 1,
			  "type" => "switch"),	
			  
	  array( "title" => __( "Show Date", "brad-framework"),
			  "subtitle" => __( "Check to show 'date' on blog entries.", "brad-framework"),
			  "id" => "check_blog_date",
			  "default" => 1,
			  "type" => "switch"),		  

    array(
      "type" => "text",
      "title" => __("Text on the load more button", "brad-framework"),
      "id" => "blog_lm_title",
      "default" => __("Load More", "brad-framework"),
      "subtitle" => __("Text on the load More button.", "brad-framework"),
	  'required' => array('blog_pagination' ,'=' , 'loadmore')
    ),
 	    
       array( "title" => __( "Enable Author Info on Post Detail", "brad-framework"),
			   "subtitle" => __( "Check to enable Author Info", "brad-framework"),
			   "id" => "check_authorinfo",
			   "default" => 1,
			   "type" => "switch"  ), 

       array(  "title" => __( "Enable Related Posts on Post Detail", "brad-framework"),
				"subtitle" => __( "Check to enable Related Posts", "brad-framework"),
				"id" => "check_relatedposts",
				"default" => 1,
				"type" => "switch"), 
					
     
	 	  array( "title" => __( "Related Posts Number", "brad-framework"),
			  "subtitle" => __( "Maxmium Related Posts to display on Single Page", "brad-framework"),
			  "id" => "blog_relatedpostsnumber",
			  "default" => "10",
			  "type" => "text"),
			  
					
      array( "title" => __( "Enable Share-Box on Post Detail", "brad-framework"),
			 "subtitle" => __( "Check to enable Share-Box", "brad-framework"),
			 "id" => "check_sharebox",
			 "default" => 1,
			 "folds" => 1,
			 "type" => "switch" ), 
 
     array( "title" => __( "Enable Google +  in Social Sharing Box", "brad-framework"),
			"subtitle" => __( "Check to enable Google in Social Sharing Box", "brad-framework"),
			"id" => "check_sharingboxgoogle",
			"default" => 1,
			"type" => "checkbox",
			 'required' => array('check_sharebox','=',1) ), 
										
     array( "title" => __( "Enable Facebook in Social Sharing Box", "brad-framework"),
			"subtitle" => __( "Check to enable Facebook in Social Sharing Box", "brad-framework"),
			"id" => "check_sharingboxfacebook",
			"default" => 1,
			"type" => "checkbox",
			 'required' => array('check_sharebox','=',1) ), 
					
    array( "title" => __( "Enable Twitter in Social Sharing Box", "brad-framework"),
		   "subtitle" => __( "Check to enable Twitter in Social Sharing Box", "brad-framework"),
		   "id" => "check_sharingboxtwitter",
		   "default" => 1,
		   "type" => "checkbox",
			 'required' => array('check_sharebox','=',1) 
		   ), 
					
  array(  "title" => __( "Enable LinkedIn in Social Sharing Box", "brad-framework"),
		  "subtitle" => __( "Check to enable LinkedIn in Social Sharing Box", "brad-framework"),
		  "id" => "check_sharingboxlinkedin",
		  "default" => 1,
	 	  "type" => "checkbox",
			 'required' => array('check_sharebox','=',1)  ), 
					
  array( "title" => __( "Enable Pinterest in Social Sharing Box", "brad-framework"),
		 "subtitle" => __( "Check to enable Pinterset in Social Sharing Box", "brad-framework"),
		 "id" => "check_sharingboxpinterest",
		 "default" => 1,
		 "type" => "checkbox",
			 'required' => array('check_sharebox','=',1) ), 
					
 array( "title" => __( "Enable Reddit in Social Sharing Box", "brad-framework"),
		"subtitle" => __( "Check to enable Dribbble in Social Sharing Box", "brad-framework"),
		"id" => "check_sharingboxreddit",
		"default" => 1,
		"type" => "checkbox",
		'required' => array('check_sharebox','=',1) )
		)
	);	
	

$this->sections[] = array(
	
	'icon' => 'el-icon-th-large',
	'icon_class' => 'icon-small',
    'title' => __('Portfolio settings', "brad-framework"),
	'desc' => __('<p>Customize the Portfolio permanlinks options and Portfolio Archive Page Settings</p>','brad-framework') ,
	'fields' => array(
	 
	   array(
                'id' => 'portfolio_rewriteslug', 
                'type' => 'text', 
                'title' => __('Custom Slug', "brad-framework"),
                'sub_desc' => __('If you want your portfolio post type to have a custom slug in the url, please enter it here. <br /><b>Note:</b>After Saving this option , refresh your permalinks just by going to Settings > Permalinks and clicking save.', "brad-framework"),
                'desc' => ''
			), 
			
			
	 array( "title" => __("Portfolio Layout",'brad-framework'),
				"subtitle" => "",
				"id" => "portfolio_layout",
				"default" => "fullwidth",
				"type" => "select",
				"multiselect" => false ,
				"options" => array(
				  'fullwidth' => __('Fullwidth','brad-framework'),
				  'sidebar' =>  __('With Sidebar','brad-framework') )
				  ),	
				  
        array( "title" => __("Sidebar Position",'brad-framework'),
				"subtitle" => __("Sidebar Position if Portfolio Layout Selected to \"With Sidebar\"",'brad-framework'),
				"id" => "portfolio_sidebar_position",
			    "default" => "sidebar-right",
				"type" => "select",
				"required" => array("portfolio_layout","=","sidebar"),
				"multiselect" => false ,
				"options" => array( 
				     'sidebar-right'=> __('Sidebar Right','brad-framework') , 
					 'sidebar-left' => __('sidebar-left','brad-framework')
					 )
				),	
				
				
	  array("title" => __("Default sidebar",'brad-framework'),
			"subtitle" => __("Select a sidebar if Portfolio Layout Selected to \"With Sidebar\" . You must first create the sidebar under Appearance > Sidebars.",'brad-framework'),
			"id" => "portfolio_sidebar",
		    "default" => "",
			"type" => "select",
			"multiselect" => false ,
			"required" => array("portfolio_layout","=","sidebar"),
			"options" => $sidebars
			),				
		
	array( "title" => __("Portfolio Style",'brad-framework'),
		   "subtitle" => __("Default Portfolio Style","brad-framework"),
		   "id" => "portfolio_style",
		   "default" => "style2",
		   "type" => "select",
		   "multiselect" => false ,
		   "options" => array(
				   'style1' => __('Style 1','brad-framework'),
				   'style2' => __('Style 2','brad-framework'), 
				   'style3' => __('Style 3','brad-framework')
				  )
	  ),	

						  
	array( "title" => __("Columns",'brad-framework'),
		   "subtitle" => __("Number of columns to display",'brad-framework'),
		   "id" => "portfolio_columns",
		   "default" => "three",
		   "type" => "select",
		   "multiselect" => false ,
		   "options" => array(
		       '2' => __('Two columns','brad-framework'),
		       '3' => __('Three Columns','brad-framework'), 
		       '4' => __('Four Columns','brad-framework'),
			   '5' => __('Five Columns','brad-framework'))
		),
			   		  
	array( "title" => __("Enable Lightbox Icon",'brad-framework'),
		   "id" => "portfolio_lightbox",
		   "default" => true ,
		   "type" => "switch" 
		   ),
			   
    array( "title" => __("Enable Link Icon",'brad-framework'),
			"id" => "portfolio_linkicon",
			   "default" => true ,
			   "type" => "switch" 
			  ),			   
			   
		
	array( "title" => __("Display Categories",'brad-framework'),
		   "id" => "portfolio_categories",
		   "std" => true ,
		   "type" => "checkbox" , 
		   "switch" => true )
	     )	   

);		   
			 
	
$this->sections[] = array(
   'icon' => 'el-icon-bulb',
   'icon_class' => 'icon-small',
   'title' => __('Lightbox', "brad-framework"),
   'desc' => __('<p class="description">Customize the Lightbox Settings</p>', "brad-framework"),
   'fields' => array(
        array( "title" => __( "Lightbox Theme", "brad-framework"),
			   "id" => "lightbox_theme",
			   "default" => "pp_default",
			   "type" => "select",
			   "multiselect" => false ,
			   "options" => array(
				    'pp_default' => 'pp_default',
					'light_rounded' => 'light_rounded',
					'dark_rounded' => 'dark_rounded',
					'light_square' => 'light_square',
					'dark_square' => 'dark_square',
					'facebook' => 'facebook'
					)),	
					
             array( "title" => __( "Disable Lightbox on Smartphone", "brad-framework"),
					"subtitle" => __( "Check this  to disable Lightbox on Smartphones. This will link directly to the image", "brad-framework"),
					"id" =>  "lightbox_smartphones",
					"default" => 0,
					"switch" => true , "type" => "checkbox"),						
					
            array( "title" => __( "Animation Speed", "brad-framework"),
					"id" => "lightbox_animation_speed",
					"default" => "fast",
					"type" => "select",
					"multiselect" => false ,
					"options" => array('fast' => 'Fast', 'slow' => 'Slow', 'normal' => 'Normal')),

            array( "title" => __( "Background Opacity", "brad-framework"),
					"subtitle" => "",
					"id" => "lightbox_opacity",
					"default" => "0.8",
					"type" => "text"),

            array( "title" => __( "Show title", "brad-framework"),
					"subtitle" => __( "Check to show the title", "brad-framework"),
					"id" => "lightbox_title",
					"default" => 1,
					"switch" => true , "type" => "checkbox"),
					
            array( "title" => __( "Show Gallery Thumbnails", "brad-framework"),
					"subtitle" => __( "Check to show gallery thumbnails", "brad-framework"),
					"id" => "lightbox_gallery",
					"default" => 1,
					"switch" => true , "type" => "checkbox"),

            array( "title" => __( "Autoplay Gallery", "brad-framework"),
					"subtitle" => __( "Check to autoplay the lightbox gallery", "brad-framework"),
					"id" => "lightbox_autoplay",
					"default" => 0,
					"switch" => true , "type" => "checkbox"),

            array( "title" => __( "Autoplay Gallery Speed", "brad-framework"),
					"subtitle" => __( "If autoplay is set to true, select the slideshow speed in ms. (Default: 5000, 1000 ms = 1 second)", "brad-framework"),
					"id" => "lightbox_slideshow_speed",
					"default" => "5000",
					"type" => "text"),

            array( "title" => __( "Social Icons", "brad-framework"),
					"subtitle" => __( "Check to show social sharing icons", "brad-framework"),
					"id" => "lightbox_social",
					"default" => 1,
					"switch" => true , "type" => "checkbox")	
        
        )
    );


$this->sections[] = array(
		'icon' => 'el-icon-twitter',
		'icon_class' => 'icon-small',
        'title' => __('Social Media', "brad-framework"),
        'desc' => __('<p class="description">Enter your username / URL to show or leave blank to hide Social Media Icons</p>', "brad-framework"),
        'fields' => array(				
             array( "title" => __( "Twitter Username", "brad-framework"),
					"subtitle" => __( "Enter your Twitter Username", "brad-framework"),
					"id" => "social_twitter",
					"default" => "",
					"type" => "text"), 
					
             array( "title" => __( "Flickr URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your Flickr Account", "brad-framework"),
					"id" => "social_flickr",
					"default" => "",
					"type" => "text"), 

            array( "title" => __( "Facebook URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your Facebook Account", "brad-framework"),
					"id" => "social_facebook",
					"default" => "",
					"type" => "text"), 
					
            array( "title" => __( "Google+ URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your Google+ Account", "brad-framework"),
					"id" => "social_google",
					"default" => "",
					"type" => "text"), 
					
            array( "title" => __( "LinkedIn URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your LinkedIn Account", "brad-framework"),
					"id" => "social_linkedin",
					"default" => "",
					"type" => "text"),
					 
            array( "title" => __( "YouTube URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your YouTube Account", "brad-framework"),
					"id" => "social_youtube",
					"default" => "",
					"type" => "text"), 
					
            array( "title" => __( "Instagram URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your Instagram Account", "brad-framework"),
					"id" => "social_instagram",
					"default" => "",
					"type" => "text"), 					
					
            array( "title" => __( "Vimeo URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your Vimeo Account", "brad-framework"),
					"id" => "social_vimeo",
					"default" => "",
					"type" => "text"), 
										
            array( "title" => __( "Skype URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your Skype Account", "brad-framework"),
					"id" => "social_skype",
					"default" => "",
					"type" => "text"), 
					
            array( "title" => __( "Forrst URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your Forrst Account", "brad-framework"),
					"id" => "social_forrst",
					"default" => "",
					"type" => "text"), 

            array( "title" => __( "Dribbble URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your Dribbble Account", "brad-framework"),
					"id" => "social_dribbble",
					"default" => "",
					"type" => "text"), 
						
           
            /*
			
			 array( "title" => __( "Digg URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your Digg Account", "brad-framework"),
					"id" => "social_digg",
					"default" => "",
					"type" => "text"), 

            array( "title" => __( "Yahoo URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your Yahoo Account", "brad-framework"),
					"id" => "social_yahoo",
					"default" => "",
					"type" => "text"),
					
       array( "title" => __( "DeviantArt URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your DeviantArt Account", "brad-framework"),
					"id" => "social_deviantart",
					"default" => "",
					"type" => "text"), 					 
			*/
					
            array( "title" => __( "Tumblr URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your Tumblr Account", "brad-framework"),
					"id" => "social_tumblr",
					"default" => "",
					"type" => "text"), 
					
      
					
            array( "title" => __( "Behance URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your Behance Account", "brad-framework"),
					"id" => "social_behance",
					"default" => "",
					"type" => "text"),
					
            array( "title" => __( "Pinterest URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your Pinterest Account", "brad-framework"),
					"id" => "social_pinterest",
					"default" => "",
					"type" => "text"),  
					
            array( "title" => __( "PayPal URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your PayPal Account", "brad-framework"),
					"id" => "social_paypal",
					"default" => "",
					"type" => "text"), 
					
            array( "title" => __( "Delicious URL", "brad-framework"),
					"subtitle" => __( "Enter URL to your Delicious Account", "brad-framework"),
					"id" => "social_delicious",
					"default" => "",
					"type" => "text"), 
					
            array( "title" => __( "Show RSS", "brad-framework"),
					"subtitle" => __( "Check to Show RSS Icon", "brad-framework"),
					"id" => "social_rss",
					"default" => 1,
					"switch" => true , "type" => "checkbox")
					)
             );
 
 
$this->sections[] = array(
	'icon' => 'el-icon-shopping-cart',
	'icon_class' => 'icon-small',
    'title' => __('woocommerce', "brad-framework"),
	'desc' => '<p>Customize the Blog settings .</p>' ,
	'fields' => array(
	 
  
	
       array( "title" => __( "Enable Rollover Effect for Product Images", "brad-framework"),
			 "id" => "check_shoprollover",
			 "default" => 1,
			 "type" => "switch" ) ,
		
	   array( "title" => __( "Enable Cart Display in header", "brad-framework"),
			 "id" => "check_cartheader",
			 "default" => 1,
			 "type" => "switch" ) ,	
			 		 
	   array( "title" => __( "Enable Cart icon for mobile", "brad-framework"),
			 "id" => "check_cartmobile",
			 "default" => 1,
			 "type" => "switch" ) 		 
					
		)
	);	
	
                

$this->sections[] = array(
		'icon' => 'el-icon-leaf',
		'icon_class' => 'icon-small',
        'title' => __('Theme Update', "brad-framework"),
        'desc' => __('<p class="description">Enter your username / Api to get theme update notifications</p>', "brad-framework"),
        'fields' => array(				
             array( "title" => "Purchase Code",
					"description" => "<p>Enter your purchase code for this theme , refer to the following image to find your purchase code   </p><p> <img src='".get_template_directory_uri()."/images/product_key.png' /></p>",
					"id" => "envato_license_key",
					"std" => "",
					"type" => "text")
				)		
			);		    
			
			

		}	




		/**
			
			All the possible arguments for Redux.
			For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

		 **/
		public function setArguments() {
			
			$theme = wp_get_theme(); // For use with some settings. Not necessary.

			$this->args = array(
	            
	            // TYPICAL -> Change these values as you need/desire
				 
				'opt_name' => 'brad_options' , // This is where your data is stored in the database and also becomes your global variable name.
				'display_name'			=> $theme->get('Name'), // Name that appears at the top of your panel
				'display_version'		=> $theme->get('Version'), // Version that appears at the top of your panel
				'menu_type'          	=> 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
			
			    'allow_sub_menu'     	=> true, // Show the sections below the admin menu item or not
				'menu_title'			=> __( 'Durus Options', 'brad-framework' ),
	            'page'		 	 		=> __( 'Durus Options', 'brad-framework' ),
	            'google_api_key'   	 	=> '', // Must be defined to add google fonts to the typography module
	            'global_variable'    	=> '', // Set a different name for your global variable other than the opt_name
	            'dev_mode'           	=> false , // Show the time the page took to load, etc
	            'customizer'         	=> false , // Enable basic customizer support

	            // OPTIONAL -> Give you extra features
	            'page_priority'      	=> 50 , // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	            'page_parent'        	=> 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	            'page_permissions'   	=> 'manage_options', // Permissions needed to access the options panel.
	            'menu_icon'          	=> '', // Specify a custom URL to an icon
	            'last_tab'           	=> '', // Force your panel to always open to a specific tab (by id)
	            'page_icon'          	=> 'icon-themes', // Icon displayed in the admin panel next to your menu_title
	            'page_slug'          	=> '_options', // Page slug used to denote the panel
	            'save_defaults'      	=> true, // On load save the defaults to DB before user clicks save or not
	            'default_show'       	=> false, // If true, shows the default value next to each field that is not the default value.
	            'default_mark'       	=> '', // What to print by the field's title if the value shown is default. Suggested: *


	            // CAREFUL -> These options are for advanced use only
	            'transient_time' 	 	=> 60 * MINUTE_IN_SECONDS,
	            'output'            	=>  false , // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	            'output_tag'            	=> false , // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	            //'domain'             	=> 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
	            'footer_credit'      	=> '', // Disable the footer credit of Redux. Please leave if you can help it.
	            

	            // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	            'database'           	=> '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	            
	        
	            'show_import_export' 	=> true, // REMOVE
	            'system_info'        	=> false, // REMOVE
	            
	            'help_tabs'          	=> array(),
	            'help_sidebar'       	=> '', // __( '', $this->args['domain'] );            
				);

		}
	}
	
	new Redux_Framework_config();

}
