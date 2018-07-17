<?php
/**
 * Contact Form widget
 *
 * @package magplus
 */

class magplus_WP_Custom_Ads_Widget extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array('classname' => 'widget_ads_entries', 'description' => __( "Add Custom ads", 'magplus-pro-addons' ) );
        parent::__construct('custom-ads', __( '- magplus: Custom Ads', 'magplus-pro-addons' ), $widget_ops);

        $this-> alt_option_name = 'widget_ads_entries';

        add_action( 'save_post',    array(&$this, 'flush_widget_cache') );
        add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
        add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
    }

    function widget($args, $instance)
    {
        global $post;

        $cache = wp_cache_get('widget_ads_entries', 'widget');

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
        $link  = $instance['link'];
        $link  = !empty($link) ? $link:'#';

        if ($title):
            echo $before_title.esc_html($title).$after_title;
        endif; ?>
        <?php if(isset($instance['url']) && isset($instance['link'])): ?>
        <a class="simple-image custom-hover" href="<?php echo esc_url($link); ?>">
          <img class="img-responsive img-border" src="<?php echo esc_url($instance['url']); ?>" height="255" width="392" alt="">
        </a>
        <?php endif; ?> 

        <?php echo $after_widget;
        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_ads_entries', $cache, 'widget');
    }

    function update( $new_instance, $old_instance )
    {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['url'] = $new_instance['url'];
      $instance['link'] = $new_instance['link'];
      $this->flush_widget_cache();

      $alloptions = wp_cache_get( 'alloptions', 'options' );
      if ( isset($alloptions['widget_ads_entries']) )
      {
          delete_option('widget_ads_entries');
      }
      return $instance;
    }

    function flush_widget_cache()
    {
      wp_cache_delete('widget_ads_entries', 'widget');
    }

    function form( $instance )
    {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $url   = isset($instance['url']) ? $instance['url'] : '';
        $link   = isset($instance['link']) ? $instance['link'] : '#';
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'magplus-pro-addons' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'url' )); ?>"><?php esc_html_e('Image URL:','magplus-pro-addons'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'url' )); ?>" type="text" value="<?php echo esc_attr($url); ?>" /></label></p>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'link' )); ?>"><?php esc_html_e('Link URL:','magplus-pro-addons'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'link' )); ?>" type="text" value="<?php echo esc_attr($link); ?>" /></label></p>
        <?php
    }
}
