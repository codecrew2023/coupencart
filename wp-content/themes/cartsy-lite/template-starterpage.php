<?php

/**
 * The template for displaying for only starter content.
 *
 * Template Name: Starter Page Template
 *
 * @package cartsylite
 */

get_header(); ?>

<div id="primary" class="cartsylite-content-area">
	<main id="main" class="cartsylite-site-main" role="main">
		<?php get_template_part('content', 'page'); ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
