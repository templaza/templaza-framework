<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Footer
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Footer Typography', 'templaza-framework' ),
        'id'         => 'typography-footers',
        'desc'       => __( 'These settings control the typography for Footer.', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'typography-footer',
                'type'     => 'select',
                'title'    => __( 'Typography Properties', 'templaza-framework' ),
                'subtitle' => __( 'Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', 'templaza-framework' ),
                'options'  => array(
                    'default'       => __('Default', 'templaza-framework'),
                    'custom'      => __('Custom', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'        => 'typography-footer-option',
                'type'      => 'typography',
                'title'     => __( 'Footer', 'templaza-framework' ),
                'subtitle'  => __( 'Specify the footer font properties.', 'templaza-framework' ),
                'required'  => array('typography-footer', '!=', 'default'),
                'color'          => true,
                'text-align'     => false,
                'preview'        => true, // Disable the previewer
                'word-spacing'   => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'font-backup'    => true,
                'google'                  => true,
                'allow_responsive'        => true,
                'allow_empty_line_height' => true,
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
                'id'        => 'typography-footer-widget-heading',
                'type'      => 'typography',
                'title'     => __( 'Footer Widget Heading', 'templaza-framework' ),
                'subtitle'  => __( 'Specify the footer widget heading font properties.', 'templaza-framework' ),
                'required'  => array('typography-footer', '!=', 'default'),
                'color'          => true,
                'text-align'     => false,
                'preview'        => true, // Disable the previewer
                'word-spacing'   => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'font-backup'    => true,
                'google'                  => true,
                'allow_responsive'        => true,
                'allow_empty_line_height' => true,
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
                'id'        => 'typography-footer-widget-content',
                'type'      => 'typography',
                'title'     => __( 'Footer Widget Content', 'templaza-framework' ),
                'subtitle'  => __( 'Specify the footer widget content font properties.', 'templaza-framework' ),
                'required'  => array('typography-footer', '!=', 'default'),
                'color'          => true,
                'text-align'     => false,
                'preview'        => true, // Disable the previewer
                'word-spacing'   => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'font-backup'    => true,
                'google'                  => true,
                'allow_responsive'        => true,
                'allow_empty_line_height' => true,
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
