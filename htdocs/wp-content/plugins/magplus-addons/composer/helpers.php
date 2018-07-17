<?php

/**
 *
 * Hex to Rgba
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'rs_hex2rgba' ) ) {
  function rs_hex2rgba( $hexcolor, $opacity = 1 ) {

    $hex    = str_replace( '#', '', $hexcolor );

    if( strlen( $hex ) == 3 ) {
      $r    = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
      $g    = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
      $b    = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
    } else {
      $r    = hexdec( substr( $hex, 0, 2 ) );
      $g    = hexdec( substr( $hex, 2, 2 ) );
      $b    = hexdec( substr( $hex, 4, 2 ) );
    }

    return ( isset( $opacity ) && $opacity != 1 ) ? 'rgba('. $r .', '. $g .', '. $b .', '. $opacity .')' : ' ' . $hexcolor;
  }
}

/**
 *
 * Get Font Icons
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( !function_exists('rs_font_icons')) {
  function rs_font_icons() {
    $icons_keys = array();
    $icons      = file_get_contents(RS_ROOT .'/composer/assets/font/font-icon.json');
    $icons      = json_decode($icons, true);
    return $icons;
  }
}

/**
 *
 * Set WPAUTOP for shortcode output
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'rs_set_wpautop' ) ) {
  function rs_set_wpautop( $content, $force = true ) {
    if ( $force ) {
      $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
    }
    return do_shortcode( shortcode_unautop( $content ) );
  }
}

/**
 *
 * element values post, page, categories
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'rs_element_values' ) ) {
  function rs_element_values(  $type = '', $query_args = array() ) {

    $options = array();

    switch( $type ) {

      case 'pages':
      case 'page':
      $pages = get_pages( $query_args );

      if ( !empty($pages) ) {
        foreach ( $pages as $page ) {
          $options[$page->post_title] = $page->ID;
        }
      }
      break;

      case 'posts':
      case 'post':
      $posts = get_posts( $query_args );

      if ( !empty($posts) ) {
        foreach ( $posts as $post ) {
          $options[$post->post_title] = lcfirst($post->ID);
        }
      }
      break;

      case 'tags':
      case 'tag':

	  if (isset($query_args['taxonomies']) && taxonomy_exists($query_args['taxonomies'])) {
		$tags = get_terms( $query_args['taxonomies'], $query_args['args'] );
		  if ( !is_wp_error($tags) && !empty($tags) ) {
			foreach ( $tags as $tag ) {
			  $options[$tag->name] = $tag->term_id;
		  }
		}
	  }
      break;

      case 'categories':
      case 'category':

	  if (isset($query_args['taxonomy']) && taxonomy_exists($query_args['taxonomy'])) {
		$categories = get_categories( $query_args );
  		if ( !empty($categories) && is_array($categories) ) {

  		  foreach ( $categories as $category ) {
  			 $options[$category->name] = $category->term_id;
  		  }
  		}
	  }
      break;

      case 'custom':
      case 'callback':

      if( is_callable( $query_args['function'] ) ) {
        $options = call_user_func( $query_args['function'], $query_args['args'] );
      }

      break;

    }

    return $options;

  }
}
/**
 *
 * Get Bootstrap Col
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'rs_get_bootstrap_col' ) ) {
  function rs_get_bootstrap_col( $width = '' ) {
    $width = explode('/', $width);
    $width = ( $width[0] != '1' ) ? $width[0] * floor(12 / $width[1]) : floor(12 / $width[1]);
    return  $width;
  }
}

/**
 * Get font choices for theme options
 * @param bool $return_string if true returned array is strict, example array item: font_name => font_label
 * @return array
 */
if(!function_exists('rs_get_font_choices')) {
  function rs_get_font_choices($return_strict = false) {
    $aFonts = array(
      array(
        'value' => 'default',
        'label' => esc_html__('Default', 'animo-addons'),
        'src' => ''
      ),
      array(
        'value' => 'Verdana',
        'label' => 'Verdana',
        'src' => ''
      ),
      array(
        'value' => 'Geneva',
        'label' => 'Geneva',
        'src' => ''
      ),
      array(
        'value' => 'Proxima Nova',
        'label' => 'Proxima Nova',
        'src' => ''
      ),
      array(
        'value' => 'Arial',
        'label' => 'Arial',
        'src' => ''
      ),
      array(
        'value' => 'Arial Black',
        'label' => 'Arial Black',
        'src' => ''
      ),
      array(
        'value' => 'Trebuchet MS',
        'label' => 'Trebuchet MS',
        'src' => ''
      ),
      array(
        'value' => 'Helvetica',
        'label' => 'Helvetica',
        'src' => ''
      ),
      array(
        'value' => 'sans-serif',
        'label' => 'sans-serif',
        'src' => ''
      ),
      array(
        'value' => 'Georgia',
        'label' => 'Georgia',
        'src' => ''
      ),
      array(
        'value' => 'Times New Roman',
        'label' => 'Times New Roman',
        'src' => ''
      ),
      array(
        'value' => 'Times',
        'label' => 'Times',
        'src' => ''
      ),
      array(
        'value' => 'serif',
        'label' => 'serif',
        'src' => ''
      ),
    );

    if (file_exists(RS_ROOT . '/composer/google-fonts.json')) {

      $google_fonts = file_get_contents(RS_ROOT . '/composer/google-fonts.json', true);
      $aGoogleFonts = json_decode($google_fonts, true);

      if (!isset($aGoogleFonts['items']) || !is_array($aGoogleFonts['items'])) {
        return;
      }

      $aFonts[] = array(
        'value' => 'google_web_fonts',
        'label' => '---Google Web Fonts---',
        'src' => ''
      );

      foreach ($aGoogleFonts['items'] as $aGoogleFont) {
        $aFonts[] = array(
          'value' => 'google_web_font_' . $aGoogleFont['family'],
          'label' => $aGoogleFont['family'],
          'src' => ''
        );
      }
    }

    if ($return_strict) {
      $aFonts2 = array();
      foreach ($aFonts as $font) {
        $aFonts2[$font['value']] = $font['label'];
      }
      return $aFonts2;
    }
    return $aFonts;
  }
}


/**
 * Get custom term values array
 * @param type $type
 * @return type
 */
function rs_get_custom_term_values($type) {

	$items = array();
	$terms = get_terms($type, array('orderby' => 'name'));
	if (is_array($terms) && !is_wp_error($terms)) {
		foreach ($terms as $term) {
			$items[$term -> name] = $term -> term_id;
		}
	}
	return $items;
}

/**
 * Plugin Path
 * @param type $type
 * @return type
 */
if(!function_exists('rs_plugin_part')) {
  function rs_plugin_part($url) {
    if(empty($url)) { return; }
    return include(plugin_dir_path( __FILE__ ).$url);
  }
}

/**
 * Get space array
 * @param type $type
 * @return array
 */
if(!function_exists('rs_get_space_array')) {
  function rs_get_space_array() {
    $space_array = array('Select Height' => '');
    for($i = 0; $i < 215;) {
      $space_array[] = $i;
      $i = $i + 5;
    }
    return $space_array;
  }
}

/**
 * Return URL
 * @param type $type
 * @return array
 */
if(!function_exists('rs_get_image_src')) {
  function rs_get_image_src( $id ) {
    if(empty($id)) { return ; }
    $image_src = (is_numeric($id)) ? wp_get_attachment_url($id):$id;
    return $image_src;
  }
}
