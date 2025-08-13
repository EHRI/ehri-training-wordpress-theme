<?php
/**
 * Admin-related functions for the EHRI Training theme.
 *
 * @package ehri_training
 */

if ( ! function_exists( 'ehri_training_add_posts_unit_filter' ) ) {
	/**
	 * Add unit taxonomy filter dropdown to Posts admin list.
	 */
	function ehri_training_add_posts_unit_filter() {
		global $typenow;

		// Only add filter on Posts list page.
		if ( 'post' !== $typenow ) {
			return;
		}

		// Get current selected unit (if any).
		// phpcs:disable WordPress.Security.NonceVerification.Recommended -- Filter dropdown doesn't need nonce
		$selected_unit = isset( $_GET['unit_filter'] ) ? sanitize_text_field( wp_unslash( $_GET['unit_filter'] ) ) : '';
		// phpcs:enable WordPress.Security.NonceVerification.Recommended

		// Get all unit terms.
		$units = get_terms(
			array(
				'taxonomy'   => 'unit',
				'hide_empty' => false,
				'orderby'    => 'meta_value_num',
				// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- Required for unit ordering
				'meta_key'   => 'term_num',
			)
		);

		if ( ! empty( $units ) && ! is_wp_error( $units ) ) {
			echo '<select name="unit_filter" id="unit_filter">';
			echo '<option value="">' . esc_html__( 'All Units', 'ehri_training' ) . '</option>';

			foreach ( $units as $unit ) {
				printf(
					'<option value="%s" %s>%s</option>',
					esc_attr( $unit->slug ),
					selected( $selected_unit, $unit->slug, false ),
					esc_html( $unit->name )
				);
			}

			echo '</select>';
		}
	}
}
add_action( 'restrict_manage_posts', 'ehri_training_add_posts_unit_filter' );

if ( ! function_exists( 'ehri_training_filter_posts_by_unit' ) ) {
	/**
	 * Filter posts by unit taxonomy in admin list.
	 *
	 * @param WP_Query $query The WordPress query object.
	 */
	function ehri_training_filter_posts_by_unit( $query ) {
		global $pagenow, $typenow;

		// Only apply filter on Posts admin list page.
		if ( 'edit.php' !== $pagenow || 'post' !== $typenow || ! is_admin() ) {
			return;
		}

		// Check if unit filter is set.
		// phpcs:disable WordPress.Security.NonceVerification.Recommended -- Filter parameter doesn't need nonce
		if ( isset( $_GET['unit_filter'] ) && ! empty( $_GET['unit_filter'] ) ) {
			$unit_slug = sanitize_text_field( wp_unslash( $_GET['unit_filter'] ) );
			// phpcs:enable WordPress.Security.NonceVerification.Recommended

			// Add tax_query to filter by unit.
			$tax_query = $query->get( 'tax_query' );
			if ( ! $tax_query ) {
				$tax_query = array();
			}

			$tax_query[] = array(
				'taxonomy' => 'unit',
				'field'    => 'slug',
				'terms'    => $unit_slug,
			);

			// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query -- Required for admin filtering
			$query->set( 'tax_query', $tax_query );
		}
	}
}
add_action( 'pre_get_posts', 'ehri_training_filter_posts_by_unit' );
