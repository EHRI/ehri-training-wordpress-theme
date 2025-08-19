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

<article class="post" <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="post-header">
		<h2 class="post-title">
			<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
				<?php the_title(); ?>
			</a>
		</h2>

		<div class="post-meta">
			<?php
			// Show unit taxonomy if it exists.
			$units = get_the_terms( get_the_ID(), 'unit' );
			if ( $units && ! is_wp_error( $units ) && ! empty( $units ) ) :
				?>
				<span class="post-unit">
					<span class="label-inline"><?php esc_html_e( 'Unit:', 'ehri_training' ); ?></span>
					<?php foreach ( $units as $unit ) : ?>
						<a href="<?php echo esc_url( get_term_link( $unit ) ); ?>">
							<?php echo esc_html( $unit->name ); ?>
						</a>
					<?php endforeach; ?>
				</span>
			<?php endif; ?>
		</div>
	</header>

	<div class="post-content">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
					<?php the_post_thumbnail( 'thumbnail', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
				</a>
			</div>
		<?php endif; ?>

		<div class="post-excerpt">
			<?php if ( has_excerpt() ) : ?>
				<?php the_excerpt(); ?>
			<?php else : ?>
				<?php
				$content         = get_the_content();
				$trimmed_content = wp_trim_words( $content, 30, '...' );
				echo wp_kses_post( $trimmed_content );
				?>
			<?php endif; ?>
		</div>
		<div class="read-more">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<?php esc_html_e( 'Read More', 'ehri_training' ); ?>
			</a>
		</div>
	</div>
</article><!-- #post-## -->
