
/**
 * Override Background Redux field
 * Feature added by    : DuongTVTemplaza
 */
(function( $ ) {
	'use strict';

	redux.field_objects.spacing.templaza_methods = redux.field_objects.spacing.templaza_methods || {};

	var tzfrm_org_redux_field_spacing = redux.field_objects.spacing.init;

	redux.field_objects.spacing.init = function( selector ) {

		tzfrm_org_redux_field_spacing(selector);

		selector = $.redux.getSelector( selector, 'spacing' );
		// console.log($(selector));
		$(selector).each(function () {
			var el = $(this);

			if(typeof el.find("> [data-responsive]") !== "undefined" && el.find("> [data-responsive]").length) {
				var __responsive_main = el.find("> [data-responsive]"),
					__device_main = __responsive_main.data("field-device");

				var switch_lock_icon = function(device){
					var __spacing_lock	= el.find(".spacing-lock"),
						__device_btn = el.find("[data-uk-switcher] a[data-field-device="+ device +"],[uk-switcher] a[data-field-device="+ device +"]"),
						__locked = __device_btn.data("locked");

					var __spacing_input = el.find(".redux-spacing-value.js-device-" + device),
						__spacing_val_count = 0;

					__spacing_input.each(function(){
						if($(this).val().trim().length){
							__spacing_val_count++;
						}
					});

					if((typeof  __locked !== "undefined" && !__locked) || (__spacing_val_count > 0 && __spacing_val_count < __spacing_input.length)){
						__spacing_lock.removeClass("locked")
							.find("i").removeClass("dashicons-lock").addClass("dashicons-unlock");
					}else{
						__spacing_lock.addClass("locked")
							.find("i").removeClass("dashicons-unlock").addClass("dashicons-lock");
					}
				};

				switch_lock_icon(__device_main);

				el.find(".redux-spacing-units").val(el.find(".field-units.js-device-" + __responsive_main.data("field-device")).val());
				el.find('.redux-spacing-units').off("change").select2().on(
					'change',
					function () {
						var __device = __responsive_main.data("field-device");

						$(this).parents('.redux-field:first').find('.redux-spacing-input').change();

						el.find(".field-units.js-device-" + __device).val($(this).val());
					}
				);
				el.find("[data-uk-switcher] a,[uk-switcher] a").on("click", function (event) {
					var __uk_item = $(this),
						__device = __uk_item.attr("data-field-device"),
						__unit_item = el.find(".field-units.js-device-" + __device);

					__responsive_main.data("field-device", __device);

					switch_lock_icon(__device);

					el.find(".redux-spacing-value.js-device-" + __device).each(function(){
						var __spacing_value = $(this).val(),
							__unit_value = el.find(".field-units.js-device-" + __device).val();
						el.find(".redux-spacing-input[rel=" + $(this).attr("id") + "]").val(__spacing_value.replace(__unit_value, ""));
					});

					el.find(".redux-spacing-units").val(__unit_item.val()).trigger("change");

				});

				el.find(".redux-spacing-input").off("change").on("change",function(){
					var __spacing_value = $(this).val(),
						__device = __responsive_main.data("field-device");

					var value;

					var units = $( this ).parents( '.redux-field:first' ).find( '.field-units' ).val();

					if ( 0 !== $( this ).parents( '.redux-field:first' ).find( '.redux-spacing-units' ).length ) {
						units = $( this ).parents( '.redux-field:first' ).find( '.redux-spacing-units option:selected' ).val();
					}

					value = $( this ).val();

					if ( 'undefined' !== typeof units && value ) {
						value += units;
					}

					// if ( $( this ).hasClass( 'redux-spacing-all' ) ) {
					// 	$( this ).parents( '.redux-field:first' ).find( '.redux-spacing-value' ).each(
					// 		function() {
					// 			$( this ).val( value );
					// 		}
					// 	);
					// } else {
						$( '#' + $( this ).attr( 'rel' ) + ".js-device-" + __device ).val( value );
					// }
				});

				el.off("click").on("click",".spacing-lock", function (e) {
					var __device = __responsive_main.data("field-device"),
						__device_btn = el.find("[data-uk-switcher] a[data-field-device="+ __device +"],[uk-switcher] a[data-field-device="+ __device +"]");

					if ($(this).hasClass("locked")) {
						__device_btn.data("locked", false);
						$(this).removeClass('locked').find("i").removeClass("dashicons-lock").addClass("dashicons-unlock");
					} else {
						__device_btn.data("locked", true);
						$(this).addClass('locked').find('i').removeClass("dashicons-unlock").addClass('dashicons-lock');
					}
				});

				el.on("input",".redux-spacing-input", function (e) {
					if(el.find(".spacing-lock").hasClass("locked")){
						// var __device	= __responsive_main.data("field-device");
						el.find(".redux-spacing-input").not($(this)).val($(this).val()).trigger("change");
					}
				});
			}

			if($(selector).closest(".tzfrm-ui-dialog,.uk-modal").length){
				// if(typeof el.find("> [data-responsive]") !== "undefined" && el.find("> [data-responsive]").length){
				// 	var __responsive_main = el.find("> [data-responsive]"),
				// 	__device = __responsive_main.data("field-device");
				// 	if(!el.find(".field-units").val() && __device){
				// 		// el.find( '.redux-spacing-input' ).val()
				// 	}
				// 	console.log(__device);
				// 	console.log(__device);
				// 	console.log(!el.find(".field-units").val());
				// }
				// // $(selector).each(function () {
				// // 	var el     = $( this );
				//
				// 	var _spacing_unit	= el.find(".field-units").val();
				// 	el.find(".redux-spacing-units").val(_spacing_unit);
				//
				// 	el.find( '.redux-spacing-input' ).each(function(){
				// 		var	_spacing_value = $( '#' + $( this ).attr( 'rel' ) ).val();
				// 		_spacing_value	= _spacing_value.replace(_spacing_unit, "");
				//
				// 		$(this).val(_spacing_value);
				// 	});
				// // });
			}
		});
	};
	redux.field_objects.spacing.templaza_methods.setting_edit_after_init_field = function(selector, parent, element){
		var __uk_item = $(this),
			__el	= $(selector),
			__responsive_main = $(selector).find("[data-responsive]"),
			__device = __responsive_main.attr("data-field-device"),
			__unit_item = __el.find(".field-units.js-device-" + __device);

		__responsive_main.data("field-device", __device);

		__el.find(".redux-spacing-value.js-device-" + __device).each(function(){
			var __spacing_value = $(this).val(),
				__unit_value = __el.find(".field-units.js-device-" + __device).val();
			__el.find(".redux-spacing-input[rel=" + $(this).attr("id") + "]").val(__spacing_value.replace(__unit_value, ""));
		});

		__el.find(".redux-spacing-units").val(__unit_item.val()).trigger("change");

	};
})( jQuery );
