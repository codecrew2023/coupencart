<?php
/**
 * The template for displaying featured content
 *
 * @package Catch_Shop
 */

$enable_content = get_theme_mod( 'catch_shop_featured_content_option', 'disabled' );

if ( ! catch_shop_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$catch_shop_tagline     = get_theme_mod( 'catch_shop_featured_content_tagline' ); 
$catch_shop_title       = get_option( 'featured_content_title', esc_html__( 'Contents', 'catch-shop' ) );
$catch_shop_description = get_option( 'featured_content_content' );

$catch_shop_classes[] = 'layout-three';
$catch_shop_classes[] = 'featured-content';
$catch_shop_classes[] = 'section';

if ( ! $catch_shop_title && ! $catch_shop_tagline && ! $catch_shop_description ) {
	$catch_shop_classes[] = 'no-section-heading';
}
?>

<div id="featured-content-section" class="featured-content-section <?php echo esc_attr( implode( ' ', $catch_shop_classes ) ); ?>">
	<div class="wrapper">
		<?php catch_shop_heading_wrapper( $catch_shop_tagline, $catch_shop_title, $catch_shop_description ); ?>
		
		<div class="section-content-wrapper featured-content-wrapper layout-three">
			<?php get_template_part( 'template-parts/featured-content/content-featured' ); ?>
		</div><!-- .section-content-wrap -->

		<?php
			$target          = get_theme_mod( 'catch_shop_featured_content_target' ) ? '_blank': '_self';
			$catch_shop_link = get_theme_mod( 'catch_shop_featured_content_link', '#' );
			$text            = get_theme_mod( 'catch_shop_featured_content_text' );

			if ( $text ) :
			?>
			<p class="view-more">
				<a class="button" target="<?php echo $target; ?>" href="<?php echo esc_url( $catch_shop_link ); ?>"><?php echo esc_html( $text ); ?></a>
			</p>
		<?php endif; ?>
	</div><!-- .wrapper -->
</div><!-- #featured-content-section -->
