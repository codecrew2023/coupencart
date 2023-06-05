<?php
/**
 * The template for displaying testimonial items
 *
 * @package Catch_Shop
 */

$enable            = get_theme_mod( 'catch_shop_testimonial_option', 'disabled' );

if ( ! catch_shop_check_section( $enable ) ) {
	// Bail if featured content is disabled
	return;
}

$catch_shop_tagline     = get_theme_mod( 'catch_shop_testimonial_tagline' );
$catch_shop_title       = '';
$catch_shop_description = '';

// Get Jetpack options for testimonial.
$jetpack_defaults = array(
	'page-title' => esc_html__( 'Testimonials', 'catch-shop' ),
);

// Get Jetpack options for testimonial.
$jetpack_options['page-title'] = get_option( 'jetpack_testimonial_title', $jetpack_defaults );
$jetpack_options['page-content'] = get_option( 'jetpack_testimonial_content');

$catch_shop_title       = isset( $jetpack_options['page-title'] ) ? $jetpack_options['page-title'] : esc_html__( 'Testimonials', 'catch-shop' );
$catch_shop_description = isset( $jetpack_options['page-content'] ) ? $jetpack_options['page-content'] : '';

$classes[] = 'section testimonial-content-section';

if ( ! $catch_shop_tagline && ! $catch_shop_title && ! $catch_shop_description ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="testimonial-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<div class="full-content-wrap full-width">

			<?php catch_shop_heading_wrapper( $catch_shop_tagline, $catch_shop_title, $catch_shop_description ); ?>

			<?php 
			$content_classes = '';
			?>

			<div class="section-content-wrapper testimonial-slider owl-carousel testimonial-content-wrapper">
				<?php
					get_template_part( 'template-parts/testimonial/post-types-testimonial' );
				?>
			</div><!-- .section-content-wrapper -->
		</div><!-- .full-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- .testimonial-content-section -->
