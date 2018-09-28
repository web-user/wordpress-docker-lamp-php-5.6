<?php get_header(); 
  
 if(  get_post_meta( get_the_ID() , 'brad_page_layout' , true ) == 'sidebar') {
	$page_type = 'sidebar';
	} else {
	$page_type = 'full-width';
	}
 ?>


<?php get_template_part( 'framework/templates/page/content', $page_type ); ?>

<?php get_footer(); ?>