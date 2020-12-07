/*global redux_change, wp, redux*/

(function( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.tz_repeater = redux.field_objects.tz_repeater || {};

    $( document ).ready(
        function() {
            //redux.field_objects.tz_repeater.init();
        }
    );

    redux.field_objects.tz_repeater.init = function( selector ) {

        if ( !selector ) {
            selector = $( document ).find( ".redux-group-tab:visible" ).find( '.redux-container-tz_repeater:visible' );
        }

        $( selector ).each(
            function() {
                var el = $( this );

                redux.field_objects.media.init(el);

                var parent = el;
                if ( !el.hasClass( 'redux-field-container' ) ) {
                    parent = el.parents( '.redux-field-container:first' );
                }
                if ( parent.is( ":hidden" ) ) { // Skip hidden fields
                    return;
                }
                
                if ( parent.hasClass( 'redux-container-tz_repeater' ) ) {
                    parent.addClass( 'redux-field-init' );    
                }
                
                if ( parent.hasClass( 'redux-field-init' ) ) {
                    parent.removeClass( 'redux-field-init' );
                } else {
                    return;
                }

                el.find( '.redux-slides-remove' ).live(
                    'click', function() {
                        redux_change( $( this ) );

                        $( this ).parent().siblings().find( 'input[type="text"]' ).val( '' );
                        $( this ).parent().siblings().find( 'textarea' ).val( '' );
                        $( this ).parent().siblings().find( 'input[type="hidden"]' ).val( '' );

                        var slideCount = $( this ).parents( '.redux-container-tz_repeater:first' ).find( '.redux-slides-accordion-group' ).length;

                        if ( slideCount > 1 ) {
                            $( this ).parents( '.redux-slides-accordion-group:first' ).slideUp(
                                'medium', function() {
                                    $( this ).remove();
                                }
                            );
                        } else {
                            var content_new_title = $( this ).parent( '.redux-slides-accordion' ).data( 'new-content-title' );

                            $( this ).parents( '.redux-slides-accordion-group:first' ).find( '.remove-image' ).click();
                            $( this ).parents( '.redux-container-tz_repeater:first' ).find( '.redux-slides-accordion-group:last' ).find( '.redux-slides-header' ).text( content_new_title );
                        }
                    }
                );

                //el.find( '.redux-slides-add' ).click(
                el.find( '.redux-tz_repeater-add' ).off('click').click(
                    function() {
                        var newSlide = $( this ).prev().find( '.redux-slides-accordion-group:last' ).clone( );

                        // var slideCount = $( newSlide ).find( '.slide-title' ).attr( "name" ).match( /[0-9]+(?!.*[0-9])/ );
                        var slideCount = $( newSlide ).attr( "data-slide-count" );
                        var slideCount1 = slideCount * 1 + 1;

                        newSlide.css("visibility", "visible");
                        newSlide.show();
                        console.log(newSlide.is(":hidden"));
                        $( newSlide ).find( 'input[type="text"], input[type="hidden"], textarea' ).each(
                            function() {

                                // redux.field_objects.
                                var $li = $(this).closest('li[data-slide-item-type]'),
                                    field_type  = $li.data("slide-item-type"),
                                    $el = $(this);

                                if($el.attr("name") !== undefined) {
                                    var $old_id = $el.attr("id");
                                    $el.attr(
                                        "name", $el.attr("name").replace(/[0-9]+(?!.*[0-9])/, slideCount1)
                                    ).attr("id", $el.attr("id").replace(/[0-9]+(?!.*[0-9])/, slideCount1));

                                    switch (field_type) {
                                        case "slider":
                                            $li.find(".redux-container-slider").attr(
                                                "id", function(index, attr){
                                                    return attr.replace(/[0-9]+(?!.*[0-9])/, slideCount1);
                                                }).attr("data-id",function(index, attr){
                                                return attr.replace(/[0-9]+(?!.*[0-9])/, slideCount1);
                                            }).css("visibility", "visible");
                                            $li.find(".redux-slider-container").attr(
                                                "id", function(index, attr){
                                                    return attr.replace(/[0-9]+(?!.*[0-9])/, slideCount1);
                                                }).attr("data-id",function(index, attr){
                                                return attr.replace(/[0-9]+(?!.*[0-9])/, slideCount1);
                                            });
                                            $(this).attr("class", function(index, attr){
                                               return attr.replace("redux-slider-input-one-" + $old_id,
                                                   "redux-slider-input-one-"+$(this).attr("id"));
                                            });

                                            redux.field_objects.slider.init($li.find(".redux-container-slider"));
                                            // redux.field_objects.slider.init();
                                            break;
                                    }

                                    // if(field_type !== undefined && redux.field_objects[field_type] !== undefined
                                    //     && typeof redux.field_objects[field_type].init === "function" ){
                                    //     redux.field_objects[$li.data("slide-item-type")].init();
                                    // }
                                }
                                $( this ).val( '' );
                                if ( $( this ).hasClass( 'slide-sort' ) ) {
                                    $( this ).val( slideCount1 );
                                }
                            }
                        );

                        var content_new_title = $( this ).prev().data( 'new-content-title' );

                        $( newSlide ).find( '.screenshot' ).removeAttr( 'style' );
                        $( newSlide ).find( '.screenshot' ).addClass( 'hide' );
                        $( newSlide ).find( '.screenshot a' ).attr( 'href', '' );
                        $( newSlide ).find( '.remove-image' ).addClass( 'hide' );
                        $( newSlide ).find( '.redux-slides-image' ).attr( 'src', '' ).removeAttr( 'id' );
                        $( newSlide ).find( 'h3' ).text( '' ).append( '<span class="redux-slides-header">' + content_new_title + '</span><span class="ui-accordion-header-icon ui-icon ui-icon-plus"></span>' );
                        $( this ).prev().append( newSlide );
                    }
                );

                el.find( '.slide-title' ).keyup(
                    function( event ) {
                        var newTitle = event.target.value;
                        $( this ).parents().eq( 3 ).find( '.redux-slides-header' ).text( newTitle );
                    }
                );


                el.find( ".redux-slides-accordion" )
                    .accordion(
                    {
                        header: "> div > fieldset > h3",
                        // collapsible: true,
                        active: false,
                        heightStyle: "content",
                        icons: {
                            "header": "ui-icon-plus",
                            "activeHeader": "ui-icon-minus"
                        }
                    }
                )
                    .sortable(
                    {
                        axis: "y",
                        handle: "h3",
                        connectWith: ".redux-slides-accordion",
                        start: function( e, ui ) {
                            ui.placeholder.height( ui.item.height() );
                            ui.placeholder.width( ui.item.width() );
                        },
                        placeholder: "ui-state-highlight",
                        stop: function( event, ui ) {
                            // IE doesn't register the blur when sorting
                            // so trigger focusout handlers to remove .ui-state-focus
                            ui.item.children( "h3" ).triggerHandler( "focusout" );
                            var inputs = $( 'input.slide-sort' );
                            inputs.each(
                                function( idx ) {
                                    $( this ).val( idx );
                                }
                            );
                        }
                    }
                );
            }
        );
    };
})( jQuery );