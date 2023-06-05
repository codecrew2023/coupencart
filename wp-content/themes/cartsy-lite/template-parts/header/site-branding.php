<?php
$cartsy_lite_site_logo = get_theme_mod('custom_logo');
$cartsy_lite_description = get_bloginfo('description', 'display');

$allowedHTML = wp_kses_allowed_html('post');
?>

<div class="site-branding">
    <?php if (!empty($cartsy_lite_site_logo)) { ?>
        <div class="cartsylite-header-logo-wrapper">
            <h2 class="site-title">
                <?php the_custom_logo(); ?>
            </h2>
        </div>
    <?php } else { ?>
        <div class="cartsylite-header-logo-wrapper">
            <?php if (is_front_page() && is_home()) : ?>
                <h2 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h2>
            <?php else : ?>
                <h2 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h2>
            <?php endif; ?>

            <?php if ($cartsy_lite_description || is_customize_preview()) : ?>
                <p class="site-description">
                    <?php echo wp_kses($cartsy_lite_description, $allowedHTML); // phpcs:ignore WordPress.Security.EscapeOutput.DeprecatedWhitelistCommentFound ?>
                </p>
            <?php endif; ?>
        </div>
    <?php } ?>
</div>