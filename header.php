<?php
/**
 * Header template for EHRI Training WordPress theme.
 *
 * @package ehri_training
 */

?>

<!DOCTYPE html>
<?php $home = get_home_url(); ?>
<html lang="en">
<head>
	<?php $home = get_home_url(); ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,minimum-scale=1">
	<meta name="dcterms.title" content="European Holocaust Research Infrastructure">
	<meta name="dcterms.type" content="Text">
	<meta name="dcterms.format" content="text/html">
	<meta name="dcterms.identifier" content="<?php echo $home; ?>/">
	<meta name="dcterms.rightsHolder" content="EHRI-ERIC">
	<meta name="dcterms.dateCopyrighted" content="<?php echo gmdate( 'Y' ); ?>">

	<meta property="og:locale" content="en-GB">
	<meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
	<meta property="og:title" content="<?php echo esc_attr( get_the_title() ); ?>">
	<?php if ( is_tax( 'unit' ) ) : ?>
		<?php $unit = get_queried_object(); ?>
		<meta property="og:description" content="<?php echo esc_attr( wp_filter_nohtml_kses( $unit->description ) ); ?>">
		<meta property="og:image" content="<?php echo esc_attr( wp_get_attachment_image_url( get_term_meta( $unit->term_id, 'term_feature_image', true ), 'large' ) ); ?>">
		<meta property="og:url" content="<?php echo esc_url( get_the_permalink() ); ?>">
		<meta property="og:type" content="article">
	<?php elseif ( is_single() ) : ?>
		<meta property="og:description" content="<?php echo esc_attr( wp_filter_nohtml_kses( get_the_excerpt() ) ); ?>">
		<meta property="og:image" content="<?php echo esc_url( ehri_training_post_unit_image_url( get_queried_object() ) ); ?>">
		<meta property="og:url" content="<?php echo esc_url( get_the_permalink() ); ?>">
		<meta property="og:type" content="article">
		<meta property="article:published_time" content="<?php echo get_the_date( 'c' ); ?>">
		<meta property="article:modified_time" content="<?php echo get_the_modified_date( 'c' ); ?>">
	<?php else : ?>
		<meta property="og:description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
		<meta property="og:image" content="<?php echo esc_url( get_theme_file_uri( 'images/ehri-logo-large.png' ) ); ?>">
		<meta property="og:url" content="<?php echo esc_url( get_home_url() ); ?>">
		<meta property="og:type" content="website">
	<?php endif; ?>

	<link rel="shortcut icon" href="<?php echo get_theme_file_uri( 'favicon.png' ); ?>" type="image/png">
	<meta name="robots" content="index, follow">

	<script type=application/ld+json>{
			"@context": "https://schema.org",
			"@type": "WebSite",
			"about": {
				"@type": "Organization",
				"email": "info@ehri-project.eu",
				"name": "EHRI-ERIC"
			},
			"url": "<?php echo get_bloginfo( 'url' ); ?>"
		}</script>

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<header class="main header">
	<a id="top"></a>
	<div id="logo">
		<a href="<?php echo $home; ?>">
			<?php if ( is_front_page() ) : ?>
				<img src="<?php echo get_theme_file_uri( 'images/ehri-logo.svg' ); ?>" alt="EHRI Logo">
			<?php else : ?>
				<img src="<?php echo get_theme_file_uri( 'images/ehri-logo-s.svg' ); ?>" alt="EHRI Logo">
			<?php endif; ?>
		</a>
	</div>

	<h1 class="header-site-name" id="site-name">
		<a href="/" title="Home" class="header-site-link" rel="home">
			<span><?php echo get_bloginfo( 'title' ); ?></span>
		</a>
	</h1>

	<!-- Render the menus -->
	<?php
	wp_nav_menu(
		array(
			'menu'            => 'main-menu',
			'theme_location'  => 'primary',
			'container'       => 'nav',
			'container_class' => 'main-menu-container',
			'menu_class'      => 'menu',
			'menu_id'         => 'main-menu',
			'fallback_cb'     => false,
		)
	);
	?>

	<?php if ( is_front_page() ) : ?>
		<div id="hero">
			<div class="hero-text">
				<?php echo get_bloginfo( 'description' ); ?>
				<span class="read-more">
					<a href="/overview">read more</a>
				</span>
			</div>
		</div>
	<?php endif; ?>
</header>
