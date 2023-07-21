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
                __can_preloader = __preloader.length && typeof el_ajax !== "undefined"
                    && el_ajax.closest($var.item_preload_dest).length;
            if(__can_preloader) {
                __preload_item.appendTo(el_ajax.closest($var.item_preload_dest))
                    .fadeIn();
            }

            $.post(url, data, function (response) {
                if (response.success) {
                    if (response.nextstep !== undefined) {
                        $installer.ajax($var.ajaxurl, response.nextstep);
                    }else {
                        __preload_item.fadeOut(400, function () {
                            $(this).remove();
                            if (typeof response.redirect !== "undefined") {
                                window.location = response.redirect;
                            }
                        });
                    }
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
})(jQuery, UIkit);