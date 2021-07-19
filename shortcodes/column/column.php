<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Column')){
    class TemplazaFramework_ShortCode_Column extends TemplazaFramework_ShortCode {

        public function __construct($field_parent = array(), $value = '', $parent = '')
        {
            $this -> hooks();

            parent::__construct($field_parent, $value, $parent);
        }

        public function hooks(){
            add_filter('templaza-framework/layout/generate/shortcode/'.$this -> get_shortcode_name().'/prepare', array($this, 'prepare_options'));
        }

        public function prepare_options($item){
            $item['has_children_shortcode']    = true;
            return $item;
        }

        public function register(){
            return array(
                'id'          => 'column',
                'title'       => __('Column'),
                'param_title' => esc_html__('Column Settings'),
                'desc'        => __('Place content elements inside the row'),
                'core'        => true, // This shortcode doesn't list in element list when add new element in column
                'params'      => array(
                    array(
                        'id'    => 'tabs',
                        'type'  => 'tz_tab',
                        'tabs'  => array(
                            // General settings
                            array(
                                'id' => 'settings',
                                'title'  => esc_html__('General Settings', $this -> text_domain),
                                'fields' => array(
//                                    array(
//                                        'id'       => 'customclass',
//                                        'type'     => 'text',
//                                        'title'    => esc_html__('Custom Class', $this -> text_domain),
//                                        'subtitle' => esc_html__('Custom Class can be used for writing custom CSS or JS.', $this -> text_domain),
//                                        'default'  => 'test',
//                                    ),
//                                    array(
//                                        'id'       => 'customid',
//                                        'type'     => 'text',
//                                        'title'    => esc_html__('Custom ID', $this -> text_domain),
//                                        'subtitle' => esc_html__('Custom ID can be used for overriding the auto-generated id.', $this -> text_domain),
//                                        'default'  => time(),
//                                    ),
                                ),
                            ), // End general settings

                            // Design settings
                            array(
                                'id'     => 'design-settings',
                                'title'  => esc_html__('Design Settings', $this -> text_domain),
                                'fields' => array(
                                    array(
                                        'id'    => 'background',
                                        'type'  => 'background',
                                        'title' => esc_html__('Background'),
                                    ),
                                    array(
                                        'id'         => 'border',
                                        'type'       => 'border',
                                        'title'      => __('Border', $this -> text_domain),
                                    ),
                                    array(
                                        'id'     => 'tab-custom_colors',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Custom Colors', $this -> text_domain),
                                    ),
                                    array(
                                        'id'       => 'text_color',
                                        'type'     => 'color',
                                        'title'    => esc_html__('Text Color', $this -> text_domain),
//                                        'required' => array('custom_colors', '=', '1'),
                                    ),
                                    array(
                                        'id'       => 'link_color',
                                        'type'     => 'link_color',
                                        'title'    => esc_html__('Link Color', $this -> text_domain),
//                                        'required' => array('custom_colors', '=', '1'),
                                    ),
                                    array(
                                        'id'     => 'tab-custom_colors-end',
                                        'type'   => 'section',
                                        'indent' => false, // Indent all options below until the next 'section' option is set.
                                    ),
                                )
                            ), // End design settings

                            // Responsive settings
                            array(
                                'id'     => 'responsive-settings',
                                'title'  => esc_html__('Responsive Settings', $this -> text_domain),
                                'fields' => array(
                                    array(
                                        'id'     => 'tab-extra-small',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Extra small', $this -> text_domain),
                                        'subtitle'   => esc_html__('<576px', $this -> text_domain),
                                    ),
                                    array(
                                        'id'      => 'xs_column_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Column size'),
                                        'options' => array(
                                            'inherit' => esc_html__('Inherit', $this -> text_domain),
                                            '1'       => esc_html__('col-xs-1', $this -> text_domain),
                                            '2'       => esc_html__('col-xs-2', $this -> text_domain),
                                            '3'       => esc_html__('col-xs-3', $this -> text_domain),
                                            '4'       => esc_html__('col-xs-4', $this -> text_domain),
                                            '5'       => esc_html__('col-xs-5', $this -> text_domain),
                                            '6'       => esc_html__('col-xs-6', $this -> text_domain),
                                            '7'       => esc_html__('col-xs-7', $this -> text_domain),
                                            '8'       => esc_html__('col-xs-8', $this -> text_domain),
                                            '9'       => esc_html__('col-xs-9', $this -> text_domain),
                                            '10'      => esc_html__('col-xs-10', $this -> text_domain),
                                            '11'      => esc_html__('col-xs-11', $this -> text_domain),
                                            '12'      => esc_html__('col-xs-12', $this -> text_domain),
                                        )
                                    ),
                                    array(
                                        'id'      => 'xs_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visibility'),
                                        'default' => true,
                                    ),
                                    // Small subsection
                                    array(
                                        'id'     => 'tab-small',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Small', $this -> text_domain),
                                        'subtitle'   => esc_html__('>=576px', $this -> text_domain),
                                    ),
                                    array(
                                        'id'      => 'sm_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Column size'),
                                        'options' => array(
                                            'inherit' => esc_html__('Inherit', $this -> text_domain),
                                            '1'       => esc_html__('col-sm-1', $this -> text_domain),
                                            '2'       => esc_html__('col-sm-2', $this -> text_domain),
                                            '3'       => esc_html__('col-sm-3', $this -> text_domain),
                                            '4'       => esc_html__('col-sm-4', $this -> text_domain),
                                            '5'       => esc_html__('col-sm-5', $this -> text_domain),
                                            '6'       => esc_html__('col-sm-6', $this -> text_domain),
                                            '7'       => esc_html__('col-sm-7', $this -> text_domain),
                                            '8'       => esc_html__('col-sm-8', $this -> text_domain),
                                            '9'       => esc_html__('col-sm-9', $this -> text_domain),
                                            '10'      => esc_html__('col-sm-10', $this -> text_domain),
                                            '11'      => esc_html__('col-sm-11', $this -> text_domain),
                                            '12'      => esc_html__('col-sm-12', $this -> text_domain),
                                        )
                                    ),
                                    array(
                                        'id'      => 'sm_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visibility'),
                                        'default' => true,
                                    ),
                                    // Medium subsection
                                    array(
                                        'id'     => 'tab-medium',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Medium', $this -> text_domain),
                                        'subtitle'   => esc_html__('>=768px', $this -> text_domain),
                                    ),
                                    array(
                                        'id'      => 'md_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Column size'),
                                        'options' => array(
                                            'inherit' => esc_html__('Inherit', $this -> text_domain),
                                            '1'       => esc_html__('col-md-1', $this -> text_domain),
                                            '2'       => esc_html__('col-md-2', $this -> text_domain),
                                            '3'       => esc_html__('col-md-3', $this -> text_domain),
                                            '4'       => esc_html__('col-md-4', $this -> text_domain),
                                            '5'       => esc_html__('col-md-5', $this -> text_domain),
                                            '6'       => esc_html__('col-md-6', $this -> text_domain),
                                            '7'       => esc_html__('col-md-7', $this -> text_domain),
                                            '8'       => esc_html__('col-md-8', $this -> text_domain),
                                            '9'       => esc_html__('col-md-9', $this -> text_domain),
                                            '10'      => esc_html__('col-md-10', $this -> text_domain),
                                            '11'      => esc_html__('col-md-11', $this -> text_domain),
                                            '12'      => esc_html__('col-md-12', $this -> text_domain),
                                        )
                                    ),
                                    array(
                                        'id'      => 'md_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visibility'),
                                        'default' => true,
                                    ),
                                    // Large subsection
                                    array(
                                        'id'     => 'tab-large',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Large', $this -> text_domain),
                                        'subtitle'   => esc_html__('>=992px', $this -> text_domain),
                                    ),
                                    array(
                                        'id'      => 'lg_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Column size'),
                                        'options' => array(
                                            'inherit' => esc_html__('Inherit', $this -> text_domain),
                                            '1'       => esc_html__('col-lg-1', $this -> text_domain),
                                            '2'       => esc_html__('col-lg-2', $this -> text_domain),
                                            '3'       => esc_html__('col-lg-3', $this -> text_domain),
                                            '4'       => esc_html__('col-lg-4', $this -> text_domain),
                                            '5'       => esc_html__('col-lg-5', $this -> text_domain),
                                            '6'       => esc_html__('col-lg-6', $this -> text_domain),
                                            '7'       => esc_html__('col-lg-7', $this -> text_domain),
                                            '8'       => esc_html__('col-lg-8', $this -> text_domain),
                                            '9'       => esc_html__('col-lg-9', $this -> text_domain),
                                            '10'      => esc_html__('col-lg-10', $this -> text_domain),
                                            '11'      => esc_html__('col-lg-11', $this -> text_domain),
                                            '12'      => esc_html__('col-lg-12', $this -> text_domain),
                                        )
                                    ),
                                    array(
                                        'id'      => 'lg_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visibility'),
                                        'default' => true,
                                    ),
                                    // Extra large subsection
                                    array(
                                        'id'     => 'tab-extra-large',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Extra Large', $this -> text_domain),
                                        'subtitle'   => esc_html__('≥1200px', $this -> text_domain),
                                    ),
                                    array(
                                        'id'      => 'xl_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Column size'),
                                        'options' => array(
                                            'inherit' => esc_html__('Inherit', $this -> text_domain),
                                            '1'       => esc_html__('col-xl-1', $this -> text_domain),
                                            '2'       => esc_html__('col-xl-2', $this -> text_domain),
                                            '3'       => esc_html__('col-xl-3', $this -> text_domain),
                                            '4'       => esc_html__('col-xl-4', $this -> text_domain),
                                            '5'       => esc_html__('col-xl-5', $this -> text_domain),
                                            '6'       => esc_html__('col-xl-6', $this -> text_domain),
                                            '7'       => esc_html__('col-xl-7', $this -> text_domain),
                                            '8'       => esc_html__('col-xl-8', $this -> text_domain),
                                            '9'       => esc_html__('col-xl-9', $this -> text_domain),
                                            '10'      => esc_html__('col-xl-10', $this -> text_domain),
                                            '11'      => esc_html__('col-xl-11', $this -> text_domain),
                                            '12'      => esc_html__('col-xl-12', $this -> text_domain),
                                        )
                                    ),
                                    array(
                                        'id'      => 'xl_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visibility'),
                                        'default' => true,
                                    ),
                                    // Extra extra large subsection
                                    array(
                                        'id'     => 'tab-extra-extra-large',
                                        'type'   => 'section',
                                        'indent' => true,
                                        'title'  => esc_html__('Extra Extra Large', $this -> text_domain),
                                        'subtitle'   => esc_html__('≥1400px', $this -> text_domain),
                                    ),
                                    array(
                                        'id'      => 'xxl_size',
                                        'type'    => 'select',
                                        'title'   => esc_html__('Column size'),
                                        'options' => array(
                                            'inherit' => esc_html__('Inherit', $this -> text_domain),
                                            '1'       => esc_html__('col-xxl-1', $this -> text_domain),
                                            '2'       => esc_html__('col-xxl-2', $this -> text_domain),
                                            '3'       => esc_html__('col-xxl-3', $this -> text_domain),
                                            '4'       => esc_html__('col-xxl-4', $this -> text_domain),
                                            '5'       => esc_html__('col-xxl-5', $this -> text_domain),
                                            '6'       => esc_html__('col-xxl-6', $this -> text_domain),
                                            '7'       => esc_html__('col-xxl-7', $this -> text_domain),
                                            '8'       => esc_html__('col-xxl-8', $this -> text_domain),
                                            '9'       => esc_html__('col-xxl-9', $this -> text_domain),
                                            '10'      => esc_html__('col-xxl-10', $this -> text_domain),
                                            '11'      => esc_html__('col-xxl-11', $this -> text_domain),
                                            '12'      => esc_html__('col-xxl-12', $this -> text_domain),
                                        )
                                    ),
                                    array(
                                        'id'      => 'xxl_visibility',
                                        'type'    => 'switch',
                                        'title'   => esc_html__('Visibility'),
                                        'default' => true,
                                    ),
                                    array(
                                        'id'     => 'tab-end',
                                        'type'   => 'section',
                                        'indent' => false, // Indent all options below until the next 'section' option is set.
                                    ),
                                )
                            ), // End design settings
                        ), // End tab field
                    ),
                ),
            );
        }


        public function prepare_params($params, $element,$parent_el){
            $params = parent::prepare_params($params, $element,$parent_el);

            if(isset($element['size'])){
                if(isset($params['tz_class'])) {
                    $params['tz_class'].= ' col-lg-'.$element['size'];
                }else{
                    $params['tz_class'] = ' col-lg-'.$element['size'];
                }
                $params['tz_class'] = trim($params['tz_class']);
            }

            if(isset($params['xs_size']) && !empty($params['xs_colum_size'])){
                $params['tz_class'] .= ' col-xs-'.$params['xs_colum_size'];
            }
            if(isset($params['sm_size']) && !empty($params['sm_size'])){
                $params['tz_class'] .= ' col-sm-'.$params['sm_size'];
            }
            if(isset($params['md_size']) && !empty($params['md_size'])){
                $params['tz_class'] .= ' col-md-'.$params['md_size'];
            }
            if(isset($params['xl_size']) && !empty($params['xl_size'])){
                $params['tz_class'] .= ' col-xl-'.$params['xl_size'];
            }
            if(isset($params['xxl_size']) && !empty($params['xxl_size'])){
                $params['tz_class'] .= ' col-xxl-'.$params['xxl_size'];
            }


            if(isset($params['xxl_visibility']) && $params['xxl_visibility'] == ''){
                $params['xxl_visibility']   = 1;
            }
            if(isset($params['xl_visibility']) && $params['xl_visibility'] == ''){
                $params['xl_visibility']   = 1;
            }
            if(isset($params['lg_visibility']) && $params['lg_visibility'] == ''){
                $params['lg_visibility']   = 1;
            }
            if(isset($params['md_visibility']) && $params['md_visibility'] == ''){
                $params['md_visibility']   = 1;
            }
            if(isset($params['sm_visibility']) && $params['sm_visibility'] == ''){
                $params['sm_visibility']   = 1;
            }
            if(isset($params['xs_visibility']) && $params['xs_visibility'] == ''){
                $params['xs_visibility']   = 1;
            }

            if(isset($params['xxl_visibility']) && (!(bool) $params['xxl_visibility'])){
                $params['tz_class'] .= ' hideonxxl';
            }
            if(isset($params['xl_visibility']) && (!(bool) $params['xl_visibility'])){
                $params['tz_class'] .= ' hideonxl';
            }
            if(isset($params['lg_visibility']) && (!(bool) $params['lg_visibility'])){
                $params['tz_class'] .= ' hideonlg';
            }
            if(isset($params['md_visibility']) && (!(bool) $params['md_visibility'])){
                $params['tz_class'] .= ' hideonmd';
            }
            if(isset($params['sm_visibility']) && (!(bool) $params['sm_visibility'])){
                $params['tz_class'] .= ' hideonsm';
            }
            if(isset($params['xs_visibility']) && (!(bool) $params['xs_visibility'])){
                $params['tz_class'] .= ' hideonxs';
            }

            return $params;
        }

        public function custom_css(&$params, &$element){
            $css    = parent::custom_css($params, $element);

            if(isset($params['text_color']) && !empty($params['text_color'])){
                $css    .= 'color: '.$params['text_color'].';';
            }

            if(isset($params['border']) && !empty($params['border'])){
                $border = $params['border'];
                $border_color   = isset($border['border-color']) && $border['border-color']?' '.$border['border-color']:'';
                if(isset($border['border-style']) && !empty($border['border-style'])){
                    if(isset($border['border-top']) && strlen($border['border-top'])){
                        $css    .= 'border-top: '.$border['border-top'].' '.$border['border-style'].$border_color;
                    }
                    if(isset($border['border-right']) && strlen($border['border-right'])){
                        $css    .= 'border-right: '.$border['border-right'].' '.$border['border-style'].$border_color;
                    }
                    if(isset($border['border-bottom']) && strlen($border['border-bottom'])){
                        $css    .= 'border-bottom: '.$border['border-bottom'].' '.$border['border-style'].$border_color;
                    }
                    if(isset($border['border-left']) && strlen($border['border-left'])){
                        $css    .= 'border-left: '.$border['border-left'].' '.$border['border-style'].$border_color;
                    }
                }

            }

            return $css;
        }

        public function enqueue() {
            if (!wp_script_is('templaza-shortcode-column-js')) {
                wp_enqueue_script(
                    'templaza-shortcode-column-js',
                    Functions::get_my_url() . '/shortcodes/'.$this -> get_shortcode_name()
                    .'/'.$this -> get_shortcode_name().'.js',
                    array( 'jquery', 'jquery-ui-tabs', 'wp-util', 'redux-js', TEMPLAZA_FRAMEWORK_NAME.'__js'),
                    time(),
                    'all'
                );
            }
        }
    }

}

?>