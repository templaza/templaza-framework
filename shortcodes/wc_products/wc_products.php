<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_WC_Products')){
    class TemplazaFramework_ShortCode_WC_Products extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'wc_products',
                'icon'        => 'fas fa-box-open',
                'title'       => __('Woo Products', 'templaza-framework'),
                'param_title' => esc_html__('Woocommerce Products Settings', 'templaza-framework'),
                'desc'        => __('Load Woo Products.', 'templaza-framework'),
                'admin_label' => true,
                'params'      => array(
                    array(
                        'id'       => 'title',
                        'type'     => 'text',
                        'title'    => __( 'Widget Title', 'templaza-framework' ),
                        'subtitle' => __( 'What text use as a widget title. Leave blank to use default widget title..', 'templaza-framework' ),
                    ),
                    array(
                        'id'       => 'widget_heading',
                        'type'     => 'select',
                        'title'    => esc_html__('Widget Title HTML Element', 'templaza-framework'),
                        'subtitle' => esc_html__('Select Widget title HTML element from the list', 'templaza-framework'),
                        'options'  => array(
                            'h1'   => 'h1',
                            'h2'   => 'h2',
                            'h3'   => 'h3',
                            'h4'   => 'h4',
                            'h5'   => 'h5',
                            'h6'   => 'h6',
                        ),
                        'default'  => 'h3',
//                        'required' => array('title', 'not_empty_and', ''),
//                        'required' => array('title', 'not', ''),
                    ),
                    array(
                        'id'       => 'number',
                        'type'     => 'text',
                        'validate' => 'numeric',
                        'title'    => __( 'Number of products to show', 'templaza-framework' ),
                        'default' => 5
                    ),
                    array(
                        'id'       => 'show',
                        'type'     => 'select',
                        'title'    => __( 'Show', 'templaza-framework' ),
                        'options'  => array(
                            'all'       => esc_html__('All products', 'templaza-framework'),
                            'featured'  => esc_html__('Featured products', 'templaza-framework'),
                            'onsale'    => esc_html__('On-sale products', 'templaza-framework'),
                        ),
                        'default' => 'all',
                    ),
                    array(
                        'id'       => 'orderby',
                        'type'     => 'select',
                        'title'    => __( 'Order by', 'templaza-framework' ),
                        'options'  => array(
                            'date'  => esc_html__('Date', 'templaza-framework'),
                            'price'  => esc_html__('Price', 'templaza-framework'),
                            'rand'  => esc_html__('Random', 'templaza-framework'),
                            'sales'  => esc_html__('Sales', 'templaza-framework'),
                        ),
                        'default' => 'date',
                    ),
                    array(
                        'id'       => 'order',
                        'type'     => 'select',
                        'title'    => __( 'Order', 'templaza-framework' ),
                        'options'  => array(
                            'asc'  => esc_html__('ASC', 'templaza-framework'),
                            'desc'  => esc_html__('DESC', 'templaza-framework'),
                        ),
                        'default' => 'desc',
                    ),
                    array(
                        'id'       => 'hide_free',
                        'type'     => 'switch',
                        'title'    => __( 'Hide free products', 'templaza-framework' ),
                        'default' => false,
                    ),
                    array(
                        'id'       => 'show_hidden',
                        'type'     => 'switch',
                        'title'    => __( 'Show hidden products', 'templaza-framework' ),
                        'default' => false,
                    ),
                )
            );
        }
    }

}

?>