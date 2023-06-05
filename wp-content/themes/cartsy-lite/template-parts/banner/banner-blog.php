<?php

if (!defined('ABSPATH')) {
  exit('Direct script access denied.');
}

if (is_page_template(['template-homepage.php'])) {
  return;
}

$cartsy_lite_banner_color_schema = $cartsy_lite_banner_color_schemaValue = "";
$cartsy_lite_banner_color_schema_load = [];
$cartsy_lite_blog_banner_switch = 'on';
$cartsy_lite_show_breadCrumb = 'on';
$cartsy_lite_pageBannerType = 'color';
$cartsy_lite_pageBannerTextColor = "#FFF";
$cartsy_lite_pageBannerColor = "#323232";
$cartsy_lite_banner_title     = get_the_title();
$cartsy_lite_pageBannerImage = [];

if (function_exists('cartsy_lite_global_option_data')) {
  $cartsy_lite_blog_banner            = cartsy_lite_global_option_data('cartsy_lite_blog_banner_switch', $cartsy_lite_blog_banner_switch);

  $cartsy_lite_blog_breadcrumb_switch = cartsy_lite_global_option_data('cartsy_lite_blog_breadcrumb_switch', $cartsy_lite_show_breadCrumb);

  $cartsy_lite_blog_banner_image      = cartsy_lite_global_option_data('cartsy_lite_blog_banner_image', []);

  $cartsy_lite_blog_banner_type       = cartsy_lite_global_option_data('cartsy_lite_blog_banner_type', $cartsy_lite_pageBannerType);

  $cartsy_lite_blog_banner_text_color = cartsy_lite_global_option_data('cartsy_lite_blog_banner_text_color', $cartsy_lite_pageBannerTextColor);

  $cartsy_lite_blog_banner_color      = cartsy_lite_global_option_data('cartsy_lite_blog_banner_color', $cartsy_lite_pageBannerColor);

  $cartsy_lite_blog_banner_switch  = !empty($cartsy_lite_blog_banner) ? $cartsy_lite_blog_banner        : $cartsy_lite_blog_banner_switch;

  $cartsy_lite_show_breadCrumb     = !empty($cartsy_lite_blog_breadcrumb_switch) ? $cartsy_lite_blog_breadcrumb_switch : $cartsy_lite_show_breadCrumb;

  $cartsy_lite_pageBannerType      = !empty($cartsy_lite_blog_banner_type) ? $cartsy_lite_blog_banner_type            : $cartsy_lite_pageBannerType;

  $cartsy_lite_pageBannerColor     = !empty($cartsy_lite_blog_banner_color) ? $cartsy_lite_blog_banner_color          : $cartsy_lite_pageBannerColor;

  $cartsy_lite_pageBannerTextColor = !empty($cartsy_lite_blog_banner_text_color) ? $cartsy_lite_blog_banner_text_color :  $cartsy_lite_pageBannerTextColor;
}

array_push($cartsy_lite_banner_color_schema_load, [
  'cartsy_lite_pageBannerBGColor' => $cartsy_lite_pageBannerColor,
  'cartsy_lite_pageBannerTextColor' => $cartsy_lite_pageBannerTextColor,
]);
if (function_exists('cartsy_lite_banner_dynamicCSS')) {
  $cartsy_lite_banner_color_schemaValue = cartsy_lite_banner_dynamicCSS($cartsy_lite_banner_color_schema_load);
}
if (!empty($cartsy_lite_banner_color_schemaValue)) {
  $cartsy_lite_banner_color_schema .= "style='$cartsy_lite_banner_color_schemaValue'";
}
?>

<?php if (!empty($cartsy_lite_blog_banner_switch) && $cartsy_lite_blog_banner_switch !== 'off') { ?>
  <div class="cartsylite-page-title-wrapper cartsylite-banner-type-blog" <?php echo apply_filters('cartsy_lite_blog_banner_color_schema', $cartsy_lite_banner_color_schema); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                          ?>>
    <div class="cartsylite-page-title <?php echo esc_attr($cartsy_lite_pageBannerType !== 'image' ? "color" : "image") ?>">
      <?php if ($cartsy_lite_pageBannerType === "image" && !empty($cartsy_lite_blog_banner_image['background-image'])) { ?>
        <div class="cartsylite-page-thumb-area"></div>
      <?php }; ?>

      <div class="cartsylite-page-title-content">
        <?php if (is_home()) { ?>

          <?php
          $cartsy_lite_our_title = "";
          if (get_option('page_for_posts', true) !== '0') {
            $cartsy_lite_our_title = get_the_title(get_option('page_for_posts', true));
          } else {
            $cartsy_lite_our_title = esc_html__('Blog', 'cartsy-lite');
          };
          ?>
          <h1><?php echo esc_html($cartsy_lite_our_title); ?></h1>

        <?php } elseif (is_category()) { ?>
          <h1>
            <?php
            /* translators: 1: Category, 2: category title. */
            printf(esc_html__('%1$s %2$s', 'cartsy-lite'), esc_html__("Category: ", "cartsy-lite"), '' . single_cat_title('', false) . ''); // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
            ?>
          </h1>

        <?php } elseif (is_tag()) { ?>
          <h1>
            <?php
            /* translators: 1: Tag, 2: tag title. */
            printf(esc_html__(' %1$s %2$s', 'cartsy-lite'), esc_html__('Tag: ', 'cartsy-lite'), '' . single_tag_title('', false) . ''); // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
            ?>
          </h1>

        <?php } elseif (is_author()) { ?>

          <?php
          $curauth = get_query_var('author_name') ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
          ?>
          <h1>
            <?php
            printf(esc_html__('%1$s %2$s', 'cartsy-lite'), esc_html__('Author posts: ', 'cartsy-lite'), esc_html($curauth->display_name)); // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment 
            ?>
          </h1>

        <?php } elseif (is_404()) { ?>

          <h1><?php echo esc_html__('Error 404', 'cartsy-lite'); ?></h1>

        <?php } elseif (is_archive()) { ?>

          <?php if (class_exists('WooCommerce') && (is_shop() || is_product_category())) { ?>

            <h1><?php woocommerce_page_title(); ?></h1>

          <?php } else { ?>

            <?php if (is_day()) { ?>
              <h1><?php printf(esc_html__(' %1$s %2$s', 'cartsy-lite'), esc_html__('Daily archives: ', 'cartsy-lite'), get_the_date()); // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment 
                  ?></h1>
            <?php } elseif (is_month()) { ?>
              <h1>
                <?php
                printf(
                  ' %s', // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
                  get_the_date(_x('F Y', 'monthly archives date format', 'cartsy-lite'))
                );
                ?>
              </h1>
            <?php } elseif (is_year()) { ?>
              <h1>
                <?php
                printf(
                  ' %s', // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment // phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
                  get_the_date(_x('Y', 'yearly archives date format', 'cartsy-lite'))
                );
                ?>
              </h1>
            <?php } else { ?>
              <h1>
                <?php
                printf(
                  esc_html__('%1$s %2$s', 'cartsy-lite'), // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
                  esc_html__('Explore: ', 'cartsy-lite'),
                  esc_html__('Blog Archives', 'cartsy-lite')
                );
                ?>
              </h1>
            <?php }; ?>
          <?php }; ?>
        <?php } elseif (is_search()) { ?>
          <h1>
            <?php echo esc_html__('Search query : ', 'cartsy-lite'); ?>
            <?php echo ' "'; ?>
            <?php echo esc_attr(get_search_query()); ?>
            <?php echo '"'; ?>
          </h1>
        <?php } else { ?>
          <h1><?php echo wp_kses_post($cartsy_lite_banner_title); ?></h1>
        <?php }; ?>

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
<?php }; ?>