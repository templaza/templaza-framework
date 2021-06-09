<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Post type Section
Templaza_API::set_section('templaza_style', array(
        'title' => __( 'Blog Options', $this -> text_domain),
        'id'    => 'blog-options',
        'desc'  => __( '', $this -> text_domain ),
        'icon'  => 'el el-list-alt'
    )
);

require_once dirname(__DIR__).'/pages/blog.php';