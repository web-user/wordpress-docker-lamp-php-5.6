<?php
/**
 *
 * RS Blog
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_post_video_playlist( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'cats'          => 0,
    'style'         => 'style1',
    'orderby'       => 'ID',
    'post_per_page' => '10',
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
    );
  }

  $args['tax_query'] = array(
    array(
      'taxonomy'   => 'post_format',
      'field'      => 'slug',
      'terms'      => 'post-format-video',
    )
  );

  ob_start();

  $the_query = new WP_Query($args); 

  ?>

  <div class="tt-video-playlist shortcode-3<?php echo ($style == 'style2') ? ' style-2':''; ?>">
    <div class="tt-content-wrapp">
      <div class="tt-block-inner tt-video-wrapper">
        <div class="row">
    

        <?php

          $the_posts = array();

          if( $the_query->have_posts() ):
            while( $the_query->have_posts() ) : $the_query->the_post();

            $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'magplus-small-hor' );
            $image = ( ! empty( $image ) ) ? $image[0] : '';

            $the_posts[] = array(
              'id'                => get_the_id(),
              'title'             => get_the_title(),
              'image'             => $image,
              'post_format'       => get_post_format(),
              'post_video_url'    => magplus_get_post_opt('post-video-url'),
              'post_video_length' => magplus_get_post_opt('post-video-length'),
            );

            endwhile;
            wp_reset_postdata();
          endif;

          if( ! empty( $the_posts ) ):

            $total_posts = count( $the_posts ); 
          ?>


          <div class="tt-item-video tt-video <?php echo ($style == 'style2') ? 'col-md-12':'col-md-8'; ?>" data-rel="2" data-src="<?php echo esc_url($the_posts[0]['post_video_url']); ?>">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="<?php echo esc_url($the_posts[0]['post_video_url']); ?>"></iframe>
            </div>
          </div>

          <?php if( $total_posts > 0 ): ?>

            <div class="tt-list <?php echo ($style == 'style2') ? 'col-md-12':'col-md-4'; ?>">


              <?php $column_right_posts = array_slice( $the_posts, 0, $post_per_page ); 
              foreach( $column_right_posts as $right_post_key => $right_post_val ): ?>

                <div class="open-video tt-post type-7 clearfix" data-rel="2" data-src="<?php echo esc_url($right_post_val['post_video_url']); ?>">
                  <a class="tt-post-img custom-hover" href="#">
                    <img class="img-responsive" src="<?php echo esc_url($right_post_val['image']); ?>" alt="">
                  </a>
                  <div class="tt-post-info">
                    <a class="tt-post-title c-h6" href="#"><?php echo wp_kses_post($right_post_val['title']); ?></a>
                    <?php if(!empty($right_post_val['post_video_length'])): ?>
                      <span class="tt-post-video-length"><?php echo esc_html($right_post_val['post_video_length']); ?></span>
                    <?php endif; ?>
                  </div>
                </div>
                <?php endforeach; ?> 


            </div>
          <?php 
            endif; 
          endif;
        ?>
          

        </div>
      </div>
    </div>
  </div>

<?php
  $output = ob_get_clean();
  return $output;
}
add_shortcode( 'rs_post_video_playlist', 'rs_post_video_playlist' );
