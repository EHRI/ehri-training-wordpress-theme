<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<main id="content">

	<section class="page-content not-found" role="main">
		<h1><?php esc_html_e( '404: Page not found' ); ?></h1>
	</section>

</main>


<?php get_footer(); ?>
