/* =========================================================
 * params/all.js v0.0.1
 * =========================================================
 * Copyright 2012 Wpbakery
 *
 * Visual composer javascript functions to enable fields.
 * This script loads with settings form.
 * ========================================================= */

var wpb_change_tab_title, wpb_change_accordion_tab_title;

!function($) {
    wpb_change_tab_title = function($element, field) {
        $('.tabs_controls a[href=#tab-' + $(field).val() +']').text($('.wpb-edit-form [name=title].wpb_vc_param_value').val());
    };
    wpb_change_accordion_tab_title = function($element, field) {
         var $section_title = $element.prev();
         $section_title.find('a').text($(field).val());
    };

    function init_textarea_html($element) {
        /*
         Simple version without all this buttons from Wordpress
         tinyMCE.init({
         mode : "textareas",
         theme: 'advanced',
         editor_selector: $element.attr('name') + '_tinymce'
         });
         */
        if($('#wp-link').parent().hasClass('wp-dialog')) $('#wp-link').wpdialog('destroy');
        var qt, textfield_id = $element.attr("id"),
            $form_line = $element.closest('.edit_form_line'),
            $content_holder = $form_line.find('.vc_textarea_html_content'),
            content = $content_holder.val();

        window.tinyMCEPreInit.mceInit[textfield_id] = _.extend({}, tinyMCEPreInit.mceInit['content']);

        if(_.isUndefined(tinyMCEPreInit.qtInit[textfield_id])) {
            window.tinyMCEPreInit.qtInit[textfield_id] = _.extend({}, tinyMCEPreInit.qtInit['replycontent'], {id: textfield_id})
        }
        $element.val($content_holder.val());
        qt = quicktags( window.tinyMCEPreInit.qtInit[textfield_id] );
        QTags._buttonsInit();
        window.switchEditors.go(textfield_id, 'tmce');
        if(tinymce.majorVersion === "4") tinymce.execCommand( 'mceAddEditor', true, textfield_id );
        vc_activeMce = textfield_id;
        /// window.tinyMCE.get(textfield_id).focus();
    }
    function init_textarea_html_old($element) {
        var textfield_id = $element.attr("id"),
            $form_line = $element.closest('.edit_form_line'),
            $content_holder = $form_line.find('.vc_textarea_html_content');
        $('#' + textfield_id +'-html').trigger('click');
        $('.switch-tmce').trigger('click');
        $form_line.find('.wp-switch-editor').removeAttr("onclick");
         $('.switch-tmce').trigger('click');
         $element.closest('.edit_form_line').find('.switch-tmce').click(function () {
         window.tinyMCE.execCommand("mceAddControl", true, textfield_id);
         window.switchEditors.go(textfield_id, 'tmce');
         $element.closest('.edit_form_line').find('.wp-editor-wrap').removeClass('html-active').addClass('tmce-active');
             var val = window.switchEditors.wpautop($(this).closest('.edit_form_line').find("textarea.visual_composer_tinymce").val());
             $("textarea.visual_composer_tinymce").val(val);
             // Add tinymce
             window.tinyMCE.execCommand("mceAddControl", true, textfield_id);
         });
         $element.closest('.edit_form_line').find('.switch-html').click(function () {
             $element.closest('.edit_form_line').find('.wp-editor-wrap').removeClass('tmce-active').addClass('html-active');
             window.tinyMCE.execCommand("mceRemoveControl", true, textfield_id);
         });
         $('#wpb_tinymce_content-html').trigger('click');
         $('#wpb_tinymce_content-tmce').trigger('click'); // Fix hidden toolbar
    }
	
    $('.wpb-edit-form .textarea_html').each(function(){
        init_textarea_html($(this));
    });

    $('.vc-color-control').wpColorPicker();
	
	
	$('.vc-icon-option i').on('click',function(){
		 $value = $(this).data('icon');
		if( $(this).hasClass('selected')){
         $(this).removeClass('selected');
		  $(this).parent().parent().find('input.vc-icon-picker').attr('value','').trigger('change');
		}
		else {
		 $(this).parent().find(' > i').removeClass('selected');	
         $(this).addClass('selected');
         $(this).parent().parent().find('input.vc-icon-picker').attr('value',$value).trigger('change');
		}
	 });
		

    var InitGalleries = function() {
        var that = this;
        // TODO: Backbone style for view binding
        $('.gallery_widget_attached_images_list', this.$view).unbind('click.removeImage').on('click.removeImage', 'a.icon-remove', function(e){
            e.preventDefault();
            var $block = $(this).closest('.edit_form_line');
            $(this).parent().remove();
            var img_ids = [];
            $block.find('.added img').each(function () {
                img_ids.push($(this).attr("rel"));
            });
            $block.find('.gallery_widget_attached_images_ids').val(img_ids.join(','));
        });
        $('.gallery_widget_attached_images_list').each(function (index) {
            var $img_ul = $(this);
            $img_ul.sortable({
                forcePlaceholderSize:true,
                placeholder:"widgets-placeholder-gallery",
                cursor:"move",
                items:"li",
                update:function () {
                    var img_ids = [];
                    $(this).find('.added img').each(function () {
                        img_ids.push($(this).attr("rel"));
                    });
                    $img_ul.closest('.edit_form_line').find('.gallery' +
                        '' +
                        '_widget_attached_images_ids').val(img_ids.join(','));
                }
            });
        });
    };
    new InitGalleries();
    var template_options = {
        evaluate:    /<#([\s\S]+?)#>/g,
        interpolate: /\{\{\{([\s\S]+?)\}\}\}/g,
        escape:      /\{\{([^\}]+?)\}\}(?!\})/g
    };

    /**
     * VC_link power code.
     */
    $('.vc-link-build').click(function(e){
        e.preventDefault();
        var $self = $(this),
            $block = $(this).closest('.vc-link'),
            $input = $block.find('.wpb_vc_param_value'),
            $url_label = $block.find('.url-label'),
            $title_label = $block.find('.title-label'),
            value_object = $input.data('json');
        var $dialog = $('#wp-link').wpdialog({
            title: wpLinkL10n.title,
            width: 480,
            height: 'auto',
            modal: true,
            dialogClass: 'wp-dialog',
            zIndex: 300000
        });
        window.wpLink.textarea = $self;
        if(_.isString(value_object.url)) $('#url-field').val(value_object.url);
        if(_.isString(value_object.title)) $('#link-title-field').val(value_object.title);
        $('#link-target-checkbox').attr('checked', !_.isEmpty(value_object.target) ? true : false);
        $('#wp-link-submit').unbind('click.vcLink').bind('click.vcLink', function(e){
            e.preventDefault();
            var options = {},
                string = '';
            options.url = $('#url-field').val();
            options.title = $('#link-title-field').val();
            options.target = $('#link-target-checkbox').is(':checked') ? ' _blank' : '';
            string = _.map(options, function(value, key){
                if(_.isString(value) && value.length >0) {
                    return key + ':' + encodeURIComponent(value);
                }
            }).join('|');
            $input.val(string);
            $input.data('json', options);
            $url_label.html(options.url + options.target );
            $title_label.html(options.title);
            $dialog.wpdialog('close');
            // remove vc_link hooks for wpLink
            $('#wp-link-submit').unbind('click.vcLink');
            $('#wp-link-cancel').unbind('click.vcLink');
            window.wpLink.textarea = '';
        });
        $('#wp-link-cancel').unbind('click.vcLink').bind('click.vcLink', function(e){
            e.preventDefault();
            $dialog.wpdialog('close');
            // remove vc_link hooks for wpLink
            $('#wp-link-submit').unbind('click.vcLink');
            $('#wp-link-cancel').unbind('click.vcLink');
            window.wpLink.textarea = '';
        });
    });
}(window.jQuery);