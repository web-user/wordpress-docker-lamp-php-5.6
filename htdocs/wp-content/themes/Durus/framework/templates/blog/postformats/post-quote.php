<?php global $brad_data; ?>
<?php  global $post; ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(' post-standard post-standard-no-border clearfix '); ?>>
 
  <div class="post-format-container">
  <div class="post-format-blockquote">
  <i class="ss-air ss-quote"></i>
    <?php the_content(); ?>
  </div>


 <div class="post-format-meta">
    <?php if( $brad_data['check_readmore'] ): ?>
  <a href="<?php the_permalink(); ?>#post_content" class="button button_alternatelight button_small"> <?php echo __('Read More','brad');?><i class="icon-arrow-right8"></i></a>
  <?php endif; ?>
  <div class="post-meta-data"> <span><?php echo __("Posted By:","brad");?>
    <?php the_author_posts_link(); ?>
    </span>
    <?php if(has_category() && $brad_data['check_blog_categories'] == true ):?>
    <span class="divider">|</span><span><?php echo __('Posted In:','brad');?>
    <?php the_category(' , '); ?>
    </span>
    <?php endif; ?>
    <?php if($brad_data['check_blog_date'] == true): ?>
    <span class="divider">|</span><span>
    <?php the_date();?>
    </span>
    <?php endif; ?>
    <?php if ( comments_open() ) : ?>
    <span class="divider">|</span><span>
    <?php comments_popup_link('<i class="ss-air ss-chat"></i> 0','<i class="ss-air ss-chat"></i> 1', '<i class="ss-air ss-chat"></i>  %' ,'comments-info'); ?>
    </span>
    <?php endif; ?>
  </div>
  </div>

</div>
</div>