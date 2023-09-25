<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Typography
Templaza_API::set_section('templaza_style',
    array(
        'title'  => __( 'Typography', 'templaza-framework' ),
        'id'     => 'typographies',
        'desc'   => __( 'These settings control the typography', 'templaza-framework' ),
        'icon'   => 'el el-font',
        'fields' => array(
        )
    )
);

// -> START Body Typography
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Body Typography', 'templaza-framework' ),
        'id'         => 'typography-bodies',
        'desc'       => __( 'These settings control the typography for all body text.', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'typography-body',
                'type'     => 'select',
                'title'    => __( 'Typography Properties', 'templaza-framework' ),
                'subtitle' => __( 'Choose typography properties for this section. If <code>Default</code> selected then properties will inherit from CSS code.', 'templaza-framework' ),
                'options'  => array(
                    'default'     => __('Default', 'templaza-framework'),
                    'custom'      => __('Custom', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'                      => 'typography-body-option',
                'type'                    => 'typography',
                'title'                   => __( 'Body Font', 'templaza-framework' ),
                'subtitle'                => __( 'Specify the body font properties.', 'templaza-framework' ),
                'required'                => array('typography-body', '!=', 'default'),
                'color'                   => false,
                'text-align'              => false,
                'preview'                 => true, // Disable the previewer
                'word-spacing'            => false,
                'letter-spacing'          => true,
                'text-transform'          => true,
                'font-backup'             => true,
                'allow_responsive'        => true,
                'allow_empty_line_height' => true,
                'google'                  => true,
                'units'                   => array(
                    'font-size'   => array(''),
                    'line-height' => array(''),
                    'letter-spacing' => array(''),
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
                'select2'       => array( 'allowClear' => true ),
            ),
        )
    )
);

require_once 'typographies/heading.php';
require_once 'typographies/menu.php';
require_once 'typographies/footer.php';
require_once 'typographies/archive.php';
