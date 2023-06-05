<?php

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

$cartsy_lite_banner_title = esc_html__( "Products Delivered in 90 Minutes", 'cartsy-lite' );
$cartsy_lite_banner_sub_title = esc_html__( "Get your products delivered at your doorsteps all day everyday", 'cartsy-lite' );
$cartsy_lite_banner_switch = "on";
$cartsy_lite_banner_image = $cartsy_lite_banner_color_schema_load = [];
$cartsy_lite_banner_type = "color";
$cartsy_lite_banner_text_color = "#212121";
// $cartsy_lite_banner_color = "#323232";
$cartsy_lite_banner_color_schemaValue = $cartsy_lite_banner_color_schema = "";


if (function_exists('cartsy_lite_global_option_data')) {
    $cartsy_lite_banner_title     = cartsy_lite_global_option_data('cartsy_lite_home_banner_title', $cartsy_lite_banner_title);
    
    $cartsy_lite_banner_sub_title = cartsy_lite_global_option_data('cartsy_lite_home_banner_sub_title', $cartsy_lite_banner_sub_title);

    $cartsy_lite_banner_switch = cartsy_lite_global_option_data('cartsy_lite_home_banner_switch', $cartsy_lite_banner_switch);

    // $cartsy_lite_banner_type       = cartsy_lite_global_option_data('cartsy_lite_home_banner_type', $cartsy_lite_banner_type);

    // $cartsy_lite_banner_image      = cartsy_lite_global_option_data('cartsy_lite_home_banner_image', $cartsy_lite_banner_image);
    
    // $cartsy_lite_banner_color      = cartsy_lite_global_option_data('cartsy_lite_home_banner_color', $cartsy_lite_banner_color);

    $cartsy_lite_banner_text_color = cartsy_lite_global_option_data('cartsy_lite_blog_home_text_color', $cartsy_lite_banner_text_color);
}

array_push($cartsy_lite_banner_color_schema_load, [
    // 'cartsy_lite_pageBannerBGColor' => $cartsy_lite_banner_color,
    'cartsy_lite_pageBannerTextColor' => $cartsy_lite_banner_text_color,
]);
if (function_exists('cartsy_lite_banner_dynamicCSS')) {
    $cartsy_lite_banner_color_schemaValue = cartsy_lite_banner_dynamicCSS($cartsy_lite_banner_color_schema_load);
}
if (!empty($cartsy_lite_banner_color_schemaValue)) {
    $cartsy_lite_banner_color_schema .= "style='$cartsy_lite_banner_color_schemaValue'";
}
if ($cartsy_lite_banner_switch === "off") {
    return;
}

?>

<div class="cartsylite-home-banner" <?php echo apply_filters('cartsy_lite_banner_color_schema', $cartsy_lite_banner_color_schema); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
    <div class="cartsylite-home-page-thumb-area"></div>

    <div class="cartsylite-banner-content">
        <h1 class="cartsylite-banner-title"><?php echo esc_html( $cartsy_lite_banner_title )?></h1>
        <p class="cartsylite-banner-description"><?php echo esc_html( $cartsy_lite_banner_sub_title )?></p>
    </div>
</div>