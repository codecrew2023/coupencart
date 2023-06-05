<?php

namespace Cartsy_Lite\Framework\Traits;

defined('ABSPATH') || exit;

trait Cartsy_Lite_StyleScriptLoader
{
    private static $scripts = [];

    private static $styles = [];

    /**
     * registerScript.
     *
     * @param string $handle
     * @param string $path
     * @param array  $deps
     * @param string $version
     * @param bool   $in_footer
     */
    public static function registerScript($handle, $path, $deps = ['jquery'], $version = CARTSY_LITE_VERSION, $in_footer = true)
    {
        self::$scripts[] = $handle;
        wp_register_script($handle, $path, $deps, $version, $in_footer);
    }

    /**
     * enqueueScript.
     *
     * @param string $handle
     * @param string $path
     * @param array  $deps
     * @param string $version
     * @param bool   $in_footer
     */
    public static function enqueueScript($handle, $path = '', $deps = ['jquery'], $version = CARTSY_LITE_VERSION, $in_footer = true)
    {
        if (!in_array($handle, self::$scripts, true) && $path) {
            self::registerScript($handle, $path, $deps, $version, $in_footer);
        }
        wp_enqueue_script($handle);
    }

    /**
     * registerStyle.
     *
     * @param string $handle
     * @param string $path
     * @param array  $deps
     * @param string $version
     * @param string $media
     * @param bool   $has_rtl
     */
    public static function registerStyle($handle, $path, $deps = [], $version = CARTSY_LITE_VERSION, $media = 'all', $has_rtl = false)
    {
        self::$styles[] = $handle;
        wp_register_style($handle, $path, $deps, $version, $media);

        if ($has_rtl) {
            wp_style_add_data($handle, '-rtl', 'replace');
        }
    }

    /**
     * enqueueStyle.
     *
     * @param string $handle
     * @param string $path
     * @param array  $deps
     * @param string $version
     * @param string $media
     * @param bool   $has_rtl
     */
    public static function enqueueStyle($handle, $path = '', $deps = [], $version = CARTSY_LITE_VERSION, $media = 'all', $has_rtl = false)
    {
        if (!in_array($handle, self::$styles, true) && $path) {
            self::registerStyle($handle, $path, $deps, $version, $media, $has_rtl);
        }
        wp_enqueue_style($handle);
    }

    /**
     * localizeScripts.
     *
     * @param string $handle
     * @param string $localize_variable_name
     * @param array  $data
     */
    public static function localizeScripts($handle, $localize_variable_name = '', $data = [])
    {
        wp_localize_script($handle, $localize_variable_name, $data);
    }

    /**
     * Register Google fonts.
     *
     * @since 2.4.0
     * @return string Google fonts URL for the theme.
     */
    public static function cartsy_lite_google_fonts() 
    {
        $google_fonts = apply_filters (
            'cartsy_lite_google_font_families',
            array(
                'open-sans' => 'Open+Sans:300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic',
            )
        );

        $query_args = array(
            'family' => implode( '|', $google_fonts ),
            'subset' => rawurlencode( 'latin,latin-ext' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

        return $fonts_url;
    }
}
