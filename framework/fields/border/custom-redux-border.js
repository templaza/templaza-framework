
/**
 * Override Background Redux field
 * Feature added by    : DuongTVTemplaza
 */
(function( $ ) {
	'use strict';

	var tzfrm_org_redux_field_spacing = redux.field_objects.border.init;

	redux.field_objects.border.init = function( selector ) {
		if($(selector).closest(".tzfrm-ui-dialog").length){
			$(selector).each(function () {
				var el     = $( this );

				var _border_unit	= el.find(".field-units").val();
				el.find(".redux-border-units").val(_border_unit);

				el.find( '.redux-border-input' ).each(function(){
					var	_border_value = $( '#' + $( this ).attr( 'rel' ) ).val();
					_border_value	= _border_value.replace(_border_unit, "");

					$(this).val(_border_value);
				});
			});
		}
		tzfrm_org_redux_field_spacing(selector);
	};
})( jQuery );
