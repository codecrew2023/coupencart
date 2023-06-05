<?php

/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cartsy Lite
 */
/** 
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php
	if (have_comments()) :
	?>
		<h2 class="comments-title">
			<?php
			$cartsy_lite_comment_count = get_comments_number();
			if ('1' === $cartsy_lite_comment_count) {
				printf(
					/* translators: 1: title. */
					esc_html__('One Comment on &ldquo;%1$s&rdquo;', 'cartsy-lite'),
					'<span>' . get_the_title() . '</span>' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			} else {
				printf(
					/* translators: 1: comment count number, 2: title. */
					esc_html(_nx('%1$s Comment on &ldquo;%2$s&rdquo;', '%1$s Comments on &ldquo;%2$s&rdquo;', $cartsy_lite_comment_count, 'comments title', 'cartsy-lite')),
					number_format_i18n($cartsy_lite_comment_count), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . get_the_title() . '</span>' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}
			?>
		</h2><!-- .comments-title -->
		<ol class="comment-list">
			<?php
			wp_list_comments(array(
				'style'      => 'ol',
				'short_ping' => true,
				'callback'   => 'cartsy_lite_comments',
				'avatar_size' => 60,
			));
			?>
		</ol><!-- .comment-list -->
		<?php
		the_comments_navigation();
		if (!comments_open()) :
		?>
			<p class="no-comments">
				<?php esc_html_e('Comments are closed.', 'cartsy-lite'); ?>
			</p>
	<?php
		endif;
	endif; // Check for have_comments().
	?>
	<?php comment_form(apply_filters('comment_form_args', array())); ?>
</div><!-- #comments -->