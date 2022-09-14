<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Post_TypeFunctions;

// -> START Post Type Fields
require_once 'post_type/post_type.php';
require_once 'settings/settings.php';

//$tzfrm_field_args    = array(
//    'post_type'      => 'templaza_style',
//    'posts_per_page' => -1,
//    'orderby'        => 'title',
//    'order'          => 'ASC',
//    'meta_query' => array(
//        array(
//            'key'   => '_templaza_style_theme',
//            'value' => basename(get_template_directory()),
//            'compare'   => '='
//        )
//    )
//);

//// Global configs of post ty
//Templaza_API::set_section('settings', array(
//    'id'         => 'settings',
//    'title'     => esc_html__('Settings','templaza-framework'),
//    'desc'      => esc_html__('General theme options','templaza-framework'),
//    'icon'      => 'el-icon-home',
//    'fields'    => array(
//        array(
//            'id'       => '404-page-style',
//            'type'     => 'select',
////            'data'     => 'posts',
//            'title'    => __('404 Page Style', 'templaza-framework'),
//            'subtitle' => __('This template style will be defined as the global default template style.', 'templaza-framework'),
////            'args'     => $tzfrm_field_args,
//            'data'     => 'callback',
//            'args'     => array('TemPlazaFramework\Functions', 'get_templaza_style_by_slug'),
//        )
//    ),
//));
////Templaza_API::set_subsection('settings', 'settings', array(
////    'id'    => '404-pages-subsections',
////    'title' => __('404 Page'),
////
////));
//
//$tzfrm_post_types  = Post_TypeFunctions::getPostTypes();
//if(count($tzfrm_post_types)){
//    foreach ($tzfrm_post_types as $tzfrm_post_type){
//        $tzfrm_post_type_obj  = get_post_type_object($tzfrm_post_type);
//        $tzfrm_subsection   = array(
//            'id'    => $tzfrm_post_type.'-subsections',
//            'title' => sprintf(__('%s Options', 'templaza-framework'),$tzfrm_post_type_obj -> label),
//            'subsection' => true,
//            'fields'     => array(
//                array(
//                    'id'    => $tzfrm_post_type.'-archive-style',
//                    'type'  => 'select',
////                    'data' => 'posts',
//                    'title' => sprintf(__('%s Archive Style', 'templaza-framework'), $tzfrm_post_type_obj -> label),
//                    'subtitle' => __('This template style will be defined as the global default template style.', 'templaza-framework'),
////                    'args'  => $tzfrm_field_args,
//                    'data'     => 'callback',
//                    'args'     => array('TemPlazaFramework\Functions', 'get_templaza_style_by_slug'),
//                ),
//                array(
//                    'id'    => $tzfrm_post_type.'-single-style',
//                    'type'  => 'select',
////                    'data' => 'posts',
//                    'title' => sprintf(__('%s Single Style', 'templaza-framework'), $tzfrm_post_type_obj -> label),
//                    'subtitle' => __('This template style will be defined as the global default template style.', 'templaza-framework'),
////                    'args'  => $tzfrm_field_args,
//                    'data'     => 'callback',
//                    'args'     => array('TemPlazaFramework\Functions', 'get_templaza_style_by_slug'),
//                )
//            )
//        );
//        Templaza_API::set_section('settings', $tzfrm_subsection);
//    }
//}