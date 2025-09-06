<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

Templaza_API::set_section('templaza_style',
    array(
        'title'  => __( 'Menu', 'templaza-framework' ),
        'id'     => 'menus',
//        'desc'   => __( 'Here you can set your preferences for the template header(Logo, Menu and Menu Elements).', 'templaza-framework' ),
        'icon'   => 'fas fa-bars',
    //    'subsection' => true,
        'fields' => array(
        ),
    )
);

Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Main Menu', 'templaza-framework' ),
        'id'         => 'menus-main-menu',
        'desc'       => __( 'These settings control design for main menu', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'     => 'main-menu-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Padding', 'templaza-framework'),
                'select2'   => array('allowClear' => true),
            ),
            array(
                'id'     => 'main-menu-margin',
                'type'   => 'spacing',
                'mode'   => 'margin',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Margin', 'templaza-framework'),
                'select2'   => array('allowClear' => true),
            ),
            array(
                'id'       => 'main-menu-border',
                'type'     => 'border',
                'title'    => __('Menu item border', 'templaza-framework'),
                'default'  => array(
                    'border-top'    => '',
                    'border-right'  => '',
                    'border-bottom' => '',
                    'border-left'   => '',
                    'border-style'  => '',
                    'border-color'  => '',
                ),
                'color_alpha'  => true
            ),
        ),
    )
);

Templaza_API::set_section('templaza_style',
	array(
		'title'      => __( 'Drop-down Menu', 'templaza-framework' ),
		'id'         => 'menus-dropdown-menu',
		'desc'       => __( 'These settings control design for drop down menu', 'templaza-framework' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'     => 'dropdown-menu-padding',
				'type'   => 'spacing',
				'mode'   => 'padding',
				'all'    => false,
                'allow_responsive'    => true,
				'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
				'title'  => esc_html__('Padding', 'templaza-framework'),
			),
			array(
				'id'     => 'dropdown-menu-margin',
				'type'   => 'spacing',
				'mode'   => 'margin',
				'all'    => false,
				'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
				'title'  => esc_html__('Margin', 'templaza-framework'),
			),
            array(
                'id'       => 'dropdown-menu-border-radius',
                'type'     => 'spacing',
                'mode'     => 'border-radius',
                'allow_responsive'    => true,
                'all'    => false,
                'units'  => array('px', '%' ),
                'title'    => esc_html__('Border radius', 'templaza-framework'),
            ),
		),
	)
);

Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Sticky Menu', 'templaza-framework' ),
        'id'         => 'menus-sticky-menu',
        'desc'       => __( 'These settings control design for sticky menu', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'     => 'sticky-menu-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Padding', 'templaza-framework'),
                'select2'   => array('allowClear' => true),
            ),
            array(
                'id'     => 'sticky-menu-margin',
                'type'   => 'spacing',
                'mode'   => 'margin',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Margin', 'templaza-framework'),
                'select2'   => array('allowClear' => true),
            ),
        ),
    )
);