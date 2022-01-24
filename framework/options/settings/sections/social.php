<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Social
Templaza_API::set_section('settings',
    array(
        'title'  => __( 'Social', $this -> text_domain ),
        'id'     => 'socials',
    //    'desc'   => __( 'These settings control the typography', $this -> text_domain ),
        'icon'   => 'el el-share',
        'fields' => array(
            array(
                'id'       => 'social-style',
                'type'     => 'select',
                'title'    => __( 'Style', $this -> text_domain ),
                'subtitle' => __( 'Choose the style how you want to show social profile on your site.', $this -> text_domain ),
                'options'  => array(
                    'inherit' => esc_html__('Inherit', $this -> text_domain),
                    'brand'   => esc_html__('Brand', $this -> text_domain),
                ),
                'default'  => 'inherit',
            ),
            array(
                'id'       => 'social-gap',
                'type'     => 'select',
                'title'    => __( 'Social Gap', $this -> text_domain ),
                'subtitle' => __( 'Choose the space between socials', $this -> text_domain ),
                'options'  => array(
                    '' => esc_html__('Default', $this -> text_domain),
                    'small'   => esc_html__('Small', $this -> text_domain),
                    'medium'   => esc_html__('Medium', $this -> text_domain),
                    'large'   => esc_html__('Large', $this -> text_domain),
                    'collapse'   => esc_html__('Collapse', $this -> text_domain),
                ),
                'default'  => '',
            ),
            array(
                'id'       => 'social',
                'type'     => 'tz_social',
                'title'    => __( 'Branding', $this -> text_domain ),
                'subtitle' => __( 'Enable or disable the footer copyright bar.', $this -> text_domain ),
                'default'  => false,
            ),
        )
    )
);