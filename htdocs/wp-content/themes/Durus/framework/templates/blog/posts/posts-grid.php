<?php global $brad_data , $post , $brad_includes; ?>
<?php $brad_includes['load_isotope'] = true; ?>
<?php 
   $class    = brad_get_class_name($brad_data['grid_blog_columns']);
   $img_type = brad_get_img_size($brad_data['grid_blog_columns']);
?>
<?php if (have_posts()) : ?>
<?php 
if( $brad_includes['load_infiniteScroll'] == true && ( $brad_data['blog_pagination'] == 'if_scroll' || $brad_data['blog_pagination'] == 'loadmore' )) {
	   $output .= '<p>'. __('Sorry You cannot create more than 1 infinite scroll or Load More Posts ( Portfolios ) per page . Please change this in page builder or blog settings ','brad') .'</p>';
	}
	else {
?>
<?php $ex_class = ($brad_data['blog_pagination'] == 'ifscroll' || $brad_data['blog_pagination'] == 'loadmore' ) ? 'posts-with-infinite' : '' ; ?>
<div class="blog-gird <?php echo $ex_class;?>">
<ul class="posts-grid posts-with-padding-yes row-fluid posts-grid-bg-<?php echo $brad_data['grid_blog_style']?>">
  <?php  while (have_posts()) : the_post(); ?>
  <li id="post-<?php the_ID(); ?>" <?php post_class(' post-grid-item '.$class ); ?>>
    <div class="inner-content">
      <div class="post-grid-item-wrap">
      
    
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
        <?php if(has_post_thumbnail() || !empty($images)  || get_post_meta(get_the_ID(),'brad_video_embed',true) != '' ): ?>
        <div class="flexslider floated-slideshow">
          <ul class="slides">
            <?php if( get_post_meta(get_the_ID(),'brad_video_embed',true) != ''):?>
            <li>
              <div class="video"><?php echo get_post_meta(get_the_ID(),'brad_video_embed',true);?></div>
            </li>
            <?php endif; ?>
            <?php if(!empty($images)):
		    foreach( $images as $image ){
			$src = wp_get_attachment_image_src( $image , $img_type);
			$full_image = wp_get_attachment_image_src( $image , '');
			$src_info = wp_get_attachment_metadata( $image );
			if( is_array($src_info) && !empty($src_info)){
				$metadata = ' width="'.$src_info['width'].'" height="'.$src_info['height'].'" ';
			}
			else{
				$metadata = '';
			}?>
            <li>
              <div class="image hoverlay">
                   <a href="<?php the_permalink(); ?>"><img src="<?php echo $src[0];?>" <?php echo $metadata;?> alt="<?php the_title();?>" /></a>
                   <div class="overlay">
                       <div class="overlay-content"><a class="icon" title="<?php the_title(); ?>"  href="<?php echo $full_image[0];?>" rel="prettyPhoto[post<?php the_ID();?>]"><i class="fa-search"></i></a></div>
                   </div>
               </div>
            </li>
            <?php } endif; ?>
            <?php if(has_post_thumbnail()): ?>
            <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), ''); ?>
            <li>
              <div class="image hoverlay">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($img_type); ?></a>
                <?php if( $brad_data['blog_lightbox']): ?>
                <div class="overlay">
                  <div class="overlay-content"> <a class="icon" title="<?php the_title(); ?>"  href="<?php echo $full_image[0];?>" rel="prettyPhoto[post<?php the_ID();?>]"><i class="fa-search"></i></a> </div>
                </div>
                <?php endif; ?>
              </div>
            </li>
            <?php endif; ?>
          </ul>
        </div>
        <?php endif; ?>
        
        <div class="post-text-container">
           <?php switch( get_post_format($post -> ID)) {
		   case 'quote' : ?>
           <div class="grid-post-format-container">
               <div class="post-format-blockquote">
                   <i class="ss-air ss-quote"></i>
                   <?php the_content(); ?>
               </div>
           </div> 
		   <?php 
		   break;
		   case 'link' : ?>
		   <div class="grid-post-format-container">
               <div class="post-format-blockquote">
                   <i class="ss-air ss-link"></i>
                   <blockquote><?php the_content(); ?></blockquote>
               </div>
           </div> 
           <?php
		   break;
		   default :  ?> 
           
          <div class="post-meta">
            <h5><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'brad'), the_title_attribute('echo=0') ); ?>">
              <?php the_title(); ?>
              </a></h5>
            <?php if($brad_data['check_author'] ||  $brad_data['check_blog_categories'] ):?>
            <div class="post-meta-data">
              <?php if($brad_data['check_author']):?>
              <span> <?php echo __('By','brad');?>
              <?php the_author_posts_link(); ?>
              </span>
              <?php endif; ?>
              <?php if($brad_data['check_blog_categories']):?>
              <span class="divider">|</span><span> In
              <?php the_category(' , '); ?>
              </span>
              <?php endif; ?>
            </div>
            <?php endif; ?>
            <p class="excerpt"> <?php echo get_the_excerpt(); ?></p>
          </div>
          <?php break;?>
           <?php } ?>  
          <?php if( comments_open() || $brad_data['check_blog_date']): ?>
          <div class="post-text-bottom">
            <?php if($brad_data['check_blog_date']):?>
            <span class="post-date"><?php echo get_the_date();?></span>
            <?php endif; ?>
            <?php if ( comments_open() ) : ?>
            <?php comments_popup_link('<i class="ss-air ss-chat"></i> 0','<i class="ss-air ss-chat"></i> 1', '<i class="ss-air ss-chat"></i>  %' ,'comments-info'); ?>
            <?php endif; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </li>
  <?php  endwhile; ?>
</ul>

<p class="hidden">
  <?php posts_nav_link(); ?>
</p>

<?php if( $brad_data['blog_pagination'] == 'ifscroll' || $brad_data['blog_pagination'] == 'loadmore'){
		echo '<div id="infinite_scroll_loading"></div>';
	    $brad_includes['load_infiniteScroll'] = true ;
     }
	 
     if( $brad_data['blog_pagination'] == 'default' || $brad_data['blog_pagination'] == 'ifscroll' || $brad_data['blog_pagination'] == 'loadmore'):
			   $p_class =  $brad_data['blog_pagination'] == 'default' ? '' : 'hidden';
               brad_pagination($pages = '' , $range = 2 , true , $p_class);
            endif;	 
 

     if( $brad_data['blog_pagination'] == 'loadmore' ):
                echo  '<p id="load_more" class="sp-container aligncenter"><a  href="#" class="button button_alternatelight icon-align-left" title="'.__('Load More Posts..','brad').'">'.__('Load More','brad').'</a></p>';
           endif;

?> 
</div>
<?php } ?>
<?php endif; ?>