// start the popup specefic scripts
// safe to use jQuery
jQuery(document).ready(function($) {
    window.brad_tb_height = (92 / 100) * jQuery(window).height();
    window.brad_shortcodes_height = (71 / 100) * jQuery(window).height();
    if(window.brad_shortcodes_height > 550) {
        window.brad_shortcodes_height = (74 / 100) * jQuery(window).height();
    }

    jQuery(window).resize(function() {
        window.brad_tb_height = (92 / 100) * jQuery(window).height();
        window.brad_shortcodes_height = (71 / 100) * jQuery(window).height();

        if(window.brad_shortcodes_height > 550) {
            window.brad_shortcodes_height = (74 / 100) * jQuery(window).height();
        }
    });

    brad_shortcodes = {
    	loadVals: function()
    	{
    		var shortcode = jQuery('#_brad_shortcode').text(),
    			uShortcode = shortcode;
    		
    		// fill in the gaps eg {{param}}
    		jQuery('.brad-input').each(function() {
    			var input = jQuery(this),
    				id = input.attr('id'),
    				id = id.replace('brad_', ''),		// gets rid of the brad_ prefix
    				re = new RegExp("{{"+id+"}}","g");
					if( input.is('[type="checkbox"]')){
						value = input.is(':checked') ? "yes" : "no";
					}
					else{
                       var value = input.val();
					}
                    if(value == null) {
                      value = '';
                    }
    			uShortcode = uShortcode.replace(re, value);
    		});

    		// adds the filled-in shortcode as hidden input
    		jQuery('#_brad_ushortcode').remove();
    		jQuery('#brad-sc-form-table').prepend('<div id="_brad_ushortcode" class="hidden">' + uShortcode + '</div>');
    	},
    	cLoadVals: function()
    	{
    		var shortcode = jQuery('#_brad_cshortcode').text(),
    			pShortcode = '';

    			if(shortcode.indexOf("<li>") < 0) {
    				shortcodes = '<br />';
    			} else {
    				shortcodes = '';
    			}

    		// fill in the gaps eg {{param}}
    		jQuery('.child-clone-row').each(function() {
    			var row = jQuery(this),
    				rShortcode = shortcode;
    			
  
    			jQuery('.brad-cinput', this).each(function() {
    				var input = jQuery(this),
    					id = input.attr('id'),
    					id = id.replace('brad_', '')		// gets rid of the brad_ prefix
    					re = new RegExp("{{"+id+"}}","g");
                        if( input.is('[type="checkbox"]')){
						    value = input.is(':checked') ? "yes" : "no";
					    }
					    else{
                           var value = input.val();
					    }
                        if(value == null) {
                          value = '';
                        }
    				rShortcode = rShortcode.replace(re, input.val());
    			});

    			if(shortcode.indexOf("<li>") < 0) {
    				shortcodes = shortcodes + rShortcode + '<br />';
    			} else {
    				shortcodes = shortcodes + rShortcode;
    			}
    		});
    		
    		// adds the filled-in shortcode as hidden input
    		jQuery('#_brad_cshortcodes').remove();
    		jQuery('.child-clone-rows').prepend('<div id="_brad_cshortcodes" class="hidden">' + shortcodes + '</div>');
    		
    		// add to parent shortcode
    		this.loadVals();
    		pShortcode = jQuery('#_brad_ushortcode').html().replace('{{child_shortcode}}', shortcodes);
            
    		// add updated parent shortcode
    		jQuery('#_brad_ushortcode').remove();
    		jQuery('#brad-sc-form-table').prepend('<div id="_brad_ushortcode" class="hidden">' + pShortcode + '</div>');
    	},
    	children: function()
    	{
    		// assign the cloning plugin
    		jQuery('.child-clone-rows').appendo({
    			subSelect: '> div.child-clone-row:last-child',
    			allowDelete: false,
    			focusFirst: false,
                onAdd: function(row) {
                    // Get Upload ID
                    var prev_upload_id = jQuery(row).prev().find('.brad-upload-button').data('uploadId');
                    var new_upload_id = prev_upload_id + 1;
                    jQuery(row).find('.brad-upload-button').attr('data-uploadId', new_upload_id);

                   
                    // activate color picker
                    jQuery('.wp-color-picker-field').wpColorPicker({
                        change: function(event, ui) {
                            brad_shortcodes.loadVals();
                            brad_shortcodes.cLoadVals();
                        }
                    });
                    brad_shortcodes.loadVals();
                    brad_shortcodes.cLoadVals();
                }
    		});
    		
    		// remove button
    		jQuery('.child-clone-row-remove').live('click', function() {
    			var	btn = jQuery(this),
    				row = btn.parent();
    			
    			if( jQuery('.child-clone-row').size() > 1 )
    			{
    				row.remove();
    			}
    			else
    			{
    				alert('You need a minimum of one row');
    			}
    			
    			return false;
    		});
    		
    		// assign jUI sortable
    		jQuery( ".child-clone-rows" ).sortable({
				placeholder: "sortable-placeholder",
				items: '.child-clone-row',
                cancel: 'div.iconpicker, input, select, textarea, a'
			});
    	},
    	resizeTB: function()
    	{
			var	ajaxCont = jQuery('#TB_ajaxContent'),
				tbWindow = jQuery('#TB_window'),
				bradPopup = jQuery('#brad-popup');

            tbWindow.css({
                height: window.brad_tb_height,
                width: bradPopup.outerWidth(),
                marginLeft: -(bradPopup.outerWidth()/2)
            });

			ajaxCont.css({
				paddingTop: 0,
				paddingLeft: 0,
				paddingRight: 0,
				height: window.brad_tb_height,
				overflow: 'auto', // IMPORTANT
				width: bradPopup.outerWidth()
			});

            tbWindow.show();

			jQuery('#brad-popup').addClass('no_preview');
            jQuery('#brad-sc-form-wrap #brad-sc-form').height(window.brad_shortcodes_height);
    	},
		
    	load: function()
    	{
    		var	brad = this,
    			popup = jQuery('#brad-popup'),
    			form = jQuery('#brad-sc-form', popup),
    			shortcode = jQuery('#_brad_shortcode', form).text(),
    			popupType = jQuery('#_brad_popup', form).text(),
    			uShortcode = '';
    		
            // if its the shortcode selection popup
            if(jQuery('#_brad_popup').text() == 'shortcode-generator') {
                jQuery('.brad-insert').hide();
            }

    		// resize TB
    		brad_shortcodes.resizeTB();
    		jQuery(window).resize(function() { brad_shortcodes.resizeTB() });
    		
    		// initialise
            brad_shortcodes.loadVals();
    		brad_shortcodes.children();
    		brad_shortcodes.cLoadVals();
    		
    		// update on children value change
    		jQuery('.brad-cinput', form).live('change', function() {
    			brad_shortcodes.cLoadVals();
    		});
    		
    		// update on value change
    		jQuery('.brad-input', form).live('change', function() {
    			brad_shortcodes.loadVals();
    		});

            // change shortcode when a user selects a shortcode from choose a dropdown field
            jQuery('#brad_select_shortcode').change(function() {
                var name = jQuery(this).val();
                var label = jQuery(this).text();
                
                if(name != 'select') {
                    tinyMCE.activeEditor.execCommand("bradPopup", false, {
                        title: label,
                        identifier: name
                    });

                    jQuery('#TB_window').hide();
                }
            });

          

            // update upload button ID
            jQuery('.brad-upload-button:not(:first)').each(function() {
                var prev_upload_id = jQuery(this).data('uploadId');
                var new_upload_id = prev_upload_id + 1;
                jQuery(this).attr('data-uploadId', new_upload_id);
            });
    	}
	}
    
    // run
    jQuery('#brad-popup').livequery(function() {
        brad_shortcodes.load();

        jQuery('#brad-popup').closest('#TB_window').addClass('brad-shortcodes-popup');

        jQuery('#brad_video_content').closest('li').hide();

            // activate color picker
            jQuery('.wp-color-picker-field').wpColorPicker({
                change: function(event, ui) {
                    setTimeout(function() {
                        brad_shortcodes.loadVals();
                        brad_shortcodes.cLoadVals();
                    },
                    1);
                }
            });
    });

    // when insert is clicked
    jQuery('.brad-insert').live('click', function() {                        
        if(window.tinyMCE)
        {
			if(window.tinymce.majorVersion === "4") {
				parent.tinyMCE.activeEditor.execCommand('mceInsertContent', false, jQuery('#_brad_ushortcode').html());
				tb_remove();
			}
			else {
			activeEditor = window.tinyMCE.activeEditor.id;
			window.tinyMCE.execInstanceCommand(activeEditor, 'mceInsertContent', false, jQuery('#_brad_ushortcode').html());
            tb_remove();
			}
        }
    });

    //tinymce.init(tinyMCEPreInit.mceInit['brad_content']);
    //tinymce.execCommand('mceAddControl', true, 'brad_content');
    //quicktags({id: 'brad_content'});
	
    // activate upload button
    jQuery('.brad-upload-button').live('click', function(e) {
	    e.preventDefault();

        var uploadId = jQuery(this).attr('data-uploadId');

        if(jQuery(this).hasClass('remove-image')) {
            jQuery('.brad-upload-button[data-uploadId="' + uploadId + '"]').parent().find('img').attr('src', '').hide();
            jQuery('.brad-upload-button[data-uploadId="' + uploadId + '"]').parent().find('input').attr('value', '');
            jQuery('.brad-upload-button[data-uploadId="' + uploadId + '"]').text('Upload').removeClass('remove-image');

            return;
        }

        var file_frame = wp.media.frames.customHeader = wp.media({
            title: 'Select Image',
            button: {
                text: 'Select Image',
            },
	        // Tell the modal to show only images. Ignore if want ALL
            library: {
                  type: 'image'
                    }
        });


        file_frame.on( 'select', function() {
            var attachment = file_frame.state().get('selection').first();
            jQuery('.brad-upload-button[data-uploadId="' + uploadId + '"]').parent().find('img').attr('src', attachment.attributes.url).show();
            jQuery('.brad-upload-button[data-uploadId="' + uploadId + '"]').parent().find('input').attr('value', attachment.attributes.id);
            
			brad_shortcodes.loadVals();
            brad_shortcodes.cLoadVals();
            
			jQuery('.brad-upload-button[data-uploadId="' + uploadId + '"]').text('Remove').addClass('remove-image');
            jQuery('.media-modal-close').trigger('click');
        });

       file_frame.open();
	  
    });


    // activate iconpicker
    jQuery('.iconpicker i').live('click', function(e) {
        e.preventDefault();
        var iconWithPrefix = jQuery(this).attr('class');
        var fontName = jQuery(this).attr('data-icon');
        if(jQuery(this).hasClass('selected')) {
            jQuery(this).parent().find('.selected').removeClass('selected');
            jQuery(this).parent().parent().find('input').attr('value', '');
        } else {
            jQuery(this).parent().find('.selected').removeClass('selected');
            jQuery(this).addClass('selected');

            jQuery(this).parent().parent().find('input').attr('value', fontName);
        }
        brad_shortcodes.loadVals();
        brad_shortcodes.cLoadVals();
    });


    jQuery('#brad-popup textarea').live('focus', function() {
        var text = jQuery(this).val();

        if(text == 'Your Content Goes Here') {
            jQuery(this).val('');
        }
    });


});