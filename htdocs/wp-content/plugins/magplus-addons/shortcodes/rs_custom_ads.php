<?php
/**
 *
 * Custom Ads
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if( ! function_exists( 'rs_custom_ads' ) ) {
  function rs_custom_ads( $atts, $content = '', $key = '' ) {
    return rawurldecode( base64_decode( strip_tags( $content ) ) );
  }
  add_shortcode( 'rs_custom_ads', 'rs_custom_ads' );
  add_shortcode( 'rs_custom_ads', 'rs_custom_ads' );
}