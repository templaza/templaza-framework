
/**
 * Override Background Redux field
 * Feature added by    : DuongTVTemplaza
 */
(function( $ ) {
	'use strict';

	var tzfrm_org_redux_field_spacing = redux.field_objects.border.init;

	$(document).on("templaza-framework/field/tz_layout/load_setting/border/field_value",
		".redux-container-tz_layout", function(e, f_name, setting, field, element, form){
		if(field.closest(".redux-field-container").attr("data-type") === "border"){
			var _f_name	= field.closest(".redux-field-container").attr("data-id");

			if(field.hasClass("redux-border-value") && form.find(".redux-border-input[rel="+field.attr("id") + "]").length){
				if(typeof setting[_f_name] !== "undefined"){
					var _f_value	= typeof setting[_f_name][field.attr("id")] !== "undefined"?setting[_f_name][field.attr("id")]:setting[_f_name];
					if(_f_value && typeof _f_value !== "object") {
						form.find(".redux-border-input[rel=" + field.attr("id") + "]").val(parseInt(_f_value));
					}
				}
			}
		}
	});

	redux.field_objects.border.init = function( selector ) {
		if($(selector).closest(".tzfrm-ui-dialog,.uk-modal").length){
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
