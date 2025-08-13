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

<div <?php post_class( 'resource-card' ); ?> id="post-<?php the_ID(); ?>">
	<div class="resource-img">
		<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo get_the_title(); ?>">
			<?php
			$alt_text = get_the_title();
			echo ehri_training_teaser_element( $alt_text );
			?>
		</a>
	</div>
	<div class="resource-info">
		<!-- render the title as a link -->
		<header>
			<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo get_the_title(); ?>">
				<?php the_title(); ?>
			</a>
		</header>
	</div>
</div><!-- #post-## -->

<div class="views-row views-row-1">
	<div class="ds-2col taxonomy-term vocabulary-unit view-mode-taxonomy_teaser clearfix">


		<div class="group-left">

			<div class="field-title">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</div>

			<div class="field-teaser">
				<p>The majority of Jews persecuted by the Nazis shared the experience of being forced to live in a
					ghetto for a certain period of time. Some of these ghettos existed for several years, others only
					for a few weeks or even days. While several ghettos were hermetically sealed and surrounded by a
					wall or a fence, others remained open and were only defined by designating certain streets.</p>
			</div>
		</div>

		<div class="group-right">

			<div class="field-unit-image">
				<a href="/unit/1-ghettos-under-nazi-rule">
					<picture>
						<!--[if IE 9]>
						<video style="display: none;"><![endif]-->
						<source
							srcset="https://training.ehri-project.eu/sites/training/files/styles/unit_startcustom_user_wide_1x/public/map.jpg?itok=jvbWP6er&amp;timestamp=1395678886 1x, https://training.ehri-project.eu/sites/training/files/styles/unit_startcustom_user_wide_2x/public/map.jpg?itok=CfddbGHj&amp;timestamp=1395678886 2x"
							media="@media all and (min-width: 1200px)">
						<source
							srcset="https://training.ehri-project.eu/sites/training/files/styles/unit_startcustom_user_normal_1x/public/map.jpg?itok=2iKD7Ozm&amp;timestamp=1395678886 1x, https://training.ehri-project.eu/sites/training/files/styles/unit_startcustom_user_normal_2x/public/map.jpg?itok=AJKTyxB0&amp;timestamp=1395678886 2x"
							media="@media all and (max-width: 1199px)">
						<!--[if IE 9]></video><![endif]-->
						<img
							src="https://training.ehri-project.eu/sites/training/files/styles/unit_startcustom_user_normal_2x/public/map.jpg?itok=AJKTyxB0&amp;timestamp=1395678886"
							width="1696" height="1120" alt="" title="">
					</picture>
				</a></div>
		</div>

	</div>

</div>
