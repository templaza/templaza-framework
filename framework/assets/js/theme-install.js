(function($, UIkit){
    $.Templaza_FrameworkThemeInstall = function(el, options){
        var $installer  =$(el),
            $var = $.extend({}, $.Templaza_FrameworkThemeInstall.defaults, options);

        $installer.var = $var;

        var $selector   = $installer.find($var.selector),
            __i18n   = typeof $var.i18n !== "undefined"?$var.i18n:{},
            __preloader = $installer.find($var.preloader),
            __theme_install = typeof $var.theme_install !== "undefined"?$var.theme_install:{};

        // Store a reference to the slider object
        $.data(el, "themeInstall", $installer);

        $installer.ajax = function(url, data, el_ajax){
            var __preload_item = __preloader.clone(),
                __can_preloader = __preloader.length && el_ajax.closest($var.item_preload_dest).length;
            if(__can_preloader) {
                __preload_item.appendTo(el_ajax.closest($var.item_preload_dest))
                    .fadeIn();
            }

            $.post(url, data, function (response) {
                console.log(response);

                if (response.success) {
                    if (response.nextstep !== undefined) {
                        //
                        // var totalStep = 1;

                        // if(response.action_import === undefined){
                        //     each    = each / 2;
                        // }

                        // console.log(response.nextstep);

                        // /* Total step is total package files from server */
                        // if (response.nextstep.total_step !== undefined) {
                        //     if(count === totalItem) {
                        //         totalStep = response.nextstep.total_step;
                        //     }else {
                        //         totalStep = response.nextstep.total_step + 1;
                        //     }
                        // }
                        // var eachStep = each/ totalStep;

                        // /* Set current step */
                        // item.data("tzinst_import_ajax_current_step", eachStep);
                        //
                        // percentage = currentWidth + eachStep;
                        //
                        // progress_bar.css('width', percentage + '%');

                        /* Call ajax with the next step */
                        // tzinst_import_ajax(response.nextstep, button, form, totalItem, totalItemCheck, count);

                        $installer.ajax($var.ajaxurl, postdata);
                    }
                    __preload_item.fadeOut(400, function(){
                        $(this).remove();
                        if(typeof response.redirect !== "undefined"){
                            window.location    = response.redirect;
                        }
                    });
                }else{
                    if(typeof response.redirect !== "undefined"){
                        window.location    = response.redirect;
                    }
                }
            }, "json");
        }

        if($selector.length){
            $selector.off("click").on("click", function(){
               var __input = $(this);

                UIkit.modal.confirm(__i18n.install_theme_question).then(function () {

                    var postdata    = {
                        "action": "tzinst_theme_install",
                        page: $var.page,
                        security: __theme_install.theme_install_nonce,
                    };

                    if($selector.data("theme-pack") !== undefined){
                        postdata['pack'] = __input.data("theme-pack");
                    }
                    if($selector.data("theme-pack-type")) {
                        postdata['pack_type'] = __input.data("theme-pack-type");
                    }
                    if($selector.data("theme-title") !== undefined){
                        postdata["theme_title"] = __input.data("theme-title");
                    }

                    $installer.ajax($var.ajaxurl, postdata, __input);
                }, function () {
                    return false;
                });
            });
        }
    };

    $.Templaza_FrameworkThemeInstall.defaults = {
        selector: "[data-install-theme]",
        item: ".item",
        item_preload_dest: ".item-inner",
        preloader: ".tzinst-preloader",
        page: "",
        ajaxurl: "",
        i18n: {},
        theme_install: {},
    }

    $.fn.Templaza_FrameworkThemeInstall = function(options){

        if (options === undefined) { options = {}; }

        // // This is the easiest way to have default options.
        // var settings = $.extend({}, options );

        return this.each(function() {
            var $this = $(this);
            console.log($this.data('themeInstall'));

            if ($this.data('themeInstall') === undefined) {
                new $.Templaza_FrameworkThemeInstall(this, options);
            }
        });
    };

    $(document).ready(function(){
       $(".tzinst-theme-install").Templaza_FrameworkThemeInstall({
           ajaxurl: ajaxurl,
           i18n: tzinst_theme_install.l10nStrings,
           page: templazaInstallationSettings.page,
           theme_install: tzinst_theme_install,
       });
    });
    // $(document).on("click", ".tzinst-theme-install [data-install-theme]", function(){
    //     var __input = $(this),
    //         __theme_install = typeof tzinst_theme_install !== "undefined"?tzinst_theme_install:{},
    //         __i18n  = typeof __theme_install.l10nStrings !== "undefined"?__theme_install.l10nStrings:{};
    //
    //     UIkit.modal.confirm(__i18n.install_theme_question).then(function () {
    //
    //         var postdata    = {
    //             "action": "tzinst_theme_install",
    //             page: templazaInstallationSettings.page,
    //             security: __theme_install.theme_install_nonce,
    //         };
    //
    //         if(__input.data("theme-pack") !== undefined){
    //             postdata['pack'] = __input.data("theme-pack");
    //         }
    //         if(__input.data("theme-pack-type")) {
    //             postdata['pack_type'] = __input.data("theme-pack-type");
    //         }
    //         if(__input.data("theme-title") !== undefined){
    //             postdata["theme_title"] = __input.data("theme-title");
    //         }
    //
    //         $.post(ajaxurl, postdata, function (response) {
    //
    //             if (response.success) {
    //                 if (response.nextstep !== undefined) {
    //
    //                     var totalStep = 1;
    //
    //                     // if(response.action_import === undefined){
    //                     //     each    = each / 2;
    //                     // }
    //
    //                     /* Total step is total package files from server */
    //                     if (response.nextstep.total_step !== undefined) {
    //                         if(count === totalItem) {
    //                             totalStep = response.nextstep.total_step;
    //                         }else {
    //                             totalStep = response.nextstep.total_step + 1;
    //                         }
    //                     }
    //                     // var eachStep = each/ totalStep;
    //
    //                     // /* Set current step */
    //                     // item.data("tzinst_import_ajax_current_step", eachStep);
    //                     //
    //                     // percentage = currentWidth + eachStep;
    //                     //
    //                     // progress_bar.css('width', percentage + '%');
    //
    //                     /* Call ajax with the next step */
    //                     tzinst_import_ajax(response.nextstep, button, form, totalItem, totalItemCheck, count);
    //                 }
    //             }
    //         });
    //     }, function () {
    //         return false;
    //     });
    // });
})(jQuery, UIkit);