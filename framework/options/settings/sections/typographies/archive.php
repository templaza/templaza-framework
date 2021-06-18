<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Archive Typography', $this -> text_domain ),
        'id'         => 'archive-typo',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog_item_bg',
                'type'     => 'background',
                'title'    => __( 'Blog item background', $this -> text_domain ),
                'subtitle' => __( 'background for blog item.', $this -> text_domain ),
            ),
            array(
                'id'       => 'blog_item_border',
                'type'     => 'border',
                'title'    => __('Blog item border', $this -> text_domain),
                'default'  => ''
            ),
            array(
                'id'       => 'blog_item_padding',
                'type'     => 'spacing',
                'title'    => __('Blog item padding', $this -> text_domain),
                'default'  => ''
            ),
            array(
                'id'       => 'blog_item_margin',
                'type'     => 'spacing',
                'mode'     => 'margin',
                'title'    => __('Blog item margin', $this -> text_domain),
                'default'  => ''
            ),
            array(
                'id'       => 'blog_item_border_radius',
                'type'     => 'spacing',
                'mode'     => 'border-radius',
                'title'    => __('Blog item Border radius', $this -> text_domain),
                'default'  => '',
            ),
            array(
                'id'       => 'blog_item_shadow',
                'type'     => 'text',
                'title'    => __('Blog item box shadow', $this -> text_domain),
                'default'  => '',
                'desc'     => __( 'Example: 10px 10px 5px 0px rgba(0,0,0,0.75). You can generator <a href="https://cssgenerator.org/box-shadow-css-generator.html">Here</a> ', $this -> text_domain ),
            ),
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