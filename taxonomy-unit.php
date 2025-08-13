<?php
/**
 * The template for displaying all pages.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$unit = get_queried_object();
?>
<main id="content">
	<div class="page-content unit" role="main">
		<header class="unit-header">
			<h1 class="unit-title">
				<?php echo ehri_training_unit_number( $unit ); ?>
				<?php echo $unit->name; ?>
			</h1>
		</header>
		<section class="unit-content">
			<div class="unit-description">
				<?php echo $unit->description; ?>
			</div>
			<?php if ( have_posts() ) : ?>
				<div class="unit-chapter-list">
					<?php while ( have_posts() ) : the_post(); ?>
						<header class="unit-chapter-header">
							<h2 class="unit-chapter-title">
								<?php $chapter = get_post_meta( get_the_ID(), '_unit_chapter', true ); ?>
								<?php if ( $chapter ): ?>
									<span href="<?php the_permalink(); ?>"
										  class="unit-chapter-number"><?php echo esc_html( $chapter ); ?></span>
								<?php endif; ?>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
						</header>
					<?php endwhile; ?>
					<!-- Fetch any index_page posts for this unit -->
					<?php $index_page = ehri_training_get_unit_index_page( $unit->slug ); ?>
					<?php if ( $index_page ) : ?>
						<div class="unit-chapter-header">
							<h2 class="unit-chapter-title">
								<a href="<?php echo esc_attr( get_the_permalink( $index_page ) ); ?>">
									<?php echo esc_html( get_the_title( $index_page->ID ) ); ?>
								</a>
							</h2>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</section>
		<section class="unit-featured-image">
			<img
				src="<?php echo wp_get_attachment_image_url( get_term_meta( $unit->term_id, "term_feature_image", true ), "large" ) ?>"
				alt="Featured image for <?php echo esc_html( $unit->name ); ?>">
		</section>
	</div>
</main>

<?php get_footer(); ?>
