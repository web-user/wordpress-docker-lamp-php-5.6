<?php
/**
 * Contact Form widget
 *
 * @package magplus
 */

class magplus_WP_About_Block_Widget extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array('classname' => 'widget_about_block_entries', 'description' => __( "Add About Block", 'magplus-pro-addons' ) );
        parent::__construct('about-block', __( '- magplus: About Block', 'magplus-pro-addons' ), $widget_ops);

        $this-> alt_option_name = 'widget_about_block_entries';

        add_action( 'save_post',    array(&$this, 'flush_widget_cache') );
        add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
        add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
    }

    function widget($args, $instance)
    {
        global $post;

        $cache = wp_cache_get('widget_about_block_entries', 'widget');

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

        $height = ( isset($instance['height']) ) ? 'height:'.esc_html($instance['height']).';':'';

        ?>

        <div class="tt-border-block about-us-block style1">
          <?php if($title): ?>
          <div class="tt-title-block type-2">
          <h3 class="tt-title-text"><?php echo esc_html($title); ?></h3>
          </div>
          <div class="empty-space marg-lg-b15"></div>
          <?php endif; ?>

          <div class="tt-about">
            <?php if(isset($instance['url'])): ?>
            <div class="tt-about-block custom-hover-image">
              <a class="custom-hover bg" href="<?php echo esc_url($instance['link']); ?>" target="_blank" style="background-image:url(<?php echo esc_url($instance['url']); ?>); <?php echo esc_attr($height); ?>">
              </a>
            </div>
            <?php endif; ?>

            <div class="simple-text">
              <p><?php echo esc_html($instance['content']); ?></p>
            </div>
              <img class="img-responsive center-block" src="<?php echo esc_url($instance['signature']); ?>" height="67" width="104" alt="">
          </div>
        </div>

        <?php echo $after_widget;
        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_about_block_entries', $cache, 'widget');
    }

    function update( $new_instance, $old_instance )
    {
      $instance              = $old_instance;
      $instance['title']     = strip_tags($new_instance['title']);
      $instance['url']       = $new_instance['url'];
      $instance['content']   = $new_instance['content'];
      $instance['signature'] = $new_instance['signature'];
      $instance['height']    = $new_instance['height'];
      $instance['link']      = $new_instance['link'];
      $this->flush_widget_cache();

      $alloptions = wp_cache_get( 'alloptions', 'options' );
      if ( isset($alloptions['widget_about_block_entries']) )
      {
          delete_option('widget_about_block_entries');
      }
      return $instance;
    }

    function flush_widget_cache()
    {
      wp_cache_delete('widget_about_block_entries', 'widget');
    }

    function form( $instance )
    {
        $title     = isset($instance['title']) ? $instance['title'] : '';
        $url       = isset($instance['url']) ? $instance['url'] : '';
        $link      = isset($instance['link']) ? $instance['link'] : '#';
        $height    = isset($instance['height']) ? $instance['height'] : '';
        $content   = isset($instance['content']) ? $instance['content'] : '';
        $signature = isset($instance['signature']) ? $instance['signature'] : '';
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'magplus-pro-addons' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'url' )); ?>"><?php esc_html_e('Image URL:','magplus-pro-addons'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'url' )); ?>" type="text" value="<?php echo esc_attr($url); ?>" /></label></p>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'height' )); ?>"><?php esc_html_e('Height (optional):','magplus-pro-addons'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'height' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'height' )); ?>" type="text" value="<?php echo esc_attr($height); ?>" /></label></p>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'link' )); ?>"><?php esc_html_e('Link URL:','magplus-pro-addons'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'link' )); ?>" type="text" value="<?php echo esc_attr($link); ?>" /></label></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php _e( 'Content:', "magplus-addons" ); ?></label>
        <textarea class="widefat" rows="7" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>"><?php echo esc_textarea($content); ?></textarea></p>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'signature' )); ?>"><?php esc_html_e('Signature Image URL:','magplus-pro-addons'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'signature' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'signature' )); ?>" type="text" value="<?php echo esc_attr($signature); ?>" /></label></p>
        <?php
    }
}
