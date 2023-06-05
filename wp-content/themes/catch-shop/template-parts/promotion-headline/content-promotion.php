<?php
/**
 * The template used for displaying hero content
 *
 * @package Catch_Shop
 */

$enable_section = get_theme_mod( 'catch_shop_promo_head_visibility', 'disabled' );

if ( ! catch_shop_check_section( $enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}

get_template_part( 'template-parts/promotion-headline/post-type', 'promotion' );
