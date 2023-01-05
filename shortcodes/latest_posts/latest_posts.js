(function($) {
    "use strict";

    templaza.shortcode = templaza.shortcode || {};
    templaza.shortcode.latest_posts = templaza.shortcode.latest_posts || {};

    templaza.shortcode.latest_posts.load_setting = function(setting, element, form){
    //     if(typeof setting.params["menu_id"] === "undefined"){
    //         setting.params["menu_id"]   = setting.menu_id;
    //         if(form.find("[name=menu_id]").length) {
    //             form.find("[name=menu_id]").val(setting.menu_id);
    //         }
    //     }
    //     if(typeof setting.params["menu_slug"] === "undefined"){
    //         setting.params["menu_slug"]   = setting.menu_slug;
    //         if(form.find("[name=menu_slug]").length) {
    //             form.find("[name=menu_slug]").val(setting.menu_slug);
    //         }
    //     }
        console.log(setting);
        console.log(element);
        console.log(form);
        templaza.shortcode.latest_posts.__ajax_get_categories(form.find("[name=latest_post_type]").val());
        form.find("[name=latest_post_type]").on("change", function(event){
            console.log("Changed");
            templaza.shortcode.latest_posts.__ajax_get_categories($(this).val());
        });
    };

    templaza.shortcode.latest_posts.__ajax_get_categories   = function(post_type){
      $.ajax({
          url: window.ajaxurl,
          data: {
              action: "templaza-framework",
              post_type: post_type,
              shortcode: "latest_posts",
              shortcode_action: "get_categories",
          }
      });
    };

    //
    // templaza.shortcode.latest_posts.save_setting = function(setting, element, form){
    // };
    // templaza.shortcode.latest_posts.prepare_setting  = function(setting, form_element, element){
    //     return setting;
    // };
})(jQuery);