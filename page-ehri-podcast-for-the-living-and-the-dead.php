<?php
/**
 * The template for latest news items.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
?>


<div id="main">
    <div id="main-inner">
        <?php if (have_posts()) : ?>
            <div id="content" class="column" role="main">
                <div id="content-inner">
                    <a id="main-content"></a>
                    <?php while (have_posts()) : the_post(); ?>
                        <h1 class="page__title title" id="page-title"><?php the_title(); ?></h1>

                        <div class="field field-name-body">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endwhile; ?>

                    <hr>
                    <!-- Fetch all posts with the 'news' category and list them in reverse chronological order with pagination -->
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(
//                        'paged' => $paged,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'publish' => true,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'slug',
                                'terms' => 'podcast-episode',
                            )
                        ),
                        'nopaging' => true,
                    );
                    $news_query = new WP_Query($args);
                    ?>

                    <?php if ($news_query->have_posts()) : ?>
                        <div class="podcast-episode-list">
                            <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
                                <div class="podcast-episode" id="podcast-episode-<?php the_ID(); ?>">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                                    </a>

                                    <h3>
                                        <a href="<?php the_permalink(); ?>"><?php echo preg_replace('/Podcast Episode\s*\|?\s*/', '', get_the_title());; ?></a>
                                        <?php echo wp_strip_all_tags(get_the_excerpt()); ?>
                                    </h3>
                                </div>
                            <?php endwhile; ?>

                        </div>

                        <!-- The pagination component -->
                        <?php // ehri_pagination(); ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>
