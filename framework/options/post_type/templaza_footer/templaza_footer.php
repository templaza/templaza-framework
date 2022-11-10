<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Layout
Templaza_API::set_section('templaza_footer',
    array(
        'title'  => __( 'Layout', 'templaza-framework' ),
        'id'     => 'section-layouts',
        'desc'   => __( 'These settings control the layout', 'templaza-framework' ),
        'icon'   => 'el el-website',
        'fields'     => array(
            array(
                'id'       => 'f_layout',
                'type'     => 'tz_layout',
//                'title'    => 'Layout',
                'allow_copy'    => true,
                'class'    => 'field-tz_layout-content',
            ),
        ),
    )
);