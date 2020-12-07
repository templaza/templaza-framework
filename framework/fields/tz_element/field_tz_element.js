
(function( $ ) {
    'use strict';

    redux.field_objects = redux.field_objects || {};
    // redux.field_objects.tz_social = redux.field_objects.tz_social || {};

    var tz_columnOldGetContainerValue = $.redux.get_container_value;
    $.redux.get_container_value = function(id){
        var current = $( '#' + redux.args.opt_name + '-' + id ),
            parent  = current.closest("[data-type=tz_column]");
        if(!parent.length){
            return tz_columnOldGetContainerValue(id);
        }

        var value = current.serializeForm();
        if ( value !== null && typeof value === 'object' && value.hasOwnProperty( redux.args.opt_name ) ) {
            if(typeof value[redux.args.opt_name] === "object"){
                var parent_data_id = parent.data("id");
                value   = value[redux.args.opt_name][parent_data_id];
                if(typeof value === "object"){
                    var id_org  = current.data("id").replace(parent_data_id + "-", "");
                    value   = value[id_org];
                }
            }else {
                value = value[redux.args.opt_name][id];
            }
        }
        if ( $( '#' + redux.args.opt_name + '-' + id ).hasClass( 'redux-container-media' ) ) {
            value = value.url;
        }

        return value;
    };
})( jQuery );