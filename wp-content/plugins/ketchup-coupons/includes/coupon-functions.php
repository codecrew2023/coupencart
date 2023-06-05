<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category Ketchup_Coupons
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_coupon_metaboxes' );
function cmb_coupon_metaboxes( array $meta_boxes ) {

	$prefix = '_ktc_';

	$meta_boxes['single_coupom'] = array(
		'id'         => 'single_coupon',
		'title'      => __( 'Coupon Information', 'ketchupcoupons' ),
		'pages'      => array( 'ketchup-coupon'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
            array(
                'name' => __( 'Coupon Text', 'ketchupcoupons' ),
                'desc' => __( 'This is a small description of the coupon and this will appear in the front of the coupon', 'ketchupcoupons' ),
                'id'   => $prefix . 'coupon_text',
                'type' => 'textarea',
            ),
            array(
                'name' => __( 'Coupon URL', 'ketchupcoupons' ),
                'desc' => __( 'This URL opens the page in separate window', 'ketchupcoupons' ),
                'id'   => $prefix . 'coupon_url',
                'type' => 'text_url'
            ),
            array(
                'name' => __( 'Coupon Code', 'ketchupcoupons' ),
                'desc' => __( 'Fill in the Coupon Code', 'ketchupcoupons' ),
                'id'   => $prefix . 'coupon_url',
                'type' => 'text_medium'
            )
		)
	);

	return $meta_boxes;
}
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once PLUGIN_PATH.'/includes/metaboxes/init.php';

}