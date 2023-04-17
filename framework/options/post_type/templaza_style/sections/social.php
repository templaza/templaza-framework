<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Social
Templaza_API::set_section('templaza_style',
    array(
        'title'  => __( 'Social', 'templaza-framework' ),
        'id'     => 'socials',
    //    'desc'   => __( 'These settings control the typography', 'templaza-framework' ),
        'icon'   => 'el el-share',
        'fields' => array(
            array(
                'id'       => 'social-style',
                'type'     => 'select',
                'title'    => __( 'Style', 'templaza-framework' ),
                'subtitle' => __( 'Choose the style how you want to show social profile on your site.', 'templaza-framework' ),
                'options'  => array(
                    'inherit' => esc_html__('Default', 'templaza-framework'),
                    'brand'   => esc_html__('Brand', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'social-icon-color',
                'type'     => 'color',
                'title'    => __( 'Social Icon Color', 'templaza-framework' ),
                'subtitle' => __( 'Select color for Social Icon', 'templaza-framework' ),
                'transparent'=> false,
                'required' => array(
                    array('social-style', '=', array('inherit', '')),
                )
            ),
            array(
                'id'       => 'social-icon-color-hover',
                'type'     => 'color',
                'title'    => __( 'Social Icon Color Hover', 'templaza-framework' ),
                'subtitle' => __( 'Select color for Social Icon when mouse hover', 'templaza-framework' ),
                'transparent'=> false,
                'required' => array(
                    array('social-style', '=', array('inherit', '')),
                )
            ),
            array(
                'id'       => 'social-icon-font',
                'type' => 'typography',
                'allow_responsive'        => true,
                'color'       => false,
                'font-style'  => false,
                'font-family' => false,
                'font-backup' => false,
                'font-weight' => false,
                'text-transform' => false,
                'letter-spacing' => false,
                'title'    => __('Social Icon Font Style', 'templaza-framework'),
                'default'  => '',
            ),
            array(
                'id'       => 'social-gap',
                'type'     => 'select',
                'title'    => __( 'Social Gap', 'templaza-framework' ),
                'subtitle' => __( 'Choose the space between socials', 'templaza-framework' ),
                'options'  => array(
                    '' => esc_html__('Default', 'templaza-framework'),
                    'small'   => esc_html__('Small', 'templaza-framework'),
                    'medium'   => esc_html__('Medium', 'templaza-framework'),
                    'large'   => esc_html__('Large', 'templaza-framework'),
                    'collapse'   => esc_html__('Collapse', 'templaza-framework'),
                ),
                'select2'       => array( 'allowClear' => true ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'default'       => '',
            ),
            array(
                'id'       => 'social',
                'type'     => 'tz_social',
                'title'    => __( 'Branding', 'templaza-framework' ),
                'subtitle' => __( 'Enable or disable the footer copyright bar.', 'templaza-framework' ),
                'default'  => '',
            ),
        )
    )
);