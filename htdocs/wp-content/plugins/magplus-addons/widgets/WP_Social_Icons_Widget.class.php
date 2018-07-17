<?php
/**
 * Follow Us
 *
 * @package magplus-addonss
 */

class magplus_WP_Social_Icons_Widget extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array('classname' => 'widget_social_media', 'description' => esc_html__( "Displays list of social icons", 'magplus-addonss' ) );
        parent::__construct('social-media', esc_html__( '- magplus: Social Icons', 'magplus-addonss' ), $widget_ops);

        $this-> alt_option_name = 'widget_social_icons';

        add_action( 'save_post', array(&$this, 'flush_widget_cache') );
        add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
        add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
    }

    function widget($args, $instance)
    {
      global $post;

      $cache = wp_cache_get('widget_social_icons', 'widget');

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
      <ul class="tt-f-social">
       <?php magplus_social_links('%s', $instance['category']); ?>
      </ul>
      <?php echo $after_widget;
        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_social_icons', $cache, 'widget');
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title']    = strip_tags($new_instance['title']);
        $instance['style']    = intval($new_instance['style']);
        $instance['category'] = strip_tags($new_instance['category']);
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_social_icons']) )
        {
          delete_option('widget_social_icons');
        }
        return $instance;
    }

    function flush_widget_cache()
    {
      wp_cache_delete('widget_social_icons', 'widget');
    }

    function form( $instance )
    {
      $title    = isset($instance['title']) ? $instance['title'] : '';
      $category = isset($instance['category']) ? $instance['category'] : '';
    ?>
      <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:', 'magplus-addonss' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

      <p><label for="<?php echo esc_attr($this->get_field_id( 'category' )); ?>"><?php esc_html_e( 'Category:', 'magplus-addonss' ); ?></label>
      <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'category' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'category' )); ?>">
        <option value=""><?php esc_html_e('Choose', 'magplus-addonss'); ?></option>
        <?php
        $categories = magplus_get_terms_assoc('social-site-category');
        if (is_array($categories)):
          foreach ($categories as $key => $item): ?>
            <option value="<?php echo esc_attr($key); ?>" <?php selected( $key, $category ); ?>><?php echo esc_html($item); ?></option>
          <?php endforeach;
        endif; ?>
    </select>
    <?php
    }
}
