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
<?php if ( $unit && ! is_wp_error( $unit ) && ! empty( $unit ) ): ?>
	<nav class="unit-header">
		<?php foreach ( $unit as $u ): ?>
			<div class="unit-title">
				<a href="<?php echo esc_url( get_term_link( $u ) ); ?>">
					<?php echo esc_html( $u->name ); ?>
				</a>
			</div>
		<?php endforeach; ?>
	</nav>
<?php endif; ?>

<section class="unit-content">
	<?php $chapter = get_post_meta( get_the_ID(), '_unit_chapter', true ); ?>
	<?php if ( $chapter ): ?>
		<div class="unit-chapter-number"><?php echo esc_html( $chapter ); ?></div>
	<?php endif; ?>

	<h1 class="post-title" id="page-title"><?php the_title(); ?></h1>

	<?php if ( has_post_thumbnail() ): ?>
		<picture class="featured-image">
			<?php the_post_thumbnail( 'large' ); ?>
		</picture>
	<?php endif; ?>

	<div class="post-body">
		<?php the_content(); ?>
	</div>
</section>

