<?php

namespace Cartsy_Lite\Framework\Settings;

use Kirki;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Cartsy_Lite_HomeSettings
{
    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cartsy_lite_init_homeSettings();
        if (class_exists('WooCommerce')) {
            $this->cartsy_lite_home_woo_control();
        }
        $this->cartsy_lite_homeSettings();
    }

    /**
     * cartsy_lite_init_homeSettings.
     *
     * @return void
     */
    public function cartsy_lite_init_homeSettings()
    {
        Kirki::add_panel('cartsy_lite_home_section', [
            'title'       => esc_html__('Home', 'cartsy-lite'),
            'description' => esc_html__('Home settings', 'cartsy-lite'),
            'panel'       => 'cartsy_lite_config_panel',
            'priority'    => 140,
        ]);

        Kirki::add_section('cartsy_lite_home_banner_section', [
            'title'       => esc_html__('Banner', 'cartsy-lite'),
            'description' => esc_html__('Banner settings for home located here', 'cartsy-lite'),
            'panel'       => 'cartsy_lite_home_section',
            'priority'    => 150,
        ]);
    }

    /**
     * cartsy_lite_init_homeSettings.
     *
     * @return void
     */
    public function cartsy_lite_home_woo_control()
    {
        Kirki::add_section('cartsy_lite_home_products_section', [
            'title'       => esc_html__('Products', 'cartsy-lite'),
            'description' => esc_html__('Products settings for home located here', 'cartsy-lite'),
            'panel'       => 'cartsy_lite_home_section',
            'priority'    => 160,
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_home_featured_product_switch',
            'label'       => esc_html__('Show featured product', 'cartsy-lite'),
            'description' => esc_html__('Choose featured product only', 'cartsy-lite'),
            'section'     => 'cartsy_lite_home_products_section',
            'default'     => 'off',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'on'      => esc_html__('Enable', 'cartsy-lite'),
                'off'     => esc_html__('Disable', 'cartsy-lite'),
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_home_on_sale_product_switch',
            'label'       => esc_html__('Show on sale product', 'cartsy-lite'),
            'description' => esc_html__('Choose on sale product only', 'cartsy-lite'),
            'section'     => 'cartsy_lite_home_products_section',
            'default'     => 'off',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'on'      => esc_html__('Enable', 'cartsy-lite'),
                'off'     => esc_html__('Disable', 'cartsy-lite'),
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_home_out_of_stock_product_switch',
            'label'       => esc_html__('Show/Hide out of stock product', 'cartsy-lite'),
            'description' => esc_html__('Choose either out of stock product Yes/No', 'cartsy-lite'),
            'section'     => 'cartsy_lite_home_products_section',
            'default'     => 'on',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'on'      => esc_html__('Hide', 'cartsy-lite'),
                'off'     => esc_html__('Show', 'cartsy-lite'),
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'custom',
            'settings'    => 'custom_setting',
            'section'     => 'cartsy_lite_home_products_section',
            'default'     => '<h3 style="padding:15px 10px; background:#fff; margin:0;">' . esc_html__('Home page other\'s product control inherit by Customizing ▸ WooCommerce ▸ Product Catalog', 'cartsy-lite') . '</h3>',
            'priority'    => 10,
        ]);

        Kirki::add_section('cartsy_lite_home_category_section', [
            'title'       => esc_html__('Category', 'cartsy-lite'),
            'description' => esc_html__('Category settings for home located here', 'cartsy-lite'),
            'panel'       => 'cartsy_lite_home_section',
            'priority'    => 160,
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_home_sidebar_position',
            'label'       => esc_html__('Sidebar position', 'cartsy-lite'),
            'description' => esc_html__('Choose sidebar position only', 'cartsy-lite'),
            'section'     => 'cartsy_lite_home_category_section',
            'default'     => 'left_side',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'left_side'  => esc_html__('Left Side', 'cartsy-lite'),
                'right_side' => esc_html__('Right Side', 'cartsy-lite'),
                'full_width' => esc_html__('Full Width', 'cartsy-lite'),
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_home_empty_category_orderby',
            'label'       => esc_html__('Orderby', 'cartsy-lite'),
            'section'     => 'cartsy_lite_home_category_section',
            'default'     => 'menu_order',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'menu_order' => esc_html__('Menu Order', 'cartsy-lite'),
                'name'       => esc_html__('Name', 'cartsy-lite'),
                'term_id'    => esc_html__('Term ID', 'cartsy-lite'),
                'count'      => esc_html__('Count', 'cartsy-lite'),
            ],
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_home_sidebar_position',
                    'operator' => '!==',
                    'value'    => 'full_width',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_home_empty_category_order',
            'label'       => esc_html__('Order', 'cartsy-lite'),
            'section'     => 'cartsy_lite_home_category_section',
            'default'     => 'ASC',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'ASC'  => esc_html__('ASC', 'cartsy-lite'),
                'DESC' => esc_html__('DESC', 'cartsy-lite'),
            ],
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_home_empty_category_orderby',
                    'operator' => '!==',
                    'value'    => 'menu_order',
                ],
            ],
        ]);
    }

    /**
     * cartsy_lite_homeSettings.
     *
     * @return void
     */
    public function cartsy_lite_homeSettings()
    {
        // section choosing key : cartsy_lite_home_section
        // Banner controls
        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_home_banner_switch',
            'label'       => esc_html__('Banner Switch', 'cartsy-lite'),
            'description' => esc_html__('Choose either blog page banner is On/Off', 'cartsy-lite'),
            'section'     => 'cartsy_lite_home_banner_section',
            'default'     => 'on',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'on'      => esc_html__('On', 'cartsy-lite'),
                'off'     => esc_html__('Off', 'cartsy-lite'),
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'textarea',
            'settings'         => 'cartsy_lite_home_banner_title',
            'label'            => esc_html__('Banner title', 'cartsy-lite'),
            'description'      => esc_html__('Set home page banner title', 'cartsy-lite'),
            'section'          => 'cartsy_lite_home_banner_section',
            'default'          => esc_html__("Products Delivered in 90 Minutes", 'cartsy-lite'),
            'priority'         => 10,
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_home_banner_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'textarea',
            'settings'         => 'cartsy_lite_home_banner_sub_title',
            'label'            => esc_html__('Banner subtitle', 'cartsy-lite'),
            'description'      => esc_html__('Set home page banner subtitle', 'cartsy-lite'),
            'section'          => 'cartsy_lite_home_banner_section',
            'default'          => esc_html__("Get your products delivered at your doorsteps all day everyday", 'cartsy-lite'),
            'priority'         => 10,
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_home_banner_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);

        // Kirki::add_field('cartsy_lite_config', [
        //     'type'        => 'radio',
        //     'settings'    => 'cartsy_lite_home_banner_type',
        //     'label'       => esc_html__('Banner Type', 'cartsy-lite'),
        //     'description' => esc_html__('Choose page banner type', 'cartsy-lite'),
        //     'section'     => 'cartsy_lite_home_banner_section',
        //     'default'     => 'color',
        //     'priority'    => 10,
        //     'multiple'    => 1,
        //     'choices'     => [
        //         'image' => esc_html__('Image', 'cartsy-lite'),
        //         'color' => esc_html__('Color', 'cartsy-lite'),
        //     ],
        //     'active_callback'  => [
        //         [
        //             'setting'  => 'cartsy_lite_home_banner_switch',
        //             'operator' => '===',
        //             'value'    => 'on',
        //         ],
        //     ],
        // ]);

        // Kirki::add_field('cartsy_lite_config', [
        //     'type'             => 'background',
        //     'settings'         => 'cartsy_lite_home_banner_image',
        //     'label'            => esc_html__('Banner Background', 'cartsy-lite'),
        //     'description'      => esc_html__('Upload blog banner image or set a background color', 'cartsy-lite'),
        //     'section'          => 'cartsy_lite_home_banner_section',
        //     'priority'         => 10,
        //     'default'          => [
        //         'background-color'      => 'rgba(231, 242, 240, 1)',
        //         'background-image'      => '',
        //         'background-repeat'     => 'repeat',
        //         'background-position'   => 'center center',
        //         'background-size'       => 'cover',
        //         'background-attachment' => 'scroll',
        //     ],
        //     'transport'        => 'auto',
        //     'output'           => [
        //         [
        //             'element' => '.cartsylite-home-page-thumb-area',
        //         ],
        //     ],
        //     'active_callback' => [
        //         [
        //             'setting'  => 'cartsy_lite_home_banner_switch',
        //             'operator' => '!==',
        //             'value'    => 'off',
        //         ],
        //         [
        //             'setting'  => 'cartsy_lite_home_banner_type',
        //             'operator' => '===',
        //             'value'    => 'image',
        //         ],
        //     ],
        // ]);

        // Kirki::add_field('cartsy_lite_config', [
        //     'type'        => 'color',
        //     'settings'    => 'cartsy_lite_home_banner_color',
        //     'label'       => esc_html__('Page banner color', 'cartsy-lite'),
        //     'description' => esc_html__('Select page banner color', 'cartsy-lite'),
        //     'section'     => 'cartsy_lite_home_banner_section',
        //     'default'     => '#323232',
        //     'priority'    => 10,
        //     'active_callback'  => [
        //         [
        //             'setting'  => 'cartsy_lite_home_banner_type',
        //             'operator' => '===',
        //             'value'    => 'color',
        //         ],
        //         [
        //             'setting'  => 'cartsy_lite_home_banner_switch',
        //             'operator' => '!==',
        //             'value'    => 'off',
        //         ],
        //     ],
        // ]);

        Kirki::add_field('cartsy_lite_config', [
            'type' => 'color',
            'settings' => 'cartsy_lite_blog_home_text_color',
            'label' => esc_html__('Banner Text Color', 'cartsy-lite'),
            'description' => esc_html__('Select blog banner text color', 'cartsy-lite'),
            'section' => 'cartsy_lite_home_banner_section',
            'default' => '#212121',
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'cartsy_lite_home_banner_switch',
                    'operator' => '!==',
                    'value' => 'off',
                ],
            ],
        ]);
    }
}
