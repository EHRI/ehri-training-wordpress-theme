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
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,minimum-scale=1">
	<meta name="dcterms.title" content="European Holocaust Research Infrastructure"/>
	<meta name="dcterms.type" content="Text"/>
	<meta name="dcterms.format" content="text/html"/>
	<meta name="dcterms.identifier" content="<?php echo $home; ?>/"/>

	<link rel="shortcut icon" href="<?php echo get_theme_file_uri( 'favicon.png' ); ?>" type="image/png"/>
	<meta name="robots" content="index, follow">

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<header class="main header" role="banner">
	<a id="top"></a>
	<div id="logo">
		<a href="<?php echo $home; ?>">
			<?php if ( is_front_page() ) : ?>
				<img src="<?php echo get_theme_file_uri( 'images/ehri-logo.svg' ); ?>" alt="EHRI Logo"/>
			<?php else : ?>
				<img src="<?php echo get_theme_file_uri( 'images/ehri-logo-s.svg' ); ?>" alt="EHRI Logo"/>
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
		<section id="hero">
			<div class="hero-text">
				<?php echo get_bloginfo( 'description' ); ?>
				<span class="read-more">
					<a href="/overview">read more</a>
				</span>
			</div>
		</section>
	<?php endif; ?>
</header>
