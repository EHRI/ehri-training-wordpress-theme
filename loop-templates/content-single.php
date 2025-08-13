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
			<?php $index_page = ehri_training_get_unit_index_page( $u->slug ); ?>
			<?php if ( $index_page ) : ?>
				<div class="unit-index-page">
					<a href="<?php echo esc_url( get_permalink( $index_page ) ); ?>">
						<?php echo esc_html( get_the_title( $index_page ) ); ?>
					</a>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</nav>
<?php endif; ?>

<section class="unit-content">
	<header class="post-header">
		<h1 class="post-title" id="page-title">
			<?php $chapter = get_post_meta( get_the_ID(), '_unit_chapter', true ); ?>
			<?php if ( $chapter ) : ?>
				<span class="unit-chapter-number"><?php echo esc_html( $chapter ); ?></span>
			<?php endif; ?>
			<?php the_title(); ?>
		</h1>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<picture class="featured-image">
			<?php the_post_thumbnail( 'large' ); ?>
		</picture>
	<?php endif; ?>

	<?php if ( has_excerpt() ) : ?>
		<div class="post-excerpt">
			<?php the_excerpt(); ?>
		</div>
	<?php endif; ?>

	<div class="post-body">
		<?php the_content(); ?>
	</div>

	<?php $sources = get_the_terms( get_the_ID(), 'source' ); ?>
	<?php if ( $sources && ! is_wp_error( $sources ) && ! empty( $sources ) ) : ?>
		<section class="post-sources">
			<h2>Sources</h2>
			<?php foreach ( $sources as $source ) : ?>
				<div class="post-source">
					<a href="<?php echo esc_url( get_term_link( $source ) ); ?>">
						<?php echo esc_html( $source->name ); ?>
					</a>
				</div>
			<?php endforeach; ?>
		</section>
	<?php endif; ?>

</section>

<?php
// Display a link to the next chapter, if available.
$next_chapter_name = get_post_meta( get_the_ID(), '_next_chapter', true );
?>
<?php if ( $next_chapter_name ) : ?>
	<?php $next_chapter = get_page_by_path( $next_chapter_name, OBJECT, 'post' ); ?>
	<div class="next-chapter">
		<span class="label-inline"><?php esc_html_e( 'Next Chapter:', 'ehri_training' ); ?></span>
		<a href="<?php echo esc_url( get_permalink( $next_chapter ) ); ?>">
			<?php echo esc_html( get_the_title( $next_chapter ) ); ?>
		</a>
	</div>
<?php endif; ?>
