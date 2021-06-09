(function ($) {
    "use strict";
    // Functions
    var lastScrollTop = 0;
    var windowloaded = false;

    var initLastScrollTop = function () {
        var st = $(window).scrollTop();
        lastScrollTop = st;
    };
    var isScrollDown = function () {
        var st = $(window).scrollTop();
        return (st > lastScrollTop);
    };
    var initMobileMenu = function () {
        $('.templaza-mobile-menu').templazaMobileMenu();
        $('#templaza-offcanvas').find('ul.menu').templazaMobileMenu();
        $('.templaza-mobile-menu').removeClass('d-none');
        $('.templaza-sidebar-menu .nav-item-caret').click(function () {
            $(this).parent('li').siblings('li').children('ul').slideUp();
            $(this).parent('li').siblings('li').children('.nav-item-caret').removeClass('open');
            $(this).toggleClass('open');
            $(this).siblings('ul').slideToggle();
        });
        $('.templaza-sidebar-collapsable').click(function () {
            $('header.templaza-header').toggleClass('expanded');
            // $('#templaza-header').toggleClass('expanded');
        });
    };
    var initDisplay = function () {
        setTimeout(function () {
            $('.d-init').removeClass('d-none');
        }, 100);
    };
    var initBackToTop = function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() >= 200) {        // If page is scrolled more than 200px
                $('#templaza-backtotop').fadeIn(200);    // Fade in the arrow
            } else {
                $('#templaza-backtotop').fadeOut(200);   // Else fade out the arrow
            }
        });
        $('#templaza-backtotop').click(function () {      // When arrow is clicked
            $('body,html').animate({
                scrollTop: 0                       // Scroll to top of body
            }, 500);
        });
    };
    var initHeader = function () {
        var stickyHeader = $('#templaza-sticky-header');

        var _header = $('header');
        if (!_header.length) {
            return false;
        }

        var _headerTop = _header.offset().top;
        var _headerHeight = _header.height();
        var _headerBottom = _headerTop + _headerHeight;

        if (!stickyHeader.length) {
            return;
        }

        // if($("#wpadminbar").length){
        //     stickyHeader.css("margin-top", $("#wpadminbar").height());
        // }

        var _winScroll = $(window).scrollTop();

        var _breakpoint = deviceBreakpoint(true);

        if (_breakpoint == 'xl' || _breakpoint == 'lg') {
            if (stickyHeader.hasClass('header-sticky-desktop') && (_winScroll > _headerBottom)) {
                stickyHeader.removeClass('d-none');
                stickyHeader.addClass('d-flex');
            } else if (stickyHeader.hasClass('header-stickyonscroll-desktop') && (_winScroll > _headerBottom) && !isScrollDown()) {
                stickyHeader.removeClass('d-none');
                stickyHeader.addClass('d-flex');
            } else {
                stickyHeader.removeClass('d-flex');
                stickyHeader.addClass('d-none');
            }
        } else if (_breakpoint == 'sm' || _breakpoint == 'md') {
            if (stickyHeader.hasClass('header-static-tablet')) {
                return;
            }
            if (stickyHeader.hasClass('header-sticky-tablet') && (_winScroll > _headerBottom)) {
                stickyHeader.removeClass('d-none');
                stickyHeader.addClass('d-flex');
            } else if (stickyHeader.hasClass('header-stickyonscroll-tablet') && (_winScroll > _headerBottom) && !isScrollDown()) {
                stickyHeader.addClass('d-flex');
                stickyHeader.removeClass('d-none');
            } else {
                stickyHeader.addClass('d-none');
                stickyHeader.removeClass('d-flex');
            }
        } else {
            if (stickyHeader.hasClass('header-static-mobile')) {
                return;
            }
            if (stickyHeader.hasClass('header-sticky-mobile') && (_winScroll > _headerBottom)) {
                stickyHeader.addClass('d-flex');
                stickyHeader.removeClass('d-none');
            } else if (stickyHeader.hasClass('header-stickyonscroll-mobile') && (_winScroll > _headerBottom) && !isScrollDown()) {
                stickyHeader.addClass('d-flex');
                stickyHeader.removeClass('d-none');
            } else {
                stickyHeader.addClass('d-none');
                stickyHeader.removeClass('d-flex');
            }
        }
    };

    var initAnimations = function () {
        var bindAnimation = function () {
            $('[data-animation]').each(function () {
                var _animation = $(this).data('animation');
                var _delay = $(this).data('animation-delay');
                if (_animation != '' && elementInViewport($(this)) && !$(this).hasClass('animation-done')) {
                    if (_delay != '' && _delay != 0 && _delay != '0') {
                        _delay = parseInt(_delay);
                    } else {
                        _delay = 0;
                    }
                    var _this = this;
                    setTimeout(function () {
                        $(_this).css('visibility', 'visible');
                        $(_this).addClass('animated');
                        $(_this).addClass(_animation);
                        $(_this).addClass('animation-done');
                        setTimeout(function () {
                            $(_this).removeClass('animated');
                            $(_this).removeClass(_animation);
                        }, (1010 + _delay));
                    }, _delay);
                }
            });
        };

        $(window).on("scroll", function () {
            bindAnimation();
        });
        bindAnimation();
    };

    var initProgressBar = function () {
        $('.progress-bar-viewport-animation').each(function () {
            var _this = $(this);
            if (!_this.hasClass('viewport-animation-done') && elementInViewport(_this)) {
                var _width = _this.data('value');
                _width = parseInt(_width);
                _this.css('width', _width + '%');
            }
        });
    };

    var elementInViewport = function (element) {
        var _this = element;
        var _this_top = _this.offset().top;
        return (_this_top <= window.pageYOffset + parseInt(window.innerHeight)) && (_this_top >= window.pageYOffset);
    };
    var deviceBreakpoint = function (_return) {
        if ($('.templaza-breakpoints').length == 0) {
            var _breakpoints = '<div class="templaza-breakpoints d-none"><div class="d-block d-sm-none device-xs"></div><div class="d-none d-sm-block d-md-none device-sm"></div><div class="d-none d-md-block d-lg-none device-md"></div><div class="d-none d-lg-block d-xl-none device-lg"></div><div class="d-none d-xl-block device-xl"></div></div>';
            $('body').append(_breakpoints);
        }
        var _sizes = ['xs', 'sm', 'md', 'lg', 'xl'];
        var _device = 'undefined';
        _sizes.forEach(function (_size) {
            var _visiblity = $('.templaza-breakpoints .device-' + _size).css('display');
            if (_visiblity == 'block') {
                _device = _size;
                return false;
            }
        });
        if (_return) {
            return _device;
        } else {
            $('body').removeClass('templaza-device-xs').removeClass('templaza-device-sm').removeClass('templaza-device-md').removeClass('templaza-device-lg').removeClass('templaza-device-xl');
            $('body').addClass('templaza-device-' + _device);
        }
    };

    var initPreloader = function () {
        $("#templaza-preloader").addClass('d-none');
    };

    // Events
    var docReady = function () {
        initDisplay();
        initMobileMenu();
        initBackToTop();
        initHeader();
        // initTooltip();
        deviceBreakpoint(false);
    };

    var winLoad = function () {
        initAnimations();
        deviceBreakpoint(false);
        initPreloader();
        initProgressBar();
        windowloaded = true;
    };

    var winResize = function () {
        deviceBreakpoint(false);
        initHeader();
    };

    var winScroll = function () {
        initHeader();
        initLastScrollTop();
        if (windowloaded) {
            initProgressBar();
        }
        deviceBreakpoint(false);
    };

    $(docReady);
    $(window).on('load', winLoad);
    $(window).on('resize', winResize);
    $(window).on('scroll', winScroll);
    window.addEventListener("orientationchange", winResize);
})(jQuery);