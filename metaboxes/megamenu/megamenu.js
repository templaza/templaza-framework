(function($){
    "use strict";
    $.fn.templaza_megamenu  = function(options){

        var mega_dialog    = function(dialog_selector, options){
            var dialog_settings    = $.extend({}, {
                'dialogClass': 'tzfrm-ui-dialog',
                'modal': true,
                'autoOpen': false,
                'closeOnEscape': true,
                'draggable': false,
                "appendTo": $("body"),
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

        var mega_menu_setting_input = $("<input type=\"hidden\" name=\"_templaza_megamenu_settings\" id=\"_templaza_megamenu_settings\" value=\"\"/>");

        if(typeof templaza_metabox_megamenu !== typeof undefined) {
            mega_menu_setting_input.val(templaza_metabox_megamenu._templaza_megamenu_settings);
        }

        // Insert input after input hidden is menu
        $("#update-nav-menu .menu-edit input#menu").after(mega_menu_setting_input);

        var mega_menu_input = $("<input type=\"hidden\" name=\"_templaza_megamenu_layout\" id=\"_templaza_megamenu_layout\" value=\"\"/>");

        if(typeof templaza_metabox_megamenu !== typeof undefined) {
            mega_menu_input.val(templaza_metabox_megamenu._templaza_megamenu_layout);
        }
        // console.log(templaza_metabox_megamenu);

        // Insert input after input hidden is menu
        $("#update-nav-menu .menu-edit input#menu").after(mega_menu_input);

        // console.log(templaza_metabox_megamenu);
        var l10nStrings = templaza_metabox_megamenu.l10nStrings;
        var mega_button = $("<span>").addClass("button button-primary tz_mm_launch ")
            // .html(megamenu.launch_lightbox)
            .html("<i class=\"fas fa-box-open\"></i> " + l10nStrings.megamenu)
            .on("click", function(e) {
                e.preventDefault();

                if($("script#tmpl-templaza-metabox-megamenu-template").length) {

                    var control = $(this),
                        menu_item = control.closest(".menu-item");
                    var main_wrap = control.closest(".redux-wrap-div");
                    var form_setting = wp.template("templaza-metabox-megamenu-template");

                    var setting_obj = $(form_setting()),
                        fields = setting_obj.find(".redux-field-container");

                    var menu_item_id = 0;
                    // Get current menu item id
                    if(menu_item.length){
                        menu_item_id    = menu_item.find(".menu-item-data-db-id").val();
                        // Get current menu item slug
                        var menu_item_slug    = menu_item.find("input[data-tz-menu-slug]").val();
                        if(typeof menu_item_slug !== "undefined") {
                            menu_item_id = menu_item_slug;
                        }
                    }

                    var menu_item_setting = (menu_item_id && get_menu_item_settings(menu_item_id))?get_menu_item_settings(menu_item_id):[];


                    // Get child menus
                    var _menu_item_level    = get_menu_item_level(menu_item);
                    var _menu_item_childs   = menu_item.nextUntil(".menu-item-depth-"+ _menu_item_level,
                        ".menu-item-depth-"+ (_menu_item_level + 1));

                    // if(!_menu_item_childs.length){
                    //     console.log(_menu_item_childs);
                    //     console.log(_menu_item_childs.length);
                    //     var _parent_id = get_parent_menu_item_id(menu_item),
                    //         _parent_setting = _parent_id?get_menu_item_settings(_parent_id):get_main_settings();
                    //     console.log(_parent_id);
                    //     delete_menu_item_setting(_parent_setting, menu_item);
                    //     console.log(_parent_setting);
                    //     // delete_menu_item_setting(menu_item_setting, menu_item);
                    //     menu_item_setting = (menu_item_id && get_menu_item_settings(menu_item_id))?get_menu_item_settings(menu_item_id):[];
                    //     console.log(menu_item_setting);
                    //
                    // }

                    // Delete child menu moved
                    delete_menu_item_child_setting(menu_item_setting, _menu_item_childs);

                    // console.log("_menu_item_childs");
                    // console.log(_menu_item_childs);

                    // if(!_menu_item_childs.length){

                        var _column_setting_new = create_element_setting("column"),
                            _row_setting_new    = create_element_setting("row");

                        // Read, create and update setting
                        $.each(_menu_item_childs, function(){

                            var _menu_item_child    = $(this),
                                __menu_item_child_id = _menu_item_child.find(".menu-item-data-db-id").val(),
                                _menu_item_child_slug = _menu_item_child.find("input[data-tz-menu-slug]").val(),
                                _menu_item_child_id = typeof _menu_item_child_slug !== "undefined"?_menu_item_child_slug:__menu_item_child_id;

                            var _has_menu_child_item = menu_child_item_in_setting_exists(menu_item_setting, _menu_item_child_id);
                            // var _has_menu_child_item = menu_child_item_in_setting_exists(menu_item_setting, _menu_item_child_slug);

                            if(!_has_menu_child_item){
                                var _menu_child_item_setting = create_megamenu_item_setting(_menu_item_child);

                                if(!_has_menu_child_item && _menu_child_item_setting) {
                                    _column_setting_new.elements.push(_menu_child_item_setting);
                                }
                            }

                        });

                        if(_column_setting_new.elements.length){
                            _row_setting_new.elements.push(_column_setting_new);
                            menu_item_setting.push(_row_setting_new);

                        }
                    // }

                    setting_obj.find("#megamenu_layout").val("");

                    // Set mega menu layout
                    if(menu_item_setting) {
                        var _menu_item_setting  = JSON.stringify(menu_item_setting);
                        setting_obj.find("#megamenu_layout").val(_menu_item_setting).text(_menu_item_setting);

                        var _opt_name,
                            _opt_obj = setting_obj.find("form[data-opt-name]");
                        if(_opt_obj.length){
                            _opt_name   = _opt_obj.attr("data-opt-name");
                        }
                    }
                    tz_required(setting_obj);


                    var mega_dialog_options = {
                        "autoOpen": false,
                        "buttons": [
                            {
                                text: "Save changes",
                                class: "button button-primary",
                                click: function () {

                                    update_menu_item_settings(menu_item_id, $(this).find("#megamenu_layout").val());

                                    var menu_item    = $(this).find("form[data-opt-name=megamenu__item]").serializeForm();

                                    delete menu_item["megamenu__item"]["megamenu_layout"];
                                    update_menu_item_settings(menu_item_id, menu_item["megamenu__item"], mega_menu_setting_input);


                                    $(this).dialog("close").dialog("destroy");
                                },
                            },
                            {
                                text: "Close",
                                class: "button button-secondary ms-2",
                                click: function() {
                                    $( this ).dialog( "close" );
                                },
                            },
                        ],
                        "open": function (event, ui) {
                            // alert("Opened");
                            var _dialog = $(this);
                            fields  = _dialog.find(".redux-field-container");

                            // $.redux.tabCheck();
                            if (fields.length) {
                                var menu_setting = (menu_item_id && get_menu_item_settings(menu_item_id, mega_menu_setting_input))?get_menu_item_settings(menu_item_id, mega_menu_setting_input):[];
                                fields.each(function () {
                                    var field = $(this);

                                    // Set mega menu settings
                                    if(menu_setting) {
                                        var f_name  = field.attr("data-id");
                                        if(typeof menu_setting[f_name] !== typeof undefined){
                                            field.find("[name]").val(menu_setting[f_name]);
                                        }
                                    }
                                });
                            }

                            var org_iniFields   = $.redux.initFields;
                            $.redux.initFields  = function(){
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
                                                    tz_redux_field.templaza_methods.setting_edit_before_init_field(field, _dialog);
                                                }
                                            }

                                            tz_redux_field.init(field);

                                            // After init field in setting edit
                                            // Trigger of field (setting_edit_after_init_field)
                                            if(field.length){
                                                if(typeof tz_redux_field.templaza_methods !== typeof undefined
                                                    && typeof tz_redux_field.templaza_methods.setting_edit_after_init_field !== typeof undefined){
                                                    tz_redux_field.templaza_methods.setting_edit_after_init_field(field, _dialog);
                                                }
                                            }
                                        }

                                    });


                                    // $.redux.checkRequired(_dialog);
                                    // $.redux.initFields();
                                    // $.redux.tabCheck();
                                }
                                org_iniFields();
                            };
                            $.redux.tabCheck();

                            // $.redux.initFields();

                            // $.redux.tabCheck();
                        },
                    };

                    // Get menu title set to dialog
                    if(control.prevAll(".menu-item-title").length){
                        mega_dialog_options.title   = control.prevAll(".menu-item-title").text();
                    }

                    mega_dialog(setting_obj, mega_dialog_options).dialog('open');
                }
            });

        // Get main mega menu settings
        var get_main_settings = function(input_field){
            // var _settings = $("#tzfrm_metabox-tz_megamenu #_templaza_megamenu").val();
            if(typeof input_field === typeof undefined){
                input_field = mega_menu_input;
            }
            var _settings = input_field.val();

            return _settings.length?JSON.parse(_settings):{};
        };

        // Get menu item settings
        var get_menu_item_settings = function($menu_id, input_field){
            var _settings   = get_main_settings(input_field);

            return typeof _settings[$menu_id] !== typeof undefined?_settings[$menu_id]:false;
        };

        // Get id of menu item
        var get_menu_item_id = function($menu){
            return get_menu_by_option($menu, ".menu-item-data-db-id");
        };
        // Get id of menu item
        var get_menu_item_slug = function($menu){
            return get_menu_by_option($menu, "input[data-tz-menu-slug]");
        };
        // Get parent id of menu item
        var get_parent_menu_item_id = function($menu){
            return get_menu_by_option($menu, ".menu-item-data-parent-id");
        };

        // Get option of menu item
        var get_menu_by_option = function($menu, $find){
            if($menu === undefined || !$menu){
                return false;
            }
            if(!$menu.find($find).length){
                return false;
            }
            return parseInt($menu.find($find).val());
        };

        // Update menu item settings
        var update_menu_item_settings = function($menu_id, $new_settings, input_field){
            if(typeof input_field === typeof undefined){
                input_field = mega_menu_input;
            }

            var _settings   = get_main_settings(input_field);
            // var _settings   = get_menu_item_settings($menu_id);

            if(!$menu_id){
            // if(!$menu_id || !$new_settings){
                return;
            }
            // if(!$new_settings){
            //     delete _settings[$menu_id];
            //     set_settings_to_form_field(_settings, input_field);
            //     return;
            // }
            var _new_settings   = (typeof $new_settings === "string" && $new_settings)?JSON.parse($new_settings):$new_settings;
            _settings[$menu_id] = _new_settings;
            set_settings_to_form_field(_settings, input_field);
        };

        // Set settings to form field
        var set_settings_to_form_field = function($settings, input_field){
            if(!$settings || ($settings && typeof $settings === typeof undefined)){
                return;
            }
            $settings   = typeof $settings !== "string"?JSON.stringify($settings):$settings;

            if(typeof input_field === typeof undefined){
                input_field = mega_menu_input;
            }

            input_field.val($settings);
            // $("#tzfrm_metabox-tz_megamenu #_templaza_megamenu").val($settings);
        };

        /*  Get menu item level by class name.
        *   E.g: menu-item-depth-0, menu-item-depth-1
        *   @var $menu_item is jQuery Element
        * */
        var get_menu_item_level = function($menu_item){
            var mclass  = $menu_item!==undefined?$menu_item.attr("class"):'';
            // var mclass  = "menu-item menu-item-depth-12 menu-item-page menu-item-edit-inactive";
            mclass = mclass.length?mclass.match(/menu-item-depth-[0-9]+/):'';
            if(!mclass.length){
                return false;
            }
            mclass = mclass[0];
            return parseInt(mclass.replace("menu-item-depth-", ""));
        };

        /*  Create column setting.
        *   @var $element_type shortcode name. E.g: column, row,...
        * */
        function create_element_setting($shortcode_name){
            if(!$shortcode_name){
                return false;
            }
            var _element_shortcode;
            if($("#tmpl-field-tz_layout-template-" + $shortcode_name).length){
                _element_shortcode  =  wp.template("field-tz_layout-template-" + $shortcode_name);
            }else{
                _element_shortcode =  wp.template("field-tz_layout-template__element");
            }
            if(!_element_shortcode){
                return false;
            }
            var _element_setting_tmp = wp.template("field-tz_layout-settings-" + $shortcode_name),
                _element_setting_new = redux.field_objects.tz_layout.get_form_settings($(_element_setting_tmp()),$(_element_shortcode({})));
            _element_setting_new.id = redux.field_objects.tz_layout.generateID();

            return _element_setting_new;
        }

        /*  Create mega menu item setting.
        *   @var $menu_item is jQuery Element
        *  */
        function create_megamenu_item_setting($menu_item){

            var _element_setting_new = create_element_setting("megamenu_menu_item");

            if(!_element_setting_new){
                return _element_setting_new;
            }

            var _menu_item_child_title = $menu_item.find(".menu-item-title").text();
            _element_setting_new.params = {};

            _element_setting_new.params.tz_admin_label = _menu_item_child_title;
            // // _element_setting_new.menu_id = $menu_item.find(".menu-item-data-db-id").val();
            // _element_setting_new.menu_slug = $menu_item.find("input[data-tz-menu-slug]").val();
            if($menu_item.find("input[data-tz-menu-slug]").length) {
                _element_setting_new.menu_slug = $menu_item.find("input[data-tz-menu-slug]").val();
            }else{
                _element_setting_new.menu_id = $menu_item.find(".menu-item-data-db-id").val();
            }
            _element_setting_new.title = "Megamenu Menu Item";

            if (typeof templaza_metabox_megamenu !== typeof undefined) {
                _element_setting_new.title = templaza_metabox_megamenu.l10nStrings.menu_item;
            }
            _element_setting_new.admin_label = _menu_item_child_title;
            _element_setting_new["type"] = "megamenu_menu_item";

            return _element_setting_new;
        }

        /*  Create row setting has menu item.
        *   @var $menu_item is jQuery Element
        * */
        function create_row_setting_has_menu_item ($menu_item){
            if(!$menu_item){
                return false;
            }

            var _row_setting_new = create_element_setting("row"),
                _column_setting_new = create_element_setting("column"),
                _menu_child_item_setting = create_megamenu_item_setting($menu_item);

            if(!_row_setting_new || !_column_setting_new || !_menu_child_item_setting) {
                return false;
            }

            if(_menu_child_item_setting) {
                _column_setting_new.elements.push(_menu_child_item_setting);
            }

            if(_column_setting_new.elements.length){
                _row_setting_new.elements.push(_column_setting_new);
                return _row_setting_new;
            }

            return false;
        }

        // Check menu item exits in settings
        var menu_child_item_in_setting_exists = function($setting, $menu_id){
            var _has_menu_item = function($_setting){
                if($_setting && $_setting.type === "megamenu_menu_item"){
                    if(typeof $_setting.menu_slug !== "undefined" && $_setting.menu_slug === $menu_id){
                        return true;
                    }else if(typeof $_setting.menu_id !== "undefined" &&
                        parseInt($_setting.menu_id) === parseInt($menu_id)){
                        return true;
                    }
                }
            };

            var _result = tree_menu_setting($setting, _has_menu_item);

            _result = typeof _result !== typeof undefined?_result:false;

            return _result;
        };

        // Setting tree traversal
        var tree_menu_setting = function($tree, $callback, $_callback_after, $level = 0){

            var _result;

            var _tree_menu_setting = function($_tree, $_callback, $_callback_after) {
                $.each($_tree, function (index, value) {

                    if(typeof $_callback !== typeof undefined){
                        var _result_callback = $_callback(value, index, $_tree);
                        if(typeof _result_callback !== typeof undefined){
                            _result = _result_callback;
                        }
                    }

                    if(typeof _result !== typeof undefined){
                        return _result;
                    }

                    if (value !== undefined && typeof value.elements !== typeof undefined && value.elements.length) {
                        value.__has_element = true;
                        _tree_menu_setting(value.elements, $_callback, $_callback_after, $level);
                    }

                    if(typeof $_callback_after !== typeof undefined){
                        var _result_callback_after = $_callback_after(value, index, $_tree);
                        if(typeof _result_callback_after !== typeof undefined){
                            _result = _result_callback_after;
                        }
                    }
                    if(typeof _result !== typeof undefined){
                        return _result;
                    }

                });

                if(typeof _result !== typeof undefined){
                    return _result;
                }
            };

            _tree_menu_setting($tree, $callback, $_callback_after, $level);

          return _result;
        };

        /* Insert menu item setting
        * @var $src_setting The menu item setting need to insert
        * @var $dest_setting The menu item setting destination
        * @var $position position to insert
        * */
        var insert_menu_item_setting = function($src_setting, $dest_setting, $position = "last"){
            if($position === "last"){
                if($dest_setting !== null){
                        $dest_setting.push($src_setting);
                }
            }else if($position === "first"){
                if($dest_setting !== null){
                    $dest_setting.unshift($src_setting);
                }
            }else if(Number.isInteger($position)){
                if($dest_setting !== null){
                    $dest_setting.splice($position, 0, $src_setting);
                }
            }
        };

        /* Delete menu item setting
        * @var $menu is jQuery Element
        *  */
        function delete_menu_item_setting($setting, $menu){
            var _menu_id  = get_menu_item_slug($menu);
            // var _menu_id = get_menu_item_id($menu);
            var __delete_menu_item_setting    = function($_setting, $_index, $_tree){
                if($_setting && $_setting.type === "megamenu_menu_item" &&
                    (typeof $_setting.menu_id !== "undefined" || typeof $_setting.menu_slug !== "undefined")){
                    if (typeof $_setting.menu_slug !== "undefined" && $_setting.menu_slug === _menu_id) {
                        $_tree.splice($_index, 1);
                    }else if (typeof $_setting.menu_id !== "undefined" && parseInt($_setting.menu_id) === _menu_id) {
                        $_tree.splice($_index, 1);
                    }
                }

            };
            var __delete_menu_item_setting_after    = function($_setting, $_index, $_tree){
                if($_setting !== undefined && $_setting.__has_element !== undefined
                    && $_setting.__has_element && !$_setting.elements.length){
                    $_tree.splice($_index, 1);
                }

            };
            tree_menu_setting($setting, __delete_menu_item_setting, __delete_menu_item_setting_after);

            update_menu_item_settings(get_parent_menu_item_id($menu), $setting);

        }
        // Delete child menu moved
        var delete_menu_item_child_setting = function($setting, $menu_item_childs){
            var __delete_menu_item_child    = function($_setting, $_index, $_tree){
                if($_setting && $_setting.type === "megamenu_menu_item" &&
                    (typeof $_setting.menu_id !== typeof undefined || typeof $_setting.menu_slug !== "undefined")){
                    if ($menu_item_childs !== undefined && $menu_item_childs.length) {
                        var _has_menu_item_child    = false;
                        $.each($menu_item_childs, function () {
                            var _menu_item_child = $(this),
                                _menu_item_child_id = _menu_item_child.find(".menu-item-data-db-id").val(),
                                _menu_item_child_slug = _menu_item_child.find("input[data-tz-menu-slug]").val(),
                                _menu_item_child_title = _menu_item_child.find(".menu-item-title").text();

                            if (typeof $_setting.menu_slug !== "undefined" &&
                                $_setting.menu_slug === _menu_item_child_slug) {
                                _has_menu_item_child = true;
                            }else if (typeof $_setting.menu_id !== "undefined" &&
                                parseInt($_setting.menu_id) === parseInt(_menu_item_child_id)) {
                                _has_menu_item_child = true;
                            }

                        });
                        if(!_has_menu_item_child){
                            $_tree.splice($_index, 1);
                        }
                    } else {
                        $_tree.splice($_index, 1);
                    }
                }

            };
            var __delete_element_not_childs    = function($_setting, $_index, $_tree){
                if($_setting !== undefined && $_setting.__has_element !== undefined
                    && $_setting.__has_element && !$_setting.elements.length){
                    $_tree.splice($_index, 1);
                }

            };
            tree_menu_setting($setting, __delete_menu_item_child, __delete_element_not_childs);

        };
        var tz_required = function(obj_selector) {
            if(obj_selector.find("[data-opt-name]").length) {
                $.each(obj_selector.find("[data-opt-name]"), function(){
                    var _opt_name = $(this).attr("data-opt-name");
                    $.each(
                        window['redux_' + _opt_name].folds,
                        function (i, v) {
                            var div;
                            var rawTable;

                            var fieldset = obj_selector.find('#' + _opt_name + '-' + i);

                            fieldset.parents('tr:first, li:first').addClass('fold');

                            if ('hide' === v) {
                                fieldset.parents('tr:first, li:first').addClass('hide');

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

        $("#menu-to-edit li.menu-item").each(function() {

            var menu_item = $(this);

            menu_item.data("megamenu_has_button", "true");

            $(".item-title", menu_item).append(mega_button.clone(true));
        });

        // $(".megamenu_enabled #menu-to-edit")
        $("#menu-to-edit").on("mouseenter mouseleave", "li.menu-item", function() {
            var menu_item = $(this);

            if (!menu_item.data("megamenu_has_button")) {

                menu_item.data("megamenu_has_button", "true");

                $(".item-title", menu_item).append(mega_button.clone(true));
            }
            // tree_menu($("#menu-to-edit li.menu-item"));
        });
        $("#menu-to-edit").on("click", ".submitdelete", function() {
            var _btn = $(this),
                _menu_item = _btn.closest(".menu-item"),
                _menu_item_id = get_menu_item_id(_menu_item),
                _menu_item_setting = get_menu_item_settings(_menu_item_id),
                _menu_item_level = get_menu_item_level(_menu_item),
                _menu_item_childs = _menu_item.nextUntil(".menu-item-depth-"+ _menu_item_level ,
                    ".menu-item-depth-"+ (_menu_item_level+ 1) ),
                _parent_id = get_parent_menu_item_id(_menu_item),
                _parent_setting = _parent_id?get_menu_item_settings(_parent_id):get_main_settings();

            var _menu_item_position = _menu_item.prevAll(".menu-item-depth-"+ get_menu_item_level(_menu_item)).length;

            delete_menu_item_setting(_parent_setting, _menu_item);


            var _main_setting = get_main_settings(),
                _new_parent_id = get_parent_menu_item_id(_menu_item),
                _new_parent_setting = get_menu_item_settings(_new_parent_id);

            _new_parent_setting = _new_parent_setting?_new_parent_setting:[];

            if(_main_setting[_menu_item_id] !== undefined){
                delete _main_setting[_menu_item_id];
            }
            set_settings_to_form_field(_main_setting, mega_menu_input);

            if(_menu_item_childs.length){
                $.each(_menu_item_childs, function(){
                   var _menu_item_child = $(this),
                       _menu_item_child_setting = create_row_setting_has_menu_item(_menu_item_child);

                    insert_menu_item_setting(_menu_item_child_setting, _new_parent_setting, _menu_item_position++);
                });
            }

            if(!_new_parent_setting.length){
            //     insert_menu_item_setting(_menu_item_setting, _new_parent_setting, _menu_item_position);
            // }
            // else{
                _new_parent_setting.push(_menu_item_setting);
            }

            if(_new_parent_setting.length){
                update_menu_item_settings(_new_parent_id, _new_parent_setting,
                    $("#update-nav-menu #_templaza_megamenu_layout"));
            }

        });

        $("#nav-menu-meta").on("click", ".megamenu-save-option", function(e){
            e.preventDefault();

            var btn = $(this),
                spinner = btn.next(".spinner"),
                main_form = btn.closest("#nav-menu-meta");

            spinner.css("visibility", "visible");

            $.ajax({
                "url": templaza_metabox_megamenu.admin_ajax_url,
                "method": "POST",
                // "dataType": "json",
                "data": {
                    "action": templaza_metabox_megamenu.admin_ajax_action,
                    "menu": $("#menu").val(),
                    "megamenu_meta": main_form.find(".redux-container [name^=tzfrm_metabox-tz_megamenu]").serializeForm(),
                    "nonce": templaza_metabox_megamenu.admin_ajax_nonce,
                },
                "success": function(){
                    spinner.css("visibility", "hidden");
                }
            });
        });

        var menu_list_sortable = function(){

            if(window.wpNavMenu === undefined){
                return;
            }
            var tz_menuList    = window.wpNavMenu.menuList,
                menuList_Sortable    = tz_menuList.data("ui-sortable");

            if(menuList_Sortable !== undefined) {
                tz_menuList.on("sortstart", function(event, ui){
                    ui.item.data("templaza-megamenu-level", get_menu_item_level(ui.item));
                    ui.item.data("templaza-megamenu-parent-start", ui.item.find(".menu-item-data-parent-id").val());
                });
                tz_menuList.on("sortstop", function(event, ui){
                    var tz_menu_list = $(this);
                    setTimeout(
                        function(){
                            var _parent_menu_start_item_id = ui.item.data("templaza-megamenu-parent-start"),
                                _parent_menu_item_id = get_parent_menu_item_id(ui.item),
                                _menu_item_id = get_menu_item_id(ui.item);

                            var _parent_menu_start_item_setting = (_parent_menu_start_item_id
                                && get_menu_item_settings(_parent_menu_start_item_id))
                                ?get_menu_item_settings(_parent_menu_start_item_id):[];

                            var _menu_item_level    = ui.item.data("templaza-megamenu-level");
                            var _menu_item_childs   = tz_menu_list.find(".menu-item-depth-"+ _menu_item_level).not(ui.item);

                            if(_parent_menu_start_item_id > 0) {

                                // Remove item sortable setting before sort
                                // delete_menu_item_setting(_parent_menu_start_item_setting, ui.item);
                                // if(_menu_item_childs.length) {
                                //     delete_menu_item_child_setting(_parent_menu_start_item_setting, _menu_item_childs);
                                // }
                                delete_menu_item_child_setting(_parent_menu_start_item_setting, _menu_item_childs);

                                update_menu_item_settings(_parent_menu_start_item_id, _parent_menu_start_item_setting);
                            }

                            var _parent_menu_item_setting = (_parent_menu_item_id
                                && get_menu_item_settings(_parent_menu_item_id))
                                ?get_menu_item_settings(_parent_menu_item_id):[];
                            var _menu_item_setting = create_row_setting_has_menu_item(ui.item);

                            if(_parent_menu_item_setting.length) {
                                var _menu_item_position = ui.item.prevAll(".menu-item-depth-"+ get_menu_item_level(ui.item)).length;
                                insert_menu_item_setting(_menu_item_setting, _parent_menu_item_setting, _menu_item_position);
                            }
                            else{
                                _parent_menu_item_setting.push(_menu_item_setting);
                            }

                            if(_parent_menu_item_setting.length) {
                                update_menu_item_settings(_parent_menu_item_id, _parent_menu_item_setting,
                                    $("#update-nav-menu #_templaza_megamenu_layout"));
                            }

                            // console.log(get_main_settings());
                        },100);

                });
            }
        };
        menu_list_sortable();


    };

    $(document).ready(function(){
        $("#menu-to-edit").templaza_megamenu();
    });
})(jQuery);