<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

Templaza_API::set_section('__templaza_style', array(
    'id'         => 'settings',
    'title'     => esc_html__('Settings',$this -> text_domain),
    'desc'      => esc_html__('General theme options',$this -> text_domain),
    'icon'      => 'el-icon-home',
    'fields'    => array(
    ),
));

// Post type is templaza_style
require_once 'templaza_style/templaza_style.php';