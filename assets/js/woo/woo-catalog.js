(function ($) {
    'use strict';
    var templaza_woo = templaza_woo || {};
    templaza_woo.init = function () {
        templaza_woo.$body = $(document.body),
            templaza_woo.$window = $(window);

        // Catalog
        // this.catalogBanner();
        // this.catalogToolBarV1();
        // this.catalogToolBarV2();
        // this.catalogToolBarV3();
        // this.productsTools();
        // this.productCategoriesCarousel();
        // this.catalogCollapseWidget();
        this.productsLoading();
        this.productsInfinite();
        // this.productsFilterActivated();

        // this.scrollFilterSidebar();
        // this.changeCatalogElementsFiltered();

        // this.stickySidebar();
    };
    templaza_woo.productsLoading = function () {
        templaza_woo.$body.on('click', '#templaza-catalog-previous-ajax > a', function (e) {
            e.preventDefault();

            var $this = $(this);
            if ($this.data('requestRunning')) {
                return;
            }

            $this.data('requestRunning', true);

            var $wrapper = $this.closest('.templaza-shop-container'),
                $products = $wrapper.find('.products'),
                $pagination = $wrapper.find('.next-posts-navigation'),
                numberPosts = $products.children('.product').length,
                href = $this.attr('href');

            $pagination.addClass('loading');

            $.get(
                href,
                function (response) {
                    var content = $(response).find('#templaza-shop-container').find('.products').children('.product');

                    // Add animation class
                    for (var index = 0; index < content.length; index++) {
                        $(content[index]).css('animation-delay', index * 100 + 'ms');
                    }
                    content.addClass('TemplazaFadeInUp');
                    if ($(response).find('.next-posts-navigation').length > 0) {
                        $pagination.html($(response).find('.next-posts-navigation').html());
                    } else {
                        $pagination.fadeOut();
                    }
                    $products.append(content);
                    $pagination.find('.nav-previous-ajax > a').data('requestRunning', false);

                    numberPosts += content.length;
                    $wrapper.find('.templaza-posts__found .current-post').html(' ' + numberPosts);
                    templaza_woo.postsFound();
                    $pagination.removeClass('loading');
                    $(document.body).trigger('templaza_products_loaded', [content, true]);
                }
            );
        });
    };
    templaza_woo.postsFound = function () {
        var $found = $('.templaza-posts__found-inner'),
            $foundEls = $found.find('.count-bar'),
            $current = $found.find('.current-post').html(),
            $total = $found.find('.found-post').html(),
            pecent = ($current / $total) * 100;

        $foundEls.css('width', pecent + '%');
    };
    templaza_woo.productsInfinite = function () {
        if (!$('.woocommerce-navigation').hasClass('ajax-scroll')) {
            return;
        }
        templaza_woo.$window.on('scroll', function () {
            if (templaza_woo.$body.find('#templaza-catalog-previous-ajax').is(':in-viewport')) {
                templaza_woo.$body.find('#templaza-catalog-previous-ajax > a').trigger('click');
            }
        }).trigger('scroll');
    };

    $(function () {
        templaza_woo.init();
    });

})(jQuery);