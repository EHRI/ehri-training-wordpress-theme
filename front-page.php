<?php
/**
 * The main template file.
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
		<?php
		// Get all terms in the 'unit' taxonomy with caching for better performance.
		$terms = get_transient( 'ehri_training_front_page_units' );
		if ( false === $terms ) {
			$terms = get_terms(
				array(
					'taxonomy'   => 'unit',
					'hide_empty' => false,
					'orderby'    => 'meta_value_num',
					'meta_key'   => 'term_num', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- Required for custom unit ordering on front page
				)
			);

			// Cache for 1 hour.
			set_transient( 'ehri_training_front_page_units', $terms, HOUR_IN_SECONDS );
		}
		?>

		<?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
			<div class="unit-list">
				<?php foreach ( $terms as $unit_term ) : ?>
					<div class="unit-item">
						<div class="unit-title">
							<h2>
								<?php echo ehri_training_unit_number( $unit_term ); ?>
								<a href="<?php echo esc_url( get_term_link( $unit_term ) ); ?>">
									<?php echo esc_html( $unit_term->name ); ?>
								</a>
							</h2>
						</div>

						<div class="unit-teaser">
							<?php echo wp_kses_post( get_term_meta( $unit_term->term_id, 'term_teaser', true ) ); ?>
						</div>

						<div class="unit-featured-image">
							<a href="<?php echo esc_url( get_term_link( $unit_term ) ); ?>">
								<img
									src="<?php echo esc_url( wp_get_attachment_image_url( get_term_meta( $unit_term->term_id, 'term_feature_image', true ), 'large' ) ); ?>"
									alt="">
							</a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
