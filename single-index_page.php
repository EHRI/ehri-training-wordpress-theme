<?php
/**
 * The template for displaying all single posts.
 *
 * @package ehri_training
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<main id="content">

	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<div class="page-content index-page" role="main">
				<?php get_template_part( 'loop-templates/content', 'index_page' ); ?>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</main>

<?php get_footer(); ?>
