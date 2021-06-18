<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Typography
Templaza_API::set_section('settings',
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
Templaza_API::set_section('settings',
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
                'google'                  => true,
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

require_once 'typographies/heading.php';
require_once 'typographies/menu.php';
require_once 'typographies/sidebar.php';
require_once 'typographies/footer.php';
require_once 'typographies/archive.php';
require_once 'typographies/single.php';