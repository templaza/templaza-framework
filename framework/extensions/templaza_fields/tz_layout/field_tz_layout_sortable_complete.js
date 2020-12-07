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

                redux.field_objects.tz_layout.init_tooltip(el);

                // redux.field_objects.tz_layout.init_source(el);
                redux.field_objects.tz_layout.init_control(el);

            });
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
        selector.find("[data-fl-control=toggle]").off("click").on("click", function(event){
            $(this).closest("[data-fl-element_type]").toggleClass("fl_collapsed-row");
        });

        // Section sortable
        selector.sortable({
            handle: "> .fl_controls [data-fl-control=move]",
            placeholder: "fl-ui-state-highlight",
            forcePlaceholderSize: true,
            items: '[data-fl-element_type=section]',
            start: function( event, ui ) {
                selector.tooltip("destroy");
                // if(ui.item.hasClass("fl_content_element")) {
                ui.placeholder.height(ui.item.outerHeight());
                // }
            },
            stop: function( event, ui ) {
                redux.field_objects.tz_layout.init_tooltip(selector);

                // // Allow 2 level of row
                // if(ui.item.data("fl-element_type") === "row" && ui.item.parents("[data-fl-element_type=row].fl_row_inner").length) {
                //     $(this).sortable('cancel');
                // }
            },
        }).disableSelection();

        // Row sortable
        selector.find(".fl_column-container:not(.fl_container_for_children)").sortable({
            handle: "[data-fl-control=move]",
            placeholder: "fl-ui-state-highlight",
            forcePlaceholderSize: true,
            cancel: '[data-fl-element_type=row].fl_row_inner',
            items: '[data-fl-element_type=row]',
            connectWith: ".fl_column-container:not(.fl_container_for_children)",
            start: function( event, ui ) {
                selector.tooltip("destroy");
                ui.placeholder.height(ui.item.outerHeight());
            },
            stop: function( event, ui ) {
                redux.field_objects.tz_layout.init_tooltip(selector);
            },
        }).disableSelection();

        // Column sortable
        selector.find("[data-fl-element_type=row] .fl_row_container").sortable({
            // handle: "[data-fl-control=move]",
            placeholder: "fl-ui-state-highlight fl-column-state-highlight",
            forcePlaceholderSize: true,
            items: '> [data-fl-element_type=column]',
            start: function( event, ui ) {
                selector.tooltip("destroy");
                var padding = ui.item.outerWidth() - ui.item.width(),
                    width   = Math.floor(ui.item.closest(".fl_row_container").width() / 100 * parseFloat(ui.item.css("flex").replace("0 0 ", "")));
                ui.placeholder.width(width-padding);
                ui.placeholder.height(ui.item.outerHeight());
            },
            stop: function( event, ui ) {
                redux.field_objects.tz_layout.init_tooltip(selector);
            },
        }).disableSelection();

        // Element sortable
        selector.find(".fl_column-container.fl_container_for_children").sortable({
            placeholder: "fl-ui-state-highlight",
            forcePlaceholderSize: true,
            items: '> [data-fl-element_type]',
            dropOnEmpty: true,
            connectWith: ".fl_column-container.fl_container_for_children",
            start: function( event, ui ) {
                selector.tooltip("destroy");
                ui.placeholder.height(ui.item.outerHeight());
            },
            stop: function( event, ui ) {
                redux.field_objects.tz_layout.init_tooltip(selector);

                // Allow 2 level of row
                if(ui.item.data("fl-element_type") === "row" && ui.item.parents("[data-fl-element_type=row].fl_row_inner").length) {
                    $(this).sortable('cancel');
                }
            },
        }).disableSelection();
    };
})(jQuery);