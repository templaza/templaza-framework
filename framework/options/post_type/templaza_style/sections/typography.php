<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Typography
Templaza_API::set_section('templaza_style',
    array(
        'title'  => __( 'Typography', $this -> text_domain ),
        'id'     => 'typographies',
        'desc'   => __( 'These settings control the typography', $this -> text_domain ),
        'icon'   => 'el el-font',
        'fields' => array(
        )
    )
);

// -> START Body Typography
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Body Typography', $this -> text_domain ),
        'id'         => 'typography-bodies',
        'desc'       => __( 'These settings control the typography for all body text.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'typography-body',
                'type'     => 'button_set',
                'title'    => __( 'Typography Properties', $this -> text_domain ),
                'subtitle' => __( 'Choose typography properties for this section. If <code>Default</code> selected then properties will inherit from CSS code.', $this -> text_domain ),
                'options'  => array(
                    'default'     => __('Default', $this -> text_domain),
                    'custom'      => __('Custom', $this -> text_domain),
                ),
                'default'  => 'default',
            ),
            array(
                'id'                      => 'typography-body-option',
                'type'                    => 'typography',
                'title'                   => __( 'Body Font', $this -> text_domain ),
                'subtitle'                => __( 'Specify the body font properties.', $this -> text_domain ),
                'required'                => array('typography-body', '=', 'custom'),
                'color'                   => false,
                'text-align'              => false,
                'preview'                 => true, // Disable the previewer
                'word-spacing'            => false,
                'letter-spacing'          => true,
                'text-transform'          => true,
                'font-backup'             => true,
                'allow_responsive'        => true,
                'allow_empty_line_height' => true,
                'units'                   => array(
                    'font-size'   => 'px',
                    'line-height' => 'em',
                ),
                'default'        => array(
                    'color'          => '#000',
                    'font-weight'    => '400',
                    'letter-spacing' => '0',
                    'text-transform' => 'none',
                    'font-family'    => 'Nunito',
                    'font-backup'    => 'Arial, Helvetica, sans-serif',
                ),
            ),
        )
    )
);

// -> START Menu
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Menu Typography', $this -> text_domain ),
        'id'         => 'typography-menus',
        'desc'       => __( 'These settings control the typography for menu.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'typography-menu',
                'type'     => 'button_set',
                'title'    => __( 'Typography Properties', $this -> text_domain ),
                'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
                'options'  => array(
                    'default'       => __('Default', $this -> text_domain),
                    'custom'      => __('Custom', $this -> text_domain),
                ),
                'default'  => 'default',
            ),
            array(
                'id'                      => 'typography-menu-option',
                'type'                    => 'typography',
                'title'                   => __( 'Menu Font', $this -> text_domain ),
                'subtitle'                => __( 'Specify the menu font properties.', $this -> text_domain ),
                'required'                => array('typography-menu', '=', 'custom'),
                'color'                   => false,
                'text-align'              => false,
                'preview'                 => true, // Disable the previewer
                'word-spacing'            => false,
                'letter-spacing'          => true,
                'text-transform'          => true,
                'font-backup'             => true,
                'allow_responsive'        => true,
                'allow_empty_line_height' => true,
                'units'                   => array(
                    'font-size'   => 'px',
                    'line-height' => 'em',
                ),
                'default'                 => array(
                    'color'          => '#000',
                    'font-weight'    => '400',
                    'letter-spacing' => '0',
                    'text-transform' => 'none',
                    'font-family'    => 'Nunito',
                    'font-backup'    => 'Arial, Helvetica, sans-serif',
                ),
            ),
        )
    )
);

// -> START Drop Down Menu
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Drop Down Menu Typography', $this -> text_domain ),
        'id'         => 'typography-submenus',
        'desc'       => __( 'These settings control the typography for submenu.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'typography-submenu',
                'type'     => 'button_set',
                'title'    => __( 'Typography Properties', $this -> text_domain ),
                'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
                'options'  => array(
                    'default'       => __('Default', $this -> text_domain),
                    'custom'      => __('Custom', $this -> text_domain),
                ),
                'default'  => 'default',
            ),
            array(
                'id'                      => 'typography-submenu-option',
                'type'                    => 'typography',
                'title'                   => __( 'Dropdown Menu Font', $this -> text_domain ),
                'subtitle'                => __( 'Specify the dropdown menu font properties.', $this -> text_domain ),
                'required'                => array('typography-submenu', '=', 'custom'),
                'color'                   => false,
                'text-align'              => false,
                'preview'                 => true, // Disable the previewer
                'word-spacing'            => false,
                'letter-spacing'          => true,
                'text-transform'          => true,
                'font-backup'             => true,
                'allow_responsive'        => true,
                'allow_empty_line_height' => true,
                'units'                   => array(
                    'font-size'   => 'px',
                    'line-height' => 'em',
                ),
                'default'                  => array(
                    'color'          => '#000',
                    'font-weight'    => '400',
                    'letter-spacing' => '0',
                    'text-transform' => 'none',
                    'font-backup'    => 'Arial, Helvetica, sans-serif',
                ),
            ),
        )
    )
);

// -> START H1
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'H1 Typography', $this -> text_domain ),
        'id'         => 'typography-h1s',
        'desc'       => __( 'These settings control the typography for submenu.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'typography-h1',
                'type'     => 'button_set',
                'title'    => __( 'Typography Properties', $this -> text_domain ),
                'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
                'options'  => array(
                    'default'       => __('Default', $this -> text_domain),
                    'custom'      => __('Custom', $this -> text_domain),
                ),
                'default'  => 'default',
            ),
            array(
                'id'                      => 'typography-h1-option',
                'type'                    => 'typography',
                'title'                   => __( 'H1 Font', $this -> text_domain ),
                'subtitle'                => __( 'Specify the h1 font properties.', $this -> text_domain ),
                'required'                => array('typography-h1', '=', 'custom'),
                'color'                   => true,
                'text-align'              => false,
                'preview'                 => true, // Disable the previewer
                'word-spacing'            => false,
                'letter-spacing'          => true,
                'text-transform'          => true,
                'font-backup'             => true,
                'allow_responsive'        => true,
                'allow_empty_line_height' => true,
                'units'                   => array(
                    'font-size'   => 'px',
                    'line-height' => 'em',
                ),
                'default'                 => array(
                    'color'          => '#000',
                    'font-weight'    => '700',
                    'letter-spacing' => '0',
                    'text-transform' => 'none',
                    'font-family'    => 'Arial, Helvetica, sans-serif',
                    'font-backup'    => 'Arial, Helvetica, sans-serif',
                ),
            ),
        )
    )
);

// -> START H2
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'H2 Typography', $this -> text_domain ),
        'id'         => 'typography-h2s',
        'desc'       => __( 'These settings control the typography for submenu.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'typography-h2',
                'type'     => 'button_set',
                'title'    => __( 'Typography Properties', $this -> text_domain ),
                'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
                'options'  => array(
                    'default'       => __('Default', $this -> text_domain),
                    'custom'      => __('Custom', $this -> text_domain),
                ),
                'default'  => 'default',
            ),
            array(
                'id'        => 'typography-h2-option',
                'type'      => 'typography',
                'title'     => __( 'H2 Font', $this -> text_domain ),
                'subtitle'  => __( 'Specify the h2 font properties.', $this -> text_domain ),
                'required'  => array('typography-h2', '=', 'custom'),
                'color'          => true,
                'text-align'     => false,
                'preview'        => true, // Disable the previewer
                'word-spacing'   => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'font-backup'    => true,
                'allow_responsive'        => true,
                'allow_empty_line_height' => true,
                'units'                   => array(
                    'font-size'   => 'px',
                    'line-height' => 'em',
                ),
                'default'        => array(
                    'color'          => '#000',
                    'font-weight'    => '600',
                    'letter-spacing' => '0',
                    'text-transform' => 'none',
                    'font-family'    => 'Arial, Helvetica, sans-serif',
                    'font-backup'    => 'Arial, Helvetica, sans-serif',
                ),
            ),
        )
    )
);

// -> START H3
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'H3 Typography', $this -> text_domain ),
        'id'         => 'typography-h3s',
        'desc'       => __( 'These settings control the typography for submenu.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'typography-h3',
                'type'     => 'button_set',
                'title'    => __( 'Typography Properties', $this -> text_domain ),
                'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
                'options'  => array(
                    'default'       => __('Default', $this -> text_domain),
                    'custom'      => __('Custom', $this -> text_domain),
                ),
                'default'  => 'default',
            ),
            array(
                'id'        => 'typography-h3-option',
                'type'      => 'typography',
                'title'     => __( 'H3 Font', $this -> text_domain ),
                'subtitle'  => __( 'Specify the h3 font properties.', $this -> text_domain ),
                'required'  => array('typography-h3', '=', 'custom'),
                'color'          => true,
                'text-align'     => false,
                'preview'        => true, // Disable the previewer
                'word-spacing'   => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'font-backup'    => true,
                'allow_responsive'        => true,
                'allow_empty_line_height' => true,
                'units'                   => array(
                    'font-size'   => 'px',
                    'line-height' => 'em',
                ),
                'default'        => array(
                    'color'          => '#000',
                    'font-weight'    => '500',
                    'letter-spacing' => '0',
                    'text-transform' => 'none',
                    'font-family'    => 'Arial, Helvetica, sans-serif',
                    'font-backup'    => 'Arial, Helvetica, sans-serif',
                ),
            ),
        )
    )
);

// -> START H4
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'H4 Typography', $this -> text_domain ),
        'id'         => 'typography-h4s',
        'desc'       => __( 'These settings control the typography for submenu.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'typography-h4',
                'type'     => 'button_set',
                'title'    => __( 'Typography Properties', $this -> text_domain ),
                'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
                'options'  => array(
                    'default'       => __('Default', $this -> text_domain),
                    'custom'      => __('Custom', $this -> text_domain),
                ),
                'default'  => 'default',
            ),
            array(
                'id'        => 'typography-h4-option',
                'type'      => 'typography',
                'title'     => __( 'H4 Font', $this -> text_domain ),
                'subtitle'  => __( 'Specify the h4 font properties.', $this -> text_domain ),
                'required'  => array('typography-h4', '=', 'custom'),
                'color'          => true,
                'text-align'     => false,
                'preview'        => true, // Disable the previewer
                'word-spacing'   => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'font-backup'    => true,
                'allow_responsive'        => true,
                'allow_empty_line_height' => true,
                'units'                   => array(
                    'font-size'   => 'px',
                    'line-height' => 'em',
                ),
                'default'        => array(
                    'color'          => '#000',
                    'font-weight'    => '500',
                    'letter-spacing' => '0',
                    'text-transform' => 'none',
                    'font-family'    => 'Arial, Helvetica, sans-serif',
                    'font-backup'    => 'Arial, Helvetica, sans-serif',
                ),
            ),
        )
    )
);

// -> START H5
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'H5 Typography', $this -> text_domain ),
        'id'         => 'typography-h5s',
        'desc'       => __( 'These settings control the typography for submenu.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'typography-h5',
                'type'     => 'button_set',
                'title'    => __( 'Typography Properties', $this -> text_domain ),
                'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
                'options'  => array(
                    'default'       => __('Default', $this -> text_domain),
                    'custom'      => __('Custom', $this -> text_domain),
                ),
                'default'  => 'default',
            ),
            array(
                'id'        => 'typography-h5-option',
                'type'      => 'typography',
                'title'     => __( 'H5 Font', $this -> text_domain ),
                'subtitle'  => __( 'Specify the h5 font properties.', $this -> text_domain ),
                'required'  => array('typography-h5', '=', 'custom'),
                'color'          => true,
                'text-align'     => false,
                'preview'        => true, // Disable the previewer
                'word-spacing'   => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'font-backup'    => true,
                'allow_responsive'        => true,
                'allow_empty_line_height' => true,
                'units'                   => array(
                    'font-size'   => 'px',
                    'line-height' => 'em',
                ),
                'default'        => array(
                    'color'          => '#000',
                    'font-weight'    => '500',
                    'letter-spacing' => '0',
                    'text-transform' => 'none',
                    'font-family'    => 'Arial, Helvetica, sans-serif',
                    'font-backup'    => 'Arial, Helvetica, sans-serif',
                ),
            ),
        )
    )
);

// -> START H6
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'H6 Typography', $this -> text_domain ),
        'id'         => 'typography-h6s',
        'desc'       => __( 'These settings control the typography for submenu.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'typography-h6',
                'type'     => 'button_set',
                'title'    => __( 'Typography Properties', $this -> text_domain ),
                'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
                'options'  => array(
                    'default'       => __('Default', $this -> text_domain),
                    'custom'      => __('Custom', $this -> text_domain),
                ),
                'default'  => 'default',
            ),
            array(
                'id'        => 'typography-h6-option',
                'type'      => 'typography',
                'title'     => __( 'H6 Font', $this -> text_domain ),
                'subtitle'  => __( 'Specify the h6 font properties.', $this -> text_domain ),
                'required'  => array('typography-h6', '=', 'custom'),
                'color'          => true,
                'text-align'     => false,
                'preview'        => true, // Disable the previewer
                'word-spacing'   => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'font-backup'    => true,
                'allow_responsive'        => true,
                'allow_empty_line_height' => true,
                'units'                   => array(
                    'font-size'   => 'px',
                    'line-height' => 'em',
                ),
                'default'        => array(
                    'color'          => '#000',
                    'font-weight'    => '500',
                    'letter-spacing' => '0',
                    'text-transform' => 'none',
                    'font-family'    => 'Arial, Helvetica, sans-serif',
                    'font-backup'    => 'Arial, Helvetica, sans-serif',
                ),
            ),
        )
    )
);

// -> START Top Bar
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Top Bar', $this -> text_domain ),
        'id'         => 'typography-top-bars',
        'desc'       => __( 'These settings control the typography for top bar section.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'typography-top-bar',
                'type'     => 'button_set',
                'title'    => __( 'Typography Properties', $this -> text_domain ),
                'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
                'options'  => array(
                    'default'       => __('Default', $this -> text_domain),
                    'custom'      => __('Custom', $this -> text_domain),
                ),
                'default'  => 'default',
            ),
            array(
                'id'        => 'typography-top-bar-option',
                'type'      => 'typography',
                'title'     => __( 'Top Bar Font', $this -> text_domain ),
                'subtitle'  => __( 'Specify the top bar font properties.', $this -> text_domain ),
                'required'  => array('typography-top-bar', '=', 'custom'),
                'color'          => true,
                'text-align'     => false,
                'preview'        => true, // Disable the previewer
                'font-backup'    => true,
                'word-spacing'   => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'allow_responsive'        => true,
                'allow_empty_line_height' => true,
                'units'                   => array(
                    'font-size'   => 'px',
                    'line-height' => 'em',
                ),
                'default'        => array(
                    'color'          => '#000',
                    'font-weight'    => '500',
                    'letter-spacing' => '0',
                    'text-transform' => 'none',
                    'font-family'    => 'Arial, Helvetica, sans-serif',
                    'font-backup'    => 'Arial, Helvetica, sans-serif',
                ),
            ),
        )
    )
);

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
                'title'     => __( 'Top Bar Font', $this -> text_domain ),
                'subtitle'  => __( 'Specify the top bar font properties.', $this -> text_domain ),
                'required'  => array('typography-footer', '=', '0'),
                'color'          => true,
                'text-align'     => false,
                'preview'        => true, // Disable the previewer
                'word-spacing'   => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'font-backup'    => true,
                'allow_responsive'        => true,
                'allow_empty_line_height' => true,
                'units'                   => array(
                    'font-size'   => 'px',
                    'line-height' => 'em',
                ),
                'default'        => array(
                    'color'          => '#000',
                    'font-weight'    => '400',
                    'letter-spacing' => '0',
                    'text-transform' => 'none',
                    'font-backup'    => 'Arial, Helvetica, sans-serif',
                ),
            ),
        )
    )
);
