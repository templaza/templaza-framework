(function ($) {
    "use strict";

    $(document).ready(function(){
        function tzinst_license_active() {
            var popup, timeInterval, templatejson = null,
                btn_active = $("[data-tzinst-active-license]");

            // if(btn_active.length){
            if(typeof tzinst_license_ajax !== "undefined")try {
                templatejson = tzinst_license_ajax.license_active;
            }catch (window) {}

            if (null != templatejson) {
                var doc = $("<html>"),
                    head = $("<head>"),
                    body = $("<body>");
                doc.append(head).append(body);
                var style = $("<link>").attr({
                    rel: "stylesheet",
                    href: templatejson.api + "/components/com_tz_envato_license/css/style.css"
                });
                head.append(style), head.append("<title>"+ tzinst_license_ajax.strings.theme_active_title +"</title>");
                var form = $('<form style="display:none;">').attr({
                    action: templatejson.api + '/index.php?option=com_tz_envato_license&view=activation',
                    method: "POST",
                    enctype: "multipart/form-data",
                    id: templatejson.productname.toLowerCase() + "-activate-product-form",
                    acceptCharset: "ISO-8859-1"
                }).append('<div class="'+templatejson.productname.toLowerCase() +'-activation-loading"><div class="'
                    +templatejson.productname.toLowerCase()
                    +'-activation-loading-content"><h2>'+tzinst_license_ajax.strings.loading+'</h2><p>'+tzinst_license_ajax.strings.loading_desc+'</p></div></div>');
                for (var jsonelement in templatejson) {
                    // console.log(jsonelement);
                    $("<input>").attr({
                        type: "hidden",
                        name: jsonelement,
                        value: templatejson[jsonelement]
                    }).appendTo(form);
                }
                body.append(form);
                var browser = function () {
                    var userAgent = window.navigator.userAgent,
                        n = userAgent.indexOf("MSIE ");
                    if (n > 0) return parseInt(userAgent.substring(n + 5, userAgent.indexOf(".", n)), 10);
                    if (userAgent.indexOf("Trident/") > 0) {
                        var a = userAgent.indexOf("rv:");
                        return parseInt(userAgent.substring(a + 3, userAgent.indexOf(".", a)), 10)
                    }
                    var o = userAgent.indexOf("Edge/");
                    return o > 0 && parseInt(userAgent.substring(o + 5, userAgent.indexOf(".", o)), 10)
                }();
                browser && (form.attr("target", "tzinstProductActivationWindow"), form.appendTo($(document.body)));

                var _activate_license    = function(){
                    var html = doc.clone(),
                        forminside = html.find("form"),
                        maxheight = 600,
                        minheight = browser ? 550 : 350,
                        screenW = screen.width / 2 - 300,
                        screenH = screen.height / 2 - minheight / 2;
                    //window.open("https://joomla.templaza.com/tzportfolio.com/joomla/index.php?option=com_tz_envato_license&view=activation&code=981532f23c9ca9474aa5c33197f76aca38bce1b70753f5a1e989a3a2f569d5de", "tzinstProductActivationWindowf", "width=600, height=" + minheight + ", top=" + screenH + ", left=" + screenW);
                    popup = window.open("", "tzinstProductActivationWindow", "width=600, height=" + minheight + ", top=" + screenH + ", left=" + screenW);
                    browser ? form.submit() : $(popup.document.body).append(html);
                    popup ? browser || html.find("link").on("load", function () {
                        forminside.show(), setTimeout(function () {
                            minheight = 800, popup.resizeTo(maxheight, minheight), popup.moveBy(0, -200);
                            forminside.submit();
                        }, 1100)
                    }) : alert(tzinst_license_ajax.strings.browser_warning);
                    window.clearInterval(timeInterval), timeInterval = setInterval(function () {
                        if (browser) {
                            try {
                                popup.parent
                            } catch (e) {
                                window.clearInterval(timeInterval), window.location.reload()
                            }
                        } else popup.parent || (window.clearInterval(timeInterval), window.location.reload())
                    }, 300);
                };

                btn_active.on("click", function (a) {
                    a.preventDefault();
                    _activate_license();
                });


                $("[data-tzinst-reactivate-license]").on("click", function (t) {
                    t.preventDefault();
                    _activate_license();
                });
            }

            $("[data-tzinst-delete-license]").on("click", function (t) {
                var $this = $(this);

                var __delete_license = function(){
                    var request = {};
                    // request[token] = 1;
                    request['action'] = 'ajax_deactivate_license';
                    request['page'] = tzinst_license_ajax.page;
                    $.ajax({
                        url: tzinst_license_ajax.admin_ajax_url ,
                        type: "POST",
                        dataType: "JSON",
                        data: request,
                        beforeSend: function () {
                            $this.find('> span:first-child').removeClass("dashicons dashicons-no").addClass(tzinst_license_ajax.loading_class_icon);
                        },
                        success: function (response) {
                            if(response.success && response.redirect){
                                window.location    = response.redirect;
                            }
                        }
                    });
                    return 1;
                };

                if(typeof UIkit !== "undefined" && typeof UIkit.modal !== "undefined"){
                    UIkit.modal.confirm(tzinst_license_ajax.strings.delete_question).then(function () {
                        return __delete_license();
                    }, function () {
                        return false;
                    });
                }else if (confirm(tzinst_license_ajax.strings.delete_question)) {
                    return __delete_license();
                }
            });
        }
        tzinst_license_active();

        // Plugin action
        function tzinst_plugin_action(obj, event, action = "install"){

            var $this = $( obj );

            if($this.hasClass("importing")){
                return;
            }

            var data = {
                    action: "tzinst_plugin_action",
                    plugin: $this.data("plugin"),
                    // plugin_name: $this.data("plugin_name"),
                    _nonce: $this.data( "nonce" ),
                },
                inputEl   = $this.closest(".item").find("input[type=checkbox]"),
                loadingHtml = $("<span class=\"spinner-border spinner-border-sm mr-1\"></span>");

            data["page"] = templazaInstallationSettings.page;

            if(action === "update"){
                data["tgmpa-update"]    = "update-plugin";
                data["tgmpa-nonce"]     = $this.data( "tgmpa-update_nonce" );
            }else if(action === "activate"){
                data["tgmpa-activate"]  = "activate-plugin";
                data["tgmpa-nonce"]     =  $this.data( "tgmpa-activate_nonce" );
            }else{
                data["tgmpa-install"]   = "install-plugin";
                data["tgmpa-nonce"]     =  $this.data( "tgmpa_nonce" );
            }

            if($this.closest(".tzinst-plugin__install").data("plugin-passed") !== undefined){
                data['passed']  = $this.closest(".tzinst-plugin__install").data("plugin-passed");
            }

            inputEl.prop("checked", true);
            $this.addClass("importing");

            if(!$this.find("> .spinner-border").length) {
                loadingHtml.prependTo($this);
            }

            $.get( ajaxurl, data, function( response ) {
                var $div   =  $("<div></div>");
                var message_box = $this.closest(".uk-modal").find("[data-import-message-box]");

                $div.append(response);
                var result  = {},
                    $error = false;

                if($div.find("[data-tzinst-install-plugin-message]") && $div.find("[data-tzinst-install-plugin-message]").length){
                    result  = JSON.parse($div.find("[data-tzinst-install-plugin-message]").text());

                    if(!result.success){
                        $error  = true;
                        if(result.install){
                            $this.removeClass("text-info update text-primary activate text-success activated")
                                .addClass("text-danger install").html(templazaInstallationSettings.l10nStrings.install);
                        }else if(result.update){
                            $this.removeClass("text-danger install text-primary activate text-success activated")
                                .addClass("text-info update").html(templazaInstallationSettings.l10nStrings.update);
                        }else if(result.activate){
                            $this.removeClass("text-danger install text-info update text-success activated")
                                .addClass("text-primary activate").html(templazaInstallationSettings.l10nStrings.activate);
                        }
                        if(result.message){
                            message_box.html("<div class=\"alert alert-danger rounded-0 uk-alert-danger\" data-uk-alert>"+
                                result.message
                                +"</div>");
                        }else{
                            message_box.html("<div class=\"alert alert-danger rounded-0 uk-alert-danger\" data-uk-alert>"+
                                $div.find(".wrap").find("> p:last-child").remove().end().html()
                                +"</div>");
                        }
                    }else{
                        if(result.activate){
                            $this.removeClass("text-danger install text-info update text-success activated")
                                .addClass("text-primary activate").html(templazaInstallationSettings.l10nStrings.activate);
                        }else if(result.activated){
                            $this.removeClass("text-danger install text-info update text-primary activate")
                                .addClass("text-success activated").html(templazaInstallationSettings.l10nStrings.activated);
                        }
                        if(result.message && !__tzinst_plugin_count(action)){
                            message_box.html("<div class=\"alert alert-success rounded-0 uk-alert-success\" data-uk-alert>"+
                                result.message
                                +"</div>");
                        }

                        if(typeof result.passed !== "undefined") {
                            $this.parents(".tzinst-plugin__install").data("plugin-passed", result.passed);
                        }
                    }
                }else{
                    $this.removeClass("text-danger install")
                        .addClass("text-success activated")
                        .html(templazaInstallationSettings.l10nStrings.activated);
                }


                if($this.hasClass("activated") && inputEl.is(":checked")) {
                    inputEl.prop("disabled", true);
                }
                $this.removeClass( 'importing' ).find(loadingHtml).remove();

                $(".tzinst-plugin__install input[data-checkbox-plugin-all]").data("clicked", false);

                if(__tzinst_plugin_count(action) && !$error) {
                    $(".js-tzinst-plugin__"+ action +"-all").trigger("click");
                }else if(!__tzinst_plugin_count(action)){
                    $(".js-tzinst-plugin__"+ action +"-all").addClass("uk-hidden");
                }
            }, "html" ).fail(function(jqXHR, textStatus, errorThrown){
                var message_box = $this.closest(".uk-modal").find("[data-import-message-box]");
                message_box.html("<div class=\"alert alert-danger rounded-0 uk-alert-danger\" data-uk-alert>"+
                    errorThrown + ": " +jqXHR.responseText
                    +"</div>");
            });
        }

        // Install & activate plugin click
        $(".js-tzinst-plugin__install").on("click", function(event){
            event.preventDefault();

            var $this = $( this );

            if($this.hasClass("importing") || $this.hasClass("activated")){
                return;
            }

            if($this.hasClass("activate")){
                // Activate plugin
                tzinst_plugin_action(this, event, "activate");
            }else if ($this.hasClass("install")) {
                // Install plugin
                tzinst_plugin_action(this, event);
            }else if($this.hasClass("update")) {
                // Update plugin
                tzinst_plugin_action(this, event, "update");
            }
        });

        $(".tzinst-plugin__install [data-plugin-item] input[type=checkbox]").on("change", function(){
            var $this = $(this);
            if($this.is(":checked")){
                $this.closest("[data-plugin-item]").addClass("checked");
            }else{
                $this.closest("[data-plugin-item]").removeClass("checked");
                $(".tzinst-plugin__install input[data-checkbox-plugin-all]").prop("checked", false);
            }
            if(__tzinst_plugin_count("install")){
                $(".js-tzinst-plugin__install-all").removeClass("uk-hidden");
            }else{
                $(".js-tzinst-plugin__install-all").addClass("uk-hidden");
            }
            if(__tzinst_plugin_count("update")) {
                $(".js-tzinst-plugin__update-all").removeClass("uk-hidden");
            }else{
                $(".js-tzinst-plugin__update-all").addClass("uk-hidden");
            }
            if(__tzinst_plugin_count("activate")) {
                $(".js-tzinst-plugin__activate-all").removeClass("uk-hidden");
            }else{
                $(".js-tzinst-plugin__activate-all").addClass("uk-hidden");
            }
        });

        $(".tzinst-plugin__install input[data-checkbox-plugin-all]").on("change", function(event){

            var $this   = $(this);

            var $parent = $this.closest(".tzinst-plugin__install");
            if($this.is( ":checked" )){
                $parent.find("[data-plugin-item] input[type=checkbox]:not(:disabled)").prop("checked", true ).trigger("change");
            }else{
                $parent.find("[data-plugin-item] input[type=checkbox]:not(:disabled)").prop("checked", false ).trigger("change");
            }
        });

        // Get count action button
        var __tzinst_plugin_count    = function(action = "install"){
            var els = $(".tzinst-plugin__install [data-plugin-item].checked");
            if(els.length){
                return els.find(".js-tzinst-plugin__install." + action).length;
            }
            return 0;
        };

        // Install plugins selected
        var __tzinst_plugin_find_action   = function(obj, action){
            var inputElAll = obj.closest(".item").find("input[data-checkbox-plugin-all]");

            if(inputElAll.data("clicked")){
                return;
            }

            inputElAll.data("clicked", true);

            var mainEl = obj.closest(".tzinst-plugin__install"),
                inputEls = mainEl.find("[data-plugin-item] input[type=checkbox]:checked:not(:disabled)"),
                inputCount = inputEls.length;
            var i = 0;

            if(!inputCount) {
                return;
            }

            var inputEl = inputEls.eq(i),
                elAction = inputEl.closest("[data-plugin-item]").find(".js-tzinst-plugin__install." + action);

            while(!elAction.length) {
                inputEl = inputEls.eq(i);
                elAction = inputEl.closest("[data-plugin-item]").find(".js-tzinst-plugin__install." + action);
                i++
            }

            if(!elAction.length) {
                return;
            }

            elAction.trigger("click");
        };

        $(".js-tzinst-plugin__install-all").on("click", function(e){
            e.preventDefault();
            __tzinst_plugin_find_action($(this), "install");
        });
        $(".js-tzinst-plugin__update-all").on("click", function(e){
            e.preventDefault();

            __tzinst_plugin_find_action($(this), "update");
        });
        $(".js-tzinst-plugin__activate-all").on("click", function(e){
            e.preventDefault();

            __tzinst_plugin_find_action($(this), "activate");
        });

        $(".js-tzinst-import").on("click", function(e){
            e.preventDefault();

            var $this   = $(this),
                modal   = $this.closest("[data-install-demo-data__modal]"),
                form    = modal.find("form[data-demo-id]"),
                inputEl = $this.closest(".item").find("input[type=checkbox]"),
                totalItem = form.find(".js-tzinst-demoitem:not(.is-finished) input[data-pack-type]:checked").length,
                totalItemCheck = form.find(".js-tzinst-demoitem input[data-pack-type]:checked").length,
                progress_bar = $this.closest(".uk-modal-footer").find(".js-processing-box .js-progress-bar"),
                uk_progress_bar = $this.closest(".uk-modal-footer").find(".js-processing-box progress");

            if($this.hasClass("importing")){
                return;
            }

            if(!totalItem){
                return;
            }
            inputEl.prop("checked", true);

            modal.find(".uk-modal-close").prop("disabled",true);

            $this.addClass("disabled importing")
                .find("> .js-tzinst-importing-icon").removeClass("uk-hidden")
                .closest(".uk-modal-footer")
                .find(".js-processing-box")
                .removeClass("uk-hidden");

            form.find("input[data-pack-type]")
                .prop("disabled", true);

            if(progress_bar.length) {
                if (parseInt(progress_bar[0].style.width) === 100) {
                    progress_bar.removeClass("bg-success").css("width", "0%");
                }
                progress_bar.parent().css("padding-right", 0);
            }else if(uk_progress_bar.length){
                if (parseInt(uk_progress_bar.val()) === 100) {
                    uk_progress_bar.removeClass("bg-success").val(0);
                }
            }

            modal.find("[data-tzinst-stop-importing]").removeClass("uk-hidden");

            tzinst_import_ajax({}, $this, form, totalItem, totalItemCheck, totalItem);
        });

        $("[data-tzinst-stop-importing]").on("click", function(e){
            e.preventDefault();
            var __stop_btn  = $(this),
                __parent    = __stop_btn.parent(),
                __import_btn = __parent.find(".js-tzinst-import"),
                ajaxRequest = __import_btn.data("ajaxRequest");
            if(typeof ajaxRequest === "undefined"){
                return;
            }
            ajaxRequest.abort();
            __stop_btn.addClass("uk-hidden");
            __import_btn.find(".js-tzinst-importing-icon").addClass("uk-hidden");
            __parent.find(".uk-modal-close").prop("disabled", false);

        });

        function tzinst_import_ajax(data, button, form, totalItem, totalItemCheck, count) {
            // var each    = 100/totalItem;
            var each    = 100/totalItemCheck;

            if(form.find(".js-tzinst-demoitem:not(.is-finished) input[data-pack-type]:checked").length) {
                var input = form.find(".js-tzinst-demoitem:not(.is-finished) input[data-pack-type]:checked").first(),
                    item = input.closest(".js-tzinst-demoitem:not(.is-finished)");

                if (input.length) {
                    var postdata    = data,
                        modal   = button.closest(".uk-modal"),
                        message_box = button.closest(".uk-modal").find("[data-import-message-box]"),
                        progress_bar = button.closest(".uk-modal-footer").find(".js-processing-box .progress-bar"),
                        uk_progress_bar = button.closest(".uk-modal-footer").find(".js-processing-box progress");

                    if(!Object.keys(postdata).length){
                        postdata    = {
                            action: "tzinst_import_demo_data",
                            page: templazaInstallationSettings.page,
                            security: templazaInstallationSettings.demoImportNonce,
                            action_import: "download",
                            pack: form.data("demo-id"),
                            pack_type: input.data("pack-type")
                        };

                        if(input.data("parent-slug") !== undefined){
                            postdata['pack'] = input.data("parent-slug");
                            postdata['pack_main'] = form.data("demo-id");
                        }
                        if(input.data("demo-title") !== undefined){
                            postdata['demo_title'] = input.data("demo-title");
                        }
                        if(input.data("demo-type") !== undefined){
                            postdata['demo_type'] = input.data("demo-type");
                        }
                        if(input.data("file-name") !== undefined){
                            postdata['file_name'] = input.data("file-name");
                        }
                        if(input.data("demo-key") !== undefined){
                            postdata['demo_key'] = input.data("demo-key");
                        }
                    }

                    postdata["demo_item_last"]  = count;

                    if(!item.hasClass("importing") && !item.hasClass("is-finished")) {
                        modal.find(".uk-modal-body").scrollTop(modal.find(".uk-modal-body").scrollTop() + item.position().top);
                    }
                    item.addClass("importing");

                    button.data("ajaxRequest", $.post(ajaxurl, postdata, function (response) {

                            if (response.success) {
                                var currentWidth = 0,
                                    percentage = currentWidth + each;

                                if(progress_bar.length){
                                    currentWidth = parseFloat(progress_bar[0].style.width);
                                }else if(uk_progress_bar.length){
                                    currentWidth = parseFloat(uk_progress_bar.val());
                                }
                                // percentage = Math.round(currentWidth + each);
                                if (response.nextstep !== undefined) {

                                    var totalStep = 1;

                                    if(response.action_import === undefined){
                                        each    = each / 2;
                                    }

                                    /* Total step is total package files from server */
                                    if (response.nextstep.total_step !== undefined) {
                                        if(count === totalItem) {
                                            totalStep = response.nextstep.total_step;
                                        }else {
                                            totalStep = response.nextstep.total_step + 1;
                                        }
                                    }
                                    var eachStep = each/ totalStep;

                                    /* Set current step */
                                    item.data("tzinst_import_ajax_current_step", eachStep);

                                    percentage = currentWidth + eachStep;

                                    if(progress_bar.length) {
                                        progress_bar.css('width', percentage + '%');
                                    }else if(uk_progress_bar.length){
                                        uk_progress_bar.val(percentage);
                                    }

                                    /* Call ajax with the next step */
                                    tzinst_import_ajax(response.nextstep, button, form, totalItem, totalItemCheck, count);
                                } else {
                                    count -= 1;
                                    if(count > 0 && count <= totalItem) {

                                        /* Set width of progress bar with the current item */
                                        // percentage = Math.round(each * (totalItem - count));
                                        percentage = each * (totalItem - count);
                                        if(progress_bar.length) {
                                            progress_bar.css('width', percentage + '%');
                                        }else if(uk_progress_bar.length){
                                            uk_progress_bar.val(percentage);
                                        }
                                        item.removeClass("importing").addClass("is-finished");

                                        /* Call ajax with next item */
                                        tzinst_import_ajax({}, button, form, totalItem, totalItemCheck, count);
                                    }else{
                                        item.removeClass("importing").addClass("is-finished");

                                        /* Set width of progress bar is 100% with the last item */
                                        if(progress_bar.length) {
                                            progress_bar.css('width', '100%').addClass("bg-success");
                                        }else if(uk_progress_bar.length){
                                            uk_progress_bar.val(100).addClass("uk-progress-success");
                                        }

                                        /* Reset current step */
                                        item.data("tzinst_import_ajax_current_step", undefined);

                                        form.find(".js-tzinst-demoitem input[data-pack-type]:checked")
                                            .prop("disabled");

                                        modal.find(".uk-modal-close").prop("disabled", false);

                                        form.find(".js-tzinst-demoitem input[data-pack-type]:not(:checked)")
                                            .removeProp("disabled");

                                        button.removeClass("importing disabled")
                                            .find("> .js-tzinst-importing-icon").addClass("uk-hidden");

                                        modal.find("[data-tzinst-stop-importing]").addClass("uk-hidden");

                                        message_box.html("<div class=\"alert alert-success rounded-0 uk-alert-success\" data-uk-alert>"+
                                            response.message
                                            +"</div>");
                                        modal.find(".uk-modal-body").scrollTop(message_box.position().top);

                                        button.addClass("uk-button-success");
                                    }
                                }
                            } else {
                                message_box.html("<div class=\"alert alert-danger rounded-0 uk-alert-danger\" data-uk-alert>"+
                                    response.message
                                    +"</div>");
                                modal.find(".uk-modal-body").scrollTop(message_box.position().top);
                                modal.find(".uk-modal-close").prop("disabled", false);

                                /* Minus the value of progress bar */
                                if(item.data("tzinst_import_ajax_current_step") !== undefined){
                                    // var _percentage = parseFloat(progress_bar[0].style.width) - item.data("tzinst_import_ajax_current_step");
                                    var _percentage = item.data("tzinst_import_ajax_current_step");

                                    if(progress_bar.length) {
                                        _percentage = parseFloat(progress_bar[0].style.width) - _percentage;
                                        progress_bar.css("width", _percentage + "%");
                                    }else if(uk_progress_bar.length){
                                        _percentage = parseFloat(uk_progress_bar.val()) - _percentage;
                                        uk_progress_bar.val(_percentage);
                                    }
                                }

                                item.removeClass("importing");
                                form.find(".js-tzinst-demoitem input[data-pack-type]:not(:checked), .js-tzinst-demoitem input[data-pack-type]:not(.is-finished)")
                                    .removeProp("disabled");
                                button.removeClass("importing disabled");
                            }
                        }, 'json').fail(function(jqXHR, textStatus, errorThrown){

                            message_box.html("<div class=\"alert alert-danger rounded-0 uk-alert-danger\" data-uk-alert>"+
                                errorThrown + ": " +jqXHR.responseText
                                +"</div>");
                            modal.find(".uk-modal-body").scrollTop(message_box.position().top);

                            modal.find(".uk-modal-close").prop("disabled", false);
                            item.removeClass("importing");

                            /* Minus the value of progress bar */
                            if(item.data("tzinst_import_ajax_current_step") !== undefined){
                                // var _percentage = parseFloat(progress_bar[0].style.width) - item.data("tzinst_import_ajax_current_step");
                                var _percentage = item.data("tzinst_import_ajax_current_step");

                                if(progress_bar.length) {
                                    _percentage = parseFloat(progress_bar[0].style.width) - _percentage;
                                    progress_bar.css("width", _percentage + "%");
                                }else if(uk_progress_bar.length){
                                    _percentage = parseFloat(uk_progress_bar.val()) - _percentage;
                                    uk_progress_bar.val(_percentage);
                                }
                            }

                            form.find(".js-tzinst-demoitem input[data-pack-type]:not(:checked), .js-tzinst-demoitem input[data-pack-type]:not(.is-finished)")
                                .removeProp("disabled");
                            button.removeClass("importing disabled");
                        })
                    );

                    // button.data("ajaxRequest", ajaxRequest);
                    // button.data("ajaxRequest", "ajaxRequest");
                }
            }
        }
    });
})(jQuery);