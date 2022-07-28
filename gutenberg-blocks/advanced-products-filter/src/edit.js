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

import { useState ,Fragment} from '@wordpress/element';
// import { /*Spinner,*/ IconButton/*, TextControl, Panel, PanelBody, PanelRow*/  } from '@wordpress/components';
import { SelectControl,Panel,PanelBody,PanelRow,
	ToggleControl,TextControl,BaseControl,BoxControl,ComboboxControl} from '@wordpress/components';
// import { more } from '@wordpress/icons';
// import React from 'react';
import ReactSelect from 'react-select';
import SortableSelectInput from 'react-sortable-select';

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

	let _custom_fields=[];

	if(typeof attributes.ap_custom_fields !== "undefined" && attributes.ap_custom_fields.length
		&& typeof tz_gt_advanced_products_filter.custom_fields_options !== "undefined"
		&& tz_gt_advanced_products_filter.custom_fields_options.length){
		_custom_fields	= tz_gt_advanced_products_filter.custom_fields_options.filter((item) => {
			return (attributes.ap_custom_fields.indexOf(item.value) !== -1);
		});
	}
	const [fieldValues, setFieldValues] = useState(_custom_fields);

	const handleChipChange = (fval,value,index) => {
		setFieldValues(value.map((val, index) => ({ ...val, order: index + 1 })));
		setAttributes({ap_custom_fields: value.map((val, index) => val.value)});
	};

	function handleOnDragEnd(result) {
		const reorder = (list, startIndex, endIndex) => {
			const result = Array.from(list);
			const [removed] = result.splice(startIndex, 1);
			result.splice(endIndex, 0, removed);

			return result;
		};

		// dropped outside the list
		if (!result.destination) {
			return;
		}

		const items = reorder(
			fieldValues,
			result.source.index,
			result.destination.index
		);

		setFieldValues(
			items.map((item, index) => ({
				...item,
				order: index + 1
			}))
		);

		setAttributes({ap_custom_fields: items.map((item, index) => item.value)});
	}

	return (
		<Fragment>
				{/*Block settings*/}
				<InspectorControls key="setting">
					<PanelBody>
						<div id="templaza-framework-adv-products-filter-controls">
							<BaseControl id="ap-custom-field">
								<SortableSelectInput
									className='react-sortable-select'
									// name='fieldValues'
									value={fieldValues}
									onChange={(value, index) =>
										handleChipChange('fieldValues', value, index)
									}
									placeholder='Select Custom Fields'
									textFieldProps={{
										label: __('Select Custom Fields'),
										variant: 'outlined',
										InputLabelProps: {
											shrink: true
										}
									}}
									options={
										typeof tz_gt_advanced_products_filter !== "undefined"?tz_gt_advanced_products_filter.custom_fields_options:''
									}
									/*options={defaultItems.map((item) => ({
										value: item.id,
										label: item.label,
										class: item.class
									}))}*/
									isMulti
									isSortable
									onDragEnd={handleOnDragEnd}
									fullWidth
									variant='fixed'
								/>
							</BaseControl>

							<ToggleControl
								label={__('Filter By Keyword')}
								help={ isChecked ? 'Enabled filter by keyword.' : 'Disabled filter by keyword.' }
								checked={ isChecked }
								onChange={ (val) => {setChecked(( state ) => ! state); setAttributes({enable_keyword: isChecked})}}
							/>
							<TextControl
								label={__('Submit Text')}
								value={ attributes.submit_text }
								onChange={ ( value ) => {setAttributes({submit_text: value})} }/>
						</div>
					</PanelBody>
				</InspectorControls>

				<div { ...useBlockProps() }>
					[advanced-product-form include="{
						typeof attributes.ap_custom_fields === "object"?attributes.ap_custom_fields.join(','):attributes.ap_custom_fields
				}" enable_keyword="{isChecked?1:0}" submit_text="{attributes.submit_text}"]
				</div>
		</Fragment>
	)
}
