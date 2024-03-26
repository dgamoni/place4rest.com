<?php
if ( ! function_exists( 'bgt_cat_parking_tax' ) ) {

// Register Custom Taxonomy
function bgt_cat_parking_tax() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Categories', 'free4rest' ),
		'singular_name'              => _x( 'Categories', 'Categories', 'free4rest' ),
		'menu_name'                  => __( 'Categories', 'free4rest' ),
		'all_items'                  => __( 'All Items', 'free4rest' ),
		'parent_item'                => __( 'Parent Item', 'free4rest' ),
		'parent_item_colon'          => __( 'Parent Item:', 'free4rest' ),
		'new_item_name'              => __( 'New Item Name', 'free4rest' ),
		'add_new_item'               => __( 'Add New Item', 'free4rest' ),
		'edit_item'                  => __( 'Edit Item', 'free4rest' ),
		'update_item'                => __( 'Update Item', 'free4rest' ),
		'view_item'                  => __( 'View Item', 'free4rest' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'free4rest' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'free4rest' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'free4rest' ),
		'popular_items'              => __( 'Popular Items', 'free4rest' ),
		'search_items'               => __( 'Search Items', 'free4rest' ),
		'not_found'                  => __( 'Not Found', 'free4rest' ),
		'no_terms'                   => __( 'No items', 'free4rest' ),
		'items_list'                 => __( 'Items list', 'free4rest' ),
		'items_list_navigation'      => __( 'Items list navigation', 'free4rest' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'cat_parking', array( 'parking' ), $args );

}
add_action( 'init', 'bgt_cat_parking_tax', 0 );

}