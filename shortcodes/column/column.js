(function($) {
    "use strict";

    templaza.shortcode = templaza.shortcode || {};
    templaza.shortcode.column = templaza.shortcode.column || {};

    templaza.shortcode.column.load_setting = function(setting, element, form){
        if(form.find("[name=lg_colum_size]").length) {
            form.find("[name=lg_colum_size]").val(setting.size);
        }
    };

    templaza.shortcode.column.save_setting = function(setting, element, form){
        if(typeof setting.params !== typeof undefined) {
            var params = setting.params;
            if(typeof params.lg_colum_size !== typeof undefined && params.lg_colum_size !== ""){
                element.attr("data-column-width", params.lg_colum_size);
                element.attr('class', function(i, c){
                    return c.replace(/(^|\s)col-\S+/g, "col-" + params.lg_colum_size);
                });
                setting.size    = parseInt(params.lg_colum_size);
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