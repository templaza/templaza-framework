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
 * @see https://developer.wordpress.org/block-editor/packages/packages-block-editor/#useBlockProps
 */
// import { useBlockProps } from '@wordpress/block-editor';
import { useBlockProps, Inserter, RichText,
	ColorPalette,
	InspectorControls, InnerBlocks } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

import { useState } from '@wordpress/element';
// import { /*Spinner,*/ IconButton/*, TextControl, Panel, PanelBody, PanelRow*/  } from '@wordpress/components';
import { SelectControl,Panel,PanelBody,FormToggle,TextControl,BoxControl,ComboboxControl} from '@wordpress/components';
// import { more } from '@wordpress/icons';

// import { useSelect } from '@wordpress/data';
// import MyButtonBlockAppender from './button-appender';


/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit( { attributes, setAttributes, isSelected, clientId }) {

	const onChangeBGColor = ( hexColor ) => {
		setAttributes( { bg_color: hexColor } );
	};

	const [ isChecked, setChecked ] = useState( true );
	const [ className, setClassName ] = useState( __('Inventory Search') );

	const title_display = [
		{"label":__("Inline"),
			"value": "uk-display-inline"
		},
		{"label":__("Block"),
			"value": "uk-display-block"
		},
		{"label":__("Inline Block"),
			"value": "uk-display-inline-block"
		}
	];
	// const title_tag =[
	// 	{"label": "h1", "value": "h1"},
	// 	{"label": "h2", "value": "h2"},
	// 	{"label": "h3", "value": "h3"},
	// 	{"label": "h4", "value": "h4"},
	// 	{"label": "h5", "value": "h5"},
	// 	{"label": "h6", "value": "h6"},
	// 	{"label": "div", "value": "div"},
	// 	{"label": "span", "value": "span"},
	// 	{"label": "p", "value": "p"}
	// ];
	// const myControl	= function () {
	//
	// };

	return (
		<div /*{ ...useBlockProps({ style: STYLES	}) }*/>
			{/*Block settings*/}
			<InspectorControls key="setting">
				<Panel header="My Panel">
					<PanelBody title="My Block Settings">
					<div id="templaza-framework-adv-products-filter-controls">
						{/*<TextControl*/}
						{/*	label={__('Title')}*/}
						{/*	value={attributes.title}*/}
						{/*	onChange={(value) => {*/}
						{/*		setAttributes({title: value})*/}
						{/*	}}/>*/}
						{/*<TextControl*/}
						{/*	label={__('Title')}*/}
						{/*	value={className}*/}
						{/*	onChange={ ( value ) => {setClassName( value ); setAttributes({form_title: value})}}/>*/}

						{/*{typeof attributes.title !== "undefined" &&*/}
						{/*<SelectControl*/}
						{/*	// Selected value.*/}
						{/*	value={ attributes.title_tag }*/}
						{/*	label={ __( 'Title Tag' ) }*/}
						{/*	onChange={( val ) => { setAttributes( { title_tag: val }) }}*/}
						{/*	options={title_tag} />*/}
						{/*}*/}
						{/*{typeof attributes.title !== "undefined" &&*/}
						{/*<SelectControl*/}
						{/*	// Selected value.*/}
						{/*	value={ attributes.title_display }*/}
						{/*	label={ __( 'Title Display' ) }*/}
						{/*	onChange={( val ) => { setAttributes( { title_display: val }) }}*/}
						{/*	options={ title_display } />*/}
						{/*}*/}
						{/*/!*{ top: '50px', left: '10%', right: '10%', bottom: '50px', }*!/*/}
						{/*{typeof attributes.title !== "undefined" &&*/}
						{/*<BoxControl values={ {*/}
						{/*	top: '50px',*/}
						{/*	left: '10%',*/}
						{/*	right: '10%',*/}
						{/*	bottom: '50px',*/}
						{/*} }*/}
						{/*			onChange={ ( nextValues ) => console.log(nextValues) }/>*/}
						{/*}*/}
						{/*{typeof attributes.title !== "undefined" &&*/}
						{/*<BoxControl values={ attributes.title_margin }*/}
						{/*			onChange={ ( nextValues ) => console.log(nextValues) }/>*/}
						{/*}*/}
						<SelectControl
							// Selected value.
							multiple
							value={ attributes.ap_custom_fields }
							label={ __( 'Select Custom Fields' ) }
							onChange={( val ) => { setAttributes( { ap_custom_fields: val }) }}
							options={ typeof tz_gt_advanced_products_filter !== "undefined"?tz_gt_advanced_products_filter.custom_fields_options:'' } />
						<FormToggle
							checked={ isChecked }
							onChange={ (val) => {setChecked(( state ) => ! state); setAttributes({enable_keyword: isChecked})}}
						/>{__(' Filter By Keyword')}
						<TextControl
							label={__('Submit Text')}
							value={ attributes.submit_text }
							onChange={ ( value ) => {setAttributes({submit_text: value})} }/>
					</div>
					</PanelBody>
                </Panel>
			</InspectorControls>

			<div { ...useBlockProps() }>
				{/*{"<"+attributes.title_tag+">" +attributes.title+"</"+attributes.title_tag+">"}*/}
				[advanced-product-form include="{typeof attributes.ap_custom_fields === "object"?attributes.ap_custom_fields.join(','):attributes.ap_custom_fields
			}" enable_keyword="{isChecked?1:0}" submit_text="{attributes.submit_text}"]
			</div>
		</div>
	)
}
