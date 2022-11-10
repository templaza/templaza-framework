<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Post type Section
Templaza_API::set_section('templaza_style', array(
        'title' => __( 'Blog Options', 'templaza-framework'),
        'id'    => 'blog-options',
        'desc'  => __( '', 'templaza-framework' ),
        'icon'  => 'el el-list-alt'
    )
);

require_once dirname(__DIR__).'/pages/blog.php';