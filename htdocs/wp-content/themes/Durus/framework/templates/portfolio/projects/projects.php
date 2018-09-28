<?php global $brad_data , $post; ?>

<?php if (have_posts()) : ?>

<div class="portfolio">
  <div class="row-fluid portfolio-items filterable-items portfolio-<?php echo $brad_data['portfolio_style'];?> columns-<?php echo $brad_data['portfolio_columns'];?>" data-columns="<?php echo $brad_data['portfolio_columns']; ?>" data-fullwidth="no" data-animation-delay="" data-animation-effect="">
    <?php 
	$args = array(
	       'portfolio_style' => $brad_data['portfolio_style'] ,
		   'class'  => 'span' ,
		   'img_size' =>  brad_get_img_size($brad_data['portfolio_columns']) ,
		   'disable_lb_icon' => $brad_data['portfolio_lightbox'] == true ? 'no' : 'yes' ,
		   'disable_li_icon' => $brad_data['portfolio_linkicon'] == true ? 'no' : 'yes',
		   'disable_li_title' => 'no' ,
		   'show_categories' => $brad_data['portfolio_categories'] == true ? 'yes' : 'no' ,
		   'overlay_style' => 'style'
		   ); 
	while (have_posts()) : the_post();  
      echo brad_portfolio_loop_style1( $post , $args);
    endwhile; ?>
  </div>
</div>
<?php endif; ?>
<?php brad_pagination($pages = '', $range = 2); ?>