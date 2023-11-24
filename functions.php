<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$ehriproject_includes = [
    'pagination',
    'widgets',
    'queries',
    'drupal',
    'theme-settings',
    'customizer',
];


foreach ($ehriproject_includes as $file) {
    if (!$filepath = locate_template("inc/$file.php")) {
        trigger_error("Error locating /inc/$file.php", E_USER_ERROR);
    }

    require_once $filepath;
}


//if (!function_exists('ehriproject_teaser_image_data')) {
//    function ehriproject_teaser_image_data()
//    {
//        return array(
//            'teaser_desktop_1x' => array(
//                'name' => __('Teaser Desktop 1x'),
//                'width' => 400,
//                'height' => 270,
//                'media' => '(min-width: 992px)',
//            ),
//            'teaser_desktop_2x' => array(
//                'name' => __('Teaser Desktop 2x'),
//                'width' => 800,
//                'height' => 540,
//                'media' => '(min-width: 992px)',
//            ),
//            'teaser_tablet_1x' => array(
//                'name' => __('Teaser Tablet 1x'),
//                'width' => 280,
//                'height' => 184,
//                'media' => '(min-width: 768px)',
//            ),
//            'teaser_tablet_2x' => array(
//                'name' => __('Teaser Tablet 2x'),
//                'width' => 560,
//                'height' => 370,
//                'media' => '(min-width: 768px)',
//            ),
//            'teaser_mobile_1x' => array(
//                'name' => __('Teaser Mobile 1x'),
//                'width' => 320,
//                'height' => 180,
//                'media' => '(min-width: 0px)',
//            ),
//            'teaser_mobile_2x' => array(
//                'name' => __('Teaser Mobile 2x'),
//                'width' => 640,
//                'height' => 360,
//                'media' => '(min-width: 0px)',
//            ),
//        );
//    }
//}

function ehrieric_random_gallery_image_url() {
	$args = array(
		'post_type' => 'gallery_item',
		'orderby' => 'rand',
		'posts_per_page' => 1
	);
	$gallery_items = new WP_Query($args);
	if ($gallery_items->have_posts()) {
		while ($gallery_items->have_posts()) {
			$gallery_items->the_post();
			return get_the_post_thumbnail_url(null, 'full');
		}
	}
	return '';
}

// Temporarily required to import media from the same host
add_filter('http_request_host_is_external', '__return_true');

if (!function_exists('ehri_theme_setup')) {
    function ehri_theme_setup()
    {
        add_theme_support('post-thumbnails', array('post', 'page'));

//        foreach (ehriproject_teaser_image_data() as $key => $value) {
//            add_image_size($key, $value['width'], $value['height'], true);
//        }
//
//        add_filter('image_size_names_choose', 'ehri_teaser_sizes');
//
//        function ehri_teaser_sizes($sizes)
//        {
//            $ehri_teaser_image_size_names = array();
//            foreach (ehriproject_teaser_image_data() as $key => $value) {
//                $ehri_teaser_image_size_names[$key] = $value['name'];
//            }
//            return array_merge($sizes, $ehri_teaser_image_size_names);
//        }
    }
}

add_action('after_setup_theme', 'ehri_theme_setup');


if (!function_exists('ehriproject_setup_theme_default_settings')) {
    function ehriproject_setup_theme_default_settings()
    {

        // check if settings are set, if not set defaults.
        // Caution: DO NOT check existence using === always check with == .
        // Latest blog posts style.
        $ehriproject_teaser_images = get_theme_mod('ehriproject_teaser_images');
        if ('' == $ehriproject_teaser_images) {
            set_theme_mod('ehriproject_teaser_images', 'default');
        }
    }
}


// Register new custom post type for 'gallery_item':
if (!function_exists('ehriproject_register_gallery_item_post_type')) {
    function ehriproject_register_gallery_item_post_type()
    {
        $labels = array(
            'name' => __('Gallery Items'),
            'singular_name' => __('Gallery Item'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Gallery Item'),
            'edit_item' => __('Edit Gallery Item'),
            'new_item' => __('New Gallery Item'),
            'all_items' => __('All Gallery Items'),
            'view_item' => __('View Gallery Item'),
            'search_items' => __('Search Gallery Items'),
            'not_found' => __('No gallery items found'),
            'not_found_in_trash' => __('No gallery items found in Trash'),
            'parent_item_colon' => '',
            'menu_name' => 'Gallery Items'
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'gallery_item'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'author', 'thumbnail'),
        );

        register_post_type('gallery_item', $args);
    }
}

if (!function_exists('ehriproject_register_video_post_type')) {
// Register a new custom post type for 'video'
    function ehriproject_register_video_post_type()
    {
        $labels = array(
            'name' => __('Videos'),
            'singular_name' => __('Video'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Video'),
            'edit_item' => __('Edit Video'),
            'new_item' => __('New Video'),
            'all_items' => __('All Videos'),
            'view_item' => __('View Video'),
            'search_items' => __('Search Videos'),
            'not_found' => __('No videos found'),
            'not_found_in_trash' => __('No videos found in Trash'),
            'parent_item_colon' => '',
            'menu_name' => 'Videos'
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'video'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'author', 'thumbnail'),
        );

        register_post_type('video', $args);
    }
}

if (!function_exists('ehriproject_register_newsletter_edition_taxonomy')) {
    function ehriproject_register_newsletter_edition_taxonomy()
    {
        $labels = array(
            'name' => _x('Newsletter Editions', 'taxonomy general name'),
            'singular_name' => _x('Newsletter Edition', 'taxonomy singular name'),
            'search_items' => __('Search Newsletter Editions'),
            'all_items' => __('All Newsletter Editions'),
            'parent_item' => __('Parent Newsletter Edition'),
            'parent_item_colon' => __('Parent Newsletter Edition:'),
            'edit_item' => __('Edit Newsletter Edition'),
            'update_item' => __('Update Newsletter Edition'),
            'add_new_item' => __('Add New Newsletter Edition'),
            'new_item_name' => __('New Newsletter Edition Name'),
            'menu_name' => __('Newsletter Editions'),
        );

        $args = array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'closed' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'show_in_rest' => true,
            'rewrite' => array('slug' => 'newsletter-edition'),
            'default' => array(
                'name' => __('None'),
                'slug' => __('none'),
            )
        );

        register_taxonomy('newsletter_edition', array('post', 'page'), $args);
    }
}

if (!function_exists('ehriproject_register_newsletter_category_taxonomy')) {
    function ehriproject_register_newsletter_category_taxonomy()
    {
        $labels = array(
            'name' => _x('Newsletter Categories', 'taxonomy general name'),
            'singular_name' => _x('Newsletter Category', 'taxonomy singular name'),
            'search_items' => __('Search Newsletter Categories'),
            'all_items' => __('All Newsletter Categories'),
            'parent_item' => __('Parent Newsletter Category'),
            'parent_item_colon' => __('Parent Newsletter Category:'),
            'edit_item' => __('Edit Newsletter Category'),
            'update_item' => __('Update Newsletter Category'),
            'add_new_item' => __('Add New Newsletter Category'),
            'new_item_name' => __('New Newsletter Category Name'),
            'menu_name' => __('Newsletter Categories'),
        );

        $args = array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'closed' => true,
            'query_var' => true,
            'show_in_rest' => true,
            'rewrite' => array('slug' => 'newsletter-category'),
            'show_in_menu' => true,
        );

        register_taxonomy('newsletter_category', array('post', 'page'), $args);
    }
}

if (!function_exists('ehriproject_register_fellowship_year_taxonomy')) {
    function ehriproject_register_fellowship_year_taxonomy()
    {
        $labels = array(
            'name' => _x('Fellowship Years', 'taxonomy general name'),
            'singular_name' => _x('Fellowship Year', 'taxonomy singular name'),
            'search_items' => __('Search Fellowship Years'),
            'all_items' => __('All Fellowship Years'),
            'parent_item' => __('Parent Fellowship Year'),
            'parent_item_colon' => __('Parent Fellowship Year:'),
            'edit_item' => __('Edit Fellowship Year'),
            'update_item' => __('Update Fellowship Year'),
            'add_new_item' => __('Add New Fellowship Year'),
            'new_item_name' => __('New Fellowship Year Name'),
            'menu_name' => __('Fellowship Years'),
        );

        $args = array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'closed' => true,
            'query_var' => 'fellowship-year',
            'show_in_rest' => true,
            'rewrite' => array('slug' => 'fellowship-year'),
            'show_in_menu' => true,
        );

        register_taxonomy('fellowship_year', array('post', 'page'), $args);
    }
}

if (!function_exists('ehriproject_register_fellowship_institution_taxonomy')) {
    function ehriproject_register_fellowship_institution_taxonomy()
    {
        $labels = array(
            'name' => _x('Fellowship Institutions', 'taxonomy general name'),
            'singular_name' => _x('Fellowship Institution', 'taxonomy singular name'),
            'search_items' => __('Search Fellowship Institutions'),
            'all_items' => __('All Fellowship Institutions'),
            'parent_item' => __('Parent Fellowship Institution'),
            'parent_item_colon' => __('Parent Fellowship Institution:'),
            'edit_item' => __('Edit Fellowship Institution'),
            'update_item' => __('Update Fellowship Institution'),
            'add_new_item' => __('Add New Fellowship Institution'),
            'new_item_name' => __('New Fellowship Institution Name'),
            'menu_name' => __('Fellowship Institutions'),
        );

        $args = array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'closed' => true,
            'query_var' => 'fellowship-institution',
            'show_in_rest' => true,
            'rewrite' => array('slug' => 'fellowship-institution'),
            'show_in_menu' => true,
        );

        register_taxonomy('fellowship_institution', array('post', 'page'), $args);
    }
}

add_action('init', 'ehriproject_register_gallery_item_post_type');
add_action('init', 'ehriproject_register_video_post_type');
add_action('init', 'ehriproject_register_newsletter_edition_taxonomy');
add_action('init', 'ehriproject_register_newsletter_category_taxonomy');
add_action('init', 'ehriproject_register_fellowship_year_taxonomy');
add_action('init', 'ehriproject_register_fellowship_institution_taxonomy');

/**
 * Transients!
 */

// Manage transients for homepage posts and gallery items
if (!function_exists('ehriproject_delete_homepage_transients')) {
    function ehriproject_delete_homepage_transients($post_id)
    {
        delete_transient('ehri_homepage_posts');
        delete_transient('ehri_latest_news');
    }
}

if (!function_exists('ehriproject_delete_gallery_transients')) {
    function ehriproject_delete_gallery_transients($post_id)
    {
        if (get_post_type($post_id) == 'gallery_item') {
            delete_transient('ehri_gallery_items');
        }
    }
}

add_action('save_post_post', 'ehriproject_delete_homepage_transients');
add_action('delete_post', 'ehriproject_delete_homepage_transients');
add_action('save_post_gallery_item', 'ehriproject_delete_gallery_transients');
add_action('delete_post', 'ehriproject_delete_gallery_transients');

