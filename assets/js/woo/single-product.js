(function ($) {
    'use strict';

    var templaza_woo = templaza_woo || {};
    templaza_woo.init = function () {
        templaza_woo.$body = $(document.body),
            templaza_woo.$window = $(window),
            templaza_woo.$header = $('#site-header');

        // Single product
        this.productVariation();

        // Product Layout
        this.singleProductV1();
        this.singleProductV2();
        this.singleProductV3();
        this.singleProductV4();
        this.singleProductV5();
        this.productTabs();

        this.stickyATC();

        this.productVideo();
        this.productVideoPopup();

        this.relatedProductsCarousel($('.products.related'));
        this.relatedProductsCarousel($('.products.upsells'));
    };

    /**
     * Product Thumbnails
     */
    templaza_woo.productThumbnails = function ($vertical) {
        var $gallery = $('.woocommerce-product-gallery'),
            $video = $gallery.find('.woocommerce-product-gallery__image.templaza_woo-product-video');

        $gallery.on('wc-product-gallery-after-init', function(){
            $gallery.imagesLoaded(function () {
                setTimeout(function () {

                    var columns = $gallery.data('columns'),
                        $thumbnail = $gallery.find('.flex-control-thumbs');

                    $thumbnail.wrap('<div class="woocommerce-product-gallery__thumbs-carousel swiper-container" style="opacity:0"></div>');
                    $thumbnail.addClass('swiper-wrapper');
                    $thumbnail.find('li').addClass('swiper-slide');
                    $thumbnail.after('<span class="templaza_woo-svg-icon templaza-thumbs-button-prev templaza-swiper-button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg></span>');
                    $thumbnail.after('<span class="templaza_woo-svg-icon templaza-thumbs-button-next templaza-swiper-button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg></span>');

                    var options = {
                        slidesPerView: columns,
                        loop: false,
                        autoplay: false,
                        speed: 800,
                        watchOverflow: true,
                        spaceBetween: 15,
                        navigation: {
                            nextEl: '.templaza-thumbs-button-next',
                            prevEl: '.templaza-thumbs-button-prev',
                        },
                        on: {
                            init: function () {
                                $thumbnail.parent().css('opacity', 1);
                            }
                        },
                        breakpoints: {
                            300: {
                                spaceBetween: 0,
                                allowTouchMove: false,
                            },
                            991: {
                                spaceBetween: 15,
                            },
                        }
                    };

                    if ($vertical) {
                        options.direction = 'vertical';
                    } else {
                        options.direction = 'horizontal';
                    }

                    new Swiper($thumbnail.parent(), options);

                    // Add an <span> to thumbnails for responsive bullets.
                    $('li', $thumbnail).append('<span/>');

                    if ($video.length > 0) {
                        var videoNumber = $('.woocommerce-product-gallery').data('video') - 1;
                        $('.woocommerce-product-gallery').addClass('has-video');
                        $thumbnail.find('li').eq(videoNumber).append('<div class="i-video"></div>');
                    }

                }, 200);

            });
        });
    };

    /**
     * Single Product V1
     */
    templaza_woo.singleProductV1 = function () {
        var $product = $('div.product.layout-1');

        if (!$product.length) {
            return;
        }
        templaza_woo.productThumbnails(false);
        $('.woocommerce-product-gallery').on('product_thumbnails_slider_horizontal', function(){
            templaza_woo.productThumbnails(false);
        });
    };

    /**
     * Single Product V2
     */
    templaza_woo.singleProductV2 = function () {

        var $product = $('div.product.layout-2');

        if (!$product.length) {
            return;
        }
        templaza_woo.productThumbnails(true);
    };

    /**
     * Single Product V3
     */
    templaza_woo.singleProductV3 = function () {
        var $product = $('div.product.layout-3');

        if (!$product.length) {
            return;
        }

        // Init zoom for product gallery images
        if ('1' === templazaData.product_image_zoom) {
            $product.find('.woocommerce-product-gallery .woocommerce-product-gallery__image').each(function () {
                templaza_woo.zoomSingleProductImage(this);
            });
        }

        templaza_woo.responsiveProductGallery();
    };

    /**
     * Single Product V4
     */
    templaza_woo.singleProductV4 = function () {
        var $product = $('div.product.layout-4');

        if (!$product.length) {
            return;
        }

        var $gallery = $('.woocommerce-product-gallery'),
            $galleryWrap = $gallery.find('.woocommerce-product-gallery__wrapper');

        $gallery.imagesLoaded(function () {

            if ($gallery.find('.woocommerce-product-gallery__image').length < 2) {
                return;
            }

            $gallery.addClass('swiper-container');
            $galleryWrap.addClass('swiper-wrapper');
            $galleryWrap.children().addClass('swiper-slide');
            $galleryWrap.after('<span class="templaza_woo-svg-icon templaza-swiper-button-prev templaza-swiper-button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg></span>');
            $galleryWrap.after('<span class="templaza_woo-svg-icon templaza-swiper-button-next templaza-swiper-button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg></span>');
            $galleryWrap.after('<div class="swiper-pagination"></div>');

            var options = {
                loop: false,
                autoplay: false,
                speed: 800,
                watchOverflow: true,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.templaza-swiper-button-next',
                    prevEl: '.templaza-swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                    clickable: true
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                        slidesPerGroup: 1
                    },
                    481: {
                        slidesPerView: 1,
                        slidesPerGroup: 1
                    },
                }
            };

            new Swiper($gallery, options);
        });

        // Init zoom for product gallery images
        if ('1' === templazaData.product_image_zoom) {
            $product.find('.woocommerce-product-gallery .woocommerce-product-gallery__image').each(function () {
                templaza_woo.zoomSingleProductImage(this);
            });
        }
    };

    /**
     * Single Product V5
     */
    templaza_woo.singleProductV5 = function () {
        var $product = $('div.product.layout-5');

        if (!$product.length) {
            return;
        }

        // Init zoom for product gallery images
        if ('1' === templazaData.product_image_zoom) {
            $product.find('.woocommerce-product-gallery .woocommerce-product-gallery__image').each(function () {
                templaza_woo.zoomSingleProductImage(this);
            });
        }

        templaza_woo.responsiveProductGallery();
    };

     /**
     * Product Tabs
     */
      templaza_woo.productTabs = function () {
        var $product = $('div.product');

        if (!$product.hasClass('product-tabs-under-summary')) {
            return;
        }

        // Product tabs
        var $tabs = $product.find('.woocommerce-tabs'),
            $hash = window.location.hash;

        if ($hash.toLowerCase().indexOf("comment-") >= 0 || $hash === "#reviews" || $hash === "#tab-reviews") {
            $tabs.find(".tab-title-reviews").addClass("active");
            $tabs.find(".woocommerce-Tabs-panel--reviews").show();
        }

        $(".woocommerce-review-link").on("click", function () {
            $(".templaza-accordion-title.tab-title-reviews").trigger('click');
        });

        $tabs.on("click", ".templaza-accordion-title", function (e) {
            e.preventDefault();

            if ($(this).hasClass("active")) {
                $(this).removeClass("active");
                $(this).siblings(".woocommerce-Tabs-panel").stop().slideUp(300);
            } else {
                $tabs.find(".templaza-accordion-title").removeClass("active");
                $tabs.find(".woocommerce-Tabs-panel").slideUp();
                $(this).addClass("active");
                $(this).siblings(".woocommerce-Tabs-panel").stop().slideDown(300);
            }
        });
    };

    /**
     * Related & ppsell products carousel.
     */
    templaza_woo.relatedProductsCarousel = function ($related) {
        if (!$related.length) {
            return;
        }

        var $products = $related.find('ul.products');
        var spaceBetween = true;

        $products.wrap('<div class="swiper-container linked-products-carousel" style="opacity: 0;"></div>');
        $products.addClass('swiper-wrapper');
        $products.find('li.product').addClass('swiper-slide uk-width-auto');

        var $number = templaza_woo.$body.hasClass('product-full-width') ? 5 : 4;
        var options = {
            loop: false,
            on: {
                init: function () {
                    this.$el.css('opacity', 1);
                }
            },
            spaceBetween: spaceBetween,
            breakpoints: {
                300: {
                    slidesPerView: templazaData.mobile_portrait == '' ? 2 : templazaData.mobile_portrait,
                    slidesPerGroup: templazaData.mobile_portrait == '' ? 2 : templazaData.mobile_portrait,
                    spaceBetween: 15,
                },
                480: {
                    slidesPerView: templazaData.mobile_landscape == '' ? 3 : templazaData.mobile_landscape,
                    slidesPerGroup: templazaData.mobile_landscape == '' ? 3 : templazaData.mobile_landscape,
                },
                768: {
                    spaceBetween: 15,
                    slidesPerView: 3,
                    slidesPerGroup: 3
                },
                992: {
                    slidesPerView: 3,
                    slidesPerGroup: 3
                },
                1200: {
                    slidesPerView: $number,
                    slidesPerGroup: $number,
                    spaceBetween: spaceBetween == true ? 30 : 0,
                }
            }
        };

        if( templazaProductData.related_product_navigation == 'scrollbar' ) {
            $products.after('<div class="swiper-scrollbar"></div>');
            options['scrollbar'] = {
                el: '.swiper-scrollbar',
                hide: false,
                draggable: true
            };
        } else if( templazaProductData.related_product_navigation == 'arrows' ) {
            $products.after('<span class="razzi-svg-icon rz-swiper-button-prev rz-swiper-button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg></span>');
            $products.after('<span class="razzi-svg-icon rz-swiper-button-next rz-swiper-button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg></span>');

            options['navigation'] = {
                nextEl: $related.find('.rz-swiper-button-next'),
                prevEl: $related.find('.rz-swiper-button-prev'),
            };

        } else {
            $products.after('<div class="swiper-pagination"></div>');

            options['pagination'] = {
                el: $related.find('.swiper-pagination'),
                type: 'bullets',
                clickable: true
            };
        }

        new Swiper($related.find('.linked-products-carousel'), options);
    };

    templaza_woo.productVariation = function () {

        templaza_woo.$body.on('tawcvs_initialized', function () {
            $('.variations_form').off('tawcvs_no_matching_variations');
            $('.variations_form').on('tawcvs_no_matching_variations', function (event, $el) {
                event.preventDefault();

                $('.variations_form').find('.woocommerce-variation.single_variation').show();
                if (typeof wc_add_to_cart_variation_params !== 'undefined') {
                    $('.variations_form').find('.single_variation').slideDown(200).html('<p>' + wc_add_to_cart_variation_params.i18n_no_matching_variations_text + '</p>');
                }
            });

        });

        $('.variations_form').on('found_variation.wc-variation-form', function (event, variation) {
            var $sku = $('.div.product').find('.sku_wrapper .sku');

            if (typeof $sku.wc_set_content !== 'function') {
                return;
            }

            if (typeof $sku.wc_reset_content !== 'function') {
                return;
            }


            if (variation.sku) {
                $sku.wc_set_content(variation.sku);
            } else {
                $sku.wc_reset_content();
            }

        });

    };

    /**
     * Zoom an image.
     * Copy from WooCommerce single-product.js file.
     */
    templaza_woo.zoomSingleProductImage = function (zoomTarget) {
        if (typeof wc_single_product_params == 'undefined' || !$.fn.zoom) {
            return;
        }

        var $target = $(zoomTarget),
            width = $target.width(),
            zoomEnabled = false;

        $target.each(function (index, target) {
            var $image = $(target).find('img');

            if ($image.data('large_image_width') > width) {
                zoomEnabled = true;
                return false;
            }
        });

        // Only zoom if the img is larger than its container.
        if (zoomEnabled) {
            var zoom_options = $.extend({
                touch: false
            }, wc_single_product_params.zoom_options);

            if ('ontouchstart' in document.documentElement) {
                zoom_options.on = 'click';
            }

            $target.trigger('zoom.destroy');
            $target.zoom(zoom_options);
        }
    }

    /**
     * Init slider for product gallery on mobile.
     */
    templaza_woo.responsiveProductGallery = function () {
        if (typeof templazaData.product_gallery_slider === 'undefined') {
            return;
        }

        if (templazaData.product_gallery_slider || !$.fn.wc_product_gallery) {
            return;
        }

        var $window = $(window),
            $product = $('.woocommerce div.product'),
            default_flexslider_enabled = false,
            default_flexslider_options = {};

        if (!$product.length) {
            return;
        }

        var $gallery = $('.woocommerce-product-gallery', $product),
            $originalGallery = $gallery.clone(),
            $video = $gallery.find('.woocommerce-product-gallery__image.templaza-product-video'),
            sliderActive = false;

        $originalGallery.children('.woocommerce-product-gallery__trigger').remove();

        // Turn off events then we init them again later.
        $originalGallery.off();

        if (typeof wc_single_product_params !== undefined) {
            default_flexslider_enabled = wc_single_product_params.flexslider_enabled;
            default_flexslider_options = wc_single_product_params.flexslider;
        }

        initProductGallery();
        $window.on('resize', initProductGallery);

        // Init product gallery
        function initProductGallery() {
            if ($window.width() >= 992) {
                if (!sliderActive) {
                    return;
                }

                if (typeof wc_single_product_params !== undefined) {
                    wc_single_product_params.flexslider_enabled = default_flexslider_enabled;
                    wc_single_product_params.flexslider = default_flexslider_options;
                }

                // Destroy is not supported at this moment.
                $gallery.replaceWith($originalGallery.clone());
                $gallery = $('.woocommerce-product-gallery', $product);

                $gallery.each(function () {
                    $(this).wc_product_gallery();
                });

                $('form.variations_form select', $product).trigger('change');

                // Init zoom for product gallery images
                if ('1' === templazaData.product_image_zoom && $product.hasClass('layout-v3', 'layout-v5')) {
                    $gallery.find('.woocommerce-product-gallery__image').each(function () {
                        templaza_woo.zoomSingleProductImage(this);
                    });
                }

                sliderActive = false;
            } else {
                if (sliderActive) {
                    return;
                }

                if (typeof wc_single_product_params !== undefined) {
                    wc_single_product_params.flexslider_enabled = true;
                    wc_single_product_params.flexslider.controlNav = true;
                }

                $gallery.replaceWith($originalGallery.clone());
                $gallery = $('.woocommerce-product-gallery', $product);

                setTimeout(function () {
                    $gallery.each(function () {
                        $(this).wc_product_gallery();
                    });
                }, 100);

                $('form.variations_form select', $product).trigger('change');

                sliderActive = true;

                if ($video.length > 0) {
                    $('.woocommerce-product-gallery').addClass('has-video');
                }
            }
        }
    };

    /**
     * Init sticky add to cart
     */
    templaza_woo.stickyATC = function () {
        var $selector = $('#templaza-sticky-add-to-cart'),
            $btn = $selector.find('.templaza-sticky-add-to-cart__content-button');

        if (!$selector.length) {
            return;
        }

        if (!$('div.product .entry-summary form.cart').length) {
            return;
        }

        var headerHeight = 0,
            cartHeight;

        if (templaza_woo.$body.hasClass('admin-bar')) {
            headerHeight += 32;
        }

        var isTop = $selector.hasClass('templaza-sticky-atc_top') ? true : false;

        function stickyAddToCartToggle() {

            cartHeight = $('.entry-summary form.cart').offset().top + $('.entry-summary form.cart').outerHeight() - headerHeight;

            if (window.pageYOffset > cartHeight) {
                $selector.addClass('open');

                if (templaza_woo.$body.hasClass('header-sticky') && isTop) {
                    templaza_woo.$body.find('.site-header').addClass('templaza-header_sticky-act-active');
                }
            } else {
                $selector.removeClass('open');
                templaza_woo.$body.find('.site-header').removeClass('templaza-header_sticky-act-active');
            }

            if (!isTop) {
                var documentHeight = document.body.scrollHeight;
                if (window.pageYOffset > documentHeight - window.innerHeight) {
                    $selector.removeClass('open');
                }
            }
        }

        templaza_woo.$window.on('scroll', function () {
            stickyAddToCartToggle();
        }).trigger('scroll');

        if (!$btn.hasClass('ajax_add_to_cart')) {
            $btn.on('click', function (event) {
                event.preventDefault();

                $('html,body').stop().animate({
                        scrollTop: $(".entry-summary").offset().top
                    },
                    'slow');
            });
        }
    };

    /**
     * Init product video
     */
    templaza_woo.productVideo = function () {
        var $gallery = $('.woocommerce-product-gallery');
        var $video = $gallery.find('.woocommerce-product-gallery__image.templaza-product-video');
        var $thumbnail = $gallery.find('.flex-control-thumbs');

        if ($video.length < 1) {
            return;
        }

        $thumbnail.on('click', 'li', function () {

            var $video = $gallery.find('.templaza-product-video');

            var $iframe = $video.find('iframe'),
                $wp_video = $video.find('video.wp-video-shortcode');

            if ($iframe.length > 0) {
                $iframe.attr('src', $iframe.attr('src'));
            }

            if ($wp_video.length > 0) {
                $wp_video[0].pause();
            }

            return false;

        });

        $video.find('.video-vimeo > iframe').attr('width', '100%').attr('height', 500);

        $thumbnail.find('li').on('click', '.i-video', function (e) {
            e.preventDefault();
            $(this).closest('li').find('img').trigger('click');
        });
    };

    /**
     * Init product video
     */
    templaza_woo.productVideoPopup = function () {
        var $video_icon = $('.woocommerce-product-gallery').find('.templaza-product-video--icon');
        if ($video_icon.length < 1) {
            return;
        }

        var options = {
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 300,
            preloader: false,
            fixedContentPos: false,
            iframe: {
                markup: '<div class="mfp-iframe-scaler">' +
                    '<div class="mfp-close"></div>' +
                    '<iframe class="mfp-iframe" frameborder="0" allow="autoplay"></iframe>' +
                    '</div>',
                patterns: {
                    youtube: {
                        index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

                        id: 'v=', // String that splits URL in a two parts, second part should be %id%
                        src: 'https://www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
                    },
                    vimeo: {
                        index: 'vimeo.com/',
                        id: '/',
                        src: '//player.vimeo.com/video/%id%?autoplay=1'
                    }
                },

                srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
            }
        };

        //$video_icon.magnificPopup( options);

    };


    /**
     * Document ready
     */
    $(function () {
        templaza_woo.init();
    });

})(jQuery);