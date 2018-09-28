<?php global $brad_data;  ?>
   <?php  if (have_posts()) : while (have_posts()) : the_post(); ?>
   <?php  $content = get_the_content();
          $shortcode_tree = brad_shortcodeHelper::build_shortcode_tree($content);
		  $shortcode_array = brad_shortcodeHelper::$tree;
		  $first_el = ( is_array($shortcode_array) && !empty($shortcode_array) ) ? $shortcode_array[0] : false ;
		  $last_el = ( is_array($shortcode_array) && !empty($shortcode_array) ) ? end($shortcode_array) : false ;
		  $next_el = brad_shortcodeHelper::find_tree_item(0 , 1 );
   ?>
  <?php if(!$first_el || ( $first_el !== false && !in_array($first_el['shortcode'],array('vc_section','vc_double_section')))):
    brad_shortcodeHelper::$section_count++;
   ?>
   <section id="section_0" class="section post-content">
    <div class="container">
     <div class="row-fluid"> 
    <?php endif; ?>
    <?php the_content(); ?>  
    <?php if( !$last_el || (  $last_el !== false &&  !in_array($last_el['shortcode'],array('vc_section','vc_double_section')))): ?>
       </div>
     </div>
  </section>
  <?php if(!$brad_data['check_disablecomments']): ?>
  <section class="section">
     <div class="container">
        <div class="row-fluid">
       	<?php wp_reset_query(); ?>
	    <?php comments_template(); ?>
        </div>
     </div>
  </section>      
 <?php endif; ?>
 <?php endif; ?>
<?php endwhile; endif; ?>
   
  
