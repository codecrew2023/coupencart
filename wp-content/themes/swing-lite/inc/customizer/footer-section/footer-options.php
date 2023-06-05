<?php
/* Bottom Footer settings options */
$wp_customize->add_section( 'swing-buttom-footer-section', array(
    'priority'       => 35,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'Footer Settings', 'swing-lite' )
) );

/* Footer Copyright show/hide  */
$wp_customize->add_setting( 'swing_lite_footer_cp_show_hide', array( 'default' => 'show', 'sanitize_callback' => 'swing_lite_sanitize_switch_option', ) );
$wp_customize->add_control( new swing_lite_Customize_Switch_Control( $wp_customize, 'swing_lite_footer_cp_show_hide',  array(
    'type'      => 'switch',                    
    'label'     => esc_html__( 'Footer Copyright show/hide', 'swing-lite' ),
    'description'   => esc_html__( 'Show/Hide Footer Copyright', 'swing-lite' ),
    'section'   => 'swing-buttom-footer-section',
    'choices'   => array(
        'show'  => esc_html__( 'Show', 'swing-lite' ),
        'hide'  => esc_html__( 'Hide', 'swing-lite' )
        )
        
    ) ) );
    
// Footer Top Text
$wp_customize->add_setting('swing_lite_footer_top_text', array( 'sanitize_callback' => 'swing_lite_text_sanitize', 'default' => ''));

$wp_customize->add_control('swing_lite_footer_top_text', array(
    'type' => 'text',
    'label' => esc_html__('Footer Top Text', 'swing-lite'),
    'description' => esc_html__( 'Set the top footer text', 'swing-lite' ),
    'section' => 'swing-buttom-footer-section',
    'settings' => 'swing_lite_footer_top_text'
)); 

// Footer Bototm Text
$wp_customize->add_setting('swing_lite_footer_bottom_text', array( 'default' => '', 'sanitize_callback' => 'swing_lite_text_sanitize' ));
$wp_customize->add_control('swing_lite_footer_bottom_text', array(
    'type' => 'text',
    'label' => esc_html__('Footer Bottom Text', 'swing-lite'),
    'description' => esc_html__( 'Set the bottom footer text', 'swing-lite' ),
    'section' => 'swing-buttom-footer-section',
    'settings' => 'swing_lite_footer_bottom_text'
)); 