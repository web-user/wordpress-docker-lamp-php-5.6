<?php
/**
 * Latest posts widget
 *
 * @package magplus
 */
class magplus_WP_Category_Block_Widget extends WP_Widget
{
  function __construct()
  {
    $widget_ops = array('classname' => 'widget_category_block', 'description' => esc_html__( 'Displays category in block', 'magplus-pro-addons' ) );
    parent::__construct('category-block', esc_html__( '- magplus: Category Block', 'magplus-pro-addons' ), $widget_ops);

    $this-> alt_option_name = 'widget_category_block';

  }

  function widget($args, $instance)
  {
    global $post;

    $cache = wp_cache_get('widget_category_block', 'widget');

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
    $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__( 'Category Block', 'magplus-pro-addons' ) : $instance['title'], $instance, $this->id_base);
    if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
    {
      $number = 6;
    }

    echo $before_title.esc_html($title).$after_title;

    $style     = (empty($instance['style'])) ? 1:$instance['style'];
    $category  = (!empty($instance['category'])) ? $instance['category']:'';


    $cat_args = array(
      'orderby' => 'name',
      'order'   => 'ASC',
      'include' => $category
    );

    $fcategories =   get_categories($cat_args); 


    switch ($style) {
      case 1: 
        foreach($fcategories as $fcategory):

          $post_args = array(
            'posts_per_page' => 1,
            'cat'            => $fcategory->cat_ID
          );

          $fposts = query_posts($post_args);
          while(have_posts()) : the_post(); 
            $image_url = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
            <div  class="tt-category-block custom-hover-image tt-category-block-style1">
              <div class="tt-category-block-inner bg" style="background-image:url(<?php echo esc_url($image_url); ?>);">
                <a href="<?php echo  get_category_link( $fcategory->term_id ); ?>"></a>
                <div class="tt-category-text-style1">
                  <h5 class="tt-category-title c-h5"><?php echo esc_html($fcategory->name); ?></h5>
                </div>
              </div>
            </div>
          <?php
          endwhile; 
        endforeach;
        wp_reset_query();
      break;

      default:
      case 2:
        foreach($fcategories as $fcategory):

            $post_args = array(
              'posts_per_page' => 1,
              'cat'            => $fcategory->cat_ID
            );

            $fposts = query_posts($post_args);
            while(have_posts()) : the_post(); 
              $image_url = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
              <div  class="tt-category-block custom-hover-image tt-category-block-style2">
                <div class="tt-category-block-inner bg" style="background-image:url(<?php echo esc_url($image_url); ?>);">
                  <a href="<?php echo  get_category_link( $fcategory->term_id ); ?>"></a>
                  <div class="tt-category-text-style2">
                    <h5 class="tt-category-title c-h5"><?php echo esc_html($fcategory->name); ?></h5>
                  </div>
                </div>
              </div>
            <?php
            endwhile; 
          endforeach;
          wp_reset_query();
        # code...
        break;
    }

    echo $after_widget;
    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_category_block', $cache, 'widget');
  }

  function update( $new_instance, $old_instance )
  {
    $instance             = $old_instance;
    $instance['title']    = strip_tags($new_instance['title']);
    $instance['style']    = intval($new_instance['style']);
    $instance['category'] = $new_instance['category'];

    $alloptions = wp_cache_get( 'alloptions', 'options' );
    if ( isset($alloptions['widget_category_block']) )
    {
      delete_option('widget_category_block');
    }
    return $instance;
  }

  function form( $instance )
  {
    $title    = isset($instance['title']) ? $instance['title'] : '';
    $style    = isset($instance['style']) ? $instance['style'] : '1';
    $category = isset($instance['category']) ? $instance['category'] : '';
    ?>
    <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'magplus-pro-addons' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'style' )); ?>"><?php esc_html_e( 'Style:', 'magplus-pro-addons' ); ?></label>
    <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'style' )); ?>">
      <option value="1" <?php selected( '1', $style ); ?>>Style 1</option>
      <option value="2" <?php selected( '2', $style ); ?>>Style 2</option>    
    </select></p>

    <p><label for="<?php echo esc_attr($this->get_field_id( 'category' )); ?>"><?php esc_html_e('Category ID:','magplus-pro-addons'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'category' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'category' )); ?>" type="text" value="<?php echo esc_attr($category); ?>" /><span class="desc">Enter category ID. <a href="https://goo.gl/8hTY4j" target="_blank"><em>How to find the category ID ?</em></a></span></label></p>
    
    <?php
  }
}
