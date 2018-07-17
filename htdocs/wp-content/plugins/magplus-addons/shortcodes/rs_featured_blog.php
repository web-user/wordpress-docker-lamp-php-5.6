<?php
/**
 *
 * RS Blog
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_featured_blog( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'             => '',
    'class'          => '',
    'cats'           => 0,
    'style'          => 'style1',
    'orderby'        => 'ID',
    'show_category'  => 'yes',
    'show_date'      => 'yes',
    'show_views'     => 'yes',
    'show_comment'   => 'yes',
    'show_author'    => 'yes',
    'post_per_page'  => '3',
    'exclude_posts' => '',
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
    'nav'            => 'default',
    'template'       => 'list-layout',
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

  $isotope_html = $end_div = $isotope_class = '';
  if($style == 'style1') {
    wp_enqueue_script('isotope-pkg');
    $isotope_html = '<div class="isotope isotope-content"><div class="grid-sizer col-xs-12 col-sm-6 col-md-2"></div>';
    $end_div      = '</div>';
    $isotope_class = ' isotope-item';
  }

  ob_start();

  $the_query = new WP_Query($args);
  $max_num_pages = $the_query->max_num_pages;

  switch ($style) {
    case 'style1':
    case 'style4': ?>
      <div <?php echo esc_attr($id); ?> class="row <?php echo esc_attr($class); ?>">
      <?php echo wp_kses_post($isotope_html); ?>
      <?php $i = 0;
        while ($the_query -> have_posts()) : $the_query -> the_post();
          if($i == 0 || $style == 'style4'): ?>
            <div <?php post_class('col-sm-12'.$isotope_class); ?>>
              <div class="tt-post">
                <?php magplus_post_format('magplus-big', 'img-responsive'); ?>

                <div class="tt-post-info">
                  <?php magplus_blog_category($show_category); ?>
                  <?php magplus_blog_title(); ?>
                  <?php magplus_blog_author_date($show_author, $show_date); ?>
                  <?php magplus_blog_excerpt(30); ?>
                  <?php magplus_blog_post_bottom($show_comment, $show_views); ?>
                </div>
              </div>
              <div class="empty-space marg-lg-b30"></div>
            </div>
          <?php else: ?>
            <div <?php post_class('col-sm-6'.$isotope_class); ?>>
              <div class="tt-post type-2">
                  <?php magplus_post_format('magplus-medium', 'img-responsive'); ?>
                  <div class="tt-post-info">
                    <?php magplus_blog_category($show_category); ?>
                    <?php magplus_blog_title('c-h5'); ?>
                    <?php magplus_blog_author_date($show_author, $show_date); ?>
                    <?php magplus_blog_excerpt(15); ?>
                    <?php magplus_blog_post_bottom($show_comment, $show_views); ?>
                  </div>
              </div>
              <div class="empty-space marg-lg-b30 marg-xs-b30"></div>
            </div>
            <div class="empty-space marg-lg-b55 marg-sm-b30"></div>
          <?php
          endif;
          $i++;
        endwhile;
        wp_reset_postdata(); ?>
        <?php echo wp_kses_post($end_div); ?>
      </div>
      <?php
      //magplus_paging_nav($max_num_pages, $nav_args);
      break;
    case 'style2': ?>

      <div <?php echo esc_attr($id); ?> class="row <?php echo esc_attr($class); ?>">
        <?php $i = 0; while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
        <?php if($i == 0): ?>
        <div <?php post_class('col-sm-8'); ?>>

          <div class="tt-post type-2">
            <?php magplus_post_format('magplus-big-alt-2', 'img-responsive'); ?>
            <div class="tt-post-info">
              <?php magplus_blog_category($show_category); ?>
              <?php magplus_blog_title('c-h4', true); ?>
              <?php magplus_blog_author_date($show_author, $show_date); ?>
              <?php magplus_blog_excerpt(); ?>
              <?php magplus_blog_post_bottom($show_comment, $show_views); ?>
            </div>
          </div>
          <div class="empty-space marg-xs-b30"></div>
        </div>
        <?php else: ?>

        <div <?php post_class('col-sm-4'); ?>>
          <div class="tt-post type-4">
            <?php magplus_post_format('magplus-medium', 'img-responsive'); ?>
            <div class="tt-post-info">
              <?php magplus_blog_title('c-h5'); ?>
              <?php magplus_blog_author_date($show_author, $show_date); ?>
            </div>
          </div>
          <?php echo (($the_query->current_post + 1) !== ( $the_query->post_count )) ? '<div class="empty-space marg-lg-b25"></div>':''; ?>
        </div>
        <?php endif; $i++; ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
      </div>
      <?php

      break;
    case 'style5': ?>
      <div <?php echo esc_attr($id); ?> class="row <?php echo esc_attr($class); ?>">
        <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
        <div <?php post_class('col-sm-12 tt-featured-blog-style5 '); ?>>
          <div class="tt-post text-center">
            <?php magplus_post_format('magplus-big', 'img-responsive'); ?>
            <div class="tt-post-info">
              <?php magplus_blog_category($show_category); ?>
              <?php magplus_blog_title(); ?>
              <?php magplus_blog_author_date($show_author, $show_date); ?>
              <?php magplus_blog_excerpt(40); ?>
              <?php magplus_blog_post_bottom($show_comment, $show_views); ?>
            </div>
          </div>
          <div class="empty-space marg-lg-b30"></div>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
      <?php
      # code...
      break;

    case 'style6': ?>
    <div <?php echo esc_attr($id); ?> class="row tt-post-two-col <?php echo esc_attr($class); ?>">
      <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
        <div <?php post_class('col-sm-6 tt-featured-blog-style6 tt-post-two-col-item'); ?>>
          <div class="tt-post type-2 text-center">
              <?php magplus_post_format('magplus-medium', 'img-responsive'); ?>
              <div class="tt-post-info">
                <?php magplus_blog_category($show_category); ?>
                <?php magplus_blog_title('c-h5'); ?>
                <?php magplus_blog_author_date($show_author, $show_date); ?>
                <?php magplus_blog_excerpt(15); ?>
                <?php magplus_blog_post_bottom($show_comment, $show_views); ?>
              </div>
          </div>
          <div class="empty-space marg-lg-b30 marg-xs-b30"></div>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
      </div>
      <?php
      break;
    default:
      # code...
      break;
  }

  $output = ob_get_clean();
  return $output;
}
add_shortcode( 'rs_featured_blog', 'rs_featured_blog' );
