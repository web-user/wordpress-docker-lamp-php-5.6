<?php
// Template Name: Side Navigation
?>
<?php  get_header(); ?>
<?php
global $brad_data;
if(get_post_meta($post->ID, 'brad_sidenav_position', true) == 'left') {
		$content_css = 'content-right';
		$sidebar_css = 'sidebar-left';
	} else {
		$content_css = 'content-left';
		$sidebar_css = 'sidebar-right';
	}
?>

<section class="section-with-sidebar">
  <div class="container">
    <div class="row-fluid">
      <div class="row-fluid">
        <div id="content" class="span9 content <?php echo $content_css;?>">
          <div class="inner-content">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content();?>
            <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
            <?php if(!$brad_data['check_disablecomments']) { ?>
            <?php comments_template(); ?>
            <?php } ?>
            <?php endwhile; endif; ?>
          </div>
        </div>
        <div id="sidebar" class="span3 sidebar <?php echo $sidebar_css; ?>" style="">
          <div class="inner-content">
            <ul class="side-navigation">
              <?php 	
				$post_ancestors = get_post_ancestors($post->ID);
				$post_parent = end($post_ancestors);
			?>
              <li  <?php if(is_page($post_parent)): ?>class="current_page_item"<?php endif; ?>><a href="<?php echo get_permalink($post->post_parent); ?>" title="Back to Parent Page"><?php echo get_the_title($post->post_parent); ?> </a></li>
              <?php
			if($post_parent) {
				$children = wp_list_pages("title_li=&child_of=".$post_parent."&echo=0");
			} else {
				$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
			}
			
			if ($children) { echo $children;  } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php  get_footer(); ?>
