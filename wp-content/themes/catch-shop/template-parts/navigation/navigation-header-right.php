<?php
/**
 * Displays Header Right Navigation
 *
 * @package Catch_Store
 */
?>

<div class="header-right-container">
	<div id="site-header-right-menu" class="site-secondary-menu">
		<div class="secondary-search-wrapper">
			<div id="search-container-main">
				<button id="search-toggle-main" class="menu-search-main-toggle">
					<?php echo catch_shop_get_svg( array( 'icon' => 'search' ) ); echo catch_shop_get_svg( array( 'icon' => 'close' ) ); ?>
					<?php echo '<span class="menu-label-prefix">'. esc_attr__( 'Search ', 'catch-shop' ) . '</span>'; ?>
				</button>

	        	<div class="search-container">
	            	<?php get_search_form(); ?>
	            </div><!-- .search-container -->
			</div><!-- #search-social-container -->
		</div><!-- .secondary-search-wrapper -->
	</div><!-- #site-header-right-menu -->
	
	<?php

	if ( function_exists( 'catch_shop_header_right_cart_account' ) ) {
		catch_shop_header_right_cart_account();
	}
	?>
</div>
