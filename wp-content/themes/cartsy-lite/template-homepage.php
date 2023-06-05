<?php

/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `cartsy_lite_homepage` action.
 *
 * Template name: Homepage
 *
 * @package cartsylite
 */
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

$cartsy_lite_home_sidebar_position = "full_width";

if (class_exists('WooCommerce')) {
    $cartsy_lite_home_sidebar_position   = "left_side";

    if (function_exists('cartsy_lite_global_option_data')) {
        $cartsy_lite_home_sidebar_position       = cartsy_lite_global_option_data('cartsy_lite_home_sidebar_position', $cartsy_lite_home_sidebar_position);
    }
}

get_header();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="cartsylite-homepage-layout <?php echo esc_attr($cartsy_lite_home_sidebar_position === "full_width" ? "" : "cartsylite-home-with-sidebar cartsylite-layout-sidebar-position-" . $cartsy_lite_home_sidebar_position . "") ?>">
            <div class="cartsylite-layout-main">
                <?php if ($cartsy_lite_home_sidebar_position !== "full_width") { ?>
                    <button class="cartsylite-show-sidebar-category" aria-label="<?php echo esc_attr__("Category Button", 'cartsy-lite') ?>">
                        <?php echo esc_html__("Categories", "cartsy-lite"); ?>
                        <svg width="1em" height="1em" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.53033 0.96967C9.82322 1.26256 9.82322 1.73744 9.53033 2.03033L5.53033 6.03033C5.23744 6.32322 4.76256 6.32322 4.46967 6.03033L0.46967 2.03033C0.176777 1.73744 0.176777 1.26256 0.46967 0.96967C0.762563 0.676777 1.23744 0.676777 1.53033 0.96967L5 4.43934L8.46967 0.96967C8.76256 0.676777 9.23744 0.676777 9.53033 0.96967Z" fill="currentColor" />
                        </svg>
                    </button>
                <?php } ?>
                <?php
                /**
                 * Functions hooked in to cartsy_lite_homepage_sidebar action
                 *
                 */
                do_action('cartsy_lite_homepage_sidebar');
                ?>
                <?php
                /**
                 * Functions hooked in to cartsy_lite_homepage action
                 *
                 * @hooked cartsy_lite_homepage_banner_content     - 10
                 * @hooked cartsy_lite_woo_products_content    - 20
                 */
                do_action('cartsy_lite_homepage');

                /**
                 * Functions hooked in to cartsy_lite_page add_action
                 *
                 * @hooked cartsy_lite_page_header          - 10
                 * @hooked cartsy_lite_page_content         - 20
                 */
                do_action('cartsy_lite_page');
                ?>
            </div>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
