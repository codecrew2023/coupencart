<?php

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

$cartsy_lite_home_page_product_args = [];
$cartsy_lite_woo_featured_product_switch = $cartsy_lite_woo_on_sale_product_switch = "off";
$cartsy_lite_home_out_of_stock_product_switch = "on";


if (function_exists('cartsy_lite_global_option_data')) {
    $cartsy_lite_woo_featured_product_switch      = cartsy_lite_global_option_data('cartsy_lite_home_featured_product_switch', $cartsy_lite_woo_featured_product_switch);

    $cartsy_lite_woo_on_sale_product_switch       = cartsy_lite_global_option_data('cartsy_lite_home_on_sale_product_switch', $cartsy_lite_woo_on_sale_product_switch);

    $cartsy_lite_home_out_of_stock_product_switch = cartsy_lite_global_option_data('cartsy_lite_home_out_of_stock_product_switch', $cartsy_lite_home_out_of_stock_product_switch);
}


$cartsy_lite_product_args = apply_filters(
    'cartsy_lite_products_args',
    array(
        'columns'    => get_option('woocommerce_catalog_columns', 5),
        'orderby'    => get_option('woocommerce_default_catalog_orderby', 'menu_order'),
        'paginate'   => "true",
        'visibility' => $cartsy_lite_woo_featured_product_switch === "on" ? 'featured' : "",
        'on_sale'    => $cartsy_lite_woo_on_sale_product_switch  === "on" ? 'true' : "",
    )
);

if (function_exists('cartsy_lite_woocommerce_shortcode_products_query')) {
    add_filter('woocommerce_shortcode_products_query', 'cartsy_lite_woocommerce_shortcode_products_query', 20, 1);
}

$cartsy_lite_home_page_product_args = array(
    'per_page'   => wc_get_default_products_per_row() * wc_get_default_product_rows_per_page(),
    'paginate'   => esc_attr($cartsy_lite_product_args['paginate']),
    'orderby'    => esc_attr($cartsy_lite_product_args['orderby']),
    'columns'    => intval($cartsy_lite_product_args['columns']),
);

if ($cartsy_lite_product_args['visibility'] === "featured") {
    $cartsy_lite_home_page_product_args['visibility'] = $cartsy_lite_product_args['visibility'];
}

if ($cartsy_lite_product_args['on_sale'] === "true") {
    $cartsy_lite_home_page_product_args['on_sale'] = $cartsy_lite_product_args['on_sale'];
}

$cartsy_lite_shortcode_content = cartsy_lite_do_shortcode(
    'products',
    apply_filters(
        'cartsy_lite_home_page_product_args',
        $cartsy_lite_home_page_product_args
    )
);


/**
 * Only display the section if the shortcode returns products
 */
if (false !== strpos($cartsy_lite_shortcode_content, 'product')) { ?>
    <section class="cartsylite-product-section" aria-label="<?php echo esc_attr__('Products', 'cartsy-lite'); ?>">
        <?php
        echo wp_kses_post($cartsy_lite_shortcode_content); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
        ?>
    </section>
<?php } else {
    do_action('woocommerce_no_products_found');
}
