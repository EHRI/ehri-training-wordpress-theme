<?php
/**
 * The template for latest news items.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<main id="content">
	<?php if ( have_posts() ) : ?>
        <section class="page-content" role="main">
            <a id="main-content"></a>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'loop-templates/content', 'single' ); ?>
			<?php endwhile; ?>
			<?php
			$args         = array(
				'tag'      => 'fellows-list-2013',
				'orderby'  => 'date',
				'order'    => 'ASC',
				'nopaging' => true,
			);
			$people_query = new WP_Query( $args );
			?>

			<?php if ( $people_query->have_posts() ) : ?>
				<?php while ( $people_query->have_posts() ) : $people_query->the_post(); ?>
					<?php get_template_part( 'loop-templates/content', 'fellowship' ); ?>
				<?php endwhile; ?>
			<?php endif; ?>
        </section>
	<?php endif; ?>


	<?php get_sidebar(); ?>
</main>


<?php get_footer(); ?>
