<?php
/**
 *
 * RS Blog
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_post_grid( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'cats'          => 0,
    'style'         => 'style1',
    'orderby'       => 'ID',
    'show_date'     => 'yes',
    'show_author'   => 'yes',
    'post_per_page' => '4',
    'exclude_posts' => '',
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. $class : '';

  $args = array(
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

  if (!empty($exclude_posts)) {
    $exclude_posts_arr = explode(',',$exclude_posts);
    if (is_array($exclude_posts_arr) && count($exclude_posts_arr) > 0) {
      $args['post__not_in'] = array_map('intval',$exclude_posts_arr);
    }
  }

  ob_start();

  $the_query = new WP_Query($args); ?>

  <div <?php echo $id; ?> class="row tt-post-two-col <?php echo $class; ?>">
    <?php $i = 0;  while ($the_query -> have_posts()) : $the_query -> the_post();  ?>
    <div <?php post_class('tt-post tt-post-two-col-item type-3 col-sm-6 col-md-6'); ?>>
      <?php magplus_post_format('magplus-big-alt-2', 'img-responsive'); ?>
      <div class="tt-post-info">
        <a class="tt-post-title c-h5" href="<?php echo esc_url(get_the_permalink()); ?>"><small><?php the_title(); ?></small></a>
          <?php magplus_blog_author_date($show_author, $show_date); ?>
      </div>
      <div class="marg-lg-b30"></div>
    </div>
    <?php $i++; endwhile; wp_reset_postdata(); ?>
  </div>
  <?php
  $output = ob_get_clean();
  return $output;
}
add_shortcode( 'rs_post_grid', 'rs_post_grid' );
