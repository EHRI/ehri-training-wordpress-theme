<?php

if (!function_exists("ehriproject_homepage_teaser_args")) {
    function ehriproject_homepage_teaser_args($limit = 6)
    {
        global $wpdb;

        // Write some custom SQL to fetch the posts we actually want on the front page, in order
        // to match the (buggy) Drupal homepage teasers view. The logic for this incorporates the
        // inherent randomness of comparing NULL values in MySQL, which is why we need to use a
        // custom ORDER BY clause.
        $results = $wpdb->get_results("
            SELECT DISTINCT p.ID
            FROM {$wpdb->posts} p
            LEFT JOIN {$wpdb->term_relationships} rels ON (p.ID = rels.object_id)
            LEFT JOIN {$wpdb->postmeta} pm1 ON (p.ID = pm1.post_id AND pm1.meta_key = '_promote_to_home')
            LEFT JOIN {$wpdb->postmeta} pm2 ON (p.ID = pm2.post_id AND pm2.meta_key = '_homepage_order')
            WHERE p.post_type IN ('post', 'page')
            AND p.post_status = 'publish'
            AND (pm1.meta_value = 'yes')
            ORDER BY
                CASE WHEN pm2.meta_value IS NOT NULL THEN 0 ELSE 1 END,
                pm2.meta_value ASC,
                p.post_date DESC
            LIMIT {$limit}"
        );

        // Now we've got the post IDs, we can fetch the full post objects
        $args = array(
            'post__in' => wp_list_pluck($results, 'ID'),
            'post_type' => array('post', 'page'),
            'orderby' => 'post__in',
            'posts_per_page' => $limit,
        );
        return $args;
    }
}