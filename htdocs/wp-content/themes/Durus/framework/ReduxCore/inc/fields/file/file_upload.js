
/**
 * Custom Font Uploader
*/

(function( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.font_uploader = redux.field_objects.font_uploader || {};

    $( document ).ready(
        function() {
            redux.field_objects.font_uploader.init();
			
        }
    );
    
    redux.field_objects.font_uploader.init = function( selector ) {
		
        if ( !selector ) {
            selector = $( document ).find( '.redux-container-file' );
        }
        $( selector ).each(
            function() {
                var el = $( this );
                var parent = el;
              
                // Remove the image button
                el.find( '.remove-font' ).unbind().on(
                    'click', function(event) {
                        redux.field_objects.font_uploader.removeFont( $( this ).parents( 'fieldset.redux-field:first' ) );
                    }
                );
                // Upload media button
                el.find( '.icon_font_upload_button' ).unbind().on(
                    'click', function( event ) {
                        redux.field_objects.font_uploader.addFont( event, $( this ).parents( 'fieldset.redux-field:first' ) );
                    }
                );
            }
        );
    };

    // Add a file via the wp.media function
    redux.field_objects.font_uploader.addFont = function( event, selector ) {
        event.preventDefault();

        var frame;
        var jQueryel = $( this );

        // If the media frame already exists, reopen it.
        if ( frame ) {
            frame.open();
            return;
        }

        // Create the media frame.
        frame = wp.media(
            {
                multiple: false,
                library: {
                    //type: 'image' //Only allow images
                },

                // Set the title of the modal.
                title: jQueryel.data( 'choose' ),

                // Customize the submit button.
                button: {
                    // Set the text of the button.
                    text: jQueryel.data( 'update' )
                    // Tell the button not to close the modal, since we're
                    // going to refresh the page when the image is selected.
                }
            }
        );

        // When an image is selected, run a callback.
        frame.on(
            'select', function() {

                // Grab the selected attachment.
                var attachment = frame.state().get( 'selection' ).first(),
				         nonce = redux_file_upload.nonce,
					   ajaxurl = redux_file_upload.ajaxurl;
                
				frame.close();
				
				selector.find('.icon_font_upload_button').unbind('click');
				selector.find('.icon_font_uploading').fadeIn();
	   
	            var request = $.ajax( {url: ajaxurl  , cache:false , type: "POST" , data : { 'action' : 'of_ajax_post_redux_file' , 'nonce' : nonce , 'attachment' : attachment.attributes.id }});
				
				request.done(function( response ) {
					if(response.search('Error') > -1 || response == -1){
						alert(response);
					}
					else{
						response = $.parseJSON(response);
					    selector.find('.icon-css-url').val(response.css_url);
					    selector.find('.icon-css-file').val(response.css_file);
					    selector.find('.icon-prefix').val(response.prefix);
					    selector.find('.icon-name').val(response.name);
					    selector.find('.icon-font-container').html('Font Uploaded:' + response.name);
					     selector.find('.remove-font').fadeIn(300,"linear",function(){ $(this).css('display' , 'inline-block');});
					}
					selector.find('.icon_font_upload_button').on(
                    'click', function( event ) {
                        redux.field_objects.font_uploader.addFont( event, selector );
                    });
					selector.find('.icon_font_uploading').fadeOut();
                });
				
				request.fail(function( jqXHR, textStatus ) {
                  alert(textStatus);
				  selector.find('.icon_font_upload_button').on(
                    'click', function( event ) {
                        redux.field_objects.font_uploader.addFont( event, selector );
                    });
				 selector.find('.icon_font_uploading').fadeOut();	
               });
			   


            }
        );

        // Finally, open the modal.
        frame.open();
    };

    // Function to remove the image on click. Still requires a save
    redux.field_objects.font_uploader.removeFont = function( selector ) {
		
		var font = selector.find('.icon-name').val(),
				         nonce = redux_file_upload.nonce,
					   ajaxurl = redux_file_upload.ajaxurl;
				
				selector.find('.remove-font').unbind('click');
				selector.find('.icon_font_uploading').fadeIn();
					   
			var request = $.ajax( {url: ajaxurl  , cache:false , type: "POST" , data : { 'action' : 'of_ajax_delete_redux_file' , 'nonce' : nonce , 'font_name' : font } });
				
				request.done(function( response ) {
					if( response.search('Error') > -1 || response == -1){
						alert(response);
						}
					else{	
					    selector.find('.icon-css-url').val('');
					    selector.find('.icon-css-file').val('');
					    selector.find('.icon-prefix').val('');
					    selector.find('.icon-name').val('');
					    selector.find('.icon-font-container').html('');
					}
					    selector.find('.icon_font_uploading').fadeOut();
					    selector.find('.remove-font').on(
                             'click', function( event ) {
                              redux.field_objects.font_uploader.removeFont( selector );
                         });
					    selector.find('.remove-font').fadeOut();
					    selector.find('.icon_font_uploading').fadeOut();
                });
				
				request.fail(function( jqXHR, textStatus ) {
                  alert(textStatus);
				  selector.find('.remove-font').on(
                    'click', function( event ) {
                        redux.field_objects.font_uploader.removeFont( selector );
                    });
				  selector.find('.icon_font_uploading').fadeOut();
               });		   

       
    };
})( jQuery );

