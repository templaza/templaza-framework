<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Single Typography', 'templaza-framework' ),
        'id'         => 'single-typo',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog_single_bg',
                'type'     => 'background',
                'title'    => __( 'Blog single background', 'templaza-framework' ),
                'subtitle' => __( 'background for Blog single.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog_single_border',
                'type'     => 'border',
                'title'    => __('Blog single border', 'templaza-framework'),
                /* styles option added by TemPlaza*/
                'styles'   => array('' => esc_html__('Style', 'templaza-framework')),
                'placeholder'   => array(
                    'style' => esc_html__('Style', 'templaza-framework'),
                ),
                'select2'  => array('allowClear' => true),
                'default'  => ''
            ),

            array(
                'id'       => 'blog_single_padding',
                'type'     => 'spacing',
                'title'    => __('Blog single padding', 'templaza-framework'),
                'units'     => array(false,'px'),
                'select2'   => array('allowClear' => true),
                'default'   => array(
                    'units' => ''
                )
            ),
            array(
                'id'       => 'blog_single_margin',
                'type'     => 'spacing',
                'mode'     => 'margin',
                'title'    => __('Blog single margin', 'templaza-framework'),
                'units'     => array(false,'px'),
                'select2'   => array('allowClear' => true),
                'default'   => array(
                    'units' => ''
                )
            ),
            array(
                'id'       => 'blog_single_border_radius',
                'type'     => 'spacing',
                'mode'     => 'border-radius',
                'title'    => __('Blog single Border radius', 'templaza-framework'),
                'units'     => array(false,'px'),
                'select2'   => array('allowClear' => true),
                'default'   => array(
                    'units' => ''
                )
            ),
            array(
                'id'       => 'blog_single_shadow',
                'type'     => 'text',
                'title'    => __('Blog single box shadow', 'templaza-framework'),
                'default'  => '',
                'desc'     => __( 'Example: 10px 10px 5px 0px rgba(0,0,0,0.75). You can generator <a href="https://cssgenerator.org/box-shadow-css-generator.html">Here</a> ', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog_single_quote_bg',
                'type'     => 'background',
                'title'    => __( 'blockquote background', 'templaza-framework' ),
                'subtitle' => __( 'background for blockquote.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog_single_quote',
                'type' => 'typography',
                'allow_responsive'        => true,
                'google'      => true,
                'font-backup' => true,
                'text-transform' => true,
                'letter-spacing' => true,
                'title'    => __('Blog single blockquote', 'templaza-framework'),
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
                'id'       => 'blog_single_h1',
                'type' => 'typography',
                'allow_responsive'        => true,
                'google'      => true,
                'font-backup' => true,
                'text-transform' => true,
                'letter-spacing' => true,
                'title'    => __('Blog single heading H1', 'templaza-framework'),
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
                'id'       => 'blog_single_heading_box',
                'type' => 'typography',
                'allow_responsive'        => true,
                'google'      => true,
                'font-backup' => true,
                'text-transform' => true,
                'letter-spacing' => true,
                'title'    => __('Blog single heading box', 'templaza-framework'),
                'default'  => '',
                'desc'     => __( 'Typo for heading box example: author, comment, related', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog_single_h2',
                'type' => 'typography',
                'allow_responsive'        => true,
                'google'      => true,
                'font-backup' => true,
                'text-transform' => true,
                'letter-spacing' => true,
                'title'    => __('Blog single heading H2', 'templaza-framework'),
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
                'id'       => 'blog_single_h3',
                'type' => 'typography',
                'allow_responsive'        => true,
                'google'      => true,
                'font-backup' => true,
                'text-transform' => true,
                'letter-spacing' => true,
                'title'    => __('Blog single heading H3', 'templaza-framework'),
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
                'id'       => 'blog_single_h4',
                'type' => 'typography',
                'allow_responsive'        => true,
                'google'      => true,
                'font-backup' => true,
                'text-transform' => true,
                'letter-spacing' => true,
                'title'    => __('Blog single heading H4', 'templaza-framework'),
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
                'id'       => 'blog_single_h5',
                'type' => 'typography',
                'allow_responsive'        => true,
                'google'      => true,
                'font-backup' => true,
                'text-transform' => true,
                'letter-spacing' => true,
                'title'    => __('Blog single heading H5', 'templaza-framework'),
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
                'id'       => 'blog_single_h6',
                'type' => 'typography',
                'allow_responsive'        => true,
                'google'      => true,
                'font-backup' => true,
                'text-transform' => true,
                'letter-spacing' => true,
                'title'    => __('Blog single heading H6', 'templaza-framework'),
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
                'id'       => 'blog_single_content',
                'type' => 'typography',
                'allow_responsive'        => true,
                'google'      => true,
                'font-backup' => true,
                'text-transform' => true,
                'letter-spacing' => true,
                'title'    => __('Blog single content', 'templaza-framework'),
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