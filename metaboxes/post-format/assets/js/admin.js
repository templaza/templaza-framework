jQuery( function ( $ ) {
	'use strict';
	$(document).ready(function(){
		$('#post-format-selector-0').on('change', function(e) {

			var format = $(this).val();

			switch (format) {
				case 'standard':
					$('.vp-pfui-format-wrap').hide();
					break;
				case 'aside':
					$('.vp-pfui-format-wrap').hide();
					$('#vp-pfui-format-aside').show();
					break;
				case 'chat':
					$('.vp-pfui-format-wrap').hide();
					$('#vp-pfui-format-chat').show();
					break;
				case 'status':
					$('.vp-pfui-format-wrap').hide();
					$('#vp-pfui-format-status').show();
					break;
				case 'link':
					$('.vp-pfui-format-wrap').hide();
					$('#vp-pfui-format-link-url').show();
					break;
				case 'gallery':
					$('.vp-pfui-format-wrap').hide();
					$('#vp-pfui-format-gallery-preview').show();
					break;
				case 'video':
					$('.vp-pfui-format-wrap').hide();
					$('#vp-pfui-format-video-fields').show();
					break;
				case 'quote':
					$('.vp-pfui-format-wrap').hide();
					$('#vp-pfui-format-quote-fields').show();
					break;
				case 'audio':
					$('.vp-pfui-format-wrap').hide();
					$('#vp-pfui-format-audio-fields').show();
					break;
			}
		});
	})

} );