<?php

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * Global hooks
 *
 * @see  cartsy_lite_site_loaded()
 */
add_action('wp_body_open', 'cartsy_lite_site_loaded', 10);

/**
 * General
 *
 * @see  cartsy_lite_get_sidebar()
 * 
 */
add_action('cartsy_lite_sidebar', 'cartsy_lite_get_sidebar', 10);
add_action('cartsy_lite_post_loop_after', 'cartsy_lite_paging_nav');

/**
 * Header
 *
 * @see  cartsy_lite_header_wrapper()
 * @see  cartsy_lite_skip_links()
 * @see  cartsy_lite_header_menu()
 * @see  cartsy_lite_site_branding()
 * @see  cartsy_lite_header_search()
 * @see  cartsy_lite_woo_link()
 * @see  cartsy_lite_header_wrapper_close()
 * 
 */
add_action('cartsy_lite_header', 'cartsy_lite_header_wrapper', 0);
add_action('cartsy_lite_header', 'cartsy_lite_skip_links', 5);
add_action('cartsy_lite_header', 'cartsy_lite_header_menu', 10);
add_action('cartsy_lite_header', 'cartsy_lite_site_branding', 15);
add_action('cartsy_lite_header', 'cartsy_lite_woo_link', 25);
add_action('cartsy_lite_header', 'cartsy_lite_header_wrapper_close', 30);
add_action('cartsy_lite_header', 'cartsy_lite_header_horizontal_menu', 18);

/**
 * Before content
 *
 * @see  template-functions.php
 * @see cartsy_lite_banner()
 */
add_action('cartsy_lite_before_content', 'cartsy_lite_banner', 5);

/**
 * Page
 *
 * @see  cartsy_lite_page_header()
 * @see  cartsy_lite_page_content()
 * 
 */
add_action('cartsy_lite_page', 'cartsy_lite_page_header', 10);
add_action('cartsy_lite_page', 'cartsy_lite_page_content', 20);
add_action('cartsy_lite_page', 'cartsy_lite_edit_post_link', 30);
add_action('cartsy_lite_page_after', 'cartsy_lite_display_comments', 10);


/**
 * Footer
 *
 * @see  cartsy_footer_copyright()
 * @see  cartsy_footer_social()
 * 
 */
add_action('cartsy_lite_footer', 'cartsy_footer_copyright', 5);
add_action('cartsy_lite_footer', 'cartsy_footer_social', 10);


add_filter( 'woocommerce_add_to_cart_fragments', 'cartsy_lite_cart_link_fragment');

/**
 * cartsy_lite_homepage
 *
 * @see  cartsy_lite_homepage_banner_content()
 * @see  cartsy_lite_woo_products_content()
 * 
 */
add_action( 'cartsy_lite_homepage', 'cartsy_lite_homepage_banner_content', 10 );
add_action( 'cartsy_lite_homepage', 'cartsy_lite_woo_products_content', 20 );

/**
 * cartsy_lite_homepage_sidebar
 *
 * @see  cartsy_lite_woo_homepage_sidebar_content()
 * 
 */
add_action( 'cartsy_lite_homepage_sidebar', 'cartsy_lite_woo_homepage_sidebar_content', 10 );