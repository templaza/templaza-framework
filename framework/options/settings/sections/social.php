<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Social
Templaza_API::set_section('settings',
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
                    'inherit' => esc_html__('Inherit', 'templaza-framework'),
                    'brand'   => esc_html__('Brand', 'templaza-framework'),
                ),
                'default'  => 'inherit',
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
                'default'  => '',
            ),
            array(
                'id'       => 'social',
                'type'     => 'tz_social',
                'title'    => __( 'Branding', 'templaza-framework' ),
                'subtitle' => __( 'Add your socials.', 'templaza-framework' ),
                'default'  => false,
            ),
        )
    )
);