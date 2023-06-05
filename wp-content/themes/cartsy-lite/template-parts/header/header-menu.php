<?php
$cartsy_lite_siteLogo = get_theme_mod('custom_logo');
$cartsy_lite_count_posts = wp_count_posts('page');
$cartsy_lite_calling_menu_class = 'Cartsy_Lite\\Framework\\Client\\Cartsy_Lite_Menu_Walker';
?>

<nav id="site-navigation" class="cartsylite-navigation-drawer">
    <button class="cartsylite-menu-toggler" aria-label="<?php bloginfo('name'); ?>">
        <span></span>
        <span></span>
        <span></span>
    </button>
    <div class="cartsylite-menu-drawer">
        <div class="cartsylite-menu-drawer-header">

            <?php if (empty($cartsy_lite_siteLogo)) { ?>
                <h2 class="site-title">
                    <a class="cartsylite-drawer-title" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </h2>
            <?php } else { ?>
                <?php the_custom_logo(); ?>
            <?php } ?>

            <button class="cartsylite-menu-drawer-close">
                <i class="dashicons dashicons-no-alt"></i>
            </button>
        </div>

        <?php
        wp_nav_menu(array(
            'container'       => 'div',
            'container_class' => 'cartsylite-menu-wrapper',
            'theme_location'  => 'cartsylite-menu',
            'menu_id'         => 'main-menu',
            'menu_class'      => 'cartsylite-main-menu',
            'walker'          => new $cartsy_lite_calling_menu_class(),
            'fallback_cb'     => 'Cartsy_Lite\\Framework\\Client\\Cartsy_Lite_Menu_Walker::fallback',
        ));
        ?>

        <?php
        /**
         * Functions hooked into cartsy_after_drawer_menu action
         *
         * @see template-hooks.php file
         * @see template-function.php file
         */
        do_action('cartsy_after_drawer_menu');
        ?>

        <?php if (is_user_logged_in()) { ?>
            <div class="cartsylite-menu-drawer-logout">
                <a href="<?php echo esc_url( wp_logout_url(home_url()) ); ?>">
                    <?php echo esc_html__('Logout', 'cartsy-lite'); ?>
                </a>
            </div>
        <?php } else { ?>
            <div class="cartsylite-menu-drawer-logout">
            <?php if (function_exists('cartsy_lite_my_account')) {
                cartsy_lite_my_account();
            }?>
            </div>
        <?php }  ?>
    </div>
    <!-- end mobile menu -->

    <div class="cartsylite-drawer-overlay">
    </div>
</nav>