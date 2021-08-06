/*global redux_change, redux, templaza_tz_typography_ajax, WebFont */

/**
 * Override Typography redux field
 * Dependencies:        google.com, jquery, select2
 * Feature added by:    Dovy Paukstys - http://simplerain.com/
 * Date:                06.14.2013
 *
 * Rewrite:             Kevin Provance (kprovance)
 * Date:                May 25, 2014
 * And again on:        April 4, 2017 for v4.0
 */
(function( $ ) {
	'use strict';

	var org_redux_field_import_export__options = redux.field_objects.import_export.get_options;
	redux.field_objects.import_export.get_options = function( $secret ) {
		// if(window.tz_custom_redux_import_export !== undefined){
		var $el = $( '#redux-export-code-copy' );
		if($el.attr("data-post-id") !== undefined){
			var url = ajaxurl + '?download=0&action=redux_download_options-' + redux.optName.args.opt_name + '&secret=' + $secret;
				url	+= '&post_id=' + $el.attr("data-post-id");
			$el.addClass( 'disabled' ).attr( 'disabled', 'disabled' );
			$el.text( $el.data( 'copy' ) );
			$.get( url, function( data ) {
				redux.field_objects.import_export.copy_text( data );
				$el.removeClass( 'disabled' );
				$el.text( $el.data( 'copied' ) );
				setTimeout( function() {
					$el.text( $el.data( 'copy' ) ).removeClass( 'disabled' ).removeAttr( 'disabled' );
				}, 2000 );
			} );
		}else {
			org_redux_field_import_export__options($secret);
		}
	};
	// var org_redux_field_import_export__init = redux.field_objects.import_export.init;
	// redux.field_objects.import_export.init = function( selector ) {
	// 	org_redux_field_import_export__init(selector);
	// 	selector = $.redux.getSelector(selector, 'import_export');
	//
	// 	$(selector).each(
	// 		function () {
	//
	// 			var el = $( this );
	// 			el.each(
	// 				function() {
	// 					$( '#redux-import' ).off("click").click(
	// 						function( e ) {
	// 							e.preventDefault();
	// 							// if ( '' === $( '#import-code-value' ).val() && '' === $(
	// 							// 	'#import-link-value' ).val() ) {
	// 							// 	return false;
	// 							// }
	// 							var $secret = $( this ).data( 'secret' );
	// 							var $el = $( '#redux-import' );
	// 							var url = ajaxurl + '?action=tzfrm_import_options-' + redux.optName.args.opt_name
	// 								+ "&secret="+$secret;
	//
	// 							if($el.attr("data-post-id") !== undefined){
	// 								url	+= '&post_id=' + $el.attr("data-post-id");
	// 							}
	// 							if($("#import-code-value") !== undefined){
	// 								url	+= '&data=' + $("#import-code-value").val();
	// 							}
	// 							// $.ajax({
	// 							//
	// 							// })
	// 							var __ajax_data	= {
	// 								"action": "tzfrm_import_options-" + redux.optName.args.opt_name,
	// 								"secret": $secret,
	// 								"data": $("#import-code-value").val()
	// 							};
	//
	// 							__ajax_data["post_id"]	= $el.attr("data-post-id");
	//
	// 							// console.log(ajaxurl);
	// 							// console.log(__ajax_data);
	// 							$.ajax({
	// 								url: ajaxurl,
	// 								method: "POST",
	// 								data: __ajax_data,
	// 								success: function(response){
	// 									// window.location.href =  window.location.href;
	// 									// // window.location.href="";
	// 									window.location.reload();
	// 								}
	// 							});
	//
	// 							// $.get( ajaxurl,__ajax_data, function( data ) {
	// 							//
	// 							// });
	// 							// $.get( url, function( data ) {
	// 							//
	// 							// });
	// 						}
	// 					);
	// 				}
	// 			);
	// 		});
	// }
})( jQuery );
