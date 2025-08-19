<?php
/**
 * Theme functions and definitions.
 *
 * @package ehri_training
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$ehri_training_includes = array(
	'pagination',
	'widgets',
	'theme-settings',
	'customizer',
	'unit-taxonomy-type',
	'source-taxonomy-type',
	'unit-metadata',
	'source-metadata',
	'index-page-post-type',
	'shortcodes',
	'admin',
);


foreach ( $ehri_training_includes as $file ) {
	$filepath = locate_template( "inc/$file.php" );
	if ( ! $filepath ) {
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
		trigger_error( "Error locating /inc/$file.php", E_USER_ERROR );
	}

	require_once $filepath;
}


// Temporarily required to import media from the same host.
add_filter( 'http_request_host_is_external', '__return_true' );

// Run shortcodes on the excerpt.
add_filter( 'the_excerpt', 'do_shortcode' );

if ( ! function_exists( 'ehri_training_theme_setup' ) ) {
	/**
	 * Set up theme defaults and register support for various WordPress features.
	 */
	function ehri_training_theme_setup() {
		add_theme_support(
			'html5',
			array(
				'caption',
				'script',
				'search-form',
				'style',
			)
		);
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

		add_filter( 'screen_options_show_screen', '__return_true' );
	}
}
add_action( 'after_setup_theme', 'ehri_training_theme_setup' );

if ( ! function_exists( 'ehri_training_document_title_parts' ) ) {
	/**
	 * Customise the format of the page title.
	 *
	 * @param array $parts title components.
	 *
	 * @return array the components to use.
	 */
	function ehri_training_document_title_parts( $parts ) {
		// Default parts array contains: title, page, tagline, site.

		// For a simple "Page Title | Site Name" format.
		$custom_parts = array();

		if ( isset( $parts['title'] ) ) {
			$custom_parts['title'] = $parts['title'];
		}

		if ( isset( $parts['site'] ) ) {
			$custom_parts['site'] = $parts['site'];
		}

		return $custom_parts;
	}
}
add_filter( 'document_title_parts', 'ehri_training_document_title_parts' );

/**
 * Enqueue scripts and styles.
 */
function ehri_training_scripts() {
	// Enqueue Typekit script.
	wp_enqueue_script( 'typekit', '//use.typekit.com/pvi1xwv.js', array(), '1.0.0', false );

	// Add inline script for Typekit loading.
	wp_add_inline_script( 'typekit', 'try{Typekit.load();}catch(e){}' );
	// Enqueue theme stylesheet.
	wp_enqueue_style( 'ehri-training-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
}

add_action( 'wp_enqueue_scripts', 'ehri_training_scripts' );

/**
 * Clear cached source metadata when term is updated.
 *
 * @param int $term_id The term ID.
 */
function ehri_training_clear_source_metadata_cache( $term_id ) {
	delete_transient( 'source_metadata_' . $term_id );
}

add_action( 'saved_source', 'ehri_training_clear_source_metadata_cache' );
add_action( 'edited_source', 'ehri_training_clear_source_metadata_cache' );
add_action( 'saved_unit', 'ehri_training_clear_source_metadata_cache' );
add_action( 'edited_unit', 'ehri_training_clear_source_metadata_cache' );

/**
 * Clear front-page units cache when units are modified.
 *
 * @param int $term_id The term ID.
 */
function ehri_training_clear_front_page_units_cache( $term_id ) {
	delete_transient( 'ehri_training_front_page_units' );
}

add_action( 'saved_unit', 'ehri_training_clear_front_page_units_cache' );
add_action( 'edited_unit', 'ehri_training_clear_front_page_units_cache' );
add_action( 'deleted_unit', 'ehri_training_clear_front_page_units_cache' );

if ( ! function_exists( 'ehri_training_render_open_graph_meta' ) ) {
	/**
	 * Generate Open Graph meta tags.
	 */
	function ehri_training_render_open_graph_meta() {
		$og_data = array(
			'locale'    => 'en-GB',
			'site_name' => get_bloginfo( 'name' ),
			'title'     => get_the_title(),
		);

		if ( is_tax( 'unit' ) ) {
			$unit                   = get_queried_object();
			$og_data['description'] = wp_filter_nohtml_kses( $unit->description );
			$og_data['image']       = wp_get_attachment_image_url( get_term_meta( $unit->term_id, 'term_feature_image', true ), 'large' );
			$og_data['url']         = get_the_permalink();
			$og_data['type']        = 'article';
			$og_data['title']       = $unit->name;
		} elseif ( is_single() ) {
			$og_data['description']            = wp_filter_nohtml_kses( get_the_excerpt() );
			$og_data['image']                  = ehri_training_post_unit_image_url( get_queried_object() );
			$og_data['url']                    = get_the_permalink();
			$og_data['type']                   = 'article';
			$og_data['article:published_time'] = get_the_date( 'c' );
			$og_data['article:modified_time']  = get_the_modified_date( 'c' );
		} else {
			$og_data['description'] = get_bloginfo( 'description' );
			$og_data['image']       = get_theme_file_uri( 'images/ehri-logo-large.png' );
			$og_data['url']         = get_home_url();
			$og_data['type']        = 'website';
			$og_data['title']       = get_the_title();
		}

		foreach ( $og_data as $property => $content ) {
			if ( ! empty( $content ) ) {
				printf(
					'<meta property="og:%s" content="%s">' . "\n\t",
					esc_attr( $property ),
					esc_attr( $content )
				);
			}
		}
	}
}



