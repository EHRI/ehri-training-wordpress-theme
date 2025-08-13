<?php
/**
 * The main template file.
 *
 * @package ehri-training
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>


<main id="content">
	<section class="page-content" role="main">
		<a id="main-content"></a>
		<div class="ds-1col node node-homepage view-mode-full clearfix">
			<div class="field field-name-body"></div>
		</div>
		<div id="block-views-homepage-teasers-block-1" class="block block-views last even">
			<div class="view view-homepage-teasers">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<?php get_template_part( 'loop-templates/content', get_post_format() ); ?>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
