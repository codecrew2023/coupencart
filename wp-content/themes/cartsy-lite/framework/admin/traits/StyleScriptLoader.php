<?php

namespace Cartsy_Lite\Framework\Admin\Traits;

use Cartsy_Lite\Framework\Traits\Cartsy_Lite_StyleScriptLoader;

defined('ABSPATH') || exit;

trait Cartsy_Lite_Admin_Script_Trait {

    use Cartsy_Lite_StyleScriptLoader;

    /**
     * Dashboard_Enqueue_Style
     *
     * @return void
     */
    public static function Dashboard_Enqueue_Style ()
    {
        $register_styles = apply_filters('cartsy_lite_dashboard_scripts_array', [
            'cartsy-lite-dashboard-style' => [
                'src'     => CARTSY_LITE_DIST . 'cartsy-lite-dashboard.css',
                'deps'    => [],
                'version' => CARTSY_LITE_VERSION,
                'has_rtl' => true,
            ],
            'cartsy-lite-dashboard-fonts' => [
                'src'     => self::cartsy_lite_google_fonts(),
                'deps'    => [],
                'version' => CARTSY_LITE_VERSION,
                'has_rtl' => false,
            ],
        ]);
        
        foreach ($register_styles as $name => $props) {
            self::registerStyle($name, $props['src'], $props['deps'], $props['version'], 'all', $props['has_rtl']);
        }

        self::enqueueStyle('cartsy-lite-dashboard-style');
        self::enqueueStyle('cartsy-lite-dashboard-fonts');
    }

    /**
     * Dashboard_Enqueue_Script
     *
     * @return void
     */
    public static function Dashboard_Enqueue_Script ()
    {
        $register_scripts = apply_filters('cartsy_lite_dashboard_scripts_array', [
            'cartsy-lite-dashboard' => [
                'src'     => CARTSY_LITE_ASSETS . 'admin/js/dashboard.js',
                'deps'    => ['jquery'],
                'version' => CARTSY_LITE_VERSION,
            ],
        ]);

        foreach ($register_scripts as $name => $key) {
            self::registerScript($name, $key['src'], $key['deps'], $key['version']);
        }

        self::enqueueScript('cartsy-lite-dashboard');
    }
}
