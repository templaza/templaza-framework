(function($){
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.tz_repeater = redux.field_objects.tz_repeater || {};

    redux.field_objects.tz_repeater.init = function( selector ) {


        if (!selector) {
            selector = $(document).find(".redux-group-tab:visible").find('.redux-container-tz_repeater:visible');
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

                var insert_value = function (value, pos = "last") {
                    var global_value  = get_value();
                    if(!global_value){
                        global_value    = [];
                    }
                    if(pos === "last"){
                        global_value.push(value);
                    }else if(pos === "first"){
                        global_value.unshift(value);
                    }else{
                        global_value.splice(pos, 0, value);
                    }

                    set_values_to_field(global_value);
                };

                var get_value = function(){
                    var field_main = get_field_main();
                    if(!field_main.length ){
                        return false;
                    }
                    var value   = el.find("#" + el.data("id")).val().trim();

                    if(!value.length){
                        return false;
                    }
                    value   = JSON.parse(value);
                    return value;
                };

                var set_values_to_field = function(global_value){
                    var field_main = get_field_main();
                    if(field_main.length ){
                        global_value    = JSON.stringify(global_value);
                        field_main.val(global_value).text(global_value);
                    }
                };

                var get_field_main = function(){
                    var field_main = el.find("#" + el.data("id"));
                    if(field_main.length){
                        return field_main;
                    }
                    return false;
                };

                var remove_value = function (pos = "last") {
                    var global_value  = get_value();
                    if(!global_value){
                        global_value    = [];
                    }
                    if(pos === "last"){
                        global_value.pop();
                    }else if(pos === "first"){
                        global_value.shift();
                    }else{
                        global_value.splice(pos, 1);
                    }

                    set_values_to_field(global_value);
                };

                // Change title of accordion item
                var set_accordion_title_when_add_new = function(){
                    if(typeof field_tz_repeater_obj !== typeof undefined){
                        if(typeof field_tz_repeater_obj.title_field !== typeof undefined){
                            el.find("[name=\"" +el.attr("data-id")+"__opt_name\["+field_tz_repeater_obj.title_field+"\]\"]")
                                .off("change").on("change", function(){
                                var parent = $(this).closest(".field-tz_repeater-accordion-group");
                                parent.find("> .redux-field > h3 .title").text($(this).val());
                            });
                        }
                    }
                };
                var init_accordion_title = function(){
                    if(typeof field_tz_repeater_obj !== typeof undefined){
                        if(typeof field_tz_repeater_obj.title_field !== typeof undefined){
                            var title_f_name =  el.attr("data-id")+"__opt_name\["+field_tz_repeater_obj.title_field+"\]",
                                title_fields = el.find("[name=\""+title_f_name+"\"]");
                            if(title_fields.length) {
                                $.each(title_fields, function () {
                                    var parent = $(this).closest(".field-tz_repeater-accordion-group");
                                    if($(this).val().length) {
                                        parent.find("> .redux-field > h3 .title").text($(this).val());
                                    }
                                });
                            }
                        }
                    }
                };

                // Field onchange trigger
                var field_on_change = function(field){
                    field.off("change").on("change", function(){
                        var _field_value = field.serializeForm(),
                            parent = field.closest(".field-tz_repeater-accordion-group"),
                            value = get_value(),
                            index = parent.index(),
                            field_id = field.attr("data-id");

                        if(Object.keys(_field_value).length){
                            _field_value    = _field_value[Object.keys(_field_value)[0]];
                            _field_value    = _field_value[Object.keys(_field_value)[0]];
                        }

                        if(value && typeof value[index] !== typeof undefined){
                            value[index][field_id] = _field_value;
                            set_values_to_field(value);
                        }else{
                            var setting = {};
                            setting[field_id] = _field_value;
                            insert_value(setting);
                        }
                    });
                };

                // Remove button
                var delete_button = function() {
                    el.find(".remove-option").off("click").on("click", function (event) {
                        event.preventDefault();
                        var button = $(this),
                            parent = button.closest(".field-tz_repeater-accordion-group"),
                            ask_remove = 'Are you sure to delete this option?';
                        if (typeof field_tz_repeater_obj !== typeof undefined) {
                            ask_remove = field_tz_repeater_obj.ask_remove_option;
                        }
                        var result = confirm(ask_remove);
                        if (result) {
                            // Remove data
                            remove_value(parent.index());
                            // Remove accordion item html
                            parent.remove();
                        }
                    });
                };

                var field_val   = el.find("#"+el.attr("data-id")).val().trim();

                if(field_val.length && typeof field_val === "string"){
                    field_val   = JSON.parse(field_val);
                }
                if(field_val.length){
                    var content = el.find(".field-tz_repeater-accordion");
                    $.each(field_val, function(index, value){
                        var field_list = wp.template("tzfrm-field-tz_repeater-template__field-"+el.attr("data-id")),
                            field_list_obj  = $(field_list({})),
                            fields = field_list_obj.find(".redux-field-container");

                        if(fields.length){
                            fields.each(function () {
                                var field = $(this),
                                    f_name  = field.attr("data-id");
                                if(typeof value[f_name] !== "undefined"){
                                    if(typeof value[f_name] === "object"){
                                        $.each(value[f_name], function(_sub_name, _sub_value){
                                            var _sub_field  = field.find("[name$='["+f_name+"]["+_sub_name+"]'");
                                            if(_sub_field.length){
                                                _sub_field.val(_sub_value);
                                            }
                                        });
                                    }else {
                                        field.find("[name]").val(value[f_name]);
                                    }
                                }
                                field_on_change(field);
                            });
                            content.append(field_list_obj);
                        }
                    });
                    var fields  = el.find(".redux-field-container");
                    if(fields.length){
                        fields.each(function () {
                            var field = $(this),
                                field_type = field.data("type"),
                                tz_redux = redux.field_objects;
                            if (typeof tz_redux[field_type] !== typeof undefined) {
                                tz_redux[field_type].init(field);

                                var tz_redux_field  = tz_redux[field_type];
                                if(typeof tz_redux_field.templaza_methods !== typeof undefined
                                    && typeof tz_redux_field.templaza_methods.setting_edit_after_init_field !== typeof undefined){
                                    tz_redux_field.templaza_methods.setting_edit_after_init_field(field);
                                }
                            }
                        });
                    }
                    if(typeof content.data("ui-accordion") !== typeof undefined){
                        content.accordion("refresh");
                    }
                    delete_button();
                    init_accordion_title();
                }


                el.find(".add-more").on("click", function(event){
                    event.preventDefault();
                    var add_more = $(this),
                        field_list = wp.template("tzfrm-field-tz_repeater-template__field-"+el.attr("data-id")),
                        field_list_obj = $(field_list({}));
                    var content = el.find(".field-tz_repeater-accordion");
                    content.append(field_list_obj);

                    var fields  = el.find(".redux-field-container");
                    if(fields.length){
                        fields.each(function () {
                            var field = $(this),
                                field_type = field.data("type"),
                                tz_redux = redux.field_objects;
                            if (typeof tz_redux[field_type] !== typeof undefined) {
                                tz_redux[field_type].init(field);
                            }

                            field_on_change(field);
                        });
                    }
                    if(typeof content.data("ui-accordion") !== typeof undefined){
                        content.accordion("refresh");
                    }

                    delete_button();
                    set_accordion_title_when_add_new();

                });

                el.find( '.field-tz_repeater-accordion' ).accordion(
                    {
                        header: '> div > fieldset > h3',
                        collapsible: true,
                        active: false,
                        heightStyle: 'content',
                        icons: {
                            'header': 'ui-icon-plus',
                            'activeHeader': 'ui-icon-minus'
                        }
                    }
                ).sortable(
                    {
                        axis: 'y',
                        handle: 'h3',
                        connectWith: '.field-tz_repeater-accordion',
                        start: function( e, ui ) {
                            e = null;
                            ui.placeholder.height( ui.item.height() );
                            ui.placeholder.width( ui.item.width() );

                            $(this).data("item-index-start", ui.item.index());
                        },
                        placeholder: 'ui-state-highlight',
                        stop: function( event, ui ) {
                            var inputs;

                            event = null;

                            // IE doesn't register the blur when sorting
                            // so trigger focusout handlers to remove .ui-state-focus.
                            ui.item.children( 'h3' ).triggerHandler( 'focusout' );
                            inputs = $( 'input.slide-sort' );
                            inputs.each(
                                function( idx ) {
                                    $( this ).val( idx );
                                }
                            );

                        },
                        update: function (event, ui) {
                            var value = get_value();
                            var index_start =  $(this).data("item-index-start"),
                                index = ui.item.index();
                            var tmp_value = value[index_start];
                            value[index_start]   = value[index];
                            value[index] = tmp_value;

                            set_values_to_field(value);
                        },
                    }
                );


            });
    }
})(jQuery);