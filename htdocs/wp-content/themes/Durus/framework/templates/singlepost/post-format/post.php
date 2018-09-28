<?php global $brad_data , $post; 
if( $brad_data['blog_layout'] == 'sidebar' ){ $img_size = 'post-wide';}
      else { $img_size = 'post-fullwidth'; } 
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(' post-standard post-single clearfix '); ?>>
<?php  $img_list = get_post_meta( get_the_ID(), 'brad_image_list', false );
         if ( !is_array( $img_list ) )
			    	$img_list = ( array ) $img_list;
			    if ( !empty( $img_list ) ) {
			    	$img_list = implode( ',', $img_list );
			    	$images = $wpdb->get_col( "
			    	SELECT ID FROM $wpdb->posts
			    	WHERE post_type = 'attachment'
			    	AND ID IN ( $img_list )
			    	ORDER BY menu_order ASC
			    	" );
				}
				else{
					$images = false;
				}
    ?>
  <?php if(has_post_thumbnail() || !empty($images) || get_post_meta(get_the_ID(),'brad_video_embed',true) != ''  ): ?>
  <div class="flexslider">
    <ul class="slides">
      <?php if( get_post_meta(get_the_ID(),'brad_video_embed',true) != ''):?>
      <li>
        <div class="video"><?php echo get_post_meta(get_the_ID(),'brad_video_embed',true);?></div>
      </li>
      <?php endif; ?>
      <?php if(!empty($images)):
		 foreach($images as $image ){
			$src = wp_get_attachment_image_src( $image , $img_size );
			$src2 = wp_get_attachment_image_src( $image , '' ); ?>
      <li>
        <div class="image hoverlay"><img src="<?php echo $src[0];?>" alt="<?php the_title();?>" />
        <?php if( $brad_data['blog_lightbox']): ?>
          <div class="overlay">
            <div class="overlay-content"><a href="<?php echo $src2[0];?>" rel="prettyPhoto[post<?php the_ID();?>]" class="icon"><i class="fa-search"></i></a></div>
          </div>
        <?php endif; ?>  
        </div>
      </li>
      <?php } endif; ?>
      <?php if(has_post_thumbnail()): ?>
      <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), ''); ?>
      <li>
        <div class="image hoverlay">
          <?php the_post_thumbnail($img_size); ?>
          <?php if( $brad_data['blog_lightbox']): ?>
          <div class="overlay">
            <div class="overlay-content"> <a class="icon" title="<?php the_title(); ?>"  href="<?php echo $full_image[0];?>"  rel="prettyPhoto[post<?php the_ID();?>]"><i class="fa-search"></i></a></div>
          </div>
         <?php endif; ?> 
        </div>
      </li>
      <?php endif; ?>
    </ul>
  </div>
  <?php endif; ?>
  
  <!--post meta info -->
  <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'brad'), the_title_attribute('echo=0') ); ?>">
    <?php the_title(); ?>
    </a></h2>
  <div class="post-meta-data">
  <?php if( $brad_data['check_author'] == true ):?>
   <span><?php echo __("Posted By:","brad");?>
    <?php the_author_posts_link(); ?>
    </span>
    <?php endif; ?>
    <?php if(has_category() && $brad_data['check_blog_categories'] == true ):?>
    <span class="divider">|</span><span><?php echo __('Posted In:','brad');?>
    <?php the_category(' , '); ?>
    </span>
    <?php endif; ?>
    <?php if($brad_data['check_blog_date'] == true): ?>
    <span class="divider">|</span><span>
    <?php echo get_the_date();?>
    </span>
    <?php endif; ?>
    <?php if ( comments_open() ) : ?>
    <span class="divider">|</span><span>
    <?php comments_popup_link('<i class="ss-air ss-chat"></i> 0','<i class="ss-air ss-chat"></i> 1', '<i class="ss-air ss-chat"></i> %' ,'comments-info'); ?>
    </span>
    <?php endif; ?>
  </div>
  
  <!-- post excerpt -->
  <div class="post-content">
    <?php the_content(); ?>
  </div>
</div>