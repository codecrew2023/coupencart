<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Catch_Shop
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="archive-posts-wrapper <?php echo esc_attr( catch_shop_get_posts_columns() ); ?>">
			<?php if ( have_posts() ) :

				$catch_shop_tagline     = get_theme_mod( 'catch_shop_recent_posts_tagline', esc_html__( 'Latest Updates', 'catch-shop' ) );
				$catch_shop_title       = get_theme_mod( 'catch_shop_recent_posts_title', esc_html__( 'From Our Blog', 'catch-shop' ) );
				$catch_shop_description = get_theme_mod( 'catch_shop_recent_posts_description' );

				catch_shop_heading_wrapper( $catch_shop_tagline, $catch_shop_title, $catch_shop_description ); ?>

				<div class="section-content-wrapper">
					<div id="infinite-post-wrap" class="archive-post-wrap">
						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content/content', get_post_format() );

						endwhile;
						?>
					</div><!-- .archive-post-wrap -->
				</div><!-- .section-content-wrap -->

				<?php catch_shop_content_nav(); ?>

				<?php
				else :

					get_template_part( 'template-parts/content/content', 'none' );

				endif; ?>
			</div><!-- .archive-post-wrapper -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar();
get_footer();
