<?php
/**
 *
 * RS Recent News
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_recent_news( $atts, $content = '', $id = '' ) {
  global $post;
  extract( shortcode_atts( array(
    'id'               => '',
    'class'            => '',
    'post_per_page'    => 3,
    'excerpt_length'   => 35,
    'orderby'          => 'date',
    'show_category'    => 'yes',
    'show_date'        => 'yes',
    'show_views'       => 'yes',
    'show_comment'     => 'yes',
    'show_author'      => 'yes',
    'pagination'       => 'yes',
    'pagination_style' => 'default',
    'exclude_posts'    => '',
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. $class : '';

  if (get_query_var('paged')) {
    $paged = get_query_var('paged');
  } elseif (get_query_var('page')) {
    $paged = get_query_var('page');
  } else {
    $paged = 1;
  }

  $args = array(
    'paged'          => $paged,
    'orderby'        => $orderby,
    'posts_per_page' => $post_per_page,
    'meta_query'     => array(array('key' => '_thumbnail_id')),
  );

  $nav_args = array(
    'nav'            => $pagination_style,
    'template'       => 'list-layout',
    'show_category'  => $show_category,
    'show_date'      => $show_date,
    'show_author'    => $show_author,
    'show_views'     => $show_views,
    'excerpt_length' => $excerpt_length,
    'posts_per_page' => $post_per_page,
    'isotope'        => 0,
  );

  if (!empty($exclude_posts)) {
    $exclude_posts_arr = explode(',',$exclude_posts);
    if (is_array($exclude_posts_arr) && count($exclude_posts_arr) > 0) {
      $args['post__not_in'] = array_map('intval',$exclude_posts_arr);
    }
  }

  ob_start();

  $the_query = new WP_Query($args);
  $max_num_pages = $the_query->max_num_pages; ?>

  <div class="tt-recent-news isotope-content">
    <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
    <div <?php post_class('tt-post type-6 clearfix'); ?>>
      <?php magplus_post_format('magplus-medium-ver', 'img-responsive'); ?>
      <div class="tt-post-info">
        <?php magplus_blog_category($show_category); ?>
        <?php magplus_blog_title('c-h4', true); ?>
        <?php magplus_blog_author_date($show_author, $show_date); ?>
        <?php magplus_blog_excerpt($excerpt_length); ?>
        <?php magplus_blog_post_bottom($show_comment, $show_views); ?>
      </div>
    </div>
    <div class="empty-space marg-lg-b30"></div>
    <?php endwhile; wp_reset_postdata(); if($pagination == 'yes') : magplus_paging_nav($max_num_pages, $nav_args); endif; ?>
  </div>
  <?php
  $output = ob_get_clean();
  return $output;
}
add_shortcode( 'rs_recent_news', 'rs_recent_news' );
