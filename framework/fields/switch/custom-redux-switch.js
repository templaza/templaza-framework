
/**
 * Override Background Redux field
 * Feature added by    : DuongTVTemplaza
 */
(function( $ ) {
	'use strict';

	redux.field_objects.switch.templaza_methods = redux.field_objects.switch.templaza_methods || {};

	redux.field_objects.switch.templaza_methods.setting_edit_after_init_field = function(selector, parent){
		var val = selector.find(".checkbox-input").val();
		if(val.length){
			val	= parseInt(val);
		}
		if(val === 1){
			selector.find(".cb-enable").trigger("click");
		}
		else{
			selector.find(".cb-disable").trigger("click");
		}
	};
})( jQuery );
