<?php

abstract class Base
{
    static $textDomain;
    public $acfJsonPath;

    public function __construct()
    {
        $this->removeEmojis();

        add_action('after_setup_theme', array(&$this, 'add_theme_supports'));

        add_filter('pings_open', '__return_false', PHP_INT_MAX);
        // Remove feed icon link from legacy RSS widget.
        add_filter('rss_widget_feed_link', '__return_false', PHP_INT_MAX);
        add_filter( 'show_admin_bar', '__return_false' );

        add_filter('wp_headers', array(&$this, 'disabled_ping_backs'));

        add_filter('acf/settings/save_json', array(&$this, 'acf_json_save_point'));
        add_filter('acf/settings/load_json', array(&$this, 'acf_json_load_point'));
    }

    abstract public function add_theme_supports();

    private function removeEmojis()
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('admin_print_styles', 'print_emoji_styles');
    }

    public function disabled_ping_backs($headers)
    {
        unset($headers['X-Pingback']);
        return $headers;
    }

    public function acf_json_save_point($path)
    {
        return $this->acfJsonPath;
    }

    public function acf_json_load_point($paths)
    {
        return array($this->acfJsonPath);
    }
}
