<?php
/**
 * Catch Shop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Catch_Shop
 */

if ( ! function_exists( 'catch_shop_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function catch_shop_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Catch Shop, use a find and replace
		 * to change 'catch-shop' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'catch-shop', get_parent_theme_file_path( '/languages' ) );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
		 *
		 * Google fonts url addition
		 *
		 * Font Awesome addition
		 */
		add_editor_style( array(
			'assets/css/editor-style.css',
			catch_shop_fonts_url()
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Used in Portfolio
		set_post_thumbnail_size( 666, 666, true ); // Ratio 1:1

		// Used in Archive: Excerpt image
		add_image_size( 'catch-shop-archive', 1920, 9999, true ); // Flexible Height

		// Used in Archive: Excerpt image
		add_image_size( 'catch-shop-content', 666, 488, true ); // 15:11

		// Used in featured slider
		add_image_size( 'catch-shop-slider', 1920, 822, true ); // Ratio 21:9

		// Used in testimonials
		add_image_size( 'catch-shop-testimonial', 720, 720, true ); // Ratio 1:1

		// Used in team and service
		add_image_size( 'catch-shop-team', 1160, 670, true ); // Ratio 16:10

		// Used in logo slider and Stats Section
		add_image_size( 'catch-shop-logo-slider', 146, 82, true ); // Ratio 16:9

		// Used in Stats Section
		add_image_size( 'catch-shop-stats', 50, 33, true ); // Ratio 3:2

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1'             => esc_html__( 'Primary', 'catch-shop' ),
			'social-header-left' => esc_html__( 'Header Social Left Menu', 'catch-shop' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Add support for essential widget image.
		 *
		 */
		add_theme_support( 'ew-newsletter-image' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Small', 'catch-shop' ),
					'shortName' => esc_html__( 'S', 'catch-shop' ),
					'size'      => 13,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'catch-shop' ),
					'shortName' => esc_html__( 'M', 'catch-shop' ),
					'size'      => 18,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'catch-shop' ),
					'shortName' => esc_html__( 'L', 'catch-shop' ),
					'size'      => 42,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'catch-shop' ),
					'shortName' => esc_html__( 'XL', 'catch-shop' ),
					'size'      => 56,
					'slug'      => 'huge',
				),
			)
		);

		// Add support for custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'White', 'catch-shop' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html__( 'Black', 'catch-shop' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
			array(
				'name'  => esc_html__( 'Eighty Black', 'catch-shop' ),
				'slug'  => 'eighty-black',
				'color' => '#151515',
			),
			array(
				'name'  => esc_html__( 'Sixty Five Black', 'catch-shop' ),
				'slug'  => 'sixty-five-black',
				'color' => '#151515',
			),
			array(
				'name'  => esc_html__( 'Gray', 'catch-shop' ),
				'slug'  => 'gray',
				'color' => '#444444',
			),
			array(
				'name'  => esc_html__( 'Medium Gray', 'catch-shop' ),
				'slug'  => 'medium-gray',
				'color' => '#7b7b7b',
			),
			array(
				'name'  => esc_html__( 'Light Gray', 'catch-shop' ),
				'slug'  => 'light-gray',
				'color' => '#f8f8f8',
			),
			array(
				'name'  => esc_html__( 'Dark Yellow', 'catch-shop' ),
				'slug'  => 'dark-yellow',
				'color' => '#ffa751',
			),
			array(
				'name'  => esc_html__( 'Yellow', 'catch-shop' ),
				'slug'  => 'yellow',
				'color' => '#f9a926',
			),
		) );

		/**
		 * Adds support for Catch Breadcrumb.
		 */
		add_theme_support( 'catch-breadcrumb', array(
			'content_selector' => '.site-content .wrapper .content-area',
			'breadcrumb_dynamic' => 'before',
		) );
	}
endif;
add_action( 'after_setup_theme', 'catch_shop_setup' );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 */
function catch_shop_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$count++;
	}

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class ) {
		echo 'class="widget-area footer-widget-area ' . esc_attr( $class ) . '"';
	}
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function catch_shop_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'catch_shop_content_width', 920 );
}
add_action( 'after_setup_theme', 'catch_shop_content_width', 0 );

if ( ! function_exists( 'catch_shop_template_redirect' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet for different value other than the default one
	 *
	 * @global int $content_width
	 */
	function catch_shop_template_redirect() {
		$layout = catch_shop_get_theme_layout();

		if ( 'no-sidebar-full-width' === $layout ) {
			$GLOBALS['content_width'] = 1510;
		}
	}
endif;
add_action( 'template_redirect', 'catch_shop_template_redirect' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function catch_shop_widgets_init() {
	$args = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s"> <div class="widget-wrap">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Sidebar', 'catch-shop' ),
		'id'          => 'sidebar-1',
		'description' => esc_html__( 'Add widgets here.', 'catch-shop' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 1', 'catch-shop' ),
		'id'          => 'sidebar-2',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'catch-shop' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 2', 'catch-shop' ),
		'id'          => 'sidebar-3',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'catch-shop' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 3', 'catch-shop' ),
		'id'          => 'sidebar-4',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'catch-shop' ),
		) + $args
	);

	if ( class_exists( 'Catch_Instagram_Feed_Gallery_Widget' ) ||  class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
		register_sidebar( array(
			'name'        => esc_html__( 'Instagram', 'catch-shop' ),
			'id'          => 'sidebar-instagram',
			'description' => esc_html__( 'Appears above footer. This sidebar is only for Widget from plugin Catch Instagram Feed Gallery Widget and Catch Instagram Feed Gallery Widget Pro', 'catch-shop' ),
			) + $args
		);
	}

	if ( class_exists( 'WooCommerce' ) ) {
		//Optional Primary Sidebar for Shop
		register_sidebar( array(
			'name'        => esc_html__( 'WooCommerce Sidebar', 'catch-shop' ),
			'id'          => 'sidebar-woo',
			'description' => esc_html__( 'This is Optional Sidebar for WooCommerce Pages', 'catch-shop' ),
			) + $args
		);
	}

	//Optional Sidebar Six Footer Newsletter
	register_sidebar( array(
		'name'          => esc_html__( 'Newsletter', 'catch-shop' ),
		'id'            => 'sidebar-newsletter',
		'description'   => esc_html__( 'This is for Newsletter Template Widget Area.', 'catch-shop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">
		<div class="widget-wrap"><div class="widget-inner">',
		'after_widget'  => '</div></div></section>',
		'before_title'  => '<div class="section-title-wrapper"><h2 class="section-title">',
		'after_title'   => '</h2></div>'
	) );
}
add_action( 'widgets_init', 'catch_shop_widgets_init' );

if ( ! function_exists( 'catch_shop_fonts_url' ) ) :
	/**
	 * Register Google fonts for Catch Shop
	 *
	 * Create your own catch_shop_fonts_url() function to override in a child theme.
	 *
	 * @since 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function catch_shop_fonts_url() {
		$fonts_url = '';

		/* Translators: If there are characters in your language that are not
		* supported by Poppins, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$poppins = _x( 'on', 'Poppins: on or off', 'catch-shop' );

		/* Translators: If there are characters in your language that are not
		* supported by Oswald, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$oswald = _x( 'on', 'Oswald: on or off', 'catch-shop' );

		if ( 'off' !== $poppins || 'off' !== $oswald ) {
			$font_families = array();

			if ( 'off' !== $poppins ) {
			$font_families[] = 'Poppins:300,400,500,600,700,400italic,700italic';
			}

			if ( 'off' !== $oswald ) {
			$font_families[] = 'Oswald:300,400,500,600,700,400italic,700italic';
			}

			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}
		// Load google font locally.
		require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );
		return esc_url_raw( wptt_get_webfont_url( $fonts_url ) );
	}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since 1.0
 */
function catch_shop_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'catch_shop_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 */
function catch_shop_scripts() {
	$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	$path = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? 'assets/js/source/' : 'assets/js/';

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'catch-shop-fonts', catch_shop_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'catch-shop-style', get_stylesheet_uri(), null, date( 'Ymd-Gis', filemtime( get_template_directory() . '/style.css' ) ) );

	// Theme block stylesheet.
	wp_enqueue_style( 'catch-shop-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'catch-shop-style' ), date( 'Ymd-Gis', filemtime( get_template_directory() . '/assets/css/blocks.css' ) ) );

	// Load the html5 shiv.
	wp_enqueue_script( 'catch-shop-html5',  get_theme_file_uri() . '/' . $path . 'html5' . $min . '.js', array(), '3.7.3' );

	wp_enqueue_script( 'jquery-match-height', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'jquery.matchHeight' . $min . '.js', array( 'jquery' ), '201800703', true );

	$deps[] = 'jquery-match-height';

	wp_script_add_data( 'catch-shop-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'catch-shop-skip-link-focus-fix', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'skip-link-focus-fix' . $min . '.js', array(), '201800703', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$deps[] = 'jquery';

	//Slider Scripts
	$enable_slider             = catch_shop_check_section( get_theme_mod( 'catch_shop_slider_option', 'disabled' ) );
	$enable_logo_slider        = catch_shop_check_section( get_theme_mod( 'catch_shop_logo_slider_option', 'disabled' ) );

	if ( $enable_slider || $enable_logo_slider ) {
		// Enqueue owl carousel css. Must load CSS before JS.
		wp_enqueue_style( 'owl-carousel-core', get_theme_file_uri( 'assets/css/owl-carousel/owl.carousel.min.css' ), null, '2.3.4' );
		wp_enqueue_style( 'owl-carousel-default', get_theme_file_uri( 'assets/css/owl-carousel/owl.theme.default.min.css' ), null, '2.3.4' );

		// Enqueue script
		wp_enqueue_script( 'owl-carousel', get_theme_file_uri( $path . 'owl.carousel' . $min . '.js'), array( 'jquery' ), '2.3.4', true );

		$deps[] = 'owl-carousel';
	}

	// Add masonry to dependent scripts of main script.
	$deps[] = 'jquery-masonry';

	// Countdown Scripts.
	$enable_countdown = catch_shop_check_section( get_theme_mod( 'catch_shop_countdown_option', 'disabled' ) );

	if ( $enable_countdown ) {
		wp_register_script( 'jquery-countdown', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'jquery.countdown' . $min . '.js', array(), '2.2.0', true );
		$deps[] = 'jquery-countdown';
	}

	wp_enqueue_script( 'catch-shop-script', trailingslashit( esc_url ( get_template_directory_uri() ) ) . $path . 'functions' . $min . '.js', $deps, date( 'Ymd-Gis', filemtime( get_template_directory() . '/' . $path . 'functions' . $min . '.js' ) ), true );

	if ( $enable_countdown ) {
		// Add 10 Days to current Date.
		$default    = current_time( 'Y-m-d H:i:s' );
		$default_date = date( 'Y-m-d H:i:s', strtotime( $default . '+ 10 days') );

		$end_date = get_theme_mod( 'catch_shop_countdown_end_date', $default_date );

		wp_localize_script( 'catch-shop-script', 'catchShopCountdownEndDate', array( $end_date ) );
	}

	wp_localize_script( 'catch-shop-script', 'catchShopOptions', array(
		'screenReaderText' => array(
			'expand'   => esc_html__( 'expand child menu', 'catch-shop' ),
			'collapse' => esc_html__( 'collapse child menu', 'catch-shop' ),
			'icon'     => catch_shop_get_svg( array(
					'icon'     => 'angle-down',
					'fallback' => true,
				)
			),
		),
		'iconNavPrev'     => catch_shop_get_svg( array(
				'icon'     => 'angle-left',
				'fallback' => true,
			)
		),
		'iconNavNext'     => catch_shop_get_svg( array(
				'icon'     => 'angle-right',
				'fallback' => true,
			)
		),
		'rtl' => is_rtl(),
	) );
}
add_action( 'wp_enqueue_scripts', 'catch_shop_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 */
function catch_shop_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'catch-shop-block-editor-style', get_theme_file_uri( 'assets/css/editor-blocks.css' ) );

	// Add custom fonts.
	wp_enqueue_style( 'catch-shop-fonts', catch_shop_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'catch_shop_block_editor_styles' );

if ( ! function_exists( 'catch_shop_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since 1.0
	 */
	function catch_shop_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Customizer Options
		$length	= get_theme_mod( 'catch_shop_excerpt_length', 22 );

		return absint( $length );
	}
endif; //catch_shop_excerpt_length
add_filter( 'excerpt_length', 'catch_shop_excerpt_length', 999 );

if ( ! function_exists( 'catch_shop_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer
	 *
	 * @return string option from customizer prepended with an ellipsis.
	 */
	function catch_shop_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more_tag_text = get_theme_mod( 'catch_shop_excerpt_more_text',  esc_html__( 'Continue reading', 'catch-shop' ) );

		$link = sprintf( '<span class="more-button"><a href="%1$s" class="more-link more-icon">%2$s</a></span>',
			esc_url( get_permalink() ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);

		return $link;
	}
endif;
add_filter( 'excerpt_more', 'catch_shop_excerpt_more' );

if ( ! function_exists( 'catch_shop_custom_excerpt' ) ) :
	/**
	 * Adds Continue reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * @since 1.0
	 */
	function catch_shop_custom_excerpt( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$more_tag_text = get_theme_mod( 'catch_shop_excerpt_more_text', esc_html__( 'Continue reading', 'catch-shop' ) );

			$link = sprintf( '<span class="more-button"><a href="%1$s" class="more-link more-icon">%2$s</a></span>',
				esc_url( get_permalink() ),
				/* translators: %s: Name of current post */
				wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);

			$output = $link;
		}

		return $output;
	}
endif; //catch_shop_custom_excerpt
add_filter( 'get_the_excerpt', 'catch_shop_custom_excerpt' );

if ( ! function_exists( 'catch_shop_more_link' ) ) :
	/**
	 * Replacing Continue reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * @since 1.0
	 */
	function catch_shop_more_link( $more_link, $more_link_text ) {
		$more_tag_text = get_theme_mod( 'catch_shop_excerpt_more_text', esc_html__( 'Continue reading', 'catch-shop' ) );

		return ' &hellip; ' . str_replace( $more_link_text, wp_kses_data( $more_tag_text ), $more_link );
	}
endif; //catch_shop_more_link
add_filter( 'the_content_more_link', 'catch_shop_more_link', 10, 2 );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function catch_shop_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// WooCommerce.
		array(
			'name' => 'WooCommerce', // Plugin Name, translation not required.
			'slug' => 'woocommerce',
		),
		// Catch Web Tools.
		array(
			'name' => 'Catch Web Tools', // Plugin Name, translation not required.
			'slug' => 'catch-web-tools',
		),
		// To Top.
		array(
			'name' => 'To top', // Plugin Name, translation not required.
			'slug' => 'to-top',
		),
		// Catch Gallery.
		array(
			'name' => 'Catch Gallery', // Plugin Name, translation not required.
			'slug' => 'catch-gallery',
		),
	);

	if ( ! class_exists( 'Catch_Infinite_Scroll_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Infinite Scroll', // Plugin Name, translation not required.
			'slug' => 'catch-infinite-scroll',
		);
	}

	if ( ! class_exists( 'Essential_Content_Types_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Essential Content Types', // Plugin Name, translation not required.
			'slug' => 'essential-content-types',
		);
	}

	if ( ! class_exists( 'Essential_Widgets_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Essential Widgets', // Plugin Name, translation not required.
			'slug' => 'essential-widgets',
		);
	}

	if ( ! class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Instagram Feed Gallery & Widget', // Plugin Name, translation not required.
			'slug' => 'catch-instagram-feed-gallery-widget',
		);
	}

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'catch-shop',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'catch_shop_register_required_plugins' );

/**
 * Checks if there are options already present from free version and adds it to the Pro theme options
 *
 * @since 1.0
 * @hook after_theme_switch
 */
function catch_shop_setup_options( $old_theme_name ) {
	if ( $old_theme_name ) {
		$old_theme_slug = sanitize_title( $old_theme_name );
		$free_version_slug = array(
			'catch_shop',
		);

		$pro_version_slug  = 'catch-shop';

		$free_options = get_option( 'theme_mods_' . $old_theme_slug );

		// Perform action only if theme_mods_catch_shop free version exists.
		if ( in_array( $old_theme_slug, $free_version_slug ) && $free_options && '1' !== get_theme_mod( 'free_pro_migration' ) ) {
			$new_options = wp_parse_args( get_theme_mods(), $free_options );

			if ( update_option( 'theme_mods_' . $pro_version_slug, $free_options ) ) {
				// Set Migration Parameter to true so that this script does not run multiple times.
				set_theme_mod( 'free_pro_migration', '1' );
			}
		}
	}
}
add_action( 'after_switch_theme', 'catch_shop_setup_options' );

/**
 * Implement the Custom Header feature
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Icon Function
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Custom template tags for this theme
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Functions which enhance the theme by hooking into WordPress
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions
 */
require get_parent_theme_file_path( '/inc/customizer/customizer.php' );

/**
 * Color Scheme additions
 */
require get_parent_theme_file_path( '/inc/color-scheme.php' );

/**
 * Load Jetpack compatibility file
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_parent_theme_file_path( '/inc/jetpack.php' );
}

/**
 * Load Social Widgets
 */
require get_parent_theme_file_path( '/inc/widget-social-icons.php' );

/**
 * Load TGMPA
 */
require get_parent_theme_file_path( '/inc/class-tgm-plugin-activation.php' );

/**
 * Load Theme About Page
 */
require get_parent_theme_file_path( '/inc/about.php' );

/**
 * Load WooCommerce compatibility file.
 */
require get_parent_theme_file_path( 'inc/woocommerce.php' );
