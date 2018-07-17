<?php
/**
 * Contact Form widget
 *
 * @package magplus
 */

class magplus_WP_Social_Follow_Widget extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array('classname' => 'widget_social_follow_entries', 'description' => __( "Add Social Followers Button", 'magplus-pro-addons' ) );
        parent::__construct('social-follow', __( '- magplus: Social Follow', 'magplus-pro-addons' ), $widget_ops);

        $this-> alt_option_name = 'widget_social_follow_entries';

        add_action( 'save_post',    array(&$this, 'flush_widget_cache') );
        add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
        add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
    }

    function widget($args, $instance)
    {
        global $post;

        $cache = wp_cache_get('widget_social_follow_entries', 'widget');

        if ( !is_array($cache) )
        {
            $cache = array();
        }
        if ( ! isset( $args['widget_id'] ) )
        {
          $args['widget_id'] = $this->id;
        }

        if ( isset( $cache[ $args['widget_id'] ] ) )
        {
          echo $cache[ $args['widget_id'] ];
          return;
        }

        ob_start();
        extract($args);
        echo $before_widget;

        $title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

        if ($title):
            echo $before_title.esc_html($title).$after_title;
        endif; ?>

        <?php if(isset($instance['fb_link']) && !empty($instance['fb_link'])): ?>
        <a class="c-btn type-1 size-3 style-2 color-3" target="_blank" href="<?php echo esc_url($instance['fb_link']); ?>">
            <span><i class="fa fa-facebook-official" aria-hidden="true"></i><?php echo esc_html__('join followers', 'magplus-pro-addons'); ?></span>
        </a>
        <div class="empty-space marg-lg-b10"></div>
        <?php endif; ?>
        <?php if(isset($instance['twitter_link']) && !empty($instance['twitter_link'])): ?>
        <a class="c-btn type-1 size-3 style-2 color-4" target="_blank" href="<?php echo esc_url($instance['twitter_link']); ?>">
          <span><i class="fa fa-twitter" aria-hidden="true"></i><?php echo esc_html__('join followers', 'magplus-pro-addons'); ?></span>
        </a>
        <?php endif; ?>

        <?php if(isset($instance['insta_link']) && !empty($instance['insta_link'])): ?>
        <div class="empty-space marg-lg-b10"></div>
        <a class="c-btn type-1 size-3 style-2 color-5" target="_blank" href="<?php echo esc_url($instance['insta_link']); ?>">
            <span><i class="fa fa-instagram" aria-hidden="true"></i><?php echo esc_html__('join followers', 'magplus-pro-addons'); ?></span>
        </a>

        <?php endif; ?>

        <?php echo $after_widget;
        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_social_follow_entries', $cache, 'widget');
    }

    function update( $new_instance, $old_instance )
    {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['fb_link'] = $new_instance['fb_link'];
      $instance['twitter_link'] = $new_instance['twitter_link'];
      $instance['insta_link'] = $new_instance['insta_link'];
      $this->flush_widget_cache();

      $alloptions = wp_cache_get( 'alloptions', 'options' );
      if ( isset($alloptions['widget_social_follow_entries']) )
      {
          delete_option('widget_social_follow_entries');
      }
      return $instance;
    }

    function flush_widget_cache()
    {
      wp_cache_delete('widget_social_follow_entries', 'widget');
    }

    function form( $instance )
    {
        $title        = isset($instance['title']) ? $instance['title'] : '';
        $fb_link      = isset($instance['fb_link']) ? $instance['fb_link'] : '';
        $twitter_link = isset($instance['twitter_link']) ? $instance['twitter_link'] : '';
        $insta_link   = isset($instance['insta_link']) ? $instance['insta_link'] : '';
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'magplus-pro-addons' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'fb_link' )); ?>"><?php esc_html_e('Facebook Link URL:','magplus-pro-addons'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'fb_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'fb_link' )); ?>" type="text" value="<?php echo esc_attr($fb_link); ?>" /></label></p>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'twitter_link' )); ?>"><?php esc_html_e('Twitter Link URL:','magplus-pro-addons'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'twitter_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter_link' )); ?>" type="text" value="<?php echo esc_attr($twitter_link); ?>" /></label></p>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'insta_link' )); ?>"><?php esc_html_e('Instagram Link URL:','magplus-pro-addons'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'insta_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'insta_link' )); ?>" type="text" value="<?php echo esc_attr($insta_link); ?>" /></label></p>
        <?php
    }
}
