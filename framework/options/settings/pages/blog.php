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
Templaza_API::set_section('settings',
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
                'default'  => 'list',
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
                'type'     => 'switch',
                'title'    => __( 'Leading item', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide Leading item.', 'templaza-framework' ),
                'default'  => true,
                'required' => array('blog-page-layout', '=' , 'grid')
            ),
            array(
                'id'       => 'blog-page-title',
                'type'     => 'switch',
                'title'    => __( 'Show Title', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide title.', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-page-thumbnail',
                'type'     => 'switch',
                'title'    => __( 'Show Thumbnail', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide Thumbnail.', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-page-thumbnail-size',
                'type'     => 'select',
                'title'    => __('Thumbnail size', 'templaza-framework'),
                'subtitle' => __('choose image size in Blog page.', 'templaza-framework'),
                'options'  => $arr_thumbnails,
                'default'  => 'list',
                'required' => array('blog-page-thumbnail', '=' , true)
            ),
            array(
                'id'       => 'blog-page-thumbnail-effect',
                'type'     => 'select',
                'title'    => __('Thumbnail effect', 'templaza-framework'),
                'subtitle' => __('Choose thumbnail hover effect for Blog page.', 'templaza-framework'),
                'options'  => $thumbnail_effects,
                'default'  => 'none',
                'required' => array('blog-page-thumbnail', '=' , true)
            ),
            array(
                'id'       => 'blog-page-date',
                'type'     => 'switch',
                'title'    => __( 'Show Date', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide date.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-page-author',
                'type'     => 'switch',
                'title'    => __( 'Show Author', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide title.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-page-comment-count',
                'type'     => 'switch',
                'title'    => __( 'Show Comment count', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide comment count.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-page-post-view',
                'type'     => 'switch',
                'title'    => __( 'Show Post view', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide Post view.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-page-category',
                'type'     => 'switch',
                'title'    => __( 'Show Category', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide category.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-page-tag',
                'type'     => 'switch',
                'title'    => __( 'Show Tag', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide tag.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-page-description',
                'type'     => 'switch',
                'title'    => __( 'Show Description', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide description.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-page-readmore',
                'type'     => 'switch',
                'title'    => __( 'Show Readmore', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide Readmore.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-page-share',
                'type'     => 'switch',
                'title'    => __( 'Show Share', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide share.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-page-thumb-audio',
                'type'     => 'switch',
                'title'    => __( 'Show Thumbnail Audio post', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide thumbnail audio.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-page-thumb-video',
                'type'     => 'switch',
                'title'    => __( 'Show Thumbnail Video post', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide thumbnail video.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-page-thumb-link',
                'type'     => 'switch',
                'title'    => __( 'Show Thumbnail Link post', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide thumbnail link.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-page-thumb-quote',
                'type'     => 'switch',
                'title'    => __( 'Show Thumbnail Quote post', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide thumbnail quote.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-page-pagination',
                'type'     => 'switch',
                'title'    => __( 'Show Pagination', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide pagination.', 'templaza-framework' ),
            ),
	        array(
		        'id'       => 'blog_item_bg',
		        'type'     => 'background',
		        'title'    => __( 'Blog item background', 'templaza-framework' ),
		        'subtitle' => __( 'background for blog item.', 'templaza-framework' ),
	        ),
	        array(
		        'id'       => 'blog_item_border',
		        'type'     => 'border',
		        'title'    => __('Blog item border', 'templaza-framework'),
		        'default'  => ''
	        ),
	        array(
		        'id'       => 'blog_item_padding',
		        'type'     => 'spacing',
                'allow_responsive'    => true,
		        'title'    => __('Blog item padding', 'templaza-framework'),
		        'default'  => ''
	        ),
	        array(
		        'id'       => 'blog_media_padding',
		        'type'     => 'spacing',
                'allow_responsive'    => true,
		        'title'    => __('Blog media padding', 'templaza-framework'),
		        'default'  => ''
	        ),
	        array(
		        'id'       => 'blog_media_margin',
		        'type'     => 'spacing',
                'mode'     => 'margin',
                'allow_responsive'    => true,
		        'title'    => __('Blog media margin', 'templaza-framework'),
		        'default'  => ''
	        ),
	        array(
		        'id'       => 'blog_item_margin',
		        'type'     => 'spacing',
		        'mode'     => 'margin',
                'allow_responsive'    => true,
		        'title'    => __('Blog item margin', 'templaza-framework'),
		        'default'  => ''
	        ),
	        array(
		        'id'       => 'blog_item_border_radius',
		        'type'     => 'spacing',
		        'mode'     => 'border-radius',
                'allow_responsive'    => true,
		        'title'    => __('Blog item Border radius', 'templaza-framework'),
		        'default'  => '',
	        ),
	        array(
		        'id'       => 'blog_item_shadow',
		        'type'     => 'text',
		        'title'    => __('Blog item box shadow', 'templaza-framework'),
		        'default'  => '',
		        'desc'     => __( 'Example: 10px 10px 5px 0px rgba(0,0,0,0.75). You can generator <a href="https://cssgenerator.org/box-shadow-css-generator.html">Here</a> ', 'templaza-framework' ),
	        ),
        )
    )
);

// -> START Blog Single Section
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Blog Single', 'templaza-framework' ),
        'id'         => 'blog-single',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog-single-title',
                'type'     => 'switch',
                'title'    => __( 'Show Title', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide title.', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-single-thumbnail',
                'type'     => 'switch',
                'title'    => __( 'Show Thumbnail', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide Thumbnail.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'blog-single-thumbnail-size',
                'type'     => 'select',
                'title'    => __('Feature size', 'templaza-framework'),
                'subtitle' => __('choose image size in Blog detail page.', 'templaza-framework'),
                'options'  => $arr_thumbnails,
                'default'  => 'list',
                'required' => array('blog-single-thumbnail', '=' , true)
            ),
            array(
                'id'       => 'blog-single-thumbnail-effect',
                'type'     => 'select',
                'title'    => __('Feature effect', 'templaza-framework'),
                'subtitle' => __('Choose thumbnail hover effect for Blog detail page.', 'templaza-framework'),
                'options'  => $thumbnail_effects,
                'default'  => 'none',
                'required' => array('blog-page-thumbnail', '=' , true)
            ),
            array(
                'id'       => 'blog-single-meta',
                'type'     => 'switch',
                'title'    => __( 'Show block meta post', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide meta post.', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-single-date',
                'type'     => 'switch',
                'title'    => __( 'Show Date', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide date.', 'templaza-framework' ),
                'default'  => true,
                'required' => array('blog-single-meta', '=' , true)
            ),
            array(
                'id'       => 'blog-single-author',
                'type'     => 'switch',
                'title'    => __( 'Show Author', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide title.', 'templaza-framework' ),
                'default'  => true,
                'required' => array('blog-single-meta', '=' , true)
            ),
            array(
                'id'       => 'blog-single-comment-count',
                'type'     => 'switch',
                'title'    => __( 'Show Comment count', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide comment count.', 'templaza-framework' ),
                'required' => array('blog-single-meta', '=' , true)
            ),
            array(
                'id'       => 'blog-single-post-view',
                'type'     => 'switch',
                'title'    => __( 'Show Post view', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide Post view.', 'templaza-framework' ),
                'required' => array('blog-single-meta', '=' , true)
            ),
            array(
                'id'       => 'blog-single-category',
                'type'     => 'switch',
                'title'    => __( 'Show Category', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide category.', 'templaza-framework' ),
                'default'  => true,
                'required' => array('blog-single-meta', '=' , true)
            ),
            array(
                'id'       => 'blog-single-tag',
                'type'     => 'switch',
                'title'    => __( 'Show Tag', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide tag.', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-single-description',
                'type'     => 'switch',
                'title'    => __( 'Show Description', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide description.', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-single-related',
                'type'     => 'switch',
                'title'    => __( 'Show Related', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide related.', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-single-share',
                'type'     => 'switch',
                'title'    => __( 'Show Share', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide share.', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-single-next-preview',
                'type'     => 'switch',
                'title'    => __( 'Show Next, Preview', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide next, preview post.', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-single-comment',
                'type'     => 'switch',
                'title'    => __( 'Show Comment', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide comment.', 'templaza-framework' ),
                'default'  => true,
            ),
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
		        'default'  => ''
	        ),

	        array(
		        'id'       => 'blog_single_padding',
		        'type'     => 'spacing',
                'allow_responsive'    => true,
		        'title'    => __('Blog single padding', 'templaza-framework'),
		        'default'  => ''
	        ),

	        array(
		        'id'       => 'blog_single_media_padding',
		        'type'     => 'spacing',
                'allow_responsive'    => true,
		        'title'    => __('Blog single media padding', 'templaza-framework'),
		        'default'  => ''
	        ),
	        array(
		        'id'       => 'blog_single_margin',
		        'type'     => 'spacing',
		        'mode'     => 'margin',
                'allow_responsive'    => true,
		        'title'    => __('Blog single margin', 'templaza-framework'),
		        'default'  => ''
	        ),
	        array(
		        'id'       => 'blog_single_border_radius',
		        'type'     => 'spacing',
		        'mode'     => 'border-radius',
                'allow_responsive'    => true,
		        'title'    => __('Blog single Border radius', 'templaza-framework'),
		        'default'  => ''
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
        )
    )
);

// -> START Blog Single Slider
Templaza_API::set_section('settings',
    array(
        'title'      => __( 'Blog Slider Options', 'templaza-framework' ),
        'id'         => 'blog-slider',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'blog-slider-autoplay',
                'type'     => 'switch',
                'title'    => __( 'Autoplay', 'templaza-framework' ),
                'subtitle' => __( 'Autoplay slider.', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-slider-nav',
                'type'     => 'switch',
                'title'    => __( 'Show Nav(next/preview)', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide next/preview.', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog-slider-animation',
                'type'     => 'select',
                'title'    => __('Animation', 'templaza-framework'),
                'options'  => array(
                    'fade' => esc_html__('Fade', 'templaza-framework'),
                    'slide'   => esc_html__('Slide', 'templaza-framework'),
                    'scale'   => esc_html__('Scale', 'templaza-framework'),
                    'pull'   => esc_html__('Pull', 'templaza-framework'),
                    'push'   => esc_html__('Push', 'templaza-framework'),
                ),
                'default'  => 'fade',
            ),
            array(
                'id'       => 'blog-slider-kenburns',
                'type'     => 'switch',
                'title'    => __( 'Show Ken Burns effect)', 'templaza-framework' ),
                'subtitle' => __( 'Show/hide Ken Burns effect.', 'templaza-framework' ),
                'default'  => true,
            ),

        )
    )
);
// -> START Blog Single Related
Templaza_API::set_section('settings',
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
            )
        )
    )
);