<?php
/**
 * Gallery Post
 *
 * @package magplus
 */
class magplus_WP_Post_Gallery_Widget extends WP_Widget
{
  function __construct()
  {
    $widget_ops = array('classname' => 'widget_post_gallery_entries', 'description' => esc_html__( 'Post Gallery/Video Post', 'magplus-pro-addons' ) );
    parent::__construct('gallery-posts', esc_html__( '- magplus: Post Gallery/Video', 'magplus-pro-addons' ), $widget_ops);

    $this-> alt_option_name = 'widget_post_gallery_entries';

  }

  function widget($args, $instance)
  {
    global $post;

    $cache = wp_cache_get('widget_post_gallery_entries', 'widget');

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

    //ob_start();
    extract($args);
    echo $before_widget;
    $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__( 'Post Gallery', 'magplus-pro-addons' ) : $instance['title'], $instance, $this->id_base);
    $category = $instance['category'];


    // query
    $args = array(
      'orderby'        => 'ID',
      'posts_per_page' => 1,
      'post__in'       => explode(',', $category),
    );

    $the_query = new WP_Query($args); ?>


    <div class="tt-border-block">
      <div class="tt-title-block type-2">
        <h3 class="tt-title-text"><?php echo esc_html($title); ?></h3>
      </div>
      <div class="empty-space marg-lg-b15"></div>

      <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
      <div <?php post_class('tt-post type-4'); ?>>
        <?php magplus_post_format('magplus-medium-hor', 'img-responsive'); ?>
        <div class="tt-post-info">
          <a class="tt-post-title c-h5" href="<?php echo esc_url(get_the_permalink()); ?>"><small><?php the_title(); ?></small></a>
          <?php magplus_blog_author_date(); ?>
        </div>
      </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>

    <?php

    echo $after_widget;
    //$cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_post_gallery_entries', $cache, 'widget');
  }

  function update( $new_instance, $old_instance )
  {
    $instance = $old_instance;
    $instance['title']  = strip_tags($new_instance['title']);
    $instance['category'] = (int) $new_instance['category'];

    $alloptions = wp_cache_get( 'alloptions', 'options' );
    if ( isset($alloptions['widget_post_gallery_entries']) )
    {
      delete_option('widget_post_gallery_entries');
    }
    return $instance;
  }

  function form( $instance )
  {
    $title = isset($instance['title']) ? $instance['title'] : '';
    $category = isset($instance['category']) ? $instance['category'] : '';
    ?>
    <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'magplus-pro-addons' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <p><label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php _e( 'Post ID ( Seperated by comma ):', 'magplus-pro-addons' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('category')); ?>" name="<?php echo esc_attr($this->get_field_name('category')); ?>" type="text" value="<?php echo esc_attr($category); ?>" /></p>
    <?php
  }
}
