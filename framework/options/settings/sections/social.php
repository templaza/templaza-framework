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
                    'custom'   => esc_html__('Custom', 'templaza-framework'),
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
                'id'       => 'social-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Social Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color of social.', 'templaza-framework' ),
                'required'                => array('social-style', '=', 'custom'),
            ),
            array(
                'id'       => 'social-color-hover',
                'type'     => 'color_rgba',
                'title'    => __( 'Social Hover Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color hover of social.', 'templaza-framework' ),
                'required'                => array('social-style', '=', 'custom'),
            ),
            array(
                'id'       => 'social-bg-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Social Background Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the background color of social.', 'templaza-framework' ),
                'required'                => array('social-style', '=', 'custom'),
            ),
            array(
                'id'       => 'social-bg-color-hover',
                'type'     => 'color_rgba',
                'title'    => __( 'Social Background Hover Color', 'templaza-framework' ),
                'subtitle' => __( 'Set the color background hover of social.', 'templaza-framework' ),
                'required'                => array('social-style', '=', 'custom'),
            ),
            array(
                'id'       => 'social-fix-width-height',
                'type'     => 'switch',
                'title'    => esc_html__('Social Fix Width Height', 'templaza-framework'),
                'default'  => true,
                'required'                => array('social-style', '=', 'custom'),
            ),
            array(
                'id'       => 'social-width-height',
                'type'     => 'dimensions',
                'title'    => esc_html__('Social Width Height', 'templaza-framework'),
                'default'  => array(
                    'Width'   => '40',
                    'Height'  => '40'
                ),
                'required'                => array('social-style', '=', 'custom'),
            ),
            array(
                'id'       => 'social',
                'type'     => 'tz_social',
                'title'    => __( 'Branding', 'templaza-framework' ),
                'subtitle' => __( 'Enable or disable the footer copyright bar.', 'templaza-framework' ),
                'default'  => false,
            ),
        )
    )
);