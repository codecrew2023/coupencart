<?php
/**
 * About starter content.
 *
 * @package Cartsy_Lite\Inc\Starter_Content
 */

return [
	'post_type'  => 'page',
	'post_title' => _x( 'About', 'Theme starter content', 'cartsy-lite' ),
	'template'   => 'template-starterpage.php',
	'post_content' => '
	<!-- wp:columns {"verticalAlignment":null,"align":"wide"} -->
	<div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"center","width":"35%"} -->
	<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:35%"><!-- wp:heading -->
	<h2 id="views-of-mt-fuji">Views of Mt. Fuji</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph -->
	<p>An exhibition of early 20th century woodblock prints featuring the majesty of Mt. Fuji.</p>
	<!-- /wp:paragraph -->

	<!-- wp:paragraph -->
	<p><strong><a href="#">Learn More →</a></strong></p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"66.66%"} -->
	<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:gallery {"columns":2,"linkTo":"none"} -->
	<figure class="wp-block-gallery has-nested-images columns-2 is-cropped"><!-- wp:image {"id":841,"sizeSlug":"large","linkDestination":"none"} -->
	<figure class="wp-block-image size-large"><img src="https://s.w.org/patterns/files/2021/06/image-from-rawpixel-id-3065130-jpeg-1024x1024.jpg" alt="" class="wp-image-841"/></figure>
	<!-- /wp:image -->

	<!-- wp:image {"id":840,"sizeSlug":"large","linkDestination":"none"} -->
	<figure class="wp-block-image size-large"><img src="https://s.w.org/patterns/files/2021/06/image-from-rawpixel-id-3064488-jpeg-1024x1024.jpg" alt="" class="wp-image-840"/></figure>
	<!-- /wp:image -->

	<!-- wp:image {"id":839,"sizeSlug":"large","linkDestination":"none"} -->
	<figure class="wp-block-image size-large"><img src="https://s.w.org/patterns/files/2021/06/image-from-rawpixel-id-3063921-jpeg-1024x449.jpg" alt="" class="wp-image-839"/></figure>
	<!-- /wp:image --></figure>
	<!-- /wp:gallery --></div>
	<!-- /wp:column --></div>
	<!-- /wp:columns -->

	<!-- wp:group {"align":"full","style":{"color":{"text":"#000000","background":"#ffffff"}}} -->
	<div class="wp-block-group alignfull has-text-color has-background" style="background-color:#ffffff;color:#000000"><!-- wp:spacer {"height":64} -->
	<div style="height:64px" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide"><!-- wp:column -->
	<div class="wp-block-column"><!-- wp:cover {"customOverlayColor":"#f6f6f6","minHeight":600,"isDark":false,"className":"is-style-cartsy-lite-border"} -->
	<div class="wp-block-cover is-light is-style-cartsy-lite-border" style="min-height:600px"><span aria-hidden="true" class="has-background-dim-100 wp-block-cover__gradient-background has-background-dim" style="background-color:#f6f6f6"></span><div class="wp-block-cover__inner-container"><!-- wp:image {"align":"center","id":571,"sizeSlug":"medium","linkDestination":"none"} -->
	<div class="wp-block-image"><figure class="aligncenter size-medium"><img src="https://s.w.org/patterns/files/2021/06/wire-sculpture-263x300.jpg" alt="" class="wp-image-571"/></figure></div>
	<!-- /wp:image --></div></div>
	<!-- /wp:cover --></div>
	<!-- /wp:column -->

	<!-- wp:column {"verticalAlignment":"center"} -->
	<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":3,"style":{"typography":{"fontSize":35,"lineHeight":"1.26"}},"className":"margin-bottom-half"} -->
	<h3 class="margin-bottom-half" id="insects" style="font-size:35px;line-height:1.26">Insects</h3>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"style":{"typography":{"fontSize":17,"lineHeight":"1.65"}},"className":"margin-top-half"} -->
	<p class="margin-top-half" style="font-size:17px;line-height:1.65">Bees aren\'t the only pollinators. Insects such as butterflies, moths, bee flies, mosquitoes, and even ants fertilize flowers as they travel around your yard. </p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:column --></div>
	<!-- /wp:columns -->

	<!-- wp:spacer {"height":64} -->
	<div style="height:64px" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer --></div>
	<!-- /wp:group -->
	',
];
