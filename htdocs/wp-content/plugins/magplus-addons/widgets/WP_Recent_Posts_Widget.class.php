<?php
/**
 * Recent posts widget
 *
 * @package magplus
 */
class magplus_WP_Recent_Posts_Widget extends WP_Widget
{
  function __construct()
  {
    $widget_ops = array('classname' => 'widget_recent_posts_entries', 'description' => esc_html__( 'Recent Posts', 'magplus-pro-addons' ) );
    parent::__construct('recent-posts', esc_html__( '- magplus: Recent Posts', 'magplus-pro-addons' ), $widget_ops);

    $this-> alt_option_name = 'widget_recent_posts_entries';

  }

  function widget($args, $instance)
  {
    global $post;

    $cache = wp_cache_get('widget_recent_posts_entries', 'widget');

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
    $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__( 'Recent Posts', 'magplus-pro-addons' ) : $instance['title'], $instance, $this->id_base);
    if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
      $number = 4;
    }
    
    ?>
    <?php echo $before_title.esc_html($title).$after_title;  ?>
    <ul class="tt-post-list dark">
      <?php echo magplus_recent_post_query('date', $number); ?>                                                    
    </ul>

  <?php
    echo $after_widget;
    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_recent_posts_entries', $cache, 'widget');
  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['number'] = (int) $new_instance['number'];

    $alloptions = wp_cache_get( 'alloptions', 'options' );
    if ( isset($alloptions['widget_recent_posts_entries']) )
    {
      delete_option('widget_recent_posts_entries');
    }
    return $instance;
  }

  function form( $instance ) {
    $title = isset($instance['title']) ? $instance['title'] : '';
    $number = isset($instance['number']) ? $instance['number'] : 4;
    ?>
    <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'magplus-pro-addons' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e( 'Number of posts to show:', 'magplus-pro-addons' ); ?></label>
    <input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
    <?php
  }
}


function magplus_recent_post_query($order_by, $post_per_page, $meta_key = '') {

  global $post;
  $latest = get_posts(
    array(
      'suppress_filters'    => false,
      'ignore_sticky_posts' => 1,
      'orderby'             => $order_by,
      'order'               => 'desc',
      'meta_key'            => $meta_key,
      'numberposts'         => $post_per_page,
      'meta_query'          => array(array('key' => '_thumbnail_id')), 
    )
  );

  ob_start();

  foreach($latest as $post) :
    setup_postdata($post);
  ?>

  <li>
    <div <?php post_class('tt-post type-7 dark clearfix'); ?>>
      <?php magplus_post_format('magplus-small-alt', 'img-responsive', false); ?>
      <div class="tt-post-info">
        <?php magplus_blog_title('c-h6'); ?>
        <?php magplus_blog_category(); ?>
      </div>
    </div>                                            
  </li>

  <?php endforeach;
  wp_reset_postdata();
  $contents = ob_get_contents();
  ob_end_clean();
  return $contents;

}