<?php

/**
 * The template for displaying full width pages.
 *
 * Template Name: Full width
 *
 * @package cartsylite
 */

get_header(); ?>

<div id="primary" class="cartsylite-content-area">
	<main id="main" class="cartsylite-site-main" role="main">

		<?php
		while (have_posts()) :
			the_post();

			do_action('cartsy_lite_page_before');

			get_template_part('content', 'page');

			/**
			 * Functions hooked in to cartsy_lite_page_after action
			 *
			 * @hooked cartsy_lite_display_comments - 10
			 */
			do_action('cartsy_lite_page_after');

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
