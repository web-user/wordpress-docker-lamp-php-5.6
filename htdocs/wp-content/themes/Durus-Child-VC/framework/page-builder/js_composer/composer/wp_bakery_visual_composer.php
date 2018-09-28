<?php
/**
 * WPBakery Visual Composer Here includes useful files for plugin
 *
 * @package WPBakeryVisualComposer
 *
 */

$lib_dir = $composer_settings['COMPOSER_LIB'];
$shortcodes_dir = $composer_settings['SHORTCODES_LIB'];


require_once( $lib_dir . 'abstract.php' );
require_once( $lib_dir . 'helpers.php' );
require_once( $lib_dir . 'helpers_api.php' );
require_once( $lib_dir . 'params.php' );
require_once( $lib_dir . 'mapper.php' );
require_once( $lib_dir . 'shortcodes.php' );
require_once( $lib_dir . 'composer.php' );


/* Add shortcodes classes */

require_once( $shortcodes_dir . 'column.php' );
require_once( $shortcodes_dir . 'row.php' );
require_once( $shortcodes_dir . 'box.php' );
require_once( $shortcodes_dir . 'section.php' );
require_once( $shortcodes_dir . 'testimonials.php' );
require_once( $shortcodes_dir . 'feature_boxes.php' );
require_once( $shortcodes_dir . 'teaser.php' );
require_once( $shortcodes_dir . 'contact_form.php' );
//require_once( $shortcodes_dir . 'product_carousel.php' );
//require_once( $shortcodes_dir . 'content_carousel.php' );
require_once( $shortcodes_dir . 'blog_list.php' );
require_once( $shortcodes_dir . 'blog.php' );
require_once( $shortcodes_dir . 'clients.php' );
require_once( $shortcodes_dir . 'counters.php' );
require_once( $shortcodes_dir . 'person.php' );
require_once( $shortcodes_dir . 'portfolio.php' );
require_once( $shortcodes_dir . 'portfolio_carousel.php' );
require_once( $shortcodes_dir . 'posts_carousel.php' );
require_once( $shortcodes_dir . 'custom.php' );
require_once( $shortcodes_dir . 'tabs.php' );
require_once( $shortcodes_dir . 'quotes_slider.php' );
require_once( $shortcodes_dir . 'accordion.php' );
require_once( $shortcodes_dir . 'button.php' );
require_once( $shortcodes_dir . 'cta_button.php' );
require_once( $shortcodes_dir . 'social_share.php' );
require_once( $shortcodes_dir . 'google_maps.php' );
require_once( $shortcodes_dir . 'image_gallery.php' );
require_once( $shortcodes_dir . 'layerslider.php' );
require_once( $shortcodes_dir . 'message_box.php' );
require_once( $shortcodes_dir . 'progress_bar.php' );
require_once( $shortcodes_dir . 'raw_content.php' );
require_once( $shortcodes_dir . 'rev_slider.php' );
require_once( $shortcodes_dir . 'separator.php' );
require_once( $shortcodes_dir . 'single_image.php' );
require_once( $shortcodes_dir . 'text.php' );
require_once( $shortcodes_dir . 'toggle_faq.php' );
require_once( $shortcodes_dir . 'tour.php' );
require_once( $shortcodes_dir . 'pie.php' );

//require_once( $shortcodes_dir . 'example.php' );

require_once( $lib_dir . 'layouts.php' );

require_once( $lib_dir . 'params/load.php');
