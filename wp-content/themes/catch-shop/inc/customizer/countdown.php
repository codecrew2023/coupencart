<?php
/**
 * Countdown options
 *
 * @package Catch Wedding Pro
 */

/**
 * Add countdown options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_shop_countdown_options( $wp_customize ) {
	$wp_customize->add_section( 'catch_shop_countdown', array(
			'title' => esc_html__( 'Countdown', 'catch-shop' ),
			'panel' => 'catch_shop_theme_options',
		)
	);

	// Add color scheme setting and control.
	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_countdown_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_shop_sanitize_select',
			'choices'           => catch_shop_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-shop' ),
			'section'           => 'catch_shop_countdown',
			'type'              => 'select',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_countdown_bg_image',
			'sanitize_callback' => 'catch_shop_sanitize_image',
			'custom_control'    => 'WP_Customize_Image_Control',
			'active_callback'   => 'catch_shop_is_countdown_active',
			'label'             => esc_html__( 'Background Image', 'catch-shop' ),
			'section'           => 'catch_shop_countdown',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_countdown_tagline',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'Deal Of The Day', 'catch-shop' ),
			'active_callback'   => 'catch_shop_is_countdown_active',
			'label'             => esc_html__( 'Tagline', 'catch-shop' ),
			'section'           => 'catch_shop_countdown',
			'type'              => 'text',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_countdown_title',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'Grey Shirt & Red Dress', 'catch-shop' ),
			'active_callback'   => 'catch_shop_is_countdown_active',
			'label'             => esc_html__( 'Title', 'catch-shop' ),
			'section'           => 'catch_shop_countdown',
			'type'              => 'text',
		)
	);

	catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_countdown_description',
            'sanitize_callback' => 'wp_kses_post',
            'active_callback'   => 'catch_shop_is_countdown_active',
            'label'             => esc_html__( 'Description', 'catch-shop' ),
            'section'           => 'catch_shop_countdown',
            'type'              => 'textarea',
        )
    );

	// Add 10 Days to current Date.
	$default    = current_time( 'Y-m-d H:i:s' );
	$default = date( 'Y-m-d H:i:s', strtotime( $default . '+ 10 days') );

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_countdown_end_date',
			'sanitize_callback' => 'catch_shop_sanitize_date_time',
			'active_callback'   => 'catch_shop_is_countdown_active',
			'default'           => $default,
			'label'             => esc_html__( 'End Date', 'catch-shop' ),
			'section'           => 'catch_shop_countdown',
			'type'              => 'date_time',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_countdown_small_description',
			'sanitize_callback' => 'wp_kses_post',
			'default'           => esc_html__( 'Product Code xxxxxx', 'catch-shop' ),
			'active_callback'   => 'catch_shop_is_countdown_active',
			'label'             => esc_html__( 'Small Description', 'catch-shop' ),
			'section'           => 'catch_shop_countdown',
			'type'              => 'textarea',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_countdown_more_text',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_shop_is_countdown_active',
			'label'             => esc_html__( 'Button Text', 'catch-shop' ),
			'section'           => 'catch_shop_countdown',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_countdown_more_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_shop_is_countdown_active',
			'label'             => esc_html__( 'Button Link', 'catch-shop' ),
			'section'           => 'catch_shop_countdown',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_countdown_more_target',
			'sanitize_callback' => 'catch_shop_sanitize_checkbox',
			'active_callback'   => 'catch_shop_is_countdown_active',
			'label'             => esc_html__( 'Open Button Link in New Window/Tab', 'catch-shop' ),
			'section'           => 'catch_shop_countdown',
			'custom_control'    => 'Catch_Shop_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'catch_shop_countdown_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_shop_is_countdown_active' ) ) :
	/**
	* Return true if countdown is active
	*
	* @since Catch Wedding Pro 1.0
	*/
	function catch_shop_is_countdown_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_shop_countdown_option' )->value();

		return ( catch_shop_check_section( $enable ) );
	}
endif;
