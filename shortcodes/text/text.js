(function($) {
    "use strict";

    // alert("section shortcode");
    // templaza = templaza || {};
    templaza.shortcode = templaza.shortcode || {};
    templaza.shortcode.text = templaza.shortcode.text || {};
    //
    templaza.shortcode.text.load_setting  = function(value, element, form){
        if(value["text"] !== undefined){
            value["params"]["text"] = value["text"];
        }
        var _editors = form.find(".wp-editor-area");

        if(_editors.length){
            $.each(_editors, function(){
               var _id = $(this).attr("id"),
                   _param = value["params"] !== undefined?value["params"]:{};
                $(this).val(_param[_id]);
            });
        }
    };
    templaza.shortcode.text.prepare_setting  = function(setting, form, element){
        console.log(setting);
        var  _id = "text",
            _editor = window.tinymce.get(_id),
            _params = setting["params"] !== undefined?setting["params"]:{},
            _text;

        if(_params[_id] !== undefined){
            _text = _params[_id];
            delete setting["params"][_id];
        }

        if(_editor){
            _text = wp.editor.getContent(_id);
        }
        if(_text.length){
            setting[_id] = _text;
        }
        return setting;
    };

    // templaza.shortcode.text.save_setting = function(setting, element, form){
    //     console.log(setting);
    // };
})(jQuery);