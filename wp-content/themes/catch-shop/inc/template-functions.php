<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Catch_Shop
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @since 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function catch_shop_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Always add a front-page class to the front page.
	if ( is_front_page() && ! is_home() ) {
		$classes[] = 'page-template-front-page';
	}

	$classes['site-layout'] = 'fluid-layout';

	$menu = get_theme_mod( 'catch_shop_menu_type', 'classic' );
	
	// Adds a class of navigation-(default|classic) to blogs.
	if ( 'classic' === $menu ) {
		$classes[] = 'navigation-classic';
	} else {
		$classes[] = 'navigation-default';
	}

	// Adds a class with respect to layout selected.
	$layout  = catch_shop_get_theme_layout();
	$sidebar = catch_shop_get_sidebar_id();

	$layout_class = 'no-sidebar full-width-layout';
	
	if ( 'right-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$layout_class = 'two-columns-layout content-left';
		}
	}

	$classes[] = $layout_class;

	$classes['archive-layout'] = 'excerpt';

	$classes[] = 'header-media-fluid';

	$enable_slider = catch_shop_check_section( get_theme_mod( 'catch_shop_slider_option', 'disabled' ) );

	$header_image = catch_shop_featured_overall_image();

	if ( 'disable' !== $header_image ) {
		$classes[] = 'has-header-media';
	}

	if ( ! catch_shop_has_header_media_text() ) {
		$classes[] = 'header-media-text-disabled';
	}

	// Add a class if there is a custom header.
	if ( has_header_image() ) {
		$classes[] = 'has-header-image';
	}

	if ( ! ( has_nav_menu( 'social-header-left' ) ) ) {
    	$classes[] = 'header-main-left-disabled';
    }

	// Added color scheme to body class.
	$classes[] = 'color-scheme-' . esc_attr( get_theme_mod( 'color_scheme', 'default' ) );

	$my_account     = get_theme_mod( 'catch_shop_primary_menu_my_account_enable' );
	$product_search = get_theme_mod( 'catch_shop_primary_menu_search_enable' );
	$cart           = get_theme_mod( 'catch_shop_primary_menu_cart_enable' );

	if ( ! $my_account && ! $product_search && ! $cart ) {
		$classes[] = 'primary-nav-center';
	}

	return $classes;
}
add_filter( 'body_class', 'catch_shop_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function catch_shop_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'catch_shop_pingback_header' );

/**
 * Adds custom overlay for Promotion Headline Background Image
 */
function catch_shop_promo_head_bg_image_overlay_css() {
	$enable   = get_theme_mod( 'catch_shop_promo_head_visibility', 'disabled' );

	if ( ! catch_shop_check_section( $enable ) ) {
		// Bail if contact section is disabled.
		return;
	}

	$overlay = get_theme_mod( 'catch_shop_promo_head_background_image_opacity', 20 );

	$css = '';

	$overlay_bg = $overlay / 100;

	if ( $overlay ) {
		$css = '.promotion-section .cover-link:before {
					background-color: rgba(0, 0, 0, ' . esc_attr( $overlay_bg ) . ' );
			    } '; // Dividing by 100 as the option is shown as % for user
	}

	wp_add_inline_style( 'catch-shop-style', $css );
}
add_action( 'wp_enqueue_scripts', 'catch_shop_promo_head_bg_image_overlay_css', 11 );

/**
 * Adds custom overlay for Promotion Headline Background Image
 */
function catch_shop_special_right_bg_image_overlay_css() {
	$enable   = get_theme_mod( 'catch_shop_special_visibility', 'disabled' );

	if ( ! catch_shop_check_section( $enable ) ) {
		// Bail if contact section is disabled.
		return;
	}

	$overlay = get_theme_mod( 'catch_shop_special_right_background_image_opacity', 20 );

	$css = '';

	$overlay_bg = $overlay / 100;

	if ( $overlay ) {
		$css = '#special-right .cover-link:before {
					background-color: rgba(0, 0, 0, ' . esc_attr( $overlay_bg ) . ' );
			    } '; // Dividing by 100 as the option is shown as % for user
	}

	wp_add_inline_style( 'catch-shop-style', $css );
}
add_action( 'wp_enqueue_scripts', 'catch_shop_special_right_bg_image_overlay_css', 11 );

function catch_shop_header_media_image_overlay_css() {
	$overlay = get_theme_mod( 'catch_shop_header_media_image_opacity' );

	$css = '';

	$overlay_bg = $overlay / 100;

	if ( $overlay ) {
	$css = '.custom-header-overlay {
		background-color: rgba(0, 0, 0, ' . esc_attr( $overlay_bg ) . ' );
    } '; // Dividing by 100 as the option is shown as % for user
}

	wp_add_inline_style( 'catch-shop-style', $css );
}
add_action( 'wp_enqueue_scripts', 'catch_shop_header_media_image_overlay_css', 11 );

/**
 * Remove first post from blog as it is already show via recent post template
 */
function catch_shop_alter_home( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$cats = get_theme_mod( 'catch_shop_front_page_category' );

		if ( is_array( $cats ) && ! in_array( '0', $cats ) ) {
			$query->query_vars['category__in'] = $cats;
		}

		if ( get_theme_mod( 'catch_shop_exclude_slider_post' ) ) {
			$quantity = get_theme_mod( 'catch_shop_slider_number', 4 );

			$post_list	= array();	// list of valid post ids

			for( $i = 1; $i <= $quantity; $i++ ){
				if ( get_theme_mod( 'catch_shop_slider_post_' . $i ) && get_theme_mod( 'catch_shop_slider_post_' . $i ) > 0 ) {
					$post_list = array_merge( $post_list, array( get_theme_mod( 'catch_shop_slider_post_' . $i ) ) );
				}
			}

			if ( ! empty( $post_list ) ) {
	    		$query->query_vars['post__not_in'] = $post_list;
			}
		}
	}
}
add_action( 'pre_get_posts', 'catch_shop_alter_home' );

/**
 * Function to add Scroll Up icon
 */
function catch_shop_scrollup() {
	$disable_scrollup =  ! get_theme_mod( 'catch_shop_disable_scrollup', 1 );

	if ( $disable_scrollup ) {
		return;
	}

	echo '<a href="#masthead" id="scrollup" class="backtotop">' . catch_shop_get_svg( array( 'icon' => 'scrollup' ) ) . '<span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'catch-shop' ) . '</span></a>' ;

}
add_action( 'wp_footer', 'catch_shop_scrollup', 1 );

if ( ! function_exists( 'catch_shop_content_nav' ) ) :
	/**
	 * Display navigation/pagination when applicable
	 *
	 * @since 1.0
	 */
	function catch_shop_content_nav() {
		global $wp_query;

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$pagination_type = get_theme_mod( 'catch_shop_pagination_type', 'default' );

		if ( ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) || class_exists( 'Catch_Infinite_Scroll' ) ) {
			// Support infinite scroll plugins.
			the_posts_navigation();
		} elseif ( 'numeric' === $pagination_type && function_exists( 'the_posts_pagination' ) ) {
			the_posts_pagination( array(
				'prev_text'          => '<span>' . esc_html__( 'Prev', 'catch-shop' ) . '</span>',
				'next_text'          => '<span>' . esc_html__( 'Next', 'catch-shop' ) . '</span>',
				'screen_reader_text' => '<span class="nav-subtitle screen-reader-text">' . esc_html__( 'Page', 'catch-shop' ) . ' </span>',
			) );
		} else {
			the_posts_navigation();
		}
	}
endif; // catch_shop_content_nav

/**
 * Check if a section is enabled or not based on the $value parameter
 * @param  string $value Value of the section that is to be checked
 * @return boolean return true if section is enabled otherwise false
 */
function catch_shop_check_section( $value ) {
	return ( 'entire-site' == $value  || ( is_front_page() && 'homepage' === $value ) );
}

/**
 * Return the first image in a post. Works inside a loop.
 * @param [integer] $post_id [Post or page id]
 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param [string/array] $attr Query string or array of attributes.
 * @return [string] image html
 *
 * @since 1.0
 */
function catch_shop_get_first_image( $postID, $size, $attr, $src = false ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field('post_content', $postID ) , $matches);

	if ( isset( $matches[1][0] ) ) {
		// Get first image.
		$first_img = $matches[1][0];

		if ( $src ) {
			//Return url of src is true
			return $first_img;
		}

		return '<img class="wp-post-image" src="'. esc_url( $first_img ) .'">';
	}

	return false;
}

function catch_shop_get_posts_columns() {
	$columns = 'layout-one';

	if ( is_front_page() ) {
		$columns = 'layout-three';
	}

	return $columns;
}

function catch_shop_get_theme_layout() {
	$layout = '';

	if ( is_page_template( 'templates/full-width-page.php' ) ) {
		$layout = 'no-sidebar-full-width';
	} elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
		$layout = 'right-sidebar';
	} else {
		$layout = get_theme_mod( 'catch_shop_default_layout', 'right-sidebar' );

		if ( is_home() || is_archive() ) {
			$layout = get_theme_mod( 'catch_shop_homepage_archive_layout', 'no-sidebar-full-width' );
		}

		if ( class_exists( 'WooCommerce' ) && ( is_shop() || is_woocommerce() || is_cart() || is_checkout() ) ) {
			$layout = get_theme_mod( 'catch_shop_woocommerce_layout', 'right-sidebar' );
		}
	}

	return $layout;
}

function catch_shop_get_sidebar_id() {
	$sidebar = $id = '';

	$layout = catch_shop_get_theme_layout();

	if ( 'no-sidebar-full-width' === $layout || 'no-sidebar' === $layout ) {
		return $sidebar;
	}

	if ( is_active_sidebar( 'sidebar-woo' ) && class_exists( 'WooCommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() ) ) {
		$sidebar = 'sidebar-woo'; // WooCommerce Sidebar.
	} elseif ( is_active_sidebar( 'sidebar-1' ) ) {
		$sidebar = 'sidebar-1'; // Primary Sidebar.
	}

	return $sidebar;
}

if ( ! function_exists( 'catch_shop_truncate_phrase' ) ) :
	/**
	 * Return a phrase shortened in length to a maximum number of characters.
	 *
	 * Result will be truncated at the last white space in the original string. In this function the word separator is a
	 * single space. Other white space characters (like newlines and tabs) are ignored.
	 *
	 * If the first `$max_characters` of the string does not contain a space character, an empty string will be returned.
	 *
	 * @since 1.0
	 *
	 * @param string $text            A string to be shortened.
	 * @param integer $max_characters The maximum number of characters to return.
	 *
	 * @return string Truncated string
	 */
	function catch_shop_truncate_phrase( $text, $max_characters ) {

		$text = trim( $text );

		if ( mb_strlen( $text ) > $max_characters ) {
			//* Truncate $text to $max_characters + 1
			$text = mb_substr( $text, 0, $max_characters + 1 );

			//* Truncate to the last space in the truncated string
			$text = trim( mb_substr( $text, 0, mb_strrpos( $text, ' ' ) ) );
		}

		return $text;
	}
endif; //catch_shop_truncate_phrase

if ( ! function_exists( 'catch_shop_get_the_content_limit' ) ) :
	/**
	 * Return content stripped down and limited content.
	 *
	 * Strips out tags and shortcodes, limits the output to `$max_char` characters, and appends an ellipsis and more link to the end.
	 *
	 * @since 1.0
	 *
	 * @param integer $max_characters The maximum number of characters to return.
	 * @param string  $more_link_text Optional. Text of the more link. Default is "(more...)".
	 * @param bool    $stripteaser    Optional. Strip teaser content before the more text. Default is false.
	 *
	 * @return string Limited content.
	 */
	function catch_shop_get_the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {

		$content = get_the_content( '', $stripteaser );

		// Strip tags and shortcodes so the content truncation count is done correctly.
		$content = strip_tags( strip_shortcodes( $content ), apply_filters( 'get_the_content_limit_allowedtags', '<script>,<style>' ) );

		// Remove inline styles / .
		$content = trim( preg_replace( '#<(s(cript|tyle)).*?</\1>#si', '', $content ) );

		// Truncate $content to $max_char
		$content = catch_shop_truncate_phrase( $content, $max_characters );

		// More link?
		if ( $more_link_text ) {
			$link   = apply_filters( 'get_the_content_more_link', sprintf( '<a href="%s" class="more-link">%s</a>', esc_url( get_permalink() ), $more_link_text ), $more_link_text );
			$output = sprintf( '<p>%s %s</p>', $content, $link );
		} else {
			$output = sprintf( '<p>%s</p>', $content );
			$link = '';
		}

		return apply_filters( 'catch_shop_get_the_content_limit', $output, $content, $link, $max_characters );

	}
endif; //catch_shop_get_the_content_limit

/**
 * Get Featured Posts
 */
function catch_shop_get_posts( $section ) {
	$type   = get_theme_mod( 'catch_shop_feat_cont_type', 'category' );
	$number = get_theme_mod( 'catch_shop_feat_cont_number', 3 );

	if ( 'feat_cont' === $section ) {
		$type     = get_theme_mod( 'catch_shop_feat_cont_type', 'category' );
		$number   = get_theme_mod( 'catch_shop_feat_cont_number', 3 );
		$cpt_slug = 'featured-content';
	} elseif ( 'portfolio' === $section ) {
		$type     = get_theme_mod( 'catch_shop_portfolio_type', 'category' );
		$number   = get_theme_mod( 'catch_shop_portfolio_number', 5 );
		$cpt_slug = 'jetpack-portfolio';
	} elseif ( 'service' === $section ) {
		$type     = get_theme_mod( 'catch_shop_service_type', 'category' );
		$number   = get_theme_mod( 'catch_shop_service_number', 3 );
		$cpt_slug = 'ect-service';
	} elseif ( 'team' === $section ) {
		$type     = get_theme_mod( 'catch_shop_team_type', 'category' );
		$number   = get_theme_mod( 'catch_shop_team_number', 3 );
		$cpt_slug = ''; // Event has no cpt.
	} elseif ( 'stats' === $section ) {
		$type     = get_theme_mod( 'catch_shop_stats_type', 'category' );
		$number   = get_theme_mod( 'catch_shop_stats_number', 4 );
		$cpt_slug = ''; // Event has no cpt.
	} elseif ( 'testimonial' === $section ) {
		$type     = get_theme_mod( 'catch_shop_testimonial_type', 'category' );
		$number   = get_theme_mod( 'catch_shop_testimonial_number', 4 );
		$cpt_slug = 'jetpack-testimonial';
	}

	$post_list  = array();
	$no_of_post = 0;

	$args = array(
		'post_type'           => 'post',
		'ignore_sticky_posts' => 1, // ignore sticky posts.
	);

	// Get valid number of posts.
	if ( 'post' === $type || 'page' === $type || $cpt_slug === $type || 'product' === $type ) {
		$args['post_type'] = $type;

		for ( $i = 1; $i <= $number; $i++ ) {
			$post_id = '';

			if ( 'post' === $type ) {
				$post_id = get_theme_mod( 'catch_shop_' . $section . '_post_' . $i );
			} elseif ( 'page' === $type ) {
				$post_id = get_theme_mod( 'catch_shop_' . $section . '_page_' . $i );
			} elseif ( $cpt_slug === $type ) {
				$post_id = get_theme_mod( 'catch_shop_' . $section . '_cpt_' . $i );
			} elseif ( 'product' === $type ) {
				$post_id = get_theme_mod( 'catch_shop_' . $section . '_product_' . $i );
			}

			if ( $post_id && '' !== $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );

				$no_of_post++;
			}
		}

		$args['post__in'] = $post_list;
		$args['orderby']  = 'post__in';
	} elseif ( 'category' === $type ) {
		if ( $cat = get_theme_mod( 'catch_shop_' . $section . '_select_category' ) ) {
			$args['category__in'] = $cat;
		}


		$no_of_post = $number;
	}

	$args['posts_per_page'] = $no_of_post;

	if( ! $no_of_post ) {
		return;
	}

	$posts = get_posts( $args );

	return $posts;
}

if ( ! function_exists( 'catch_shop_sections' ) ) :
	/**
	 * Display Sections on header
	 */
	function catch_shop_sections() {
		get_template_part( 'template-parts/header/header-media' );
		get_template_part( 'template-parts/slider/display-slider' );
		get_template_part( 'template-parts/logo-slider/display-logo-slider' );
		get_template_part( 'template-parts/woo-products/featured-products' );
		get_template_part( 'template-parts/promotion-headline/content-promotion' );
		get_template_part( 'template-parts/testimonial/display-testimonial' );
		get_template_part( 'template-parts/countdown/display-countdown' );
	}
endif;

if ( ! function_exists( 'catch_shop_get_no_thumb_image' ) ) :
	/**
	 * $image_size post thumbnail size
	 * $type image, src
	 */
	function catch_shop_get_no_thumb_image( $image_size = 'post-thumbnail', $type = 'image' ) {
		$image = $image_url = '';

		global $_wp_additional_image_sizes;

		$size = $_wp_additional_image_sizes['post-thumbnail'];

		if ( isset( $_wp_additional_image_sizes[ $image_size ] ) ) {
			$size = $_wp_additional_image_sizes[ $image_size ];
		}

		$image_url  = trailingslashit( get_template_directory_uri() ) . 'assets/images/no-thumb.jpg';

		if ( 'post-thumbnail' !== $image_size ) {
			$image_url  = trailingslashit( get_template_directory_uri() ) . 'assets/images/no-thumb-' . $size['width'] . 'x' . $size['height'] . '.jpg';
		}

		if ( 'src' === $type ) {
			return $image_url;
		}

		return '<img class="no-thumb ' . esc_attr( $image_size ) . '" src="' . esc_url( $image_url ) . '" />';
	}
endif;

function catch_shop_team_social( $link ) {
    // Get supported social icons.
    $social_icons = catch_shop_social_links_icons();

    foreach ( $social_icons as $attr => $value ) {
        if ( false !== strpos( $link, $attr ) ) {
            return catch_shop_get_svg( array( 'icon' => esc_attr( $value ) ) );
        }
    }
}

if ( ! function_exists( 'catch_shop_team_social_links' ) ) :
	/**
	 * Displays team social links html
	 */
	function catch_shop_team_social_links( $counter ) {
		?>
		<div class="artist-social-profile">
            <nav class="social-navigation" role="navigation" aria-label="Social Menu">
                <div class="menu-social-container">
                    <ul id="menu-social-menu" class="social-links-menu">
				        <?php
				        $social_link_one = get_theme_mod( 'catch_shop_team_social_link_one_' . $counter );
				    	if ( $social_link_one ): ?>
				            <li class="menu-item-one">
				                <a target="_blank" rel="nofollow" href="<?php echo esc_url( $social_link_one ); ?>"><?php echo catch_shop_team_social( $social_link_one ); // WPCS: XSS ok. ?></a>
				            </li>
				    	<?php endif;  ?>

						<?php
				    	$social_link_two = get_theme_mod( 'catch_shop_team_social_link_two_' . $counter );
				    	if ( $social_link_two ): ?>
				            <li class="menu-item-two">
				                <a target="_blank" rel="nofollow" href="<?php echo esc_url( $social_link_two ); ?>"><?php echo catch_shop_team_social( $social_link_two ); // WPCS: XSS ok. ?></a>
				            </li>
				    	<?php endif;  ?>

				    	<?php
				    	$social_link_three = get_theme_mod( 'catch_shop_team_social_link_three_' . $counter );
				    	if ( $social_link_three ): ?>
				            <li class="menu-item-three">
				                <a target="_blank" rel="nofollow" href="<?php echo esc_url( $social_link_three ); ?>"><?php echo catch_shop_team_social( $social_link_three ); // WPCS: XSS ok. ?></a>
				            </li>
				    	<?php endif;  ?>

				    	<?php
				    	$social_link_four = get_theme_mod( 'catch_shop_team_social_link_four_' . $counter );
				    	if ( $social_link_four ): ?>
				            <li class="menu-item-four">
				                <a target="_blank" rel="nofollow" href="<?php echo esc_url( $social_link_four ); ?>"><?php echo catch_shop_team_social( $social_link_four ); // WPCS: XSS ok. ?></a>
				            </li>
				    	<?php endif; ?>
				    </ul>
				</div>
			</nav>
		</div><!-- .artist-social-profile -->
		<?php
	}
endif;

if ( ! function_exists( 'catch_shop_post_thumbnail' ) ) :
	/**
	 * $image_size post thumbnail size
	 * $type html, html-with-bg, url
	 * $echo echo true/false
	 * $no_thumb display no-thumb image or not
	 */
	function catch_shop_post_thumbnail( $image_size = 'post-thumbnail', $type = 'html', $echo = true, $no_thumb = false ) {
		$image = $image_url = '';
		
		if ( has_post_thumbnail() ) {
			$image_url = get_the_post_thumbnail_url( get_the_ID(), $image_size );
			$image     = get_the_post_thumbnail( get_the_ID(), $image_size );
		} else {
			if ( $no_thumb ) {
				global $_wp_additional_image_sizes;

				$image_url  = trailingslashit( get_template_directory_uri() ) . 'assets/images/no-thumb-' . $_wp_additional_image_sizes[ $image_size ]['width'] . 'x' . $_wp_additional_image_sizes[ $image_size ]['height'] . '.jpg';
				$image      = '<img src="' . esc_url( $image_url ) . '" alt="" />';
			}

			// Get the first image in page, returns false if there is no image.
			$first_image_url = catch_shop_get_first_image( get_the_ID(), $image_size, '', true );

			// Set value of image as first image if there is an image present in the page.
			if ( $first_image_url ) {
				$image_url = $first_image_url;
				$image = '<img class="wp-post-image" src="'. esc_url( $image_url ) .'">';
			}
		}

		if ( ! $image_url ) {
			// Bail if there is no image url at this stage.
			return;
		}

		if ( 'url' === $type ) {
			return $image_url;
		}

		$output = '<div';

		if ( 'html-with-bg' === $type ) {
			$output .= ' class="post-thumbnail-background" style="background-image: url( ' . esc_url( $image_url ) . ' )"';
		} else {
			$output .= ' class="post-thumbnail"';
		}

		$output .= '>';

		$output .= '<a class="cover-link" href="' . esc_url( get_the_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '">';

		if ( 'html-with-bg' !== $type ) {
			$output .= $image;
		}

		$output .= '</a></div><!-- .post-thumbnail -->';

		if ( ! $echo ) {
			return $output;
		}

		echo $output;
	}
endif;
