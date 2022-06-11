<?php

class Enqueues
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts_and_styles'));
        add_action('wp_head', array(&$this, 'base_google_fonts_pre_connect'));
    }

    public function enqueue_scripts_and_styles()
    {
        $theme_version = wp_get_theme()->get('Version');

        wp_enqueue_style('base-styles', get_template_directory_uri() . '/assets/main.min.css', false, $theme_version);

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        wp_enqueue_script( 'brk-scripts', get_template_directory_uri() . '/assets/main.min.js', false, $theme_version, true );
    }

    public function base_google_fonts_pre_connect()
    {
        echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
        echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    }
}

new Enqueues();
