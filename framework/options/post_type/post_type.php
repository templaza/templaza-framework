<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

Templaza_API::set_section('__templaza_style', array(
    'id'         => 'settings',
    'title'     => esc_html__('Settings','templaza-framework'),
    'desc'      => esc_html__('General theme options','templaza-framework'),
    'icon'      => 'el-icon-home',
    'fields'    => array(
    ),
));

// Post type is templaza_style
require_once 'templaza_style/templaza_style.php';
// Post type is templaza_header
require_once 'templaza_header/templaza_header.php';
// Post type is templaza_footer
require_once 'templaza_footer/templaza_footer.php';