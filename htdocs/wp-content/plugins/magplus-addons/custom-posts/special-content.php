<?php
/**
 * Special Content
 */
$labels = array(
    'name'               => esc_html__( 'Special Content', 'magplus-pro-addons' ),
    'singular_name'      => esc_html__( 'Special Content', 'magplus-pro-addons' ),
    'add_new'            => esc_html__( 'Add New','magplus-pro-addons' ),
    'add_new_item'       => esc_html__( 'Add New Item','magplus-pro-addons' ),
    'edit_item'          => esc_html__( 'Edit Item','magplus-pro-addons' ),
    'new_item'           => esc_html__( 'New Item','magplus-pro-addons' ),
    'all_items'          => esc_html__( 'All Items','magplus-pro-addons' ),
    'view_item'          => esc_html__( 'View Item','magplus-pro-addons' ),
    'search_items'       => esc_html__( 'Search Special Content Items','magplus-pro-addons' ),
    'not_found'          => esc_html__( 'No Special Content items found','magplus-pro-addons' ),
    'not_found_in_trash' => esc_html__( 'No Special Content items found in the Trash','magplus-pro-addons' ),
    'parent_item_colon'  => '',
    'menu_name'          => esc_html__( 'Special Content', 'magplus-pro-addons' ),
);

$args = array(
  'labels'        => $labels,
  'public'        => false,
  'show_ui'       => true,
  'menu_position' => 21,
  'supports'      => array( 'title', 'editor' ),
  'has_archive'   => false,
  'rewrite' => array(
    'slug' => 'cpt-special-content'
  )
);
register_post_type( 'special-content', $args );