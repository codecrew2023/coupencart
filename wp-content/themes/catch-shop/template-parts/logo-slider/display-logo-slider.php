<?php
/**
 * The template used for displaying logo_slider
 *
 * @package Catch_Shop
 */
?>
<?php
$enable_logo_slider = get_theme_mod( 'catch_shop_logo_slider_option', 'disabled' );

if ( ! catch_shop_check_section( $enable_logo_slider ) ) {
	return;
}

$catch_shop_type        = get_theme_mod( 'catch_shop_logo_slider_type', 'category' );
$catch_shop_tagline     = get_theme_mod( 'catch_shop_logo_slider_tagline' );
$catch_shop_title       = get_theme_mod( 'catch_shop_logo_slider_title');
$catch_shop_description = get_theme_mod( 'catch_shop_logo_slider_description' );

$classes[] = 'catch-shop-logo-slider-section logo-slider-section section';

if ( ! $catch_shop_title && ! $catch_shop_tagline && ! $catch_shop_description ) {
	$classes[] = 'no-section-heading';
}
?>
<div id="logo-slider-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php catch_shop_heading_wrapper( $catch_shop_tagline, $catch_shop_title, $catch_shop_description ); ?>

		<div class="section-content-wrapper catch-shop-logo-slider-content-wrapper owl-carousel">
			<?php get_template_part( 'template-parts/logo-slider/post-type-logo-slider' ); ?>
		</div><!-- .section-content-wrapper  -->	
	</div><!-- .wrapper -->
</div><!-- #catch-shop-logo-slider-section -->
