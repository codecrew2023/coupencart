<?php

if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

$cartsy_lite_copyrightText = "on";
$cartsy_lite_copyright_url = "https://redq.io/cartsy";
if (function_exists('cartsy_lite_global_option_data')) {
    $cartsy_lite_copyrightText = cartsy_lite_global_option_data('cartsy_lite_footer_widget_switch', $cartsy_lite_copyrightText);
    $cartsy_lite_copyright_url = cartsy_lite_global_option_data('cartsy_lite_copyright_url', $cartsy_lite_copyright_url);
}



if ($cartsy_lite_copyrightText === "off") {
    return false;
}

$cartsy_lite_copyrightText_content = ' - All right reserved - Designed & Developed by RedQ Inc. &copy; '. date('Y') .'';

if (function_exists('cartsy_lite_global_option_data')) {
    $cartsy_lite_copyrightText_content = cartsy_lite_global_option_data('cartsy_lite_copyright_texts', $cartsy_lite_copyrightText_content);
}
?>

<div class="copyright">
    
    <?php if (!empty($cartsy_lite_copyright_url)) { ?>
        <a href="<?php echo esc_url( $cartsy_lite_copyright_url ); ?>" target="_blank" class="copyright-url">
            <?php echo esc_html( get_bloginfo('name') ); ?>
        </a>
    <?php } else { ?>
        <?php echo esc_html( get_bloginfo('name') ); ?>
    <?php }  ?>

    <?php if (!empty($cartsy_lite_copyrightText_content)) { ?>
    <?php echo wp_kses_post( $cartsy_lite_copyrightText_content ); ?>
    <?php } ?>
</div>