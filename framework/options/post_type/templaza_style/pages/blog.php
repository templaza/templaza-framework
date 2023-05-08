<?php

defined('TEMPLAZA_FRAMEWORK') or exit();
$all_thumbnails = get_intermediate_image_sizes();
$arr_thumbnails = array();
foreach ($all_thumbnails as $thumbnail){
    $arr_thumbnails[$thumbnail] = $thumbnail;
}
$arr_thumbnails['full'] = 'full';
$thumbnail_effects = array(
    'none' => __('None','templaza-framework'),
    'zoomin' => __('Zoom in','templaza-framework'),
    'pointzoom' => __('Point zoom','templaza-framework'),
    'zoomrorate' => __('Zoom rotate','templaza-framework'),
    'zoomslow-motion' => __('Zoom in slow-motion','templaza-framework'),
    'brighten-zoomin' => __('Brighten and Zoom-in','templaza-framework'),
    'blur-zoom' => __('Blur zoom','templaza-framework'),
);
// -> START Blog Section
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Blog Page', 'templaza-framework' ),
        'id'         => 'blog-page',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog-page-layout',
                'type'     => 'select',
                'title'    => __('Blog Layout', 'templaza-framework'),
                'subtitle' => __('Default style list or grid for Blog page.', 'templaza-framework'),
                'options'  => array(
                    'grid' => 'Grid',
                    'list' => 'List',
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-grid-column',
                'type'     => 'spinner',
                'title'    => __('Blog columns', 'templaza-framework'),
                'subtitle' => __('Number items per row in blog grid','templaza-framework'),
                'default'  => '2',
                'min'      => '2',
                'step'     => '1',
                'max'      => '10',
                'required' => array('blog-page-layout', '=' , 'grid')
            ),
            array(
                'id'       => 'blog-page-leading',
                'type'     => 'select',
                'title'    => __( 'Leading item', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide leading item.', 'templaza-framework' ),
                'options'       => array(
                    'on'        => esc_html__('On', 'templaza-framework'),
                    'off'       => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-page-layout', '=' , 'grid')
            ),
            array(
                'id'       => 'blog-page-title',
                'type'     => 'select',
                'title'    => __( 'Show Title', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide title.', 'templaza-framework' ),
                'options'       => array(
                    'on'        => esc_html__('On', 'templaza-framework'),
                    'off'       => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-thumbnail',
                'type'     => 'select',
                'title'    => __( 'Show Thumbnail', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide Thumbnail.', 'templaza-framework' ),
                'options'       => array(
                    'on'        => esc_html__('On', 'templaza-framework'),
                    'off'       => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-thumbnail-size',
                'type'     => 'select',
                'title'    => __('Thumbnail size', 'templaza-framework'),
                'subtitle' => __('choose image size in Blog page.', 'templaza-framework'),
                'options'  => $arr_thumbnails,
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-page-thumbnail', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-page-thumbnail-effect',
                'type'     => 'select',
                'title'    => __('Thumbnail effect', 'templaza-framework'),
                'subtitle' => __('Choose thumbnail hover effect for Blog page.', 'templaza-framework'),
                'options'  => $thumbnail_effects,
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-page-thumbnail', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-page-date',
                'type'     => 'select',
                'title'    => __( 'Show Date', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide date.', 'templaza-framework' ),
                'options'       => array(
                    'on'        => esc_html__('On', 'templaza-framework'),
                    'off'       => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-author',
                'type'     => 'select',
                'title'    => __( 'Show Author', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide title.', 'templaza-framework' ),
                'options'       => array(
                    'on'        => esc_html__('On', 'templaza-framework'),
                    'off'       => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-comment-count',
                'type'     => 'select',
                'title'    => __( 'Show Comment count', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide comment count.', 'templaza-framework' ),
                'options'       => array(
                    'on'        => esc_html__('On', 'templaza-framework'),
                    'off'       => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-post-view',
                'type'     => 'select',
                'title'    => __( 'Show Post view', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide Post view.', 'templaza-framework' ),
                'options'       => array(
                    'on'        => esc_html__('On', 'templaza-framework'),
                    'off'       => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-category',
                'type'     => 'select',
                'title'    => __( 'Show Category', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide category.', 'templaza-framework' ),
                'options'       => array(
                    'on'        => esc_html__('On', 'templaza-framework'),
                    'off'       => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-tag',
                'type'     => 'select',
                'title'    => __( 'Show Tag', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide tag.', 'templaza-framework' ),
                'options'       => array(
                    'on'        => esc_html__('On', 'templaza-framework'),
                    'off'       => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-description',
                'type'     => 'select',
                'title'    => __( 'Show Description', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide description.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-readmore',
                'type'     => 'select',
                'title'    => __( 'Show Readmore', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide Readmore.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-share',
                'type'     => 'select',
                'title'    => __( 'Show Share', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide share.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-thumb-audio',
                'type'     => 'select',
                'title'    => __( 'Show Thumbnail Audio post', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide thumbnail audio.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-thumb-video',
                'type'     => 'select',
                'title'    => __( 'Show Thumbnail Video post', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide thumbnail video.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-thumb-link',
                'type'     => 'select',
                'title'    => __( 'Show Thumbnail Link post', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide thumbnail link.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-thumb-quote',
                'type'     => 'select',
                'title'    => __( 'Show Thumbnail Quote post', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide thumbnail quote.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-pagination',
                'type'     => 'select',
                'title'    => __( 'Show Pagination', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide pagination.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
        )
    )
);

// -> START Blog Single Section
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Blog Single', 'templaza-framework' ),
        'id'         => 'blog-single',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog-single-title',
                'type'     => 'select',
                'title'    => __( 'Show Title', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide title.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-single-thumbnail',
                'type'     => 'select',
                'title'    => __( 'Show Thumbnail', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide Thumbnail.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-single-thumbnail-size',
                'type'     => 'select',
                'title'    => __('Feature size', 'templaza-framework'),
                'subtitle' => __('choose image size in Blog detail page.', 'templaza-framework'),
                'options'  => $arr_thumbnails,
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-single-thumbnail', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-single-thumbnail-effect',
                'type'     => 'select',
                'title'    => __('Feature effect', 'templaza-framework'),
                'subtitle' => __('Choose thumbnail hover effect for Blog detail page.', 'templaza-framework'),
                'options'  => $thumbnail_effects,
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-page-thumbnail', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-single-meta',
                'type'     => 'select',
                'title'    => __( 'Show block meta post', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide meta post.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-single-date',
                'type'     => 'select',
                'title'    => __( 'Show Date', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide date.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-single-meta', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-single-author',
                'type'     => 'select',
                'title'    => __( 'Show Author', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide title.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-single-meta', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-single-comment-count',
                'type'     => 'select',
                'title'    => __( 'Show Comment count', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide comment count.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-single-meta', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-single-post-view',
                'type'     => 'select',
                'title'    => __( 'Show Post view', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide Post view.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-single-meta', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-single-category',
                'type'     => 'select',
                'title'    => __( 'Show Category', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide category.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-single-meta', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-single-tag',
                'type'     => 'select',
                'title'    => __( 'Show Tag', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide tag.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-single-description',
                'type'     => 'select',
                'title'    => __( 'Show Description', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide description.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-single-related',
                'type'     => 'select',
                'title'    => __( 'Show Related', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide related.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-single-share',
                'type'     => 'select',
                'title'    => __( 'Show Share', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide share.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-single-next-preview',
                'type'     => 'select',
                'title'    => __( 'Show Next, Preview', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide next, preview post.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-single-comment',
                'type'     => 'select',
                'title'    => __( 'Show Comment', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide comment.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
        )
    )
);

// -> START Blog Single Section
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Blog Slider Options', 'templaza-framework' ),
        'id'         => 'blog-slider',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog-slider-autoplay',
                'type'     => 'select',
                'title'    => __( 'Autoplay', 'templaza-framework' ),
                'subtitle' => __( 'Autoplay slider.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-slider-nav',
                'type'     => 'select',
                'title'    => __( 'Show Nav(next/preview)', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide next/preview.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-slider-animation',
                'type'     => 'select',
                'title'    => __('Animation', 'templaza-framework'),
                'options'  => array(
                    'fade'    => esc_html__('Fade', 'templaza-framework'),
                    'slide'   => esc_html__('Slide', 'templaza-framework'),
                    'scale'   => esc_html__('Scale', 'templaza-framework'),
                    'pull'    => esc_html__('Pull', 'templaza-framework'),
                    'push'    => esc_html__('Push', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-slider-kenburns',
                'type'     => 'select',
                'title'    => __( ' Ken Burns effect', 'templaza-framework' ),
                'subtitle' => __( ' Ken Burns effect.', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),

        )
    )
);
// -> START Blog Single Related
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Blog Related Options', 'templaza-framework' ),
        'id'         => 'blog-related',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog-related-column',
                'type'     => 'spinner',
                'title'    => __('Related columns', 'templaza-framework'),
                'subtitle' => __('Number items per row','templaza-framework'),
                'default'  => '3',
                'min'      => '1',
                'step'     => '1',
                'max'      => '20',
            ),
            array(
                'id'       => 'blog-related-limit',
                'type'     => 'spinner',
                'title'    => __('Related Limit', 'templaza-framework'),
                'subtitle' => __('Limit related post ','templaza-framework'),
                'default'  => '3',
                'min'      => '1',
                'step'     => '1',
                'max'      => '21',
            ),
            array(
                'id'       => 'blog-related-nav',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Next/Preview', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-related-dot',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Dots', 'templaza-framework' ),
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
        )
    )
);