<?php

namespace Cartsy_Lite\Framework\Client;

if (!defined('ABSPATH')) {
  exit('Direct script access denied.');
}

use Cartsy_Lite\Framework\Traits\Cartsy_Lite_StyleScriptLoader;
use Cartsy_Lite\Framework\Cartsy_Lite;

class Cartsy_Lite_Client_Style {
  use Cartsy_Lite_StyleScriptLoader;

  public function __construct() {
    add_filter('body_class', [$this, 'cartsy_lite_body_classes']);
    add_action('wp_enqueue_scripts', [$this, 'cartsy_lite_load_styles']);
  }

  /**
   * cartsy_lite_body_classes.
   *
   * @param array $classes
   *
   * @return array
   */
  public function cartsy_lite_body_classes($classes) {
    // Add class of feed to non-singular pages.
    if (!is_singular()) {
      $classes[] = 'cartsylite';
      $classes[] = 'cartsylite-page';
    }

    if (!is_active_sidebar('cartsylite-sidebar') || !is_active_sidebar('cartsylite-woo-sidebar')) {
      $classes[] = 'cartsylite-no-sidebar';
    }

    if (!is_user_logged_in()) {
      $classes[]  = "cartsylite-logout-mode";
    }

    // Add class when WooCommerce exist
    if (class_exists('WooCommerce')) {
      $classes[] = 'cartsylite-woo';
    }

    $classes[] = 'cartsylite-version-' . CARTSY_LITE_VERSION;

    return $classes;
  }

  /**
   * cartsy_lite_registerStyles.
   */
  private static function cartsy_lite_registerStyles() {
    $register_styles = apply_filters('cartsy_lite_frontend_styles_array', [
      'jquery.overlayScrollbars.min' => [
        'src'     => CARTSY_LITE_ASSETS . 'global/css/jquery.overlayScrollbars.min.css',
        'deps'    => [],
        'version' => CARTSY_LITE_VERSION,
        'has_rtl' => false,
      ],
      'cartsy-lite-fonts' => [
        'src'     => self::cartsy_lite_google_fonts(),
        'deps'    => [],
        'version' => CARTSY_LITE_VERSION,
        'has_rtl' => false,
      ],
      'cartsy-lite-normalize-style' => [
        'src'     => CARTSY_LITE_DIST . 'cartsy-lite-normalize-style.css',
        'deps'    => [],
        'version' => CARTSY_LITE_VERSION,
        'has_rtl' => true,
      ],
      'cartsy-lite-block-style' => [
        'src'     => CARTSY_LITE_ASSETS . 'global/css/blocks.css',
        'deps'    => [],
        'version' => CARTSY_LITE_VERSION,
        'has_rtl' => true,
      ],
      'cartsy-lite-woo-style' => [
        'src'     => CARTSY_LITE_DIST . 'cartsy-lite-woo-style.css',
        'deps'    => [],
        'version' => CARTSY_LITE_VERSION,
        'has_rtl' => true,
      ],
      'cartsy-lite-main-style' => [
        'src'     => CARTSY_LITE_DIST . 'cartsy-lite-main-style.css',
        'deps'    => [],
        'version' => CARTSY_LITE_VERSION,
        'has_rtl' => true,
      ],
      'cartsy-lite-home-style' => [
        'src'     => CARTSY_LITE_DIST . 'cartsy-lite-home-style.css',
        'deps'    => [],
        'version' => CARTSY_LITE_VERSION,
        'has_rtl' => true,
      ],
      'cartsy-lite-rnb-style' => [
        'src'     => CARTSY_LITE_DIST . 'cartsy-lite-rnb.css',
        'deps'    => [],
        'version' => CARTSY_LITE_VERSION,
        'has_rtl' => true,
      ],
    ]);

    foreach ($register_styles as $name => $props) {
      self::registerStyle($name, $props['src'], $props['deps'], $props['version'], 'all', $props['has_rtl']);
    }
  }
  /**
   * load_styles.
   */
  public function cartsy_lite_load_styles() {
    self::cartsy_lite_registerStyles();
    self::enqueueStyle('cartsy-lite-normalize-style');
    self::enqueueStyle('jquery.overlayScrollbars.min');
    wp_enqueue_style('dashicons');
    self::enqueueStyle('cartsy-lite-fonts');
    self::enqueueStyle('cartsy-lite-woo-style');
    self::enqueueStyle('cartsy-lite-block-style');
    self::enqueueStyle('cartsy-lite-main-style');
    if (is_page_template(['template-homepage.php'])) {
      self::enqueueStyle('cartsy-lite-home-style');
    }
    if ( (class_exists( 'WooCommerce' )) && (class_exists( 'RedQ_Rental_And_Bookings' )) ) {
      self::enqueueStyle('cartsy-lite-rnb-style');
    }
  }
}
