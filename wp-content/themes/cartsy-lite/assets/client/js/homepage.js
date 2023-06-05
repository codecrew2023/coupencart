(function ($) {
    'use strict';

    init();

    function init() {
        sidebarDrawer();
    }

    //ioS device detection
    function iOS() {
        return (
        [
            'iPad Simulator',
            'iPhone Simulator',
            'iPod Simulator',
            'iPad',
            'iPhone',
            'iPod',
        ].includes(navigator.platform) ||
        // iPad on iOS 13 detection
        (navigator.userAgent.includes('Mac') && 'ontouchend' in document)
        );
    }

    // Window on load functions here
    $(window).on('load', function () {
        // Sidebar custom scrollbar
        var sidebarScrollbar = "";
        if ($('.cartsylite-layout-sidebar-scroll').length) {
            sidebarScrollbar = $('.cartsylite-layout-sidebar-scroll')
                .overlayScrollbars({
                    autoUpdate: true,
                    scrollbars: {
                        autoHide: 'leave',
                    },
                })
                .overlayScrollbars();
        }

        //Destroy scrollbar on ios device
        if (iOS()) {
            if ($('.cartsylite-layout-sidebar-scroll').length) {
                sidebarScrollbar.destroy();
            }
        }
    });

    //Sidebar drawer
    function sidebarDrawer() {
        var layoutSidebar = $('.cartsylite-layout-sidebar');
        $('.cartsylite-show-sidebar-category').on('click', function () {
            $('body').css({
                overflow: 'hidden',
                touchAction: 'none',
            });

            layoutSidebar.addClass('show-sidebar');
        });
        $('.cartsylite-layout-sidebar-close, .cartsylite-category-clear').on(
        'click',
        function () {
            $('body').css({
                overflow: '',
                touchAction: '',
                width: '',
            });
            layoutSidebar.removeClass('show-sidebar');
        }
        );
        $(document).mouseup((e) => {
            if (
                !$('.cartsylite-layout-sidebar, .cartsylite-layout-sidebar *').is(
                e.target
                )
            ) {
                layoutSidebar.removeClass('show-sidebar');
            }
        });
    }


    if ($('.cartsylite-category-dropdown-open').length) {
        $('.cartsylite-category-dropdown-open').on('click', function() {

            let $this = jQuery(this);

            $this
                .parents('.cartsylite-category-dropdown-title-wrapper')
                .toggleClass('active');

            $('.cartsylite-category-dropdown-title').removeClass('current')

            $this
                .siblings('.cartsylite-category-dropdown-title').addClass('current')

            $this
                .parents('.cartsylite-category-dropdown-title-wrapper')
                .siblings('.cartsylite-category-dropdown-content')
                .slideToggle('slow');

            $this
                .parents('.cartsylite-category-dropdown')
                .siblings()
                .find('.cartsylite-category-dropdown-content')
                .slideUp();
            
            $this
                .parents('.cartsylite-category-dropdown')
                .siblings()
                .find('.cartsylite-category-dropdown-title-wrapper')
                .removeClass('active');
        })
    }

    //Layout Sidebar position
    $(window).on('scroll', function () {
        if (
            $('.cartsylite-layout-sidebar').length &&
            $('footer.cartsylite-site-footer').length &&
            $(window).width() > 1024
        ) {
            var cartsyliteFooter = $('footer.cartsylite-site-footer');
            var elementTop = cartsyliteFooter.offset().top;
            var elementBottom =
            cartsyliteFooter.offset().top + cartsyliteFooter.outerHeight(true);
            var bottomOfScreen = $(window).scrollTop() + $(window).innerHeight();
            var topOfScreen = $(window).scrollTop();
            if (bottomOfScreen > elementTop && topOfScreen < elementBottom) {
                $('.cartsylite-layout-sidebar-inner').css({
                    paddingBottom: cartsyliteFooter.outerHeight(true) + 20,
                });
                cartsyliteFooter.css({
                    boxShadow: '0 -2px 4px rgb(0 0 0 / 8%)',
                });
            } else {
                $('.cartsylite-layout-sidebar-inner').css({
                    paddingBottom: '',
                });
                cartsyliteFooter.css({
                    boxShadow: '',
                });
            }
        }
    })

    // Check if home page sidebar is active
    if ($(".cartsylite-layout-sidebar").length) {
        function cartsy_lite_header_height(params) {
            $(":root")[0].style.setProperty(
                "--store-header-height",
                $(".cartsylite-header-default").outerHeight() + "px"
            );
        }
        cartsy_lite_header_height();
        $(window).on('resize', function () {
            cartsy_lite_header_height();
        })
    }
})(jQuery);
