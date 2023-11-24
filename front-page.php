<?php
/**
 * The main template file.
 */

?>

<?php get_header(); ?>

<section class="hero">
    <div class="hero-content">
        <h1>Towards a permanent European Holocaust Research Infrastructure</h1>
        <p>Since 2010 EHRI has worked to build a sustainable infrastructure to support scholarship into the Holocaust.
            From 2025, it will become a permanent organisation in the form of a European Research Infrastructure Consortium (ERIC).
        </p>
        <p><a href="/towards-a-permanent-holocaust-research-infrastructure">Read more...</a></p>
    </div>
</section>

<main id="content">

    <section class="home services">

	    <?php
	    $args = ehriproject_homepage_teaser_args(6);
	    $the_query = new WP_Query($args);

	    ?>

        <div class="resource-cards">
            <?php if ($the_query->have_posts()) : ?>
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <?php get_template_part('loop-templates/content-front', get_post_format()); ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </section>

    <?php get_sidebar(); ?>
</main>


<?php get_footer(); ?>