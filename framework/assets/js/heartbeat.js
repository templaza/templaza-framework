(function($, document, window){
    $(document).ready(function(){
        if(typeof tzinst_heartbeat_ajax !== "undefined" && typeof tzinst_heartbeat_ajax.admin_ajax_url !== "undefined") {
            $("#templaza-framework .tzinst-demo-import").addClass("no-license");
            var tzinst_heartbeat   ={
                beatTimer: 0,
                beatIntTimer: 0,
                interval: 60,
                connecting: false,
                init: function() {
                    // var $mmain = $("#templaza-framework");
                    // if($mmain.length){
                    //     $mmain.find(".tzinst-demo-import").addClass("no-license");
                    // }
                    if(tzinst_heartbeat.connecting){
                        return;
                    }
                    tzinst_heartbeat.connecting = true;
                    $.ajax({
                        "url": tzinst_heartbeat_ajax.admin_ajax_url,
                        "method": "POST",
                        "dataType": "json",
                        "data": {
                            "action": tzinst_heartbeat_ajax.heartbeat_action,
                            "_nonce": tzinst_heartbeat_ajax.heartbeat_nonce,
                        }
                    }).done(function (response, textStatus, jqXHR) {
                        if (typeof response !== "undefined" && typeof response.auth_check !== "undefined") {
                            var $main = $("#templaza-framework"),
                                $notice = $("#setting-error-tzinst_heartbeat_domain_notice");
                            if (!response.auth_check) {
                                if ($main.length) {
                                    var $mHeader = $main.find(".templaza-framework__header"),
                                        $mImport = $main.find(".tzinst-demo-import");
                                    if ($mImport.length) {
                                        $mImport.find(".action").remove().end().addClass("no-license");
                                    }
                                    if ($mHeader.length) {
                                        if (response.message) {
                                            var $msg = '<div class="uk-alert-danger uk-margin-bottom uk-box-shadow-small heartbeat-error" data-uk-alert>' +
                                                response.message +
                                                '<a class="uk-alert-close" data-uk-close></a></div>';
                                            var $heartbeat = $main.find(".heartbeat-error");
                                            if ($heartbeat.length) {
                                                $heartbeat.remove();
                                            }
                                            $mHeader.after($msg);
                                        }
                                    }
                                } else {
                                    if ($notice.length) {
                                        if (response.message) {
                                            var $msg = '<div class="notice-error settings-error notice is-dismissible"><p>' +
                                                response.message + '</p>' +
                                                '<p>' + tzinst_heartbeat_ajax.l10nStrings.reactivate
                                                + '</p></div>';
                                            $notice.html($msg).removeClass("hide-if-no-js");
                                        }
                                    }
                                }
                            } else {
                                if ($main.length) {
                                    var $heartbeat = $main.find(".heartbeat-error"),
                                        $mimport = $main.find(".tzinst-demo-import");
                                    if ($heartbeat.length) {
                                        $heartbeat.remove();
                                    }
                                    if($mimport.length){
                                        $mimport.removeClass("no-license");
                                    }
                                } else if ($notice.length) {
                                    $notice.html('').addClass("hide-if-no-js");
                                }
                            }
                        }
                        tzinst_heartbeat.connecting = false;
                        window.clearInterval( tzinst_heartbeat.beatIntTimer );
                        tzinst_heartbeat.beatIntTimer  = window.setInterval(tzinst_heartbeat.init, tzinst_heartbeat.interval * 1000);
                    });
                }
            };
            window.clearTimeout( tzinst_heartbeat.beatTimer );
            tzinst_heartbeat.beatTimer = window.setTimeout(
                function() {
                    tzinst_heartbeat.init();
                },
                tzinst_heartbeat.interval
            );
        }
    });
})(jQuery, document, window);