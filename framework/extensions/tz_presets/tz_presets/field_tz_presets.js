(function($) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.tz_presets = redux.field_objects.tz_presets || {};

    redux.field_objects.tz_presets.init = function (selector) {
        selector = $.redux.getSelector( selector, 'tz_presets' );

        $( selector ).each(function() {
            var field_tz_presets    = field_tz_presets || {},
                __i18n = field_tz_presets.i18n || {
                    "messages" :{
                        'valid_name' : 'Please insert name of preset!',
                        'remove_confirm' : 'This preset will be deleted! Are you sure?',
                        'load_confirm' : 'Your current configure will be lost and overwritten by new data. Are you sure?'
                    }
                };
            var el     = $( this ),
                _el_main = el.find(".js-field-tz_presets"),
                __page = _el_main.attr("data-field-page"),
                __post_type = _el_main.attr("data-field-post-type"),
                __post_id = _el_main.attr("data-field-post-id");

            var get_ajax_data = function () {

                var __ajax_data = {};

                if(typeof __page !== "undefined" && __page){
                    __ajax_data["page"] = __page;
                }
                if(typeof __post_type !== "undefined" && __post_type){
                    __ajax_data["post_type"] = __post_type;
                }
                if(typeof __post_id !== "undefined" && __post_id){
                    __ajax_data["post_id"] = __post_id;
                }

                return __ajax_data;
            };

            el.on("click", ".js-save-preset", function(){
                var __btn    = $(this),
                    __title = el.find(".js-preset-title").val(),
                    __description = el.find(".js-preset-description").val(),
                    __secret = __btn.data("secret"),
                    __ajax_data = get_ajax_data();

                if(!__title && !__title.trim().length){
                    alert("Please insert name of preset!");
                    el.find(".js-preset-title").focus();
                    return;
                }

                __ajax_data["title"] = __title;
                __ajax_data["description"] = __description;
                __ajax_data["action"]   = "templaza_framework_save_presets-"+redux.optName.args.opt_name;

                if(typeof __secret !== "undefined" && __secret){
                    __ajax_data["secret"] = __secret;
                }

                // Get config
                var __main  = el.closest(".redux-main"),
                    __options = __main.serializeForm();

                __ajax_data["preset"] =  JSON.stringify(__options[redux.optName.args.opt_name]);

                $.post(ajaxurl,__ajax_data,function (data) {
                    if(data && data.success){
                        window.location = window.location.href;
                        // window.location.reload();
                    }
                });
            });

            // UIkit.util.on(el.find(".js-remove-preset"), 'click', function (e) {
            el.find(".js-remove-preset").off("click").on("click", function (e) {
                e.preventDefault();
                // e.target.blur();

                var __btn = $(this),
                    __name = __btn.data("name"),
                    __secret = __btn.data("secret"),
                    __ajax_data = get_ajax_data();
                UIkit.modal.confirm(__i18n.messages.remove_confirm).then(function () {
                    __ajax_data["action"] = "templaza_framework_remove_presets-" + redux.optName.args.opt_name;

                    __ajax_data["name"] = __name;

                    if (typeof __secret !== "undefined" && __secret) {
                        __ajax_data["secret"] = __secret;
                    }

                    $.post(ajaxurl, __ajax_data, function (data) {
                        // if (data && data.success) {
                        //     window.location.href = window.location.href;
                        // }
                        //
                        window.location = window.location.href;
                    });
                }, function () {
                    return;
                });
            });

            el.find(".js-load-preset").off("click").on("click", function(){
                var __btn = $(this),
                    __name = __btn.data("name"),
                    __secret = __btn.data("secret"),
                    __ajax_data = get_ajax_data();
                UIkit.modal.confirm(__i18n.messages.load_confirm).then(function () {
                    __ajax_data["action"] = "templaza_framework_load_presets-" + redux.optName.args.opt_name;

                    __ajax_data["name"] = __name;

                    if (typeof __secret !== "undefined" && __secret) {
                        __ajax_data["secret"] = __secret;
                    }

                    $.post(ajaxurl, __ajax_data, function (data) {
                        if (data && data.success) {
                            window.location = window.location.href;
                            // window.location.href = window.location.href;
                        }
                        //
                        // window.location.href = window.location.href;
                    });
                }, function () {
                    return;
                });
            });
        });
    }
})(jQuery);