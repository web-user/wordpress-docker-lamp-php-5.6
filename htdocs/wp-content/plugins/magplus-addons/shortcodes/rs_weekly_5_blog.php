<?php
/**
 *
 * RS Blog
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_weekly_5_blog( $atts, $content = '', $id = '' ) {

  global $zilla_likes;
  //echo $zilla_likes->do_likes(); 

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'cats'          => 0,
    'orderby'       => 'ID',
    'post_per_page' => '5',
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
    'date_query'      => array(
      array(
        //'after' => '1 week ago'
      ),
    )
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

  if (!empty($exclude_posts)) {
    $exclude_posts_arr = explode(',',$exclude_posts);
    if (is_array($exclude_posts_arr) && count($exclude_posts_arr) > 0) {
      $args['post__not_in'] = array_map('intval',$exclude_posts_arr);
    }
  }

  ob_start();

  $the_query = new WP_Query($args); 

  if($the_query->have_posts()): ?>



  <div class="row">

    <div class="col-md-6">
      <?php for ($i = 0; $i < 1; $i ++): $the_query -> the_post(); ?>
      <div <?php post_class('tt-post'); ?>>
        <?php magplus_post_format('magplus-big-alt', 'img-responsive'); ?>
        <div class="tt-post-info">
          <?php magplus_blog_category(); ?>
          <?php magplus_blog_title('c-h2'); ?>
          <?php magplus_blog_author_date(); ?>
          <?php magplus_blog_excerpt(30); ?>
          <?php magplus_blog_post_bottom(); ?>
        </div>
      </div>
      <?php
        if (!$the_query -> have_posts()) :
          break;
        endif; ?>
      <?php endfor; ?>
      <div class="empty-space marg-sm-b30"></div>                       
    </div>

    <?php
      $small_previews_count = $the_query -> post_count - 1;
      if ($the_query -> have_posts() && $small_previews_count > 0):
        $posts_per_column = $post_per_page - 1;
    ?>

    <div class="col-md-6">
      <?php for ($i = 0; $i < $posts_per_column; $i++):

        if (!$the_query -> have_posts()) :
          break;
        endif;
        $the_query -> the_post();
      ?>
      <div <?php post_class('tt-post type-8 clearfix'); ?>>
        <?php magplus_post_format('magplus-medium-alt', 'img-responsive'); ?>
        <div class="tt-post-info">
          <?php magplus_blog_title('c-h5'); ?>
          <?php magplus_blog_excerpt(30); ?>
        </div>
      </div>
      <div class="empty-space marg-lg-b30"></div>
      <?php endfor; ?>
    </div>
    <?php endif; ?>                                                                                               
  </div>

  <?php endif; wp_reset_postdata();

  $output = ob_get_clean();
  return $output;
}
add_shortcode( 'rs_weekly_5_blog', 'rs_weekly_5_blog' );
