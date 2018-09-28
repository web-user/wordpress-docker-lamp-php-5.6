<?php  global $brad_data;?>

<?php if($brad_data['check_footerwidgets']){	?>
<footer id="footer">
  <div class="container">
    <div class="row-fluid">
      <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widgets')) : ?>
      <?php endif; ?>
    </div>
  </div>
</footer>
<?php } ?>
<section id="copyright">
  <div class="container">
    <div class="row-fluid">
      <div class="row-fluid">
       <div class="copyright-text span4">
        <?php if($brad_data['textarea_copyright'] != "") { ?>
        <?php echo $brad_data['textarea_copyright']; ?>
        <?php } ?>
      </div>
      <div class="span8 textright">
      <?php if( $brad_data['footer_rightcontent'] == 'menu'){
		  if(has_nav_menu('footer_navigation')){
           wp_nav_menu(array('theme_location' => 'footer_navigation','depth' => 1 , 'container' => false, 'menu_id' => 'footer_menu','menu_class' => 'footer-menu')); 
		   }
	  }
	  elseif ( $brad_data['footer_rightcontent'] == 'social'){
       get_template_part('framework/headers/social-icons');
	  }
	  ?>
        <!-- Top Bar Social Icons END --> 
      </div>
    </div>
   </div>
 </div>
</section>
<!-- end copyright -->

  <?php if( $brad_data['layout'] == 'boxed') { ?>
  </div>
  <!-- End Boxed Layout -->
  <?php  } ?>
   
<?php wp_footer(); ?>
<!-- End footer -->
</body>
</html>