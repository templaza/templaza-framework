(function($) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.tz_tab = redux.field_objects.tz_tab || {};

    redux.field_objects.tz_tab.init = function( selector ) {

        if (!selector) {
            selector = $(document).find(".redux-group-tab:visible").find('.redux-container-tz_tab:visible');
        }

        $(selector).each(
            function () {
                var el = $(this);
                var parent = el;
                if (!el.hasClass('redux-field-container')) {
                    parent = el.parents('.redux-field-container:first');
                }
                if (parent.is(":hidden")) { // Skip hidden fields
                    return;
                }
                if (parent.hasClass('redux-field-init')) {
                    parent.removeClass('redux-field-init');
                } else {
                    return;
                }

                if(el.find("[data-fl-tz_layout-tab]").length) {
                    el.find("[data-fl-tz_layout-tab]").tabs({
                        "activate": function (event, ui) {
                            var tab = $(this),
                                fields = ui.newPanel.find(".redux-field-container");
                            if (fields.length) {
                                fields.each(function () {
                                    var field = $(this),
                                        field_type = field.data("type"),
                                        tz_redux = redux.field_objects;

                                    if (typeof tz_redux[field_type] !== typeof undefined) {
                                        var tz_redux_field = tz_redux[field_type];

                                        // Before init field in setting edit
                                        // Trigger of field (setting_edit_before_init_field)
                                        if(field.length){
                                            if(typeof tz_redux_field.templaza_methods !== typeof undefined
                                                && typeof tz_redux_field.templaza_methods.setting_edit_before_init_field !== typeof undefined){
                                                tz_redux_field.templaza_methods.setting_edit_before_init_field(field, tab);
                                            }
                                        }

                                        tz_redux_field.init(field);

                                        // After init field in setting edit
                                        // Trigger of field (setting_edit_after_init_field)
                                        if(field.length){
                                            if(typeof tz_redux_field.templaza_methods !== typeof undefined
                                                && typeof tz_redux_field.templaza_methods.setting_edit_after_init_field !== typeof undefined){
                                                tz_redux_field.templaza_methods.setting_edit_after_init_field(field, tab);
                                            }
                                        }
                                    }
                                });
                            }
                        },
                    });
                }

            });
    };
})(jQuery);