<?php
/**
 *
 * RS Blog
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_blog_masonry( $atts, $content = '', $id = '' ) {
  wp_enqueue_script('isotope-pkg');
  extract( shortcode_atts( array(
    'id'               => '',
    'class'            => '',
    'cats'             => 0,
    'orderby'          => 'ID',
    'post_per_page'    => '8',
    'show_category'    => 'yes',
    'show_date'        => 'yes',
    'show_views'       => 'yes',
    'show_comment'     => 'yes',
    'show_author'      => 'yes',
    'excerpt_length'   => '15',
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
  );

  if( $cats ) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'category',
        'field'    => 'ids',
        'terms'    => explode( ',', $cats )
      )
    );
  }

  $nav_args = array(
    'nav'            => $pagination_style,
    'template'       => 'masonry-layout',
    'show_category'  => $show_category,
    'show_date'      => $show_date,
    'show_author'    => $show_author,
    'show_views'     => $show_views,
    'excerpt_length' => $excerpt_length,
    'posts_per_page' => $post_per_page,
    'isotope'        => 1,
  );

  if (!empty($exclude_posts)) {
    $exclude_posts_arr = explode(',',$exclude_posts);
    if (is_array($exclude_posts_arr) && count($exclude_posts_arr) > 0) {
      $args['post__not_in'] = array_map('intval',$exclude_posts_arr);
    }
  }

  ob_start();

  $the_query = new WP_Query($args);
  $max_num_pages = $the_query->max_num_pages;
  ?>


  <div class="row tt-blog-masonry tt-recent-news">
   <div class="isotope isotope-content">
    <div class="grid-sizer col-xs-12 col-sm-6 col-md-2"></div>

    <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

    <div <?php post_class('isotope-item col-xs-12 col-sm-6 col-md-2'); ?>>
      <div class="tt-post type-2">
        <?php magplus_post_format('magplus-medium', 'img-responsive'); ?>
        <div class="tt-post-info">
          <?php magplus_blog_category($show_category); ?>
          <?php magplus_blog_title('c-h5'); ?>
          <?php magplus_blog_author_date($show_author, $show_date); ?>
          <?php magplus_blog_excerpt($excerpt_length); ?>
          <?php magplus_blog_post_bottom($show_comment, $show_views); ?>
        </div>
      </div>
      <div class="empty-space marg-lg-b30 marg-xs-b30"></div>
    </div>

    <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <?php magplus_paging_nav($max_num_pages, $nav_args); ?>
   </div>

  <?php

  $output = ob_get_clean();
  return $output;
}
add_shortcode( 'rs_blog_masonry', 'rs_blog_masonry' );
