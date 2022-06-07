<?php
defined('TEMPLAZA_FRAMEWORK') or exit();
use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Custom_Field_Helper;
// -> START Advanced Product Section
Templaza_API::set_section('settings', array(
        'title' => esc_html__( 'Advanced Product Options', 'baressco'),
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
$arr_wpform['custom'] = esc_html__('Custom','baressco');
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
        'title'      => esc_html__( 'Advanced Product Archive', 'baressco' ),
        'id'         => 'ap_product-page',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-layout',
                'type'     => 'select',
                'title'    => esc_html__('Inventory Layout', 'baressco'),
                'subtitle' => esc_html__('Default style list or grid for Inventory page.', 'baressco'),
                'options'  => array(
                    'grid' => esc_html__('Grid', 'baressco'),
                    'masonry' => esc_html__('Masonry', 'baressco'),
                ),
                'default'  => 'grid',
            ),
            array(
                'id'       => 'ap_product-column-large',
                'type'     => 'select',
                'title'    => esc_html__('Large Desktop Columns', 'baressco'),
                'subtitle' => esc_html__('Number products per row large desktop (1600px and larger)', 'baressco'),
                'options'  => array(
                    '1' => esc_html__('1 Column', 'baressco'),
                    '2' => esc_html__('2 Columns', 'baressco'),
                    '3' => esc_html__('3 Columns', 'baressco'),
                    '4' => esc_html__('4 Columns', 'baressco'),
                    '5' => esc_html__('5 Columns', 'baressco'),
                    '6' => esc_html__('6 Columns', 'baressco'),
                ),
                'default'  => '3',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-column',
                'type'     => 'select',
                'title'    => esc_html__('Desktop Columns', 'baressco'),
                'subtitle' => esc_html__('Number products per row (1200px and larger)', 'baressco'),
                'options'  => array(
                    '1' => esc_html__('1 Column', 'baressco'),
                    '2' => esc_html__('2 Columns', 'baressco'),
                    '3' => esc_html__('3 Columns', 'baressco'),
                    '4' => esc_html__('4 Columns', 'baressco'),
                    '5' => esc_html__('5 Columns', 'baressco'),
                    '6' => esc_html__('6 Columns', 'baressco'),
                ),
                'default'  => '3',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-column-laptop',
                'type'     => 'select',
                'title'    => esc_html__('Laptop Columns', 'baressco'),
                'subtitle' => esc_html__('Number products per row (960px and larger)', 'baressco'),
                'options'  => array(
                    '1' => esc_html__('1 Column', 'baressco'),
                    '2' => esc_html__('2 Columns', 'baressco'),
                    '3' => esc_html__('3 Columns', 'baressco'),
                    '4' => esc_html__('4 Columns', 'baressco'),
                    '5' => esc_html__('5 Columns', 'baressco'),
                    '6' => esc_html__('6 Columns', 'baressco'),
                ),
                'default'  => '3',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-column-tablet',
                'type'     => 'select',
                'title'    => esc_html__('Tablet Columns', 'baressco'),
                'subtitle' => esc_html__('Number products per row (640px and larger)', 'baressco'),
                'options'  => array(
                    '1' => esc_html__('1 Column', 'baressco'),
                    '2' => esc_html__('2 Columns', 'baressco'),
                    '3' => esc_html__('3 Columns', 'baressco'),
                    '4' => esc_html__('4 Columns', 'baressco'),
                    '5' => esc_html__('5 Columns', 'baressco'),
                    '6' => esc_html__('6 Columns', 'baressco'),
                ),
                'default'  => '2',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-column-mobile',
                'type'     => 'select',
                'title'    => esc_html__('Mobile Columns', 'baressco'),
                'subtitle' => esc_html__('Number products per row mobile', 'baressco'),
                'options'  => array(
                    '1' => esc_html__('1 Column', 'baressco'),
                    '2' => esc_html__('2 Columns', 'baressco'),
                    '3' => esc_html__('3 Columns', 'baressco'),
                    '4' => esc_html__('4 Columns', 'baressco'),
                    '5' => esc_html__('5 Columns', 'baressco'),
                    '6' => esc_html__('6 Columns', 'baressco'),
                ),
                'default'  => '1',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-column-gap',
                'type'     => 'select',
                'title'    => esc_html__('Column Gap', 'baressco'),
                'subtitle' => esc_html__('Column Gap grid.', 'baressco'),
                'options'  => array(
                    'default' => esc_html__('Default','baressco'),
                    'small' => esc_html__('Small','baressco'),
                    'medium' => esc_html__('Medium','baressco'),
                    'large' => esc_html__('Large','baressco'),
                    'collapse' => esc_html__('Collapse','baressco'),
                ),
                'default'  => 'default',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-products_per_page',
                'type'     => 'spinner',
                'title'    => esc_html__('Products per page.', 'baressco'),
                'subtitle' => esc_html__('Products per page.', 'baressco'),
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
        'title'      => esc_html__( 'Advanced Product Loop', 'baressco' ),
        'id'         => 'ap_product-loop',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-loop-layout',
                'type'     => 'select',
                'title'    => esc_html__('Inventory Layout', 'baressco'),
                'subtitle' => esc_html__('Default style list or grid for Inventory page.', 'baressco'),
                'options'  => array(
                    'style1' => esc_html__('Style1', 'baressco'),
                    'style2' => esc_html__('Style2', 'baressco'),
                ),
                'default'  => 'style1',
            ),
            array(
                'id'       => 'ap_product-thumbnail-size',
                'type'     => 'select',
                'title'    => esc_html__('Thumbnail size', 'baressco'),
                'subtitle' => esc_html__('choose image size.', 'baressco'),
                'options'  => $arr_thumbnails,
            ),
            array(
                'id'       => 'ap_product-loop-bg-color',
                'type'     => 'background',
                'title'    => esc_html__( 'Product Loop Background', $this -> text_domain ),
                'subtitle' => esc_html__( 'Select the background for product loop item.', $this -> text_domain ),
            ),
            array(
                'id'     => 'ap_product-loop-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),
                'title'  => esc_html__('Product Loop Padding', 'baressco'),
            ),
            array(
                'id'     => 'ap_product-loop-info-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),
                'title'  => esc_html__('Product Info Padding', 'baressco'),
            ),
            array(
                'id'     => 'ap_product-loop-border',
                'type'     => 'border',
                'title'    => esc_html__('Product Loop Border', 'baressco'),
                'desc'     => esc_html__('Border for product loop item in archive page.', 'baressco'),
            ),
            array(
                'id'     => 'ap_product-loop-border_hover',
                'type'     => 'border',
                'title'    => esc_html__('Product Border Hover Option', 'baressco'),
                'desc'     => esc_html__('Border hover for product loop item in archive page.', 'baressco'),
            ),

        )
    )
);
Templaza_API::set_subsection('settings','ap_product-page',
    array(
        'title'      => esc_html__( 'Advanced Product Single', 'baressco' ),
        'id'         => 'ap_product-single',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-single-layout',
                'type'     => 'select',
                'title'    => esc_html__('Single Style', 'baressco'),
                'options'  => array(
                    'style1' => esc_html__('Style 1', 'baressco'),
                    'style2' => esc_html__('Style 2', 'baressco'),
                ),
                'default'  => 'style1',
            ),
            array(
                'id'       => 'ap_product-single-style2-top',
                'type'     => 'select',
                'multi'     => true,
                'title'    => esc_html__( 'Choose fields display horizontal', 'baressco' ),
                'options'  => $arr_fields,
                'required' => array('ap_product-single-layout', '=' , 'style2'),
            ),
            array(
                'id'       => 'ap_product-office-price',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Office Price', 'baressco' ),
                'default'  => true,
            ),
            array(
                'id'       => 'ap_product-office-price-label',
                'type'     => 'text',
                'title'    => esc_html__( 'Office Price Label', 'baressco' ),
                'default'  => esc_html__( 'MAKE AN OFFICE PRICE', 'baressco' ),
                'required' => array('ap_product-office-price', '=' , true),
            ),
            array(
                'id'       => 'ap_product-office-price-form',
                'type'     => 'select',
                'title'    => esc_html__( 'Office Price Form', 'baressco' ),
                'options'  => $arr_wpform,
                'required' => array('ap_product-office-price', '=' , true),
            ),
            array(
                'id'       => 'ap_product-office-price-form-custom',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Form', 'baressco' ),
                'subtitle' => esc_html__('Insert Form Shortcode', 'baressco'),
                'required' => array('ap_product-office-price-form', '=' , 'custom'),
            ),
            array(
                'id'       => 'ap_product-box-bg-color',
                'type'     => 'background',
                'title'    => esc_html__( 'Single Box Background', $this -> text_domain ),
                'subtitle' => esc_html__( 'Select the background for single box item.', $this -> text_domain ),
            ),
            array(
                'id'     => 'ap_product-box-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Single Box Padding', 'baressco'),
            ),
            array(
                'id'     => 'ap_product-box-margin',
                'type'   => 'spacing',
                'mode'   => 'margin',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Single Box Margin', 'baressco'),
            ),
            array(
                'id'     => 'ap_product-media-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Media Box Padding', 'baressco'),
            ),
            array(
                'id'     => 'ap_product-custom-field-margin',
                'type'   => 'spacing',
                'mode'   => 'margin',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Custom Field Item Margin', 'baressco'),
            ),
        )
    )
);
Templaza_API::set_subsection('settings','ap_product-page',
    array(
        'title'      => esc_html__( 'Advanced Product Related', 'baressco' ),
        'id'         => 'ap_product-single-related',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-related',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Product Related', 'baressco' ),
                'default'  => true,
            ),
            array(
                'id'       => 'ap_product-related-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Related Title', 'baressco' ),
                'default'  => esc_html__( 'RELATED PRODUCT', 'baressco' ),
                'required' => array('ap_product-related', '=' , true),
            ),
            array(
                'id'       => 'ap_product-related-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Number Product Related', 'baressco'),
                'default'  => '3',
                'min'      => '1',
                'step'     => '1',
                'max'      => '50',
                'required' => array('ap_product-related', '=' , true),
            ),
            array(
                'id'       => 'ap_product-related-spec-limit',
                'type'     => 'spinner',
                'title'    => esc_html__('Limit Specifications', 'baressco'),
                'default'  => '3',
                'min'      => '1',
                'step'     => '1',
                'max'      => '50',
                'required' => array('ap_product-related', '=' , true),
            ),
        )
    )
);