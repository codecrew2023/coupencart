<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.4.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart');

$cartsy_lite_showCrossSell  = 'on';
$cartsy_lite_woo_banner = "on";
if (function_exists('cartsy_lite_global_option_data')) {
    $cartsy_lite_woo_banner  = cartsy_lite_global_option_data('cartsy_lite_woo_banner_switch', $cartsy_lite_woo_banner);
}
?>

<div class="cartsylite-cart-contents-wrapper">
    <div class="cartsylite-woocommerce-cart-form-wrapper">
        <?php if ($cartsy_lite_woo_banner !== "on") { ?>    
            <h2 class="cartsylite-woocommerce-cart-form-title"><?php esc_html_e('Cart', 'cartsy-lite'); ?></h2>
        <?php }  ?>

        <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
            <?php do_action('woocommerce_before_cart_table'); ?>

            <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                <thead>
                    <tr>
                        <th class="product-thumbnail">&nbsp;</th>
                        <th class="product-name"><?php esc_html_e('Product', 'cartsy-lite'); ?></th>
                        <th class="product-price"><?php esc_html_e('Price', 'cartsy-lite'); ?></th>
                        <th class="product-quantity"><?php esc_html_e('Quantity', 'cartsy-lite'); ?></th>
                        <th class="product-subtotal"><?php esc_html_e('Subtotal', 'cartsy-lite'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php do_action('woocommerce_before_cart_contents'); ?>

                    <?php
                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                        $cartsy_lite_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                        $cartsy_lite_product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                        if ($cartsy_lite_product && $cartsy_lite_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                            $cartsy_lite_product_permalink = apply_filters('woocommerce_cart_item_permalink', $cartsy_lite_product->is_visible() ? $cartsy_lite_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                    ?>
                            <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                                <td class="product-thumbnail">
                                    <div class="product-thumbnail-wrapper">
                                        <div class="remove-product">
                                            <?php
                                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                'woocommerce_cart_item_remove_link',
                                                sprintf(
                                                    '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><span>&times;</span></a>',
                                                    esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                    esc_html__('Remove this item', 'cartsy-lite'),
                                                    esc_attr($cartsy_lite_product_id),
                                                    esc_attr($cartsy_lite_product->get_sku())
                                                ),
                                                $cart_item_key
                                            );
                                            ?>
                                        </div>

                                        <?php
                                        $cartsy_lite_thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $cartsy_lite_product->get_image(), $cart_item, $cart_item_key);

                                        if (!$cartsy_lite_product_permalink) {
                                            echo wp_kses_post($cartsy_lite_thumbnail); // phpcs:ignore WordPress.Security.EscapeOutput.DeprecatedWhitelistCommentFound
                                        } else {
                                            printf('<a href="%s">%s</a>', esc_url($cartsy_lite_product_permalink), $cartsy_lite_thumbnail); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        }
                                        ?>
                                    </div>
                                </td>

                                <td class="product-name" data-title="<?php esc_attr_e('Product', 'cartsy-lite'); ?>">
                                    <?php
                                    if (!$cartsy_lite_product_permalink) {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $cartsy_lite_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                    } else {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($cartsy_lite_product_permalink), $cartsy_lite_product->get_name()), $cart_item, $cart_item_key));
                                    }

                                    do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                                    // Meta data.
                                    echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

                                    // Backorder notification.
                                    if ($cartsy_lite_product->backorders_require_notification() && $cartsy_lite_product->is_on_backorder($cart_item['quantity'])) {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'cartsy-lite') . '</p>', $cartsy_lite_product_id));
                                    }
                                    ?>
                                </td>

                                <td class="product-price" data-title="<?php esc_attr_e('Price', 'cartsy-lite'); ?>">
                                    <?php
                                    echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($cartsy_lite_product), $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    ?>
                                </td>

                                <td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'cartsy-lite'); ?>">
                                    <?php
                                    if ($cartsy_lite_product->is_sold_individually()) {
                                        $cartsy_lite_product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                    } else {
                                        $cartsy_lite_product_quantity = woocommerce_quantity_input(
                                            array(
                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                'input_value'  => $cart_item['quantity'],
                                                'max_value'    => $cartsy_lite_product->get_max_purchase_quantity(),
                                                'min_value'    => '0',
                                                'product_name' => $cartsy_lite_product->get_name(),
                                            ),
                                            $cartsy_lite_product,
                                            false
                                        );
                                    }

                                    echo apply_filters('woocommerce_cart_item_quantity', $cartsy_lite_product_quantity, $cart_item_key, $cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    ?>
                                </td>

                                <td class="product-subtotal" data-title="<?php esc_attr_e('Subtotal', 'cartsy-lite'); ?>">
                                    <?php
                                    echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($cartsy_lite_product, $cart_item['quantity']), $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                    <?php do_action('woocommerce_cart_contents'); ?>

                    <tr>
                        <td colspan="6" class="actions">

                            <?php if (wc_coupons_enabled()) { ?>
                                <div class="coupon">
                                    <label for="coupon_code"><?php esc_html_e('Coupon:', 'cartsy-lite'); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'cartsy-lite'); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'cartsy-lite'); ?>"><?php esc_html_e('Apply coupon', 'cartsy-lite'); ?></button>
                                    <?php do_action('woocommerce_cart_coupon'); ?>
                                </div>
                            <?php } ?>

                            <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update cart', 'cartsy-lite'); ?>"><?php esc_html_e('Update cart', 'cartsy-lite'); ?></button>

                            <?php do_action('woocommerce_cart_actions'); ?>

                            <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                        </td>
                    </tr>

                    <?php do_action('woocommerce_after_cart_contents'); ?>
                </tbody>
            </table>
            <?php do_action('woocommerce_after_cart_table'); ?>
        </form>
    </div>

    <?php do_action('woocommerce_before_cart_collaterals'); ?>

    <div class="cart-collaterals">
        <?php
        /**
         * Cart collaterals hook.
         *
         * @hooked woocommerce_cross_sell_display
         * @hooked woocommerce_cart_totals - 10
         */
        // do_action('woocommerce_cart_collaterals');
        woocommerce_cart_totals();
        ?>
    </div>
</div>

<?php if ($cartsy_lite_showCrossSell === 'on') { ?>
    <div class="cartsylite-cart-crossell">
        <?php
        /**
         * Cart collaterals hook.
         *
         * @hooked woocommerce_cross_sell_display
         * @hooked woocommerce_cart_totals - 10
         */
        // do_action('woocommerce_cart_collaterals');
        woocommerce_cross_sell_display();
        ?>
    </div>
<?php } ?>


<?php do_action('woocommerce_after_cart'); ?>