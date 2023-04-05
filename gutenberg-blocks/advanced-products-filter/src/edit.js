/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
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
import { SelectControl,Panel,PanelBody,PanelRow,Spinner,
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
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit( { attributes, setAttributes, isSelected, clientId }) {

	const onChangeBGColor = ( hexColor ) => {
		setAttributes( { bg_color: hexColor } );
	};

	const [ isChecked, setChecked ] = useState( true );
	const [ className, setClassName ] = useState( __('Inventory Search', 'templaza-framework') );

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

	const formData = new FormData();
	if(typeof tz_gt_advanced_products_filter.filter_form_action !== "undefined") {
		formData.append('action', tz_gt_advanced_products_filter.filter_form_action);
		formData.append('_nonce', tz_gt_advanced_products_filter.filter_form_nonce);
	}else{
		formData.append('action', "advanced_product_filter_form_gutenberg");
	}

	const shortcode	= '[advanced-product-form include="'+
		(typeof attributes.ap_custom_fields === "object"?attributes.ap_custom_fields.join(','):attributes.ap_custom_fields)
		+'" enable_keyword="'+(attributes.enable_keyword?1:0)+'" submit_text="'+attributes.submit_text
		+'" limit_height="'+(attributes.limit_height?1:0)
		+'" instant="'+(attributes.instant?1:0)+'" update_url="'+(attributes.update_url?1:0)
		+'" column="'+(attributes.column?attributes.column:1)
		+'" column_large="'+(attributes.column_large?attributes.column_large:1)
		+'" column_laptop="'+(attributes.column_laptop?attributes.column_laptop:1)
		+'" column_tablet="'+(attributes.column_tablet?attributes.column_tablet:1)
		+'" column_mobile="'+(attributes.column_mobile?attributes.column_mobile:1)+'"'
		+(typeof attributes.max_height !== "undefined" && attributes.max_height.length?' max_height="'
			+ attributes.max_height +'"':'')
		+']';

	formData.append("shortcode", shortcode.toString());

	fetch(ajaxurl, {
		method: "POST",
		mode: "no-cors",
		cache: "no-cache",
		credentials: "same-origin",
		headers: {
			'Content-Type': 'application/json'
			// "Content-Type": "form-data"
		},
		body: formData
	})
		.then((response) => { return response.json(); })
		.then(response => {
			var __form_html	= "";
			if(typeof response.success !== "undefined"){
				if(response.success){
					if(typeof response.data){
						__form_html	= response.data;
					}
				}else if(typeof response.message !== "undefined"){
					__form_html	= response.message;
				}
			}
			if(document.getElementById("block-"+clientId)) {
				document.getElementById("block-" + clientId).innerHTML = __form_html;
			}
		}).catch((error) => {

			if(document.getElementById("block-"+clientId)) {
				document.getElementById("block-" + clientId).innerHTML = error;
			}
		});
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
										label: __('Select Custom Fields', 'templaza-framework'),
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
								label={__('Filter By Keyword', 'templaza-framework')}
								help={ attributes.enable_keyword ? __('Enabled filter by keyword.',
									'templaza-framework') : __('Disabled filter by keyword.', 'templaza-framework') }
								checked={ attributes.enable_keyword }
								onChange={ (val) => {setAttributes({enable_keyword: val})}}
							/>

							<ToggleControl
								label={__('Limit Height Fields', 'templaza-framework')}
								help={ attributes.limit_height ? __('Enabled limit height.',
									'templaza-framework') : __('Disabled limit height.', 'templaza-framework') }
								checked={ attributes.limit_height }
								onChange={ (val) => {setAttributes({limit_height: val})}}
							/>
							<TextControl
								label={__('Submit Text', 'templaza-framework')}
								value={ attributes.submit_text }
								onChange={ ( value ) => {setAttributes({submit_text: value})} }/>
							<ToggleControl
								label={__('Use ajax for filtering', 'templaza-framework')}
								help={ attributes.enable_ajax ? __('Enabled ajax for filtering.',
									'templaza-framework') : __('Disabled ajax for filtering.',
									'templaza-framework') }
								checked={ attributes.enable_ajax }
								onChange={ (val) => {setAttributes({enable_ajax: val});}}
							/>
							{attributes.enable_ajax &&
								(<ToggleControl
								label={__('Update URL', 'templaza-framework')}
								help={attributes.update_url ? __('Enabled update url for filtering.', 'templaza-framework')
									: __('Disabled update url for filtering.', 'templaza-framework')}
								checked={attributes.update_url}
								onChange={(val) => {
									setAttributes({update_url: val});
								}}/>)
							}
							{attributes.enable_ajax &&
								(<ToggleControl
										label={__('Filtering products instantly (no buttons required)', 'templaza-framework')}
										help={ attributes.instant ? __('Enabled filtering products instantly',
											'templaza-framework') : __('Disabled filtering products instantly',
											'templaza-framework') }
										checked={ attributes.instant }
										onChange={ (val) => {setAttributes({instant: val});}}
									/>)
							}
						</div>
					</PanelBody>
					<Panel>
						<PanelBody title={__("General", "templaza-framework")}>
							<PanelRow>
								<div id="templaza-framework-adv-products-filter-controls__general">
									<TextControl
										label={__('Max Height', 'templaza-framework')}
										value={ attributes.max_height }
										onChange={ ( val ) => {setAttributes({max_height: val});} }
									/>
								<SelectControl
									label={__('Large Desktop Columns', 'tempaza-framework')}
									help={__('Number products per row large desktop (1600px and larger)', 'tempaza-framework')}
									value={ attributes.column_large }
									options={ [
										{ label: __('1 Column', 'tempaza-framework'), value: '1' },
										{ label: __('2 Columns', 'tempaza-framework'), value: '2' },
										{ label: __('3 Columns', 'tempaza-framework'), value: '3' },
										{ label: __('4 Columns', 'tempaza-framework'), value: '4' },
										{ label: __('5 Columns', 'tempaza-framework'), value: '5' },
										{ label: __('6 Columns', 'tempaza-framework'), value: '6' },
									] }
									onChange={ (val) => {setAttributes({column_large: val});}}
								/>
								<SelectControl
									label={__('Desktop Columns', 'tempaza-framework')}
									help={__('Number products per row (1200px and larger)', 'tempaza-framework')}
									value={ attributes.column }
									options={ [
										{ label: __('1 Column', 'tempaza-framework'), value: '1' },
										{ label: __('2 Columns', 'tempaza-framework'), value: '2' },
										{ label: __('3 Columns', 'tempaza-framework'), value: '3' },
										{ label: __('4 Columns', 'tempaza-framework'), value: '4' },
										{ label: __('5 Columns', 'tempaza-framework'), value: '5' },
										{ label: __('6 Columns', 'tempaza-framework'), value: '6' },
									] }
									onChange={ (val) => {setAttributes({column: val});}}
								/>
								<SelectControl
									label={__('Laptop Columns', 'tempaza-framework')}
									help={__('Number products per row (960px and larger)', 'tempaza-framework')}
									value={ attributes.column_laptop }
									options={ [
										{ label: __('1 Column', 'tempaza-framework'), value: '1' },
										{ label: __('2 Columns', 'tempaza-framework'), value: '2' },
										{ label: __('3 Columns', 'tempaza-framework'), value: '3' },
										{ label: __('4 Columns', 'tempaza-framework'), value: '4' },
										{ label: __('5 Columns', 'tempaza-framework'), value: '5' },
										{ label: __('6 Columns', 'tempaza-framework'), value: '6' },
									] }
									onChange={ (val) => {setAttributes({column_laptop: val});}}
								/>
								<SelectControl
									label={__('Tablet Columns', 'tempaza-framework')}
									help={__('Number products per row (640px and larger)', 'tempaza-framework')}
									value={ attributes.column_tablet }
									options={ [
										{ label: __('1 Column', 'tempaza-framework'), value: '1' },
										{ label: __('2 Columns', 'tempaza-framework'), value: '2' },
										{ label: __('3 Columns', 'tempaza-framework'), value: '3' },
										{ label: __('4 Columns', 'tempaza-framework'), value: '4' },
										{ label: __('5 Columns', 'tempaza-framework'), value: '5' },
										{ label: __('6 Columns', 'tempaza-framework'), value: '6' },
									] }
									onChange={ (val) => {setAttributes({column_tablet: val});}}
								/>
								<SelectControl
									label={__('Mobile Columns', 'tempaza-framework')}
									help={__('Number products per row mobile', 'tempaza-framework')}
									value={ attributes.column_mobile }
									options={ [
										{ label: __('1 Column', 'tempaza-framework'), value: '1' },
										{ label: __('2 Columns', 'tempaza-framework'), value: '2' },
										{ label: __('3 Columns', 'tempaza-framework'), value: '3' },
										{ label: __('4 Columns', 'tempaza-framework'), value: '4' },
										{ label: __('5 Columns', 'tempaza-framework'), value: '5' },
										{ label: __('6 Columns', 'tempaza-framework'), value: '6' },
									] }
									onChange={ (val) => {setAttributes({column_mobile: val});}}
								/>
								</div>
							</PanelRow>
						</PanelBody>
					</Panel>
				</InspectorControls>

				<div { ...useBlockProps() }>
					<Spinner />
				</div>
				{/*<div { ...useBlockProps() }>*/}
				{/*	[advanced-product-form include="{*/}
				{/*		typeof attributes.ap_custom_fields === "object"?attributes.ap_custom_fields.join(','):attributes.ap_custom_fields*/}
				{/*}" enable_keyword="{attributes.enable_keyword?1:0}" submit_text="{attributes.submit_text*/}
				{/*}" enable_ajax="{attributes.enable_ajax?1:0}" update_url="{attributes.update_url?1:0*/}
				{/*}" instant="{attributes.instant?1:0}" column="{attributes.column?attributes.column:1*/}
				{/*}" column_large="{attributes.column_large?attributes.column_large:1*/}
				{/*}" column_laptop="{attributes.column_laptop?attributes.column_laptop:1*/}
				{/*}" column_tablet="{attributes.column_tablet?attributes.column_tablet:1*/}
				{/*}" column_mobile="{attributes.column_mobile?attributes.column_mobile:1}"{*/}
				{/*	typeof attributes.max_height !== "undefined" && attributes.max_height.length?" max_height=\""*/}
				{/*		+ attributes.max_height +"\"":""*/}
				{/*}]*/}
				{/*</div>*/}
		</Fragment>
	)
}
