<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Archive Typography', 'templaza-framework' ),
        'id'         => 'archive-typo',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog_item_heading',
                'type' => 'typography',
                'allow_responsive'        => true,
                'google'      => true,
                'font-backup' => true,
                'text-transform' => true,
                'letter-spacing' => true,
                'title'    => __('Blog item heading', 'templaza-framework'),
                'default'  => ''
            ),
            array(
                'id'       => 'blog_item_content',
                'type' => 'typography',
                'google'      => true,
                'font-backup' => true,
                'allow_responsive'        => true,
                'title'    => __('Blog item content', 'templaza-framework'),
                'default'  => ''
            ),
        )
    )
);