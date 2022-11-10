<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Footer
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Footer Typography', 'templaza-framework' ),
        'id'         => 'typography-footers',
        'desc'       => __( 'These settings control the typography for Footer.', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'typography-footer',
                'type'     => 'button_set',
                'title'    => __( 'Typography Properties', 'templaza-framework' ),
                'subtitle' => __( 'Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', 'templaza-framework' ),
                'options'  => array(
                    'default'       => __('Default', 'templaza-framework'),
                    'custom'      => __('Custom', 'templaza-framework'),
                ),
                'default'  => 'default',
            ),
            array(
                'id'        => 'typography-footer-option',
                'type'      => 'typography',
                'title'     => __( 'Footer', 'templaza-framework' ),
                'subtitle'  => __( 'Specify the footer font properties.', 'templaza-framework' ),
                'required'  => array('typography-footer', '=', 'custom'),
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
                    'font-size'   => 'px',
                    'line-height' => 'em',
                ),
                'default'        => array(
                    'color'          => '#ffffff',
                    'font-weight'    => '700',
                    'letter-spacing' => '0',
                    'text-transform' => 'none',
                    'font-backup'    => 'Arial, Helvetica, sans-serif',
                ),
            ),
            array(
                'id'        => 'typography-footer-widget-heading',
                'type'      => 'typography',
                'title'     => __( 'Footer Widget Heading', 'templaza-framework' ),
                'subtitle'  => __( 'Specify the footer widget heading font properties.', 'templaza-framework' ),
                'required'  => array('typography-footer', '=', 'custom'),
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
                    'font-size'   => 'px',
                    'line-height' => 'em',
                ),
                'default'        => array(
                    'color'          => '#ffffff',
                    'font-weight'    => '700',
                    'letter-spacing' => '0',
                    'text-transform' => 'none',
                    'font-backup'    => 'Arial, Helvetica, sans-serif',
                ),
            ),
            array(
                'id'        => 'typography-footer-widget-content',
                'type'      => 'typography',
                'title'     => __( 'Footer Widget Content', 'templaza-framework' ),
                'subtitle'  => __( 'Specify the footer widget content font properties.', 'templaza-framework' ),
                'required'  => array('typography-footer', '=', 'custom'),
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
                    'font-size'   => 'px',
                    'line-height' => 'em',
                ),
                'default'        => array(
                    'color'          => '#ffffff',
                    'font-weight'    => '400',
                    'letter-spacing' => '0',
                    'text-transform' => 'none',
                    'font-backup'    => 'Arial, Helvetica, sans-serif',
                ),
            ),
        )
    )
);
