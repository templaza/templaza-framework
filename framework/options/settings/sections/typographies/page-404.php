<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Footer
Templaza_API::set_section('settings',
    array(
        'title'      => __( '404 Typography', $this -> text_domain ),
        'id'         => 'typography-404',
        'desc'       => __( 'These settings control the typography for 404 page.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'        => 'typography-404-heading',
                'type'      => 'typography',
                'title'     => __( '404 Heading H1', $this -> text_domain ),
                'subtitle'  => __( 'Specify the 404 heading font properties.', $this -> text_domain ),
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
                'id'        => 'typography-404-content',
                'type'      => 'typography',
                'title'     => __( '404 Content', $this -> text_domain ),
                'subtitle'  => __( 'Specify the 404 content font properties.', $this -> text_domain ),
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
