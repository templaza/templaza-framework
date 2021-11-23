(function($) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.tz_preloader = redux.field_objects.tz_preloader || {};

    redux.field_objects.tz_preloader.init = function( selector ) {

        if (!selector) {
            selector = $(document).find(".redux-group-tab:visible").find('.redux-container-tz_preloader:visible');
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

                if(el.find(".field-tz-preloader-modal, [data-toggle=tz-preloader-modal]").length) {
                    el.find(".field-tz-preloader-modal, [data-toggle=tz-preloader-modal]").each(function(){
                        var $el = $(this);
                        $el.off("click").on("click", function (event) {
                            event.preventDefault();
                            var $target = $el.data("target"),
                                $info = (typeof $target !== "undefined" && $target.length)?$target:$el.attr("href"),
                                $mcontent = $($info);
                            $mcontent.find(".tz-preloader-select").off("click").on("click", function(e){
                                var $sEl    = $(this);
                                $("#" + $sEl.data("id") ).val($sEl.data("value"));
                                // $("#" + $sEl.data("id") +"__html").val($sEl.data("html"));
                                // $("#" + $sEl.data("id") +"__html").val($sEl.find(".tz-preloader-select-inner").html());
                                $el.next(".select-preloader").html($sEl.html());

                                UIkit.modal($sEl.closest(".uk-modal")).hide();
                                // $mcontent.dialog("close");
                            });

                            // var __mcontent = $('<div id="my-id" class="uk-modal-container" data-uk-modal>\n' +
                            //     '    <div class="uk-modal-dialog">\n' +
                            //     '        <button class="uk-modal-close-default" type="button" uk-close></button>\n' +
                            //     '        <div class="uk-modal-header">\n' +
                            //     '            <h2 class="uk-modal-title">'+$mcontent.attr("title")+'</h2>\n' +
                            //     '        </div>\n' +
                            //     '        <div class="uk-modal-body" data-uk-overflow-auto></div>\n' +
                            //     '        <div class="uk-modal-footer uk-text-right">\n'+
                            //     '            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>\n'+
                            //     '        </div>\n' +
                            //     '    </div>\n' +
                            //     '</div>');
                            // $mcontent.appendTo(__mcontent.find(".uk-modal-body"));
                            //
                            // UIkit.util.on(__mcontent, 'hidden', function () {
                            //     $(this).remove();
                            // });
                            //
                            // UIkit.modal(__mcontent).show();

                            // $mcontent.dialog({
                            //     'dialogClass': 'field-tz-preloader-dialog',
                            //     'modal': true,
                            //     'autoOpen': false,
                            //     'closeOnEscape': true,
                            //     'draggable': false,
                            //     'buttons'       : {
                            //         "Close": function() {
                            //             $(this).dialog('close');
                            //         }
                            //     }
                            // }).removeClass("hide").dialog('open');
                            // $mcontent;
                        });
                    });

                }
            });
    };

    // redux.field_objects.color_rgba.modInit = function(el) {
    //
    // };

    // $(document).ready(function(){
    //     if($(".field-tz-preloader-modal, [data-toggle=tz-preloader-modal]").length) {
    //         $(".field-tz-preloader-modal, [data-toggle=tz-preloader-modal]").each(function(){
    //             var $el = $(this);
    //             $el.off("click").on("click", function (event) {
    //                 event.preventDefault();
    //                 var $target = $el.data("target"),
    //                     $info = (typeof $target !== "undefined" && $target.length)?$target:$el.attr("href"),
    //                     $mcontent = $($info);
    //                 $mcontent.find(".tz-preloader-select").off("click").on("click", function(e){
    //                     var $sEl    = $(this);
    //                     $("#" + $sEl.data("id") ).val($sEl.data("value"));
    //                     // $("#" + $sEl.data("id") +"__html").val($sEl.data("html"));
    //                     // $("#" + $sEl.data("id") +"__html").val($sEl.find(".tz-preloader-select-inner").html());
    //                     $el.next(".select-preloader").html($sEl.html());
    //                     $mcontent.dialog("close");
    //                 });
    //                 $mcontent.dialog({
    //                     'dialogClass': 'field-tz-preloader-dialog',
    //                     'modal': true,
    //                     'autoOpen': false,
    //                     'closeOnEscape': true,
    //                     'draggable': false,
    //                     'buttons'       : {
    //                         "Close": function() {
    //                             $(this).dialog('close');
    //                         }
    //                     }
    //                 }).removeClass("hide").dialog('open');
    //                 // $mcontent;
    //             });
    //         });
    //
    //     }
    // });
})(jQuery);