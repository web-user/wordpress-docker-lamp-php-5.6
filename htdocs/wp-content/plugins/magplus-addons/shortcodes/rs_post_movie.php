<?php
/**
 *
 * RS Blog
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_post_movie( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'cats'          => '',
    'orderby'       => 'ID',
    'show_views'    => 'yes',
    'show_comment'  => 'yes',
    'post_per_page' => '6',
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
      ),
      array(
        'taxonomy' => 'post_format',
        'field'    => 'slug',
        'terms'    => 'post-format-video'
      )
    );
  }

  ob_start();

  $the_query = new WP_Query($args); ?>


  <div <?php echo $id; ?> class="row <?php echo esc_attr($class); ?>">
    <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
    <div class="col-md-2 col-sm-4 col-xs-6 col-lg-2">
      <div <?php post_class('tt-post-movie'); ?>>
        <?php magplus_post_format('magplus-small-ver', 'img-responsive'); ?>
        <div class="tt-post-attributes">
          <div class="empty-space marg-lg-b10"></div>
          <?php magplus_blog_title('c-h6'); ?>
          <?php magplus_blog_post_bottom($show_comment, $show_views); ?>
        </div>
      </div>
      <div class="empty-space marg-sm-b15 marg-xs-b10"></div>
    </div>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>

  <?php
  $output = ob_get_clean();
  return $output;
}
add_shortcode( 'rs_post_movie', 'rs_post_movie' );
