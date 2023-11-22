<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Admin\Admin_Page_Function;

// -> START Typography
Templaza_API::set_section('settings',
    array(
        'title'  => __( 'Typography', 'templaza-framework' ),
        'id'     => 'typographies',
        'desc'   => __( 'These settings control the typography', 'templaza-framework' ),
        'icon'   => 'el el-font',
        'fields' => array(
        )
    )
);

// -> START Body Typography
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Body Typography', 'templaza-framework' ),
        'id'         => 'typography-bodies',
        'desc'       => __( 'These settings control the typography for all body text.', 'templaza-framework' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'typography-body',
                'type'     => 'button_set',
                'title'    => __( 'Typography Properties', 'templaza-framework' ),
                'subtitle' => __( 'Choose typography properties for this section. If <code>Default</code> selected then properties will inherit from CSS code.', 'templaza-framework' ),
                'options'  => array(
                    'default'     => __('Default', 'templaza-framework'),
                    'custom'      => __('Custom', 'templaza-framework'),
                ),
                'default'  => 'default',
            ),
            array(
                'id'                      => 'typography-body-option',
                'type'                    => 'typography',
                'title'                   => __( 'Body Font', 'templaza-framework' ),
                'subtitle'                => __( 'Specify the body font properties.', 'templaza-framework' ),
                'required'                => array('typography-body', '=', 'custom'),
                'weights'                => array('400', '700'),
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
                'multi_styles'            => true,
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
if(Admin_Page_Function::is_plugin_active('advanced-product')) {
    require_once 'typographies/advanced-product.php';
}

if(Admin_Page_Function::is_plugin_active('woocommerce')) {
    require_once 'typographies/woocommerce.php';
}
require_once 'typographies/page-404.php';