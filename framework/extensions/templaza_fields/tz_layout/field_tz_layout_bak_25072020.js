(function($) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.tz_layout = redux.field_objects.tz_layout || {};

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

                // var section = wp.template('field-tz_layout-template-section');
                // var html    = section({element: "Element", "test": "abc"});
                // console.log(html);
                // var _sec    = _.template(html,
                //     {
                //         evaluate:    /<#([\s\S]+?)#>/g,
                //         interpolate: /\{\{\{([\s\S]+?)\}\}\}/g,
                //         escape:      /\{\{([^\}]+?)\}\}(?!\})/g,
                //         variable:    'data'
                //     });
                // console.log(_sec({element: "Test"}));

                redux.field_objects.tz_layout.init_elements(el);
                redux.field_objects.tz_layout.init_tooltip(el);

                // redux.field_objects.tz_layout.init_source(el);
                redux.field_objects.tz_layout.init_control(el);

                // console.log($("#" + el.data("id")).val());
                // console.log(column({attribs: {"column": 12}}));
                // console.log(row({element: column({attribs: {"column": 12}})}));
                // console.log(row);
                // console.log(column);
                // console.log(section({element: row({element: column({attribs: {"column": 12}})})}));

            });
    };

    redux.field_objects.tz_layout.init_elements = function(selector){
        var $vals   = selector.find("#"+selector.data("id")).val().trim();



        if($vals.length){
            var $json_vals   = JSON.parse($vals),
                $element_data={element: ""},
                $html = "";

            var    $tree_html = [];
            var $level = 0;
            var tree_element = function(tree){
                $.each(tree, function(index, item){

                    if(typeof item.elements !== typeof undefined && item.elements.length){
                        tree_element(item.elements);
                        $level++;
                    }else{
                        $level = 0;
                    }

                    console.log(item);
                    console.log($level);

                    var $item_tmp,
                        $item_tmp_data = Object.assign({}, item);

                    delete $item_tmp_data.params;
                    delete $item_tmp_data.elements;

                    // Get element html template
                    if($("#tmpl-field-tz_layout-template-" + item.type).length) {
                        $item_tmp = wp.template("field-tz_layout-template-" + item.type);
                    }else{
                        $item_tmp = wp.template("field-tz_layout-template__element");
                    }

                    if(typeof item.elements !== typeof undefined && item.elements.length){
                        $item_tmp_data.element  = $tree_html[$level - 1];
                        $tree_html[$level - 1]   = "";
                    }else{
                        $item_tmp_data.element  = "";
                    }

                    if(typeof $tree_html[$level] === typeof undefined) {
                        $tree_html[$level] = $item_tmp($item_tmp_data);
                    }else{
                        $tree_html[$level] += $item_tmp($item_tmp_data);
                    }
                });

                // return $tree_html;
            };
            tree_element($json_vals);
            if($tree_html.length) {
                // console.log($tree_html);
                $html   = $tree_html.pop();
                // selector.find(".field-tz_layout-content").html($tree_html.pop());
            }
        }else{
            // Load elements when empty value
            if(!$("#" + selector.data("id")).val().length){
                $html   = redux.field_objects.tz_layout.get_section_empty();
                // selector.find(".field-tz_layout-content").prepend(redux.field_objects.tz_layout.get_section_empty());
            }
        }
        selector.find(".field-tz_layout-content").html($html);
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
        var section = wp.template('field-tz_layout-template-section');
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

    redux.field_objects.tz_layout.init_control  = function(selector){
        var sortable_column  = function(sort_selector){
            // Column sortable
            // if( typeof sort_selector.find("[data-fl-element_type=row] .fl_row_container").data("ui-sortable") !== typeof undefined){
            //     sort_selector.find("[data-fl-element_type=row] .fl_row_container").sortable("destroy");
            // }
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
                },
                stop: function( event, ui ) {
                    redux.field_objects.tz_layout.init_tooltip(sort_selector);
                },
            }).disableSelection();
        };


        var sortable_element  = function(sort_selector){
            // Element sortable
            // if(sort_selector.find(".fl_column-container.fl_container_for_children").data("ui-sortable") !== undefined){
            //     sort_selector.find(".fl_column-container.fl_container_for_children").sortable("destroy");
            // }
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
                    // ui.placeholder.height(ui.item.outerHeight());
                },
                stop: function( event, ui ) {
                    redux.field_objects.tz_layout.init_tooltip(sort_selector);

                    // Allow 2 level of row
                    // if(ui.item.data("fl-element_type") === "row_inner") {
                    //     $(this).sortable('cancel');
                    // }
                    // console.log(event);
                    // console.log(ui);
                    if(ui.item.data("fl-element_type") === "row_inner" && ui.item.parents("[data-fl-element_type=row_inner]").length) {
                        $(this).sortable('cancel');
                    }else{
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
                },
                // deactivate: function (event, ui) {
                //     redux.field_objects.tz_layout.init_tooltip(sort_selector);
                //
                //     // Allow 2 level of row
                //     // console.log(ui);
                //     if(ui.item.data("fl-element_type") === "row_inner" && ui.item.parents("[data-fl-element_type=row_inner]").length) {
                //         $(this).sortable('cancel');
                //     }else{
                //         var src_parent   = $(event.target),
                //             des_parent   = ui.item.closest(".fl_column-container.fl_container_for_children");
                //         if(!src_parent.children().length){
                //             src_parent.addClass("fl_empty-container");
                //             init_event();
                //         }
                //         if(des_parent.length && des_parent.hasClass("fl_empty-container")){
                //             des_parent.removeClass("fl_empty-container").off("click");
                //         }
                //     }
                // },
                // out: function (event, ui) {
                // // //     console.log("out");
                // // //     console.log(ui);
                // //     if(!ui.sender.find("[data-fl-element_type]:not(.ui-sortable-helper)").length && !ui.sender.has(ui.placeholder).length){
                // //         ui.sender.addClass("fl_empty-container")
                // //             .closest("[data-fl-element_type]").find(">.fl_controls-column.bottom-controls")
                // //             .removeClass("d-block");
                // //     }
                // // //
                // // //
                // // //     // parent.removeClass("fl_empty-container");
                // // //
                // // //     console.log(ui.sender.has(ui.placeholder));
                // // //
                // // //     // ui.sender.has(ui.placeholder).removeClass("fl_empty-container");
                // // //     // ui.sender.has(ui.placeholder).removeClass("fl_empty-container");
                // // //
                // // //     if(!ui.sender.find("[data-fl-element_type]:not(.ui-sortable-helper)").length){
                // // //         ui.sender.addClass("fl_empty-container")
                // // //             .closest("[data-fl-element_type]").find(">.fl_controls-column.bottom-controls")
                // // //             .removeClass("d-block");
                // // //     }
                //
                // //     var parent  = ui.placeholder.closest(".fl_column-container.fl_container_for_children");
                // //     if(!parent.find("[data-fl-element_type]:not(.ui-sortable-helper)").length){
                // //         // parent.removeClass("fl_empty-container");
                // //         parent.addClass("fl_empty-container")
                // //             .closest("[data-fl-element_type]").find(">.fl_controls-column.bottom-controls")
                // //             .removeClass("d-block");
                // //
                // //     }
                // },
                // change: function (event, ui) {
                //
                //     var dest = ui.placeholder.closest(".fl_column-container.fl_container_for_children");
                //     dest.removeClass("fl_empty-container");
                //
                //     // if(ui.sender !== null) {
                //     //     ui.sender.addClass("fl_empty-container");
                //     // }else{
                //     //     var dest = ui.placeholder.closest(".fl_column-container.fl_container_for_children");
                //     //     dest.removeClass("fl_empty-container");
                //     //
                //     // }
                //     // if(!dest.find("[data-fl-element_type]:not(.ui-sortable-helper)").length){
                //     //     dest.remove
                //     // }
                //     // console.log(ui.placeholder.closest(".fl_column-container.fl_container_for_children"));
                //     // console.log(ui.placeholder.closest(".fl_column-container.fl_container_for_children"));
                //     // // console.log(ui.item.closest(".fl_column-container.fl_container_for_children"));
                //     // if(ui.placeholder.closest(".fl_column-container.fl_container_for_children").length){
                //     //     var dest = ui.placeholder.closest(".fl_column-container.fl_container_for_children");
                //     //
                //     //     dest.removeClass("fl_empty-container");
                //     //     // if(dest.find(">[data-fl-element_type]").length){
                //     //     // }
                //     // }
                //     //
                //     // if(ui.sender !== null && !ui.sender.find("[data-fl-element_type]:not(.ui-sortable-helper)").length){
                //     //     ui.sender.addClass("fl_empty-container")
                //     //         .closest("[data-fl-element_type]").find(">.fl_controls-column.bottom-controls")
                //     //         .removeClass("d-block");
                //     // }
                // },
                // over: function (event, ui) {
                //     console.log("over");
                //     console.log(ui);
                //     // if(!ui.sender.find("[data-fl-element_type]:not(.ui-sortable-helper)").length){
                //     //     ui.sender.addClass("fl_empty-container")
                //     //         .closest("[data-fl-element_type]").find(">.fl_controls-column.bottom-controls")
                //     //         .removeClass("d-block");
                //     // }
                // },
            }).disableSelection();
        };

        var sortable_row = function (sort_selector) {
            // Row sortable
            // if(sort_selector.find(".fl_column-container:not(.fl_container_for_children)").data("ui-sortable") !== undefined){
            //     sort_selector.find(".fl_column-container:not(.fl_container_for_children)").sortable("destroy");
            // }
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
                },
                stop: function( event, ui ) {
                    redux.field_objects.tz_layout.init_tooltip(sort_selector);
                },
            }).disableSelection();
        };

        var sortable_section    = function(sort_selector){
            // Section sortable
            // if(sort_selector.data("ui-sortable") !== undefined){
            //     sort_selector.sortable("destroy");
            // }
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
                },
                stop: function( event, ui ) {
                    redux.field_objects.tz_layout.init_tooltip(sort_selector);

                    // // Allow 2 level of row
                    // if(ui.item.data("fl-element_type") === "row" && ui.item.parents("[data-fl-element_type=row].fl_row_inner").length) {
                    //     $(this).sortable('cancel');
                    // }
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
            var settings    = $.extend({}, {
                'dialogClass': 'tzfrm-ui-dialog',
                'modal': true,
                'autoOpen': false,
                'closeOnEscape': true,
                'draggable': false,
                "appendTo": selector,
                // "appendTo": dialog_selector.parent(),
                "title":  $("[data-fl_tz_layout-elements]").data("modal-title"),
                'buttons'       : {
                    "Close": function() {
                        $(this).dialog('close');
                    }
                }
            }, options);
            return dialog_selector.dialog(settings).removeClass("hide");
        };


        var add_cache;
        var init_event  = function(){

            selector.find("[data-fl-control=toggle]").off("click").on("click", function(event){
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
            // Add section
            selector.find(".fl_add-element-not-empty-button").off("click").on("click", function (event) {
                event.preventDefault();
                var section = redux.field_objects.tz_layout.get_section_empty();
                selector.find(".field-tz_layout-content").append(section);

                sortable(selector);
                init_event();
            });
            // Add element, Add column
            selector.find("[data-fl-control=add]").off("click").on("click", function(event){
                event.preventDefault();
                var element = $(this),
                    parent = element.closest("[data-fl-element_type]");

                if(element.closest("[data-fl-element_type]").data("fl-element_type") === "row"
                    || element.closest("[data-fl-element_type]").data("fl-element_type") === "row_inner") {
                    element.closest("[data-fl-element_type]")
                        .find(".fl_row_container.fl_container_for_children").first()
                        .append(redux.field_objects.tz_layout.get_column_empty());
                }else{
                    add_cache   = element;

                    if(add_cache.closest("[data-fl-element_type=row_inner").length){
                        $("[data-fl_tz_layout-elements]").find("[data-element=row_inner]").parent().addClass("hide");
                    }else{
                        $("[data-fl_tz_layout-elements]").find("[data-element=row_inner]").parent().removeClass("hide");
                    }

                    tzdialog($("[data-fl_tz_layout-elements]"), {
                        "close": function (ev, ui) {
                            add_cache   = null;
                        }
                    }).removeClass("hide").dialog('open');
                }

                sortable(selector);
                init_event();
            });
            selector.find(".fl_column-container.fl_empty-container").off("click").on("click", function(event){
                event.preventDefault();
                add_cache   = $(this);
                if(add_cache.closest("[data-fl-element_type=row_inner").length){
                    $("[data-fl_tz_layout-elements]").find("[data-element=row_inner]").parent().addClass("hide");
                }else{
                    $("[data-fl_tz_layout-elements]").find("[data-element=row_inner]").parent().removeClass("hide");
                }
                tzdialog($("[data-fl_tz_layout-elements]"),{
                    "close": function (ev, ui) {
                        add_cache   = undefined;
                    }
                }).removeClass("hide").dialog('open');
            });
            // Add section
            selector.find("[data-fl-control=add-section]").off("click").on("click", function(event){
                event.preventDefault();
                var element = $(this),
                    section = redux.field_objects.tz_layout.get_section_empty(),
                    parent = element.closest("[data-fl-element_type=section]");
                parent.after(section);

                sortable(selector);
                init_event();
            });
            // Add row
            selector.find("[data-fl-control=add-row]").off("click").on("click", function(event){
                event.preventDefault();
                var element = $(this), row, parent_class;
                if(element.closest("[data-fl-element_type]").data("fl-element_type") === "section"){
                    row = wp.template("field-tz_layout-template-row");
                }else{
                    row = wp.template("field-tz_layout-template-row_inner");
                }
                if(element.closest(".fl_controls").hasClass("bottom-controls")){
                    element.closest("[data-fl-element_type]").find(".fl_column-container").first().off("click")
                        .removeClass("fl_empty-container").append(row({element: redux.field_objects.tz_layout.get_column_empty()}));
                }else{
                    element.closest("[data-fl-element_type]").find(".fl_column-container").first().off("click")
                        .removeClass("fl_empty-container").prepend(row({element: redux.field_objects.tz_layout.get_column_empty()}));
                }
                sortable(selector);
                init_event();
            });
            // Duplicate element
            selector.find("[data-fl-control=clone]").off("click").on("click", function(event){
                event.preventDefault();
                var el  = $(this),
                    parent  = el.closest("[data-fl-element_type]");

                // if( typeof selector.find("[data-fl-element_type=row] .fl_row_container").data("ui-sortable") !== typeof undefined){
                //     selector.find("[data-fl-element_type=row] .fl_row_container").sortable("destroy");
                // }
                // parent.clone(true).insertAfter(parent);
                var clone   = parent.clone();
                clone.insertAfter(parent);
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
                    // var parent  = element.closest("[data-fl-element_type=section]");
                    if(parent.find("> [data-fl-element_type=row]").length === 1){
                        access  = false;
                    }
                }else if(element.data("fl-element_type") === "column"){
                    // var parent  = element.parent();
                    if(parent.find("[data-fl-element_type=column]").length === 1){
                        access  = false;
                    }
                }
                if(access) {
                    var result  = confirm("Are you sure?");
                    if(result){
                        // var parent  = element.parent();
                        element.remove();
                        if(parent.hasClass("fl_column-container fl_container_for_children") && !parent.find("[data-fl-element_type]").length){
                            var column = wp.template("field-tz_layout-template-column");
                            parent.closest("[data-fl-element_type]").after(column({
                                size: parent.closest("[data-fl-element_type]").data("column-width")
                            })).remove();
                            // parent.closest("[data-fl-element_type]").after(redux.field_objects.tz_layout.get_column_empty()).remove();
                            // parent.addClass("fl_empty-container").off("click");
                        }
                        // if(parent.hasClass("fl_column-container fl_container_for_children") && !parent.find("[data-fl-element_type]").length){
                        //     parent.closest("[data-fl-element_type]").after(redux.field_objects.tz_layout.get_column_empty()).remove();
                        // }
                        sortable(selector);
                        init_event();
                    }
                }
            });
            // Insert element
            selector.find("[data-fl_tz_layout-elements] [data-element]").off("click").on("click", function(event){
                event.preventDefault();
                var element = $(this);
                if (typeof add_cache !== typeof undefined) {
                    var tmpl_data,
                        tmp_el;

                    if(!$("script#tmpl-field-tz_layout-template-"+element.data("element")).length){
                        tmp_el  = wp.template("field-tz_layout-template__element");
                        tmpl_data   = {
                            "icon": element.find("[data-fl-element-icon]").data("fl-element-icon"),
                            "title": element.find("[data-fl-element-name]").text(),
                            "type": element.data("element")
                        };
                    }else{
                        tmp_el = wp.template("field-tz_layout-template-"+element.data("element"));
                        if(element.data("element") === "row_inner"){
                            tmpl_data   = {
                                element: redux.field_objects.tz_layout.get_column_empty()
                            };
                        }
                    }
                    if (typeof add_cache.attr("data-fl-control") !== typeof undefined && add_cache.attr("data-fl-control") === "add") {
                        if(add_cache.closest(".fl_controls-column.bottom-controls").length) {
                            add_cache.closest("[data-fl-element_type=column]")
                                .find(".fl_column-container.fl_container_for_children").first()
                                .removeClass("fl_empty-container").off("click").append(tmp_el(tmpl_data));
                        }else{
                            add_cache.closest("[data-fl-element_type=column]")
                                .find(".fl_column-container.fl_container_for_children").first()
                                .removeClass("fl_empty-container").off("click").prepend(tmp_el(tmpl_data));
                        }
                    }else{
                        add_cache.append(tmp_el(tmpl_data)).removeClass("fl_empty-container").off("click");
                    }
                    add_cache.closest("[data-fl-element_type=column]").find(">.fl_controls-column.bottom-controls").first().addClass("d-block");
                    $("[data-fl_tz_layout-elements]").dialog("close");

                    sortable(selector);
                    init_event();
                }
            });

            // Edit element
            selector.find("[data-fl-control=edit]").off("click").on("click",function(event){
                event.preventDefault();
                var control = $(this),
                    element = control.closest("[data-fl-element_type]"),
                    setting = wp.template("field-tz_layout-settings-" + element.data("fl-element_type"));
                setting = setting();
                var setting_obj = $(setting),
                    fields = setting_obj.find(".redux-field-container");
                setting_obj.find("[data-fl-tz_layout-tab]").tabs({
                    "activate": function( event, ui ) {
                        var fields  = ui.newPanel.find(".redux-field-container");
                        // console.log(ui);
                        if(fields.length){
                            fields.each(function(){
                                var field = $(this),
                                    field_type  = field.data("type"),
                                    tz_redux = redux.field_objects;

                                // console.log(typeof tz_redux[field_type]);
                                if(typeof tz_redux[field_type] !== typeof undefined){

                                    // console.log(field_type);
                                    // tz_redux[field_type].init(field[0]);
                                    tz_redux[field_type].init(field[0]);
                                }
                            });
                        }
                    },
                });

                tzdialog(setting_obj,{
                    "title": setting_obj.data("fl-setting-title"),
                    "close": function (ev, ui) {
                        $(this).remove();
                    },
                    "open": function( event, ui ) {
                        if(fields.length){
                            fields.each(function(){
                                var field = $(this),
                                    field_type  = field.data("type"),
                                    tz_redux = redux.field_objects;
                                if(typeof tz_redux[field_type] !== typeof undefined){
                                    tz_redux[field_type].init(field[0]);
                                }

                                // $.redux.hideFields();
                                // $.redux.checkRequired();

                            });
                        }
                    },
                }).dialog('open');
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
                        $.each($cells, function(index, value){
                            var $new_col = wp.template('field-tz_layout-template-column'),
                                $col_data = {size: value};
                            if(columns.length){
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
                                if( index === ($cells.length - 1) && columns.length && columns.length > $cells.length){
                                    $new_col_obj.find(".fl_container_for_children").first().append(columns.not($not)
                                            .find(">.fl_element-wrapper>.fl_column-container.fl_container_for_children")
                                            .children()).removeClass("fl_empty-container");
                                }
                                if(index === 0){
                                    row.find(".fl_row_container.fl_container_for_children").first().html($new_col_obj);
                                }else {
                                    row.find(".fl_row_container.fl_container_for_children").first().append($new_col_obj);
                                }

                                sortable(selector);
                                init_event();
                            }
                        });
                    }
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