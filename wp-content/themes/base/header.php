<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page">
    <a href="#primary"><?php esc_html_e('Skip to content', 'base'); ?></a>

    <header id="masthead">
        <div>
            <?php
            if (is_front_page()):
                ?>
                <h1><?php bloginfo('name'); ?></h1>
            <?php
            else:
                ?>
            <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"></a></p>
            <?php
            endif;
            ?>
        </div>
    </header>
