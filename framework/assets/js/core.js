
    var templaza    = {};
(function($) {
    "use strict";

    templaza.getStorageItem = templaza.getStorageItem || function(key){
        var __key   = "templaza-framework";
        var __templaza = localStorage.getItem(__key);
        try {
            __templaza  = __templaza?__templaza:{};
            __templaza  = (__templaza && typeof __templaza === "string")?JSON.parse(__templaza):__templaza;

            return __templaza[key];
        } catch (_unused) {
            return undefined;
        }
    };
    templaza.setStorageItem = templaza.setStorageItem || function(key, value){
        try {
            var __key   = "templaza-framework";
            var __templaza = localStorage.getItem(__key);

            __templaza  = __templaza?__templaza:{};
            __templaza  = (__templaza && typeof __templaza === "string")?JSON.parse(__templaza):__templaza;

            __templaza[key] = value;

            localStorage.setItem(__key, JSON.stringify(__templaza));
        } catch (_unused2) {
            return false;
        }

        return true;
    };

    templaza.copyClipboard  = templaza.copyClipboard || function(key, value){
        try{
            var __clipboard = templaza.getStorageItem("clipboard");

            __clipboard = __clipboard?__clipboard:{};
            __clipboard = (__clipboard && typeof __clipboard === "string")?JSON.parse(__clipboard):__clipboard;

            __clipboard[key]    = value;

            return templaza.setStorageItem("clipboard", __clipboard);
        }catch (e) {
            return false;
        }
    };

    templaza.getClipboard  = templaza.getClipboard || function(key){
        try {
            var __clipboard = templaza.getStorageItem("clipboard");

            __clipboard = __clipboard ? __clipboard : {};
            __clipboard = typeof __clipboard === "string" ? JSON.parse(__clipboard) : __clipboard;

            return __clipboard[key];
        }catch (e) {
            return false;
        }
    };

    templaza.removeClipboard  = templaza.removeClipboard || function(key){
        var __clipboard = templaza.getStorageItem("clipboard");

        __clipboard = __clipboard?__clipboard:{};
        __clipboard = typeof __clipboard === "string"?JSON.parse(__clipboard):__clipboard;

        delete __clipboard[key];

        templaza.setStorageItem("clipboard", __clipboard);

        return true;
    };

    $(document).ready(function(){
        var tzoptions = $("#poststuff .templaza-framework-options");
        tzoptions.find("[name=action]").remove();
        tzoptions.find("[name=_wpnonce]").remove();
        tzoptions.find("[name=_wp_http_referer]").remove();
       // console.log($("#poststuff .templaza-framework-options"));

        $("#post").submit(function(){
            window.onbeforeunload = null;
        });
    });
})(jQuery, window);