<?php if (class_exists('WooCommerce')) { ?>
    <div class="cartsylite-menu-right-col">
        <?php if (function_exists('cartsy_lite_mini_cart')) {
            cartsy_lite_mini_cart();
        }?>
        <?php if (function_exists('cartsy_lite_header_search')) {
            cartsy_lite_header_search();
        }?>
        <?php if (function_exists('cartsy_lite_my_account')) {
            cartsy_lite_my_account();
        }?>
    </div>
<?php } ?>