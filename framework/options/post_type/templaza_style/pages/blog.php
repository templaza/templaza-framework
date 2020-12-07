<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

// -> START Blog Section
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Blog Page', $this -> text_domain ),
        'id'         => 'blog-page',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog-page-title',
                'type'     => 'switch',
                'title'    => __( 'Show Title', $this -> text_domain ),
                'subtitle' => __( 'Show/hide title.', $this -> text_domain ),
            ),
            array(
                'id'       => 'blog-page-date',
                'type'     => 'switch',
                'title'    => __( 'Show Date', $this -> text_domain ),
                'subtitle' => __( 'Show/hide date.', $this -> text_domain ),
            ),
            array(
                'id'       => 'blog-page-author',
                'type'     => 'switch',
                'title'    => __( 'Show Author', $this -> text_domain ),
                'subtitle' => __( 'Show/hide title.', $this -> text_domain ),
            ),
            array(
                'id'       => 'blog-page-category',
                'type'     => 'switch',
                'title'    => __( 'Show Category', $this -> text_domain ),
                'subtitle' => __( 'Show/hide category.', $this -> text_domain ),
            ),
            array(
                'id'       => 'blog-page-tag',
                'type'     => 'switch',
                'title'    => __( 'Show Tag', $this -> text_domain ),
                'subtitle' => __( 'Show/hide tag.', $this -> text_domain ),
            ),
            array(
                'id'       => 'blog-page-description',
                'type'     => 'switch',
                'title'    => __( 'Show Description', $this -> text_domain ),
                'subtitle' => __( 'Show/hide description.', $this -> text_domain ),
            ),
            array(
                'id'       => 'blog-page-pagination',
                'type'     => 'switch',
                'title'    => __( 'Show Pagination', $this -> text_domain ),
                'subtitle' => __( 'Show/hide pagination.', $this -> text_domain ),
            ),
        )
    )
);

// -> START Blog Single Section
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Blog Single', $this -> text_domain ),
        'id'         => 'blog-single',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog-single-title',
                'type'     => 'switch',
                'title'    => __( 'Show Title', $this -> text_domain ),
                'subtitle' => __( 'Show/hide title.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-single-date',
                'type'     => 'switch',
                'title'    => __( 'Show Date', $this -> text_domain ),
                'subtitle' => __( 'Show/hide date.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-single-author',
                'type'     => 'switch',
                'title'    => __( 'Show Author', $this -> text_domain ),
                'subtitle' => __( 'Show/hide title.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-single-category',
                'type'     => 'switch',
                'title'    => __( 'Show Category', $this -> text_domain ),
                'subtitle' => __( 'Show/hide category.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-single-tag',
                'type'     => 'switch',
                'title'    => __( 'Show Tag', $this -> text_domain ),
                'subtitle' => __( 'Show/hide tag.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-single-description',
                'type'     => 'switch',
                'title'    => __( 'Show Description', $this -> text_domain ),
                'subtitle' => __( 'Show/hide description.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-single-related',
                'type'     => 'switch',
                'title'    => __( 'Show Related', $this -> text_domain ),
                'subtitle' => __( 'Show/hide related.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-single-share',
                'type'     => 'switch',
                'title'    => __( 'Show Share', $this -> text_domain ),
                'subtitle' => __( 'Show/hide share.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-single-comment',
                'type'     => 'switch',
                'title'    => __( 'Show Comment', $this -> text_domain ),
                'subtitle' => __( 'Show/hide comment.', $this -> text_domain ),
                'default'  => true,
            ),
        )
    )
);

