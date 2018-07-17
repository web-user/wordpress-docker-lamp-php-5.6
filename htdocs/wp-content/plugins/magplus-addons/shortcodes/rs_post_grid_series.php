<?php
/**
 *
 * RS Blog
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_post_grid_series( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'cats'          => 0,
    'style'         => 'style1',
    'orderby'       => 'ID',
    'show_category' => 'yes',
    'show_date'     => 'yes',
    'show_views'    => 'yes',
    'show_comment'  => 'yes',
    'show_author'   => 'yes',
    'post_per_page' => '3',
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

  if (!empty($exclude_posts)) {
    $exclude_posts_arr = explode(',',$exclude_posts);
    if (is_array($exclude_posts_arr) && count($exclude_posts_arr) > 0) {
      $args['post__not_in'] = array_map('intval',$exclude_posts_arr);
    }
  }

  ob_start();

  $the_query = new WP_Query($args); 

  if($the_query->have_posts()): 

  switch ($style) {
    default:
    case 'style1': ?>
      <div class="row">

        <div class="tt-post-grid-series">

      
          <div class="col-md-6">

            <?php for ($i = 0; $i < 1; $i ++): $the_query->the_post(); ?>
            <div <?php post_class('tt-post'); ?>>

              <?php magplus_post_format('magplus-big-alt', 'img-responsive'); ?>
              <div class="tt-post-info">
                <?php magplus_blog_category($show_category); ?>
                <?php magplus_blog_title('c-h2'); ?>
                <?php magplus_blog_author_date($show_author, $show_date); ?>
                <?php magplus_blog_excerpt(30); ?>
                <?php magplus_blog_post_bottom($show_comment, $show_views); ?>
              </div>
            </div>

            <?php
              if (!$the_query->have_posts()) :
                break;
              endif; ?>
            <?php endfor; ?>


            <div class="empty-space marg-lg-b30 marg-sm-b30"></div>                       
          </div>

          <?php
            $small_previews_count = $the_query->post_count - 1;
            if ($the_query->have_posts() && $small_previews_count > 0):
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
                <?php magplus_post_format('magplus-medium-ver', 'img-responsive'); ?>
                <div class="tt-post-info">
                  <?php magplus_blog_title('c-h5'); ?>
                  <?php magplus_blog_excerpt(12); ?>
                </div>
              </div>
              <div class="empty-space marg-lg-b30"></div>
              <?php endfor; ?>                          
            

          </div>
          <?php endif; ?>
          
          <?php
          wp_reset_postdata(); ?>

        </div>

      </div>
      <?php
      break;
    case 'style2': ?>

      <div class="tt-classic-grid-series">


        <?php for ($i = 0; $i < 1; $i ++): $the_query -> the_post(); ?>
        <div <?php post_class('tt-post type-3'); ?>>
          <?php magplus_post_format('magplus-medium', 'img-responsive'); ?>
          <div class="tt-post-info">
            <a class="tt-post-title c-h5" href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a>
            <?php magplus_blog_author_date($show_author, $show_date); ?>
          </div>
        </div>
        <?php
          if (!$the_query -> have_posts()) :
            break;
          endif; ?>
        <?php endfor; ?>

        <div class="empty-space marg-lg-b30 marg-sm-b30"></div>

        <?php
          $small_previews_count = $the_query -> post_count - 1;
          if ($the_query -> have_posts() && $small_previews_count > 0):
            $posts_per_column = $post_per_page - 1;
        ?>

        <ul class="tt-post-list type-3">
          <?php for ($i = 0; $i < $posts_per_column; $i++):

            if (!$the_query -> have_posts()) :
              break;
            endif;
            $the_query -> the_post();
          ?>
          <li>
            <div <?php post_class('tt-post type-7 clearfix'); ?>>
              <?php magplus_post_format('magplus-small-alt', 'img-responsive'); ?>
              <div class="tt-post-info">
                <?php magplus_blog_title('c-h5', true); ?>
                <?php magplus_blog_author_date($show_author, $show_date); ?>
              </div>
            </div>                                    
          </li>
          <?php endfor; ?> 
        </ul>
        <?php endif; ?>
      </div>

      <?php
      break;

    case 'style3': ?>
      <div class="row">

        <div class="tt-post-grid-series tt-classic-grid-series tt-post-grid-series-style3">

      
          <div class="col-md-7">

            <?php for ($i = 0; $i < 1; $i ++): $the_query->the_post(); ?>
            <div <?php post_class('tt-post type-2'); ?>>
              <?php magplus_post_format('magplus-medium', 'img-responsive'); ?>
              <div class="tt-post-info">
                <?php magplus_blog_category($show_category); ?>
                <?php magplus_blog_title('c-h4', true); ?>
                <?php magplus_blog_author_date($show_author, $show_date); ?>
                <?php magplus_blog_excerpt(15); ?>
                <?php magplus_blog_post_bottom($show_comment, $show_views); ?>
              </div>
            </div>

            <?php
              if (!$the_query->have_posts()) :
                break;
              endif; ?>
            <?php endfor; ?>


            <div class="empty-space marg-lg-b30 marg-sm-b30"></div>                       
          </div>

          <?php
            $small_previews_count = $the_query->post_count - 1;
            if ($the_query->have_posts() && $small_previews_count > 0):
              $posts_per_column = $post_per_page - 1;
          ?>
          <div class="col-md-5">

            
            <ul class="tt-post-list type-3">
              <?php for ($i = 0; $i < $posts_per_column; $i++):

                if (!$the_query -> have_posts()) :
                  break;
                endif;
                $the_query -> the_post();
              ?>
              <li>
                <div <?php post_class('tt-post type-7 clearfix'); ?>>
                  <?php magplus_post_format('magplus-small-alt', 'img-responsive'); ?>
                  <div class="tt-post-info">
                    <?php magplus_blog_title('c-h5', true); ?>
                    <?php magplus_blog_author_date($show_author, $show_date); ?>
                  </div>
                </div>                                    
              </li>
              <?php endfor; ?> 
            </ul>                        
          
          </div>
          <?php endif; ?>
          
          <?php
          wp_reset_postdata(); ?>

        </div>

      </div>
      <?php
      
      break;
  }

  wp_reset_postdata();

  endif;
  $output = ob_get_clean();
  return $output;
}
add_shortcode( 'rs_post_grid_series', 'rs_post_grid_series' );
