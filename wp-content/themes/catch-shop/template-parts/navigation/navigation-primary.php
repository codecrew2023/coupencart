<?php
/**
 * Displays Primary Navigation
 *
 * @package Catch_Store
 */
?>
<div id="header-navigation-area">
	<div class="wrapper">
		<div class="menu-toggle-wrapper">
       		<button id="menu-toggle" class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
       			<?php echo catch_shop_get_svg( array( 'icon' => 'bars' ) ); echo catch_shop_get_svg( array( 'icon' => 'close' ) ); ?>
       			
	       		<span class="menu-label"><?php esc_html_e( 'Menu', 'catch-shop' ); ?></span>
			</button>
		</div><!-- .menu-toggle-wrapper -->

		<div id="site-header-menu" class="site-primary-menu">
			<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
				<nav id="site-primary-navigation" class="main-navigation site-navigation custom-primary-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'catch-shop' ); ?>">
					<?php wp_nav_menu( array(
						'theme_location'	=> 'menu-1',
						'container_class'	=> 'primary-menu-container',
						'menu_class'		=> 'primary-menu',
					) ); ?>
				</nav><!-- #site-primary-navigation.custom-primary-menu -->
			<?php else : ?>
				<nav id="site-primary-navigation" class="main-navigation site-navigation default-page-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'catch-shop' ); ?>">
					<?php wp_page_menu(
						array(
							'menu_class' => 'primary-menu-container',
							'before'     => '<ul id="primary-page-menu" class="primary-menu">',
							'after'      => '</ul>',
						)
					); ?>
				</nav><!-- #site-primary-navigation.default-page-menu -->
			<?php endif; ?>

			<?php if ( get_theme_mod( 'catch_shop_primary_search_enable', 1 ) ) : ?> 
			<div class="mobile-search">
				<div class="search-container">
					<?php get_search_form(); ?>
				</div>
			</div><!-- .mobile-search -->
			<?php endif; ?>

			<?php if ( has_nav_menu( 'social-header-left' ) ) : ?>
				<div class="mobile-search">
					<?php get_template_part( 'template-parts/navigation/navigation-social-header-left' );  ?>
				</div><!-- .mobile-social -->
			<?php endif; ?>

		</div><!-- .site-primary-menu -->
	</div><!-- .wrapper -->
</div><!-- #header-navigation-area -->
