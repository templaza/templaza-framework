<?php

defined('TEMPLAZA_FRAMEWORK') or exit();
// -> START Shop Section
Templaza_API::set_section('templaza_style', array(
        'title' => esc_html__( 'Woocommerce Options', 'templaza-framework'),
        'id'    => 'Woocommerce-options',
        'icon'  => 'el el-shopping-cart'
    )
);
Templaza_API::set_section('templaza_style',
    array(
        'title'      => esc_html__( 'Product Catalog', 'templaza-framework' ),
        'id'         => 'shop-page',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-layout',
                'type'     => 'select',
                'title'    => esc_html__('Shop Layout', 'templaza-framework'),
                'subtitle' => esc_html__('Default style list or grid for Shop page.', 'templaza-framework'),
                'options'  => array(
                    'grid' => esc_html__('Grid', 'templaza-framework'),
                    'masonry' => esc_html__('Masonry', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-column-large',
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
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-layout', '=' , 'grid')
            ),
            array(
                'id'       => 'templaza-shop-column',
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
                'required' => array('templaza-shop-layout', '=' , 'grid'),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-column-laptop',
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
                'required' => array('templaza-shop-layout', '=' , 'grid'),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-column-tablet',
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
                'required' => array('templaza-shop-layout', '=' , 'grid'),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-column-mobile',
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
                'required' => array('templaza-shop-layout', '=' , 'grid'),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-column-gap',
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
                'required' => array('templaza-shop-layout', '=' , 'grid'),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-products_per_page',
                'type'     => 'text',
                'title'    => esc_html__('Products per page.', 'templaza-framework'),
                'subtitle' => esc_html__('Products per page.', 'templaza-framework'),
                'default'  => '',
            ),
            array(
                'id'       => 'templaza-shop-background-color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Item Background Color', 'templaza-framework' ),
                'subtitle' => esc_html__( 'Select the background color for Shop item.', 'templaza-framework' ),
            ),
            array(
                'id'     => 'templaza-shop-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Item Summary Padding', 'templaza-framework'),
            ),
            array(
                'id'     => 'templaza-shop-margin',
                'type'   => 'spacing',
                'mode'   => 'margin',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Item Summary Margin', 'templaza-framework'),
            ),

            array(
                'id'       => 'templaza-shop-pagination',
                'type'     => 'select',
                'title'    => esc_html__('Shop Pagination', 'templaza-framework'),
                'subtitle' => esc_html__('Pagination Type.', 'templaza-framework'),
                'options'  => array(
                    'number' => esc_html__('Number','templaza-framework'),
                    'loadmore' => esc_html__('Button Load more','templaza-framework'),
                    'scroll' => esc_html__('Infinite Scroll','templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza_shop_show_title',
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
                'id'       => 'templaza_shop_show_rating',
                'title'    => esc_html__( 'Show Rating', 'templaza-framework' ),
                'subtitle' => esc_html__( 'Show/hide Rating.', 'templaza-framework' ),
                'type'     => 'select',
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

// Product Loop Setting
Templaza_API::set_subsection('templaza_style', 'shop-page',
    array(
        'title'      => esc_html__( 'Product Loop', 'templaza-framework' ),
        'id'         => 'shop-product-loop',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-loop-layout',
                'type'     => 'select',
                'title'    => esc_html__('Product Loop Layout', 'templaza-framework'),
                'options'  => array(
                    'layout-1' => esc_html__( 'Icons over thumbnail on hover', 'templaza-framework' ),
                    'layout-2' => esc_html__( 'Icons & Quick view button', 'templaza-framework' ),
                    'layout-3' => esc_html__( 'Icons & Add to cart button', 'templaza-framework' ),
                    'layout-4' => esc_html__( 'Icons on the bottom', 'templaza-framework' ),
                    'layout-5' => esc_html__( 'Simple', 'templaza-framework' ),
                    'layout-6' => esc_html__( 'Standard button', 'templaza-framework' ),
                    'layout-7' => esc_html__( 'Info on hover', 'templaza-framework' ),
                    'layout-8' => esc_html__( 'Icons & Add to cart text', 'templaza-framework' ),
                    'layout-9' => esc_html__( 'Quick Shop button', 'templaza-framework' ),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-loop-hover',
                'type'     => 'select',
                'title'    => esc_html__('Product Loop Hover', 'templaza-framework'),
                'options'  => array(
                    'classic' => esc_html__( 'Default', 'templaza-framework' ),
                    'slider'  => esc_html__( 'Slider', 'templaza-framework' ),
                    'fadein'  => esc_html__( 'Fadein', 'templaza-framework' ),
                    'zoom'    => esc_html__( 'Zoom', 'templaza-framework' ),
                ),
                'required' => array('templaza-shop-loop-layout', '!=' , 'layout-7'),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-loop-featured-icons',
                'type'     => 'checkbox',
                'title'    => esc_html__('Featured Icons', 'templaza-framework'),

                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    'cart'  => esc_html__( 'Cart', 'templaza-framework' ),
                    'quickview' => esc_html__( 'Quick View', 'templaza-framework' ),
                    'wishlist' => esc_html__( 'Wishlist', 'templaza-framework' ),
                ),
                //See how default has changed? you also don't need to specify opts that are 0.
                'default' => array(
                    'cart' => '1',
                    'quickview' => '1',
                    'wishlist' => '1'
                ),
                'required' => array('templaza-shop-loop-layout', '!=' , 'layout-5'),
            ),
            array(
                'id'       => 'templaza-shop-loop-wishlist',
                'title'    => esc_html__( 'Always Display Wishlist', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-loop-layout', '=' , array('layout-2','layout-3','layout-9')),
            ),
            array(
                'id'       => 'templaza-shop-loop-attributes',
                'type'     => 'checkbox',
                'title'    => esc_html__('Attributes', 'templaza-framework'),

                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    'taxonomy' => esc_html__( 'Taxonomy', 'templaza-framework' ),
                    'rating'   => esc_html__( 'Rating', 'templaza-framework' ),
                ),
                //See how default has changed? you also don't need to specify opts that are 0.
                'default' => array(
                    'taxonomy' => '1',
                    'rating' => '0',
                ),
            ),
            array(
                'id'       => 'templaza-shop-loop-taxonomy',
                'type'     => 'select',
                'title'    => esc_html__('Product Loop Taxonomy', 'templaza-framework'),
                'options'  => array(
                    'product_cat'   => esc_html__( 'Category', 'templaza-framework' ),
                    'product_brand' => esc_html__( 'Brand', 'templaza-framework' ),
                ),
                'required' => array(
                    array( 'templaza-shop-loop-attributes', '=', 'taxonomy' ),
                    array( 'templaza-shop-loop-attributes', '=', '1' )
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-loop-variation',
                'title'    => esc_html__( 'Show Variations', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-loop-layout', '=' , array('layout-8','layout-9')),
            ),
            array(
                'id'       => 'templaza-shop-loop-variation-ajax',
                'title'    => esc_html__( 'Show Variations With AJAX', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array(
                    array( 'templaza-shop-loop-variation', '=', true ),
                    array( 'templaza-shop-loop-layout', '=', 'layout-9' )
                ),
            ),
            array(
                'id'       => 'templaza-shop-loop-description',
                'title'    => esc_html__( 'Show Description', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-loop-layout', '=' , 'layout-6'),
            ),
            array(
                'id'       => 'templaza-shop-loop-description-length',
                'type'     => 'spinner',
                'title'    => esc_html__('Description Length', 'templaza-framework'),
                'min'      => '1',
                'step'     => '1',
                'max'      => '500',
                'required' => array('templaza-shop-loop-layout', '=' , 'layout-6'),
            ),
        )
    )
);
//  Product Notifications Setting
Templaza_API::set_subsection('templaza_style', 'shop-page',
    array(
        'title'      => esc_html__( 'Product Notifications', 'templaza-framework' ),
        'id'         => 'shop-notify',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-notify',
                'type'     => 'select',
                'title'    => esc_html__('Added to Cart Notice', 'templaza-framework'),
                'subtitle' => esc_html__('Show notice when click add to cart button.', 'templaza-framework'),
                'options'  => array(
                    'panel'  => esc_html__( 'Open mini cart panel', 'templaza-framework' ),
                    'popup'  => esc_html__( 'Open cart popup', 'templaza-framework' ),
                    'simple' => esc_html__( 'Simple', 'templaza-framework' ),
                    'none'   => esc_html__( 'None', 'templaza-framework' ),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-notify-popup',
                'type'     => 'select',
                'title'    => esc_html__('Recommended Products', 'templaza-framework'),
                'subtitle' => esc_html__('Display Recommend product in popup.', 'templaza-framework'),
                'options'  => array(
                    'none'                  => esc_html__( 'None', 'templaza-framework' ),
                    'best_selling_products' => esc_html__( 'Best selling products', 'templaza-framework' ),
                    'featured_products'     => esc_html__( 'Featured products', 'templaza-framework' ),
                    'recent_products'       => esc_html__( 'Recent products', 'templaza-framework' ),
                    'sale_products'         => esc_html__( 'Sale products', 'templaza-framework' ),
                    'top_rated_products'    => esc_html__( 'Top rated products', 'templaza-framework' ),
                    'related_products'      => esc_html__( 'Related products', 'templaza-framework' ),
                    'upsells_products'      => esc_html__( 'Upsells products', 'templaza-framework' ),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-notify', '=' , 'popup'),
            ),
            array(
                'id'       => 'templaza-shop-notify-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Recommend Title', 'templaza-framework' ),
                'required' => array('templaza-shop-notify', '=' , 'popup'),
            ),
            array(
                'id'       => 'templaza-shop-notify-product-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Number of products', 'templaza-framework'),
                'min'      => '1',
                'step'     => '1',
                'max'      => '20',
                'required' => array('templaza-shop-notify', '=' , 'popup'),
            ),
            array(
                'id'       => 'templaza-shop-notify-autohide',
                'type'     => 'spinner',
                'title'    => esc_html__('Cart Notification Auto Hide', 'templaza-framework'),
                'subtitle' => esc_html__('Number seconds you want to hide the notification.', 'templaza-framework'),
                'min'      => '1',
                'step'     => '1',
                'max'      => '500',
                'required' => array('templaza-shop-notify', '=' , 'simple'),
            ),
            array(
                'id'       => 'templaza-shop-notify-wishlist',
                'title'    => esc_html__( 'Added to Wishlist Notification', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-notify-wishlist-autohide',
                'type'     => 'spinner',
                'title'    => esc_html__('Wishlist Notification Auto Hide', 'templaza-framework'),
                'subtitle' => esc_html__('Number seconds you want to hide the notification.', 'templaza-framework'),
                'min'      => '1',
                'step'     => '1',
                'max'      => '500',
                'required' => array('templaza-shop-notify-wishlist', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-single-image-lightbox',
                'title'    => esc_html__( 'Image Light box', 'templaza-framework' ),
                'type'     => 'select',
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
// Single Product Setting
Templaza_API::set_subsection('templaza_style', 'shop-page',
    array(
        'title'      => esc_html__( 'Single Product', 'templaza-framework' ),
        'id'         => 'shop-single',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-single-layout',
                'type'     => 'select',
                'title'    => esc_html__('Single Product Layout', 'templaza-framework'),
                'options'  => array(
                    'layout-1' => esc_html__( 'Layout 1', 'templaza-framework' ),
                    'layout-2' => esc_html__( 'Layout 2', 'templaza-framework' ),
                    'layout-3' => esc_html__( 'Layout 3', 'templaza-framework' ),
                    'layout-4' => esc_html__( 'Layout 4', 'templaza-framework' ),
                    'layout-5' => esc_html__( 'Layout 5', 'templaza-framework' ),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-single-box-background-color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background Color', 'templaza-framework' ),
                'subtitle' => esc_html__( 'Select the background color for boxed layout.', 'templaza-framework' ),
            ),
            array(
                'id'     => 'templaza-shop-single-box-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Single Box Padding', 'templaza-framework'),
                'default' => array(
                    'units' => 'px',
                ),
            ),
            array(
                'id'     => 'templaza-shop-single-box-margin',
                'type'   => 'spacing',
                'mode'   => 'margin',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Single Box Margin', 'templaza-framework'),
            ),
            array(
                'id'     => 'templaza-shop-single-content-max-width',
                'type'   => 'dimensions',
                'height' => false,
                'units'    => array('em','px','%'),
                'title'  => esc_html__('Description max width', 'templaza-framework'),
                'default' => array(
                    'width' => '',
                    'units' => '%',
                ),
            ),
            array(
                'id'       => 'templaza-shop-single-cart-ajax',
                'title'    => esc_html__( 'Add to cart with AJAX ', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-single-cart-sticky',
                'title'    => esc_html__( 'Sticky Add To Cart', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-single-cart-sticky-pos',
                'type'     => 'select',
                'title'    => esc_html__('Cart sticky position', 'templaza-framework'),
                'options'  => array(
                    'top'   => esc_html__( 'Top', 'templaza-framework' ),
                    'bottom' => esc_html__( 'Bottom', 'templaza-framework' ),

                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-single-cart-sticky', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-single-cart-sticky-atc-variable',
                'type'     => 'select',
                'title'    => esc_html__('Product Variable Style', 'templaza-framework'),
                'options'  => array(
                    'button'   => esc_html__( 'Button', 'templaza-framework' ),
                    'form' => esc_html__( 'Add to cart form', 'templaza-framework' ),

                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-single-cart-sticky', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-single-taxonomy',
                'type'     => 'select',
                'title'    => esc_html__('Product Taxonomy', 'templaza-framework'),
                'subtitle' => esc_html__( 'Show taxonomy above product title.', 'templaza-framework' ),
                'options'  => array(
                    'product_cat'   => esc_html__( 'Category', 'templaza-framework' ),
                    'product_brand' => esc_html__( 'Brand', 'templaza-framework' ),
                    ''              => esc_html__( 'None', 'templaza-framework' ),

                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-single-brand-type',
                'type'     => 'select',
                'title'    => esc_html__('Product Brand type', 'templaza-framework'),
                'options'  => array(
                    'title'   => esc_html__( 'Title', 'templaza-framework' ),
                    'logo' => esc_html__( 'Logo', 'templaza-framework' ),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-single-taxonomy', '=' , 'product_brand'),
            ),
            array(
                'id'       => 'templaza-shop-single-wishlist',
                'type'     => 'select',
                'title'    => esc_html__('Wishlist button', 'templaza-framework'),
                'options'  => array(
                    'icon' => esc_html__('Icon','templaza-framework'),
                    'title' => esc_html__('Icon & Title','templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-single-image-zoom',
                'title'    => esc_html__( 'Image Zoom', 'templaza-framework' ),
                'subtitle' => esc_html__( 'Zoom image when hover', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-single-image-lightbox',
                'title'    => esc_html__( 'Image Light box', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-single-thumb-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Thumbnail Slider Numbers', 'templaza-framework'),
                'min'      => '1',
                'step'     => '1',
                'max'      => '20',
            ),
            array(
                'id'       => 'templaza-shop-single-meta',
                'type'     => 'checkbox',
                'title'    => esc_html__('Product Meta', 'templaza-framework'),
                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    'sku'      => esc_html__( 'Sku', 'templaza-framework' ),
                    'tags'     => esc_html__( 'Tags', 'templaza-framework' ),
                    'category' => esc_html__( 'Category', 'templaza-framework' ),
                ),
                //See how default has changed? you also don't need to specify opts that are 0.
                'default' => array(
                    'sku' => '1',
                    'tags' => '1',
                    'category' => '1'
                ),
            ),
            array(
                'id'       => 'templaza-shop-single-content-tabs',
                'type'     => 'select',
                'title'    => esc_html__('Content Tabs Position', 'templaza-framework'),
                'options'  => array(
                    'default' => esc_html__('Under Slider','templaza-framework'),
                    'under_summary' => esc_html__('Under Product meta','templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),

        )
    )
);
// Related Product Setting
Templaza_API::set_subsection('templaza_style', 'shop-page',
    array(
        'title'      => esc_html__( 'Related Products', 'templaza-framework' ),
        'id'         => 'shop-related',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-related',
                'title'    => esc_html__( 'Show Related Products', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'true'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-related-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Related Title', 'templaza-framework' ),
                'default'  => esc_html__( 'Related Products', 'templaza-framework' ),
                'required' => array('templaza-shop-related', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-related-category',
                'title'    => esc_html__( 'Related Products by categories', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-related', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-related-parent-category',
                'title'    => esc_html__( 'Related Products by parent category', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-related', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-related-tag',
                'title'    => esc_html__( 'Related Products by tags', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-related', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-related-number',
                'type'     => 'text',
                'title'    => esc_html__('Related Products Numbers', 'templaza-framework'),
                'default'       => '',
                'required' => array('templaza-shop-related', '=' , true),
            ),

        )
    )
);
// Upsells Product Setting
Templaza_API::set_subsection('templaza_style', 'shop-page',
    array(
        'title'      => esc_html__( 'Upsells Products ', 'templaza-framework' ),
        'id'         => 'shop-upsells',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-upsells',
                'title'    => esc_html__( 'Show Upsells Products', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-upsells-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Upsells Title', 'templaza-framework' ),
                'required' => array('templaza-shop-upsells', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-upsells-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Upsells Products Numbers', 'templaza-framework'),
                'min'      => '1',
                'step'     => '1',
                'max'      => '50',
                'required' => array('templaza-shop-upsells', '=' , true),
            ),

        )
    )
);
// Recent Viewed Product Setting
Templaza_API::set_subsection('templaza_style', 'shop-page',
    array(
        'title'      => esc_html__( 'Recent Viewed Products ', 'templaza-framework' ),
        'id'         => 'shop-recent-viewed',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-recent-viewed',
                'title'    => esc_html__( 'Show Recent Viewed Products', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-recent-viewed-ajax',
                'title'    => esc_html__( 'Load With Ajax', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-recent-viewed-empty',
                'title'    => esc_html__('Hide Empty Products', 'templaza-framework' ),
                'subtitle'    => esc_html__('Check this option to hide the recently viewed products when empty.', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-recent-viewed-page',
                'type'     => 'checkbox',
                'title'    => esc_html__('Display on page', 'templaza-framework'),
                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    'single'   => esc_html__('Single Product', 'templaza-framework'),
                    'catalog'  => esc_html__('Catalog Page', 'templaza-framework'),
                    'cart'     => esc_html__('Cart Page', 'templaza-framework'),
                    'checkout' => esc_html__('Checkout Page', 'templaza-framework'),
                ),
                //See how default has changed? you also don't need to specify opts that are 0.
                'default' => array(
                    'single' => '1',
                    'catalog' => '0',
                    'cart' => '0',
                    'checkout' => '0'
                ),
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),

            array(
                'id'       => 'templaza-shop-recent-viewed-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Recently Viewed Title', 'templaza-framework' ),
                'default'  => esc_html__( 'Recently Viewed', 'templaza-framework' ),
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'    => 'templaza-shop-recent-viewed-readmore-text',
                'type'  => 'text',
                'title' => esc_html__( 'Read more text', 'templaza-framework' ),
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'    => 'templaza-shop-recent-viewed-readmore-url',
                'type'  => 'text',
                'title' => esc_html__( 'Read more url', 'templaza-framework' ),
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-recent-viewed-columns',
                'type'     => 'spinner',
                'title'    => esc_html__('Recent viewed columns', 'templaza-framework'),
                'min'      => '1',
                'step'     => '1',
                'max'      => '50',
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-recent-viewed-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Recent viewed numbers', 'templaza-framework'),
                'min'      => '1',
                'step'     => '1',
                'max'      => '50',
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),

        )
    )
);
// Badge Setting
Templaza_API::set_subsection('templaza_style', 'shop-page',
    array(
        'title'      => esc_html__( 'Product Badges', 'templaza-framework' ),
        'id'         => 'shop-badge',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-catalog-badges',
                'title'    => esc_html__( 'Catalog Badges', 'templaza-framework' ),
                'subtitle' => esc_html__( 'Display the badges in the catalog page', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-catalog-badges-layout',
                'type'     => 'select',
                'title'    => esc_html__('Badges Layout', 'templaza-framework'),
                'subtitle' => esc_html__('Badges Layout.', 'templaza-framework'),
                'options'  => array(
                    'layout-1' => esc_html__('Layout 1','templaza-framework'),
                    'layout-2' => esc_html__('Layout 2','templaza-framework'),
                ),
                'required' => array('templaza-shop-catalog-badges', '=' , true),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-single-badges',
                'title'    => esc_html__( 'Product Badges', 'templaza-framework' ),
                'subtitle' => esc_html__( 'Display the badges in the single page', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-badge-sale',
                'title'    => esc_html__( 'Enable Sale Badge', 'templaza-framework' ),
                'subtitle' => esc_html__( 'Display a badge for sale products', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-badge-sale-type',
                'type'     => 'select',
                'title'    => esc_html__('Badges Sale type', 'templaza-framework'),
                'options'  => array(
                    'percent' => esc_html__('Percent','templaza-framework'),
                    'text' => esc_html__('Text','templaza-framework'),
                    'both' => esc_html__('Both','templaza-framework'),
                ),
                'required' => array('templaza-shop-badge-sale', '=' , true),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-badge-sale-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Badge Sale text', 'templaza-framework' ),
                'desc'     => esc_html__( 'Use {%} to display discount percent, {$} to display discount amount.', 'templaza-framework' ),
            ),
            array(
                'id'       => 'templaza-shop-badge-new',
                'title'    => esc_html__( 'Enable New Badge', 'templaza-framework' ),
                'subtitle' => esc_html__( 'Display a badge for new products', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-badge-new-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Badge New text', 'templaza-framework' ),
                'required' => array('templaza-shop-badge-new', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-new-day',
                'type'     => 'spinner',
                'title'    => esc_html__('Product Newness', 'templaza-framework'),
                'desc'     => esc_html__('Display the "New" badge for how many days?', 'templaza-framework'),
                'min'      => '1',
                'step'     => '1',
                'max'      => '500',
                'required' => array('templaza-shop-badge-new', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-badge-featured',
                'title'    => esc_html__( 'Enable Featured Badge', 'templaza-framework' ),
                'subtitle' => esc_html__( 'Display a badge for featured products', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-badge-featured-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Badge Featured text', 'templaza-framework' ),
                'required' => array('templaza-shop-badge-featured', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-badge-soldout',
                'title'    => esc_html__( 'Enable Sold Out Badge', 'templaza-framework' ),
                'subtitle' => esc_html__( 'Display a badge for out of stock products', 'templaza-framework' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', 'templaza-framework'),
                    'off'         => esc_html__('Off', 'templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-badge-soldout-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Badge Sold out text', 'templaza-framework' ),
                'required' => array('templaza-shop-badge-soldout', '=' , true),
            ),


        )
    )
);

// Cart Setting
Templaza_API::set_subsection('templaza_style', 'shop-page',
    array(
        'title'      => esc_html__( 'Cart Page', 'templaza-framework' ),
        'id'         => 'shop-cart',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-cart-auto',
                'type'     => 'switch',
                'title'    => esc_html__( 'Update Cart Automatically', 'templaza-framework' ),
                'subtitle' => esc_html__( 'Automatically update cart when change product', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-cart-cross',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Cross-Sells Products ', 'templaza-framework' ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-cart-cross-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Cross-Sells Products Title', 'templaza-framework' ),
                'default'  => esc_html__( 'You may also like', 'templaza-framework' ),
                'required' => array('templaza-shop-cart-cross', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-cart-cross-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Cross-Sells Products Numbers', 'templaza-framework'),
                'default'  => '6',
                'min'      => '1',
                'step'     => '1',
                'max'      => '500',
                'required' => array('templaza-shop-cart-cross', '=' , true),
            ),
        )
    )
);
// Login Setting
Templaza_API::set_subsection('templaza_style', 'shop-page',
    array(
        'title'      => esc_html__( 'Mini cart', 'templaza-framework' ),
        'id'         => 'mini-cart',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-mini-cart',
                'type'     => 'select',
                'title'    => esc_html__('Login type', 'templaza-framework'),
                'options'  => array(
                    'modal' => esc_html__('Modal','templaza-framework'),
                    'link' => esc_html__('Link','templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
        )
    )
);
// Login Setting
Templaza_API::set_subsection('templaza_style', 'shop-page',
    array(
        'title'      => esc_html__( 'Account Login', 'templaza-framework' ),
        'id'         => 'account-login',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-account-login',
                'type'     => 'select',
                'title'    => esc_html__('Login type', 'templaza-framework'),
                'options'  => array(
                    'modal' => esc_html__('Modal','templaza-framework'),
                    'link' => esc_html__('Link','templaza-framework'),
                ),
                'placeholder'   => esc_html__('Inherit', 'templaza-framework'),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-account-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Login text', 'templaza-framework' ),
            ),

        )
    )
);