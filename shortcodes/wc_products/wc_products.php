<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_WC_Products')){
    class TemplazaFramework_ShortCode_WC_Products extends TemplazaFramework_ShortCode {

        public function register(){
            return array(
                'id'          => 'wc_products',
                'icon'        => 'fas fa-box-open',
                'title'       => __('Woo Products', $this -> text_domain),
                'param_title' => esc_html__('Woocommerce Products Settings', $this -> text_domain),
                'desc'        => __('Load Woo Products.', $this -> text_domain),
                'admin_label' => true,
                'params'      => array(
                    array(
                        'id'       => 'title',
                        'type'     => 'text',
                        'title'    => __( 'Widget Title', $this -> text_domain ),
                        'subtitle' => __( 'What text use as a widget title. Leave blank to use default widget title..', $this -> text_domain ),
                    ),
                    array(
                        'id'       => 'widget_heading',
                        'type'     => 'select',
                        'title'    => esc_html__('Widget Title HTML Element', $this -> text_domain),
                        'subtitle' => esc_html__('Select Widget title HTML element from the list', $this -> text_domain),
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
                        'title'    => __( 'Number of products to show', $this -> text_domain ),
                        'default' => 5
                    ),
                    array(
                        'id'       => 'show',
                        'type'     => 'select',
                        'title'    => __( 'Show', $this -> text_domain ),
                        'options'  => array(
                            'all'       => esc_html__('All products', $this -> text_domain),
                            'featured'  => esc_html__('Featured products', $this -> text_domain),
                            'onsale'    => esc_html__('On-sale products', $this -> text_domain),
                        ),
                        'default' => 'all',
                    ),
                    array(
                        'id'       => 'orderby',
                        'type'     => 'select',
                        'title'    => __( 'Order by', $this -> text_domain ),
                        'options'  => array(
                            'date'  => esc_html__('Date', $this -> text_domain),
                            'price'  => esc_html__('Price', $this -> text_domain),
                            'rand'  => esc_html__('Random', $this -> text_domain),
                            'sales'  => esc_html__('Sales', $this -> text_domain),
                        ),
                        'default' => 'date',
                    ),
                    array(
                        'id'       => 'order',
                        'type'     => 'select',
                        'title'    => __( 'Order', $this -> text_domain ),
                        'options'  => array(
                            'asc'  => esc_html__('ASC', $this -> text_domain),
                            'desc'  => esc_html__('DESC', $this -> text_domain),
                        ),
                        'default' => 'desc',
                    ),
                    array(
                        'id'       => 'hide_free',
                        'type'     => 'switch',
                        'title'    => __( 'Hide free products', $this -> text_domain ),
                        'default' => false,
                    ),
                    array(
                        'id'       => 'show_hidden',
                        'type'     => 'switch',
                        'title'    => __( 'Show hidden products', $this -> text_domain ),
                        'default' => false,
                    ),
                )
            );
        }
    }

}

?>