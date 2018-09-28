<?php

// load wordpress
require_once('get_wp.php');

class brad_shortcodes
{
	var	$conf;
	var	$popup;
	var	$params;
	var	$shortcode;
	var $cparams;
	var $cshortcode;
	var $popup_title;
	var $no_preview;
	var $has_child;
	var	$output;
	var	$errors;

	// --------------------------------------------------------------------------

	function __construct( $popup )
	{
		if( file_exists( dirname(__FILE__) . '/config.php' ) )
		{
			$this->conf = dirname(__FILE__) . '/config.php';
			$this->popup = $popup;

			$this->formate_shortcode();
		}
		else
		{
			$this->append_error('Config file does not exist');
		}
	}

	// --------------------------------------------------------------------------

	function formate_shortcode()
	{
		global $ss_air , $ss_social, $fa_icons, $brad_data , $uploaded_icons  ;
		// get config file
		require_once( $this->conf );

		unset($brad_shortcodes['shortcode-generator']['params']['select_shortcode']);
		if( isset( $brad_shortcodes[$this->popup]['child_shortcode'] ) )
			$this->has_child = true;

		if( isset( $brad_shortcodes ) && is_array( $brad_shortcodes ) )
		{
			// get shortcode config stuff
			$this->params = $brad_shortcodes[$this->popup]['params'];
			$this->shortcode = $brad_shortcodes[$this->popup]['shortcode'];
			$this->popup_title = $brad_shortcodes[$this->popup]['popup_title'];

			// adds stuff for js use
			$this->append_output( "\n" . '<div id="_brad_shortcode" class="hidden">' . $this->shortcode . '</div>' );
			$this->append_output( "\n" . '<div id="_brad_popup" class="hidden">' . $this->popup . '</div>' );

			if( isset( $brad_shortcodes[$this->popup]['no_preview'] ) && $brad_shortcodes[$this->popup]['no_preview'] )
			{
				//$this->append_output( "\n" . '<div id="_brad_preview" class="hidden">false</div>' );
				$this->no_preview = true;
			}

			// filters and excutes params
			foreach( $this->params as $pkey => $param )
			{
				// prefix the fields names and ids with brad_
				$pkey = 'brad_' . $pkey;

				// popup form row start
				$row_start  = '<tbody>' . "\n";
				$row_start .= '<tr class="form-row">' . "\n";
				$row_start .= '<td class="label">' . $param['label'] . '</td>' . "\n";
				$row_start .= '<td class="field">' . "\n";
				
				// popup form row end
				$row_end	= '<span class="brad-form-desc">' . $param['desc'] . '</span>' . "\n";
				$row_end   .= '</td>' . "\n";
				$row_end   .= '</tr>' . "\n";					
				$row_end   .= '</tbody>' . "\n";


				switch( $param['type'] )
				{
					case 'text' :

						// prepare
						$output  = $row_start;
						$output .= '<input type="text" class="brad-form-text brad-input" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['std'] . '" />' . "\n";
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;

					case 'textarea' :

						// prepare
						$output  = $row_start;

						// Turn on the output buffer
						ob_start();

						// Echo the editor to the buffer
						wp_editor( $param['std'], $pkey, array( 'editor_class' => 'brad_tinymce', 'media_buttons' => true ) );

						// Store the contents of the buffer in a variable
						$editor_contents = ob_get_clean();

						//$output .= $editor_contents;
						$output .= '<textarea rows="10" cols="30" name="' . $pkey . '" id="' . $pkey . '" class="brad-form-textarea brad-input">' . $param['std'] . '</textarea>' . "\n";
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;

					case 'select' :

						// prepare
						$output  = $row_start;
						$output .= '<div class="brad-form-select-field">';
						$output .= '<select name="' . $pkey . '" id="' . $pkey . '" class="brad-form-select brad-input">' . "\n";
						$output .= '</div>';

						foreach( $param['options'] as $value => $option )
						{
							$selected = ($param['std'] == $value) ? 'selected="selected"' : '';
							$output .= '<option value="' . $value . '"' . $selected . '>' . $option . '</option>' . "\n";
						}

						$output .= '</select>' . "\n";
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;


					case 'checkbox' :

						// prepare
						$output  = $row_start;
						$output .= '<label for="' . $pkey . '" class="brad-form-checkbox">' . "\n";
						$output .= '<input type="checkbox" class="brad-input" name="' . $pkey . '" id="' . $pkey . '" value="yes" ' . ( $param['std'] ? 'checked' : '' ) . ' />' . "\n";
						$output .= ' ' . $param['checkbox_text'] . '</label>' . "\n";
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;

					

				
					case 'iconpicker' :

						// prepare
						$output  = $row_start;
						$output .= '<div class="vc-icon-option iconpicker wpb-icon-prefix">';
						
						if( !empty( $uploaded_icons) ){
		                    foreach( $uploaded_icons as $k => $icon){
			                    $output .= '<i class="'.$brad_data['custom_iconfont']['prefix'].' '.$icon.'" data-icon="'.$k.'|uploaded"></i>';
							}
		                }
						
						
						if( !empty( $ss_air)){
		                    foreach( $ss_air as $k => $ss_icon){
			                    $output .= '<i class="ss-air '.$ss_icon.'" data-icon="'.$k.'|ss-air"></i>';
		                       }
	                     }
	
	                    if( is_array($fa_icons ) && !empty($fa_icons)) {
	                        foreach( $fa_icons as $k => $fontawesome_icon) { 
	                            $output .= '<i class="'.$fontawesome_icon.'" data-icon="'.$k.'|fontawesome"></i>';
	                         }
	                     }
	
	                    if( !empty( $ss_social)){
		                    foreach( $ss_social as $k => $ss_icon){
			                    $output .= '<i class="ss-social-regular '.$ss_icon.'" data-icon="'.$k.'|ss-social"></i>';
		                    }
						}
						$output .= '</div>';

						$output .= '<input type="hidden" class="brad-form-text brad-input" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['std'] . '" />' . "\n";
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;
						
                   case 'uploader' :

						// prepare
						$output  = $row_start;
						$output .= '<div class="brad-upload-container">';
						$output .= '<img src="" alt="Image" class="uploaded-image" />';
						$output .= '<input type="hidden" class="brad-form-text brad-form-upload brad-input" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['std'] . '" />' . "\n";
						$output .= '<a href="' . $pkey . '" class="brad-upload-button button button-secondary " data-uploadId="1">Upload</a>';
						$output .= '</div>';
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;
						
						
					case 'colorpicker' :

						// prepare
						$output  = $row_start;
						$output .= '<input type="text" class="brad-form-text brad-input wp-color-picker-field" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['std'] . '" />' . "\n";
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;

				}
			}

			// checks if has a child shortcode
			if( isset( $brad_shortcodes[$this->popup]['child_shortcode'] ) )
			{
				// set child shortcode
				$this->cparams = $brad_shortcodes[$this->popup]['child_shortcode']['params'];
				$this->cshortcode = $brad_shortcodes[$this->popup]['child_shortcode']['shortcode'];

				// popup parent form row start
				$prow_start  = '<tbody>' . "\n";
				$prow_start .= '<tr class="form-row has-child">' . "\n";
				$prow_start .= '<td><a href="#" id="form-child-add" class="button-secondary">' . $brad_shortcodes[$this->popup]['child_shortcode']['clone_button'] . '</a>' . "\n";
				$prow_start .= '<div class="child-clone-rows">' . "\n";
				
				// for js use
				$prow_start .= '<div id="_brad_cshortcode" class="hidden">' . $this->cshortcode . '</div>' . "\n";
				
				// start the default row
				$prow_start .= '<div class="child-clone-row">' . "\n";
				$prow_start .= '<ul class="child-clone-row-form">' . "\n";

				// add $prow_start to output
				$this->append_output( $prow_start );

				foreach( $this->cparams as $cpkey => $cparam )
				{

					// prefix the fields names and ids with brad_
					$cpkey = 'brad_' . $cpkey;

					// popup form row start
					$crow_start  = '<li class="child-clone-row-form-row clearfix">' . "\n";
					$crow_start .= '<div class="child-clone-row-label-desc">' . "\n";
					$crow_start .= '<div class="child-clone-row-label">' . "\n";
					$crow_start .= '<label>' . $cparam['label'] . '</label>' . "\n";
					$crow_start .= '</div>' . "\n";
					$crow_start	.= '<span class="child-clone-row-desc">' . $cparam['desc'] . '</span>' . "\n";
					$crow_start .= '</div>' . "\n";
					$crow_start .= '<div class="child-clone-row-field">' . "\n";

					// popup form row end
					$crow_end    = '</div>' . "\n";
					$crow_end   .= '</li>' . "\n";

					switch( $cparam['type'] )
					{
						case 'text' :

							// prepare
							$coutput  = $crow_start;
							$coutput .= '<input type="text" class="brad-form-text brad-cinput" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;

						case 'textarea' :

							// prepare
							$coutput  = $crow_start;
							$coutput .= '<textarea rows="10" cols="30" name="' . $cpkey . '" id="' . $cpkey . '" class="brad-form-textarea brad-cinput">' . $cparam['std'] . '</textarea>' . "\n";
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;

						case 'select' :

							// prepare
							$coutput  = $crow_start;
							$coutput .= '<div class="brad-form-select-field">';
							$coutput .= '<select name="' . $cpkey . '" id="' . $cpkey . '" class="brad-form-select brad-cinput">' . "\n";
							$coutput .= '</div>';

							foreach( $cparam['options'] as $value => $option )
							{
								$coutput .= '<option value="' . $value . '">' . $option . '</option>' . "\n";
							}

							$coutput .= '</select>' . "\n";
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;

						case 'checkbox' :

							// prepare
							$coutput  = $crow_start;
							$coutput .= '<label for="' . $cpkey . '" class="brad-form-checkbox">' . "\n";
							$coutput .= '<input type="checkbox" class="brad-cinput" value="yes" name="' . $cpkey . '" id="' . $cpkey . '" ' . ( $cparam['std'] ? 'checked' : '' ) . ' />' . "\n";
							$coutput .= ' ' . $cparam['checkbox_text'] . '</label>' . "\n";
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;

						
						case 'uploader' :

							// prepare
							$coutput  = $crow_start;
							$coutput .= '<div class="brad-upload-container">';
							$coutput .= '<img src="" alt="Image" class="uploaded-image" />';
							$coutput .= '<input type="hidden" class="brad-form-text brad-form-upload brad-cinput" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= '<a href="' . $cpkey . '" class="brad-upload-button" data-uploadId="1">Upload</a>';
							$coutput .= '</div>';
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;


						case 'colorpicker' :

							// prepare
							$coutput  = $crow_start;
							$coutput .= '<input type="text" class="brad-form-text brad-cinput wp-color-picker-field" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;

						case 'iconpicker' :

							// prepare
							$coutput  = $crow_start;

							$coutput .= '<div class="vc-icon-option iconpicker wpb-icon-prefix">';
							
							
							if( !empty( $uploaded_icons) && $cparam['iconType'] != 'social'){
		                        foreach( $uploaded_icons as $k => $icon){
			                        $coutput .= '<i class="'.$brad_data['custom_iconfont']['prefix'].' '.$icon.'" data-icon="'.$k.'|uploaded"></i>';
		                       }
	                        }
							
							
						    if( !empty( $ss_air) && $cparam['iconType'] != 'social'){
		                        foreach( $ss_air as $k => $ss_icon){
			                        $coutput .= '<i class="ss-air '.$ss_icon.'" data-icon="'.$k.'|ss-air"></i>';
		                       }
	                        }
	
	                        if( is_array($fa_icons ) && !empty($fa_icons) && $cparam['iconType'] != 'social') {
	                            foreach( $fa_icons as $k => $fontawesome_icon) { 
	                                $coutput .= '<i class="'.$fontawesome_icon.'" data-icon="'.$k.'|fontawesome"></i>';
	                           }
	                        }
	
	                        if( !empty( $ss_social)){
		                        foreach( $ss_social as $k => $ss_icon){
			                        $coutput .= '<i class="ss-social-regular '.$ss_icon.'" data-icon="'.$k.'|ss-social"></i>';
		                       }
						     }
							$coutput .= '</div>';

							$coutput .= '<input type="hidden" class="brad-form-text brad-cinput" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;
					}
				}

				// popup parent form row end
				$prow_end    = '</ul>' . "\n";		// end .child-clone-row-form
				$prow_end   .= '<a href="#" class="child-clone-row-remove">Remove</a>' . "\n";
				$prow_end   .= '</div>' . "\n";		// end .child-clone-row
				
				
				$prow_end   .= '</div>' . "\n";		// end .child-clone-rows
				$prow_end   .= '</td>' . "\n";
				$prow_end   .= '</tr>' . "\n";					
				$prow_end   .= '</tbody>' . "\n";

				// add $prow_end to output
				$this->append_output( $prow_end );
			}
		}
	}

	// --------------------------------------------------------------------------

	function append_output( $output )
	{
		$this->output = $this->output . "\n" . $output;
	}

	// --------------------------------------------------------------------------

	function reset_output( $output )
	{
		$this->output = '';
	}

	// --------------------------------------------------------------------------

	function append_error( $error )
	{
		$this->errors = $this->errors . "\n" . $error;
	}
}

?>