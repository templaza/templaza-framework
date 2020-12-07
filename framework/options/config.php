<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Post Type Fields
require_once 'post_type/post_type.php';

// Global configs of post ty
Templaza_API::set_section('settings', array(
    'id'         => 'settings',
    'title'     => esc_html__('Settings',$this -> text_domain),
    'desc'      => esc_html__('General theme options',$this -> text_domain),
    'icon'      => 'el-icon-home',
    'fields'    => array(
//        array(
//            'id'    => 'color-rgba',
//            'type'  => 'color_rgba',
//            'title' => esc_html__('Color Rgba'),
//        ),
//        array(
//            'id'    => 'background',
//            'type'  => 'background',
//            'color_rgba' => true,
//            'background-clip' => true,
//            'background-origin' => true,
////            'preview_media' => true,
//            'title' => esc_html__('Background'),
//            'default' => array(
////                'background-color' => '#ff0000',
////                'background-color-rgba' => 'rgba(0,0,0,0.5)',
////                'background-color-alpha' => '0.5',
//                'background-color'  => array(
//                    'color'     => '#ff0000',
////                    'color'     => 'rgba(0,0,0,0.5)',
////                    'rgba'     => 'rgba(0,0,0,0.5)',
//                    'alpha'     => 0.5
//                ),
//            ),
//            'options' => array(
//
//            ),
//        ),
//        array(
//            'id'    => 'background-2',
//            'type'  => 'background',
//            'title' => esc_html__('Background'),
//        ),
//        array(
//            'id'             => 'tz_typo-test-123',
//            'type'           => 'typography',
//            'title'          => __( 'Body Font', $this -> text_domain ),
//            'subtitle'       => __( 'Specify the body font properties.', $this -> text_domain ),
////            'required'       => array('typography-body', '=', 'custom'),
//            'color'          => true,
//            'text-align'     => true,
//            'preview'        => array(
//                'always_display' => true,
//            ), // Disable the previewer
//            'word-spacing'   => true,
//            'letter-spacing' => true,
//            'text-transform' => true,
//            'font-backup'    => true,
//            'allow_responsive'    => true,
//            'allow_empty_line_height'    => true,
////            'units'          => 'em',
//            'units'          => array(
//                'font-size'   => '%',
//                'line-height' => 'em',
//                'letter-spacing' => 'rem',
//                'word-spacing' => 'em',
//            ),
//            'default'        => array(
//                'color'          => '#000',
//                'font-weight'    => '400',
////                'font-size'      => '2em',
//                'font-size'      => array(
//                    'desktop'    => '1.5rem',
//                    'tablet'     => '1em',
//                    'mobile'     => '32px',
//                ),
//                'letter-spacing' => '0',
//                'text-transform' => 'none',
//                'font-family'    => 'Nunito',
//                'font-backup'    => 'Arial, Helvetica, sans-serif',
//            ),
//        ),
    ),
));

// -> START Fields of Posts Type "Posts"
Templaza_API::set_section('settings', array(
    'id'         => 'post-sections',
    'title'      => esc_html__('Posts Options',$this -> text_domain),
//    'desc'       => esc_html__('General posts options',$this -> text_domain),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'    => 'post-archive-style',
            'type'  => 'select',
            'data' => 'posts',
            'title' => esc_html__('Posts Archive Style', $this -> text_domain),
            'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
            'args'  => array(
                'post_type'      => 'templaza_style',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
//                'meta_key'       => '_templaza_style_theme',
//                'meta_value'     => basename(get_template_directory()),
                'meta_query' => array(
                    array(
                        'key'   => '_templaza_style_theme',
                        'value' => basename(get_template_directory()),
                        'compare'   => '='
                    )
                )
            ),
        ),
        array(
            'id'    => 'post-single-style',
            'type'  => 'select',
            'data' => 'posts',
            'title' => esc_html__('Posts Single Style', $this -> text_domain),
            'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
            'args'  => array(
                'post_type'      => 'templaza_style',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
                'meta_query' => array(
                    array(
                        'key'   => '_templaza_style_theme',
                        'value' => basename(get_template_directory()),
                        'compare'   => '='
                    )
                )
            ),
        ),
    ),
));
//// -> START Fields of Post Type "Portfolio"
//Templaza_API::set_section('settings', array(
//    'id'         => 'portfolio-sections',
//    'title'      => esc_html__('Portfolio Options',$this -> text_domain),
////    'desc'       => esc_html__('General posts options',$this -> text_domain),
//    'subsection' => true,
//    'fields'     => array(
//        array(
//            'id'    => 'portfolio-archive-style',
//            'type'  => 'select',
//            'data' => 'posts',
//            'title' => esc_html__('Portfolio Archive Style', $this -> text_domain),
//            'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
//            'args'  => array(
//                'post_type'      => 'templaza_style',
//                'posts_per_page' => -1,
//                'orderby'        => 'title',
//                'order'          => 'ASC',
//                'meta_key'       => '_templaza_style_theme',
//                'meta_value'     => basename(get_template_directory()),
//            ),
//        ),
//        array(
//            'id'    => 'portfolio-single-style',
//            'type'  => 'select',
//            'data' => 'posts',
//            'title' => esc_html__('Portfolio Single Style', $this -> text_domain),
//            'subtitle' => __('This template style will be defined as the global default template style.', $this -> text_domain),
//            'args'  => array(
//                'post_type'      => 'templaza_style',
//                'posts_per_page' => -1,
//                'orderby'        => 'title',
//                'order'          => 'ASC',
//                'meta_query' => array(
//                    array(
//                        'key'   => '_templaza_style_theme',
//                        'value' => basename(get_template_directory()),
//                        'compare'   => '='
//                    )
//                )
//            ),
//        ),
//    ),
//));