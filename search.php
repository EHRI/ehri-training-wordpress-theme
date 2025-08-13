<?php
/**
 * The template for displaying search results.
 *
 * @package ehri_training
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<main id="content">
	<div class="page-content search-results" role="main">
		<a id="main-content"></a>

		<header class="search-header">
			<h1 class="search-title">
				<?php if ( have_posts() ) : ?>
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: "%s"', 'ehri_training' ), '<span class="search-query">' . esc_html( get_search_query() ) . '</span>' );
					?>
				<?php else : ?>
					<?php esc_html_e( 'Nothing Found', 'ehri_training' ); ?>
				<?php endif; ?>
			</h1>
		</header>

		<section class="search-content">
			<?php if ( have_posts() ) : ?>
				<div class="search-results-count">
					<?php
					global $wp_query;
					/* translators: %s: number of search results. */
					printf( esc_html__( 'Found %s results', 'ehri_training' ), '<strong>' . esc_html( $wp_query->found_posts ) . '</strong>' );
					?>
				</div>

				<div class="search-results-list">
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<?php get_template_part( 'loop-templates/content', 'search' ); ?>
					<?php endwhile; ?>
				</div>

				<?php
				// Pagination.
				if ( function_exists( 'ehri_training_pagination' ) ) {
					ehri_training_pagination();
				} else {
					the_posts_navigation();
				}
				?>

			<?php else : ?>
				<div class="search-no-results">
					<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'ehri_training' ); ?></p>

					<div class="search-form-container">
						<?php get_search_form(); ?>
					</div>

					<div class="search-suggestions">
						<h3><?php esc_html_e( 'Suggestions:', 'ehri_training' ); ?></h3>
						<ul>
							<li><?php esc_html_e( 'Try different keywords', 'ehri_training' ); ?></li>
							<li><?php esc_html_e( 'Try more general keywords', 'ehri_training' ); ?></li>
							<li><?php esc_html_e( 'Check your spelling', 'ehri_training' ); ?></li>
						</ul>
					</div>
				</div>
			<?php endif; ?>
		</section>
	</div>
</main>

<?php get_footer(); ?>
