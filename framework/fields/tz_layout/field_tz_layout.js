(function($) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.tz_layout = redux.field_objects.tz_layout || {};

    // Override $.redux.getOptName function for use in block edit settings
    var origParseFloat = $.redux.getOptName;
    $.redux.getOptName  = function(el){

        var item = $( el );
        var opt_name = item.closest("[data-opt-name]").data("opt-name");

        if(opt_name !== undefined){
            redux.optName = window['redux_' + opt_name.replace( /\-/g, '_' )];
            return opt_name;
        }

        return origParseFloat(el);
    };

    redux.field_objects.tz_layout.init = function( selector ) {

        if (!selector) {
            selector = $(document).find(".redux-group-tab:visible").find('.redux-container-tz_layout:visible');
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

                var $settings,
                    $field = el.find("#"+el.data("id")),
                    $vals   = $field.val().trim();

                if($vals.length){
                    $settings  = JSON.parse($vals);
                }else{
                    $settings  = [];
                }

                el.trigger("templaza-framework/field/tz_layout/init", [$settings]);

                redux.field_objects.tz_layout.init_elements(el, $settings);

                redux.field_objects.tz_layout.init_tooltip(el);

                // redux.field_objects.tz_layout.init_source(el);
                redux.field_objects.tz_layout.init_control(el, $settings);


                el.trigger("templaza-framework/field/tz_layout/init/after", [$settings]);
            });
    };

    redux.field_objects.tz_layout.init_elements = function(selector, settings){
        if(settings){
            var $html = "";

            // var $tree_html = [];
            // var $level = 0;

            var $m_tree_html = [];
            var $m_level = -1;

            var tree_element = function(tree){
                $.each(tree, function(index, item){

                    var $m_item_tmp,
                        $m_item_tmp_data = $.extend(true, {}, item),
                        $m_params = $m_item_tmp_data.params;

                    delete $m_item_tmp_data.params;
                    delete $m_item_tmp_data.elements;

                    // var $has_parent = false;
                    // // Get element html template
                    // if($("#tmpl-field-tz_layout-settings-" + item.type).length) {
                    //     var $m_item_setting_tmp = $(wp.template("field-tz_layout-settings-" + item.type)()),
                    //         $_parent = $m_item_setting_tmp.attr("data-fl-parent");
                    //     if(typeof $_parent !== "undefined" && $_parent === "true"){
                    //         $has_parent = true;
                    //     }
                    // }
                    // if(typeof item.parent !== "undefined" && item.parent && item.parent === "true") {
                    //     $has_parent = true;
                    // }


                    // if(typeof item.parent !== "undefined" && item.parent) {
                    // if($has_parent) {
                        $m_level++;
                    // }


                    // var $item_tmp,
                    //     $item_tmp_data = $.extend(true, {}, item),
                    //     $params = $item_tmp_data.params;
                    //     // $item_tmp_data = Object.assign({}, item);
                    //
                    // delete $item_tmp_data.params;
                    // delete $item_tmp_data.elements;
                    //
                    // $item_tmp_data.element  = "";
                    //
                    //
                    if(typeof item.elements !== typeof undefined && item.elements.length){
                    //     if($level > 0){
                    //         $level--;
                    //     }
                    //
                        tree_element(item.elements);
                    //     $level++;
                    //
                    //     $item_tmp_data.element  = $tree_html[$level - 1];
                    //     $tree_html[$level - 1]   = "";
                    }


                    // Get element html template
                    if($("#tmpl-field-tz_layout-template-" + item.type).length) {
                        $m_item_tmp = wp.template("field-tz_layout-template-" + item.type);
                    }else{
                        $m_item_tmp = wp.template("field-tz_layout-template__element");
                    }

                    if(typeof $m_tree_html[$m_level + 1] !== "undefined"){
                        $m_item_tmp_data.element  = $m_tree_html[$m_level + 1];
                        $m_tree_html[$m_level + 1]  = "" ;
                    }

                    var $m_item_html = $m_item_tmp($m_item_tmp_data);

                    var $m_item_html_prepare = selector.triggerHandler("templaza-framework/field/tz_layout/shortcode/" +
                        item.type+"/prepare/html", [$m_item_html, $m_item_tmp_data, $m_params]);
                    if(typeof $m_item_html_prepare !== "undefined"){
                        $m_item_html  = $m_item_html_prepare;
                    }
                    if(typeof $m_tree_html[$m_level] === typeof undefined) {
                        $m_tree_html[$m_level] = $m_item_html;
                    }else{
                        $m_tree_html[$m_level] += $m_item_html;
                    }

                    $m_level --;



                    // if(!$tree_html.length && item.type === "column" && $level === 0){
                    //     $level++;
                    // }
                    //
                    // // Get element html template
                    // if($("#tmpl-field-tz_layout-template-" + item.type).length) {
                    //     $item_tmp = wp.template("field-tz_layout-template-" + item.type);
                    // }else{
                    //     $item_tmp = wp.template("field-tz_layout-template__element");
                    // }
                    //
                    // var $item_html = $item_tmp($item_tmp_data);
                    //
                    // var $item_html_prepare = selector.triggerHandler("templaza-framework/field/tz_layout/shortcode/" +
                    //     item.type+"/prepare/html", [$item_html, $item_tmp_data, $params]);
                    // if(typeof $item_html_prepare !== "undefined"){
                    //     $item_html  = $item_html_prepare;
                    // }
                    //
                    // if(typeof $tree_html[$level] === typeof undefined) {
                    //     $tree_html[$level] = $item_html;
                    // }else{
                    //     $tree_html[$level] += $item_html;
                    // }


                    // Prepare default setting from shortcode element
                    if(typeof templaza.shortcode !== typeof undefined){
                        var element_type = item.type,
                            shortcode = templaza.shortcode;
                        if(typeof shortcode[element_type] !== typeof undefined &&
                            typeof shortcode[element_type]["init"] === "function"){
                            shortcode[element_type]["init"]($m_item_tmp_data, $m_params);
                        }
                    }
                });
            };
            tree_element(settings);
            // if($tree_html.length) {
            //     $html   = $tree_html.pop();
            //     if($($html).find("[data-fl-element_type=section]").length) {
            //         selector.find(".field-tz_layout-content").html($html);
            //     }else{
            //         selector.find(".field-tz_layout-content").html("<div class=\"fl_column-container fl_column-section-container\">" + $html + "</div>");
            //     }
            // }

            if($m_tree_html.length) {
                $html   = $m_tree_html.shift();
                if($($html).find("[data-fl-element_type=section]").length) {
                    selector.find(".field-tz_layout-content").html($html);
                }else{
                    selector.find(".field-tz_layout-content").html("<div class=\"fl_column-container fl_column-section-container\">" + $html + "</div>");
                }
            }

        }
        // else{
        //     // Load elements when empty value
        //     if(!$("#" + selector.data("id")).val().length){
        //         $html   = redux.field_objects.tz_layout.get_section_empty();
        //         // selector.find(".field-tz_layout-content").prepend(redux.field_objects.tz_layout.get_section_empty());
        //     }
        // }
    };

    redux.field_objects.tz_layout.generateID =function() {
        var r = Math.random() >= 0.5;
        if (r) {
            var x = Math.floor((Math.random() * 10) + 1);
            var y = Math.floor((Math.random() * 100) + 1);
            var z = Math.floor((Math.random() * 10) + 1);
        } else {
            var x = Math.floor((Math.random() * 10) + 1);
            var y = Math.floor((Math.random() * 10) + 1);
            var z = Math.floor((Math.random() * 100) + 1);
        }
        var t = Date.now();
        return x + y + z + t.toString();
    };


    // General setting
    redux.field_objects.tz_layout.generate_setting_element = function(element, selector, settings){

        if(element.find("[data-fl-element_type]").length){

            var $tree_setting = [];

            var $level = 0;

            // Each sub elements
            var tree_element    = function(tree){
                $.each(tree, function(index, value){
                    var sub_element = $(this);

                    var $setting;
                    var form_setting_tmp = wp.template("field-tz_layout-settings-" + sub_element.data("fl-element_type"));

                    // /* 29/04/2021 */
                    // var _form_setting_obj   = $(form_setting_tmp());
                    // /* End 29/04/2021 */

                    if(selector.find("[data-fl-element_type]").index(element) > -1){
                        $setting   = redux.field_objects.tz_layout.get_setting(sub_element, selector, settings);
                    }else{
                        $setting   = redux.field_objects.tz_layout.get_form_settings($(form_setting_tmp()), sub_element);
                    }
                    $setting["id"]  = redux.field_objects.tz_layout.generateID();

                    // /* 29/04/2021 */
                    // $setting["parent"]  = _form_setting_obj.attr("data-fl-parent");
                    // /* End 29/04/2021 */

                    if(typeof sub_element.data("icon") !== typeof undefined) {
                        $setting["icon"] = sub_element.data("icon");
                    }
                    if(sub_element.find("[data-fl-element_type]").length){
                        if($level > 0){
                            $level--;
                        }
                        tree_element(sub_element.find("[data-fl-element_type]").first().parent().find("> [data-fl-element_type]"));
                        $level++;
                        $setting["elements"]    =  $tree_setting[$level - 1];
                        $tree_setting[$level - 1]   = [];
                    }
                    // else{
                    // //     $level  = 0;
                    //     if(typeof $setting.elements !== typeof undefined){
                    //         delete $setting.elements;
                    //     }
                    // }
                    if(typeof $tree_setting[$level] === typeof undefined) {
                        $tree_setting[$level]   = [];
                    }
                    $tree_setting[$level].push($setting);
                });
            };
            tree_element(element);

            return $tree_setting.pop().shift();
        }else{
            var $setting;
            var form_setting_tmp = wp.template("field-tz_layout-settings-" + element.data("fl-element_type"));

            if(selector.find("[data-fl-element_type]").index(element) > -1){
                $setting = redux.field_objects.tz_layout.get_setting(element, selector, settings);
            }else{
                if($("script#tmpl-field-tz_layout-settings-" + element.data("fl-element_type")).length) {
                    $setting = redux.field_objects.tz_layout.get_form_settings($(form_setting_tmp()), element);
                }
            }
            $setting["id"]  = redux.field_objects.tz_layout.generateID();
            if(typeof $setting["title"] === typeof undefined && typeof element.data("title") !== typeof undefined) {
                $setting["title"] = element.data("title");
            }
            if(typeof $setting["icon"] === typeof undefined && typeof element.data("icon") !== typeof undefined) {
                $setting["icon"] = element.data("icon");
            }
            return $setting;
        }
        // return false;
    };



    // Load setting value for fields of element
    redux.field_objects.tz_layout.load_setting = function(form, element, selector, settings){
        var fields = form.find("[name]");
        if(fields.length){
            var $value = redux.field_objects.tz_layout.get_setting(element, selector, settings),
                $setting = (typeof $value !== typeof undefined)?$value['params']:null;

            if($setting === null){
                return;
            }
            $.each(fields, function(){
               var field  = $(this),
                    f_name = field.attr("name"),
                    f_value;

               //  console.log(field.closest("[data-type]"));
               // if(field.closest("data-type")){
               //     console.log(field.closest("data-type"));
               // }

                // if(f_name === "margin"){
                // }
               if(f_name === "admin_label" && typeof $value[f_name] !== typeof undefined){
                   field.val($value[f_name]);
               }else{
                   if(f_name.match(/\[(.*?)\]/mg) !== null ){
                       var f_name_multi = f_name.split(/\[(.+?)\]/);

                       if(f_name_multi.length){
                           $.each(f_name_multi, function(index, _f_name){
                               if(_f_name.trim().length){
                                   if(typeof f_value === typeof undefined){
                                       if(typeof $setting[_f_name] !== typeof undefined){
                                           f_value = $setting[_f_name];
                                       }
                                   }else{
                                       if(typeof f_value[_f_name] !== typeof undefined) {
                                           f_value = f_value[_f_name];
                                       }
                                       if(typeof f_value !== "object") {
                                           if(field.hasClass("redux-hidden-rgba")){
                                               field.closest(".redux-container-background")
                                                   .find(".redux-color-rgba").attr("data-color", f_value);
                                           }
                                           // if(field.hasClass("redux-color-rgba")){
                                           //     field.closest(".redux-container-background")
                                           //         .find(".redux-hidden-color").attr("data-color", f_value);
                                           // }
                                           // console.log(field);


                                           // var _field = field.closest("[data-type]");
                                           // // console.log(_field.attr("data-type"));
                                           // // console.log(_field);
                                           // if(_field.attr("data-type") === "checkbox" && f_value === "1"){
                                           //     field.parent().find(".checkbox").prop("checked", true);
                                           //     console.log(field.parent());
                                           //     console.log(_field);
                                           // }

                                           // console.log(_f_name);
                                           // console.log(f_value);
                                           // console.log(field);

                                           field.val(f_value);


                                           // var _field = field.closest("[data-type]");
                                           // // After load field's setting
                                           // if(_field.length){
                                           //     var tz_redux = redux.field_objects,
                                           //          field_type = _field.attr("data-type");
                                           //     if (typeof tz_redux[field_type] !== typeof undefined) {
                                           //         if(typeof tz_redux[field_type].tz_after_load_setting !== typeof undefined){
                                           //             tz_redux[field_type].tz_after_load_setting(_field, field, f_value);
                                           //         }
                                           //     }
                                           // }
                                       }
                                   }
                               }
                           });
                       }
                   }else{
                       if(typeof $setting[f_name] !== typeof undefined){
                           field.val($setting[f_name]);
                       }
                   }
               }
            });

            // Prepare default setting from shortcode element
            if(typeof templaza.shortcode !== typeof undefined){
                var element_type = element.data("fl-element_type"),
                    shortcode = templaza.shortcode;
                if(typeof shortcode[element_type] !== typeof undefined &&
                    typeof shortcode[element_type]["load_setting"] === "function"){
                    shortcode[element_type]["load_setting"]($value, element, form);
                }
            }
        }
    };

    // Get setting of element
    redux.field_objects.tz_layout.get_setting = function(element, selector, settings){
        var parents = element.parents("[data-fl-element_type]"),
            parent = element.parent(),
            elements = parent.find("> [data-fl-element_type]"),
            element_index = elements.index(element);

        var val;

        if(parents.length) {
            var $i = parents.length - 1;
            while($i >= 0){
                var element_parent = parents.eq($i);
                // var val_index = element_parent.parent().find("> [data-fl-element_type]").index(element_parent);
                var val_index = element_parent.index();

                if(typeof val === typeof undefined){
                    val = settings[val_index];
                }else{
                    if(typeof val.elements !== typeof undefined) {
                        val = val.elements;
                    }
                    val   = val[val_index];
                }
                if($i === 0){
                    if(typeof val !== typeof undefined){
                        if(typeof val.elements !== typeof undefined) {
                            val = val.elements;
                        }
                        val = val[element_index];
                    }
                }
                $i--;
            }
        }else{
            val = settings[element_index];
        }
        return val;
    };

    // Get default settings
    redux.field_objects.tz_layout.get_form_settings = function(form, element){

        var element_type = element.data("fl-element_type");
        var default_setting = {
            type: element_type,
            elements: [],
            params: form.serializeForm()
        };

        // /* 29/04/2021 */
        // if(typeof form.attr("data-fl-parent") !== "undefined") {
        //     default_setting["parent"] = form.attr("data-fl-parent");
        // }
        // /* End 29/04/2021 */

        if(typeof form.data("icon") !== typeof undefined){
            default_setting.icon    = form.data("icon");
        }
        if(typeof form.data("title") !== typeof undefined){
            default_setting.title    = form.data("title");
        }

        // Prepare default setting from shortcode element
        if(typeof templaza.shortcode !== typeof undefined){
            var shortcode = templaza.shortcode;
            if(typeof shortcode[element_type] !== typeof undefined &&
                typeof shortcode[element_type]["prepare_setting"] === "function"){
                shortcode[element_type]["prepare_setting"](default_setting, form, element);
            }
        }

        return default_setting;
    };

    redux.field_objects.tz_layout.insert_setting = function(src_setting, dest_setting = null, settings, selector, pos = "last", replace = false){
        if(pos === "last"){
                if(dest_setting !== null){
                    if(replace){
                        dest_setting.elements[dest_setting.elements.length] = src_setting;
                    }else {
                        dest_setting.elements.push(src_setting);
                    }
                }else{
                    if(replace){
                        settings[settings.length]   = src_setting;
                    }else {
                        settings.push(src_setting);
                    }
                }
        }else if(pos === "first"){
            if(dest_setting !== null){
                if(replace){
                    dest_setting.elements[0]    = (src_setting);
                }else {
                    dest_setting.elements.unshift(src_setting);
                }
            }else{
                if(replace){
                    settings[0] = src_setting;
                }else {
                    settings.unshift(src_setting);
                }
            }
        }else if(Number.isInteger(pos)){
            if(dest_setting !== null){
                if(replace){
                    dest_setting.elements.splice(pos, 1, src_setting);
                }else {
                    dest_setting.elements.splice(pos, 0, src_setting);
                }
            }else{
                if(replace){
                    settings.splice(pos, 1, src_setting);
                }else {
                    settings.splice(pos, 0, src_setting);
                }
            }
        }

        // Set settings to field
        redux.field_objects.tz_layout.set_setting_to_field(settings, selector);
    };

    // Modify settings
    redux.field_objects.tz_layout.modify_setting = function(setting, form, element, selector, settings){
        if(form.find("[name]").length){
            var form_data = form.serializeForm();
            if(typeof form_data.tz_admin_label !== typeof undefined) {
                setting.admin_label = form_data.tz_admin_label;
                // delete form_data.admin_label;
            }
            setting.params  = form_data;
            // setting.params  = Object.assign(setting.params, form_data);
        }

        // if(typeof setting.id === typeof undefined){
            setting.id   = redux.field_objects.tz_layout.generateID();
        // }

        if(typeof templaza.shortcode !== typeof undefined){
            var element_type = element.data("fl-element_type"),
                shortcode = templaza.shortcode;
            if(typeof shortcode[element_type] !== typeof undefined &&
                typeof shortcode[element_type]["prepare_setting"] !== typeof undefined){
                shortcode[element_type]["prepare_setting"](setting, form, element);
            }
        }

    };

    redux.field_objects.tz_layout.set_setting_to_field = function(settings, selector){
        var settings_str    = (typeof settings === "object")?JSON.stringify(settings):settings;
        // console.log(settings_str);
        // console.log(selector.find("#"+selector.data("id")));
        // selector.find("#"+selector.data("id")).val(settings_str);
        selector.find("#"+selector.data("id")).val(settings_str).text(settings_str);
    };

    redux.field_objects.tz_layout.get_row_empty = function(){
        var row = wp.template('field-tz_layout-template-row');
        return row({element: redux.field_objects.tz_layout.get_column_empty()});
    };
    redux.field_objects.tz_layout.get_column_empty = function(){
        var column = wp.template('field-tz_layout-template-column');
        return  column({"size": 12});
    };
    redux.field_objects.tz_layout.get_section_empty = function(){
        if(!$("#tmpl-field-tz_layout-template-section").length){
            return false;
        }
        var section = wp.template("field-tz_layout-template-section");
        return section({element: redux.field_objects.tz_layout.get_row_empty()});
    };

    redux.field_objects.tz_layout.init_tooltip = function(selector){
        selector.tooltip({
            // disabled: true,
            // items: "[title]",
            tooltipClass: "fl-tz_layout-ui-tooltip",
            position: {
                my: "center bottom",
                at: "center top",
                using: function( position, feedback ) {
                    $( this ).css( position );
                    $( "<div>" )
                        .addClass( "fl-arrow" )
                        .addClass( feedback.vertical )
                        .addClass( feedback.horizontal )
                        .appendTo( this );
                }
            }
        });
    };

    redux.field_objects.tz_layout.init_control  = function(selector, settings){
        var sortable_column  = function(sort_selector){
            // Column sortable
            sort_selector.find("[data-fl-element_type=row] .fl_row_container").sortable({
                // handle: "[data-fl-control=move]",
                placeholder: "fl-ui-state-highlight fl-column-state-highlight",
                forcePlaceholderSize: true,
                items: '> [data-fl-element_type=column]',
                start: function( event, ui ) {
                    sort_selector.tooltip("destroy");
                    var padding = ui.item.outerWidth() - ui.item.width(),
                        width   = Math.floor(ui.item.closest(".fl_row_container").width() / 100 * parseFloat(ui.item.css("flex").replace("0 0 ", "")));
                    ui.placeholder.width(width-padding);
                    ui.placeholder.height(ui.item.outerHeight());

                    $(this).data("fl-ui-old-index", ui.item.index());
                    // console.log(ui.item);
                    $(this).data("fl-ui-parent-old", ui.item.parents("[data-fl-element_type]").first());
                },
                stop: function( event, ui ) {
                    redux.field_objects.tz_layout.init_tooltip(sort_selector);
                },
                update: function( event, ui ) {
                    var element = $(this),
                        old_item_index  = element.data("fl-ui-old-index"),
                        old_parent  = element.data("fl-ui-parent-old"),
                        new_parent  = ui.item.parents("[data-fl-element_type]").first();

                    if(typeof old_parent !== typeof undefined) {
                        var parent_old_setting = redux.field_objects.tz_layout.get_setting(old_parent, selector, settings),
                            src_setting = parent_old_setting.elements.splice(old_item_index, 1),
                            dest_setting = redux.field_objects.tz_layout.get_setting(new_parent, selector, settings);

                        if(src_setting.length){
                            src_setting = src_setting.shift();
                        }
                        redux.field_objects.tz_layout.insert_setting(src_setting, dest_setting, settings, selector, ui.item.index());
                    }

                },
            }).disableSelection();
        };


        var sortable_element  = function(sort_selector){
            // Element sortable
            sort_selector.find(".fl_column-container.fl_container_for_children").sortable({
                placeholder: "fl-element-state-highlight fl-ui-state-highlight",
                forcePlaceholderSize: true,
                items: '> [data-fl-element_type]',
                dropOnEmpty: true,
                connectWith: ".fl_column-container.fl_container_for_children",
                start: function( event, ui ) {
                    if(sort_selector.data("ui-tooltip") !== undefined){
                        sort_selector.tooltip("destroy");
                    }

                    $(this).data("fl-ui-old-index", ui.item.index());
                    $(this).data("fl-ui-parent-old", ui.item.parents("[data-fl-element_type]").first());
                },
                stop: function( event, ui ) {
                    redux.field_objects.tz_layout.init_tooltip(sort_selector);

                    // Allow 2 level of row
                    // if(ui.item.data("fl-element_type") === "row_inner") {
                    //     $(this).sortable('cancel');
                    // }

                    if(ui.item.data("fl-element_type") === "row_inner" && ui.item.parents("[data-fl-element_type=row_inner]").length) {
                        $(this).sortable('cancel');
                    }
                    else{
                        var src_parent   = $(event.target),
                            des_parent   = ui.item.closest(".fl_column-container.fl_container_for_children");
                        if(!src_parent.children().length){
                            src_parent.addClass("fl_empty-container");
                            init_event();
                        }
                        if(des_parent.length && des_parent.hasClass("fl_empty-container")){
                            des_parent.removeClass("fl_empty-container").off("click");
                        }
                    }
                    // var src_parent   = $(event.target),
                    //     des_parent   = ui.item.closest(".fl_column-container.fl_container_for_children");
                    // if(!src_parent.children().length){
                    //     src_parent.addClass("fl_empty-container");
                    //     init_event();
                    // }
                    // if(des_parent.length && des_parent.hasClass("fl_empty-container")){
                    //     des_parent.removeClass("fl_empty-container").off("click");
                    // }
                },
                update: function( event, ui ) {
                    var element = $(this),
                        old_item_index  = element.data("fl-ui-old-index"),
                        old_parent  = element.data("fl-ui-parent-old"),
                        new_parent  = ui.item.parents("[data-fl-element_type]").first();

                    if(typeof old_parent !== typeof undefined) {
                        var parent_old_setting = redux.field_objects.tz_layout.get_setting(old_parent, selector, settings),
                            src_setting = parent_old_setting.elements.splice(old_item_index, 1),
                            dest_setting = redux.field_objects.tz_layout.get_setting(new_parent, selector, settings);

                        if(src_setting.length){
                            src_setting = src_setting.shift();
                        }
                        redux.field_objects.tz_layout.insert_setting(src_setting, dest_setting, settings, selector, ui.item.index());
                    }
                },
            }).disableSelection();
        };

        var sortable_row = function (sort_selector) {
            // Row sortable
            sort_selector.find(".fl_column-container:not(.fl_container_for_children)").sortable({
                handle: "[data-fl-control=move]",
                placeholder: "fl-row-state-highlight fl-ui-state-highlight",
                forcePlaceholderSize: true,
                containment: "parent",
                // cancel: '[data-fl-element_type=row].fl_row_inner',
                items: '[data-fl-element_type=row]',
                connectWith: ".fl_column-container:not(.fl_container_for_children)",
                start: function( event, ui ) {
                    sort_selector.tooltip("destroy");
                    ui.placeholder.height(ui.item.outerHeight());

                    $(this).data("fl-ui-old-index", ui.item.index());
                    $(this).data("fl-ui-parent-old", ui.item.parents("[data-fl-element_type]").first());
                },
                stop: function( event, ui ) {
                    redux.field_objects.tz_layout.init_tooltip(sort_selector);
                },
                update: function( event, ui ) {
                    var element = $(this),
                        old_item_index  = element.data("fl-ui-old-index"),
                        old_parent  = element.data("fl-ui-parent-old");

                    if(old_parent.length) {
                        var new_parent = ui.item.parents("[data-fl-element_type]").first(),
                            parent_old_setting = redux.field_objects.tz_layout.get_setting(old_parent, selector, settings),
                            src_setting = parent_old_setting.elements.splice(old_item_index, 1),
                            dest_setting = redux.field_objects.tz_layout.get_setting(new_parent, selector, settings);

                        if (src_setting.length) {
                            src_setting = src_setting.shift();
                        }
                        redux.field_objects.tz_layout.insert_setting(src_setting, dest_setting, settings, selector, ui.item.index());
                    }
                    else{
                        var old_item_index  = $(this).data("fl-ui-old-index");
                        var src_setting = settings.splice(old_item_index, 1);

                        redux.field_objects.tz_layout.insert_setting(src_setting[0], null, settings, selector, ui.item.index());
                    }

                },
            }).disableSelection();
        };


        var sortable_section    = function(sort_selector){
            // Section sortable
            sort_selector.sortable({
                handle: "> .fl_controls [data-fl-control=move]",
                placeholder: "fl-ui-state-highlight",
                forcePlaceholderSize: true,
                items: '[data-fl-element_type=section]',
                start: function( event, ui ) {
                    sort_selector.tooltip("destroy");
                    // if(ui.item.hasClass("fl_content_element")) {
                    ui.placeholder.height(ui.item.outerHeight());
                    // }

                    $(this).data("fl-ui-old-index", ui.item.index());
                },
                stop: function( event, ui ) {
                    redux.field_objects.tz_layout.init_tooltip(sort_selector);

                    // // Allow 2 level of row
                    // if(ui.item.data("fl-element_type") === "row" && ui.item.parents("[data-fl-element_type=row].fl_row_inner").length) {
                    //     $(this).sortable('cancel');
                    // }
                },
                update: function( event, ui ) {

                    var old_item_index  = $(this).data("fl-ui-old-index");
                    var src_setting = settings.splice(old_item_index, 1);

                    redux.field_objects.tz_layout.insert_setting(src_setting[0], null, settings, selector, ui.item.index());
                },
            }).disableSelection();

        };

        var sortable    = function(sort_selector){
            sortable_section(sort_selector);
            sortable_row(sort_selector);
            sortable_column(sort_selector);
            sortable_element(sort_selector);
        };

        var tzdialog  = function(dialog_selector, options){
            var dialog_settings    = $.extend({}, {
                'dialogClass': 'tzfrm-ui-dialog redux-container-tz_layout__dialog',
                'modal': true,
                'autoOpen': false,
                'closeOnEscape': true,
                'draggable': false,
                // "appendTo": selector,
                "appendTo": selector.closest(".tzfrm-ui-dialog").length?$("body"):selector,
                // "appendTo": dialog_selector.parent(),
                "title":  dialog_selector.data("modal-title"),
                'buttons'       : [
                    {
                        text: "Close",
                        class: "button button-secondary ms-2",
                        click: function() {
                            $( this ).dialog( "close" );
                        },
                    },
                ]
            }, options);
            return dialog_selector.dialog(dialog_settings).removeClass("hide");
        };


        var button_cache;
        var init_event  = function(){

            var element_click_event = function(element_selector, element_dest){
                element_selector.find("[data-element]").off("click").on("click", function(event){
                    event.preventDefault();
                    var item = $(this);
                    // if (typeof button_cache !== typeof undefined) {
                    var tmpl_data,
                        tmp_el;
                    if(!$("script#tmpl-field-tz_layout-template-"+item.data("element")).length){
                        tmp_el  = wp.template("field-tz_layout-template__element");
                        tmpl_data   = {
                            "icon": item.find("[data-fl-element-icon]").data("fl-element-icon"),
                            "title": item.find("[data-fl-element-name]").text(),
                            "type": item.data("element")
                        };
                    }else{
                        tmp_el = wp.template("field-tz_layout-template-"+item.data("element"));
                        if(item.data("element") === "row_inner"){
                            tmpl_data   = {
                                element: redux.field_objects.tz_layout.get_column_empty()
                            };
                        }
                    }

                    tmp_el = $(tmp_el(tmpl_data));

                    // Get setting
                    var pos = "last",
                        dest_element,
                        src_setting = redux.field_objects.tz_layout.generate_setting_element(tmp_el, selector, settings);

                    selector.trigger("templaza-framework/field/tz_layout/action/add/shortcode/before",
                        [tmp_el, src_setting, element_dest, settings, selector]);
                    element_selector.trigger("templaza-framework/field/tz_layout/action/add/shortcode/before",
                        [tmp_el, src_setting, element_dest, settings, selector]);

                    if (typeof element_dest.attr("data-fl-control") !== typeof undefined
                        && element_dest.attr("data-fl-control") === "add") {
                        if(element_dest.closest(".fl_controls-column.bottom-controls").length) {
                            dest_element    = element_dest.closest("[data-fl-element_type=column]");

                            element_dest.closest("[data-fl-element_type=column]")
                                .find(".fl_column-container.fl_container_for_children").first()
                                .removeClass("fl_empty-container").off("click").append(tmp_el);
                        }else{
                            pos             = "first";
                            dest_element    = element_dest.closest("[data-fl-element_type=column]");

                            element_dest.closest("[data-fl-element_type=column]")
                                .find(".fl_column-container.fl_container_for_children").first()
                                .removeClass("fl_empty-container").off("click").prepend(tmp_el);
                        }
                    }else{
                        dest_element    = element_dest.closest("[data-fl-element_type=column]");
                        element_dest.append(tmp_el).removeClass("fl_empty-container").off("click");
                    }
                    element_dest.closest("[data-fl-element_type=column]").removeClass("fl_empty-column")
                        .find(">.fl_controls-column.bottom-controls").first()
                        .addClass("d-block");

                    var dest_setting = redux.field_objects.tz_layout.get_setting(dest_element, selector, settings);
                    // Add setting
                    redux.field_objects.tz_layout.insert_setting(src_setting, dest_setting, settings, selector, pos);

                    selector.trigger("templaza-framework/field/tz_layout/action/add/shortcode/after",
                        [src_setting, element_dest, dest_setting]);
                    element_selector.trigger("templaza-framework/field/tz_layout/action/add/shortcode/after",
                        [src_setting, element_dest, dest_setting]);

                    element_selector.dialog("close");

                    sortable(selector);
                    init_event();
                    // }
                });
            };

            selector.find("[data-fl-control=toggle]").off("click").on("click", function(event){
                event.preventDefault();
                $(this).closest("[data-fl-element_type]").toggleClass("fl_collapsed-row");
            });
            // Edit grid
            selector.find("[data-fl-control=edit-grid]").off("click").on("click", function(event){
                event.preventDefault();

                selector.find(".tzfrm-ui-dialog").dialog({
                    'dialogClass': 'field-tz-preloader-dialog',
                    'modal': true,
                    'autoOpen': false,
                    'closeOnEscape': true,
                    'draggable': false,
                    'buttons'       : {
                        "Close": function() {
                            $(this).dialog('close');
                        }
                    }
                }).removeClass("hide").dialog('open');
            });
            // Add element, Add column
            selector.find("[data-fl-control=add]").off("click").on("click", function(event){
                event.preventDefault();

                var control = $(this),
                    element = control.closest("[data-fl-element_type]");

                if(element.data("fl-element_type") === "row"
                    || element.data("fl-element_type") === "row_inner") {
                    var column  = $(redux.field_objects.tz_layout.get_column_empty());

                    // Add setting
                    var src_setting = redux.field_objects.tz_layout.generate_setting_element(column, selector, settings),
                        dest_setting = redux.field_objects.tz_layout.get_setting(element, selector, settings);
                    redux.field_objects.tz_layout.insert_setting(src_setting, dest_setting, settings, selector);

                    element.find(".fl_row_container.fl_container_for_children").first()
                        .append(column);


                }else{
                    button_cache   = control;

                    if(control.closest("[data-fl-element_type=row_inner").length){
                        $("[data-fl_tz_layout-elements]").find("[data-element=row_inner]").parent().addClass("hide");
                    }else{
                        $("[data-fl_tz_layout-elements]").find("[data-element=row_inner]").parent().removeClass("hide");
                    }

                    var list_elements = wp.template("field-tz_layout-list__items");
                    var list_element_obj = $(list_elements());

                    tzdialog(list_element_obj, {
                        open: function( event, ui ) {
                            element_click_event($(this), control);
                        },
                        "close": function (ev, ui) {
                            $(this).remove();
                        }
                    }).removeClass("hide").dialog('open');

                }

                sortable(selector);
                init_event();
            });
            selector.find(".fl_column-container.fl_empty-container").off("click").on("click", function(event){
                event.preventDefault();
                var element_empty = $(this);
                var list_elements = wp.template("field-tz_layout-list__items");
                var list_element_obj = $(list_elements());

                // button_cache   = $(this);
                // if(element_empty.closest("[data-fl-element_type=row_inner").length){
                //     $("[data-fl_tz_layout-elements]").find("[data-element=row_inner]").parent().addClass("hide");
                // }else{
                //     $("[data-fl_tz_layout-elements]").find("[data-element=row_inner]").parent().removeClass("hide");
                // }
                if(element_empty.closest("[data-fl-element_type=row_inner").length){
                    list_element_obj.find("[data-element=row_inner]").parent().addClass("hide");
                }else{
                    list_element_obj.find("[data-element=row_inner]").parent().removeClass("hide");
                }

                tzdialog(list_element_obj, {
                    open: function( event, ui ) {
                        element_click_event($(this), element_empty);
                    },
                    "close": function (ev, ui) {
                        // button_cache   = null;
                        $(this).remove();
                    }
                }).removeClass("hide").dialog('open');

                // tzdialog($("[data-fl_tz_layout-elements]"),{
                //     "close": function (ev, ui) {
                //         button_cache   = undefined;
                //     }
                // }).removeClass("hide").dialog('open');
            });
            // Add section
            selector.find("[data-fl-control=add-section], .fl_add-element-not-empty-button").off("click").on("click", function(event){
                event.preventDefault();
                var control = $(this),
                    section_empty = redux.field_objects.tz_layout.get_section_empty(),
                    section_new,
                    element = control.closest("[data-fl-element_type=section]");

                if(section_empty){
                    section_new = $(section_empty);
                }else{
                    section_new = $(redux.field_objects.tz_layout.get_row_empty());
                }

                var pos = "last",
                    src_setting = redux.field_objects.tz_layout.generate_setting_element(section_new, selector, settings);

                if(element.length) {
                    pos = element.parent().find("[data-fl-element_type=section]").index(element) + 1;
                    element.after(section_new);
                }else{
                    if(!selector.find(".field-tz_layout-content > .fl_column-container.fl_column-section-container").length) {
                        var selector_child = $("<div>");
                        selector_child.attr("class", "fl_column-container fl_column-section-container");

                        if(!section_empty) {
                            selector_child.append(section_new).appendTo(selector.find(".field-tz_layout-content"));
                        }else{
                            selector_child.append(section_empty).appendTo(selector.find(".field-tz_layout-content"));
                        }
                    }else {
                        selector.find(".field-tz_layout-content > .fl_column-container.fl_column-section-container").append(section_new);
                    }
                }

                redux.field_objects.tz_layout.insert_setting(src_setting, null, settings, selector, pos);

                selector.trigger("templaza-framework/field/tz_layout/shortcode/section/add/after");

                sortable(selector);
                init_event();
            });
            // Add row
            selector.find("[data-fl-control=add-row]").off("click").on("click", function(event){
                event.preventDefault();
                var control = $(this),
                    element = control.closest("[data-fl-element_type]"),
                    element_type = "row",
                    parent = element.closest("[data-fl-element_type=section]"),
                    parent_class;

                if(element.data("fl-element_type") !== "section"){
                    element_type = "row_inner";
                }
                var row_temp = wp.template("field-tz_layout-template-" + element_type);

                var row_new    = $(row_temp({element: redux.field_objects.tz_layout.get_column_empty()}));

                var pos = "last",
                    src_setting = redux.field_objects.tz_layout.generate_setting_element(row_new, selector, settings),
                    dest_setting = redux.field_objects.tz_layout.get_setting(parent, selector, settings);

                if(control.closest(".fl_controls").hasClass("bottom-controls")){
                    element.find(".fl_column-container").first().off("click")
                        .removeClass("fl_empty-container").append(row_new);
                }else{
                    pos = "first";
                    element.find(".fl_column-container").first().off("click")
                        .removeClass("fl_empty-container").prepend(row_new);
                }

                redux.field_objects.tz_layout.insert_setting(src_setting, dest_setting, settings, selector, pos);

                sortable(selector);
                init_event();
            });
            // Duplicate element
            selector.find("[data-fl-control=clone]").off("click").on("click", function(event){
                event.preventDefault();
                var control  = $(this),
                    element  = control.closest("[data-fl-element_type]"),
                    parent  = element.parents("[data-fl-element_type]").first();

                selector.trigger("templaza-framework/field/tz_layout/action/clone/before",
                    [control, element, selector, settings]);

                var pos = element.index() + 1;
                // var pos = element.parent().find("[data-fl-element_type]").index(element) + 1;
                var dest_setting = null;
                var el_setting = redux.field_objects.tz_layout.get_setting(element, selector, settings);
                var src_setting = $.extend(true, {id: redux.field_objects.tz_layout.generateID()}, el_setting);

                if(parent.length){
                    dest_setting    = redux.field_objects.tz_layout.get_setting(parent, selector, settings);
                }
                var clone   = element.clone();

                var _src_setting = selector.triggerHandler("templaza-framework/field/tz_layout/action/clone/shortcode/setting/before",
                    [element, clone, src_setting, dest_setting, selector, settings]);
                src_setting = $.extend(true, src_setting, _src_setting);

                redux.field_objects.tz_layout.insert_setting(src_setting, dest_setting, settings, selector, pos);

                selector.trigger("templaza-framework/field/tz_layout/action/clone/shortcode/setting/after",
                    [element, clone, src_setting, dest_setting, selector, settings]);

                selector.trigger("templaza-framework/field/tz_layout/action/clone/shortcode/html/before",
                    [element, clone, src_setting, dest_setting, selector, settings]);

                // var clone   = element.clone();

                // clone   = selector.triggerHandler("templaza-framework/field/tz_layout/action/clone/shortcode/html/prepare",
                //     [clone, element, src_setting, dest_setting, control]);
                clone.insertAfter(element);

                selector.trigger("templaza-framework/field/tz_layout/action/clone/shortcode/html/after",
                    [element, clone, src_setting, selector, settings]);

                selector.trigger("templaza-framework/field/tz_layout/action/clone/after", [element, clone, src_setting, selector, settings]);

                // Re init sortable
                sortable(selector);
                init_event();
            });
            // Delete element
            selector.find("[data-fl-control=delete]").off("click").on("click", function(event){
                event.preventDefault();
                var control = $(this),
                    element = control.closest("[data-fl-element_type]"),
                    access  = true;
                var parent  = element.parent();

                if(element.data("fl-element_type") === "row"){
                    if(parent.find("> [data-fl-element_type=row]").length === 1){
                        access  = false;
                    }
                }else if(element.data("fl-element_type") === "column"){
                    if(parent.find("[data-fl-element_type=column]").length === 1){
                        access  = false;
                    }
                }
                if(access) {
                    var result  = confirm("Are you sure?");
                    if(result){

                        var element_index = element.index(),
                            parent_element = element.parents("[data-fl-element_type]").first(),
                            parent_setting  = redux.field_objects.tz_layout.get_setting(parent_element, selector, settings),
                        element_setting = (typeof parent_setting !== typeof undefined && parent_setting.elements[element_index])?parent_setting.elements[element_index]:{};

                        selector.trigger("templaza-framework/field/tz_layout/action/delete/shortcode/setting/before",
                                [element, element_setting, parent_setting]);
                        control.trigger("templaza-framework/field/tz_layout/action/delete/shortcode/setting/before", [element, element_setting, parent_setting]);

                        if(typeof parent_setting !== typeof undefined){
                            parent_setting.elements.splice(element_index, 1);
                        }else{
                            settings.splice(element_index, 1);
                        }

                        redux.field_objects.tz_layout.set_setting_to_field(settings, selector);

                        selector.trigger("templaza-framework/field/tz_layout/action/delete/shortcode", [element, element_setting, parent_setting]);
                        control.trigger("templaza-framework/field/tz_layout/action/delete/shortcode", [element, element_setting, parent_setting]);

                        element.remove();

                        if(parent.hasClass("fl_column-container fl_container_for_children") && !parent.find("[data-fl-element_type]").length){
                            var column = wp.template("field-tz_layout-template-column");
                            parent.closest("[data-fl-element_type]").after(column({
                                size: parent.closest("[data-fl-element_type]").attr("data-column-width")
                            })).remove();
                        }

                        selector.trigger("templaza-framework/field/tz_layout/action/delete/shortcode/after");
                        control.trigger("templaza-framework/field/tz_layout/action/delete/shortcode/after");

                        sortable(selector);
                        init_event();
                    }
                }
            });
            // // Insert element
            // selector.find("[data-fl_tz_layout-elements] [data-element]").off("click").on("click", function(event){
            //     event.preventDefault();
            //     var element = $(this);
            //     if (typeof button_cache !== typeof undefined) {
            //         var tmpl_data,
            //             tmp_el;
            //
            //         if(!$("script#tmpl-field-tz_layout-template-"+element.data("element")).length){
            //             tmp_el  = wp.template("field-tz_layout-template__element");
            //             tmpl_data   = {
            //                 "icon": element.find("[data-fl-element-icon]").data("fl-element-icon"),
            //                 "title": element.find("[data-fl-element-name]").text(),
            //                 "type": element.data("element")
            //             };
            //         }else{
            //             tmp_el = wp.template("field-tz_layout-template-"+element.data("element"));
            //             if(element.data("element") === "row_inner"){
            //                 tmpl_data   = {
            //                     element: redux.field_objects.tz_layout.get_column_empty()
            //                 };
            //             }
            //         }
            //
            //         tmp_el = $(tmp_el(tmpl_data));
            //
            //         // Get setting
            //         var pos = "last",
            //             dest_element,
            //             src_setting = redux.field_objects.tz_layout.generate_setting_element(tmp_el, selector, settings);
            //
            //
            //         if (typeof button_cache.attr("data-fl-control") !== typeof undefined && button_cache.attr("data-fl-control") === "add") {
            //             if(button_cache.closest(".fl_controls-column.bottom-controls").length) {
            //                 dest_element    = button_cache.closest("[data-fl-element_type=column]");
            //
            //                 button_cache.closest("[data-fl-element_type=column]")
            //                     .find(".fl_column-container.fl_container_for_children").first()
            //                     .removeClass("fl_empty-container").off("click").append(tmp_el);
            //             }else{
            //                 pos             = "first";
            //                 dest_element    = button_cache.closest("[data-fl-element_type=column]");
            //
            //                 button_cache.closest("[data-fl-element_type=column]")
            //                     .find(".fl_column-container.fl_container_for_children").first()
            //                     .removeClass("fl_empty-container").off("click").prepend(tmp_el);
            //             }
            //         }else{
            //             dest_element    = button_cache;
            //             button_cache.append(tmp_el).removeClass("fl_empty-container").off("click");
            //         }
            //         button_cache.closest("[data-fl-element_type=column]").removeClass("fl_empty-column")
            //             .find(">.fl_controls-column.bottom-controls").first()
            //             .addClass("d-block");
            //
            //         console.log(button_cache);
            //         console.log(dest_element);
            //         console.log(src_setting);
            //         var dest_setting = redux.field_objects.tz_layout.get_setting(dest_element.parents("[data-fl-element_type]").first(), selector, settings);
            //         // Add setting
            //         redux.field_objects.tz_layout.insert_setting(src_setting, dest_setting, settings, selector, pos);
            //         console.log(settings);
            //
            //         button_cache    = null;
            //
            //         $("[data-fl_tz_layout-elements]").dialog("close");
            //
            //         sortable(selector);
            //         init_event();
            //     }
            // });

            var tz_required = function(obj_selector) {
                // console.log(obj_selector.find(".redux-container"));

                // obj_selector.find(".redux-container").each(
                //     function() {
                //         var opt_name = $.redux.getOptName( this );
                //         console.log(opt_name);
                //         console.log(redux.optName.required);
                //
                //         // if ( $.inArray( opt_name, tempArr ) === -1 ) {
                //         //     tempArr.push( opt_name );
                //         $.redux.check_dependencies( this );
                //             // $.redux.checkRequired( $( this ) );
                //             // $.redux.initEvents( $( this ) );
                //         // }
                //     }
                // );
                // obj_selector.find(" select, radio, input[type=checkbox], input[type=hidden]")
                //     .each(
                //     function() {
                //         // var opt_name = $.redux.getOptName( this );
                //         // console.log(opt_name);
                //         // console.log(redux.optName.required);
                //         console.log(this);
                //
                //         // if ( $.inArray( opt_name, tempArr ) === -1 ) {
                //         //     tempArr.push( opt_name );
                //         $.redux.check_dependencies( this );
                //             // $.redux.checkRequired( $( this ) );
                //             // $.redux.initEvents( $( this ) );
                //         // }
                //     }
                // );
                // $( 'body' ).on(
                //     'change',
                //     '.redux-main select, .redux-main radio, .redux-main input[type=checkbox], .redux-main input[type=hidden]',
                //     function() {
                //         alert("44233");
                //         $.redux.check_dependencies( this );
                //     }
                // );


                // Hide the fold elements on load.
                // It's better to do this by PHP but there is no filter in tr tag , so is not possible
                // we going to move each attributes we may need for folding to tr tag.
                $.each(
                    redux.opt_names,
                    function( x ) {
                        $.each(
                            window['redux_' + redux.opt_names[x].replace( /\-/g, '_' )].folds,
                            function( i, v ) {
                                var div;
                                var rawTable;

                                var fieldset = obj_selector.find( '#' + redux.opt_names[x] + '-' + i );

                                fieldset.parents( 'tr:first, li:first' ).addClass( 'fold' );

                                // // console.log(fieldset);
                                // console.log(v);
                                // // console.log(x);
                                // console.log(redux.opt_names[x]);
                                // // console.log(redux.opt_names);

                                if ( 'hide' === v ) {
                                    fieldset.parents( 'tr:first, li:first' ).addClass( 'hide' );

                                    if ( fieldset.hasClass( 'redux-container-section' ) ) {
                                        div = $( '#section-' + i );

                                        if ( div.hasClass( 'redux-section-indent-start' ) ) {
                                            $( '#section-table-' + i ).hide().addClass( 'hide' );
                                            div.hide().addClass( 'hide' );
                                        }
                                    }

                                    if ( fieldset.hasClass( 'redux-container-info' ) ) {
                                        $( '#info-' + i ).hide().addClass( 'hide' );
                                    }

                                    if ( fieldset.hasClass( 'redux-container-divide' ) ) {
                                        $( '#divide-' + i ).hide().addClass( 'hide' );
                                    }

                                    if ( fieldset.hasClass( 'redux-container-raw' ) ) {
                                        rawTable = fieldset.parents().find( 'table#' + redux.opt_names[x] + '-' + i );
                                        rawTable.hide().addClass( 'hide' );
                                    }
                                }
                            }
                        );
                    }
                );



                // $( 'body' ).on(
                //     'change',
                //     '.redux-main select, .redux-main radio, .redux-main input[type=checkbox], .redux-main input[type=hidden], .redux-main input[type=text]',
                //     function() {
                //         alert("43243");
                //         // $.redux.check_dependencies( this );
                //         check_dependencies( this );
                //     }
                // );
                //
                // var check_parents_dependencies = function(id){
                //     var show = '';
                //
                //     var current = obj_selector.find(".redux-field[data-id="+id+"]"),
                //         optName = current.closest(".redux-container").attr("data-opt-name"),
                //         optName_id = 'redux_' + optName.replace(/\-/g, '_');
                //     console.log(current);
                //     console.log(optName);
                //
                //     // if ( redux.optName.required_child.hasOwnProperty( id ) ) {
                //     if ( window[optName_id].required_child.hasOwnProperty( id ) ) {
                //         $.each(
                //             window[optName_id].required_child[id],
                //             function( i, parentData ) {
                //                 var parentValue;
                //
                //                 i = null;
                //
                //                 if ( $( '#' + optName + '-' + parentData.parent ).parents( 'tr:first' ).hasClass( 'hide' ) ) {
                //                     show = false;
                //                 } else if ( $( '#' +optName + '-' + parentData.parent ).parents( 'li:first' ).hasClass( 'hide' ) ) {
                //                     show = false;
                //                 } else {
                //                     if ( false !== show ) {
                //                         parentValue = $.redux.getContainerValue( parentData.parent );
                //
                //                         show = $.redux.check_dependencies_visibility( parentValue, parentData );
                //                     }
                //                 }
                //             }
                //         );
                //     } else {
                //         show = true;
                //     }
                //
                //     return show;
                // };
                //
                // var check_dependencies = function(variable) {
                //     // obj_selector.find(" select, radio, input[type=checkbox], input[type=hidden], input[type=text]")
                //     //     .each(function () {
                //             var current, container, isHidden;
                //             current = $(variable);
                //             var id = current.closest(".redux-field").attr("data-id");
                //
                //
                //             var optName = current.closest(".redux-container").attr("data-opt-name");
                //             container = current.parents('.redux-field-container:first');
                //             isHidden = container.parents('tr:first').hasClass('hide');
                //             $.each(
                //                 window['redux_' + optName.replace(/\-/g, '_')].required[id],
                //                 function (child) {
                //                     var div;
                //                     var rawTable;
                //                     var tr;
                //
                //                     var current = $(this);
                //                     var show = false;
                //                     var childFieldset = obj_selector.find('#' + optName + '-' + child);
                //
                //                     tr = childFieldset.parents('tr:first');
                //
                //                     if (0 === tr.length) {
                //                         tr = childFieldset.parents('li:first');
                //                     }
                //
                //                     if (!isHidden) {
                //                         // show = $.redux.check_parents_dependencies(child);
                //                         show = check_parents_dependencies(child);
                //                     }
                //
                //
                //
                //                     // // console.log(window['redux_' + optName.replace( /\-/g, '_' )].required[id]);
                //                     // console.log(child);
                //                     // console.log('#' + optName + '-' + child);
                //                     // console.log(childFieldset);
                //                     // console.log(show);
                //                     // console.log(tr);
                //
                //                     if (true === show) {
                //
                //                         // Shim for sections.
                //                         if (childFieldset.hasClass('redux-container-section')) {
                //                             div = $('#section-' + child);
                //
                //                             if (div.hasClass('redux-section-indent-start') && div.hasClass('hide')) {
                //                                 $('#section-table-' + child).fadeIn(300).removeClass('hide');
                //                                 div.fadeIn(300).removeClass('hide');
                //                             }
                //                         }
                //
                //                         if (childFieldset.hasClass('redux-container-info')) {
                //                             $('#info-' + child).fadeIn(300).removeClass('hide');
                //                         }
                //
                //                         if (childFieldset.hasClass('redux-container-divide')) {
                //                             $('#divide-' + child).fadeIn(300).removeClass('hide');
                //                         }
                //
                //                         if (childFieldset.hasClass('redux-container-raw')) {
                //                             rawTable = childFieldset.parents().find('table#' + redux.optName.args.opt_name + '-' + child);
                //                             rawTable.fadeIn(300).removeClass('hide');
                //                         }
                //
                //
                //                         tr.fadeIn(
                //                             300,
                //                             function () {
                //                                 $(this).removeClass('hide');
                //                                 if (redux.optName.required.hasOwnProperty(child)) {
                //                                     $.redux.check_dependencies($('#' + redux.optName.args.opt_name + '-' + child).children().first());
                //                                 }
                //
                //                                 $.redux.initFields();
                //                             }
                //                         );
                //
                //                         if (childFieldset.hasClass('redux-container-section') || childFieldset.hasClass('redux-container-info')) {
                //                             tr.css({display: 'none'});
                //                         }
                //                     } else if (false === show) {
                //                         tr.fadeOut(
                //                             100,
                //                             function () {
                //                                 $(this).addClass('hide');
                //                                 if (redux.optName.required.hasOwnProperty(child)) {
                //                                     $.redux.required_recursive_hide(child);
                //                                 }
                //                             }
                //                         );
                //                     }
                //
                //                     current.find('select, radio, input[type=checkbox]').trigger('change');
                //                 }
                //             );
                //         // });
                // }
                //
                // obj_selector.find(" select, radio, input[type=checkbox], input[type=hidden], input[type=text]")
                //     .each(function () {
                //         check_dependencies(this);
                //     });
            };

            // var org_iniFields   = $.redux.initFields;
            // $.redux.initFields  = function(){
            //     console.log("Redux Init Fields");
            //   org_iniFields();
            // };

            // Edit element setting
            selector.find("[data-fl-control=edit]").off("click").on("click",function(event){
                event.preventDefault();
                var control = $(this),
                    main_wrap = control.closest(".redux-wrap-div"),
                    main_opt_name   = main_wrap.attr("data-opt-name"),
                    element = control.closest("[data-fl-element_type]"),
                    element_type = element.data("fl-element_type"),
                    form_setting = wp.template("field-tz_layout-settings-" + element_type);
                button_cache    = control;

                $(main_wrap).removeData("opt-name");

                if($("script#tmpl-field-tz_layout-settings-" + element_type).length) {
                    form_setting = form_setting();
                    var setting_obj = $(form_setting),
                        fields = setting_obj.find(".redux-field-container");

                    redux.field_objects.tz_layout.load_setting(setting_obj, element, selector, settings);

                    tz_required( setting_obj );
                    selector.tooltip("destroy");

                    var obj_id  = redux.field_objects.tz_layout.generateID();
                    setting_obj.attr("id", "modal-" + obj_id);

                    tzdialog(setting_obj, {
                        "title": setting_obj.data("fl-setting-title"),
                        "buttons": [
                            {
                                text: "Save changes",
                                class: "button button-primary",
                                click: function () {
                                    $(this).trigger("templaza-framework/setting/save/init", element, selector, settings);

                                    // Save change
                                    var setting = redux.field_objects.tz_layout.get_setting(element, selector, settings);

                                    redux.field_objects.tz_layout.modify_setting(setting, $(this), element, selector, settings);

                                    if (typeof setting.admin_label !== typeof undefined && element.hasClass("fl_content_element")) {
                                        if (element.find(".fl_element-title > .admin-label").length) {
                                            element.find(".fl_element-title > .admin-label").html(setting.admin_label);
                                        } else {
                                            element.find(".fl_element-title").append("<small class=\"admin-label\">" + setting.admin_label + "</small>");
                                        }
                                    }

                                    if (typeof templaza.shortcode !== typeof undefined) {
                                        var shortcode = templaza.shortcode;
                                        if (typeof shortcode[element_type] !== typeof undefined &&
                                            typeof shortcode[element_type]["save_setting"] !== typeof undefined) {
                                            shortcode[element_type]["save_setting"](setting, element, $(this));
                                        }
                                    }
                                    $(this).trigger("templaza-framework/setting/save/before",[element, selector, settings]);

                                    redux.field_objects.tz_layout.set_setting_to_field(settings, selector);

                                    $(this).trigger("templaza-framework/setting/save/after",[element, selector, settings]);

                                    $(this).dialog("close").dialog("destroy");
                                },
                            },
                            {
                                text: "Close",
                                class: "button button-secondary ms-2",
                                click: function () {
                                    $(this).trigger("templaza-framework/setting/close", [settings, selector]);
                                    $(this).dialog("close").dialog("destroy");
                                },
                            },
                        ],
                        "close": function (ev, ui) {
                            // $(this).remove();
                            redux.field_objects.tz_layout.init_tooltip(selector);
                        },
                        "create": function(event, ui){
                            if(!$(this).closest(".templaza-framework-options").length){
                                $(this).wrapInner("<div class=\"redux-container templaza-framework-options\"><div class='redux-main'></div></div>");
                            }
                        },
                        "open": function (event, ui) {
                            var shortcode = templaza.shortcode;
                            var _dialog = $(this);
                            fields  = _dialog.find(".redux-field-container");

                            // Trigger of shortcode
                            if(typeof shortcode !== typeof undefined){
                                if(typeof shortcode[element_type] !== typeof undefined &&
                                    typeof shortcode[element_type]["setting_edit_before_init_fields"] === "function"){
                                    shortcode[element_type]["setting_edit_before_init_fields"](fields, _dialog, element);
                                }
                            }

                            if (fields.length) {
                                main_wrap.data("opt-name", undefined);
                                main_wrap.removeData("data-opt-name");
                                fields.each(function () {
                                    var field = $(this),
                                        field_type = field.data("type"),
                                        tz_redux = redux.field_objects;

                                    if (typeof tz_redux[field_type] !== typeof undefined) {
                                        // if(field_type === "select"){
                                        //     field.find("select").data("dropdown-parent", _dialog.closest(".tzfrm-ui-dialog"));
                                        // }

                                        var tz_redux_field = tz_redux[field_type];

                                        // Before init field in setting edit
                                        // Trigger of shortcode (setting_edit_before_init_field)
                                        if(typeof shortcode !== typeof undefined){
                                            if(typeof shortcode[element_type] !== typeof undefined &&
                                                typeof shortcode[element_type]["setting_edit_before_init_field"] === "function"){
                                                shortcode[element_type]["setting_edit_before_init_field"](field, _dialog, element, selector, settings);
                                            }
                                        }

                                        // Before init field in setting edit
                                        // Trigger of field (setting_edit_before_init_field)
                                        if(field.length){
                                            // tz_redux_field  = tz_redux[field_type];
                                            if(typeof tz_redux_field.templaza_methods !== typeof undefined
                                                && typeof tz_redux_field.templaza_methods.setting_edit_before_init_field !== typeof undefined){
                                                tz_redux_field.templaza_methods.setting_edit_before_init_field(field, _dialog);
                                            }
                                        }

                                        tz_redux_field.init(field);

                                        // After init field in setting edit
                                        // Trigger of field (setting_edit_after_init_field)
                                        if(field.length){
                                            // tz_redux_field  = tz_redux[field_type];
                                            if(typeof tz_redux_field.templaza_methods !== typeof undefined
                                                && typeof tz_redux_field.templaza_methods.setting_edit_after_init_field !== typeof undefined){
                                                tz_redux_field.templaza_methods.setting_edit_after_init_field(field, _dialog);
                                            }
                                        }
                                        // After init field in setting edit
                                        // Trigger of shortcode (setting_edit_after_init_field)
                                        if(typeof shortcode !== typeof undefined){
                                            if(typeof shortcode[element_type] !== typeof undefined &&
                                                typeof shortcode[element_type]["setting_edit_after_init_field"] === "function"){
                                                shortcode[element_type]["setting_edit_after_init_field"](field, _dialog, element);
                                            }
                                        }
                                    }
                                    main_wrap.removeData("opt-name");
                                    main_wrap.removeData("data-opt-name");

                                });
                            }
                        },
                    }).dialog('open');
                }
            });

            // Edit grid
            selector.find("[data-fl-control=edit-grid]").off("click").on("click", function(event){
                event.preventDefault();
                var control = $(this),
                    row = control.closest("[data-fl-element_type]"),
                    grid_setting    = wp.template("field-tz_layout-settings__grid"),
                    grid_setting_obj    = $(grid_setting());

                grid_setting_obj.find(".fl-grid-item").off("click").on("click", function (e) {
                    e.preventDefault();
                    var $grid_item = $(this),
                        $cells   = $grid_item.data("cells"),
                        columns = row.find("> .fl_element-wrapper > .fl_container_for_children > [data-fl-element_type=column]");

                    if($cells !== "custom") {
                        $cells = $cells.toString().replace(/\s+/g, "").split("+");
                    }else{
                        var $custom  = prompt("Please enter custom grid size (eg. 2+3+6+1)");
                        if($custom.length){
                           $cells   = $custom.replace(/\s+/g, "").split("+");
                        }
                    }

                    if(typeof $cells !== "string" && $cells.length){
                        var $not    = '';
                        var row_setting = redux.field_objects.tz_layout.get_setting(row, selector, settings);
                        var col_htmls = [];
                        var col_settings = [];

                        $.each($cells, function(index, value){
                            var $new_col = wp.template('field-tz_layout-template-column'),
                                $col_data = {size: value};
                            if(columns.length){
                                var new_col_setting;

                                var $col =  columns.eq(index);
                                if($not){
                                    $not    += ",";
                                }
                                $not   += ":eq(" + index +")";

                                if($col.length){
                                    var $col_child = $col.find(">.fl_element-wrapper>.fl_column-container.fl_container_for_children");
                                    if(!$col_child.hasClass("fl_empty-container")){
                                        $col_data["element"]    = $col_child.html();
                                    }
                                }

                                var $new_col_obj    = $($new_col($col_data));
                                var $new_col_form   = $(wp.template("field-tz_layout-settings-column")());

                                if($col.length){
                                    new_col_setting = redux.field_objects.tz_layout.get_setting($col, selector, settings);
                                    new_col_setting.size    = $new_col_obj.data("column-width");
                                }else{
                                    new_col_setting = redux.field_objects.tz_layout.get_form_settings($new_col_form, $new_col_obj);
                                }

                                if( index === ($cells.length - 1) && columns.length && columns.length > $cells.length){

                                    var $child_settings = [];
                                    // // Insert all children settings
                                    $.each(columns.not($not), function(){
                                        var col = $(this),
                                            col_opt = redux.field_objects.tz_layout.get_setting(col, selector, settings);

                                        $child_settings = $child_settings.concat(col_opt.elements);
                                    });

                                    new_col_setting.elements    = new_col_setting.elements.concat($child_settings);

                                    $new_col_obj.find(".fl_container_for_children").first().append(columns.not($not)
                                            .find(">.fl_element-wrapper>.fl_column-container.fl_container_for_children")
                                            .children()).removeClass("fl_empty-container");
                                }

                                new_col_setting.id   = redux.field_objects.tz_layout.generateID();

                                col_settings.push(new_col_setting);
                                col_htmls.push($new_col_obj[0]);

                                // if(index === 0){
                                //     row.find(".fl_row_container.fl_container_for_children").first().html($new_col_obj);
                                // }else {
                                //     row.find(".fl_row_container.fl_container_for_children").first().append($new_col_obj);
                                // }

                                // sortable(selector);
                                // init_event();
                            }
                        });

                        row_setting.elements    = col_settings;

                        redux.field_objects.tz_layout.set_setting_to_field(settings, selector);

                        row.find(".fl_row_container.fl_container_for_children").first().html(col_htmls);
                    }

                    sortable(selector);
                    init_event();

                    grid_setting_obj.dialog("destroy");
                });

                tzdialog(grid_setting_obj,{
                    "title": grid_setting_obj.data("fl-setting-title"),
                    "close": function (ev, ui) {
                        $(this).remove();
                    },
                }).dialog('open');
            });
        };

        sortable(selector);
        // sortable_row(selector);
        // sortable_column(selector);
        init_event();
    };
})(jQuery);