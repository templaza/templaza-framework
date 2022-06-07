<?php

defined('TEMPLAZA_FRAMEWORK') or exit();
// -> START Shop Section
Templaza_API::set_section('templaza_style', array(
        'title' => esc_html__( 'Woocommerce Options', 'agruco'),
        'id'    => 'Woocommerce-options',
        'icon'  => 'el el-shopping-cart'
    )
);
Templaza_API::set_section('templaza_style',
    array(
        'title'      => esc_html__( 'Product Catalog', 'agruco' ),
        'id'         => 'shop-page',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-layout',
                'type'     => 'select',
                'title'    => esc_html__('Shop Layout', 'agruco'),
                'subtitle' => esc_html__('Default style list or grid for Shop page.', 'agruco'),
                'options'  => array(
                    'grid' => esc_html__('Grid', 'agruco'),
                    'masonry' => esc_html__('Masonry', 'agruco'),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-column-large',
                'type'     => 'select',
                'title'    => esc_html__('Large Desktop Columns', 'agruco'),
                'subtitle' => esc_html__('Number products per row large desktop (1600px and larger)', 'agruco'),
                'options'  => array(
                    '1' => esc_html__('1 Column', 'agruco'),
                    '2' => esc_html__('2 Columns', 'agruco'),
                    '3' => esc_html__('3 Columns', 'agruco'),
                    '4' => esc_html__('4 Columns', 'agruco'),
                    '5' => esc_html__('5 Columns', 'agruco'),
                    '6' => esc_html__('6 Columns', 'agruco'),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-layout', '=' , 'grid')
            ),
            array(
                'id'       => 'templaza-shop-column',
                'type'     => 'select',
                'title'    => esc_html__('Desktop Columns', 'agruco'),
                'subtitle' => esc_html__('Number products per row (1200px and larger)', 'agruco'),
                'options'  => array(
                    '1' => esc_html__('1 Column', 'agruco'),
                    '2' => esc_html__('2 Columns', 'agruco'),
                    '3' => esc_html__('3 Columns', 'agruco'),
                    '4' => esc_html__('4 Columns', 'agruco'),
                    '5' => esc_html__('5 Columns', 'agruco'),
                    '6' => esc_html__('6 Columns', 'agruco'),
                ),
                'required' => array('templaza-shop-layout', '=' , 'grid'),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-column-laptop',
                'type'     => 'select',
                'title'    => esc_html__('Laptop Columns', 'agruco'),
                'subtitle' => esc_html__('Number products per row (960px and larger)', 'agruco'),
                'options'  => array(
                    '1' => esc_html__('1 Column', 'agruco'),
                    '2' => esc_html__('2 Columns', 'agruco'),
                    '3' => esc_html__('3 Columns', 'agruco'),
                    '4' => esc_html__('4 Columns', 'agruco'),
                    '5' => esc_html__('5 Columns', 'agruco'),
                    '6' => esc_html__('6 Columns', 'agruco'),
                ),
                'required' => array('templaza-shop-layout', '=' , 'grid'),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-column-tablet',
                'type'     => 'select',
                'title'    => esc_html__('Tablet Columns', 'agruco'),
                'subtitle' => esc_html__('Number products per row (640px and larger)', 'agruco'),
                'options'  => array(
                    '1' => esc_html__('1 Column', 'agruco'),
                    '2' => esc_html__('2 Columns', 'agruco'),
                    '3' => esc_html__('3 Columns', 'agruco'),
                    '4' => esc_html__('4 Columns', 'agruco'),
                    '5' => esc_html__('5 Columns', 'agruco'),
                    '6' => esc_html__('6 Columns', 'agruco'),
                ),
                'required' => array('templaza-shop-layout', '=' , 'grid'),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-column-mobile',
                'type'     => 'select',
                'title'    => esc_html__('Mobile Columns', 'agruco'),
                'subtitle' => esc_html__('Number products per row mobile', 'agruco'),
                'options'  => array(
                    '1' => esc_html__('1 Column', 'agruco'),
                    '2' => esc_html__('2 Columns', 'agruco'),
                    '3' => esc_html__('3 Columns', 'agruco'),
                    '4' => esc_html__('4 Columns', 'agruco'),
                    '5' => esc_html__('5 Columns', 'agruco'),
                    '6' => esc_html__('6 Columns', 'agruco'),
                ),
                'required' => array('templaza-shop-layout', '=' , 'grid'),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-column-gap',
                'type'     => 'select',
                'title'    => esc_html__('Column Gap', 'agruco'),
                'subtitle' => esc_html__('Column Gap grid.', 'agruco'),
                'options'  => array(
                    'default' => esc_html__('Default','agruco'),
                    'small' => esc_html__('Small','agruco'),
                    'medium' => esc_html__('Medium','agruco'),
                    'large' => esc_html__('Large','agruco'),
                    'collapse' => esc_html__('Collapse','agruco'),
                ),
                'required' => array('templaza-shop-layout', '=' , 'grid'),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-products_per_page',
                'type'     => 'text',
                'title'    => esc_html__('Products per page.', 'agruco'),
                'subtitle' => esc_html__('Products per page.', 'agruco'),
                'default'  => '',
            ),
            array(
                'id'       => 'templaza-shop-background-color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Item Background Color', $this -> text_domain ),
                'subtitle' => esc_html__( 'Select the background color for Shop item.', $this -> text_domain ),
            ),
            array(
                'id'     => 'templaza-shop-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Item Summary Padding', 'agruco'),
            ),
            array(
                'id'     => 'templaza-shop-margin',
                'type'   => 'spacing',
                'mode'   => 'margin',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Item Summary Margin', 'agruco'),
            ),

            array(
                'id'       => 'templaza-shop-pagination',
                'type'     => 'select',
                'title'    => esc_html__('Shop Pagination', 'agruco'),
                'subtitle' => esc_html__('Pagination Type.', 'agruco'),
                'options'  => array(
                    'number' => esc_html__('Number','agruco'),
                    'loadmore' => esc_html__('Button Load more','agruco'),
                    'scroll' => esc_html__('Infinite Scroll','agruco'),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza_shop_show_title',
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
                'id'       => 'templaza_shop_show_rating',
                'title'    => esc_html__( 'Show Rating', 'agruco' ),
                'subtitle' => esc_html__( 'Show/hide Rating.', 'agruco' ),
                'type'     => 'select',
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

// Product Loop Setting
Templaza_API::set_subsection('templaza_style', 'shop-page',
    array(
        'title'      => esc_html__( 'Product Loop', 'agruco' ),
        'id'         => 'shop-product-loop',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-loop-layout',
                'type'     => 'select',
                'title'    => esc_html__('Product Loop Layout', 'agruco'),
                'options'  => array(
                    'layout-1' => esc_html__( 'Icons over thumbnail on hover', 'agruco' ),
                    'layout-2' => esc_html__( 'Icons & Quick view button', 'agruco' ),
                    'layout-3' => esc_html__( 'Icons & Add to cart button', 'agruco' ),
                    'layout-4' => esc_html__( 'Icons on the bottom', 'agruco' ),
                    'layout-5' => esc_html__( 'Simple', 'agruco' ),
                    'layout-6' => esc_html__( 'Standard button', 'agruco' ),
                    'layout-7' => esc_html__( 'Info on hover', 'agruco' ),
                    'layout-8' => esc_html__( 'Icons & Add to cart text', 'agruco' ),
                    'layout-9' => esc_html__( 'Quick Shop button', 'agruco' ),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-loop-hover',
                'type'     => 'select',
                'title'    => esc_html__('Product Loop Hover', 'agruco'),
                'options'  => array(
                    'classic' => esc_html__( 'Default', 'agruco' ),
                    'slider'  => esc_html__( 'Slider', 'agruco' ),
                    'fadein'  => esc_html__( 'Fadein', 'agruco' ),
                    'zoom'    => esc_html__( 'Zoom', 'agruco' ),
                ),
                'required' => array('templaza-shop-loop-layout', '!=' , 'layout-7'),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-loop-featured-icons',
                'type'     => 'checkbox',
                'title'    => esc_html__('Featured Icons', 'agruco'),

                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    'cart'  => esc_html__( 'Cart', 'agruco' ),
                    'quickview' => esc_html__( 'Quick View', 'agruco' ),
                    'wishlist' => esc_html__( 'Wishlist', 'agruco' ),
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
                'title'    => esc_html__( 'Always Display Wishlist', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-loop-layout', '=' , array('layout-2','layout-3','layout-9')),
            ),
            array(
                'id'       => 'templaza-shop-loop-attributes',
                'type'     => 'checkbox',
                'title'    => esc_html__('Attributes', 'agruco'),

                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    'taxonomy' => esc_html__( 'Taxonomy', 'agruco' ),
                    'rating'   => esc_html__( 'Rating', 'agruco' ),
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
                'title'    => esc_html__('Product Loop Taxonomy', 'agruco'),
                'options'  => array(
                    'product_cat'   => esc_html__( 'Category', 'agruco' ),
                    'product_brand' => esc_html__( 'Brand', 'agruco' ),
                ),
                'required' => array(
                    array( 'templaza-shop-loop-attributes', '=', 'taxonomy' ),
                    array( 'templaza-shop-loop-attributes', '=', '1' )
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-loop-variation',
                'title'    => esc_html__( 'Show Variations', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-loop-layout', '=' , array('layout-8','layout-9')),
            ),
            array(
                'id'       => 'templaza-shop-loop-variation-ajax',
                'title'    => esc_html__( 'Show Variations With AJAX', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array(
                    array( 'templaza-shop-loop-variation', '=', true ),
                    array( 'templaza-shop-loop-layout', '=', 'layout-9' )
                ),
            ),
            array(
                'id'       => 'templaza-shop-loop-description',
                'title'    => esc_html__( 'Show Description', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-loop-layout', '=' , 'layout-6'),
            ),
            array(
                'id'       => 'templaza-shop-loop-description-length',
                'type'     => 'spinner',
                'title'    => esc_html__('Description Length', 'agruco'),
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
        'title'      => esc_html__( 'Product Notifications', 'agruco' ),
        'id'         => 'shop-notify',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-notify',
                'type'     => 'select',
                'title'    => esc_html__('Added to Cart Notice', 'agruco'),
                'subtitle' => esc_html__('Show notice when click add to cart button.', 'agruco'),
                'options'  => array(
                    'panel'  => esc_html__( 'Open mini cart panel', 'agruco' ),
                    'popup'  => esc_html__( 'Open cart popup', 'agruco' ),
                    'simple' => esc_html__( 'Simple', 'agruco' ),
                    'none'   => esc_html__( 'None', 'agruco' ),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-notify-popup',
                'type'     => 'select',
                'title'    => esc_html__('Recommended Products', 'agruco'),
                'subtitle' => esc_html__('Display Recommend product in popup.', 'agruco'),
                'options'  => array(
                    'none'                  => esc_html__( 'None', 'agruco' ),
                    'best_selling_products' => esc_html__( 'Best selling products', 'agruco' ),
                    'featured_products'     => esc_html__( 'Featured products', 'agruco' ),
                    'recent_products'       => esc_html__( 'Recent products', 'agruco' ),
                    'sale_products'         => esc_html__( 'Sale products', 'agruco' ),
                    'top_rated_products'    => esc_html__( 'Top rated products', 'agruco' ),
                    'related_products'      => esc_html__( 'Related products', 'agruco' ),
                    'upsells_products'      => esc_html__( 'Upsells products', 'agruco' ),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-notify', '=' , 'popup'),
            ),
            array(
                'id'       => 'templaza-shop-notify-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Recommend Title', 'agruco' ),
                'required' => array('templaza-shop-notify', '=' , 'popup'),
            ),
            array(
                'id'       => 'templaza-shop-notify-product-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Number of products', 'agruco'),
                'min'      => '1',
                'step'     => '1',
                'max'      => '20',
                'required' => array('templaza-shop-notify', '=' , 'popup'),
            ),
            array(
                'id'       => 'templaza-shop-notify-autohide',
                'type'     => 'spinner',
                'title'    => esc_html__('Cart Notification Auto Hide', 'agruco'),
                'subtitle' => esc_html__('Number seconds you want to hide the notification.', 'agruco'),
                'min'      => '1',
                'step'     => '1',
                'max'      => '500',
                'required' => array('templaza-shop-notify', '=' , 'simple'),
            ),
            array(
                'id'       => 'templaza-shop-notify-wishlist',
                'title'    => esc_html__( 'Added to Wishlist Notification', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-notify-wishlist-autohide',
                'type'     => 'spinner',
                'title'    => esc_html__('Wishlist Notification Auto Hide', 'agruco'),
                'subtitle' => esc_html__('Number seconds you want to hide the notification.', 'agruco'),
                'min'      => '1',
                'step'     => '1',
                'max'      => '500',
                'required' => array('templaza-shop-notify-wishlist', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-single-image-lightbox',
                'title'    => esc_html__( 'Image Light box', 'agruco' ),
                'type'     => 'select',
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
// Single Product Setting
Templaza_API::set_subsection('templaza_style', 'shop-page',
    array(
        'title'      => esc_html__( 'Single Product', 'agruco' ),
        'id'         => 'shop-single',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-single-layout',
                'type'     => 'select',
                'title'    => esc_html__('Single Product Layout', 'agruco'),
                'options'  => array(
                    'layout-1' => esc_html__( 'Layout 1', 'agruco' ),
                    'layout-2' => esc_html__( 'Layout 2', 'agruco' ),
                    'layout-3' => esc_html__( 'Layout 3', 'agruco' ),
                    'layout-4' => esc_html__( 'Layout 4', 'agruco' ),
                    'layout-5' => esc_html__( 'Layout 5', 'agruco' ),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-single-box-background-color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background Color', $this -> text_domain ),
                'subtitle' => esc_html__( 'Select the background color for boxed layout.', $this -> text_domain ),
            ),
            array(
                'id'     => 'templaza-shop-single-box-padding',
                'type'   => 'spacing',
                'mode'   => 'padding',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Single Box Padding', $this -> text_domain),
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
                'title'  => esc_html__('Single Box Margin', $this -> text_domain),
            ),
            array(
                'id'     => 'templaza-shop-single-content-max-width',
                'type'   => 'dimensions',
                'height' => false,
                'units'    => array('em','px','%'),
                'title'  => esc_html__('Description max width', $this -> text_domain),
                'default' => array(
                    'width' => '',
                    'units' => '%',
                ),
            ),
            array(
                'id'       => 'templaza-shop-single-cart-ajax',
                'title'    => esc_html__( 'Add to cart with AJAX ', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-single-cart-sticky',
                'title'    => esc_html__( 'Sticky Add To Cart', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-single-cart-sticky-pos',
                'type'     => 'select',
                'title'    => esc_html__('Cart sticky position', 'agruco'),
                'options'  => array(
                    'top'   => esc_html__( 'Top', 'agruco' ),
                    'bottom' => esc_html__( 'Bottom', 'agruco' ),

                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-single-cart-sticky', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-single-cart-sticky-atc-variable',
                'type'     => 'select',
                'title'    => esc_html__('Product Variable Style', 'agruco'),
                'options'  => array(
                    'button'   => esc_html__( 'Button', 'agruco' ),
                    'form' => esc_html__( 'Add to cart form', 'agruco' ),

                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-single-cart-sticky', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-single-taxonomy',
                'type'     => 'select',
                'title'    => esc_html__('Product Taxonomy', 'agruco'),
                'subtitle' => esc_html__( 'Show taxonomy above product title.', 'agruco' ),
                'options'  => array(
                    'product_cat'   => esc_html__( 'Category', 'agruco' ),
                    'product_brand' => esc_html__( 'Brand', 'agruco' ),
                    ''              => esc_html__( 'None', 'agruco' ),

                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-single-brand-type',
                'type'     => 'select',
                'title'    => esc_html__('Product Brand type', 'agruco'),
                'options'  => array(
                    'title'   => esc_html__( 'Title', 'agruco' ),
                    'logo' => esc_html__( 'Logo', 'agruco' ),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-single-taxonomy', '=' , 'product_brand'),
            ),
            array(
                'id'       => 'templaza-shop-single-wishlist',
                'type'     => 'select',
                'title'    => esc_html__('Wishlist button', 'agruco'),
                'options'  => array(
                    'icon' => esc_html__('Icon','agruco'),
                    'title' => esc_html__('Icon & Title','agruco'),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-single-image-zoom',
                'title'    => esc_html__( 'Image Zoom', 'agruco' ),
                'subtitle' => esc_html__( 'Zoom image when hover', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-single-image-lightbox',
                'title'    => esc_html__( 'Image Light box', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-single-thumb-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Thumbnail Slider Numbers', 'agruco'),
                'min'      => '1',
                'step'     => '1',
                'max'      => '20',
            ),
            array(
                'id'       => 'templaza-shop-single-meta',
                'type'     => 'checkbox',
                'title'    => esc_html__('Product Meta', 'agruco'),
                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    'sku'      => esc_html__( 'Sku', 'agruco' ),
                    'tags'     => esc_html__( 'Tags', 'agruco' ),
                    'category' => esc_html__( 'Category', 'agruco' ),
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
                'title'    => esc_html__('Content Tabs Position', 'agruco'),
                'options'  => array(
                    'default' => esc_html__('Under Slider','agruco'),
                    'under_summary' => esc_html__('Under Product meta','agruco'),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),

        )
    )
);
// Related Product Setting
Templaza_API::set_subsection('templaza_style', 'shop-page',
    array(
        'title'      => esc_html__( 'Related Products', 'agruco' ),
        'id'         => 'shop-related',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-related',
                'title'    => esc_html__( 'Show Related Products', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-related-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Related Title', 'agruco' ),
                'default'  => esc_html__( 'Related Products', 'agruco' ),
                'required' => array('templaza-shop-related', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-related-category',
                'title'    => esc_html__( 'Related Products by categories', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-related', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-related-parent-category',
                'title'    => esc_html__( 'Related Products by parent category', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-related', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-related-tag',
                'title'    => esc_html__( 'Related Products by tags', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-related', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-related-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Related Products Numbers', 'agruco'),
                'min'      => '1',
                'step'     => '1',
                'max'      => '50',
                'required' => array('templaza-shop-related', '=' , true),
            ),

        )
    )
);
// Upsells Product Setting
Templaza_API::set_subsection('templaza_style', 'shop-page',
    array(
        'title'      => esc_html__( 'Upsells Products ', 'agruco' ),
        'id'         => 'shop-upsells',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-upsells',
                'title'    => esc_html__( 'Show Upsells Products', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-upsells-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Upsells Title', 'agruco' ),
                'required' => array('templaza-shop-upsells', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-upsells-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Upsells Products Numbers', 'agruco'),
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
        'title'      => esc_html__( 'Recent Viewed Products ', 'agruco' ),
        'id'         => 'shop-recent-viewed',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-recent-viewed',
                'title'    => esc_html__( 'Show Recent Viewed Products', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-recent-viewed-ajax',
                'title'    => esc_html__( 'Load With Ajax', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-recent-viewed-empty',
                'title'    => esc_html__('Hide Empty Products', 'agruco' ),
                'subtitle'    => esc_html__('Check this option to hide the recently viewed products when empty.', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-recent-viewed-page',
                'type'     => 'checkbox',
                'title'    => esc_html__('Display on page', 'agruco'),
                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    'single'   => esc_html__('Single Product', 'agruco'),
                    'catalog'  => esc_html__('Catalog Page', 'agruco'),
                    'cart'     => esc_html__('Cart Page', 'agruco'),
                    'checkout' => esc_html__('Checkout Page', 'agruco'),
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
                'title'    => esc_html__( 'Recently Viewed Title', 'agruco' ),
                'default'  => esc_html__( 'Recently Viewed', 'agruco' ),
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'    => 'templaza-shop-recent-viewed-readmore-text',
                'type'  => 'text',
                'title' => esc_html__( 'Read more text', 'agruco' ),
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'    => 'templaza-shop-recent-viewed-readmore-url',
                'type'  => 'text',
                'title' => esc_html__( 'Read more url', 'agruco' ),
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-recent-viewed-columns',
                'type'     => 'spinner',
                'title'    => esc_html__('Recent viewed columns', 'agruco'),
                'min'      => '1',
                'step'     => '1',
                'max'      => '50',
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-recent-viewed-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Recent viewed numbers', 'agruco'),
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
        'title'      => esc_html__( 'Product Badges', 'agruco' ),
        'id'         => 'shop-badge',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-catalog-badges',
                'title'    => esc_html__( 'Catalog Badges', 'agruco' ),
                'subtitle' => esc_html__( 'Display the badges in the catalog page', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-catalog-badges-layout',
                'type'     => 'select',
                'title'    => esc_html__('Badges Layout', 'agruco'),
                'subtitle' => esc_html__('Badges Layout.', 'agruco'),
                'options'  => array(
                    'layout-1' => esc_html__('Layout 1','agruco'),
                    'layout-2' => esc_html__('Layout 2','agruco'),
                ),
                'required' => array('templaza-shop-catalog-badges', '=' , true),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-single-badges',
                'title'    => esc_html__( 'Product Badges', 'agruco' ),
                'subtitle' => esc_html__( 'Display the badges in the single page', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-badge-sale',
                'title'    => esc_html__( 'Enable Sale Badge', 'agruco' ),
                'subtitle' => esc_html__( 'Display a badge for sale products', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-badge-sale-type',
                'type'     => 'select',
                'title'    => esc_html__('Badges Sale type', 'agruco'),
                'options'  => array(
                    'percent' => esc_html__('Percent','agruco'),
                    'text' => esc_html__('Text','agruco'),
                    'both' => esc_html__('Both','agruco'),
                ),
                'required' => array('templaza-shop-badge-sale', '=' , true),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-badge-sale-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Badge Sale text', 'agruco' ),
                'desc'     => esc_html__( 'Use {%} to display discount percent, {$} to display discount amount.', 'agruco' ),
            ),
            array(
                'id'       => 'templaza-shop-badge-new',
                'title'    => esc_html__( 'Enable New Badge', 'agruco' ),
                'subtitle' => esc_html__( 'Display a badge for new products', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-badge-new-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Badge New text', 'agruco' ),
                'required' => array('templaza-shop-badge-new', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-new-day',
                'type'     => 'spinner',
                'title'    => esc_html__('Product Newness', 'agruco'),
                'desc'     => esc_html__('Display the "New" badge for how many days?', 'agruco'),
                'min'      => '1',
                'step'     => '1',
                'max'      => '500',
                'required' => array('templaza-shop-badge-new', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-badge-featured',
                'title'    => esc_html__( 'Enable Featured Badge', 'agruco' ),
                'subtitle' => esc_html__( 'Display a badge for featured products', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-badge-featured-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Badge Featured text', 'agruco' ),
                'required' => array('templaza-shop-badge-featured', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-badge-soldout',
                'title'    => esc_html__( 'Enable Sold Out Badge', 'agruco' ),
                'subtitle' => esc_html__( 'Display a badge for out of stock products', 'agruco' ),
                'type'     => 'select',
                'options'       => array(
                    'on'         => esc_html__('On', $this -> text_domain),
                    'off'         => esc_html__('Off', $this -> text_domain),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-badge-soldout-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Badge Sold out text', 'agruco' ),
                'required' => array('templaza-shop-badge-soldout', '=' , true),
            ),


        )
    )
);

// Cart Setting
Templaza_API::set_subsection('templaza_style', 'shop-page',
    array(
        'title'      => esc_html__( 'Cart Page', 'agruco' ),
        'id'         => 'shop-cart',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-cart-auto',
                'type'     => 'switch',
                'title'    => esc_html__( 'Update Cart Automatically', 'agruco' ),
                'subtitle' => esc_html__( 'Automatically update cart when change product', 'agruco' ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-cart-cross',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Cross-Sells Products ', 'agruco' ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-cart-cross-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Cross-Sells Products Title', 'agruco' ),
                'default'  => esc_html__( 'You may also like', 'agruco' ),
                'required' => array('templaza-shop-cart-cross', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-cart-cross-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Cross-Sells Products Numbers', 'agruco'),
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
        'title'      => esc_html__( 'Mini cart', 'agruco' ),
        'id'         => 'mini-cart',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-mini-cart',
                'type'     => 'select',
                'title'    => esc_html__('Login type', 'agruco'),
                'options'  => array(
                    'modal' => esc_html__('Modal','agruco'),
                    'link' => esc_html__('Link','agruco'),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
        )
    )
);
// Login Setting
Templaza_API::set_subsection('templaza_style', 'shop-page',
    array(
        'title'      => esc_html__( 'Account Login', 'agruco' ),
        'id'         => 'account-login',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-account-login',
                'type'     => 'select',
                'title'    => esc_html__('Login type', 'agruco'),
                'options'  => array(
                    'modal' => esc_html__('Modal','agruco'),
                    'link' => esc_html__('Link','agruco'),
                ),
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),
            array(
                'id'       => 'templaza-shop-account-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Login text', 'agruco' ),
            ),
            array(
                'id'          => 'templaza-shop-account-icon',
                'type'        => 'select',
                'title'       => esc_html__( 'Login icon', 'agruco' ),
                'data'        => 'fontawesome',
                'placeholder'   => esc_html__('Inherit', $this -> text_domain),
                'select2'       => array( 'allowClear' => true ),
                'default'       => '',
            ),

        )
    )
);