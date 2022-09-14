<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Post_TypeFunctions;

// Global configs of post ty
Templaza_API::set_section('settings', array(
    'id'         => 'settings',
    'title'     => esc_html__('Settings','templaza-framework'),
    'desc'      => esc_html__('General theme options','templaza-framework'),
    'icon'      => 'el-icon-home',
    'fields'    => array(
        array(
            'id'       => 'dev-mode',
            'type'     => 'switch',
            'title'    => __('Developer mode', 'templaza-framework'),
            'default'   => '0',
        ),
        array(
            'id'       => '404-page-style',
            'type'     => 'select',
            'title'    => __('404 Page Style', 'templaza-framework'),
            'subtitle' => __('This template style will be defined as the global default template style.', 'templaza-framework'),
            'data'     => 'callback',
            'args'     => array('TemPlazaFramework\Functions', 'get_templaza_style_by_slug'),
        )
    ),
));

require_once 'sections/general.php';
//require_once 'sections/header.php';
require_once 'sections/menu.php';
require_once 'sections/typography.php';
require_once 'sections/color.php';
require_once 'sections/pages.php';
require_once 'sections/layout.php';
require_once 'sections/social.php';
require_once 'sections/miscellaneous.php';
require_once 'sections/custom.php';
require_once 'sections/woocommerce/product.php';
require_once 'sections/woocommerce/product-template-style.php';
require_once 'sections/advanced-product/ap_product.php';
