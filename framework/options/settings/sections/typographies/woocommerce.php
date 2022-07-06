<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START WooCommerce Typography
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'WooCommerce Typography', $this -> text_domain ),
        'id'         => 'typography-woocommerce',
        'desc'       => __( 'These settings control the typography for WooCommerce.', $this -> text_domain ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'        => 'typography-woo-catalog-title',
                'type'      => 'typography',
                'title'     => __( 'Catalog Title', $this -> text_domain ),
                'subtitle'  => __( 'Font for title catalog page.', $this -> text_domain ),
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
                'title'     => __( 'Single title', $this -> text_domain ),
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
