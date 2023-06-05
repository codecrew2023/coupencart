<?php
/**
 * The template for displaying featured content
 *
 * @package Catch Wedding
 */
?>

<?php
$enable_content = get_theme_mod( 'catch_shop_countdown_option', 'disabled' );

if ( ! catch_shop_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$content = get_theme_mod( 'catch_shop_countdown_small_description', esc_html__( 'Product Code xxxxxx', 'catch-shop' ) );

$classes[] = 'section';

$classes[] = 'content-align-center';
$classes[] = 'text-align-center';


$background = '';

$thumb = get_theme_mod( 'catch_shop_countdown_bg_image' );

if ( $thumb ) {
	$background = ' style="background-image: url( ' . esc_url( $thumb ) . ' )"';

	unset( $classes['background-image-class'] );
}

$catch_shop_tagline     = get_theme_mod( 'catch_shop_countdown_tagline' , esc_html__( 'Deal Of The Day', 'catch-shop' ) );
$catch_shop_title       = get_theme_mod( 'catch_shop_countdown_title', esc_html__( 'Grey Shirt & Red Dress', 'catch-shop' ) );
$catch_shop_description = get_theme_mod( 'catch_shop_countdown_description' );
?>

<div id="countdown-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" <?php echo $background; ?>>
	<div class="wrapper section-content-wrapper countdown-content-wrapper">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="hentry-inner">
				<div class="entry-container">
					<div class="content-wrapper">
						<?php catch_shop_heading_wrapper( $catch_shop_tagline, $catch_shop_title, $catch_shop_description ); ?>

						<div class="entry-content">
							<div class="clock"></div>

							<?php 
							if ( $content ) {
								echo wp_kses_post( wpautop( $content ) );
							}
							
							$more_text   = get_theme_mod( 'catch_shop_countdown_more_text' );
							$more_link   = get_theme_mod( 'catch_shop_countdown_more_link', '#' );
							$more_target = get_theme_mod( 'catch_shop_countdown_more_target' ) ? '_blank' : '_self' ;

							if ( $more_text ) : ?>
								<a class="more-link" href="<?php echo esc_url( $more_link ); ?>" target="<?php echo esc_attr( $more_target ); ?>">
									<span class="more-button"><?php echo esc_html( $more_text ); ?></span>
								</a>
							<?php
							endif;
							?>
						</div><!-- .entry-content -->
					</div><!-- .content-wrapper -->
				</div><!-- .entry-container -->
			</div><!-- .hentry-inner -->
		</article><!-- #post-## -->
	</div><!-- .wrapper -->
</div><!-- .section -->
