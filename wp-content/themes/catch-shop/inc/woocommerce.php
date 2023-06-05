<?php

/**
 * WooCommerce Compatibility File
 * See: https://wordpress.org/plugins/woocommerce/
 *
 * @package Izabel Pro 1.0
 */

/**
 * Query WooCommerce activation
 */
if (!function_exists('catch_shop_is_woocommerce_activated')) {
	function catch_shop_is_woocommerce_activated()
	{
		return class_exists('WooCommerce') ? true : false;
	}
}

if (!function_exists('catch_shop_generate_products_array')) {
	/**
	 * Returns list of products to be used in customizer
	 */
	function catch_shop_generate_products_array($post_type = 'product')
	{
		$output = array();
		$posts = get_posts(
			array(
				'post_type'        => 'product',
				'post_status'      => 'publish',
				'suppress_filters' => false,
				'posts_per_page'   => -1,
			)
		);

		$output['0'] = esc_html__('-- Select --', 'catch-shop');

		foreach ($posts as $post) {
			/* translators: 1: post id. */
			$output[$post->ID] = !empty($post->post_title) ? $post->post_title : sprintf(__('#%d (no title)', 'catch-shop'), $post->ID);
		}

		return $output;
	}
}

if (!function_exists('catch_shop_header_mini_cart_refresh_number')) {
	/**
	 * Update Header Cart items number on add to cart
	 */
	function catch_shop_header_mini_cart_refresh_number($fragments)
	{
		ob_start();
?>
		<span class="count"><?php echo wp_kses_data(sprintf(_n('%d', '%d', WC()->cart->get_cart_contents_count(), 'catch_shop-pro'), WC()->cart->get_cart_contents_count())); ?></span>
	<?php
		$fragments['.site-header-cart .count'] = ob_get_clean();
		return $fragments;
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'catch_shop_header_mini_cart_refresh_number');

if (!function_exists('catch_shop_header_mini_cart_refresh_amount')) {
	/**
	 * Update Header Cart amount on add to cart
	 */
	function catch_shop_header_mini_cart_refresh_amount($fragments)
	{
		ob_start();
	?>
		<span class="amount"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></span>
<?php
		$fragments['.site-header-cart .menu .amount'] = ob_get_clean();
		return $fragments;
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'catch_shop_header_mini_cart_refresh_amount');
