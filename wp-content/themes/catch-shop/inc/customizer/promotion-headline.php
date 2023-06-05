<?php
/**
 * Promotion Headline Options
 *
 * @package Catch_Shop
 */

/**
 * Add promotion headline options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_shop_promo_head_options( $wp_customize ) {
	$wp_customize->add_section( 'catch_shop_promotion_headline', array(
			'title' => esc_html__( 'Promotion Headline', 'catch-shop' ),
			'panel' => 'catch_shop_theme_options',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_promo_head_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_shop_sanitize_select',
			'choices'           => catch_shop_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-shop' ),
			'section'           => 'catch_shop_promotion_headline',
			'type'              => 'select',
		)
	);

	/*Overlay Option for Promotion Headline Background Image */
	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_promo_head_background_image_opacity',
			'default'           => 20,
			'sanitize_callback' => 'catch_shop_sanitize_number_range',
			'active_callback'   => 'catch_shop_is_promotion_headline_active',
			'label'             => esc_html__( 'Background Image Overlay', 'catch-shop' ),
			'section'           => 'catch_shop_promotion_headline',
			'type'              => 'number',
			'input_attrs'       => array(
				'style' => 'width: 60px;',
				'min'   => 0,
				'max'   => 100,
			),
		)
	);

	/* Promotion Headline Image */
	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_promo_head_logo_image',
			'sanitize_callback' => 'catch_shop_sanitize_image',
			'custom_control'    => 'WP_Customize_Image_Control',
			'active_callback'   => 'catch_shop_is_promotion_headline_active',
			'label'             => esc_html__( 'Promotion Headline Image', 'catch-shop' ),
			'section'           => 'catch_shop_promotion_headline',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_promo_head_text_color',
			'default'           => 1,
			'sanitize_callback' => 'catch_shop_sanitize_checkbox',
			'active_callback'   => 'catch_shop_is_promotion_headline_active',
			'label'             => esc_html__( 'Display text in white color', 'catch-shop' ),
			'section'           => 'catch_shop_promotion_headline',
			'custom_control'    => 'Catch_Shop_Toggle_Control',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_promo_head_sub_title',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_shop_is_promotion_headline_active',
			'label'             => esc_html__( 'Tagline', 'catch-shop' ),
			'section'           => 'catch_shop_promotion_headline',
			'type'              => 'text',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_promotion_headline',
			'default'           => '0',
			'sanitize_callback' => 'catch_shop_sanitize_post',
			'active_callback'   => 'catch_shop_is_promotion_headline_active',
			'label'             => esc_html__( 'Page', 'catch-shop' ),
			'section'           => 'catch_shop_promotion_headline',
			'type'              => 'dropdown-pages',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_promo_head_description',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_shop_is_promotion_headline_active',
			'label'             => esc_html__( 'Description', 'catch-shop' ),
			'section'           => 'catch_shop_promotion_headline',
			'type'              => 'textarea',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_display_promotion_headline_title',
			'sanitize_callback' => 'catch_shop_sanitize_checkbox',
			'default'           => 1,
			'active_callback'   => 'catch_shop_is_promotion_headline_active',
			'label'             => esc_html__( 'Display title', 'catch-shop' ),
			'section'           => 'catch_shop_promotion_headline',
			'custom_control'    => 'Catch_Shop_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'catch_shop_promo_head_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_shop_is_promotion_headline_active' ) ) :
	/**
	* Return true if promotion headline is active
	*
	* @since 1.0
	*/
	function catch_shop_is_promotion_headline_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_shop_promo_head_visibility' )->value();

		return catch_shop_check_section( $enable );
	}
endif;
