<?php  global $brad_data; ?>
<?php 
if (have_posts()) : 
    while (have_posts()) : the_post(); 
        get_template_part('framework/templates/blog/postformats/post' , get_post_format());
    endwhile;
endif; 
?>

<?php brad_pagination($pages = '', $range = 2); ?>
<p class="hidden">
  <?php posts_nav_link(); ?>
</p>
