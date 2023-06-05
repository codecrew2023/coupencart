<?php

/**
 * The template for displaying all single posts
 *
 * @package Cartsy Lite
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
		while (have_posts()) :
			the_post();

			do_action('cartsy_lite_single_post_before');

			get_template_part('content', 'single');

			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) :
				comments_template();
			endif;

			do_action('cartsy_lite_single_post_after');

		endwhile; // End of the loop.
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
