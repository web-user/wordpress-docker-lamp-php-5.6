<?php
add_action( 'admin_init', 'rw_register_meta_box' );
function rw_register_meta_box()
{
    // Check if plugin is activated or included in theme
    if ( !class_exists( 'RW_Meta_Box' ) ) { return; }
	global $brad_data , $wpdb;
	$revsliders =array();
	$revsliders[0] = 'Select a slider';
	if (is_plugin_active('revslider/revslider.php')) {
    $get_sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
    if($get_sliders) {
	    foreach($get_sliders as $slider) {
		   $revsliders[$slider->alias] = $slider->title;
	   }
    }
	}
	$prefix = 'brad_';
	$meta_boxes = array();
	$meta_boxes[] = array(
	    	'id' => 'brad-metabox-post-gallery',
		    'title' =>  __('Gallery Settings','brad-framework'),
	    	'description' => '',
    		'pages'      => array( 'post' ), // Post type
	    	'context'    => 'normal',
		    'priority'   => 'high',
	    	'show_names' => true, // Show field names on the lef
	    	'fields' => array(
			     array(
			         'name'		=> 'Gallery Images',
			         'desc'	    => 'Upload Images for post Gallery ( Upto 15 Images ).',
			         'type'     => 'image_advanced',
			         'id'	    => $prefix . 'image_list',
	         'max_file_uploads' => 15 
	         )
		)
	);


   $meta_boxes[] = array(
		'id' => 'brad-metabox-post-video',
		'title' => __('Video Settings','brad-framework'),
		'description' => '',
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array( 
		   array(
				  'name' => 'Featued Video',
				  'desc' => 'Insert The Embed Code from your Video ( Note : Please Do\' insert any Video Links Here)',
			  	  'id'   => $prefix . 'video_embed',
				  'type' => 'textarea',
			)
		  , 
		)
	 );
	 
	

  //Parallax Slider
  /*	
   $meta_boxes[] = array(
	   'id'		=> 'bradslider_options',
	   'title'		=> 'Slider Options',
	   'pages'		=> array( 'bradslider' ),
	   'context' => 'normal',
       'fields'	=> array(	
	
	    array(
				'name'		=> 'Slider Background Type',
				'id'		=> $prefix . "slider_type",
				'desc'      => __('Select the default background type','brad-framework'),
				'type'		=> 'select',
				'options'	=> array(
				    'image'	=> 'Image',
					'video'		=> 'Video'
				),
				'multiple'	=> false,
				'std'		=> array( 'image' )
		),
		
		
		 array(
			'name'		=>  'Slider Background Image',
			'id'		=>  $prefix . 'slider_image',
			'type'      =>  'image_advanced',
			'desc'      => __('Background Image for Slider if background type selected to image','brad-framework'),
			'max_file_uploads' => 1
		),	
		
		
		array(
			'name'		=> 'Sider Background video ( mp4)',
			'id'		=> $prefix . 'slider_video_mp4',
			'clone'		=> false,
			'type'		=> 'text',
			'desc'      => 'Slider Background mp4 video url if Slider background type selected to video . You can upload video with wordpress media.' ,
			'std'		=> ''
		),	
		
		array(
			'name'		=> 'Sider Background video (WebM)',
			'id'		=> $prefix . 'slider_video_webm',
			'clone'		=> false,
			'type'		=> 'text',
			'desc'      => 'Slider Background Webm video url if Slider background type selected to video . You can upload video with wordpress media.' ,
			'std'		=> ''
		),	
		
		
		array(
			'name'		=> 'Sider Background video (OGV)',
			'id'		=> $prefix . 'slider_video_ogv',
			'clone'		=> false,
			'type'		=> 'text',
			'desc'      => 'Slider Background ogv video url if Slider background type selected to video . You can upload video with wordpress media.' ,
			'std'		=> ''
		),	
		
		
		 array(
			'name'		=> 'Sider Title',
			'id'		=> $prefix . 'slider_title',
			'clone'		=> false,
			'type'		=> 'text',
			'desc'      => '' ,
			'std'		=> ''
		),
		
		array(
			'name'		=> 'Sider Sub Title',
			'id'		=> $prefix . 'slider_subtitle',
			'clone'		=> false,
			'type'		=> 'text',
			'desc'      => 'This will be place on top of the slider title' ,
			'std'		=> ''
		),	
		
		
		array(
			'name'		=> 'Sider Caption',
			'id'		=> $prefix . 'slider_caption',
			'clone'		=> false,
			'type'		=> 'textarea',
			'desc'      => '' ,
			'std'		=> ''
		),	
		
		array(
			'name'		=> 'Sider Font Color Scheme',
			'id'		=> $prefix . 'slider_color',
			'type'		=> 'select',
				'options'	=> array(
				    'light'	=> 'light',
					'dark'	=> 'dark'
				),
			'multiple'	=> false,
			'std'		=> array( 'light' ),
			'desc'      => '' 
		),	
		
		
		array(
			'name'		=> 'Sider Caption horizental Align',
			'id'		=> $prefix . 'slider_caption_align',
			'type'		=> 'select',
				'options'	=> array(
				    'left'	=> 'left',
					'center'	=> 'center' ,
					'right'	=> 'right' 
				),
			'multiple'	=> false,
			'std'		=> array( 'left' ),
			'desc'      => '' 
		),	
		
		array(
			'name'		=> 'Sider Caption Vertical Align',
			'id'		=> $prefix . 'slider_caption_vertical_align',
			'type'		=> 'select',
				'options'	=> array(
				    'top'	=> 'top',
					'center'	=> 'center' ,
					'top'	=> 'bottom' 
				),
			'multiple'	=> false,
			'std'		=> array( 'center' ),
			'desc'      => '' 
		),	
		
		
		  array(
			'name'		=> 'Slider Caption Button Text',
			'id'		=> $prefix . 'slider_button',
			'clone'		=> false,
			'type'		=> 'text',
			'desc'      => 'Leave Blank if you do\'t want to display this button' ,
			'std'		=> ''
		),	
		
		array(
			'name'		=> 'Slider Caption Button Style',
			'id'		=> $prefix . 'slider_button_style',
			'desc'      => 'Leave Blank if you do\'t want to display this button' ,
			'type'		=> 'select',
				'options'	=> array( "default" => __("Default", "brad-framework") , "grey" =>  __("Grey Button", "brad-framework") , "green" => __("Green Button", "brad-framework") , "seagreen" => __("Sea Green Button", "brad-framework"), "orange" => __("Orange Button", "brad-framework"), "red" => __("Red Button", "brad-framework") , "black" => __("Black Button", "brad-framework") , "purple" => __("Purple Button", "brad-framework")  ,  "yellow" => __("Yellow Button", "brad-framework") , 'alternate' => __('Alternate Button','brad-framework') , 'alternate-white' => __('Alternate Transparent Button','brad-framework') ),
				'multiple'	=> false,
				'std'		=> array( 'default' )
		),	
		
		
		array(
			'name'		=> 'Slider Caption Alternate Button Text',
			'id'		=> $prefix . 'slider_button_alternate',
			'clone'		=> false,
			'type'		=> 'text',
			'desc'      => 'Leave Blank if you do\'t want to display this button' ,
			'std'		=> ''
		),	
		
		array(
			'name'		=> 'Slider Caption Alternate Button Style',
			'id'		=> $prefix . 'slider_button_style_alternate',
			'desc'      => 'Leave Blank if you do\'t want to display this button' ,
			'type'		=> 'select',
				'options'	=> array( "default" => __("Default", "brad-framework") , "grey" =>  __("Grey Button", "brad-framework") , "green" => __("Green Button", "brad-framework") , "seagreen" => __("Sea Green Button", "brad-framework"), "orange" => __("Orange Button", "brad-framework"), "red" => __("Red Button", "brad-framework") , "black" => __("Black Button", "brad-framework") , "purple" => __("Purple Button", "brad-framework")  ,  "yellow" => __("Yellow Button", "brad-framework") , 'alternate' => __('Alternate Button','brad-framework') , 'alternate-white' => __('Alternate Transparent Button','brad-framework') ),
				'multiple'	=> false,
				'std'		=> array( 'alternate-white' )
		),	
		
		
		array(
				'name'		=> 'Slider Caption Css Animation',
				'id'		=> $prefix . "slider_caption_animation",
				'type'		=> 'select',
				'options'	=> array(
					'fade'			=> 'Fade',
					'slide-left'    => 'Slide From Left',
					'slide-right'   => 'Slide From Right',
					'slide-top'     => 'Slide From Top',
					'slide-bottom'  => 'Slide From bottom'
				),
				'multiple'	=> false,
				'std'		=> array( 'fade' )
		),
		
		
		
		 array(
			'name'		=>  'Slider Image',
			'id'		=>  $prefix . 'slider_img',
			'type'      =>  'image_advanced',
			'max_file_uploads' => 1
		),
		
		array(
			'name'		=> 'Sider Image Align',
			'id'		=> $prefix . 'slider_img_align',
			'type'		=> 'select',
				'options'	=> array(
				    'top'	=> 'Top of caption content',
					'left'	=> 'Left Side of the caption' ,
					'right'	=> 'Right Side of the content' 
				),
			'multiple'	=> false,
			'desc'      => __("By Default Slider image will be placed on the top of caption content , You can align the image according to caption alignment.For ex. if you are aligning caption to the left , image will be displayed as part of the caption and align on top and if you want the image to be different form caption and want to align on right then 'select right side of the content'","brad-framework"),
			'std'		=> array( 'top' )
		),		
		
		
		array(
				'name'		=> 'Slider Image Css Animation',
				'id'		=> $prefix . "slider_image_animation",
				'type'		=> 'select',
				'options'	=> array(
					'fade'			=> 'Fade',
					'slide-left'    => 'Slide From Left',
					'slide-right'   => 'Slide From Right',
					'slide-top'     => 'Slide From Top',
					'slide-bottom'  => 'Slide From bottom'
				),
				'multiple'	=> false,
				'std'		=> array( 'fade' )
		)
	
	)
  );
 
 	*/
	
  
	 //Portfolio Option		
   $meta_boxes[] = array(
	   'id'		=> 'portfolio_options',
	   'title'		=> 'Project Info',
	   'pages'		=> array( 'portfolio' ),
	   'context' => 'normal',
       'fields'	=> array(
	  
	   
	   array(
			'name'		=> 'excerpt',
			'id'		=> $prefix . 'excerpt',
			'clone'		=> false,
			'type'		=> 'wysiwyg',
			'desc'      => 'Project Excerpt' , 
			'std'		=> ''
		),	
		
	    array(
			'name'		=> 'Client',
			'id'		=> $prefix . 'project_client',
			'desc'		=> '',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		
	  
		
	   array(
			'name'		=> 'Project link',
			'id'		=> $prefix . 'portfolio-link',
			'desc'		=> 'URL to the Project if available (Do not forget the http://)',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		
		array(
			'name'		=> 'Project link title',
			'id'		=> $prefix . 'portfolio-link-title',
			'desc'		=> '',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		
		/*
		array(
				'name'		=> 'Project Image Size',
				'id'		=> $prefix . "project_img_size",
				'type'		=> 'select',
				'options'	=> array(
				    'fullwidth'	=> 'Fullwidth',
					'half'		=> '2/3 Width'
				),
				'description' => 'Project image if select portfolio type select to masonry layout.' ,
				'multiple'	=> false,
				'std'		=> array( 'fullwidth' )
		),
		*/
		
		array(
				'name'		=> 'Project type',
				'id'		=> $prefix . "project_type",
				'type'		=> 'select',
				'options'	=> array(
				    ''	=> 'Fullwidth',
					'half'		=> '2/3 Width'
				),
				'multiple'	=> false,
				'std'		=> array( 'fullwidth' )
		),
		
		
	  array(
			'name'		=> 'Show Related Projects?',
			'id'		=> $prefix . "portfolio-relatedposts",
			'type'		=> 'checkbox',
			'std'       => true 
		),
		
	   
	   array(
			'name'		=> 'Project Slider Images',
			'desc'	    => 'Upload up to 50 project images for a slideshow.',
			'type'      =>  'image_advanced',
			'id'	    => $prefix . 'image_list',
	 'max_file_uploads' => 50 ,
		
	  ),	
		
	
       array(
		    'name' => 'Featued Video for your project',
		    'desc' => 'Insert The Embed Code from your Video ( Note : Please Do\' insert only Video Links Here)',
	    	'id'   => $prefix . 'video_embed',
		    'type' => 'textarea',
			)		
		
	
	)
  );
  
 
 
 	
	/* Clients Meta Box */ 
	$meta_boxes[] = array(
		'id'    => 'client_meta_box',
		'title' => __('Client Meta', 'brad-framework'),
		'pages' => array( 'clients' ),
		'fields' => array(
			
			// CLIENT IMAGE LINK
			array(
				'name' => __('Client Link', 'brad-framework'),
				'id' => $prefix . 'client_link',
				'desc' => __("Enter the link for the client if you want the image to be clickable.", 'brad-framework'),
				'clone' => false,
				'type'  => 'text',
				'std' => ''
			),
			array(
				'name'  => __('Client Logo', 'brad-framework'),
				'desc'  => __('Enter the image for the Client (required).', 'brad-framework'),
				'id'    => $prefix  . "client_image",
				'type'  => 'image_advanced',
				'max_file_uploads' => 1
			)
		)	
	);
	
	
	/* Testimonials Meta Box */
	$meta_boxes[] = array(
		'id'    => 'testimonials_meta_box',
		'title' => __('Testimonial Info', 'brad-framework'),
		'pages' => array( 'testimonials' ),
		'fields' => array(
			
			array(
				'name' => __('Testimonial Name', 'brad-framework'),
				'id' => $prefix . 'testimonial_name',
				'desc' => __("Enter the cite name for the testimonial.", 'brad-framework'),
				'clone' => false,
				'type'  => 'text',
				'std' => ''
			),
			
			array(
				'name' => __('Role', 'brad-framework'),
				'id' => $prefix . 'testimonial_role',
				'desc' => __("Enter the role of testimonial for ex. Ceo  , President", 'brad-framework'),
				'clone' => false,
				'type'  => 'text',
				'std' => ''
			),

			array(
				'name' => __('Testimonial Company', 'brad-framework'),
				'id' => $prefix . 'testimonial_company',
				'desc' => __("Enter the testimonial company (optional).", 'brad-framework'),
				'clone' => false,
				'type'  => 'text',
				'std' => ''
			),
		
		  array(
				'name' => __('Company Link', 'brad-framework'),
				'id' => $prefix . 'testimonial_company_link',
				'desc' => __("Enter the Company url or leve blank if do't want to have a link", 'brad-framework'),
				'clone' => false,
				'type'  => 'text',
				'std' => ''
			),

			array(
				'name'  => __('Testimonial  Image', 'brad-framework'),
				'desc'  => __('Enter the image for the testimonial (optional).', 'brad-framework'),
				'id'    => $prefix  . "testimonial_image",
				'type'  => 'image_advanced',
				'max_file_uploads' => 1
			),
		)	
	);
	

	 //Page Options
     $meta_boxes[] = array(
	   'id'		=> 'brad_page_settings_default',
	   'title'		=> 'Page Settings',
	   'pages'		=> array( 'page' , 'post' ),
	   'context' => 'side',
       'fields'	=> array(
	   
	   	array(
			'name'		=> 'Default Page Layout',
			'id'		=> $prefix . "page_layout",
			'type'		=> 'select',
			'options'	=> array(
			        'fullwidth'		=> 'Full Width',
					'sidebar'		=> 'With Sidebar',
				),
			'multiple'	=> false
		),	
		
	  array(
			'name'		=> 'Sidebar Position',
			'id'		=> $prefix . "sidebar_position",
			'type'		=> 'select',
			'options'	=> array(
			        'left'		=> 'Left',
					'right'		=> 'Right',
				),
			'multiple'	=> false
		  ) 
	   	  
		)
	 );
	 
	 	
if($brad_data['layout'] == 'boxed' ) {
	
      $meta_boxes[] = array(
			'id' => 'styling',
			'title' => 'Background Styling Options',
			'pages' => array( 'post', 'page', 'portfolio' ),
			'context' => 'side',
			'priority' => 'low',
		
			// List of meta fields
			'fields' => array(
				array(
					'name'		=> 'Background Image',
					'id'		=> $prefix . 'bg_image',
					'desc'		=> '',
					'clone'		=> false,
					'type'		=> 'image_advanced',
					'max_file_uploads' => 1
				),
				array(
					'name'		=> 'Style',
					'id'		=> $prefix . "bg_style",
					'type'		=> 'select',
					'options'	=> array(
						'stretch'		=> 'Cover Background 100%',
						'repeat'		=> 'Repeat',
						'no-repeat'		=> 'No-Repeat',
						'repeat-x'		=> 'Repeat-X',
						'repeat-y'		=> 'Repeat-Y'
					),
					'multiple'	=> false,
					'std'		=> array( 'stretch' )
				),
				array(
					'name'		=> 'Background Color',
					'id'		=> $prefix . "bg_color",
					'type'		=> 'color'
				)
			)
		);
}
		
	  $meta_boxes[] = array(
	   'id'		=> 'brad_page_settings_sideNavigation',
	   'title'		=> 'Side Nav Position',
	   'pages'		=> array( 'page' ),
	   'context' => 'side',
       'fields'	=> array(
	   
	  array(
			'name'		=> '',
			'id'		=> $prefix . "sidenav_position",
			'type'		=> 'select',
			'options'	=> array(
			        'left'		=> 'Left',
					'right'		=> 'Right',
				),
			'multiple'	=> false
		 )	
		)
	  );
		
     $meta_boxes[] = array(
	   'id'		=> 'brad_page_settings',
	   'title'		=> 'Page Settings',
	   'pages'		=> array( 'page' , 'blog' , 'portfolio' ),
	   'context' => 'normal',
       'fields'	=> array(
	    array(
				'name'		=> 'Title Bar',
				'id'		=> $prefix . "titlebar",
				'type'		=> 'select',
				'options'	=> array(
					'breadcrumb'	=> 'Title & Breadcrumbs',
					'title'		    => 'Only Title',
					'no'			=> 'No Title Bar'
				),
				'multiple'	=> false,
				'std'		=> array( 'breadcrumb' )
		),
		
		 array(
				'name'		=> 'Default Title Bar Style',
				'id'		=> $prefix . "titlebar_style",
				'type'		=> 'select',
				'options'	=> array(
					'style1'			=> 'Classic Titlebar',
					'style2'			=> 'Modern Titlebar',
				),
				'multiple'	=> false,
				'std'		=> array( 'style1' )
		),
		
		
		array(
			'name'		=> 'Tilebar Font color scheme',
			'id'		=> $prefix . 'title_color_scheme',
			'clone'		=> false,
			'type'		=> 'select',
			'options'	=> array(
			        'scheme0'	  => 'Default',
					'scheme1'	  => 'White'
				),
				'multiple'	=> false
		),
		
	   
	   array(
			'name'		=> 'Titlebar Background Color',
			'id'		=> $prefix . 'titlebar_bg_color',
			'clone'		=> false,
			'type'		=> 'color',
		),	
		
	   array(
			'name'		=>  'Titlebar Background Image',
			'id'		=>  $prefix . 'bg_image_titlebar',
			'type'      =>  'image_advanced',
			'max_file_uploads' => 1
		),	
		
		
	
	   /*
	array( "name" => "Titlebar Background Image Style",
		   "id" => $prefix . "bg_pos_titlebar",
		   "clone" => false,
	       "type" => "select",
		   "options"=> array(
		                ''              => 'Default as selected in Admin panel',
		                'stretch'		=> 'Cover Background 100%',
						'repeat'		=> 'Repeat',
						'no-repeat'		=> 'No-Repeat',
						'repeat-x'		=> 'Repeat-X',
						'repeat-y'		=> 'Repeat-Y')
					 ),	
		*/
						
	   array(
			'name'		=> 'Enable Titlebar Background Overlay',
			'id'		=> $prefix . 'title_bg_overlay',
			'clone'		=> false,
			'type'		=> 'select',
			'options'	=> array(
			        'no'	=> 'No',
					'yes'   => 'Yes'
				),
				'multiple'	=> false
		),
		
		array(
			'name'		=> 'Titlebar Height (Modern Titlebar)',
			'id'		=> $prefix . 'title_height',
			'clone'		=> false,
			'type'		=> 'text',
			'desc'      => 'Only Work If you have selected modern titlebar . Do \'t include px only just numbers' ,
			'std'		=> '150'
		),			
		
	  array(
				'name'		=> 'Enable Parallax (Modern Titlebar) ',
				'id'		=> $prefix . "titlebar_parallax",
				'type'		=> 'select',
				'options'	=> array(
					'no'			=> 'No',
					'yes'			=> 'Yes',
				),
				'multiple'	=> false,
				'std'		=> array( 'no' )
		),
			  		  	
	   array(
			'name'		=> 'Title',
			'id'		=> $prefix . 'page_title',
			'clone'		=> false,
			'type'		=> 'text',
			'desc'      => 'If this field is empty then default page or post title will be used or just type "hide" to remove this fields in titlebar' ,
			'std'		=> ''
		),	
     
	 array(
			'name'		=> 'Additional Content',
			'id'		=> $prefix . 'add_content',
			'clone'		=> false,
			'type'		=> 'wysiwyg',
			'desc'      => 'Additional Content for Modern Titlebar . This will be placed after the title and breadcrumb in titlebar . You use any shortcode in this field' , 
			'std'		=> ''
		),		
		
	
	 array(
			'name'		=> 'Page Slider (Rev Slider)',
			'id'		=> $prefix . "rev_slider",
			'type'		=> 'select',
			'options'	=> $revsliders ,
			'multiple'	=> false
		)
	)
  );	
	   
	   
    foreach ( $meta_boxes as $meta_box )
    {
        new RW_Meta_Box( $meta_box );
    }
	
}

