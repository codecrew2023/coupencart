<?php

/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header();

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

$cartsy_lite_sidebar_class = $cartsy_lite_display_sidebar = "";
$cartsy_lite_sidebar_position = 'right';
$cartsy_lite_display_sidebar_class = 'cartsylite-with-sidebar';

if (function_exists('cartsy_lite_global_option_data')) {
    $cartsy_lite_display_sidebar  = cartsy_lite_global_option_data('cartsy_lite_woo_single_sidebar_switch', 'on');
    $cartsy_lite_sidebar_position = cartsy_lite_global_option_data('cartsy_lite_woo_single_sidebar_position', $cartsy_lite_sidebar_position);
}


if (is_active_sidebar('cartsylite-woo-sidebar')) {
    if (!empty($cartsy_lite_display_sidebar) && $cartsy_lite_display_sidebar === 'on') {
        $cartsy_lite_display_sidebar_class = 'cartsylite-with-sidebar';
    } else {
        $cartsy_lite_display_sidebar_class = 'cartsylite-no-sidebar';
    }
} else {
    $cartsy_lite_display_sidebar_class = 'cartsylite-no-sidebar';
}

if ($cartsy_lite_sidebar_position == 'left') {
    $cartsy_lite_sidebar_class = 'cartsylite-left-sidebar';
} else {
    $cartsy_lite_sidebar_class = 'cartsylite-right-sidebar';
}
?>

<div id="primary" class="cartsylite-content-area <?php echo esc_attr($cartsy_lite_display_sidebar_class); ?> <?php echo esc_attr($cartsy_lite_sidebar_class); ?>">

    <?php
    /**
     * woocommerce_before_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening div's for the content)
     * @hooked woocommerce_breadcrumb - 20
     */
    do_action('woocommerce_before_main_content');
    ?>
    <main id="main" class="cartsylite-site-main">
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <?php wc_get_template_part('content', 'single-product'); ?>
        <?php endwhile; // end of the loop.
        ?>
    </main>

    <?php
    /**
     * woocommerce_after_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing div's for the content)
     */
    do_action('woocommerce_after_main_content');
    ?>

    <?php
    if (is_active_sidebar('cartsylite-woo-sidebar') && (!empty($cartsy_lite_display_sidebar) && $cartsy_lite_display_sidebar === 'on')) {
        do_action('cartsy_lite_sidebar');
    }
    ?>
</div>

<?php
get_footer();

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
