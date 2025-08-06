<?php get_header(); ?>
    <div id="main">
        <div id="main-inner">

            <div id="content" class="column" role="main">
                <div id="content-inner">
                    <a id="main-content"></a>

                    <!-- This sets the $curauth variable -->
                    <?php
                    $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
                    ?>

                    <h2>Posts by <?php echo $curauth->nickname; ?>:</h2>

                    <ul>
                        <!-- The Loop -->

                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <li>
                                <a href="<?php the_permalink() ?>" rel="bookmark"
                                   title="Permanent Link: <?php the_title(); ?>">
                                    <?php the_title(); ?></a>,
                                <?php the_time('d M Y'); ?> in <?php the_category('&'); ?>
                            </li>

                        <?php endwhile; else: ?>
                            <p><?php _e('No posts by this author.'); ?></p>

                        <?php endif; ?>

                        <!-- End Loop -->

                    </ul>

                    <!-- The pagination component -->
                    <?php ehri_training_pagination(); ?>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
<?php get_footer(); ?>
