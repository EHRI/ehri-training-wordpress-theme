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
			'search_items'      => __( 'Search Units', 'ehri_training' ),
			'all_items'         => __( 'All Units', 'ehri_training' ),
			'parent_item'       => __( 'Parent Unit', 'ehri_training' ),
			'parent_item_colon' => __( 'Parent Unit:', 'ehri_training' ),
			'edit_item'         => __( 'Edit Unit', 'ehri_training' ),
			'update_item'       => __( 'Update Unit', 'ehri_training' ),
			'add_new_item'      => __( 'Add New Unit', 'ehri_training' ),
			'new_item_name'     => __( 'New Unit Name', 'ehri_training' ),
			'menu_name'         => __( 'Units', 'ehri_training' ),
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

		register_taxonomy( 'unit', array( 'post', 'index_page' ), $args );
	}
}
add_action( 'init', 'ehri_training_create_unit_taxonomy' );

if ( ! function_exists( 'unit_taxonomy_query_params' ) ) {
	/**
	 * Modify the main query to sort units by a custom meta key.
	 *
	 * @param WP_Query $query The WP_Query instance (passed by reference).
	 */
	function unit_taxonomy_query_params( $query ) {
		if ( ! is_admin() && $query->is_main_query() ) {
			// Replace 'your_taxonomy' with your actual taxonomy name
			if ( is_tax( 'unit' ) || is_category() || is_tag() ) {
				$query->set( 'meta_key', '_sort_order' );
				$query->set( 'orderby', 'meta_value_num' );
				$query->set( 'order', 'ASC' );
				$query->set( 'posts_per_page', - 1 ); // Show all posts in the taxonomy.
			}
		}
	}
}
add_action( 'pre_get_posts', 'unit_taxonomy_query_params' );
