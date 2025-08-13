<?php
/**
 * The template for displaying all pages.
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
		<div class="page-content" role="main">
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php get_template_part( 'loop-templates/content', 'page' ); ?>
			<?php endwhile; ?>
		</div>
	<?php endif; ?>
</main>

<?php get_footer(); ?>
