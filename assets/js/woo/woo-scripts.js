(function ($) {
	'use strict';

	var templaza_woo = templaza_woo || {};
	templaza_woo.init = function () {
		templaza_woo.$body = $(document.body),
			templaza_woo.$window = $(window)

		// Common
		this.toggleModals();
		this.toggleOffPopup();
		this.scrollSection();

		this.miniCartQuantity();

		// Product Loop
		this.addWishlist();
		this.productLoopHover();
		this.productLoopATCForm();
		this.productLoopHoverSlider();
		this.productLoopHoverZoom();
		this.productQuickView();
		this.productQuantityDropdown();
		this.productQuantityNumber();
		this.updateQuantityAuto();
		this.productLoopFormAJAX();

		this.productLoaded();

		// Single Product
		this.productLightBox();
		this.reviewProduct();
		this.stickyAddToCart();

		// Product Notification
		this.openMiniCartPanel();
		this.addedToCartNotice();
		this.productPopupATC();
		this.addedToWishlistNotice();

		this.addToCartSingleAjax();

		// Cart
		this.cartPageQuantity();
		this.crossSellProductsCarousel();

		// Account
		this.accountOrder();
		this.loginPanel();
		this.loginPanelAuthenticate();

		this.recentlyViewedProducts();

		// Mobile

		// Style
		// this.inlineStyle();
	};

	/**
	 * Toggle modals.
	 */
	templaza_woo.toggleModals = function () {
		$(document.body).on('click', '[data-toggle="modal"]', function (event) {
			var target = '#' + $(this).data('target');

			if ($(target).hasClass('open')) {
				templaza_woo.closeModal(target);
			} else if (templaza_woo.openModal(target)) {
				event.preventDefault();
			}

		}).on('click', '.templaza-modal .button-close, .templaza-modal .off-modal-layer', function (event) {
			event.preventDefault();
			templaza_woo.closeModal(this);
		}).on('keyup', function (e) {
			if (e.keyCode === 27) {
				templaza_woo.closeModal();
			}
		});
	};

	/**
	 * Open a modal.
	 *
	 * @param string target
	 */
	templaza_woo.openModal = function (target) {
		var $target = $(target);

		if (!$target.length) {
			return false;
		}

		$target.fadeIn();
		$target.addClass('open');

		$(document.body).addClass('modal-opened ' + $target.attr('id') + '-opened').trigger('templaza_modal_opened', [$target]);

		if( $target.attr('id') == 'search-modal' ) {
			$('.ra-search-modal .search-field').focus();
		} else if( $target.attr('id') == 'account-modal' ) {
			$('.woocommerce-account .input-text[name="username"]').focus();
		}

		var widthScrollBar = window.innerWidth - document.documentElement.clientWidth;
		$(document.body).css({'padding-right': widthScrollBar, 'overflow': 'hidden'});

		return true;
	}

	/**
	 * Close a modal.
	 *
	 * @param string target
	 */
	templaza_woo.closeModal = function (target) {
		if (!target) {
			$('.templaza-modal').removeClass('open').fadeOut();

			$('.templaza-modal').each(function () {
				var $modal = $(this);

				if (!$modal.hasClass('open')) {
					return;
				}

				$modal.removeClass('open').fadeOut();
				$(document.body).removeClass($modal.attr('id') + '-opened');
			});
		} else {
			target = $(target).closest('.templaza-modal');
			target.removeClass('open loaded').fadeOut();

			$(document.body).removeClass(target.attr('id') + '-opened');
		}

		$(document.body).removeAttr('style');
		$(document.body).removeClass('modal-opened').trigger('templaza_modal_closed', [target]);
	}

	/**
	 * Toggle off-screen panels
	 */
	templaza_woo.toggleOffPopup = function () {
		$(document.body).on('click', '[data-toggle="off-popup"]', function (event) {
			var target = '#' + $(this).data('target');

			if ($(target).hasClass('open')) {
				templaza_woo.closeOffPopup(target);
			} else if (templaza_woo.openOffPopup(target)) {
				event.preventDefault();
			}
		}).on('click', '.offscreen-popup .button-close, .offscreen-popup .backdrop', function (event) {
			event.preventDefault();

			templaza_woo.closeOffPopup(this);
		}).on('keyup', function (e) {
			if (e.keyCode === 27) {
				templaza_woo.closeOffPopup();
			}
		});
	};

	/**
	 * Open off popup panel.
	 */
	templaza_woo.openOffPopup = function (target) {
		var $target = $(target);

		if (!$target.length) {
			return false;
		}

		$target.fadeIn();
		$target.addClass('open');

		$(document.body).addClass('offpopup-opened ' + $target.attr('id') + '-opened').trigger('templaza_off_popup_opened', [$target]);

		return true;
	}

	/**
	 * Close off popup panel.
	 */
	templaza_woo.closeOffPopup = function (target) {
		if (!target) {
			$('.offscreen-popup').each(function () {
				var $panel = $(this);

				if (!$panel.hasClass('open')) {
					return;
				}

				$panel.removeClass('open').fadeOut();
				$(document.body).removeClass($panel.attr('id') + '-opened');
			});
		} else {
			target = $(target).closest('.offscreen-popup');
			target.removeClass('open').fadeOut();

			$(document.body).removeClass(target.attr('id') + '-opened');
		}

		$(document.body).removeClass('offpopup-opened').trigger('templaza_off_popup_closed', [target]);
	}

	templaza_woo.getOptionsDropdown = function () {
		var options = {
			onChange: function (value, input) {
			   templaza_woo.updateCartAJAX(value, input);
			}
		};

		return options;
	}

	templaza_woo.updateCartAJAX = function (value, input) {
		var $row = $( input ).closest('.woocommerce-mini-cart-item'),
		key = $row.find('a.remove').data('cart_item_key'),
		nonce = $row.find('.woocommerce-cart-item__qty').data('nonce'),
		ajax_url = wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'update_cart_item');

		if ($.fn.block) {
			$row.block({
				message: null,
				overlayCSS: {
					opacity: 0.6,
					background: '#fff'
				}
			});
		}

		$.post(
			ajax_url, {
				cart_item_key: key,
				qty: value,
				security: nonce
			}, function (response) {
				if (!response || !response.fragments) {
					return;
				}

				if ($.fn.unblock) {
					$row.unblock();
				}

				$( document.body ).trigger( 'added_to_cart', [response.fragments, response.cart_hash] );
			}).fail(function () {
			if ($.fn.unblock) {
				$row.unblock();
			}

			return;
		});
	}

	/**
	 * Make the cart widget more flexible.
	 */
	templaza_woo.miniCartQuantity = function () {
		if (typeof wc_add_to_cart_params === undefined) {
			$('.woocommerce-mini-cart-item .quantity .qty').prop('disabled', true);

			$(document.body).on('wc_fragments_refreshed removed_from_cart', function () {
				$('.woocommerce-mini-cart-item .quantity .qty').prop('disabled', true);
			});

			return;
		}

		if ($.fn.quantityDropdown && ! templaza_woo.$body.hasClass('product-qty-number')) {
			var options = templaza_woo.getOptionsDropdown();
			$('.woocommerce-mini-cart-item .quantity .qty').quantityDropdown(options);

			$(document.body).on('wc_fragments_refreshed removed_from_cart added_to_cart', function () {
				$('.woocommerce-mini-cart-item .quantity .qty').quantityDropdown(options);
			});
		}

	};

	/**
	 * Make the cart widget more flexible.
	 */
	templaza_woo.cartPageQuantity = function () {
		if (typeof wc_add_to_cart_params === undefined) {
			$('.woocommerce-cart-form__cart-item .quantity .qty').prop('disabled', true);

			$(document.body).on('wc_fragments_refreshed removed_from_cart', function () {
				$('.woocommerce-cart-form__cart-item .quantity .qty').prop('disabled', true);
			});

			return;
		}


		if ($.fn.quantityDropdown && ! templaza_woo.$body.hasClass('product-qty-number')) {
			var options = '';
			$('.woocommerce-cart-form__cart-item .quantity .qty').quantityDropdown(options);

			$(document.body).on('wc_fragments_refreshed removed_from_cart added_to_cart', function () {
				$('.woocommerce-cart-form__cart-item .quantity .qty').quantityDropdown(options);
			});
		}

	};

	/**
	 * Quantity dropdown
	 */

	templaza_woo.productQuantityDropdown = function () {
		if ($.fn.quantityDropdown && ! templaza_woo.$body.hasClass('product-qty-number')) {
			// Quantity dropdown
			$('div.product, .templaza-sticky-add-to-cart').find('.quantity .qty').quantityDropdown();

			$(document.body).on('wc_fragments_refreshed removed_from_cart added_to_cart', function () {
				$('div.product, .templaza-sticky-add-to-cart').find('.quantity .qty').quantityDropdown();
			});
		}
	};

	/**
	 * Change product quantity
	 */
	 templaza_woo.productQuantityNumber = function () {
		if( ! templaza_woo.$body.hasClass('product-qty-number') ) {
			return;
		}

		templaza_woo.$body.on('click', '.templaza-qty-button', function (e) {
			e.preventDefault();

			var $this = $(this),
				$qty = $this.siblings('.qty'),
				current = 0,
				min = parseFloat($qty.attr('min')),
				max = parseFloat($qty.attr('max')),
				step = parseFloat($qty.attr('step'));

			if ($qty.val() !== '') {
				current = parseFloat($qty.val());
			} else if ($qty.attr('placeholder') !== '') {
				current = parseFloat($qty.attr('placeholder'))
			}

			min = min ? min : 0;
			max = max ? max : current + 1;

			if ($this.hasClass('decrease') && current > min) {
				$qty.val(current - step);
				$qty.trigger('change');
			}
			if ($this.hasClass('increase') && current < max) {
				$qty.val(current + step);
				$qty.trigger('change');
			}

		});

	};

	templaza_woo.updateQuantityAuto = function() {
		$( document.body ).on( 'change', 'table.cart .qty', function() {
			if (typeof templazaData.update_cart_page_auto !== undefined && templazaData.update_cart_page_auto == '1') {
				templaza_woo.$body.find('button[name="update_cart"]').attr( 'clicked', 'true' ).prop( 'disabled', false ).attr( 'aria-disabled', false );
				templaza_woo.$body.find('button[name="update_cart"]').trigger('click');
			}
		} );

		$( document.body ).on( 'change', '.woocommerce-mini-cart .qty', function() {
			templaza_woo.updateCartAJAX( this.value, this );
		} );
	}

	/**
	 * Cross sell products carousel.
	 */
	templaza_woo.crossSellProductsCarousel = function () {
		var $crossSells = $('.woocommerce .cross-sells');

		if (!$crossSells.length) {
			return;
		}

		var $products = $crossSells.find('ul.products');

		$products.wrap('<div class="swiper-container linked-products-carousel" style="opacity: 0;"></div>');
		$products.after('<div class="swiper-scrollbar"></div>');
		$products.addClass('swiper-wrapper');
		$products.find('li.product').addClass('swiper-slide');

		new Swiper($crossSells.find('.linked-products-carousel'), {
			loop: false,
			spaceBetween: 30,
			scrollbar: {
				el: $crossSells.find('.swiper-scrollbar'),
				hide: false,
				draggable: true
			},
			on: {
				init: function () {
					this.$el.css('opacity', 1);
				}
			},
			breakpoints: {
				300: {
					slidesPerView: templazaData.mobile_portrait,
					slidesPerGroup: templazaData.mobile_portrait,
					spaceBetween: 20,
				},
				480: {
					slidesPerView: templazaData.mobile_landscape,
					slidesPerGroup: templazaData.mobile_landscape,
				},
				768: {
					spaceBetween: 20,
					slidesPerView: 3,
					slidesPerGroup: 3
				},
				992: {
					slidesPerView: 3,
					slidesPerGroup: 3
				},
				1200: {
					slidesPerView: 4,
					slidesPerGroup: 4
				}
			}
		});
	};

	// add wishlist
	templaza_woo.addWishlist = function () {
		templaza_woo.$body.on('click', 'a.yith-wcwl-add-to-wishlist-button', function () {
			$(this).addClass('loading');
		});

		templaza_woo.$body.on('added_to_wishlist', function (e, $el_wrap) {
			e.preventDefault();
			$('ul.products li.product .yith-wcwl-add-button a').removeClass('loading');
		});
	};

	// Product loop hover
	templaza_woo.productLoopHover = function () {
		if (typeof templazaData.product_loop_layout === 'undefined') {
			return;
		}

		if (templazaData.product_loop_layout !== 'layout-8') {
			return;
		}


		var on_mobile = false;
		templaza_woo.$window.on('resize', function () {
			if (templaza_woo.$window.width() < 992) {
				on_mobile = true;
			} else {
				on_mobile = false;
			}
		}).trigger('resize');

		templaza_woo.$body.on('mouseover', '.product-inner', function () {

			if (on_mobile) {
				return;
			}

			if ($(this).hasClass('has-transform')) {
				return;
			}

			if ($(this).closest('ul.products').hasClass('shortcode-element')) {
				return;
			}


			var $product_bottom = $(this).find('.product-loop__buttons'),
				product_bottom_height = $product_bottom.outerHeight(),
				$product_summary = $(this).find('.product-summary');

			$(this).addClass('has-transform');
			$product_summary.css({
				'-webkit-transform': "translateY(-" + product_bottom_height + "px)",
				'transform': "translateY(-" + product_bottom_height + "px)"
			});

		});


		$(document.body).on('tawcvs_initialized', function (e, form) {
			if (form.hasClass('variations_form_loop') && $.fn.tooltip) {
				form.find('.swatch').tooltip({disabled: true});
			}
		});


	};

	// Product loop hover
	templaza_woo.productLoopFormAJAX = function () {
		if (typeof templazaData.product_loop_layout === 'undefined') {
			return;
		}

		if (typeof templazaData.product_loop_variation_ajax === 'undefined') {
			return;
		}

		if (templazaData.product_loop_layout !== 'layout-9') {
			return;
		}

		if (templazaData.product_loop_variation_ajax !== '1') {
			return;
		}

		templaza_woo.$body.on('click', '.product-quick-shop-button', function (e) {
			e.preventDefault();

			if ($(this).hasClass('has-content')) {
				return;
			}

			$(this).addClass('has-content');

			var $product_id = $(this).data('product_id'),
				$product_inner = $(this).closest('li.product').find('.product-inner'),
				$product_form = $(this).closest('li.product').find('.product-loop__form');

			$product_inner.addClass('loading');

			$.ajax({
				url: templazaData.ajax_url.toString().replace('%%endpoint%%', 'templaza_product_loop_form'),
				type: 'POST',
				data: {
					nonce: templazaData.nonce,
					product_id: $product_id
				},
				success: function (response) {
					if (!response || response.data === '') {
						return;
					}
					$product_form.prepend(response.data);

					var $variations = $product_form.find('.variations_form');

					if (typeof $.fn.wc_variation_form !== 'undefined') {
						$variations.each(function () {
							$(this).wc_variation_form();
						});
					}

					$( document.body ).trigger( 'init_variation_swatches');

					setTimeout(function () {
						$product_inner.removeClass('loading').addClass('show-variations_form');
					}, 400);

				}
			})

		});


	};

	templaza_woo.productLoopATCForm = function () {
		if (typeof templazaData.product_loop_variation === 'undefined') {
			return;
		}

		if (templazaData.product_loop_variation !== '1') {
			return;
		}

		templaza_woo.$body.on('click', '.product-close-variations-form', function (e) {
			e.preventDefault();
			$(this).closest('.product-inner').removeClass('show-variations_form');
		});

		templaza_woo.$body.on('click', '.product-quick-shop-button', function (e) {
			e.preventDefault();

			if (typeof templazaData.product_loop_variation_ajax === 'undefined') {
				$(this).closest('.product-inner').addClass('show-variations_form');
			} else if ($(this).hasClass('has-content')) {
				$(this).closest('.product-inner').addClass('show-variations_form');
			}

		});

		templaza_woo.$body.on('click', 'a.product_type_variable', function (e) {
			e.preventDefault();
			$(this).closest('li.product').find('.variations_form .single_add_to_cart_button').trigger('click');
		});

		templaza_woo.$body.on('click', 'li.product .variations_form .single_add_to_cart_button', function (e) {
			e.preventDefault();
			var $this = $(this),
				$cartForm = $this.closest('.variations_form'),
				$cartButtonLoading = $this.closest('li.product').find('a.product_type_variable');

			if ($(this).is('.disabled')) {
				return;
			}

			templaza_woo.addToCartFormAJAX($this, $cartForm, $cartButtonLoading);

			return false;
		});
	};

	templaza_woo.addToCartSingleAjax = function () {

		var $selector = $('div.product, .templaza-sticky-add-to-cart');

		if ($selector.length < 1) {
			return;
		}

		if (!$selector.hasClass('product-add-to-cart-ajax')) {
			return;
		}

		$selector.find('form.cart').on('click', '.single_add_to_cart_button', function (e) {
			var $el = $(this),
				$cartForm = $el.closest('form.cart');

			if ($el.closest('.product').hasClass('product-type-external')) {
				return;
			}

			if ($cartForm.hasClass('buy-now-clicked')) {
				return;
			}

			if ($el.is('.disabled')) {
				return;
			}

			if ($cartForm.length > 0) {
				e.preventDefault();
			} else {
				return;
			}


			templaza_woo.addToCartFormAJAX($el, $cartForm, $el);
		});

	};

	templaza_woo.addToCartFormAJAX = function ($cartButton, $cartForm, $cartButtonLoading) {

		if ($cartButton.data('requestRunning')) {
			return;
		}

		$cartButton.data('requestRunning', true);

		var found = false;

		$cartButtonLoading.addClass('loading');
		if (found) {
			return;
		}
		found = true;

		var formData = $cartForm.serializeArray(),
			formAction = $cartForm.attr('action');

		if ($cartButton.val() != '') {
			formData.push({name: $cartButton.attr('name'), value: $cartButton.val()});
		}

		$(document.body).trigger('adding_to_cart', [$cartButton, formData]);

		$.ajax({
			url: formAction,
			method: 'post',
			data: formData,
			error: function (response) {
				window.location = formAction;
			},
			success: function (response) {
				if (!response) {
					window.location = formAction;
				}

				if (typeof wc_add_to_cart_params !== 'undefined') {
					if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {
						window.location = wc_add_to_cart_params.cart_url;
						return;
					}
				}

				var $message = '',
					className = 'info';
				if ($(response).find('.woocommerce-message').length > 0) {
					$(document.body).trigger('wc_fragment_refresh');
				} else {
					if (!$.fn.notify) {
						return;
					}

					var $checkIcon = '<span class="templaza-svg-icon message-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg></span>',
						$closeIcon = '<span class="templaza-svg-icon svg-active"><svg class="svg-icon" aria-hidden="true" role="img" focusable="false" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 1L1 14M1 1L14 14" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>';

					if ($(response).find('.woocommerce-error').length > 0) {
						$message = $(response).find('.woocommerce-error').html();
						className = 'error';
						$checkIcon = '<span class="templaza-svg-icon message-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg></span>';
					} else if ($(response).find('.woocommerce-info').length > 0) {
						$message = $(response).find('.woocommerce-info').html();
					}

					$.notify.addStyle('templaza', {
						html: '<div>' + $checkIcon + '<ul class="message-box">' + $message + '</ul>' + $closeIcon + '</div>'
					});

					$.notify('&nbsp', {
						autoHideDelay: 5000,
						className: className,
						style: 'templaza',
						showAnimation: 'fadeIn',
						hideAnimation: 'fadeOut'
					});
				}
				$cartButton.data('requestRunning', false);
				$cartButton.removeClass('loading');
				$cartButtonLoading.removeClass('loading');
				found = false;

			}
		});
	};

	templaza_woo.productLoopHoverSlider = function () {

		var $selector = templaza_woo.$body.find('ul.products .product-thumbnails--slider'),
			options = {
				loop: false,
				autoplay: false,
				speed: 800,
				watchOverflow: true,
				lazy: true,
				breakpoints: {}
			};

		$selector.find('.woocommerce-loop-product__link').addClass('swiper-slide');

		templaza_woo.$body.find('ul.products').imagesLoaded(function () {
			setTimeout(function () {
				$selector.each(function () {
					options.navigation = {
						nextEl: $(this).find('.templaza-product-loop-swiper-next'),
						prevEl: $(this).find('.templaza-product-loop-swiper-prev'),
					}
					new Swiper($(this), options);
				});
			}, 200);
		});

	};

	/**
	 * Product thumbnail zoom.
	 */
	templaza_woo.productLoopHoverZoom = function () {
		if (typeof templazaData.product_loop_hover === 'undefined' || !$.fn.zoom) {
			return;
		}

		if (templazaData.product_loop_hover !== 'zoom') {
			return;
		}

		var $seletor = templaza_woo.$body.find('ul.products .product-thumbnail-zoom');
		$seletor.each(function () {
			var $el = $(this);

			$el.zoom({
				url: $el.attr('data-zoom_image')
			});
		});
	};


	/**
	 * Quick view modal.
	 */
	templaza_woo.productQuickView = function () {
		$(document.body).on('click', '.quick-view-button', function (event) {
			event.preventDefault();

			var $el = $(this),
				product_id = $el.data('id'),
				$target = $('#quick-view-modal'),
				$container = $target.find('.woocommerce'),
				ajax_url = templazaData.ajax_url.toString().replace('%%endpoint%%', 'product_quick_view');
			$target.addClass('loading').removeClass('loaded');
			$container.find('.product').html('');

			$.post(
				ajax_url,
				{
					action: 'templaza_get_product_quickview',
					product_id: product_id,
				},
				function (response) {
					$container.find('.product').replaceWith(response.data);

					if (response.success) {
						update_quickview();
					}

					$target.removeClass('loading').addClass('loaded');
					templaza_woo.productQuantityDropdown();
					templaza_woo.addToCartSingleAjax();
					templaza_woo.$body.trigger('templaza_product_quick_view_loaded');

					if ($container.find('.deal-expire-countdown').length > 0) {
						$(document.body).trigger('templaza_countdown', [$('.deal-expire-countdown')]);
					}
					$container.find('.single_add_to_cart_button').wrapInner( "<span></span>");
				}
			).fail(function () {
				// window.location.href = $el.attr('href');
			});

			/**
			 * Update quick view common elements.
			 */
			function update_quickview() {
				var $product = $container.find('.product'),
					$gallery = $product.find('.woocommerce-product-gallery'),
					$variations = $product.find('.variations_form');

				// Prevent clicking on gallery image link.
				$gallery.on('click', '.woocommerce-product-gallery__image a', function (event) {
					event.preventDefault();
				});

				$gallery.removeAttr('style');

				if ($gallery.find('.woocommerce-product-gallery__wrapper').children().length > 1) {
					$gallery.addClass('swiper-container');
					$gallery.find('.woocommerce-product-gallery__wrapper').addClass('swiper-wrapper');
					$gallery.find('.woocommerce-product-gallery__image').addClass('swiper-slide');
					$gallery.after('<span class="templaza-svg-icon templaza-quickview-button-prev templaza-swiper-button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg></span>');
					$gallery.after('<span class="templaza-svg-icon templaza-quickview-button-next templaza-swiper-button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg></span>');

					var options = {
						loop: false,
						autoplay: false,
						speed: 800,
						watchOverflow: true,
						navigation: {
							nextEl: '.templaza-quickview-button-next',
							prevEl: '.templaza-quickview-button-prev',
						},
						on: {
							init: function () {
								$gallery.css('opacity', 1);
							}
						},
					};

					$gallery.imagesLoaded(function () {
						new Swiper($gallery, options);
					});
				}

				if (typeof wc_add_to_cart_variation_params !== 'undefined') {

					$variations.each(function () {
						$(this).wc_variation_form();
					});
				}

				$( document.body ).trigger( 'init_variation_swatches');

			}
		});
	};

	templaza_woo.productLoaded = function () {
		templaza_woo.$body.on('templaza_products_loaded', function (e, $content) {

			var $variations = $content.find('.variations_form');

			if (typeof $.fn.wc_variation_form !== 'undefined') {
				$variations.each(function () {
					$(this).wc_variation_form();
				});
			}

			$( document.body ).trigger( 'init_variation_swatches');

			templaza_woo.productLoopHoverSlider();
			templaza_woo.productLoopHoverZoom();
			$(document).trigger( 'yith_wcwl_reload_fragments' );
		});
	};

	templaza_woo.accountOrder = function () {
		if (!templaza_woo.$body.hasClass('woocommerce-account')) {
			return;
		}

		$('.woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link > a').append('<span class="templaza-svg-icon "><svg class="svg-icon" aria-hidden="true" role="img" focusable="false" width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.50495 4.82011L0.205241 1.04856C-0.0684137 0.808646 -0.0684137 0.419663 0.205241 0.179864C0.478652 -0.0599547 0.922098 -0.0599547 1.19549 0.179864L5.00007 3.5171L8.80452 0.179961C9.07805 -0.0598577 9.52145 -0.0598577 9.79486 0.179961C10.0684 0.41978 10.0684 0.808743 9.79486 1.04866L5.49508 4.8202C5.35831 4.94011 5.17925 5 5.00009 5C4.82085 5 4.64165 4.94 4.50495 4.82011Z"/></svg></span>');

		$('table.my_account_orders').on('click', '.item-plus', function () {
			$(this).closest('ul').find('li').show();

			$(this).closest('ul').find('.item-plus').hide();
		});
	};

	/**
	 * Toggle register/login form in the login panel.
	 */
	templaza_woo.loginPanel = function () {
		$(document.body)
			.on('click', '#account-modal .create-account', function (event) {
				event.preventDefault();

				$(this).closest('form.login').fadeOut(function () {
					$(this).next('form.register').fadeIn();
				});
			}).on('click', '#account-modal a.login', function (event) {
			event.preventDefault();

			$(this).closest('form.register').fadeOut(function () {
				$(this).prev('form.login').fadeIn();
			});
		});
	};

	/**
	 * Ajax login before refresh page
	 */
	templaza_woo.loginPanelAuthenticate = function () {
		$('#account-modal').on('submit', 'form.login', function authenticate(event) {
			var username = $('input[name=username]', this).val(),
				password = $('input[name=password]', this).val(),
				remember = $('input[name=rememberme]', this).is(':checked'),
				nonce = $('input[name=woocommerce-login-nonce]', this).val(),
				$button = $('[type=submit]', this),
				$form = $(this),
				$box = $form.next('.woocommerce-error');

			if (!username) {
				$('input[name=username]', this).focus();

				return false;
			}

			if (!password) {
				$('input[name=password]', this).focus();

				return false;
			}

			$form.find('.woocommerce-error').remove();
			$button.html('<span class="templaza-button templaza-loading"></span>');

			if ($box.length) {
				$box.fadeOut();
			}

			var ajax_url = templazaData.ajax_url.toString().replace('%%endpoint%%', 'templaza_login_authenticate');

			$.post(
				ajax_url,
				{
					security: nonce,
					username: username,
					password: password,
					remember: remember
				},
				function (response) {
					if (!response.success) {
						if (!$box.length) {
							$box = $('<div class="woocommerce-error" role="alert"/>');

							$box.append('<ul class="error-message" />')
								.append('<span class="templaza-svg-icon svg-icon icon-close size-normal close-message"><svg class="svg-icon" aria-hidden="true" role="img" focusable="false" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 1L1 14M1 1L14 14" stroke="#ffffff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>');

							$box.hide().prependTo($form);
						}

						$box.find('.error-message').html('<li>' + response.data + '</li>');
						$box.fadeIn();
						$button.html($button.attr('value'));
					} else {
						$button.html($button.data('signed'));
						window.location.reload();
					}
				}
			);

			event.preventDefault();
		}).on('click', '.woocommerce-error .close-message', function () {
			// Remove the error message to fix the layout issue.
			$(this).closest('.woocommerce-error').fadeOut(function () {
				$(this).remove();
			});

			return false;
		});
	};

	/**
	 * Open product image lightbox when click on the zoom image
	 */
	templaza_woo.productLightBox = function () {
		if (typeof wc_single_product_params === 'undefined' || wc_single_product_params.photoswipe_enabled !== '1') {
			$('.woocommerce-product-gallery').on('click', '.woocommerce-product-gallery__image', function (e) {
				e.preventDefault();
			});
			return false;
		}

		$('.woocommerce-product-gallery').on('click', '.zoomImg', function () {
			if (wc_single_product_params.flexslider_enabled) {
				$(this).closest('.woocommerce-product-gallery').children('.woocommerce-product-gallery__trigger').trigger('click');
			} else {
				$(this).prev('a').trigger('click');
			}
		});
	};

	/**
	 * Handle product reviews
	 */
	templaza_woo.reviewProduct = function () {
		setTimeout(function () {
			$('#respond p.stars a').prepend('<span class="templaza-svg-icon "><i class="fas fa-star"></i></span>');
		}, 100);
	};

	/**
	 * Open Mini Cart
	 */
	templaza_woo.openMiniCartPanel = function () {
		if (typeof templazaData.added_to_cart_notice === 'undefined') {
			return;
		}

		if (templazaData.added_to_cart_notice.added_to_cart_notice_layout !== 'panel') {
			return;
		}

		var product_title = '1';
		$(document.body).on('adding_to_cart', function (event, $thisbutton) {
			product_title = '';
		});

		$(document.body)
			.on('added_to_cart wc_fragments_refreshed', function () {
				if (product_title !== '1') {
					templaza_woo.openModal('#cart-modal');
				}
			});

	};

	templaza_woo.addedToCartNotice = function () {

		if (typeof templazaData.added_to_cart_notice === 'undefined' || !$.fn.notify) {
			return;
		}

		if (templazaData.added_to_cart_notice.added_to_cart_notice_layout != 'simple') {
			return;
		}

		var product_title = '1';
		$(document.body).on('adding_to_cart', function (event, $thisbutton) {
			product_title = '';
			if (typeof $thisbutton.data('title') !== 'undefined') {
				product_title = $thisbutton.data('title');
			}

			product_title = typeof(product_title) === 'undefined' ? '' : product_title;
			if (product_title === '') {
				if ($thisbutton.closest('form.cart').not('.grouped_form').length) {
					product_title = $thisbutton.closest('form.cart').find('.templaza_product_id').data('title');
				}
			}

		});

		$(document.body).on('added_to_cart', function () {
			if (product_title !== '1') {
				getaddedToCartNotice(product_title);
			}
		});

		$(document.body).on('wc_fragment_refresh', function () {
			if (product_title !== '1') {
				getaddedToCartNotice(product_title);
			}

		});

		function getaddedToCartNotice($content) {

			if ($content) {
				$content += ' ' + templazaData.added_to_cart_notice.added_to_cart_text;
			} else {
				$content = templazaData.added_to_cart_notice.successfully_added_to_cart_text;
			}

			$content += '<a href="' + templazaData.added_to_cart_notice.cart_view_link + '" class="btn-button">' + templazaData.added_to_cart_notice.cart_view_text + '</a>';

			var $checkIcon = '<span class="templaza-svg-icon message-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></span>',
				$closeIcon = '<span class="templaza-svg-icon svg-active"><svg class="svg-icon" aria-hidden="true" role="img" focusable="false" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 1L1 14M1 1L14 14" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>';

			$.notify.addStyle('templaza', {
				html: '<div>' + $checkIcon + $content + $closeIcon + '</div>'
			});

			$.notify('&nbsp', {
				autoHideDelay: templazaData.added_to_cart_notice.cart_notice_auto_hide,
				className: 'success',
				style: 'templaza',
				showAnimation: 'fadeIn',
				hideAnimation: 'fadeOut'
			});
		}
	};


	/**
	 * Toggle product popup add to cart
	 */
	templaza_woo.productPopupATC = function () {

		if (typeof templazaData.added_to_cart_notice === 'undefined') {
			return;
		}

		if (templazaData.added_to_cart_notice.added_to_cart_notice_layout != 'popup') {
			return;
		}

		var $modal = $('#templaza-popup-add-to-cart'),
			$product = $modal.find('.product-modal-content'),
			$recomended = $product.find('.templaza-product-popup-atc__recommendation');

		if ($modal.length < 1) {
			return
		}

		var $product_item_id = 0,
			$product_id = 0;
		$(document.body).on('adding_to_cart', function (event, $thisbutton) {
			$product_item_id = $product_id = 0;
			if (typeof $thisbutton.data('product_id') !== 'undefined') {
				$product_id = $thisbutton.data('product_id');
				$product_item_id = '0,' + $product_id;
			}

			$product_id = typeof($product_id) === 'undefined' ? 0 : $product_id;

			if ($product_id === 0 && $thisbutton.closest('form.cart').length) {
				var $cartForm = $thisbutton.closest('form.cart');
				$product_id = $cartForm.find('.templaza_product_id').val();

				$product_item_id = $product_id;

				if ($cartForm.hasClass('variations_form') && $cartForm.find('.single_variation_wrap .variation_id').length > 0) {
					$product_item_id = $cartForm.find('.single_variation_wrap .variation_id').val();
				}

				if ($cartForm.hasClass('grouped_form')) {
					$product_item_id = 0;
					$cartForm.find('.woocommerce-grouped-product-list-item').each(function () {
						if ($(this).find('.quantity .input-text').val() > 0) {
							var $id = $(this).attr('id');
							$id = $id.replace('product-', '');
							$product_item_id += ',' + $id;
						}
					});
				}
			}

		});

		$(document.body).on('wc_fragments_loaded', function () {
			if ($product_item_id && $product_id) {
				getProductPopupContent($product_id, $product_item_id);
				$product_item_id = 0;
				$product_id = 0;
			}
		});

		$(document.body).on('wc_fragments_refreshed', function () {
			if ($product_item_id && $product_id) {
				getProductPopupContent($product_id, $product_item_id);
				$product_item_id = 0;
				$product_id = 0;
			}

		});

		function getProductPopupContent($product_id, $product_item_id) {
			var $item_ids = $product_item_id.split(',');

			for (var i = 0; i < $item_ids.length; ++i) {
				$modal.find('.mini-cart-item-' + $item_ids[i]).addClass('active');
			}
			$modal.find('.woocommerce-mini-cart-item').not('.active').remove();
			$modal.find('.woocommerce-mini-cart-item').find('.woocommerce-cart-item__qty, .remove_from_cart_button').remove();

			templaza_woo.openModal($modal);
			$modal.addClass('loaded');
			if (!$recomended.hasClass('loaded')) {
				$recomended.removeClass('active').removeClass('hidden').addClass('loading');
				$.ajax({
					url: templazaData.ajax_url.toString().replace('%%endpoint%%', 'templaza_product_popup_recommended'),
					type: 'POST',
					data: {
						nonce: templazaData.nonce,
						product_id: $product_id
					},
					success: function (response) {
						if (!response || response.data === '') {
							$recomended.addClass('hidden');
							return;
						}
						$recomended.html(response.data);
						productsCarousel($recomended);
						$recomended.addClass('active');

					}
				})
			} else {
				if (!$recomended.hasClass('has-carousel')) {
					productsCarousel($recomended);
					$recomended.addClass('has-carousel');
				}
			}

		}

		function productsCarousel($selector) {

			if ($selector.length < 1) {
				return;
			}

			var $products = $selector.find('ul.product-items');

			if ($products.length < 1) {
				return;
			}

			$products.find('li.product-item').addClass('swiper-slide');
			$products.after('<div class="swiper-pagination"></div>');
			new Swiper($selector.find('.recommendation-products-carousel'), {
				loop: false,
				spaceBetween: 20,
				watchOverflow: true,
				navigation: {
					nextEl: $selector.find('.templaza-swiper-button-next'),
					prevEl: $selector.find('.templaza-swiper-button-prev'),
				},
				pagination: {
					el: $selector.find('.swiper-pagination'),
					clickable: true
				},
				on: {
					init: function () {
						this.$el.css('opacity', 1);
					}
				},
				breakpoints: {
					300: {
						slidesPerView: templazaData.mobile_portrait,
						slidesPerGroup: templazaData.mobile_portrait,
						spaceBetween: 20,
					},
					480: {
						slidesPerView: templazaData.mobile_landscape,
						slidesPerGroup: templazaData.mobile_landscape,
					},
					768: {
						spaceBetween: 20,
						slidesPerView: 3,
						slidesPerGroup: 3
					},
					992: {
						slidesPerView: 3,
						slidesPerGroup: 3
					},
					1200: {
						slidesPerView: 4,
						slidesPerGroup: 4
					}
				}
			});

		};

	};

	templaza_woo.addedToWishlistNotice = function () {
		if (typeof templazaData.added_to_wishlist_notice === 'undefined' || !$.fn.notify) {
			return;
		}

		templaza_woo.$body.on('added_to_wishlist', function (e, $el_wrap) {
			var content = $el_wrap.attr('data-product-title');
			getaddedToWishlistNotice(content);
		});

		function getaddedToWishlistNotice($content) {

			$content += ' ' + templazaData.added_to_wishlist_notice.added_to_wishlist_text;

			$content += '<a href="' + templazaData.added_to_wishlist_notice.wishlist_view_link + '" class="btn-button">' + templazaData.added_to_wishlist_notice.wishlist_view_text + '</a>';


			var $checkIcon = '<span class="templaza-svg-icon message-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></span>',
				$closeIcon = '<span class="templaza-svg-icon svg-active"><svg class="svg-icon" aria-hidden="true" role="img" focusable="false" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 1L1 14M1 1L14 14" stroke="#A0A0A0" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>';

			$.notify.addStyle('templaza', {
				html: '<div>' + $checkIcon + $content + $closeIcon + '</div>'
			});
			$.notify('&nbsp', {
				autoHideDelay: templazaData.added_to_wishlist_notice.wishlist_notice_auto_hide,
				className: 'success',
				style: 'templaza',
				showAnimation: 'fadeIn',
				hideAnimation: 'fadeOut'
			});
		}
	}

	// Recently Viewed Products
	templaza_woo.recentlyViewedProducts = function () {

		var $recently = $('#templaza-history-products');

		if ($recently.length < 1) {
			return;
		}

		if ($recently.hasClass('loaded')) {
			return;
		}

		if ($recently.hasClass('no-ajax')) {
			recentlyViewedProductsCarousel();
			hoverInforProduct();

			return;
		}

		templaza_woo.$window.on('scroll', function () {
			if (templaza_woo.$body.find('#templaza-history-products').is(':in-viewport')) {
				loadProductsAJAX();
			}
		}).trigger('scroll');

		function loadProductsAJAX() {
			if ($recently.hasClass('loaded')) {
				return;
			}
			if ($recently.data('requestRunning')) {
				return;
			}

			$recently.data('requestRunning', true);

			var ajax_url = templazaData.ajax_url.toString().replace('%%endpoint%%', 'templaza_get_recently_viewed');
			$.post(
				ajax_url,
				function (response) {

					$recently.find('.recently-products ').html(response.data);
					if ($recently.find('.product-list').hasClass('no-products')) {
						$recently.addClass('no-products');
					}
					recentlyViewedProductsCarousel();
					hoverInforProduct();
					$recently.addClass('loaded');
					$recently.data('requestRunning', false);
					templaza_woo.$body.trigger('templaza_products_loaded', [$recently, false]);
				}
			);
		}

		function hoverInforProduct() {
			var $product = $recently.find('.product');

			$product.on('mousemove', function (e) {
				var el = $(this),
					left = e.pageX - el.offset().left + 10,
					right = left - el.find('.product-infor').outerWidth(),
					top = e.pageY - el.offset().top + 10;

				if( el.is(':last-child') ) {
					el.find('.product-infor')
					.show()
					.css({left: right, top: top});
				} else {
					el.find('.product-infor')
					.show()
					.css({left: left, top: top});
				}

			}).on('mouseout', function () {
				$(this).find('.product-infor').hide();
			});
		}

		function recentlyViewedProductsCarousel() {
			var $related = $('#templaza-history-products'),
				$products = $related.find('.products'),
				$col = $related.data('col');

			if (!$related.length) {
				return;
			}

			$col = $col ? $col : 4;

			$products.wrap('<div class="swiper-container history-products-carousel"></div>');
			$products.after('<div class="swiper-scrollbar"></div>');
			$products.addClass('swiper-wrapper');
			$products.find('.product').addClass('swiper-slide');

			new Swiper($related.find('.history-products-carousel'), {
				loop: false,
				scrollbar: {
					el: $related.find('.swiper-scrollbar'),
					hide: false,
					draggable: true
				},
				on: {
					init: function () {
						if ($related.hasClass('no-ajax')) {
							$related.find('.recently-products').css('opacity', 1);
						}
					}
				},
				speed: 1000,
				spaceBetween: 30,
				breakpoints: {
					300: {
						slidesPerView: templazaData.mobile_portrait == '' ? 2 : templazaData.mobile_portrait,
						slidesPerGroup: templazaData.mobile_portrait == '' ? 2 : templazaData.mobile_portrait,
						spaceBetween: 15,
					},
					480: {
						slidesPerView: templazaData.mobile_landscape == '' ? 3 : templazaData.mobile_landscape,
						slidesPerGroup: templazaData.mobile_landscape == '' ? 3 : templazaData.mobile_landscape,
						spaceBetween: 15,
					},
					768: {
						spaceBetween: 20,
						slidesPerView: 3,
						slidesPerGroup: 3
					},
					992: {
						slidesPerView: 4,
						slidesPerGroup: 4
					},
					1200: {
						slidesPerView: $col,
						slidesPerGroup: $col
					}
				}
			});
		}
	};

	// Scroll Section
	templaza_woo.scrollSection = function () {
		var baseURI = $('#templaza-base-url').data('url');
		$('#primary-menu').on('click', 'a', function (e) {
			e.preventDefault();
			var currentHref = $(this).attr('href'),
				target = this.hash;

			if (target == '') {
				window.location.href = currentHref;
				return false;
			} else if ( target !== '' && $(target).length < 1)  {
				window.location.href = baseURI + target;
				return false;
			}
		});

	};

	/**
	 * Init sticky cart form.
	 *
	 * @todo Support bundled products.
	 */
	 templaza_woo.stickyAddToCart = function() {
		var $sticky = $( '#templaza-sticky-add-to-cart' );

		$sticky = ! $sticky.length ? $( '#templaza-navigation-bar' ) : $sticky;

		if ( ! $sticky.length ) {
			return;
		}

		var $forms = $( 'form.cart', $sticky.closest( '.single-product' ) ),
			$image = $sticky.find( '.templaza-sticky-atc__product-image img' ),
			$price = $sticky.find( '.templaza-sticky-add-to-cart__content-price' ),
			doingSync = false;

		// Handle add-to-cart variations of 2 forms.
		$forms
			.on( 'reset_data', function() {
				$image.attr( 'src', $image.data( 'o_src' ) );
				$price.show().siblings( '.variation-price, .stock' ).remove();
			} )
			.on( 'found_variation', function( event, variation ) {
				if ( variation.image && variation.image.gallery_thumbnail_src && variation.image.gallery_thumbnail_src.length > 1 ) {
					$image.attr( 'src', variation.image.gallery_thumbnail_src );
				}

				if ( variation.availability_html && variation.availability_html.length ) {
					$price.hide().siblings( '.stock, .variation-price' ).remove();
					$price.after( variation.availability_html );
				} else {
					$price.siblings( '.stock' ).remove();

					if ( variation.price_html && variation.price_html.length ) {
						$price.hide().siblings( '.variation-price' ).remove();
						$price.after( $( variation.price_html ).addClass( 'variation-price' ) );
					}
				}
			} )
			// Sync inputs' value.
			.on( 'change', ':input', function() {
				// Avoid infinite loop.

				if ( doingSync ) {
					return;
				}

				doingSync = true;

				var $currentForm = $( this ).closest( 'form.cart' ),
					$targetForm = $forms.not( $currentForm );


				$targetForm.find( ':input[name="' + this.name + '"]' ).val( this.value ).trigger( 'change' );

				if( ! templaza_woo.$body.hasClass('product-qty-number') ) {
					$targetForm.find( ':input[name="' + this.name + '"]' ).siblings('.qty-dropdown').find('.current .value').html(this.value);
				}

				doingSync = false;
			} );

	}

	/**
	 * Document ready
	 */
	$(function () {
		templaza_woo.init();
	});

})(jQuery);