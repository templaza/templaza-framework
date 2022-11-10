<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Sidebar Typography', 'templaza-framework' ),
        'id'         => 'sidebar-typo',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'sidebar_bg',
                'type'     => 'background',
                'title'    => __( 'Sidebar Background', 'templaza-framework' ),
                'subtitle' => __( 'background for sidebar.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'widget_box_bg',
                'type'     => 'background',
                'title'    => __( 'Widget Background', 'templaza-framework' ),
                'subtitle' => __( 'background for all widget in sidebar.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'widget_box_border',
                'type'     => 'border',
                'title'    => __('Widget Border', 'templaza-framework'),
                /* styles option added by TemPlaza*/
                'styles'   => array('' => esc_html__('Style', 'templaza-framework')),
                'placeholder'   => array(
                    'style' => esc_html__('Style', 'templaza-framework'),
                ),
                'select2'  => array('allowClear' => true),
            ),
            array(
                'id'        => 'widget_box_padding',
                'type'      => 'spacing',
                'allow_responsive'    => true,
                'title'     => __('Widget Padding', 'templaza-framework'),
                'units'     => array(false,'px'),
                'select2'   => array('allowClear' => true),
                'default'   => array(
                    'units' => ''
                )
            ),
            array(
                'id'        => 'widget_box_margin',
                'type'      => 'spacing',
                'mode'      => 'margin',
                'allow_responsive'    => true,
                'title'     => __('Widget Margin', 'templaza-framework'),
                'units'     => array(false,'px'),
                'select2'   => array('allowClear' => true),
                'default'   => array(
                    'units' => ''
                )
            ),
            array(
                'id'       => 'widget_box_border_radius',
                'type'     => 'spacing',
                'mode'     => 'border-radius',
                'allow_responsive'    => true,
                'title'    => __('Widget Border radius', 'templaza-framework'),
                'units'     => array(false,'px'),
                'select2'   => array('allowClear' => true),
                'default'   => array(
                    'units' => ''
                )
            ),
            array(
                'id'       => 'widget_box_shadow',
                'type'     => 'text',
                'title'    => __('Widget Box Shadow', 'templaza-framework'),
                'default'  => '',
                'desc'     => __( 'Example: 10px 10px 5px 0px rgba(0,0,0,0.75). You can generator <a href="https://cssgenerator.org/box-shadow-css-generator.html">Here</a> ', 'templaza-framework' ),
            ),
            array(
                'id'       => 'widget_box_heading_style',
                'type'     => 'tz_select_image',
                'title'    => __('Heading Style', 'redux-framework-demo'),
                'subtitle' => __('Choose Heading Style.', 'redux-framework-demo'),
                'options'  => array(
                    'style1' => array(
                        'alt'   => esc_html__('Style 1', 'templaza-framework'),
                        'img'   =>  Functions::get_my_frame_url().'/options/patterns/widget-title-style1.jpg'
                    ),
                    'style2' => array(
                        'alt'   => esc_html__('Style 2', 'templaza-framework'),
                        'img'   => Functions::get_my_frame_url().'/options/patterns/widget-title-style2.jpg'
                    ),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'widget_box_heading2_margin',
                'type'     => 'spacing',
                'title'    => __('Heading Style 2 margin', 'templaza-framework'),
                'default'  => '',
                'required' => array('widget_box_heading_style', '=' , 'style2')
            ),
            array(
                'id'       => 'widget_box_heading2_bg',
                'type'     => 'background',
                'title'    => __('Heading Style 2 background', 'templaza-framework'),
                'default'  => '',
                'required' => array('widget_box_heading_style', '=' , 'style2')
            ),
            array(
                'id'       => 'widget_box_heading',
                'type' => 'typography',
                'allow_responsive'        => true,
                'google'      => true,
                'font-backup' => true,
                'letter-spacing' => true,
                'text-transform' => true,
                'title'    => __('Widget Heading', 'templaza-framework'),
                'units'                   => array(
                    'font-size'         => array(''),
                    'line-height'       => array(''),
                    'letter-spacing'    => array(''),
                ),
                'default'                 => array(
                    'color'          => '',
                    'font-weight'    => '',
                    'letter-spacing' => '',
                    'text-transform' => '',
                    'font-family'    => '',
                    'font-backup'    => '',
                    'units'          => array(
                        'font-size'     => '',
                        'line-height'   => '',
                        'letter-spacing'   => '',
                    )
                ),
            ),
            array(
                'id'       => 'widget_box_content',
                'type' => 'typography',
                'allow_responsive'        => true,
                'google'      => true,
                'font-backup' => true,
                'letter-spacing' => true,
                'text-transform' => true,
                'title'    => __('Widget Content', 'templaza-framework'),
                'units'                   => array(
                    'font-size'         => array(''),
                    'line-height'       => array(''),
                    'letter-spacing'    => array(''),
                ),
                'default'                 => array(
                    'color'          => '',
                    'font-weight'    => '',
                    'letter-spacing' => '',
                    'text-transform' => '',
                    'font-family'    => '',
                    'font-backup'    => '',
                    'units'          => array(
                        'font-size'     => '',
                        'line-height'   => '',
                        'letter-spacing'   => '',
                    )
                ),
            ),
        )
    )
);