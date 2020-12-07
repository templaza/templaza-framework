(function($) {
    "use strict";

    // alert("section shortcode");
    // templaza = templaza || {};
    templaza.shortcode = templaza.shortcode || {};
    templaza.shortcode.text = templaza.shortcode.text || {};
    //
    templaza.shortcode.text.prepare_setting  = function(setting){
        return setting;
    };

    templaza.shortcode.text.save_setting = function(setting, element, form){
        // alert("Test");
        console.log(setting);
        console.log(form.find(".wp-editor-area").val());
        console.log(element);
        // if(typeof setting.admin_label !== typeof undefined && element.find(".fl_controls .fl_control-title").length){
        //     element.find(".fl_controls .fl_control-title").first().text(setting.admin_label);
        // }
        
    };
})(jQuery);