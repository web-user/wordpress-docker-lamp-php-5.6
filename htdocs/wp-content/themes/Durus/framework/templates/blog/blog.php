<?php global $brad_data; ?>

<?php
  switch ( $brad_data['blog_type'] ) {
    case 'grid' :
    $blog_type = 'grid';
	break;
	break;
	case 'timeline' :
	$blog_type = 'timeline';
	break;	
	default :
	$blog_type = 'standard';
	break;
}
	?>
    
<section class="section">
  <div class="container">
    <div class="row-fluid">
      <?php get_template_part( 'framework/templates/blog/posts/posts', $blog_type ); ?>
    </div>
  </div>
</section>
        
  
