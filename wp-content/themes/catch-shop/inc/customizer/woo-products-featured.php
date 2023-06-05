<?php
/**
 * Adding support for WooCommerce Products Showcase Option
 */

if ( ! class_exists( 'WooCommerce' ) ) {
    // Bail if WooCommerce is not installed
    return;
}

/**
 * Add WooCommerce Product Showcase Options to customizer
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_shop_featured( $wp_customize ) {
   $wp_customize->add_section( 'catch_shop_featured', array(
        'title' => esc_html__( 'WooCommerce Featured Products', 'catch-shop' ),
        'panel' => 'catch_shop_theme_options',
    ) );

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_featured_option',
            'default'           => 'disabled',
            'sanitize_callback' => 'catch_shop_sanitize_select',
            'choices'           => catch_shop_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'catch-shop' ),
            'section'           => 'catch_shop_featured',
            'type'              => 'select',
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_featured_tagline',
            'sanitize_callback' => 'sanitize_text_field',
            'active_callback'   => 'catch_shop_is_featured_active',
            'label'             => esc_html__( 'Tagline', 'catch-shop' ),
            'default'           => esc_html__( 'All Styles in This Spring', 'catch-shop' ) ,
            'section'           => 'catch_shop_featured',
            'type'              => 'text',
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_featured_title',
            'sanitize_callback' => 'sanitize_text_field',
            'active_callback'   => 'catch_shop_is_featured_active',
            'label'             => esc_html__( 'Title', 'catch-shop' ),
            'default'           => esc_html__( 'Featured Products', 'catch-shop' ),
            'section'           => 'catch_shop_featured',
            'type'              => 'text',
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_featured_description',
            'sanitize_callback' => 'wp_kses_post',
            'active_callback'   => 'catch_shop_is_featured_active',
            'label'             => esc_html__( 'Description', 'catch-shop' ),
            'section'           => 'catch_shop_featured',
            'type'              => 'textarea',
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_featured_number',
            'default'           => 4,
            'sanitize_callback' => 'catch_shop_sanitize_number_range',
            'active_callback'   => 'catch_shop_is_featured_active',
            'description'       => esc_html__( 'Save and refresh the page if No. of Products is changed. Set -1 to display all', 'catch-shop' ),
            'input_attrs'       => array(
                'style' => 'width: 50px;',
                'min'   => -1,
            ),
            'label'             => esc_html__( 'No of Products', 'catch-shop' ),
            'section'           => 'catch_shop_featured',
            'type'              => 'number',
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'               => 'catch_shop_featured_columns',
            'default'            => 4,
            'sanitize_callback'  => 'catch_shop_sanitize_number_range',
            'active_callback'    => 'catch_shop_is_featured_active',
            'description'        => esc_html__( 'Theme supports up to 4 columns', 'catch-shop' ),
            'label'              => esc_html__( 'No of Columns', 'catch-shop' ),
            'section'            => 'catch_shop_featured',
            'type'               => 'number',
            'input_attrs'       => array(
                'style' => 'width: 50px;',
                'min'   => 1,
                'max'   => 4,
            ),
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'               => 'catch_shop_featured_paginate',
            'default'            => 'false',
            'sanitize_callback'  => 'catch_shop_sanitize_select',
            'active_callback'    => 'catch_shop_is_featured_active',
            'label'              => esc_html__( 'Paginate', 'catch-shop' ),
            'section'            => 'catch_shop_featured',
            'type'               => 'radio',
            'choices'            => array(
                'false' => esc_html__( 'No', 'catch-shop' ),
                'true' => esc_html__( 'Yes', 'catch-shop' ),
            ),
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'               => 'catch_shop_featured_orderby',
            'default'            => 'date',
            'sanitize_callback'  => 'catch_shop_sanitize_select',
            'active_callback'    => 'catch_shop_is_featured_active',
            'label'              => esc_html__( 'Order By', 'catch-shop' ),
            'section'            => 'catch_shop_featured',
            'type'               => 'select',
            'choices'            => array(
                'date'       => esc_html__( 'Date - The date the product was published', 'catch-shop' ),
                'id'         => esc_html__( 'ID - The post ID of the product', 'catch-shop' ),
                'menu_order' => esc_html__( 'Menu Order - The Menu Order, if set (lower numbers display first)', 'catch-shop' ),
                'popularity' => esc_html__( 'Popularity - The number of purchases', 'catch-shop' ),
                'rand'       => esc_html__( 'Random', 'catch-shop' ),
                'rating'     => esc_html__( 'Rating - The average product rating', 'catch-shop' ),
                'title'      => esc_html__( 'Title - The product title', 'catch-shop' ),
            ),
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'               => 'catch_shop_featured_products_filter',
            'default'            => 'none',
            'sanitize_callback'  => 'catch_shop_sanitize_select',
            'active_callback'    => 'catch_shop_is_featured_active',
            'label'              => esc_html__( 'Products Filter', 'catch-shop' ),
            'section'            => 'catch_shop_featured',
            'type'               => 'radio',
            'choices'            => array(
                'none'         => esc_html__( 'None', 'catch-shop' ),
                'on_sale'      => esc_html__( 'Retrieve on sale products', 'catch-shop' ),
                'best_selling' => esc_html__( 'Retrieve best selling products', 'catch-shop' ),
                'top_rated'    => esc_html__( 'Retrieve top rated products', 'catch-shop' ),
            ),
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_featured_featured',
            'default'           => '1',
            'sanitize_callback' => 'catch_shop_sanitize_checkbox',
            'active_callback'   => 'catch_shop_is_featured_active',
            'label'             => esc_html__( 'Show only Products that are marked as Featured Products', 'catch-shop' ),
            'section'           => 'catch_shop_featured',
            'custom_control'    => 'catch_shop_Toggle_Control',
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'               => 'catch_shop_featured_order',
            'default'            => 'DESC',
            'sanitize_callback'  => 'catch_shop_sanitize_select',
            'active_callback'    => 'catch_shop_is_featured_active',
            'label'              => esc_html__( 'Order', 'catch-shop' ),
            'section'            => 'catch_shop_featured',
            'type'               => 'radio',
            'choices'            => array(
                'ASC'  => esc_html__( 'Ascending', 'catch-shop' ),
                'DESC' => esc_html__( 'Descending', 'catch-shop' ),
            ),
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_featured_skus',
            'description'       => esc_html__( 'Comma separated list of product SKUs', 'catch-shop' ),
            'sanitize_callback' => 'sanitize_text_field',
            'active_callback'   => 'catch_shop_is_featured_active',
            'label'             => esc_html__( 'SKUs', 'catch-shop' ),
            'section'           => 'catch_shop_featured',
            'type'              => 'text',
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_featured_category',
            'description'       => esc_html__( 'Comma separated list of category slugs', 'catch-shop' ),
            'sanitize_callback' => 'sanitize_text_field',
            'active_callback'   => 'catch_shop_is_featured_active',
            'label'             => esc_html__( 'Category', 'catch-shop' ),
            'section'           => 'catch_shop_featured',
            'type'              => 'textarea',
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_featured_text',
            'sanitize_callback' => 'sanitize_text_field',
            'active_callback'   => 'catch_shop_is_featured_active',
            'label'             => esc_html__( 'Button Text', 'catch-shop' ),
            'section'           => 'catch_shop_featured',
            'type'              => 'text',
        )
    );
    $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_featured_link',
            'default'           =>  esc_url( $shop_page_url ),
            'sanitize_callback' => 'esc_url_raw',
            'active_callback'   => 'catch_shop_is_featured_active',
            'label'             => esc_html__( 'Button Link', 'catch-shop' ),
            'section'           => 'catch_shop_featured',
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_featured_target',
            'sanitize_callback' => 'catch_shop_sanitize_checkbox',
            'active_callback'   => 'catch_shop_is_featured_active',
            'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-shop' ),
            'section'           => 'catch_shop_featured',
            'custom_control'    => 'catch_shop_Toggle_Control',
        )
    );
}
add_action( 'customize_register', 'catch_shop_featured', 10 );

/** Active Callback Functions **/
if( ! function_exists( 'catch_shop_is_featured_active' ) ) :
    /**
    * Return true if featured content is active
    *
    * @since Catch_Store Pro 1.0
    */
    function catch_shop_is_featured_active( $control ) {
        $enable = $control->manager->get_setting( 'catch_shop_featured_option' )->value();

        return ( catch_shop_check_section( $enable ) );
    }
endif;
