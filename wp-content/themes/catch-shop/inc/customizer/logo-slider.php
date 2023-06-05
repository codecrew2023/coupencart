<?php
/**
 * Featured Slider Options
 *
 * @package Catch_Shop
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_shop_logo_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'catch_shop_logo_slider', array(
			'panel' => 'catch_shop_theme_options',
			'title' => esc_html__( 'Logo Slider', 'catch-shop' ),
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_logo_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_shop_sanitize_select',
			'choices'           => catch_shop_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-shop' ),
			'section'           => 'catch_shop_logo_slider',
			'type'              => 'select',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_logo_slider_tagline',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_shop_is_logo_slider_active',
			'label'             => esc_html__( 'Tagline', 'catch-shop' ),
			'section'           => 'catch_shop_logo_slider',
			'type'              => 'text',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_logo_slider_title',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_shop_is_logo_slider_active',
			'label'             => esc_html__( 'Title', 'catch-shop' ),
			'section'           => 'catch_shop_logo_slider',
			'type'              => 'text',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_logo_slider_description',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'catch_shop_is_logo_slider_active',
			'label'             => esc_html__( 'Description', 'catch-shop' ),
			'section'           => 'catch_shop_logo_slider',
			'type'              => 'textarea',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_logo_slider_number',
			'default'           => '7',
			'sanitize_callback' => 'catch_shop_sanitize_number_range',

			'active_callback'   => 'catch_shop_is_logo_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Items is changed (Max no of slides is 20)', 'catch-shop' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of Items', 'catch-shop' ),
			'section'           => 'catch_shop_logo_slider',
			'type'              => 'number',
		)
	);

	$logo_slider_number = get_theme_mod( 'catch_shop_logo_slider_number', 7 );

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_logo_slider_display_title',
			'sanitize_callback' => 'catch_shop_sanitize_checkbox',
			'active_callback'   => 'catch_shop_is_logo_slider_active',
			'label'             => esc_html__( 'Display Title', 'catch-shop' ),
			'section'           => 'catch_shop_logo_slider',
			'custom_control'    => 'Catch_Shop_Toggle_Control',
		)
	);

	for ( $i = 1; $i <= $logo_slider_number ; $i++ ) {
		// Page Sliders
		catch_shop_register_option( $wp_customize, array(
				'name'              => 'catch_shop_logo_slider_page_' . $i,
				'sanitize_callback' => 'catch_shop_sanitize_post',
				'active_callback'   => 'catch_shop_is_logo_slider_active',
				'label'             => esc_html__( 'Page', 'catch-shop' ) . ' # ' . $i,
				'section'           => 'catch_shop_logo_slider',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'catch_shop_logo_slider_options' );

/** Active Callback Functions */

if ( ! function_exists( 'catch_shop_is_logo_slider_active' ) ) :
	/**
	* Return true if logo_slider is active
	*
	* @since Catch Mag Pro 1.0
	*/
	function catch_shop_is_logo_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_shop_logo_slider_option' )->value();

		//return true only if previwed page on customizer matches the type option selected
		return catch_shop_check_section( $enable );
	}
endif;
