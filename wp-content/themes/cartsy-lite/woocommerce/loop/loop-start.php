<?php

/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.3.0
 */

if (!defined('ABSPATH')) {
	exit;
}

global $woocommerce_loop;


$cartsy_lite_gridLayout = $cartsy_lite_gridWrapperClass = '';

$cartsy_lite_gridLayout = 'grid_helium';

$cartsy_lite_is_sidebar = cartsy_lite_check_woo_sidebar_availability();

$cartsy_lite_gridWrapperClass = "grid-helium grid-cols-sm-3 grid-cols-2 gap-10";
if (isset($woocommerce_loop['name'])) {
	switch ($cartsy_lite_gridLayout) {
		case 'grid_helium':
			if ($woocommerce_loop['name'] == 'up-sells' || $woocommerce_loop['name'] == 'related' || $woocommerce_loop['name'] ==  'cross-sells') {
				$cartsy_lite_gridWrapperClass = "grid-helium grid-cols-lg-4 grid-cols-md-3 grid-cols-sm-3 grid-cols-2 gap-10";
				if (!$cartsy_lite_is_sidebar) {
					$cartsy_lite_gridWrapperClass .= " grid-cols-xxl-". wc_get_loop_prop('columns') ." grid-cols-xl-". wc_get_loop_prop('columns') ."";
				}
			} elseif ($woocommerce_loop['name'] === "products" && $woocommerce_loop['is_shortcode']) {
				$cartsy_lite_gridWrapperClass = "grid-helium grid-cols-lg-4 grid-cols-md-3 grid-cols-sm-3 grid-cols-2 gap-10 grid-cols-xxl-". wc_get_loop_prop('columns') ." grid-cols-xl-". wc_get_loop_prop('columns') ."";
			} else {
				$cartsy_lite_gridWrapperClass = 'grid-helium grid-cols-sm-3 grid-cols-2 gap-10';
				if (!$cartsy_lite_is_sidebar) {
					$cartsy_lite_gridWrapperClass .= " grid-cols-xxl-". wc_get_loop_prop('columns') ." grid-cols-xl-". wc_get_loop_prop('columns') ." grid-cols-md-4";
				}
			}
			break;

		default:
			if ($woocommerce_loop['name'] == 'up-sells' || $woocommerce_loop['name'] == 'related' || $woocommerce_loop['name'] ==  'cross-sells') {
				$cartsy_lite_gridWrapperClass = "grid-helium grid-cols-lg-4 grid-cols-md-3 grid-cols-sm-3 grid-cols-2 gap-10";
				if (!$cartsy_lite_is_sidebar) {
					$cartsy_lite_gridWrapperClass .= " grid-cols-xxl-". wc_get_loop_prop('columns') ." grid-cols-xl-". wc_get_loop_prop('columns') ."";
				}
			} else {
				$cartsy_lite_gridWrapperClass = "grid-helium grid-cols-xl-". wc_get_loop_prop('columns') ." grid-cols-md-4 grid-cols-sm-3 grid-cols-2 gap-10";
				if (!$cartsy_lite_is_sidebar) {
					$cartsy_lite_gridWrapperClass .= " grid-cols-xxl-". wc_get_loop_prop('columns') ." grid-cols-xl-". wc_get_loop_prop('columns') ." grid-cols-md-4";
				}
			}
			break;
	}
}


if ($cartsy_lite_is_sidebar && (is_shop() || is_product_category() || is_product_tag())) {
	$cartsy_lite_gridWrapperClass .= " grid-cols-xxl-4";
}
?>
<ul class="products cartsylite-archive-products columns-<?php echo esc_attr(wc_get_loop_prop('columns')); ?> <?php echo esc_attr($cartsy_lite_gridWrapperClass); ?>">