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
                'id'       => 'layout-background',
                'type'     => 'background',
                'title'    => __( 'Background', 'templaza-framework' ),
                'required' => array('layout-theme', '!=', 'wide'),
            ),
        )
    )
);