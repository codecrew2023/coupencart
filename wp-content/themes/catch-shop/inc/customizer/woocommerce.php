<?php
/**
 * Adding support for WooCommerce Plugin
 */

/**
 * Query WooCommerce activation
 */
if ( ! function_exists( 'catch_shop_is_woocommerce_activated' ) ) {
    function catch_shop_is_woocommerce_activated() {
        return class_exists( 'WooCommerce' ) ? true : false;
    }
}

if ( ! class_exists( 'WooCommerce' ) ) {
    // Bail if WooCommerce is not installed
    return;
}

if ( ! function_exists( 'catch_shop_woocommerce_setup' ) ) :
    /**
     * Sets up support for various WooCommerce features.
     */
    function catch_shop_woocommerce_setup() {
        add_theme_support( 'woocommerce', array(
            'thumbnail_image_width'         => 480,
            'single_image_width'            => 580,
            'gallery_thumbnail_image_width' => 120,
        ) );

        if ( get_theme_mod( 'catch_shop_product_gallery_zoom', 1 ) ) {
            add_theme_support('wc-product-gallery-zoom');
        }

        if ( get_theme_mod( 'catch_shop_product_gallery_lightbox', 1 ) ) {
            add_theme_support('wc-product-gallery-lightbox');
        }

        if ( get_theme_mod( 'catch_shop_product_gallery_slider', 1 ) ) {
            add_theme_support('wc-product-gallery-slider');
        }
    }
endif; //catch_shop_woocommerce_setup
add_action( 'after_setup_theme', 'catch_shop_woocommerce_setup' );

/**
 * Add WooCommerce Options to customizer
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_shop_woocommerce_options( $wp_customize ) {
    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_shop_subtitle',
            'sanitize_callback' => 'wp_kses_post',
            'label'             => esc_html__( 'Shop Page Subtitle', 'catch-shop' ),
            'default'           => esc_html__( 'This is where you can add new products to your store.', 'catch-shop' ),
            'section'           => 'catch_shop_woocommerce_options',
            'type'              => 'textarea',
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_woocommerce_layout',
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'catch_shop_sanitize_select',
            'description'       => esc_html__( 'Layout for WooCommerce Pages', 'catch-shop' ),
            'label'             => esc_html__( 'WooCommerce Layout', 'catch-shop' ),
            'section'           => 'catch_shop_layout_options',
            'type'              => 'radio',
            'choices'           => array(
                'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'catch-shop' ),
                'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'catch-shop' ),
            ),
        )
    );

    // WooCommerce Options
    $wp_customize->add_section( 'catch_shop_woocommerce_options', array(
        'title'       => esc_html__( 'WooCommerce Options', 'catch-shop' ),
        'panel'       => 'catch_shop_theme_options',
        'description' => esc_html__( 'Since these options are added via theme support, you will need to save and refresh the customizer to view the full effect.', 'catch-shop' ),
    ) );

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_product_gallery_zoom',
            'default'           => 1,
            'sanitize_callback' => 'catch_shop_sanitize_checkbox',
            'label'             => esc_html__( 'Product Gallery Zoom', 'catch-shop' ),
            'section'           => 'catch_shop_woocommerce_options',
            'custom_control'    => 'Catch_Shop_Toggle_Control',
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_product_gallery_lightbox',
            'default'           => 1,
            'sanitize_callback' => 'catch_shop_sanitize_checkbox',
            'label'             => esc_html__( 'Product Gallery Lightbox', 'catch-shop' ),
            'section'           => 'catch_shop_woocommerce_options',
            'custom_control'    => 'Catch_Shop_Toggle_Control',
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'              => 'catch_shop_product_gallery_slider',
            'default'           => 1,
            'sanitize_callback' => 'catch_shop_sanitize_checkbox',
            'label'             => esc_html__( 'Product Gallery Slider', 'catch-shop' ),
            'section'           => 'catch_shop_woocommerce_options',
            'custom_control'    => 'Catch_Shop_Toggle_Control',
        )
    );

    catch_shop_register_option( $wp_customize, array(
            'name'               => 'catch_shop_shop_page_header_image',
            'sanitize_callback'  => 'catch_shop_sanitize_checkbox',
            'label'              => esc_html__( 'Header Image on Single Product page', 'catch-shop' ),
            'section'            => 'header_image',
            'custom_control'    => 'Catch_Shop_Toggle_Control',
        )
    );
}
add_action( 'customize_register', 'catch_shop_woocommerce_options' );

/**
 * uses remove_action to remove the WooCommerce Wrapper and add_action to add Main Wrapper
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'catch_shop_woocommerce_start' ) ) :
    function catch_shop_woocommerce_start() {
    	echo '<div id="primary" class="content-area"><main role="main" class="site-main woocommerce" id="main"><div class="woocommerce-posts-wrapper">';
    }
endif; //catch_shop_woocommerce_start
add_action( 'woocommerce_before_main_content', 'catch_shop_woocommerce_start', 15 );

if ( ! function_exists( 'catch_shop_woocommerce_end' ) ) :
    function catch_shop_woocommerce_end() {
    	echo '</div><!-- .woocommerce-posts-wrapper --></main><!-- #main --></div><!-- #primary -->';
    }
endif; //catch_shop_woocommerce_end
add_action( 'woocommerce_after_main_content', 'catch_shop_woocommerce_end', 15 );

function catch_shop_woocommerce_shorting_start() {
	echo '<div class="woocommerce-shorting-wrapper">';
}
add_action( 'woocommerce_before_shop_loop', 'catch_shop_woocommerce_shorting_start', 10 );

function catch_shop_woocommerce_shorting_end() {
	echo '</div><!-- .woocommerce-shorting-wrapper -->';
}
add_action( 'woocommerce_before_shop_loop', 'catch_shop_woocommerce_shorting_end', 40 );

function catch_shop_woocommerce_product_container_start() {
	echo '<div class="product-container">';
}
add_action( 'woocommerce_before_shop_loop_item_title', 'catch_shop_woocommerce_product_container_start', 20 );

function catch_shop_woocommerce_product_container_end() {
	echo '</div><!-- .product-container -->';
}
add_action( 'woocommerce_after_shop_loop_item', 'catch_shop_woocommerce_product_container_end', 20 );

if ( ! function_exists( 'catch_shop_my_account_icon_link' ) ) {
    /**
     * The account callback function
     */
    function catch_shop_my_account_icon_link( $label ) {

        $label_html = '';

        $label_title = esc_html__( 'My Account', 'catch-shop' );

        if ( $label ) {
            $label_html = '<span class="my-account-label">' . esc_html( $label ) . '</span>';
            $label_title = $label;
        }
        echo '<a class="my-account" href="' . esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . '" title="' . esc_attr( $label_title ) . '">' . catch_shop_get_svg( array( 'icon' => 'user' ) ) .  $label_html . '</a>';
    }
}

if ( ! function_exists( 'catch_shop_cart_link' ) ) {
    /**
     * Cart Link
     * Displayed a link to the cart including the number of items present and the cart total
     *
     * @return void
     * @since  1.0.0
     */
    function catch_shop_cart_link( $items = true, $amount = true ) {
        ?>
            <a class="site-cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'catch-shop' ); ?>">
                <div class="cart-count">
                    <?php echo catch_shop_get_svg( array( 'icon' => 'shopping-bag' ) ); ?>
                    <?php if ( $items ) : ?>
                    <?php /* translators: number of items in the mini cart. */ ?>
                    <span class="count"><?php echo absint( WC()->cart->get_cart_contents_count() );?></span>
                    <?php endif; ?>
                </div>

                <?php if ( $items && $amount ) : ?>
                <span class="sep"> / </span>
                <?php endif; ?>

                <?php if ( $amount ) : ?>
                <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span>
                <?php endif; ?>
            </a>
        <?php
    }
}

if ( ! function_exists( 'catch_shop_header_right_cart_account' ) ) {
    /**
     * Displays header right cart and my accounnt link
     *
     * @return void
     * @since  1.0.0
     */
    function catch_shop_header_right_cart_account() {
        if ( ! catch_shop_is_woocommerce_activated() ) {
            // Bail if WooCommerce is not activated.
            return;
        }

        $cart               = get_theme_mod( 'catch_shop_header_right_cart_enable', 1 );
        $my_account         = get_theme_mod( 'catch_shop_header_right_my_account_enable' );
        $my_account_label   = get_theme_mod( 'catch_shop_header_right_my_account_label_enable' );

        if ( $cart || $my_account ) :
            if ( is_cart() ) {
                $cartclass = 'menu-inline site-cart current-menu-item';
            } else {
                $cartclass = 'menu-inline site-cart';
            }

            //account class
            if ( is_account_page() ) {
                $accountclass = 'secondary-account-wrapper menu-inline current-menu-item';
            } else {
                $accountclass = 'secondary-account-wrapper menu-inline';
            }
        ?>
        <div id="site-header-secondary-cart-wrapper" class="site-header-cart-wrapper">
            <?php if ( $my_account ) : ?>
            <div class="<?php echo esc_attr( $accountclass ); ?>">
                <?php  if ( $my_account_label ) :
                    catch_shop_my_account_icon_link( get_theme_mod( 'catch_shop_header_right_my_account_label', esc_html__( 'My Account', 'catch-shop' ) ) ); 
                else:
                    catch_shop_my_account_icon_link( '' ); 
                endif; ?>
            </div>
            <?php endif; ?>

            <?php if ( $cart ) : ?>

            <ul class="site-header-cart menu">
                <li class="<?php echo esc_attr( $cartclass ); ?>">
                    <?php catch_shop_cart_link( get_theme_mod( 'catch_shop_header_right_cart_items_enable' ), get_theme_mod( 'catch_shop_header_right_cart_amount_enable' ) ); ?>

                        <ul id="site-cart-contents-items" class="site-cart-contents-items">
                            <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                        </ul>
                    </li>
            </ul>
            <?php endif; ?>
        </div><!-- .site-header-cart-wrapper -->
        <?php endif;
    }
}

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function catch_shop_woocommerce_active_body_class( $classes ) {
    $classes[] = 'woocommerce-active';

    return $classes;
}
add_filter( 'body_class', 'catch_shop_woocommerce_active_body_class' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function catch_shop_woocommerce_scripts() {
    $font_path   = WC()->plugin_url() . '/assets/fonts/';
    $inline_font = '@font-face {
            font-family: "star";
            src: url("' . $font_path . 'star.eot");
            src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
                url("' . $font_path . 'star.woff") format("woff"),
                url("' . $font_path . 'star.ttf") format("truetype"),
                url("' . $font_path . 'star.svg#star") format("svg");
            font-weight: normal;
            font-style: normal;
        }';

    wp_add_inline_style( 'catch-shop-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'catch_shop_woocommerce_scripts' );

if ( ! function_exists( 'catch_shop_woocommerce_product_columns_wrapper' ) ) {
    /**
     * Product columns wrapper.
     *
     * @return  void
     */
    function catch_shop_woocommerce_product_columns_wrapper() {
        // Get option from Customizer=> WooCommerce=> Product Catlog=> Products per row.
        echo '<div class="wocommerce-section-content-wrapper columns-' . absint( get_option( 'woocommerce_catalog_columns', 4 ) ) . '">';
    }
}
add_action( 'woocommerce_before_shop_loop', 'catch_shop_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'catch_shop_woocommerce_product_columns_wrapper_close' ) ) {
    /**
     * Product columns wrapper close.
     *
     * @return  void
     */
    function catch_shop_woocommerce_product_columns_wrapper_close() {
        echo '</div>';
    }
}
add_action( 'woocommerce_after_shop_loop', 'catch_shop_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Make Shop Page Title dynamic
 */
function catch_shop_woocommerce_shop_subtitle( $args ) {
    if ( is_shop() ) {
        return wp_kses_post( get_theme_mod( 'catch_shop_shop_subtitle', esc_html__( 'This is where you can add new products to your store.', 'catch-shop' ) ) );
    }

    return $args;
}
add_filter( 'get_the_archive_description', 'catch_shop_woocommerce_shop_subtitle', 20 );

/**
* woo_hide_page_title
*
* Removes the "shop" title on the main shop page
*
* @access      public
* @since       1.0
* @return      void
*/
 
function catch_shop_woocommerce_hide_page_title() { 
    if ( is_shop() && catch_shop_has_header_media_text() ) {
        return false;
    }

    return true;  
}
add_filter( 'woocommerce_show_page_title', 'catch_shop_woocommerce_hide_page_title' ); 

if ( ! function_exists( 'catch_shop_remove_default_woo_store_notice' ) ) {
    /**
     * Remove default Store Notice from footer, added in header.php
     *
     * @return  void
     */
    function catch_shop_remove_default_woo_store_notice() {
        remove_action( 'wp_footer', 'woocommerce_demo_store' );
    }
}
add_action( 'after_setup_theme', 'catch_shop_remove_default_woo_store_notice', 40 );

/**
 * Include Woo Featured Products
 */
require get_parent_theme_file_path( 'inc/customizer/woo-products-featured.php' );
