<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Archive Typography', 'templaza-framework' ),
        'id'         => 'archive-typo',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog_item_bg',
                'type'     => 'background',
                'title'    => __( 'Blog item background', 'templaza-framework' ),
                'subtitle' => __( 'background for blog item.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog_item_border',
                'type'     => 'border',
                'title'    => __('Blog item border', 'templaza-framework'),
                /* styles option added by TemPlaza*/
                'styles'   => array('' => esc_html__('Style', 'templaza-framework')),
                'placeholder'   => array(
                    'style' => esc_html__('Style', 'templaza-framework'),
                ),
                'select2'  => array('allowClear' => true),
            ),
            array(
                'id'        => 'blog_item_padding',
                'type'      => 'spacing',
                'title'     => __('Blog item padding', 'templaza-framework'),
                'units'     => array(false,'px'),
                'select2'   => array('allowClear' => true),
                'default'   => array(
                    'units' => ''
                )
            ),
            array(
                'id'        => 'blog_item_margin',
                'type'      => 'spacing',
                'mode'      => 'margin',
                'title'     => __('Blog item margin', 'templaza-framework'),
                'units'     => array(false,'px'),
                'select2'   => array('allowClear' => true),
                'default'   => array(
                    'units' => ''
                )
            ),
            array(
                'id'        => 'blog_item_border_radius',
                'type'      => 'spacing',
                'mode'      => 'border-radius',
                'title'     => __('Blog item Border radius', 'templaza-framework'),
                'units'     => array(false,'px'),
                'select2'   => array('allowClear' => true),
                'default'   => array(
                    'units' => ''
                )
            ),
            array(
                'id'       => 'blog_item_shadow',
                'type'     => 'text',
                'title'    => __('Blog item box shadow', 'templaza-framework'),
                'default'  => '',
                'desc'     => __( 'Example: 10px 10px 5px 0px rgba(0,0,0,0.75). You can generator <a href="https://cssgenerator.org/box-shadow-css-generator.html">Here</a> ', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog_item_heading',
                'type' => 'typography',
                'allow_responsive'        => true,
                'google'      => true,
                'font-backup' => true,
                'text-transform' => true,
                'letter-spacing' => true,
                'title'    => __('Blog item heading', 'templaza-framework'),
                'units'                   => array(
                    'font-size'         => array(''),
                    'line-height'       => array(''),
                    'letter-spacing'    => array(''),
                ),
                'default'                 => array(
                    'color'          => '',
                    'font-weight'    => '',
                    'letter-spacing' => '',
                    'text-transform' => '',
                    'font-family'    => '',
                    'font-backup'    => '',
                    'units'          => array(
                        'font-size'     => '',
                        'line-height'   => '',
                        'letter-spacing'   => '',
                    )
                ),
            ),
            array(
                'id'       => 'blog_item_content',
                'type' => 'typography',
                'google'      => true,
                'font-backup' => true,
                'allow_responsive'        => true,
                'title'    => __('Blog item content', 'templaza-framework'),
                'units'                   => array(
                    'font-size'         => array(''),
                    'line-height'       => array(''),
                    'letter-spacing'    => array(''),
                ),
                'default'                 => array(
                    'color'          => '',
                    'font-weight'    => '',
                    'letter-spacing' => '',
                    'text-transform' => '',
                    'font-family'    => '',
                    'font-backup'    => '',
                    'units'          => array(
                        'font-size'     => '',
                        'line-height'   => '',
                        'letter-spacing'   => '',
                    )
                ),
            ),
        )
    )
);