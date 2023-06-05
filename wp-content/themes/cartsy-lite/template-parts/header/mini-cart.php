<?php 
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
if (!class_exists('WooCommerce')) {
    return;
}
if (is_cart() || is_checkout() || is_account_page()) {
    return;
}
$cartsy_lite_header_mini_cart_display = "on";
if (function_exists('cartsy_lite_global_option_data')) {
    $cartsy_lite_header_mini_cart_display = cartsy_lite_global_option_data('cartsy_lite_enable_header_mini_cart', 'on');
}
if ($cartsy_lite_header_mini_cart_display !== "on") {
    return;
}
?>
<div class="cartsylite-mini-cart-main-wrapper">
    <div class="cartsylite-mini-cart-wrapper">
        <?php if (function_exists('cartsy_lite_cart_link')) {
            cartsy_lite_cart_link(); 
        } ?>
    </div>
    <div class="cartsylite-mini-cart-items-wrapper">
        <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
    </div>
</div>