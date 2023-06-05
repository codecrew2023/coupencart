<?php
/* This file is part of Shop Here child theme.
 * Note: this function loads the parent stylesheet before, then child theme stylesheet, leave it in place unless you know what you are doing.
 */

/*
 * default settings 
 */
if( !function_exists('ecommerce_star_settings') ){

		function ecommerce_star_settings(){
			return array(
		
			'header_myaccount_link' => esc_url(home_url().'/my-account'),
			'header_myaccount_text' => esc_html__('My Account', 'shop-here'),
			'header_woocommerce' => 1,
			
			'logo_width' => 90,
			
			'breadcrumb_bg_color' => '#1e1d1d70',
			'breadcrumb_image' => '',
			'breadcrumb_heigh' => 350,
			'increase_header_menu_width' => false,
			'header_show_title_tag' => true,
			'header_woocommerce_ajax_search' => false,			
			'woocommerce_category_menu' => false,
			'header_style' => 'yes',
			
			'footer_foreground_color' => '#fff',
			'header_top_color' => '#141414',
			
			'slider_max_items' => 3,
			'slider_cat' => '',
			'slider_animation_type' => 'slide',
			'slider_speed' => 3000,
			'slider_button_text' => esc_html__('More Details', 'shop-here'),
			'slider_button_link' => '',
			'slider_in_home_page' => false,
			'slider_image_height' => 500,			
			
			'top_widgets' => 'col-sm-12',
			
			'colorscheme_color' => '#0d42e1',
			
			'navigation_font_size' => '15',
			'header_fontfamily' => 'Oswald',
			'body_fontfamily' => 'Poppins',
			
			'mini_header_color' => '#f7f7f7',
			'menu_bar_color' => 'rgba(255, 96, 0, 0.92)',
			'menu_text_color' => '#fff',
			'mini_header_style' => 'top-1',
			'mini_header_border' => 0,
			'enable_breadcrumb' => 0,
			
			'button_radius' => 3,
			'social_button_radius' => 24,
			'search_button_radius' => 24,
			'scroll_button_radius' => 4,
			
			'body_container_width' => 1200,
			'header_container_width' => 1200,
		
			'blog_sidebar_position' => 'right',
			
			'layout_section_post_one_column' => 0 ,	
			'box_layout' => 0,
			'woo_sidebar_position' => 'left',
							
			'social_facebook_link' => '',
			'social_twitter_link' => '',
			'social_skype_link' => '',
			'social_pinterest_link' => '',
			'social_instagram_link' => '',
			'social_linkdin_link' => '',
			'social_youtube_link' => '',
			'social_open_new_tab' => 1,
			
			'woocommerce_header_cart_hide' => 0,					
			'woocommerce_no_breadcrumb' => 0,
			
			'contact_section_hide_header' => 0,
			'contact_section_address' => '',
			'contact_section_email' => '',
			'contact_section_fax' => '',
			'contact_section_phone' => '',
			'contact_section_hours' => '',
			'contact_section_map' => '',
					
			'footer_section_background_color' => '#082253',
			'footer_section_widget_layout' => 'primary',
			'footer_bottom_layout' => 'one-column',
			'footer_section_image' => '',
			'footer_section_image_repeat' => 'no-repeat',		
            'footer_section_bottom_text' => '',
				
			);
		}
}


//sub menu
require_once  get_stylesheet_directory().'/inc/admin-page.php';

/*
 * get_parent theme settings and override with child theme settings
 */
$shop_here_option = wp_parse_args(  get_option( 'ecommerce_star_option', array() ) , ecommerce_star_settings());

add_action( 'wp_enqueue_scripts', 'shop_here_styles' );

function shop_here_styles() {
	//enqueue parent styles
	wp_enqueue_style( 'shop-here-parent-styles', get_template_directory_uri().'/style.css' );
} 

/* 
 * allowed html tags 
 */
$shop_here_allowed_html = array(
		'a'          => array(
			'href'  => true,
			'title' => true,
			'class'  => true,			
		),
		'option'          => array(
			'selected'  => true,
			'value' => true,
			'class'  => true,			
		),		
		'p'          => array(
			'class'  => true,
		),		
		'abbr'       => array(
			'title' => true,
		),
		'acronym'    => array(
			'title' => true,
		),
		'b'          => array(),
		'blockquote' => array(
			'cite' => true,
		),
		'cite'       => array(),
		'code'       => array(),
		'del'        => array(
			'datetime' => true,
		),
		'em'         => array(),
		'i'          => array(),
		'q'          => array(
			'cite' => true,
		),
		's'          => array(),
		'strike'     => array(),
		'strong'     => array(),
	);

/* 
 * wp body open 
 */
function shop_here_body_open(){
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
}

add_action('shop_here_wp_body_open', 'shop_here_body_open');


/*
 * override parent theme custom css
 */
function ecommerce_star_custom_css(){
	require_once  get_stylesheet_directory().'/inc/custom-styles.php';
}

ecommerce_star_custom_css();

/*
 * header_background 
 */

add_action( 'customize_register', 'shop_here_customizer_settings' );

/*
 * load customizer control 
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	// Inlcude the Alpha Color Picker control file.
	require_once get_template_directory().'/inc/color-picker/alpha-color-picker.php';
}

function shop_here_customizer_settings( $wp_customize ) {

	//widgets section	
	$wp_customize->add_section( 'home_widgets' , array(
		'title'      => __( 'Home Header Widgets', 'shop-here' ),
		'priority'   => 1,
		'panel' => 'theme_options',
	) );	
	
	//top banner
	$wp_customize->add_setting('ecommerce_star_option[top_widgets]' , array(
		'default'    => 'col-sm-12',
		'sanitize_callback' => 'ecommerce_star_sanitize_select',
		'type'=>'option',

	));

	$wp_customize->add_control('ecommerce_star_option[top_widgets]' , array(
		'label' => __('Select Number of Widgets', 'shop-here' ),
		'section' => 'home_widgets',
		'type'=>'select',
		'choices'=>array(
			'col-sm-12'=> __('1 Widgets', 'shop-here' ),
			'col-sm-6'=> __('2 Widgets', 'shop-here' ),
			'col-sm-4'=> __('3 Widgets', 'shop-here' ),
			'col-sm-3'=> __('4 Widgets', 'shop-here' ),
			'col-sm-2'=> __('6 Widgets', 'shop-here' ),
		),
	) );


}



 
//add child theme widget area

function shop_here_widgets_init(){

	/* header sidebar */
	global $shop_here_option;

	register_sidebar(
		array(
			'name'          => __( 'Home Header Widgets', 'shop-here' ),
			'id'            => 'header-banner',
			'description'   => __( 'Add widgets to appear in Header.', 'shop-here' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s '.$shop_here_option['top_widgets'].' text-center">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'shop_here_widgets_init' );

 
/**
 * Return rgb value of a $hex - hexadecimal color value with given $a - alpha value
 * Ex:- ecommerce_star_rgba('#11ffee',15) // return rgba(17,255,238,15)
**/
 
function shop_here_rgba($hex,$a){
 
	$r = hexdec(substr($hex,1,2));
	$g = hexdec(substr($hex,3,2));
	$b = hexdec(substr($hex,5,2));
	$result = 'rgba('.$r.','.$g.','.$b.','.$a.')';
	
	return $result;
}


// Register and load the widget
function shop_here_latest_posts_widget() {
	register_widget( 'shop_here_latest_posts_widget' );
}
add_action( 'widgets_init', 'shop_here_latest_posts_widget' );

// Creating the widget 
class shop_here_latest_posts_widget extends WP_Widget {

	function __construct() {
	parent::__construct(
	
	// Base ID of your widget
	'shop_here_latest_posts_widget', 
	
	// Widget name will appear in UI
	esc_html__('Advanced Recent Posts', 'shop-here'), 
	
	// Widget description
	array( 'description' => esc_html__( 'Display latest posts with the featured image', 'shop-here' ), ) 
	);
}

// Creating widget front-end

public function widget( $args, $instance ) {
	$title = ( ! empty( $instance['title'] ) ) ? strip_tags( apply_filters( 'widget_title', $instance['title'] ) ) : esc_html__( 'Recent Posts', 'shop-here' );
	$max_items = ( ! empty( $instance['max_items'] ) ) ? strip_tags( $instance['max_items'] ) : '5';
	
	// before and after widget arguments are defined by themes
	echo $args['before_widget'];
	if ($title)
	echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $args['after_title'];
	
	// This run the code and display the output
	shop_here_get_latest_posts($max_items);	
	//
	echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
	$title = ( ! empty( $instance['title'] ) ) ? strip_tags( apply_filters( 'widget_title', $instance['title'] ) ) : esc_html__( 'Recent Posts', 'shop-here' );
	$max_items = ( ! empty( $instance['max_items'] ) ) ? strip_tags( $instance['max_items'] ) : '5';
	// Widget admin form
?>

	<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:','shop-here' ); ?></label> 
	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'max_items' )); ?>"><?php esc_html_e( 'Number of posts to Show:','shop-here'  ); ?></label> 
	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'max_items' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'max_items' )); ?>" type="number" value="<?php echo absint( $max_items ); ?>" />
	</p>

<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : esc_html_e( 'Advanced Recent Posts','shop-here' );
	$instance['max_items'] = ( ! empty( $new_instance['max_items'] ) ) ? absint( $new_instance['max_items'] ) : '5';
	return $instance;
 }
} // Class latest_posts_list_widget ends here


function shop_here_get_latest_posts($max){
 
	echo '<ul class="adv-recent-posts">';
		
		$args = array( 'post_type' => 'post', 'ignore_sticky_posts' => 1 ,  'posts_per_page' =>  absint($max), 'numberposts' => absint($max) , 'orderby' => 'date', 'order' => 'DESC');		 
		$latest_posts_query = new WP_Query($args);
        
		while ($latest_posts_query->have_posts()) : $latest_posts_query->the_post();
		$i=1;
			 
				?>
				<li>
					<table border="0">
					  <tr>
						<td rowspan="2"><a href="<?php echo esc_url(get_the_permalink()); ?>">						
						<?php 
							if ( has_post_thumbnail() ) {
							   the_post_thumbnail();
							}
						 ?>
						 </a></td>
						<td><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html(get_the_title()) ;?></a></td>
					  </tr>
					  <tr class="no-border">
					     <td class="entry-meta"><?php echo esc_html(get_the_date( 'Y-M-d' )); echo ' &iota; '.esc_html(get_the_author()); ?></td>
					  </tr>
					</table> 
				</li>				     
				<?php				
			 
		$i++;
		endwhile;
		wp_reset_postdata();		
	echo '</ul>';

}


