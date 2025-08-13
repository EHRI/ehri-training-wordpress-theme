<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php $unit = get_the_terms( get_the_ID(), 'unit' ); ?>
<?php if ( $unit && ! is_wp_error( $unit ) && ! empty( $unit ) ) : ?>
	<nav class="unit-header">
		<?php foreach ( $unit as $u ) : ?>
			<div class="unit-title">
				<a href="<?php echo esc_url( get_term_link( $u ) ); ?>">
					<?php echo ehri_training_unit_number( $u ); ?>
					<?php echo esc_html( $u->name ); ?>
				</a>
			</div>
		<?php endforeach; ?>
	</nav>
<?php endif; ?>

<section class="unit-content">
	<h1 class="post-title" id="page-title"><?php the_title(); ?></h1>

	<!-- List all the chapters for this unit and their respective sources -->
	<?php
	$chapter_query = new WP_Query(
		array(
			'post_type'      => 'post',
			'posts_per_page' => -1, // Get all posts.
			'orderby'        => 'meta_value_num',
			'meta_key'       => '_sort_order', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- Required for custom sort order of chapters
			'order'          => 'ASC',
			'tax_query'      => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query -- Necessary to filter posts by unit taxonomy
				array(
					'taxonomy' => 'unit',
					'field'    => 'slug',
					'terms'    => $unit ? wp_list_pluck( $unit, 'slug' ) : array(),
				),
			),
		)
	);
	?>
	<?php if ( $chapter_query->have_posts() ) : ?>
		<nav class="unit-chapter-list">
			<?php while ( $chapter_query->have_posts() ) : ?>
				<?php $chapter_query->the_post(); ?>
				<h3 class="unit-chapter">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<?php $sources = get_the_terms( get_the_ID(), 'source' ); ?>
				<?php if ( $sources && ! is_wp_error( $sources ) && ! empty( $sources ) ) : ?>
					<ul class="source-list">
						<?php foreach ( $sources as $source ) : ?>
							<li class="source-item">
								<a href="<?php echo esc_url( get_term_link( $source ) ); ?>">
									<?php echo esc_html( $source->name ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</nav>
	<?php endif; ?>

</section>

