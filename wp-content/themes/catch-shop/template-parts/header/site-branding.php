<?php
/**
 * Displays header site branding
 *
 * @package Catch_Store
 */
?>

<div id="header-content">
	<div class="wrapper">
		<div class="site-header-main">
			<?php get_template_part( 'template-parts/navigation/navigation-primary' );  ?>

			<?php get_template_part( 'template-parts/navigation/navigation-social-header-left' );  ?>

			<div class="site-branding">
				<div class="site-branding-wrapper">
					<?php catch_shop_the_custom_logo(); ?>

					<div class="site-identity">
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif;

						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo esc_html( $description ); ?></p>
						<?php endif; ?>
					</div><!-- .site-identity -->
				</div><!-- .site-branding-wrapper -->
			</div><!-- .site-branding -->

			<?php get_template_part( 'template-parts/navigation/navigation-header', 'right' );  ?>
		</div><!-- .site-header-main -->
	</div><!-- .wrapper -->
</div><!-- #header-content -->
