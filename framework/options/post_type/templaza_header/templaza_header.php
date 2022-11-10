<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

require_once 'sections/header.php';
// -> START Layout
Templaza_API::set_section('templaza_header',
    array(
        'title'  => __( 'Layout', 'templaza-framework' ),
        'id'     => 'section-layouts',
        'desc'   => __( 'These settings control the layout', 'templaza-framework' ),
        'icon'   => 'el el-website',
        'fields'     => array(
            array(
                'id'       => 'h_layout',
                'type'     => 'tz_layout',
//                'title'    => 'Layout',
                'allow_copy'    => true,
                'class'    => 'field-tz_layout-content',
            ),
        ),
    )
);