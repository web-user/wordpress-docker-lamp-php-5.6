<?php  get_header(); ?>

<?php global $brad_data ;

if(  $brad_data['portfolio_layout'] == 'sidebar') {
		$portfolio_layout = 'sidebar';
	} else {
		$portfolio_layout = '';
	}
?>


<?php get_template_part('/framework/templates/portfolio/portfolio',$portfolio_layout);?>

<?php get_footer(); ?>