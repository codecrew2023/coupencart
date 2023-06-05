<?php

namespace Cartsy_Lite\Framework\Settings;

use Kirki;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Cartsy_Lite_SocialProfileSettings
{
    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cartsy_lite_init_social_profileSettings();
        $this->cartsy_lite_social_profileSettings();
    }

    /**
     * cartsy_lite_init_social_profileSettings.
     *
     * @return void
     */
    public function cartsy_lite_init_social_profileSettings()
    {
        Kirki::add_section('cartsy_lite_global_social_section', [
            'title'       => esc_html__('Social Profile', 'cartsy-lite'),
            'description' => esc_html__('Set your social profile links.', 'cartsy-lite'),
            'panel'       => 'cartsy_lite_config_panel',
            'priority'    => 160,
        ]);
    }

    /**
     * cartsy_lite_social_profileSettings.
     *
     * @return void
     */
    public function cartsy_lite_social_profileSettings()
    {
        // section choosing key : cartsy_lite_global_social_section
        Kirki::add_field('cartsy_lite_config', [
            'type'        => 'select',
            'settings'    => 'cartsy_lite_social_profile_switch',
            'label'       => esc_html__('Display Social Profile', 'cartsy-lite'),
            'description' => esc_html__('Choose either display social option is On/Off', 'cartsy-lite'),
            'section'     => 'cartsy_lite_global_social_section',
            'default'     => 'on',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => [
                'on'      => esc_html__('On', 'cartsy-lite'),
                'off'     => esc_html__('Off', 'cartsy-lite'),
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'radio',
            'settings'         => 'cartsy_lite_fb_switch',
            'label'            => esc_html__('Facebook', 'cartsy-lite'),
            'description'      => esc_html__('Choose either facebook share option is On/Off', 'cartsy-lite'),
            'section'          => 'cartsy_lite_global_social_section',
            'default'          => 'on',
            'priority'         => 10,
            'multiple'         => 1,
            'choices'          => [
                'on'           => esc_html__('On', 'cartsy-lite'),
                'off'          => esc_html__('Off', 'cartsy-lite'),
            ],
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_social_profile_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'text',
            'settings'         => 'cartsy_lite_fb_profile_link',
            'label'            => esc_html__('Facebook profile link', 'cartsy-lite'),
            'description'      => esc_html__('Set facebook profile link', 'cartsy-lite'),
            'section'          => 'cartsy_lite_global_social_section',
            'default'          => esc_url( "https://www.facebook.com/" ),
            'priority'         => 10,
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_fb_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
                [
                    'setting'  => 'cartsy_lite_social_profile_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'radio',
            'settings'         => 'cartsy_lite_twitter_switch',
            'label'            => esc_html__('Twitter', 'cartsy-lite'),
            'description'      => esc_html__('Choose either twitter share option is On/Off', 'cartsy-lite'),
            'section'          => 'cartsy_lite_global_social_section',
            'default'          => 'on',
            'priority'         => 10,
            'multiple'         => 1,
            'choices'          => [
                'on'           => esc_html__('On', 'cartsy-lite'),
                'off'          => esc_html__('Off', 'cartsy-lite'),
            ],
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_social_profile_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'text',
            'settings'         => 'cartsy_lite_tw_profile_link',
            'label'            => esc_html__('Twitter profile link', 'cartsy-lite'),
            'description'      => esc_html__('Set twitter profile link', 'cartsy-lite'),
            'section'          => 'cartsy_lite_global_social_section',
            'default'          => esc_url( "https://twitter.com/" ),
            'priority'         => 10,
            'active_callback'  => [
                [
                    'setting'  => 'twitter_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
                [
                    'setting'  => 'cartsy_lite_social_profile_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'radio',
            'settings'         => 'cartsy_lite_linkedin_switch',
            'label'            => esc_html__('LinkedIn', 'cartsy-lite'),
            'description'      => esc_html__('Choose either linkedin share option is On/Off', 'cartsy-lite'),
            'section'          => 'cartsy_lite_global_social_section',
            'default'          => 'on',
            'priority'         => 10,
            'multiple'         => 1,
            'choices'          => [
                'on'           => esc_html__('On', 'cartsy-lite'),
                'off'          => esc_html__('Off', 'cartsy-lite'),
            ],
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_social_profile_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'text',
            'settings'         => 'cartsy_lite_linkedin_profile_link',
            'label'            => esc_html__('LinkedIn profile link', 'cartsy-lite'),
            'description'      => esc_html__('Set linkedin profile link', 'cartsy-lite'),
            'section'          => 'cartsy_lite_global_social_section',
            'default'          => esc_url( "https://www.linkedin.com/" ),
            'priority'         => 10,
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_linkedin_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
                [
                    'setting'  => 'cartsy_lite_social_profile_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'radio',
            'settings'         => 'cartsy_lite_instagram_switch',
            'label'            => esc_html__('Instagram', 'cartsy-lite'),
            'description'      => esc_html__('Choose either instagram share option is On/Off', 'cartsy-lite'),
            'section'          => 'cartsy_lite_global_social_section',
            'default'          => 'on',
            'priority'         => 10,
            'multiple'         => 1,
            'choices'          => [
                'on'           => esc_html__('On', 'cartsy-lite'),
                'off'          => esc_html__('Off', 'cartsy-lite'),
            ],
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_social_profile_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'text',
            'settings'         => 'cartsy_lite_instagram_profile_link',
            'label'            => esc_html__('Instagram profile link', 'cartsy-lite'),
            'description'      => esc_html__('Set instagram profile link', 'cartsy-lite'),
            'section'          => 'cartsy_lite_global_social_section',
            'default'          => esc_url( "https://www.instagram.com/" ),
            'priority'         => 10,
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_instagram_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
                [
                    'setting'  => 'cartsy_lite_social_profile_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'radio',
            'settings'         => 'cartsy_lite_pinterest_switch',
            'label'            => esc_html__('Pinterest', 'cartsy-lite'),
            'description'      => esc_html__('Choose either pinterest share option is On/Off', 'cartsy-lite'),
            'section'          => 'cartsy_lite_global_social_section',
            'default'          => 'off',
            'priority'         => 10,
            'multiple'         => 1,
            'choices'          => [
                'on'           => esc_html__('On', 'cartsy-lite'),
                'off'          => esc_html__('Off', 'cartsy-lite'),
            ],
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_social_profile_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'text',
            'settings'         => 'cartsy_lite_pinterest_profile_link',
            'label'            => esc_html__('Pinterest profile link', 'cartsy-lite'),
            'description'      => esc_html__('Set pinterest profile link', 'cartsy-lite'),
            'section'          => 'cartsy_lite_global_social_section',
            'default'          => esc_url( "https://www.pinterest.com/" ),
            'priority'         => 10,
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_pinterest_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
                [
                    'setting'  => 'cartsy_lite_social_profile_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'radio',
            'settings'         => 'cartsy_lite_youtube_switch',
            'label'            => esc_html__('YouTube', 'cartsy-lite'),
            'description'      => esc_html__('Choose either youtube share option is On/Off', 'cartsy-lite'),
            'section'          => 'cartsy_lite_global_social_section',
            'default'          => 'off',
            'priority'         => 10,
            'multiple'         => 1,
            'choices'          => [
                'on'           => esc_html__('On', 'cartsy-lite'),
                'off'          => esc_html__('Off', 'cartsy-lite'),
            ],
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_social_profile_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
            ],
        ]);

        Kirki::add_field('cartsy_lite_config', [
            'type'             => 'text',
            'settings'         => 'cartsy_lite_youtube_profile_link',
            'label'            => esc_html__('YouTube profile link', 'cartsy-lite'),
            'description'      => esc_html__('Set youtube profile link', 'cartsy-lite'),
            'section'          => 'cartsy_lite_global_social_section',
            'default'          => esc_url( "https://www.youtube.com/" ),
            'priority'         => 10,
            'active_callback'  => [
                [
                    'setting'  => 'cartsy_lite_youtube_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
                [
                    'setting'  => 'cartsy_lite_social_profile_switch',
                    'operator' => '!==',
                    'value'    => 'off',
                ],
            ],
        ]);
    }
}
