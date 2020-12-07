
/**
 * Override Background Redux field
 * Feature added by    : DuongTVTemplaza
 */
(function( $ ) {
	'use strict';

	redux.field_objects.checkbox.templaza_methods = redux.field_objects.checkbox.templaza_methods || {};

	// redux.field_objects.checkbox.tz_after_load_setting = function(selector, field_input, field_value){
	// 	if(field_input.val() === "1") {
	// 		field_input.parent().find(".checkbox").prop("checked", true);
	// 	}
	// };
	redux.field_objects.checkbox.templaza_methods.setting_edit_after_init_field = function(selector, parent){
		if(selector.find(".checkbox-check").length){
			$.each(selector.find(".checkbox-check"), function(){
				if($(this).val() === "1"){
					$(this).next(".checkbox").prop("checked", true);
				}
			})
		}
	};
})( jQuery );
