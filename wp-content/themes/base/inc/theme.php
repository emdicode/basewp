<?php

class Theme extends Base
{

    static $textDomain = 'base';

    public function __construct()
    {
        parent::__construct();
    }

    public function add_theme_supports()
    {
        add_theme_support('title-tag');
        add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
        add_theme_support('post-thumbnails');

        add_action('after_setup_theme', array(&$this, 'register_menus'));

        // Enable RSS feeds
        add_theme_support( 'automatic-feed-links' );

        // Enable Widgets refresh from Customizer
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Set max content width (embedded)
        if ( ! isset( $content_width ) ) {
            $content_width = 1400;
        }

        // Load translations
        load_theme_textdomain( self::$textDomain, get_template_directory() . '/languages' );

        $this->add_options_page();
    }

    /**
     * Body class when info bar is active
     * @param array $class Array of classes
     * @return array
     */
    public function body_class($class)
    {
        return $class;
    }

    /**
     * Add a global Theme Settings page in admin area
     */
    public function add_options_page()
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page(array(
                'page_title' => __('Theme Options', self::$textDomain),
                'menu_title' => 'Theme Options',
                'menu_slug' => 'theme-options',
                'capability' => 'administrator',
                'redirect' => false
            ));
        }
    }

    /**
     * Register navigation menu areas that can be configurable via Appearance -> Menus
     */
    public function register_menus()
    {
        register_nav_menus(array(
            'header-primary' => __('Header Primary Menu', self::$textDomain),
            'header-quick-links' => __('Header Quick Links Menu', self::$textDomain),
            'footer' => __('Footer Menu', self::$textDomain),
            'footer-meta' => __('Footer Copyright Links', self::$textDomain)
        ));
    }
}

new Theme();
