<?php

if ( ! function_exists('bgt_cpt_place') ) {

// Register Custom Post Type
function bgt_cpt_place() {

	$labels = array(
		'name'                  => _x( 'Place', 'Place', 'free4rest' ),
		'singular_name'         => _x( 'Place', 'Place', 'free4rest' ),
		'menu_name'             => __( 'Place', 'free4rest' ),
		'name_admin_bar'        => __( 'Place', 'free4rest' ),
		'archives'              => __( 'Item Archives', 'free4rest' ),
		'attributes'            => __( 'Item Attributes', 'free4rest' ),
		'parent_item_colon'     => __( 'Parent Item:', 'free4rest' ),
		'all_items'             => __( 'All Items', 'free4rest' ),
		'add_new_item'          => __( 'Add New Item', 'free4rest' ),
		'add_new'               => __( 'Add New', 'free4rest' ),
		'new_item'              => __( 'New Item', 'free4rest' ),
		'edit_item'             => __( 'Edit Item', 'free4rest' ),
		'update_item'           => __( 'Update Item', 'free4rest' ),
		'view_item'             => __( 'View Item', 'free4rest' ),
		'view_items'            => __( 'View Items', 'free4rest' ),
		'search_items'          => __( 'Search Item', 'free4rest' ),
		'not_found'             => __( 'Not found', 'free4rest' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'free4rest' ),
		'featured_image'        => __( 'Featured Image', 'free4rest' ),
		'set_featured_image'    => __( 'Set featured image', 'free4rest' ),
		'remove_featured_image' => __( 'Remove featured image', 'free4rest' ),
		'use_featured_image'    => __( 'Use as featured image', 'free4rest' ),
		'insert_into_item'      => __( 'Insert into item', 'free4rest' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'free4rest' ),
		'items_list'            => __( 'Items list', 'free4rest' ),
		'items_list_navigation' => __( 'Items list navigation', 'free4rest' ),
		'filter_items_list'     => __( 'Filter items list', 'free4rest' ),
	);
	$args = array(
		'label'                 => __( 'Place', 'free4rest' ),
		'description'           => __( 'Place', 'free4rest' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes', 'excerpt', 'comments' ),
		'taxonomies'            => array( 'cat_place' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'menu_icon'   			=> 'dashicons-pressthis',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'place', $args );

}
add_action( 'init', 'bgt_cpt_place', 0 );

}