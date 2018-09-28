<?php 
global $brad_data;
$menu_class = isset($brad_data['show_nav_divi']) ? 'yes' : 'no'; 
if(has_nav_menu('main_navigation')){
    wp_nav_menu(array('theme_location' => 'main_navigation','depth' => 3 ,  'items_wrap' => '%3$s' , 'container' => false, 'menu_id' => 'main_menu','menu_class' => 'main_menu nav-divider-'.$menu_class,'walker' => new Brad_Megamenu_walker )); }
 else {
   echo '<div class="no-menu">'.__("Please assign a menu to the Main Menu in Appearance > Menus", "brad").'</div>';	
     }
?>