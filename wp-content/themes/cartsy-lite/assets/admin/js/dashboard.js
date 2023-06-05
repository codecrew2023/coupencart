(function ($) {
    'use strict';
  
    $(document).ready(function () {

        $(window).on('scroll', function() {
            var currentTop = $(window).scrollTop();
            $('.redq-dashboard-changelog-wrap').each(function () {
                var elemTop 	= $(this).offset().top;
                var elemBottom 	= elemTop + $(this).height();

                if(currentTop >= elemTop && currentTop <= elemBottom){
                    var id 		= $(this).attr('id');
                    var navElem = $('a.redq-admin-dashboard-list-link[href="#' + id+ '"]');

                    navElem.parent().addClass('active').siblings().removeClass( 'active' );
                };
            })
        })
        
    });

    let $this = $('.redq-admin-dashboard-tab-wrapper');
    if ($this.length) {
        let position = $this.position().top
        $(window).on('scroll', function() {
            let offset = $(window).scrollTop()
            if (offset > position) {
                $this.parents('.redq-dashboard-header').addClass('stick')
            } else {
                $this.parents('.redq-dashboard-header').removeClass('stick')
            }
        })
    }

})(jQuery);
  