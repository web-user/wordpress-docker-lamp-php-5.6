<?php
/**
 *
 * RS Blog
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_weekly_7_blog( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'cats'          => 0,
    'orderby'       => 'ID',
    'post_per_page' => '7',
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

  $the_query = new WP_Query($args); ?>


  <?php if($the_query->have_posts()): ?>

  <div class="row">

    <?php

      $the_posts = array();

      if( $the_query->have_posts() ):
        while( $the_query->have_posts() ) : $the_query->the_post();

        $big_image    = wp_get_attachment_image_src( get_post_thumbnail_id(), 'magplus-big-alt' );
        $big_image    = ( ! empty( $big_image ) ) ? $big_image[0] : '';
        $medium_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'magplus-medium-alt' );
        $medium_image = ( ! empty( $medium_image ) ) ? $medium_image[0] : '';

        $the_posts[] = array(
          'id'                => get_the_id(),
          'title'             => get_the_title(),
          'medium_image'      => $medium_image,
          'big_image'         => $big_image,
          'category'          => get_the_category_list( esc_html__( ', ', 'magplus' ) ) ,
          'permalink'         => get_the_permalink(),
          'author'            => get_the_author(),
          'excerpt'           => get_the_excerpt(),
          'comment'           => get_comments_number(),
          'date'              => get_the_time('M d'),
          'post_format'       => get_post_format(),
          'post_gallery'      => magplus_get_post_opt('post-gallery'),
          'post_video_url'    => magplus_get_post_opt('post-video-url'),
          'post_video_length' => magplus_get_post_opt('post-video-length'),
          'post_views'        => magplus_getPostViews(get_the_ID())
        );

        endwhile;
        wp_reset_postdata();
      endif;

      if( ! empty( $the_posts ) ):

        $total_posts = count( $the_posts );
    ?>


        <div class="col-md-6 col-md-push-3">

          <div class="tt-post">

          <?php magplus_weekly_post_format($the_posts[0]['big_image'], $the_posts[0]['post_format'], $the_posts[0]['permalink'], $the_posts[0]['post_gallery'], $the_posts[0]['post_video_url'], $the_posts[0]['post_video_length'] ); ?>

            <div class="tt-post-info">
                <div class="tt-post-cat"><?php echo $the_posts[0]['category']; ?></div>
                <a class="tt-post-title c-h2" href="<?php echo esc_url($the_posts[0]['permalink']); ?>"><?php echo wp_kses_post($the_posts[0]['title']); ?></a>
                <div class="tt-post-label">
                  <span><a href="#"><?php echo esc_html($the_posts[0]['author']); ?></a></span>
                  <span><?php echo esc_html($the_posts[0]['date']); ?></span>
                </div>
                <div class="simple-text">
                  <p><?php echo magplus_auto_post_excerpt(20, $the_posts[0]['excerpt']); ?></p>
                </div>
                <div class="tt-post-bottom">
                  <span><a href="#"><i class="material-icons">chat_bubble</i><?php echo esc_html($the_posts[0]['comment']); ?> <?php echo esc_html('Comments', 'magplus'); ?></a></span>
                  <span><a href="#"><i class="material-icons">visibility</i><?php echo esc_html($the_posts[0]['post_views']); ?></a></span>
                </div>
            </div>
          </div>

          <div class="empty-space marg-sm-b30"></div>                       
        </div>


        <?php if( $total_posts > 1 ): ?>
          <div class="col-sm-6 col-md-3 col-md-pull-6">
            <?php $column_left_posts = array_slice( $the_posts, 1, 3 );

              foreach( $column_left_posts as $left_post_key => $left_post_val ): ?>

                <div class="tt-post type-5">
                  <?php magplus_weekly_post_format($left_post_val['medium_image'], $left_post_val['post_format'], $left_post_val['permalink'], $left_post_val['post_gallery'], $left_post_val['post_video_url'], $left_post_val['post_video_length'] ); ?>
                  <div class="tt-post-info">
                    <div class="tt-post-cat"><?php echo $left_post_val['category']; ?></div>
                    <a class="tt-post-title c-h5" href="<?php echo esc_url($left_post_val['permalink']); ?>"><small><?php echo wp_kses_post($left_post_val['title']); ?></small></a>
                  </div>
                </div>
              <?php

              echo ($left_post_key < 2) ? '<div class="empty-space marg-lg-b25"></div>':'';

              endforeach;
        ?>
      </div>
    <?php 
    endif;

    if( $total_posts > 3 ): ?>
      <div class="col-sm-6 col-md-3">
        <div class="empty-space marg-sm-b25"></div>
        <?php
          $column_right_posts = array_slice( $the_posts, 4, 7);
          
          foreach( $column_right_posts as $right_post_key => $right_post_val ): ?>
            
            <div class="tt-post type-5">
                <?php magplus_weekly_post_format($right_post_val['medium_image'], $right_post_val['post_format'], $right_post_val['permalink'], $right_post_val['post_gallery'], $right_post_val['post_video_url'], $right_post_val['post_video_length'] ); ?>
              <div class="tt-post-info">
                <div class="tt-post-cat"><?php echo $right_post_val['category']; ?></div>
                <a class="tt-post-title c-h5" href="<?php echo esc_url($right_post_val['permalink']); ?>"><small><?php echo wp_kses_post($right_post_val['title']); ?></small></a>
              </div>
            </div>
            <?php

            echo ($right_post_key < 6) ? '<div class="empty-space marg-lg-b25"></div>':'';

          endforeach; ?>

      </div>   
    <?php endif; ?>                                                                
  </div>
  <div class="empty-space marg-lg-b40 marg-sm-b30"></div>
  <?php
  endif;
  endif;

  $output = ob_get_clean();
  return $output;
}
add_shortcode( 'rs_weekly_7_blog', 'rs_weekly_7_blog' );
