
    var templaza    = {};
(function($) {
    "use strict";

    $(document).ready(function(){
        var tzoptions = $("#poststuff .templaza-framework-options");
        tzoptions.find("[name=action]").remove();
        tzoptions.find("[name=_wpnonce]").remove();
        tzoptions.find("[name=_wp_http_referer]").remove();
       // console.log($("#poststuff .templaza-framework-options"));


    });
})(jQuery, window);