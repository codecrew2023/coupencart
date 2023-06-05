<?php

namespace Cartsy_Lite\Framework\Settings;

use Kirki;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Cartsy_Lite_HeaderSettings
{
    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cartsy_lite_init_headerSettings();
        $this->cartsy_lite_headerSettings();
    }

    /**
     * cartsy_lite_init_headerSettings.
     *
     * @return void
     */
    public function cartsy_lite_init_headerSettings()
    {
        Kirki::add_section('cartsy_lite_header_section', [
            'title'       => esc_html__('Header', 'cartsy-lite'),
            'description' => esc_html__('Global settings for header located here', 'cartsy-lite'),
            'panel'       => 'cartsy_lite_config_panel',
            'priority'    => 160,
        ]);
    }

    /**
     * cartsy_lite_headerSettings.
     *
     * @return void
     */
    public function cartsy_lite_headerSettings()
    {
        // section choosing key : cartsy_lite_header_section
        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'color',
            'settings'    => 'cartsy_lite_header_initial_color',
            'label'       => esc_html__('Background Color [initial]', 'cartsy-lite'),
            'description' => esc_html__('Choose initial background color', 'cartsy-lite'),
            'section'     => 'cartsy_lite_header_section',
            'default'     => '#ffffff',
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'color',
            'settings'    => 'cartsy_lite_header_menu_color',
            'label'       => esc_html__('Header Text Color', 'cartsy-lite'),
            'description' => esc_html__('Change header menu, site title and site description color.', 'cartsy-lite'),
            'section'     => 'cartsy_lite_header_section',
            'default'     => '#212121',
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'color',
            'settings'    => 'cartsy_lite_header_menu_hover_color',
            'label'       => esc_html__('Header Text Color [Hover]', 'cartsy-lite'),
            'description' => esc_html__('Change header menu and site title hover color.', 'cartsy-lite'),
            'section'     => 'cartsy_lite_header_section',
            'default'     => '#3a3a3a',
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'color',
            'settings'    => 'cartsy_lite_header_menu_hover_bg_color',
            'label'       => esc_html__('Background Color [Hover]', 'cartsy-lite'),
            'description' => esc_html__('Choose initial background color', 'cartsy-lite'),
            'section'     => 'cartsy_lite_header_section',
            'default'     => '#f3f3f3',
        ]);
    }
}
