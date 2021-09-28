<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Layout
Templaza_API::set_section('templaza_style',
    array(
        'title'  => __( 'Layout', $this -> text_domain ),
        'id'     => 'section-layouts',
        'desc'   => __( 'These settings control the layout', $this -> text_domain ),
        'icon'   => 'el el-website',
        'fields'     => array(
            array(
                'id'       => 'layout',
                'type'     => 'tz_layout',
                'title'    => 'Layout',
                'allow_copy'    => true,
                'class'    => 'field-tz_layout-content',
            ),
        ),
    )
);
