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
		<header class="source-header">
			<h1 class="source-title"><?php echo $source->name; ?></h1>
		</header>
		<section class="source-content">
			<div class="source-description">
				<?php echo $source->description; ?>
			</div>
			<?php if ( have_posts() ) : ?>
				<div class="source-chapter-list">
					<?php while ( have_posts() ) : the_post(); ?>
						<h2 class="source-chapter">
							<?php $chapter = get_post_meta( get_the_ID(), '_source_chapter', true ); ?>
							<?php if ( $chapter ): ?>
								<div class="source-chapter-number"><?php echo esc_html( $chapter ); ?></div>
							<?php endif; ?>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</section>
		<?php $image = get_term_meta( $source->term_id, "term_feature_image", true ); ?>
		<?php if ( $image ): ?>
			<section class="source-featured-image">
				<img src="<?php echo wp_get_attachment_image_url( $image ); ?>"
					 alt="Featured image for <?php echo esc_html( $source->name ); ?>">
			</section>
		<?php endif; ?>
		<?php $file_1 = get_term_meta( $source->term_id, "term_file_1", true ); ?>
		<?php if ( $file_1 ): ?>
			<section class="source-file-1">
				<a href="<?php echo esc_url( wp_get_attachment_url( $file_1 ) ); ?>" target="_blank">
					<?php echo esc_html( get_the_title( $file_1 ) ); ?>
				</a>
			</section>
		<?php endif; ?>
		<?php $file_2 = get_term_meta( $source->term_id, "term_file_2", true ); ?>
		<?php if ( $file_2 ): ?>
			<section class="source-file-2">
				<a href="<?php echo esc_url( wp_get_attachment_url( $file_2 ) ); ?>" target="_blank">
					<?php echo esc_html( get_the_title( $file_2 ) ); ?>
				</a>
			</section>
		<?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
