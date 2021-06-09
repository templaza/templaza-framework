<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Footer
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Footer Typography', $this -> text_domain ),
        'id'         => 'typography-footers',
        'desc'       => __( 'These settings control the typography for Footer.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'typography-footer',
                'type'     => 'button_set',
                'title'    => __( 'Typography Properties', $this -> text_domain ),
                'subtitle' => __( 'Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
                'options'  => array(
                    'default'       => __('Default', $this -> text_domain),
                    'custom'      => __('Custom', $this -> text_domain),
                ),
                'default'  => 'default',
            ),
            array(
                'id'        => 'typography-footer-option',
                'type'      => 'typography',
                'title'     => __( 'Footer', $this -> text_domain ),
                'subtitle'  => __( 'Specify the footer font properties.', $this -> text_domain ),
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
                'title'     => __( 'Footer Widget Heading', $this -> text_domain ),
                'subtitle'  => __( 'Specify the footer widget heading font properties.', $this -> text_domain ),
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
                'title'     => __( 'Footer Widget Content', $this -> text_domain ),
                'subtitle'  => __( 'Specify the footer widget content font properties.', $this -> text_domain ),
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
