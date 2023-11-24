<?php
/**
 * The template for displaying all single posts.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<main id="content">

    <?php if (have_posts()) : ?>
        <section class="page-content news" role="main">
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('loop-templates/content', 'single'); ?>
            <?php endwhile; ?>
        </section>
    <?php endif; ?>

    <?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>
