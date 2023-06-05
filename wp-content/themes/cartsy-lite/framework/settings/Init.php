<?php

namespace Cartsy_Lite\Framework\Settings;

use Kirki;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Cartsy_Lite_CustomizeSettings
{
    public function __construct()
    {
        $this->cartsy_lite_settingsPanelInit();
        new Cartsy_Lite_GeneralSettings();
        new Cartsy_Lite_HeaderSettings();
        new Cartsy_Lite_HomeSettings();
        new Cartsy_Lite_BlogSettings();
        if (class_exists('WooCommerce')) {
            new Cartsy_Lite_WooGeneralSettings();
        }
        new Cartsy_Lite_ColorSettings();
        new Cartsy_Lite_TypographySettings();
        new Cartsy_Lite_SocialProfileSettings();
        new Cartsy_Lite_FooterSettings();
    }

    public function cartsy_lite_settingsPanelInit()
    {
        Kirki::add_config('cartsy_lite_config', [
            'capability'  => 'edit_theme_options',
            'option_type' => 'theme_mod',
        ]);

        Kirki::add_panel('cartsy_lite_config_panel', [
            'priority'    => 10,
            'title'       => esc_html__('Cartsy Lite theme panel', 'cartsy-lite'),
            'description' => esc_html__('Cartsy Lite theme panel description', 'cartsy-lite'),
        ]);
    }
}
