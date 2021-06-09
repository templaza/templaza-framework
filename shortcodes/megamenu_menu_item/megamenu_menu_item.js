(function($) {
    "use strict";

    templaza.shortcode = templaza.shortcode || {};
    templaza.shortcode.megamenu_menu_item = templaza.shortcode.megamenu_menu_item || {};

    templaza.shortcode.megamenu_menu_item.load_setting = function(setting, element, form){
        if(typeof setting.params["menu_id"] === "undefined"){
            setting.params["menu_id"]   = setting.menu_id;
            if(form.find("[name=menu_id]").length) {
                form.find("[name=menu_id]").val(setting.menu_id);
            }
        }
        if(typeof setting.params["menu_slug"] === "undefined"){
            setting.params["menu_slug"]   = setting.menu_slug;
            if(form.find("[name=menu_slug]").length) {
                form.find("[name=menu_slug]").val(setting.menu_slug);
            }
        }
    };

    templaza.shortcode.megamenu_menu_item.save_setting = function(setting, element, form){
    };
    templaza.shortcode.megamenu_menu_item.prepare_setting  = function(setting, form_element, element){
        return setting;
    };
})(jQuery);