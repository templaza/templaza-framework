<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Footer
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Advanced Product Typography', $this -> text_domain ),
        'id'         => 'typography-advanced-product',
        'desc'       => __( 'These settings control the typography for Advanced Product.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'        => 'typography-ap-group-title',
                'type'      => 'typography',
                'title'     => __( 'Group Field Title', $this -> text_domain ),
                'subtitle'  => __( 'Font for title custom field group.', $this -> text_domain ),
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
            ),
            array(
                'id'        => 'typography-ap-field-label',
                'type'      => 'typography',
                'title'     => __( 'Custom field label', $this -> text_domain ),
                'subtitle'  => __( 'Font for custom field label.', $this -> text_domain ),
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
            ),
        )
    )
);
