<?php
defined('TEMPLAZA_FRAMEWORK') or exit();
use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Custom_Field_Helper;
// -> START Advanced Product Section
Templaza_API::set_section('settings', array(
        'title' => esc_html__( 'Advanced Product Options', $this -> text_domain),
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
$arr_wpform['custom'] = esc_html__('Custom',$this -> text_domain);
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
        'title'      => esc_html__( 'Advanced Product Archive', $this -> text_domain ),
        'id'         => 'ap_product-page',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-layout',
                'type'     => 'select',
                'title'    => esc_html__('Inventory Layout', $this -> text_domain),
                'subtitle' => esc_html__('Default style list or grid for Inventory page.', $this -> text_domain),
                'options'  => array(
                    'grid' => esc_html__('Grid', $this -> text_domain),
                    'masonry' => esc_html__('Masonry', $this -> text_domain),
                ),
                'default'  => 'grid',
            ),
            array(
                'id'       => 'ap_product-column-large',
                'type'     => 'select',
                'title'    => esc_html__('Large Desktop Columns', $this -> text_domain),
                'subtitle' => esc_html__('Number products per row large desktop (1600px and larger)', $this -> text_domain),
                'options'  => array(
                    '1' => esc_html__('1 Column', $this -> text_domain),
                    '2' => esc_html__('2 Columns', $this -> text_domain),
                    '3' => esc_html__('3 Columns', $this -> text_domain),
                    '4' => esc_html__('4 Columns', $this -> text_domain),
                    '5' => esc_html__('5 Columns', $this -> text_domain),
                    '6' => esc_html__('6 Columns', $this -> text_domain),
                ),
                'default'  => '3',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-column',
                'type'     => 'select',
                'title'    => esc_html__('Desktop Columns', $this -> text_domain),
                'subtitle' => esc_html__('Number products per row (1200px and larger)', $this -> text_domain),
                'options'  => array(
                    '1' => esc_html__('1 Column', $this -> text_domain),
                    '2' => esc_html__('2 Columns', $this -> text_domain),
                    '3' => esc_html__('3 Columns', $this -> text_domain),
                    '4' => esc_html__('4 Columns', $this -> text_domain),
                    '5' => esc_html__('5 Columns', $this -> text_domain),
                    '6' => esc_html__('6 Columns', $this -> text_domain),
                ),
                'default'  => '3',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-column-laptop',
                'type'     => 'select',
                'title'    => esc_html__('Laptop Columns', $this -> text_domain),
                'subtitle' => esc_html__('Number products per row (960px and larger)', $this -> text_domain),
                'options'  => array(
                    '1' => esc_html__('1 Column', $this -> text_domain),
                    '2' => esc_html__('2 Columns', $this -> text_domain),
                    '3' => esc_html__('3 Columns', $this -> text_domain),
                    '4' => esc_html__('4 Columns', $this -> text_domain),
                    '5' => esc_html__('5 Columns', $this -> text_domain),
                    '6' => esc_html__('6 Columns', $this -> text_domain),
                ),
                'default'  => '3',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-column-tablet',
                'type'     => 'select',
                'title'    => esc_html__('Tablet Columns', $this -> text_domain),
                'subtitle' => esc_html__('Number products per row (640px and larger)', $this -> text_domain),
                'options'  => array(
                    '1' => esc_html__('1 Column', $this -> text_domain),
                    '2' => esc_html__('2 Columns', $this -> text_domain),
                    '3' => esc_html__('3 Columns', $this -> text_domain),
                    '4' => esc_html__('4 Columns', $this -> text_domain),
                    '5' => esc_html__('5 Columns', $this -> text_domain),
                    '6' => esc_html__('6 Columns', $this -> text_domain),
                ),
                'default'  => '2',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-column-mobile',
                'type'     => 'select',
                'title'    => esc_html__('Mobile Columns', $this -> text_domain),
                'subtitle' => esc_html__('Number products per row mobile', $this -> text_domain),
                'options'  => array(
                    '1' => esc_html__('1 Column', $this -> text_domain),
                    '2' => esc_html__('2 Columns', $this -> text_domain),
                    '3' => esc_html__('3 Columns', $this -> text_domain),
                    '4' => esc_html__('4 Columns', $this -> text_domain),
                    '5' => esc_html__('5 Columns', $this -> text_domain),
                    '6' => esc_html__('6 Columns', $this -> text_domain),
                ),
                'default'  => '1',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-column-gap',
                'type'     => 'select',
                'title'    => esc_html__('Column Gap', $this -> text_domain),
                'subtitle' => esc_html__('Column Gap grid.', $this -> text_domain),
                'options'  => array(
                    'default' => esc_html__('Default',$this -> text_domain),
                    'small' => esc_html__('Small',$this -> text_domain),
                    'medium' => esc_html__('Medium',$this -> text_domain),
                    'large' => esc_html__('Large',$this -> text_domain),
                    'collapse' => esc_html__('Collapse',$this -> text_domain),
                ),
                'default'  => 'default',
                'required' => array('ap_product-layout', '=' , array('grid','masonry'))
            ),
            array(
                'id'       => 'ap_product-products_per_page',
                'type'     => 'spinner',
                'title'    => esc_html__('Products per page.', $this -> text_domain),
                'subtitle' => esc_html__('Products per page.', $this -> text_domain),
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
        'title'      => esc_html__( 'Advanced Product Loop', $this -> text_domain ),
        'id'         => 'ap_product-loop',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-loop-layout',
                'type'     => 'select',
                'title'    => esc_html__('Inventory Layout', $this -> text_domain),
                'subtitle' => esc_html__('Default style list or grid for Inventory page.', $this -> text_domain),
                'options'  => array(
                    'style1' => esc_html__('Style1', $this -> text_domain),
                    'style2' => esc_html__('Style2', $this -> text_domain),
                ),
                'default'  => 'style1',
            ),
            array(
                'id'       => 'ap_product-thumbnail-size',
                'type'     => 'select',
                'title'    => esc_html__('Thumbnail size', $this -> text_domain),
                'subtitle' => esc_html__('choose image size.', $this -> text_domain),
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
                'title'  => esc_html__('Product Loop Padding', $this -> text_domain),
            ),
            array(
                'id'     => 'ap_product-loop-info-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),
                'title'  => esc_html__('Product Info Padding', $this -> text_domain),
            ),
            array(
                'id'     => 'ap_product-loop-border',
                'type'     => 'border',
                'title'    => esc_html__('Product Loop Border', $this -> text_domain),
                'desc'     => esc_html__('Border for product loop item in archive page.', $this -> text_domain),
            ),
            array(
                'id'     => 'ap_product-loop-border_hover',
                'type'     => 'border',
                'title'    => esc_html__('Product Border Hover Option', $this -> text_domain),
                'desc'     => esc_html__('Border hover for product loop item in archive page.', $this -> text_domain),
            ),
            array(
                'id'       => 'ap_product-loop-border-radius',
                'type'     => 'spacing',
                'mode'     => 'border-radius',
                'allow_responsive'    => true,
                'title'    => esc_html__('Product Loop Border radius', $this -> text_domain),
                'default'  => ''
            ),

        )
    )
);
Templaza_API::set_subsection('settings','ap_product-page',
    array(
        'title'      => esc_html__( 'Advanced Product Single', $this -> text_domain ),
        'id'         => 'ap_product-single',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-single-layout',
                'type'     => 'select',
                'title'    => esc_html__('Single Style', $this -> text_domain),
                'options'  => array(
                    'style1' => esc_html__('Style 1', $this -> text_domain),
                    'style2' => esc_html__('Style 2', $this -> text_domain),
                ),
                'default'  => 'style1',
            ),
            array(
                'id'       => 'ap_product-single-style2-top',
                'type'     => 'select',
                'multi'     => true,
                'title'    => esc_html__( 'Choose fields display horizontal', $this -> text_domain ),
                'options'  => $arr_fields,
                'required' => array('ap_product-single-layout', '=' , 'style2'),
            ),
            array(
                'id'       => 'ap_product-office-price',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Office Price', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'ap_product-single-media',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Media', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'ap_product-office-price-label',
                'type'     => 'text',
                'title'    => esc_html__( 'Office Price Label', $this -> text_domain ),
                'default'  => esc_html__( 'MAKE AN OFFICE PRICE', $this -> text_domain ),
                'required' => array('ap_product-office-price', '=' , true),
            ),
            array(
                'id'       => 'ap_product-office-price-form',
                'type'     => 'select',
                'title'    => esc_html__( 'Office Price Form', $this -> text_domain ),
                'options'  => $arr_wpform,
                'required' => array('ap_product-office-price', '=' , true),
            ),
            array(
                'id'       => 'ap_product-single-customfield-style',
                'type'     => 'select',
                'title'    => esc_html__('Custom Fields Style', $this -> text_domain),
                'options'  => array(
                    'style1' => esc_html__('Style 1', $this -> text_domain),
                    'style2' => esc_html__('Style 2', $this -> text_domain),
                ),
                'default'  => 'style1',
            ),
            array(
                'id'       => 'ap_product-office-price-form-custom',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Form', $this -> text_domain ),
                'subtitle' => esc_html__('Insert Form Shortcode', $this -> text_domain),
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
                'title'  => esc_html__('Single Box Padding', $this -> text_domain),
            ),
            array(
                'id'     => 'ap_product-box-margin',
                'type'   => 'spacing',
                'mode'   => 'margin',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Single Box Margin', $this -> text_domain),
            ),
            array(
                'id'     => 'ap_product-media-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Media Box Padding', $this -> text_domain),
            ),
            array(
                'id'     => 'ap_product-custom-field-margin',
                'type'   => 'spacing',
                'mode'   => 'margin',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Custom Field Item Margin', $this -> text_domain),
            ),
        )
    )
);
Templaza_API::set_subsection('settings','ap_product-page',
    array(
        'title'      => esc_html__( 'Advanced Product Related', $this -> text_domain ),
        'id'         => 'ap_product-single-related',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'ap_product-related',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Product Related', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'ap_product-related-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Related Title', $this -> text_domain ),
                'default'  => esc_html__( 'RELATED PRODUCT', $this -> text_domain ),
                'required' => array('ap_product-related', '=' , true),
            ),
            array(
                'id'       => 'ap_product-related-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Number Product Related', $this -> text_domain),
                'default'  => '3',
                'min'      => '1',
                'step'     => '1',
                'max'      => '50',
                'required' => array('ap_product-related', '=' , true),
            ),
            array(
                'id'       => 'ap_product-related-spec-limit',
                'type'     => 'spinner',
                'title'    => esc_html__('Limit Specifications', $this -> text_domain),
                'default'  => '3',
                'min'      => '1',
                'step'     => '1',
                'max'      => '50',
                'required' => array('ap_product-related', '=' , true),
            ),
        )
    )
);