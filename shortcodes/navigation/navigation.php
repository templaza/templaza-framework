<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Navigation')){
	class TemplazaFramework_ShortCode_Navigation extends TemplazaFramework_ShortCode {

		public function register(){
			return array(
				'id'          => 'navigation',
				'icon'        => 'fas fa-bars',
				'title'       => esc_html__('Navigation', 'templaza-framework'),
				'param_title' => esc_html__('Navigation Settings', 'templaza-framework'),
				'desc'        => esc_html__('Insert an Navigation', 'templaza-framework'),
				'admin_label' => true,
				'params'      => array(
                    array(
                        'id'        => 'nav_wrap_style',
                        'type'      => 'select',
                        'title'     => esc_html__('Menu Style', 'templaza-framework'),
                        'options'   => array(
                            'default'       => esc_html__('Default', 'templaza-framework'),
                            'inline'        => esc_html__('Inline', 'templaza-framework'),
                        )
                    ),
					array(
						'id' => 'nav-items-start',
						'type' => 'section',
						'title' => esc_html__('Items Manager', 'templaza-framework'),
						'subtitle' => esc_html__('With the "section" field you can add/edit Menu Items.', 'templaza-framework'),
						'indent' => true
					),
					array(
						'id'       => 'nav_items',
						'type'     => 'tz_repeater',
						'title' => esc_html__('Items', 'templaza-framework'),
						'fields' => array(
							array(
								'id'       => 'nav_item_title',
								'type'     => 'text',
								'title'    => esc_html__( 'Nav Item Title', 'templaza-framework' ),
								'subtitle' => esc_html__( 'What text use as a nav title.', 'templaza-framework' ),
							),
							array(
								'id'       => 'nav_item_url',
								'type'     => 'text',
								'title'    => esc_html__( 'Nav Item URL', 'templaza-framework' ),
								'subtitle' => esc_html__( 'What url use as a nav url.', 'templaza-framework' ),
							),
							array(
								'id'        => 'nav_item_icon',
								'type'      => 'select',
								'title'     => esc_html__('Icon', 'templaza-framework'),
								'subtitle'  => esc_html__('Place scalable vector icons anywhere in your content. See live preview here https://getuikit.com/docs/icon', 'templaza-framework'),
								'options'   => $this->get_font_uikit()
							),
							array(
								'id'      => 'nav_item_active',
								'type'    => 'switch',
								'title'   => esc_html__('Enable it to indicate an active menu item.', 'templaza-framework'),
								'default' => false,
							),
							array(
								'id'        => 'nav_item_target',
								'type'      => 'select',
								'title'     => esc_html__('Link Open', 'templaza-framework'),
								'options'   => array(
									''              => esc_html__('Self', 'templaza-framework'),
									'_blank'        => esc_html__('New Window', 'templaza-framework'),
								)
							),
                        ),
                    ),
					array(
						'id' => 'nav-items-end',
						'type' => 'section',
						'indent' => false
					),
					array(
						'id' => 'nav-configure-start',
						'type' => 'section',
						'title' => esc_html__('Item Configure', 'templaza-framework'),
						'subtitle' => esc_html__('With the "section" field you can configure Menu Items.', 'templaza-framework'),
						'indent' => true
					),
					array(
						'id'        => 'nav_alignment',
						'type'      => 'select',
						'title'     => esc_html__('Nav Alignment', 'templaza-framework'),
						'options'   => array(
							'left'          => esc_html__('Left', 'templaza-framework'),
							'center'        => esc_html__('Center', 'templaza-framework'),
							'right'         => esc_html__('Right', 'templaza-framework'),
						)
					),
					array(
						'id'        => 'nav_style',
						'type'      => 'select',
						'title'     => esc_html__('Nav Style', 'templaza-framework'),
						'options'   => array(
							'-'          => esc_html__('Default', 'templaza-framework'),
							'text'       => esc_html__('Text', 'templaza-framework'),
							'heading'    => esc_html__('Heading', 'templaza-framework'),
							'reset'      => esc_html__('Reset', 'templaza-framework'),
						)
					),
					array(
						'id'     => 'nav_item_padding',
						'type'   => 'spacing',
						'mode'   => 'padding',
						'all'    => false,
						'allow_responsive'    => true,
						'units'  => array( 'em', 'rem', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
						'title'  => esc_html__('Padding', 'templaza-framework'),
						'default' => array(
							'units' => 'px'
						),
					),
					array(
						'id'     => 'nav_item_margin',
						'type'   => 'spacing',
						'mode'   => 'margin',
						'all'    => false,
						'allow_responsive'    => true,
						'units'  => array( 'em', 'rem', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
						'title'  => esc_html('Margin', 'templaza-framework'),
						'default' => array(
							'units' => 'px'
						),
					),
					array(
						'id' => 'nav-configure-end',
						'type' => 'section',
						'indent' => false
					),
					array(
						'id' => 'nav-style-start',
						'type' => 'section',
						'title' => esc_html__('Item Style', 'templaza-framework'),
						'subtitle' => esc_html__('With the "section" field you can configure Menu Style.', 'templaza-framework'),
						'indent' => true
					),
					array(
						'id'        => 'nav_decoration',
						'type'      => 'select',
						'title'     => esc_html__('Nav Decoration', 'templaza-framework'),
						'options'   => array(
							'-'                 => esc_html__('Default', 'templaza-framework'),
							'underline'         => esc_html__('Underline', 'templaza-framework'),
							'line-through'      => esc_html__('Line Through', 'templaza-framework'),
							'overline'          => esc_html__('Overline', 'templaza-framework'),
							'none'              => esc_html__('None', 'templaza-framework'),
						)
					),
					array(
						'id'       => 'nav_color',
						'type'     => 'color',
						'title'    => esc_html__('Menu Item Color', 'templaza-framework'),
					),
					array(
						'id'        => 'nav_background',
						'type'      => 'background',
						'title'     => esc_html__('Menu Item Background', 'templaza-framework'),
					),
					array(
						'id'         => 'nav_border',
						'type'       => 'border',
						'title'      => esc_html__('Menu Item Border', 'templaza-framework'),
					),
					array(
						'id' => 'nav-style-end',
						'type' => 'section',
						'indent' => false
					),
					array(
						'id' => 'nav-style-hover-start',
						'type' => 'section',
						'title' => esc_html__('Item Style Hover', 'templaza-framework'),
						'subtitle' => esc_html__('With the "section" field you can configure Menu Style on Hover.', 'templaza-framework'),
						'indent' => true
					),
					array(
						'id'        => 'nav_decoration_hover',
						'type'      => 'select',
						'title'     => esc_html__('Nav Decoration Hover', 'templaza-framework'),
						'options'   => array(
							'-'                 => esc_html__('Default', 'templaza-framework'),
							'underline'         => esc_html__('Underline', 'templaza-framework'),
							'line-through'      => esc_html__('Line Through', 'templaza-framework'),
							'overline'          => esc_html__('Overline', 'templaza-framework'),
							'none'              => esc_html__('None', 'templaza-framework'),
						)
					),
					array(
						'id'       => 'nav_color_hover',
						'type'     => 'color',
						'title'    => esc_html__('Menu Item Color Hover', 'templaza-framework'),
					),
					array(
						'id'        => 'nav_background_hover',
						'type'      => 'background',
						'title'     => esc_html__('Menu Item Background Hover', 'templaza-framework'),
					),
					array(
						'id'         => 'nav_border_hover',
						'type'       => 'border',
						'title'      => esc_html__('Menu Item Border Hover', 'templaza-framework'),
					),
					array(
						'id' => 'nav-style-hover-end',
						'type' => 'section',
						'indent' => false
					),
				)
			);
		}
	}

}

?>