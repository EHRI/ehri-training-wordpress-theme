<?php
/**
 * Understrap Theme Customizer
 *
 * @package ehri_training
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'ehri_training_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function ehri_training_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'ehri_training_customize_register' );

if ( ! function_exists( 'ehri_training_theme_customize_register' ) ) {
	/**
	 * Register theme customizer settings.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function ehri_training_theme_customize_register( $wp_customize ) {
		$wp_customize->add_section(
			'ehri_training_theme_header_options',
			array(
				'title'       => __( 'Theme Header Settings' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'EHRI theme header settings' ),
				'priority'    => 170,
			)
		);

		$wp_customize->add_section(
			'ehri_training_theme_footer_options',
			array(
				'title'       => __( 'Theme Footer Settings' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'EHRI theme footer settings' ),
				'priority'    => 171,
			)
		);
	}
}

add_action( 'customize_register', 'ehri_training_theme_customize_register' );
