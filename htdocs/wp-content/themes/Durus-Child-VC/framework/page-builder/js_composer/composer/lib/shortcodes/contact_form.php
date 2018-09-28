<?php

/* Testimonials
-----------------------------------------------*/
class WPBakeryShortCode_VC_Contact_Form extends WPBakeryShortCode {
	
 protected function content( $atts, $content = null , $helper = false) {
	 
	   static $formId = 1 ;
	   
	   extract( shortcode_atts( array(
	        'email'   => '' ,
            'message_height'    => '6',
            'fields'            => 'name,email,telephone,message',
            'required'          => 'name,email,message',
            'button_size'       => 'medium',
            'button_title'      => 'Send message' ,
			'half_width'        => '',
			'show_icons'        => 'no',
			'success_message'   => __("<strong>Success!</strong> Your Message Has been Sent","brad-framework"),
			'error_message'     => __("<strong>Error!</strong> An Error Occured While Sending your Message","brad-framework"),
			'style' => ''
			
        ), $atts ) );

		
        $message_height = preg_replace('/[^\d]/', '',  $message_height );
		//Explode the fields
        $required = explode( ',', $required );
		// Explode the Required Fields
        $fields =  explode( ',', $fields  );
		// Explode the Half Width Fields
        $hw_fields =  explode( ',', $half_width  );
        $clear_fields = array();
		
		//Set the field value for translation
		$field_values = array();
		$field_values['name'] = __('Your Name','brad');
		$field_values['country'] = __('Your Country','brad');
		$field_values['city'] = __('Your City','brad');
		$field_values['company'] = __('Your Company','brad');
		$field_values['message'] = __('Your Message','brad');
		$field_values['website'] = __('Your Website','brad');
		$field_values['telephone'] = __('Your Phone Number','brad');
		$field_values['email'] = __('Your Email','brad');
		

		//Set the Icons
		$field_icons = array();
		$field_icons['name'] = 'ss-air ss-user';
		$field_icons['country'] = 'ss-air ss-map';
		$field_icons['city'] = 'ss-air ss-location';
		$field_icons['company'] = 'ss-air ss-contacts';
		$field_icons['website'] = 'ss-air ss-link';
		$field_icons['telephone'] = 'ss-air ss-phone';
		$field_icons['email'] = 'ss-air ss-mail';
		
		$output = '' ;

		if( is_array($fields) && !empty($fields)):
		
        $output .=  '<form action="'.get_permalink(get_the_ID()).'" id="contactForm'.$formId.'"  class="contact-form field-icons-'.$show_icons.'">
		<input type="hidden" id="contact_form_email_nonce" name="contact_form_email_nonce" value="'.$email.'" />
		 <div class="alert alert-success hidden" id="contactSuccess'.$formId.'"><span class="close"><i class="icon-blandes-remove"></i></span>'.$success_message.'</div>
		 <div class="alert alert-error hidden" id="contactError'.$formId.'"><span class="close"><i class="icon-blandes-remove"></i></span>'.$error_message.'</div>
		 <div class="row-fluid">';
		foreach( $fields as $field){
			switch($field){
			case 'name' :
			case 'country' :
			case 'city' :
			case 'company' :
			case 'email' :
			case 'website' :
			case 'telephone' :
			$output .= '<div class="'. ( in_array ($field , $hw_fields ) ? "span6" : "span12" ) .'"><div class="control-wrap"><span class="icon"><i class="'.$field_icons[$field].'"></i></span><input type="text" maxlength="100" name="'.$field.'" id="'.$field.$formId.'" class="'.$field.' '. ( in_array ($field , $required ) ? "required" : "" ) .'" placeholder="'.$field_values[$field].'" /></div></div>';
			break;
			
			case 'message' :
			$output .= '<div class="span12"><div class="control-wrap"><textarea maxlength="5000" name="'.$field.'" id="'.$field.$formId.'" rows="' . esc_attr( $message_height ) . '" class="'. ( in_array( $field, $required ) ? "required" : "" ) .'" placeholder="'.$field_values[$field].'" ></textarea></div></div>';
			break;	
			}
		}
		
		$output .= '<div class="span12"><input type="submit" class="button button_'.$button_size.' button_'.$style.'" value="'.$button_title.'"></div></div></form>';
		
		endif;
		
	    return $output ;
		
		$formId++;


    }
	

}
