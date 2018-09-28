<?php 
    
function brad_custom_js(){
    global $brad_data;
    ?>
<!-- Custom Scripts -->
<script type="text/javascript">
(function($){
    'use strict';
	jQuery(document).ready(function($){
	  var retina = window.devicePixelRatio > 1 ? true : false;
         <?php if($brad_data['media_logo_retina']['url'] && $brad_data['logo_width']): ?>
        if(retina) {
        	jQuery('#logo img').attr('src', '<?php echo $brad_data["media_logo_retina"]['url']; ?>');
        	jQuery('#logo img').css('max-width', '<?php echo $brad_data["logo_width"]; ?>');
        }
        <?php endif; ?>
        
		/* ------------------------------------------------------------------------ */
		/* Add PrettyPhoto */
		/* ------------------------------------------------------------------------ */
		
		var lightboxArgs = {			
			<?php if($brad_data["lightbox_animation_speed"]): ?>
			animation_speed: '<?php echo strtolower($brad_data["lightbox_animation_speed"]); ?>',
			<?php endif; ?>
			overlay_gallery: <?php if($brad_data["lightbox_gallery"]) { echo 'true'; } else { echo 'false'; } ?>,
			autoplay_slideshow: <?php if($brad_data["lightbox_autoplay"]) { echo 'true'; } else { echo 'false'; } ?>,
			<?php if($brad_data["lightbox_slideshow_speed"]): ?>
			slideshow: <?php echo $brad_data['lightbox_slideshow_speed']; ?>, /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			<?php endif; ?>
			<?php if($brad_data["lightbox_theme"]): ?>
			theme: '<?php echo $brad_data['lightbox_theme']; ?>', 
			<?php endif; ?>
			<?php if($brad_data["lightbox_opacity"]): ?>
			opacity: <?php echo $brad_data['lightbox_opacity']; ?>,
			<?php endif; ?>
			show_title: <?php if($brad_data["lightbox_title"]) { echo 'true'; } else { echo 'false'; } ?>,
			<?php if(!$brad_data["lightbox_social"]) { echo 'social_tools: "",'; } ?>
			deeplinking: false,
			allow_resize: true, 			/* Resize the photos bigger than viewport. true/false */
			counter_separator_label: '/', 	/* The separator for the gallery counter 1 "of" 2 */
			default_width: 1140,
			default_height:640
		};

		jQuery("a[rel^='prettyPhoto']").prettyPhoto(lightboxArgs);
	
	
		<?php if($brad_data["lightbox_smartphones"] == 1): ?>
		var windowWidth = 	window.screen.width < window.outerWidth ?
                  			window.screen.width : window.outerWidth;
        var mobile = windowWidth < 500;
        
        if(mobile){
	        jQuery("a[rel^='prettyPhoto']").unbind('click.prettyphoto');
        }
        <?php endif; ?>
	});
}(jQuery))	
</script>
        <?php
	}
	
	add_action( 'wp_footer', 'brad_custom_js', 100 );
?>