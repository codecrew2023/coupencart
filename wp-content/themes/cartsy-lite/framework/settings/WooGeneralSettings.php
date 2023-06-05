<?php

namespace Cartsy_Lite\Framework\Settings;

use Kirki;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Cartsy_Lite_WooGeneralSettings
{
    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cartsy_lite_init_wooGeneralSettings();
        $this->cartsy_lite_wooGeneralSettings();
    }

    /**
     * cartsy_lite_init_wooGeneralSettings.
     *
     * @return void
     */
    public function cartsy_lite_init_wooGeneralSettings()
    {
        Kirki::add_section('cartsy_lite_woo_section', [
            'title'       => esc_html__('WooCommerce General', 'cartsy-lite'),
            'description' => esc_html__('Global settings for WooCommerce located here', 'cartsy-lite'),
            'panel'       => 'cartsy_lite_config_panel',
            'priority'    => 160,
        ]);
    }

    /**
     * cartsy_lite_wooGeneralSettings.
     *
     * @return void
     */
    public function cartsy_lite_wooGeneralSettings()
    {
        // section choosing key : cartsy_lite_woo_section


        Kirki::add_field('cartsy_lite_config', [
            'type' => 'select',
            'settings' => 'cartsy_lite_woo_sidebar_switch',
            'label' => esc_html__('WooCommerce Page Sidebar', 'cartsy-lite'),
            'description' => esc_html__('Choose either page sidebar is On/Off', 'cartsy-lite'),
            'section' => 'cartsy_lite_woo_section',
            'default' => 'on',
            'priority' => 10,
            'multiple' => 1,
            'choices' => [
                'on' => esc_html__('On', 'cartsy-lite'),
                'off' => esc_html__('Off', 'cartsy-lite'),
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_woo_sidebar_position',
            'label'       => esc_html__('Woo layout', 'cartsy-lite'),
            'description' => esc_html__('Choose layout for display on woo pages', 'cartsy-lite'),
            'section'     => 'cartsy_lite_woo_section',
            'default'     => 'right',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'right' => esc_html__('Right Sidebar', 'cartsy-lite'),
                'left'  => esc_html__('Left Sidebar', 'cartsy-lite'),
            ],
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_woo_sidebar_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);


        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_woo_single_sidebar_switch',
            'label'       => esc_html__('Product Single Sidebar', 'cartsy-lite'),
            'description' => esc_html__('Choose either sidebar is On/Off (Not recommended)', 'cartsy-lite'),
            'section'     => 'cartsy_lite_woo_section',
            'default'     => 'off',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'on'      => esc_html__('On', 'cartsy-lite'),
                'off'     => esc_html__('Off', 'cartsy-lite'),
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_woo_single_sidebar_position',
            'label'       => esc_html__('Woo single layout', 'cartsy-lite'),
            'description' => esc_html__('Choose layout for display on woo single', 'cartsy-lite'),
            'section'     => 'cartsy_lite_woo_section',
            'default'     => 'right',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'right' => esc_html__('Right Sidebar', 'cartsy-lite'),
                'left'  => esc_html__('Left Sidebar', 'cartsy-lite'),
            ],
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_woo_single_sidebar_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_woo_banner_switch',
            'label'       => esc_html__('WooCommerce Page Banner', 'cartsy-lite'),
            'description' => esc_html__('Choose either page banner section is On/Off', 'cartsy-lite'),
            'section'     => 'cartsy_lite_woo_section',
            'default'     => 'on',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'on'      => esc_html__('On', 'cartsy-lite'),
                'off'     => esc_html__('Off', 'cartsy-lite'),
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'radio',
            'settings'    => 'cartsy_lite_woo_banner_type',
            'label'       => esc_html__('Banner Type', 'cartsy-lite'),
            'description' => esc_html__('Choose page banner type', 'cartsy-lite'),
            'section'     => 'cartsy_lite_woo_section',
            'default'     => 'color',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'image' => esc_html__('Image', 'cartsy-lite'),
                'color' => esc_html__('Color', 'cartsy-lite'),
            ],
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_woo_banner_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'background',
            'settings'         => 'cartsy_lite_woo_banner_image',
            'label'            => esc_html__('Banner Background', 'cartsy-lite'),
            'description'      => esc_html__('Upload page banner image or set a background color', 'cartsy-lite'),
            'section'          => 'cartsy_lite_woo_section',
            'priority'         => 10,
            'default'          => [
                'background-color'      => 'rgba(231, 242, 240, 1)',
                'background-image'      => '',
                'background-repeat'     => 'repeat',
                'background-position'   => 'center center',
                'background-size'       => 'cover',
                'background-attachment' => 'scroll',
            ],
            'transport'        => 'auto',
            'output'           => [
                [
                    'element' => '.cartsylite-banner-type-woo .cartsylite-page-thumb-area',
                ],
            ],
            'active_callback' => [
                [
                    'setting'  => 'cartsy_lite_woo_banner_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
                [
                    'setting'  => 'cartsy_lite_woo_banner_type',
                    'operator' => '===',
                    'value'    => 'image',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'color',
            'settings'    => 'cartsy_lite_woo_banner_bg_color',
            'label'       => esc_html__('Page banner color', 'cartsy-lite'),
            'description' => esc_html__('Select page banner color', 'cartsy-lite'),
            'section'     => 'cartsy_lite_woo_section',
            'default'     => '#323232',
            'priority'    => 10,
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_woo_banner_type',
                    'operator' => '!==',
                    'value'    => 'image',
                ],
                [
                    'setting'  => 'cartsy_lite_woo_banner_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type' => 'color',
            'settings' => 'cartsy_lite_woo_banner_text_color',
            'label' => esc_html__('WooCommerce Page banner text color', 'cartsy-lite'),
            'description' => esc_html__('Select page banner text color', 'cartsy-lite'),
            'section' => 'cartsy_lite_woo_section',
            'default' => '#FFFFFF',
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'cartsy_lite_woo_banner_switch',
                    'operator' => '===',
                    'value' => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type' => 'select',
            'settings' => 'cartsy_lite_woo_page_breadcrumb_switch',
            'label' => esc_html__('WooCommerce page breadcrumb switch', 'cartsy-lite'),
            'description' => esc_html__('Choose either page breadcrumb section is On/Off', 'cartsy-lite'),
            'section' => 'cartsy_lite_woo_section',
            'default' => 'on',
            'priority' => 10,
            'multiple' => 1,
            'choices' => [
                'on' => esc_html__('On', 'cartsy-lite'),
                'off' => esc_html__('Off', 'cartsy-lite'),
            ],
            'active_callback' => [
                [
                    'setting' => 'cartsy_lite_woo_banner_switch',
                    'operator' => '===',
                    'value' => 'on',
                ],
            ],
        ]);
    }
}
