<?php
/**
 * The sidebar containing the main widget area.
 */
?>

<aside class="sidebars">
    <section class="social">
        <header>Follow Us</header>
        <?php get_template_part('partials/social'); ?>
    </section>

    <section class="resources">
        <header>Resources</header>
        <!-- Render the sidebar menu resources menu -->
        <?php wp_nav_menu(array(
            'menu' => 'resources-menu',
            'theme_location' => 'primary',
            'fallback_cb' => false
        )); ?>
    </section>


    <!-- Fetch a random gallery_item and use it as the header image -->
    <?php
    if (false === ($latest_news_query = get_transient('ehri_latest_news'))) {
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'category_name' => 'News',
            'tax_query' => array(
                array(
                    'taxonomy' => 'newsletter_category',
                    'field' => 'slug',
                    'terms' => array('Online'),
                    'operator' => 'OR'
                )
            ),
        );
        $latest_news_query = new WP_Query($args);
        set_transient('ehri_latest_news', $latest_news_query, 24 * HOUR_IN_SECONDS);
    }
    ?>

    <?php if ($latest_news_query->have_posts()) : ?>
        <section class="latest-news">
            <header>Latest News</header>
            <?php $num = 1; ?>
            <?php while ($latest_news_query->have_posts()) : $latest_news_query->the_post(); ?>
                <div class="latest-news-item-<?php echo $num; ?>">
                    <header>
                        <a href="<?php echo esc_url(get_permalink()); ?>"
                           title="<?php echo get_the_title(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </header>
                </div>
                <?php $num++; ?>
            <?php endwhile; ?>
            <div class="more-link">
                <a href="/latestnews">More news... </a>
            </div>
        </section>
    <?php endif; ?>

</aside>
