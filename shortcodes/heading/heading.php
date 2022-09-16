<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\CSS;
use TemPlazaFramework\Templates;
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
                        'title'    => esc_html__('Enable Custom Heading', 'templaza-framework'),
                        'subtitle' => esc_html__('If set to on, the heading will be display custom heading.', 'templaza-framework'),
                        'desc'     => esc_html__('Default is get_the_title()', 'templaza-framework'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'custom_heading',
                        'type'     => 'text',
                        'title'    => esc_html__('Custom Heading', 'templaza-framework'),
                        'required' => array('enable_custom_heading', '=', true),
                    ),
                    array(
                        'id'       => 'heading_tag',
                        'type'     => 'select',
                        'title'    => esc_html__('Heading Tag', 'templaza-framework'),
                        'subtitle' => esc_html__('Select heading tag from the list', 'templaza-framework'),
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
                        'title'    => esc_html__('Heading Inner Tag', 'templaza-framework'),
                        'subtitle' => esc_html__('The heading will be added span tag to heading tag', 'templaza-framework'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'enable_heading_custom_font',
                        'type'     => 'switch',
                        'title'    => esc_html__('Heading Custom font', 'templaza-framework'),
                        'default'  => false,
                    ),
                    array(
                        /* To use this id is a variable. You should create id with "_" character*/
                        'id'                      => 'typography_heading_element',
                        'type'                    => 'typography',
                        'title'                   => esc_html__( 'Heading Font', 'templaza-framework' ),
                        'subtitle'                => esc_html__( 'Specify Heading font properties.', 'templaza-framework' ),
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
                        'title'  => esc_html__('Heading Margin', 'templaza-framework'),
                        'default' => array(
                            'units' => 'px'
                        ),
                    ),
                    array(
                        'id'       => 'enable_heading_single',
                        'type'     => 'switch',
                        'title'    => esc_html__('Show heading in single post', 'templaza-framework'),
                        'subtitle' => esc_html__('The heading will be show in single post', 'templaza-framework'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'enable_heading_single_meta',
                        'type'     => 'switch',
                        'title'    => esc_html__('Show meta in single post', 'templaza-framework'),
                        'default'  => false,
                        'required' => array('enable_heading_single', '=', true),
                    ),
                    array(
                        'id'       => 'heading_custom_class',
                        'type'     => 'text',
                        'title'    => esc_html__('Heading Custom Class', 'templaza-framework'),
                        'subtitle' => esc_html__('Custom class will be added to heading tag.', 'templaza-framework'),
                    ),
                )
            );
        }


        public function prepare_params($params, $element, $parent_el)
        {

//            $css = array('desktop' => '', 'tablet' => '', 'mobile' => '');
            $css = Templates::get_devices(true);

            $custom_css_name    = 'tz_custom_'.$element['id'].' '
                .(isset($params['heading_tag'])?$params['heading_tag']:'h1');
            if(isset($params['heading_margin']) && !empty($params['heading_margin'])){

                $margin    = CSS::make_spacing_redux('margin', $params['heading_margin'], true, 'px');

                if(!empty($margin)){
                    if(is_array($margin)){
                        foreach($margin as $device => $pcss){
                            if(!isset($css[$device])){
                                $css[$device]   = '';
                            }
                            $css[$device] .= $pcss;
                        }
                    }else{
                        $css['desktop'] .= $margin;
                    }
                }

                if(!empty($css)){
                    if(is_array($css)){
                        if(count($css)){
                            foreach ($css as $device => $style){
                                if(!empty($style)) {
                                    $style  = '.'.$custom_css_name.'{'.$style.'}';
                                    Templates::add_inline_style($style, $device);
                                }
                            }
                        }
                    }else{
                        Templates::add_inline_style($css);
                    }
                }
            }

            return parent::prepare_params($params, $element, $parent_el);
        }
    }

}

?>