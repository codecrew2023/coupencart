<?php
/**
 * The template used for displaying slider
 *
 * @package Catch_Shop
 */

$quantity      = get_theme_mod( 'catch_shop_slider_number', 4 );
$no_of_post    = 0; // for number of posts
$post_list     = array(); // list of valid post/page ids
$catch_shop_type = get_theme_mod( 'catch_shop_slider_type', 'category' );
$show_content  = get_theme_mod( 'catch_shop_slider_content_show', 'hide-content' );
$show_meta     = get_theme_mod( 'catch_shop_slider_meta_show', 'show-meta' );

$args = array(
	'post_type'           => 'page',
	'orderby'             => 'post__in',
	'ignore_sticky_posts' => 1, // ignore sticky posts
);
//Get valid number of posts
for ( $i = 1; $i <= $quantity; $i++ ) {
	$catch_shop_post_id = '';

	$catch_shop_post_id = get_theme_mod( 'catch_shop_slider_page_' . $i );

	if ( $catch_shop_post_id ) {
		$post_list = array_merge( $post_list, array( $catch_shop_post_id ) );

		$no_of_post++;
	}
}

$args['post__in'] = $post_list;

if ( ! $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;

$loop = new WP_Query( $args );

while ( $loop->have_posts() ) :
	$loop->the_post();

	$thumbnail = 'catch-shop-slider';	
	?>
	<article class="<?php echo esc_attr( 'post post-' . get_the_ID() . ' hentry slides' ); ?>">
		<div class="hentry-inner">
			<div class="slider-image-wrapper">
				<a class="cover-link" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
					<?php 
					if  ( has_post_thumbnail() ) {
						the_post_thumbnail( 'catch-shop-slider' );
					} else {
						echo '<img class="wp-post-image" src="' . trailingslashit( get_template_directory_uri() ) . 'assets/images/no-thumb-1920x1080.jpg"/>';
					}
					?>
				</a>
			</div><!-- .slider-image-wrapper -->

			<div class="slider-content-wrapper">
				<div class="entry-container">
					<header class="entry-header">
						<?php 
						$catch_shop_sub_title = get_theme_mod( 'catch_shop_featured_slider_sub_title_' . ( $loop->current_post  + 1 ) );
						if ( $catch_shop_sub_title ) : ?>	
							<h3 class="entry-subtitle">
	                            <span><?php echo esc_html( $catch_shop_sub_title ); ?></span>
	                        </h3>
                        <?php endif; ?>
						<h2 class="entry-title">
							<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
								<?php 
								$catch_shop_title_image = get_theme_mod( 'catch_shop_slider_title_image_' . ( $loop->current_post  + 1 ) );

								the_title( '<span class="title-text">','</span>' ); ?>
							</a>
						</h2>
					</header>

					<?php catch_shop_content_display(); ?>
				</div><!-- .entry-container -->
			</div><!-- .slider-content-wrapper -->
		</div><!-- .hentry-inner -->
	</article><!-- .slides -->
<?php
endwhile;

wp_reset_postdata();
