(function($) {
    "use strict";

    templaza.shortcode = templaza.shortcode || {};
    templaza.shortcode.column = templaza.shortcode.column || {};

    templaza.shortcode.column.init = function(element, params){
        if(typeof element.size !== "undefined" && typeof element.size === "number") {
            element.size = templaza.shortcode.column.convert_column_to_UIkit(element.size);
        }
    };
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
            form.find("[name=lg_size]").val(templaza.shortcode.column.convert_column_to_UIkit(setting.size));
        }
    };

    templaza.shortcode.column.convert_column_to_UIkit = function($column) {
        var __col_real = $column;
        var __modulo = 12 % $column;
        switch ($column) {
//                case 1:
//                    __col_real   = '1-12';
//                    break;
            case 2:
            case 3:
            case 4:
            case 6:
            case 8:
            case 9:
            case 10:
                if (__modulo == 0) {
                    __col_real = "1-" + (12 / $column);
                } else {
                    __col_real = ($column / __modulo) + "-" + (12 / __modulo);
                }
                break;
            case 5:
                __col_real = "1-5";
                break;
            case 7:
                __col_real = "4-5";
                break;
//                case 11:
//                    __col_real   = '11-12';
//                    break;
            case 12:
                __col_real = "1-1";
                break;
        }
        return __col_real;
    };

    templaza.shortcode.column.save_setting = function(setting, element, form){
        if(typeof setting.params !== typeof undefined) {
            var params = setting.params;
            if(typeof params.lg_size !== "undefined" && params.lg_size !== ""){
                element.attr("data-column-width", params.lg_size);
                element.attr('class', function(i, c){
                    if(typeof params.lg_size === "string"){
                        return c.replace(/(^|\s)uk-width-\S+/g, "uk-width-" + params.lg_size);
                    }else {
                        return c.replace(/(^|\s)col-\S+/g, "col-" + params.lg_size);
                    }
                });
                setting.size    = params.lg_size;
                // setting.size    = parseInt(params.lg_size);
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