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
                        'id'       => 'enable_heading_custom_font',
                        'type'     => 'switch',
                        'title'    => esc_html__('Heading Custom font', $this -> text_domain),
                        'default'  => false,
                    ),
                    array(
                        /* To use this id is a variable. You should create id with "_" character*/
                        'id'                      => 'typography_heading_element',
                        'type'                    => 'typography',
                        'title'                   => esc_html__( 'Heading Font', $this -> text_domain ),
                        'subtitle'                => esc_html__( 'Specify Heading font properties.', $this -> text_domain ),
                        'required'                => array('enable_heading_custom_font', '=', 'true'),
                        'color'                   => true,
                        'text-align'              => false,
                        'preview'                 => true, // Disable the previewer
                        'word-spacing'            => false,
                        'letter-spacing'          => true,
                        'text-transform'          => true,
                        'font-backup'             => true,
                        'allow_responsive'        => true,
                        'allow_empty_line_height' => true,
                        'google'                  => true,
                        'units'                   => array(
                            'font-size'   => 'px',
                            'line-height' => 'em',
                        ),
                        'default'                 => array(
                            'color'          => '',
                            'font-weight'    => '',
                            'letter-spacing' => '',
                            'text-transform' => 'none',
                        ),
                    ),
                    array(
                        'id'     => 'heading_margin',
                        'type'   => 'spacing',
                        'mode'   => 'margin',
                        'all'    => false,
                        'allow_responsive'    => true,
                        'units'  => array( 'em', 'rem', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                        'title'  => esc_html__('Custom Margin', $this -> text_domain),
                        'default' => array(
                            'units' => 'px'
                        ),
                    ),
                    array(
                        'id'       => 'enable_heading_single',
                        'type'     => 'switch',
                        'title'    => esc_html__('Show heading in single post', $this -> text_domain),
                        'subtitle' => esc_html__('The heading will be show in single post', $this -> text_domain),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'enable_heading_single_meta',
                        'type'     => 'switch',
                        'title'    => esc_html__('Show meta in single post', $this -> text_domain),
                        'default'  => false,
                        'required' => array('enable_heading_single', '=', true),
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