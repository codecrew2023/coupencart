<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package swing
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php $show_img = get_theme_mod('swing_lite_post_img_show_hide','show');
	if($show_img == 'show'){ ?>
		<?php the_post_thumbnail(); 
	}?>
	<header class="entry-header">
		<?php
		$show_post = get_theme_mod('swing_lite_post_title_show_hide','show');
		if($show_post == 'show'){
			if ( is_singular() ) :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
		}

	$metadata = get_theme_mod('swing_lite_metadata_show_hide','show');
	if($metadata == 'show'){ 

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php swing_lite_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; 
	}?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'swing-lite' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'swing-lite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php swing_lite_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->