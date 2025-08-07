<?php
/**
 * Add a custom taxonomy for units.
 */

if ( ! function_exists( 'ehri_training_create_unit_taxonomy' ) ) {
	/**
	 * Create a custom taxonomy for units.
	 */
	function ehri_training_create_unit_taxonomy() {
		$labels = array(
			'name'              => _x( 'Units', 'taxonomy general name' ),
			'singular_name'     => _x( 'Unit', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Units' ),
			'all_items'         => __( 'All Units' ),
			'parent_item'       => __( 'Parent Unit' ),
			'parent_item_colon' => __( 'Parent Unit:' ),
			'edit_item'         => __( 'Edit Unit' ),
			'update_item'       => __( 'Update Unit' ),
			'add_new_item'      => __( 'Add New Unit' ),
			'new_item_name'     => __( 'New Unit Name' ),
			'menu_name'         => __( 'Units' ),
		);

		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'unit' ),
			'show_in_rest'      => true,         // Enable for Gutenberg/REST API.
		);

		register_taxonomy( 'unit', array( 'post' ), $args );
	}
}
add_action( 'init', 'ehri_training_create_unit_taxonomy' );
