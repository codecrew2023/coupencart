<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
    
    return $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	$options = array();

	$options[] = array(
		'name' => __('Basic Options', 'coupon'),
		'type' => 'heading');
        
    $options[] = array(
        'name' => __('Premium Features', 'coupon'),
        'desc' => '<ul>
        
        <li>'.__('Upload Logo','coupon').'</li>
        <li>'.__('Slider - Enable-disable and custom text + URL','coupon').'</li>
        <li>'.__('Google Fonts','coupon').'</li>
        <li>'.__('Color Pickers','coupon').'</li>
        <li>'.__('Advanced Coupon Options','coupon').'</li>
        <li>'.__('1-4 Widgetized Areas in Footer','coupon').'</li>
        </ul>'.
        '<p>
        <a rel="nofollow" href="'.esc_url( __( 'http://www.ketchupthemes.com/coupon/', 'coupon')).'" style="background:red; padding:10px 20px; color:#ffffff; margin-top:10px; text-decoration:none;">Update to Premium</a></p>',
        'type' => 'info');

	$options[] = array(
		'name' => __('Favicon Upload', 'coupon'),
		'desc' => __('Upload Your Favicon icon here. Please upload a 16x16 icon.', 'coupon'),
		'id' => 'favicon_upload',
		'type' => 'upload');
        
    $options[] = array(
        'name' => __('Footer Sidebars', 'coupon'),
        'desc' => __('Select Footer Sidebars Number.', 'coupon'),
        'id' => 'footer_sidebars_number',
        'std' => '1',
        'type' => 'radio',
        'options' => array('1'=>__('1','coupon'),
                           '2'=>__('2','coupon')
                           ));
	return $options;
}