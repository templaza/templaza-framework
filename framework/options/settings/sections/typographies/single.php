<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Single Typography', $this -> text_domain ),
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
                'title'    => __('Blog single blockquote', $this -> text_domain),
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
                'title'    => __('Blog single heading H1', $this -> text_domain),
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
                'title'    => __('Blog single heading box', $this -> text_domain),
                'default'  => '',
                'desc'     => __( 'Typo for heading box example: author, comment, related', $this -> text_domain ),
            ),
            array(
                'id'       => 'blog_single_h2',
                'type' => 'typography',
                'allow_responsive'        => true,
                'google'      => true,
                'font-backup' => true,
                'text-transform' => true,
                'letter-spacing' => true,
                'title'    => __('Blog single heading H2', $this -> text_domain),
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
                'title'    => __('Blog single heading H3', $this -> text_domain),
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
                'title'    => __('Blog single heading H4', $this -> text_domain),
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
                'title'    => __('Blog single heading H5', $this -> text_domain),
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
                'title'    => __('Blog single heading H6', $this -> text_domain),
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
                'title'    => __('Blog single content', $this -> text_domain),
                'default'  => ''
            ),
        )
    )
);