<?php
/**
 * Pagination layout.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'ehri_pagination' ) ) {

	function ehri_pagination( $args = array(), $class = 'pagination' ) {

		if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) {
			return;
		}

		$args = wp_parse_args(
			$args,
			array(
				'mid_size'           => 2,
				'prev_next'          => true,
				'prev_text'          => __( 'Previous', 'ehri' ),
				'next_text'          => __( 'Next', 'ehri' ),
				'screen_reader_text' => __( 'Posts navigation', 'ehri' ),
				'type'               => 'array',
				'current'            => max( 1, get_query_var( 'paged' ) ),
			)
		);

		$links = paginate_links( $args );

		?>

		<nav class="item-list" aria-label="<?php echo $args['screen_reader_text']; ?>">

			<ul class="pager">

				<?php
				foreach ( $links as $key => $link ) {
					?>
					<li class="pager-item <?php echo strpos( $link, 'current' ) ? 'pager-current active' : ''; ?>">
						<?php echo str_replace( 'page-numbers', 'page-link', $link ); ?>
					</li>
					<?php
				}
				?>

			</ul>

		</nav>

		<?php
	}
}

?>
