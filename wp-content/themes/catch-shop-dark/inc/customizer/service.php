<?php
/**
 * Services options
 *
 * @package Catch_Shop
 */

/**
 * Add service content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_shop_service_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_service_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Shop_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Services Options, go %1$shere%2$s', 'catch-shop-dark' ),
                '<a href="javascript:wp.customize.section( \'catch_shop_service\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'catch_shop_service', array(
			'title' => esc_html__( 'Services', 'catch-shop-dark' ),
			'panel' => 'catch_shop_theme_options',
		)
	);

	$action = 'install-plugin';
    $slug   = 'essential-content-types';

    $install_url = wp_nonce_url(
        add_query_arg(
            array(
                'action' => $action,
                'plugin' => $slug
            ),
            admin_url( 'update.php' )
        ),
        $action . '_' . $slug
    );

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_service_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Shop_Note_Control',
            'active_callback'   => 'catch_shop_is_ect_services_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Services, install %1$sEssential Content Types%2$s Plugin with Service Type Enabled', 'catch-shop-dark' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'catch_shop_service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	// Add color scheme setting and control.
	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_service_option',
			'default'           => 'disabled',
			'active_callback'   => 'catch_shop_is_ect_services_active',
			'sanitize_callback' => 'catch_shop_sanitize_select',
			'choices'           => catch_shop_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-shop-dark' ),
			'section'           => 'catch_shop_service',
			'type'              => 'select',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_service_tagline',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_shop_is_service_active',
			'label'             => esc_html__( 'Tagline', 'catch-shop-dark' ),
			'section'           => 'catch_shop_service',
			'type'              => 'text',
		)
	);

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_service_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Shop_Note_Control',
            'active_callback'   => 'catch_shop_is_service_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'catch-shop-dark' ),
                 '<a href="javascript:wp.customize.control( \'ect_service_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'catch_shop_service',
            'type'              => 'description',
        )
    );

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_service_number',
			'default'           => 3,
			'sanitize_callback' => 'catch_shop_sanitize_number_range',
			'active_callback'   => 'catch_shop_is_service_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Services is changed (Max no of Services is 20)', 'catch-shop-dark' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of items', 'catch-shop-dark' ),
			'section'           => 'catch_shop_service',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'catch_shop_service_number', 3 );

	//loop for service post content
	for ( $i = 1; $i <= $number ; $i++ ) {
		catch_shop_register_option( $wp_customize, array(
				'name'              => 'catch_shop_service_cpt_' . $i,
				'sanitize_callback' => 'catch_shop_sanitize_post',
				'active_callback'   => 'catch_shop_is_service_active',
				'label'             => esc_html__( 'Item ', 'catch-shop-dark' ) . ' ' . $i ,
				'section'           => 'catch_shop_service',
				'type'              => 'select',
                'choices'           => catch_shop_generate_post_array( 'ect-service' ),
			)
		);
	} // End for().

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_service_text',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_shop_is_service_active',
			'label'             => esc_html__( 'Button Text', 'catch-shop-dark' ),
			'section'           => 'catch_shop_service',
			'type'              => 'text',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_service_link',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'catch_shop_is_service_active',
			'label'             => esc_html__( 'Button Link', 'catch-shop-dark' ),
			'section'           => 'catch_shop_service',
		)
	);

	catch_shop_register_option( $wp_customize, array(
			'name'              => 'catch_shop_service_target',
			'sanitize_callback' => 'catch_shop_sanitize_checkbox',
			'active_callback'   => 'catch_shop_is_service_active',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-shop-dark' ),
			'section'           => 'catch_shop_service',
			'custom_control'    => 'Catch_Shop_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'catch_shop_service_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_shop_is_service_active' ) ) :
	/**
	* Return true if service content is active
	*
	* @since 1.0
	*/
	function catch_shop_is_service_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_shop_service_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( catch_shop_is_ect_services_active( $control ) && catch_shop_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'catch_shop_is_ect_services_inactive' ) ) :
    /**
    * Return true if service is active
    *
    * @since Catch Shop 1.0
    */
    function catch_shop_is_ect_services_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

if ( ! function_exists( 'catch_shop_is_ect_services_active' ) ) :
    /**
    * Return true if service is active
    *
    * @since Catch Shop 1.0
    */
    function catch_shop_is_ect_services_active( $control ) {
        return ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;
