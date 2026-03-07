<?php
/**
 * The search results template file.
 *
 * @package ehri_training
 */

// Get the search query for pagination.
global $wp_query;

?>

<?php get_header(); ?>

<main id="content">
	<section class="page-content">
		<?php $query = get_search_query(); ?>
		<?php $q = trim( $query ); ?>
		<header class="search-header">
			<h1 class="search-title"><?php esc_html_e( 'Search the website', 'ehri_training' ); ?></h1>

			<form method="get">
				<div class="search-box">
					<label class="sr-only" for="search-box">Search</label>
					<i class="fa fa-2x fa-search" aria-hidden="true"></i>
					<input name="s" id="search-box" class="search-box-input" type="text"
						placeholder="<?php esc_attr_e( 'What are you looking for?', 'ehri_training' ); ?>"
						value="<?php echo esc_attr( $q ); ?>">
					<button type="submit" class="search-box-button button-primary">
						<?php esc_html_e( 'Search', 'ehri_training' ); ?>
					</button>
				</div>
			</form>
		</header>
		<?php if ( $q ) : ?>
			<?php if ( have_posts() ) : ?>
					<div class="breadcrumbs">
						<div class="text-muted">
							<?php echo '"' . esc_html( $q ) . '"'; ?>
						</div>
					</div>

				<div class="post-list">
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<?php get_template_part( 'loop-templates/content' ); ?>
					<?php endwhile; ?>
				</div>

				<!-- The pagination component -->
				<?php ehri_training_pagination( $wp_query ); ?>
			<?php else : ?>
				<div class="post-list">
					<h4><?php echo esc_html( sprintf( 'No results found for "%s"', $query ) ); ?> </h4>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</section>
</main>

<?php get_footer(); ?>
