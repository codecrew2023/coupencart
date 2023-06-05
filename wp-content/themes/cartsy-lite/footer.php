<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 */

?>

<?php do_action('cartsy_lite_content_bottom'); ?>
</div><!-- #content -->
<?php do_action('cartsy_lite_after_content'); ?>
</div><!-- #page -->

<!-- Content area end -->

<!-- Footer area start -->
<?php do_action('cartsy_lite_before_footer'); ?>

<footer id="colophon" role="contentinfo" class="cartsylite-site-footer cartsylite-footer-default">
	<div class="site-info">
		<?php
		/**
		 * Functions hooked in to cartsy_lite_footer action
		 *
		 * @hooked cartsy_footer_copyright    - 5
		 * @hooked cartsy_footer_social       - 10
		 */
		do_action('cartsy_lite_footer');
		?>
	</div>

</footer>

<?php do_action('cartsy_lite_after_footer'); ?>
<!-- Footer area end -->


<?php wp_footer(); ?>
</body>

</html>