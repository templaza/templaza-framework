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
                        class: "button button-secondary ml-2",
                        click: function() {
                            $( this ).dialog( "close" );
                        },
                    },
                ]
            }, options);

            return dialog_selector.dialog(dialog_settings).removeClass("hide");
        };

        var mega_button = $("<span>").addClass("button button-primary mm_launch")
            // .html(megamenu.launch_lightbox)
            .html("<i class=\"fas fa-box-open\"></i> TZ Mega Menu")
            .on("click", function(e) {
                e.preventDefault();

                if($("script#tmpl-templaza-metabox-megamenu-template").length) {

                    var control = $(this);
                    var main_wrap = control.closest(".redux-wrap-div");
                    var form_setting = wp.template("templaza-metabox-megamenu-template");

                    var setting_obj = $(form_setting()),
                        fields = setting_obj.find(".redux-field-container");

                    setting_obj.find("#megamenu_layout").val("");

                    if($("#tzfrm_metabox-tz_megamenu #_templaza_megamenu").length) {
                        // Get menu id
                        var menu_item   = control.closest(".menu-item"),
                            menu_item_id = 0;

                        if(menu_item.length){
                            menu_item_id    = menu_item.find(".menu-item-data-db-id").val();
                        }

                        if(menu_item_id) {
                            var megamenu_layout = $("#tzfrm_metabox-tz_megamenu #_templaza_megamenu").val();

                            if(megamenu_layout.length){
                                megamenu_layout = JSON.parse(megamenu_layout);
                                if(typeof megamenu_layout[menu_item_id]){
                                    setting_obj.find("#megamenu_layout").val(JSON.stringify(megamenu_layout[menu_item_id]));
                                    // console.log(megamenu_layout[menu_item_id]);
                                }
                            }
                        }

                        // console.log($("#tzfrm_metabox-tz_megamenu #megamenu_layout"));
                        // console.log(megamenu_layout);
                        // console.log(typeof megamenu_layout);
                        // console.log(megamenu_layout);
                        // console.log(JSON.stringify(megamenu_layout[2580]));
                        // setting_obj.find("#megamenu_layout").val(JSON.stringify(megamenu_layout[2580]));
                    }
                    // setting_obj.find("#megamenu_layout")
                    //     .val('[{"type":"row","elements":[{"type":"column","elements":[{"type":"megamenu_menu_item", "title":"Megamenu Menu Item", "admin_label": "New Style 2020 - Single Portfolio", "params":{}}],"params":{"tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"text_color":"","link_color":{"regular":"","hover":"","active":""},"xs_colum_size":"","xs_visibility":"","sm_colum_size":"","sm_visibility":"","md_colum_size":"","md_visibility":"","lg_colum_size":"","lg_visibility":"","xl_colum_size":"","xl_visibility":""},"size":12,"id":"291601538988002"}],"params":{"test":"","tz_customclass":"","tz_customid":"","background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"hideonxs":"","hideonsm":"","hideonmd":"","hideonlg":"","hideonxl":""},"id":"951601538987998"}]');
                    mega_dialog(setting_obj, {
                        'autoOpen': false,
                        "open": function (event, ui) {
                            var _dialog = $(this);
                            fields  = _dialog.find(".redux-field-container");
                            if (fields.length) {
                                main_wrap.data("opt-name", undefined);
                                main_wrap.removeData("data-opt-name");
                                fields.each(function () {
                                    var field = $(this),
                                        field_type = field.data("type"),
                                        tz_redux = redux.field_objects;
                                    if (typeof tz_redux[field_type] !== typeof undefined) {
                                        var tz_redux_field;

                                        // Before init field in setting edit
                                        // Trigger of field (setting_edit_before_init_field)
                                        if(field.length){
                                            tz_redux_field  = tz_redux[field_type];
                                            if(typeof tz_redux_field.templaza_methods !== typeof undefined
                                                && typeof tz_redux_field.templaza_methods.setting_edit_before_init_field !== typeof undefined){
                                                tz_redux_field.templaza_methods.setting_edit_before_init_field(field, _dialog);
                                            }
                                        }

                                        tz_redux[field_type].init(field);

                                        // After init field in setting edit
                                        // Trigger of field (setting_edit_after_init_field)
                                        if(field.length){
                                            tz_redux_field  = tz_redux[field_type];
                                            if(typeof tz_redux_field.templaza_methods !== typeof undefined
                                                && typeof tz_redux_field.templaza_methods.setting_edit_after_init_field !== typeof undefined){
                                                tz_redux_field.templaza_methods.setting_edit_after_init_field(field, _dialog);
                                            }
                                        }
                                    }
                                    // main_wrap.removeData("opt-name");
                                    // main_wrap.removeData("data-opt-name");

                                });
                            }

                        },
                    }).dialog('open');
                }
                // if (!$("body").hasClass("megamenu_enabled")) {
                //     // alert(megamenu.is_disabled_error);
                //     return;
                // }

                // $(this).megaMenu({
                //     menu_item_id: id
                // });
            });

        var tree_menu   = function(tree){
            $.each(tree, function(index, item){
                var el  = $(this);
                var parent_id   = el.find(".menu-item-data-parent-id").val();
                // console.log(parent_id);

                // Get menu level by class
                // var menu_level =
                var mclass  = el.attr("class");
                // var mclass  = "menu-item menu-item-depth-12 menu-item-page menu-item-edit-inactive";
                mclass = mclass.match(/menu-item-depth-[0-9]+/);
                if(mclass.length){
                    mclass = mclass[0];
                    var mlevel  = mclass.replace("menu-item-depth-", "");
                    // console.log(mlevel);
                }
            });
        };

        tree_menu($("#menu-to-edit li.menu-item"));

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
            tree_menu($("#menu-to-edit li.menu-item"));
        });


    };
    // templaza.dialog = function(dialog_selector, options){
    //     var dialog_settings    = $.extend({}, {
    //         'dialogClass': 'tzfrm-ui-dialog',
    //         'modal': true,
    //         'autoOpen': false,
    //         'closeOnEscape': true,
    //         'draggable': false,
    //         "appendTo": $("body"),
    //         // "appendTo": dialog_selector.parent(),
    //         "title":  dialog_selector.data("modal-title"),
    //         'buttons'       : [
    //             {
    //                 text: "Close",
    //                 class: "button button-secondary ml-2",
    //                 click: function() {
    //                     console.log($( this ));
    //                     $( this ).dialog( "close" );
    //                 },
    //             },
    //         ]
    //     }, options);
    //
    //     return dialog_selector.dialog(dialog_settings).removeClass("hide");
    // };

    $(document).ready(function(){

        $("#menu-to-edit").templaza_megamenu();

        // $(".megamenu_enabled #menu-to-edit").on("mouseenter mouseleave", "li.menu-item", function() {
        //     var menu_item = $(this);
        //
        //     if (!menu_item.data("megamenu_has_button")) {
        //
        //         menu_item.data("megamenu_has_button", "true");
        //
        //         var button = $("<span>").addClass("mm_launch mm_disabled")
        //             .html("<i class=\"fas fa-box-open\"></i> TZ Mega Menu")
        //             .on("click", function(e) {
        //                 e.preventDefault();
        //                 if($("script#tmpl-templaza-metabox-megamenu-template").length) {
        //                     var control = $(this);
        //                     var main_wrap = control.closest(".redux-wrap-div");
        //                     var form_setting = wp.template("templaza-metabox-megamenu-template");
        //
        //                     var setting_obj = $(form_setting()),
        //                         fields = setting_obj.find(".redux-field-container");
        //                     templaza.dialog(setting_obj, {
        //                         'autoOpen': false,
        //                         "open": function (event, ui) {
        //                             var _dialog = $(this);
        //                             fields  = _dialog.find(".redux-field-container");
        //                             if (fields.length) {
        //                                 main_wrap.data("opt-name", undefined);
        //                                 main_wrap.removeData("data-opt-name");
        //                                 fields.each(function () {
        //                                     var field = $(this),
        //                                         field_type = field.data("type"),
        //                                         tz_redux = redux.field_objects;
        //                                     if (typeof tz_redux[field_type] !== typeof undefined) {
        //                                         var tz_redux_field;
        //
        //                                         // Before init field in setting edit
        //                                         // Trigger of field (setting_edit_before_init_field)
        //                                         if(field.length){
        //                                             tz_redux_field  = tz_redux[field_type];
        //                                             if(typeof tz_redux_field.templaza_methods !== typeof undefined
        //                                                 && typeof tz_redux_field.templaza_methods.setting_edit_before_init_field !== typeof undefined){
        //                                                 tz_redux_field.templaza_methods.setting_edit_before_init_field(field, _dialog);
        //                                             }
        //                                         }
        //
        //                                         tz_redux[field_type].init(field);
        //
        //                                         // After init field in setting edit
        //                                         // Trigger of field (setting_edit_after_init_field)
        //                                         if(field.length){
        //                                             tz_redux_field  = tz_redux[field_type];
        //                                             if(typeof tz_redux_field.templaza_methods !== typeof undefined
        //                                                 && typeof tz_redux_field.templaza_methods.setting_edit_after_init_field !== typeof undefined){
        //                                                 tz_redux_field.templaza_methods.setting_edit_after_init_field(field, _dialog);
        //                                             }
        //                                         }
        //                                     }
        //                                     // main_wrap.removeData("opt-name");
        //                                     // main_wrap.removeData("data-opt-name");
        //
        //                                 });
        //                             }
        //
        //                         },
        //                     }).dialog('open');
        //                 }
        //             });
        //
        //         $(".item-title", menu_item).append(button);
        //     }
        // });
        // $("#menu-to-edit li.menu-item").each(function() {
        //
        //     var menu_item = $(this);
        //
        //     menu_item.data("megamenu_has_button", "true");
        //
        //     var id = parseInt(menu_item.attr("id").match(/[0-9]+/)[0], 10);
        //
        //     var button = $("<span>").addClass("button button-primary mm_launch")
        //         // .html(megamenu.launch_lightbox)
        //         .html("<i class=\"fas fa-box-open\"></i> TZ Mega Menu")
        //         .on("click", function(e) {
        //             e.preventDefault();
        //
        //             // var _dialog = $("<div/>");
        //             // _dialog.html("Test");
        //
        //             if($("script#tmpl-templaza-metabox-megamenu-template").length) {
        //                 var control = $(this);
        //                 var main_wrap = control.closest(".redux-wrap-div");
        //                 var form_setting = wp.template("templaza-metabox-megamenu-template");
        //
        //                 var setting_obj = $(form_setting()),
        //                     fields = setting_obj.find(".redux-field-container");
        //                 templaza.dialog(setting_obj, {
        //                     'autoOpen': false,
        //                     "open": function (event, ui) {
        //                         var _dialog = $(this);
        //                         fields  = _dialog.find(".redux-field-container");
        //                         if (fields.length) {
        //                             main_wrap.data("opt-name", undefined);
        //                             main_wrap.removeData("data-opt-name");
        //                             fields.each(function () {
        //                                 var field = $(this),
        //                                     field_type = field.data("type"),
        //                                     tz_redux = redux.field_objects;
        //                                 if (typeof tz_redux[field_type] !== typeof undefined) {
        //                                     var tz_redux_field;
        //
        //                                     // Before init field in setting edit
        //                                     // Trigger of field (setting_edit_before_init_field)
        //                                     if(field.length){
        //                                         tz_redux_field  = tz_redux[field_type];
        //                                         if(typeof tz_redux_field.templaza_methods !== typeof undefined
        //                                             && typeof tz_redux_field.templaza_methods.setting_edit_before_init_field !== typeof undefined){
        //                                             tz_redux_field.templaza_methods.setting_edit_before_init_field(field, _dialog);
        //                                         }
        //                                     }
        //
        //                                     tz_redux[field_type].init(field);
        //
        //                                     // After init field in setting edit
        //                                     // Trigger of field (setting_edit_after_init_field)
        //                                     if(field.length){
        //                                         tz_redux_field  = tz_redux[field_type];
        //                                         if(typeof tz_redux_field.templaza_methods !== typeof undefined
        //                                             && typeof tz_redux_field.templaza_methods.setting_edit_after_init_field !== typeof undefined){
        //                                             tz_redux_field.templaza_methods.setting_edit_after_init_field(field, _dialog);
        //                                         }
        //                                     }
        //                                 }
        //                                 // main_wrap.removeData("opt-name");
        //                                 // main_wrap.removeData("data-opt-name");
        //
        //                             });
        //                         }
        //
        //                     },
        //                 }).dialog('open');
        //             }
        //             // if (!$("body").hasClass("megamenu_enabled")) {
        //             //     // alert(megamenu.is_disabled_error);
        //             //     return;
        //             // }
        //
        //             // $(this).megaMenu({
        //             //     menu_item_id: id
        //             // });
        //         });
        //
        //     $(".item-title", menu_item).append(button);
        //
        //     // if (megamenu.css_prefix === "true") {
        //     //     var custom_css_classes = menu_item.find(".edit-menu-item-classes");
        //     //     var css_prefix = $("<span>").addClass("mm_prefix").html(megamenu.css_prefix_message);
        //     //     custom_css_classes.after(css_prefix);
        //     // }
        //
        // });
    });
})(jQuery);