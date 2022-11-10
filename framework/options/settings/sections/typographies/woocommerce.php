<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START WooCommerce Typography
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'WooCommerce Typography', 'templaza-framework' ),
        'id'         => 'typography-woocommerce',
        'desc'       => __( 'These settings control the typography for WooCommerce.', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'        => 'typography-woo-catalog-title',
                'type'      => 'typography',
                'title'     => __( 'Catalog Title', 'templaza-framework' ),
                'subtitle'  => __( 'Font for title catalog page.', 'templaza-framework' ),
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
                'id'        => 'typography-woo-single-title',
                'type'      => 'typography',
                'title'     => __( 'Single title', 'templaza-framework' ),
                'subtitle'  => __( 'Font for custom field label.', 'templaza-framework' ),
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
