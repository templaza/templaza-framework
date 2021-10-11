/**
 * Hello World: Step 1
 *
 * Simple block, renders and saves the same content without interactivity.
 *
 * Using inline styles - no external stylesheet needed.  Not recommended
 * because all of these styles will appear in `post_content`.
 */
( function( blocks, i18n, element, editor, components ) {
	var el = element.createElement;
	var __ = i18n.__;

	const {BlockControls, InspectorControls, AlignmentToolbar, PanelColorSettings} = editor;
	const { Fragment } = element;
	const { PanelBody, ToggleControl, SelectControl, ColorPalette } = components;
	const colorSamples = [
		{
			name: 'Coral',
			slug: 'coral',
			color: '#FF7F50'
		},
		{
			name: 'Brown',
			slug: 'brown',
			color: '#964B00'
		},
		{
			name: 'Purple',
			slug: 'purple',
			color: '#800080'
		}
	];

	blocks.registerBlockType( 'templaza-framework/sample', {
		// title: __( 'Templaza: Sample', 'templaza-framework' ),
		// icon: 'universal-access-alt',
		// category: 'design',

		// example: {
		// 	attributes: {
		// 		// content: 'Hello World',
		// 		colorControl: '#FF7F50',
		// 	},
		// },
		// attributes: {
		// 	textColor: {
		// 		type: 'string'
		// 	},
		// 	colorControl: {
		// 		type: 'string',
		// 		default: "#FF7F50",
		// 	},
		// 	toggleControl: {
		// 		type: 'bool',
		// 		default: false
		// 	},
		// 	selectControl: {
		// 		type: 'string',
		// 		default: ''
		// 	},
		// // 	"url": {
		// // 		"type": "string",
		// // 		"source": "attribute",
		// // 		"selector": "a",
		// // 		"attribute": "href"
		// // 	}
		// },
		edit: function(props) {
			const blockInnerStyle = {
				backgroundColor: props.attributes.colorControl,
				color: '#fff',
				padding: '20px',
			};
			return [
				el( Fragment, {},
					el( InspectorControls, {},
						el( PanelColorSettings, {
							title: 'Custom Color Options', initialOpen: true,
							colorSettings: [
								{
									// colors: colorSamples, // here you can pass custom colors
									value: props.attributes.colorControl,
									label: 'Color Control',
									onChange: ( value ) => {
										props.setAttributes( { colorControl: value } );
									},
								},
							]
						}),
						el( PanelBody, {
								title: 'Basic Options',
								initialOpen: true,
							},
							el(
								ToggleControl,{
									label: "Toggle Control",
									checked: props.attributes.toggleControl,
									onChange: (state) => {
										props.setAttributes({toggleControl: state});
									}
								}
							),
							el(
								SelectControl,{
									label: "Select Control",
									value: props.attributes.selectControl,
									options: [
										{
											label: "Option 1",
											value: "option-1"
										},
										{
											label: "Option 2",
											value: "option-2"
										}
									],
									onChange: (value) => {
										props.setAttributes({selectControl: value});
									}
								}
							)
						),
						/*),*/
					),
				),
				el(
					'p',
					{ style: blockInnerStyle,
						// attributes: props.attributes,
					},
					__('Hello World, step 1 (from the editor).', 'templaza-framework')
				),
				el(
					ColorPalette,{
						label: "Color Control",
						colors: colorSamples,
						value: props.attributes.colorControl,
						onChange: ( value ) => {
							props.setAttributes( { colorControl: value } );
						},
					}
				),
				el(
					ToggleControl,{
						label: "Toggle Control",
						checked: props.attributes.toggleControl,
						onChange: (state) => {
							props.setAttributes({toggleControl: state});
						},
					}
				),
				el(
					SelectControl,{
						label: "Select Control",
						options: [
							{
								label: "Option 1",
								value: "option-1"
							},
							{
								label: "Option 2",
								value: "option-2"
							}
						],
						value: props.attributes.selectControl,
						onChange: (value) => {
							props.setAttributes({selectControl: value});
						},
					}
				),
			];
		},
		save: function(props) {
			const blockInnerStyle = {
				backgroundColor: props.attributes.colorControl,
				color: '#fff',
				padding: '20px',
			};

			return el(
				'p',
				{ style: blockInnerStyle },
				'Gutenberg Hello World, step 1 (from the frontend).'
			);
		},
	} );
} )( window.wp.blocks, window.wp.i18n, window.wp.element, window.wp.editor,window.wp.components);
