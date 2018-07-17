<?php
/**
 * Latest posts widget
 *
 * @package magplus
 */
class magplus_WP_Latest_Posts_Widget extends WP_Widget
{
  function __construct()
  {
    $widget_ops = array('classname' => 'widget_latest_posts_entries', 'description' => esc_html__( "Displays the most popular posts", 'magplus-pro-addons' ) );
    parent::__construct('latest-posts', esc_html__( '- magplus: Popular Posts', 'magplus-pro-addons' ), $widget_ops);

    $this-> alt_option_name = 'widget_latest_posts_entries';

  }

  function widget($args, $instance)
  {
    global $post;

    $cache = wp_cache_get('widget_latest_posts_entries', 'widget');

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
    $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__( 'Popular Posts', 'magplus-pro-addons' ) : $instance['title'], $instance, $this->id_base);
    if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
    {
      $number = 6;
    }

    $style = (empty($instance['style'])) ? 1:$instance['style'];
    $r = new WP_Query( apply_filters( 'widget_posts_args', array('meta_query' => array(array('key' => '_thumbnail_id')), 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_key' =>'post_views_count', 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true) ) );
    if ($r->have_posts()) :

      $post_count = ($style == 1) ? 1:$r->post_count;

    ?>
      

      <div class="tt-border-block">
        <div class="tt-title-block type-2">
            <h3 class="tt-title-text"><?php echo esc_html($title);  ?></h3>
        </div>
        <div class="empty-space marg-lg-b15"></div>

        <?php for ($i = 0; $i < $post_count; $i ++): $r -> the_post(); ?>
        <div <?php post_class('tt-post type-3'); ?>>
          <?php magplus_post_format('magplus-medium-hor', 'img-responsive'); ?>
          <div class="tt-post-info">
            <a class="tt-post-title c-h5" href="<?php echo esc_url(get_the_permalink()); ?>"><small><?php the_title(); ?></small></a>
              <?php magplus_blog_author_date(); ?>
          </div>
        </div>
        <?php echo ($style == 2) ? '<div class="marg-lg-b30"></div>':''; ?>
        <?php
          if (!$r -> have_posts()) :
            break;
          endif; ?>
        <?php endfor; ?>
        


        <?php echo ($style == 1) ?  '<div class="empty-space marg-lg-b30"></div>':''; ?>

        <?php

          $small_previews_count = $r -> post_count - 1;


          if ($r -> have_posts() && $small_previews_count > 0 && $style == 1):

            $posts_per_column = $number - 1;
        ?>

        <ul class="tt-post-list type-2">
          <?php for ($i = 0; $i < $posts_per_column; $i++):

            if (!$r -> have_posts()) :
              break;
            endif;
            $r -> the_post();
          ?>
          <li>
            <div class="tt-post type-7 clearfix">
              <?php magplus_post_format('magplus-small-alt', 'img-responsive', false); ?>
              <div class="tt-post-info">
                <?php magplus_blog_title('c-h6'); ?>
                <?php magplus_blog_author_date(false); ?>
              </div>
            </div>                                    
          </li>
          <?php endfor; ?>                          
        </ul> 
        <?php endif; ?>
      </div>

      <?php
      // Reset the global $the_post as this query will have stomped on it
      wp_reset_postdata();
    endif; //have_posts()
    echo $after_widget;
    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_latest_posts_entries', $cache, 'widget');
  }

  function update( $new_instance, $old_instance )
  {
    $instance           = $old_instance;
    $instance['title']  = strip_tags($new_instance['title']);
    $instance['number'] = (int) $new_instance['number'];
    $instance['style']  = intval($new_instance['style']);

    $alloptions = wp_cache_get( 'alloptions', 'options' );
    if ( isset($alloptions['widget_latest_posts_entries']) )
    {
      delete_option('widget_latest_posts_entries');
    }
    return $instance;
  }

  function form( $instance )
  {
    $title = isset($instance['title']) ? $instance['title'] : '';
    $number = isset($instance['number']) ? $instance['number'] : 5;
    $style = isset($instance['style']) ? $instance['style'] : '1';
    ?>
    <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'magplus-pro-addons' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'style' )); ?>"><?php esc_html_e( 'Style:', 'splendid-addons' ); ?></label>
    <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'style' )); ?>">
      <option value="1" <?php selected( '1', $style ); ?>>Style 1</option>
      <option value="2" <?php selected( '2', $style ); ?>>Style 2</option>    
    </select></p>

    <p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e( 'Number of posts to show:', 'magplus-pro-addons' ); ?></label>
    <input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
    <?php
  }
}
