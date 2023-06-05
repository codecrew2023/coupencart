<?php

namespace Cartsy_Lite\Framework\Settings;

use Kirki;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Cartsy_Lite_BlogSettings
{
    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cartsy_lite_init_blogSettings();
        $this->cartsy_lite_blogSettings();
    }

    /**
     * cartsy_lite_init_blogSettings.
     *
     * @return void
     */
    public function cartsy_lite_init_blogSettings()
    {
        Kirki::add_section('cartsy_lite_blog_section', [
            'title' => esc_html__('Blog', 'cartsy-lite'),
            'description' => esc_html__('Global settings for blog located here', 'cartsy-lite'),
            'panel' => 'cartsy_lite_config_panel',
            'priority' => 160,
        ]);
    }

    /**
     * cartsy_lite_blogSettings.
     *
     * @return void
     */
    public function cartsy_lite_blogSettings()
    {
        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_blog_sidebar_switch',
            'label'       => esc_html__('Sidebar Switch', 'cartsy-lite'),
            'description' => esc_html__('Choose either blog sidebar is On/Off', 'cartsy-lite'),
            'section'     => 'cartsy_lite_blog_section',
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
            'settings'    => 'cartsy_lite_blog_sidebar_position',
            'label'       => esc_html__('Blog layout', 'cartsy-lite'),
            'description' => esc_html__('Choose layout for display on blog', 'cartsy-lite'),
            'section'     => 'cartsy_lite_blog_section',
            'default'     => 'right',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'right' => esc_html__('Right Sidebar', 'cartsy-lite'),
                'left'  => esc_html__('Left Sidebar', 'cartsy-lite'),
            ],
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_blog_sidebar_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_blog_banner_switch',
            'label'       => esc_html__('Banner Switch', 'cartsy-lite'),
            'description' => esc_html__('Choose either blog page banner is On/Off', 'cartsy-lite'),
            'section'     => 'cartsy_lite_blog_section',
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
            'settings'    => 'cartsy_lite_blog_banner_type',
            'label'       => esc_html__('Banner Type', 'cartsy-lite'),
            'description' => esc_html__('Choose page banner type', 'cartsy-lite'),
            'section'     => 'cartsy_lite_blog_section',
            'default'     => 'color',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'image' => esc_html__('Image', 'cartsy-lite'),
                'color' => esc_html__('Color', 'cartsy-lite'),
            ],
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_blog_banner_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'background',
            'settings'         => 'cartsy_lite_blog_banner_image',
            'label'            => esc_html__('Banner Background', 'cartsy-lite'),
            'description'      => esc_html__('Upload blog banner image or set a background color', 'cartsy-lite'),
            'section'          => 'cartsy_lite_blog_section',
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
                    'element' => '.cartsylite-banner-type-blog .cartsylite-page-thumb-area',
                ],
            ],
            'active_callback' => [
                [
                    'setting'  => 'cartsy_lite_blog_banner_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
                [
                    'setting'  => 'cartsy_lite_blog_banner_type',
                    'operator' => '===',
                    'value'    => 'image',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'color',
            'settings'    => 'cartsy_lite_blog_banner_color',
            'label'       => esc_html__('Page banner color', 'cartsy-lite'),
            'description' => esc_html__('Select page banner color', 'cartsy-lite'),
            'section'     => 'cartsy_lite_blog_section',
            'default'     => '#323232',
            'priority'    => 10,
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_blog_banner_type',
                    'operator' => '===',
                    'value'    => 'color',
                ],
                [
                    'setting'  => 'cartsy_lite_blog_banner_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type' => 'color',
            'settings' => 'cartsy_lite_blog_banner_text_color',
            'label' => esc_html__('Banner Text Color', 'cartsy-lite'),
            'description' => esc_html__('Select blog banner text color', 'cartsy-lite'),
            'section' => 'cartsy_lite_blog_section',
            'default' => '#FFFFFF',
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'cartsy_lite_blog_banner_switch',
                    'operator' => '!==',
                    'value' => 'off',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type' => 'select',
            'settings' => 'cartsy_lite_blog_breadcrumb_switch',
            'label' => esc_html__('Breadcrumb Switch', 'cartsy-lite'),
            'description' => esc_html__('Choose either blog breadcrumb section is On/Off', 'cartsy-lite'),
            'section' => 'cartsy_lite_blog_section',
            'default' => 'on',
            'priority' => 10,
            'multiple' => 1,
            'choices' => [
                'on' => esc_html__('On', 'cartsy-lite'),
                'off' => esc_html__('Off', 'cartsy-lite'),
            ],
            'active_callback' => [
                [
                    'setting' => 'cartsy_lite_blog_banner_switch',
                    'operator' => '===',
                    'value' => 'on',
                ],
            ],
        ]);
    }
}
