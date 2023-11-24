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


<div <?php post_class( 'page-summary' ); ?> id="post-<?php the_ID(); ?>">
    <div class="page-summary-content">
		<?php if ( has_post_thumbnail() ): ?>
            <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo get_the_title(); ?>">
				<?php echo ehriproject_teaser_element( $alt_text = get_the_title(), $classes = 'featured-image' ); ?>
            </a>
		<?php endif; ?>
        <header class="field field-name-field-title">
            <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo get_the_title(); ?>">
				<?php the_title(); ?>
            </a>
        </header>
        <time class="news-date" title="<?php echo get_the_date( 'd/m/Y' ); ?>">
			<?php echo get_the_date( 'l, F jS, Y' ); ?>
        </time>

        <div class="field field-name-field-body">
		    <?php echo get_the_excerpt(); ?>
        </div>
    </div>
    <a class="read-more" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo get_the_title(); ?>">
		<?php echo __( 'Read more', 'ehri' ); ?>
    </a>
</div>