<?php
/**
 * The template for displaying Woo Products Showcase
 *
 * @package Audioman
 */

if ( ! class_exists( 'WooCommerce' ) ) {
    // Bail if WooCommerce is not installed
    return;
}

$catch_shop_enable_content = get_theme_mod( 'catch_shop_featured_option', 'disabled' );

if ( ! catch_shop_check_section( $catch_shop_enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$catch_shop_number         = get_theme_mod( 'catch_shop_featured_number', 4 );
$catch_shop_columns        = get_theme_mod( 'catch_shop_featured_columns', 4 );
$catch_shop_paginate       = get_theme_mod( 'catch_shop_featured_paginate' );
$catch_shop_orderby        = isset( $_GET['orderby'] ) ? $_GET['orderby'] : get_theme_mod( 'catch_shop_featured_orderby' );
$catch_shop_product_filter = get_theme_mod( 'catch_shop_featured_products_filter', 'best_selling' );
$catch_shop_featured       = get_theme_mod( 'catch_shop_featured_featured' );
$catch_shop_order          = get_theme_mod( 'catch_shop_featured_order' );
$catch_shop_skus           = get_theme_mod( 'catch_shop_featured_skus' );
$catch_shop_category       = get_theme_mod( 'catch_shop_featured_category' );

$catch_shop_shortcode = '[products';

if ( $catch_shop_number ) {
	$catch_shop_shortcode .= ' limit="' . esc_attr( $catch_shop_number ) . '"';
}

if ( $catch_shop_columns ) {
	$catch_shop_shortcode .= ' columns="' . absint( $catch_shop_columns ) . '"';
}

if ( $catch_shop_paginate ) {
	$catch_shop_shortcode .= ' paginate="' . esc_attr( $catch_shop_paginate ) . '"';
}

if ( $catch_shop_orderby ) {
	$catch_shop_shortcode .= ' orderby="' . esc_attr( $catch_shop_orderby ) . '"';
}

if ( $catch_shop_order ) {
	$catch_shop_shortcode .= ' order="' . esc_attr( $catch_shop_order ) . '"';
}

if ( $catch_shop_product_filter && 'none' !== $catch_shop_product_filter ) {
	$catch_shop_shortcode .= ' ' . esc_attr( $catch_shop_product_filter ) . '="true"';
}

if ( $catch_shop_skus ) {
	$catch_shop_shortcode .= ' skus="' . esc_attr( $catch_shop_skus ) . '"';
}

if ( $catch_shop_category ) {
	$catch_shop_shortcode .= ' category="' . esc_attr( $catch_shop_category ) . '"';
}

if ( $catch_shop_featured ) {
	$catch_shop_shortcode .= ' visibility="featured"';
}

$catch_shop_shortcode .= ']';

$catch_shop_tagline     = get_theme_mod( 'catch_shop_featured_tagline', esc_html__( 'All Styles in This Spring', 'catch-shop' ) );
$catch_shop_title       = get_theme_mod( 'catch_shop_featured_title',  esc_html__( 'Featured Products', 'catch-shop' ) );
$catch_shop_description = get_theme_mod( 'catch_shop_featured_description' );
?>

<div id="product-content-section" class="section featured-products">
	<div class="wrapper">
		<?php catch_shop_heading_wrapper( $catch_shop_tagline, $catch_shop_title, $catch_shop_description ); ?>

		<div class="section-content-wrapper product-content-wrapper">
			<?php echo do_shortcode( $catch_shop_shortcode ); ?>
		</div><!-- .section-content-wrapper -->

		<?php
			$catch_shop_target = get_theme_mod( 'catch_shop_featured_target' ) ? '_blank': '_self';
			$catch_shop_link   = get_theme_mod( 'catch_shop_featured_link', get_permalink( wc_get_page_id( 'shop' ) ) );
			$catch_shop_text   = get_theme_mod( 'catch_shop_featured_text' );

			if ( $catch_shop_text ) :
		?>
			<p class="view-more">
				<a class="button" target="<?php echo $catch_shop_target; ?>" href="<?php echo esc_url( $catch_shop_link ); ?>"><?php echo esc_html( $catch_shop_text ); ?></a>
			</p>
		<?php endif; ?>
	</div><!-- .wrapper -->
</div><!-- .sectionr -->
