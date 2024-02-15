/*global redux_change, redux */

/**
 * Override Color RGBA redux field
 * Dependencies:        google.com, jquery, select2
 * Feature added by:    Dovy Paukstys - http://simplerain.com/
 * Date:                06.14.2013
 *
 * Rewrite:             Kevin Provance (kprovance)
 * Date:                May 25, 2014
 * And again on:        April 4, 2017 for v4.0
 */
(function( $ ) {
	'use strict';

	redux.field_objects.color_rgba.templaza_methods = redux.field_objects.color_rgba.templaza_methods || {};

	redux.field_objects.color_rgba.templaza_methods.field_repeater_init_value	= function(field, value){
		var _f_name	= field.attr("data-id");

		if(typeof value[_f_name] === "object"){
			if(typeof value[_f_name]["alpha"] !== "undefined"
				&& value[_f_name]["alpha"] != 1){
				field.find("input.redux-color-rgba").data("color", value[_f_name]["rgba"]);
				field.find("input.redux-color-rgba").data("current-color", value[_f_name]["color"]);
			}else{
				field.find("input.redux-color-rgba").data("color", value[_f_name]["color"]);
				field.find("input.redux-color-rgba").data("current-color", value[_f_name]["color"]);
			}
		}
	}

	var org_redux_field_color_rgba__init	 = redux.field_objects.color_rgba.init;

	redux.field_objects.color_rgba.init	= function(selector){

		org_redux_field_color_rgba__init(selector);

		selector = $.redux.getSelector( selector, 'color_rgba' );

		$(selector).each(function () {
			var el = $(this);
			var __colorpickerInput = el.find("input.redux-color-rgba");
			var __globalInput = el.find(".redux-hidden-_global");

			// Init global color if option use it
			if(__globalInput.length && __globalInput.val().length) {
				// var __globalColor	= __globalInput.data("color");
				var __globalColor	= el.find("[data-tzfrm-global-color] li.uk-active [data-tzfrm-global-color-theme]")
					.data("tzfrm-global-color-theme");

				if(typeof __globalColor === "object" && Object.keys(__globalColor).length){
					if (__colorpickerInput.length) {
						if(typeof __globalColor["color"]["rgba"] !== "undefined"
							&& __globalColor["color"]["alpha"] !== 1) {
							__colorpickerInput.spectrum("set", __globalColor["color"]["rgba"]);
						}else{
							__colorpickerInput.spectrum("set", __globalColor["color"]["color"]);
						}
					}
				}else if(typeof __globalColor !== "undefined" && __globalColor.length){
					__colorpickerInput.spectrum("set", __globalColor);
				}
				el.find("[uk-dropdown],[data-uk-dropdown]")
					.prev(".uk-button").addClass("button-primary");
			}

			if((typeof el.find(".redux-color-rgba-container").data("choose-color") !== "undefined")
				&& el.find(".redux-color-rgba-container").data("choose-color") && __colorpickerInput.data("color").length){
				el.find(".sp-preview").next(".sp-dd").text(__colorpickerInput.data("color"));
			}

			// Custom color change
			__colorpickerInput.off("change.spectrum").on("change.spectrum", function (e, tinycolor) {
				if(__globalInput.length) {
					__globalInput.val("");
					el.find("[data-tzfrm-global-color-theme]").parent().removeClass("uk-active")
						.find(".sp-preview-inner").children().addClass("uk-hidden");
					el.find("[uk-dropdown],[data-uk-dropdown]")
						.prev(".uk-button").removeClass("button-primary");
				}
				if((typeof el.find(".redux-color-rgba-container").data("choose-color") !== "undefined")
					&& el.find(".redux-color-rgba-container").data("choose-color")){
					el.find(".sp-preview").next(".sp-dd").text(tinycolor.toString());
				}
			});

			// Global color change
			if(el.find("[data-tzfrm-global-color-theme]").length) {
				el.find("[data-tzfrm-global-color-theme]").on("click", function () {
					var __li_current = $(this).closest("li");
					var __current_color = "";
					var __colorInput = el.find(".redux-hidden-_global"),
						__color = $(this).data("tzfrm-global-color-theme"),
						__dropdown	= $(this).closest("[uk-dropdown],[data-uk-dropdown]");

					__li_current.siblings().removeClass("uk-active").find(".sp-preview-inner")
						.children().addClass("uk-hidden");
					__li_current.addClass("uk-active").find(".sp-preview-inner")
						.children().removeClass("uk-hidden");

					if (typeof __color === "object") {
						if (typeof __color["color"]["color"] !== "undefined") {
							__current_color = __color["color"]["color"];
							// __field.find(".redux-hidden-color").val(__color["color"]);
							el.find(".redux-hidden-color").val("");
						}
						if (typeof __color["color"]["alpha"] !== "undefined") {
							// 	__field.find(".redux-hidden-alpha").val(__color["alpha"]);
							el.find(".redux-hidden-alpha").val("");
						}
						if (typeof __color["color"]["rgba"] !== "undefined") {
							__current_color = __color["color"]["rgba"];
							// __field.find(".redux-hidden-rgba").val(__color["rgba"]);
							el.find(".redux-hidden-rgba").val("");
						}
					} else {
						__current_color = __color;
					}

					if (__colorpickerInput.length) {
						__colorpickerInput.spectrum("set", __current_color);
					}
					if (typeof __color["id"] !== "undefined") {
						__colorInput.val(__color["id"]);
					}

					// Hide colors dropdown
					if($(this).closest("[uk-dropdown],[data-uk-dropdown]").length) {
						__dropdown.prev(".uk-button").addClass("button-primary");
						UIkit.dropdown(__dropdown).hide(false);
					}
				});
			}
		});
	};
})( jQuery );
