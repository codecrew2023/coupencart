<?php
    if (!defined('ABSPATH')) {
        exit('Direct script access denied.');
    }
    
    $cartsy_lite_header_search_display = "on";
    if (function_exists('cartsy_lite_global_option_data')) {
        $cartsy_lite_header_search_display = cartsy_lite_global_option_data('cartsy_lite_enable_global_search', 'on');
    }
?>
<?php if (class_exists('WooCommerce') && !empty($cartsy_lite_header_search_display) && $cartsy_lite_header_search_display === "on") { ?>
    <button class="cartsylite-header-search-button" aria-label="<?php echo esc_attr__( "Search", "cartsy-lite" ); ?>" type="button">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20"><path d="M15.153,13.659a8.466,8.466,0,1,0-1.494,1.494l.045.048,4.49,4.49a1.058,1.058,0,1,0,1.5-1.5L15.2,13.7Zm-2.2-9.683a6.349,6.349,0,1,1-8.979,0A6.349,6.349,0,0,1,12.956,3.976Z" transform="translate(0 0)" fill-rule="evenodd"/></svg>
    </button>
    <div class="cartsylite-header-search-form">
        <div class="site-search">
            <?php the_widget('WC_Widget_Product_Search', 'title='); ?>
        </div>
    </div>
<?php }
