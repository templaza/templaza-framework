<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Navigation')){
	class TemplazaFramework_ShortCode_Navigation extends TemplazaFramework_ShortCode {

		public function register(){
			return array(
				'id'          => 'navigation',
				'icon'        => 'fas fa-bars',
				'title'       => esc_html__('Navigation', $this -> text_domain),
				'param_title' => esc_html__('Navigation Settings', $this -> text_domain),
				'desc'        => esc_html__('Insert an Navigation', $this -> text_domain),
				'admin_label' => true,
				'params'      => array(
                    array(
                        'id'        => 'nav_wrap_style',
                        'type'      => 'select',
                        'title'     => esc_html__('Menu Style', $this -> text_domain),
                        'options'   => array(
                            'default'       => esc_html__('Default', $this -> text_domain),
                            'inline'        => esc_html__('Inline', $this -> text_domain),
                        )
                    ),
					array(
						'id' => 'nav-items-start',
						'type' => 'section',
						'title' => esc_html__('Items Manager', $this -> text_domain),
						'subtitle' => esc_html__('With the "section" field you can add/edit Menu Items.', $this -> text_domain),
						'indent' => true
					),
					array(
						'id'       => 'nav_items',
						'type'     => 'tz_repeater',
						'title' => esc_html__('Items', $this -> text_domain),
						'fields' => array(
							array(
								'id'       => 'nav_item_title',
								'type'     => 'text',
								'title'    => esc_html__( 'Nav Item Title', $this -> text_domain ),
								'subtitle' => esc_html__( 'What text use as a nav title.', $this -> text_domain ),
							),
							array(
								'id'       => 'nav_item_url',
								'type'     => 'text',
								'title'    => esc_html__( 'Nav Item URL', $this -> text_domain ),
								'subtitle' => esc_html__( 'What url use as a nav url.', $this -> text_domain ),
							),
							array(
								'id'        => 'nav_item_icon',
								'type'      => 'select',
								'title'     => esc_html__('Icon', $this -> text_domain),
								'subtitle'  => esc_html__('Place scalable vector icons anywhere in your content. See live preview here https://getuikit.com/docs/icon', $this -> text_domain),
								'options'   => $this->get_font_uikit()
							),
							array(
								'id'      => 'nav_item_active',
								'type'    => 'switch',
								'title'   => esc_html__('Enable it to indicate an active menu item.', $this -> text_domain),
								'default' => false,
							),
							array(
								'id'        => 'nav_item_target',
								'type'      => 'select',
								'title'     => esc_html__('Link Open', $this -> text_domain),
								'options'   => array(
									''              => esc_html__('Self', $this -> text_domain),
									'_blank'        => esc_html__('New Window', $this -> text_domain),
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
						'title' => esc_html__('Item Configure', $this -> text_domain),
						'subtitle' => esc_html__('With the "section" field you can configure Menu Items.', $this -> text_domain),
						'indent' => true
					),
					array(
						'id'        => 'nav_alignment',
						'type'      => 'select',
						'title'     => esc_html__('Nav Alignment', $this -> text_domain),
						'options'   => array(
							'left'          => esc_html__('Left', $this -> text_domain),
							'center'        => esc_html__('Center', $this -> text_domain),
							'right'         => esc_html__('Right', $this -> text_domain),
						)
					),
					array(
						'id'        => 'nav_style',
						'type'      => 'select',
						'title'     => esc_html__('Nav Style', $this -> text_domain),
						'options'   => array(
							'-'          => esc_html__('Default', $this -> text_domain),
							'text'       => esc_html__('Text', $this -> text_domain),
							'heading'    => esc_html__('Heading', $this -> text_domain),
							'reset'      => esc_html__('Reset', $this -> text_domain),
						)
					),
					array(
						'id'     => 'nav_item_padding',
						'type'   => 'spacing',
						'mode'   => 'padding',
						'all'    => false,
						'allow_responsive'    => true,
						'units'  => array( 'em', 'rem', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
						'title'  => esc_html__('Padding', $this -> text_domain),
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
						'title'  => esc_html('Margin', $this -> text_domain),
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
						'title' => esc_html__('Item Style', $this -> text_domain),
						'subtitle' => esc_html__('With the "section" field you can configure Menu Style.', $this -> text_domain),
						'indent' => true
					),
					array(
						'id'        => 'nav_decoration',
						'type'      => 'select',
						'title'     => esc_html__('Nav Decoration', $this -> text_domain),
						'options'   => array(
							'-'                 => esc_html__('Default', $this -> text_domain),
							'underline'         => esc_html__('Underline', $this -> text_domain),
							'line-through'      => esc_html__('Line Through', $this -> text_domain),
							'overline'          => esc_html__('Overline', $this -> text_domain),
							'none'              => esc_html__('None', $this -> text_domain),
						)
					),
					array(
						'id'       => 'nav_color',
						'type'     => 'color',
						'title'    => esc_html__('Menu Item Color', $this -> text_domain),
					),
					array(
						'id'        => 'nav_background',
						'type'      => 'background',
						'title'     => esc_html__('Menu Item Background', $this -> text_domain),
					),
					array(
						'id'         => 'nav_border',
						'type'       => 'border',
						'title'      => esc_html__('Menu Item Border', $this -> text_domain),
					),
					array(
						'id' => 'nav-style-end',
						'type' => 'section',
						'indent' => false
					),
					array(
						'id' => 'nav-style-hover-start',
						'type' => 'section',
						'title' => esc_html__('Item Style Hover', $this -> text_domain),
						'subtitle' => esc_html__('With the "section" field you can configure Menu Style on Hover.', $this -> text_domain),
						'indent' => true
					),
					array(
						'id'        => 'nav_decoration_hover',
						'type'      => 'select',
						'title'     => esc_html__('Nav Decoration Hover', $this -> text_domain),
						'options'   => array(
							'-'                 => esc_html__('Default', $this -> text_domain),
							'underline'         => esc_html__('Underline', $this -> text_domain),
							'line-through'      => esc_html__('Line Through', $this -> text_domain),
							'overline'          => esc_html__('Overline', $this -> text_domain),
							'none'              => esc_html__('None', $this -> text_domain),
						)
					),
					array(
						'id'       => 'nav_color_hover',
						'type'     => 'color',
						'title'    => esc_html__('Menu Item Color Hover', $this -> text_domain),
					),
					array(
						'id'        => 'nav_background_hover',
						'type'      => 'background',
						'title'     => esc_html__('Menu Item Background Hover', $this -> text_domain),
					),
					array(
						'id'         => 'nav_border_hover',
						'type'       => 'border',
						'title'      => esc_html__('Menu Item Border Hover', $this -> text_domain),
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