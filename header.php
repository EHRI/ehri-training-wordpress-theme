<?php
// With this snippet from header.php:
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

    <script src="//use.typekit.com/pvi1xwv.js"></script>
    <script>
      try {
        Typekit.load();
      } catch (e) {
      }
    </script>

    <!-- include style.css -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css"/>
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<header class="main header" role="banner">
    <a id="top"></a>
    <div id="logo">
        <a href="<?php echo $home; ?>">
            <?php if (is_front_page()): ?>
                <img src="<?php echo get_theme_file_uri( 'images/ehri-logo.svg' ); ?>" alt="EHRI Logo"/>
            <?php else: ?>
                <img src="<?php echo get_theme_file_uri( 'images/ehri-logo-s.svg' ); ?>" alt="EHRI Logo"/>
            <?php endif; ?>
        </a>
    </div>

    <h1 class="header__site-name" id="site-name">
        <a href="/" title="Home" class="header__site-link" rel="home">
            <span><?php echo get_bloginfo( 'title' ); ?></span>
        </a>
    </h1>

    <div id="main-menu" role="navigation">
        <ul class="menu">
            <li class="menu__item is-leaf first leaf"><a href="/overview" class="menu__link">overview</a></li>
            <li class="menu__item is-leaf last leaf"><a href="/contact" class="menu__link">contact</a></li>
        </ul>
    </div>

	<?php if ( is_front_page() ): ?>
        <div class="header__tagline">
            <h2><?php echo get_bloginfo( 'description' ); ?></h2>
        </div>

        <section id="hero">
            <div class="hero-text">
                <p>Welcome to the EHRI Online Course in Holocaust Studies.
                    With this growing resource, we want to provide teachers, lecturers and students with source material
                    and background information in order to give them an overview on recent trends in historiography.
                    Since it is not possible to cover all the manifold topics encompassed by modern historical Holocaust
                    research,
                    EHRI has decided to develop a course that teaches by using selected representative examples: five
                    overarching topics have been developed
                    for the online course. Each of these topics is used to focus on a critical analysis of sources
                    within the context of the
                    current state and methods of Holocaust research.</p>
                <span class="readmore"><a href="/overview">read more</a></span>
            </div>
        </section>
	<?php endif; ?>
</header>
