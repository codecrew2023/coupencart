<?php
/**
 * Theme functions and definitions
 *
 * @package Shopkeeper Ecommerce
 */ 

if ( ! function_exists( 'shopkeeper_ecommerce_enqueue_styles' ) ) :
	/**
	 * Load assets.
	 *
	 * @since 1.0.0
	 */
	function shopkeeper_ecommerce_enqueue_styles() {
		wp_enqueue_style( 'modern-ecommerce-style-parent', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'shopkeeper-ecommerce-style', get_stylesheet_directory_uri() . '/style.css', array( 'modern-ecommerce-style-parent' ), '1.0.0' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'shopkeeper_ecommerce_enqueue_styles', 99 );

function shopkeeper_ecommerce_setup() {
	add_theme_support( 'align-wide' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( "wp-block-styles" );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support('custom-background',array(
		'default-color' => 'ffffff',
	));
	add_image_size( 'shopkeeper-ecommerce-featured-image', 2000, 1200, true );
	add_image_size( 'shopkeeper-ecommerce-thumbnail-avatar', 100, 100, true );

	$GLOBALS['content_width'] = 525;
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'shopkeeper-ecommerce' ),
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	/*
	* This theme styles the visual editor to resemble the theme style,
	* specifically font, colors, and column width.
	*/
	add_editor_style( array( 'assets/css/editor-style.css', modern_ecommerce_fonts_url() ) );
}
add_action( 'after_setup_theme', 'shopkeeper_ecommerce_setup' );

function shopkeeper_ecommerce_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'shopkeeper-ecommerce' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'shopkeeper-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'shopkeeper-ecommerce' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'shopkeeper-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'shopkeeper-ecommerce' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'shopkeeper-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'shopkeeper-ecommerce' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'shopkeeper-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'shopkeeper-ecommerce' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'shopkeeper-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'shopkeeper-ecommerce' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'shopkeeper-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'shopkeeper_ecommerce_widgets_init' );

function shopkeeper_ecommerce_remove_my_action() {
    remove_action( 'admin_menu','modern_ecommerce_gettingstarted' );
    remove_action( 'after_setup_theme','modern_ecommerce_notice' );
}
add_action( 'init', 'shopkeeper_ecommerce_remove_my_action');

function shopkeeper_ecommerce_customize_register() {
  	global $wp_customize;

  	$wp_customize->remove_section( 'modern_ecommerce_pro' );
}
add_action( 'customize_register', 'shopkeeper_ecommerce_customize_register', 11 );

function shopkeeper_ecommerce_customize( $wp_customize ) {

	wp_enqueue_style('customizercustom_css', esc_url( get_stylesheet_directory_uri() ). '/assets/css/customizer.css');

	$wp_customize->add_section('shopkeeper_ecommerce_pro', array(
		'title'    => __('UPGRADE SHOPKEEPER PREMIUM', 'shopkeeper-ecommerce'),
		'priority' => 1,
	));

	$wp_customize->add_setting('shopkeeper_ecommerce_pro', array(
		'default'           => null,
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control(new Shopkeeper_Ecommerce_Pro_Control($wp_customize, 'shopkeeper_ecommerce_pro', array(
		'label'    => __('SHOPKEEPER ECOMMERCE PREMIUM', 'shopkeeper-ecommerce'),
		'section'  => 'shopkeeper_ecommerce_pro',
		'settings' => 'shopkeeper_ecommerce_pro',
		'priority' => 1,
	)));

	// Featured Category Section
	$wp_customize->add_section( 'shopkeeper_ecommerce_featured_cat_section' , array(
    	'title'      => __( 'Featured Category Section Settings', 'shopkeeper-ecommerce' ),    	
		'priority'   => 6,
	) );

	$wp_customize->add_setting('shopkeeper_ecommerce_featured_cat_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('shopkeeper_ecommerce_featured_cat_title',array(
		'label'	=> esc_html__('Section Title ','shopkeeper-ecommerce'),
		'section'	=> 'shopkeeper_ecommerce_featured_cat_section',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('shopkeeper_ecommerce_featured_cat_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('shopkeeper_ecommerce_featured_cat_text',array(
		'label'	=> esc_html__('Section Text','shopkeeper-ecommerce'),
		'section'	=> 'shopkeeper_ecommerce_featured_cat_section',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('shopkeeper_ecommerce_featured_cat_increament',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('shopkeeper_ecommerce_featured_cat_increament',array(
		'label'	=> esc_html__('Featured Category Increament','shopkeeper-ecommerce'),
		'section'	=> 'shopkeeper_ecommerce_featured_cat_section',
		'type'		=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 6,
		),
	));

	$volunteer = get_theme_mod('shopkeeper_ecommerce_featured_cat_increament');
	for ($i=1; $i <= $volunteer ; $i++) {

		$wp_customize->add_setting('shopkeeper_ecommerce_featured_cat_box_image'.$i, array(
			'default' => '',
			'sanitize_callback'	=> 'esc_url_raw',
			'capability' => 'edit_theme_options',
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'shopkeeper_ecommerce_featured_cat_box_image'.$i, array(
			'label' => __( 'Featured Category Image ', 'shopkeeper-ecommerce' ).$i,
			'section' => 'shopkeeper_ecommerce_featured_cat_section',
			'settings' => 'shopkeeper_ecommerce_featured_cat_box_image'.$i,
		)));

		$wp_customize->add_setting('shopkeeper_ecommerce_featured_cat_box_title'.$i,array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
		));	
		$wp_customize->add_control('shopkeeper_ecommerce_featured_cat_box_title'.$i,array(
			'label'	=> esc_html__('Title ','shopkeeper-ecommerce').$i,
			'section'	=> 'shopkeeper_ecommerce_featured_cat_section',
			'type'		=> 'text'
		));

		$wp_customize->add_setting('shopkeeper_ecommerce_featured_cat_box_title_link'.$i,array(
			'default'	=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
		));	
		$wp_customize->add_control('shopkeeper_ecommerce_featured_cat_box_title_link'.$i,array(
			'label'	=> esc_html__('URL ','shopkeeper-ecommerce').$i,
			'section'	=> 'shopkeeper_ecommerce_featured_cat_section',
			'type'		=> 'text'
		));
	}
}
add_action( 'customize_register', 'shopkeeper_ecommerce_customize' );

function shopkeeper_ecommerce_enqueue_comments_reply() {
  if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
    // Load comment-reply.js (into footer)
    wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );
  }
}
add_action(  'wp_enqueue_scripts', 'shopkeeper_ecommerce_enqueue_comments_reply' );

define('SHOPKEEPER_ECOMMERCE_PRO_LINK',__('https://www.ovationthemes.com/wordpress/shopkeeper-wordpress-theme/','shopkeeper-ecommerce'));

/* Pro control */
if (class_exists('WP_Customize_Control') && !class_exists('Shopkeeper_Ecommerce_Pro_Control')):
    class Shopkeeper_Ecommerce_Pro_Control extends WP_Customize_Control{

    public function render_content(){?>
        <label style="overflow: hidden; zoom: 1;">
            <div class="col-md upsell-btn">
                <a href="<?php echo esc_url( SHOPKEEPER_ECOMMERCE_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE SHOPKEEPER PREMIUM','shopkeeper-ecommerce');?> </a>
            </div>
            <div class="col-md">
                <img class="shopkeeper_ecommerce_img_responsive " src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/screenshot.png">
            </div>
            <div class="col-md">
                <h3 style="margin-top:10px; margin-left: 20px; text-decoration:underline; color:#333;"><?php esc_html_e('SHOPKEEPER PREMIUM - Features', 'shopkeeper-ecommerce'); ?></h3>
                <ul style="padding-top:10px">
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Boxed or fullwidth layout', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Shortcode Support', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Designed with HTML5 and CSS3', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Customizable Design & Code', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Stylish Custom Widgets', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Patterns Background', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Live Customizer', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('AMP Ready', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Clean Code', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'shopkeeper-ecommerce');?> </li>
                    <li class="upsell-shopkeeper_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'shopkeeper-ecommerce');?> </li>                    
                </ul>
            </div>
            <div class="col-md upsell-btn upsell-btn-bottom">
                <a href="<?php echo esc_url( SHOPKEEPER_ECOMMERCE_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE SHOPKEEPER PREMIUM','shopkeeper-ecommerce');?> </a>
            </div>
        </label>
    <?php } }
endif;
