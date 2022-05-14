<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Post_TypeFunctions;

// Global configs of post ty
Templaza_API::set_section('settings', array(
    'id'         => 'settings',
    'title'     => esc_html__('Settings',$this -> text_domain),
    'desc'      => esc_html__('General theme options',$this -> text_domain),
    'icon'      => 'el-icon-home',
    'fields'    => array(
        array(
            'id'       => 'dev-mode',
            'type'     => 'switch',
            'title'    => __('Developer mode', $this -> text_domain),
            'default'   => '0',
        ),
        array(
            'id'       => '404-page-style',
            'type'     => 'select',
            'title'    => __('404 Page Style', $this -> text_domain),
            'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
            'data'     => 'callback',
            'args'     => array('TemPlazaFramework\Functions', 'get_templaza_style_by_slug'),
        )
    ),
));

$tzfrm_post_types  = Post_TypeFunctions::getPostTypes();
if(count($tzfrm_post_types)){
    foreach ($tzfrm_post_types as $tzfrm_post_type){
        $tzfrm_post_type_obj  = get_post_type_object($tzfrm_post_type);
        $tzfrm_subsection   = array(
            'id'    => $tzfrm_post_type.'-subsections',
            'title' => sprintf(__('%s Options', $this -> text_domain),$tzfrm_post_type_obj -> label),
            'subsection' => true,
            'fields'     => array(
                array(
                    'id'    => $tzfrm_post_type.'-archive-style',
                    'type'  => 'select',
                    'title' => sprintf(__('%s Archive Style', $this -> text_domain), $tzfrm_post_type_obj -> label),
                    'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
                    'data'     => 'callback',
                    'args'     => array('TemPlazaFramework\Functions', 'get_templaza_style_by_slug'),
                ),
                array(
                    'id'    => $tzfrm_post_type.'-single-style',
                    'type'  => 'select',
                    'title' => sprintf(__('%s Single Style', $this -> text_domain), $tzfrm_post_type_obj -> label),
                    'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
                    'data'     => 'callback',
                    'args'     => array('TemPlazaFramework\Functions', 'get_templaza_style_by_slug'),
                )
            )
        );
        Templaza_API::set_section('settings', $tzfrm_subsection);
    }
}

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