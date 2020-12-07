(function($) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.tz_social = redux.field_objects.tz_social || {};

    redux.field_objects.tz_social.init = function( selector ) {

        if (!selector) {
            selector = $(document).find(".redux-group-tab:visible").find('.redux-container-tz_social:visible');
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

                redux.field_objects.tz_social.init_source(el);

            });
    };

    redux.field_objects.tz_social.init_source = function(el){
        var source_datas = [],
            data_id = el.data("id"),
            sources_list    = el.find("[data-sources-list]");

        if(sources_list.data("sources-list")){
            source_datas    = sources_list.data("sources-list");
        }

        if(!source_datas.length){
            return;
        }

        var search_brand    = el.find("[data-search-brand]"),
            field_form      = el.find("[data-field-form]"),
            field_form_data = field_form.data("field-form"),
            source_tmpl = wp.template("tzfrm-field-tz_social__" + data_id + "-source"),
            form_tmpl = wp.template("tzfrm-field-tz_social__" + data_id + "-form");

        var get_field_main = function(){
            var field_main = el.find("#" + el.data("id"));
            if(field_main.length){
                return field_main;
            }
            return false;
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

        var generate_social = function(){
            var value  = get_value();

            if(!value){
                return;
            }

            var $color  = false;
            $.each(value, function(index, val){
                var val_clone = $.extend(true, {random_id: new Date().getTime()}, val);
                // var form_tmpl = wp.template("tzfrm-field-tz-social__"+ el.data("id") +"-form");
                field_form.append(form_tmpl(val_clone));

                if(!val.icon.length || (val.icon.length > 0 && !val.icons.length)){
                    $color  = true;
                }
            });

            if($color) {
                init_color_input();
            }
        };

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
        var delete_value = function (element) {
            var global_value  = get_value();
            var index   = element.index();

            if(typeof global_value[index] !== typeof undefined){
                global_value.splice(index, 1);
            }

            set_values_to_field(global_value);
        };
        var set_values_to_field = function(global_value){
            var field_main = get_field_main();
            if(field_main.length ){
                global_value    = JSON.stringify(global_value);
                field_main.val(global_value).text(global_value);
            }
        };

        var field_delete_btn    = function(parent_form) {
            parent_form.find("[data-delete-form-item]").off("click").on("click", function (e) {
                var result  = confirm("Are you sure?");
                if(result) {
                    var item = $(this).closest(".tz-social-item");
                    delete_value(item);
                    item.remove();
                }
            });
        };

        var field_input_class  = function(parent_form){
            parent_form.find("[data-input=icon]").on("keyup", function(){
                var el_input = $(this);
                el_input.closest(".tz-social-item").find(".card-header > span:first-child() > i").attr("class", el_input.val());
            });
        };

        var source_item = function(parent_source) {
            parent_source.find(".social-profile-item").off("click").on("click", function (e) {
                var source_data = $(this).data("source");
                field_form.append(form_tmpl(source_data));
                field_keyup_event();
                field_delete_btn(field_form);
                field_input_class(field_form);
                field_select_icon();
                insert_value(source_data);
            });
        };

        var load_sources    = function(){
            // Display all sources list
            $.map(source_datas, function (val) {
                sources_list.append(source_tmpl(val));
                source_item(sources_list);
            });
        };

        var load_form_data    = function(){
            // Display all form field list data
            if(field_form_data && field_form_data.length) {
                $.map(field_form_data, function (val) {
                    field_form.append(form_tmpl(val));
                });
                init_color_input();
            }
        };

        var field_select_icon = function(){
            field_form.find(".select-icon").off("click").on("click", function(){
                var el_icon = $(this);
                el_icon.siblings().removeClass("active").end().addClass("active")
                    .closest(".tz-social-item")
                    .find(".card-header > span:first-child() > i")
                    .attr("class", el_icon.find("> i").attr("class"));

                var value = get_value();
                var index = el_icon.closest(".tz-social-item").index();

                if(typeof value[index] !== typeof undefined){
                    value[index]["icon"]   = el_icon.find("> i").attr("class");
                }
                set_values_to_field(value);
            });
        };
        var init_color_input = function(){
            redux.field_objects.color_rgba.modInit(field_form);
            redux.field_objects.color_rgba.initColorPicker(field_form);
        };

        var sortable = function(){
          field_form.sortable({
               // handle: "[data-fl-control=move]",
               // placeholder: "fl-ui-state-highlight fl-column-state-highlight",
               forcePlaceholderSize: true,
               items: '> .tz-social-item',
              start: function (event, ui) {
                   $(this).data("item-index-start", ui.item.index());
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
        };

        var field_keyup_event = function() {
            field_form.find("[data-input]").on("keyup", function (e) {
                var input = $(this);
                var value = get_value(),
                    index = input.closest(".tz-social-item").index();

                if(typeof value[index] !== typeof undefined){
                    value[index][input.data("input")]   = input.val();
                }
                set_values_to_field(value);
            });

            field_form.delegate("[data-input=color]","change", function (e) {
                var input = $(this);

                var input_alpha = $("#"+input.data("block-id")+"-alpha");
                var input_rgba = $("#"+input.data("block-id")+"-rgba");

                var value = get_value(),
                    index = input.closest(".tz-social-item").index();

                if(typeof value[index] !== typeof undefined){
                    if(input_rgba.length && input_alpha.length && input_alpha.val() < 1) {
                        value[index][input.data("input")] = input_rgba.val();
                    }else{
                        value[index][input.data("input")] = input.val();
                    }
                }
                set_values_to_field(value);
            });
        };

        generate_social();
        load_sources();
        load_form_data();
        field_delete_btn(field_form);
        field_input_class(field_form);
        field_select_icon();
        sortable();
        field_keyup_event();

        el.find("[data-add-custom-field]").off("click").on("click", function(){
            var source_data  = {"color":"","enabled":false,"icon":"","icons":[],"id":"custom","link":"","title":""};

            var date    = new Date();
            var data_clone  = $.extend(true, {random_id: date.getTime()}, source_data);

            field_form.append(form_tmpl(data_clone));
            field_delete_btn(field_form);
            field_input_class(field_form);
            init_color_input();
            insert_value(source_data);
            field_keyup_event();
        });

        search_brand.on("keyup", function (e) {
            var elsearh     = $(this),
                find_text   = elsearh.val()
                ;

            sources_list.html("");

            if(find_text.length) {

                var patt = new RegExp(find_text);

                $.grep(source_datas, function (source_data, index) {
                    var child_result = $.grep(source_data.icons, function (val, i) {
                        return patt.exec(val);
                    });
                    var finded = ((child_result && child_result.length) || patt.exec(source_data.title));

                    if (finded) {
                        // Display source html found
                        sources_list.append(source_tmpl(source_data));
                        source_item(sources_list);
                    }
                });
            }else{
                // Display all sources list
                // $.map(source_datas, function(val){
                //     sources_list.append(source_tmpl(val));
                //     source_item(sources_list);
                // });
                load_sources();
            }
        });
        return source_datas;
    };
})(jQuery);