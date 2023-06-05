<?php

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

get_header();

$cartsy_lite_sidebar_class = $cartsy_lite_sidebar_name = "";
$cartsy_lite_display_sidebar = 'on';
$cartsy_lite_sidebar_position = 'right';
$cartsy_lite_display_sidebar_class = 'cartsylite-with-sidebar';


if (class_exists('WooCommerce') && (is_woocommerce() || is_cart() || is_account_page() || is_checkout())) {
    $cartsy_lite_sidebar_name = 'cartsylite-woo-sidebar';
    if (function_exists('cartsy_lite_global_option_data')) {
        $cartsy_lite_display_sidebar  = cartsy_lite_global_option_data('cartsy_lite_woo_sidebar_switch', 'on');
        $cartsy_lite_sidebar_position = cartsy_lite_global_option_data('cartsy_lite_woo_sidebar_position', $cartsy_lite_sidebar_position);
    }
} else {
    $cartsy_lite_sidebar_name = 'cartsylite-sidebar';
    if (function_exists('cartsy_lite_global_option_data')) {
        $cartsy_lite_display_sidebar  = cartsy_lite_global_option_data('cartsy_lite_blog_sidebar_switch', 'on');
        $cartsy_lite_sidebar_position = cartsy_lite_global_option_data('cartsy_lite_blog_sidebar_position', $cartsy_lite_sidebar_position);
    }
}

if (is_active_sidebar($cartsy_lite_sidebar_name)) {
    if (!empty($cartsy_lite_display_sidebar) && $cartsy_lite_display_sidebar === 'on') {
        $cartsy_lite_display_sidebar_class = 'cartsylite-with-sidebar';
    } else {
        $cartsy_lite_display_sidebar_class = 'cartsylite-no-sidebar';
    }
} else {
    $cartsy_lite_display_sidebar_class = 'cartsylite-no-sidebar';
}


if (!empty($cartsy_lite_sidebar_position) && $cartsy_lite_sidebar_position === 'left') {
    $cartsy_lite_sidebar_class = 'cartsylite-left-sidebar';
}
?>

<div id="primary" class="cartsylite-content-area <?php echo esc_attr($cartsy_lite_display_sidebar_class . ' ' . $cartsy_lite_sidebar_class); ?>">
    <main id="main" class="cartsylite-site-main" role="main">

        <?php
        if (have_posts()) :

            do_action('cartsy_lite_post_loop_before');

            while (have_posts()) :
                the_post();

                /**
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                get_template_part('content', get_post_format());

            endwhile;

            /**
             * Functions hooked in to cartsy_lite_paging_nav action
             *
             * @hooked cartsy_lite_paging_nav - 10
             */
            do_action('cartsy_lite_post_loop_after');

        else :

            get_template_part('content', 'none');

        endif;
        ?>

    </main><!-- #main -->

    <?php
    if (is_active_sidebar($cartsy_lite_sidebar_name) && (!empty($cartsy_lite_display_sidebar) && $cartsy_lite_display_sidebar === 'on')) {
        do_action('cartsy_lite_sidebar');
    }
    ?>

</div><!-- #primary -->

<?php
get_footer();
