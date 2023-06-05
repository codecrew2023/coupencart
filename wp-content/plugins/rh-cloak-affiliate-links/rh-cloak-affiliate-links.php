<?php
/**
Plugin Name: RH Link Pro
Plugin URI: https://1.envato.market/rh-links
Description: Utility for Rehub Post Offer external & affiliate links. 
Author: Wpsoul
Author URI: https://wpsoul.com/
License: GPL v3
Requires at least: 5.0.0
Tested up to: 5.8
Text Domain: wpsmcal
Domain Path: /lang
Version: 1.4.5
*/

if ( !defined( 'WPINC' ) ) die;

/**
 * Define constants.
 */
if( !defined( 'WPSMCAL_THEME' ) ){
	if( 'rehub' == get_option( 'template') || 'rehub-theme' == get_option( 'template' ) ){
		define( 'WPSMCAL_THEME', true );
	} else {
		define( 'WPSMCAL_THEME', false );
	}
}

if( !defined( 'WPSMCAL_BASENAME' ) ){ define( 'WPSMCAL_BASENAME', plugin_basename( __FILE__ ) ); }
if( !defined( 'WPSMCAL_DIRPATH' ) ){ define( 'WPSMCAL_DIRPATH', dirname( __FILE__ ) ); }
if( !defined( 'WPSMCAL_URIPATH' ) ){ define( 'WPSMCAL_URIPATH', plugin_dir_url( __FILE__ ) ); }

/*  */
require_once WPSMCAL_DIRPATH .'/includes/class-update-checker.php';
require_once WPSMCAL_DIRPATH .'/includes/class-wpsmcal.php';

/*  */
function wpsmcal_is_plugin_active( $plugin ) {
    return in_array( $plugin, (array) get_option( 'active_plugins', array() ) ) || wpsmcal_is_plugin_active_for_network( $plugin );
}

/*  */
function wpsmcal_is_plugin_active_for_network( $plugin ) {
    if ( !is_multisite() )
        return false;
    $plugins = get_site_option( 'active_sitewide_plugins');
    if ( isset($plugins[$plugin]) )
        return true;
    return false;
}

/*  */
//if( WPSMCAL_THEME ) {
	//$wpsmcal = new Wpsmcal( '1.4.4' );
//} else {
	//add_action( 'admin_notices', 'wpsmcal_admin_notice_warning' );
//}

$wpsmcal = new Wpsmcal( '1.4.5' );

/*  */
function wpsmcal_admin_notice_warning() {
	?>
	<div class="notice notice-warning">
		<p><?php printf( __( 'Sorry, but RH Link plugin works only with %s theme.', 'wpsmcal' ), '<a href="https://1.envato.market/rh-links" target="_blank">REHub</a>' ) ; ?></p>
	</div>
	<?php
}

/* update Class */
if(!class_exists('PucFactory')){
	require WPSMCAL_DIRPATH .'/includes/class-update-checker.php';
}

/* Update plugin */
function rh_update_check_rhlink(){

	if(defined('PLUGIN_REPO')){
		$serverupdateurl = PLUGIN_REPO;
	} else{
		$serverupdateurl = 'https://wpsoul.net/serverupdate/';
	}
	
	$tf = 'tfuser=';
	$rehub_options = get_option( 'Rehub_Key' );
	$tf_username = isset( $rehub_options[ 'tf_username' ] ) ? $rehub_options[ 'tf_username' ] : '';
	
	if($tf_username) {
		$tf = 'tfuser='.$tf_username;
	}

	$wpsmcal_checker = PucFactory::buildUpdateChecker(
		$serverupdateurl.'?action=get_metadata&slug=rh-cloak-affiliate-links&'.$tf,
		__FILE__,
		'rh-cloak-affiliate-links',
		'24'
	);
}
add_action('admin_init', 'rh_update_check_rhlink');
