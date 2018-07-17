<?php
/*
Plugin Name: MagPlus Addons
Plugin URI: http://www.themebubble.com
Description: A part of magplus theme.
Version: 1.5
Author: relstudiosnx
Author URI: http://www.themebubble.com
Text Domain: magplus-pro-addons
*/

defined('RS_ROOT') or define('RS_ROOT', plugin_dir_path( __FILE__ ));

if(!class_exists('RS_Shortcode')) {

  class RS_Shortcode {

    private $assets_css;
    private $assets_js;
    private $theme_dir;

    public function __construct() {
      add_action('init', array($this,'rs_init'),50);
      add_action('setup_theme', array($this,'rs_load_custom_post_types'),40);
      add_action('widgets_init', array($this,'rs_load_widgets'),50);
    }

    public static function activate() {
      flush_rewrite_rules();
    }

    public static function deactivate() {
      flush_rewrite_rules();
    }

    public function rs_init() {

      if (!defined('MAGPLUS_THEME_ACTIVATED') || MAGPLUS_THEME_ACTIVATED !== true) {
         add_action( 'admin_notices', array($this,'rs_activate_theme_notice') );
      } else {
        $this->assets_css = plugins_url('/composer/assets/css', __FILE__);
        $this->assets_js  = plugins_url('/composer/assets/js', __FILE__);
        $this->theme_dir  = get_template_directory();
        add_action('admin_print_scripts-post.php',   array($this, 'rs_load_vc_scripts'), 99);
        add_action('admin_print_scripts-post-new.php', array($this, 'rs_load_vc_scripts'), 99);
        add_action('admin_init', array($this, 'rs_disable_activation_key'));
        add_action('vc_load_default_params', array($this, 'rs_reload_vc_js'));
        if(class_exists('Vc_Manager')) {
          $this->rs_vc_load_shortcodes();
          $this->rs_init_vc();
          $this->rs_vc_integration();
          $this->rs_vc_templates();
        }
      }
    }

    function rs_activate_theme_notice() { ?>
      <div class="updated">
        <p><strong><?php esc_html_e('Please activate the Magplus theme to use Magplus Addons plugin.', 'magplus-pro-addons'); ?></strong></p>
        <?php
        $screen = get_current_screen();
        if ($screen -> base != 'themes'): ?>
          <p><a href="<?php echo esc_url(admin_url('themes.php')); ?>"><?php esc_html_e('Activate theme', 'magplus-pro-addons'); ?></a></p>
        <?php endif; ?>
      </div>
    <?php }

    public function rs_init_vc() {
      global $vc_manager;
      $list = array( 'page', 'post', 'special-content', 'social-site');
      $vc_manager->setEditorDefaultPostTypes( $list );
    }

    public function rs_load_custom_post_types() {
      require_once(RS_ROOT .'/custom-posts/social-site.php');
      require_once(RS_ROOT .'/custom-posts/special-content.php');
    }

    public function rs_load_widgets() {
      if (!defined('MAGPLUS_THEME_ACTIVATED') || MAGPLUS_THEME_ACTIVATED !== true) {
        return false;
      }
      $widgets = array(
        'WP_Latest_Posts_Widget',
        'WP_Social_Icons_Widget',
        'WP_Contact_Form_Cpcp7_Widget',
        'WP_Newsletter_Widget',
        'WP_Two_Column_Post_Widget',
        'WP_Custom_Ads_Widget',
        'WP_Posts_Tabbed_Widget',
        'WP_Post_Gallery_Widget',
        'WP_Social_Follow_Widget',
        'WP_Recent_Posts_Widget',
        'WP_Category_Block_Widget',
        'WP_About_Block_Widget'
      );
      foreach ($widgets as $widget) {
        if (file_exists(RS_ROOT .'/widgets/'.$widget.'.class.php')) {
          require_once(RS_ROOT .'/widgets/'.$widget.'.class.php');
          register_widget('magplus_'.$widget);
        }
      }
    }

    public function rs_vc_load_shortcodes() {
      require_once(RS_ROOT. '/' . 'shortcodes/rs_section_heading.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_featured_blog.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_hand_picked_blog.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_post_grid_series.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_about_us.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_weekly_7_blog.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_weekly_5_blog.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_blog_masonry.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_wp_post_gallery_video.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_blockquote.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_video_block.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_image_block.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_gallery_showcase.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_sound_cloud_embed.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_youtube_video_playlist.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_gif_showcase.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_space.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_recent_news.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_category_block.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_newsletter.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_tabs.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_post_movie.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_special_text.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_progress_bar_rating.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_post_grid.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_post_video_playlist.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_custom_ads.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_post_card.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_slider_content.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_divider.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_button.php');

      require_once(RS_ROOT. '/' . 'shortcodes/vc_column_text.php');
    }

    public function rs_vc_templates() {
      require_once( RS_ROOT .'/' .'composer/templates.php' );
      require_once( RS_ROOT .'/' .'composer/class.vc_template_panel.php' );
      $rs_vc_templates = new RS_VC_Templates();
      return $rs_vc_templates->init();
    }

    public function rs_vc_integration() {
      require_once( RS_ROOT .'/' .'composer/map.php' );
    }

    public function rs_load_vc_scripts() {
      wp_enqueue_style('rs-vc-custom', $this->assets_css. '/vc-style.css');
      wp_enqueue_style('rs-font-icon', $this->assets_css. '/font-icon.css');
      wp_enqueue_style('rs-chosen',    $this->assets_css. '/chosen.css');
      wp_enqueue_script('vc-script',   $this->assets_js . '/vc-script.js' ,      array('jquery'), '1.0.0', true);
      wp_enqueue_script('vc-chosen',   $this->assets_js . '/jquery.chosen.js' ,  array('jquery'), '1.0.0', true);
    }

    public function rs_disable_activation_key() {
      if(is_admin()) {
        setcookie('vchideactivationmsg', '1', strtotime('+3 years'), '/');
        setcookie('vchideactivationmsg_vc11', (defined('WPB_VC_VERSION') ? WPB_VC_VERSION : '1'), strtotime('+3 years'), '/');
      }
    }

    public function rs_reload_vc_js() {
      echo '<script type="text/javascript">(function($){ $(document).ready( function(){ $.reloadPlugins(); }); })(jQuery);</script>';
    }
  }
  new RS_Shortcode;
  register_activation_hook( __FILE__, array( 'RS_Shortcode', 'activate' ) );
  register_deactivation_hook( __FILE__, array( 'RS_Shortcode', 'deactivate' ) );
}
