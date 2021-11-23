(function($) {
    "use strict";

    // alert("section shortcode");
    // templaza = templaza || {};
    templaza.shortcode = templaza.shortcode || {};
    templaza.shortcode.text = templaza.shortcode.text || {};
    //
    templaza.shortcode.text.setting_edit_before_init_fields  = function(fields, dialog, element){
        UIkit.util.on(dialog, 'hidden', function () {

            if($(this).find(".wp-editor-area").length) {
                $.each($(this).find(".wp-editor-area"), function (i) {
                    var _id = $(this).attr("id");
                    wp.editor.remove(_id);
                });
            }
            // do something
            // alert("Modal hidden");
        });
        // UIkit.modal($( this ).closest(".uk-modal")).hide();
    };
    templaza.shortcode.text.setting_edit_after_init_field  = function(field, dialog){
        var _editors = dialog.find(".wp-editor-area");
        $.each(_editors, function(i) {
            var _id = $(this).attr("id");
            setTimeout(function () {
                dialog.find("#" + _id + "-tmce").trigger("click");
            }, 100);
        });
    };
    templaza.shortcode.text.load_setting  = function(value, element, form){
        if(value["text"] !== undefined){
            value["params"]["text"] = value["text"];
        }
        var _editors = form.find(".wp-editor-area");

        if(_editors.length){
            $.each(_editors, function(i){
               var _id = $(this).attr("id"),
                   _param = value["params"] !== undefined?value["params"]:{};

                $(this).val(_param[_id]);

                // setTimeout(function(){
                //     form.find("#"+_id+"-tmce").trigger("click");
                // }, 100);
            });

            // console.log(typeof wp.editor);
            // // console.log(wp.editor.remove("text"));
            // console.log(wp.editor.initialize("text"));
            // console.log(wp.editor.getContent("text"));
            // console.log(tinymce.activeEditor.isHidden());
            // console.log(tinymce.activeEditor.getContent());
            // console.log(tinymce.activeEditor.fixed());
            //
            // // _dialog.find("#text-tmce").trigger("click");
            // // tinymce.on('addeditor', function( event ) {
            // //     var editor = event.editor;
            // //     var $textarea = $('#' + editor.id);
            // //     console.log($textarea.val());
            // // }, true );
        }
    };
    templaza.shortcode.text.prepare_setting  = function(setting, form, element){

        var _editors = form.find(".wp-editor-area");
        var  _id = "text",
            _editor = window.tinymce.get(_id),
            _params = setting["params"] !== undefined?setting["params"]:{},
            _text;

        // if(_params[_id] !== undefined){
        //     _text = _params[_id];
        //     delete setting["params"][_id];
        // }
        //
        // if(_editor){
        //     _text = wp.editor.getContent(_id);
        // }
        // if(_text.length){
        //     setting[_id] = _text;
        // }

        if(_editors.length){
            $.each(_editors, function(i){
                // var _id = $(this).attr("id"),
                //     _param = value["params"] !== undefined?value["params"]:{};
                var _id = $(this).attr("id");
                if(_params[_id] !== undefined){
                    _text = _params[_id];
                    delete setting["params"][_id];
                }

                if(_editor){
                    _text = wp.editor.getContent(_id);
                }
                if(_text && _text.length){
                    setting[_id] = _text;
                }
            });
        }
        return setting;
    };

    // templaza.shortcode.text.save_setting = function(setting, element, form){
    //     console.log(setting);
    // };
})(jQuery);