<?php
/**
 * The template used for displaying testimonial on front page
 *
 * @package Catch_Shop
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<div class="entry-container">
			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div>

			<div class="author-thumb">
				<?php catch_shop_post_thumbnail( 'catch-shop-stats', 'html', true ); ?>
			
				<?php the_title( '<header class="entry-header">
					<h2 class="entry-title">', '</h2></header>' ); ?>
			</div> <!-- .author-thumb -->
		</div><!-- .entry-container -->	
	</div><!-- .hentry-inner -->
</article>
