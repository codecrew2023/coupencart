<?php
/*
 * This is the child theme for Catch Shop Dark theme.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
function catch_shop_dark_enqueue_styles() {
    // Include parent theme CSS.
    wp_enqueue_style( 'catch-shop-style', get_template_directory_uri() . '/style.css', null, date( 'Ymd-Gis', filemtime( get_template_directory() . '/style.css' ) ) );
    
    // Include child theme CSS.
    wp_enqueue_style( 'catch-shop-dark-style', get_stylesheet_directory_uri() . '/style.css', array( 'catch-shop-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/style.css' ) ) );

	// Load the rtl.
	if ( is_rtl() ) {
		wp_enqueue_style( 'catch-shop-rtl', get_template_directory_uri() . '/rtl.css', array( 'catch-shop-style' ), $version );
	}

	// Enqueue child block styles after parent block style.
	wp_enqueue_style( 'catch-shop-dark-block-style', get_stylesheet_directory_uri() . '/assets/css/child-blocks.css', array( 'catch-shop-block-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/assets/css/child-blocks.css' ) ) );
}
add_action( 'wp_enqueue_scripts', 'catch_shop_dark_enqueue_styles' );

/**
 * Add child theme editor styles
 */
function catch_shop_dark_editor_style() {
	add_editor_style( array(
			'assets/css/child-editor-style.css',
			catch_shop_fonts_url(),
			get_theme_file_uri( 'assets/css/font-awesome/css/font-awesome.css' ),
		)
	);
}
add_action( 'after_setup_theme', 'catch_shop_dark_editor_style', 11 );

/**
 * Enqueue editor styles for Gutenberg
 */
function catch_shop_dark_block_editor_styles() {
	// Enqueue child block editor style after parent editor block css.
	wp_enqueue_style( 'catch-shop-dark-block-editor-style', get_stylesheet_directory_uri() . '/assets/css/child-editor-blocks.css', array( 'catch-shop-block-editor-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/assets/css/child-editor-blocks.css' ) ) );
}
add_action( 'enqueue_block_editor_assets', 'catch_shop_dark_block_editor_styles', 11 );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function catch_shop_dark_body_classes( $classes ) {
	// Added color scheme to body class.
	$classes['color-scheme'] = 'color-scheme-dark';

	return $classes;
}
add_filter( 'body_class', 'catch_shop_dark_body_classes', 100 );

/**
 * Change default background color
 */
function catch_shop_dark_background_default_color( $args ) {
    $args['default-color'] = '#000000';

    return $args;
}
add_filter( 'catch_shop_custom_bg_args', 'catch_shop_dark_background_default_color' );

/**
 * Change default header text color
 */
function catch_shop_dark_dark_header_default_color( $args ) {
	$args['default-image'] =  get_theme_file_uri( 'assets/images/header-image.jpg' );
	$args['default-text-color'] = '#ffffff';

	return $args;
}
add_filter( 'catch_shop_custom_header_args', 'catch_shop_dark_dark_header_default_color' );

/**
 * Override parent to add promotion headline section
 */
function catch_shop_sections() {
	get_template_part( 'template-parts/header/header-media' );
	get_template_part( 'template-parts/slider/display-slider' );
	get_template_part( 'template-parts/logo-slider/display-logo-slider' );
	get_template_part( 'template-parts/woo-products/featured-products' );
	get_template_part( 'template-parts/promotion-headline/content-promotion' );
	get_template_part( 'template-parts/testimonial/display-testimonial' );
}

/**
 * Load Customizer Options
 */
require trailingslashit( get_stylesheet_directory() ) . 'inc/customizer/service.php';
