<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_filter_gallery_wrap extends WPBakeryShortCodesContainer {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'columns'			=>		'4',
			'columnstab'		=>		'3',
			'columnsmbl'		=>		'2',
			'img_height'		=>		'',
			'caption_bg'		=>		'rgba(29,161,245,0.7)',
			'layout'			=>		'overlay',
			'hover_effect'		=>		'ih_item_fade_effect',
			'classname'			=>		'',
			'shuffle_checked'	=>		'',
			'search_checked'	=>		'',
			'txt_transform'		=>		'uppercase',
			'all_label'			=>		'All',
			'filter_cat'		=>		'',
			'link_icon'			=>		'fas fa-link',
			'popup_icon'		=>		'fas fa-search-plus',
			'categ_rlpadding'	=>		'25',
			'categ_tbpadding'	=>		'8',
			'categ_rlmargin'	=>		'5',
			'categ_radius'		=>		'',
			'categ_textsize'	=>		'17',
			'categ_bmargin'		=>		'',
			'categ_borderwidth'	=>		'0',
			'categ_borderstyle'	=>		'solid',
			'categ_borderclr'	=>		'',
			'categ_textclr'		=>		'',
			'categ_textbg'		=>		'',
			'categ_activeclr'	=>		'',
			'categ_activebg'	=>		'',
		), $atts ) );
		$randomPort_id = rand(5, 500);
		$GLOBALS['maw_filtergal_effect'] = $hover_effect; $GLOBALS['maw_filtergal_linkicon'] = $link_icon;
		$GLOBALS['maw_filtergal_popupicon'] = $popup_icon; $GLOBALS['maw_filtergal_imgheight'] = $img_height;
		$GLOBALS['maw_filtergal_Gid'] = $randomPort_id;
		$content = wpb_js_remove_wpautop($content, true);
		wp_enqueue_style( 'filterizr-css', plugins_url( '../css/filterizr.css' , __FILE__ ));
		wp_enqueue_script( 'filterizr-min-js', plugins_url( '../js/filterizr.min.js' , __FILE__ ), array('jquery'));
		wp_enqueue_script( 'custom-filterizr-js', plugins_url( '../js/filterizr.js' , __FILE__ ));
		wp_enqueue_script( 'custom-fslightbox-js', plugins_url( '../js/fslightbox.js' , __FILE__ ));
		ob_start(); ?>
		<div class="maw_portfolioGallery_container">
			<div class="filtrContainer">
				<div class="FilterGalleryUL_<?php echo esc_attr($randomPort_id); ?> <?php echo esc_attr($classname); ?>">
		            <ul class="maw_simplefilters_ul">
						<?php if ($all_label != "") { ?>
		            		<li class="color-controls-0 fltr-controls<?php echo esc_attr($randomPort_id); ?> active" data-filter="all">
		            			<?php echo esc_attr($all_label) ?>
		            		</li>
		            	<?php } ?>
		            	<?php
							if ($filter_cat != "") {
								$filterCategory = array_map('trim', explode(',', $filter_cat));
								foreach ($filterCategory as $categ) {
									$categremovespace = str_replace(' ', '', esc_attr($categ)); ?>
									<li class="color-controls-0 fltr-controls<?php echo esc_attr($randomPort_id); ?>" data-filter="maw-fg-<?php echo esc_attr($categremovespace) ?>"
										style="">
										<?php echo esc_attr($categ) ?>
									</li>
								<?php }
							} 
						?>
						<?php if ($shuffle_checked != "") { ?>
							<li class="color-controls-0 fltr-controls<?php echo esc_attr($randomPort_id); ?>" data-shuffle>
								Shuffle
							</li>
						<?php } ?>
						<!-- <li class="fltr-controls" data-sortAsc> Ascending </li> -->
						<!-- <li class="fltr-controls" data-sortDesc> Descending </li> -->
						<!-- <?php if ($search_checked != "") { ?>
							<input type="text" class="fltr-controls filtr-search" name="filtr-search" placeholder="Search..." data-search="">
						<?php } ?> -->
					</ul>
			       

					
					
					<div class="maw_portfolioGallery_wrapper color-container-0 filter-container">
						<?php echo wp_kses_post($content); ?>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		    const simpleFilters<?php echo esc_attr($randomPort_id); ?> = document.querySelectorAll('.FilterGalleryUL_<?php echo esc_attr($randomPort_id); ?> .maw_simplefilters_ul li');
		    Array.from(simpleFilters<?php echo esc_attr($randomPort_id); ?>).forEach((node) =>
		      node.addEventListener('click', function() {
		        simpleFilters<?php echo esc_attr($randomPort_id); ?>.forEach((filter) => filter.classList.remove('active'));
		        node.classList.add('active');
		      })
		    );
		</script>
		<style>
			.FilterGalleryUL_<?php echo esc_attr($randomPort_id); ?> .color-controls-0 {
				padding: <?php echo esc_attr($categ_tbpadding) ?>px <?php echo esc_attr($categ_rlpadding) ?>px;
				margin: 0 <?php echo esc_attr($categ_rlmargin) ?>px;
				font-size: <?php echo esc_attr($categ_textsize) ?>px; color: <?php echo esc_attr($categ_textclr) ?>;
				background: <?php echo esc_attr($categ_textbg) ?>; 
    			border: <?php echo esc_attr($categ_borderwidth) ?>px <?php echo esc_attr($categ_borderstyle) ?> <?php echo esc_attr($categ_borderclr) ?>;
    			border-radius: <?php echo esc_attr($categ_radius) ?>px; 
    			text-transform: <?php echo esc_attr($txt_transform) ?>;
			}
			.FilterGalleryUL_<?php echo esc_attr($randomPort_id); ?> .color-controls-0.active {
			    color: <?php echo esc_attr($categ_activeclr); ?> !important;
			    background: <?php echo esc_attr($categ_activebg); ?> !important;
			}
			.FilterGalleryUL_<?php echo esc_attr($randomPort_id); ?> .maw_simplefilters_ul input {
				padding: <?php echo esc_attr($categ_tbpadding) ?>px <?php echo esc_attr($categ_rlpadding) ?>px;
				border-radius: <?php echo esc_attr($categ_radius) ?>px;
				min-height: auto;
			}
			.maw_portfolioGallery_wrapper .mix-<?php echo esc_attr($randomPort_id) ?> {
				width: calc(100%/<?php echo esc_attr($columns); ?> - (((<?php echo esc_attr($columns); ?> - 1) * 1rem) / <?php echo esc_attr($columns); ?>)) !important;
			}
			@media screen and (max-width: 961px) {
			    .maw_portfolioGallery_wrapper .mix-<?php echo esc_attr($randomPort_id) ?> {
			        width: calc(100%/<?php echo esc_attr($columnstab); ?> - (((<?php echo esc_attr($columnstab); ?> - 1) * 1rem) / <?php echo esc_attr($columnstab); ?>)) !important;
			    }
			}
			@media screen and (max-width: 480px) {
			    .maw_portfolioGallery_wrapper .mix-<?php echo esc_attr($randomPort_id) ?> {
			        width: calc(100%/<?php echo esc_attr($columnsmbl); ?> - (((<?php echo esc_attr($columnsmbl); ?> - 1) * 1rem) / <?php echo esc_attr($columnsmbl); ?>)) !important;
			    }
			}
			.maw_portfolioGallery_wrapper .mix-<?php echo esc_attr($randomPort_id) ?> .info {
				background-color: <?php echo esc_attr($caption_bg); ?>;
			}
		</style>
		


		<?php return ob_get_clean();
	}
}


vc_map( array(
	"base" 			=> "filter_gallery_wrap",
	"name" 			=> __( 'Filterable Gallery', 'megaaddons' ),
	"as_parent" 	=> array('only' => 'filter_gallery_son'),
	"content_element" => true,
	"js_view" 		=> 'VcColumnView',
	"category" 		=> __('Mega Addons'),
	"description" 	=> __('Display images with separate categories', 'megaaddons'),
	"icon" => plugin_dir_url( __FILE__ ).'../icons/filtergallery.png',
	'params' => array(
		array(
			"type" 			=> "vc_links",
			"param_name" 	=> "caption_urls",
			"class"			=>	"ult_param_heading",
			"description" 	=> __( '<span style="Background: #ddd;padding: 10px; display: block; color: #302f2f;font-weight:600;">Number of Items Display In Row <a target="_blank" href="https://addons.topdigitaltrends.net/filterable-gallery">Demo</a></span>', 'megaaddons' ),
			"group" 		=> 'General',
		),
		array(
            "type" 			=> 	"vc_number",
			"heading" 		=> 	__( 'Columns [For PC]', 'megaaddons' ),
			"param_name" 	=> 	"columns",
			"edit_field_class" => "vc_col-sm-4 wdo_items_to_show wdo_margin_bottom",
			"value" 		=> 	"4",
			"group" 		=> 	'General',
        ),

        array(
            "type" 			=> 	"vc_number",
			"heading" 		=> 	__( 'Columns [For Tab]', 'megaaddons' ),
			"param_name" 	=> 	"columnstab",
			"edit_field_class" => "vc_col-sm-4 wdo_items_to_show wdo_margin_bottom",
			"value" 		=> 	"3",
			"group" 		=> 	'General',
        ),

        array(
            "type" 			=> 	"vc_number",
			"heading" 		=> 	__( 'Columns [Mobile]', 'megaaddons' ),
			"param_name" 	=> 	"columnsmbl",
			"edit_field_class" => "vc_col-sm-4 wdo_items_to_show wdo_margin_bottom",
			"value" 		=> 	"2",
			"group" 		=> 	'General',
        ),

		// array(
		// 	"type" 			=> 	"dropdown",
		// 	"heading" 		=> 	__( 'Grid Style', 'megaaddons' ),
		// 	"param_name" 	=> 	"gridstyle",
		// 	"group" 		=> 'General',
		// 	"value"			=> array(
		// 		"Grid"				=>	"grid",
		// 		"Masonry"			=>	"masonry",
		// 	)
		// ),

		array(
            "type" 			=> 	"vc_number",
			"heading" 		=> 	__( 'Image Height', 'megaaddons' ),
			"param_name" 	=> 	"img_height",
			"edit_field_class" => "vc_col-sm-4 wdo_items_to_show wdo_margin_bottom",
			"suffix"		=>	"px",
			"group" 		=> 	'General',
        ),

        array(
			"type" 			=> "colorpicker",
			"heading" 		=> __( 'Caption Background', 'megaaddons' ),
			"param_name" 	=> "caption_bg",
			"edit_field_class" => "vc_col-sm-4 wdo_items_to_show wdo_margin_bottom",
			"value"			=>	"rgba(29,161,245,0.7)",
			"group" 		=> 'General',
		),

		array(
			"type" 			=> "dropdown",
			"heading" 		=> __( 'Hover Effect', 'ihover' ),
			"param_name" 	=> "hover_effect",
			"group" 		=> 'General',
			"value" 		=>  array(
				'Fade In'		=>		'ih_item_fade_effect',
				'Slide Up'		=>		'ih_item_slide_up',
				'Zoom In (Pro Version)'		=>		'',
				'Card Style (Pro Version)'	=>		'',
			)
		),

		array(
			"type" 			=> "iconpicker",
			"heading" 		=> __( 'Link Icon', 'accordion' ),
			"param_name" 	=> "link_icon",
			"value" 		=> "fas fa-link",
			"group" 		=> 'General',
		),

		array(
			"type" 			=> "iconpicker",
			"heading" 		=> __( 'Lightbox Icon', 'accordion' ),
			"param_name" 	=> "popup_icon",
			"value" 		=> "fas fa-search-plus",
			"group" 		=> 'General',
		),

		array(
            "type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Extra Class Name', 'megaaddons' ),
			"param_name" 	=> 	"classname",
			"description" 	=> 	"Style particular content element differently - add a class name and refer to it in custom CSS.",
			"group" 		=> 	'General',
        ),

		array(
			"type" 			=> "vc_links",
			"param_name" 	=> "caption_url",
			"class"			=>	"ult_param_heading",
			"description" 	=> __( '<span style="Background: #ddd;padding: 10px; display: block; color: #0073aa;font-weight:600;"><a href="https://1.envato.market/02aNL" target="_blank" style="text-decoration: none;">Get the Pro version for more stunning elements and customization options.</a></span>', 'ihover' ),
			"group" 		=> 'General',
		),

		// --------------------- Filterable Controls ------------------------ >
		
		array(
            "type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Gallery All Label', 'megaaddons' ),
			"param_name" 	=> 	"all_label",
			"value"			=>	"ALL",
			"group" 		=> 	'Filterable Controls',
        ),

        array(
            "type" 			=> 	"textarea",
			"heading" 		=> 	__( 'Categories Name', 'megaaddons' ),
			"param_name" 	=> 	"filter_cat",
			"value"			=>	"tech, innovation, brand",
			"description"		=>	"write all categories name seprated with comma e.g tech, innovation, brand",
			"group" 		=> 	'Filterable Controls',
        ),

        array(
            "type" 			=> 	"checkbox",
			"heading" 		=> 	__( 'Shuffle Button', 'megaaddons' ),
			"param_name" 	=> 	"shuffle_checked",
			"edit_field_class" => "vc_col-sm-4 wdo_items_to_show wdo_margin_bottom",
			"value"			=>	"",
			"group" 		=> 	'Filterable Controls',
        ),

        // array(
        //     "type" 			=> 	"checkbox",
		// 	"heading" 		=> 	__( 'Search Field', 'megaaddons' ),
		// 	"param_name" 	=> 	"search_checked",
		// 	"edit_field_class" => "vc_col-sm-4 wdo_items_to_show wdo_margin_bottom",
		// 	"value"			=>	"",
		// 	"group" 		=> 	'Filterable Controls',
        // ),

        array(
			"type" 			=> "dropdown",
			"heading" 		=> __( 'Text Transform', 'megaaddons' ),
			"param_name" 	=> "txt_transform",
			"edit_field_class" => "vc_col-sm-4 wdo_items_to_show wdo_margin_bottom",
			"group" 		=> 'Filterable Controls',
			"value"			=>	array(
				"Uppercase"		=>		"uppercase",
				"Capitalize"	=>		"capitalize",
				"Lowercase"		=>		"lowercase",
			)
		),

        // --------------------- Control Styles ------------------------ >

        array(
			"type" 			=> "vc_links",
			"param_name" 	=> "caption_urls",
			"class"			=>	"ult_param_heading",
			"description" 	=> __( '<span style="Background: #ddd;padding: 10px; display: block; color: #302f2f;font-weight:600;">Category Control Styles</span>', 'megaaddons' ),
			"group" 		=> 'Filterable Controls',
		),

		array(
			"type" 			=> "vc_number",
			"heading" 		=> __( 'Padding [Top Bottom]', 'megaaddons' ),
			"edit_field_class" => "vc_col-sm-4 wdo_items_to_show wdo_margin_bottom",
			"param_name" 	=> "categ_tbpadding",
			"value"			=>	"8",
			"suffix"		=>	"px",
			"group" 		=> 'Filterable Controls',
		),

		array(
			"type" 			=> "vc_number",
			"heading" 		=> __( 'Padding [Right Left]', 'megaaddons' ),
			"edit_field_class" => "vc_col-sm-4 wdo_items_to_show wdo_margin_bottom",
			"param_name" 	=> "categ_rlpadding",
			"value"			=>	"25",
			"suffix"		=>	"px",
			"group" 		=> 'Filterable Controls',
		),

		array(
			"type" 			=> "vc_number",
			"heading" 		=> __( 'Margin [Right Left]', 'megaaddons' ),
			"edit_field_class" => "vc_col-sm-4 wdo_items_to_show wdo_margin_bottom",
			"param_name" 	=> "categ_rlmargin",
			"value"			=>	"5",
			"suffix"		=>	"px",
			"group" 		=> 'Filterable Controls',
		),

		array(
			"type" 			=> "vc_number",
			"heading" 		=> __( 'Boder Radius', 'megaaddons' ),
			"edit_field_class" => "vc_col-sm-4 wdo_items_to_show wdo_margin_bottom",
			"param_name" 	=> "categ_radius",
			"suffix"		=>	"px",
			"group" 		=> 'Filterable Controls',
		),

		array(
			"type" 			=> "vc_number",
			"heading" 		=> __( 'Category [Font Size]', 'megaaddons' ),
			"edit_field_class" => "vc_col-sm-4 wdo_items_to_show wdo_margin_bottom",
			"param_name" 	=> "categ_textsize",
			"value"			=>	"17",
			"suffix"		=>	"px",
			"group" 		=> 'Filterable Controls',
		),

		array(
			"type" 			=> "vc_number",
			"heading" 		=> __( 'Margin [Bottom]', 'megaaddons' ),
			"edit_field_class" => "vc_col-sm-4 wdo_items_to_show wdo_margin_bottom",
			"param_name" 	=> "categ_bmargin",
			"suffix"		=>	"px",
			"group" 		=> 'Filterable Controls',
		),

		array(
			"type" 			=> "vc_number",
			"heading" 		=> __( 'Border Width', 'ihover' ),
			"param_name" 	=> "categ_borderwidth",
			"edit_field_class" => "vc_col-sm-4 wdo_items_to_show wdo_margin_bottom",
			"value"			=>	"0",
			"suffix" 		=> 'px',
			"group" 		=> 'Filterable Controls',
		),

		array(
			"type" 			=> "dropdown",
			"heading" 		=> __( 'Border Style', 'ich-vc' ),
			"param_name" 	=> "categ_borderstyle",
			"edit_field_class" => "vc_col-sm-4 wdo_items_to_show wdo_margin_bottom",
			"group" 		=> 'Filterable Controls',
			"value"			=>	array(
				"Solid"		=>		"solid",
				"Dotted"	=>		"dotted",
				"Ridge"		=>		"ridge",
				"Dashed"	=>		"dashed",
				"Double"	=>		"double",
				"Groove"	=>		"groove",
				"Inset"		=>		"inset",
			)
		),

		array(
			"type" 			=> "colorpicker",
			"heading" 		=> __( 'Border Color', 'ihover' ),
			"param_name" 	=> "categ_borderclr",
			"edit_field_class" => "vc_col-sm-4 wdo_items_to_show wdo_margin_bottom",
			"group" 		=> 'Filterable Controls',
		),

		// --------------------- Color Styling ------------------------ >

		array(
			"type" 			=> "vc_links",
			"param_name" 	=> "caption_urls",
			"class"			=>	"ult_param_heading",
			"description" 	=> __( '<span style="Background: #ddd;padding: 10px; display: block; color: #302f2f;font-weight:600;">Color Settings</span>', 'megaaddons' ),
			"group" 		=> 'Filterable Controls',
		),

		array(
			"type" 			=> "colorpicker",
			"heading" 		=> __( 'Text Color', 'ihover' ),
			"param_name" 	=> "categ_textclr",
			"edit_field_class" => "vc_col-sm-6 wdo_items_to_show wdo_margin_bottom",
			"group" 		=> 'Filterable Controls',
		),

		array(
			"type" 			=> "colorpicker",
			"heading" 		=> __( 'Background Color', 'ihover' ),
			"param_name" 	=> "categ_textbg",
			"edit_field_class" => "vc_col-sm-6 wdo_items_to_show wdo_margin_bottom",
			"group" 		=> 'Filterable Controls',
		),

		array(
			"type" 			=> "colorpicker",
			"heading" 		=> __( 'Active Text Color', 'ihover' ),
			"param_name" 	=> "categ_activeclr",
			"edit_field_class" => "vc_col-sm-6 wdo_items_to_show wdo_margin_bottom",
			"group" 		=> 'Filterable Controls',
		),

		array(
			"type" 			=> "colorpicker",
			"heading" 		=> __( 'Active Background', 'ihover' ),
			"param_name" 	=> "categ_activebg",
			"edit_field_class" => "vc_col-sm-6 wdo_items_to_show wdo_margin_bottom",
			"group" 		=> 'Filterable Controls',
		),
	)
) 
);
