<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

// General
Templaza_API::set_section('templaza_style',
    array(
        'id'         => 'generals',
        'title'     => esc_html__('General','templaza-framework'),
        'desc'      => esc_html__('General theme options','templaza-framework'),
        'icon'      => 'el-icon-home',
        'fields'    => array(
        ),
    )
);

// -> START Layout Settings
Templaza_API::set_section('templaza_style',
    array(
        'id'         => 'layout-settings',
        'title'     => esc_html__('Layout Settings','templaza-framework'),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'layout-theme',
                'type'     => 'select',
                'title'    => __( 'Site Layout', 'templaza-framework' ),
                'subtitle' => __( 'Select the site layout.', 'templaza-framework' ),
                'options'  => array(
                    'wide'       => __('Wide', 'templaza-framework'),
                    'boxed'      => __('Boxed', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'layout-maxwidth',
                'type'     => 'text',
                'title'    => __('Box Max Width', 'templaza-framework'),
                'default'  => '',
                'desc'     => __( 'Example: 1500px or 90%', 'templaza-framework' ),
                'required' => array('layout-theme', '=', 'boxed'),
            ),
            array(
                'id'       => 'layout-shadow',
                'type'     => 'text',
                'title'    => __('Box shadow', 'templaza-framework'),
                'default'  => '',
                'required' => array('layout-theme', '=', 'boxed'),
                'desc'     => __( 'Example: 10px 10px 5px 0px rgba(0,0,0,0.75). You can generator <a href="https://cssgenerator.org/box-shadow-css-generator.html">Here</a> ', 'templaza-framework' ),
            ),
            array(
                'id'       => 'layout-background',
                'type'     => 'background',
                'title'    => __( 'Box Background', 'templaza-framework' ),
                'required' => array('layout-theme', '!=', 'wide'),
            ),
            array(
                'id'       => 'layout-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'    => __( 'Site Padding', 'templaza-framework' ),
                'subtitle' => __( 'Padding wrap content.', 'templaza-framework' ),
                'default' => array(
                    'units' => 'px',
                ),
            ),
        )
    )
);