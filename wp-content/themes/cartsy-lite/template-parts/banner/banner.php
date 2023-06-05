<?php

if (!defined('ABSPATH')) {
  exit('Direct script access denied.');
}

if (is_page_template(['template-homepage.php'])) {
  return;
}

global $post;
$cartsy_lite_banner_color_schemaLoad = $cartsy_lite_banner_color_schemaValue = $cartsy_lite_pageBannerImage = '';
$cartsy_lite_page_banner_switch     = "on";
$cartsy_lite_page_breadcrumb_switch = 'on';
$cartsy_lite_banner_color_schema    = [];
$cartsy_lite_pageBannerType         = 'color';
$cartsy_lite_pageBannerTextColor    = '#fff';
$cartsy_lite_pageBannerColor        = "#323232";

if (function_exists('cartsy_lite_global_option_data')) {
    $cartsy_lite_page_banner            = cartsy_lite_global_option_data('cartsy_lite_page_banner_switch', $cartsy_lite_page_banner_switch);

    $cartsy_lite_page_breadcrumb        = cartsy_lite_global_option_data('cartsy_lite_page_breadcrumb_switch', $cartsy_lite_page_breadcrumb_switch);

    $cartsy_lite_page_banner_type       = cartsy_lite_global_option_data('cartsy_lite_page_banner_type', $cartsy_lite_pageBannerType);

    $cartsy_lite_page_banner_image      = cartsy_lite_global_option_data('cartsy_lite_page_banner_image', []);
    $cartsy_lite_page_banner_text_color = cartsy_lite_global_option_data('cartsy_lite_page_banner_text_color', $cartsy_lite_pageBannerTextColor);

    $cartsy_lite_page_banner_color      = cartsy_lite_global_option_data('cartsy_lite_page_banner_color', $cartsy_lite_pageBannerColor);

    $cartsy_lite_page_banner_switch     = !empty($cartsy_lite_page_banner) ? $cartsy_lite_page_banner        : $cartsy_lite_page_banner_switch;

    $cartsy_lite_page_breadcrumb_switch = !empty($cartsy_lite_page_breadcrumb) ? $cartsy_lite_page_breadcrumb: $cartsy_lite_page_breadcrumb_switch;

    $cartsy_lite_pageBannerType         = !empty($cartsy_lite_page_banner_type) ? $cartsy_lite_page_banner_type            : $cartsy_lite_pageBannerType;

    $cartsy_lite_pageBannerImage        = !empty($cartsy_lite_page_banner_image) ? $cartsy_lite_page_banner_image          : [];

    $cartsy_lite_pageBannerTextColor    = !empty($cartsy_lite_page_banner_text_color) ? $cartsy_lite_page_banner_text_color: $cartsy_lite_pageBannerTextColor;

    $cartsy_lite_pageBannerColor        = !empty($cartsy_lite_page_banner_color) ? $cartsy_lite_page_banner_color          : $cartsy_lite_pageBannerColor;
}

array_push($cartsy_lite_banner_color_schema, [
    'cartsy_lite_pageBannerBGColor' => $cartsy_lite_pageBannerColor,
    'cartsy_lite_pageBannerTextColor' => $cartsy_lite_pageBannerTextColor,
]);
if (function_exists('cartsy_lite_banner_dynamicCSS')) {
    $cartsy_lite_banner_color_schemaValue = cartsy_lite_banner_dynamicCSS($cartsy_lite_banner_color_schema);
}
if (!empty($cartsy_lite_banner_color_schemaValue)) {
    $cartsy_lite_banner_color_schemaLoad .= "style='$cartsy_lite_banner_color_schemaValue'";
}
?>
<?php if (!empty($cartsy_lite_page_banner_switch) && $cartsy_lite_page_banner_switch === 'on') { ?>
    <div class="cartsylite-page-title-wrapper cartsylite-main-banner-area" <?php echo apply_filters('cartsy_lite_page_banner_color_schema', $cartsy_lite_banner_color_schemaLoad); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
        <div class="cartsylite-page-title <?php echo esc_attr( $cartsy_lite_pageBannerType === 'image' ? "image" : "color" )?>">
          <?php if ($cartsy_lite_pageBannerType === 'image') { ?>
            <?php if (!empty($cartsy_lite_pageBannerImage['background-image'])) { ?>
              <div class="cartsylite-page-thumb-area"></div>
            <?php } elseif (has_post_thumbnail()) { ?>
              <div class="cartsylite-page-thumb-area-image">
                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" />
              </div>
            <?php } ?>
          <?php } ?>

          <div class="cartsylite-page-title-content">
            <?php 
            if ( is_search() ) { 
              if (isset($_GET['s'])) { ?>
                <h1><?php echo esc_html__( 'Search for: ', 'cartsy-lite' ) . esc_html( sanitize_text_field($_GET['s']) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash ?></h1>
              <?php } ?>
            <?php } else {
              if (!empty($post->post_title)) { ?>
                <h1><?php the_title(); ?></h1>
              <?php }
            }
            ?>
            <?php
            if ($cartsy_lite_page_breadcrumb_switch === 'on') {
              if (function_exists('cartsy_lite_breadcrumb')) {
                cartsy_lite_breadcrumb();
              }
            }
            ?>
          </div>
        </div>
    </div>
<?php } ?>