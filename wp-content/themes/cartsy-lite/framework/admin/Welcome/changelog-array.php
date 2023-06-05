<?php

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

$change_log_array = [
    '1.4.8' => [
        'version' => esc_html__( 'v1.4.8', 'cartsy-lite' ),
        'release_date' => esc_html__( 'August 8 2022', 'cartsy-lite' ),
        'logs' => [
            'fix' => [
                esc_html__( 'WordPress Latest Version Compatibility.', 'cartsy-lite' ),
            ],
            'feat' => [
                esc_html__( 'Booking and Rental System (Woocommerce) plugin support add.', 'cartsy-lite' ),
            ],
        ]
    ],
    '1.4.7' => [
        'version' => esc_html__( 'v1.4.7', 'cartsy-lite' ),
        'release_date' => esc_html__( 'May 10 2022', 'cartsy-lite' ),
        'logs' => [
            'fix' => [
                esc_html__( 'WordPress Latest Version Compatibility.', 'cartsy-lite' ),
                esc_html__( 'WooCommerce Latest Version Compatibility.', 'cartsy-lite' ),
                esc_html__( 'Update Starter Content.', 'cartsy-lite' ),
            ],
        ]
    ],
    '1.4.6' => [
        'version' => esc_html__( 'v1.4.6', 'cartsy-lite' ),
        'release_date' => esc_html__( 'Mar 4 2022', 'cartsy-lite' ),
        'logs' => [
            'fix' => [
                esc_html__( 'Remove accessibility-ready tag.', 'cartsy-lite' ),
                esc_html__( 'Starter content logo broken issue.', 'cartsy-lite' ),
                esc_html__( 'Header area search panel issue.', 'cartsy-lite' ),
            ],
        ]
    ],
    '1.4.5' => [
        'version' => esc_html__( 'v1.4.5', 'cartsy-lite' ),
        'release_date' => esc_html__( 'Feb 22 2022', 'cartsy-lite' ),
        'logs' => [
            'fix' => [
                esc_html__( 'php8 compatibility check.', 'cartsy-lite' ),
            ],
        ]
    ],
    '1.4.4' => [
        'version' => esc_html__( 'v1.4.4', 'cartsy-lite' ),
        'release_date' => esc_html__( 'Feb 18 2022', 'cartsy-lite' ),
        'logs' => [
            'fix' => [
                esc_html__( 'Starter content broken issue.', 'cartsy-lite' ),
            ],
        ]
    ],
    '1.4.3' => [
        'version' => esc_html__( 'v1.4.3', 'cartsy-lite' ),
        'release_date' => esc_html__( 'Feb 18 2022', 'cartsy-lite' ),
        'logs' => [
            'fix' => [
                esc_html__( 'Composer file name issue.', 'cartsy-lite' ),
            ],
        ]
    ],
    '1.4.2' => [
        'version' => esc_html__( 'v1.4.2', 'cartsy-lite' ),
        'release_date' => esc_html__( 'Feb 17 2022', 'cartsy-lite' ),
        'logs' => [
            'fix' => [
                esc_html__( 'Documentation update.', 'cartsy-lite' ),
                esc_html__( 'Language file update.', 'cartsy-lite' ),
            ],
            'feat' => [
                esc_html__( 'Homepage Gutenberg blocks support.', 'cartsy-lite' ),
                esc_html__( 'Starter content added.', 'cartsy-lite' ),
                esc_html__( 'Theme info related admin notice added.', 'cartsy-lite' ),
                esc_html__( 'Theme tour guide added in admin area.', 'cartsy-lite' ),
            ],
        ]
    ],
    '1.4.1' => [
        'version' => esc_html__( 'v1.4.1', 'cartsy-lite' ),
        'release_date' => esc_html__( 'Feb 09 2022', 'cartsy-lite' ),
        'logs' => [
            'fix' => [
                esc_html__( 'Category permalink issue', 'cartsy-lite' ),
                esc_html__( 'Accessibility ready issue fix', 'cartsy-lite' ),
                esc_html__( 'Mini-cart overlapping CSS issue', 'cartsy-lite' ),
                esc_html__( 'Header overlapping in Category sidebar CSS issue', 'cartsy-lite' ),
            ],
            'perf' => [
                esc_html__( 'Product category query optimization for better performance.', 'cartsy-lite' ),
            ],
            'feat' => [
                esc_html__( 'Copyright site link customize options added.', 'cartsy-lite' ),
                esc_html__( 'Homepage product category customize option added', 'cartsy-lite' )
            ]
        ]
    ],
    '1.4' => [
        'version' => esc_html__( 'v1.4', 'cartsy-lite' ),
        'release_date' => esc_html__( 'Feb 04 2022', 'cartsy-lite' ),
        'logs' => [
            'release' => [
                esc_html__( 'Initial release', 'cartsy-lite' )
            ]
        ]
    ],
];