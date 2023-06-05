<?php

if (class_exists('WooCommerce') && (is_woocommerce() || is_cart() || is_account_page() || is_checkout() || is_product())) {
	if (!is_active_sidebar('cartsylite-woo-sidebar')) {
		return;
	}
} else {
	if (!is_active_sidebar('cartsylite-sidebar')) {
		return;
	}
}
if (class_exists('WooCommerce')) {
	if (is_account_page() && !is_user_logged_in()) return;
}
?>
<aside id="secondary" class="cartsylite-widget-area">

	<?php if (class_exists('WooCommerce') && (is_woocommerce() || is_cart() || is_account_page() || is_checkout() || is_product())) { ?>
		<?php if (is_active_sidebar('cartsylite-woo-sidebar')) { ?>
			<?php dynamic_sidebar('cartsylite-woo-sidebar'); ?>
		<?php } ?>
	<?php } else { ?>
		<?php if (is_active_sidebar('cartsylite-sidebar')) { ?>
			<?php dynamic_sidebar('cartsylite-sidebar'); ?>
		<?php } ?>
	<?php } ?>


</aside><!-- #secondary -->