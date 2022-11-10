<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Single Typography', 'templaza-framework' ),
        'id'         => 'single-typo',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog_single_quote',
                'type' => 'typography',
                'allow_responsive'        => true,
                'google'      => true,
                'font-backup' => true,
                'text-transform' => true,
                'letter-spacing' => true,
                'title'    => __('Blog single blockquote', 'templaza-framework'),
                'default'  => ''
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
                'default'  => ''
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
                'default'  => ''
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
                'default'  => ''
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
                'default'  => ''
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
                'default'  => ''
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
                'default'  => ''
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
                'default'  => ''
            ),
        )
    )
);