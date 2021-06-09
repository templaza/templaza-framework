
/**
 * Override Background Redux field
 * Feature added by    : DuongTVTemplaza
 */
(function( $ ) {
	'use strict';

	var tzfrm_org_redux_field_spacing = redux.field_objects.spacing.init;

	redux.field_objects.spacing.init = function( selector ) {
		if($(selector).closest(".tzfrm-ui-dialog").length){
			$(selector).each(function () {
				var el     = $( this );

				var _spacing_unit	= el.find(".field-units").val();
				el.find(".redux-spacing-units").val(_spacing_unit);

				el.find( '.redux-spacing-input' ).each(function(){
					var	_spacing_value = $( '#' + $( this ).attr( 'rel' ) ).val();
					_spacing_value	= _spacing_value.replace(_spacing_unit, "");

					$(this).val(_spacing_value);
				});
			});
		}
		tzfrm_org_redux_field_spacing(selector);
	};
})( jQuery );
