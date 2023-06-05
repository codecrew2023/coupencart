/* global catchShopOptions */
 /*
 * Custom scripts
 * Description: Custom scripts for catch_shop
 */
( function( $ ) {
    jQuery( document ).ready( function() {
        body = jQuery( document.body );
        jQuery( window )
            .on( 'load.catchShop resize.catchShop', function() {
            if ( window.innerWidth < 1200 ) {
                jQuery('#site-header-menu').on('focusout', function () {
                    var $elem = jQuery(this);
                    // let the browser set focus on the newly clicked elem before check
                    setTimeout(function () {
                        if ( ! $elem.find(':focus').length ) {
                            jQuery( '#menu-toggle' ).trigger('click');
                        }
                    }, 0);
                });

                jQuery('#site-header-top-menu').on('focusout', function () {
                    var $elem = jQuery(this);
                    // let the browser set focus on the newly clicked elem before check
                    setTimeout(function () {
                        if ( ! $elem.find(':focus').length ) {
                            jQuery( '#menu-toggle-top' ).trigger('click');
                        }
                    }, 0);
                });
            }

            jQuery('#search-container-main .search-container').on('focusout', function () {
                var $elem = jQuery(this);

                // let the browser set focus on the newly clicked elem before check
                setTimeout(function () {
                    if ( ! $elem.find(':focus').length ) {
                        jQuery( '#search-toggle-main' ).trigger('click');
                    }
                }, 0);
            });
        } );
    });

    // Owl Carousel
    if ( typeof $.fn.owlCarousel === "function" ) {
        // Featured Slider
        var sliderOptions = {
            rtl:catchShopOptions.rtl ? true : false,
            autoHeight:true,
            margin: 0,
            items: 1,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            loop: true,
            navText: [catchShopOptions.iconNavPrev,catchShopOptions.iconNavNext]
        };

        $(".main-slider").owlCarousel(sliderOptions);

        // Scrolling Section
        var logoSliderLayout = 6;
        var logoSliderOptions = {
            rtl:catchShopOptions.rtl ? true : false,
            autoHeight:true,
            margin: 0,
            items: 6,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            loop: true,
            responsive:{
                0:{
                    items:1
                },
                480:{
                    items:2
                },
                640:{
                    items:( logoSliderLayout < 3 ) ? logoSliderLayout : 3
                },
                640:{
                    items:( logoSliderLayout < 4 ) ? logoSliderLayout : 4
                },
                1024:{
                    items:( logoSliderLayout < 5 ) ? logoSliderLayout : 5
                },
                1120:{
                    items:( logoSliderLayout < 6 ) ? logoSliderLayout : 6
                }
            },
            navText: [catchShopOptions.iconNavPrev,catchShopOptions.iconNavNext]
        };

        $(".catch-shop-logo-slider-content-wrapper").owlCarousel(logoSliderOptions);

        // Testimonial Section
        var testimonialLayout = 2;
        var testimonialOptions = {
            rtl:catchShopOptions.rtl ? true : false,
            autoHeight: true,
            margin: 0,
            items: 1,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            loop: true,
            responsive:{
                0:{
                    items:1
                },
                668:{
                    items:( testimonialLayout < 2 ) ? testimonialLayout : 2
                }
            },
            navText: [catchShopOptions.iconNavPrev,catchShopOptions.iconNavNext]
        };

        $( '.testimonial-slider' ).owlCarousel(testimonialOptions);
    }

    $( function() {
        // Functionality for scroll to top button
        $(window).on( 'scroll', function () {
            if ( $( this ).scrollTop() > 100 ) {
                $( '#scrollup' ).fadeIn('slow');
                $( '#scrollup' ).show();
            } else {
                $('#scrollup').fadeOut('slow');
                $("#scrollup").hide();
            }
        });

        $( '#scrollup' ).on( 'click', function () {
            $( 'body, html' ).animate({
                scrollTop: 0
            }, 500 );
            return false;
        });

        // Fit Vid load
        if ( typeof $.fn.fitVids === "function" ) {
            $('.hentry, .widget').fitVids();
        }
    });

    //Light Box for videos section
    if ( typeof $.fn.flashy === "function" ) {
        $('.mixed').flashy({
            gallery: false,
        });
    }

    // Add header video class after the video is loaded.
    $( document ).on( 'wp-custom-header-video-loaded', function() {
        $( 'body' ).addClass( 'has-header-video' );
    });

    $( function() {
        $( document ).ready( function() {
            //Equal Height Initialize
            $('.logo-slider-section .section-content-wrapper .hentry, .service-section .hentry-inner, .featured-content-section .section-content-wrapper .hentry-inner .entry-container, .why-choose-us-section .hentry-inner .entry-container, #testimonial-content-section .section-content-wrapper .entry-container, .team-content-wrapper.section-content-wrapper .hentry-inner .entry-container').matchHeight();

            // Add one-column-layout to section-content-wrapper of special section if only one div (left or right) is present.
            if ( $( '#special-section' ).length ) {
                if ( ! $( '#special-right' ).length ) {
                    // Section-right is not present.
                    $( '#special-section .section-content-wrapper' ).addClass( 'one-column-layout' );
                } if ( ! ( $.trim( $('#special-left').html() ).length ) ) {
                    // Section left is present but empty, so remove that div and add in class to wrapper.
                    $( '#special-left' ).remove();
                    $( '#special-section .section-content-wrapper' ).addClass( 'one-column-layout' );
                }
            }
        });
    });

    /*
     * Test if inline SVGs are supported.
     * @link https://github.com/Modernizr/Modernizr/
     */
    function supportsInlineSVG() {
        var div = document.createElement( 'div' );
        div.innerHTML = '<svg/>';
        return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
    }

    $( function() {
        $( document ).ready( function() {
            if ( true === supportsInlineSVG() ) {
                document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
            }
        });
    });

    var body, masthead, menuToggle, siteNavigation, socialNavigation, siteHeaderMenu, resizeTimer;

    function initMainNavigation( container ) {

        // Add dropdown toggle that displays child menu items.
        var dropdownToggle = $( '<button />', { 'class': 'dropdown-toggle', 'aria-expanded': false })
            .append( catchShopOptions.screenReaderText.icon )
            .append( $( '<span />', { 'class': 'screen-reader-text', text: catchShopOptions.expand }) );

        container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( dropdownToggle );

        // Set the active submenu dropdown toggle button initial state.
        container.find( '.current-menu-ancestor > button' )
            .addClass( 'toggled-on' )
            .attr( 'aria-expanded', 'true' )
            .find( '.screen-reader-text' )
            .text( catchShopOptions.collapse );
        // Set the active submenu initial state.
        container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

        // Add menu items with submenus to aria-haspopup="true".
        container.find( '.menu-item-has-children' ).attr( 'aria-haspopup', 'true' );

        container.find( '.dropdown-toggle' ).on( 'click', function( e ) {
            var _this            = $( this ),
                screenReaderSpan = _this.find( '.screen-reader-text' );

            e.preventDefault();
            _this.toggleClass( 'toggled-on' );
            _this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

            // jscs:disable
            _this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            // jscs:enable
            screenReaderSpan.text( screenReaderSpan.text() === catchShopOptions.expand ? catchShopOptions.collapse : catchShopOptions.expand );
        } );
    }

    masthead         = $( '#header-navigation-area' );
    menuToggle       = masthead.find( '#menu-toggle' );
    siteHeaderMenu   = masthead.find( '#site-header-menu' );
    siteNavigation   = masthead.find( '#site-primary-navigation' );
    socialNavigation = masthead.find( '#search-social-container' );
    initMainNavigation( siteNavigation );

    // Enable menuToggle.
    ( function() {

        // Return early if menuToggle is missing.
        if ( ! menuToggle.length ) {
            return;
        }

        // Add an initial values for the attribute.
        menuToggle.add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded', 'false' );

        menuToggle.on( 'click.catchShop', function() {
            $( this ).add( siteHeaderMenu ).toggleClass( 'toggled-on' );

            // jscs:disable
            $( this ).add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded', $( this ).add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            // jscs:enable
        } );
    } )();

    // Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
    ( function() {
        if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
            return;
        }

        // Toggle `focus` class to allow submenu access on tablets.
        function toggleFocusClassTouchScreen() {
            if ( window.innerWidth >= 1024 ) {
                $( document.body ).on( 'touchstart.catchShop', function( e ) {
                    if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
                        $( '.main-navigation li' ).removeClass( 'focus' );
                    }
                } );
                siteNavigation.find( '.menu-item-has-children > a' ).on( 'touchstart.catchShop', function( e ) {
                    var el = $( this ).parent( 'li' );

                    if ( ! el.hasClass( 'focus' ) ) {
                        e.preventDefault();
                        el.toggleClass( 'focus' );
                        el.siblings( '.focus' ).removeClass( 'focus' );
                    }
                } );
            } else {
                siteNavigation.find( '.menu-item-has-children > a' ).unbind( 'touchstart.catchShop' );
            }
        }

        if ( 'ontouchstart' in window ) {
            $( window ).on( 'resize.catchShop', toggleFocusClassTouchScreen );
            toggleFocusClassTouchScreen();
        }

        $('#site-primary-navigation a').on( 'focus blur', function() {
            $( this ).parents( '.menu-item' ).toggleClass( 'focus' );
        } );
    } )();

    //For Header Top Menu
    menuToggleTop    = $( '#menu-toggle-top' ); // button id
    siteTopMenu       = $( '#site-header-top-menu' ); // wrapper id
    siteNavigationTop = $( '#site-top-navigation' ); // nav id
    initMainNavigation( siteNavigationTop );

    // Enable menuToggleTop.
    ( function() {
        // Return early if menuToggleTop is missing.
        if ( ! menuToggleTop.length ) {
            return;
        }

        // Add an initial values for the attribute.
        menuToggleTop.add( siteNavigationTop ).attr( 'aria-expanded', 'false' );

        menuToggleTop.on( 'click', function() {
            $( this ).add( siteTopMenu ).toggleClass( 'toggled-on' );

            // jscs:disable
            $( this ).add( siteNavigationTop ).attr( 'aria-expanded', $( this ).add( siteNavigationTop ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            // jscs:enable
        } );
    } )();

    // Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
    ( function() {
        if ( ! siteNavigationTop.length || ! siteNavigationTop.children().length ) {
            return;
        }

        // Toggle `focus` class to allow submenu access on tablets.
        function toggleFocusClassTouchScreenTopNav() {
            if ( window.innerWidth >= 1024 ) {
                $( document.body ).on( 'touchstart', function( e ) {
                    if ( ! $( e.target ).closest( '.top-navigation li' ).length ) {
                        $( '.top-navigation li' ).removeClass( 'focus' );
                    }
                } );
                siteNavigationTop.find( '.menu-item-has-children > a' ).on( 'touchstart', function( e ) {
                    var el = $( this ).parent( 'li' );

                    if ( ! el.hasClass( 'focus' ) ) {
                        e.preventDefault();
                        el.toggleClass( 'focus' );
                        el.siblings( '.focus' ).removeClass( 'focus' );
                    }
                } );
            } else {
                siteNavigationTop.find( '.menu-item-has-children > a' ).unbind( 'touchstart' );
            }
        }

        if ( 'ontouchstart' in window ) {
            $( window ).on( 'resize', toggleFocusClassTouchScreenTopNav );
            toggleFocusClassTouchScreenTopNav();
        }

        siteNavigationTop.find( 'a' ).on( 'focus blur', function() {
            $( this ).parents( '.menu-item' ).toggleClass( 'focus' );
        } );
    })();
    //Header Top Menu End

    //Search Toggle Top
    $( '#mobile-toggle-top, #search-toggle-top' ).on( 'click', function() {

        $(this).toggleClass('toggled-on');

        var jQuerythis_el_search = $(this),
            jQueryform_search = jQuerythis_el_search.siblings( '#search-top-container' );

        if ( ! jQueryform_search.length ) {
            jQueryform_search = jQuerythis_el_search.siblings( '#site-header-top-menu' ).children( '.top-main-wrapper' ).children( '#search-top-container' );
        }

        if ( jQueryform_search.hasClass( 'displaynone' ) ) {
            jQueryform_search.removeClass( 'displaynone' ).addClass( 'displayblock' );
        } else {
            jQueryform_search.removeClass( 'displayblock' ).addClass( 'displaynone' );
        }
    });

    //Search Toggle
    var jQueryheader_search = $( '#search-toggle' );
    jQueryheader_search.on( 'click', function() {
        var jQuerythis_el_search = $(this),
            jQueryform_search = jQuerythis_el_search.siblings( '#search-social-container' );

        if ( jQueryform_search.hasClass( 'displaynone' ) ) {
             jQueryheader_search.addClass( 'toggled-on' );
            jQueryform_search.removeClass( 'displaynone' ).addClass( 'displayblock' );
        } else {
            jQueryform_search.removeClass( 'displayblock' ).addClass( 'displaynone' );
        }
    });

    $( '.menu-search-toggle' ).on( 'click', function() {
        $( this ).toggleClass( 'toggled-on' );
        $( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
        $( '.site-product-search' ).toggleClass( 'toggled-on' );
    });

    $( '#search-toggle-main' ).on( 'click', function() {
        $( this ).toggleClass( 'toggled-on' );
        $( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
        $( '#search-container-main .search-container' ).toggleClass( 'toggled-on' );
    });

    $(document).ready(function() {
        $('#share-toggle').on('click', function(e){
            e.stopPropagation();
            $(this).toggleClass('toggled-on');
            $('#header-search-container').removeClass('toggled-on');
            $('#header-menu-social').toggleClass('toggled-on');
        });
    });

       //Adding padding top for header to match with custom header
    $( window ).on( 'load resize', function () {
        if( $( 'body' ).hasClass( 'has-custom-header' ) || $( 'body' ).hasClass( 'absolute-header' )) {
            headerheight = $('#masthead').height();
            $('.home.absolute-header #masthead + .custom-header, .home.absolute-header #masthead + #feature-slider-section .slider-image-wrapper').css('padding-top', headerheight );
        }
    });

    /* Playlist On Scroll For Mobile */
    var PlaylistOnScroll = function(){

        var scrollTop = $(window).scrollTop();

        if (scrollTop > 46) {
            $('body').addClass('playlist-fixed');
        } else {
            $('body').removeClass('playlist-fixed');
        }
    };

    /*Onload*/
    PlaylistOnScroll();

    /*On Scroll*/
    $(window).on( 'scroll',function() {
        PlaylistOnScroll();
    });

    // Show count in header if count is more than 0
    if (parseInt($(".site-header-cart .cart-contents .count").text()) !== 0) {
        $(".site-header-cart .cart-contents .count").show();
    }

    var windowWidth = $(window).width();
    if(windowWidth > 768){
         $( window ).on( 'load resize', function () {
         });
    }

    //Masonry blocks
    $blocks = $('.grid');

    $blocks.imagesLoaded(function(){
        $blocks.masonry({
            itemSelector: '.grid-item',
            columnWidth: '.grid-item',
        });

        // Fade blocks in after images are ready (prevents jumping and re-rendering)
        $('.grid-item').fadeIn();
        $blocks.find( '.grid-item' ).animate( {
            'opacity' : 1
        } );

    });

    $(document).ready( function() { setTimeout( function() { $blocks.masonry(); }, 2000); });

    $(window).on( 'resize', function () {
        $blocks.masonry();
    });

    //Isotope
     $( window ).on( 'load resize', function () {
        if ( typeof $.fn.isotope === "function" ) {
            // init Isotope
            var $grid = $('.grid').isotope({
                itemSelector: '.grid-item',
            });

            // filter items on button click
            $('.filter-button-group').on( 'click', 'button', function() {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({ filter: filterValue });
            });
        }

         $('.filter-button-group .button').on( 'click',function(){
            $('.filter-button-group .button').removeClass('is-checked');
            $(this).addClass('is-checked');
        });
    });

    $(window).on( 'load resize', function() {
        var thumbHeight = $('#featured-video-section .featured').height();
        if ( $(window).width() > 1024 ) {
            $('#featured-video-section .side-posts-wrap').css('height', thumbHeight);
        } else {
            $('#featured-video-section .side-post-wrap').removeAttr('style');
        }


        // var thumbHeight = $('#featured-video-section .featured .video-thumbnail').height();
        // $('#featured-video-section .side-posts-wrap').css('height', thumbHeight);

        var thumbHeight = $('#featured-video-section .featured').height();
        $('#featured-video-section .side-posts-wrap').css('height', thumbHeight);
    });

    // Added
    $(window).on('load resize', function () {
        $('ul.products li.product img').each(function (i) {
            // Find closest parent .type-procuct, then find its child .product-container, then add the images inner height - 42 top to the button.
            $(this).closest('.type-product').children('.product-container').children('a.button').css('top', $(this).innerHeight() - 42);

        })
    });

    if ( typeof $.fn.countdown === "function"  ) {
        if ( typeof catchShopCountdownEndDate !== 'undefined' ) {
            $('.clock').countdown( catchShopCountdownEndDate, function(event) {
              var $this = $(this).html(event.strftime(''
                + '<span class="count-down"><span class="countdown-day"><span class="countdown-number">%-D</span><span class="countdown-label"> day%!d</span></span></span> '
                + '<span class="count-down"><span class="countdown-hour"><span class="countdown-number">%H</span><span class="countdown-label"> hr</span></span></span> '
                + '<span class="count-down"><span class="countdown-minute"><span class="countdown-number">%M</span><span class="countdown-label"> min</span></span></span> '
                + '<span class="count-down"><span class="countdown-second"><span class="countdown-number">%S</span><span class="countdown-label"> sec</span></span></span>'));
            });
        }

        if ( typeof catchShopCountdownHeaderEndDate !== 'undefined' ) {
            $('.header-clock').countdown( catchShopCountdownHeaderEndDate, function(event) {
              var $this = $(this).html(event.strftime(''
                + '<span class="count-down"><span class="countdown-day"><span class="countdown-number">%-D</span><span class="countdown-label">D</span></span></span> '
                + '<span class="count-down"><span class="countdown-hour"><span class="countdown-number">%-H</span><span class="countdown-label"> H</span></span></span> '
                + '<span class="count-down"><span class="countdown-minute"><span class="countdown-number">%-M</span><span class="countdown-label"> M</span></span></span> '
                + '<span class="count-down"><span class="countdown-second"><span class="countdown-number">%-S</span><span class="countdown-label"> S</span></span></span>'));
            });
        }
    }
} )( jQuery );
