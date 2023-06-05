<?php

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

use Cartsy_Lite\Framework\Traits\Cartsy_Lite_QueryTrait;

$cartsy_lite_home_empty_category_orderby = 'menu_order';
$cartsy_lite_home_empty_category_order   = "ASC";
$cartsy_lite_home_sidebar_position   = "left_side";


if (function_exists('cartsy_lite_global_option_data')) {
    $cartsy_lite_home_empty_category_orderby      = cartsy_lite_global_option_data('cartsy_lite_home_empty_category_orderby', $cartsy_lite_home_empty_category_orderby);
    $cartsy_lite_home_empty_category_order        = cartsy_lite_global_option_data('cartsy_lite_home_empty_category_order', $cartsy_lite_home_empty_category_order);
    $cartsy_lite_home_sidebar_position            = cartsy_lite_global_option_data('cartsy_lite_home_sidebar_position', $cartsy_lite_home_sidebar_position);
}

if ($cartsy_lite_home_sidebar_position === "full_width") {
    return;
}

$cartsy_lite_categories = Cartsy_Lite_QueryTrait::getCategoriesByProducts([
    'categoryOrderBy'   => $cartsy_lite_home_empty_category_orderby,
    'categoryOrder'     => $cartsy_lite_home_empty_category_order,
]);

$cartsy_lite_placeholder_image = CARTSY_LITE_IMAGE_PATH . 'placeholder-icon.svg';
?>


<?Php if (empty($cartsy_lite_categories)) { ?>
    <div class="cartsylite-layout-sidebar cartsylite-category-not-found">
        <div class="cartsylite-layout-sidebar-head">
            <div class="cartsylite-layout-sidebar-head-title">
                <?php echo esc_html__("Categories", "cartsy-lite"); ?>
            </div>
            <button class="cartsylite-layout-sidebar-close">
                <i class="dashicons dashicons-no-alt"></i>
            </button>
        </div>
        <p class="cartsylite-category-notice">
            <?php echo esc_html__("Category not found.", "cartsy-lite"); ?>
        </p>
    </div>
<?php } ?>

<?php if (!empty($cartsy_lite_categories) && is_array($cartsy_lite_categories)) { ?>
    <div class="cartsylite-layout-sidebar">
        <div class="cartsylite-layout-sidebar-head">
            <div class="cartsylite-layout-sidebar-head-title">
                <?php echo esc_html__("Categories", "cartsy-lite"); ?>
            </div>
            <button class="cartsylite-layout-sidebar-close">
                <i class="dashicons dashicons-no-alt"></i>
            </button>
        </div>
        <div class="cartsylite-layout-sidebar-scroll">
            <div class="cartsylite-layout-sidebar-inner">
                <?php foreach ($cartsy_lite_categories as $key => $category) { ?>
                    <div class="cartsylite-category-dropdown">
                        <div class="cartsylite-category-dropdown-title-wrapper">
                            <a href="<?php echo esc_url($category['term_url']) ?>" class="cartsylite-category-dropdown-title">
                                <span class="cartsylite-category-thumb" title="<?php echo esc_attr($category['name']) ?>">
                                    <?php if (($category['image_url'])) { ?>
                                        <img src="<?php echo esc_url($category['image_url'][0]) ?>" alt="<?php echo esc_attr($category['name']) ?>">
                                    <?php } else { ?>
                                        <img src="<?php echo esc_url($cartsy_lite_placeholder_image); ?>" alt="<?php echo esc_attr($category['name']) ?>" class="fallback-thumb" />
                                    <?php } ?>
                                </span>
                                <span class="cartsylite-category-name"><?php echo esc_html($category['name']) ?></span>
                            </a>
                            <?php if (!empty($category['child'])) { ?>
                                <button class="cartsylite-category-dropdown-open">
                                    <svg width="1em" height="1em" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.53033 0.96967C9.82322 1.26256 9.82322 1.73744 9.53033 2.03033L5.53033 6.03033C5.23744 6.32322 4.76256 6.32322 4.46967 6.03033L0.46967 2.03033C0.176777 1.73744 0.176777 1.26256 0.46967 0.96967C0.762563 0.676777 1.23744 0.676777 1.53033 0.96967L5 4.43934L8.46967 0.96967C8.76256 0.676777 9.23744 0.676777 9.53033 0.96967Z" fill="currentColor" />
                                    </svg>
                                </button>
                            <?php } ?>
                        </div>
                        <?php if (!empty($category['child']) && is_array($category['child'])) { ?>
                            <div class="cartsylite-category-dropdown-content">
                                <?php foreach ($category['child'] as $key => $child) { ?>
                                    <?php
                                    $product_second_sub_categories = [];
                                    $subcategoryArgs = [
                                        'taxonomy'     => 'product_cat',
                                        'child_of'     => 0,
                                        'parent'       => $child->term_id,
                                        'orderby'      => $cartsy_lite_home_empty_category_orderby,
                                        'order'        => $cartsy_lite_home_empty_category_order,
                                        'show_count'   => 0,
                                        'pad_counts'   => 0,
                                        'hierarchical' => 1,
                                        'title_li'     => '',
                                        'hide_empty'   => 0,
                                    ];
                                    $product_second_sub_categories = get_categories($subcategoryArgs);
                                    ?>
                                    <div class="cartsylite-category-dropdown">
                                        <div class="cartsylite-category-dropdown-title-wrapper">
                                            <a href="<?php echo esc_url(get_term_link($child->term_id)) ?>" class="cartsylite-category-dropdown-title" title="<?php echo esc_attr($child->name) ?>">
                                                <span class="cartsylite-category-name"><?php echo esc_html($child->name) ?></span>
                                            </a>
                                            <?php if ($product_second_sub_categories) { ?>
                                                <button class="cartsylite-category-dropdown-open">
                                                    <svg width="1em" height="1em" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.53033 0.96967C9.82322 1.26256 9.82322 1.73744 9.53033 2.03033L5.53033 6.03033C5.23744 6.32322 4.76256 6.32322 4.46967 6.03033L0.46967 2.03033C0.176777 1.73744 0.176777 1.26256 0.46967 0.96967C0.762563 0.676777 1.23744 0.676777 1.53033 0.96967L5 4.43934L8.46967 0.96967C8.76256 0.676777 9.23744 0.676777 9.53033 0.96967Z" fill="currentColor" />
                                                    </svg>
                                                </button>
                                            <?php } ?>
                                        </div>
                                        <?php if ($product_second_sub_categories && !empty($category['child']) && is_array($category['child'])) { ?>
                                            <div class="cartsylite-category-dropdown-content">
                                                <?php foreach ($product_second_sub_categories as $key => $second_sub) { ?>
                                                    <div class="cartsylite-category-dropdown">
                                                        <div class="cartsylite-category-dropdown-title-wrapper">
                                                            <a href="<?php echo esc_url(get_term_link($second_sub->term_id)) ?>" class="cartsylite-category-dropdown-title" title="<?php echo esc_attr($second_sub->name) ?>">
                                                                <span class="cartsylite-category-name"><?php echo esc_html($second_sub->name) ?></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>