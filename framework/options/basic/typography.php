<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Typography
$this -> sections[]	= array(
    'title'  => __( 'Typography', $this -> text_domain ),
    'id'     => 'typographies',
    'desc'   => __( 'These settings control the typography', $this -> text_domain ),
    'icon'   => 'el el-font',
    'fields' => array(        
    )
);

// -> START Body Typography
$this -> sections[] = array(
    'title'      => __( 'Body Typography', $this -> text_domain ),
    'id'         => 'typography-bodies',
    'desc'       => __( 'These settings control the typography for all body text.', $this -> text_domain ),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'typography-body',
            'type'     => 'switch',
            'title'    => __( 'Typography Properties', $this -> text_domain ),
            'subtitle' => __( 'Choose typography properties for this section. If <code>Default</code> selected then properties will inherit from CSS code.', $this -> text_domain ),
            'default'  => true,
            'on'       => __('Default', $this -> text_domain),
            'off'      => __('Custom', $this -> text_domain),
        ),
        array(
            'id'        => 'typography-body-option',
            'type'      => 'typography',
            'title'     => __( 'Body Font', $this -> text_domain ),
            'subtitle'  => __( 'Specify the body font properties.', $this -> text_domain ),
            'required'  => array('typography-body', '=', '0'),
            'color'          => false,
            'text-align'     => false,
            'preview'        => true, // Disable the previewer
            'word-spacing'   => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'font-backup'    => true,
            'default'        => array(
                'color'          => '#000',
                'font-weight'    => '400',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'font-backup'    => 'Arial, Helvetica, sans-serif',
            ),
        ),
    )
);

// -> START Menu
$this -> sections[] = array(
    'title'      => __( 'Menu Typography', $this -> text_domain ),
    'id'         => 'typography-menus',
    'desc'       => __( 'These settings control the typography for menu.', $this -> text_domain ),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'typography-menu',
            'type'     => 'switch',
            'title'    => __( 'Typography Properties', $this -> text_domain ),
            'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
            'default'  => true,
            'on'       => __('Inherit', $this -> text_domain),
            'off'      => __('Custom', $this -> text_domain),
        ),
        array(
            'id'             => 'typography-menu-option',
            'type'           => 'typography',
            'title'          => __( 'Menu Font', $this -> text_domain ),
            'subtitle'       => __( 'Specify the menu font properties.', $this -> text_domain ),
            'required'       => array('typography-menu', '=', '0'),
            'color'          => false,
            'text-align'     => false,
            'preview'        => true, // Disable the previewer
            'word-spacing'   => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'font-backup'    => true,
            'default'        => array(
                'color'          => '#000',
                'font-weight'    => '400',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'font-backup'    => 'Arial, Helvetica, sans-serif',
            ),
        ),
    )
);

// -> START Drop Down Menu
$this -> sections[] = array(
    'title'      => __( 'Drop Down Menu Typography', $this -> text_domain ),
    'id'         => 'typography-submenus',
    'desc'       => __( 'These settings control the typography for submenu.', $this -> text_domain ),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'typography-submenu',
            'type'     => 'switch',
            'title'    => __( 'Typography Properties', $this -> text_domain ),
            'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
            'default'  => true,
            'on'       => __('Inherit', $this -> text_domain),
            'off'      => __('Custom', $this -> text_domain),
        ),
        array(
            'id'        => 'typography-submenu-option',
            'type'      => 'typography',
            'title'     => __( 'Dropdown Menu Font', $this -> text_domain ),
            'subtitle'  => __( 'Specify the dropdown menu font properties.', $this -> text_domain ),
            'required'  => array('typography-submenu', '=', '0'),
            'color'          => false,
            'text-align'     => false,
            'preview'        => true, // Disable the previewer
            'word-spacing'   => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'font-backup'    => true,
            'default'        => array(
                'color'          => '#000',
                'font-weight'    => '400',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'font-backup'    => 'Arial, Helvetica, sans-serif',
            ),
        ),
    )
);

// -> START H1
$this -> sections[] = array(
    'title'      => __( 'H1 Typography', $this -> text_domain ),
    'id'         => 'typography-h1s',
    'desc'       => __( 'These settings control the typography for submenu.', $this -> text_domain ),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'typography-h1',
            'type'     => 'switch',
            'title'    => __( 'Typography Properties', $this -> text_domain ),
            'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
            'default'  => true,
            'on'       => __('Inherit', $this -> text_domain),
            'off'      => __('Custom', $this -> text_domain),
        ),
        array(
            'id'        => 'typography-h1-option',
            'type'      => 'typography',
            'title'     => __( 'H1 Font', $this -> text_domain ),
            'subtitle'  => __( 'Specify the h1 font properties.', $this -> text_domain ),
            'required'  => array('typography-h1', '=', '0'),
            'color'          => true,
            'text-align'     => false,
            'preview'        => true, // Disable the previewer
            'word-spacing'   => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'font-backup'    => true,
            'default'        => array(
                'color'          => '#000',
                'font-weight'    => '700',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'font-backup'    => 'Arial, Helvetica, sans-serif',
            ),
        ),
    )
);

// -> START H2
$this -> sections[] = array(
    'title'      => __( 'H2 Typography', $this -> text_domain ),
    'id'         => 'typography-h2s',
    'desc'       => __( 'These settings control the typography for submenu.', $this -> text_domain ),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'typography-h2',
            'type'     => 'switch',
            'title'    => __( 'Typography Properties', $this -> text_domain ),
            'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
            'default'  => true,
            'on'       => __('Inherit', $this -> text_domain),
            'off'      => __('Custom', $this -> text_domain),
        ),
        array(
            'id'        => 'typography-h2-option',
            'type'      => 'typography',
            'title'     => __( 'H2 Font', $this -> text_domain ),
            'subtitle'  => __( 'Specify the h2 font properties.', $this -> text_domain ),
            'required'  => array('typography-h2', '=', '0'),
            'color'          => true,
            'text-align'     => false,
            'preview'        => true, // Disable the previewer
            'word-spacing'   => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'font-backup'    => true,
            'default'        => array(
                'color'          => '#000',
                'font-weight'    => '600',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'font-backup'    => 'Arial, Helvetica, sans-serif',
            ),
        ),
    )
);

// -> START H3
$this -> sections[] = array(
    'title'      => __( 'H3 Typography', $this -> text_domain ),
    'id'         => 'typography-h3s',
    'desc'       => __( 'These settings control the typography for submenu.', $this -> text_domain ),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'typography-h3',
            'type'     => 'switch',
            'title'    => __( 'Typography Properties', $this -> text_domain ),
            'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
            'default'  => true,
            'on'       => __('Inherit', $this -> text_domain),
            'off'      => __('Custom', $this -> text_domain),
        ),
        array(
            'id'        => 'typography-h3-option',
            'type'      => 'typography',
            'title'     => __( 'H3 Font', $this -> text_domain ),
            'subtitle'  => __( 'Specify the h3 font properties.', $this -> text_domain ),
            'required'  => array('typography-h3', '=', '0'),
            'color'          => true,
            'text-align'     => false,
            'preview'        => true, // Disable the previewer
            'word-spacing'   => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'font-backup'    => true,
            'default'        => array(
                'color'          => '#000',
                'font-weight'    => '500',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'font-backup'    => 'Arial, Helvetica, sans-serif',
            ),
        ),
    )
);

// -> START H4
$this -> sections[] = array(
    'title'      => __( 'H4 Typography', $this -> text_domain ),
    'id'         => 'typography-h4s',
    'desc'       => __( 'These settings control the typography for submenu.', $this -> text_domain ),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'typography-h4',
            'type'     => 'switch',
            'title'    => __( 'Typography Properties', $this -> text_domain ),
            'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
            'default'  => true,
            'on'       => __('Inherit', $this -> text_domain),
            'off'      => __('Custom', $this -> text_domain),
        ),
        array(
            'id'        => 'typography-h4-option',
            'type'      => 'typography',
            'title'     => __( 'H4 Font', $this -> text_domain ),
            'subtitle'  => __( 'Specify the h4 font properties.', $this -> text_domain ),
            'required'  => array('typography-h4', '=', '0'),
            'color'          => true,
            'text-align'     => false,
            'preview'        => true, // Disable the previewer
            'word-spacing'   => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'font-backup'    => true,
            'default'        => array(
                'color'          => '#000',
                'font-weight'    => '500',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'font-backup'    => 'Arial, Helvetica, sans-serif',
            ),
        ),
    )
);

// -> START H5
$this -> sections[] = array(
    'title'      => __( 'H5 Typography', $this -> text_domain ),
    'id'         => 'typography-h5s',
    'desc'       => __( 'These settings control the typography for submenu.', $this -> text_domain ),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'typography-h5',
            'type'     => 'switch',
            'title'    => __( 'Typography Properties', $this -> text_domain ),
            'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
            'default'  => true,
            'on'       => __('Inherit', $this -> text_domain),
            'off'      => __('Custom', $this -> text_domain),
        ),
        array(
            'id'        => 'typography-h5-option',
            'type'      => 'typography',
            'title'     => __( 'H5 Font', $this -> text_domain ),
            'subtitle'  => __( 'Specify the h5 font properties.', $this -> text_domain ),
            'required'  => array('typography-h5', '=', '0'),
            'color'          => true,
            'text-align'     => false,
            'preview'        => true, // Disable the previewer
            'word-spacing'   => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'font-backup'    => true,
            'default'        => array(
                'color'          => '#000',
                'font-weight'    => '500',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'font-backup'    => 'Arial, Helvetica, sans-serif',
            ),
        ),
    )
);

// -> START H6
$this -> sections[] = array(
    'title'      => __( 'H6 Typography', $this -> text_domain ),
    'id'         => 'typography-h6s',
    'desc'       => __( 'These settings control the typography for submenu.', $this -> text_domain ),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'typography-h6',
            'type'     => 'switch',
            'title'    => __( 'Typography Properties', $this -> text_domain ),
            'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
            'default'  => true,
            'on'       => __('Inherit', $this -> text_domain),
            'off'      => __('Custom', $this -> text_domain),
        ),
        array(
            'id'        => 'typography-h6-option',
            'type'      => 'typography',
            'title'     => __( 'H6 Font', $this -> text_domain ),
            'subtitle'  => __( 'Specify the h6 font properties.', $this -> text_domain ),
            'required'  => array('typography-h6', '=', '0'),
            'color'          => true,
            'text-align'     => false,
            'preview'        => true, // Disable the previewer
            'word-spacing'   => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'font-backup'    => true,
            'default'        => array(
                'color'          => '#000',
                'font-weight'    => '500',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'font-backup'    => 'Arial, Helvetica, sans-serif',
            ),
        ),
    )
);

// -> START Top Bar
$this -> sections[] = array(
    'title'      => __( 'Top Bar', $this -> text_domain ),
    'id'         => 'typography-top-bars',
    'desc'       => __( 'These settings control the typography for top bar section.', $this -> text_domain ),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'typography-top-bar',
            'type'     => 'switch',
            'title'    => __( 'Typography Properties', $this -> text_domain ),
            'subtitle' => __( ' Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
            'default'  => true,
            'on'       => __('Inherit', $this -> text_domain),
            'off'      => __('Custom', $this -> text_domain),
        ),
        array(
            'id'        => 'typography-top-bar-option',
            'type'      => 'typography',
            'title'     => __( 'Top Bar Font', $this -> text_domain ),
            'subtitle'  => __( 'Specify the top bar font properties.', $this -> text_domain ),
            'required'  => array('typography-top-bar', '=', '0'),
            'color'          => true,
            'text-align'     => false,
            'preview'        => true, // Disable the previewer
            'font-backup'    => true,
            'word-spacing'   => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'default'        => array(
                'color'          => '#000',
                'font-weight'    => '500',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'font-backup'    => 'Arial, Helvetica, sans-serif',
            ),
        ),
    )
);

// -> START Footer
$this -> sections[] = array(
    'title'      => __( 'Footer Typography', $this -> text_domain ),
    'id'         => 'typography-footers',
    'desc'       => __( 'These settings control the typography for Footer.', $this -> text_domain ),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'typography-footer',
            'type'     => 'switch',
            'title'    => __( 'Typography Properties', $this -> text_domain ),
            'subtitle' => __( 'Choose typography properties for this section. If <code>inherit</code> selected then property will inherit its value from body typography properties.', $this -> text_domain ),
            'default'  => true,
            'on'       => __('Inherit', $this -> text_domain),
            'off'      => __('Custom', $this -> text_domain),
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
            'default'        => array(
                'color'          => '#000',
                'font-weight'    => '400',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'font-backup'    => 'Arial, Helvetica, sans-serif',
            ),
        ),
    )
);
