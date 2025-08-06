<?php
/**
 * The main template file.
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
			// Get all terms in the 'unit' taxonomy
			$terms = get_terms( array(
				'taxonomy'   => 'unit',
				'hide_empty' => false,
			) );
			?>

			<?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
                <div class="unit-list">
					<?php foreach ( $terms as $term ) : ?>
                        <div class="unit-item">
                            <div class="unit-title">
                                <h2><a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a></h2>
                            </div>

                            <div class="unit-teaser">
                                <p><?php echo get_term_meta( $term->term_id, 'term_teaser', true ); ?></p>
                            </div>

                            <div class="unit-featured-image">
                                <a href="<?php echo get_term_link($term); ?>">
                                    <img src="<?php echo wp_get_attachment_image_url(get_term_meta($term->term_id, "term_feature_image", true), "large") ?>" alt="">
                                </a>
                            </div>
                        </div>
					<?php endforeach; ?>
                </div>
			<?php endif; ?>
        </div>
    </main>

<?php get_footer(); ?>
