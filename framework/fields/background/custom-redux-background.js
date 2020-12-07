
/**
 * Override Background Redux field
 * Feature added by    : DuongTVTemplaza
 */
(function( $ ) {
	'use strict';

	var org_redux_field_preview = redux.field_objects.background.preview;
	var org_redux_field_background = redux.field_objects.background.init;

	redux.field_objects.background.preview = function( selector , color) {
		var main_selector	= selector.closest(".redux-container-background");
		if(main_selector.children().data("background-rgba")){
			var css;

			var hide    = true;
			var parent  = $( selector ).parents( '.redux-container-background:first' );
			var preview = $( parent ).find( '.background-preview' );

			if ( ! preview ) { // No preview present.
				return;
			}

			css = 'height:' + preview.height() + 'px;';

			$( parent ).find( '.redux-background-input' ).each(
				function() {
					var data = $( this ).serializeArray();

					data = data[0];
					if ( data && data.name.indexOf( '[background-' ) !== - 1 ) {
						if ( '' !== data.value ) {
							hide = false;

							data.name = data.name.split( '[background-' );
							if(data.name[1].search(/\[.*?\]$/i)){
								data.name[1]	= data.name[1].replace(/\[.*?\]$/i, '');
							}
							data.name = 'background-' + data.name[1].replace( ']', '' );

							if ( 'background-image' === data.name ) {
								css += data.name + ':url("' + data.value + '");';
							} else {
								if(data.name === 'background-color'){
									var color = $(this).spectrum("get");
									css += data.name + ':' + color.toRgbString()+ ';';
								}else {
									css += data.name + ':' + data.value + ';';
								}
							}
						}
					}
				}
			);

			if ( ! hide ) {
				preview.attr( 'style', css ).fadeIn();
			} else {
				preview.slideUp();
			}
		}else{
			org_redux_field_preview(selector);
		}
	};

	redux.field_objects.background.init	= function(selector) {

		selector = $.redux.getSelector(selector, 'background');

		org_redux_field_background(selector);

			$(selector).each(function () {
				var el = $(this);

				if(el.find("[data-background-rgba]").length) {

					if (typeof redux.field_objects.color_rgba.initColorPicker === "function") {
						redux.field_objects.color_rgba.initColorPicker(el.parent());

						// Set preview when color change
						el.parent().find( '.redux-color-rgba' ).on('change.spectrum move.spectrum', function(event) {
							var color	= $(this).spectrum("get"),
								cur_color	= $(this).val();
							if(event.type === "move") {
								$(this).val(color.toRgbString());
							}
							redux.field_objects.background.preview( $(this));

							if(event.type === "move") {
								$(this).val(cur_color);
							}
						});
					}
				}
			});
	};
})( jQuery );
