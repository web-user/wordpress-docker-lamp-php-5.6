<?php global $brad_includes , $post; ?>
<?php get_header(); ?>
<?php while(have_posts()): the_post(); ?>
<?php get_template_part('framework/templates/single-portfolio/portfolio',get_post_meta(get_the_ID(),'brad_project_type',true)) ;?>
<?php $relatedProjects = brad_get_related_projects(get_the_ID()); ?>
<?php if ( get_post_meta(get_the_ID(),'brad_portfolio-relatedposts',true) && $relatedProjects->have_posts() ) : ?>
<?php $brad_includes['load_caroufred'] = true; ?>

<section class="section section-border-yes" style="background-color:#f7f7f7; padding-bottom:80px;">
  <div class="container">
    <div class="row-fluid">
      <h3 class="textuppercase textcenter"><?php echo __('Related Projects','brad');?></h3>
      <div class="hr double-border border-tiny aligncenter" style="margin-bottom:35px"></div>
      <div class="carousel-container"> <a class="carousel-prev"></a> <a class="carousel-next"></a>
        <div class="carousel-wrapper carousel-padding-no">
          <ul class="carousel-items portfolio-items row portfolio-style2 element-padding-no bottom-margin-yes" data-columns="3">
            <?php 
			$args = array(
	       'portfolio_style' => 'style2' ,
		   'class'  => 'span' ,
		   'img_size' => brad_get_img_size(3) ,
		   'disable_lb_icon' => 'no' ,
		   'disable_li_icon' => 'yes',
		   'disable_li_title' => 'no',
		   'show_categories' => 'yes' ,
		   'overlay_style' => ''
		   );
	        while($relatedProjects->have_posts()): $relatedProjects->the_post();
                echo brad_portfolio_loop_style1( $relatedProjects , $args);
            endwhile ; ?>
                  <?php wp_reset_query(); ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php if(!$brad_data['check_disablecomments']): ?>
<section class="section">
  <div class="container">
    <div class="row-fluid">
      <?php comments_template(); ?>
    </div>
  </div>
</section>
<?php endif; ?>
<div class="page-nav-prev"><?php previous_post_link('%link' ,'<i class="fa-arrow-thin-left"></i>'); ?></div>
<div class="page-nav-next"><?php next_post_link('%link' , '<i class="fa-arrow-thin-right"></i>'); ?></div>
<?php endwhile; ?>
<?php get_footer(); ?>
