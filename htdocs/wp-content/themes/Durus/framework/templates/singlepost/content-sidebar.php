<?php
   global $brad_data; 
   if($brad_data['select_blogsidebar'] == 'sidebar-left' ) {
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
        <div id="content" class="content span9  <?php echo $content_css;?>">
            <div class="inner-content">
            <?php get_template_part("framework/templates/singlepost/singlepost"); ?>
             </div>
           </div>
          <div id="sidebar" class="span3 sidebar <?php echo $sidebar_css; ?>" style="">
          <div class="inner-content">
          <?php
		    if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Blog Sidebar')): 
		    endif;
		   ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>