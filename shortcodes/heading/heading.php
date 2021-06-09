<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Heading')){
    class TemplazaFramework_ShortCode_Heading extends TemplazaFramework_ShortCode {

        public function __construct($field_parent = array(), $value = '', $parent = '')
        {
//            $this -> hooks();

            parent::__construct($field_parent, $value, $parent);
        }

//        public function hooks(){
//            add_filter('templaza-framework/layout/generate/shortcode/'.$this -> get_shortcode_name().'/after_shortcode',
//                array($this, 'after_shortcode'));
//        }

//        public function after_shortcode($shortcode){
//
//            $options        = Functions::get_theme_options();
//            $header         = isset($options['enable-header'])?(bool) $options['enable-header']:true;
//
//            if(!$header){
//                return '';
//            }
//
//            return $shortcode;
//        }

        public function register(){
            return array(
                'id'          => 'heading',
                'icon'        => 'fas fa-heading',
                'title'       => __('Heading'),
                'param_title' => __('Heading settings'),
                'desc'        => __('Load a heading.'),
                'admin_label' => true,
                'params'      => array(
                    array(
                        'id'       => 'enable_custom_heading',
                        'type'     => 'switch',
                        'title'    => esc_html__('Enable Custom Heading', $this -> text_domain),
                        'subtitle' => esc_html__('If set to on, the heading will be display custom heading.', $this -> text_domain),
                        'desc'     => esc_html__('Default is get_the_title()', $this -> text_domain),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'custom_heading',
                        'type'     => 'text',
                        'title'    => esc_html__('Custom Heading', $this -> text_domain),
                        'required' => array('enable_custom_heading', '=', true),
                    ),
                    array(
                        'id'       => 'heading_tag',
                        'type'     => 'select',
                        'title'    => esc_html__('Heading Tag', $this -> text_domain),
                        'subtitle' => esc_html__('Select heading tag from the list', $this -> text_domain),
                        'options'  => array(
                            'h1'   => 'h1',
                            'h2'   => 'h2',
                            'h3'   => 'h3',
                            'h4'   => 'h4',
                            'h5'   => 'h5',
                            'h6'   => 'h6',
                        ),
                        'default'  => 'h1',
                    ),
                    array(
                        'id'       => 'enable_heading_inner_tag',
                        'type'     => 'switch',
                        'title'    => esc_html__('Heading Inner Tag', $this -> text_domain),
                        'subtitle' => esc_html__('The heading will be added span tag to heading tag', $this -> text_domain),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'heading_custom_class',
                        'type'     => 'text',
                        'title'    => esc_html__('Heading Custom Class', $this -> text_domain),
                        'subtitle' => esc_html__('Custom class will be added to heading tag.', $this -> text_domain),
                    ),
                )
            );
        }
//        public function prepare_params($params, $element){
//            $params = parent::prepare_params($params, $element);
//
//
//            return $params;
//        }
    }

}

?>