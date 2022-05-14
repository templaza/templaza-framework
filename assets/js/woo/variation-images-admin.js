(function ($) {
	'use strict';

	var product_gallery_frame;
	function variartion_images_init() {
		$( '#variable_product_options' ).on( 'click', '.templaza-variation-images-upload', function( event ) {
			var $el = $( this ),
				$image_gallery_ids = $el.closest('.templaza-variation-images-container').find( '.templaza_variation_images' ),
				$product_images    = $el.closest('.templaza-variation-images-container').find( 'ul.variation-images-list' );

			event.preventDefault();

			// Create the media frame.
			if ( ! product_gallery_frame ) {
				product_gallery_frame = wp.media({
					// Set the title of the modal.
					title: $el.data( 'choose' ),
					button: {
						text: $el.data( 'update' )
					},
					states: [
						new wp.media.controller.Library({
							title: $el.data( 'choose' ),
							filterable: 'all',
							multiple: true
						})
					]
				});
			}

			product_gallery_frame.off( 'select' );

			// When an image is selected, run a callback.
			product_gallery_frame.on( 'select', function() {
				var selection = product_gallery_frame.state().get( 'selection' );
				var attachment_ids = $image_gallery_ids.val();

				selection.map( function( attachment ) {
					attachment = attachment.toJSON();

					if ( attachment.id ) {
						attachment_ids   = attachment_ids ? attachment_ids + ',' + attachment.id : attachment.id;
						var attachment_image = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;

						$product_images.append(
							'<li class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachment_image +
							'" /><a href="#" class="delete" title="' + $el.data('delete') + '"></a></li>'
						);
					}
				});

				$image_gallery_ids.val( attachment_ids );
				$el.closest( '.woocommerce_variation' ).addClass( 'variation-needs-update' );
				$( 'button.cancel-variation-changes, button.save-variation-changes' ).prop( 'disabled', false );
				$( '#variable_product_options' ).trigger( 'woocommerce_variations_input_changed' );
			});

			// Finally, open the modal.
			product_gallery_frame.open();
		});

		// Image ordering.
		$( '#variable_product_options' ).find('ul.variation-images-list').sortable({
			items: 'li.image',
			cursor: 'move',
			scrollSensitivity: 40,
			forcePlaceholderSize: true,
			forceHelperSize: false,
			helper: 'clone',
			opacity: 0.65,
			placeholder: 'wc-metabox-sortable-placeholder',
			start: function( event, ui ) {
				ui.item.css( 'background-color', '#f6f6f6' );
			},
			stop: function( event, ui ) {
				ui.item.removeAttr( 'style' );
			},
			update: function() {
				var attachment_ids = '';

				$(this).closest('.templaza-variation-images-container').find( 'ul.variation-images-list li.image' ).css( 'cursor', 'default' ).each( function() {
					var attachment_id = $( this ).attr( 'data-attachment_id' );
					attachment_ids = attachment_ids + attachment_id + ',';
				});

				$(this).closest('.templaza-variation-images-container').find( '.templaza_variation_images' ).val( attachment_ids );
				$(this).closest( '.woocommerce_variation' ).addClass( 'variation-needs-update' );
				$( 'button.cancel-variation-changes, button.save-variation-changes' ).prop( 'disabled', false );
				$( '#variable_product_options' ).trigger( 'woocommerce_variations_input_changed' );
			}
		});

		// Remove images.
		$( '#variable_product_options' ).on( 'click', 'a.delete', function() {
			var $el = $( this ),
			$image_gallery_ids = $el.closest('.templaza-variation-images-container').find( '.templaza_variation_images' ),
			$image_list = $el.closest('ul.variation-images-list');

			$el.closest( 'li.image' ).remove();

			var attachment_ids = '';

			$image_list.find( 'li.image' ).each( function() {
				var attachment_id = $(this).attr( 'data-attachment_id' );
				attachment_ids = attachment_ids + attachment_id + ',';
			});

			$image_gallery_ids.val( attachment_ids );
			$image_list.closest( '.woocommerce_variation' ).addClass( 'variation-needs-update' );
			$( 'button.cancel-variation-changes, button.save-variation-changes' ).prop( 'disabled', false );
			$( '#variable_product_options' ).trigger( 'woocommerce_variations_input_changed' );

			return false;
		});
	}

	function variartion_images_position() {
		$('.woocommerce_variation').each(function () {
			var optionsWrapper = $(this).find('.options:first');
			var galleryWrapper = $(this).find('.templaza-variation-images-container');
			galleryWrapper.insertBefore(optionsWrapper);
		  });
	}

	/**
	 * Document ready
	 */
	$(function () {
		variartion_images_init();
		$( '#woocommerce-product-data' ).on( 'woocommerce_variations_loaded woocommerce_variations_added', function() {
			variartion_images_position();
		} );

	});

})(jQuery);