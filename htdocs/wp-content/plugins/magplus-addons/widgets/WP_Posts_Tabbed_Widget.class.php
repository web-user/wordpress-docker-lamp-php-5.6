<?php
/**
 * Latest posts widget
 *
 * @package magplus
 */
class magplus_WP_Posts_Tabbed_Widget extends WP_Widget
{
  function __construct()
  {
    $widget_ops = array('classname' => 'widget_posts_tabbed_entries', 'description' => esc_html__( 'Tabbed Post', 'magplus-pro-addons' ) );
    parent::__construct('tabbed-posts', esc_html__( '- magplus: Tabbed Posts', 'magplus-pro-addons' ), $widget_ops);

    $this-> alt_option_name = 'widget_posts_tabbed_entries';

  }

  function widget($args, $instance)
  {
    global $post;

    $cache = wp_cache_get('widget_posts_tabbed_entries', 'widget');

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
    if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
      $number = 4;
    }

    $trending_title = $instance['title_trending_as'];
    $trending_title = (!empty($trending_title) && isset($trending_title)) ? esc_html($trending_title):esc_html__('Trending', 'magplus-pro-addons');
    $popular_title  = $instance['title_popular_as'];
    $popular_title  = (!empty($popular_title) && isset($popular_title)) ? esc_html($popular_title):esc_html__('Popular', 'magplus-pro-addons');

    $trending_cats  = (!empty($instance['trending_cats'])) ? $instance['trending_cats']:'';
    $popular_cats   = (!empty($instance['popular_cats'])) ? $instance['popular_cats']:'';

    if(empty($popular_cats)) {
      $orderby = 'meta_value_num';
      $meta_key = 'post_views_count';
    }

    ?>


    <div class="tt-tab-wrapper type-1 clearfix">
      <div class="tt-tab-nav-wrapper">
        <div  class="tt-nav-tab">
          <div class="tt-nav-tab-item active"><i class="material-icons">trending_up</i><?php echo $trending_title; ?></div>
          <div class="tt-nav-tab-item"><i class="material-icons">whatshot</i><?php echo $popular_title; ?></div>
        </div>
      </div>
      <div class="tt-tabs-content clearfix">
        <div class="tt-tab-info active">
          <ul class="tt-post-list">
            <?php echo magplus_post_query('date', $number, '', $trending_cats); ?>
          </ul>
          <a class="c-btn type-2" href="<?php echo esc_url(home_url('/' )); ?>"><?php echo esc_html__('Show More', 'magplus-pro-addons'); ?></a>
        </div>
        <div class="tt-tab-info">
          <ul class="tt-post-list">
            <?php echo magplus_post_query($orderby, $number, $meta_key, $popular_cats); ?>
          </ul>
          <a class="c-btn type-2" href="<?php echo esc_url(home_url('/' )); ?>"><?php echo esc_html__('Show More', 'magplus-pro-addons'); ?></a>
        </div>
      </div>
    </div>

  <?php
    echo $after_widget;
    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_posts_tabbed_entries', $cache, 'widget');
  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title']             = strip_tags($new_instance['title']);
    $instance['title_trending_as'] = strip_tags($new_instance['title_trending_as']);
    $instance['trending_cats']     = strip_tags($new_instance['trending_cats']);
    $instance['title_popular_as']  = strip_tags($new_instance['title_popular_as']);
    $instance['popular_cats']      = strip_tags($new_instance['popular_cats']);
    $instance['number'] = (int) $new_instance['number'];

    $alloptions = wp_cache_get( 'alloptions', 'options' );
    if ( isset($alloptions['widget_posts_tabbed_entries']) )
    {
      delete_option('widget_posts_tabbed_entries');
    }
    return $instance;
  }

  function form( $instance ) {
    $title             = isset($instance['title']) ? $instance['title'] : '';
    $title_trending_as = isset($instance['title_trending_as']) ? $instance['title_trending_as'] : '';
    $trending_cats     = isset($instance['trending_cats']) ? $instance['trending_cats'] : '';
    $title_popular_as  = isset($instance['title_popular_as']) ? $instance['title_popular_as'] : '';
    $popular_cats      = isset($instance['popular_cats']) ? $instance['popular_cats'] : '';
    $number            = isset($instance['number']) ? $instance['number'] : 4;
    ?>
    <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'magplus-pro-addons' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <p><label for="<?php echo esc_attr($this->get_field_id('title_trending_as')); ?>"><?php _e( 'Title \'Trending\' As:', 'magplus-pro-addons' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title_trending_as')); ?>" name="<?php echo esc_attr($this->get_field_name('title_trending_as')); ?>" type="text" value="<?php echo esc_attr($title_trending_as); ?>" /></p>

    <p><label for="<?php echo esc_attr($this->get_field_id('trending_cats')); ?>"><?php _e( 'Category ID:', 'magplus-pro-addons' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('trending_cats')); ?>" name="<?php echo esc_attr($this->get_field_name('trending_cats')); ?>" type="text" value="<?php echo esc_attr($trending_cats); ?>" /><span class="description" style="padding:0;"><em>Add Catgory ID sepertaed with comma, if empty default will be used as trending.</em></span></p>

    <p><label for="<?php echo esc_attr($this->get_field_id('title_popular_as')); ?>"><?php _e( 'Title \'Popular\' As:', 'magplus-pro-addons' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title_popular_as')); ?>" name="<?php echo esc_attr($this->get_field_name('title_popular_as')); ?>" type="text" value="<?php echo esc_attr($title_popular_as); ?>" /></p>

    <p><label for="<?php echo esc_attr($this->get_field_id('popular_cats')); ?>"><?php _e( 'Category ID:', 'magplus-pro-addons' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('popular_cats')); ?>" name="<?php echo esc_attr($this->get_field_name('popular_cats')); ?>" type="text" value="<?php echo esc_attr($popular_cats); ?>" /><span class="description" style="padding:0;"><em>Add Catgory ID sepertaed with comma, if empty default will be used as popular.</em></span></p>

    <p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e( 'Number of posts to show:', 'magplus-pro-addons' ); ?></label>
    <input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
    <?php
  }
}


function magplus_post_query($order_by = 'date', $post_per_page, $meta_key = '', $category = '') {

  global $post;
  $args = array(
    'suppress_filters'    => false,
    'ignore_sticky_posts' => 1,
    'orderby'             => $order_by,
    'order'               => 'desc',
    'numberposts'         => $post_per_page,
    'meta_query'          => array(array('key' => '_thumbnail_id')),
  );

  if(!empty($category)) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'category',
        'field'    => 'ids',
        'terms'    => explode( ',', $category )
      )
    );
  }

  if(!empty($meta_key)) {
    $args['meta_key'] = $meta_key;
  }

  $latest = get_posts($args);

  ob_start();

  foreach($latest as $post) :
    setup_postdata($post);
  ?>

  <li>
    <div <?php post_class('tt-post type-7 clearfix'); ?>>
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
