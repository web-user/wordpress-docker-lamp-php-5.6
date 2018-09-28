<?php

function vc_taxonomy_form_field($settings, $value) {
	$dependency = vc_generate_dependencies_attributes($settings);
	
		if ( !empty($settings['taxonomy']) ) {
           $terms = get_terms( $settings['taxonomy'] );
		}
		else
		{
		    $terms = '' ;
		 }
		 
    $return = '<input class="wpb_vc_param_value wpb-checkboxes" type="hidden" value="" name="'.$settings['param_name'].'" '.$dependency.'/>';
				$current_value = explode(",", $value);
				if( is_array($terms) && !empty($terms))
				{
			    foreach( $terms as $term ) {
				$checked = in_array($term->term_id , $current_value) ? ' checked="checked"' : '';	
				$return .= sprintf('<label><input id="%s-%s" value="%s" class="%s checkbox" type="checkbox" name="%s" %s> %s </label>' , $settings['param_name'] , $term->slug , $term->term_id  , $settings['param_name'] , $settings['param_name'] , $checked ,$term->name );
				}
			}
    return $return;
}