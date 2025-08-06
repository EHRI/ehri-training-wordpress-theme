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
			<h1 class="unit-title"><?php echo $unit->name; ?></h1>
		</header>
		<section class="unit-content">
			<div class="unit-description">
				<?php echo $unit->description; ?>
			</div>
			<?php if ( have_posts() ) : ?>
				<div class="unit-chapter-list">
					<?php while ( have_posts() ) : the_post(); ?>
						<h2 class="unit-chapter">
							<?php $chapter = get_post_meta( get_the_ID(), '_unit_chapter', true ); ?>
							<?php if ( $chapter ): ?>
								<div class="unit-chapter-number"><?php echo esc_html( $chapter ); ?></div>
							<?php endif; ?>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</section>
        <section class="unit-featured-image">
            <img src="<?php echo wp_get_attachment_image_url( get_term_meta( $unit->term_id, "term_feature_image", true ), "large" ) ?>"
                 alt="">
        </section>
    </div>
</main>

<?php get_footer(); ?>
