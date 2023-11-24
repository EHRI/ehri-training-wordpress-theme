<?php

/**
 * @file
 * Returns the HTML for the basic html structure of a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728208
 */

$newsletter_edition_slug = get_queried_object()->slug;
$newsletter_edition_name = get_queried_object()->name;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="shortcut icon" href="<?php echo get_theme_file_uri('favicon.png'); ?>" type="image/png"/>
    <!--    <meta name="generator" content="Drupal 7 (https://www.drupal.org)" />-->
    <link rel="canonical"
          href="<?php echo get_term_link($newsletter_edition_slug, $taxonomy = 'newsletter_edition'); ?>"/>
    <link rel="shortlink"
          href="<?php echo get_term_link($newsletter_edition_slug, $taxonomy = 'newsletter_edition'); ?>"/>
    <meta name="dcterms.title" content="EHRI Newsletter - <?php echo $newsletter_edition_name; ?>"/>
    <meta name="dcterms.type" content="Text"/>
    <meta name="dcterms.format" content="text/html"/>
    <!--    <meta name="dcterms.identifier" content="--><?php //echo the_pa ?><!--" />-->

    <title>EHRI Newsletter - <?php echo $newsletter_edition_name; ?></title>
    <?php
    //    global $base_url;
    //    global $mybase;
    //    $mybase = url(path_to_theme(),array('absolute'=>true));
    //    $mybase = trim($mybase,'/');

    $base_url = get_bloginfo('url');
    ?>
    <style>
        <!--
        body {
            background-color: #ffffff;
            font: 14px Arial, Helvetica, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        div.container {
            width: 100%;
        }

        table.wrap {
            text-align: center;
            margin-left: auto;
            margin-right: auto;
            margin-top: 0;
            border-bottom: 10px solid #a8026c;
            width: 560px;
        }

        tr, td {
            text-align: left;
        }

        td#top1 {
            height: 15px;
        }

        td#top2 {
            height: 129px;
        }

        td#top3 {
            height: 193px;
        }

        td#top4 {
            height: 29px;
            text-align: right;
            background-color: #9b0058;
            color: #ffffff;
        }

        td#social {
            text-align: center;
        }

        td#video {
            text-align: center;
            font-size: 14px;
        }

        table.main {
            width: 100%;
            border: 0;
            padding: 0;
        }

        td.inset {
            width: 8px;
        }

        .topborder {
            font-size: 11px;
            text-align: center;
            background-color: #4e1965;
            height: 15px;
        }

        .topborder a {
            font-size: 11px;
            text-align: center;
            color: #ffffff;
        }

        .topborder a:hover {
            color: #ffffff;
            text-decoration: none;
        }

        p {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        a:link, .active, .readmore {
            color: #9b0058;
            text-decoration: none;
        }

        a:hover, .active:hover {
            color: #9b0058;
            text-decoration: underline;
        }

        .td_padding {
            padding-right: 16px;
            padding-left: 16px;
        }

        table.footer {
            width: 560px;
            border: 0;
        }

        td.institution_list {
            width: 280px;
        }

        .footer td {
            font-size: 11px;
            vertical-align: top;
        }

        .footer p {
            font-size: 11px;
            color: #666666;
            padding-right: 15px;
            padding-left: 15px;
        }

        .footer th {
            font-size: 20px;
            font-weight: 700;
            text-align: left;
            padding-left: 16px;
            border-top: 1px solid #666666;
            border-bottom: 1px solid #666666;
            padding-top: 5px;
            padding-bottom: 3px;
            color: #666666;
        }

        .footer .border {
            border-top: 1px solid #666666;
        }

        .footer ul {
            list-style: none;
            padding-left: 16px;
        }

        .footer li {
            color: #666666;
            background: url(<?php echo get_theme_file_uri('images/newsletter/bullet.gif'); ?>) no-repeat 0 5px;
            padding-left: 10px;
        }

        .odd td {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        h2 {
            font-weight: 400;
            margin: 0;
            padding: 0;
        }

        h2 a, h2 a:hover {
            color: #666666;
            text-decoration: none;
        }

        .even td {
            padding: 15px;
        }

        .even {
            background: #e4e4e4;
        }

        .odd img {
            float: right;
            margin-left: 10px;
        }

        .even img {
            float: left;
            padding-right: 10px;
        }

        .views-row-odd td {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .views-row-even td {
            padding: 8px;
        }

        .views-row-odd {
            background: #ffffff;
        }

        .views-row-even {
            background: #e4e4e4;
        }

        .views-row-odd img {
            float: right;
            margin-left: 10px;
        }

        .views-row-even img {
            float: left;
            padding-right: 10px;
        }

        h3 {
            font-size: 100%;
        }

        -->
    </style>
</head>
<body>

<div class="container">
    <table class="wrap">
        <tr>
            <td id="top1" class="topborder">&nbsp;</td>
        </tr>
        <tr>
            <td id="top2"><img src="<?php echo get_theme_file_uri('images/newsletter/logo.gif'); ?>" alt=""/></td>
        </tr>
        <tr>
            <td id="top3"><img src="<?php echo get_theme_file_uri('images/newsletter/visual.jpg'); ?>" alt=""/></td>
        </tr>
        <tr>
            <td id="top4" class="td_padding"><b>EHRI Newsletter - <?php echo $newsletter_edition_name; ?></b></td>
        </tr>

        <?php
        $args = array(
            'post_status' => 'publish',
            'category_name' => 'news',
            'post_type' => 'post', // Your Post type Name that You Registered
            'posts_per_page' => 15,
            'order' => 'DESC',
            'orderby' => 'date',
            'tax_query' => array(
                array(
                    'taxonomy' => 'newsletter_edition',
                    'field' => 'slug',
                    'terms' => $newsletter_edition_slug
                )
            )
        );

        $the_query = new WP_Query($args);
        $post_count = 0;
        ?>

        <?php if ($the_query->have_posts()) : ?>
            <?php while ($the_query->have_posts()) : $the_query->the_post();
                $post_count++; ?>

                <tr class="views-row views-row-<?php echo $post_count; ?> views-row-<?php echo $post_count % 2 == 0 ? 'even' : 'odd'; ?>">
                    <td>
                        <table class="main">
                            <tr>
                                <td colspan="2">
                                    <div class="field field-title">
                                        <h2><a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php the_title(); ?></a></h2>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="inset">&nbsp;</td>
                                <td>
                                    <?php if(has_post_thumbnail()): ?>
                                        <div class="field field-photo">
                                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>"
                                                 alt="<?php echo get_the_title(); ?>"/>
                                        </div>
                                    <?php endif; ?>
                                    <div class="field field-datum">
                                <span class="date-display-single">
                                    <?php echo get_the_date('d/m/Y'); ?>
                                </span>
                                    </div>
                                    <div class="field field-body">
                                        <?php echo drupal_text_summary(get_the_content(), $max_length = 600); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                            <span class="readmore">
                                <a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                    Read more &gt;
                            </span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>


        <tr>
            <td>
                <table class="footer">
                    <tr>
                        <th colspan="2" scope="col">EHRI partners</th>
                    </tr>
                    <tr>
                        <td class="institution_list">
                            <ul>
                                <li>KNAW – NIOD Institute for War, Holocaust and Genocide Studies (NL)</li>
                                <li>KNAW – DANS Data Archiving and Networked Services (NL)</li>
                                <li>Belgian State Archives/CegeSoma (BE)</li>
                                <li>Masaryk Institute and Archives of the Czech Academy of Sciences (CZ)</li>
                                <li>Yad Vashem (IL)</li>
                                <li>Leibniz Institute for Contemporary History (DE)</li>
                                <li>King's College London (UK)</li>
                                <li>Holocaust Documentation Center (SK)</li>
                                <li>Kazerne Dossin (BE)</li>
                                <li>The Wiener Holocaust Library (UK)</li>
                                <li>’Elie Wiesel’ National Institute for the Study of the Holocaust in Romania (RO)</li>
                                <li>Vienna Wiesenthal Institute for Holocaust Studies (AT)</li>
                            </ul>
                        </td>
                        <td class="institution_list">
                            <ul>
                                <li>Shoah Memorial (FR)</li>
                                <li>Jewish Historical Institute (PL)</li>
                                <li>US Holocaust Memorial Museum (US)</li>
                                <li>National Research Council (IT)</li>
                                <li>Arolsen Archives (DE)</li>
                                <li>Federal Archives (DE)</li>
                                <li>Inria – team ALMAnaCH (FR)</li>
                                <li>Polish Center for Holocaust Research (PL)</li>
                                <li>Contemporary Jewish Documentation Center Foundation (IT)</li>
                                <li>Aristotle University of Thessaloniki (GR)</li>
                                <li>Vilna Gaon Museum of Jewish History (LT)</li>
                                <li>Hungarian Jewish Museum and Archives (HU)</li>
                                <li>Center for Urban History of East Central Europe (UA)</li>
                                <li>Jewish Museum in Prague (CZ)</li>
                                <li>Jewish Museum of Greece (GR)</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="border">
                            <p>EHRI, European Holocaust Research Infrastructure, NIOD. Institute for War, Holocaust and
                                Genocide Studies, Herengracht 380, NL-1016 CJ Amsterdam, The
                                Netherlands, +31(0)20-5233800 &copy; 2011 EHRI</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" id="video">
                            Watch a <a class="active" target="_blank" href="https://youtu.be/IUFqR7l5qW8">video
                                introduction to the EHRI Portal</a>
                        </td>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
        </tr>
        <tr>
            <td id="social">
                <a href="https://twitter.com/EHRIproject">
                    <img border="0" alt="EHRI on Twitter"
                         src="<?php echo get_theme_file_uri('images/newsletter/follow-us-on-twitter.jpg'); ?>"
                         width="100" height="50">
                </a>
            </td>
            <td id="social">
                <a href="https://facebook.com/EHRIproject">
                    <img border="0" alt="EHRI on Facebook"
                         src="<?php echo get_theme_file_uri('images/newsletter/find-us-on-facebook.png'); ?>"
                         width="100" height="50">
                </a>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
