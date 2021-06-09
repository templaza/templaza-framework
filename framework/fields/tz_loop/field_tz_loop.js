(function($){
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.tz_loop = redux.field_objects.tz_loop || {};

    redux.field_objects.tz_loop.init = function( selector ) {


        if (!selector) {
            selector = $(document).find(".redux-group-tab:visible").find('.redux-container-tz_loop:visible');
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

                /*
                * @pos only use with @val_type is "array"
                * */
                var insert_value = function (value, val_type = "array", pos = "last") {
                    var global_value  = get_value();
                    if(!global_value){
                        switch (val_type){
                            default:
                            case "array":
                                global_value = [];
                                break;
                            case "json":
                                global_value = {};
                                break;
                        }
                    }
                    if(val_type === "array"){
                        if(pos === "last"){
                            global_value.push(value);
                        }else if(pos === "first"){
                            global_value.unshift(value);
                        }else{
                            global_value.splice(pos, 0, value);
                        }
                    }else{
                        global_value    = Object.assign(global_value, value);
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
                    if(typeof field_tz_loop_obj !== typeof undefined){
                        if(typeof field_tz_loop_obj.title_field !== typeof undefined){
                            el.find("[name=\"" +el.attr("data-id")+"__opt_name\["+field_tz_loop_obj.title_field+"\]\"]")
                                .off("change").on("change", function(){
                                var parent = $(this).closest(".field-tz_loop-accordion-group");
                                parent.find("> .redux-field > h3 .title").text($(this).val());
                            });
                        }
                    }
                };
                var init_accordion_title = function(){
                    if(typeof field_tz_loop_obj !== typeof undefined){
                        if(typeof field_tz_loop_obj.title_field !== typeof undefined){
                            var title_f_name =  el.attr("data-id")+"__opt_name\["+field_tz_loop_obj.title_field+"\]",
                                title_fields = el.find("[name=\""+title_f_name+"\"]");
                            if(title_fields.length) {
                                $.each(title_fields, function () {
                                    var parent = $(this).closest(".field-tz_loop-accordion-group");
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
                        var input = $(this).find("input, textarea, select"),
                            parent = input.closest(".field-tz_loop-accordion-group"),
                            group_field = parent.attr("data-group-field");

                        var value = get_value(),
                            index = parent.index(),
                            input_id = input.attr("id");
                        if(input.closest(".redux-field-container").attr("data-type") === "select"){
                            input_id    = input_id.replace(/-select$/gi, "");
                        }

                        if(group_field !== undefined){
                            if(value && value[group_field] !== undefined){
                                value[group_field][input_id]    = input.val();
                                set_values_to_field(value);
                            }else{
                                var setting = {};
                                setting[group_field]    = {};
                                setting[group_field][input_id] = input.val();
                                insert_value(setting, "json");
                            }
                        }else{
                            if(value && typeof value[index] !== typeof undefined){
                                value[index][input_id] = input.val();
                                set_values_to_field(value);
                            }else{
                                var setting = {};
                                setting[input_id] = input.val();
                                insert_value(setting);
                            }
                        }
                    });
                };

                // Remove button
                var delete_button = function() {
                    el.find(".remove-option").off("click").on("click", function (event) {
                        event.preventDefault();
                        var button = $(this),
                            parent = button.closest(".field-tz_loop-accordion-group"),
                            ask_remove = 'Are you sure to delete this option?';
                        if (typeof field_tz_loop_obj !== typeof undefined) {
                            ask_remove = field_tz_loop_obj.ask_remove_option;
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

                // Sortable object values by in
                var sortable_values = function(object_values, start_index, end_index){
                    if(typeof object_values !== "object"){
                        return object_values;
                    }

                    var objkeys = Object.keys(object_values);
                    return objkeys.reduce(
                        (obj, key) => {
                            var index = objkeys.indexOf(key);
                            if(index == end_index){
                                obj[objkeys[start_index]]	= object_values[objkeys[start_index]];
                            }else if(index == start_index){

                                obj[objkeys[end_index]]	= object_values[objkeys[end_index]];
                            }else{
                                obj[key] = object_values[key];
                            }
                            return obj;
                        },
                        {}
                    );
                };

                // var field_val   = el.find("#"+el.attr("data-id")).val().trim();
                //
                // if(field_val.length && typeof field_val === "string"){
                //     field_val   = JSON.parse(field_val);
                // }
                // if(field_val.length){
                //     var content = el.find(".field-tz_loop-accordion");
                //     $.each(field_val, function(index, value){
                //         var field_list = wp.template("tzfrm-field-tz_loop-template__field-"+el.attr("data-id")),
                //             field_list_obj  = $(field_list({})),
                //             fields = field_list_obj.find(".redux-field-container");
                //             // fields = field_list_obj.find(".redux-field-container").find("[name]");
                //         if(fields.length){
                //             fields.each(function () {
                //                 var field = $(this),
                //                     f_name  = field.attr("data-id");
                //                 if(typeof value[f_name] !== typeof undefined){
                //                     field.find("[name]").val(value[f_name]);
                //                 }
                //
                //                 field_on_change(field);
                //
                //             });
                //             content.append(field_list_obj);
                //         }
                //     });
                //     var fields  = el.find(".redux-field-container");
                //     if(fields.length){
                //         fields.each(function () {
                //             var field = $(this),
                //                 field_type = field.data("type"),
                //                 tz_redux = redux.field_objects;
                //             if (typeof tz_redux[field_type] !== typeof undefined) {
                //                 tz_redux[field_type].init(field);
                //
                //                 var tz_redux_field  = tz_redux[field_type];
                //                 if(typeof tz_redux_field.templaza_methods !== typeof undefined
                //                     && typeof tz_redux_field.templaza_methods.setting_edit_after_init_field !== typeof undefined){
                //                     tz_redux_field.templaza_methods.setting_edit_after_init_field(field);
                //                 }
                //             }
                //         });
                //     }
                //     if(typeof content.data("ui-accordion") !== typeof undefined){
                //         content.accordion("refresh");
                //     }
                //     delete_button();
                //     init_accordion_title();
                // }


                var init_fields = function(){
                    var values  = get_value(),
                        main = get_field_main(),
                        next = main.next(".field-tz_loop-accordion"),
                        group_fields = next.attr("data-group-fields");

                    if(typeof group_fields == "string"){
                        group_fields    = JSON.parse(group_fields);
                    }

                    // console.log(values);
                    // var test = ['a'];
                    // console.log(typeof values);
                    // console.log(typeof test);
                    // console.log(Array.isArray( values));
                    // console.log(group_fields);

                    var _value_keys = Object.keys(values),
                        _group_keys = Object.keys(group_fields);

                    var content = el.find(".field-tz_loop-accordion");

                    if(_value_keys.length && _value_keys.length >= _group_keys.length){
                        $.each(values, function(index, value){
                            var location    = index;

                            if(Array.isArray(values)){
                                location = Object.keys(value).shift();
                            }
                            var field_list = wp.template("tzfrm-field-tz_loop-template__field-"+el.attr("data-id")),
                                field_list_obj  = $(field_list({
                                    'group': location,
                                    'group_title': group_fields[location]
                                })),
                                fields = field_list_obj.find(".redux-field-container");

                            if(fields.length){
                                fields.each(function () {
                                    var field = $(this),
                                        f_name  = field.attr("data-id");
                                    if(Array.isArray(values)){
                                        if(typeof value[location][f_name] !== typeof undefined){
                                            field.find("[name]").val(value[location][f_name]);
                                        }
                                    }else{
                                        if(typeof value[f_name] !== typeof undefined){
                                            field.find("[name]").val(value[f_name]);
                                        }
                                    }

                                    field_on_change(field);

                                });
                                content.append(field_list_obj);
                            }
                        });
                    }else{
                        if(typeof group_fields !== typeof undefined){

                            if(typeof group_fields == "string"){
                                group_fields    = JSON.parse(group_fields);
                            }
                            $.each(group_fields, function(location, name){
                                var field_list = wp.template("tzfrm-field-tz_loop-template__field-"+el.attr("data-id")),
                                    field_list_obj = $(field_list({
                                        'group': location,
                                        'group_title': name
                                    }));

                                content.append(field_list_obj);

                                var fields  = field_list_obj.find(".redux-field-container");
                                if(fields.length){
                                    fields.each(function () {
                                        var field = $(this),
                                            field_type = field.data("type"),
                                            tz_redux = redux.field_objects,
                                            f_name  = field.attr("data-id");
                                        var _index = location;
                                        if(Array.isArray(values)){
                                            _index  = _group_keys.indexOf(location);
                                        }
                                        if(values[_index] !== undefined && values[_index][f_name] !== undefined) {
                                            field.find("[name]").val(values[_index][f_name]);
                                        }

                                        field_on_change(field);
                                    });
                                }


                            });

                        }
                    }


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

                    init_accordion_title();

                };

                init_fields();

                // el.find(".add-more").on("click", function(event){
                //     event.preventDefault();
                //     var add_more = $(this),
                //         field_list = wp.template("tzfrm-field-tz_loop-template__field-"+el.attr("data-id")),
                //         field_list_obj = $(field_list({}));
                //     var content = el.find(".field-tz_loop-accordion");
                //     content.append(field_list_obj);
                //
                //     var fields  = el.find(".redux-field-container");
                //     if(fields.length){
                //         fields.each(function () {
                //             var field = $(this),
                //                 field_type = field.data("type"),
                //                 tz_redux = redux.field_objects;
                //             if (typeof tz_redux[field_type] !== typeof undefined) {
                //                 tz_redux[field_type].init(field);
                //             }
                //
                //             field_on_change(field);
                //         });
                //     }
                //     if(typeof content.data("ui-accordion") !== typeof undefined){
                //         content.accordion("refresh");
                //     }
                //
                //     delete_button();
                //     set_accordion_title_when_add_new();
                //
                // });

                el.find( '.field-tz_loop-accordion' ).accordion(
                    {
                        header: '> div > fieldset > h3',
                        collapsible: true,
                        active: false,
                        heightStyle: 'content',
                        icons: false,
                        // icons: {
                        //     'header': 'ui-icon-plus',
                        //     'activeHeader': 'ui-icon-minus'
                        //     // 'header': 'ui-icon-plus',
                        //     // 'activeHeader': 'ui-icon-minus'
                        // }
                    }
                ).sortable(
                    {
                        axis: 'y',
                        handle: 'h3',
                        connectWith: '.field-tz_loop-accordion',
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
                                index = ui.item.index(),
                                group_field = ui.item.attr("data-group-field");

                            if(group_field !== undefined){
                                value = sortable_values(value, index_start, index);
                                // var test    = [];
                                // test.push(value);
                                // test.sort(function(a, b){
                                //     console.log("a");
                                //     console.log(a);
                                //     console.log("b");
                                //     console.log(b);
                                //     return 1;
                                // });
                                // var tmp_value = value
                                // var sortable = Object.fromEntries(
                                //     Object.entries(value).sort(([,a],[,b]) => a-b)
                                // );
                            }else {
                                var tmp_value = value[index_start];
                                value[index_start] = value[index];
                                value[index] = tmp_value;
                            }

                            set_values_to_field(value);
                        },
                    }
                );


            });
    }
})(jQuery);