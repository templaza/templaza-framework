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
                'id'       => 'social',
                'type'     => 'tz_social',
                'title'    => __( 'Branding', 'templaza-framework' ),
                'subtitle' => __( 'Enable or disable the footer copyright bar.', 'templaza-framework' ),
                'default'  => '',
            ),
        )
    )
);