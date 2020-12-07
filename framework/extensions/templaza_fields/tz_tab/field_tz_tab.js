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
                            var fields = ui.newPanel.find(".redux-field-container");
                            if (fields.length) {
                                fields.each(function () {
                                    var field = $(this),
                                        field_type = field.data("type"),
                                        tz_redux = redux.field_objects;

                                    if (typeof tz_redux[field_type] !== typeof undefined) {
                                        tz_redux[field_type].init(field[0]);
                                    }
                                });
                            }
                        },
                    });
                }

            });
    };
})(jQuery);