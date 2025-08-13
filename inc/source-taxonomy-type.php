<?php

if ( ! function_exists( 'ehri_training_create_source_taxonomy_type' ) ) {
	/**
	 * Register the Source post type.
	 *
	 * @return void
	 */
	function ehri_training_create_source_taxonomy_type() {
		register_taxonomy( 'source',
			'post',
			array(
				'labels'       => array(
					'name'               => 'Sources',
					'singular_name'      => 'Source',
					'add_new'            => 'Add New Source',
					'add_new_item'       => 'Add New Source',
					'edit_item'          => 'Edit Source',
					'new_item'           => 'New Source',
					'view_item'          => 'View Source',
					'search_items'       => 'Search Sources',
					'not_found'          => 'No sources found',
					'not_found_in_trash' => 'No sources found in Trash',
					'all_items'          => 'All Sources',
					'menu_name'          => 'Sources',
				),
				'public'       => true,
				'show_in_rest' => true, // Enable Gutenberg/REST API
				'show_ui'      => true,
				'show_in_menu' => true,
				'supports'     => array( 'title', 'editor', 'thumbnail' ),
				'menu_icon'    => 'dashicons-admin-links',
			)
		);
	}
}
add_action( 'init', 'ehri_training_create_source_taxonomy_type' );
