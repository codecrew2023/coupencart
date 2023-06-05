<?php

/**
 *
 *  The template used for displaying page content in page.php
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to cartsy_lite_page add_action
	 *
	 * @hooked cartsy_lite_page_header          - 10
	 * @hooked cartsy_lite_page_content         - 20
	 */
	do_action('cartsy_lite_page');
	?>

</article><!-- #post-## -->