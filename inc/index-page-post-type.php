<?php
/**
 * Register the index_page type for the theme.
 *
 * @package ehri_training
 */

/**
 * Register Index Page Custom Post Type
 */
if ( ! function_exists( 'ehri_training_register_index_page_post_type' ) ) {
	/**
	 * Registers the Index Page custom post type.
	 *
	 * @return void
	 */
	function ehri_training_register_index_page_post_type() {
		$labels = array(
			'name'                  => _x( 'Index Pages', 'Post type general name', 'ehri_training' ),
			'singular_name'         => _x( 'Index Page', 'Post type singular name', 'ehri_training' ),
			'menu_name'             => _x( 'Index Pages', 'Admin Menu text', 'ehri_training' ),
			'name_admin_bar'        => _x( 'Index Page', 'Add New on Toolbar', 'ehri_training' ),
			'add_new'               => __( 'Add New', 'ehri_training' ),
			'add_new_item'          => __( 'Add New Index Page', 'ehri_training' ),
			'new_item'              => __( 'New Index Page', 'ehri_training' ),
			'edit_item'             => __( 'Edit Index Page', 'ehri_training' ),
			'view_item'             => __( 'View Index Page', 'ehri_training' ),
			'all_items'             => __( 'All Index Pages', 'ehri_training' ),
			'search_items'          => __( 'Search Index Pages', 'ehri_training' ),
			'parent_item_colon'     => __( 'Parent Index Pages:', 'ehri_training' ),
			'not_found'             => __( 'No Index Pages found.', 'ehri_training' ),
			'not_found_in_trash'    => __( 'No Index Pages found in Trash.', 'ehri_training' ),
			'featured_image'        => _x( 'Index Page Featured Image', 'Overrides the "Featured Image" phrase', 'ehri_training' ),
			'set_featured_image'    => _x( 'Set featured image', 'Overrides the "Set featured image" phrase', 'ehri_training' ),
			'remove_featured_image' => _x( 'Remove featured image', 'Overrides the "Remove featured image" phrase', 'ehri_training' ),
			'use_featured_image'    => _x( 'Use as featured image', 'Overrides the "Use as featured image" phrase', 'ehri_training' ),
			'archives'              => _x( 'Index Page archives', 'The post type archive label', 'ehri_training' ),
			'insert_into_item'      => _x( 'Insert into Index Page', 'Overrides the "Insert into post" phrase', 'ehri_training' ),
			'uploaded_to_this_item' => _x( 'Uploaded to this Index Page', 'Overrides the "Uploaded to this post" phrase', 'ehri_training' ),
			'filter_items_list'     => _x( 'Filter Index Pages list', 'Screen reader text for the filter links', 'ehri_training' ),
			'items_list_navigation' => _x( 'Index Pages list navigation', 'Screen reader text for the pagination', 'ehri_training' ),
			'items_list'            => _x( 'Index Pages list', 'Screen reader text for the items list', 'ehri_training' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'index-page' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => 'dashicons-list-view', // You can change this to any dashicon.
			'show_in_rest'       => true, // Enables Gutenberg editor.
			'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
		);

		register_post_type( 'index_page', $args );
	}
}

// Hook into the 'init' action.
add_action( 'init', 'ehri_training_register_index_page_post_type' );

/**
 * Flush rewrite rules on theme activation (optional)
 * Add this if you want to automatically flush permalinks when the theme is activated
 */
if ( ! function_exists( 'ehri_training_index_page_rewrite_flush' ) ) {
	/**
	 * Flush rewrite rules for index page post type.
	 */
	function ehri_training_index_page_rewrite_flush() {
		ehri_training_register_index_page_post_type();
		flush_rewrite_rules();
	}
}

add_action( 'after_switch_theme', 'ehri_training_index_page_rewrite_flush' );

