<?php

defined('TEMPLAZA_FRAMEWORK') or exit();
// -> START Shop Section
Templaza_API::set_section('settings', array(
        'title' => esc_html__( 'Woocommerce Options', $this -> text_domain),
        'id'    => 'Woocommerce-options',
        'icon'  => 'el el-shopping-cart'
    )
);
Templaza_API::set_section('settings',
    array(
        'title'      => esc_html__( 'Product Catalog', $this -> text_domain ),
        'id'         => 'shop-page',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-layout',
                'type'     => 'select',
                'title'    => esc_html__('Shop Layout', $this -> text_domain),
                'subtitle' => esc_html__('Default style list or grid for Shop page.', $this -> text_domain),
                'options'  => array(
                    'grid' => esc_html__('Grid', $this -> text_domain),
                    'masonry' => esc_html__('Masonry', $this -> text_domain),
                ),
                'default'  => 'grid',
            ),
            array(
                'id'       => 'templaza-shop-column-large',
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
                'required' => array('templaza-shop-layout', '=' , 'grid')
            ),
            array(
                'id'       => 'templaza-shop-column',
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
                'required' => array('templaza-shop-layout', '=' , 'grid')
            ),
            array(
                'id'       => 'templaza-shop-column-laptop',
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
                'required' => array('templaza-shop-layout', '=' , 'grid')
            ),
            array(
                'id'       => 'templaza-shop-column-tablet',
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
                'required' => array('templaza-shop-layout', '=' , 'grid')
            ),
            array(
                'id'       => 'templaza-shop-column-mobile',
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
                'required' => array('templaza-shop-layout', '=' , 'grid')
            ),
            array(
                'id'       => 'templaza-shop-column-gap',
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
                'required' => array('templaza-shop-layout', '=' , 'grid')
            ),
            array(
                'id'       => 'templaza-shop-products_per_page',
                'type'     => 'spinner',
                'title'    => esc_html__('Products per page.', $this -> text_domain),
                'subtitle' => esc_html__('Products per page.', $this -> text_domain),
                'default'  => '9',
                'min'      => '1',
                'step'     => '1',
                'max'      => '500',
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
                'title'  => esc_html__('Item Summary Padding', $this -> text_domain),
            ),
            array(
                'id'     => 'templaza-shop-margin',
                'type'   => 'spacing',
                'mode'   => 'margin',
                'all'    => false,
                'allow_responsive'    => true,
                'units'  => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                'title'  => esc_html__('Item Summary Margin', $this -> text_domain),
            ),

            array(
                'id'       => 'templaza-shop-pagination',
                'type'     => 'select',
                'title'    => esc_html__('Shop Pagination', $this -> text_domain),
                'subtitle' => esc_html__('Pagination Type.', $this -> text_domain),
                'options'  => array(
                    'number' => esc_html__('Number',$this -> text_domain),
                    'loadmore' => esc_html__('Button Load more',$this -> text_domain),
                    'scroll' => esc_html__('Infinite Scroll',$this -> text_domain),
                ),
                'default'  => 'number',
            ),
            array(
                'id'       => 'templaza_shop_show_title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Title', $this -> text_domain ),
                'subtitle' => esc_html__( 'Show/hide Title.', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza_shop_show_rating',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Rating', $this -> text_domain ),
                'subtitle' => esc_html__( 'Show/hide Rating.', $this -> text_domain ),
                'default'  => true,
            ),
        )
    )
);

// Product Loop Setting
Templaza_API::set_subsection('settings', 'shop-page',
    array(
        'title'      => esc_html__( 'Product Loop', $this -> text_domain ),
        'id'         => 'shop-product-loop',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-loop-layout',
                'type'     => 'select',
                'title'    => esc_html__('Product Loop Layout', $this -> text_domain),
                'options'  => array(
                    'layout-1' => esc_html__( 'Icons over thumbnail on hover', $this -> text_domain ),
                    'layout-2' => esc_html__( 'Icons & Quick view button', $this -> text_domain ),
                    'layout-3' => esc_html__( 'Icons & Add to cart button', $this -> text_domain ),
                    'layout-4' => esc_html__( 'Icons on the bottom', $this -> text_domain ),
                    'layout-5' => esc_html__( 'Simple', $this -> text_domain ),
                    'layout-6' => esc_html__( 'Standard button', $this -> text_domain ),
                    'layout-7' => esc_html__( 'Info on hover', $this -> text_domain ),
                    'layout-8' => esc_html__( 'Icons & Add to cart text', $this -> text_domain ),
                    'layout-9' => esc_html__( 'Quick Shop button', $this -> text_domain ),
                ),
                'default'  => 'layout-1',
            ),
            array(
                'id'       => 'templaza-shop-loop-hover',
                'type'     => 'select',
                'title'    => esc_html__('Product Loop Hover', $this -> text_domain),
                'options'  => array(
                    'classic' => esc_html__( 'Default', $this -> text_domain ),
                    'slider'  => esc_html__( 'Slider', $this -> text_domain ),
                    'fadein'  => esc_html__( 'Fadein', $this -> text_domain ),
                    'zoom'    => esc_html__( 'Zoom', $this -> text_domain ),
                ),
                'default'  => 'classic',
                'required' => array('templaza-shop-loop-layout', '!=' , 'layout-7'),
            ),
            array(
                'id'       => 'templaza-shop-loop-featured-icons',
                'type'     => 'checkbox',
                'title'    => esc_html__('Featured Icons', $this -> text_domain),

                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    'cart'  => esc_html__( 'Cart', $this -> text_domain ),
                    'quickview' => esc_html__( 'Quick View', $this -> text_domain ),
                    'wishlist' => esc_html__( 'Wishlist', $this -> text_domain ),
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
                'type'     => 'switch',
                'title'    => esc_html__( 'Always Display Wishlist', $this -> text_domain ),
                'default'  => true,
                'required' => array('templaza-shop-loop-layout', '=' , array('layout-2','layout-3','layout-9')),
            ),
            array(
                'id'       => 'templaza-shop-loop-attributes',
                'type'     => 'checkbox',
                'title'    => esc_html__('Attributes', $this -> text_domain),

                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    'taxonomy' => esc_html__( 'Taxonomy', $this -> text_domain ),
                    'rating'   => esc_html__( 'Rating', $this -> text_domain ),
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
                'title'    => esc_html__('Product Loop Taxonomy', $this -> text_domain),
                'options'  => array(
                    'product_cat'   => esc_html__( 'Category', $this -> text_domain ),
                    'product_brand' => esc_html__( 'Brand', $this -> text_domain ),
                ),
                'default'  => 'product_cat',
                'required' => array(
                    array( 'templaza-shop-loop-attributes', '=', 'taxonomy' ),
                    array( 'templaza-shop-loop-attributes', '=', '1' )
                ),
            ),
            array(
                'id'       => 'templaza-shop-loop-variation',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Variations', $this -> text_domain ),
                'default'  => true,
                'required' => array('templaza-shop-loop-layout', '=' , array('layout-8','layout-9')),
            ),
            array(
                'id'       => 'templaza-shop-loop-variation-ajax',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Variations With AJAX', $this -> text_domain ),
                'default'  => true,
                'required' => array(
                    array( 'templaza-shop-loop-variation', '=', true ),
                    array( 'templaza-shop-loop-layout', '=', 'layout-9' )
                ),
            ),
            array(
                'id'       => 'templaza-shop-loop-description',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Description', $this -> text_domain ),
                'default'  => true,
                'required' => array('templaza-shop-loop-layout', '=' , 'layout-6'),
            ),
            array(
                'id'       => 'templaza-shop-loop-description-length',
                'type'     => 'spinner',
                'title'    => esc_html__('Description Length', $this -> text_domain),
                'default'  => '10',
                'min'      => '1',
                'step'     => '1',
                'max'      => '500',
                'required' => array('templaza-shop-loop-layout', '=' , 'layout-6'),
            ),
        )
    )
);
//  Product Notifications Setting
Templaza_API::set_subsection('settings', 'shop-page',
    array(
        'title'      => esc_html__( 'Product Notifications', $this -> text_domain ),
        'id'         => 'shop-notify',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-notify',
                'type'     => 'select',
                'title'    => esc_html__('Added to Cart Notice', $this -> text_domain),
                'subtitle' => esc_html__('Show notice when click add to cart button.', $this -> text_domain),
                'options'  => array(
                    'panel'  => esc_html__( 'Open mini cart panel', $this -> text_domain ),
                    'popup'  => esc_html__( 'Open cart popup', $this -> text_domain ),
                    'simple' => esc_html__( 'Simple', $this -> text_domain ),
                    'none'   => esc_html__( 'None', $this -> text_domain ),
                ),
                'default'  => 'panel',
            ),
            array(
                'id'       => 'templaza-shop-notify-popup',
                'type'     => 'select',
                'title'    => esc_html__('Recommended Products', $this -> text_domain),
                'subtitle' => esc_html__('Display Recommend product in popup.', $this -> text_domain),
                'options'  => array(
                    'none'                  => esc_html__( 'None', $this -> text_domain ),
                    'best_selling_products' => esc_html__( 'Best selling products', $this -> text_domain ),
                    'featured_products'     => esc_html__( 'Featured products', $this -> text_domain ),
                    'recent_products'       => esc_html__( 'Recent products', $this -> text_domain ),
                    'sale_products'         => esc_html__( 'Sale products', $this -> text_domain ),
                    'top_rated_products'    => esc_html__( 'Top rated products', $this -> text_domain ),
                    'related_products'      => esc_html__( 'Related products', $this -> text_domain ),
                    'upsells_products'      => esc_html__( 'Upsells products', $this -> text_domain ),
                ),
                'default'  => 'related_products',
                'required' => array('templaza-shop-notify', '=' , 'popup'),
            ),
            array(
                'id'       => 'templaza-shop-notify-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Recommend Title', $this -> text_domain ),
                'default'  => esc_html__( 'You may also like', $this -> text_domain ),
                'required' => array('templaza-shop-notify', '=' , 'popup'),
            ),
            array(
                'id'       => 'templaza-shop-notify-product-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Number of products', $this -> text_domain),
                'default'  => '6',
                'min'      => '1',
                'step'     => '1',
                'max'      => '20',
                'required' => array('templaza-shop-notify', '=' , 'popup'),
            ),
            array(
                'id'       => 'templaza-shop-notify-autohide',
                'type'     => 'spinner',
                'title'    => esc_html__('Cart Notification Auto Hide', $this -> text_domain),
                'subtitle' => esc_html__('Number seconds you want to hide the notification.', $this -> text_domain),
                'default'  => '3',
                'min'      => '1',
                'step'     => '1',
                'max'      => '500',
                'required' => array('templaza-shop-notify', '=' , 'simple'),
            ),
            array(
                'id'       => 'templaza-shop-notify-wishlist',
                'type'     => 'switch',
                'title'    => esc_html__( 'Added to Wishlist Notification', $this -> text_domain ),
                'default'  => false,
            ),
            array(
                'id'       => 'templaza-shop-notify-wishlist-autohide',
                'type'     => 'spinner',
                'title'    => esc_html__('Wishlist Notification Auto Hide', $this -> text_domain),
                'subtitle' => esc_html__('Number seconds you want to hide the notification.', $this -> text_domain),
                'default'  => '3',
                'min'      => '1',
                'step'     => '1',
                'max'      => '500',
                'required' => array('templaza-shop-notify-wishlist', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-single-image-lightbox',
                'type'     => 'switch',
                'title'    => esc_html__( 'Image Light box', $this -> text_domain ),
                'default'  => false,
            ),
        )
    )
);
// Single Product Setting
Templaza_API::set_subsection('settings', 'shop-page',
    array(
        'title'      => esc_html__( 'Single Product', $this -> text_domain ),
        'id'         => 'shop-single',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-single-layout',
                'type'     => 'select',
                'title'    => esc_html__('Single Product Layout', $this -> text_domain),
                'options'  => array(
                    'layout-1' => esc_html__( 'Layout 1', $this -> text_domain ),
                    'layout-2' => esc_html__( 'Layout 2', $this -> text_domain ),
                    'layout-3' => esc_html__( 'Layout 3', $this -> text_domain ),
                    'layout-4' => esc_html__( 'Layout 4', $this -> text_domain ),
                    'layout-5' => esc_html__( 'Layout 5', $this -> text_domain ),
                ),
                'default'  => 'layout-1',
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
                'type'     => 'switch',
                'title'    => esc_html__( 'Add to cart with AJAX ', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-single-cart-sticky',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky Add To Cart', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-single-cart-sticky-pos',
                'type'     => 'select',
                'title'    => esc_html__('Cart sticky position', $this -> text_domain),
                'options'  => array(
                    'top'   => esc_html__( 'Top', $this -> text_domain ),
                    'bottom' => esc_html__( 'Bottom', $this -> text_domain ),

                ),
                'default'  => 'top',
                'required' => array('templaza-shop-single-cart-sticky', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-single-cart-sticky-atc-variable',
                'type'     => 'select',
                'title'    => esc_html__('Product Variable Style', $this -> text_domain),
                'options'  => array(
                    'button'   => esc_html__( 'Button', $this -> text_domain ),
                    'form' => esc_html__( 'Add to cart form', $this -> text_domain ),

                ),
                'default'  => 'button',
                'required' => array('templaza-shop-single-cart-sticky', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-single-taxonomy',
                'type'     => 'select',
                'title'    => esc_html__('Product Taxonomy', $this -> text_domain),
                'subtitle' => esc_html__( 'Show taxonomy above product title.', $this -> text_domain ),
                'options'  => array(
                    'product_cat'   => esc_html__( 'Category', $this -> text_domain ),
                    'product_brand' => esc_html__( 'Brand', $this -> text_domain ),
                    ''              => esc_html__( 'None', $this -> text_domain ),

                ),
                'default'  => '',
            ),
            array(
                'id'       => 'templaza-shop-single-brand-type',
                'type'     => 'select',
                'title'    => esc_html__('Product Brand type', $this -> text_domain),
                'options'  => array(
                    'title'   => esc_html__( 'Title', $this -> text_domain ),
                    'logo' => esc_html__( 'Logo', $this -> text_domain ),
                ),
                'default'  => 'title',
                'required' => array('templaza-shop-single-taxonomy', '=' , 'product_brand'),
            ),
            array(
                'id'       => 'templaza-shop-single-wishlist',
                'type'     => 'select',
                'title'    => esc_html__('Wishlist button', $this -> text_domain),
                'options'  => array(
                    'icon' => esc_html__('Icon',$this -> text_domain),
                    'title' => esc_html__('Icon & Title',$this -> text_domain),
                ),
                'default'  => 'icon',
            ),
            array(
                'id'       => 'templaza-shop-single-image-zoom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Image Zoom', $this -> text_domain ),
                'subtitle' => esc_html__( 'Zoom image when hover', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-single-image-lightbox',
                'type'     => 'switch',
                'title'    => esc_html__( 'Image Light box', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-single-thumb-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Thumbnail Slider Numbers', $this -> text_domain),
                'default'  => '4',
                'min'      => '1',
                'step'     => '1',
                'max'      => '20',
            ),
            array(
                'id'       => 'templaza-shop-single-meta',
                'type'     => 'checkbox',
                'title'    => esc_html__('Product Meta', $this -> text_domain),
                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    'sku'      => esc_html__( 'Sku', $this -> text_domain ),
                    'tags'     => esc_html__( 'Tags', $this -> text_domain ),
                    'category' => esc_html__( 'Category', $this -> text_domain ),
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
                'title'    => esc_html__('Content Tabs Position', $this -> text_domain),
                'options'  => array(
                    'default' => esc_html__('Under Slider',$this -> text_domain),
                    'under_summary' => esc_html__('Under Product meta',$this -> text_domain),
                ),
                'default'  => 'default',
            ),

        )
    )
);
// Related Product Setting
Templaza_API::set_subsection('settings', 'shop-page',
    array(
        'title'      => esc_html__( 'Related Products', $this -> text_domain ),
        'id'         => 'shop-related',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-related',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Related Products', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-related-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Related Title', $this -> text_domain ),
                'default'  => esc_html__( 'Related Products', $this -> text_domain ),
                'required' => array('templaza-shop-related', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-related-category',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Products by categories', $this -> text_domain ),
                'default'  => true,
                'required' => array('templaza-shop-related', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-related-parent-category',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Products by parent category', $this -> text_domain ),
                'default'  => false,
                'required' => array('templaza-shop-related', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-related-tag',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Products by tags', $this -> text_domain ),
                'default'  => true,
                'required' => array('templaza-shop-related', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-related-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Related Products Numbers', $this -> text_domain),
                'default'  => '4',
                'min'      => '1',
                'step'     => '1',
                'max'      => '50',
                'required' => array('templaza-shop-related', '=' , true),
            ),

        )
    )
);
// Upsells Product Setting
Templaza_API::set_subsection('settings', 'shop-page',
    array(
        'title'      => esc_html__( 'Upsells Products ', $this -> text_domain ),
        'id'         => 'shop-upsells',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-upsells',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Upsells Products', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-upsells-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Upsells Title', $this -> text_domain ),
                'default'  => esc_html__( 'You may also like', $this -> text_domain ),
                'required' => array('templaza-shop-upsells', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-upsells-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Upsells Products Numbers', $this -> text_domain),
                'default'  => '6',
                'min'      => '1',
                'step'     => '1',
                'max'      => '50',
                'required' => array('templaza-shop-upsells', '=' , true),
            ),

        )
    )
);
// Recent Viewed Product Setting
Templaza_API::set_subsection('settings', 'shop-page',
    array(
        'title'      => esc_html__( 'Recent Viewed Products ', $this -> text_domain ),
        'id'         => 'shop-recent-viewed',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-recent-viewed',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Recent Viewed Products', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-recent-viewed-ajax',
                'type'     => 'switch',
                'title'    => esc_html__( 'Load With Ajax', $this -> text_domain ),
                'default'  => true,
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-recent-viewed-empty',
                'type'     => 'switch',
                'title'    => esc_html__('Hide Empty Products', $this -> text_domain ),
                'subtitle'    => esc_html__('Check this option to hide the recently viewed products when empty.', $this -> text_domain ),
                'default'  => true,
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-recent-viewed-page',
                'type'     => 'checkbox',
                'title'    => esc_html__('Display on page', $this -> text_domain),
                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    'single'   => esc_html__('Single Product', $this -> text_domain),
                    'catalog'  => esc_html__('Catalog Page', $this -> text_domain),
                    'cart'     => esc_html__('Cart Page', $this -> text_domain),
                    'checkout' => esc_html__('Checkout Page', $this -> text_domain),
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
                'title'    => esc_html__( 'Recently Viewed Title', $this -> text_domain ),
                'default'  => esc_html__( 'Recently Viewed', $this -> text_domain ),
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'    => 'templaza-shop-recent-viewed-readmore-text',
                'type'  => 'text',
                'title' => esc_html__( 'Read more text', $this -> text_domain ),
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'    => 'templaza-shop-recent-viewed-readmore-url',
                'type'  => 'text',
                'title' => esc_html__( 'Read more url', $this -> text_domain ),
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-recent-viewed-columns',
                'type'     => 'spinner',
                'title'    => esc_html__('Recent viewed columns', $this -> text_domain),
                'default'  => '4',
                'min'      => '1',
                'step'     => '1',
                'max'      => '50',
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-recent-viewed-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Recent viewed numbers', $this -> text_domain),
                'default'  => '6',
                'min'      => '1',
                'step'     => '1',
                'max'      => '50',
                'required' => array('templaza-shop-recent-viewed', '=' , true),
            ),

        )
    )
);
// Badge Setting
Templaza_API::set_subsection('settings', 'shop-page',
    array(
        'title'      => esc_html__( 'Product Badges', $this -> text_domain ),
        'id'         => 'shop-badge',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-catalog-badges',
                'type'     => 'switch',
                'title'    => esc_html__( 'Catalog Badges', $this -> text_domain ),
                'subtitle' => esc_html__( 'Display the badges in the catalog page', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-catalog-badges-layout',
                'type'     => 'select',
                'title'    => esc_html__('Badges Layout', $this -> text_domain),
                'subtitle' => esc_html__('Badges Layout.', $this -> text_domain),
                'options'  => array(
                    'layout-1' => esc_html__('Layout 1',$this -> text_domain),
                    'layout-2' => esc_html__('Layout 2',$this -> text_domain),
                ),
                'required' => array('templaza-shop-catalog-badges', '=' , true),
                'default'  => 'layout-1',
            ),
            array(
                'id'       => 'templaza-shop-single-badges',
                'type'     => 'switch',
                'title'    => esc_html__( 'Product Badges', $this -> text_domain ),
                'subtitle' => esc_html__( 'Display the badges in the single page', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-badge-sale',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Sale Badge', $this -> text_domain ),
                'subtitle' => esc_html__( 'Display a badge for sale products', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-badge-sale-type',
                'type'     => 'select',
                'title'    => esc_html__('Badges Sale type', $this -> text_domain),
                'options'  => array(
                    'percent' => esc_html__('Percent',$this -> text_domain),
                    'text' => esc_html__('Text',$this -> text_domain),
                    'both' => esc_html__('Both',$this -> text_domain),
                ),
                'required' => array('templaza-shop-badge-sale', '=' , true),
                'default'  => 'text',
            ),
            array(
                'id'       => 'templaza-shop-badge-sale-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Badge Sale text', $this -> text_domain ),
                'desc'     => esc_html__( 'Use {%} to display discount percent, {$} to display discount amount.', $this -> text_domain ),
                'default'  => esc_html__( 'Sale', $this -> text_domain ),
            ),
            array(
                'id'       => 'templaza-shop-badge-new',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable New Badge', $this -> text_domain ),
                'subtitle' => esc_html__( 'Display a badge for new products', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-badge-new-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Badge New text', $this -> text_domain ),
                'default'  => esc_html__( 'New', $this -> text_domain ),
                'required' => array('templaza-shop-badge-new', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-new-day',
                'type'     => 'spinner',
                'title'    => esc_html__('Product Newness', $this -> text_domain),
                'desc'     => esc_html__('Display the "New" badge for how many days?', $this -> text_domain),
                'default'  => '5',
                'min'      => '1',
                'step'     => '1',
                'max'      => '500',
                'required' => array('templaza-shop-badge-new', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-badge-featured',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Featured Badge', $this -> text_domain ),
                'subtitle' => esc_html__( 'Display a badge for featured products', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-badge-featured-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Badge Featured text', $this -> text_domain ),
                'default'  => esc_html__( 'Hot', $this -> text_domain ),
                'required' => array('templaza-shop-badge-featured', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-badge-soldout',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Sold Out Badge', $this -> text_domain ),
                'subtitle' => esc_html__( 'Display a badge for out of stock products', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-badge-soldout-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Badge Sold out text', $this -> text_domain ),
                'default'  => esc_html__( 'Sold Out', $this -> text_domain ),
                'required' => array('templaza-shop-badge-soldout', '=' , true),
            ),


        )
    )
);

// Cart Setting
Templaza_API::set_subsection('settings', 'shop-page',
    array(
        'title'      => esc_html__( 'Cart Page', $this -> text_domain ),
        'id'         => 'shop-cart',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-cart-auto',
                'type'     => 'switch',
                'title'    => esc_html__( 'Update Cart Automatically', $this -> text_domain ),
                'subtitle' => esc_html__( 'Automatically update cart when change product', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-cart-cross',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Cross-Sells Products ', $this -> text_domain ),
                'default'  => true,
            ),
            array(
                'id'       => 'templaza-shop-cart-cross-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Cross-Sells Products Title', $this -> text_domain ),
                'default'  => esc_html__( 'You may also like', $this -> text_domain ),
                'required' => array('templaza-shop-cart-cross', '=' , true),
            ),
            array(
                'id'       => 'templaza-shop-cart-cross-number',
                'type'     => 'spinner',
                'title'    => esc_html__('Cross-Sells Products Numbers', $this -> text_domain),
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
Templaza_API::set_subsection('settings', 'shop-page',
    array(
        'title'      => esc_html__( 'Mini cart', $this -> text_domain ),
        'id'         => 'mini-cart',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-mini-cart',
                'type'     => 'select',
                'title'    => esc_html__('Login type', $this -> text_domain),
                'options'  => array(
                    'modal' => esc_html__('Modal',$this -> text_domain),
                    'link' => esc_html__('Link',$this -> text_domain),
                ),
                'default'  => 'modal',
            ),
        )
    )
);
// Login Setting
Templaza_API::set_subsection('settings', 'shop-page',
    array(
        'title'      => esc_html__( 'Account Login', $this -> text_domain ),
        'id'         => 'account-login',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'templaza-shop-account-login',
                'type'     => 'select',
                'title'    => esc_html__('Login type', $this -> text_domain),
                'options'  => array(
                    'modal' => esc_html__('Modal',$this -> text_domain),
                    'link' => esc_html__('Link',$this -> text_domain),
                ),
                'default'  => 'modal',
            ),
            array(
                'id'       => 'templaza-shop-account-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Login text', $this -> text_domain ),
            ),

        )
    )
);