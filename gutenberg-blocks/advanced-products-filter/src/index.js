/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing `style` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './style.scss';

/**
 * Internal dependencies
 */
import Edit from './edit';
import save from './save';

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
registerBlockType( 'templaza-framework/advanced-products-filter', {
	"title": "TemPlaza - Advanced Products Filter",
	/**
	 * @see ./edit.js
	 */
	edit: Edit,

	/**
	 * @see ./save.js
	 */
	save,
} );

//
// /**
//  * Internal dependencies
//  */
// import Edit_Template from './edit-template';
// // import {InnerBlocks, useBlockProps} from "@wordpress/block-editor";
// // import Save_Template from './save-template';
//
// /**
//  * Every block starts by registering a new block type definition.
//  *
//  * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
//  */
// registerBlockType( 'gutenberg-test/add-icon', {
// 	title: 'Icon',
// 	parent: [ 'gutenberg-test/gutenberg-test' ],
// 	/**
// 	 * @see ./edit-template.js
// 	 */
// 	edit: Edit_Template,
//
// 	// /**
// 	//  * @see ./save-template.js
// 	//  */
// 	// Save_Template,
// } );

