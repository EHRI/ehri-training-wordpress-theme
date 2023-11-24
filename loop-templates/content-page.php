<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// For now the page content is the same as the single post content
get_template_part('loop-templates/content', 'single');


