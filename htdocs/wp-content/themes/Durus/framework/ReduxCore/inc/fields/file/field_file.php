<?php



    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

class ReduxFramework_file {

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since Redux_Options 1.0.0
    */
    function __construct($field = array(), $value ='', $parent = '') {
		$this->parent = $parent;
        $this->field = $field;
		$this->value = $value;
		$this->args = $parent->args;
		
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since Redux_Options 1.0.0
    */
    function render() {
		
		 // No errors please
         $defaults = array(
                    'id'        => '',
                    'css-url'       => '',
					'css-file'       => '',
                    'prefix'     => '',
                    'name'    => ''
                );

          $this->value = wp_parse_args( $this->value, $defaults );
		
		 echo '<input type="hidden" class="icon-css-file" name="' . $this->field['name'] . '[css-file]' . $this->field['name_suffix'] . '" id="' . $this->parent->args['opt_name'] . '[' . $this->field['id'] . '][css-file]" value="' . $this->value['css-file'] . '" />';
		 
		 echo '<input type="hidden" class="icon-css-url" name="' . $this->field['name'] . '[css-url]' . $this->field['name_suffix'] . '" id="' . $this->parent->args['opt_name'] . '[' . $this->field['id'] . '][css-url]" value="' . $this->value['css-url'] . '" />';
		 
		 echo '<input type="hidden" class="icon-prefix" name="' . $this->field['name'] . '[prefix]' . $this->field['name_suffix'] . '" id="' . $this->parent->args['opt_name'] . '[' . $this->field['id'] . '][prefix]" value="' . $this->value['prefix'] . '" />';
		 
		 echo '<input type="hidden" class="icon-name" name="' . $this->field['name'] . '[name]' . $this->field['name_suffix'] . '" id="' . $this->parent->args['opt_name'] . '[' . $this->field['id'] . '][name]" value="' . $this->value['name'] . '" />';
		 
		 
		 
		 echo '<div class="icon-font-container">';
		 if(!empty($this->value['name']) ){
			echo 'Font Uploaded: '.$this->value['name'];
		 }
		 echo '</div>';
   
         //Upload controls DIV
         echo '<div class="upload_button_div">';
		 
         //If the user has WP3.5+ show upload/remove button
         echo '<span class="button icon_font_upload_button" id="' . $this->field['id'] . '-media">' . __( 'Upload', 'redux-framework' ) . '</span>';
		 
		 $hide = '';
		 if ( empty( $this->value['name'] ) || $this->value['name'] == '' ) {
                    $hide = ' hide';
          }

          echo '<span class="button remove-font remove-image' . $hide . '" id="reset_' . $this->field['id'] . '" rel="' . $this->field['id'] . '">' . __( 'Remove', 'redux-framework' ) . '</span>';
		  
		  echo '<span class="icon_font_uploading"><img src="'.ReduxFramework::$_url.'assets/img/ajax.gif" /></span>';
		 
		 echo '</div>';
    }

    /**
     * Enqueue Function.
     *
     * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
     *
     * @since Redux_Options 1.0.0
    */
    function enqueue() {
		 
		 wp_enqueue_style(
                'field-file-upload', 
                ReduxFramework::$_url . 'inc/fields/file/file_upload.css', 
                false,
                null,
                ''
            );
   
         wp_enqueue_script(
                'field-file-upload-js', 
                ReduxFramework::$_url . 'inc/fields/file/file_upload.js', 
                array('jquery'),
                time(),
                true
            );
			
	 wp_localize_script('field-file-upload-js', 'redux_file_upload' , array( "nonce" => wp_create_nonce( 'redux_file_upload_nonce') , 'ajaxurl' => admin_url( 'admin-ajax.php' )));
	 
    }
}
