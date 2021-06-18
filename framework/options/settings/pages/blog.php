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
Templaza_API::set_section('settings',
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
                'default'  => 'list',
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
                'id'       => 'blog-page-title',
                'type'     => 'switch',
                'title'    => __( 'Show Title', $this -> text_domain ),
                'subtitle' => __( 'Show/hide title.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-page-thumbnail',
                'type'     => 'switch',
                'title'    => __( 'Show Thumbnail', $this -> text_domain ),
                'subtitle' => __( 'Show/hide Thumbnail.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-page-thumbnail-size',
                'type'     => 'select',
                'title'    => __('Thumbnail size', $this -> text_domain),
                'subtitle' => __('choose image size in Blog page.', $this -> text_domain),
                'options'  => $arr_thumbnails,
                'default'  => 'list',
                'required' => array('blog-page-thumbnail', '=' , true)
            ),
            array(
                'id'       => 'blog-page-thumbnail-effect',
                'type'     => 'select',
                'title'    => __('Thumbnail effect', $this -> text_domain),
                'subtitle' => __('Choose thumbnail hover effect for Blog page.', $this -> text_domain),
                'options'  => $thumbnail_effects,
                'default'  => 'none',
                'required' => array('blog-page-thumbnail', '=' , true)
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
                'id'       => 'blog-page-comment-count',
                'type'     => 'switch',
                'title'    => __( 'Show Comment count', $this -> text_domain ),
                'subtitle' => __( 'Show/hide comment count.', $this -> text_domain ),
            ),
            array(
                'id'       => 'blog-page-post-view',
                'type'     => 'switch',
                'title'    => __( 'Show Post view', $this -> text_domain ),
                'subtitle' => __( 'Show/hide Post view.', $this -> text_domain ),
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
                'id'       => 'blog-page-readmore',
                'type'     => 'switch',
                'title'    => __( 'Show Readmore', $this -> text_domain ),
                'subtitle' => __( 'Show/hide Readmore.', $this -> text_domain ),
            ),
            array(
                'id'       => 'blog-page-share',
                'type'     => 'switch',
                'title'    => __( 'Show Share', $this -> text_domain ),
                'subtitle' => __( 'Show/hide share.', $this -> text_domain ),
            ),
            array(
                'id'       => 'blog-page-thumb-audio',
                'type'     => 'switch',
                'title'    => __( 'Show Thumbnail Audio post', $this -> text_domain ),
                'subtitle' => __( 'Show/hide thumbnail audio.', $this -> text_domain ),
            ),
            array(
                'id'       => 'blog-page-thumb-video',
                'type'     => 'switch',
                'title'    => __( 'Show Thumbnail Video post', $this -> text_domain ),
                'subtitle' => __( 'Show/hide thumbnail video.', $this -> text_domain ),
            ),
            array(
                'id'       => 'blog-page-thumb-link',
                'type'     => 'switch',
                'title'    => __( 'Show Thumbnail Link post', $this -> text_domain ),
                'subtitle' => __( 'Show/hide thumbnail link.', $this -> text_domain ),
            ),
            array(
                'id'       => 'blog-page-thumb-quote',
                'type'     => 'switch',
                'title'    => __( 'Show Thumbnail Quote post', $this -> text_domain ),
                'subtitle' => __( 'Show/hide thumbnail quote.', $this -> text_domain ),
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
Templaza_API::set_section('settings',
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
                'id'       => 'blog-single-thumbnail',
                'type'     => 'switch',
                'title'    => __( 'Show Thumbnail', $this -> text_domain ),
                'subtitle' => __( 'Show/hide Thumbnail.', $this -> text_domain ),
            ),
            array(
                'id'       => 'blog-single-thumbnail-size',
                'type'     => 'select',
                'title'    => __('Feature size', $this -> text_domain),
                'subtitle' => __('choose image size in Blog detail page.', $this -> text_domain),
                'options'  => $arr_thumbnails,
                'default'  => 'list',
                'required' => array('blog-single-thumbnail', '=' , true)
            ),
            array(
                'id'       => 'blog-single-thumbnail-effect',
                'type'     => 'select',
                'title'    => __('Feature effect', $this -> text_domain),
                'subtitle' => __('Choose thumbnail hover effect for Blog detail page.', $this -> text_domain),
                'options'  => $thumbnail_effects,
                'default'  => 'none',
                'required' => array('blog-page-thumbnail', '=' , true)
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
                'id'       => 'blog-single-comment-count',
                'type'     => 'switch',
                'title'    => __( 'Show Comment count', $this -> text_domain ),
                'subtitle' => __( 'Show/hide comment count.', $this -> text_domain ),
            ),
            array(
                'id'       => 'blog-single-post-view',
                'type'     => 'switch',
                'title'    => __( 'Show Post view', $this -> text_domain ),
                'subtitle' => __( 'Show/hide Post view.', $this -> text_domain ),
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

// -> START Blog Single Section
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Blog Slider Options', $this -> text_domain ),
        'id'         => 'blog-slider',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog-slider-autoplay',
                'type'     => 'switch',
                'title'    => __( 'Autoplay', $this -> text_domain ),
                'subtitle' => __( 'Autoplay slider.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-slider-animation',
                'type'     => 'select',
                'title'    => __('Animation', $this -> text_domain),
                'options'  => array(
                    'fade' => 'Fade',
                    'slide'   => 'Slide',
                ),
                'default'  => 'fade',
            ),
            array(
                'id'       => 'blog-slider-nav',
                'type'     => 'switch',
                'title'    => __( 'Show Nav(next/preview)', $this -> text_domain ),
                'subtitle' => __( 'Show/hide next/preview.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-slider-slideshowspeed',
                'type'     => 'spinner',
                'title'    => __('Animation duration', $this -> text_domain),
                'subtitle' => __( 'Set the speed of the slideshow cycling, in milliseconds.', $this -> text_domain ),
                'default'  => '7000',
                'min'      => '1000',
                'step'     => '200',
                'max'      => '100000',
            ),
            array(
                'id'       => 'blog-slider-animationduration',
                'type'     => 'spinner',
                'title'    => __('Animation duration', $this -> text_domain),
                'subtitle' => __( 'Set the speed of animations, in milliseconds.', $this -> text_domain ),
                'default'  => '600',
                'min'      => '100',
                'step'     => '100',
                'max'      => '100000',
            ),
        )
    )
);