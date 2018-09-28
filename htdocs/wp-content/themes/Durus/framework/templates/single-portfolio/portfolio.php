<?php global $brad_data , $post; ?>

<section class="section" style="padding-top:80px; padding-bottom:80px;">
  <div class="container">
    <div class="row-fluid">
      <?php  $images =  rwmb_meta('brad_image_list', 'type=image&size=full'); ?>
      <?php if(has_post_thumbnail() || !empty($images)  || get_post_meta(get_the_ID(),'brad_video_embed',true) != '' ): ?>
      <div class="flexslider">
        <ul class="slides">
        
        
         <?php if( get_post_meta(get_the_ID(),'brad_video_embed',true) != ''):?>
          <li>
            <div class="video"><?php echo get_post_meta(get_the_ID(),'brad_video_embed',true);?></div>
          </li>
          <?php endif; ?>
          
          
        <?php if(!empty($images)):
		            foreach($images as $image ){
			        $src = $image['url'];
			        $src2 = $image['full_url'];; ?>
                <li>
                  <div class="image hoverlay"><img src="<?php echo $src;?>" alt="<?php the_title();?>" />
                    <div class="overlay">
                      <div class="overlay-content"><a href="<?php echo $src2;?>" rel="prettyPhoto[projectSlides]" class="icon"><i class="fa-search"></i></a></div>
                    </div>
                  </div>
                </li>
                <?php } ?>
               <?php endif; ?> 
          
        <?php if(has_post_thumbnail()): ?>
          <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), ''); ?>
          <li>
            <div class="image hoverlay">
              <?php the_post_thumbnail('post-fullwidth'); ?>
              <div class="overlay">
                <div class="overlay-content"> <a class="icon" title="<?php the_title(); ?>"  href="<?php echo $full_image[0];?>" rel="prettyPhoto[projectSlides]"><i class="fa-search"></i></a></div>
              </div>
            </div>
          </li>
          <?php endif; ?>

        </ul>
      </div>
      <?php endif; ?>
      <div class="gap" style="height:60px; line-height:60px"></div>
      <div class="row-fluid">
        <div class="span8">
          <div class="inner-content">
            <h4 class="title style1 textuppercase"><span><?php echo __('About the Project','brad');?></span></h4>
            <div class="excerpt">
              <?php  $content = apply_filters('the_content', get_post_meta(get_the_ID(),'brad_excerpt',true));
			 echo $content;
			 ?>
            </div>
          </div>
        </div>
        <div class="span4">
          <div class="inner-content">
             <h4 class="title textuppercase style1"><span><?php echo __('Project Info','brad');?></span></h4>
            <div class="project-info">
              <?php if( get_post_meta(get_the_ID(),'brad_project_client',true) != '' ) :  ?>
              <div class="clearfix">
                <strong><?php echo __('Client :','brad');?></strong> 
                <span><?php echo  get_post_meta(get_the_ID(),'brad_project_client',true);?></span>
              </div>
              <?php endif; ?>
              
              <div class="clearfix">
                <strong><?php echo __('Categories :','brad');?></strong>
                <span><?php echo get_the_term_list($post->ID, 'portfolio_category', '', '</span> , <span>', ''); ?></span>
              </div>
              
              <?php if ( get_post_meta(get_the_ID(),'brad_portfolio-link',true) != '' ) : ?>
              <div class="clearfix">
                  <strong><?php echo __('Project Url :','brad');?></strong>
                  <span><a href="<?php echo get_post_meta(get_the_ID(),'brad_portfolio-link',true);?>"><?php  if( get_post_meta(get_the_ID(),'brad_portfolio-link-title',true) != '' ) { echo get_post_meta(get_the_ID(),'brad_portfolio-link-title',true); } else { echo get_post_meta(get_the_ID(),'brad_portfolio-link',true); } ?></a></span>
              </div>
              <?php endif; ?>
            </div>
            
            <?php if($brad_data['check_sharebox']): ?>
        
                  <div class="post-share project-share clearfix">
                  <span class="share-label">
                  <?php echo __('Share : ','brad'); ?>
                  </span>
                  <span class="share-menu">
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
                  </span>
                </div>
              <?php endif; ?>
              
              
          </div>
        </div>
      </div>
    </div>
  </div>
</section>