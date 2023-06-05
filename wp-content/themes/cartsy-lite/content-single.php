<?php
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

$cartsy_lite_blogSingleBannerSwitch = "on";
if (function_exists('cartsy_lite_global_option_data')) {
	$cartsy_lite_blogSingleBannerSwitch = cartsy_lite_global_option_data('cartsy_lite_blog_banner_switch', 'on');
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if (has_post_thumbnail()) : ?>
		<div class="entry-media">
			<?php
			if (function_exists('cartsy_lite_post_thumbnail')) {
				cartsy_lite_post_thumbnail();
			}
			?>
		</div>
	<?php endif; ?>
	<!-- .entry-media -->

	<header class="entry-header">
		<?php
		if ('post' === get_post_type()) :
		?>
			<div class="entry-meta">
				<?php
				cartsy_lite_post_meta();
				?>
			</div>
			<!-- .entry-meta -->
		<?php endif; ?>

		<?php
		if (!empty($cartsy_lite_blogSingleBannerSwitch) && $cartsy_lite_blogSingleBannerSwitch === 'off') {
			the_title('<h1 class="entry-title">', '</h1>');
		}
		?>
	</header>
	<!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content(sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				esc_html__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'cartsy-lite'),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		));

		wp_link_pages(array(
			'before' => '<div class="page-links">' . esc_html__('Pages:', 'cartsy-lite'),
			'after'  => '</div>',
		));

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					'%1$s<span class="screen-reader-text">%2$s</span>',
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				esc_html__("Edit", 'cartsy-lite'),
				get_the_title()
			),
			'<div class="edit-link">',
			'</div>'
		);

		?>
	</div>
	<!-- .entry-content -->
</article>
<!-- #post-<?php the_ID(); ?> -->

<?php
$cartsy_lite_tagsList = get_the_tag_list('', esc_html_x(', ', 'Comma used between tag items.', 'cartsy-lite'));
$cartsy_lite_categoriesList = get_the_category_list(esc_html_x(', ', 'Comma used between category items.', 'cartsy-lite'));

if ($cartsy_lite_tagsList) {
	printf(
		'<div class="entry-post-tags"> 
          <span class="tag-title">%1$s </span>
          <span class="tag-items">%2$s</span>
          </div>',
		esc_html_x('Tags: ', 'Used before tag items.', 'cartsy-lite'),
		$cartsy_lite_tagsList // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	);
}
// end of .entry-post-tag

if ($cartsy_lite_categoriesList) {
	printf(
		'<div class="entry-post-categories">
          <span class="cat-title">%1$s </span>
          <span class="cat-items">%2$s</span>
          </div>',
		esc_html_x('Categories :', 'Used before category items.', 'cartsy-lite'),
		$cartsy_lite_categoriesList // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	);
}
// end of .entry-post-category

if (is_singular('attachment')) {
	the_post_navigation(
		array(
			/* translators: %s: parent post link */
			'prev_text' => sprintf(
				('<span class="meta-nav">%1$s</span><span class="post-title">%2$s</span>'),
				esc_html__( 'Published in', 'cartsy-lite' ),
				'%title'
			),
		)
	);
} elseif (is_singular('post')) {
	if (function_exists('cartsy_lite_post_navigation')) {
		cartsy_lite_post_navigation();
	}
}
// end of .post-navigation
