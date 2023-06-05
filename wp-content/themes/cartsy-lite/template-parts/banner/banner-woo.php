<?php

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

if (is_page_template(['template-homepage.php'])) {
    return;
}

$cartsy_lite_banner_color_schema = $cartsy_lite_banner_color_schemaValue = "";
$cartsy_lite_banner_color_schema_load = [];
$cartsy_lite_woo_banner_switch = 'on';
$cartsy_lite_show_breadCrumb = 'on';
$cartsy_lite_wooBannerType = 'color';
$cartsy_lite_wooBannerTextColor = "#FFF";
$cartsy_lite_wooBannerColor = "#323232";
$cartsy_lite_banner_title     = get_the_title();
$cartsy_lite_wooBannerImage = [];

if (function_exists('cartsy_lite_global_option_data')) {
    $cartsy_lite_woo_banner            = cartsy_lite_global_option_data('cartsy_lite_woo_banner_switch', $cartsy_lite_woo_banner_switch);

    $cartsy_lite_woo_breadcrumb_switch = cartsy_lite_global_option_data('cartsy_lite_woo_page_breadcrumb_switch', $cartsy_lite_show_breadCrumb);

    $cartsy_lite_woo_banner_image      = cartsy_lite_global_option_data('cartsy_lite_woo_banner_image', []);
    $cartsy_lite_woo_banner_type       = cartsy_lite_global_option_data('cartsy_lite_woo_banner_type', $cartsy_lite_wooBannerType);

    $cartsy_lite_woo_banner_text_color = cartsy_lite_global_option_data('cartsy_lite_woo_banner_text_color', $cartsy_lite_wooBannerTextColor);

    $cartsy_lite_woo_banner_bg_color       = cartsy_lite_global_option_data('cartsy_lite_woo_banner_bg_color', $cartsy_lite_wooBannerColor);

    $cartsy_lite_woo_banner_switch  = !empty($cartsy_lite_woo_banner) ? $cartsy_lite_woo_banner        : $cartsy_lite_woo_banner_switch;

    $cartsy_lite_show_breadCrumb     = !empty($cartsy_lite_woo_breadcrumb_switch) ? $cartsy_lite_woo_breadcrumb_switch: $cartsy_lite_show_breadCrumb;

    $cartsy_lite_wooBannerType      = !empty($cartsy_lite_woo_banner_type) ? $cartsy_lite_woo_banner_type            : $cartsy_lite_wooBannerType;

    $cartsy_lite_wooBannerImage     = !empty($cartsy_lite_woo_banner_image) ? $cartsy_lite_woo_banner_image          : [];

    $cartsy_lite_wooBannerColor     = !empty($cartsy_lite_woo_banner_bg_color) ? $cartsy_lite_woo_banner_bg_color          : $cartsy_lite_wooBannerColor;

    $cartsy_lite_wooBannerTextColor = !empty($cartsy_lite_woo_banner_text_color) ? $cartsy_lite_woo_banner_text_color:  $cartsy_lite_wooBannerTextColor;
}

array_push($cartsy_lite_banner_color_schema_load, [
    'cartsy_lite_pageBannerBGColor' => $cartsy_lite_wooBannerColor,
    'cartsy_lite_pageBannerTextColor' => $cartsy_lite_wooBannerTextColor,
]);
if (function_exists('cartsy_lite_banner_dynamicCSS')) {
    $cartsy_lite_banner_color_schemaValue = cartsy_lite_banner_dynamicCSS($cartsy_lite_banner_color_schema_load);
}
if (!empty($cartsy_lite_banner_color_schemaValue)) {
    $cartsy_lite_banner_color_schema .= "style='$cartsy_lite_banner_color_schemaValue'";
}

?>

<?php if (!empty($cartsy_lite_woo_banner_switch) && $cartsy_lite_woo_banner_switch === 'on') { ?>
    <div class="cartsylite-page-title-wrapper cartsylite-banner-type-woo" <?php echo apply_filters('cartsy_lite_woo_banner_color_schema', $cartsy_lite_banner_color_schema); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
        <div class="cartsylite-page-title <?php echo esc_attr( $cartsy_lite_woo_banner_type === "image" ? "image" : "color")?>">
            <?php if ($cartsy_lite_wooBannerType === "image" && !empty($cartsy_lite_wooBannerImage['background-image'])) { ?>
            <div class="cartsylite-page-thumb-area"></div>
            <?php } ?>
            <div class="cartsylite-page-title-content">
                <?php if (is_shop() || is_archive()) { ?>
                    <h1><?php woocommerce_page_title(); ?></h1>
                <?php } else { ?>
                    <h1><?php the_title(); ?></h1>
                <?php } ?>

                <?php
                if ($cartsy_lite_show_breadCrumb === 'on') {
                    if (function_exists('cartsy_lite_breadcrumb')) {
                        cartsy_lite_breadcrumb();
                    }
                }
                ?>
            </div>
        </div>
    </div>
<?php } ?>