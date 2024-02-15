(function($){
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.tz_color_repeater = redux.field_objects.tz_color_repeater || {};

    redux.field_objects.tz_color_repeater.init = function( selector ) {


        if (!selector) {
            selector = $(document).find(".redux-group-tab:visible").find('.redux-container-tz_color_repeater:visible');
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

                el.closest("tr").addClass("field-tz_color_repeater__tr");

                // Remove form settings of layout in dialog
                if(el.closest(".tzfrm-ui-dialog,.uk-modal").length){
                    el.closest(".tzfrm-ui-dialog,.uk-modal").on("templaza-framework/setting/save/before", function(event, $setting,  $element, $selector, $settings){
                        if(typeof $setting.params[el.attr("data-id")+"__opt_name"] !== "undefined"){
                            delete $setting.params[el.attr("data-id")+"__opt_name"];
                        }
                    });
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
                    value   = !Array.isArray(value)?Object.values(value):value;
                    return value;
                };

                var set_values_to_field = function(global_value){
                    var field_main = get_field_main();
                    if(field_main.length ){
                        global_value    = Object.assign({}, global_value);
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

                // Field onchange trigger
                var field_on_change = function(field){
                    field.off("change").on("change", function(){
                        var _field_value = field.serializeForm(),
                            parent = field.closest(".field-tz_color_repeater__item"),
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

                // Get uniqueid
                var getUniqueId = function(){
                    return Math.random().toString(16).substr(2, 7);
                };

                // Remove button
                var delete_button = function() {
                    el.find(".remove-option").off("click").on("click", function (event) {
                        event.preventDefault();
                        var button = $(this),
                            parent = button.closest(".field-tz_color_repeater__item"),
                            ask_remove = 'Are you sure to delete this option?';
                        if (typeof field_tz_color_repeater_obj !== typeof undefined) {
                            ask_remove = field_tz_color_repeater_obj.ask_remove_option;
                        }
                        UIkit.modal.confirm(ask_remove,{
                            "stack": true,
                        }).then(function(){
                            // Remove data
                            remove_value(parent.index());
                            // Remove accordion item html
                            parent.remove();
                        }, function () {
                        });
                    });
                };

                var field_val   = el.find("#"+el.attr("data-id")).val().trim();

                if(field_val.length && typeof field_val === "string"){
                    field_val   = JSON.parse(field_val);
                }

                if((Array.isArray(field_val) && field_val.length) || (!Array.isArray(field_val) && Object.keys(field_val).length)){
                    var content = el.find(".field-tz_color_repeater__list");
                    $.each(field_val, function(index, value){
                        var field_list = wp.template("tzfrm-field-tz_color_repeater-template__field-"+el.attr("data-id")),
                            field_list_obj  = $(field_list({})),
                            fields = field_list_obj.find(".redux-field-container");

                        if(fields.length){
                            fields.each(function () {
                                var field = $(this),
                                    f_name  = field.attr("data-id");

                                // // Added on 21/12/2023
                                // var field_type = field.data("type"),
                                //     tz_redux = redux.field_objects;
                                // if (typeof tz_redux[field_type] !== typeof undefined) {
                                //     tz_redux[field_type].init(field);
                                // }

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

                                    // Call function to custom some task for field can execute
                                    var _f_field_type = field.data("type"),
                                        _f_tz_redux = redux.field_objects;
                                    if (typeof _f_tz_redux[_f_field_type] !== "undefined") {
                                        var _f_tz_redux_field  = _f_tz_redux[_f_field_type];
                                        if(typeof _f_tz_redux_field.templaza_methods !== "undefined"
                                            && typeof _f_tz_redux_field.templaza_methods.field_repeater_init_value !== "undefined"){
                                            _f_tz_redux_field.templaza_methods.field_repeater_init_value(field, value);
                                        }
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

                            if(field.data("type") === "select"){
                                const d = new Date();
                                field.find("select").attr("id", function (i, val) {
                                    return val + "__" + d.getTime();
                                });
                            }

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
                    delete_button();
                }

                // Init field value
                var init_value  = function(field){

                    var f_name  = field.attr("data-id");
                    // Set value for id if it is empty value
                    if(f_name === "id"){
                        field.find("[name]").val(getUniqueId());
                        field.trigger("change");
                    }
                    if(f_name === "title" && (typeof field_tz_color_repeater_obj.new_item !== "undefined")
                        && !field.val().length){
                        var _index  = field.closest(".field-tz_color_repeater__item").index();
                        field.find("[name]").val(wp.i18n.sprintf(field_tz_color_repeater_obj.new_item, _index + 1));

                        field.trigger("change");
                    }
                };

                el.find(".add-more").on("click", function(event){
                    event.preventDefault();
                    var add_more = $(this),
                        field_list = wp.template("tzfrm-field-tz_color_repeater-template__field-"+el.attr("data-id")),
                        field_list_obj = $(field_list({}));
                    var content = el.find(".field-tz_color_repeater__list");
                    content.append(field_list_obj);

                    var fields  = field_list_obj.find(".redux-field-container");
                    if(fields.length){
                        fields.each(function () {
                            var field = $(this),
                                field_type = field.data("type"),
                                tz_redux = redux.field_objects;

                            if(field.data("type") === "select"){
                                const d = new Date();
                                field.find("select").attr("id", function (i, val) {
                                    return val + "__" + d.getTime();
                                });
                            }

                            if (typeof tz_redux[field_type] !== typeof undefined) {
                                tz_redux[field_type].init(field);
                            }

                            field_on_change(field);
                            init_value(field);
                        });
                    }

                    delete_button();

                });

                el.find( '.field-tz_color_repeater__list' ).sortable(
                {
                    axis: 'y',
                    handle: '.move-option',
                    // connectWith: '.field-tz_color_repeater__list',
                    start: function( e, ui ) {
                        e = null;
                        ui.placeholder.height( ui.item.outerHeight() );
                        ui.placeholder.width( ui.item.outerWidth() );

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
                });


            });
    }
})(jQuery);