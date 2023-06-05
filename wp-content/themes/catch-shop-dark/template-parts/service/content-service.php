<?php
/**
 * The template for displaying service posts on the front page
 *
 * @package Catch_Shop
 */

$show_content    = get_theme_mod( 'catch_shop_service_show', 'excerpt' );
$number          = get_theme_mod( 'catch_shop_service_number', 3 );

$post_list  = array();
$no_of_post = 0;


// Get valid number of posts.
for ( $i = 1; $i <= $number; $i++ ) {
	$catch_shop_post_id = get_theme_mod( 'catch_shop_service_cpt_' . $i );

	if ( $catch_shop_post_id ) {
		$post_list = array_merge( $post_list, array( $catch_shop_post_id ) );

		$no_of_post++;
	}
}

$args = array(
	'post_type'           => 'ect-service',
	'ignore_sticky_posts' => 1, // ignore sticky posts.
	'post__in'            => $post_list,
	'orderby'             => 'post__in',
	'posts_per_page'      => $no_of_post,
);

if ( ! $no_of_post ) {
	return;
}

$loop = new WP_Query( $args );

while ( $loop->have_posts() ) :
	
	$loop->the_post();
	$no_thumb = trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/images/no-thumb-80x80.jpg';
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="hentry-inner">
			<?php if( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail">
					<a class="cover-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<img src="<?php the_post_thumbnail_url( array(80, 80) ); ?>">
					</a>
				</div>
			<?php else : ?>
				<div class="post-thumbnail">
					<a class="cover-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<img src="<?php echo esc_url( $no_thumb ); ?>">
					</a>
				</div>
			<?php endif; ?>

			<div class="entry-container">
				<header class="entry-header">
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
				</header>

				<?php catch_shop_content_display(); ?>
			</div><!-- .entry-container -->
		</div> <!-- .hentry-inner -->
	</article> <!-- .article -->
	<?php
endwhile;

wp_reset_postdata();
