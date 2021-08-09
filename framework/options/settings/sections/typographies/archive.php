<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Archive Typography', $this -> text_domain ),
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
                'title'    => __('Blog item heading', $this -> text_domain),
                'default'  => ''
            ),
            array(
                'id'       => 'blog_item_content',
                'type' => 'typography',
                'google'      => true,
                'font-backup' => true,
                'allow_responsive'        => true,
                'title'    => __('Blog item content', $this -> text_domain),
                'default'  => ''
            ),
        )
    )
);