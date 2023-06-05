<?php

namespace Cartsy_Lite\Framework\Admin;

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

class Cartsy_Lite_Plugins
{
    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        add_action('tgmpa_register', [$this, 'cartsy_lite_load_plugins_via_tgmpa']);
    }

    /**
     * cartsy_lite_load_plugins_via_tgmpa.
     *
     * @return void
     */
    public function cartsy_lite_load_plugins_via_tgmpa()
    {
        /**
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = [
            [
                'name'     => esc_html__('WooCommerce - excelling eCommerce', 'cartsy-lite'),
                'slug'     => 'woocommerce',
                'required' => false,
            ],
            [
                'name'     => esc_html__('Kirki Customizer Framework', 'cartsy-lite'),
                'slug'     => 'kirki',
                'required' => false,
            ],
            [
                'name'     => esc_html__('Contact Form 7', 'cartsy-lite'),
                'slug'     => 'contact-form-7',
                'required' => false,
            ],
            [
                'name'     => esc_html__('Booking and Rental System (Woocommerce)', 'cartsy-lite'),
                'slug'     => 'booking-and-rental-system-woocommerce',
                'required' => false,
            ],
        ];

        $config = [
            'id'           => 'cartsy-lite',           // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug'  => 'themes.php',            // Parent menu slug.
            'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
        ];
        tgmpa($plugins, $config);
    }
}
