<?php
/**
 * Understrap Theme Customizer
 *
 * @package ehrieric
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'ehrieric_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function ehrieric_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'ehrieric_customize_register' );

if ( ! function_exists( 'ehrieric_theme_customize_register' ) ) {
	function ehrieric_theme_customize_register( $wp_customize ) {
        $wp_customize->add_section(
            'ehrieric_theme_header_options',
            array(
                'title' => __( 'Theme Header Settings' ),
                'capability' => 'edit_theme_options',
                'description' => __( 'EHRI theme header settings' ),
                'priority' => 170,
            )
        );

        $wp_customize->add_setting(
            'ehrieric_plausible_domain',
            array(
                'default' => '',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'ehrieric_plausible_domain',
                array(
                    'label' => __( 'Plausible Analytics domain', 'ehri' ),
                    'description' => __( 'Set the domain for adding a Plausible Analytics tracking script', 'ehri' ),
                    'section' => 'ehrieric_theme_header_options',
                    'settings' => 'ehrieric_plausible_domain',
                    'type' => 'input',
                    'priority' => '10',
                )

            )
        );

        $wp_customize->add_section(
			'ehrieric_theme_social_options',
			array(
				'title' => __( 'Theme Social Media Settings' ),
				'capability' => 'edit_theme_options',
				'description' => __( 'EHRI theme social settings' ),
				'priority' => 170,
			)
		);

        $wp_customize->add_setting(
            'ehrieric_twitter_url',
            array(
                'default' => '',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'ehrieric_twitter_url',
                array(
                    'label' => __( 'Twitter URL', 'ehrieric' ),
                    'description' => __( 'Set the Twitter/X follow URL', 'ehrieric' ),
                    'section' => 'ehrieric_theme_social_options',
                    'settings' => 'ehrieric_twitter_url',
                    'type' => 'input',
                    'priority' => '10',
                )

            )
        );

        $wp_customize->add_setting(
			'ehrieric_linkedin_url',
			array(
				'default' => '',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
			)
		);

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'ehrieric_linkedin_url',
                array(
                    'label' => __( 'Linkedin URL', 'ehrieric' ),
                    'description' => __( 'Set the LinkedIn follow URL', 'ehrieric' ),
                    'section' => 'ehrieric_theme_social_options',
                    'settings' => 'ehrieric_linkedin_url',
                    'type' => 'input',
                    'priority' => '10',
                )

            )
        );

        $wp_customize->add_setting(
            'ehrieric_facebook_url',
            array(
                'default' => '',
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
            )
        );

        $wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'ehrieric_facebook_url',
				array(
					'label' => __( 'Facebook URL', 'ehrieric' ),
					'description' => __( 'Set the Facebook follow URL', 'ehrieric' ),
					'section' => 'ehrieric_theme_social_options',
					'settings' => 'ehrieric_facebook_url',
					'type' => 'input',
					'priority' => '10',
				)

			)
		);

		$wp_customize->add_section(
			'ehrieric_theme_footer_options',
			array(
				'title' => __( 'Theme Footer Settings' ),
				'capability' => 'edit_theme_options',
				'description' => __( 'EHRI theme footer settings' ),
				'priority' => 171,
			)
		);

		$wp_customize->add_setting(
			'ehrieric_mailinglist_url',
			array(
				'default' => '',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'ehrieric_mailinglist_url',
				array(
					'label' => __( 'Mailing List URL', 'ehri' ),
					'description' => __( 'Set the URL for signing up to the mailing list', 'ehri' ),
					'section' => 'ehrieric_theme_footer_options',
					'settings' => 'ehri_mailinglist_url',
					'type' => 'input',
					'priority' => '10',
				)

			)
		);
	}
}

add_action( 'customize_register', 'ehrieric_theme_customize_register' );
