<?php global $brad_data; ?>
<?php 
if(has_nav_menu('top_navigation')){
    wp_nav_menu(array('theme_location' => 'top_navigation','depth' => 1 , 'container' => false, 'menu_id' => 'top_menu','menu_class' => 'top-menu')); }
 else {
   echo '<div class="no-menu">'.__("Please assign a menu to the Top Menu in Appearance > Menus", "brad").'</div>';	
     }
?>