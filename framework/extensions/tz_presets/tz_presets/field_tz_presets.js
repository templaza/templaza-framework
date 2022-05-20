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

            el.off("click", ".js-save-preset").on("click", ".js-save-preset", function(){

                var __form_data = el.serializeForm();

                // if(!__form_data && !__form_data.length){
                //     UIkit.modal.alert("Please insert name of preset!");
                //     return;
                // }
                if(!__form_data && !__form_data.length){
                    UIkit.modal.alert("Please enter value of preset!");
                    return;
                }

                __form_data = __form_data[Object.keys(__form_data).pop()];

                var __btn    = $(this),
                    __title = typeof __form_data["title"] !== "undefined"?__form_data["title"]:"",
                    __secret = __btn.data("secret"),
                    __ajax_data = get_ajax_data();

                if(!__title && !__title.trim().length){
                    UIkit.modal.alert("Please enter title of preset!");
                    return;
                }

                __ajax_data["preset_data"]  = __form_data;

                __ajax_data["action"]   = "templaza_framework_save_presets-"+redux.optName.args.opt_name;

                if(typeof __secret !== "undefined" && __secret){
                    __ajax_data["secret"] = __secret;
                }

                // Get config
                var __main  = el.closest(".redux-main"),
                    __options = __main.serializeForm();

                __ajax_data["preset"] =  JSON.stringify(__options[redux.optName.args.opt_name]);

                $.post(ajaxurl,__ajax_data,function (response) {
                    if(response && response.success){
                        if(typeof response.data.message !== "undefined") {
                            UIkit.notification({
                                "message": response.data.message,
                                "status": "success",
                                "pos": "bottom-right"
                            });
                        }
                        window.location = window.location.href;
                        // window.location.reload();
                    }else if(typeof response.data.message !== "undefined") {
                        UIkit.notification({
                            "message": response.data.message,
                            "status": "danger",
                            "pos"  : "bottom-right"
                        });
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

                    $.post(ajaxurl, __ajax_data, function (response) {
                        if (response && response.success) {
                            UIkit.notification({
                                "pos":      "bottom-right",
                                "status":   "success",
                                "message":  '<div class="uk-text-break">' + response.data.message + '</div>'
                            });
                            window.location = window.location.href;
                        }else{
                            UIkit.notification({
                                "pos":      "bottom-right",
                                "status":   "danger",
                                "message":  '<div class="uk-text-break">' + response.data.message + '</div>'
                            });
                        }
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

                    $.post(ajaxurl, __ajax_data, function (response) {
                        if (response && response.success) {
                            UIkit.notification({
                                "pos":      "bottom-right",
                                "status":   "success",
                                "message":  '<div class="uk-text-break">' + response.data.message + '</div>'
                            });
                            window.location = window.location.href;
                        }else{
                            UIkit.notification({
                                "pos":      "bottom-right",
                                "status":   "danger",
                                "message":  '<div class="uk-text-break">' + response.data.message + '</div>'
                            });
                        }
                    });
                }, function () {
                    return;
                });
            });

            // var __mediaUploader;
            // el.find(".js-upload-image").off("click").on("click", function(e){
            //     e.preventDefault();
            //
            //     // If the uploader object has already been created, reopen the dialog
            //     if (__mediaUploader) {
            //         __mediaUploader.open();
            //         return;
            //     }
            //     // Extend the wp.media object
            //     __mediaUploader = wp.media.frames.file_frame = wp.media({
            //         title: 'Choose Image',
            //         button: {
            //             text: 'Choose Image'
            //         }, multiple: false });
            //
            //     // // When a file is selected, grab the URL and set it as the text field's value
            //     // __mediaUploader.on('select', function() {
            //     //     var attachment = __mediaUploader.state().get('selection').first().toJSON();
            //     //     $('#image-url').val(attachment.url);
            //     // });
            //     // Open the uploader dialog
            //     __mediaUploader.open();
            // });
        });
    }
})(jQuery);