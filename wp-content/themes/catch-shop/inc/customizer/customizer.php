<?php
/**
 * Theme Customizer
 *
 * @package Catch_Shop
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_shop_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport              = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport       = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport      = 'postMessage';
	$wp_customize->get_setting( 'header_video' )->transport          = 'refresh';
	$wp_customize->get_setting( 'external_header_video' )->transport = 'refresh';
	$wp_customize->get_setting( 'header_image' )->transport 		 = 'refresh';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'catch_shop_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'catch_shop_customize_partial_blogdescription',
		) );
	}

	// Important Links.
	$wp_customize->add_section( 'catch_shop_important_links', array(
		'priority'      => 999,
		'title'         => esc_html__( 'Important Links', 'catch-shop' ),
	) );

	// Has dummy Sanitizaition function as it contains no value to be sanitized.
	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_important_links',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Catch_Shop_Important_Links_Control',
			'label'             => esc_html__( 'Important Links', 'catch-shop' ),
			'section'           => 'catch_shop_important_links',
			'type'              => 'catch_shop_important_links',
		)
	);
	// Important Links End.
}
add_action( 'customize_register', 'catch_shop_customize_register', 11 );

/**
 * Include Custom Controls
 */
require get_parent_theme_file_path( 'inc/customizer/custom-controls.php' );

/**
 * Include Header Media Options
 */
require get_parent_theme_file_path( 'inc/customizer/header-media.php' );

/**
 * Include Theme Options
 */
require get_parent_theme_file_path( 'inc/customizer/theme-options.php' );

/**
 * Include Featured Slider
 */
require get_parent_theme_file_path( 'inc/customizer/featured-slider.php' );

/**
 * Include Featured Content
 */
require get_parent_theme_file_path( 'inc/customizer/featured-content.php' );

/**
 * Include Testimonial
 */
require get_parent_theme_file_path( 'inc/customizer/testimonial.php' );

/**
 * Include Promotion Headline
 */
require get_parent_theme_file_path( 'inc/customizer/promotion-headline.php' );

/**
 * Include WooCommerce Support
 */
require get_parent_theme_file_path( 'inc/customizer/woocommerce.php' );

/**
 * Include Customizer Helper Functions
 */
require get_parent_theme_file_path( 'inc/customizer/helpers.php' );

/**
 * Include Sanitization functions
 */
require get_parent_theme_file_path( 'inc/customizer/sanitize-functions.php' );

/**
 * Include Reset Button
 */
require get_parent_theme_file_path( 'inc/customizer/reset.php' );

/**
 * Include Logo Slider
 */
require get_parent_theme_file_path( 'inc/customizer/logo-slider.php' );

/**
 * Include Countdown
 */
require get_parent_theme_file_path( 'inc/customizer/countdown.php' );

/**
 * Upgrade to Pro Button
 */
require get_parent_theme_file_path( 'inc/customizer/upgrade-button/class-customize.php' );
