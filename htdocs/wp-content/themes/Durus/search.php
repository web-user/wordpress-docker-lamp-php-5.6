<?php  get_header(); ?>

<?php global $brad_data , $post ;

if(  $brad_data['select_blogsidebar'] == 'sidebar-left') {
		$content_css = 'sidebar-right';
		$sidebar_css = 'sidebar-left';
	} else {
		$content_css = 'sidebar-left';
		$sidebar_css = 'sidebar-right';
	}
?>

<section class="section-with-sidebar">
  <div class="container">
    <div class="row-fluid">
      <div id="content" class="content span9  <?php echo $content_css;?>">
        <div class="inner-content">   
           <div class="search-results-box">
           <h4 class="textuppercase"><?php echo __('New Search' , 'brad');?></h4>
           <p><?php echo __('To Refine Your Search Change your search text Below','brad');?></p>
           <form action="<?php echo home_url(); ?>/" id="searchform" class="search-form" method="get">
           <div>
           <input type="text" id="s" name="s" value="<?php echo @$_GET['s'];?>" autocomplete="off" />
           <input type="submit" value="search" class="hidden" />
           </div>
           </form>
           </div>
           <div class="post-search-container">
           <?php $search_query = new WP_Query("s=$s&showposts=-1"); 
		         $key = esc_html($s, 1); 
				 $count = $search_query->post_count; 
				 if( $count == 0 ){
					 $count = __('No','brad');
				 }
				 wp_reset_query(); 
		   ?>
		   <?php if ($count == 1) : ?>
           <h4><?php printf(__('%1$s result found for: <span>%2$s</span></h1>', 'brad'), $count , $key ); ?></h4>
		   <?php else : ?>
		   <h4><?php printf(__('%1$s results found for: <span>%2$s</span>', 'brad'), $count, $key ); ?></h4>	
		   <?php endif; ?>  
           <!-- Search Results -->
           <?php if (have_posts()) : while (have_posts()) : the_post();  ?> 
           <div id="post-<?php the_ID(); ?>" <?php post_class(' post-search clearfix'); ?>>
           <?php  if( has_post_thumbnail()) {
			   echo '<div class="search-image">';
               the_post_thumbnail('mini');
			   echo '</div>';   
		     }
		     else if ( get_post_format( $post->ID ) == 'video' ) {
			   echo '<span class="search-type"><i class="fa-facetime-video"></i></span>';
		     }
		     else if ( get_post_format( $post->ID ) == 'gallery' ) {
			   echo '<span class="search-type"><i class="fa-camera"></i></span>';
		     }
		     else if ( get_post_format( $post->ID ) == 'standard' ) {
			   echo '<span class="search-type"><i class="fa-paper-clip"></i></span>';
		     }
		    
			 else if ( get_post_format( $post->ID ) == 'quote' ) {
			   echo '<span class="search-type"><i class="fa-quote-left"></i></span>';
		     }
			 else if ( get_post_format( $post->ID ) == 'link' ) {
			   echo '<span class="search-type"><i class="fa-link"></i></span>';
		     }
		     else{
			   echo '<span class="search-type"><i class="fa-pencil"></i></span>';
		     }
		   ?>
           <div class="search-info">
           <div class="post-meta">
           <h2><a href="<?php the_permalink(); ?>"><?php echo the_title();?></a></h2>
           <div class="post-meta-info post-meta-data">
           <span><?php the_author_posts_link(); ?></span><span class="divider">|</span><span><?php echo get_the_date();?></span>
           </div>
           </div>
           <div class="excerpt"><?php echo get_the_excerpt(); ?></div>
           </div>
           </div>
           <?php endwhile; ?>
           <?php endif;?>
           </div>
           <?php brad_pagination($pages = '', $range = 2); ?>	 
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
</section>

<?php get_footer(); ?>