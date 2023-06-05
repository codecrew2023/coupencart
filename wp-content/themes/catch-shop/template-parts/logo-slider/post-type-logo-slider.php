<?php
/**
 * The template used for displaying logo_slider
 *
 * @package Catch_Shop
 */
$quantity      = get_theme_mod( 'catch_shop_logo_slider_number', 7 );
$no_of_post    = 0; // for number of posts
$post_list     = array(); // list of valid post/page ids

$args = array(
	'post_type'           => 'page',
	'ignore_sticky_posts' => 1, // ignore sticky posts
);

//Get valid number of posts
for ( $i = 1; $i <= $quantity; $i++ ) {
	$catch_shop_post_id = get_theme_mod( 'catch_shop_logo_slider_page_' . $i );

	if ( $catch_shop_post_id && '' !== $catch_shop_post_id ) {
		$post_list = array_merge( $post_list, array( $catch_shop_post_id ) );

		$no_of_post++;
	}
}

$args['post__in'] = $post_list;
$args['orderby'] = 'post__in';

if ( ! $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;

$loop = new WP_Query( $args );

while ( $loop->have_posts() ) :
	$loop->the_post();

	$classes = 'post post-' . get_the_ID() . ' hentry slides';

	// Default value if there is no featurd image or first image.
	$image_url = trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/images/no-thumb-140x80.jpg';

	if ( has_post_thumbnail() ) {
		$image_url = get_the_post_thumbnail_url( get_the_ID(), 'catch-shop-logo-slider' );
	} else {
		// Get the first image in page, returns false if there is no image.
		$first_image_url = catch_shop_get_first_image( get_the_ID(), 'catch-shop-logo-slider', '', true );

		// Set value of image as first image if there is an image present in the page.
		if ( $first_image_url ) {
			$image_url = $first_image_url;
		}
	}
	?>
	<article class="<?php echo esc_attr( $classes ); ?>">
		<div class="hentry-inner">
			<div class="second-content-thumbnail post-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<img src="<?php echo esc_url( $image_url ); ?>" class="wp-post-image" alt="<?php the_title_attribute(); ?>">
					</a>
			</div><!-- .logo_slider-image-wrapper -->

			<?php if ( get_theme_mod( 'catch_shop_logo_slider_display_title' ) ) : ?>
			<div class="entry-container">
				<header class="entry-header">
					<h2 class="entry-title">
						<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>
				</header>
			</div><!-- .entry-container -->
			<?php endif; ?>
		</div><!-- .hentry-inner -->
	</article><!-- .slides -->
<?php
endwhile;

wp_reset_postdata();
