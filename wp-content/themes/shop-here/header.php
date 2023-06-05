<?php
/**
 * The header
 * @package shop-here
 * @since 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php 
	wp_head();
	/* 
	 * get default settings 
	 */ 
	global $shop_here_option;	
	if ( class_exists( 'WP_Customize_Control' ) ) {
	   $shop_here_option = wp_parse_args(  get_option( 'ecommerce_star_option', array() ) , ecommerce_star_settings());  
	}

?>
</head>
<body <?php body_class(); ?>>
<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else { 
		do_action( 'wp_body_open' ); 
	}
$shop_here_option['header_style'] = ecommerce_star_header_class();
	
if(is_front_page()  ) { 
	get_template_part( 'templates/widget', 'section' ); 
}
?>
<!-- The Search Modal Dialog -->
<div id="myModal" class="modal" aria-hidden="true" tabindex="-1" role="dialog">
  <!-- Modal content -->
  <div class="modal-content"> <span id="search-close" class="close" tabindex="0">&times;</span> 
  <br/><br/>
    <?php get_search_form(); ?>
    <br/>
  </div>
</div>
<!-- end search model-->
<div id="page" class="site">
<?php 
	if($shop_here_option['box_layout']){
		echo '<div class="wrap-box">';
	}
?>
<a class="skip-link screen-reader-text" href="#primary" ><?php esc_html_e( 'Skip to content', 'shop-here' ); ?></a>
<header id="masthead" class="<?php echo esc_attr(ecommerce_star_header_class()); ?> site-header" role="banner" >
	
	<?php get_template_part( 'template-parts/header/header', $shop_here_option['mini_header_style'] );	?>

	<div class="container">
		<?php
		if($shop_here_option['header_woocommerce'] && class_exists( 'WooCommerce' )){
			ecommerce_star_woocommerce_header();
		} else {
			ecommerce_star_default_header(); 
		}
		?>
	</div><!-- .container -->
	
		<!--display menu bar full row when header options, woocommerce layout with search--> 
		<?php 
		// display full width menu below woocommerce search
		if($shop_here_option['header_woocommerce'] && class_exists( 'WooCommerce' )){
			ecommerce_star_woocommerce_menu();
		}
		
		//display slider
		if((is_front_page() || is_home()) && $shop_here_option['slider_in_home_page'] ){
			get_template_part( 'template-parts/slider', 'section' );	
		}
				
		// breadcrumb not displayed with transparent header
		if ($shop_here_option['enable_breadcrumb'] ) {
			get_template_part( 'template-parts/header/breadcrumb'); 
		}
?>
</header><!-- #masthead -->