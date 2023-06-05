jQuery(function($){
 	"use strict";
   	jQuery('.gb_navigation > ul').superfish({
		delay:       500,
		animation:   {opacity:'show',height:'show'},
		speed:       'fast'
  	});
});

function modern_ecommerce_gb_Menu_open() {
	jQuery(".side_gb_nav").addClass('show');
}
function modern_ecommerce_gb_Menu_close() {
	jQuery(".side_gb_nav").removeClass('show');
}

jQuery(function($){
	$('.gb_toggle').click(function () {
        modern_ecommerce_Keyboard_loop($('.side_gb_nav'));
    });

    jQuery("h2.slider-title").each(function() {
		var t = jQuery(this).text();
		var splitT = t.split(" ");
		var halfIndex = Math.round(splitT.length / 2);
		var newText = "";
		for(var i = 0; i < splitT.length; i++) {
		if(i == halfIndex) {
			newText += "<span style='color:#ffbd27'>";
		}
			newText += splitT[i] + " ";
		}
		newText += "</span>";
		jQuery(this).html(newText);
	});
});