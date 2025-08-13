<?php
/**
 * Pagination layout.
 *
 * @package ehri_training
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'ehri_training_pagination' ) ) {
	/**
	 * Display pagination for posts.
	 *
	 * @param array  $args  Arguments for paginate_links().
	 * @param string $class CSS class for pagination container.
	 */
	function ehri_training_pagination( $args = array(), $class = 'pagination' ) {

		if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) {
			return;
		}

		$args = wp_parse_args(
			$args,
			array(
				'mid_size'           => 2,
				'prev_next'          => true,
				'prev_text'          => __( 'Previous', 'ehri_training' ),
				'next_text'          => __( 'Next', 'ehri_training' ),
				'screen_reader_text' => __( 'Posts navigation', 'ehri_training' ),
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
