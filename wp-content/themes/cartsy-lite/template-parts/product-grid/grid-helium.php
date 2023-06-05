<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
?>

<li <?php wc_product_class('product type-product cartsylite-grid-helium', $product); ?>>

    <?php
    $cartsy_lite_qty = "";
    $cartsy_lite_splicedGalleryIDs = [];
    if (function_exists('cartsy_lite_woocommerce_check_product_in_cart')) {
        $cartsy_lite_qty = cartsy_lite_woocommerce_check_product_in_cart($product->get_id());
    } else {
        $cartsy_lite_qty = false;
    }
    $cartsy_lite_display = $cartsy_lite_qty ? 'display:flex;' : 'display:none;';
    $cartsy_lite_qty_class = 'cartsy-qty-button cartsy-qty-button-' . $product->get_id();
    $cartsy_lite_stock_qty = $product->get_manage_stock() ? $product->get_stock_quantity() : -1;
    $cartsy_lite_size = 'woocommerce_thumbnail';
    $cartsy_lite_imageSize = apply_filters('single_product_archive_thumbnail_size', $cartsy_lite_size);
    $cartsy_lite_image_id = $product->get_image_id();
    $cartsy_lite_galleryImageIDs = $product ?  $product->get_gallery_image_ids() : [];
    $cartsy_lite_isInStock =  $product->is_in_stock();
    $cartsy_lite_isOnSale = $product->is_on_sale();
    $cartsy_lite_productTitle = $product->get_title();
    $cartsy_lite_productType = get_the_terms($product->get_id(), 'product_type') ? current(get_the_terms($product->get_id(), 'product_type'))->slug : '';
    $cartsy_lite_link = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product);
    if (function_exists('cartsy_lite_woocommerce_check_product_in_cart')) {
        $cartsy_lite_itemOnCart = cartsy_lite_woocommerce_check_product_in_cart($product->get_id());
    } else {
        $cartsy_lite_itemOnCart = false;
    }
    $cartsy_lite_cartButton = $cartsy_lite_itemOnCart ? 'display:none;' : 'display:flex;';
    $cartsy_lite_placeholderImage = CARTSY_LITE_ASSETS . '/client/images/placeholder-icon.svg';
    array_unshift($cartsy_lite_galleryImageIDs, $cartsy_lite_image_id);
    $cartsy_lite_image_html_markup = "";
    ?>

    <div class="cartsylite-helium-product-card">
        <div class="cartsylite-helium-product-card-thumb">
            <a href="<?php echo esc_url($cartsy_lite_link); ?>" aria-label="<?php echo esc_attr__('Product Image', 'cartsy-lite');  ?>" class="cartsylite-product-grid-button">
                <?php if ($cartsy_lite_isOnSale) { ?>
                    <span class="product-badge">
                        <?php echo esc_html__('Sale', 'cartsy-lite');  ?>
                    </span>
                <?php }
                /**
                 * Hook: woocommerce_before_shop_loop_item_title.
                 *
                 * @hooked woocommerce_show_product_loop_sale_flash - 10
                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                 */
                do_action('woocommerce_before_shop_loop_item_title');
                ?>
            </a>
        </div>

        <div class=" cartsylite-helium-product-card-description">
            <div class="cartsylite-helium-product-card-price">
                <?php woocommerce_template_loop_price(); ?>
            </div>
            <a href="<?php echo esc_url($cartsy_lite_link); ?>" class="cartsylite-helium-product-card-title">
                <?php woocommerce_template_loop_product_title(); ?>
            </a>

            <?php if ($cartsy_lite_isInStock) { ?>
                <?php if ($cartsy_lite_productType === 'simple') { ?>
                    <div class="cartsylite-helium-product-card-cart">
                        <!-- Add to cart button -->
                        <a href="<?php echo esc_url('?add-to-cart=' . $product->get_id()); ?>" class="product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>" data-quantity="1" rel="nofollow">
                            <span class="cartsylite-helium-product-card-cart-button">
                                <span class="label"><?php echo esc_html__('ADD', 'cartsy-lite'); ?></span>
                                <span class="icon"></span>
                            </span>
                        </a>
                        <!-- End -->
                    </div>
                <?php } else { ?>
                    <div class="cartsylite-helium-product-card-cart">
                        <a href="<?php echo esc_url($cartsy_lite_link); ?>" class="product_type_variable add_to_cart_button" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>" rel="nofollow">
                            <span class="cartsylite-helium-product-card-cart-button">
                                <span class="label"><?php echo esc_html__('Select Options', 'cartsy-lite'); ?></span>
                                <span class="icon"></span>
                            </span>
                        </a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="cartsylite-helium-product-card-cart">
                    <div class="out-of-stock"><?php echo esc_html__('OUT OF STOCK', 'cartsy-lite'); ?></div>
                </div>
            <?php } ?>


        </div>

        <?php
        /**
         * Hook: woocommerce_after_shop_loop_item_title.
         *
         * @hooked woocommerce_template_loop_rating - 5
         * @hooked woocommerce_template_loop_price - 10
         */
        do_action('woocommerce_after_shop_loop_item_title');
        ?>

        <?php
        /**
         * Hook: woocommerce_after_shop_loop_item.
         *
         * @hooked woocommerce_template_loop_product_link_close - 5
         * @hooked woocommerce_template_loop_add_to_cart - 10
         */
        do_action('woocommerce_after_shop_loop_item');
        ?>

    </div>
</li>