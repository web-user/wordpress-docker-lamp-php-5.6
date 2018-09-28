 
 
jQuery(document).ready(function ($) {
	'use strict';

function checkTitlebar(){
		var titlebar = $('#brad_titlebar_style').attr('value');

		//only run on the posts page
		if(typeof titlebar != 'undefined'){
			
			if(titlebar == 'style2'){
				$('#brad_add_content').parents('.rwmb-field').stop(true,true).fadeIn(300);
				$('#brad_titlebar_parallax').parents('.rwmb-field').stop(true,true).fadeIn(300);
				$('#brad_title_height').parents('.rwmb-field').stop(true,true).fadeIn(300);
				$('#brad_title_bg_overlay').parents('.rwmb-field').stop(true,true).fadeIn(300);
			}
			
			else {
				$('#brad_add_content').parents('.rwmb-field').stop(true,true).fadeOut(300);
				$('#brad_titlebar_parallax').parents('.rwmb-field').stop(true,true).fadeOut(300);
				$('#brad_title_height').parents('.rwmb-field').stop(true,true).fadeOut(300);
				$('#brad_title_bg_overlay').parents('.rwmb-field').stop(true,true).fadeOut(300);
			}

					
		}
	
	}
	
	$('#brad_titlebar_style').change(checkTitlebar);
	checkTitlebar();
	

    $('#post-formats-select input').change(checkFormat);
	
	function checkFormat(){
		var format = $('#post-formats-select input:checked').attr('value');

		//only run on the posts page
		if(typeof format != 'undefined'){
			
			if(format == 'gallery'){
				$('#poststuff div[id$=slide][id^=post]').stop(true,true).fadeIn(500);
			}
			
			else {
				$('#poststuff div[id$=slide][id^=post]').stop(true,true).fadeOut(500);
			}
			
			$('#post-body div[id^=brad-metabox-post-]').hide();
			$('#post-body #brad-metabox-post-'+format+'').stop(true,true).fadeIn(500);
					
		}
	
	}
	
	
	checkFormat();
	
	
	$('#page_template').change(checkPageSettings);
	
	function checkPageSettings(){
		var format = $('#page_template').attr('value');

		//only run on the page
		if(typeof format != 'undefined'){
			format = format.replace('.php', '');
			$('#post-body div[id^=brad_page_settings_]').hide();
			$('#post-body #brad_page_settings_'+format+'').stop(true,true).fadeIn(500);
					
		}
	
	}
	
	checkPageSettings();
	
});