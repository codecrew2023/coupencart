<?php

/**
 * Cratsy Lite functions and definitions.
 *
 * @see https://developer.wordpress.org/themes/basics/theme-functions/
 */

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

use Cartsy_Lite\Framework\Cartsy_Lite;

if (!defined('CARTSY_LITE_VERSION')) {
    define('CARTSY_LITE_VERSION', wp_get_theme()->get('Version'));
}

if (!defined('CARTSY_LITE_MIN_PHP_VER_REQUIRED')) {
    define('CARTSY_LITE_MIN_PHP_VER_REQUIRED', wp_get_theme()->get('RequiresPHP'));
}

if (!defined('CARTSY_LITE_MIN_WP_VER_REQUIRED')) {
    define('CARTSY_LITE_MIN_WP_VER_REQUIRED', wp_get_theme()->get('RequiresWP'));
}

if (!defined('CARTSY_LITE_ASSETS')) {
    define('CARTSY_LITE_ASSETS', get_theme_file_uri() . '/assets/');
}

if (!defined('CARTSY_LITE_IMAGE_PATH')) {
    define('CARTSY_LITE_IMAGE_PATH', get_template_directory_uri() . '/assets/images/');
}

if (!defined('CARTSY_LITE_DIST')) {
    define('CARTSY_LITE_DIST', get_theme_file_uri() . '/dist/');
}

if (!defined('CARTSY_LITE_DATA_PATH')) {
    define('CARTSY_LITE_DATA_PATH', get_template_directory_uri() . '/assets/data/');
}

require get_theme_file_path('/vendor/autoload.php');
require get_theme_file_path('/framework/kirki/class-kirki-installer-section.php');
if (is_admin()) {
    require get_theme_file_path('/framework/tgmpa/class-tgm-plugin-activation.php');
}
new Cartsy_Lite();
