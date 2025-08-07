<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$ehri_training_includes = array(
    'pagination',
    'widgets',
    'drupal',
    'theme-settings',
    'customizer',
	'unit-taxonomy-type',
	'source-taxonomy-type',
	'unit-metadata',
	'source-metadata',
);


foreach ($ehri_training_includes as $file) {
    if (!$filepath = locate_template("inc/$file.php")) {
        trigger_error("Error locating /inc/$file.php", E_USER_ERROR);
    }

    require_once $filepath;
}


// Temporarily required to import media from the same host.
add_filter('http_request_host_is_external', '__return_true');

if (!function_exists( 'ehri_training_theme_setup' )) {
    function ehri_training_theme_setup()
    {
        add_theme_support('post-thumbnails', array('post', 'page'));

	    add_filter('screen_options_show_screen', '__return_true');
    }
}

add_action('after_setup_theme', 'ehri_training_theme_setup' );


