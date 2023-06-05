<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @package Catch_Shop
 */
$number        = get_theme_mod( 'catch_shop_featured_content_number', 3 );
$post_list     = array();
$no_of_post    = 0;

$args = array(
	'post_type'           => 'featured-content',
	'ignore_sticky_posts' => 1, // ignore sticky posts.
);

// Get valid number of posts.
for ( $i = 1; $i <= $number; $i++ ) {
	$catch_shop_post_id = '';

	$catch_shop_post_id = get_theme_mod( 'catch_shop_featured_content_cpt_' . $i );

	if ( $catch_shop_post_id ) {
		$post_list = array_merge( $post_list, array( $catch_shop_post_id ) );

		$no_of_post++;
	}
}

$args['post__in'] = $post_list;
$args['orderby']  = 'post__in';

if ( ! $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;

$loop = new WP_Query( $args );

$show_content = get_theme_mod( 'catch_shop_featured_content_show', 'excerpt' );

while ( $loop->have_posts() ) :
	
	$loop->the_post();

	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="hentry-inner">
			<?php catch_shop_post_thumbnail( 'catch-shop-content' ); ?>

			<div class="entry-container">
				<header class="entry-header">
					<div class="entry-meta">
						<?php catch_shop_cat_list(); ?>
						<?php catch_shop_by_line(); ?>
					</div><!-- .entry-meta -->
					
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
				</header>
				
				<?php catch_shop_content_display(); ?>
			</div><!-- .entry-container -->
		</div><!-- .hentry-inner -->
	</article>
<?php
endwhile;

wp_reset_postdata();
