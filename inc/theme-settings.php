<?php
/**
 * Check and setup theme's default settings
 *
 * @package ehrieric
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'ehrieric_setup_theme_default_settings' ) ) {
	function ehrieric_setup_theme_default_settings() {

		// check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .

        // Twitter URL
        $ehrieric_twitter_url = get_theme_mod( 'ehrieric_twitter_url' );
        if ( $ehrieric_twitter_url == '' ) {
            set_theme_mod( 'ehrieric_twitter_url', '' );
        }

        // Twitter URL
        $ehrieric_linkedin_url = get_theme_mod( 'ehrieric_linkedin_url' );
        if ( $ehrieric_linkedin_url == '' ) {
            set_theme_mod( 'ehrieric_linkedin_url', '' );
        }

		// Twitter URL
		$ehrieric_facebook_url = get_theme_mod( 'ehrieric_facebook_url' );
		if ( $ehrieric_facebook_url == '' ) {
			set_theme_mod( 'ehrieric_facebook_url', '' );
		}
	}
}
