<?php global $brad_data; ?>
<?php global $post; ?>

<?php while ( have_posts() ) : the_post(); ?>

<!-- Single Post -->
<?php  get_template_part("framework/templates/singlepost/post-format/post",get_post_format())?>

<!-- Post Links -->
<div class="page-links"><?php wp_link_pages(); ?></div>

<?php $relatedPosts = brad_get_related_posts(get_the_ID()); ?>
<?php if ( $brad_data['check_relatedposts'] && $relatedPosts->have_posts() ) : ?>
<!-- Related Posts -->
<div class="related-posts-container <?php if( get_post_format() == 'link' || get_post_format() == 'quote') { echo 'no-border'; }?>">
<h4 class="textuppercase title style1"><span><?php echo __("Related Posts","brad");?></span></h4>
<ul class="related-posts">
  <?php while($relatedPosts->have_posts()): $relatedPosts->the_post(); ?>
  <li><a class="" href="<?php the_permalink();?>"><?php the_title(); ?></a> <span>(<?php the_time(get_option('date_format')); ?>)</span></li>
  <?php endwhile; ?>
 <?php wp_reset_query(); ?>
</ul></div>
<?php endif; ?>

<?php if($brad_data['check_sharebox']): ?>
<!-- Share Box -->
<div class="post-share project-share clearfix"> <span class="share-label"> <?php echo __('Share this Story : ','brad'); ?> </span> <span class="share-menu">
  <ul class="post-share-menu">
    <?php if($brad_data['check_sharingboxfacebook']): ?>
    <li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>"  class="facebook-share"><i class="fa-facebook"></i><span class="count"></span></a></li>
    <?php endif; ?>
    <?php if($brad_data['check_sharingboxtwitter']): ?>
    <li ><a href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" class="twitter-share"><i class="fa-twitter"></i><span class="count"></span></a></li>
    <?php endif; ?>
    <?php if($brad_data['check_sharingboxlinkedin']): ?>
    <li><a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" class="linkedin-share"><i class="fa-linkedin"></i><span class="count"></span></a></li>
    <?php endif; ?>
    <?php if($brad_data['check_sharingboxpinterest']): ?>
    <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
    <li ><a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&amp;description=<?php echo urlencode($post->post_title); ?>&amp;media=<?php echo urlencode($full_image[0]); ?>" class="pinterest-share"><i class="fa-pinterest"></i><span class="count"></span></a></li>
    <?php endif; ?>
    <?php if($brad_data['check_sharingboxgoogle']): ?>
    <li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>"  class="google-share"><i class="fa-google-plus"></i><span class="count"></span></a></li>
    <?php endif; ?>
  </ul>
  </span> </div>
<?php endif; ?>


<?php if($brad_data['check_authorinfo']):  ?>
<!-- Author Info -->
<div class="about-the-author clearfix">
  <div class="avatar"><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_avatar( get_the_author_meta('user_email'), '60', '' ); ?></a></div>
  <div class="author-info">
    <h4 class="textuppercase"><span>
      <?php _e('About the Author', 'brad'); ?>
      </span></h4>
    <?php if( get_the_author_meta('description') != '') { the_author_meta('description');  } else { echo __('The Author has not yet added any info about himself','brad'); } ?>
  </div>
</div>
<?php endif; ?>
<?php comments_template();?>
<div class="page-nav-prev"><?php previous_post_link('%link' ,'<i class="fa-arrow-thin-left"></i>'); ?></div>
<div class="page-nav-next"><?php next_post_link('%link' , '<i class="fa-arrow-thin-right"></i>'); ?></div>
<?php endwhile; ?>