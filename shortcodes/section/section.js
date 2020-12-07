(function($) {
    "use strict";

    // alert("section shortcode");
    // templaza = templaza || {};
    templaza.shortcode = templaza.shortcode || {};
    templaza.shortcode.section = templaza.shortcode.section || {};
    //
    templaza.shortcode.section.prepare_setting  = function(setting){
        return setting;
    };

    templaza.shortcode.section.save_setting = function(setting, element, form){
        if(typeof setting.admin_label !== typeof undefined && element.find(".fl_controls .fl_control-title").length){
            element.find(".fl_controls .fl_control-title").first().text(setting.admin_label);
        }
        if(typeof setting.params.layout_type !== typeof undefined){
            switch (setting.params.layout_type) {
                default:

                    break;
                case 'no-container':
                case 'custom-container':
                case "container-with-no-gutters":
                case "container-fluid-with-no-gutters":
                    if(setting.elements.length){
                        $.each(setting.elements, function(index, value){
                            value.params.tz_no_gutters  = true;
                        });
                    }
                    break;
            }
        }
    };
})(jQuery);