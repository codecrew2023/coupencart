<?php
/*
Plugin Name: Ketchup Coupons
Description: This plugin enables a very simple coupon post type.
Version: 0.1
Author: Alex Itsios
Author URI: http://ketchupthemes.com
*/
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );
DEFINE ('PLUGIN_PATH',plugin_dir_path( __FILE__ ));
/**
*
* CMB Metaboxes Initialization
*
*/
require_once PLUGIN_PATH.'/includes/coupon-functions.php';
/**
* 
* COUPONS POST TYPES AND TAXONOMIES
* 
*/   
function create_ketchup_coupon_post_type() {

    $labels = array(
        'name'                => _x( 'Coupons', 'Post Type General Name', 'ketchupcoupons' ),
        'singular_name'       => _x( 'Coupon', 'Post Type Singular Name', 'ketchupcoupons' ),
        'menu_name'           => __( 'Coupons', 'ketchupcoupons' ),
        'parent_item_colon'   => __( 'Parent Coupon:', 'ketchupcoupons' ),
        'all_items'           => __( 'All Coupons', 'ketchupcoupons' ),
        'view_item'           => __( 'View Coupons', 'ketchupcoupons' ),
        'add_new_item'        => __( 'Add New Coupon', 'ketchupcoupons' ),
        'add_new'             => __( 'Add New', 'ketchupcoupons' ),
        'edit_item'           => __( 'Edit Coupon', 'ketchupcoupons' ),
        'update_item'         => __( 'Update Coupons', 'ketchupcoupons' ),
        'search_items'        => __( 'Search Coupon', 'ketchupcoupons' ),
        'not_found'           => __( 'Not found', 'ketchupcoupons' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'ketchupcoupons' ),
    );
    $args = array(
        'label'               => __( 'ketchup-coupon', 'ketchupcoupons' ),
        'description'         => __( 'Simple Coupon Post Type', 'ketchupcoupons' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'thumbnail', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'ketchup-coupon', $args );

}
function create_ketchup_coupon_category() {

    $labels = array(
        'name'                       => _x( 'Coupon Categories', 'Taxonomy General Name', 'ketchupcoupons' ),
        'singular_name'              => _x( 'Coupon Category', 'Taxonomy Singular Name', 'ketchupcoupons' ),
        'menu_name'                  => __( 'Coupon Categories', 'ketchupcoupons' ),
        'all_items'                  => __( 'All Coupon Categories', 'ketchupcoupons' ),
        'parent_item'                => __( 'Parent Coupon Categories', 'ketchupcoupons' ),
        'parent_item_colon'          => __( 'Parent Coupon Category:', 'ketchupcoupons' ),
        'new_item_name'              => __( 'New Coupon Category', 'ketchupcoupons' ),
        'add_new_item'               => __( 'Add New Coupon Category', 'ketchupcoupons' ),
        'edit_item'                  => __( 'Edit Coupon Category', 'ketchupcoupons' ),
        'update_item'                => __( 'Update Coupon Category', 'ketchupcoupons' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'ketchupcoupons' ),
        'search_items'               => __( 'Search Coupon Categories', 'ketchupcoupons' ),
        'add_or_remove_items'        => __( 'Add or remove Coupon Categories', 'ketchupcoupons' ),
        'choose_from_most_used'      => __( 'Choose from the most used items', 'ketchupcoupons' ),
        'not_found'                  => __( 'Not Found', 'ketchupcoupons' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'ketchup-coupon-category', array( 'ketchup-coupon' ), $args );

}
function create_ketchup_coupon_tag() {

    $labels = array(
        'name'                       => _x( 'Coupon Tags', 'Taxonomy General Name', 'ketchupcoupons' ),
        'singular_name'              => _x( 'Coupon  Tag', 'Taxonomy Singular Name', 'ketchupcoupons' ),
        'menu_name'                  => __( 'Coupon Tags', 'ketchupcoupons' ),
        'all_items'                  => __( 'All Coupon Tags', 'ketchupcoupons' ),
        'parent_item'                => __( 'Parent Coupon Tags', 'ketchupcoupons' ),
        'parent_item_colon'          => __( 'Parent Coupon Tags:', 'ketchupcoupons' ),
        'new_item_name'              => __( 'New Coupon Tag', 'ketchupcoupons' ),
        'add_new_item'               => __( 'Add New Coupon Tag', 'ketchupcoupons' ),
        'edit_item'                  => __( 'Edit Coupon Tag', 'ketchupcoupons' ),
        'update_item'                => __( 'Update Coupon Tag', 'ketchupcoupons' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'ketchupcoupons' ),
        'search_items'               => __( 'Search Coupon Tags', 'ketchupcoupons' ),
        'add_or_remove_items'        => __( 'Add or remove Coupon Tags', 'ketchupcoupons' ),
        'choose_from_most_used'      => __( 'Choose from the most used items', 'ketchupcoupons' ),
        'not_found'                  => __( 'Not Found', 'ketchupcoupons' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'ketchup-coupon-tag', array( 'ketchup-coupon' ), $args );

}
add_action( 'init', 'create_ketchup_coupon_post_type', 0 );
add_action( 'init', 'create_ketchup_coupon_category', 0 );
add_action( 'init', 'create_ketchup_coupon_tag', 0 );