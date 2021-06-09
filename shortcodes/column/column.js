(function($) {
    "use strict";

    templaza.shortcode = templaza.shortcode || {};
    templaza.shortcode.column = templaza.shortcode.column || {};

    templaza.shortcode.column.load_setting = function(setting, element, form){
        if(typeof setting.params.xs_visibility === "undefined" ||
            (typeof setting.params.xs_visibility !== "undefined" && setting.params.xs_visibility === "")){
            form.find("[name=xs_visibility]").val(1);
        }
        if(typeof setting.params.sm_visibility === "undefined" ||
            (typeof setting.params.sm_visibility !== "undefined" && setting.params.sm_visibility === "")){
            form.find("[name=sm_visibility]").val(1);
        }
        if(typeof setting.params.md_visibility === "undefined" ||
            (typeof setting.params.md_visibility !== "undefined" && setting.params.md_visibility === "")){
            form.find("[name=md_visibility]").val(1);
        }
        if(typeof setting.params.lg_visibility === "undefined" ||
            (typeof setting.params.lg_visibility !== "undefined" && setting.params.lg_visibility === "")){
            form.find("[name=lg_visibility]").val(1);
        }
        if(typeof setting.params.xl_visibility === "undefined" ||
            (typeof setting.params.xl_visibility !== "undefined" && setting.params.xl_visibility === "")){
            form.find("[name=xl_visibility]").val(1);
        }
        if(typeof setting.params.xxl_visibility === "undefined" ||
            (typeof setting.params.xxl_visibility !== "undefined" && setting.params.xxl_visibility === "")){
            form.find("[name=xl_visibility]").val(1);
        }
        if(form.find("[name=lg_size]").length) {
            form.find("[name=lg_size]").val(setting.size);
        }
    };

    templaza.shortcode.column.save_setting = function(setting, element, form){
        if(typeof setting.params !== typeof undefined) {
            var params = setting.params;
            if(typeof params.lg_size !== typeof undefined && params.lg_size !== ""){
                element.attr("data-column-width", params.lg_size);
                element.attr('class', function(i, c){
                    return c.replace(/(^|\s)col-\S+/g, "col-" + params.lg_size);
                });
                setting.size    = parseInt(params.lg_size);
            }
        }
    };
    templaza.shortcode.column.prepare_setting  = function(setting, form_element, element){
        if(typeof element !== "undefined" && typeof element.data("column-width") !== typeof undefined){
            setting.size    = element.data("column-width");
        }else{
            setting.size    = form_element.data("column-width");
        }
        return setting;
    };
})(jQuery);