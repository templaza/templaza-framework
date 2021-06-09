(function($) {
    "use strict";

    templaza.shortcode = templaza.shortcode || {};
    templaza.shortcode.widget = templaza.shortcode.widget || {};
    templaza.shortcode.widget.ajax_completed = false;

    // Prepare html when init element
    $(".templaza-framework-options .redux-field-container[data-type=tz_layout]")
        .off("templaza-framework/field/tz_layout/shortcode/widget/prepare/html")
        .on("templaza-framework/field/tz_layout/shortcode/widget/prepare/html",
        function(event, html, data, params){
        // Add data-widget_id attribute to widget element
        if(typeof params !== "undefined" && typeof params["widget_id"] !== "undefined") {
            var _html_obj   = $(html).attr("data-widget_id", params["widget_id"]);
            return _html_obj.prop("outerHTML");
        }
        return html;
    });
    // Prepare html when duplicate element
    $(".templaza-framework-options .redux-field-container[data-type=tz_layout]")
        .off("templaza-framework/field/tz_layout/action/clone/shortcode/setting/after")
        .on("templaza-framework/field/tz_layout/action/clone/shortcode/setting/after",
        function(event, element, element_clone, setting, dest_setting, main_selector, main_settings){
            var _ajax_result    = false;

            if(element.attr("data-fl-element_type") !== "widget"){
                if(element.find("[data-fl-element_type=widget]").length){
                    var tree_el_setting = function(element_settings, element_index = 0){
                        $.each(element_settings, function(index, el_setting){
                            var _next_bool  = true;

                            if(el_setting.type === "widget")
                            {
                                _next_bool = false;
                                // if(!_ajax_result) {
                                $.when(_ajax_result).done(function(){
                                    _ajax_result = $.post(ajaxurl, {
                                        "post_type": templaza_shortcode_widget.post_type,
                                        "action": templaza_shortcode_widget.clone_ajax_action,
                                        "widget_id": el_setting.params.widget_id,
                                        "_wpnonce": templaza_shortcode_widget.clone_ajax_nonce
                                    }, function (response) {
                                        _next_bool = true;
                                        _ajax_result = false;
                                        var _elements = element_clone.find("[data-fl-element_type]");
                                        _elements.eq(element_index).attr("data-widget_id", response.data.new_widget_id);

                                        el_setting.params.widget_id = response.data.new_widget_id;
                                    });
                                });
                                // }
                            }

                            if(_next_bool && typeof el_setting.elements !== "undefined" && setting.elements.length){
                            // if(typeof el_setting.elements !== "undefined" && setting.elements.length){
                            //     $.when(_ajax_result).done(function(){
                            //         alert("when done");
                                    element_index++;
                                    tree_el_setting(el_setting.elements, element_index);
                                // });
                            }

                        });
                    };

                    tree_el_setting(setting.elements);

                    _ajax_result.done(function () {
                        redux.field_objects.tz_layout.insert_setting(setting, dest_setting, main_settings, main_selector, element.index() + 1, true);
                    });
                }
            }else{
                // $.when(_ajax_result).done(function(){
                    _ajax_result = $.post(ajaxurl, {
                        "post_type": templaza_shortcode_widget.post_type,
                        "action": templaza_shortcode_widget.clone_ajax_action,
                        "widget_id": setting.params.widget_id,
                        "_wpnonce":templaza_shortcode_widget.clone_ajax_nonce
                    }, function (response) {
                        _ajax_result    = false;
                        main_selector.data("tzfrm-ajax-complete", true);
                        // setting.id  = redux.field_objects.tz_layout.generateID();
                        element_clone.attr("data-widget_id", response.data.new_widget_id);
                        setting.params.widget_id = response.data.new_widget_id;

                        // Replace setting
                        redux.field_objects.tz_layout.insert_setting(setting, dest_setting, main_settings, main_selector, element.index()+1, true);
                    });
                // });

            }

    });
    $(".templaza-framework-options .redux-field-container[data-type=tz_layout]").on(
        "templaza-framework/field/tz_layout/init",function(){
            // Push widget_id to delete stores to delete
            $(this).off("templaza-framework/field/tz_layout/action/delete/shortcode/setting/before")
                .on("templaza-framework/field/tz_layout/action/delete/shortcode/setting/before", function(event, element, setting){
                    if(setting.type !== "widget"){
                        if(element.find("[data-fl-element_type=widget]").length){
                            if(typeof templaza.shortcode.widget.delete_stores === "undefined"){
                                templaza.shortcode.widget.delete_stores = [];
                            }
                            $.each(element.find("[data-fl-element_type=widget]"), function(){
                                var _widget_id = $(this).attr("data-widget_id");
                                if(typeof _widget_id !== "undefined" &&
                                    templaza.shortcode.widget.delete_stores.indexOf(_widget_id) === -1) {
                                    templaza.shortcode.widget.delete_stores.push(_widget_id);
                                }
                            });
                        }
                    }else{
                        if(typeof templaza.shortcode.widget.delete_stores === "undefined"){
                            templaza.shortcode.widget.delete_stores = [];
                        }
                        if(templaza.shortcode.widget.delete_stores.indexOf(setting.params.widget_id) === -1) {
                            templaza.shortcode.widget.delete_stores.push(setting.params.widget_id);
                        }
                    }
            });
            if(pagenow  === "templaza_style"){
                // Delete widgets (if exists) when update post
                $("form #publish").on("click", function(e){
                    if(typeof templaza.shortcode.widget.delete_stores !== "undefined"){
                        e.preventDefault();
                        var _btn = $(this);
                        var _delete_widgets = function() {
                            $.each(templaza.shortcode.widget.delete_stores, function (index, widget_id) {
                                templaza.shortcode.widget.delete_widget(widget_id);
                            });
                        };

                        $.when(_delete_widgets()).then(function(){
                            _btn.closest("form").submit();
                        });
                    }
                });
            }
        });
    // templaza.shortcode.widget.init  = function(data){
    //     console.log(data);
    // };
    templaza.shortcode.widget.delete_widget = function(widget_id){
        if(typeof templaza_shortcode_widget === "undefined"){
            return;
        }
        templaza.shortcode.widget.ajax_completed    = false;
        // Delete widget from sidebar
        $.post(templaza_shortcode_widget.admin_ajax_url, {
            action: templaza_shortcode_widget.delete_ajax_action,
            widget_id: widget_id,
            post_type: templaza_shortcode_widget.post_type,
            _wpnonce: templaza_shortcode_widget.delete_ajax_nonce
        }, function(delete_response) {
            templaza.shortcode.widget.ajax_completed = true;
            return true;
        });
    };
    templaza.shortcode.widget.setting_edit_before_init_field  = function(field, form, element, selector, settings){
        if(field.attr("data-id") === "widget") {
            field.append("<div class=\"widgets\"/>");

            var _input = $("<input type='hidden' name='widget_id'>");
            var _loading = $("<div class=\"text-center d-none\"><div class=\"spinner-border spinner-border-sm\" role=\"status\">\n" +
                "  <span class=\"sr-only\">Loading...</span>\n" +
                "</div></div>");
            var _widget_delete_stores   = [];

            var field_setting   = redux.field_objects.tz_layout.get_setting(element, selector, settings);
            if(field_setting){
                _input.val(field_setting["params"]["widget_id"]);
            }

            if(!field.find(_input).length){
                field.append(_input);
            }

            var _widgets    = field.find(".widgets");
            _widgets.html(_loading);

            var _ajax_widget = function (id_base, widget_id) {
                if(!id_base){
                    return;
                }

                _loading.removeClass("d-none");

                var _data   = {
                    post_type: templaza_shortcode_widget.post_type
                };

                if(widget_id && widget_id.length){
                    _data["widget_id"]  = widget_id;
                    _data["action"]     = templaza_shortcode_widget.edit_ajax_action;
                    _data["_wpnonce"]     = templaza_shortcode_widget.edit_ajax_nonce;
                }else{
                    _data["action"]     = templaza_shortcode_widget.ajax_action;
                    _data["id_base"]    = id_base;
                    _data["title"]      = field.find("option:selected").text();
                    _data["_wpnonce"]   = templaza_shortcode_widget.ajax_nonce;
                }

                $.post(templaza_shortcode_widget.admin_ajax_url, _data, function(response) {
                    _loading.addClass("d-none");

                    var $response = $(response);
                    var $form = $response.find("form");
                    var _new_widget_id = $form.find("[name=widget-id]").val();

                    if(typeof _new_widget_id !== "undefined" && _new_widget_id &&
                        _widget_delete_stores.length && _widget_delete_stores.indexOf(_new_widget_id) !== -1) {
                        delete _widget_delete_stores[_widget_delete_stores.indexOf(_new_widget_id)];
                    }

                    var delete_widgets = function(){
                        if(!_widget_delete_stores.length) return;
                        var _field_params  = field_setting["params"] !== "underfined"?field_setting["params"]:{};
                        $.each(_widget_delete_stores, function(index, value){
                            if(_field_params["widget_id"] !== "underfined" && _field_params["widget_id"] !== value){
                                // Delete widget from sidebar
                                templaza.shortcode.widget.delete_widget(value);
                                // $.post(templaza_shortcode_widget.admin_ajax_url, {
                                //     action: templaza_shortcode_widget.delete_ajax_action,
                                //     widget_id: value,
                                //     post_type: templaza_shortcode_widget.post_type,
                                //     _wpnonce: templaza_shortcode_widget.delete_ajax_nonce
                                // }, function(delete_response) {});
                            }
                        });
                    };

                    form.off("templaza-framework/setting/close").on("templaza-framework/setting/close",function(){
                        delete_widgets();
                        // console.log(_widget_delete_stores);
                    });
                    form.off("templaza-framework/setting/save/init").on("templaza-framework/setting/save/init",
                        function(event, element, main_selector, settings){

                        var _form = _widgets.find("form");

                        if(_form.length) {
                            var data = _form.serialize(),
                                _widget_id = _form.find("[name=widget-id]").val();

                            data    += "&post_type=" + templaza_shortcode_widget.post_type;

                            field.find("[name=widget_id]").val(_widget_id);
                            $(element).attr("data-widget_id", _widget_id);

                            _widgets.html("");
                            delete_widgets();
                            $.post(templaza_shortcode_widget.admin_ajax_url, data, function(submit_response) {});
                        }
                    });

                    field.data("widget-base-"+id_base, $form.find("[name=widget-id]").val());

                    _widgets.html($response);
                    var widget = _widgets.find(".widget").first();

                    widget.data("loaded", true).toggleClass("open");

                    console.log(widget);

                    // Init Black Studio TinyMCE
                    if (widget.is("[id*=black-studio-tinymce]")) {
                        bstw(widget).deactivate().activate();
                    }
                    // _widget.find(".widget-action").trigger("click");

                    setTimeout(function(){
                        // fix for WordPress 4.8 widgets when lightbox is opened, closed and reopened
                        if (wp.textWidgets !== undefined) {
                            wp.textWidgets.widgetControls = {}; // WordPress 4.8 Text Widget
                        }

                        if (wp.mediaWidgets !== undefined) {
                            wp.mediaWidgets.widgetControls = {}; // WordPress 4.8 Media Widgets
                        }

                        if (wp.customHtmlWidgets !== undefined) {
                            wp.customHtmlWidgets.widgetControls = {}; // WordPress 4.9 Custom HTML Widgets
                        }

                        var result = $(document).trigger("widget-added", [widget]);

                        if ('acf' in window && typeof acf.getFields !== "undefined") {
                            acf.getFields(document);
                        }
                    }, 100);

                    // close all other widgets
                    $(".widget").not(widget).removeClass("open");

                });


            };

            var _field_id = field.attr("data-id"),
                _field = field.find("[name=" + _field_id + "]");

            if(_field.val().length){
                if(field.find("[name=widget_id]").length && field.find("[name=widget_id]").val().length){
                    _ajax_widget(_field.val(), field.find("[name=widget_id]").val());
                }else{
                    _ajax_widget(_field.val());
                }
            }

            _field.on("change", function(){
                var _widget_id = field.find("[name=widget_id]").length?field.find("[name=widget_id]").val():"",
                    _id_base_f_widget_id = _widget_id.length?_widget_id.replace(/-[0-9]+$/, ""):"",
                    _id_base = $(this).val();

                if(_id_base !== _id_base_f_widget_id ) {
                    _widget_id  = null;
                }
                if(typeof field.data("widget-base-"+_id_base) !== "undefined"){
                    _widget_id  = field.data("widget-base-"+_id_base);
                }

                // Store widget id to delete when dialog close
                var _new_widget_id  = _widgets.find("form [name=widget-id]").val();
                if(_new_widget_id !== "underfined" && _widget_id) {
                    _widget_delete_stores.push(_new_widget_id);
                }

                _ajax_widget(_id_base, _widget_id);
            });
        }
    };
    templaza.shortcode.widget.load_setting  = function(value, element, form){
    };
    templaza.shortcode.widget.prepare_setting  = function(setting, form, element){
    };

    templaza.shortcode.widget.save_setting = function(setting, element, form){
    };
})(jQuery);