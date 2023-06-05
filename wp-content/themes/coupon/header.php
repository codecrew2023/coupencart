<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title('|',true,'right'); ?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php if(of_get_option('favicon_upload')): ?>
    <link rel="icon" href="<?php if(of_get_option('favicon_upload','') != ''): echo esc_url(of_get_option('favicon_upload','')); endif; ?> " type="image/x-icon">    
    <?php endif; ?>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="container">
    <div class="row">
        <div class="col-md-4" id="kt-logo">
            <h1>
            <a href="<?php echo esc_url(home_url()); ?>"><?php echo get_bloginfo('name'); ?></a>
            </h1>
        </div><!--#kt-logo ends here-->
        <div class="col-md-8" id="kt-main-nav">
            <?php 
            $menu_args =  array('location'=>'primary',
            'menu_container'=>false,
            'menu_class'=>'main-menu',
            'menu_id'=>false);
            wp_nav_menu($menu_args);
            ?> 
        </div><!--#kt-main-nav ends here-->
    </div>
</div>
<?php if (get_header_image() != ''): ?>
<div class="kt-dotted"></div>
<div id="kt-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                 <img class="img-responsive" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />    
                </div>
            </div>
        </div>
</div>
<?php endif; ?>