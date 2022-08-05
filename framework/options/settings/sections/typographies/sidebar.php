<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Sidebar Typography', $this -> text_domain ),
        'id'         => 'sidebar-typo',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'sidebar_bg',
                'type'     => 'background',
                'title'    => __( 'Sidebar Background', $this -> text_domain ),
                'subtitle' => __( 'background for sidebar.', $this -> text_domain ),
            ),
            array(
                'id'       => 'widget_box_bg',
                'type'     => 'background',
                'title'    => __( 'Widget Background', $this -> text_domain ),
                'subtitle' => __( 'background for all widget in sidebar.', $this -> text_domain ),
            ),
            array(
                'id'       => 'widget_box_border',
                'type'     => 'border',
                'title'    => __('Widget Border', $this -> text_domain),
                'default'  => ''
            ),
            array(
                'id'       => 'widget_box_padding',
                'type'     => 'spacing',
                'allow_responsive'    => true,
                'title'    => __('Widget Padding', $this -> text_domain),
                'default'  => ''
            ),
            array(
                'id'       => 'widget_box_margin',
                'type'     => 'spacing',
                'mode'     => 'margin',
                'allow_responsive'    => true,
                'title'    => __('Widget Margin', $this -> text_domain),
                'default'  => ''
            ),
            array(
                'id'       => 'widget_box_border_radius',
                'type'     => 'spacing',
                'mode'     => 'border-radius',
                'allow_responsive'    => true,
                'title'    => __('Widget Border radius', $this -> text_domain),
                'default'  => ''
            ),
            array(
                'id'       => 'widget_box_shadow',
                'type'     => 'text',
                'title'    => __('Widget Box Shadow', $this -> text_domain),
                'default'  => '',
                'desc'     => __( 'Example: 10px 10px 5px 0px rgba(0,0,0,0.75). You can generator <a href="https://cssgenerator.org/box-shadow-css-generator.html">Here</a> ', $this -> text_domain ),
            ),
            array(
                'id'       => 'widget_box_heading_style',
                'type'     => 'image_select',
                'title'    => __('Heading Style', 'redux-framework-demo'),
                'subtitle' => __('Choose Heading Style.', 'redux-framework-demo'),
                'options'  => array(
                    'style1' => array(
                        'alt'   => esc_html__('Style 1', $this -> text_domain),
                        'img'   =>  Functions::get_my_frame_url().'/options/patterns/widget-title-style1.jpg'
                    ),
                    'style2' => array(
                        'alt'   => esc_html__('Style 2', $this -> text_domain),
                        'img'   => Functions::get_my_frame_url().'/options/patterns/widget-title-style2.jpg'
                    ),
                ),
                'default'  => 'style1',
            ),
            array(
                'id'       => 'widget_box_heading2_margin',
                'type'     => 'spacing',
                'title'    => __('Heading Style 2 margin', $this -> text_domain),
                'default'  => '',
                'required' => array('widget_box_heading_style', '=' , 'style2')
            ),
            array(
                'id'       => 'widget_box_heading2_bg',
                'type'     => 'background',
                'title'    => __('Heading Style 2 background', $this -> text_domain),
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
                'title'    => __('Widget Heading', $this -> text_domain),
                'default'  => ''
            ),
            array(
                'id'       => 'widget_box_content',
                'type' => 'typography',
                'allow_responsive'        => true,
                'google'      => true,
                'font-backup' => true,
                'letter-spacing' => true,
                'text-transform' => true,
                'title'    => __('Widget Content', $this -> text_domain),
                'default'  => ''
            ),
        )
    )
);