<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

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
                'google'                  => true,
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
                'google'                  => true,
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
                'google'                  => true,
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
                'google'                  => true,
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
                'google'                  => true,
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
                'google'                  => true,
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