<?php
/**
 * WPBakery Visual Composer build plugin
 *
 * @package WPBakeryVisualComposer
 *
 */
if (!defined('ABSPATH')) die('-1');
if (!class_exists('WPBakeryVisualComposerSetup')) {
class WPBakeryVisualComposerSetup extends WPBakeryVisualComposerAbstract {
    protected $composer;
    public function __construct() {
    }

    public function init($settings) {
        parent::init($settings);
        $this->composer = WPBakeryVisualComposer::getInstance();
        $this->composer->createColumnShortCode(); // Refactored
        $this->composer->setTheme();
            $this->setUpTheme();
       
        if ( function_exists( 'add_theme_support' ) ) {
            add_theme_support( 'post-thumbnails');
        }
        add_post_type_support( 'page', 'excerpt' );
        $this->composer->addFilter('the_excerpt', 'excerptFilter');

    }
 
	
    public function setUpPlugin() {
        if (!is_admin()) {
			$this->addAction('template_redirect', 'frontJsRegister');
            $this->addFilter('the_content', 'fixPContent', 11); //If weight is higher then 11 it doesn work... why?
            $this->addFilter('body_class', 'jsComposerBodyClass');

        }
    }

    public function fixPContent($content = null) {
        //$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
        $s = array(
                    '/'.preg_quote('</div>', '/').'[\s\n\f]*'.preg_quote('</p>', '/').'/i',
                    '/'.preg_quote('<p>', '/').'[\s\n\f]*'.preg_quote('<div ', '/').'/i',
                    '/'.preg_quote('<p>', '/').'[\s\n\f]*'.preg_quote('<section ', '/').'/i',
                    '/'.preg_quote('</section>', '/').'[\s\n\f]*'.preg_quote('</p>', '/').'/i'
                  );
        $r = array("</div>", "<div ", "<section ", "</section>");
        $content = preg_replace($s, $r, $content);
        return $content;
    }
   
   
  public function frontJsRegister() {

    }



    public function setUpTheme() {
        $this->setUpPlugin();
    }


    public function jsComposerBodyClass($classes) {
        $classes[] = 'wpb-js-composer js-comp-ver-'.WPB_VC_VERSION;
        $classes[] = 'vc_responsive';
        return $classes;
    }
}

/* Setup for admin */

class WPBakeryVisualComposerSetupAdmin extends WPBakeryVisualComposerSetup {
    public function __construct() {
        parent::__construct();
    }

   
    /* Setup plugin composer */

    public function setUpPlugin() {
    
        parent::setUpPlugin();
        
            $this->composer->addAction( 'edit_post', 'saveMetaBoxes' );
            $this->composer->addAction( 'wp_ajax_wpb_get_element_backend_html', 'elementBackendHtmlJavascript_callback' );
            $this->composer->addAction( 'wp_ajax_wpb_get_convert_elements_backend_html', 'Convert2NewVersionJavascript_callback' );
            $this->composer->addAction( 'wp_ajax_wpb_get_row_element_backend_html', 'elementRowBackendHtmlJavascript_callback' );
            $this->composer->addAction( 'wp_ajax_wpb_shortcodes_to_visualComposer', 'shortCodesVisualComposerJavascript_callback' );
            $this->composer->addAction( 'wp_ajax_wpb_single_image_src', 'singleImageSrcJavascript_callback' );
			$this->composer->addAction( 'wp_ajax_wpb_icon_code', 'iconCodeJavascript_callback' );
            $this->composer->addAction( 'wp_ajax_wpb_gallery_html', 'galleryHTMLJavascript_callback' );
            $this->composer->addAction( 'wp_ajax_wpb_get_loop_suggestion', 'getLoopSuggestionJavascript_callback' );
      
            /*
             * Create edit form html
             * @deprecated
             */
           $this->composer->addAction( 'wp_ajax_wpb_show_edit_form', 'showEditFormJavascript_callback' );
           $this->composer->addAction( 'wp_ajax_wpb_get_edit_form', 'getEditFormJavascript_callback' );
           $this->composer->addAction('wp_ajax_wpb_save_template', 'saveTemplateJavascript_callback');
           $this->composer->addAction('wp_ajax_wpb_load_template', 'loadTemplateJavascript_callback');
           $this->composer->addAction('wp_ajax_wpb_load_template_shortcodes', 'loadTemplateShortcodesJavascript_callback');
           $this->composer->addAction('wp_ajax_wpb_delete_template', 'deleteTemplateJavascript_callback');
           $this->composer->addAction('wp_ajax_wpb_get_loop_settings', 'getLoopSettingsJavascript_callback');
           $this->addAction( 'admin_init', 'jsComposerEditPage', 5 );
        
          // Add specific CSS class by filter
          $this->addFilter('body_class', 'jsComposerBodyClass');
          $this->addFilter( 'get_media_item_args', 'jsForceSend' );
          $this->addAction( 'admin_init', 'composerRedirect' );
          $this->addAction( 'admin_init', 'registerCss' );
          $this->addAction( 'admin_init', 'registerJavascript' );
          $this->addAction( 'admin_print_scripts-post.php', 'editScreen_js' );
          $this->addAction( 'admin_print_scripts-post-new.php', 'editScreen_js' );
          // Upgrade message in plugins list.
          $plugin_file_name = 'js_composer/js_composer.php';
        
    }
    /*
     * Set up theme filters and actions
     *
     */
    public function setUpTheme() {
        $this->setUpPlugin();
		    }


    public function jsForceSend($args) {
        $args['send'] = true;
        return $args;
    }

   

    public function editScreen_js() {

        if(in_array(get_post_type(), $this->composer->getPostTypes())) {
			global $brad_data;
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'wp-color-picker' );
            wp_enqueue_style('ui-custom-theme');
            wp_enqueue_style('isotope-css');
			wp_enqueue_style('icon-picker');
			wp_enqueue_style('icons-css');
			wp_enqueue_style('ss-icons-css');
			
			if(!empty($brad_data['custom_iconfont']['name'])){
		        wp_enqueue_style( $brad_data['custom_iconfont']['name'] , $brad_data['custom_iconfont']['css-url'] , false, null, '' );
		    }
			
			
            wp_enqueue_style("brad-framework");
            wp_enqueue_script('jquery-ui-tabs');
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_script('jquery-ui-droppable');
            wp_enqueue_script('jquery-ui-draggable');
            wp_enqueue_script('jquery-ui-accordion');
            wp_enqueue_script('jquery-ui-autocomplete');


            //MMM wp_enqueue_script('bootstrap-js');
            wp_enqueue_script('isotope');
            wp_enqueue_script('wpb_bootstrap_modals_js');
            wp_enqueue_script('wpb_scrollTo_js');
            wp_enqueue_script('wpb_php_js');
            // js composer js app {{
            // wpb_js_composer_js_sortable
            wp_enqueue_script('wpb_js_composer_js_sortable');
            wp_enqueue_script('wpb_json-js');


            wp_enqueue_script('wpb_js_composer_js_tools');
            wp_enqueue_script('wpb_js_composer_js_storage');
            wp_enqueue_script('wpb_js_composer_js_models');
            wp_enqueue_script('wpb_js_composer_js_view');
            wp_enqueue_script('wpb_js_composer_js_custom_views');
            wp_enqueue_script('wpb_js_composer_js_backbone');
            wp_enqueue_script('wpb_jscomposer_composer_js');
            wp_enqueue_script('wpb_jscomposer_shortcode_js');
            wp_enqueue_script('wpb_jscomposer_modal_js');
            wp_enqueue_script('wpb_jscomposer_templates_js');
            wp_enqueue_script('wpb_jscomposer_stage_js');
            wp_enqueue_script('wpb_jscomposer_layout_js');
            wp_enqueue_script('wpb_jscomposer_row_js');
            wp_enqueue_script('wpb_jscomposer_media_editor_js');
            wp_enqueue_script('wpb_js_composer_js');

        }
    }

    public function registerJavascript() {
        wp_register_script('isotope', $this->composer->assetURL( 'lib/isotope/jquery.isotope.min.js' ), array( 'jquery' ), WPB_VC_VERSION, true);
        wp_register_script('wpb_bootstrap_modals_js', $this->composer->assetURL( 'lib/bootstrap_modals/js/bootstrap.min.js' ), array('jquery'), WPB_VC_VERSION, true);
        wp_register_script('wpb_scrollTo_js', $this->composer->assetURL( 'lib/scrollTo/jquery.scrollTo.min.js' ), array('jquery'), WPB_VC_VERSION, true);
        wp_register_script('wpb_php_js', $this->composer->assetURL( 'lib/php.default/php.default.min.js' ), array('jquery'), WPB_VC_VERSION, true);
		
        wp_register_script('wpb_json-js', $this->composer->assetURL( 'lib/json-js/json2.js' ), false, WPB_VC_VERSION, true);

        wp_register_script('wpb_js_composer_js_tools', $this->composer->assetURL( 'js/backend/composer-tools.js' ), array('jquery', 'backbone', 'wpb_json-js'), WPB_VC_VERSION, true);
        wp_register_script('wpb_js_composer_js_atts', $this->composer->assetURL( 'js/backend/composer-atts.js' ), array('wpb_js_composer_js_tools'), WPB_VC_VERSION, true);
        wp_register_script('wpb_js_composer_js_storage', $this->composer->assetURL( 'js/backend/composer-storage.js' ), array('wpb_js_composer_js_atts'), WPB_VC_VERSION, true);
        wp_register_script('wpb_js_composer_js_models', $this->composer->assetURL( 'js/backend/composer-models.js' ), array('wpb_js_composer_js_storage'), WPB_VC_VERSION, true);
        wp_register_script('wpb_js_composer_js_view', $this->composer->assetURL( 'js/backend/composer-view.js' ), array('wpb_js_composer_js_models'), WPB_VC_VERSION, true);
        wp_register_script('wpb_js_composer_js_custom_views', $this->composer->assetURL( 'js/backend/composer-custom-views.js' ), array('wpb_js_composer_js_view'), WPB_VC_VERSION, true);
        wp_register_script('wpb_jscomposer_media_editor_js', $this->composer->assetURL( 'js/backend/media-editor.js' ), array('wpb_js_composer_js_view'), WPB_VC_VERSION, true);

        wp_localize_script( 'wpb_js_composer_js_view', 'i18nLocale', array(
            'add_remove_picture' => __( 'Add/remove picture', "brad-framework" ),
            'finish_adding_text' => __( 'Finish Adding Images', "brad-framework" ),
            'add_image' => __( 'Add Image', "brad-framework" ),
            'add_images' => __( 'Add Images', "brad-framework" ),
            'main_button_title' => __( 'Brad page builder', "brad-framework" ),
            'main_button_title_revert' => __( 'Classic editor', "brad-framework" ),
            'please_enter_templates_name' => __('Please enter templates name', "brad-framework"),
            'confirm_deleting_template' => __('Confirm deleting "{template_name}" template, press Cancel to leave. This action cannot be undone.', "brad-framework"),
            'press_ok_to_delete_section' => __('Press OK to delete this element, Cancel to leave', "brad-framework"),
			'one_field_is_required' => __('At least One Element is Required', "brad-framework"),
            'drag_drop_me_in_column' => __('Drag and drop me in the column', "brad-framework"),
            'press_ok_to_delete_tab' => __('Press OK to delete "{tab_name}" tab, Cancel to leave', "brad-framework"),
            'slide' => __('Slide', "brad-framework"),
            'tab' => __('Tab', "brad-framework"),
			'quote' => __('Quote', "brad-framework"),
            'section' => __('Section', "brad-framework"),
            'please_enter_new_tab_title' => __('Please enter new tab title', "brad-framework"),
            'press_ok_delete_section' => __('Press OK to delete "{tab_name}" section, Cancel to leave', "brad-framework"),
            'section_default_title' => __('Section', "brad-framework"),
            'please_enter_section_title' => __('Please enter new section title', "brad-framework"),
            'error_please_try_again' => __('Error. Please try again.', "brad-framework"),
            'if_close_data_lost' => __('If you close this window all shortcode settings will be lost. Close this window?', "brad-framework"),
            'header_select_element_type' => __('Select element type', "brad-framework"),
            'header_media_gallery' => __('Media gallery', "brad-framework"),
            'header_element_settings' => __('Element settings', "brad-framework"),
            'add_tab' => __('Add tab', "brad-framework"),
            'are_you_sure_convert_to_new_version' => __('Are you sure you want to convert to new version?', "brad-framework"),
            'loading' => __('Loading...', "brad-framework"),
            // Media editor
            'set_image' => __('Set Image', "brad-framework"),
            'are_you_sure_reset_css_classes' => __('Are you sure taht you want to remove all your data?', "brad-framework"),
            'loop_frame_title' => __('Loop settings','brad-framework'),
            'enter_custom_layout' => __('Enter custom layout for your row:', "brad-framework"),
            'wrong_cells_layout' => __('Wrong row layout format! Example: 1/2 + 1/2 or span6 + span6.', "brad-framework"),
        ) );

      
    }

    public function registerCss() {
        //MMM wp_register_style( 'bootstrap', $this->composer->assetURL( 'bootstrap/css/bootstrap.css' ), false, WPB_VC_VERSION, false );
        wp_register_style( 'bootstrap_modals', $this->composer->assetURL( 'lib/bootstrap_modals/css/bootstrap.modals.css' ), false, WPB_VC_VERSION, false );
        wp_register_style( 'ui-custom-theme', $this->composer->assetURL( 'css/ui-custom-theme/jquery-ui-' . WPB_JQUERY_UI_VERSION . '.custom.css' ), false, WPB_VC_VERSION, false );
        wp_register_style( 'isotope-css', $this->composer->assetURL( 'css/isotope.css' ), false, WPB_VC_VERSION, 'screen' );
	    wp_enqueue_style( 'icon-picker', get_template_directory_uri().'/framework/css/icon-picker.css', false, '1.0', 'all' );
		wp_register_style( 'icons-css', get_template_directory_uri().'/css/icons.css' , false, '1.0', 'all' );
		wp_register_style( 'ss-icons-css', get_template_directory_uri().'/css/ss-icons.css', false, '1.0', 'all' );
        wp_register_style( "brad-framework", $this->composer->assetURL( 'css/js_composer.css' ), array('isotope-css','bootstrap_modals'), WPB_VC_VERSION, false );
		
        wp_register_style( 'js_composer_settings', $this->composer->assetURL( 'css/js_composer_settings.css' ), false, WPB_VC_VERSION, false );
      
    }
    /* Call to generate main template editor */

    public function jsComposerEditPage() {
        $pt_array = $this->composer->getPostTypes();
        foreach ($pt_array as $pt) {
            add_meta_box( 'wpb_visual_composer', __('Brad page builder', "brad-framework"), Array($this->composer->getLayout(), 'output'), $pt, 'normal', 'high');
        }
    }


    public function composerRedirect() {
        if ( get_option('wpb_js_composer_do_activation_redirect', false) ) {
            delete_option('wpb_js_composer_do_activation_redirect');
            wp_redirect(network_admin_url('options-general.php?page=wpb_vc_settings&build_css=1'));
        }
    }
}
}


