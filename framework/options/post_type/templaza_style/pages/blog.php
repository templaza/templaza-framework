<?php

defined('TEMPLAZA_FRAMEWORK') or exit();
$all_thumbnails = get_intermediate_image_sizes();
$arr_thumbnails = array();
foreach ($all_thumbnails as $thumbnail){
    $arr_thumbnails[$thumbnail] = $thumbnail;
}
$arr_thumbnails['full'] = 'full';
$thumbnail_effects = array(
    'none' => __('None',$this -> text_domain),
    'zoomin' => __('Zoom in',$this -> text_domain),
    'pointzoom' => __('Point zoom',$this -> text_domain),
    'zoomrorate' => __('Zoom rotate',$this -> text_domain),
    'zoomslow-motion' => __('Zoom in slow-motion',$this -> text_domain),
    'brighten-zoomin' => __('Brighten and Zoom-in',$this -> text_domain),
    'blur-zoom' => __('Blur zoom',$this -> text_domain),
);
// -> START Blog Section
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Blog Page', $this -> text_domain ),
        'id'         => 'blog-page',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog-page-layout',
                'type'     => 'select',
                'title'    => __('Blog Layout', $this -> text_domain),
                'subtitle' => __('Default style list or grid for Blog page.', $this -> text_domain),
                'options'  => array(
                    'grid' => 'Grid',
                    'list' => 'List',
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-grid-column',
                'type'     => 'spinner',
                'title'    => __('Blog columns', $this -> text_domain),
                'subtitle' => __('Number items per row in blog grid',$this -> text_domain),
                'default'  => '2',
                'min'      => '2',
                'step'     => '1',
                'max'      => '10',
                'required' => array('blog-page-layout', '=' , 'grid')
            ),
            array(
                'id'       => 'blog-page-leading',
                'type'     => 'select',
                'title'    => __( 'Leading item', $this -> text_domain ),
                'subtitle' => __( 'Show/hide leading item.', $this -> text_domain ),
                'options'       => array(
                    'on'        => esc_html__('On', $this -> text_domain),
                    'off'       => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-page-layout', '=' , 'grid')
            ),
            array(
                'id'       => 'blog-page-title',
                'type'     => 'select',
                'title'    => __( 'Show Title', $this -> text_domain ),
                'subtitle' => __( 'Show/hide title.', $this -> text_domain ),
                'options'       => array(
                    'on'        => esc_html__('On', $this -> text_domain),
                    'off'       => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-thumbnail',
                'type'     => 'select',
                'title'    => __( 'Show Thumbnail', $this -> text_domain ),
                'subtitle' => __( 'Show/hide Thumbnail.', $this -> text_domain ),
                'options'       => array(
                    'on'        => esc_html__('On', $this -> text_domain),
                    'off'       => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-thumbnail-size',
                'type'     => 'select',
                'title'    => __('Thumbnail size', $this -> text_domain),
                'subtitle' => __('choose image size in Blog page.', $this -> text_domain),
                'options'  => $arr_thumbnails,
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-page-thumbnail', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-page-thumbnail-effect',
                'type'     => 'select',
                'title'    => __('Thumbnail effect', $this -> text_domain),
                'subtitle' => __('Choose thumbnail hover effect for Blog page.', $this -> text_domain),
                'options'  => $thumbnail_effects,
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-page-thumbnail', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-page-date',
                'type'     => 'select',
                'title'    => __( 'Show Date', $this -> text_domain ),
                'subtitle' => __( 'Show/hide date.', $this -> text_domain ),
                'options'       => array(
                    'on'        => esc_html__('On', $this -> text_domain),
                    'off'       => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-author',
                'type'     => 'select',
                'title'    => __( 'Show Author', $this -> text_domain ),
                'subtitle' => __( 'Show/hide title.', $this -> text_domain ),
                'options'       => array(
                    'on'        => esc_html__('On', $this -> text_domain),
                    'off'       => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-comment-count',
                'type'     => 'select',
                'title'    => __( 'Show Comment count', $this -> text_domain ),
                'subtitle' => __( 'Show/hide comment count.', $this -> text_domain ),
                'options'       => array(
                    'on'        => esc_html__('On', $this -> text_domain),
                    'off'       => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-post-view',
                'type'     => 'select',
                'title'    => __( 'Show Post view', $this -> text_domain ),
                'subtitle' => __( 'Show/hide Post view.', $this -> text_domain ),
                'options'       => array(
                    'on'        => esc_html__('On', $this -> text_domain),
                    'off'       => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-category',
                'type'     => 'select',
                'title'    => __( 'Show Category', $this -> text_domain ),
                'subtitle' => __( 'Show/hide category.', $this -> text_domain ),
                'options'       => array(
                    'on'        => esc_html__('On', $this -> text_domain),
                    'off'       => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-tag',
                'type'     => 'select',
                'title'    => __( 'Show Tag', $this -> text_domain ),
                'subtitle' => __( 'Show/hide tag.', $this -> text_domain ),
                'options'       => array(
                    'on'        => esc_html__('On', $this -> text_domain),
                    'off'       => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-description',
                'type'     => 'select',
                'title'    => __( 'Show Description', $this -> text_domain ),
                'subtitle' => __( 'Show/hide description.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-readmore',
                'type'     => 'select',
                'title'    => __( 'Show Readmore', $this -> text_domain ),
                'subtitle' => __( 'Show/hide Readmore.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-share',
                'type'     => 'select',
                'title'    => __( 'Show Share', $this -> text_domain ),
                'subtitle' => __( 'Show/hide share.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-thumb-audio',
                'type'     => 'select',
                'title'    => __( 'Show Thumbnail Audio post', $this -> text_domain ),
                'subtitle' => __( 'Show/hide thumbnail audio.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-thumb-video',
                'type'     => 'select',
                'title'    => __( 'Show Thumbnail Video post', $this -> text_domain ),
                'subtitle' => __( 'Show/hide thumbnail video.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-thumb-link',
                'type'     => 'select',
                'title'    => __( 'Show Thumbnail Link post', $this -> text_domain ),
                'subtitle' => __( 'Show/hide thumbnail link.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-thumb-quote',
                'type'     => 'select',
                'title'    => __( 'Show Thumbnail Quote post', $this -> text_domain ),
                'subtitle' => __( 'Show/hide thumbnail quote.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-page-pagination',
                'type'     => 'select',
                'title'    => __( 'Show Pagination', $this -> text_domain ),
                'subtitle' => __( 'Show/hide pagination.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
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
                'type'     => 'select',
                'title'    => __( 'Show Title', $this -> text_domain ),
                'subtitle' => __( 'Show/hide title.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-single-thumbnail',
                'type'     => 'select',
                'title'    => __( 'Show Thumbnail', $this -> text_domain ),
                'subtitle' => __( 'Show/hide Thumbnail.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-single-thumbnail-size',
                'type'     => 'select',
                'title'    => __('Feature size', $this -> text_domain),
                'subtitle' => __('choose image size in Blog detail page.', $this -> text_domain),
                'options'  => $arr_thumbnails,
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-single-thumbnail', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-single-thumbnail-effect',
                'type'     => 'select',
                'title'    => __('Feature effect', $this -> text_domain),
                'subtitle' => __('Choose thumbnail hover effect for Blog detail page.', $this -> text_domain),
                'options'  => $thumbnail_effects,
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-page-thumbnail', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-single-meta',
                'type'     => 'select',
                'title'    => __( 'Show block meta post', $this -> text_domain ),
                'subtitle' => __( 'Show/hide meta post.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-single-date',
                'type'     => 'select',
                'title'    => __( 'Show Date', $this -> text_domain ),
                'subtitle' => __( 'Show/hide date.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-single-meta', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-single-author',
                'type'     => 'select',
                'title'    => __( 'Show Author', $this -> text_domain ),
                'subtitle' => __( 'Show/hide title.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-single-meta', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-single-comment-count',
                'type'     => 'select',
                'title'    => __( 'Show Comment count', $this -> text_domain ),
                'subtitle' => __( 'Show/hide comment count.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-single-meta', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-single-post-view',
                'type'     => 'select',
                'title'    => __( 'Show Post view', $this -> text_domain ),
                'subtitle' => __( 'Show/hide Post view.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-single-meta', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-single-category',
                'type'     => 'select',
                'title'    => __( 'Show Category', $this -> text_domain ),
                'subtitle' => __( 'Show/hide category.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('blog-single-meta', '!=' , 'off')
            ),
            array(
                'id'       => 'blog-single-tag',
                'type'     => 'select',
                'title'    => __( 'Show Tag', $this -> text_domain ),
                'subtitle' => __( 'Show/hide tag.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-single-description',
                'type'     => 'select',
                'title'    => __( 'Show Description', $this -> text_domain ),
                'subtitle' => __( 'Show/hide description.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-single-related',
                'type'     => 'select',
                'title'    => __( 'Show Related', $this -> text_domain ),
                'subtitle' => __( 'Show/hide related.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-single-share',
                'type'     => 'select',
                'title'    => __( 'Show Share', $this -> text_domain ),
                'subtitle' => __( 'Show/hide share.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-single-next-preview',
                'type'     => 'select',
                'title'    => __( 'Show Next, Preview', $this -> text_domain ),
                'subtitle' => __( 'Show/hide next, preview post.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-single-comment',
                'type'     => 'select',
                'title'    => __( 'Show Comment', $this -> text_domain ),
                'subtitle' => __( 'Show/hide comment.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
        )
    )
);

// -> START Blog Single Section
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Blog Slider Options', $this -> text_domain ),
        'id'         => 'blog-slider',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog-slider-autoplay',
                'type'     => 'select',
                'title'    => __( 'Autoplay', $this -> text_domain ),
                'subtitle' => __( 'Autoplay slider.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-slider-nav',
                'type'     => 'select',
                'title'    => __( 'Show Nav(next/preview)', $this -> text_domain ),
                'subtitle' => __( 'Show/hide next/preview.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-slider-animation',
                'type'     => 'select',
                'title'    => __('Animation', $this -> text_domain),
                'options'  => array(
                    'fade'    => esc_html__('Fade', $this -> text_domain),
                    'slide'   => esc_html__('Slide', $this -> text_domain),
                    'scale'   => esc_html__('Scale', $this -> text_domain),
                    'pull'    => esc_html__('Pull', $this -> text_domain),
                    'push'    => esc_html__('Push', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'blog-slider-kenburns',
                'type'     => 'select',
                'title'    => __( ' Ken Burns effect', $this -> text_domain ),
                'subtitle' => __( ' Ken Burns effect.', $this -> text_domain ),
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),

        )
    )
);
// -> START Blog Single Related
Templaza_API::set_section('templaza_style',
    array(
        'title'      => __( 'Blog Related Options', $this -> text_domain ),
        'id'         => 'blog-related',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog-related-column',
                'type'     => 'spinner',
                'title'    => __('Related columns', $this -> text_domain),
                'subtitle' => __('Number items per row',$this -> text_domain),
                'default'  => '3',
                'min'      => '1',
                'step'     => '1',
                'max'      => '20',
            ),
            array(
                'id'       => 'blog-related-limit',
                'type'     => 'spinner',
                'title'    => __('Related Limit', $this -> text_domain),
                'subtitle' => __('Limit related post ',$this -> text_domain),
                'default'  => '3',
                'min'      => '1',
                'step'     => '1',
                'max'      => '21',
            )
        )
    )
);