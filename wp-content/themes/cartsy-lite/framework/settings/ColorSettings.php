<?php

namespace Cartsy_Lite\Framework\Settings;

use Kirki;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Cartsy_Lite_ColorSettings
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->cartsy_lite_init_colorSettings();
        $this->cartsy_lite_colorSettings();
    }

    /**
     * cartsy_lite_init_colorSettings
     *
     * @return void
     */
    public function cartsy_lite_init_colorSettings()
    {
        Kirki::add_section('cartsy_lite_color_section', [
            'title'          => esc_html__('Colors', 'cartsy-lite'),
            'description'    => esc_html__('Global settings for theme colors located here', 'cartsy-lite'),
            'panel'          => 'cartsy_lite_config_panel',
            'priority'       => 160,
        ]);
    }

    /**
     * cartsy_lite_colorSettings
     *
     * @return void
     */
    public function cartsy_lite_colorSettings()
    {
        // section choosing key : cartsy_lite_color_section
        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'color',
            'settings'    => 'cartsy_lite_primary_color',
            'label'       => esc_html__('Primary Color', 'cartsy-lite'),
            'section'     => 'cartsy_lite_color_section',
            'default'     => '#212121',
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'color',
            'settings'    => 'cartsy_lite_primary_hover_color',
            'label'       => esc_html__('Primary Color [Hover]', 'cartsy-lite'),
            'section'     => 'cartsy_lite_color_section',
            'default'     => '#3a3a3a',
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'color',
            'settings'    => 'cartsy_lite_secondary_color',
            'label'       => esc_html__('Secondary Color', 'cartsy-lite'),
            'section'     => 'cartsy_lite_color_section',
            'default'     => '#212121',
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'color',
            'settings'    => 'cartsy_lite_dark_text_color',
            'label'       => esc_html__('Dark Text Color', 'cartsy-lite'),
            'section'     => 'cartsy_lite_color_section',
            'default'     => '#212121',
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'color',
            'settings'    => 'cartsy_lite_main_text_color',
            'label'       => esc_html__('Main Text Color', 'cartsy-lite'),
            'section'     => 'cartsy_lite_color_section',
            'default'     => '#212121',
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'color',
            'settings'    => 'cartsy_lite_light_text_color',
            'label'       => esc_html__('Light Text Color', 'cartsy-lite'),
            'section'     => 'cartsy_lite_color_section',
            'default'     => '#5A5A5A',
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'color',
            'settings'    => 'cartsy_lite_lighter_text_color',
            'label'       => esc_html__('Lighter Text Color', 'cartsy-lite'),
            'section'     => 'cartsy_lite_color_section',
            'default'     => '#999999',
        ]);
    }
}
