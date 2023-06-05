<?php
/**
 * The template for displaying service content
 *
 * @package Catch_Shop
 */

$enable_content            = get_theme_mod( 'catch_shop_service_option', 'disabled' );

if ( ! catch_shop_check_section( $enable_content ) ) {
	// Bail if service content is disabled.
	return;
}

$catch_shop_title       = get_option( 'ect_service_title', esc_html__( 'Services', 'catch-shop-dark' ) );
$catch_shop_description = get_option( 'ect_service_content' );
$catch_shop_tagline     = get_theme_mod( 'catch_shop_service_tagline' );

$classes[] = 'service-section section text-align-center';

if ( ! $catch_shop_title && ! $catch_shop_tagline && ! $catch_shop_description ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="service-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php catch_shop_heading_wrapper( $catch_shop_tagline, $catch_shop_title, $catch_shop_description ); ?>

		<div class="section-content-wrapper service-content-wrapper layout-three">
			<?php
			get_template_part( 'template-parts/service/content-service' );
			?>

			<?php
				$target          = get_theme_mod( 'catch_shop_service_target' ) ? '_blank': '_self';
				$catch_shop_link = get_theme_mod( 'catch_shop_service_link', '#' );
				$text            = get_theme_mod( 'catch_shop_service_text' );

				if ( $text ) :
			?>

			<p class="view-more">
				<a class="button" target="<?php echo $target; ?>" href="<?php echo esc_url( $catch_shop_link ); ?>"><?php echo esc_html( $text ); ?></a>
			</p>
			<?php endif; ?>
		</div><!-- .service-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #service-section -->
