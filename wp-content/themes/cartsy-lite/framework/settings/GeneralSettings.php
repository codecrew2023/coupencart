<?php

namespace Cartsy_Lite\Framework\Settings;

use Kirki;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Cartsy_Lite_GeneralSettings
{
    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cartsy_lite_init_generalSettings();
        $this->cartsy_lite_generalSettings();
    }

    /**
     * cartsy_lite_init_generalSettings.
     *
     * @return void
     */
    public function cartsy_lite_init_generalSettings()
    {
        Kirki::add_section('cartsy_lite_general_section', [
            'title'       => esc_html__('General', 'cartsy-lite'),
            'description' => esc_html__('General theme settings', 'cartsy-lite'),
            'panel'       => 'cartsy_lite_config_panel',
            'priority'    => 160,
        ]);
    }

    /**
     * cartsy_lite_generalSettings.
     *
     * @return void
     */
    public function cartsy_lite_generalSettings()
    {
        // section choosing key : cartsy_lite_general_section
        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_site_loader',
            'label'       => esc_html__('Site loader', 'cartsy-lite'),
            'description' => esc_html__('Choose either site loader is On/Off through out the site', 'cartsy-lite'),
            'section'     => 'cartsy_lite_general_section',
            'default'     => 'on',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'on'      => esc_html__('On', 'cartsy-lite'),
                'off'     => esc_html__('Off', 'cartsy-lite'),
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_enable_global_search',
            'label'       => esc_html__('Enable Global Search', 'cartsy-lite'),
            'description' => esc_html__('Use Global search for products.', 'cartsy-lite'),
            'section'     => 'cartsy_lite_general_section',
            'default'     => 'on',
            'priority'    => 10,
            'choices'     => [
                'on'      => esc_html__('Enable', 'cartsy-lite'),
                'off'     => esc_html__('Disable', 'cartsy-lite'),
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_enable_header_mini_cart',
            'label'       => esc_html__('Enable Header Mini Cart', 'cartsy-lite'),
            'section'     => 'cartsy_lite_general_section',
            'default'     => 'on',
            'priority'    => 10,
            'choices'     => [
                'on'      => esc_html__('Enable', 'cartsy-lite'),
                'off'     => esc_html__('Disable', 'cartsy-lite'),
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_page_sidebar',
            'label'       => esc_html__('Page Sidebar', 'cartsy-lite'),
            'description' => esc_html__('Choose either page sidebar is On/Off', 'cartsy-lite'),
            'section'     => 'cartsy_lite_general_section',
            'default'     => 'on',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'on'      => esc_html__('On', 'cartsy-lite'),
                'off'     => esc_html__('Off', 'cartsy-lite'),
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_page_sidebar_position',
            'label'       => esc_html__('Page layout', 'cartsy-lite'),
            'description' => esc_html__('Choose layout for display on page', 'cartsy-lite'),
            'section'     => 'cartsy_lite_general_section',
            'default'     => 'right',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'right' => esc_html__('Right Sidebar', 'cartsy-lite'),
                'left'  => esc_html__('Left Sidebar', 'cartsy-lite'),
            ],
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_page_sidebar',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_page_banner_switch',
            'label'       => esc_html__('Page Banner', 'cartsy-lite'),
            'description' => esc_html__('Choose either page banner section is On/Off', 'cartsy-lite'),
            'section'     => 'cartsy_lite_general_section',
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
            'settings'    => 'cartsy_lite_page_banner_type',
            'label'       => esc_html__('Banner Type', 'cartsy-lite'),
            'description' => esc_html__('Choose page banner type', 'cartsy-lite'),
            'section'     => 'cartsy_lite_general_section',
            'default'     => 'color',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'image' => esc_html__('Image', 'cartsy-lite'),
                'color' => esc_html__('Color', 'cartsy-lite'),
            ],
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_page_banner_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'background',
            'settings'         => 'cartsy_lite_page_banner_image',
            'label'            => esc_html__('Banner Background', 'cartsy-lite'),
            'description'      => esc_html__('Upload post single banner image or set a background color', 'cartsy-lite'),
            'section'          => 'cartsy_lite_general_section',
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
                    'element' => '.cartsylite-main-banner-area .cartsylite-page-thumb-area',
                ],
            ],
            'active_callback' => [
                [
                    'setting'  => 'cartsy_lite_page_banner_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
                [
                    'setting'  => 'cartsy_lite_page_banner_type',
                    'operator' => '===',
                    'value'    => 'image',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'color',
            'settings'    => 'cartsy_lite_page_banner_color',
            'label'       => esc_html__('Page banner color', 'cartsy-lite'),
            'description' => esc_html__('Select page banner color', 'cartsy-lite'),
            'section'     => 'cartsy_lite_general_section',
            'default'     => '#323232',
            'priority'    => 10,
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_page_banner_type',
                    'operator' => '!==',
                    'value'    => 'image',
                ],
                [
                    'setting'  => 'cartsy_lite_page_banner_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'color',
            'settings'         => 'cartsy_lite_page_banner_text_color',
            'label'            => esc_html__('Page banner text color', 'cartsy-lite'),
            'description'      => esc_html__('Select page banner text color', 'cartsy-lite'),
            'section'          => 'cartsy_lite_general_section',
            'default'          => '#FFF',
            'priority'         => 10,
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_page_banner_switch',
                    'operator' => ' === ',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'select',
            'settings'         => 'cartsy_lite_page_breadcrumb_switch',
            'label'            => esc_html__('Page breadcrumb switch', 'cartsy-lite'),
            'description'      => esc_html__('Choose either page breadcrumb section is On/Off', 'cartsy-lite'),
            'section'          => 'cartsy_lite_general_section',
            'default'          => 'on',
            'priority'         => 10,
            'multiple'         => 1,
            'choices'          => [
                'on'           => esc_html__('On', 'cartsy-lite'),
                'off'          => esc_html__('Off', 'cartsy-lite'),
            ],
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_page_banner_switch',
                    'operator' => ' === ',
                    'value'    => 'on',
                ],
            ],
        ]);
    }
}
