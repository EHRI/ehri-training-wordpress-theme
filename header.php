<?php
// With this snippet from header.php:
?>

<!DOCTYPE html>
<?php $home = get_home_url(); ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo get_the_title(); ?> | <?php echo get_bloginfo('description'); ?></title>
    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <meta name="dcterms.title" content="European Holocaust Research Infrastructure"/>
    <meta name="dcterms.type" content="Text"/>
    <meta name="dcterms.format" content="text/html"/>
    <meta name="dcterms.identifier" content="<?php echo $home; ?>/"/>

    <link rel="shortcut icon" href="<?php echo get_theme_file_uri('favicon.png'); ?>" type="image/png"/>
    <meta name="robots" content="index, follow">

    <!-- include style.css -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css"/>
    <?php wp_head(); ?>

    <?php if ($random_header_url = ehrieric_random_gallery_image_url()): ?>
        <style>
            .hero-content {
                background-image: url('<?php echo get_template_directory_uri(); ?>/images/bubbles-v2.svg');
            }
        </style>
    <?php endif; ?>

</head>
<body>
<header class="main header">
    <div class="banner">
        <div class="logo">
            <a href="<?php echo $home ?>"><img src="<?php echo get_theme_file_uri('images/ehri-logo.svg'); ?>" alt="EHRI Logo"/></a>
        </div>
    </div>
    <nav class="nav main-navbar">
        <label for="hb-toggle">Show menu</label>
        <input id="hb-toggle" type="checkbox"/>
        <span class="hb"></span>
        <span class="hb"></span>
        <span class="hb"></span>

        <div class="navbar">
            <ul class="main-menu" id="main-menu-items">
				<?php wp_nav_menu(array(
					'menu' => 'main-menu',
					'container' => false,
					'items_wrap' => '%3$s', // don't wrap the items in a <ul>
				)); ?>

                <li class="menu-item" id="menu-item-search">
                    <label class="screen-reader-text" for="search-toggle">Show search bar</label>
                    <input id="search-toggle" type="checkbox"/>
                    <div class="search-controls">
                        <form role="search" method="get" id="search-form" class="search-form" action="<?php echo $home; ?>">
                            <label class="screen-reader-text" for="search-input">Search for:</label>
                            <input type="text" value="" name="s" id="search-input" placeholder="Enter your search here" autofocus>
                            <button type="submit" id="search-submit">
                                <i class="fa-solid fa-fw fa-search"></i>
                                <span class="screen-reader-text">Search</span>
                            </button>
                        </form>
                    </div>
                    <i id="search-icon" class="fa-solid fa-fw fa-search"></i>
                    <span class="st-x"></span>
                    <span class="st-x"></span>
                </li>
            </ul>

        </div>
    </nav>
</header>

