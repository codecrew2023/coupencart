<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php do_action('cartsy_lite_before_site'); ?>
	
	<!-- Header area start -->
	<?php do_action('cartsy_lite_before_header'); ?>
	<header id="masthead" class="cartsylite-site-header cartsylite-header-default">
		<?php
		/**
		 * Functions hooked into cartsy_lite_header action
		 *
		 * @hooked cartsy_lite_header_wrapper                 - 0
		 * @hooked cartsy_lite_skip_links                       - 5
		 * @hooked cartsy_lite_social_icons                     - 10
		 * @hooked cartsy_lite_site_branding                    - 20
		 * @hooked cartsy_lite_secondary_navigation             - 30
		 * @hooked cartsy_lite_product_search                   - 40
		 * @hooked cartsy_lite_header_wrapper_close           - 41
		 * @hooked cartsy_lite_primary_navigation_wrapper       - 42
		 * @hooked cartsy_lite_primary_navigation               - 50
		 * @hooked cartsy_lite_header_cart                      - 60
		 * @hooked cartsy_lite_primary_navigation_wrapper_close - 68
		 */
		do_action('cartsy_lite_header');
		?>
	</header><!-- #masthead -->
	<?php do_action('cartsy_lite_after_header'); ?>

	<!-- Header area end -->


	<!-- Page content area start -->

	<div id="page" class="hfeed site">
		<?php
		/**
		 * Functions hooked in to cartsy_lite_before_content
		 *
		 * @hooked cartsy_lite_header_widget_region - 10
		 * @hooked woocommerce_breadcrumb - 10
		 */
		do_action('cartsy_lite_before_content');
		?>

		<div id="content" class="cartsylite-site-content">
			<?php
			do_action('cartsy_lite_content_top');
