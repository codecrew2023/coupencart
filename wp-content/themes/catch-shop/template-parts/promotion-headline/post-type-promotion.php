<?php
/**
 * The template used for displaying promotion headline
 *
 * @package Catch_Shop
 */

$catch_shop_subtitle    = get_theme_mod( 'catch_shop_promo_head_sub_title' );
$catch_shop_description = get_theme_mod( 'catch_shop_promo_head_description' );

if ( $catch_shop_id = get_theme_mod( 'catch_shop_promotion_headline' ) ) {
	$args['page_id'] = absint( $catch_shop_id );
}

// If $args is empty return false
if ( empty( $args ) ) {
	return;
}

$args['posts_per_page'] = 1;
$args['ignore_sticky'] = false;

// Create a new WP_Query using the argument previously created
$promotion_headline_query = new WP_Query( $args );
if ( $promotion_headline_query->have_posts() ) :
	while ( $promotion_headline_query->have_posts() ) :
		$promotion_headline_query->the_post();

		$class[] = 'section promotion-section content-align-center text-align-center promotion-headline-one';

		if ( get_theme_mod( 'catch_shop_promo_head_text_color', 1 ) ) {
			$class[] = 'content-color-white';
		}
		?>
		<div id="promotion-section" class="<?php echo esc_attr( implode( ' ', $class ) ); ?>">
			<div class="wrapper section-content-wrapper">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="hentry-inner">
						<?php catch_shop_post_thumbnail( 'catch-shop-slider', 'html-with-bg' ); // catch_shop_post_thumbnail( $image_size, $catch_shop_type = 'html', $echo = true, $no_thumb = false ). ?>

						<div class="content-wrapper">
							<div class="entry-container">
								<div class="entry-container-frame">

									<?php if( $catch_shop_subtitle ) : ?>
										<div class="section-subtitle">
											<?php echo esc_html( $catch_shop_subtitle ); ?>
										</div>
									<?php endif; ?>

									<?php if ( get_theme_mod( 'catch_shop_display_promotion_headline_title', 1 ) ) : ?>
										<header class="entry-header section-title-wrapper">
											<?php the_title( '<h2 class="entry-title section-title">', '</h2>' ); ?>
										</header><!-- .entry-header -->
									<?php endif; ?>

									<?php if ( $catch_shop_description ) : ?>
										<div class="section-description">
											<p>
												<?php
													echo wp_kses_post( $catch_shop_description );
												?>
											</p>
										</div><!-- .section-description-wrapper -->
									<?php endif; ?>

									<?php
										$image = get_theme_mod( 'catch_shop_promo_head_logo_image' );
										if ( $image ) : ?>
											<div class="post-thumbnail">
												<img src="<?php echo esc_url( $image ); ?>">
											</div><!-- .post-thumbnail-->
										<?php endif; ?>

									<div class="entry-content">
										<?php
										the_content();

										wp_link_pages( array(
											'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'catch-shop' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span class="page-number">',
											'link_after'  => '</span>',
											'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'catch-shop' ) . ' </span>%',
											'separator'   => '<span class="screen-reader-text">, </span>',
										) );
										?>
									</div><!-- .entry-content -->
								</div><!-- .entry-container-frame -->
							</div><!-- .entry-container -->
						</div><!-- .content-wrapper -->
					</div><!-- .hentry-inner -->
				</article><!-- #post-## -->
			</div><!-- .wrapper -->
		</div><!-- .section -->
	<?php
	endwhile;
	wp_reset_postdata();
endif;
