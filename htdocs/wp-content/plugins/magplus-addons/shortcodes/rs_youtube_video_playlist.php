<?php
/**
 *
 * RS Youtube Playlist
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_youtube_video_playlist( $atts, $content = '', $id = '' ) {
  extract( shortcode_atts( array(
    'id'         => '',
    'class'      => '',
    'channel_id' => '',
    'height'     => ''
  ), $atts ) );

  $id           = ( $id ) ? ' '.esc_attr($id) : '';
  $class        = ( $class ) ? ' '. $class : '';
  $height_style = ($height) ? ' style="height:'.esc_attr($height).';"':'';

  $output = '';
  if(!empty($channel_id)):
    wp_enqueue_script('yt-playlist');
    wp_enqueue_style('ytv-playlist');
    $output .= '<div id="frame'.$id.'" class="yt-playlist'.$class.'" '.$height_style.' data-channel-id="'.esc_attr($channel_id).'"></div>';
  endif;
  return $output;

}
add_shortcode( 'rs_youtube_video_playlist', 'rs_youtube_video_playlist' );
