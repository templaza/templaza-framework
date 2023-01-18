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
$arr_fields = array();
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
                'id'       => 'ap_product-products_per_page',
                'type'     => 'spinner',
                'title'    => esc_html__('Products per page.', 'templaza-framework'),
                'subtitle' => esc_html__('Products per page.', 'templaza-framework'),
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
                'title'    => esc_html__('Inventory Layout', 'templaza-framework'),
                'subtitle' => esc_html__('Default style list or grid for Inventory page.', 'templaza-framework'),
                'options'  => array(
                    'style1' => esc_html__('Style1', 'templaza-framework'),
                    'style2' => esc_html__('Style2', 'templaza-framework'),
                    'style3' => esc_html__('Style3', 'templaza-framework'),
                    'style4' => esc_html__('Style4', 'templaza-framework'),
                    'style5' => esc_html__('Style5', 'templaza-framework'),
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
                'id'       => 'ap_product-loop-desc-limit',
                'type'     => 'text',
                'title'    => __('Limit Description', 'templaza-framework'),
                'default'  => 100,
            ),
            array(
                'id'       => 'ap_product-thumbnail-size',
                'type'     => 'select',
                'title'    => esc_html__('Thumbnail size', 'templaza-framework'),
                'subtitle' => esc_html__('choose image size.', 'templaza-framework'),
                'options'  => $arr_thumbnails,
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
                    'style3' => esc_html__('Style 3', 'templaza-framework'),
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
                'title'    => esc_html__( 'Show Office Price', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'ap_product-single-media',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Media', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'ap_product-office-price-label',
                'type'     => 'text',
                'title'    => esc_html__( 'Office Price Label', 'templaza-framework' ),
                'default'  => esc_html__( 'MAKE AN OFFICE PRICE', 'templaza-framework' ),
                'required' => array('ap_product-office-price', '=' , true),
            ),
            array(
                'id'       => 'ap_product-office-price-form',
                'type'     => 'select',
                'title'    => esc_html__( 'Office Price Form', 'templaza-framework' ),
                'options'  => $arr_wpform,
                'required' => array('ap_product-office-price', '=' , true),
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
            ),
            array(
                'id'       => 'ap_product-office-price-form-custom',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Form', 'templaza-framework' ),
                'subtitle' => esc_html__('Insert Form Shortcode', 'templaza-framework'),
                'required' => array('ap_product-office-price-form', '=' , 'custom'),
            ),
            array(
                'id'       => 'ap_product-vendor-contact',
                'type'     => 'select',
                'title'    => esc_html__( 'Vendor Contact Form', 'templaza-framework' ),
                'options'  => $arr_wpform,
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