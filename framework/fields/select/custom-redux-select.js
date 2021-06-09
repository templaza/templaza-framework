
/**
 * Override Background Redux field
 * Feature added by    : DuongTVTemplaza
 */
(function( $ ) {
	'use strict';

	var org_redux_field_select = redux.field_objects.select.init;

	redux.field_objects.select.init = function( selector ) {
		if($(selector).closest(".tzfrm-ui-dialog").length){
			$(selector).find("select").data("dropdown-parent", $(selector).closest(".tzfrm-ui-dialog"));
		}
		org_redux_field_select(selector);
	};
})( jQuery );
