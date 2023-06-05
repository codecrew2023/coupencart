<?php
    $cartsy_lite_calling_menu_class = 'Cartsy_Lite\\Framework\\Client\\Cartsy_Lite_Menu_Walker';
?>

<nav id="site-horizontal-navigation" class="cartsylite-horizontal-navigation">
    <div class="cartsylite-horizontal-menu">
        <?php
            wp_nav_menu(array(
                'container'       => 'div',
                'container_class' => 'cartsylite-menu-wrapper',
                'theme_location'  => 'cartsylite-menu',
                'menu_id'         => 'horizontal-main-menu',
                'menu_class'      => 'cartsylite-main-menu',
                'walker'          => new $cartsy_lite_calling_menu_class(),
                'fallback_cb'     => 'Cartsy_Lite\\Framework\\Client\\Cartsy_Lite_Menu_Walker::fallback',
            ));
        ?>
    </div>
    <!-- end mobile menu -->
</nav>