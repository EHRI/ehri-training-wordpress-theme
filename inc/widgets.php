<?php
/**
 * EHRI custom widgets
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (! function_exists("ehriproject_teaser_element")) {
    function ehriproject_teaser_element($alt_text = "", $classes = "") {
        // Return a <picture> element containing the teaser image sizes. These are hard-coded now to
        // reflect the legacy site but this should be updated when the theme is refreshed.
        $html = '<picture' . ($classes ? ' class="' . $classes . '"' : '') . '>';
        $html .= '<source srcset="' .
            get_the_post_thumbnail_url(null, 'teaser_desktop_1x') . ' 1x, ' .
            get_the_post_thumbnail_url(null, 'teaser_desktop_2x') . ' 2x" media="(min-width: 1200px)">';
        $html .= '<source srcset="' .
            get_the_post_thumbnail_url(null, 'teaser_tablet_1x') . ' 1x, ' .
            get_the_post_thumbnail_url(null, 'teaser_tablet_2x') . ' 2x" media="(min-width: 960px)">';
        $html .= '<source srcset="' .
            get_the_post_thumbnail_url(null, 'teaser_mobile_1x') . ' 1x, ' .
            get_the_post_thumbnail_url(null, 'teaser_mobile_2x') . ' 2x" media="(min-width: 0px)">';
        $html .= '<img src="' . get_the_post_thumbnail_url(null, 'teaser_mobile_1x') . '" alt="' . $alt_text . '">';
        $html .= '</picture>';
        return $html;
    }
}

if (! function_exists("ehriproject_header_element")) {
    function ehriproject_header_element($alt_text = "", $classes = "") {
        // Return a <picture> element containing the header image sizes. These are hard-coded now to
        // reflect the legacy site but this should be updated when the theme is refreshed.
        $html = '<picture' . ($classes ? ' class="' . $classes . '"' : '') . '>';
        $html .= '<source srcset="' .
            get_the_post_thumbnail_url(null, 'large') . ' 1x, ' .
            get_the_post_thumbnail_url(null, 'full') . ' 2x" media="(min-width: 1200px)">';
        $html .= '<source srcset="' .
            get_the_post_thumbnail_url(null, 'medium') . ' 1x, ' .
            get_the_post_thumbnail_url(null, 'large') . ' 2x" media="(min-width: 960px)">';
        $html .= '<source srcset="' .
            get_the_post_thumbnail_url(null, 'medium') . ' 1x, ' .
            get_the_post_thumbnail_url(null, 'large') . ' 2x" media="(min-width: 0px)">';
        $html .= '<img src="' . get_the_post_thumbnail_url(null, 'full') . '" alt="' . $alt_text . '">';
        $html .= '</picture>';
        return $html;
    }
}

// Add meta box to posts and pages
if (!function_exists("ehriproject_add_promote_to_home_meta_box")) {
    function ehriproject_add_promote_to_home_meta_box()
    {
        $screens = ['post', 'page'];
        foreach ($screens as $screen) {
            add_meta_box(
                'promote_to_home',           // Unique ID
                'Homepage Promotion',        // Box title
                'ehriproject_promote_to_home_html',      // Content callback, must be of type callable
                $screen,                      // Post type
                'side'                  // Position
            );
        }
    }
}
add_action('add_meta_boxes', 'ehriproject_add_promote_to_home_meta_box');

// Meta box HTML
if (!function_exists("ehriproject_promote_to_home_html")) {
    function ehriproject_promote_to_home_html($post)
    {
        $value = get_post_meta($post->ID, '_promote_to_home', true);
        ?>
        <label for="promote_to_home">
            <input type="checkbox" id="promote_to_home" name="promote_to_home" <?php checked($value, 'yes'); ?> />
            Promote this content to homepage
        </label>
        <?php
    }
}

// Save meta box data
if (!function_exists("ehriproject_save_promote_to_home_meta")) {
    function ehriproject_save_promote_to_home_meta($post_id)
    {
        if (array_key_exists('promote_to_home', $_POST)) {
            update_post_meta(
                $post_id,
                '_promote_to_home',
                'yes'
            );
        } else {
            delete_post_meta($post_id, '_promote_to_home');
        }
    }
}
add_action('save_post', 'ehriproject_save_promote_to_home_meta');

// Add meta box to posts and pages
if (!function_exists("ehriproject_add_homepage_order_meta_box")) {
    function ehriproject_add_homepage_order_meta_box()
    {
        $screens = ['post', 'page'];
        foreach ($screens as $screen) {
            add_meta_box(
                'homepage_order',           // Unique ID
                'Homepage Order',        // Box title
                'ehriproject_homepage_order_html',      // Content callback, must be of type callable
                $screen,                      // Post type,
                'side'                  // Position
            );
        }
    }
}
add_action('add_meta_boxes', 'ehriproject_add_homepage_order_meta_box');

// Meta box HTML
if (!function_exists("ehriproject_homepage_order_html")) {
    function ehriproject_homepage_order_html($post)
    {
        $value = get_post_meta($post->ID, '_homepage_order', true);
        ?>
        <label for="homepage_order">
            <input type="number" id="homepage_order" name="homepage_order" min="1" max="999"
                   value="<?php echo $value; ?>"/>
            Set order on homepage
        </label>
        <?php
    }
}

// Save meta box data
if (!function_exists("ehriproject_save_homepage_order_meta")) {
    function ehriproject_save_homepage_order_meta($post_id)
    {
        if (array_key_exists('homepage_order', $_POST) && $_POST['homepage_order'] !== '') {
            update_post_meta(
                $post_id,
                '_homepage_order',
                $_POST['homepage_order']
            );
        } else {
            delete_post_meta($post_id, '_homepage_order');
        }
    }
}
add_action('save_post', 'ehriproject_save_homepage_order_meta');

