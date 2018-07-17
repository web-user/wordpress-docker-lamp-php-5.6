<?php
/**
 *
 * RS Blog
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_hand_picked_blog( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'cats'          => 0,
    'orderby'       => 'ID',
    'post_per_page' => '8',
    'show_category' => 'yes',
    'show_date'     => 'yes',
    'show_views'    => 'yes',
    'show_comment'  => 'yes',
    'show_author'   => 'yes',
    'style'         => 'style1',
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

  $layout = magplus_get_opt('main-layout');
  switch ($layout) {
    case 'right_sidebar':
    case 'left_sidebar':
      $col_big   = 'col-sm-6';
      $col_small = 'col-xs-6 col-sm-4 col-lg-3';
      break;
    
    default:
      $col_big   = 'col-sm-4';
      $col_small = 'col-xs-6 col-sm-4 col-lg-2';
      # code...
      break;
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

  if (!empty($exclude_posts)) {
    $exclude_posts_arr = explode(',',$exclude_posts);
    if (is_array($exclude_posts_arr) && count($exclude_posts_arr) > 0) {
      $args['post__not_in'] = array_map('intval',$exclude_posts_arr);
    }
  }

  ob_start();

  $the_query = new WP_Query($args); 

  switch ($style) {
    case 'style1': ?>
      <div class="row">
        <div class="post-grid-view">
        <?php $i = 0; while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
          <?php echo magplus_post_grid($col_small); ?>
        <?php $i++; endwhile; wp_reset_postdata(); ?>
        </div>
      </div>
      <?php
      # code...
      break;

    case 'style2':
    case 'style3': ?>
      <div class="row">
        <div class="post-grid-view">
        <?php
          $col_big = ($style == 'style3') ? 'col-sm-6':$col_big; 
          $i = 0; while ($the_query -> have_posts()) : $the_query -> the_post(); 
          if($i == 0):
        ?>
          <div <?php post_class($col_big); ?>>

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
        <?php else:
          echo magplus_post_grid($col_small);
          endif;
          $i++; endwhile; wp_reset_postdata();
        ?>
        </div>
      </div>
      <?php
      # code...
      break;
    
    default:
      # code...
      break;
  }

  ?>

  <?php
  $output = ob_get_clean();
  return $output;
}
add_shortcode( 'rs_hand_picked_blog', 'rs_hand_picked_blog' );
