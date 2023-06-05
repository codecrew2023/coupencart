<?php 
/***
*
OPTIONS -  This code works with the Options Framework Plugin
*
***/
if ( !function_exists('of_get_option')) {
function of_get_option($name, $default = false) {
    $optionsframework_settings = get_option('optionsframework');
    // Gets the unique option id
    $option_name = $optionsframework_settings['id'];
    
    if ( get_option($option_name) ) {
        $options = get_option($option_name);
    }
        
    if ( isset($options[$name]) ) {
        return $options[$name];
    } else {
        return $default;
    }
}
} 
/***
*
TGM PLUGIN ACTIVATION
*
***/
require_once('libs/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'coupon_register_recommended_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function coupon_register_recommended_plugins() {
 
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name'      => __('Options Framework','coupon'),
            'slug'      => 'options-framework',
            'required'  => false,
        ),
        array(
            'name'      => __('Ketchup Coupons','coupon'),
            'slug'      => 'ketchup-coupons',
            'required'  => false,
        )
        

    );
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'coupon' ),
            'menu_title'                      => __( 'Install Plugins', 'coupon' ),
            'installing'                      => __( 'Installing Plugin: %s', 'coupon' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'coupon' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.','coupon' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'coupon' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'coupon'), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'coupon' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'coupon' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'coupon' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'coupon' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'coupon' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'coupon' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'coupon' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'coupon' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'coupon' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'coupon' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
 
    tgmpa( $plugins, $config );
}
/***
*
THEME SETUP
*
***/
function coupon_theme_setup(){
    
        // Set $content_width
        global $content_width;
        if (!isset( $content_width ))
        $content_width = 575;
         // Load Background
        $coupon_background_args = array(
        'default-color' => 'ffffff',
        'default-image' => '',
        'wp-head-callback' => 'coupon_custom_background_cb',
        );
        add_theme_support( 'custom-background', $coupon_background_args );
        add_editor_style( 'style.css' );
        //Load Header
        $coupon_header_defaults = array(
        'default-image'          => '',
        'random-default'         => false,
        'width'                  => '1170',
        'height'                 => '450',
        'flex-height'            => false,
        'flex-width'             => false,
        'default-text-color'     => '',
        'header-text'            => false,
        'uploads'                => true,
        'wp-head-callback'       => '',
        'admin-head-callback'    => '',
        'admin-preview-callback' => '',
        );
        add_theme_support( 'custom-header', $coupon_header_defaults );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag');
        register_nav_menu( 'primary', __('Main Menu','coupon'));
        load_theme_textdomain('coupon', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'coupon_theme_setup');
function coupon_custom_background_cb() {
  $background = set_url_scheme( get_background_image() );
  $color = get_theme_mod( 'background_color', get_theme_support( 'custom-background', 'default-color' ) );

  if ( ! $background && ! $color )
    return;

  $style = $color ? "background-color: #$color;" : '';

  if ( $background ) {
    $image = " background-image: url('$background');";

    $repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
    if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
      $repeat = 'repeat';
    $repeat = " background-repeat: $repeat;";

    $position = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
    if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
      $position = 'left';
    $position = " background-position: top $position;";

    $attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );
    if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
      $attachment = 'scroll';
    $attachment = " background-attachment: $attachment;";

    $style .= $image . $repeat . $position . $attachment;
  }
?>
<style type="text/css" id="custom-background-css">
body.custom-background { <?php echo trim( $style ); ?> }
</style>
<?php
}
/***
*
LOAD CSS AND JS STYLES
*
***/
    function coupon_load_scripts() {
                                                                                                             
        wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.min.js',array('jquery'),'',true);
        wp_enqueue_script('slicknav',get_template_directory_uri().'/js/jquery.slicknav.min.js',array('jquery'),'',true);
        wp_enqueue_script('init',get_template_directory_uri().'/js/init.js',array('jquery'),'',true);
        
        wp_localize_script('init', 'init_vars', array(
            'label' => __('Menu', 'coupon')
        ));

    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );
    }
    add_action('wp_enqueue_scripts', 'coupon_load_scripts');
   
   
    function coupon_load_styles()
    { 
        wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri().'/css/bootstrap-theme.min.css','','','all' );
        wp_enqueue_style( 'bootstrap', get_template_directory_uri(). '/css/bootstrap.min.css','','','all' );
        wp_enqueue_style( 'slicknav',get_template_directory_uri().'/css/slicknav.css','','','all');
        wp_enqueue_style( 'elegant-font',get_template_directory_uri().'/fonts/elegant_font/HTML_CSS/style.css','','','all');
        wp_enqueue_style( 'style', get_stylesheet_uri(),'','','all' );
    }    
    add_action('wp_enqueue_scripts', 'coupon_load_styles');
   
    function coupon_add_ie_html5_shim () {
        echo '<!--[if lt IE 9]>';
        echo '<script src="'.get_template_directory_uri().'/js/html5shiv.js"></script>';
        echo '<![endif]-->';
    }
    add_action('wp_head', 'coupon_add_ie_html5_shim');
/***
*
SIDEBARS INITIALIZATION
*
***/
function coupon_widgets_init() {
    
    register_sidebar(array(
        'name' => __('Sidebar', 'coupon' ),
        'id'   => 'sidebar',
        'description' => __('This is the widgetized sidebar.', 'coupon' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('Footer Sidebar 1', 'coupon' ),
        'id'   => 'footer-sidebar-1',
        'description' => __('This is the widgetized sidebar.', 'coupon' ),
        'before_widget' => '<div id="%1$s" class="footerwidget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('Footer Sidebar 2', 'coupon' ),
        'id'   => 'footer-sidebar-2',
        'description' => __('This is the widgetized sidebar.', 'coupon' ),
        'before_widget' => '<div id="%1$s" class="footerwidget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
    }
add_action( 'widgets_init', 'coupon_widgets_init' );
/***
*
THEME FUNCTIONS
*
***/
function coupon_wp_title($title,$sep){

    global $page, $paged;
    $title .= get_bloginfo( 'name' );
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";

    if ( $paged >= 2 || $page >= 2 )
        
        $title = "$title $sep " . sprintf( __( 'Page %s', 'coupon' ), max( $paged, $page ) );
        
        return $title;
}
add_filter( 'wp_title', 'coupon_wp_title', 10, 2 );    
function coupon_excerpt_length( $length ) {
    return 50;
}
add_filter( 'excerpt_length', 'coupon_excerpt_length', 999 );
function coupon_archive_title(){
    $html = '';
    if(is_category()):
        $html = single_cat_title();
    elseif(is_search()):
        $html = __('Search Results','coupon');
    elseif(is_day() || is_month() || is_year()):
        $html = __('Archives >> ','coupon').get_the_time(get_option('date_format'));
    endif;
    
    return $html;
}