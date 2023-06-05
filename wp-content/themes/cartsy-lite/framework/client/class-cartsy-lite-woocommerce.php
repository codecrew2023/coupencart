<?php

namespace Cartsy_Lite\Framework\Client;

// Do not allow directly accessing this file.

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

class Cartsy_Lite_WooCommerce
{
    /**
     * __construct.
     *
     * @return void
     */
    public function __construct()
    {

        add_filter('body_class', [$this, 'cartsy_lite_woo_template_bodyClass']);
        add_action('cartsy_lite_product_grid_layout', [$this, 'cartsy_lite_product_grid_layout_func'], 10, 1);
        add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
        add_filter( 'woocommerce_placeholder_img', [$this, 'cartsy_lite_shop_placeHolder_Img'], 10, 3);
        add_filter( 'woocommerce_placeholder_img_src', [$this, 'cartsy_lite_single_placeHolder_Img'], 10, 1);
        add_filter( 'woocommerce_cross_sells_columns', [$this, 'cartsy_lite_change_cross_sells_columns'], 1 );
        add_filter( 'woocommerce_upsell_display_args', [$this, 'cartsy_lite_change_number_related_products'], 20 );
        add_filter( 'woocommerce_output_related_products_args', [$this, 'cartsy_lite_related_products_args'], 20 );
    }

    /**
     * cartsy_lite_woo_template_bodyClass.
     *
     * @param mixed $classes
     *
     * @return string
     */
    public function cartsy_lite_woo_template_bodyClass($classes)
    {
        $classes[] = 'cartsylite-woocommerce';

        return $classes;
    }

    /**
     * cartsy_lite_single_placeHolder_Img.
     *
     * @param mixed $src
     *
     * @return string
     */
    public function cartsy_lite_single_placeHolder_Img($src)
    {
        $src = CARTSY_LITE_IMAGE_PATH . 'placeholder-icon.svg';

        return $src;
    }

    /**
     * cartsy_lite_shop_placeHolder_Img.
     *
     * @param mixed $image_html
     * @param mixed $size
     * @param mixed $dimensions
     *
     * @return void
     */
    public function cartsy_lite_shop_placeHolder_Img($image_html, $size, $dimensions)
    {
        $placeholderImage = CARTSY_LITE_IMAGE_PATH . 'placeholder-icon.svg';
        $image_html = '<div class="cartsylite-placeholder-image-add"><img src="' . esc_attr($placeholderImage) . '" alt="' . esc_attr__('Placeholder', 'cartsy-lite') . '" width="' . esc_attr($dimensions['width']) . '" class="woocommerce-placeholder wp-post-image fallback-thumb" height="' . esc_attr($dimensions['height']) . '" /></div>';

        return $image_html;
    }

    /**
     * cartsy_lite_product_grid_layout_func.
     *
     * @return string
     */
    public function cartsy_lite_product_grid_layout_func()
    {
        get_template_part('template-parts/product-grid/grid', 'helium');
    }
 
    /**
     * cartsy_lite_change_cross_sells_columns.
     *
     * @return int
     */
    public function cartsy_lite_change_cross_sells_columns( $columns ) 
    {
        return 5;
    }

    /**
     * cartsy_lite_change_number_related_products.
     *
     * @return array
     */
    public function cartsy_lite_change_number_related_products( $args ) 
    {
        $args['columns'] = 5; //change number of upsells here
        return $args;
    }

    /**
     * cartsy_lite_related_products_args.
     *
     * @return array
     */
    public function cartsy_lite_related_products_args( $args ) 
    {
        $args['columns'] = 5; // arranged in 5 columns
        return $args;
    }
}
