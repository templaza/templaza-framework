/*global redux_change, redux, templaza_tz_typography_ajax, WebFont */

/**
 * Override Typography redux field
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

	var isSelecting = false;
	var org_redux_field_typography__select	 = redux.field_objects.typography.select;
	redux.field_objects.typography.select = function( selector, skipCheck, destroy, fontName, active ) {

		org_redux_field_typography__select(selector, skipCheck, destroy, fontName, active);

		var mainID;
		var that;
		var family;
		var google;
		var familyBackup;
		var size;
		var height;
		var word;
		var letter;
		var align;
		var transform;
		var fontVariant;
		var decoration;
		var style;
		var multi_style;
		var script;
		var color;
		var units;
		var weights;
		var marginTopUnit;
		var marginBottomUnit;
		var lineHeightUnit;
		var wordSpacingUnit;
		var letterSpacingUnit;
		var baseUnits;
		var _linkclass;
		var the_font;
		var link;
		var isPreviewSize;
		var marginTop;
		var marginBottom;
		var allowEmptyLineHeight;
		var defaultFontWeights;

		var typekit  = false;
		var details  = '';
		var html     = '<option value=""></option>';
		var selected = '';

		// Main id for selected field.
		mainID = $( selector ).parents( '.redux-container-typography:first' ).data( 'id' );
		if ( undefined === mainID ) {
			mainID = $( selector ).data( 'id' );
		}

		that   = $( '#' + mainID );
		family = $( '#' + mainID + '-family' ).val();

		if ( ! family ) {
			family = null; // 'inherit';
		}

		if ( fontName ) {
			family = fontName;
		}

		familyBackup = that.find( 'select.redux-typography-family-backup' ).val();
		size         = that.find( '.redux-typography-size' ).val();
		height       = that.find( '.redux-typography-height' ).val();
		word         = that.find( '.redux-typography-word' ).val();
		letter       = that.find( '.redux-typography-letter' ).val();
		align        = that.find( 'select.redux-typography-align' ).val();
		transform    = that.find( 'select.redux-typography-transform' ).val();
		fontVariant  = that.find( 'select.redux-typography-font-variant' ).val();
		decoration   = that.find( 'select.redux-typography-decoration' ).val();
		multi_style  = that.find( 'select.redux-typography-multi-style' ).val();
		script       = that.find( 'select.redux-typography-subsets' ).val();
		color        = that.find( '.redux-typography-color' ).val();
		marginTop    = that.find( '.redux-typography-margin-top' ).val();
		marginBottom = that.find( '.redux-typography-margin-bottom' ).val();
		weights      = that.find( '.typography-style' );
		baseUnits    = that.data( 'units' );

		if ( undefined === word ) {
			word = '0';
		}

		if ( undefined === letter ) {
			letter = '0';
		}

		if ( weights.length > 0 ) {
			defaultFontWeights = JSON.parse( decodeURIComponent( weights.data( 'weights' ) ) );
		}

		// Is selected font a Google font?
		if ( true === isSelecting ) {
			google = redux.field_objects.typography.makeBool( selVals['data-google'] );
			that.find( '.redux-typography-google-font' ).val( google );
		} else {
			google = redux.field_objects.typography.makeBool( that.find( '.redux-typography-google-font' ).val() ); // Check if font is a Google font.
		}

		if ( active ) {

			// Page load. Speeds things up memory wise to offload to client.
			if (!that.hasClass('tz-typography-initialized')) {
				multi_style = that.find('select.redux-typography-multi-style').data('value');
				// script = that.find('select.redux-typography-subsets').data('value');

				// if ('' !== multi_style) {
				// 	multi_style = String(multi_style);
				// }

				// if (undefined !== typeof (script)) {
				// 	script = String(script);
				// }
			}

			// Something went wrong trying to read google fonts, so turn google off.
			if (undefined === redux.fonts.google) {
				google = false;
			}

			// Get font details.
			if (true === google && (family in redux.fonts.google)) {
				details = redux.fonts.google[family];
			} else {
				if (undefined !== redux.fonts.typekit && (family in redux.fonts.typekit)) {
					typekit = true;
					details = redux.fonts.typekit[family];
				} else {
					details = defaultFontWeights;
				}
			}

			// if ($(selector).hasClass('redux-typography-subsets')) {
			// 	that.find('input.typography-subsets').val(script);
			// }

			// If we changed the font.
			// if ($(selector).hasClass('redux-typography-family')) {

				// Google specific stuff.
				if (true === google) {
					console.log("multi_style");
					console.log(multi_style);
					console.log(active);
					console.log(that.hasClass('tz-typography-initialized'));
					console.log(that.find( 'select.redux-typography-multi-style' ).data('value'));

					// STYLES.
					$.each(
						details.variants,
						function (index, variant) {
							index = null;
							if (multi_style.indexOf(variant.id) !== -1 || 1 === redux.field_objects.typography.size(details.variants)) {
								selected = ' selected="selected"';
								// multi_style = variant.id;
							} else {
								selected = '';
							}

							html += '<option value="' + variant.id + '"' + selected + '>' + variant.name.replace(/\+/g, ' ') + '</option>';
						}
					);

					// Destroy select2.
					if ( destroy ) {
						that.find( '.redux-typography-multi-style' ).select2( 'destroy' );
					}

					// Insert new HTML.
					that.find( '.redux-typography-multi-style' ).html( html ).select2();

					isSelecting = false;

					// End preview stuff.
					// If not preview showing, then set preview to show.
					if ( ! that.hasClass( 'tz-typography-initialized' ) ) {
						that.addClass( 'tz-typography-initialized' );
					}
				}
			// }

			// console.log(redux.field_objects.typography.size());
			console.log(details.variants);

		}
	}

	var org_redux_field_typography = redux.field_objects.typography.init;

	$(document).on("templaza-framework/field/tz_layout/load_setting/typography/field_value",
		".redux-container-tz_layout", function(e, f_name, setting, field, element, form){
			if(field.closest(".redux-field-container").attr("data-type") === "typography"){
				var _f_name	= field.closest(".redux-field-container").attr("data-id");
				var _f_value = typeof setting[_f_name] !== "undefined" ? setting[_f_name] : setting[_f_name];

				if (f_name.match(/\[font-family\]$/) !== null && typeof _f_value !== "undefined"
					&& typeof _f_value["font-family"] !== "undefined") {
					field.closest(".redux-typography-container").find(".redux-typography-family").data("value", _f_value["font-family"]);
				} else if (field.closest("[data-device]").length) {
					var __unit = field.val().match(/\D+$/g, '');
					field.closest(".tz-redux-typography-device[data-device]").find(".redux-typography").val(field.val().replace(/\D+$/g, ''));
					if (__unit !== null) {
						field.closest(".tz-redux-typography-device[data-device]").find(".redux-typography-unit").val(__unit);
					}
				}else if(field.closest(".select_wrapper").length && f_name.match(/\[font-style\]$/) === null){
					field.closest(".select_wrapper").find(".redux-typography").data("value", field.val());
				}

			}
		});

	redux.field_objects.typography.init	= function(selector) {

		org_redux_field_typography(selector);

		selector = $.redux.getSelector(selector, 'typography');


		var tab_init_preview = function(panel, parent){

			var input = panel.find(".typography-input"),
				input_hidden = panel.find("input[type=hidden][data-device]"),
				input_hidden_class = "typography-" + panel.attr("data-hidden-name"),
				input_class = "redux-typography-"+panel.attr("data-name");

			panel.siblings().find(".typography-input").removeClass(input_class)
				.end().find("input[type=hidden][data-device]").removeClass(input_hidden_class);
			input.addClass(input_class);
			input_hidden.addClass(input_hidden_class);

			// var mainID = $( selector ).parents( '.redux-container-typography:first' ).data( 'id' );
			// if ( undefined === mainID ) {
			// 	mainID = $( selector ).data( 'id' );
			// }
			var main = parent.closest('.redux-container-typography');
			var mainID = parent.closest('.redux-container-typography').data('id');
			if (undefined === mainID) {
				mainID = $(selector).data('id');
			}

			// console.log(main);
			var unit	= panel.find(".redux-typography-unit").val();

			var that   = $( '#' + mainID );
			that.attr("data-units", unit).data( 'units', unit );

			// redux.field_objects.typography.select(main);
			// redux.field_objects.typography.select(parent);

			input.removeClass(input_class);
			input_hidden.removeClass(input_hidden_class);
		};

		$(selector).each(function () {
			// var el     = $( selector );
			var el     = $( this );

			var field_id = el.data("id");
			el.find("#"+field_id).removeClass("typography-initialized");

			// // STYLES.
			// $.each(
			// 	details.variants,
			// 	function( index, variant ) {
			// 		index = null;
			// 		if ( variant.id === style || 1 === redux.field_objects.typography.size( details.variants ) ) {
			// 			selected = ' selected="selected"';
			// 			style    = variant.id;
			// 		} else {
			// 			selected = '';
			// 		}
			//
			// 		html += '<option value="' + variant.id + '"' + selected + '>' + variant.name.replace( /\+/g, ' ' ) + '</option>';
			// 	}
			// );

			if(el.find("[data-responsive]").length) {

				el.find(".redux-typography-family").trigger("change");
				redux.field_objects.typography.select(el);

				// el.each(function () {
					var _el = $(this);

					_el.find("[data-uk-switcher] a").on("click", function(){
						var __el_switcher	= $(this);
						UIkit.util.on(__el_switcher.closest("[data-uk-switcher]").next(".uk-switcher"), "show", function(e,a){
							var __parent = $(e.target.closest(".uk-switcher")),
								__prev = __parent.prev("[data-uk-switcher]"),
								__switchers = _el.find("[data-uk-switcher]").not(__prev);

							if(__switchers.length){
								$.each(__switchers, function(){
									UIkit.switcher($(this)).show(a.index());
								});
							}
						});
					});

					$(this).find(".tabs").tabs({
						create: function (event, ui) {

							$(this).find(".redux-typography-unit").select2();

							tab_init_preview(ui.panel, $(this));
						},
						activate: function (event, ui) {

							$(this).find(".redux-typography-unit").select2();

							tab_init_preview(ui.newPanel, $(this));

							// Active all tabs by device
							$(this).siblings(".tabs").tabs("option", "active", ui.newPanel.index()).tabs("refresh");
						}
					});

					// Init when value is changed.
					el.find('.typography-input').off("keyup").on("keyup", function () {
						var parent = $(this).closest("[data-device]");

						if (parent.length) {
							var device = parent.attr("data-device"),
								input_class = "redux-typography-" + parent.attr("data-name"),
								input_hidden_class = "typography-" + parent.attr("data-hidden-name");

							parent.find(".typography-input").addClass(input_class)
								.end().find("input[type=hidden][data-device=" + device + "]").addClass(input_hidden_class);

							var main = _el.closest('.redux-container-typography');
							var mainID = _el.closest('.redux-container-typography').data('id');
							if (undefined === mainID) {
								mainID = $(selector).data('id');
							}

							var unit = parent.find(".redux-typography-unit").val();

							var that = $('#' + mainID);
							that.attr("data-units", unit).data('units', unit);

							redux.field_objects.typography.select(main);

							if($( this ).val().length) {
								parent.find("input[data-device=" + device + "]").val($(this).val() + unit);
							}else{
								parent.find("input[data-device=" + device + "]").val("");
							}
						}

						// redux.field_objects.typography.select(main);

						parent.find(".typography-input").removeClass(input_class)
							.end().find("input[type=hidden][data-device=" + device + "]").removeClass(input_hidden_class);
					});
					$(this).find(".redux-typography-unit").on("change", function () {
						var parent = $(this).closest("[data-device]");
						if (parent.length) {

							var device = parent.attr("data-device"),
								input_class = "redux-typography-" + parent.attr("data-name"),
								input_hidden_class = "typography-" + parent.attr("data-hidden-name");

							parent.find(".typography-input").addClass(input_class)
								.end().find("input[type=hidden][data-device=" + device + "]").addClass(input_hidden_class);

							var main = _el.closest('.redux-container-typography');
							var mainID = _el.closest('.redux-container-typography').data('id');
							if (undefined === mainID) {
								mainID = $(selector).data('id');
							}

							var unit = $(this).val();

							var that = $('#' + mainID);

							that.attr("data-units", unit).data('units', unit);

							// var thisID = $( this ).attr( 'id' ), thisObj = _el.find( '#' + thisID );

							redux.field_objects.typography.select(main);
							// redux.field_objects.typography.select($(this).parents('.redux-container-typography:first'));

							parent.find("input[data-device="+device+"]").val(parent.find(".typography-input").val() + unit);

							parent.find(".typography-input").removeClass(input_class)
								.end().find("input[type=hidden][data-device=" + device + "]").removeClass(input_hidden_class);
						}
					});
				// });
			}

		});

		// org_redux_field_typography(selector);


	};
})( jQuery );
