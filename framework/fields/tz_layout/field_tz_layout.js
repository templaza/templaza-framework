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

        var field_tz_layout = templaza_field_tz_layout || {};
        redux.field_objects.tz_layout.i18n = field_tz_layout.i18n || {
            "name": "Name",
            "close": "Close",
            "search": "Search",
            "pasted": "Pasted!",
            "copied": "Copied!",
            "actions": "Actions",
            "created": "Created",
            "created_date": "Created date",
            "copy_failed": "Copy failed!",
            "section_added": "Section added!",
            "delete_question": "Are you sure?",
            "paste_failed": "Not Pasted! Please copy again.",
            "custom_column": "Please enter custom grid size (eg. 1-2;1-4;1-4 or auto;1-3;expand)"
        };

        $(selector).each(
            function () {
                var el = $(this),
                    el_inner = el.find(".js-field-tz_layout");
                var parent = el;
                var field_tz_layout = templaza_field_tz_layout || {};
                // var __i18n = templaza_field_tz_layout.i18n || {
                //     "copied": "Copied!",
                //     "pasted": "Pasted!",
                //     "delete_question": "Are you sure?",
                //     "copy_failed": "Copy failed!",
                //     "paste_failed": "Not Pasted! Please copy again.",
                //     "custom_column": "Please enter custom grid size (eg. 1-2;1-4;1-4 or auto;1-3;expand)"
                // };
                // redux.field_objects.tz_layout.i18n    = __i18n;
                var __i18n = redux.field_objects.tz_layout.i18n;
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

                el.data("allow_event", false);

                if(el.closest("td").length){
                    el.closest("td").attr("colspan", el.closest(".field-tz_layout-content").children().length);
                }

                var $settings,
                    $field = el.find("#"+el.data("id")),
                    $vals   = $field.val().trim();

                if($vals.length){
                    $settings  = JSON.parse($vals);
                }else{
                    $settings  = [];
                }

                var paste_button = function() {
                    var __settings_copied   = templaza.getClipboard("layout");
                    
                    if(typeof __settings_copied === "undefined"){
                        el.find(".js-paste-layout").attr("disabled", "");
                    }else{
                        el.find(".js-paste-layout").removeAttr("disabled");
                    }
                };

                paste_button();

                // Copy layout
                if(el.find(".js-copy-layout").length){
                    el.find(".js-copy-layout").on("click", function(e){
                        e.preventDefault();
                        var __settings  = $field.val().trim();

                        if(__settings.length) {
                            var __copied    = templaza.copyClipboard("layout", __settings);

                            paste_button();

                            if(__copied){
                                UIkit.notification({
                                    "message": __i18n.copied,
                                    "pos": "bottom-right"
                                });
                            }else{
                                UIkit.notification({
                                    "message": __i18n.copy_failed,
                                    "pos": "bottom-right"
                                });
                            }
                        }
                    });
                }
                // Paste layout
                if(el.find(".js-paste-layout").length){
                    el.find(".js-paste-layout").on("click", function(e){
                        e.preventDefault();

                        try {
                            var __settings_copied   = templaza.getClipboard("layout"),
                                __settings_str = (typeof __settings_copied === "object")?JSON.stringify(__settings_copied):__settings_copied;

                            $field.val(__settings_str).text(__settings_str);
                            $settings = (typeof __settings_copied === "string")?JSON.parse(__settings_copied):__settings_copied;

                            init_layout();

                            templaza.removeClipboard("layout");

                            paste_button();

                            UIkit.notification({
                                "message": __i18n.pasted,
                                "pos": "bottom-right"
                            });
                            return true;
                        }catch(e){
                            UIkit.notification({
                                "message": __i18n.paste_failed,
                                "pos": "bottom-right"
                            });

                            return false;
                        }
                    });
                }

                var init_layout = function(){
                    el.trigger("templaza-framework/field/tz_layout/init", [$settings]);

                    redux.field_objects.tz_layout.init_elements(el, $settings);

                    redux.field_objects.tz_layout.init_tooltip(el);

                    // redux.field_objects.tz_layout.init_source(el);
                    redux.field_objects.tz_layout.init_control(el, $settings);


                    el.trigger("templaza-framework/field/tz_layout/init/after", [$settings]);
                };

                init_layout();
                selector.on("init_layout", init_layout);
            });
    };

    /**
     * Generate settings to html
     * */
    redux.field_objects.tz_layout.generate_setting_to_html = function(settings, selector){
        if(settings){
            var $html = "";

            var $m_tree_html = [];
            var $m_level = -1;

            var tree_element = function(tree){
                $.each(tree, function(index, item){

                    var $m_item_tmp,
                        $m_item_tmp_data = $.extend(true, {}, item),
                        $m_params = $m_item_tmp_data.params;

                    delete $m_item_tmp_data.params;
                    delete $m_item_tmp_data.elements;

                    $m_level++;

                    if(typeof item.elements !== typeof undefined && item.elements.length){
                        tree_element(item.elements);
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

                    // Prepare default setting from shortcode element
                    if(typeof templaza.shortcode !== typeof undefined){
                        var element_type = item.type,
                            shortcode = templaza.shortcode;
                        if(typeof shortcode[element_type] !== typeof undefined &&
                            typeof shortcode[element_type]["init"] === "function"){
                            shortcode[element_type]["init"]($m_item_tmp_data, $m_params);
                        }
                    }

                    var $m_item_html = $m_item_tmp($m_item_tmp_data);

                    if(typeof selector !== "undefined") {
                        var $m_item_html_prepare = selector.triggerHandler("templaza-framework/field/tz_layout/shortcode/" +
                            item.type + "/prepare/html", [$m_item_html, $m_item_tmp_data, $m_params]);
                        if(typeof $m_item_html_prepare !== "undefined"){
                            $m_item_html  = $m_item_html_prepare;
                        }
                    }
                    if(typeof $m_tree_html[$m_level] === typeof undefined) {
                        $m_tree_html[$m_level] = $m_item_html;
                    }else{
                        $m_tree_html[$m_level] += $m_item_html;
                    }

                    $m_level --;
                });
            };
            tree_element(settings);

            if($m_tree_html.length) {
                $html   = $m_tree_html.shift();
            }

            return $html;
        }
        return '';
    };
    redux.field_objects.tz_layout.init_elements = function(selector, settings){
        if(settings){
            var $html = "";

            var $m_tree_html = [];
            var $m_level = -1;

            var tree_element = function(tree){
                $.each(tree, function(index, item){

                    var $m_item_tmp,
                        $m_item_tmp_data = $.extend(true, {}, item),
                        $m_params = $m_item_tmp_data.params;

                    delete $m_item_tmp_data.params;
                    delete $m_item_tmp_data.elements;

                    $m_level++;

                    if(typeof item.elements !== typeof undefined && item.elements.length){
                        tree_element(item.elements);
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

                    // Prepare default setting from shortcode element
                    if(typeof templaza.shortcode !== typeof undefined){
                        var element_type = item.type,
                            shortcode = templaza.shortcode;
                        if(typeof shortcode[element_type] !== typeof undefined &&
                            typeof shortcode[element_type]["init"] === "function"){
                            shortcode[element_type]["init"]($m_item_tmp_data, $m_params);
                        }
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
                });
            };
            tree_element(settings);

            if($m_tree_html.length) {
                $html   = $m_tree_html.shift();
                if($($html).find("[data-fl-element_type=section]").length) {
                    selector.find(".field-tz_layout-content").html($html);
                }else{
                    selector.find(".field-tz_layout-content").html("<div class=\"fl_column-container fl_column-section-container\">" + $html + "</div>");
                }
            }

        }
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

                var __opt_name   = field.closest("[data-opt-name]").attr("data-opt-name");
                var __reg    = new RegExp("^"+__opt_name+"\\[(.*?)\\]", "gi");
                f_name   = f_name.replace(__reg, "$1");

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

                                           field.val(f_value);
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
            }
            setting.params  = form_data;
        }

        setting.id   = redux.field_objects.tz_layout.generateID();

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
        selector.find("#"+selector.data("id")).val(settings_str).text(settings_str);
    };

    redux.field_objects.tz_layout.get_row_empty = function(){
        var row = wp.template('field-tz_layout-template-row');
        return row({element: redux.field_objects.tz_layout.get_column_empty()});
    };
    redux.field_objects.tz_layout.get_column_empty = function(){
        var column = wp.template('field-tz_layout-template-column');
        return  column({"size": "1-1"});
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
                    // var padding = ui.item.outerWidth() - ui.item.width(),
                    //     width   = Math.floor(ui.item.closest(".fl_row_container").width() / 100 * parseFloat(ui.item.css("flex").replace("0 0 ", "")));

                    ui.placeholder.html('<div class="uk-background-muted uk-width uk-height-1-1"></div>');
                    ui.placeholder.addClass(ui.item.attr("class"));
                    // ui.placeholder.width(width-padding);
                    // ui.placeholder.height(ui.item.outerHeight());
                    ui.placeholder.height(ui.helper.height());

                    $(this).data("fl-ui-old-index", ui.item.index());
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

                    ui.placeholder.html('<div class="uk-background-muted uk-width uk-height-1-1"></div>');
                    ui.placeholder.height(ui.helper.outerHeight());

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
                            var __src_column    = src_parent.closest(".fl_column");

                            if(__src_column.length){
                                __src_column.addClass("fl_empty-column");
                            }
                            init_event();
                        }

                        if(des_parent.length && des_parent.hasClass("fl_empty-container")){
                            des_parent.removeClass("fl_empty-container").off("click");
                            if(des_parent.closest(".fl_column").length) {
                                des_parent.closest(".fl_column").removeClass("fl_empty-column");
                            }
                        }
                    }
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
                    ui.placeholder.html('<div class="uk-background-muted uk-width uk-height-1-1"></div>');
                    var __col_margin    = ui.item.find(".fl_column").outerHeight(true) - ui.item.find(".fl_column").height();
                    // ui.placeholder.css("margin-bottom", "+=" + __col_margin);
                    ui.placeholder.height(ui.item.outerHeight() - __col_margin);

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
                placeholder: "fl-section-state-highlight fl-ui-state-highlight",
                forcePlaceholderSize: true,
                items: '[data-fl-element_type=section]',
                start: function( event, ui ) {
                    sort_selector.tooltip("destroy");
                    ui.placeholder.html('<div class="uk-background-muted uk-width uk-height-1-1"></div>');
                    // if(ui.item.hasClass("fl_content_element")) {
                    var __col_margin    = ui.item.find(".fl_column").outerHeight(true) - ui.item.find(".fl_column").height();
                    // ui.placeholder.css("margin-bottom", "+=" + __col_margin);
                    ui.placeholder.height(ui.item.outerHeight() - __col_margin);
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

        var tz_parent_modal_exists = function(el_selector){
            if(typeof el_selector.closest(".uk-modal") !== "undefined" && el_selector.closest(".uk-modal").length){
                return el_selector.closest(".uk-modal");
            }
            return false;
        };

        var tz_ui_modal  = function(dialog_selector, options){
            var __modal_title   = dialog_selector.data("modal-title");
            options = $.extend({},{
                "title": (typeof __modal_title !== "undefined")?__modal_title:"",
                // "container": selector,
                "stack": true,
                "current_target": undefined,
                "parent_modal_hide": false,
                "modal_class": "",
                "dialog_class": "",
                "buttons":[
                    {
                        text: "Close",
                        class: "uk-button uk-button-default",
                        click: function() {
                            // console.log($( this ).closest(".uk-modal"));
                            UIkit.modal($( this ).closest(".uk-modal")).hide();
                            // $( this ).closest(".uk-modal").dialog( "close" );
                        },
                    },
                ]
            }, options);

            __modal_title   = options.title;
            var __modal_html   = $('<div id="'+ Date.now() +'" class="uk-modal redux-container-tz_layout '+
                options.modal_class +'"><div class="uk-modal-dialog uk-width-4-5 '+
                options.dialog_class+'">\n' +
                '        <button class="uk-modal-close-default" type="button" data-uk-close></button>\n' +
                '        <div class="uk-modal-body" data-uk-overflow-auto></div>\n' +
                '    </div></div>');

            if(typeof __modal_title !== "undefined" && __modal_title.length){
                $('<div class="uk-modal-header">\n' +
                    '            <h2 class="uk-h4">'+ __modal_title +'</h2>\n' +
                    '        </div>').insertBefore(__modal_html.find(".uk-modal-body"));
            }
            if(options.buttons.length){
                var __modal_footer  = $('<div class="uk-modal-footer uk-text-right"></div>\n');
                $.each(options.buttons, function(index,button){
                    var __button    = $('<button type="button" class="'+ button.class +'">'+ button.text +'</button>');
                    __button.on("click", function () {
                        button.click.call(this);
                    });
                    __modal_footer.append(__button);
                });
                __modal_footer.appendTo(__modal_html.find(".uk-modal-dialog"));
            }
            __modal_html.find(".uk-modal-body").append(dialog_selector);
            var __uimodal = UIkit.modal(__modal_html, options);

            if(typeof options.current_target !== "undefined") {
                UIkit.util.on(__modal_html, "beforeshow", function () {
                    // Hide parent modal if it exists
                    var __parent_modal = tz_parent_modal_exists(options.current_target);

                    if (__parent_modal) {

                        var __main_field = options.current_target.closest("[data-type=tz_layout]");

                        if(__main_field.data("allow_event")){
                            var __parent_allow_event = true;

                            if(__parent_modal && typeof __parent_modal.data("allow_event") !== "undefined"){
                                __parent_allow_event  = __parent_modal.data("allow_event");
                            }
                            if(__parent_allow_event) {
                                __parent_modal.data("modal_shown", false);
                                UIkit.modal(__parent_modal).hide();
                            }
                        }
                    }
                });
            }

            var __org_opt_names = typeof redux.opt_names != "undefined"?redux.opt_names:[];

            UIkit.util.on(__modal_html, "shown", function(){

                if(__modal_html.find("[data-opt-name]").length) {
                    redux.opt_names = [];
                    $.each(__modal_html.find("[data-opt-name]"), function () {
                        var _opt_name = $(this).attr("data-opt-name");
                        if(redux.opt_names.indexOf(_opt_name) === -1) {
                            redux.opt_names.push(_opt_name);
                        }
                    });
                }
            });

            UIkit.util.on(__modal_html, "hidden", function(){
                redux.opt_names = __org_opt_names;

                if(typeof options.current_target !== "undefined") {
                    // Show parent modal if it exists
                    var __parent_modal = tz_parent_modal_exists(options.current_target);
                    if (__parent_modal) {


                        var __main_field = options.current_target.closest("[data-type=tz_layout]");

                        if(__main_field.data("allow_event")){
                            var __parent_allow_event = true;

                            if(__parent_modal && typeof __parent_modal.data("allow_event") !== "undefined"){
                                __parent_allow_event  = __parent_modal.data("allow_event");
                            }
                            if(__parent_allow_event) {
                                __parent_modal.data("modal_shown", true);
                                UIkit.modal(__parent_modal).show();
                            }
                        }
                    }
                }
            });

            var __methods   = ["beforeshow", "show", "shown", "beforehide", "hide", "hidden"];
            $.each(__methods, function (index, method) {
                if(typeof options[method] !== "undefined") {
                    UIkit.util.on(__modal_html, method, function () {
                        options[method].call(__modal_html);
                    });
                }
            });

            return __uimodal;
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
                        .find(">.fl_controls-column.bottom-controls").first();
                        // .addClass("d-block");

                    var dest_setting = redux.field_objects.tz_layout.get_setting(dest_element, selector, settings);
                    // Add setting
                    redux.field_objects.tz_layout.insert_setting(src_setting, dest_setting, settings, selector, pos);

                    selector.trigger("templaza-framework/field/tz_layout/action/add/shortcode/after",
                        [src_setting, element_dest, dest_setting]);
                    element_selector.trigger("templaza-framework/field/tz_layout/action/add/shortcode/after",
                        [src_setting, element_dest, dest_setting]);

                    if(element_selector.is(':ui-dialog')) {
                        element_selector.dialog("close");
                    }

                    if(typeof UIkit.modal !== "undefined" && item.closest(".uk-modal").length){
                        UIkit.modal(item.closest(".uk-modal")).hide();
                    }

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

                    tz_ui_modal(list_element_obj,{
                        "current_target": control,
                        "beforeshow":function(){
                            element_click_event($(this), control);
                        },
                        "hidden":function(){
                            $(this).remove();
                        }
                    }).show();

                    // tzdialog(list_element_obj, {
                    //     open: function( event, ui ) {
                    //         element_click_event($(this), control);
                    //     },
                    //     "close": function (ev, ui) {
                    //         $(this).remove();
                    //     }
                    // }).removeClass("hide").dialog('open');

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

                tz_ui_modal(list_element_obj, {
                    "current_target": element_empty,
                   "beforeshow":function(){
                       element_click_event($(this), element_empty);
                   },
                    "hidden": function () {
                        $(this).remove();
                    }
                }).show();

                // tzdialog(list_element_obj, {
                //     open: function( event, ui ) {
                //         element_click_event($(this), element_empty);
                //     },
                //     "close": function (ev, ui) {
                //         // button_cache   = null;
                //         $(this).remove();
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
                var __i18n = redux.field_objects.tz_layout.i18n;

                // if(section_empty){
                //     section_new = $(section_empty);
                // }else{
                //     section_new = $(redux.field_objects.tz_layout.get_row_empty());
                // }

                var __insert_blank_section = function(section_new) {
                    var pos = "last",
                        src_setting = redux.field_objects.tz_layout.generate_setting_element(section_new, selector, settings);

                    if (element.length) {
                        pos = element.parent().find("[data-fl-element_type=section]").index(element) + 1;
                        element.after(section_new);
                    } else {
                        if (!selector.find(".field-tz_layout-content > .fl_column-container.fl_column-section-container").length) {
                            var selector_child = $("<div>");
                            selector_child.attr("class", "fl_column-container fl_column-section-container");

                            if (!section_empty) {
                                selector_child.append(section_new).appendTo(selector.find(".field-tz_layout-content"));
                            } else {
                                selector_child.append(section_empty).appendTo(selector.find(".field-tz_layout-content"));
                            }
                        } else {
                            selector.find(".field-tz_layout-content > .fl_column-container.fl_column-section-container").append(section_new);
                        }
                    }

                    redux.field_objects.tz_layout.insert_setting(src_setting, null, settings, selector, pos);
                };

                var __insert_section_library = function(){
                    var __modal_html   = $('<div id="'+ Date.now() +'" class="uk-modal redux-container-tz_layout '+
                        '"><div class="uk-modal-dialog uk-width-4-5">\n' +
                        '        <button class="uk-modal-close-default" type="button" data-uk-close></button>\n' +
                        '        <div class="uk-modal-header">\n' +
                        '        <h2 class="uk-h4">Section Library</h2>\n' +
                        '        </div>\n' +
                        '        <div class="uk-modal-body uk-background-muted uk-position-relative" data-uk-overflow-auto>\n' +
                        '           <div class="uk-margin uk-clearfix">\n' +
                        '               <div class="uk-inline uk-float-right">\n' +
                        '                   <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: search"></span>\n' +
                        '                   <input class="uk-input uk-form-width-medium" id="form-s-search" type="search" placeholder="'+__i18n.search+'"/>\n' +
                        '               </div>\n' +
                        '           </div>\n' +
                        '           <div class="fl-library-items">\n' +
                        '           </div>\n' +
                        '        </div>\n' +
                        '        <div class="uk-modal-footer uk-text-right">\n' +
                        '            <button class="uk-button uk-button-default uk-modal-close" type="button">'+__i18n.close+'</button>\n' +
                        '        </div>\n' +
                        '    </div></div>');
                    var __loading = $('<div class="uk-position-cover uk-background-muted uk-flex uk-flex-center uk-flex-middle"><div data-uk-spinner></div></div>');

                    // __modal_html.find(".uk-modal-body").html(__loading);
                    __modal_html.find(".uk-modal-body").append(__loading);

                    var __table = $('        <table class="uk-table uk-table-divider">\n' +
                        '    <thead>\n' +
                        '        <tr>\n' +
                        '            <th class="uk-table-expand">'+__i18n.name+'</th>\n' +
                        '            <th>'+__i18n.created+'</th>\n' +
                        '            <th>'+__i18n.created_date+'</th>\n' +
                        '            <th class="uk-width-1-5">'+__i18n.actions+'</th>\n' +
                        '        </tr>\n' +
                        '    </thead>\n' +
                        '    <tbody class="uk-card uk-card-default">\n' +
                        '    </tbody>\n' +
                        '</table>');

                    var __ui_modal = UIkit.modal(__modal_html);
                    UIkit.util.on(__modal_html, "beforeshow", function () {
                        $.post(ajaxurl,{
                            // "action": "templaza-framework/field/tz_layout/action/templa",
                            "action": "templaza-framework/post_type/templaza_library/get_data",
                            "post_type": "templaza_library",
                            "editor_post_id": "",
                        }, function(response){
                            if(typeof response !== "undefined"){
                                if(typeof response.success !== "undefined" && response.success){
                                    var __items = response.data;
                                    if(__items.length){

                                        // Search
                                        __modal_html.find("#form-s-search").on("keyup", function (e) {

                                            var __elsearch     = $(this),
                                                __find_text   = __elsearch.val();

                                            __table.find("tbody").html("");
                                            if(__find_text.length) {
                                                var __patt = new RegExp(__find_text, 'ig');

                                                $.grep(__items, function (source_data, index) {
                                                    var __finded = __patt.exec(source_data.title);

                                                    if (__finded) {
                                                        // Display source html found
                                                        __insert_item(source_data);
                                                    }
                                                });
                                            }else{
                                                $.grep(__items, function (source_data, index) {
                                                    // Display source html found
                                                    __insert_item(source_data);
                                                });
                                            }
                                        });
                                        var __insert_item = function(item, i){

                                            var __tr    = '<tr>\n' +
                                                '   <td><strong>'+ item.title +'</strong></td>\n' +
                                                '   <td>'+item.author+'</td>\n' +
                                                '   <td>'+item.human_date+'</td>\n' +
                                                '   <td>' +
                                                '       <button class="uk-button uk-button-primary uk-button-small fl-lib-insert" type="button"><span data-uk-icon="icon: download; ratio: 0.8"></span> Insert</button>';

                                            if(typeof item.lib_id !== "undefined" && item.lib_id) {
                                                __tr += '       <button class="uk-button uk-button-danger uk-button-small fl-lib-delete" type="button"><span data-uk-icon="trash"></span> Delete</button>';
                                            }

                                            __tr    += '   </td>\n' +
                                                '</tr>\n';
                                            __tr    = $(__tr);

                                            if(typeof i !== "undefined" && i === 0){
                                                __table.find("tbody").html("");
                                                __tr.css("border-top", "none");
                                            }

                                            // Insert section trigger
                                            __tr.find(".fl-lib-insert").on("click", item, function(event){
                                                if(typeof event.data !== "undefined"){
                                                    var __item = event.data;

                                                    if(typeof __item.lib_id !== "undefined" && __item.lib_id){
                                                        var __pos   = "last";

                                                        var __new_html  = redux.field_objects.tz_layout.generate_setting_to_html([__item.lib_data], selector);
                                                        // Insert html
                                                        if(__new_html.length){
                                                            if(element.length) {
                                                                element.after(__new_html);
                                                                __pos = element.parent().find("[data-fl-element_type=section]").index(element) + 1;
                                                            }else{
                                                                selector.find(".field-tz_layout-content").append(__new_html);
                                                            }
                                                        }

                                                        // Insert settings
                                                        redux.field_objects.tz_layout.insert_setting(__item.lib_data, null, settings, selector, __pos);
                                                    }else {
                                                        __insert_blank_section($(redux.field_objects.tz_layout.get_section_empty()));
                                                    }

                                                    selector.trigger("templaza-framework/field/tz_layout/shortcode/section/add/after");

                                                    sortable(selector);
                                                    init_event();

                                                    if(__ui_modal){
                                                        // Disable lightbox
                                                        __ui_modal.hide();
                                                        UIkit.notification(__i18n.section_added, {status: "success", pos: "bottom-right", timeout: 700});
                                                    }
                                                }
                                            });

                                            // Delete section trigger
                                            __tr.find(".fl-lib-delete").on("click", item, function(event){

                                                if(typeof event.data === "undefined") {
                                                    return;
                                                }
                                                var __tr_cur = $(this).closest("tr"),
                                                    __item = event.data;

                                                UIkit.modal.confirm(__i18n.delete_question,{
                                                    "stack": true,
                                                }).then(function () {
                                                    $.post(ajaxurl, {
                                                        "action": "templaza-framework/post_type/templaza_library/remove_data",
                                                        "post_type": "templaza_library",
                                                        "lib_id": __item.lib_id,
                                                    }, function (response) {
                                                        if(response.success){
                                                            __tr_cur.remove();
                                                            UIkit.notification(response.data, {status: "success", pos: "bottom-right", timeout: 700});
                                                        }
                                                    });
                                                });
                                            });
                                            __table.find("tbody").append(__tr);
                                        };
                                        $.each(__items, function (i, item) {
                                            __insert_item(item, i);
                                        });

                                        __loading.hide();
                                        __modal_html.find(".uk-modal-body .fl-library-items").html(__table);
                                    }
                                }
                            }
                        });
                    });
                    __ui_modal.show();
                };

                if(section_empty){
                    __insert_section_library();
                }else{
                    __insert_blank_section($(redux.field_objects.tz_layout.get_row_empty()));

                    selector.trigger("templaza-framework/field/tz_layout/shortcode/section/add/after");

                    sortable(selector);
                    init_event();
                }
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

            // Save Section
            UIkit.util.on("[data-fl-control=save]", "click", function (e) {
                e.preventDefault();
                e.target.blur();
                var __control = $(this);
                var __loading = $('<div id="tz_loading_page" class="uk-position-fixed uk-position-cover uk-position-z-index uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle">\n' +
                    '    <div data-uk-spinner="ratio: 2"></div>\n' +
                    '</div>');
                var __modal = UIkit.modal.prompt("Enter name of this section:", "").then(function (name) {
                    if(name && name.length){
                        var __element = __control.closest("[data-fl-element_type]");
                        // Get my section
                        var __sec_settings = redux.field_objects.tz_layout.get_setting(__element, selector, settings);

                        __loading.appendTo("body");
                        $.ajax({
                            url: ajaxurl,
                            method: 'POST',
                            data: {
                                // page: "tzfrm_alita_opt_options",
                                // page: adminpage,
                                post_type: "templaza_library",
                                title: name,
                                action: "templaza-framework/field/tz_layout/action/save_section",
                                section: JSON.stringify(__sec_settings),
                            }
                        }).done(function(response){
                            var __notice_status   = "danger";
                            if(response.success){
                                __notice_status   = "success";
                            }
                            __loading.remove();
                            UIkit.notification(response.message, {status: __notice_status, pos: "bottom-right"});
                        });
                    }
                });
            });

            // Delete element
            selector.find("[data-fl-control=delete]").off("click").on("click", function(event){
                event.preventDefault();
                var control = $(this),
                    element = control.closest("[data-fl-element_type]"),
                    access  = true;
                var parent  = element.parent();

                if(element.data("fl-element_type") === "row"){
                    if(parent.find("> [data-fl-element_type=row]").length === 1 || element.find("[data-fl-element_type=megamenu_menu_item]").length){
                        access  = false;
                    }
                }else if(element.data("fl-element_type") === "column"){
                    if(parent.find("[data-fl-element_type=column]").length === 1 || element.find("[data-fl-element_type=megamenu_menu_item]").length){
                        access  = false;
                    }
                }
                if(access) {

                    var __confirm_opt   = {
                        "stack": true,
                    };

                    var __m_uikit_modal = control.closest(".uk-modal");

                    if(typeof __m_uikit_modal !== "undefined") {
                        __m_uikit_modal.data("modal_shown", false);
                    }

                    var result  = UIkit.modal.confirm(redux.field_objects.tz_layout.i18n.delete_question,
                        __confirm_opt ).then(function() {
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

                        // if(typeof __m_uikit_modal !== "undefined"){
                        //     UIkit.modal(__m_uikit_modal).show();
                        //     __m_uikit_modal.data("modal_shown", true);
                        // }
                    },function(){
                        // if(typeof __m_uikit_modal !== "undefined"){
                        //     UIkit.modal(__m_uikit_modal).show();
                        //     __m_uikit_modal.data("modal_shown", true);
                        // }

                    });
                    // var result  = confirm("Are you sure?");
                    // if(result){
                    //
                    //     var element_index = element.index(),
                    //         parent_element = element.parents("[data-fl-element_type]").first(),
                    //         parent_setting  = redux.field_objects.tz_layout.get_setting(parent_element, selector, settings),
                    //     element_setting = (typeof parent_setting !== typeof undefined && parent_setting.elements[element_index])?parent_setting.elements[element_index]:{};
                    //
                    //     selector.trigger("templaza-framework/field/tz_layout/action/delete/shortcode/setting/before",
                    //             [element, element_setting, parent_setting]);
                    //     control.trigger("templaza-framework/field/tz_layout/action/delete/shortcode/setting/before", [element, element_setting, parent_setting]);
                    //
                    //     if(typeof parent_setting !== typeof undefined){
                    //         parent_setting.elements.splice(element_index, 1);
                    //     }else{
                    //         settings.splice(element_index, 1);
                    //     }
                    //
                    //     redux.field_objects.tz_layout.set_setting_to_field(settings, selector);
                    //
                    //     selector.trigger("templaza-framework/field/tz_layout/action/delete/shortcode", [element, element_setting, parent_setting]);
                    //     control.trigger("templaza-framework/field/tz_layout/action/delete/shortcode", [element, element_setting, parent_setting]);
                    //
                    //     element.remove();
                    //
                    //     if(parent.hasClass("fl_column-container fl_container_for_children") && !parent.find("[data-fl-element_type]").length){
                    //         var column = wp.template("field-tz_layout-template-column");
                    //         parent.closest("[data-fl-element_type]").after(column({
                    //             size: parent.closest("[data-fl-element_type]").attr("data-column-width")
                    //         })).remove();
                    //     }
                    //
                    //     selector.trigger("templaza-framework/field/tz_layout/action/delete/shortcode/after");
                    //     control.trigger("templaza-framework/field/tz_layout/action/delete/shortcode/after");
                    //
                    //     sortable(selector);
                    //     init_event();
                    // }
                }
            });

            var tz_required = function(obj_selector) {

                // Hide the fold elements on load.
                // It's better to do this by PHP but there is no filter in tr tag , so is not possible
                // we going to move each attributes we may need for folding to tr tag.
                $.each(
                    /*redux.opt_names,*/
                    obj_selector.find("[data-opt-name]"),
                    function( x ) {
                        var _opt_name = $(this).attr("data-opt-name");
                        // console.log(x);
                        // console.log(_opt_name);
                        $.each(
                            window['redux_' + _opt_name.replace( /\-/g, '_' )].folds,
                            // window['redux_' + redux.opt_names[x].replace( /\-/g, '_' )].folds,
                            function( i, v ) {
                                var div;
                                var rawTable;

                                var fieldset = obj_selector.find( '#' + _opt_name + '-' + i );
                                // var fieldset = obj_selector.find( '#' + redux.opt_names[x] + '-' + i );

                                fieldset.parents( 'tr:first, li:first' ).addClass( 'fold' );

                                // console.log($.redux.check_parents_dependencies(i));
                                // //
                                // // console.log(obj_selector.find("form[data-opt-name]"));
                                // console.log(i);
                                // console.log(v);
                                // console.log(_opt_name);

                                if ( 'hide' === v ) {
                                    fieldset.parents( 'tr:first, li:first' ).addClass( 'hide' );

                                    if(typeof window['redux_' + _opt_name.replace( /\-/g, '_' )].required_child !== "undefined"
                                        && !$.redux.check_parents_dependencies(i)) {
                                        fieldset.parents('tr:first, li:first').addClass('hide');
                                    }

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
            };

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

                    // tz_required( setting_obj );

                    selector.tooltip("destroy");

                    var obj_id  = redux.field_objects.tz_layout.generateID();
                    setting_obj.attr("id", "modal-" + obj_id);

                    tz_ui_modal(setting_obj, {
                        "current_target": control,
                        "title": setting_obj.data("fl-setting-title"),
                        "buttons": [
                            {
                                text: "Save changes",
                                class: "uk-button uk-button-primary js-field-tz_layout-save-el-setting",
                                click: function () {
                                    $(this).closest(".uk-modal").trigger("templaza-framework/setting/save/init", element, selector, settings);

                                    // Save change
                                    var setting = redux.field_objects.tz_layout.get_setting(element, selector, settings);

                                    redux.field_objects.tz_layout.modify_setting(setting, $(this).closest(".uk-modal"), element, selector, settings);

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
                                            shortcode[element_type]["save_setting"](setting, element, $(this).closest(".uk-modal"));
                                        }
                                    }

                                    $(this).trigger("templaza-framework/setting/save/before",[setting, element, selector, settings]);

                                    redux.field_objects.tz_layout.set_setting_to_field(settings, selector);

                                    $(this).trigger("templaza-framework/setting/save/after",[setting, element, selector, settings]);

                                    // redux.optName.args.opt_name = control.closest("form.redux-form-wrapper").attr("data-opt-name");
                                    UIkit.modal($( this ).closest(".uk-modal")).hide();
                                },
                            },
                            {
                                text: "Close",
                                class: "uk-button uk-button-default uk-margin-small-left",
                                click: function () {
                                    $(this).trigger("templaza-framework/setting/close", [settings, selector]);

                                    // redux.optName.args.opt_name = control.closest("form.redux-form-wrapper").attr("data-opt-name");
                                    UIkit.modal($( this ).closest(".uk-modal")).hide();
                                },
                            },
                        ],
                        "hidden": function () {
                            $(this).remove();

                            redux.field_objects.tz_layout.init_tooltip(selector);
                        },
                        "beforeshow": function(){
                            if(!$(this).closest(".templaza-framework-options").length){
                                $(this).find(".uk-modal-body").children().wrapInner("<div class=\"redux-container templaza-framework-options\"><div class='redux-main uk-margin-remove-left'></div></div>");
                            }
                        },
                        "shown": function () {

                            // $.redux.required();

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

                                // tz_required( _dialog );
                                // $.redux.checkRequired(_dialog.find(".redux-container"));

                                main_wrap.data("opt-name", undefined);
                                main_wrap.removeData("data-opt-name");
                                fields.each(function () {
                                    var field = $(this),
                                        field_type = field.data("type"),
                                        tz_redux = redux.field_objects;


                                    if (typeof tz_redux[field_type] !== "undefined") {

                                        var tz_redux_field = tz_redux[field_type];

                                        // Before init field in setting edit
                                        // Trigger of shortcode (setting_edit_before_init_field)
                                        if(typeof shortcode !== "undefined"){
                                            if(typeof shortcode[element_type] !== "undefined" &&
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
                                        // $.redux.check_dependencies(field.find(" input,  textarea, select"));
                                        redux_change(field.find(" input,  textarea, select"));

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

                                $.redux.checkRequired(_dialog.find(".redux-container"));


                                // $.redux.required();
                                // tz_required( _dialog );

                            }
                        },
                    }).show();
                }
            });

            // Edit grid
            selector.find("[data-fl-control=edit-grid]").off("click").on("click", function(event){
                event.preventDefault();
                var control = $(this),
                    row = control.closest("[data-fl-element_type]"),
                    grid_setting    = wp.template("field-tz_layout-settings__grid"),
                    grid_setting_obj    = $(grid_setting());

                var __m_uikit_modal = control.closest(".uk-modal");

                grid_setting_obj.find(".fl-grid-item").off("click").on("click", function (e) {
                    e.preventDefault();
                    var $grid_item = $(this),
                        $cells   = $grid_item.data("cells"),
                        columns = row.find("> .fl_element-wrapper > .fl_container_for_children > [data-fl-element_type=column]");

                    var __grid_item_modal   = typeof $grid_item.closest(".uk-modal") !== "undefined"?$grid_item.closest(".uk-modal"):false;

                    if($cells !== "custom") {
                        // control.data("modal_shown",true);
                        __grid_item_modal.data("modal_shown",true);
                        $cells = $cells.toString().replace(/\s+/g, "").split(/\+|,|;/);
                    }else{
                        if(typeof __m_uikit_modal !== "undefined") {
                            __m_uikit_modal.data("allow_event", false);
                        }

                        __grid_item_modal.data("modal_shown",false);

                        /* Use UIkit modal dialog */
                        UIkit.modal.prompt(redux.field_objects.tz_layout.i18n.custom_column, "",{
                            "container": true,
                            "stack": true,
                        }).then(function ($custom) {
                            // Set allow event to show or hide parent modal
                            if(typeof __m_uikit_modal !== "undefined") {
                                __m_uikit_modal.data("allow_event", true);
                            }
                            if($custom === null || !$custom.length){
                                if(__grid_item_modal){
                                    UIkit.modal(__grid_item_modal).show();
                                }
                                return true;
                            }

                            if(__grid_item_modal){
                                __grid_item_modal.data("modal_shown",true);
                                UIkit.modal(__grid_item_modal).hide();
                            }

                            if($custom.length) {
                                $cells = $custom.replace(/\s+/g, "").split(/\+|,|;/);
                                set_cells($cells);
                                sortable(selector);
                                init_event();

                                return true;

                            }

                        });

                        // /* Use jquery ui dialog */
                        // var $custom  = prompt("Please enter custom grid size (eg. 1-2;1-4;1-4)");
                        // if($custom && $custom.length){
                        //    $cells   = $custom.replace(/\s+/g, "").split(/\+|,|;/);
                        // }
                    }

                    function set_cells($cells) {
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

                                        var __not_empty_child   = columns.not($not)
                                            .find(">.fl_element-wrapper>.fl_column-container.fl_container_for_children")
                                            .children();
                                        if(__not_empty_child.length) {
                                            $new_col_obj.find(".fl_container_for_children").first()
                                                .append(__not_empty_child).removeClass("fl_empty-container");
                                        }
                                    }

                                    new_col_setting.id   = redux.field_objects.tz_layout.generateID();

                                    col_settings.push(new_col_setting);
                                    col_htmls.push($new_col_obj[0]);
                                }
                            });

                            row_setting.elements    = col_settings;

                            redux.field_objects.tz_layout.set_setting_to_field(settings, selector);

                            row.find(".fl_row_container.fl_container_for_children").first().html(col_htmls);
                        }
                    }

                    set_cells($cells);

                    sortable(selector);
                    init_event();

                    if (grid_setting_obj.is(':ui-dialog')) {
                        grid_setting_obj.dialog("destroy");
                    }

                    // if(typeof __uimodal !== "undefined"){
                    //     __uimodal.hide();
                    // }
                    if(__grid_item_modal){
                        UIkit.modal(__grid_item_modal).hide();
                    }
                });

                tz_ui_modal(grid_setting_obj,{
                    "title": grid_setting_obj.data("fl-setting-title"),
                    "dialog_class": "",
                    "current_target": control,
                    "beforeshow": function(){
                        $(this).find(".uk-modal-body").attr("data-uk-overflow-auto","");
                    },
                    "hidden": function(){
                        // if(typeof control.data("modal_shown") === "undefined" || control.data("modal_shown")) {
                        if(typeof $(this).data("modal_shown") === "undefined" || $(this).data("modal_shown")) {
                            $(this).remove();
                        }
                    }
                }).show();

                // tzdialog(grid_setting_obj,{
                //     "title": grid_setting_obj.data("fl-setting-title"),
                //     "close": function (ev, ui) {
                //         $(this).remove();
                //     },
                // }).dialog('open');
            });
            // console.log("init event");
        };

        sortable(selector);
        init_event();
    };
})(jQuery);