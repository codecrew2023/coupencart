<?php

/**
 * Plugin Name: ImportWP - WooCommerce Importer Addon
 * Plugin URI: https://www.importwp.com
 * Description: Allow ImportWP to import WooCommerce Products.
 * Author: James Collings <james@jclabs.co.uk>
 * Version: 2.0.4 
 * Author URI: https://www.importwp.com
 * Network: True
 */

add_action('admin_init', 'iwp_woocommerce_check');

function iwp_woocommerce_requirements_met()
{
    return false === (is_admin() && current_user_can('activate_plugins') &&  (!class_exists('WooCommerce') || (!function_exists('import_wp_pro') && !function_exists('import_wp')) || version_compare(IWP_VERSION, '2.0.21', '<')));
}

function iwp_woocommerce_check()
{
    if (!iwp_woocommerce_requirements_met()) {

        add_action('admin_notices', 'iwp_woocommerce_notice');

        deactivate_plugins(plugin_basename(__FILE__));

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }
    }
}

function iwp_woocommerce_setup()
{
    if (!iwp_woocommerce_requirements_met()) {
        return;
    }

    $base_path = dirname(__FILE__);

    require_once $base_path . '/class/autoload.php';
}
add_action('plugins_loaded', 'iwp_woocommerce_setup', 9);

function iwp_woocommerce_notice()
{
    echo '<div class="error">';
    echo '<p><strong>ImportWP - WooCommerce Importer Addon</strong> requires that you have <strong>ImportWP v2.0.21 or newer</strong>, and <strong>WooCommerce</strong> installed.</p>';
    echo '</div>';
}

if(!class_exists('PucFactory')){
    require dirname(__FILE__) .'/class-update-checker.php';
}

//Updater
$wpfepp_checker = PucFactory::buildUpdateChecker(
    'https://wpsoul.net/plugins?action=get_metadata&slug=importwp-woocommerce',
    __FILE__,
    'importwp-woocommerce',
    '24'
);
