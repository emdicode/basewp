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
        add_theme_support('html5', array('search-form', 'gallery', 'caption'));
        add_theme_support('post-thumbnails');

        add_action('after_setup_theme', array(&$this, 'register_menus'));

        add_filter('image_size_names_choose', array(&$this, 'image_size_names_choose'));

        add_filter('tiny_mce_before_init', array(&$this, 'insert_formats'));
        add_filter('mce_buttons_2', array(&$this, 'add_mce_button'), 10, 2);

        add_editor_style();

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

    /**
     * WYSIWYG / Format Dropdown
     */
    public function insert_formats($init_array)
    {
        $style_formats = array(
            array(
                'title' => 'Main Heading',
                'classes' => 'main-heading',
                'wrapper' => true,
            ),
            array(
                'title' => 'Sub Heading',
                'classes' => 'sub-heading',
                'wrapper' => false,
            ),
            array(
                'title' => 'Secondary Sub Heading',
                'classes' => 'secondary-sub-heading',
                'wrapper' => true,
            ),
            array(
                'title' => 'Intro Text',
                'classes' => 'intro-text',
                'wrapper' => true,
            ),
            array(
                'title' => 'Button',
                'block' => 'span',
                'classes' => 'button button--primary',
                'wrapper' => true,
            ),
            array(
                'title' => 'Byline',
                'block' => 'p',
                'classes' => 'byline',
                'wrapper' => false,
            ),

        );

        $init_array['style_formats'] = json_encode($style_formats);

        return $init_array;
    }

    /**
     * Add Buttons To WP Editor Toolbar.
     */
    public function add_mce_button($buttons, $editor_id)
    {
        /* Add it as first item in the row */
        array_unshift($buttons, 'styleselect');
        return $buttons;
    }

    /**
     * Provide size choices for media library
     * @param string[] $sizes
     * @return string[]
     */
    public function image_size_names_choose($sizes)
    {
        return array_merge($sizes, array(
            'tiny' => __('Tiny Image', 'barrel-base'),
            'small' => __('Small Image', 'barrel-base'),
            'medium' => __('Medium Image', 'barrel-base'),
            'large' => __('Large Image', 'barrel-base'),
        ));
    }
}

new Theme();
