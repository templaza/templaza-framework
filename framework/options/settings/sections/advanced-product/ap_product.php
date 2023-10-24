<?php
defined('TEMPLAZA_FRAMEWORK') or exit();
use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Custom_Field_Helper;
// -> START Advanced Product Section
Templaza_API::set_section('settings', array(
        'title' => esc_html__( 'Advanced Product Options', 'templaza-framework'),
        'id'    => 'advanced-products-options',
        'icon'  => 'el eicon-product-stock'
    )
);
$all_thumbnails = get_intermediate_image_sizes();
$arr_thumbnails = array();
foreach ($all_thumbnails as $thumbnail){
    $arr_thumbnails[$thumbnail] = $thumbnail;
}
$arr_thumbnails['full'] = 'full';
$arr_wpform = array();
if(function_exists('wpforms')){
    $args = array(
        'numberposts' => -1,
        'post_type'   => 'wpforms'
    );

    $wpforms = get_posts( $args );
    if ( $wpforms && !is_wp_error($wpforms) ) {
        foreach ( $wpforms as $post ){
            $arr_wpform[$post->ID] = $post->post_title;
        }
        wp_reset_postdata();
    }
}
$arr_wpform['custom'] = esc_html__('Custom','templaza-framework');
$arr_wpform['custom_url'] = esc_html__('Custom Url','templaza-framework');
$arr_fields = array();
$arr_groups = array();
$arr_taxs = array();
$all_tax = array();
if(is_plugin_active( 'uipro/uipro.php' )){
    require_once WP_CONTENT_DIR .'/plugins/uipro/widgets/uiadvancedproducts/helper.php';
    $categories = UIPro_UIAdvancedProducts_Helper::get_custom_categories();
    $store_id   = md5(__METHOD__);
    if(isset(static::$cache[$store_id])){
        return static::$cache[$store_id];
    }
    $slug_cat = array(
        'ap_category' => esc_html__( 'Advanced Product Category', 'templaza-framework' ),
        'ap_branch' => esc_html__( 'Branch', 'templaza-framework' )
    );
    $slug_tax = array();
    if(!empty($categories) && count($categories)){
        foreach ($categories as $cat){
            $slug_tax[''.get_post_meta($cat -> ID, 'slug', true)]   = $cat -> post_title;
        }
    }
    $all_tax = array_merge($slug_cat,$slug_tax);
}
if(is_plugin_active( 'advanced-product/advanced-product.php' )) {
    $args = array(
        'numberposts' => -1,
        'post_type'   => 'ap_custom_field'
    );

    $wpfields = get_posts( $args );
    if ( $wpfields && !is_wp_error($wpfields)) {
        foreach ( $wpfields as $post ){
            $arr_fields[$post->post_excerpt] = $post->post_title;
        }
        wp_reset_postdata();
    }
    $terms = get_terms( array(
        'taxonomy' => 'ap_group_field',
        'hide_empty' => false,
    ) );
    $gfields_assigned   = AP_Custom_Field_Helper::get_group_fields_by_product();
    if($terms && count($terms)) {
        foreach ($terms as $group) {
            $arr_groups[$group->slug] = $group->name;
        }
    }

    $taxonomies = get_object_taxonomies('ap_product');
    if($taxonomies){
        foreach ($taxonomies as $tax) {
            $arr_taxs[$tax] = $tax;
        }
    }

}
Templaza_API::set_section('settings',
    array(
        'title'      => esc_html__( 'Advanced Product Archive', 'templaza-framework' ),
        'id'         => 'ap_product-page',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-layout',
                'type'     => 'select',
                'title'    => esc_html__('Inventory Layout', 'templaza-framework'),
                'subtitle' => esc_html__('Default style list or grid for Inventory page.', 'templaza-framework'),
                'options'  => array(
                    'grid' => esc_html__('Grid', 'templaza-framework'),
                    'masonry' => esc_html__('Masonry', 'templaza-framework'),
                    'list' => esc_html__('List', 'templaza-framework'),
                ),
                'default'  => 'grid',
            ),
            array(
                'id'       => 'ap_product-column-large',
                'type'     => 'select',
                'title'    => esc_html__('Large Desktop Columns', 'templaza-framework'),
                'subtitle' => esc_html__('Number products per row large desktop (1600px and larger)', 'templaza-framework'),
                'options'  => array(
                    '1' => esc_html__('1 Column', 'templaza-framework'),
                    '2' => esc_html__('2 Columns', 'templaza-framework'),
                    '3' => esc_html__('3 Columns', 'templaza-framework'),
                    '4' => esc_html__('4 Columns', 'templaza-framework'),
                    '5' => esc_html__('5 Columns', 'templaza-framework'),
                    '6' => esc_html__('6 Columns', 'templaza-framework'),
                ),
                'default'  => '3',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-column',
                'type'     => 'select',
                'title'    => esc_html__('Desktop Columns', 'templaza-framework'),
                'subtitle' => esc_html__('Number products per row (1200px and larger)', 'templaza-framework'),
                'options'  => array(
                    '1' => esc_html__('1 Column', 'templaza-framework'),
                    '2' => esc_html__('2 Columns', 'templaza-framework'),
                    '3' => esc_html__('3 Columns', 'templaza-framework'),
                    '4' => esc_html__('4 Columns', 'templaza-framework'),
                    '5' => esc_html__('5 Columns', 'templaza-framework'),
                    '6' => esc_html__('6 Columns', 'templaza-framework'),
                ),
                'default'  => '3',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-column-laptop',
                'type'     => 'select',
                'title'    => esc_html__('Laptop Columns', 'templaza-framework'),
                'subtitle' => esc_html__('Number products per row (960px and larger)', 'templaza-framework'),
                'options'  => array(
                    '1' => esc_html__('1 Column', 'templaza-framework'),
                    '2' => esc_html__('2 Columns', 'templaza-framework'),
                    '3' => esc_html__('3 Columns', 'templaza-framework'),
                    '4' => esc_html__('4 Columns', 'templaza-framework'),
                    '5' => esc_html__('5 Columns', 'templaza-framework'),
                    '6' => esc_html__('6 Columns', 'templaza-framework'),
                ),
                'default'  => '3',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-column-tablet',
                'type'     => 'select',
                'title'    => esc_html__('Tablet Columns', 'templaza-framework'),
                'subtitle' => esc_html__('Number products per row (640px and larger)', 'templaza-framework'),
                'options'  => array(
                    '1' => esc_html__('1 Column', 'templaza-framework'),
                    '2' => esc_html__('2 Columns', 'templaza-framework'),
                    '3' => esc_html__('3 Columns', 'templaza-framework'),
                    '4' => esc_html__('4 Columns', 'templaza-framework'),
                    '5' => esc_html__('5 Columns', 'templaza-framework'),
                    '6' => esc_html__('6 Columns', 'templaza-framework'),
                ),
                'default'  => '2',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-column-mobile',
                'type'     => 'select',
                'title'    => esc_html__('Mobile Columns', 'templaza-framework'),
                'subtitle' => esc_html__('Number products per row mobile', 'templaza-framework'),
                'options'  => array(
                    '1' => esc_html__('1 Column', 'templaza-framework'),
                    '2' => esc_html__('2 Columns', 'templaza-framework'),
                    '3' => esc_html__('3 Columns', 'templaza-framework'),
                    '4' => esc_html__('4 Columns', 'templaza-framework'),
                    '5' => esc_html__('5 Columns', 'templaza-framework'),
                    '6' => esc_html__('6 Columns', 'templaza-framework'),
                ),
                'default'  => '1',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-column-gap',
                'type'     => 'select',
                'title'    => esc_html__('Column Gap', 'templaza-framework'),
                'subtitle' => esc_html__('Column Gap grid.', 'templaza-framework'),
                'options'  => array(
                    'default' => esc_html__('Default','templaza-framework'),
                    'small' => esc_html__('Small','templaza-framework'),
                    'medium' => esc_html__('Medium','templaza-framework'),
                    'large' => esc_html__('Large','templaza-framework'),
                    'collapse' => esc_html__('Collapse','templaza-framework'),
                ),
                'default'  => 'default',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-archive-layout-switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Switch layout (List / Grid)', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'ap_product-archive-product-result',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Product Result', 'templaza-framework' ),
                'default'  => true,
                'required' => array('ap_product-archive-layout-switch', '=' , true),
            ),
            array(
                'id'       => 'ap_product-archive-product-sortby',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Sort by', 'templaza-framework' ),
                'default'  => true,
                'required' => array('ap_product-archive-layout-switch', '=' , true),
            ),
            array(
                'id'       => 'ap_product-archive-product-list-grid',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show list / grid', 'templaza-framework' ),
                'default'  => true,
                'required' => array('ap_product-archive-layout-switch', '=' , true),
            ),
            array(
                'id'       => 'ap_product-archive-product-sold',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide Product Sold', 'templaza-framework' ),
                'default'  => false,
            ),
            array(
                'id'       => 'ap_product-products_per_page',
                'type'     => 'spinner',
                'title'    => esc_html__('Products per page.', 'templaza-framework'),
                'default'  => '9',
                'min'      => '1',
                'step'     => '1',
                'max'      => '500',
            ),

        )
    )
);
Templaza_API::set_subsection('settings','ap_product-page',
    array(
        'title'      => esc_html__( 'Advanced Product Loop', 'templaza-framework' ),
        'id'         => 'ap_product-loop',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-loop-layout',
                'type'     => 'select',
                'title'    => esc_html__('Inventory Loop Layout', 'templaza-framework'),
                'subtitle' => esc_html__('Default style loop item of Inventory archive.', 'templaza-framework'),
                'options'  => array(
                    'style1' => esc_html__('Style1', 'templaza-framework'),
                    'style2' => esc_html__('Style2', 'templaza-framework'),
                    'style3' => esc_html__('Style3', 'templaza-framework'),
                    'style4' => esc_html__('Style4', 'templaza-framework'),
                    'style5' => esc_html__('Style5', 'templaza-framework'),
                    'style6' => esc_html__('Style6', 'templaza-framework'),
                    'style7' => esc_html__('Style7', 'templaza-framework'),
                ),
                'default'  => 'style1',
            ),
            array(
                'id'       => 'ap_product-loop-author',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Author', 'templaza-framework' ),
                'default'  => false,
            ),
            array(
                'id'       => 'ap_product-loop-desc',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Description', 'templaza-framework' ),
                'default'  => false,
            ),
            array(
                'id'       => 'ap_product-loop-desc-limit',
                'type'     => 'text',
                'title'    => __('Limit Description', 'templaza-framework'),
                'subtitle' => esc_html__('Number words.', 'templaza-framework'),
                'default'  => 100,
                'required' => array('ap_product-loop-desc', '=' , true),
            ),
            array(
                'id'       => 'ap_product-tax-style6',
                'type'     => 'select',
                'multi'     => false,
                'title'    => esc_html__( 'Choose taxonomy before title', 'templaza-framework' ),
                'options'  => $all_tax,
                'required' => array('ap_product-loop-layout', '=' , 'style6'),
            ),
            array(
                'id'       => 'ap_product-thumbnail-size',
                'type'     => 'select',
                'title'    => esc_html__('Thumbnail size', 'templaza-framework'),
                'subtitle' => esc_html__('choose image size.', 'templaza-framework'),
                'options'  => $arr_thumbnails,
            ),
            array(
                'id'       => 'ap_product-thumbnail-effect',
                'type'     => 'select',
                'title'    => esc_html__('Thumbnail Hover Effect', 'templaza-framework'),
                'options'  => array(
                    '' => esc_html__('Default', 'templaza-framework'),
                    'flash' => esc_html__('Flash', 'templaza-framework'),
                ),
                'default'  => '',
            ),
            array(
                'id'       => 'ap_product-loop-bg-color',
                'type'     => 'background',
                'title'    => esc_html__( 'Product Loop Background', 'templaza-framework' ),
                'subtitle' => esc_html__( 'Select the background for product loop item.', 'templaza-framework' ),
            ),
            array(
                'id'     => 'ap_product-loop-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),
                'title'  => esc_html__('Product Loop Padding', 'templaza-framework'),
            ),
            array(
                'id'     => 'ap_product-loop-info-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),
                'title'  => esc_html__('Product Info Padding', 'templaza-framework'),
            ),
            array(
                'id'     => 'ap_product-loop-border',
                'type'     => 'border',
                'title'    => esc_html__('Product Loop Border', 'templaza-framework'),
                'desc'     => esc_html__('Border for product loop item in archive page.', 'templaza-framework'),
            ),
            array(
                'id'     => 'ap_product-loop-border_hover',
                'type'     => 'border',
                'title'    => esc_html__('Product Border Hover Option', 'templaza-framework'),
                'desc'     => esc_html__('Border hover for product loop item in archive page.', 'templaza-framework'),
            ),
            array(
                'id'       => 'ap_product-loop-border-radius',
                'type'     => 'spacing',
                'mode'     => 'border-radius',
                'allow_responsive'    => true,
                'title'    => esc_html__('Product Loop Border radius', 'templaza-framework'),
                'default'  => ''
            ),
            array(
                'id'       => 'ap_product-loop-shadow',
                'type'     => 'text',
                'title'    => __('Product Loop box shadow', 'templaza-framework'),
                'default'  => '',
                'desc'     => __( 'Example: 10px 10px 5px 0px rgba(0,0,0,0.75). You can generator <a href="https://cssgenerator.org/box-shadow-css-generator.html">Here</a> ', 'templaza-framework' ),
            ),

        )
    )
);
Templaza_API::set_subsection('settings','ap_product-page',
    array(
        'title'      => esc_html__( 'Advanced Product Single', 'templaza-framework' ),
        'id'         => 'ap_product-single',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-single-layout',
                'type'     => 'select',
                'title'    => esc_html__('Single Style', 'templaza-framework'),
                'options'  => array(
                    'style1' => esc_html__('Style 1', 'templaza-framework'),
                    'style2' => esc_html__('Style 2', 'templaza-framework'),
                ),
                'default'  => 'style1',
            ),
            array(
                'id'       => 'ap_product-single-style2-top',
                'type'     => 'select',
                'sortable' => true,
                'multi'     => true,
                'title'    => esc_html__( 'Choose fields display horizontal', 'templaza-framework' ),
                'options'  => $arr_fields,
                'required' => array('ap_product-single-layout', '=' , 'style2'),
            ),
            array(
                'id'       => 'ap_product-office-price',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Offer Price', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'ap_product-single-media',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Media', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'ap_product-single-slider',
                'type'     => 'select',
                'title'    => esc_html__('Single Slider', 'templaza-framework'),
                'options'  => array(
                    'gallery' => esc_html__('Fade Slide', 'templaza-framework'),
                    'gallery-tiny' => esc_html__('Tiny Slider', 'templaza-framework'),
                ),
                'default'  => 'gallery-tiny',
            ),
            array(
                'id'       => 'ap_product-single-tiny-mode',
                'type'     => 'select',
                'title'    => esc_html__('Slider Mode', 'templaza-framework'),
                'options'  => array(
                    'carousel' => esc_html__('Carousel', 'templaza-framework'),
                    'gallery' => esc_html__('Gallery', 'templaza-framework'),
                ),
                'desc'     => esc_html__('Choose Gallery mode to fade in, fade out effect', 'templaza-framework'),
                'default'  => 'carousel',
                'required' => array('ap_product-single-slider', '=' , 'gallery-tiny'),
            ),
            array(
                'id'       => 'ap_product-single-tiny-autoheight',
                'type'     => 'switch',
                'title'    => esc_html__( 'Slider Auto Height', 'templaza-framework' ),
                'default'  => true,
                'required' => array('ap_product-single-slider', '=' , 'gallery-tiny'),
            ),
            array(
                'id'       => 'ap_product-single-tiny-custom_height',
                'type'     => 'text',
                'title'    => esc_html__( 'Slider Custom Height', 'templaza-framework' ),
                'desc'     => esc_html__('Example: 500px or 50% or 50vh', 'templaza-framework'),
                'required' => array('ap_product-single-tiny-autoheight', '=' , false),
            ),
            array(
                'id'       => 'ap_product-single-tiny-cover',
                'type'     => 'select',
                'title'    => esc_html__('Slider Image Fit', 'templaza-framework'),
                'options'  => array(
                    'cover' => esc_html__('Cover', 'templaza-framework'),
                    'auto' => esc_html__('Auto', 'templaza-framework'),
                ),
                'desc'     => esc_html__('Display image in slider box', 'templaza-framework'),
                'default'  => 'cover',
                'required' => array('ap_product-single-slider', '=' , 'gallery-tiny'),
            ),
            array(
                'id'       => 'ap_product-single-vendor',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Vendor', 'templaza-framework' ),
                'default'  => true,
                'required' => array('ap_product-single-layout', '=' , 'style1'),
            ),
            array(
                'id'       => 'ap_product-single-share',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Social Share', 'templaza-framework' ),
                'default'  => false,
            ),
            array(
                'id'       => 'ap_product-single-comment',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Comment', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'ap_product-single-share-label',
                'type'     => 'text',
                'title'    => esc_html__( 'Share Label', 'templaza-framework' ),
                'default'  => esc_html__( 'Share This', 'templaza-framework' ),
                'required' => array('ap_product-single-share', '=' , true),
            ),
            array(
                'id'       => 'ap_product-office-price-label',
                'type'     => 'text',
                'title'    => esc_html__( 'Offer Price Label', 'templaza-framework' ),
                'default'  => esc_html__( 'MAKE AN OFFER PRICE', 'templaza-framework' ),
                'required' => array('ap_product-office-price', '=' , true),
            ),
            array(
                'id'       => 'ap_product-office-price-form',
                'type'     => 'select',
                'title'    => esc_html__( 'Offer Price Form', 'templaza-framework' ),
                'options'  => $arr_wpform,
                'required' => array('ap_product-office-price', '=' , true),
            ),
            array(
                'id'       => 'ap_product-office-price-form-custom',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Form', 'templaza-framework' ),
                'subtitle' => esc_html__('Insert Form Shortcode', 'templaza-framework'),
                'required' => array('ap_product-office-price-form', '=' , 'custom'),
            ),
            array(
                'id'       => 'ap_product-office-price-form-custom-url',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Url', 'templaza-framework' ),
                'subtitle' => esc_html__('Insert url', 'templaza-framework'),
                'required' => array('ap_product-office-price-form', '=' , 'custom_url'),
            ),
            array(
                'id'       => 'ap_product-single-group-content',
                'type'     => 'select',
                'sortable' => true,
                'multi'     => true,
                'title'    => esc_html__( 'Choose Group Fields show under content', 'templaza-framework' ),
                'options'  => $arr_groups,
            ),
            array(
                'id'       => 'ap_product-single-group-content-sticky',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable sticky group fields content when scroll', 'templaza-framework' ),
                'default'  => false,
                'required' => array('ap_product-single-group-content', '!=' , ''),
            ),
            array(
                'id'       => 'ap_product-single-group-content-sticky-offset',
                'type'     => 'spinner',
                'title'    => esc_html__('Sticky group fields content nav offset top', 'templaza-framework'),
                'default'  => '117',
                'min'      => '-500',
                'step'     => '1',
                'max'      => '500',
                'required' => array('ap_product-single-group-content-sticky', '=' , true),
            ),
            array(
                'id'       => 'ap_product-single-group-content-title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Group title in content', 'templaza-framework' ),
                'default'  => true,
                'required' => array('ap_product-single-group-content-sticky', '=' , true),
            ),
            array(
                'id'       => 'ap_product-single-group-taxonomy',
                'type'     => 'select',
                'multi'     => false,
                'title'    => esc_html__( 'Show taxonomy in group', 'templaza-framework' ),
                'options'  => $arr_groups,
                'required' => array('ap_product-single-layout', '=' , 'style1'),
            ),
            array(
                'id'       => 'ap_product-single-taxonomy-show',
                'type'     => 'select',
                'sortable' => true,
                'multi'     => true,
                'title'    => esc_html__( 'Choose taxonomy display on single', 'templaza-framework' ),
                'options'  => $arr_taxs,
                'required' => array('ap_product-single-layout', '=' , 'style1'),
            ),
            array(
                'id'       => 'ap_product-single-group-field-acc',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display group field sidebar accordion', 'templaza-framework' ),
                'default'  => false,
                'required' => array('ap_product-single-layout', '=' , 'style1'),
            ),
            array(
                'id'       => 'ap_product-single-customfield-style',
                'type'     => 'select',
                'title'    => esc_html__('Custom Fields Style', 'templaza-framework'),
                'options'  => array(
                    'style1' => esc_html__('Style 1', 'templaza-framework'),
                    'style2' => esc_html__('Style 2', 'templaza-framework'),
                    'style3' => esc_html__('Style 3', 'templaza-framework'),
                ),
                'default'  => 'style1',
                'required' => array('ap_product-single-layout', '=' , 'style1'),
            ),

            array(
                'id'       => 'ap_product-vendor-contact',
                'type'     => 'select',
                'title'    => esc_html__( 'Vendor Contact Form', 'templaza-framework' ),
                'options'  => $arr_wpform,
            ),
            array(
                'id'       => 'ap_product-vendor-form-custom',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Form', 'templaza-framework' ),
                'subtitle' => esc_html__('Insert Form Shortcode', 'templaza-framework'),
                'required' => array('ap_product-vendor-contact', '=' , 'custom'),
            ),
            array(
                'id'       => 'ap_product-vendor-form-custom-url',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Url', 'templaza-framework' ),
                'subtitle' => esc_html__('Insert url', 'templaza-framework'),
                'required' => array('ap_product-vendor-contact', '=' , 'custom_url'),
            ),
            array(
                'id'       => 'ap_product-vendor-contact-label',
                'type'     => 'text',
                'title'    => esc_html__( 'Vendor Contact Title', 'templaza-framework' ),
                'default'  => esc_html__( 'Contact Vendor', 'templaza-framework' ),
                'required' => array('ap_product-vendor-contact', '!=' , ''),
            ),
            array(
                'id'       => 'ap_product-box-bg-color',
                'type'     => 'background',
                'title'    => esc_html__( 'Single Box Background', 'templaza-framework' ),
                'subtitle' => esc_html__( 'Select the background for single box item.', 'templaza-framework' ),
            ),
            array(
                'id'     => 'ap_product-box-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Single Box Padding', 'templaza-framework'),
            ),
            array(
                'id'     => 'ap_product-box-margin',
                'type'   => 'spacing',
                'mode'   => 'margin',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Single Box Margin', 'templaza-framework'),
            ),
            array(
                'id'       => 'ap_product-side-box-bg-color',
                'type'     => 'background',
                'title'    => esc_html__( 'Single Side Box Background', 'templaza-framework' ),
                'subtitle' => esc_html__( 'Select the background for single side box item.', 'templaza-framework' ),
            ),
            array(
                'id'     => 'ap_product-side-box-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Single Side Box Padding', 'templaza-framework'),
            ),
            array(
                'id'     => 'ap_product-side-box-margin',
                'type'   => 'spacing',
                'mode'   => 'margin',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Single Side Box Margin', 'templaza-framework'),
            ),
            array(
                'id'     => 'ap_product-media-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Media Box Padding', 'templaza-framework'),
            ),
            array(
                'id'     => 'ap_product-media-margin',
                'type'   => 'spacing',
                'mode'   => 'margin',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Media Box Margin', 'templaza-framework'),
            ),
            array(
                'id'     => 'ap_product-custom-field-margin',
                'type'   => 'spacing',
                'mode'   => 'margin',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Custom Field Item Margin', 'templaza-framework'),
            ),
        )
    )
);
Templaza_API::set_subsection('settings','ap_product-page',
    array(
        'title'      => esc_html__( 'Advanced Product Compare', 'templaza-framework' ),
        'id'         => 'ap_product-single-compare',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-compare-layout',
                'type'     => 'select',
                'title'    => esc_html__('Compare Layout', 'templaza-framework'),
                'options'  => array(
                    'style1' => esc_html__('Style1', 'templaza-framework'),
                    'style2' => esc_html__('Style2', 'templaza-framework'),
                    'style3' => esc_html__('Style3', 'templaza-framework'),
                    'style4' => esc_html__('Style4', 'templaza-framework'),
                    'style5' => esc_html__('Style5', 'templaza-framework'),
                ),
                'default'  => 'style1',
            ),
        )
    )
);
Templaza_API::set_subsection('settings','ap_product-page',
    array(
        'title'      => esc_html__( 'Advanced Product Related', 'templaza-framework' ),
        'id'         => 'ap_product-single-related',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-related',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Product Related', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'ap_product-related-by',
                'type'     => 'select',
                'multi'     => false,
                'title'    => esc_html__( 'Related by', 'templaza-framework' ),
                'options'  => $all_tax,
                'required' => array('ap_product-related', '=' , true),
            ),
            array(
                'id'       => 'ap_product-related-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Related Title', 'templaza-framework' ),
                'default'  => esc_html__( 'RELATED PRODUCT', 'templaza-framework' ),
                'required' => array('ap_product-related', '=' , true),
            ),
            array(
                'id'       => 'ap_product-related-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Number Product Related', 'templaza-framework'),
                'default'  => '3',
                'min'      => '1',
                'step'     => '1',
                'max'      => '50',
                'required' => array('ap_product-related', '=' , true),
            ),
            array(
                'id'       => 'ap_product-related-columns',
                'type'     => 'spinner',
                'title'    => esc_html__('Related Columns', 'templaza-framework'),
                'default'  => '3',
                'min'      => '1',
                'step'     => '1',
                'max'      => '50',
                'required' => array('ap_product-related', '=' , true),
            ),
            array(
                'id'       => 'ap_product-related-columns-gap',
                'type'     => 'select',
                'title'    => esc_html__('Columns Gap', 'templaza-framework'),
                'options'  => array(
                    'default' => esc_html__('Default', 'templaza-framework'),
                    'small' => esc_html__('Small', 'templaza-framework'),
                    'medium' => esc_html__('Medium', 'templaza-framework'),
                    'large' => esc_html__('Large', 'templaza-framework'),
                    'collapse' => esc_html__('Collapse', 'templaza-framework'),
                ),
                'default'  => 'medium',
            ),
            array(
                'id'       => 'ap_product-related-nav',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Next/Preview', 'templaza-framework' ),
                'default'  => true,
                'required' => array('ap_product-related', '=' , true),
            ),
            array(
                'id'       => 'ap_product-related-dot',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Dots', 'templaza-framework' ),
                'default'  => true,
                'required' => array('ap_product-related', '=' , true),
            ),
            array(
                'id'       => 'ap_product-related-spec-limit',
                'type'     => 'spinner',
                'title'    => esc_html__('Limit Specifications', 'templaza-framework'),
                'default'  => '3',
                'min'      => '1',
                'step'     => '1',
                'max'      => '50',
                'required' => array('ap_product-related', '=' , true),
            ),
        )
    )
);
Templaza_API::set_subsection('settings','ap_product-page',
    array(
        'title'      => esc_html__( 'Advanced Product Badges', 'templaza-framework' ),
        'id'         => 'ap_product-single-badges',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-badges',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Badges', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'ap_product-badges-style',
                'type'     => 'select',
                'title'    => esc_html__( 'Badges Style', 'templaza-framework' ),
                'default'  => '',
                'options'  => array(
                    '' => esc_html__('Default', 'templaza-framework'),
                    'style1' => esc_html__('Style1', 'templaza-framework'),
                ),
            ),
            array(
                'id'       => 'ap_product-sale-label',
                'type'     => 'text',
                'title'    => esc_html__( 'Sale Label', 'templaza-framework' ),
                'default'  => esc_html__( 'For Sale', 'templaza-framework' ),
                'required' => array('ap_product-badges', '=' , true),
            ),
            array(
                'id'       => 'ap_product-sale-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Sale Color', 'templaza-framework' ),
                'required' => array('ap_product-badges', '=' , true),
            ),
            array(
                'id'       => 'ap_product-sale-bg-color',
                'type'     => 'background',
                'title'    => __( 'Sale Background Color', 'templaza-framework' ),
                'required' => array('ap_product-badges', '=' , true),
            ),
            array(
                'id'       => 'ap_product-rent-label',
                'type'     => 'text',
                'title'    => esc_html__( 'Rent Label', 'templaza-framework' ),
                'default'  => esc_html__( 'For Rent', 'templaza-framework' ),
                'required' => array('ap_product-badges', '=' , true),
            ),
            array(
                'id'       => 'ap_product-rent-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Rent Color', 'templaza-framework' ),
                'required' => array('ap_product-badges', '=' , true),
            ),
            array(
                'id'       => 'ap_product-rent-bg-color',
                'type'     => 'background',
                'title'    => __( 'Rent Background Color', 'templaza-framework' ),
                'required' => array('ap_product-badges', '=' , true),
            ),
            array(
                'id'       => 'ap_product-sold-label',
                'type'     => 'text',
                'title'    => esc_html__( 'Sold Label', 'templaza-framework' ),
                'default'  => esc_html__( 'Sold', 'templaza-framework' ),
                'required' => array('ap_product-badges', '=' , true),
            ),
            array(
                'id'       => 'ap_product-sold-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Sold Color', 'templaza-framework' ),
                'required' => array('ap_product-badges', '=' , true),
            ),
            array(
                'id'       => 'ap_product-sold-bg-color',
                'type'     => 'background',
                'title'    => __( 'Sold Background Color', 'templaza-framework' ),
                'required' => array('ap_product-badges', '=' , true),
            ),
            array(
                'id'       => 'ap_product-contact-label',
                'type'     => 'text',
                'title'    => esc_html__( 'Contact Label', 'templaza-framework' ),
                'default'  => esc_html__( 'Contact', 'templaza-framework' ),
                'required' => array('ap_product-badges', '=' , true),
            ),
            array(
                'id'       => 'ap_product-contact-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Contact Color', 'templaza-framework' ),
                'required' => array('ap_product-badges', '=' , true),
            ),
            array(
                'id'       => 'ap_product-contact-bg-color',
                'type'     => 'background',
                'title'    => __( 'Contact Background Color', 'templaza-framework' ),
                'required' => array('ap_product-badges', '=' , true),
            ),
            array(
                'id'       => 'ap_product-sale-rent-label',
                'type'     => 'text',
                'title'    => esc_html__( 'Sale & Rent Label', 'templaza-framework' ),
                'default'  => esc_html__( 'Sale / Rent', 'templaza-framework' ),
                'required' => array('ap_product-badges', '=' , true),
            ),

            array(
                'id'       => 'ap_product-sale-rent-color',
                'type'     => 'color_rgba',
                'title'    => __( 'Sale & Rent Color', 'templaza-framework' ),
                'required' => array('ap_product-badges', '=' , true),
            ),
            array(
                'id'       => 'ap_product-sale-rent-bg-color',
                'type'     => 'background',
                'title'    => __( 'Sale & Rent Background Color', 'templaza-framework' ),
                'required' => array('ap_product-badges', '=' , true),
            ),

        )
    )
);
Templaza_API::set_subsection('settings','ap_product-page',
    array(
        'title'      => esc_html__( 'Advanced Product Quickview', 'templaza-framework' ),
        'id'         => 'ap_product-quickview',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-quickview-group',
                'type'     => 'select',
                'sortable' => true,
                'multi'     => true,
                'title'    => esc_html__( 'Choose Group Fields show in Quickview', 'templaza-framework' ),
                'options'  => $arr_groups,
            ),

        )
    )
);
Templaza_API::set_subsection('settings','ap_product-page',
    array(
        'title'      => esc_html__( 'Get a Quote', 'templaza-framework' ),
        'id'         => 'ap_product-quote',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-quote',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Get a Quote ', 'templaza-framework' ),
                'default'  => false,
            ),
            array(
                'id'       => 'ap_product-quote-label',
                'type'     => 'text',
                'title'    => esc_html__( 'Quote Label', 'templaza-framework' ),
                'default'  => '',
                'required' => array('ap_product-quote', '=' , true),
            ),
            array(
                'id'       => 'ap_product-quote-form',
                'type'     => 'select',
                'title'    => esc_html__( 'Choose Form', 'templaza-framework' ),
                'options'  => $arr_wpform,
            ),
            array(
                'id'       => 'ap_product-quote-form-custom',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Form', 'templaza-framework' ),
                'subtitle' => esc_html__('Insert Form Shortcode', 'templaza-framework'),
                'required' => array('ap_product-quote-form', '=' , 'custom'),
            ),
            array(
                'id'       => 'ap_product-quote-custom-url',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Url', 'templaza-framework' ),
                'subtitle' => esc_html__('Insert Custom Url', 'templaza-framework'),
                'required' => array('ap_product-quote-form', '=' , 'custom_url'),
            ),

        )
    )
);
Templaza_API::set_subsection('settings','ap_product-page',
    array(
        'title'      => esc_html__( 'Dealer', 'templaza-framework' ),
        'id'         => 'ap_product-dealer',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-dealer-listing',
                'type'     => 'text',
                'title'    => esc_html__( 'Dealer Listing label', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap_product-dealer-form-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Dealer Contact Title', 'templaza-framework' ),
            ),
            array(
                'id'       => 'ap_product-dealer-form',
                'type'     => 'select',
                'title'    => esc_html__( 'Form Contact Dealer', 'templaza-framework' ),
                'options'  => $arr_wpform,
            ),

            array(
                'id'       => 'ap_product-dealer-form-url',
                'type'     => 'text',
                'title'    => esc_html__( 'Dealer Contact Url', 'templaza-framework' ),
                'subtitle' => esc_html__('Insert Custom Url', 'templaza-framework'),
                'required' => array('ap_product-dealer-form', '=' , 'custom_url'),
            ),

        )
    )
);