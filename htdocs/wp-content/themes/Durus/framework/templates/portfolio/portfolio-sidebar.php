<?php global $brad_data ;

if(  $brad_data['portfolio_sidebar_position'] == 'sidebar-left') {
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
          <?php get_template_part( 'framework/templates/portfolio/projects/projects' ); ?>
        </div>
      </div>
      <div id="sidebar" class="span3 sidebar <?php echo $sidebar_css; ?>" style="">
        <div class="inner-content">
         <?php generated_dynamic_sidebar($brad_data['portfolio_sidebar']); ?>
        </div>
      </div>
     </div>
    </div>
  </div>
</section>
