<?php
/**
 * Theme Options
 *
 * @package Catch_Shop
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_shop_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'catch_shop_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'catch-shop' ),
		'priority' => 130,
	) );

	// Layout Options
	$wp_customize->add_section( 'catch_shop_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'catch-shop' ),
		'panel' => 'catch_shop_theme_options',
		)
	);

	/* Default Layout */
	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'catch_shop_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'catch-shop' ),
			'section'           => 'catch_shop_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'catch-shop' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'catch-shop' ),
			),
		)
	);

	/* Homepage/Archive Layout */
	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_homepage_archive_layout',
			'default'           => 'no-sidebar-full-width',
			'sanitize_callback' => 'catch_shop_sanitize_select',
			'label'             => esc_html__( 'Homepage/Archive Layout', 'catch-shop' ),
			'section'           => 'catch_shop_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'catch-shop' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'catch-shop' ),
			),
		)
	);

	/* Single Page/Post Image */
	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_single_layout',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_shop_sanitize_select',
			'label'             => esc_html__( 'Single Page/Post Image', 'catch-shop' ),
			'section'           => 'catch_shop_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'disabled'       => esc_html__( 'Disabled', 'catch-shop' ),
				'post-thumbnail' => esc_html__( 'Post Thumbnail', 'catch-shop' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'catch_shop_excerpt_options', array(
		'panel'     => 'catch_shop_theme_options',
		'title'     => esc_html__( 'Excerpt Options', 'catch-shop' ),
	) );

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_excerpt_length',
			'default'           => '22',
			'sanitize_callback' => 'absint',
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'catch-shop' ),
			'section'  => 'catch_shop_excerpt_options',
			'type'     => 'number',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_excerpt_more_text',
			'default'           => esc_html__( 'Continue reading...', 'catch-shop' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'catch-shop' ),
			'section'           => 'catch_shop_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'catch_shop_search_options', array(
		'panel'     => 'catch_shop_theme_options',
		'title'     => esc_html__( 'Search Options', 'catch-shop' ),
	) );

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_search_text',
			'default'           => esc_html__( 'Search Products ...', 'catch-shop' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Search Text', 'catch-shop' ),
			'section'           => 'catch_shop_search_options',
			'type'              => 'text',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'catch_shop_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'catch-shop' ),
		'panel'       => 'catch_shop_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'catch-shop' ),
	) );

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_recent_posts_tagline',
			'default'           => esc_html__( 'Latest Updates', 'catch-shop' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Tagline', 'catch-shop' ),
			'section'           => 'catch_shop_homepage_options',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_recent_posts_title',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'From Our Blog', 'catch-shop' ),
			'label'             => esc_html__( 'Recent Posts Title', 'catch-shop' ),
			'section'           => 'catch_shop_homepage_options',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_static_page_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'	=> 'catch_shop_is_static_page_enabled',
			'default'           => esc_html__( 'Archives', 'catch-shop' ),
			'label'             => esc_html__( 'Posts Page Header Text', 'catch-shop' ),
			'section'           => 'catch_shop_homepage_options',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_recent_posts_description',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Recent Posts Description', 'catch-shop' ),
			'section'           => 'catch_shop_homepage_options',
			'type'              => 'textarea'
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_front_page_category',
			'sanitize_callback' => 'catch_shop_sanitize_category_list',
			'custom_control'    => 'Catch_Shop_Multi_Cat',
			'label'             => esc_html__( 'Categories', 'catch-shop' ),
			'section'           => 'catch_shop_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_top_menu_label',
			'default'           => esc_html__( 'Top Bar', 'catch-shop' ),
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_shop_is_header_top_enabled',
			'label'             => esc_html__( 'Header Top Mobile Menu Label', 'catch-shop' ),
			'section'           => 'catch_shop_menu_options',
			'type'              => 'text',
		)
	);
	//Menu Options End

	$wp_customize->add_section( 'catch_shop_header_right', array(
		'title'       => esc_html__( 'Header Right', 'catch-shop' ),
		'description' => esc_html__( 'All options in this section requires WooCommerce Plugin', 'catch-shop' ),
		'panel'       => 'catch_shop_theme_options',
	) );

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_right_my_account_enable',
			'sanitize_callback' => 'catch_shop_sanitize_checkbox',
			'label'             => esc_html__( 'My Account Icon', 'catch-shop' ),
			'section'           => 'catch_shop_header_right',
			'custom_control'    => 'Catch_Shop_Toggle_Control',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_right_my_account_label_enable',
			'sanitize_callback' => 'catch_shop_sanitize_checkbox',
			'label'             => esc_html__( 'My Account Label', 'catch-shop' ),
			'section'           => 'catch_shop_header_right',
			'custom_control'    => 'Catch_Shop_Toggle_Control',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_right_my_account_label',
			'default'           => esc_html__( 'My Account', 'catch-shop' ),
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_shop_is_header_right_my_account_enable',
			'label'             => esc_html__( 'My Account label text', 'catch-shop' ),
			'section'           => 'catch_shop_header_right',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_right_cart_enable',
			'default'           => 1,
			'sanitize_callback' => 'catch_shop_sanitize_checkbox',
			'label'             => esc_html__( 'Cart Icon', 'catch-shop' ),
			'section'           => 'catch_shop_header_right',
			'custom_control'    => 'Catch_Shop_Toggle_Control',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_right_cart_items_enable',
			'sanitize_callback' => 'catch_shop_sanitize_checkbox',
			'active_callback'   => 'catch_shop_is_header_right_cart_enable',
			'label'             => esc_html__( 'Cart Items', 'catch-shop' ),
			'section'           => 'catch_shop_header_right',
			'custom_control'    => 'Catch_Shop_Toggle_Control',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_header_right_cart_amount_enable',
			'sanitize_callback' => 'catch_shop_sanitize_checkbox',
			'active_callback'   => 'catch_shop_is_header_right_cart_enable',
			'label'             => esc_html__( 'Cart Amount', 'catch-shop' ),
			'section'           => 'catch_shop_header_right',
			'custom_control'    => 'Catch_Shop_Toggle_Control',
		)
	);

	// Pagination Options.
	$pagination_type = get_theme_mod( 'catch_shop_pagination_type', 'default' );

	$nav_desc = '';

	/**
	* Check if navigation type is Jetpack Infinite Scroll and if it is enabled
	*/
	$nav_desc = sprintf(
		wp_kses(
			__( 'For infinite scrolling, use %1$sCatch Infinite Scroll Plugin%2$s with Infinite Scroll module Enabled.', 'catch-shop' ),
			array(
				'a' => array(
					'href' => array(),
					'target' => array(),
				),
				'br'=> array()
			)
		),
		'<a target="_blank" href="https://wordpress.org/plugins/catch-infinite-scroll/">',
		'</a>'
	);

	$wp_customize->add_section( 'catch_shop_pagination_options', array(
		'description'     => $nav_desc,
		'panel'           => 'catch_shop_theme_options',
		'title'           => esc_html__( 'Pagination Options', 'catch-shop' ),
		'active_callback' => 'catch_shop_scroll_plugins_inactive'
	) );

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_pagination_type',
			'default'           => 'default',
			'sanitize_callback' => 'catch_shop_sanitize_select',
			'choices'           => catch_shop_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'catch-shop' ),
			'section'           => 'catch_shop_pagination_options',
			'type'              => 'select',
		)
	);

	// For WooCommerce layout: catch_shop_woocommerce_layout, check woocommerce-options.php.
	/* Scrollup Options */
	$wp_customize->add_section( 'catch_shop_scrollup', array(
		'panel'    => 'catch_shop_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'catch-shop' ),
	) );

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_disable_scrollup',
			'default'			=> 1,
			'sanitize_callback' => 'catch_shop_sanitize_checkbox',
			'label'             => esc_html__( 'Scroll Up', 'catch-shop' ),
			'section'           => 'catch_shop_scrollup',
			'custom_control'    => 'Catch_Shop_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'catch_shop_theme_options' );

/** Active Callback Functions */
if ( ! function_exists( 'catch_shop_scroll_plugins_inactive' ) ) :
	/**
	* Return true if infinite scroll functionality exists
	*
	* @since 1.0
	*/
	function catch_shop_scroll_plugins_inactive( $control ) {
		if ( ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) || class_exists( 'Catch_Infinite_Scroll' ) ) {
			// Support infinite scroll plugins.
			return false;
		}

		return true;
	}
endif;

if ( ! function_exists( 'catch_shop_is_static_page_enabled' ) ) :
	/**
	* Return true if A Static Page is enabled
	*
	* @since Catch Shop 1.1.2
	*/
	function catch_shop_is_static_page_enabled( $control ) {
		$enable = $control->manager->get_setting( 'show_on_front' )->value();
		if ( 'page' === $enable ) {
			return true;
		}
		return false;
	}
endif;

if( ! function_exists( 'catch_shop_is_header_top_enabled' ) ) :
    /**
    * Return true if header top is enabled
    *
    * @since Catch_Shop Pro 1.0
    */
    function catch_shop_is_header_top_enabled( $control ) {
        return ( $control->manager->get_setting( 'catch_shop_enable_header_top' )->value() ? true : false );
    }
endif;

if( ! function_exists( 'catch_shop_is_primary_menu_my_account_enable' ) ) :
	/**
	* Return true if primary menu's my account enabled
	*
	* @since Catch_Shop Pro 1.0
	*/
	function catch_shop_is_primary_menu_my_account_enable( $control ) {
		return catch_shop_is_primary_menu_enabled( $control ) && $control->manager->get_setting( 'catch_shop_primary_menu_my_account_enable' )->value();
	}
endif;

if( ! function_exists( 'catch_shop_is_primary_menu_cart_enable' ) ) :
	/**
	* Return true if primary menu's cart icon enabled
	*
	* @since Catch_Shop Pro 1.0
	*/
	function catch_shop_is_primary_menu_cart_enable( $control ) {
		return catch_shop_is_primary_menu_enabled( $control ) && $control->manager->get_setting( 'catch_shop_primary_menu_cart_enable' )->value();
	}
endif;

if( ! function_exists( 'catch_shop_is_header_right_disabled' ) ) :
	/**
	* Return true if header right menu disabled
	*
	* @since Catch_Shop Pro 1.0
	*/
	function catch_shop_is_header_right_disabled( $control ) {
		return ! has_nav_menu( 'header-top' );
	}
endif;

if( ! function_exists( 'catch_shop_is_header_right_my_account_enable' ) ) :
	/**
	* Return true if primary menu's my account enabled
	*
	* @since Catch_Shop Pro 1.0
	*/
	function catch_shop_is_header_right_my_account_enable( $control ) {
		return $control->manager->get_setting( 'catch_shop_header_right_my_account_label_enable' )->value();
	}
endif;

if( ! function_exists( 'catch_shop_is_header_right_cart_enable' ) ) :
	/**
	* Return true if primary menu's cart icon enabled
	*
	* @since Catch_Shop Pro 1.0
	*/
	function catch_shop_is_header_right_cart_enable( $control ) {
		return $control->manager->get_setting( 'catch_shop_header_right_cart_enable' )->value() ? true : false;
	}
endif;
