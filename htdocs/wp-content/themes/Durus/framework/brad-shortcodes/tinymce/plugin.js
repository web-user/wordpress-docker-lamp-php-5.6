
(function($) {
"use strict";   
 
   if(tinymce.majorVersion === "4") {
	   		
 			//Shortcodes
            tinymce.PluginManager.add( 'bradShortcodes', function( editor, url ) {
				
				editor.addCommand("bradPopup", function ( a, params )
				{
					var popup = params.identifier;
					// load thickbox
				    tb_show("Insert Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
				});
     
                editor.addButton( 'brad_button', {
	                    title: "Insert Brad Shortcode",

						image:  "http://www.brad-web.com/img/add.png",
						icons: false,
						onclick: function() {
	                        tinyMCE.activeEditor.execCommand("bradPopup", false, {
	                            title: 'Shortcode Generator',
	                            identifier: 'shortcode-generator'
	                        });

	                        jQuery('#TB_window').hide();

							return false;
						}
	                });
         
          });
        
   }
   
   else{
	   // create bradShortcodes plugin
	tinymce.create("tinymce.plugins.bradShortcodes",
	{
		init: function ( ed, url )
		{
			ed.addCommand("bradPopup", function ( a, params )
			{
				var popup = params.identifier;
				
				
				// load thickbox
				tb_show("Insert Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
			});
		},
		createControl: function ( btn, e )
		{
			if ( btn == "brad_button" )
			{	
				var a = this;
					
				// adds the tinymce button
				var btn = e.createButton('brad_button', {
	                    title: "Insert Brad Shortcode",
						image:  "http://www.brad-web.com/img/add.png",
						icons: false,
						onclick: function() {
	                        tinyMCE.activeEditor.execCommand("bradPopup", false, {
	                            title: 'Shortcode Generator',
	                            identifier: 'shortcode-generator'
	                        });

	                        jQuery('#TB_window').hide();

							return false;
						}
	                });
					
				return btn;
			}
			
			return null;
		}
		,
		getInfo: function () {
			return {
				longname: 'Brad Shortcodes',
				author: 'Bradweb',
				authorurl: 'http://themeforest.net/user/bradweb/',
				infourl: 'http://wiki.moxiecode.com/',
				version: "1.0"
			}
		}
	});
	
	// add bradShortcodes plugin
	tinymce.PluginManager.add("bradShortcodes", tinymce.plugins.bradShortcodes);
   
   }
 
})(jQuery);

