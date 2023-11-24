<?php
/**
 * The template for latest news items.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<main id="content">
    <section class="page-content" role="main">
        <a id="#main-content"></a>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'loop-templates/content', 'single' ); ?>
		<?php endwhile; ?>

        <div class="view-filters">
			<?php
			$year_opts        = get_terms( 'fellowship_year', array( 'hide_empty' => true ) );
			$institution_opts = get_terms( 'fellowship_institution', array( 'hide_empty' => true ) );
			$paged            = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$year             = get_query_var( 'fellowship-year' );
			$institution      = get_query_var( 'fellowship-institution' );

			$tax_queries = array();
			if ( $year ) {
				$tax_queries[] = array(
					'taxonomy' => 'fellowship_year',
					'field'    => 'slug',
					'terms'    => $year,
				);
			}
			if ( $institution ) {
				$tax_queries[] = array(
					'taxonomy' => 'fellowship_institution',
					'field'    => 'slug',
					'terms'    => $institution,
				);
			}

			$args      = array(
				'tag'            => 'fellows-list,fellows-list-2013,fellow-list-2014,fellow-list-2016',
				'tax_query'      => $tax_queries,
				'paged'          => $paged,
				'posts_per_page' => 20,
				'orderby'        => 'date',
				'order'          => 'DESC',
			);
			$the_query = new WP_Query( $args );

			?>

            <form method="GET" accept-charset="UTF-8">
                <div class="views-exposed-form">
                    <div class="views-exposed-widgets clearfix">
                        <div id="edit-field-host-institution-value-wrapper"
                             class="views-exposed-widget views-widget-filter-field_host_institution_value">
                            <label for="edit-field-host-institution-value">Host institution</label>
                            <div class="views-widget">
                                <div class="form-item form-type-select form-item-field-host-institution-value">
                                    <select id="edit-field-host-institution-value"
                                            name="fellowship-institution" class="form-select">
                                        <option value="" selected="selected">- Any -</option>
										<?php foreach ( $institution_opts as $term ) : ?>
											<?php if ( $term->slug == $institution ) : ?>
                                                <option value="<?php echo $term->slug; ?>"
                                                        selected="selected"><?php echo $term->name; ?></option>
											<?php else : ?>
                                                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
											<?php endif; ?>
										<?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="edit-field-year-of-fellowship-value-wrapper"
                             class="views-exposed-widget views-widget-filter-field_year_of_fellowship_value">
                            <label for="edit-field-year-of-fellowship-value">Year of Fellowship</label>
                            <div class="views-widget">
                                <div class="form-item form-type-select form-item-field-year-of-fellowship-value">
                                    <select id="edit-field-year-of-fellowship-value"
                                            name="fellowship-year" class="form-select">
                                        <option value="" selected="selected">- Any -</option>
										<?php foreach ( $year_opts as $term ) : ?>
											<?php if ( $term->slug == $year ) : ?>
                                                <option value="<?php echo $term->slug; ?>"
                                                        selected="selected"><?php echo $term->name; ?></option>
											<?php else : ?>
                                                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
											<?php endif; ?>
										<?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="views-exposed-widget views-submit-button">
                            <input type="submit" id="edit-submit-clone-of-ehri-fellows-2016" value="Apply"
                                   class="form-submit"></div>
                    </div>
                </div>

				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<?php get_template_part( 'loop-templates/content', 'fellowship' ); ?>
					<?php endwhile; ?>
				<?php endif; ?>

                <!-- The pagination component -->
				<?php ehri_pagination(); ?>
            </form>
        </div>
    </section>
	<?php get_sidebar(); ?>
</main>


<?php get_footer(); ?>
