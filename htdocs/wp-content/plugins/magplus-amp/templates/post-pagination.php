<?php
/**
 * Post navigation in single post
 * Create next and prev button to next and prev posts
 *
 * @since 1.0
 */
$prev_post = get_previous_post();
$next_post = get_next_post();
?>
<?php if ( ! empty( $prev_post ) || ! empty( $next_post ) ) : ?>
  <div class="post-pagination">
    <?php if ( ! empty( $prev_post ) ) : ?>
      <div class="prev-post">
        <div class="prev-post-inner">
          <div class="prev-post-title">
            <div class="tt-blog-nav-label">Previous Article</div>
          </div>
          <a href="<?php echo esc_url( get_the_permalink( $prev_post->ID ) ); ?>">
            <div class="pagi-text">
              <h5 class="prev-title"><?php echo sanitize_text_field( get_the_title( $prev_post->ID ) ); ?></h5>
            </div>
          </a>
        </div>
      </div>
    <?php endif; ?>

    <?php if ( ! empty( $next_post ) ) : ?>
      <div class="next-post ">
        <div class="next-post-inner">
          <div class="prev-post-title next-post-title">
            <div class="tt-blog-nav-label">Next Article</div>
          </div>
          <a href="<?php echo esc_url( get_the_permalink( $next_post->ID ) ); ?>">
            <div class="pagi-text">
              <h5 class="next-title"><?php echo sanitize_text_field( get_the_title( $next_post->ID ) ); ?></h5>
            </div>
          </a>
        </div>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>