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

	var org_redux_field_typography = redux.field_objects.typography.init;
	redux.field_objects.typography.init	= function(selector) {

		selector = $.redux.getSelector(selector, 'typography');


		org_redux_field_typography(selector);


		var tab_init_preview = function(panel, parent){

			var input = panel.find(".typography-input"),
				input_hidden = panel.find("input[type=hidden][data-device]"),
				input_hidden_class = "typography-" + panel.attr("data-hidden-name"),
				input_class = "redux-typography-"+panel.attr("data-name");

			panel.siblings().find(".typography-input").removeClass(input_class)
				.end().find("input[type=hidden][data-device]").removeClass(input_hidden_class);
			input.addClass(input_class);
			input_hidden.addClass(input_hidden_class);

			var mainID = $( selector ).parents( '.redux-container-typography:first' ).data( 'id' );
			if ( undefined === mainID ) {
				mainID = $( selector ).data( 'id' );
			}

			var unit	= panel.find(".redux-typography-unit").val();

			var that   = $( '#' + mainID );
			that.attr("data-units", unit).data( 'units', unit );

			redux.field_objects.typography.select(parent);

			input.removeClass(input_class);
			input_hidden.removeClass(input_hidden_class);
		};

		$(selector).each(function () {
			var el     = $( this );

			if(el.find("[data-responsive]").length) {
				el.each(function () {
					var _el = $(this);
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
					$(this).find('.typography-input').off("keyup").on("keyup", function () {
						var parent = $(this).closest("[data-device]");

						if (parent.length) {
							var device = parent.attr("data-device"),
								input_class = "redux-typography-" + parent.attr("data-name"),
								input_hidden_class = "typography-" + parent.attr("data-hidden-name");

							parent.find(".typography-input").addClass(input_class)
								.end().find("input[type=hidden][data-device=" + device + "]").addClass(input_hidden_class);

							// 	var attr_class = $(this).attr("data-hidden-name");
							// 	var device = parent.attr("data-device");
							//
							// 	_el.find(".typography-input[data-hidden-name]").removeClass("redux-typography-"+$(this).attr("data-name"));
							// 	$(this).addClass("redux-typography-"+$(this).attr("data-name"));
							//
							// 	_el.find("input[type=hidden][data-device]").removeClass("typography-"+attr_class)
							// 		.end()
							// 		.find("input[type=hidden][data-device="+device+"]").addClass("typography-"+attr_class);
							var mainID = $(selector).parents('.redux-container-typography:first').data('id');
							if (undefined === mainID) {
								mainID = $(selector).data('id');
							}

							var unit = parent.find(".redux-typography-unit").val();

							var that = $('#' + mainID);
							that.attr("data-units", unit).data('units', unit);
						}
						redux.field_objects.typography.select($(this).parents('.redux-container-typography:first'));

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

							// var device = parent.attr("data-device");
							// var attr_class = parent.find("input[type=text][data-hidden-name]").attr("data-hidden-name");
							// _el.find("input[type=hidden][data-device]").removeClass("typography-"+attr_class)
							// 	.end()
							// 	.find("input[type=hidden][data-device="+device+"]").addClass("typography-"+attr_class);
							//
							// _el.find(".typography-input[data-hidden-name]").removeClass("redux-typography-"+$(this).attr("data-name"));
							// parent.find(".typography-input[data-hidden-name]").addClass("redux-typography-"+$(this).attr("data-name"));
							//
							var mainID = $(selector).parents('.redux-container-typography:first').data('id');
							if (undefined === mainID) {
								mainID = $(selector).data('id');
							}

							var unit = $(this).val();

							var that = $('#' + mainID);
							that.attr("data-units", unit).data('units', unit);

							redux.field_objects.typography.select($(this).parents('.redux-container-typography:first'));

							parent.find(".typography-input").removeClass(input_class)
								.end().find("input[type=hidden][data-device=" + device + "]").removeClass(input_hidden_class);
						}
					});
				});
			}
		});

		// org_redux_field_typography(selector);


	};
})( jQuery );
