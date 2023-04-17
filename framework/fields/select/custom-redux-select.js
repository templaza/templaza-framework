
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

	$(document).on("templaza-framework/field/tz_layout/load_setting/select/field_value",
		function(e, f_name, setting, field, element, form){
		if(field.prop("multiple") && f_name.match(/\[(.*?)\]/mg) !== null){
			var __field_name	= f_name.replace("[]", "");
			if(typeof setting[__field_name] === "object") {
				$.each(setting[__field_name], function (index, val) {
					field.find("option[value=\""+val+"\"]").prop("selected", true);
				})
			}
		}
	});
})( jQuery );
