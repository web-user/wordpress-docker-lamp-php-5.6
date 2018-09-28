<?php  get_header(); ?>

<?php 
  global $brad_data ; 
  if( $brad_data['blog_layout'] == 'sidebar' ) {
      $page_type = 'sidebar';
	  } 
  else {
      $page_type = '';
	  }
?>

<?php 
    if( $brad_data['blog_type'] === 'fullwidthAlternate' ) { 
	    get_template_part( 'framework/templates/blog/posts/posts','fullwidthAlternate');
		}
	else { 
	    get_template_part( 'framework/templates/blog/blog', $page_type ); 
		} 
?>

<?php get_footer(); ?>
