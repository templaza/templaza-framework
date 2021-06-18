/*global redux*/

(function( $ ) {
	'use strict';

	redux.field_objects              = redux.field_objects || {};
	redux.field_objects.tz_select_image = redux.field_objects.tz_select_image || {};

	redux.field_objects.tz_select_image.initialized	= false;
	redux.field_objects.tz_select_image.init = function( selector ) {
		// if(redux.field_objects.tz_select_image.initialized){
		// 	return;
		// }
		selector = $.redux.getSelector( selector, 'tz_select_image' );

		$( selector ).each(
			function() {
				var src;
				var value;
				var preview;

				var el     = $( this );
				var parent = el;

				if ( ! el.hasClass( 'redux-field-container' ) ) {
					parent = el.parents( '.redux-field-container:first' );
				}

				if ( parent.is( ':hidden' ) ) {
					return;
				}

				if ( parent.hasClass( 'redux-field-init' ) ) {
					parent.removeClass( 'redux-field-init' );
				} else {
					return;
				}

				el.find( 'select.redux-select-images' ).select2();

				// value   = el.find( 'select.redux-select-images' ).val();
				src   	= el.find( 'select.redux-select-images option:selected' ).attr('data-image');
				preview = el.find( 'select.redux-select-images' ).parents( '.redux-field:first' ).find( '.redux-preview-image' );

				// preview.attr( 'src', value );
				if(typeof src !== "undefined") {
					preview.attr('src', src).fadeIn().css('visibility', 'visible');
				}else{
					preview.fadeOut().css('visibility', 'hidden');
				}
				// if(typeof src !== "undefined") {
				// 	preview.attr('src', src);
				// }else{
				// 	preview.css('visibility', 'hidden');
				// }

				el.find('.redux-select-images').on(
					'change',
					function () {
						var preview = $(this).parents('.redux-field:first').find('.redux-preview-image');

						if ('' === $(this).val()) {
							preview.fadeOut(
								'medium',
								function () {
									preview.attr('src', '');
								}
							);
						} else {
							// preview.attr( 'src', $( this ).val() );

							if(typeof  $(this).find("option:selected").attr("data-image") !== "undefined") {
								preview.attr('src', $(this).find("option:selected").attr("data-image"));
								preview.fadeIn().css('visibility', 'visible');
							}else{
								preview.fadeOut().css('visibility', 'hidden');
							}
						}
					}
				);
			}
		);
		redux.field_objects.tz_select_image.initialized	= true;
	};
})( jQuery );
