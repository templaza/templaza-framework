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
                    var tz_required = function(obj_selector) {
                        if(obj_selector.find("[data-opt-name]").length) {
                            $.each(obj_selector.find("[data-opt-name]"), function(){
                                var _opt_name = $(this).attr("data-opt-name");

                                $.each(
                                    window['redux_' + _opt_name.replace( /\-/g, '_')].folds,
                                    function (i, v) {
                                        var div;
                                        var rawTable;

                                        var fieldset = obj_selector.find('#' + _opt_name + '-' + i);
                                        console.log(_opt_name);
                                        console.log(v);

                                        fieldset.parents('tr:first, li:first').addClass('fold');

                                        if ('hide' === v ) {
                                            fieldset.parents( 'tr:first, li:first' ).addClass( 'hide' );
                                            if(typeof window['redux_' + _opt_name.replace( /\-/g, '_')].required_child !== "undefined"
                                                && !$.redux.check_parents_dependencies(i)) {
                                                fieldset.parents('tr:first, li:first').addClass('hide');
                                            }

                                            if (fieldset.hasClass('redux-container-section')) {
                                                div = $('#section-' + i);

                                                if (div.hasClass('redux-section-indent-start')) {
                                                    $('#section-table-' + i).hide().addClass('hide');
                                                    div.hide().addClass('hide');
                                                }
                                            }

                                            if (fieldset.hasClass('redux-container-info')) {
                                                $('#info-' + i).hide().addClass('hide');
                                            }

                                            if (fieldset.hasClass('redux-container-divide')) {
                                                $('#divide-' + i).hide().addClass('hide');
                                            }

                                            if (fieldset.hasClass('redux-container-raw')) {
                                                rawTable = fieldset.parents().find('table#' + redux.opt_names[x] + '-' + i);
                                                rawTable.hide().addClass('hide');
                                            }
                                        }
                                    }
                                );
                            });
                        }
                    };

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

                                        redux_change(field.find(" input,  textarea, select"));
                                        // $.redux.check_dependencies(field.find(" input,  textarea, select"));

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

                                // console.log(ui.newPanel.find(".redux-container"));
                                // tz_required(ui.newPanel);
                                // $.redux.required();
                                // $.redux.checkRequired(ui.newPanel.find(".redux-container"));
                                // $.redux.check_parents_dependencies(ui.newPanel.find(".redux-container"));
                            }
                        },
                    });
                }

            });
    };
})(jQuery);