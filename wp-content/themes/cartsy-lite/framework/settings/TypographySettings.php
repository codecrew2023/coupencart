<?php

namespace Cartsy_Lite\Framework\Settings;

use Kirki;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Cartsy_Lite_TypographySettings
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->initTypographySettings();
        $this->TypographySettings();
    }

    /**
     * initTypographySettings
     *
     * @return void
     */
    public function initTypographySettings()
    {
        Kirki::add_section('cartsy_lite_typography_section', [
            'title'          => esc_html__('Typography', 'cartsy-lite'),
            'description'    => esc_html__('Global settings for typography located here', 'cartsy-lite'),
            'panel'          => 'cartsy_lite_config_panel',
            'priority'       => 160,
        ]);
    }


    /**
     * TypographySettings
     *
     * @return void
     */
    public function TypographySettings()
    {

        // section choosing key : cartsy_lite_typography_section
        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_typography_switch',
            'label'       => esc_html__('Display Custom Typography', 'cartsy-lite'),
            'section'     => 'cartsy_lite_typography_section',
            'default'     => 'on',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'on'      => esc_html__('On', 'cartsy-lite'),
                'off'     => esc_html__('Off', 'cartsy-lite'),
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'typography',
            'settings'    => 'cartsy_lite_heading1_typography_setting',
            'label'       => esc_html__('Heading1', 'cartsy-lite'),
            'section'     => 'cartsy_lite_typography_section',
            'default'     => [
                'font-family'    => 'Open Sans',
                'variant'        => '700',
                'font-size'      => '36px',
                'line-height'    => '1.625',
                'letter-spacing' => '0',
                'color'          => '#212121',
                'text-transform' => 'none',
            ],
            'priority'    => 10,
            'transport'   => 'auto',
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_typography_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'typography',
            'settings'    => 'cartsy_lite_heading2_typography_setting',
            'label'       => esc_html__('Heading2', 'cartsy-lite'),
            'section'     => 'cartsy_lite_typography_section',
            'default'     => [
                'font-family'    => 'Open Sans',
                'variant'        => '700',
                'font-size'      => '24px',
                'line-height'    => '1.625',
                'letter-spacing' => '0',
                'color'          => '#212121',
                'text-transform' => 'none',
            ],
            'priority'    => 10,
            'transport'   => 'auto',
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_typography_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'typography',
            'settings'    => 'cartsy_lite_heading3_typography_setting',
            'label'       => esc_html__('Heading3', 'cartsy-lite'),
            'section'     => 'cartsy_lite_typography_section',
            'default'     => [
                'font-family'    => 'Open Sans',
                'variant'        => '700',
                'font-size'      => '18px',
                'line-height'    => '1.625',
                'letter-spacing' => '0',
                'color'          => '#212121',
                'text-transform' => 'none',
            ],
            'priority'    => 10,
            'transport'   => 'auto',
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_typography_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'typography',
            'settings'    => 'cartsy_lite_heading4_typography_setting',
            'label'       => esc_html__('Heading4', 'cartsy-lite'),
            'section'     => 'cartsy_lite_typography_section',
            'default'     => [
                'font-family'    => 'Open Sans',
                'variant'        => '700',
                'font-size'      => '16px',
                'line-height'    => '1.625',
                'letter-spacing' => '0',
                'color'          => '#212121',
                'text-transform' => 'none',
            ],
            'priority'    => 10,
            'transport'   => 'auto',
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_typography_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'typography',
            'settings'    => 'cartsy_lite_heading5_typography_setting',
            'label'       => esc_html__('Heading5', 'cartsy-lite'),
            'section'     => 'cartsy_lite_typography_section',
            'default'     => [
                'font-family'    => 'Open Sans',
                'variant'        => '700',
                'font-size'      => '14px',
                'line-height'    => '1.625',
                'letter-spacing' => '0',
                'color'          => '#212121',
                'text-transform' => 'none',
            ],
            'priority'    => 10,
            'transport'   => 'auto',
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_typography_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'typography',
            'settings'    => 'cartsy_lite_heading6_typography_setting',
            'label'       => esc_html__('Heading6', 'cartsy-lite'),
            'section'     => 'cartsy_lite_typography_section',
            'default'     => [
                'font-family'    => 'Open Sans',
                'variant'        => '700',
                'font-size'      => '13px',
                'line-height'    => '1.625',
                'letter-spacing' => '0',
                'color'          => '#212121',
                'text-transform' => 'none',
            ],
            'priority'    => 10,
            'transport'   => 'auto',
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_typography_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'typography',
            'settings'    => 'cartsy_lite_body_typography_setting',
            'label'       => esc_html__('Body tag typography control', 'cartsy-lite'),
            'section'     => 'cartsy_lite_typography_section',
            'default'     => [
                'font-family'    => 'Open Sans',
                'variant'        => 'regular',
                'font-size'      => '16px',
                'line-height'    => '1.625',
                'text-transform' => 'none',
                'letter-spacing' => '0',
            ],
            'priority'    => 10,
            'transport'   => 'auto',
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_typography_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'typography',
            'settings'    => 'cartsy_lite_widget_typography_setting',
            'label'       => esc_html__('Widget typography control', 'cartsy-lite'),
            'section'     => 'cartsy_lite_typography_section',
            'default'     => [
                'font-family'    => 'Open Sans',
                'variant'        => '600',
                'font-size'      => '21px',
                'line-height'    => '1.625',
                'text-transform' => 'none',
                'letter-spacing' => '0',
            ],
            'priority'    => 10,
            'transport'   => 'auto',
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_typography_switch',
                    'operator' => '===',
                    'value'    => 'on',
                ],
            ],
        ]);
    }
}
