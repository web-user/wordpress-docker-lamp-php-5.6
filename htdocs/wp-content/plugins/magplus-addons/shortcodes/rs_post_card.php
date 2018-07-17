<?php
/**
 *
 * RS Blog
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_post_card( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'cats'          => 0,
    'style'         => 'style1',
    'orderby'       => 'ID',
    'show_category' => 'yes',
    'show_date'     => 'yes',
    'show_author'   => 'yes',
    'post_per_page' => '4',
    'exclude_posts' => '',
  ), $atts ) );

  $id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class        = ( $class ) ? ' '. $class : '';
  $height_class = ($style == 'style1') ? 'long':'small';
  $heading_tag  = ($style == 'style1') ? 'c-h3':'c-h4';

  $args = array(
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

  if (!empty($exclude_posts)) {
    $exclude_posts_arr = explode(',',$exclude_posts);
    if (is_array($exclude_posts_arr) && count($exclude_posts_arr) > 0) {
      $args['post__not_in'] = array_map('intval',$exclude_posts_arr);
    }
  }

  ob_start();

  $the_query = new WP_Query($args); ?>
  <div class="tt-post-card tt-post-card-style5">
  <?php 
    $i = 0;  
    while ($the_query -> have_posts()) : $the_query -> the_post();  
      $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
      $image_src = (!empty($image_src) && is_array($image_src)) ? $image_src[0]:''; 
  ?>


      <div <?php echo $id; ?> class="slider-style5-frame <?php echo sanitize_html_class($style); ?>">
  
        <div class="tt-mslide type-2 long style-2 custom-hover-image">
          <div class="tt-mslide-image tt-mslide bg <?php echo esc_attr($height_class); ?>"  style="background-image:url(<?php echo esc_url($image_src); ?>);">
            <a class="tt-mslide-link" href="<?php echo esc_url(get_the_permalink()); ?>"></a>
            
          </div>

            <div class="tt-mslide-table">
              <div class="tt-mslide-cell">
                <div class="tt-mslide-block">
                  <div class="tt-mslide-cat">
                    <?php 
                      $category = get_the_category(); 
                      if(is_array($category) && !empty($category) && $show_category == 'yes'):
                        foreach($category as $cat): ?>
                          <a class="c-btn type-3 color-2" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->cat_name); ?></a>
                       <?php 
                        endforeach;
                      endif;
                    ?>
                  </div>            
                  <h2 class="tt-mslide-title c-h3"><?php the_title(); ?></h2>
                  <div class="tt-mslide-label">
                    <?php if($show_author == 'yes'): ?>
                      <span><a href="#"><?php echo get_the_author(); ?></a></span>
                    <?php endif; ?>
                    <?php if($show_date == 'yes'): ?>
                      <span><?php echo magplus_time_ago(); ?></span>
                    <?php endif; ?>
                  </div>

                </div>
              </div>          
            </div>
        </div>
      </div>
  <?php $i++; endwhile; wp_reset_postdata(); ?>
  </div>
  <div class="empty-space marg-md-b10"></div>
  <?php
  $output = ob_get_clean();
  return $output;
}
add_shortcode( 'rs_post_card', 'rs_post_card' );