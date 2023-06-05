<?php

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}


/**
 * 
 * Header Hook Functions
 *
 */

if (!function_exists('cartsy_lite_header_wrapper')) {
    /**
     * cartsy_lite_header_wrapper
     *
     * @return void
     */
    function cartsy_lite_header_wrapper()
    {
        $template = 'template-parts/header/wrapper-start';
        get_template_part($template);
    }
}

if (!function_exists('cartsy_lite_skip_links')) {
    /**
     * cartsy_lite_skip_links
     *
     * @return void
     */
    function cartsy_lite_skip_links()
    {
        $template = 'template-parts/global/skip-to-link';
        get_template_part($template);
    }
}

if (!function_exists('cartsy_lite_header_menu')) {
    /**
     * cartsy_lite_header_menu
     *
     * @return void
     */
    function cartsy_lite_header_menu()
    {
        $template = 'template-parts/header/header-menu';
        get_template_part($template);
    }
}


if (!function_exists('cartsy_lite_site_branding')) {
    /**
     * cartsy_lite_site_branding
     *
     * @return void
     */
    function cartsy_lite_site_branding()
    {
        $template = 'template-parts/header/site-branding';
        get_template_part($template);
    }
}

if (!function_exists('cartsy_lite_header_search')) {
    /**
     * cartsy_lite_header_search
     *
     * @return void
     */
    function cartsy_lite_header_search()
    {
        $template = 'template-parts/header/header-search';
        get_template_part($template);
    }
}

if (!function_exists('cartsy_lite_woo_link')) {
    /**
     * cartsy_lite_woo_link
     *
     * @return void
     */
    function cartsy_lite_woo_link()
    {
        $template = 'template-parts/header/woo-link';
        get_template_part($template);
    }
}

if (!function_exists('cartsy_lite_my_account')) {
    /**
     * cartsy_lite_my_account
     *
     * @return void
     */
    function cartsy_lite_my_account()
    {
        $template = 'template-parts/header/my-account';
        get_template_part($template);
    }
}


if (!function_exists('cartsy_lite_mini_cart')) {
    /**
     * cartsy_lite_mini_cart
     *
     * @return void
     */
    function cartsy_lite_mini_cart()
    {
        $template = 'template-parts/header/mini-cart';
        get_template_part($template);
    }
}

if (!function_exists('cartsy_lite_header_wrapper_close')) {
    /**
     * cartsy_lite_header_wrapper_close
     *
     * @return void
     */
    function cartsy_lite_header_wrapper_close()
    {
        $template = 'template-parts/header/wrapper-end';
        get_template_part($template);
    }
}


/**
 * 
 * General Hook Functions
 *
 */


if (!function_exists('cartsy_lite_get_sidebar')) {
    /**
     * Display cartsylite sidebar
     *
     * @uses get_sidebar()
     */
    function cartsy_lite_get_sidebar()
    {
        get_sidebar();
    }
}

if (!function_exists('cartsy_lite_paging_nav')) {
    /**
     *
     *  Display cartsylite post navigation
     *
     */
    function cartsy_lite_paging_nav()
    {
        the_posts_navigation(array(
            'mid_size' => 2,
            'prev_text' => '<i class="dashicons dashicons-arrow-left-alt2"></i>' . esc_html__('Previous', 'cartsy-lite'),
            'next_text' =>  esc_html__('Next', 'cartsy-lite') . '<i class="dashicons dashicons-arrow-right-alt2"></i>',
        ));
    }
}


/**
 * 
 * Page Hook Functions
 *
 */

if (!function_exists('cartsy_lite_page_header')) {
    /**
     * cartsy_lite_page_header
     *
     * @return void
     */
    function cartsy_lite_page_header()
    {
        if (is_front_page() && is_page_template('template-fullwidth.php')) {
            return;
        }
        $cartsy_lite_blog_banner = $cartsy_lite_page_banner = $cartsy_lite_woo_banner = "on";
        if (function_exists('cartsy_lite_global_option_data')) {
            $cartsy_lite_blog_banner = cartsy_lite_global_option_data('cartsy_lite_blog_banner_switch', $cartsy_lite_blog_banner);
            $cartsy_lite_woo_banner  = cartsy_lite_global_option_data('cartsy_lite_woo_banner_switch', $cartsy_lite_woo_banner);
            $cartsy_lite_page_banner = cartsy_lite_global_option_data('cartsy_lite_page_banner_switch', $cartsy_lite_page_banner);
        }
        if ($cartsy_lite_blog_banner === "on" || $cartsy_lite_page_banner === "on" || $cartsy_lite_woo_banner === "on") {
            return;
        }
        ?>
        <header class="entry-header">
            <?php
            the_title('<h1 class="entry-title">', '</h1>');
            ?>
        </header><!-- .entry-header -->
    <?php
    }
}

if (!function_exists('cartsy_lite_page_content')) {
    /**
     *
     * Display the post content
     *
     * @return void
     */
    function cartsy_lite_page_content()
    {
    ?>
        <div class="entry-content">
            <?php the_content(); ?>
            <?php
            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'cartsy-lite'),
                    'after'  => '</div>',
                )
            );
            ?>
        </div><!-- .entry-content -->
<?php
    }
}


if (!function_exists('cartsy_lite_edit_post_link')) {
    /**
     * Display the edit link
     *
     */
    function cartsy_lite_edit_post_link()
    {
        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    '%1$s <span class="screen-reader-text">%2$s</span>',
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                esc_html__('Edit', 'cartsy-lite'),
                get_the_title()
            ),
            '<div class="edit-link">',
            '</div>'
        );
    }
}

/**
 * 
 * Comments Hook Functions
 *
 */

if (!function_exists('cartsy_lite_display_comments')) {
    /**
     *
     *  Cartsylite display comments
     *
     */
    function cartsy_lite_display_comments()
    {
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || 0 !== intval(get_comments_number())) :
            comments_template();
        endif;
    }
}


/**
 * 
 * Footer Hook Functions
 *
 */

if (!function_exists('cartsy_footer_copyright')) {
    /**
     * cartsy_footer_copyright
     *
     * @return void
     */
    function cartsy_footer_copyright()
    {
        $template = 'template-parts/footer/copyright';
        get_template_part($template);
    }
}

if (!function_exists('cartsy_footer_social')) {
    /**
     * cartsy_footer_social
     *
     * @return void
     */
    function cartsy_footer_social()
    {
        $template = 'template-parts/footer/social';
        get_template_part($template);
    }
}

if (!function_exists('cartsy_lite_site_loaded')) {
    /**
     * Page loader.
     *
     * @since 1.2
     */
    function cartsy_lite_site_loaded()
    {
        $cartsy_lite_site_loader = cartsy_lite_global_option_data('cartsy_lite_site_loader', 'on');
        $template = "";
        if (!empty($cartsy_lite_site_loader) && $cartsy_lite_site_loader === 'on') {
            $template = cartsy_lite_get_global_template_slug() . '/loader';
        }
        get_template_part($template);
    }
}

if (!function_exists('cartsy_lite_banner')) {
    /**
     * Cartsy lite banner.
     *
     * @return void
     */
    function cartsy_lite_banner()
    {
        if (cartsy_lite_is_blog()) {
            $name = 'banner-blog';
        } elseif (cartsy_lite_is_woo_page()) {
            $name = 'banner-woo';
        } else {
            $name = 'banner';
        }

        $template = cartsy_lite_get_banner_template_slug() . '/' . $name;

        get_template_part($template);
    }
}

if (!function_exists('cartsy_lite_get_home_template_slug')) 
{
	/**
	 * Home templates slug
	 *
	 * @since 1.2
	 */
	function cartsy_lite_get_home_template_slug() 
	{
		return 'template-parts/home';
	}
}

if ( ! function_exists( 'cartsy_lite_homepage_banner_content' ) ) 
{
	/**
	 * Display homepage banner
	 * Hooked into the `cartsy_lite_homepage` action in the homepage template
	 *
	 * @since  1.0.0
	 * @return  void
	 */
	function cartsy_lite_homepage_banner_content() 
	{ 
		$template = cartsy_lite_get_home_template_slug() . '/banner-home';

		get_template_part($template);
	}
}

if ( ! function_exists( 'cartsy_lite_woo_products_content' ) ) 
{
	/**
	 * Display Woo Products
	 * Hooked into the `cartsy_lite_homepage` action in the homepage template
	 *
	 * @since  1.0.0
	 * @param array $args the product section args.
	 * @return void
	 */
	function cartsy_lite_woo_products_content( $args ) 
	{
		if (!class_exists('WooCommerce')) {
			return;
		}

		$template = cartsy_lite_get_home_template_slug() . '/products';

		get_template_part($template);
	}
}

if ( ! function_exists( 'cartsy_lite_woo_homepage_sidebar_content' ) ) 
{
	/**
	 * Display home page sidebar
	 * Hooked into the `cartsy_lite_homepage_sidebar` action in the homepage template
	 *
	 * @since  1.0.0
	 * @param array $args the product section args.
	 * @return void
	 */
	function cartsy_lite_woo_homepage_sidebar_content( $args ) 
	{
		if (!class_exists('WooCommerce')) {
			return;
		}

		$template = cartsy_lite_get_home_template_slug() . '/sidebar';

		get_template_part($template);
	}
}