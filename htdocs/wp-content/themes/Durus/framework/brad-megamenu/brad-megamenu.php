<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
	
/*--------------------------------------------------*/
/* Brad Mega Menu Class ( Copyright bradweb)
/*--------------------------------------------------*/

class brad_megaMenu {
    
	// Intialize the class 
    function __construct() {

        add_filter( 'wp_setup_nav_menu_item', array( $this, 'brad_megamenu_nav_setup' ) );
		add_action( 'wp_update_nav_menu_item', array( $this, 'brad_megamenu_nav_update'), 10, 3 );
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'brad_megamenu_nav_edit_walker'), 10, 2 );
		add_action( 'admin_print_footer_scripts', array( $this, 'brad_megamenu_scripts' ), 99 );
		add_action( 'admin_print_styles-nav-menus.php', array( $this, 'brad_megamenu_styles' ), 15 );
		add_action( 'admin_print_styles', array( $this , 'admin_init_css'));
		add_action( 'admin_print_scripts', array( $this , 'admin_init_js'));
	
      } 
	
	//Mega menu setup
	function brad_megamenu_nav_setup ( $menu_item ) {
		//common fields
		$menu_item->brad_megamenu_icon = get_post_meta( $menu_item->ID, '_menu_item_brad_megamenu_icon', true );
		$menu_item->brad_is_megamenu = get_post_meta( $menu_item->ID, '_menu_item_brad_is_megamenu', true );
		
		//Second Level
		$menu_item->brad_megamenu_hide_title = get_post_meta( $menu_item->ID, '_menu_item_brad_megamenu_hide_title', true );
		return $menu_item;
	}
	
	//Mega Menu udate fields	
    function brad_megamenu_nav_update( $menu_id,$menu_item_db_id, $args ) {
		
        // Check if element is properly sent
		if ( isset( $_REQUEST['menu-item-brad-icon'][$menu_item_db_id]) ) {
		    $icon_value = $_REQUEST['menu-item-brad-icon'][$menu_item_db_id];
		    update_post_meta( $menu_item_db_id, '_menu_item_brad_megamenu_icon', $icon_value );
		 }
		
		    
		if ( isset( $_REQUEST['menu-item-brad-is-megamenu'][$menu_item_db_id]) ) {
		    update_post_meta( $menu_item_db_id, '_menu_item_brad_is_megamenu', 1 );
		} else {
		    update_post_meta( $menu_item_db_id, '_menu_item_brad_is_megamenu', 0 );
		 }
		 
		if ( isset( $_REQUEST['menu-item-brad-hide-title'][$menu_item_db_id]) ) {
		    update_post_meta( $menu_item_db_id, '_menu_item_brad_megamenu_hide_title', 1 );
		} else {
		    update_post_meta( $menu_item_db_id, '_menu_item_brad_megamenu_hide_title', 0 );
		 } 
		    
    }
		
	
   function brad_megamenu_nav_edit_walker($walker,$menu_id) {
		
		    return 'Brad_MegaMenu_Custom_Walker';
		    
		}
	
	function admin_init_css(){
		wp_enqueue_style('thickbox');
		wp_enqueue_style( 'icon-picker', get_template_directory_uri().'/framework/css/icon-picker.css', false, '1.0', 'all' );
		
	}
	
	function admin_init_js(){
		wp_enqueue_script('thickbox');
		
	}
	
   //Required css for mega menu	
   /**
	 * Add some beautiful inline css for admin menus.
	 *
	 */
	function brad_megamenu_styles() {
		$custom_css = '
		    .menu.ui-sortable .brad-megamenu-fields p {
				display: none;
			}

			.menu.ui-sortable .menu-item-depth-0  .brad-megamenu-fields .brad-megamenu-enable-field ,
			.menu.ui-sortable .brad-megamenu-fields .brad-megamenu-icon-field ,
			.menu.ui-sortable .menu-item-depth-1.brad-megamenu-enabled  .brad-megamenu-fields .brad-megamenu-hide-title-field  {
				display: block;
			}
		   
		';
		
		wp_add_inline_style( 'wp-admin', $custom_css );
	}

		
   //Required Javascript For Megamenu
   function brad_megamenu_scripts() {
	   global $ss_air, $ss_social , $fa_icons;

		?>
       <div id="brad_megamenu_iconpicker" style="display:none">
       <div class="brad_megamenu_iconpicker_wrapper">
       <div class="vc-icon-option wpb-icon-prefix">
       <?php
	   if( !empty( $ss_air)){
		   foreach( $ss_air as $k => $ss_icon){
			    echo '<i class="ss-air '.$ss_icon.'" data-icon="'.$k.'|ss-air"></i>';
		      }
	    }
		
		if( !empty($fa_icons)) {
	        foreach( $fa_icons as $k => $fontawesome_icon) { 
	           echo '<i class="'.$fontawesome_icon.'" data-icon="'.$k.'|fontawesome"></i>';
	             }
	     }
	
	     if( !empty( $ss_social)){
		     foreach( $ss_social as $k => $ss_icon){
			    echo '<i class="ss-social-regular '.$ss_icon.'" data-icon="'.$k.'|ss-social"></i>';
		           }
	      }
		   
	   ?>
       </div>
       </div>
       </div> 
      <script type="text/javascript">
		  jQuery(function(){
		  var brad_megamenu = {
			reinit_events : false ,  
			init_events : function(){
				var current_brad_megamenu_icon_el = null ;
			    
				jQuery('.brad-megamenu-iconpicker-button').on('click',function(e){
					var input_id = jQuery(this).attr('data-uid'),
						tb_title = jQuery(this).attr('title');
						current_brad_megamenu_icon_el = jQuery('#edit-menu-item-icon-'+ input_id );
					    tb_show( tb_title , '#TB_inline?width=600&height=400&inlineId=brad_megamenu_iconpicker');
					    return false;
				});
				 
				
			   jQuery('.brad_megamenu_iconpicker_wrapper .vc-icon-option i').live('click', function(e) {
			       e.preventDefault();
				   current_brad_megamenu_icon_el.attr('value', jQuery(this).attr('data-icon'));
				   window.parent.tb_remove();
				});
					    
				var brad_menu_items =  jQuery('.menu-item', '#menu-to-edit');
				brad_menu_items.each(function(i) {
					var current_item = jQuery(this);
					if(!current_item.is('.menu-item-depth-0')){
					    if( brad_menu_items.filter(':eq('+(i-1)+')').is('.brad-megamenu-enabled')){
							current_item.addClass('brad-megamenu-enabled');
						}
						else{
							current_item.removeClass('brad-megamenu-enabled');
						}
						
					}
                });
				
			},
			
			init : function(){
				jQuery('.edit-menu-item-brad-is-megamenu').on('click',function(){
			        if(jQuery(this).is(':checked')){
				        jQuery(this).parents('.menu-item-depth-0').addClass('brad-megamenu-enabled');
					 }
					else{
					    jQuery(this).parents('.menu-item-depth-0').removeClass('brad-megamenu-enabled');
				     }
				 });
				  brad_megamenu.init_events();
			}
			
		  }
		
		brad_megamenu.init();
		jQuery( ".menu-item-bar" ).live( "mouseup", function(event, ui) {
	        if ( !jQuery(event.target).is('a') ) {
			     clearTimeout(brad_megamenu.reinit_events);
		         brad_megamenu.reinit_events = setTimeout(brad_megamenu.init() , 700);
			}
	    });
		
	});
</script>
        
        <?php
	}
			
	
	}
	
	
	// initialiaze the menu class
	$GLOBALS['brad_megamenu'] = new brad_megaMenu();
	
	
	include_once( 'edit_custom_walker.php' );
	include_once( 'custom_menu.php');	
?>