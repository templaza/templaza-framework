
/**
 * Override Background Redux field
 * Feature added by    : DuongTVTemplaza
 */
(function( $ ) {
	'use strict';

	// var org_redux_field_editor_change = redux.field_objects.editor.onChange;
	//
	// redux.field_objects.editor.onChange = function(i){
	// 	console.log("org_redux_field_editor_change");
	// 	// console.log(typeof ( tinymce ));
	// 	// console.log(i);
	// 	// console.log(tinymce.editors[i]);
	// 	console.log(tinyMCEPreInit.mceInit);
	// 	console.log(tinyMCEPreInit.mceInit["text"]);
	//
	// 	// tinymce.editors[i].on(
	// 	// 	'change',
	// 	// 	function( e ) {
	// 	// 		console.log("e.target.contentAreaContainer");
	// 	// 		console.log(e.target.contentAreaContainer);
	// 	// 		// var el = jQuery( e.target.contentAreaContainer );
	// 	// 		// if ( 0 !== el.parents( '.redux-container-editor:first' ).length ) {
	// 	// 		// 	redux_change( $( '.wp-editor-area' ) );
	// 	// 		// }
	// 	// 	}
	// 	// );
	// 	org_redux_field_editor_change(i);
	// };

	var org_redux_field_editor = redux.field_objects.editor.init;

	redux.field_objects.editor.init = function( ) {
		var selector = $.redux.getSelector( false, 'editor' );

		// function init_editors() {
		//
		// 	$.each(selector.find('.wp-editor-area'), function (i, editor) {
		//
		// 		var editor_id = $(editor).attr('id');
		// 		wp.editor.initialize(
		// 			editor_id,
		// 			{
		// 				tinymce: {
		// 					wpautop: true,
		// 					plugins: 'charmap colorpicker compat3x directionality fullscreen hr image lists media paste tabfocus textcolor wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview',
		// 					toolbar1: 'bold italic underline strikethrough | bullist numlist | blockquote hr wp_more | alignleft aligncenter alignright | link unlink | fullscreen | wp_adv',
		// 					toolbar2: 'formatselect alignjustify forecolor | pastetext removeformat charmap | outdent indent | undo redo | wp_help'
		// 				},
		// 				quicktags: true,
		// 				mediaButtons: true,
		// 			}
		// 		);
		//
		// 		// // Save id for removal later on
		// 		// active_editors.push(editor_id);
		//
		// 	});
		// }
		//
		// console.log($("textarea#text"));

		// tinyMCEPreInit.mceInit["text"]
		// tinymce.init(tinyMCEPreInit.mceInit["text"]);
		// //
		// // if($(selector).closest(".tzfrm-ui-dialog").length){
		// // 	$(selector).find("select").data("dropdown-parent", $(selector).closest(".tzfrm-ui-dialog"));
		// // }
		// console.log("editor");
		// // console.log(selector);
		// // console.log(tinymce.editors);
		// // console.log(tinymce.editors.length);
		//
		// var i=0;
		//
		// tinymce.editors[i].on(
		// 	'change',
		// 	function( e ) {
		// 		console.log(e.target.contentAreaContainer);
		// 		var el = jQuery( e.target.contentAreaContainer );
		// 		if ( 0 !== el.parents( '.redux-container-editor:first' ).length ) {
		// 			redux_change( $( '.wp-editor-area' ) );
		// 		}
		// 	}
		// );


		var restoreTextMode = false;
		// var component = {
		// 	dismissedPointers: [],
		// 	idBases: [ 'text' ]
		// };
		//
		// console.log("selector");
		// console.log(selector);
		// // console.log(selector.find("#"));


		// // $.each(selector.find('.wp-editor-area'), function (i, editor) {
			var _id = selector.find('.wp-editor-area').attr('id'),
				_editor = window.tinymce.get(_id);
			if(_editor){
				_editor.destroy();
			}


			// function buildEditor() {
			// 	var editor, onInit, showPointerElement, _editor_option;
			//
			// 	// Abort building if the textarea is gone, likely due to the widget having been deleted entirely.
			// 	if ( ! document.getElementById( id ) ) {
			// 		return;
			// 	}
			//
			// 	// The user has disabled TinyMCE.
			// 	if ( typeof window.tinymce === 'undefined' ) {
			// 		wp.editor.initialize( id, {
			// 			quicktags: true,
			// 			mediaButtons: true
			// 		});
			//
			// 		return;
			// 	}
			//
			//
			// 	// Destroy any existing editor so that it can be re-initialized after a widget-updated event.
			// 	if ( tinymce.get( id ) ) {
			//
			// 		_editor_option	= tinyMCEPreInit.mceInit[id];
			// 		restoreTextMode = tinymce.get( id ).isHidden();
			// 		wp.editor.remove( id );
			// 	}
			//
			// 	// Add or enable the `wpview` plugin.
			// 	$( document ).one( 'wp-before-tinymce-init.text-widget-init', function( event, init ) {
			// 		// If somebody has removed all plugins, they must have a good reason.
			// 		// Keep it that way.
			// 		if ( ! init.plugins ) {
			// 			return;
			// 		} else if ( ! /\bwpview\b/.test( init.plugins ) ) {
			// 			init.plugins += ',wpview';
			// 		}
			// 	} );
			//
			// 	wp.editor.initialize( id, {
			// 		tinymce: {
			// 			wpautop: true
			// 		},
			// 		quicktags: true,
			// 		mediaButtons: false
			// 	});
			//
			// 	// wp.editor.initialize( id, _editor_option);
			// 	// window.tinymce.init(_editor_option);
			//
			// 	// wp.editor.initialize(
			// 	// 	id,
			// 	// 	{
			// 	// 		tinymce: {
			// 	// 			wpautop: true,
			// 	// 			plugins: 'charmap colorpicker compat3x directionality fullscreen hr image lists media paste tabfocus textcolor wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview',
			// 	// 			toolbar1: 'bold italic underline strikethrough | bullist numlist | blockquote hr wp_more | alignleft aligncenter alignright | link unlink | fullscreen | wp_adv',
			// 	// 			toolbar2: 'formatselect alignjustify forecolor | pastetext removeformat charmap | outdent indent | undo redo | wp_help'
			// 	// 		},
			// 	// 		quicktags: true,
			// 	// 		mediaButtons: true,
			// 	// 	});
			//
			//
			// 	// /**
			// 	//  * Show a pointer, focus on dismiss, and speak the contents for a11y.
			// 	//  *
			// 	//  * @param {jQuery} pointerElement Pointer element.
			// 	//  * @return {void}
			// 	//  */
			// 	// showPointerElement = function( pointerElement ) {
			// 	// 	pointerElement.show();
			// 	// 	pointerElement.find( '.close' ).focus();
			// 	// 	wp.a11y.speak( pointerElement.find( 'h3, p' ).map( function() {
			// 	// 		return $( this ).text();
			// 	// 	} ).get().join( '\n\n' ) );
			// 	// };
			// 	// //
			//
			// 	editor = window.tinymce.get( id );
			//
			// 	// console.log(tinyMCEPreInit);
			// 	console.log(id);
			// 	console.log(editor);
			// 	// console.log(editor.initialized);
			//
			// 	if ( ! editor ) {
			// 		alert('Failed to initialize editor');
			// 		// throw new Error( 'Failed to initialize editor' );
			// 	}
			// 	// onInit = function() {
			// 	//
			// 	// 	// When a widget is moved in the DOM the dynamically-created TinyMCE iframe will be destroyed and has to be re-built.
			// 	// 	$( editor.getWin() ).on( 'unload', function() {
			// 	// 		_.defer( buildEditor );
			// 	// 	});
			// 	//
			// 	// 	// If a prior mce instance was replaced, and it was in text mode, toggle to text mode.
			// 	// 	if ( restoreTextMode ) {
			// 	// 		switchEditors.go( id, 'html' );
			// 	// 	}
			// 	//
			// 	// 	// Show the pointer.
			// 	// 	$( '#' + id + '-html' ).on( 'click', function() {
			// 	// 		// control.pasteHtmlPointer.hide(); // Hide the HTML pasting pointer.
			// 	//
			// 	// 		if ( -1 !== component.dismissedPointers.indexOf( 'text_widget_custom_html' ) ) {
			// 	// 			return;
			// 	// 		}
			// 	// 		showPointerElement( control.customHtmlWidgetPointer );
			// 	// 	});
			// 	//
			// 	// 	// // Hide the pointer when switching tabs.
			// 	// 	// $( '#' + id + '-tmce' ).on( 'click', function() {
			// 	// 	// 	control.customHtmlWidgetPointer.hide();
			// 	// 	// });
			// 	//
			// 	// 	// Show pointer when pasting HTML.
			// 	// 	editor.on( 'pastepreprocess', function( event ) {
			// 	// 		var content = event.content;
			// 	// 		if ( -1 !== component.dismissedPointers.indexOf( 'text_widget_paste_html' ) || ! content || ! /&lt;\w+.*?&gt;/.test( content ) ) {
			// 	// 			return;
			// 	// 		}
			// 	//
			// 	// 		// // Show the pointer after a slight delay so the user sees what they pasted.
			// 	// 		// _.delay( function() {
			// 	// 		// 	showPointerElement( control.pasteHtmlPointer );
			// 	// 		// }, 250 );
			// 	// 	});
			// 	// };
			// 	//
			// 	// if ( editor.initialized ) {
			// 	// 	onInit();
			// 	// } else {
			// 	// 	editor.on( 'init', onInit );
			// 	// }
			//
			//
			//
			// 	// control.editorFocused = false;
			//
			// 	// editor.on( 'focus', function onEditorFocus() {
			// 	// 	control.editorFocused = true;
			// 	// });
			// 	// editor.on( 'paste', function onEditorPaste() {
			// 	// 	editor.setDirty( true ); // Because pasting doesn't currently set the dirty state.
			// 	// 	triggerChangeIfDirty();
			// 	// });
			// 	// // editor.on( 'NodeChange', function onNodeChange() {
			// 	// // 	needsTextareaChangeTrigger = true;
			// 	// // });
			// 	// editor.on( 'NodeChange', _.debounce( triggerChangeIfDirty, changeDebounceDelay ) );
			// 	// editor.on( 'blur hide', function onEditorBlur() {
			// 	// 	control.editorFocused = false;
			// 	// 	triggerChangeIfDirty();
			// 	// });
			//
			// 	// control.editor = editor;
			// }
			//
			// buildEditor();



			// console.log(id);
			// console.log(tinymce.get( id ));
			// console.log(wp.editor);
			// // console.log(tinymce.editors[0]);
			// // console.log(tinymce.editors[0][id]);
			//
			// // Destroy any existing editor so that it can be re-initialized after a widget-updated event.
			// if ( tinymce.get( id ) ) {
			// 	// restoreTextMode = tinymce.get( id ).isHidden();
			// 	wp.editor.remove( id );
			// }
			//
			// // Add or enable the `wpview` plugin.
			// $( document ).one( 'wp-before-tinymce-init.text-widget-init', function( event, init ) {
			// 	// If somebody has removed all plugins, they must have a good reason.
			// 	// Keep it that way.
			// 	if ( ! init.plugins ) {
			// 		return;
			// 	} else if ( ! /\bwpview\b/.test( init.plugins ) ) {
			// 		init.plugins += ',wpview';
			// 	}
			// } );
			//
			// console.log(id);
			// wp.editor.initialize( id, {
			// 	tinymce: {
			// 		wpautop: true
			// 	},
			// 	quicktags: true,
			// 	mediaButtons: true
			// });
			//
			// var _editor = window.tinymce.get( id );
			// // if ( ! _editor ) {
			// // 	throw new Error( 'Failed to initialize editor' );
			// // }
			// console.log(_editor);
		// });
		org_redux_field_editor(selector);

		// console.log("selector");
		// console.log(selector);
		// console.log(selector.find("#"));
	};
})( jQuery );
