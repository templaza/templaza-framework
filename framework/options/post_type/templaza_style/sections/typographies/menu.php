<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Menu
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Menu Typography', 'templaza-framework' ),
        'id'         => 'typography-menus',
        'desc'       => __( 'These settings control the typography for menu.', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'typography-menu',
                'type'     => 'select',
                'title'    => __( 'Typography Properties', 'templaza-framework' ),
                'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', 'templaza-framework' ),
                'options'  => array(
                    'default'       => __('Default', 'templaza-framework'),
                    'custom'      => __('Custom', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'                      => 'typography-menu-option',
                'type'                    => 'typography',
                'title'                   => __( 'Menu Font', 'templaza-framework' ),
                'subtitle'                => __( 'Specify the menu font properties.', 'templaza-framework' ),
                'required'                => array('typography-menu', '!=', 'default'),
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
            ),
        )
    )
);

// -> START Drop Down Menu
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Drop Down Menu Typography', 'templaza-framework' ),
        'id'         => 'typography-submenus',
        'desc'       => __( 'These settings control the typography for submenu.', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'typography-submenu',
                'type'     => 'select',
                'title'    => __( 'Typography Properties', 'templaza-framework' ),
                'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', 'templaza-framework' ),
                'options'  => array(
                    'default'       => __('Default', 'templaza-framework'),
                    'custom'      => __('Custom', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'                      => 'typography-submenu-option',
                'type'                    => 'typography',
                'title'                   => __( 'Dropdown Menu Font', 'templaza-framework' ),
                'subtitle'                => __( 'Specify the dropdown menu font properties.', 'templaza-framework' ),
                'required'                => array('typography-submenu', '!=', 'default'),
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