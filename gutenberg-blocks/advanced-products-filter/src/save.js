/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {WPElement} Element to render.
 */
export default function save({ attributes }) {
	return null;
	// return (
	// 	<div { ...useBlockProps().save() }>
	// 		[advanced-product-form include="{typeof attributes.ap_custom_fields === "object"?attributes.ap_custom_fields.join(','):attributes.ap_custom_fields}" enable_keyword="1"]
	// 	</div>
	// )
	// return <div { ...useBlockProps.save() }>{ attributes.message }</div>;
	// return (

		// <p { ...useBlockProps.save() }>
		// 	[advanced-product-form include="" enable_keyword="1"]
		// </p>
	// );
}
