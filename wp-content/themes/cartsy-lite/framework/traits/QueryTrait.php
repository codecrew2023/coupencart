<?php

namespace Cartsy_Lite\Framework\Traits;

defined('ABSPATH') || exit;

trait Cartsy_Lite_QueryTrait
{
    public static function getCategoriesByProducts($attributes = [])
    {
        $process_categories = get_transient('cartsy_lite_product_categories');

        if (false === $process_categories) {

            $args = [
                'taxonomy'         => 'product_cat',
                'show_count'       => 0,
                'parent'           => 0,
                'pad_counts'       => 0,
                'title_li'         => '',
                'hide_empty'       => 0,
                'suppress_filters' => false,
            ];

            if (isset($attributes['categoryOrderBy']) && $attributes['categoryOrderBy']) {
                $args['orderby'] = $attributes['categoryOrderBy'];
            } else {
                $args['orderby'] = 'menu_order';
            }

            if ($attributes['categoryOrderBy'] !== 'menu_order') {
                if (isset($attributes['categoryOrder']) && $attributes['categoryOrder']) {
                    $args['order'] = $attributes['categoryOrder'];
                }
            }


            $results            = get_categories($args);
            $process_categories = [];

            foreach ($results as $key => $category) {
                $process_categories[$category->term_id]['ID'] = $category->term_id;
                $process_categories[$category->term_id]['thumbnail_id'] = get_term_meta($category->term_id, 'thumbnail_id', true);
                $process_categories[$category->term_id]['image_url'] = wp_get_attachment_image_src(get_term_meta($category->term_id, 'thumbnail_id', true), 'thumbnail');
                $process_categories[$category->term_id]['name'] = $category->name;
                $process_categories[$category->term_id]['term_url'] = get_term_link($category->term_id);
                $process_categories[$category->term_id]['full'] = $category;
                $process_categories[$category->term_id]['child'] = get_categories(
                    [
                        'taxonomy'     => 'product_cat',
                        'child_of'     => 0,
                        'parent'       => $category->term_id,
                        'orderby'      => isset($attributes['categoryOrderBy']) && $attributes['categoryOrderBy'] ? $attributes['categoryOrderBy'] : "menu_order",
                        'show_count'   => 0,
                        'pad_counts'   => 0,
                        'hierarchical' => 1,
                        'title_li'     => '',
                        'hide_empty'   => 0,
                    ]
                );
            }

            set_transient('cartsy_lite_product_categories', $process_categories, MONTH_IN_SECONDS);
        }

        return $process_categories;
    }
}
