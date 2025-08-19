<?php
/**
 * Generic index page for authors and archives.
 *
 * @package ehri_training
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>


<main id="content">
	<div class="page-content" role="main">
		<a id="main-content"></a>
		<div class="post-list">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<?php get_template_part( 'loop-templates/content', get_post_format() ); ?>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
