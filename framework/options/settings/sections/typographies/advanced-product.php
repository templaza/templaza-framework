<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Advanced Product Typography
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Advanced Product Typography', $this -> text_domain ),
        'id'         => 'typography-advanced-product',
        'desc'       => __( 'These settings control the typography for Advanced Product.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'        => 'typography-ap-loop-title',
                'type'      => 'typography',
                'title'     => __( 'Loop Title', $this -> text_domain ),
                'subtitle'  => __( 'Font for Advanced Product loop title.', $this -> text_domain ),
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
                'id'        => 'typography-ap-loop-field-label',
                'type'      => 'typography',
                'title'     => __( 'Loop Custom Field Label', $this -> text_domain ),
                'subtitle'  => __( 'Font for Advanced Product loop custom field label.', $this -> text_domain ),
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
                'id'        => 'typography-ap-loop-field-value',
                'type'      => 'typography',
                'title'     => __( 'Loop Custom Field Value', $this -> text_domain ),
                'subtitle'  => __( 'Font for Advanced Product loop custom field value.', $this -> text_domain ),
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
                'id'        => 'typography-ap-group-title',
                'type'      => 'typography',
                'title'     => __( 'Single Group Field Title', $this -> text_domain ),
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
                'title'     => __( 'Single Custom field label', $this -> text_domain ),
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
            array(
                'id'        => 'typography-ap-field-value',
                'type'      => 'typography',
                'title'     => __( 'Single Custom field value', $this -> text_domain ),
                'subtitle'  => __( 'Font for custom field value.', $this -> text_domain ),
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
