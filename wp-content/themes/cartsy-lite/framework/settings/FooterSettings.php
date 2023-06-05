<?php

namespace Cartsy_Lite\Framework\Settings;

use Kirki;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Cartsy_Lite_FooterSettings
{
    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cartsy_lite_init_footerSettings();
        $this->cartsy_lite_footerSettings();
    }

    /**
     * cartsy_lite_init_footerSettings.
     *
     * @return void
     */
    public function cartsy_lite_init_footerSettings()
    {
        Kirki::add_section('cartsy_lite_footer_section', [
            'title'       => esc_html__('Copyright', 'cartsy-lite'),
            'description' => esc_html__('Global settings for footer located here', 'cartsy-lite'),
            'panel'       => 'cartsy_lite_config_panel',
            'priority'    => 160,
        ]);
    }

    /**
     * cartsy_lite_footerSettings.
     *
     * @return void
     */
    public function cartsy_lite_footerSettings()
    {
        // section choosing key : cartsy_lite_footer_section
        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_footer_widget_switch',
            'label'       => esc_html__('Footer Widgets', 'cartsy-lite'),
            'description' => esc_html__('Choose either On/Off', 'cartsy-lite'),
            'section'     => 'cartsy_lite_footer_section',
            'default'     => 'on',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'on'      => esc_html__('On', 'cartsy-lite'),
                'off'     => esc_html__('Off', 'cartsy-lite'),
            ],
        ]);

        // cartsylite copyright settings
        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'textarea',
            'settings'         => 'cartsy_lite_copyright_texts',
            'label'            => esc_html__('Copyright Text', 'cartsy-lite'),
            'description'      => esc_html__('enter copyright text to display', 'cartsy-lite'),
            'section'          => 'cartsy_lite_footer_section',
            'default'          => wp_kses_post( ' - All right reserved - Designed & Developed by RedQ Inc. &copy; '. date('Y') .'' ),
            'priority'         => 10,
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_footer_widget_switch',
                    'operator' => ' === ',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'url',
            'settings'         => 'cartsy_lite_copyright_url',
            'label'            => esc_html__('Copyright URL', 'cartsy-lite'),
            'description'      => esc_html__('Enter copyright URL to display', 'cartsy-lite'),
            'section'          => 'cartsy_lite_footer_section',
            'default'          => esc_url( 'https://redq.io/cartsy' ),
            'priority'         => 10,
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_footer_widget_switch',
                    'operator' => ' === ',
                    'value'    => 'on',
                ],
            ],
        ]);

        // color settings
        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'color',
            'settings'         => 'cartsy_lite_footer_text_color',
            'label'            => esc_html__('Text Color', 'cartsy-lite'),
            'description'      => esc_html__('Choose footer text color', 'cartsy-lite'),
            'section'          => 'cartsy_lite_footer_section',
            'default'          => '#212121',
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_footer_widget_switch',
                    'operator' => ' === ',
                    'value'    => 'on',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'color',
            'settings'         => 'cartsy_lite_footer_bg_color',
            'label'            => esc_html__('Background Color', 'cartsy-lite'),
            'description'      => esc_html__('Choose footer background color', 'cartsy-lite'),
            'section'          => 'cartsy_lite_footer_section',
            'default'          => '#ffffff',
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_footer_widget_switch',
                    'operator' => ' === ',
                    'value'    => 'on',
                ],
            ],
        ]);
    }
}
