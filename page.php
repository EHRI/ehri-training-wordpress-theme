<?php
/**
 * The template for displaying all pages.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<main id="content">

    <?php if (have_posts()) : ?>
        <section class="page-content" role="main">
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('loop-templates/content', 'page'); ?>
            <?php endwhile; ?>
        </section>
    <?php endif; ?>

    <?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>
