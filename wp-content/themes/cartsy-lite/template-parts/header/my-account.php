<?php
    $cartsy_lite_my_account_page_ID = get_option('woocommerce_myaccount_page_id'); 
?>
<?php if (class_exists('WooCommerce')) { ?>
    <?php if (!empty($cartsy_lite_my_account_page_ID)) { ?>
        <a class="cartsylite-join-us-btn" aria-label="<?php echo esc_attr__('My Account', 'cartsy-lite') ?>" href="<?php echo esc_url(get_permalink($cartsy_lite_my_account_page_ID)); ?>">
            <span class="cartsylite-join-us-btn-title"><?php echo esc_html__('My Account', 'cartsy-lite') ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" width="1em" viewBox="0 0 18.407 19.725"><path d="M.9,17.667a.9.9,0,0,1-.9-.9,7.368,7.368,0,0,1,2.393-5.888C3.973,9.528,6.264,8.84,9.2,8.84s5.231.688,6.81,2.045a7.372,7.372,0,0,1,2.393,5.888.9.9,0,0,1-.9.9Zm15.679-1.79C16.228,12.395,13.75,10.63,9.2,10.63s-7.025,1.765-7.371,5.247Z" transform="translate(0 2.058)"/><path d="M8.693,9.863A4.9,4.9,0,0,1,4,4.784,4.635,4.635,0,0,1,8.693,0a4.637,4.637,0,0,1,4.695,4.784A4.9,4.9,0,0,1,8.693,9.863Zm0-8.138a2.916,2.916,0,0,0-2.969,3.06A3.183,3.183,0,0,0,8.693,8.139a3.183,3.183,0,0,0,2.969-3.354,2.949,2.949,0,0,0-2.969-3.06Z" transform="translate(0.931)"/></svg>
        </a>
    <?php } ?>
<?php } ?>