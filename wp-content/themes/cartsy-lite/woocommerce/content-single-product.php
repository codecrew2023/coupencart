<?php

/**
 * The template for displaying product content in the single-product.php template.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 *
 * @version 3.6.0
 */
defined('ABSPATH') || exit;

global $product;

/*
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    return;
}

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
if (!empty($product->get_price_html())) {
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
}

$cartsy_lite_showUpSale = $cartsy_lite_showRelated = $cartsy_lite_showTabs = $cartsy_lite_showRecentlyViewed = 'on';
$cartsy_lite_recentlyViewedPosition = 'bottom';

$cartsy_lite_showUpSale = 'on';
$cartsy_lite_showRelated = "on";
$cartsy_lite_showTabs = 'on';
$cartsy_lite_showRecentlyViewed = "on";
$cartsy_lite_recentlyViewedPosition = "bottom";

$cartsy_lite_woo_banner_switch = 'on';
if (function_exists('cartsy_lite_global_option_data')) {
    $cartsy_lite_woo_banner            = cartsy_lite_global_option_data('cartsy_lite_woo_banner_switch', $cartsy_lite_woo_banner_switch);

    $cartsy_lite_woo_banner_switch  = !empty($cartsy_lite_woo_banner) ? $cartsy_lite_woo_banner        : $cartsy_lite_woo_banner_switch;
}

if ($cartsy_lite_woo_banner_switch === "on") {
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
}

?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

    <div class="cartsylite-woocommerce-product-summary-wrapper">
        <div class="cartsylite-woocommerce-product-image-wrapper">
            <?php
            /**
             * Hook: woocommerce_before_single_product_summary.
             *
             * @hooked woocommerce_show_product_sale_flash - 10
             * @hooked woocommerce_show_product_images - 20
             */
            do_action('woocommerce_before_single_product_summary');
            ?>
        </div>

        <div class="summary entry-summary">
            <?php
            /**
             * Hook: woocommerce_single_product_summary.
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_rating - 10
             * @hooked woocommerce_template_single_price - 10
             * @hooked woocommerce_template_single_excerpt - 20
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_meta - 40
             * @hooked woocommerce_template_single_sharing - 50
             * @hooked WC_Structured_Data::generate_product_data() - 60
             */
            do_action('woocommerce_single_product_summary');
            ?>
        </div>

    </div>

    <?php
    if ($cartsy_lite_showTabs === 'on') {
        woocommerce_output_product_data_tabs();
    }

    if ($cartsy_lite_showUpSale === 'on') {
        woocommerce_upsell_display();
    }
    if ($cartsy_lite_showRelated === 'on') {
        woocommerce_output_related_products();
    }


    /*
     * Hook: woocommerce_after_single_product_summary.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action('woocommerce_after_single_product_summary');
    ?>
</div>

<?php do_action('woocommerce_after_single_product'); ?>