<?php

namespace Cartsy_Lite\Framework\Client;

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

use Cartsy_Lite\Framework\Traits\Cartsy_Lite_StyleScriptLoader;

class Cartsy_Lite_Client_Script
{
    use Cartsy_Lite_StyleScriptLoader;

    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'cartsy_lite_client_scripts']);
    }

    /**
     * cartsy_lite_registerScripts.
     *
     * @return void
     */
    private static function cartsy_lite_registerScripts()
    {
        $register_scripts = apply_filters('cartsy_lite_frontend_scripts_array', [
            'fitvids' => [
                'src'     => CARTSY_LITE_ASSETS . 'global/js/jquery.fitvids.js',
                'deps'    => ['jquery'],
                'version' => '5.2.2',
            ],
            'jquery.overlayScrollbars.min' => [
                'src'     => CARTSY_LITE_ASSETS . 'global/js/jquery.overlayScrollbars.min.js',
                'deps'    => ['jquery'],
                'version' => CARTSY_LITE_VERSION,
            ],
            'skip-link-focus-fix' => [
                'src'     => CARTSY_LITE_ASSETS . 'client/js/skip-link-focus-fix.js',
                'deps'    => ['jquery'],
                'version' => CARTSY_LITE_VERSION,
            ],
            'cartsy-lite-main' => [
                'src'     => CARTSY_LITE_ASSETS . 'client/js/cartsy-lite-main.js',
                'deps'    => ['jquery'],
                'version' => CARTSY_LITE_VERSION,
            ],
            'cartsy-lite-homepage' => [
                'src'     => CARTSY_LITE_ASSETS . 'client/js/homepage.js',
                'deps'    => ['jquery', 'jquery.overlayScrollbars.min'],
                'version' => CARTSY_LITE_VERSION,
            ],
        ]);

        foreach ($register_scripts as $name => $key) {
            self::registerScript($name, $key['src'], $key['deps'], $key['version']);
        }
    }

    public function cartsy_lite_client_scripts()
    {
        $cartsy_lite_site_loader = "on";
        if (function_exists('cartsy_lite_global_option_data')) {
            $cartsy_lite_site_loader = cartsy_lite_global_option_data('cartsy_lite_site_loader', 'on');
        }

        self::cartsy_lite_registerScripts();
        self::enqueueScript('fitvids');
        self::enqueueScript('jquery.overlayScrollbars.min');
        self::enqueueScript('skip-link-focus-fix');
        if (class_exists('WooCommerce')) {
            wp_enqueue_script('flexslider');
        }
        self::enqueueScript('cartsy-lite-main');
        if (is_page_template(['template-homepage.php'])) {
            self::enqueueScript('cartsy-lite-homepage');
        }
    }
}
