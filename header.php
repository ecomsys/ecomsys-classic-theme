<?php
/**
 * The header template
 *
 * @package Ecomsys Classic Theme
 */

?><!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    

<!-- Favicon и PWA icons -->
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/favicon-16x16.png">
<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/site.webmanifest">
<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<!-- /Favicon и PWA icons -->

<?php wp_head(); ?>
</head>

<body <?php body_class("text-black dark:text-white bg-white dark:bg-gray-700"); ?>>
    <?php wp_body_open(); ?>

    <div class="overlay" data-overlay></div>

    <div id="page" class="site min-h-screen flex flex-col relative">
        <a class="skip-link screen-reader-text"
            href="#primary"><?php esc_html_e('Skip to content', 'ecomsys-classic'); ?></a>

        <?php render_component('Layout.Header'); ?>