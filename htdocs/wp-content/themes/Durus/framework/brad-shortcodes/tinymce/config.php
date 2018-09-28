<?php
$brad_shortcodes = array();
$brad_shortcodes['shortcode-generator'] = array(
	'no_preview' => true,
	'params' => array(),
	'shortcode' => '',
	'popup_title' => ''
);

// Columns
$brad_shortcodes['columns'] = array(
	'params' => array(),
	'shortcode' => '[columns] {{child_shortcode}}[/columns] ',
	'no_preview' => true,
	
	
	// can be cloned and re-arrange
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __('Column Type', 'brad_framework'),
				'desc' => '',
				'options' => array(
					'one_half' => 'One Half',
					'one_third' => 'One Third',
					'one_fourth' => 'One Fourth',
					'one_fifth' => 'One Fifth',
					'one_sixth' => 'One Sixth',				
					'two_thirds' => 'Two Thirds',
					'three_fourths' => 'Three Fourths'
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Column Content', 'brad_framework'),
				'desc' => 'Be sure to add a [clear] shortcode between rows of columns.',
			)
		),
		'shortcode' => '[{{column}}]{{content}}[/{{column}}] ',
		'clone_button' => __('Add Another Column', 'brad_framework')
	)
);


$brad_shortcodes['video'] = array(
    'popup_title' => 'Embed Video',
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => __('Video Type', 'brad_framework'),
			'options' => array(
				'vimeo' => 'Vimeo',
				'youtube' => 'Youtube',
	    	),
		   'std' => 'vimeo',
		   'desc' => ''
		),
		
		'autoplay' => array(
			'type' => 'select',
			'label' => __('Autoplay', 'brad_framework'),
			'options' => array(
				'false' => 'False',
				'true' => 'True',
			),
			'std' => 'false',
			'desc' => ''
		),	
		
	 'id' => array(
			'type' => 'text',
			'label' => __('Video Id', 'brad_framework'),
			'std' => '',
			'desc' => ''
		)	
	),
		
	'shortcode' => '[video type="{{type}}" id="{{id}}" autoplay="{{autoplay}}"]',
);




// Pricing Table
$brad_shortcodes['pricing-table'] = array(
     'popup_title' =>  __('Pricing Table', 'brad_framework'),
	 'params' => array(		
	 'columns' => array(
			'type' => 'select',
			'label' => __('Pricing Table Columns ?', 'brad_framework'),
			'desc' => '',
			'options' => array(
				'3' => 'Three Columns',
				'4' => 'Four Columns '
				),
			'std' => '3'	)),
	'shortcode' => '[pricing_table columns="{{columns}}" ] {{child_shortcode}}[/pricing_table]',
	'no_preview' => true,
	
	// can be cloned and re-arranged
	'child_shortcode' => array(
		'params' => array(
		
	    'title' => array(
				'type' => 'text',
				'label' => __('Pricing Column Title', 'brad_framework'),
				'desc' => '',
				'std' => ''
			),
			
		'title-bgcolor' => array(
				'type' => 'colorpicker',
				'label' => __('Pricing Title Background Color', 'brad_framework'),
				'desc' => 'If this field is empty then default background color will be used',
				'std' => ''
			),	
			
		'title-textcolor' => array(
				'type' => 'colorpicker',
				'label' => __('Pricing Title Color', 'brad_framework'),
				'desc' => 'If this field is empty then default color will be used',
				'std' => ''
			),		
			
		'icon' => array(
				'type' => 'iconpicker',
				'label' => __('Pricing Column Title Icon', 'brad_framework'),
				'desc' => '',
				'std' => ''
			),	
			
		'price' => array(
				'type' => 'text',
				'label' => __('Pricing Amount', 'brad_framework'),
				'desc' => '',
				'std' => '10'
			),	
				
		'price-top-left' => array(
				'type' => 'text',
				'label' => __('Pricing Amount Top Left Text', 'brad_framework'),
				'desc' => '',
				'std' => '$'
			),	
			
			
		'price-bottom-right' => array(
				'type' => 'text',
				'label' => __('Pricing Amount Bottom Right Text', 'brad_framework'),
				'desc' => '',
				'std' => '/ Month'
			),	
			
		'price-subtext' => array(
				'type' => 'text',
				'label' => __('Pricing Description', 'brad_framework'),
				'desc' => __('A small Description about your price that will be shown at bottom of pricing columns','brad-framework'),
				'std' => ''
			),	
						
		'button-icon' => array(
				'type' => 'iconpicker',
				'label' => __('Pricing Button Icon ', 'brad_framework'),
				'desc' => '',
				'std' => ''
			),	
			
			
		'button-text' => array(
				'type' => 'text',
				'label' => __('Pricing Button Text', 'brad_framework'),
				'desc' => '',
				'std' => 'Sign Up'
			),
			
			
		'button-url' => array(
				'type' => 'text',
				'label' => __('Pricing Button Url', 'brad_framework'),
				'desc' => 'Do\'t Forget to include http:// ',
				'std' => ''
			)
			,		
			
		'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Pricing Features', 'brad_framework'),
				'desc' => __('Enter The  Pricing Features in "[pricing_feature]Feature 1[/pricing_feature] " format.', 'brad_framework'),
				'std' => '[pricing_feature]Feature 1[/pricing_feature][pricing_feature]Feature 2[/pricing_feature]'
			)	
		),
		'shortcode' => '[pricing_column   title="{{title}}" icon="{{icon}}"  title_bgcolor ="{{title-bgcolor}}" title_textcolor="{{title-textcolor}}"  price="{{price}}" price_top_left="{{price-top-left}}" price_bottom_right="{{price-bottom-right}}"  button_text="{{button-text}}" button_url = "{{button-url}}" price_subtext="{{price-subtext}}" button_icon="{{button-icon}}"]{{content}} [/pricing_column] ',
		'clone_button' => __('Add Another Pricing Column', 'brad_framework'),
	)
);





// Pricing Table
$brad_shortcodes['pricing-table'] = array(
     'popup_title' =>  __('Pricing Table', 'brad_framework'),
	 'params' => array(		
	 'columns' => array(
			'type' => 'select',
			'label' => __('Pricing Table Columns ?', 'brad_framework'),
			'desc' => '',
			'options' => array(
				'3' => 'Three Columns',
				'4' => 'Four Columns '
				),
			'std' => '3'	)),
	'shortcode' => '[pricing_table columns="{{columns}}" ] {{child_shortcode}}[/pricing_table]',
	'no_preview' => true,
	
	// can be cloned and re-arranged
	'child_shortcode' => array(
		'params' => array(
		
	    'title' => array(
				'type' => 'text',
				'label' => __('Pricing Column Title', 'brad_framework'),
				'desc' => '',
				'std' => ''
			),
			
		'title-bgcolor' => array(
				'type' => 'colorpicker',
				'label' => __('Pricing Title Background Color', 'brad_framework'),
				'desc' => 'If this field is empty then default background color will be used',
				'std' => ''
			),	
			
		'title-textcolor' => array(
				'type' => 'colorpicker',
				'label' => __('Pricing Title Color', 'brad_framework'),
				'desc' => 'If this field is empty then default color will be used',
				'std' => ''
			),		
			
		'icon' => array(
				'type' => 'iconpicker',
				'label' => __('Pricing Column Title Icon', 'brad_framework'),
				'desc' => '',
				'std' => ''
			),	
			
		'price' => array(
				'type' => 'text',
				'label' => __('Pricing Amount', 'brad_framework'),
				'desc' => '',
				'std' => '10'
			),	
				
		'price-top-left' => array(
				'type' => 'text',
				'label' => __('Pricing Amount Top Left Text', 'brad_framework'),
				'desc' => '',
				'std' => '$'
			),	
			
			
		'price-bottom-right' => array(
				'type' => 'text',
				'label' => __('Pricing Amount Bottom Right Text', 'brad_framework'),
				'desc' => '',
				'std' => '/ Month'
			),	
			
		'price-subtext' => array(
				'type' => 'text',
				'label' => __('Pricing Description', 'brad_framework'),
				'desc' => __('A small Description about your price that will be shown at bottom of pricing columns','brad-framework'),
				'std' => ''
			),	
						
		'button-icon' => array(
				'type' => 'iconpicker',
				'label' => __('Pricing Button Icon ', 'brad_framework'),
				'desc' => '',
				'std' => ''
			),	
			
			
		'button-text' => array(
				'type' => 'text',
				'label' => __('Pricing Button Text', 'brad_framework'),
				'desc' => '',
				'std' => 'Sign Up'
			),
			
			
		'button-url' => array(
				'type' => 'text',
				'label' => __('Pricing Button Url', 'brad_framework'),
				'desc' => 'Do\'t Forget to include http:// ',
				'std' => ''
			)
			,		
			
		'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Pricing Features', 'brad_framework'),
				'desc' => __('Enter The  Pricing Features in "[pricing_feature]Feature 1[/pricing_feature] " format.', 'brad_framework'),
				'std' => '[pricing_feature]Feature 1[/pricing_feature][pricing_feature]Feature 2[/pricing_feature]'
			)	
		),
		'shortcode' => '[pricing_column   title="{{title}}" icon="{{icon}}"  title_bgcolor ="{{title-bgcolor}}" title_textcolor="{{title-textcolor}}"  price="{{price}}" price_top_left="{{price-top-left}}" price_bottom_right="{{price-bottom-right}}"  button_text="{{button-text}}" button_url = "{{button-url}}" price_subtext="{{price-subtext}}" button_icon="{{button-icon}}"]{{content}} [/pricing_column] ',
		'clone_button' => __('Add Another Pricing Column', 'brad_framework'),
	)
);






// Pricing Table
$brad_shortcodes['compare-table'] = array(
     'popup_title' =>  __('Compare Table', 'brad_framework'),
	 'params' => array(		
	 'elements' => array(
			'type' => 'select',
			'label' => __('Compare Table Elements ?', 'brad_framework'),
			'desc' => 'Select the number of elements you want to compare ( Max 4 )',
			'options' => array( '1' => 'one' , '2' => 'Two' , '3' => 'Three' , '4' => 'Four' ),
			'std' => '3' ),
	
	 'title' => array(
				'type' => 'text',
				'label' => __('Compare Table Heading Title', 'brad_framework'),
				'desc' => '',
				'std' => ''
			),	
			
     'title-bg' => array(
				'type' => 'colorpicker',
				'label' => __('Heading Background Color', 'brad_framework'),
				'desc' => 'Leave blank for default',
				'std' => ''
			),	
			
	'title-color' => array(
				'type' => 'colorpicker',
				'label' => __('Heading Text Color', 'brad_framework'),
				'desc' => 'Leave blank for default',
				'std' => ''
			),			
						
	'e1-title' => array(
				'type' => 'text',
				'label' => __('First Element Title', 'brad_framework'),
				'desc' => '',
				'std' => ''
			),
			
	 'e1-icon' => array(
				'type' => 'iconpicker',
				'label' => __('First Element Icon', 'brad_framework'),
				'desc' => '',
				'std' => ''
			),	
			
	'e2-title' => array(
				'type' => 'text',
				'label' => __('Second Element Title', 'brad_framework'),
				'desc' => '',
				'std' => ''
			),
			
	 'e2-icon' => array(
				'type' => 'iconpicker',
				'label' => __('Second Element Icon', 'brad_framework'),
				'desc' => '',
				'std' => ''
			),				
				
	'e3-title' => array(
				'type' => 'text',
				'label' => __('Third Element Title', 'brad_framework'),
				'desc' => '',
				'std' => ''
			),
			
	 'e3-icon' => array(
				'type' => 'iconpicker',
				'label' => __('Third Element Icon', 'brad_framework'),
				'desc' => '',
				'std' => ''
			),	
			
	'e4-title' => array(
				'type' => 'text',
				'label' => __('Fourth Element Title', 'brad_framework'),
				'desc' => '',
				'std' => ''
			),
			
	 'e4-icon' => array(
				'type' => 'iconpicker',
				'label' => __('Fourth Element Icon', 'brad_framework'),
				'desc' => '',
				'std' => ''
			)	,
			
	
	 'e5-title' => array(
				'type' => 'text',
				'label' => __('Fifth Element Title', 'brad_framework'),
				'desc' => '',
				'std' => ''
			),
			
	 'e5-icon' => array(
				'type' => 'iconpicker',
				'label' => __('Fifth Element Icon', 'brad_framework'),
				'desc' => '',
				'std' => ''
			)	,		
			
	'c-sign' => array(
			'type' => 'select',
			'label' => __('Correct Sign ?', 'brad_framework'),
			'desc' => 'This sign will be shown if the feaature is included in current element',
			'options' => array( 'correct' => 'Correct Sign' , 'dot' => 'Dot Sign' , 'correct-with-circle' => 'correct Sign with Circle'),
			'std' => 'dot' ) ,
			
	'i-sign' => array(
			'type' => 'select',
			'label' => __('InCorrect Sign ?', 'brad_framework'),
			'desc' => 'This sign will be shown if the feaature is not included in current element',
			'options' => array( 'none' => 'empty ( Nothing )' , 'hash' => 'Hash sign' , 'remove' => 'Remove Sign' , 'remove-with-circle' => 'Remove sign with Circle'),
			'std' => 'none' )	,
			
	'sign-color' => array(
				'type' => 'colorpicker',
				'label' => __('signs Color', 'brad_framework'),
				'desc' => 'Leave blank for default',
				'std' => ''
			),																						
	),
	'shortcode' => '[compare_table element="{{elements}}" title="{{title}}" e1_icon="{{e1-icon}}" e1_title="{{e1-title}}" e2_icon="{{e2-icon}}" e2_title="{{e2-title}}" e3_icon="{{e3-icon}}" e3_title="{{e3-title}}" e4_icon="{{e4-icon}}" e4_title="{{e4-title}}" e5_icon="{{e5-icon}}" e5_title="{{e5-title}}" c_sign="{{c-sign}}" i_sign="{{i-sign}}" title_bg="{{title-bg}}" title_color="{{title-color}}" sign-color="{{sign-color}}"] {{child_shortcode}}[/compare_table]',
	'no_preview' => true,
	
	// can be cloned and re-arranged
	'child_shortcode' => array(
		'params' => array(
		
	    'title' => array(
				'type' => 'text',
				'label' => __('Feature Title', 'brad_framework'),
				'desc' => '',
				'std' => ''
			),
		
		'e1-included' => array(
		        'type' => 'select',
			    'options' => array( 'yes' => 'yes' , 'no' => 'no'),
			    'std' => 'yes' ,
				'desc' => __('Is the current feature in included in element 1 ( If yes then this will show correct Sign otherwise incorrect Sign)','brad-framework'),
				'label' => __('Featured in Element 1','brad-framework')
				),
		
		'e2-included' => array(
		        'type' => 'select',
			    'options' => array( 'yes' => 'yes' , 'no' => 'no'),
			    'std' => 'no' ,
				'desc' => '',
				'label' => __('Featured in Element 2','brad-framework')
				),
				
		'e3-included' => array(
		        'type' => 'select',
			    'options' => array( 'yes' => 'yes' , 'no' => 'no'),
			    'std' => 'no' ,
				'desc' => '',
				'label' => __('Featured in Element 3','brad-framework')
				),
				
		'e4-included' => array(
		        'type' => 'select',
			    'options' => array( 'yes' => 'yes' , 'no' => 'no'),
			    'std' => 'no' ,
				'desc' => '',
				'label' => __('Featured in Element 4','brad-framework')
				),
				
		'e5-included' => array(
		        'type' => 'select',
			    'options' => array( 'yes' => 'yes' , 'no' => 'no'),
			    'std' => 'no' ,
				'desc' => '',
				'label' => __('Featured in Element 5','brad-framework')
				),									
		
		),
		'shortcode' => '[compare_feature   title="{{title}}" e1_included="{{e1-included}}"  e2_included="{{e2-included}}"  e3_included="{{e3-included}}"  e4_included="{{e4-included}}"  e5_included="{{e5-included}}"] ',
		'clone_button' => __('Add Another Feature', 'brad_framework'),
	)
);




// Drop Cap
$brad_shortcodes['dropcap'] = array(
        'popup_title' => 'Dropcap',
        'params' => array(
          'style' => array(
				'std' => '',
				'type' => 'select',
				'label' => __('Drop Cap Container Style', 'brad_framework'),
				'desc' => '',
				'options'=>array(
				  ''   => ' No container' ,
				  'style1' => 'Box Container',
				  'style2' => 'Rounded Container',
				  'style3' => 'With Stroke',
				  'style4' => 'With Stroke Rounded')
			),
			
		'color' => array(
				'std' => '',
				'type' => 'select',
				'label' => __('Drop Cap Container Background or Border Color', 'brad_framework'),
				'desc' => '',
				'options' => array(
				             '' => 'Default' ,
				      'primary' => 'Primary Color'
				   )
			),	
			
		'content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Dropcap Content', 'brad_framework'),
			'desc' => __('Enter the text for this button.', 'brad_framework')
	)

     ),
'shortcode' => '[dropcap style="{{style}}" color="{{color}}"]{{content}}[/dropcap]',
);



// Drop Cap
$brad_shortcodes['gap'] = array(
        'popup_title' => 'Gap',
        'params' => array(
		'height' => array(
			'std' => '20',
			'type' => 'text',
			'label' => __('Gap Height', 'brad_framework'),
			'desc' => __('Enter the Gap Height in pixel <b>Note:</b> Do\'t include "px" only numbers', 'brad_framework')
	)

     ),
'shortcode' => '[gap height="{{height}}"]',
);



// Checklist

$brad_shortcodes['checklist'] = array(
     "popup_title" => __("Checklist", "brad-framework"),
	 'params' => array(
	  'style' => array(
		 'std' => 'style1' ,
		 'type' => 'select' ,
		 'label' => __("Style","brad-framework"),
		 'desc' => '',
		 'options' => array(
		     'style1' => 'Style 1' , 
		     'style2' => 'Style 2' ,
			 'style3' => 'Style 3' ,
			 'style4' => 'Style 4'
			 )
		  ) ,
	  'icon' => array(
			'std' => '',
			'type' => 'iconpicker',
			'label' => __('List Icon', 'brad_framework') ,
			'desc' => ''
		)		  
		 ),
	'shortcode' => '[checklist style="{{style}}" icon="{{icon}}" ] {{child_shortcode}}[/checklist] ',
	'no_preview' => true,
	
	
	// can be cloned and re-arrange
	'child_shortcode' => array(
		'params' => array(
			'content' => array(
				'std' => 'Your Content here',
				'type' => 'textarea',
				'desc' => '' ,
				'label' => __('List Item Content', 'brad_framework')
			) 
		
		),
		
		'shortcode' => '[item] {{content}} [/item] ',
		'clone_button' => __('Add Another List Item', 'brad_framework')
	)
);



//Icon list
$brad_shortcodes['iconlist'] = array(
     "popup_title" => __("Iconlist", "brad-framework"),
	 'params' => array(
	  'size' => array(
		 'std' => 'default' ,
		 'type' => 'select' ,
		 'label' => __("Icon Size","brad-framework"),
		 'desc' => '',
		 'options' => array(
		     'small' => 'small' , 
		     'medium' => 'medium' ,
			 'large' => 'large' 
			 )
		  )
		) ,
	 'shortcode' => '[iconlist size="{{size}}"]{{child_shortcode}}[/iconlist] ',
	 'no_preview' => true,
	
	
	// can be cloned and re-arrange
	'child_shortcode' => array(
		'params' => array(
		  'content' => array(
				'std' => 'Your Content here',
				'type' => 'textarea',
				'desc' => '' ,
				'label' => __('List Item Content', 'brad_framework')
			) 
			,
		  'icon' => array(
			'std' => '',
			'type' => 'iconpicker',
			'label' => __('Icon', 'brad_framework'),
			"iconType" => "all" ,
			'desc' => ''
		   )	
		),
		
		'shortcode' => '[listitem icon="{{icon}}"] {{content}} [/listitem] ',
		'clone_button' => __('Add Another List Item', 'brad_framework')
	)
);



//Icon
$brad_shortcodes['icon'] = array(
    'popup_title' => '' ,
	'params' => array( 	
	  
	 'size' => array(
			'type' => 'select',
			'label' => __('Icon Size', 'brad_framework'),
			'desc' => __('Select the Icon size.', 'brad_framework'),
			'std' => array('small') ,
			'options' => array(
		        'small'=>'Small',
				'normal'=>'Normal',
				'medium' => 'Medium',
				'large' => 'Large' ,
				'ex-large'=>'Extra Large')
		),	
			   
	'align' => array(
			'type' => 'select',
			'std' => '' ,
			'label' => __('Align', 'brad_framework'),
			'desc' => '',
			'options' => array(
			        '' => 'Justify',
			  'center' => 'Center' )
		),
		
   'style' => array(
			'type' => 'select',
			'std' => '' ,
			'label' => __('Style', 'brad_framework'),
			'desc' => '',
			'options' => array(
				'style1' => 'Style 1',
				'style2' => 'Style 2' ,
				'style3' => 'Style 3')
		),
		
	'color' => array(
	       'type' => 'colorpicker',
		   'std' => '',
		   'label' => __('icon Color','js_composer'),
		   'desc' => __('Leave Blank for Default','brad-framework') ,
		   ),
		   
    'color-hover' => array(
	       'type' => 'colorpicker',
		   'std' => '',
		   'label' => __('icon Color on hover','js_composer'),
		   'desc' => __('Leave Blank for Default','brad-framework') ,
		   ),
		   	
	 'border-color' => array(
			'type' => 'colorpicker',
			'std' => '' ,
			'label' => __('Icon Boder Color ', 'brad_framework'),
			'desc' => 'Leave blank for Default <strong>Note:</strong> This option work only for icons style2'
		),	
		
	'border-opacity' => array(
			'type' => 'text',
			'std' => '1' ,
			'label' => __('Icon Border Color opacity', 'brad_framework'),
			'desc' => 'Leave blank for Default <strong>Note:</strong> This option work only for icons style2'
		),				
		
					   	
	'bg-color' => array(
			'type' => 'colorpicker',
			'std' => '' ,
			'label' => __('Icon Background Color', 'brad_framework'),
			'desc' => 'Leave blank for Default <strong>Note:</strong> This option work only for icons style3'
		),	
		
	'bg-opacity' => array(
			'type' => 'text',
			'std' => '1' ,
			'label' => __('Icon Background Color opacity ', 'brad_framework'),
			'desc' => 'Leave blank for Default <strong>Note:</strong> This option work only for icons style3'
		),	
		
   
	  'bg-color-hover' => array(
			'type' => 'colorpicker',
			'std' => '' ,
			'label' => __('Icon Background Color on Hover', 'brad_framework'),
			'desc' => 'Leave blank for Default <strong>Note:</strong> This option work only for icons style2 and Icon Style 3'
		),	
		
	'bg-opacity-hover' => array(
			'type' => 'text',
			'std' => '1' ,
			'label' => __('Icon Background Color opacity on hover', 'brad_framework'),
			'desc' => 'Leave blank for Default'
		),	
				
	'enable-crease' => array(
	       'type' => 'checkbox',
		   'checkbox_text' => 'yes',
		   'std' => '',
		   'label' => __('Enable Crease Background ? ' , 'brad-framework'),
		   'desc' => ' Check this if you want to enable a crease backgound for icon style 2 or icon style3 ')
		   ,
		
	
	  'icon' => array(
			'std' => '',
			'type' => 'iconpicker',
			'label' => __('Icon', 'brad_framework'),
			'desc' => ''
		)
		
	 ) ,
		
	'shortcode' => '[icon icon="{{icon}}" size="{{size}}" align="{{align}}" style="{{style}}" color="{{color}}" color_hover="{{color-hover}}" bg_color="{{bg-color}}" bg_opacity="{{bg-opacity}}" bg_opacity_hover="{{bg-opacity-hover}}" bg_color_hover="{{bg-color-hover}}" border_color="{{border-color}}" border_opacity="{{border-opacity}}" enable_crease="{{enable-crease}}"]',
);


/* Separator (Divider)
---------------------------------------------------------- */
$brad_shortcodes['separator'] = array(
   "popup_title" => __("Separator", "brad-framework"),
   "params" => array(
   "type" => array(
            "type" => "select",
            "label" => __( "Border Type" ,"brad-framework"),
			"desc" => "" ,
			"std" => "" ,
	        "options" => array( "large" => "100% Border" , "medium" => "Medium Border" , "small" => "Small Border" , "tiny" => "Extra Small Border" )
	       ),
		   
   "style" => array(
          "type" => "select",
		  "desc" => "" ,
		  "std" => "" ,
          "label" => __( "Border Style" ,"brad-framework"),
	      "options" => array( "normal" => "Normal Border"  , "double" => "Thick Border"  )
	),
	
  "align" => array(
      "type" => "select",
	  "desc" => "" ,
	  "std" => "" ,
      "label" => __('Separator Align', 'brad-framework'),
	  "options" => array(
		"left" => __("Align Left", 'brad-framework')  ,
		"center" => __("Align Center", 'brad-framework') ,
		"right" => __("Align Right", 'brad-framework')  ,
		 )
	),
	
  "margin-top" => array(
      "type" => "text",
      "label" => __("Margin Top","brad-framework"),
	  "std" =>  '5' ,
	  "desc" => __('Default Top Margin in "px"','brad-framework')
	),
	
  "margin-bottom"  =>	array(
      "type" => "text",
      "label" => __("Margin Bottom","brad-framework"),
	  "std" =>  '25' ,
	  "desc" => __('Default Bottom Margin in "px"','brad-framework')
	)
  ),
 'shortcode' => '[separator type="{{type}}" style="{{style}}" align="{{align}}"margin-bottom="{{margin-bottom}}" margin_top="{{margin-top}}"]'
 );  	
  


/* Special Title
-----------------------------------------------------------*/

$brad_shortcodes['heading'] = array(
  "popup_title" => __("label", "brad-framework"),
  "params" => array( 
    "title" => array(
      "type" => "text",
      "label" => __("Title","brad-framework"),
	  "std" =>  'Your Title Here' ,
	  "desc" => ""
	),
	
   "type" => array(
      "type" => "select",
      "label" => __( "Heading Type" ,"brad-framework"),
	  "options" => array(
	    "h1" => "heading 1" ,
		"h2" => "heading 2" ,
		"h3" => "heading 3" ,
		"h4" => "heading 4" ,
		"h5" => "heading 5" ,
		"h6" => "heading 6" ,
		 ),
	  "std" => "h1" ,
	  "desc" => ""	 
		 
	),
	
  "style" => array(
      "type" => "select",
      "label" => __( "Heading Style" ,"brad-framework"),
	  "options" => array(
	    "" => "No Style"  ,
	    "style1" => "Style 1" ,
		"style2" => "Style 2" ,
		"style3" => "Style 3" ),
	  "desc" => "",
	  "std" => ""	 
	),
	
  "text-transform" => array (
      "type" => "select",
	  "desc" => "",
	  "std" => "default",
      "label" => __( "Text Transform" ,"brad-framework"),
	  "options" => array(
	    "default" => "Default",
		"uppercase" => "Uppercase"  ,
		"lowercase" => "lowercase" )
	),
	 
	"align" =>  array(
      "type" => "select",
      "label" => __('Heading Align', 'brad-framework'),
	  "options" => array(
		"left" =>  __("Align Left", 'brad-framework'),
	  	"center" => __("Align Center", 'brad-framework') ,
		"right" => __("Align Right", 'brad-framework'),
		 ),
	 "desc" => "",
	 "std" => "left"	 
	),
   
	"margin-bottom" => array(
      "type" => "text",
      "label" => __("Margin Bottom","brad-framework"),
	  "std" =>  '20' ,
	  "desc" => __("Default Margin From Bottom in px","brad-framework")
	)	
  ),
  "shortcode" => '[heading title="{{title}}" type="{{type}}" style="{{style}}" text_transform="{{text-transform}}" align="{{align}}" margin_bottom="{{margin-bottom}}"]' 
);
 
  
//highlighted
$brad_shortcodes['highlighted'] = array(
    'popup_title' => __('Highlighted Text' , 'brad-framework'),
	'params' => array( 	
	"style" => array(
      "type" => "select",
      "label" => __( "Heading Style" ,"brad-framework"),
	  "options" => array(
	    "style1" => "Style 1" ,
		"style2" => "Style 2") ,
	  "desc" => "",
	  "std" => ""	 
	),
   'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __('Highlighted Content', 'brad_framework'),
			'desc' => ''
	)) ,
	
	'shortcode' => '[highlighted style="{{style}}"]{{content}}[/highlighted]',
	'no_preview' => true
);


//tooltip
$brad_shortcodes['tooltip'] = array(
    'popup_title' => 'Tooltip' ,
	'params' => array( 	
	'text' => array(
			'std' => '',
			'type' => 'text',
			'desc' => '',
			'label' => __('Tooltip Text', 'brad_framework'),
	),	
	
	'align' => array(
			'std' => '',
			'type' => 'select',
			'options' => array(
			    "top" => "Top" ,
				"bottom" => "Bottom" ,
				"left" => "Left" ,
				"right" => "Right" ),
			'desc' => '',
			'label' => __('Tooltip Text', 'brad_framework'),
	),	
	
   'content' => array(
			'std' => '',
			'type' => 'text',
			'desc' => '' ,
			'label' => __('Tooltip Content', 'brad_framework'),
	)) ,
	
	'shortcode' => '[tooltip text="{{text}}" align="{{align}}"]{{content}}[/tooltip]',
	'no_preview' => true
);




//social icons
$brad_shortcodes['social'] = array(
    'popup_title' => 'Social Icons' ,
    'params' => array(
			'size' => array(
				'std' => '',
				'type' => 'select',
				'label' => __('Social Icons size', 'brad_framework'),
			    'desc' => __('Select the icon size', 'brad_framework'),
				'options' =>  array(
				     '' => __('Normal', 'brad_framework') ,
					 'above-normal' => __('Above Normal', 'brad_framework') 
			         )
				) 
				,
				
		  "icon-c" => array(
             "type" => "colorpicker",
             "label" => __("Icon Color", "brad-framework"),
			 "desc" => __("Leave Blank for default","brad-framework"),
             "std" => '' ,
             ),
			 
		  "icon-bc" => array(
             "type" => "colorpicker",
             "label" => __("Icon Border Color", "brad-framework"),
			 "desc" => __("Leave Blank for default","brad-framework"),
             "std" => '' ,
             ),
			 
		   "icon-bgc" => array(
             "type" => "colorpicker",
             "label" => __("Icon Background Color", "brad-framework"),
			 "desc" => __("Leave Blank for default","brad-framework"),
             "std" => '' ,
             ),
			 
			"icon-c-hover" => array(
             "type" => "colorpicker",
             "label" => __("Icon Color:hover", "brad-framework"),
			 "desc" => __("Leave Blank for default","brad-framework"),
             "std" => '' ,
             ),
			 
		  "icon-bc-hover" => array(
             "type" => "colorpicker",
             "label" => __("Icon Border Color:hover", "brad-framework"),
			 "desc" => __("Leave Blank for default","brad-framework"),
             "std" => '' ,
             ),
			 
		   "icon-bgc-hover" => array(
             "type" => "colorpicker",
             "label" => __("Icon Background Color:hover", "brad-framework"),
			 "desc" => __("Leave Blank for default","brad-framework"),
             "std" => '' ,
             ) 
			 	
			) ,
	'shortcode' => '[social size="{{size}}" icon_c="{{icon-c}}" icon_bc="{{icon-bc}}" icon_bgc="{{icon-bgc}}" icon_c_hover="{{icon-c-hover}}" icon_bc_hover="{{icon-bc-hover}}" icon_bgc_hover="{{icon-bgc-hover}}"]{{child_shortcode}}[/social] ',
	'no_preview' => true,
	// can be cloned and re-arrange
   'child_shortcode' => array(
		'params' => array(
			'url' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Social Link', 'brad_framework')	,
				'desc' => ''
			) ,
			
	      'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Social Icon title ', 'brad_framework')	,
				'desc' => ' Social icon title for ex: follow me on Twitter'
			) ,			
				
   	     'icon' => array(
			 'std' => '',
			 'type' => 'iconpicker',
			 'iconType' => 'social' ,
			 'label' => __('Social Icon', 'brad_framework'),
			 'desc' => ''
	       ),	
		
		 'target' => array(
			'type' => 'select',
			'label' => __('Social Link Target', 'brad_framework'),
			'desc' => __('Select where the Link should open.', 'brad_framework'),
			'options' => array(
				'_self' => '_self',
				'_parent' => '_parent',
				'_blank' => '_blank',
				'_top' => '_top',
			))	
		),
		'shortcode' => '[social_icon url="{{url}}" title="{{title}}"  icon="{{icon}}" target="{{target}}"]',
		'clone_button' => __('Add Another Social Icon', 'brad_framework')
	)
	
);


//Button
$brad_shortcodes['button'] = array(
    'popup_title' => 'Button' ,
    'params' => array(
        "style" => array(
            "type" => "select",
            "label" => __("Style", "brad-framework"),
            "options" =>  array("" => __("Default", "brad-framework")  , "readmore" => __('Read More Button','brad-framework'), "grey" => __("Grey Button", "brad-framework") , "green" =>  __("Green Button", "brad-framework"), "seagreen" => __("Sea Green Button", "brad-framework") , "orange" => __("Orange Button", "brad-framework"), "red" =>  __("Red Button", "brad-framework") , "white" => __("White Button", "brad-framework") , "black" =>  __("Black Button", "brad-framework") , "purple" => __("Purple Button", "brad-framework") , "yellow" =>  __("Yellow Button", "brad-framework")  , "alternate" => __('Alternate Button','brad-framework') , "alternate-white" =>  __('Alternate Transparent Button','brad-framework')  ) ,
			"std" => '' ,
            "desc" => __("Select the default style for your button.", "brad-framework")
            ),
        "align" => array(
	        "type" => "select",
	        "label" => __("Align","brad-framework"),
	        "options" => array(
	               "none" => __("None","brad-framework") ,
	               "left" => __("Align Left","brad-framework"),
				   "right" => __("Align Right","brad-framework") ,
				   "center" => __("Align Center","brad-framework")
				  ),
			 "desc" => "",
			 "std" => "none"
			),
        "title" => array(
            "type" => "text",
            "label" => __("Text on the button", "brad-framework"),
            "std" => __("Text on the button", "brad-framework"),
            "desc" => __("Text on the button.", "brad-framework")
         ),
        "href" => array(
            "type" => "text",
            "label" => __("URL (Link)", "brad-framework"),
			"std" => "" ,
            "desc" => __("Enter the Button link. Do't forget to include http:// ", "brad-framework")
        ),
        "target" => array(
             "type" => "select",
             "label" => __("Target", "brad-framework"),
			 "std" => "",
			 "desc" => "",
             "options" => array("_self" => __("Same window", "brad-framework"), "_blank" => __("New window", "brad-framework"))
        ),
        "icon" => array(
             "type" => "iconpicker",
             "label" => __("Icon", "brad-framework"),
             "std" => "" ,
	         "desc" => __("Select the icon for your Button. Click an icon to select it and again click the same icon to deselecct it", "brad-framework")
        ),
        "icon-align" => array(
	         "type" => "select",
	         "label" => __("Icon Align","brad-framework"),
	         "options" => array(
	              "left" => __("Align Left","brad-framework"),
				  "right" => __("Align Right","brad-framework"),
				  ),
			"std" => "",
			"desc" => ""	  
             ),
         "icon-style" => array(
	         "type" => "select",
	         "label" => __("Icon Style","brad-framework"),
	         "options" => array(
	              "" => __("Default","brad-framework"),
				  "style2" => __("With Border","brad-framework"),
				  "style3" => __("With Dark Background",'brad-framework')
				  ),
			 "desc" => __("Only Work for read more button","brad-framework"),
			 "std" => ""	  
	           ),  
			   
		 "icon-size" => array(
	         "type" => "select",
	         "label" => __("Icon Size","brad-framework"),
	         "options" => array(
	              "" => __("Normal","brad-framework"),
				  "medium" => __("Medium","brad-framework")
				  ),
			 "desc" => __("Only Work for read more button","brad-framework"),
			 "std" => ""	  
	           ),  
			   
			   	   
          "icon-c" => array(
             "type" => "colorpicker",
             "label" => __("Icon Color", "brad-framework"),
	         "desc" => __("Leave Blank for default color ( Work only for readmore button)","brad-framework"),
             "std" => '' ,
             ),  
         "icon-bc" => array(
             "type" => "colorpicker",
             "label" => __("Icon Border Color", "brad-framework"),
	         "desc" => __("Leave Blank for default border color ( Only work for readmore button )","brad-framework"),
             "std" => ''
        ),	  
         "icon-bgc" => array(
             "type" => "colorpicker",
             "label" => __("Icon Background Color", "brad-framework"),
	         "desc" => __("Leave Blank for default background color ( Only work for readmore button )","brad-framework"),
             "std" => ''
         ),	  
		  "icon-bgc-hover" => array(
             "type" => "colorpicker",
             "label" => __("Icon Background Color : hover", "brad-framework"),
	         "desc" => __("Leave Blank for default background color on hover ( Only work for readmore button )","brad-framework"),
             "std" => ''
         ),	  
          "size" => array(
             "type" => "select",
             "label" => __("Size", "brad-framework"),
             "options" => array("normal" => "Normal" , "large" => "Large" , "small" => "Small"),
             "desc" => __("Select the Button size.", "brad-framework"),
			 "std" => "normal"
        )
	  ),
	  "shortcode" => '[button style="{{style}}" align="{{align}}" href="{{href}}" title="{{title}}" target="{{target}}" icon="{{icon}}" icon_align="{{icon-align}}" icon_size="{{icon-size}}" icon_style="{{icon-style}}" icon_c="{{icon-c}}" icon_bc="{{icon-bc}}" icon_bgc="{{icon-bgc}}" icon_bgc_hover="{{icon-bgc-hover}}" size="{{size}}"]' ,
	  'no_preview' => true
);


//Button
$brad_shortcodes['image'] = array(
    'popup_title' => 'Single Image' ,
    'params' => array(
	"image" => array(
      "type" => "uploader",
      "label" => __("Image", "brad-framework"),
      "std" => "",
      "desc" => __("Select image from media library.", "brad-framework")
    ),
	
    "css_animation" => array(
      "type" => "select",
      "label" => __("CSS Animation", "brad-framework"),
      "param_name" => "css_animation",
      "options" => array("" => __("No", "brad-framework"),  "fadeInLeft" => __("Left to Right", "brad-framework"), "fadeInRight" =>  __("Right to Left", "brad-framework") , "fadeInTop" =>  __("Bottom to top", "brad-framework"), "fadeInBottom" => __("Top to Bottom", "brad-framework") , "fadeInLeftBig" => __("Left to Right Big", "brad-framework") , "fadeInRightBig" => __("Right to Big big", "brad-framework") , "fadeInTopBig" => __("Bottom to Top Big", "brad-framework"),  "fadeInBottomBig" => __("Top to Bottom Big", "brad-framework")  ,"appearFromCenter" =>  __("Appear from center", "brad-framework")  , "fadeIn" => __("Fade In", "brad-framework") ),
     "desc" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "brad-framework"),
	 "std" => "" 
	 ),
	"css_animation_delay" => array(
       "type" => "select",
       "label" => __("CSS Animation Delay", "brad-framework"),
       "options" => array( "" => __("No Delay", "brad-framework"), '100' => '100' , '200' => '200', '300' => '300' , '400' => '400' , '500' => '500' ,'600' => '600' , '700' => '700' , '800' => '800'),
	   "std" => "",
	   "desc" => ""
     ),
    "img_size" => array(
      "type" => "select",
      "label" => __("Image size", "brad-framework"),
	  "options" => Array( 
	         ""  => "default" ,
		 "large" => "large" ,
		 "medium" => "medium" ,
		 "long" => "long" ,
		 "wide" => "wide",
		 "full" => "full" ,
		 "thumbnail" => "thumbnail" ,
		 "mini" => "mini" ,	 	 
		 "custom" => "custom" ),
	  "desc" => ""	,
	  "std" => "" 
		 ),
		 
	"custom_img_size" => array(
	  "type" => "text",
	  "label" => __("Custom Image size", "brad-framework"), 
      "desc" => __("Enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size. This will not work unless you select the image size to custom", "brad-framework"),
	  "std" => ""
    ),
	
	 "img_lightbox" => array(
      "type" => 'checkbox',
	  "checkbox_text" => "Yes" ,
      "label" => __("Enable Lightbox Link Icon?", "brad-framework"),
      "desc" => __("If selected there will be  show lightbox Icon on the top of image.", "brad-framework"),
      "std" => false
    ),
	
	 "icon_lightbox" => array(
      "type" => 'iconpicker',
      "label" => __("Lightbox Icon?", "brad-framework"),
      "std" => '118|ss-air' ,
	  "desc" => "You must have Enalbed the light box icon above."
    ),
	
    "img_link_large" => array(
      "type" => 'checkbox',
      "label" => __("Lightbox Link to large image?", "brad-framework"),
      "desc" => __("If selected, image will be linked to the bigger image through lightbox. <b>Note:</b>You must have Enalbed the light box icon above.", "brad-framework"),
	  "checkbox_text" => "Yes" ,
      "std" => false ,
    ),
     "img_link" => array(
      "type" => "text",
	  "std" => "",
      "label" => __("Custom Image link for Lightbox", "brad-framework"),
      "desc" => __("Enter url if you want this image to have link. You can also enter youtube or vimeo video link . Video will be shown in lightbox.<b>Note:</b>You must have Enalbed the light box icon above.", "brad-framework"),
     
    )
  ),
  'shortcode' => '[image image="{{image}}" css_animation="{{css_animation}}" css_animation_delay="{{css_animation_delay}}" img_size="{{img_size}}" custom_img_size="{{custom_img_size}}" img_lightbox="{{img_lightbox}}" icon_lightbox="{{icon_lightbox}}" img_link_large="{{img_link_large}}" img_link="{{img_link}}"  ]'
  );
 