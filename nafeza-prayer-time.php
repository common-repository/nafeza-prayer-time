<?php

/*
  Plugin Name:  Nafeza Prayer Time
  Plugin URI:   http://nafeza.net/
  Description:  Prayer times all over the world
  Version:      1.3.4
  Author:       Hussam Barbour
  Author URI:   http://nafeza.net/
  Text Domain:  nafeza-prayer-time
  Domain Path:  /languages/
 */

defined('ABSPATH') or die('No script kiddies please!'); // Exit if accessed directly.

if (!defined('NAFEZA_PREYER_TIME_PLUGIN_DIR')) {
    define('NAFEZA_PREYER_TIME_PLUGIN_DIR', plugin_dir_path(__FILE__));
}

if (!defined('NAFEZA_PREYER_TIME_PLUGIN_URL')) {
    define('NAFEZA_PREYER_TIME_PLUGIN_URL', plugin_dir_url(__FILE__));
}

function nafeza_prayer_time_load_plugin_textdomain()
{
    load_plugin_textdomain('nafeza-prayer-time', FALSE, basename(dirname(__FILE__)) . '/languages/');
}
add_action('plugins_loaded', 'nafeza_prayer_time_load_plugin_textdomain');

function nafeza_prayer_time_scripts()
{
    wp_enqueue_style('nafeza-prayer-time', NAFEZA_PREYER_TIME_PLUGIN_URL . 'css/widget.css', array(), '1.1.3');
    wp_enqueue_style('nafeza-prayer-time', NAFEZA_PREYER_TIME_PLUGIN_URL . 'css/widget.css', array(), '1.1.2');
    wp_enqueue_style('nafeza-prayer-time', NAFEZA_PREYER_TIME_PLUGIN_URL . 'css/widget.css', array(), '1.1.7');
}
add_action('wp_enqueue_scripts', 'nafeza_prayer_time_scripts');
require_once NAFEZA_PREYER_TIME_PLUGIN_DIR . 'includes/timezone.php';
require_once NAFEZA_PREYER_TIME_PLUGIN_DIR . 'includes/setting.php';
require_once NAFEZA_PREYER_TIME_PLUGIN_DIR . 'includes/functions.php';
require_once NAFEZA_PREYER_TIME_PLUGIN_DIR . 'includes/views.php';
require_once NAFEZA_PREYER_TIME_PLUGIN_DIR . 'includes/widget.php';
