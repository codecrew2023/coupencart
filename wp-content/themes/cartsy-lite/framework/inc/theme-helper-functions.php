<?php

if (!defined('ABSPATH')) {
  exit('Direct script access denied.');
}


/**
 * Theme related custom functions are listed here.
 *
 * Function Lists
 *
 * - cartsy_lite_global_option_data()
 * 
 */

if (!function_exists('cartsy_lite_global_option_data')) {
  /**
   * cartsy_lite_global_option_data.
   *
   * @param mixed $option_key
   *
   * @return string|integer
   */
  function cartsy_lite_global_option_data($option_key, $default = "")
  {
    if (class_exists('Kirki')) {
      $cartsy_lite_global_options = Kirki::get_option('cartsy_lite_config', $option_key);
    } else {
      $cartsy_lite_global_options = $default;
    }
    return $cartsy_lite_global_options;
  }
}


if (!function_exists('cartsy_lite_social_profile')) {
  /**
   * cartsy_lite_social_profile.
   *
   * @return void
   */
  function cartsy_lite_social_profile()
  {
    $cartsy_lite_social_profile_display = $cartsy_lite_facebook_switch = $cartsy_lite_twitter_switch = $cartsy_lite_linkedin_switch = $cartsy_lite_instagram_switch = $cartsy_lite_pinterest_switch = $cartsy_lite_youtube_switch = "on";

    $cartsy_lite_facebook_link          = "https://www.facebook.com/";
    $cartsy_lite_twitter_link           = "https://twitter.com/";
    $cartsy_lite_linkedin_link          = "https://www.linkedin.com/";
    $cartsy_lite_instagram_link         = "https://www.instagram.com/";
    $cartsy_lite_pinterest_profile_link = 'https://www.pinterest.com/';
    $cartsy_lite_youtube_profile_link   = 'https://www.youtube.com/';
    $cartsy_lite_html = '';

    if (function_exists('cartsy_lite_global_option_data')) {
      $cartsy_lite_social_profile_display = cartsy_lite_global_option_data('cartsy_lite_social_profile_switch', 'on');
      $cartsy_lite_facebook_switch        = cartsy_lite_global_option_data('cartsy_lite_fb_switch', 'on');
      $cartsy_lite_facebook_link          = cartsy_lite_global_option_data('cartsy_lite_fb_profile_link', 'https://www.facebook.com/');
      $cartsy_lite_twitter_switch         = cartsy_lite_global_option_data('cartsy_lite_twitter_switch', 'on');
      $cartsy_lite_twitter_link           = cartsy_lite_global_option_data('cartsy_lite_tw_profile_link', 'https://twitter.com/');
      $cartsy_lite_instagram_switch       = cartsy_lite_global_option_data('cartsy_lite_instagram_switch', 'on');
      $cartsy_lite_instagram_link         = cartsy_lite_global_option_data('cartsy_lite_instagram_profile_link', 'https://www.instagram.com/');
      $cartsy_lite_linkedin_switch        = cartsy_lite_global_option_data('cartsy_lite_linkedin_switch', 'on');
      $cartsy_lite_linkedin_link          = cartsy_lite_global_option_data('cartsy_lite_linkedin_profile_link', 'https://www.linkedin.com/');
      $cartsy_lite_pinterest_switch       = cartsy_lite_global_option_data('cartsy_lite_pinterest_switch', 'on');
      $cartsy_lite_pinterest_profile_link = cartsy_lite_global_option_data('cartsy_lite_pinterest_profile_link', 'https://www.pinterest.com/');
      $cartsy_lite_youtube_switch         = cartsy_lite_global_option_data('cartsy_lite_youtube_switch', 'on');
      $cartsy_lite_youtube_profile_link   = cartsy_lite_global_option_data('cartsy_lite_youtube_profile_link', 'https://www.youtube.com/');
    }

    if ($cartsy_lite_social_profile_display !== 'off') {
      $cartsy_lite_html .= '<ul class="cartsylite-social-profiles">';
      if ($cartsy_lite_facebook_switch !== 'off') {
        $cartsy_lite_html .= '<li class="cartsylite-social-profile-item">';
        $cartsy_lite_html .= '<a href="' . esc_url($cartsy_lite_facebook_link) . '" title="facebook" target="_blank" rel="noopener"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 8.569 16" fill="currentColor"><path d="m8.008 9 .444-2.9H5.674V4.225a1.448 1.448 0 0 1 1.633-1.564H8.57V.2A15.4 15.4 0 0 0 6.328 0a3.535 3.535 0 0 0-3.784 3.9v2.2H0V9h2.544v7h3.13V9Z"/></svg>
      </a>';
        $cartsy_lite_html .= '</li>';
      }
      if ($cartsy_lite_instagram_switch !== 'off') {
        $cartsy_lite_html .= '<li class="cartsylite-social-profile-item">';
        $cartsy_lite_html .= '<a href="' . esc_url($cartsy_lite_instagram_link) . '" title="instagram" target="_blank" rel="noopener"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 14.008 14.005" fill="currentColor"><path d="M7.002 3.411a3.585 3.585 0 0 0-3.587 3.594 3.585 3.585 0 0 0 3.587 3.587 3.585 3.585 0 0 0 3.594-3.587 3.585 3.585 0 0 0-3.594-3.594Zm0 5.925a2.339 2.339 0 0 1-2.331-2.331 2.337 2.337 0 0 1 2.331-2.337 2.337 2.337 0 0 1 2.337 2.337 2.339 2.339 0 0 1-2.337 2.331Zm4.575-6.072a.838.838 0 0 0-.837-.837.838.838 0 0 0-.837.837.836.836 0 0 0 .837.837.836.836 0 0 0 .84-.837Zm2.378.85a4.144 4.144 0 0 0-1.131-2.934A4.172 4.172 0 0 0 9.89.049c-1.156-.066-4.622-.066-5.778 0a4.166 4.166 0 0 0-2.934 1.128A4.158 4.158 0 0 0 .049 4.111c-.066 1.156-.066 4.622 0 5.778a4.145 4.145 0 0 0 1.131 2.935 4.177 4.177 0 0 0 2.934 1.131c1.156.066 4.622.066 5.778 0a4.145 4.145 0 0 0 2.935-1.131 4.172 4.172 0 0 0 1.131-2.934c.066-1.157.066-4.619 0-5.776Zm-1.491 7.016a2.363 2.363 0 0 1-1.331 1.331 15.434 15.434 0 0 1-4.131.281 15.554 15.554 0 0 1-4.125-.281 2.363 2.363 0 0 1-1.331-1.331 15.434 15.434 0 0 1-.281-4.125 15.554 15.554 0 0 1 .281-4.128 2.363 2.363 0 0 1 1.331-1.331 15.434 15.434 0 0 1 4.125-.285 15.554 15.554 0 0 1 4.128.281 2.363 2.363 0 0 1 1.331 1.331 15.434 15.434 0 0 1 .285 4.132 15.425 15.425 0 0 1-.282 4.125Z"/></svg>
      </a>';
        $cartsy_lite_html .= '</li>';
      }
      if ($cartsy_lite_linkedin_switch !== 'off') {
        $cartsy_lite_html .= '<li class="cartsylite-social-profile-item">';
        $cartsy_lite_html .= '<a href="' . esc_url($cartsy_lite_linkedin_link) . '" title="linkedin" target="_blank" rel="noopener"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 14.004 14.004" fill="currentColor"><path d="M12.094 0H1.91A1.91 1.91 0 0 0 0 1.91v10.184A1.91 1.91 0 0 0 1.91 14h10.184A1.91 1.91 0 0 0 14 12.094V1.91A1.91 1.91 0 0 0 12.094 0Zm-7.32 11.082a.3.3 0 0 1-.3.3H3.221a.3.3 0 0 1-.3-.3V5.808a.3.3 0 0 1 .3-.3h1.258a.3.3 0 0 1 .3.3Zm-.925-6.069a1.194 1.194 0 1 1 1.194-1.194 1.194 1.194 0 0 1-1.194 1.194Zm7.5 6.09a.271.271 0 0 1-.272.272H9.725a.271.271 0 0 1-.272-.272V8.632c0-.369.108-1.617-.965-1.617-.831 0-1 .854-1.034 1.237v2.853a.272.272 0 0 1-.268.272H5.878a.271.271 0 0 1-.271-.272v-5.32a.271.271 0 0 1 .271-.272h1.307a.272.272 0 0 1 .272.272v.46a1.851 1.851 0 0 1 1.743-.82c2.163 0 2.148 2.019 2.148 3.129Z"/></svg></a>';
        $cartsy_lite_html .= '</li>';
      }
      if ($cartsy_lite_pinterest_switch !== 'off') {
        $cartsy_lite_html .= '<li class="cartsylite-social-profile-item">';
        $cartsy_lite_html .= '<a href="' . esc_url($cartsy_lite_pinterest_profile_link) . '" title="pinterest" target="_blank" rel="noopener"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="1em" height="1em" viewBox="0 0 15.5 15.5"><path d="M15.5 7.75A7.749 7.749 0 0 0 7.75 0 7.749 7.749 0 0 0 0 7.75a7.753 7.753 0 0 0 4.925 7.219 7.5 7.5 0 0 1 .028-2.225c.141-.606.906-3.85.906-3.85a2.792 2.792 0 0 1-.231-1.15c0-1.078.625-1.881 1.4-1.881a.973.973 0 0 1 .985 1.087 15.573 15.573 0 0 1-.641 2.581 1.124 1.124 0 0 0 1.147 1.4c1.378 0 2.437-1.453 2.437-3.55a3.06 3.06 0 0 0-3.237-3.15 3.354 3.354 0 0 0-3.5 3.362 3.052 3.052 0 0 0 .572 1.769.232.232 0 0 1 .053.222c-.059.244-.191.772-.216.878-.034.141-.112.172-.259.1a3.478 3.478 0 0 1-1.572-3c0-2.447 1.778-4.691 5.122-4.691A4.549 4.549 0 0 1 12.7 7.35c0 2.672-1.684 4.822-4.022 4.822a2.076 2.076 0 0 1-1.778-.894s-.387 1.481-.481 1.844a8.712 8.712 0 0 1-.963 2.028 7.72 7.72 0 0 0 2.294.35 7.749 7.749 0 0 0 7.75-7.75Z"/></svg></a>';
        $cartsy_lite_html .= '</li>';
      }
      if ($cartsy_lite_youtube_switch !== 'off') {
        $cartsy_lite_html .= '<li class="cartsylite-social-profile-item">';
        $cartsy_lite_html .= '<a href="' . esc_url($cartsy_lite_youtube_profile_link) . '" title="youtube" target="_blank" rel="noopener"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16.94 12" fill="currentColor"><path d="M16.7 1.964A1.892 1.892 0 0 0 15.181.416a54.44 54.44 0 0 0-13.428 0 1.892 1.892 0 0 0-1.52 1.548 34.61 34.61 0 0 0 0 8.072 1.891 1.891 0 0 0 1.523 1.544 54.44 54.44 0 0 0 13.428 0 1.891 1.891 0 0 0 1.516-1.544 34.6 34.6 0 0 0 0-8.072Zm-9.645 6.86V3.18l4.235 2.823Z"/></svg></a>';
        $cartsy_lite_html .= '</li>';
      }
      if ($cartsy_lite_twitter_switch !== 'off') {
        $cartsy_lite_html .= '<li class="cartsylite-social-profile-item">';
        $cartsy_lite_html .= '<a href="' . esc_url($cartsy_lite_twitter_link) . '" title="twitter" target="_blank" rel="noopener"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 9.506 16" fill="currentColor"><path d="M9.434 15.009c.116-.122.069-.3.013-.453l-.688-2.009a.338.338 0 0 0-.231-.247.659.659 0 0 0-.4.069c-1.384.556-2.125-.05-2.125-1.119V7.087h2.609a.313.313 0 0 0 .313-.312V4.222a.311.311 0 0 0-.312-.309H6.019v-3.6A.313.313 0 0 0 5.706 0H3.49c-.3 0-.478.166-.5.509a3.974 3.974 0 0 1-2.637 3.66.529.529 0 0 0-.353.5v2.125a.313.313 0 0 0 .312.313h1.485v4.5c0 1.618.818 4.393 4.594 4.393a4.476 4.476 0 0 0 3.043-.991Z"/></svg>
      </a>';
        $cartsy_lite_html .= '</li>';
      }
      $cartsy_lite_html .= '</ul>';
    }

    return $cartsy_lite_html;
  }
}

if (!function_exists('cartsy_lite_post_meta')) {
  /**
   * cartsy_lite_post_meta
   *
   * @return void
   */
  function cartsy_lite_post_meta()
  {
    $number_of_comment  = get_comments_number();
    $comment          = $number_of_comment > 1 ? $number_of_comment . ' comments' : $number_of_comment . ' comment';
    $allowed_HTML      = wp_kses_allowed_html('post');
    $html             = '';

    $html .= '<span class="date"><time>' . get_the_date() . '</time></span>';
    if ($number_of_comment > 0) {
      $html .= '<span class="number-of-comment"> ' . wp_kses($comment, $allowed_HTML) . '</span>';
    }

    echo wp_kses($html, $allowed_HTML);
  }
}


if (!function_exists('cartsy_lite_post_thumbnail')) {
  /**
   * cartsy_lite_post_thumbnail
   *
   * @return void
   */
  function cartsy_lite_post_thumbnail()
  {
    $allowed_HTML     = wp_kses_allowed_html('post');
    $html            = '';

    if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
      return;
    }
    if (is_singular()) {
      $html .= '<div class="post-thumbnail">';
      $html .= the_post_thumbnail();
      $html .= '</div>';
    } else {
      $html .= the_post_thumbnail('post-thumbnail', array(
        'alt' => the_title_attribute(array(
          'echo' => false,
        )),
      ));
    }

    echo wp_kses($html, $allowed_HTML);
  }
}


if (!function_exists('cartsy_lite_post_category')) {

  /**
   * cartsy_lite_post_category
   *
   * @return void
   */
  function cartsy_lite_post_category()
  {
    $categories               = get_the_category();
    $categories_length        = count($categories);
    $remain_categories_length = $categories_length - 2;
    $categories               = $categories_length >= 2 ? array_slice($categories, 0, 2) : $categories;
    $allowed_HTML             = wp_kses_allowed_html('post');
    $html                     = '';

    if ($categories_length > 0) {
      $html .= '<span class="categories">';
      foreach ($categories as $category) {
        $html .= '<a class="category" href="' . esc_url(get_term_link($category->term_id)) . '">' . $category->name . '</a>';
      }
      if ($categories_length > 2) {
        $html .= '<a class="more" href="' . esc_url(get_permalink()) . '">' . $remain_categories_length . '+ </a>';
      }
      $html .= '</span>';

      echo wp_kses($html, $allowed_HTML);
    }
  }
}



if (!function_exists('cartsy_lite_post_navigation')) {
  /**
   * cartsy_lite_post_navigation
   *
   * @return void
   */
  function cartsy_lite_post_navigation()
  {
    $prevPost       = get_previous_post();
    $nextPost       = get_next_post();
    $allowedHTML    = wp_kses_allowed_html('post');
    $html           = '';

    if ($prevPost || $nextPost) {
      $html .= '<nav class="navigation post-navigation">';
      $html .= '<div class="nav-links">';
      if ($prevPost) {
        $html .= '<a class="nav-previous" href="' . esc_url(get_permalink($prevPost->ID)) . '">';
        $html .= '<div class="thumb-img">' . get_the_post_thumbnail($prevPost->ID, array(90, 90)) . '</div>';
        $html .= '<div class="nav-text">';
        $html .= '<h5>' . $prevPost->post_title . '</h5>';
        $html .= '<p>' . esc_html__('Previous',  'cartsy-lite') . '</p>';
        $html .= '</div>';
        $html .= '</a>';
      }
      if ($prevPost && $nextPost) {
        $html .= '<span class="hr-bar"></span>';
      }
      if ($nextPost) {
        $html .= '<a class="nav-next" href="' . esc_url(get_permalink($nextPost->ID)) . '">';
        $html .= '<div class="nav-text">';
        $html .= '<h5>' . $nextPost->post_title . '</h5>';
        $html .= '<p>' . esc_html__('Next',  'cartsy-lite') . '</p>';
        $html .= '</div>';
        $html .= '<div class="thumb-img">' . get_the_post_thumbnail($nextPost->ID, array(90, 90)) . '</div>';
        $html .= '</a>';
      }
      $html .= '</div>';
      $html .= '</nav>';
    }

    echo wp_kses($html, $allowedHTML);
  }
}

if (!function_exists('cartsy_lite_woocommerce_check_product_in_cart')) {
  /**
   * cartsy_lite_woocommerce_check_product_in_cart
   *
   * @return void
   */
  function cartsy_lite_woocommerce_check_product_in_cart($product_id)
  {
    if (!is_null(WC()->cart) && !WC()->cart->is_empty()) {
      $cart_items = WC()->cart->get_cart();

      if (!count($cart_items)) {
        return false;
      }

      foreach ($cart_items as $cart_item_key => $cart_item) {
        if ($cart_item['product_id'] === $product_id) {
          return $cart_item['quantity'];
        }
      }
    }

    return false;
  }
}

if (!function_exists('cartsy_lite_comments')) {
  /**
   * cartsy_lite_comments.
   *
   * @param mixed $comment
   * @param mixed $args
   * @param mixed $depth
   *
   * @return void
   */
  function cartsy_lite_comments($comment, $args, $depth)
  {
    $allowedHTML = wp_kses_allowed_html('post');
    $GLOBALS['comment'] = $comment; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
    extract($args, EXTR_SKIP);
    $commentPostType = get_post_type($comment->comment_post_ID);
    $key = 'nickname';
    $single = true;
    $userId = !empty($comment->user_id) ? $comment->user_id : 0;
    $custom_avatar = get_user_meta($userId, 'user_custom_gravater', true);
    $user = get_userdata($userId);
    if (!$userId) {
      $display_name = $comment->comment_author;
    } else {
      $display_name = $user->user_login;
    }
    $firstName = get_user_meta($userId, 'first_name', true);
    $lastName = get_user_meta($userId, 'last_name', true);

    $authorName = $display_name;
    if ($firstName || $lastName) {
      $authorName = $firstName . ' ' . $lastName;
    }
    $avatarUrl = CARTSY_LITE_ASSETS . '/client/images/avatar.png';
    if ($custom_avatar && count($custom_avatar)) {
      $avatarUrl = $custom_avatar[0]['url'];
    }
    $comment_author_url = get_comment_author_url($comment);
    $comment_author = get_comment_author($comment);
    $avatar = get_avatar($comment, $args['avatar_size']); ?>
    <?php if (($commentPostType === 'post') || ($commentPostType === 'page')) { ?>
      <li <?php comment_class($args['has_children'] ? 'post-comment has-children' : 'post-comment'); ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment-card">
          <?php if (!empty($avatar)) { ?>
            <div class="comment-avatar">
              <?php echo wp_kses($avatar, $allowedHTML); ?>
            </div>
          <?php } ?>
          <div class="comment-content">
            <div class="comment-meta">
              <?php
              if (!empty($comment_author_url)) {
                printf('<a href="%s" rel="external nofollow" class="url">', esc_url($comment_author_url));
              }
              ?>
              <div class="name">
                <h5>
                  <?php
                  printf(
                    wp_kses_post(
                      /* translators: %s: Comment author link. */
                      ('%1$s <span class="screen-reader-text says">%2$s</span>')
                    ),
                    '<b class="fn">' . $comment_author . '</b>', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    esc_html__("says:", 'cartsy-lite')
                  );
                  ?>
                </h5>
              </div>
              <?php
              if (!empty($comment_author_url)) {
                echo wp_kses('</a>', $allowedHTML);
              }
              ?>
              <?php comment_reply_link(array_merge($args, ['reply_text' => 'Reply' . '', 'depth' => $depth, 'max_depth' => $args['max_depth']])); ?>
            </div>
            <div class="content">
              <?php if ($comment->comment_approved == '0') : ?>
                <em> <?php esc_html_e('Your comment is awaiting moderation.',  'cartsy-lite'); ?></em><br />
              <?php endif; ?>
              <?php comment_text(); ?>
            </div>
            <div class="action">
              <div class="date"> <?php comment_date(get_option('date_format')); ?> </div>
              <?php edit_comment_link(esc_html__('Edit', 'cartsy-lite'), '  ', ''); ?>
            </div>
          </div>
        </div>

      <?php } ?>
    <?php
  }
}

if (!function_exists('cartsy_lite_header_horizontal_menu')) {
  /**
   * Header horizontal menu.
   *
   * @since 1.2
   */
  function cartsy_lite_header_horizontal_menu()
  {
    $template = cartsy_lite_get_header_template_slug() . '/horizontal-menu';

    get_template_part($template);
  }
}

if (!function_exists('cartsy_lite_get_header_template_slug')) {
  /**
   * Header templates slug
   *
   * @since 1.2
   */
  function cartsy_lite_get_header_template_slug()
  {
    return 'template-parts/header';
  }
}

if (!function_exists('cartsy_lite_check_woo_sidebar_availability')) {
  /**
   * cartsy_lite_check_woo_sidebar_availability.
   *
   * @return boolean
   */
  function cartsy_lite_check_woo_sidebar_availability()
  {
    if (!class_exists('WooCommerce') && is_active_sidebar('cartsylite-woo-sidebar')) {
      return;
    }
    $cartsy_lite_display_sidebar = $cartsy_lite_single_display_sidebar = '';
    if (class_exists('Kirki')) {
      $cartsy_lite_display_sidebar = cartsy_lite_global_option_data('cartsy_lite_woo_sidebar_switch', 'on');
      $cartsy_lite_single_display_sidebar = cartsy_lite_global_option_data('cartsy_lite_woo_single_sidebar_switch', 'on');
    } else {
      $cartsy_lite_display_sidebar = "on";
      $cartsy_lite_single_display_sidebar = "on";
    }
    if (!is_single()) {
      return (!empty($cartsy_lite_display_sidebar) && $cartsy_lite_display_sidebar === 'on');
    } else {
      return (!empty($cartsy_lite_single_display_sidebar) && $cartsy_lite_single_display_sidebar === 'on');
    }
  }
}

if (!function_exists('cartsy_lite_get_global_template_slug')) {
  /**
   * Header templates slug
   *
   * @since 1.2
   */
  function cartsy_lite_get_global_template_slug()
  {
    return 'template-parts/global';
  }
}

if (!function_exists('cartsy_lite_get_banner_template_slug')) {
  /**
   * Banner templates slug
   *
   * @since 1.2
   */
  function cartsy_lite_get_banner_template_slug()
  {
    return 'template-parts/banner';
  }
}

if (!function_exists('cartsy_lite_banner_dynamicCSS')) {
  /**
   * cartsy_lite_banner_dynamicCSS.
   *
   * @param mixed $cartsy_lite_banner_colorSchema
   *
   * @return void
   */
  function cartsy_lite_banner_dynamicCSS($cartsy_lite_banner_colorSchema)
  {
    $cartsy_lite_css_variables = $cartsy_lite_pageBannerBGColor = $cartsy_lite_pageBannerTextColor = '';
    if (!empty($cartsy_lite_banner_colorSchema) && is_array($cartsy_lite_banner_colorSchema)) {
      foreach ($cartsy_lite_banner_colorSchema as $value) {
        $cartsy_lite_pageBannerBGColor   = isset($value['cartsy_lite_pageBannerBGColor']) ? $value['cartsy_lite_pageBannerBGColor'] : "#FFF";
        $cartsy_lite_pageBannerTextColor = isset($value['cartsy_lite_pageBannerTextColor']) ? $value['cartsy_lite_pageBannerTextColor'] : "";
      }
    }
    $cartsy_lite_css_variables .= '
        --cartsyliteBannerBGColor: ' . $cartsy_lite_pageBannerBGColor . ';
        --cartsyliteBannerTextColor: ' . $cartsy_lite_pageBannerTextColor . ';
    ';

    return $cartsy_lite_css_variables;
  }
}

if (!function_exists('cartsy_lite_is_blog')) {
  /**
   * Check whether blog template or not
   *
   * @since 1.2
   */
  function cartsy_lite_is_blog()
  {
    if ((is_archive() || is_author() || is_category() || is_home() || is_tag() || is_search() || is_singular('post')) && (get_post_type() === 'post')) {
      return true;
    }
    return false;
  }
}

if (!function_exists('cartsy_lite_is_woo_page')) {
  /**
   * Check whether woocommerce archive template or not
   *
   * @since 1.2
   */
  function cartsy_lite_is_woo_page()
  {
    if (class_exists('WooCommerce')) {
      if (is_archive() || is_shop() || is_cart() || is_account_page() || is_checkout() || is_product()) {
        return true;
      }
    }

    return false;
  }
}


/**
 * cartsy_lite_typo_controller
 *
 * @param  mixed $typo
 * @param  mixed $default
 * @return void
 */
function cartsy_lite_typo_controller($typo, $default)
{
  $typo_array = [];

  if (class_exists('Kirki')) {
    if (!empty($typo['variant'])) {
      if (preg_match("/^\d+$/", $typo['variant'])) {
        // check if number only
        $typo_array['font-weight'] = $typo['variant'];
        $typo_array['font-style'] = '';
      } elseif (preg_match('~[0-9]+~', $typo['variant'])) {
        // check if string has number
        // then split the number and sting
        $splittedVariant = preg_split('/(?<=[0-9])(?=[\sa-z]+)/i', $typo['variant']);
        $typo_array['font-weight'] = $splittedVariant[0];
        $typo_array['font-style'] = $splittedVariant[1];
      } else {
        // if string only
        $typo_array['font-weight'] = '';
        $typo_array['font-style']  = $typo['variant'];
      }
    } else {
      $typo_array['font-weight'] = $default['font-weight'];
      $typo_array['font-style']  = $default['font-style'];
    }
    $typo_array['font-family']    = !empty($typo['font-family']) ? $typo['font-family']   : $default['font-family'];
    $typo_array['font-size']      = !empty($typo['font-size'])   ? $typo['font-size']     : $default['font-size'];
    $typo_array['line-height']    = !empty($typo['line-height']) ? $typo['line-height']   : $default['line-height'];
    $typo_array['letter-spacing'] = !empty($typo['letter-spacing']) ? $typo['letter-spacing'] : $default['letter-spacing'];
    $typo_array['color']          = !empty($typo['color']) ? $typo['color'] : $default['color'];
    $typo_array['text-transform'] = !empty($typo['text-transform']) ? $typo['text-transform'] : $default['text-transform'];
  } else {
    return $default;
  }

  return $typo_array;
}

/**
 * cartsy_lite_globalDynamicCSS.
 *
 * @return void
 */
function cartsy_lite_globalDynamicCSS()
{

  // color and string control variables
  $cartsy_lite_primaryColor = "#212121";
  $cartsy_lite_primaryHoverColor = "#3a3a3a";
  $cartsy_lite_secondaryColor = "#212121";
  $cartsy_lite_darkTextColor = "#212121";
  $cartsy_lite_mainTextColor = "#212121";
  $cartsy_lite_lightTextColor = "#5A5A5A";
  $cartsy_lite_lighterTextColor = '#999999';
  $cartsy_lite_commentTextColor = '#707070';

  $cartsy_lite_header_bg_color = "#FFF";
  $cartsy_lite_header_color = "#212121";
  $cartsy_lite_header_hover_color = "#3a3a3a";
  $cartsy_lite_header_hover_bg_color = "#f3f3f3";

  $cartsy_lite_footer_text_color = "#212121";
  $cartsy_lite_footer_bg_color = "#FFFFFF";

  $cartsy_lite_default_heading1 = [
    'font-family'    => 'Open Sans',
    'variant'        => '700',
    'font-size'      => '36px',
    'line-height'    => '1.625',
    'letter-spacing' => '0',
    'color'          => '#212121',
    'text-transform' => 'none',
    'font-weight'    => 700,
    'font-style'     => 'normal'
  ];

  $cartsy_lite_default_heading2 = [
    'font-family'    => 'Open Sans',
    'variant'        => '700',
    'font-size'      => '28px',
    'line-height'    => '1.625',
    'letter-spacing' => '0',
    'color'          => '#212121',
    'text-transform' => 'none',
    'font-weight'    => 700,
    'font-style'     => 'normal',
  ];

  $cartsy_lite_default_heading3 = [
    'font-family'    => 'Open Sans',
    'variant'        => '700',
    'font-size'      => '24px',
    'line-height'    => '1.625',
    'letter-spacing' => '0',
    'color'          => '#212121',
    'text-transform' => 'none',
    'font-weight'    => 700,
    'font-style'     => 'normal',
  ];

  $cartsy_lite_default_heading4 = [
    'font-family'    => 'Open Sans',
    'variant'        => '700',
    'font-size'      => '16px',
    'line-height'    => '1.625',
    'letter-spacing' => '0',
    'color'          => '#212121',
    'text-transform' => 'none',
    'font-weight'    => 700,
    'font-style'     => 'normal',
  ];

  $cartsy_lite_default_heading5 = [
    'font-family'    => 'Open Sans',
    'variant'        => '700',
    'font-size'      => '14px',
    'line-height'    => '1.625',
    'letter-spacing' => '0',
    'color'          => '#212121',
    'text-transform' => 'none',
    'font-weight'    => 700,
    'font-style'     => 'normal',
  ];

  $cartsy_lite_default_heading6 = [
    'font-family'    => 'Open Sans',
    'variant'        => '700',
    'font-size'      => '13px',
    'line-height'    => '1.625',
    'letter-spacing' => '0',
    'color'          => '#212121',
    'text-transform' => 'none',
    'font-weight'    => 700,
    'font-style'     => 'normal',
  ];

  $cartsy_lite_default_bodyTypography = [
    'font-family'    => 'Open Sans',
    'variant'        => 'regular',
    'font-size'      => '16px',
    'line-height'    => '1.625',
    'font-weight'    => 400,
    'font-style'     => 'normal',
    'text-transform' => 'none',
    'letter-spacing' => '0',
    'color'          => '',
  ];

  $cartsy_lite_default_widgetTypography = [
    'font-family'    => 'Open Sans',
    'variant'        => 'regular',
    'font-size'      => '21px',
    'line-height'    => '1.625',
    'font-weight'    => 600,
    'font-style'     => 'normal',
    'text-transform' => 'none',
    'letter-spacing' => '0',
    'color'          => '',
  ];

  wp_enqueue_style(
    'cartsy-lite-custom-style',
    get_template_directory_uri() . '/assets/global/css/custom_script.css'
  );


  if (function_exists('cartsy_lite_global_option_data')) {
    // colors
    $cartsy_lite_primaryColor          = cartsy_lite_global_option_data('cartsy_lite_primary_color', $cartsy_lite_primaryColor);
    $cartsy_lite_primaryHoverColor     = cartsy_lite_global_option_data('cartsy_lite_primary_hover_color', $cartsy_lite_primaryHoverColor);
    $cartsy_lite_secondaryColor        = cartsy_lite_global_option_data('cartsy_lite_secondary_color', $cartsy_lite_secondaryColor);
    $cartsy_lite_darkTextColor         = cartsy_lite_global_option_data('cartsy_lite_dark_text_color', $cartsy_lite_darkTextColor);
    $cartsy_lite_mainTextColor         = cartsy_lite_global_option_data('cartsy_lite_main_text_color', $cartsy_lite_mainTextColor);
    $cartsy_lite_lightTextColor        = cartsy_lite_global_option_data('cartsy_lite_light_text_color', $cartsy_lite_lightTextColor);
    $cartsy_lite_lighterTextColor      = cartsy_lite_global_option_data('cartsy_lite_lighter_text_color', $cartsy_lite_lighterTextColor);
    // Footer
    $cartsy_lite_footer_text_color     = cartsy_lite_global_option_data('cartsy_lite_footer_text_color', $cartsy_lite_footer_text_color);
    $cartsy_lite_footer_bg_color       = cartsy_lite_global_option_data('cartsy_lite_footer_bg_color', $cartsy_lite_footer_bg_color);
    // Header
    $cartsy_lite_header_bg_color       = cartsy_lite_global_option_data('cartsy_lite_header_initial_color', $cartsy_lite_header_bg_color);
    $cartsy_lite_header_color          = cartsy_lite_global_option_data('cartsy_lite_header_menu_color', $cartsy_lite_header_color);
    $cartsy_lite_header_hover_color    = cartsy_lite_global_option_data('cartsy_lite_header_menu_hover_color', $cartsy_lite_header_hover_color);
    $cartsy_lite_header_hover_bg_color = cartsy_lite_global_option_data('cartsy_lite_header_menu_hover_bg_color', $cartsy_lite_header_hover_bg_color);
    // typography
    $cartsy_lite_typo_switch = cartsy_lite_global_option_data('cartsy_lite_typography_switch', 'on');
    if (!empty($cartsy_lite_typo_switch) && $cartsy_lite_typo_switch === "on") {
      $cartsy_lite_heading1         = cartsy_lite_global_option_data('cartsy_lite_heading1_typography_setting', $cartsy_lite_default_heading1);
      $cartsy_lite_heading2         = cartsy_lite_global_option_data('cartsy_lite_heading2_typography_setting', $cartsy_lite_default_heading2);
      $cartsy_lite_heading3         = cartsy_lite_global_option_data('cartsy_lite_heading3_typography_setting', $cartsy_lite_default_heading3);
      $cartsy_lite_heading4         = cartsy_lite_global_option_data('cartsy_lite_heading4_typography_setting', $cartsy_lite_default_heading4);
      $cartsy_lite_heading5         = cartsy_lite_global_option_data('cartsy_lite_heading5_typography_setting', $cartsy_lite_default_heading5);
      $cartsy_lite_heading6         = cartsy_lite_global_option_data('cartsy_lite_heading6_typography_setting', $cartsy_lite_default_heading6);
      $cartsy_lite_bodyTypography   = cartsy_lite_global_option_data('cartsy_lite_body_typography_setting', $cartsy_lite_default_bodyTypography);
      $cartsy_lite_widgetTypography = cartsy_lite_global_option_data('cartsy_lite_widget_typography_setting', $cartsy_lite_default_widgetTypography);
    }
  }

  $cartsy_lite_heading1 = cartsy_lite_typo_controller($cartsy_lite_heading1, $cartsy_lite_default_heading1);
  $cartsy_lite_heading2 = cartsy_lite_typo_controller($cartsy_lite_heading2, $cartsy_lite_default_heading2);
  $cartsy_lite_heading3 = cartsy_lite_typo_controller($cartsy_lite_heading3, $cartsy_lite_default_heading3);
  $cartsy_lite_heading4 = cartsy_lite_typo_controller($cartsy_lite_heading4, $cartsy_lite_default_heading4);
  $cartsy_lite_heading5 = cartsy_lite_typo_controller($cartsy_lite_heading5, $cartsy_lite_default_heading5);
  $cartsy_lite_heading6 = cartsy_lite_typo_controller($cartsy_lite_heading6, $cartsy_lite_default_heading6);
  $cartsy_lite_bodyTypography = cartsy_lite_typo_controller($cartsy_lite_bodyTypography, $cartsy_lite_default_bodyTypography);
  $cartsy_lite_widgetTypography = cartsy_lite_typo_controller($cartsy_lite_widgetTypography, $cartsy_lite_default_widgetTypography);

  $cssVariables = '';
  $cssVariables .= '
    :root {
        --colorPrimary: ' . $cartsy_lite_primaryColor . ';
        --colorPrimaryHover: ' . $cartsy_lite_primaryHoverColor . ';
        --colorSecondary: ' . $cartsy_lite_secondaryColor . ';
        --colorTextDark: ' . $cartsy_lite_darkTextColor . ';
        --colorTextMain: ' . $cartsy_lite_mainTextColor . ';
        --colorTextLight: ' . $cartsy_lite_lightTextColor . ';
        --colorTextLighter: ' . $cartsy_lite_lighterTextColor . ';
        --colorCommentText: ' . $cartsy_lite_commentTextColor . ';
        --footerTextColor: ' . $cartsy_lite_footer_text_color . ';
        --footerBgColor: ' . $cartsy_lite_footer_bg_color . ';
        --cartsyliteLocalDefaultHeaderColor: ' . $cartsy_lite_header_bg_color . '; 
        --cartsyliteLocalMenuTextColor: ' . $cartsy_lite_header_color . '; 
        --cartsyliteLocalMenuTextHoverColor: ' . $cartsy_lite_header_hover_color . '; 
        --cartsyliteLocalMenuTextHoverBgColor: ' . $cartsy_lite_header_hover_bg_color . ';

        --h1FontFamily: ' . $cartsy_lite_heading1['font-family'] . ';
        --h1FontSize: ' . $cartsy_lite_heading1['font-size'] . ';
        --h1FontWeight: ' . $cartsy_lite_heading1['font-weight'] . ';
        --h1FontStyle: ' . $cartsy_lite_heading1['font-style'] . ';
        --h1LineHeight: ' . $cartsy_lite_heading1['line-height'] . ';
        --h1Color: ' . $cartsy_lite_heading1['color'] . ';
        --h1LetterSpacing: ' . $cartsy_lite_heading1['letter-spacing'] . ';
        --h1TextTransform: ' . $cartsy_lite_heading1['text-transform'] . ';

        --h2FontFamily: ' . $cartsy_lite_heading2['font-family'] . ';
        --h2FontSize: ' . $cartsy_lite_heading2['font-size'] . ';
        --h2FontWeight: ' . $cartsy_lite_heading2['font-weight'] . ';
        --h2FontStyle: ' . $cartsy_lite_heading2['font-style'] . ';
        --h2LineHeight: ' . $cartsy_lite_heading2['line-height'] . ';
        --h2Color: ' . $cartsy_lite_heading2['color'] . ';
        --h2LetterSpacing: ' . $cartsy_lite_heading2['letter-spacing'] . ';
        --h2TextTransform: ' . $cartsy_lite_heading2['text-transform'] . ';

        --h3FontFamily: ' . $cartsy_lite_heading3['font-family'] . ';
        --h3FontSize: ' . $cartsy_lite_heading3['font-size'] . ';
        --h3FontWeight: ' . $cartsy_lite_heading3['font-weight'] . ';
        --h3FontStyle: ' . $cartsy_lite_heading3['font-style'] . ';
        --h3LineHeight: ' . $cartsy_lite_heading3['line-height'] . ';
        --h3Color: ' . $cartsy_lite_heading3['color'] . ';
        --h3LetterSpacing: ' . $cartsy_lite_heading3['letter-spacing'] . ';
        --h3TextTransform: ' . $cartsy_lite_heading3['text-transform'] . ';

        --h4FontFamily: ' . $cartsy_lite_heading4['font-family'] . ';
        --h4FontSize: ' . $cartsy_lite_heading4['font-size'] . ';
        --h4FontWeight: ' . $cartsy_lite_heading4['font-weight'] . ';
        --h4FontStyle: ' . $cartsy_lite_heading4['font-style'] . ';
        --h4LineHeight: ' . $cartsy_lite_heading4['line-height'] . ';
        --h4Color: ' . $cartsy_lite_heading4['color'] . ';
        --h4LetterSpacing: ' . $cartsy_lite_heading4['letter-spacing'] . ';
        --h4TextTransform: ' . $cartsy_lite_heading4['text-transform'] . ';

        --h5FontFamily: ' . $cartsy_lite_heading5['font-family'] . ';
        --h5FontSize: ' . $cartsy_lite_heading5['font-size'] . ';
        --h5FontWeight: ' . $cartsy_lite_heading5['font-weight'] . ';
        --h5FontStyle: ' . $cartsy_lite_heading5['font-style'] . ';
        --h5LineHeight: ' . $cartsy_lite_heading5['line-height'] . ';
        --h5Color: ' . $cartsy_lite_heading5['color'] . ';
        --h5LetterSpacing: ' . $cartsy_lite_heading5['letter-spacing'] . ';
        --h5TextTransform: ' . $cartsy_lite_heading5['text-transform'] . ';

        --h6FontFamily: ' . $cartsy_lite_heading6['font-family'] . ';
        --h6FontSize: ' . $cartsy_lite_heading6['font-size'] . ';
        --h6FontWeight: ' . $cartsy_lite_heading6['font-weight'] . ';
        --h6FontStyle: ' . $cartsy_lite_heading6['font-style'] . ';
        --h6LineHeight: ' . $cartsy_lite_heading6['line-height'] . ';
        --h6Color: ' . $cartsy_lite_heading6['color'] . ';
        --h6LetterSpacing: ' . $cartsy_lite_heading6['letter-spacing'] . ';
        --h6TextTransform: ' . $cartsy_lite_heading6['text-transform'] . ';

        --bodyFontFamily: ' . $cartsy_lite_bodyTypography['font-family'] . ';
        --bodyFontSize: ' . $cartsy_lite_bodyTypography['font-size'] . ';
        --bodyFontWeight: ' . $cartsy_lite_bodyTypography['font-weight'] . ';
        --bodyFontStyle: ' . $cartsy_lite_bodyTypography['font-style'] . ';
        --bodyLineHeight: ' . $cartsy_lite_bodyTypography['line-height'] . ';
        --bodyLetterSpacing: ' . $cartsy_lite_bodyTypography['letter-spacing'] . ';
        --bodyTextTransform: ' . $cartsy_lite_bodyTypography['text-transform'] . ';
        
        --widgetFontFamily: ' . $cartsy_lite_widgetTypography['font-family'] . ';
        --widgetFontSize: ' . $cartsy_lite_widgetTypography['font-size'] . ';
        --widgetFontWeight: ' . $cartsy_lite_widgetTypography['font-weight'] . ';
        --widgetFontStyle: ' . $cartsy_lite_widgetTypography['font-style'] . ';
        --widgetLineHeight: ' . $cartsy_lite_widgetTypography['line-height'] . ';
        --widgetLetterSpacing: ' . $cartsy_lite_widgetTypography['letter-spacing'] . ';
        --widgetTextTransform: ' . $cartsy_lite_widgetTypography['text-transform'] . ';
    }

    .cartsylite-home-page-thumb-area {
      background-image:url(' . esc_url(get_header_image()) . ');
    }
    ';
  wp_add_inline_style('cartsy-lite-custom-style', $cssVariables);
}

if (function_exists('cartsy_lite_globalDynamicCSS')) {
  add_action('wp_enqueue_scripts', 'cartsy_lite_globalDynamicCSS');
}

if (!function_exists('cartsy_lite_woo_cart_available')) {
  /**
   * Validates whether the Woo Cart instance is available in the request
   *
   * @since 2.6.0
   * @return bool
   */
  function cartsy_lite_woo_cart_available()
  {
    if (!class_exists('WooCommerce')) {
      return;
    }
    $woo = WC();
    return $woo instanceof \WooCommerce && $woo->cart instanceof \WC_Cart;
  }
}

if (!function_exists('cartsy_lite_cart_link')) {
  /**
   * Cart Link
   * Displayed a link to the cart including the number of items present and the cart total
   *
   * @return void
   * @since  1.0.0
   */
  function cartsy_lite_cart_link()
  {
    if (!class_exists('WooCommerce')) {
      return;
    }
    if (function_exists('cartsy_lite_woo_cart_available')) {
      if (!cartsy_lite_woo_cart_available()) {
        return;
      }
    } else {
      return;
    }
    ?>
      <div class="cartsylite-cart-icon-wrapper">
        <button class="cartsylite-cart-icon" aria-label="<?php echo esc_attr__("Cart", "cartsy-lite"); ?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20">
            <path d="M3,2H17a1,1,0,0,1,1,1V17a1,1,0,0,1-1,1H3a1,1,0,0,1-1-1V3A1,1,0,0,1,3,2ZM0,3A3,3,0,0,1,3,0H17a3,3,0,0,1,3,3V17a3,3,0,0,1-3,3H3a3,3,0,0,1-3-3Zm10,7C7.239,10,5,7.314,5,4H7c0,2.566,1.669,4,3,4s3-1.434,3-4h2C15,7.314,12.761,10,10,10Z" fill-rule="evenodd" />
          </svg>
        </button>
        <a class="cartsylite-cart-link" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'cartsy-lite'); ?>"></a>
        <div class="cartsylite-cart-contents">
          <span class="cartsylite-cart-count"><?php echo wp_kses_data(WC()->cart->get_cart_contents_count()); ?></span>
        </div>
      </div>
  <?php
  }
}

if (!function_exists('cartsy_lite_cart_link_fragment')) {
  /**
   * Cart Fragments
   * Ensure cart contents update when products are added to the cart via AJAX
   *
   * @param  array $fragments Fragments to refresh via AJAX.
   * @return array            Fragments to refresh via AJAX
   */
  function cartsy_lite_cart_link_fragment($fragments)
  {
    if (!class_exists('WooCommerce')) {
      return;
    }

    global $woocommerce;

    ob_start();
    cartsy_lite_cart_link();
    $fragments['.cartsylite-cart-icon-wrapper'] = ob_get_clean();

    return $fragments;
  }
}

if (!function_exists('cartsy_lite_do_shortcode')) {
  /**
   * Call a shortcode function by tag name.
   *
   * @since  1.0.0
   *
   * @param string $tag     The shortcode whose function to call.
   * @param array  $atts    The attributes to pass to the shortcode function. Optional.
   * @param array  $content The shortcode's content. Default is null (none).
   *
   * @return string|bool False on failure, the result of the shortcode on success.
   */
  function cartsy_lite_do_shortcode($tag, array $atts = array(), $content = null)
  {
    global $shortcode_tags;

    if (!isset($shortcode_tags[$tag])) {
      return false;
    }

    return call_user_func($shortcode_tags[$tag], $atts, $content, $tag);
  }
}

if (!function_exists('cartsy_lite_woocommerce_shortcode_products_query')) {
  /**
   * Call a shortcode product query.
   *
   * @since  1.0.0
   *
   */
  function cartsy_lite_woocommerce_shortcode_products_query($args)
  {
    $cartsy_lite_home_out_of_stock_product_switch = "on";

    if (class_exists('Kirki')) {
      if (function_exists('cartsy_lite_global_option_data')) {
        $cartsy_lite_home_out_of_stock_product_switch  = cartsy_lite_global_option_data('cartsy_lite_home_out_of_stock_product_switch', $cartsy_lite_home_out_of_stock_product_switch);
      }
    }

    if ('on' == $cartsy_lite_home_out_of_stock_product_switch) {
      $args['meta_query'][] = [
        'key'     => '_stock_status',
        'value'   => 'instock',
        'compare' => 'IN'
      ];
    }

    return $args;
  }
}
