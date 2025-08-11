<?php
/**
 * The template for displaying all pages.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$source = get_queried_object();
?>
<main id="content">
	<div class="page-content source" role="main">

		<?php $unit_slug = get_term_meta( $source->term_id, 'term_unit', true ); ?>
		<?php if ( $unit_slug && ! is_wp_error( $unit_slug ) ): ?>
			<?php $unit = get_term_by( 'slug', $unit_slug, 'unit' ); ?>
			<nav class="unit-header">
				<div class="unit-title">
					<a href="<?php echo esc_url( get_term_link( $unit ) ); ?>">
						<?php echo esc_html( $unit->name ); ?>
					</a>
				</div>
			</nav>
		<?php endif; ?>

		<!-- List all posts that belong to this source -->
		<?php if ( have_posts() ) : ?>
			<nav class="source-chapter-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="source-chapter">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</div>
				<?php endwhile; ?>
			</nav>
		<?php endif; ?>

		<section class="source-content">
			<header class="source-header">
				<h1 class="source-title"><?php echo $source->name; ?></h1>
			</header>

			<?php $teaser = get_term_meta( $source->term_id, 'term_teaser', true ); ?>
			<?php if ( $teaser ): ?>
				<div class="source-teaser">
					<?php echo esc_html( $teaser ); ?>
				</div>
			<?php endif; ?>

			<?php get_template_part('partials/source', 'metadata', array('source' => $source)); ?>

		</section>
	</div>
</main>

<?php get_footer(); ?>
