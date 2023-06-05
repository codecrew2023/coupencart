<?php

namespace Cartsy_Lite\Framework;

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

use Cartsy_Lite\Framework\Settings\Cartsy_Lite_CustomizeSettings;
use Cartsy_Lite\Framework\Admin\Cartsy_Lite_Plugins;
use Cartsy_Lite\Framework\Client\Cartsy_Lite_Client_Script;
use Cartsy_Lite\Framework\Client\Cartsy_Lite_Client_Style;
use Cartsy_Lite\Framework\Client\Cartsy_Lite_Menu_Walker;
use Cartsy_Lite\Framework\Client\Cartsy_Lite_WooCommerce;
use Cartsy_Lite\Framework\Traits\Cartsy_Lite_StyleScriptLoader;
use Cartsy_Lite\Framework\Admin\Cartsy_Lite_Welcome;
use Cartsy_Lite\Framework\Admin\Cartsy_Lite_Welcome_Admin_Notice;

class Cartsy_Lite
{

    use Cartsy_Lite_StyleScriptLoader;

    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cartsy_lite_init_hooks();
        $this->cartsy_lite_load_classes();
    }

    /**
     * cartsy_lite_init_hooks.
     *
     * @return void
     */
    public function cartsy_lite_init_hooks()
    {
        add_action('after_setup_theme', [$this, 'cartsy_lite_setup_theme']);
        add_action('widgets_init', [$this, 'cartsy_lite_initialize_widgets']);
        add_action('init', [$this, 'cartsy_lite_register_block_style']);
        add_action('init', [$this, 'cartsy_lite_register_blocK_pattern_category']);
        add_action('init', [$this, 'cartsy_lite_blocK_pattern']);
        add_action('save_post', [$this, 'cartsy_lite_clear_transients']);
    }

    /**
     * cartsy_lite_setup_theme.
     *
     * @return void
     */
    public function cartsy_lite_setup_theme()
    {
        if (!isset($GLOBALS['content_width'])) {
            $GLOBALS['content_width'] = apply_filters('cartsy_lite_content_width', 1140);
        }
        load_theme_textdomain('cartsy-lite', get_template_directory() . '/languages');

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        register_nav_menus([
            'cartsylite-menu' => esc_html__('Cartsy Lite Main Menu', 'cartsy-lite'),
        ]);
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ]);
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('custom-logo', [
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' =>  true,
        ]);
        add_theme_support('custom-background', apply_filters('cartsy_lite_custom_background_args', [
            'default-color' => 'ffffff',
            'default-image' => '',
        ]));

        add_theme_support(
            'editor-font-sizes',
            array(
                array(
                    'name'      => esc_attr_x('Small', 'Name of the small font size in the block editor', 'cartsy-lite'),
                    'shortName' => esc_attr_x('S', 'Short name of the small font size in the block editor.', 'cartsy-lite'),
                    'size'      => 18,
                    'slug'      => 'small',
                ),
                array(
                    'name'      => esc_attr_x('Regular', 'Name of the regular font size in the block editor', 'cartsy-lite'),
                    'shortName' => esc_attr_x('M', 'Short name of the regular font size in the block editor.', 'cartsy-lite'),
                    'size'      => 22,
                    'slug'      => 'normal',
                ),
                array(
                    'name'      => esc_attr_x('Large', 'Name of the large font size in the block editor', 'cartsy-lite'),
                    'shortName' => esc_attr_x('L', 'Short name of the large font size in the block editor.', 'cartsy-lite'),
                    'size'      => 24,
                    'slug'      => 'large',
                ),
                array(
                    'name'      => esc_attr_x('Larger', 'Name of the larger font size in the block editor', 'cartsy-lite'),
                    'shortName' => esc_attr_x('XL', 'Short name of the larger font size in the block editor.', 'cartsy-lite'),
                    'size'      => 40,
                    'slug'      => 'larger',
                ),
            )
        );

        add_theme_support('align-wide');
        add_theme_support('editor-styles');
        add_theme_support('wp-block-styles');
        add_theme_support('responsive-embeds');
        add_theme_support(
            'post-formats',
            [
                'aside',
                'image',
                'video',
                'quote',
                'link',
                'gallery',
                'status',
                'audio',
                'chat',
            ]
        );

        // Add theme support for Custom Header.
        $cartsy_lite_custom_header_defaults = [
            'height'         => 500,
            'flex-width'       => true,
            'flex-height'      => true,
            'default-image'  => esc_url(CARTSY_LITE_IMAGE_PATH . 'cartsy-lite-banner.jpg'),
        ];
        add_theme_support(
            'custom-header',
            $cartsy_lite_custom_header_defaults
        );

        // editor style
        add_editor_style(trailingslashit(get_template_directory_uri()) . 'dist/cartsy-lite-editor-style.css');

        /**
         * Enqueue editor styles.
         */
        add_editor_style(self::cartsy_lite_google_fonts());

        // remove widgets block editor
        remove_theme_support('widgets-block-editor');

        // Define and register starter content to showcase the theme on new sites.
        add_theme_support( 'starter-content', self::get_starter_content() );

        // WooCommerce
        add_theme_support('woocommerce', [
            'product_grid' => [
                'default_rows'    => 2,
                'min_rows'        => 1,
                'max_rows'        => 4,
                'default_columns' => 5,
                'min_columns'     => 3,
                'max_columns'     => 6,
            ],
        ]);
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
    }

    /**
     * cartsy_lite_initialize_widgets
     *
     * @return void
     */
    public function cartsy_lite_initialize_widgets()
    {
        register_sidebar(
            [
                'name' => esc_html__('Cartsy Lite Sidebar', 'cartsy-lite'),
                'id' => 'cartsylite-sidebar',
                'description' => esc_html__('Add widgets here.', 'cartsy-lite'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            ]
        );
        register_sidebar(
            [
                'name' => esc_html__('Cartsy Lite WooCommerce Sidebar', 'cartsy-lite'),
                'id' => 'cartsylite-woo-sidebar',
                'description' => esc_html__('Add sidebar widgets to WooCommerce archives.', 'cartsy-lite'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            ]
        );
    }


    /**
     * Block Styles
     * 
     * @link https://developer.wordpress.org/reference/functions/register_block_style/
     * Register block styles.
     *
     * cartsy_lite_register_block_style
     * 
     * @return void
     */
    public function cartsy_lite_register_block_style()
    {
        if (function_exists('register_block_style')) {
            // Cover: Borders.
            register_block_style( // phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.editor_blocks_register_block_style
                'core/cover',
                array(
                    'name'  => 'cartsy-lite-border',
                    'label' => esc_html__('Borders', 'cartsy-lite'),
                )
            );

            // Image: Borders.
            register_block_style( // phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.editor_blocks_register_block_style
                'core/image',
                array(
                    'name'  => 'cartsy-lite-border',
                    'label' => esc_html__('Borders', 'cartsy-lite'),
                )
            );

            // Image: Frame.
            register_block_style( // phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.editor_blocks_register_block_style
                'core/image',
                array(
                    'name'  => 'cartsy-lite-image-frame',
                    'label' => esc_html__('Frame', 'cartsy-lite'),
                )
            );

            // Latest Posts: Borders.
            register_block_style( // phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.editor_blocks_register_block_style
                'core/latest-posts',
                array(
                    'name'  => 'cartsy-lite-latest-posts-borders',
                    'label' => esc_html__('Borders', 'cartsy-lite'),
                )
            );
        }
    }

    /**
     * Block Pattern Category
     * 
     * @link https://developer.wordpress.org/reference/functions/register_block_pattern_category/
     * Register Block Pattern Category.
     * 
     * cartsy_lite_register_blocK_pattern_category
     * 
     * @return void
     */
    public function cartsy_lite_register_blocK_pattern_category()
    {
        if (function_exists('register_block_pattern_category')) {
            register_block_pattern_category( // phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.editor_blocks_register_block_pattern_category
                'cartsy-lite',
                array('label' => esc_html__('Cartsy Lite', 'cartsy-lite'))
            );
        }
    }

    /**
     * Block Patterns
     * 
     * @link https://developer.wordpress.org/reference/functions/register_block_pattern/
     * Register Block Patterns.
     * 
     * cartsy_lite_blocK_pattern
     * 
     * @return void
     */
    public function cartsy_lite_blocK_pattern()
    {
        if (function_exists('register_block_pattern')) {

            // Large Text.
            register_block_pattern( // phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.editor_blocks_register_block_pattern
                'cartsy-lite/large-text',
                array(
                    'title'         => esc_html__('Large text', 'cartsy-lite'),
                    'categories'    => array('cartsy-lite'),
                    'viewportWidth' => 1440,
                    'content'       => '<!-- wp:heading {"align":"wide","fontSize":"gigantic","style":{"typography":{"lineHeight":"1.1"}}} --><h2 class="alignwide has-text-align-wide has-gigantic-font-size" style="line-height:1.1">' . esc_html__('A new portfolio default theme for WordPress', 'cartsy-lite') . '</h2><!-- /wp:heading -->',
                )
            );

            // Media & Text Article Title.
            register_block_pattern( // phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.editor_blocks_register_block_pattern
                'cartsy-lite/media-text-article-title',
                array(
                    'title'         => esc_html__('Media and text article title', 'cartsy-lite'),
                    'categories'    => array('cartsy-lite'),
                    'viewportWidth' => 1440,
                    'description'   => esc_html_x('A Media & Text block with a big image on the left and a heading on the right. The heading is followed by a separator and a description paragraph.', 'Block pattern description', 'cartsy-lite'),
                    'content'       => '<!-- wp:media-text {"mediaId":1752,"mediaLink":"' . esc_url('https://s.w.org/images/core/5.8/art-02.jpg') . '","mediaType":"image","className":"is-style-twentytwentyone-border"} --><div class="wp-block-media-text alignwide is-stacked-on-mobile is-style-twentytwentyone-border"><figure class="wp-block-media-text__media"><img src="' . esc_url('https://s.w.org/images/core/5.8/art-02.jpg') . '" alt="' . esc_attr__('&#8220;Playing in the Sand&#8221; by Berthe Morisot', 'cartsy-lite') . '" class="wp-image-1752"/></figure><div class="wp-block-media-text__content"><!-- wp:heading {"align":"center"} --><h2 class="has-text-align-center">' . esc_html__('Playing in the Sand', 'cartsy-lite') . '</h2><!-- /wp:heading --><!-- wp:separator {"className":"is-style-dots"} --><hr class="wp-block-separator is-style-dots"/><!-- /wp:separator --><!-- wp:paragraph {"align":"center","fontSize":"small"} --><p class="has-text-align-center has-small-font-size">' . wp_kses_post(__('Berthe Morisot<br>(French, 1841-1895)', 'cartsy-lite')) . '</p><!-- /wp:paragraph --></div></div><!-- /wp:media-text -->',
                )
            );
        }
    }


    /**
     * cartsy_lite_clear_transients
     *
     * @return void
     */
    public function cartsy_lite_clear_transients()
    {
        if (false !== get_transient('cartsy_lite_product_categories')) {
            delete_transient('cartsy_lite_product_categories');
        }
    }

    /**
	 * Return starter content definition.
	 *
	 * @return mixed|void
	 */
    public static function get_starter_content() 
    {
        $cartsy_lite_is_fresh_site = get_option( 'fresh_site' );
        if ( ! $cartsy_lite_is_fresh_site && ! is_customize_preview() ) {
			return;
		}

        $HOME_SLUG       = 'home';
        $BLOG_SLUG       = 'blog';
        $ABOUT_SLUG      = 'about';

		$nav_items = [
			'home'                 => [
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . $HOME_SLUG . '}}',
			],
			'page_about'           => [
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . $ABOUT_SLUG . '}}',
			],
			'page_blog'            => [
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{' . $BLOG_SLUG . '}}',
			],
		];

		$content = [
			'nav_menus'   => [
				'cartsylite-menu' => [
					'items' => $nav_items,
				],
			],
			'options'     => [
				'page_on_front'  => '{{' . $HOME_SLUG . '}}',
				'page_for_posts' => '{{' . $BLOG_SLUG . '}}',
				'show_on_front'  => 'page',
				'blogname'       => esc_html__( 'Cartsy Lite', 'cartsy-lite' ),
			],
			'attachments' => array(
				'logo' => array(
					'post_title' => _x( 'Logo', 'Theme starter content', 'cartsy-lite' ),
					'file' => 'assets/images/logo.png',
				),
			),
			'theme_mods' => array(
				'custom_logo' => '{{logo}}',
			),
			'posts'       => [
				$HOME_SLUG       => file_exists(__DIR__ . '/starter-content/home.php') ? require __DIR__ . '/starter-content/home.php' : "",
				$ABOUT_SLUG      => file_exists(__DIR__ . '/starter-content/about.php') ? require __DIR__ . '/starter-content/about.php' : "",
				$BLOG_SLUG       => [
					'post_name'  => $BLOG_SLUG,
					'post_type'  => 'page',
					'post_title' => _x( 'Blog', 'Theme starter content', 'cartsy-lite' ),
				],
			],
		];

		return apply_filters( 'cartsy_lite_starter_content', $content );
	}


    /**
     * cartsy_lite_load_classes.
     *
     * @return void
     */
    public function cartsy_lite_load_classes()
    {
        if (is_admin()) {
            new Cartsy_Lite_Plugins();
            new Cartsy_Lite_Welcome();
            new Cartsy_Lite_Welcome_Admin_Notice();
        }
        if (class_exists('Kirki')) {
            new Cartsy_Lite_CustomizeSettings();
        }
        new Cartsy_Lite_Menu_Walker();
        new Cartsy_Lite_Client_Script();
        new Cartsy_Lite_Client_Style();
        if (class_exists('WooCommerce')) {
            new Cartsy_Lite_WooCommerce();
        }
    }
}
