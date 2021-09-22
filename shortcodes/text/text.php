<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Text')){
    class TemplazaFramework_ShortCode_Text extends TemplazaFramework_ShortCode {

        public function __construct($field_parent = array(), $value = '', $parent = '')
        {
            $this -> hooks();

            parent::__construct($field_parent, $value, $parent);

//            add_action( 'admin_print_footer_scripts', array( '_WP_Editors', 'enqueue_scripts' ), 1 );
//            add_action( 'admin_print_footer_scripts', function(){
////                var_dump(__METHOD__); die();
//            }, 1 );

//            _WP_Editors::enqueue_scripts();
//            var_dump('text block shortcode');
//            add_action( 'admin_print_footer_scripts', array( '_WP_Editors', 'enqueue_scripts' ), 1 );
        }

        public function hooks(){
            add_filter('templaza-framework/layout/generate/shortcode/'.$this -> get_shortcode_name().'/after_shortcode',
                array($this, 'after_shortcode'), 10, 4);
        }

        public function after_shortcode($shortcode, $level, $params, $item){
            if(isset($item['text']) && !empty($item['text']) && !empty($shortcode)
                && !preg_match('/\[\/templaza_text\]$/ism', $shortcode)){
                $shortcode  .= $item['text'].'[/templaza_'.$item['type'].']';
            }elseif(!isset($item['text']) && !empty($shortcode)
                && !preg_match('/\[\/templaza_text\]$/ism', $shortcode)){
                $shortcode  .= '[/templaza_'.$item['type'].']';
            }
            return $shortcode;
        }

        public function register(){
            return array(
                'id'          => 'text',
                'icon'        => 'el el-text-width',
                'title'       => __('Text Block'),
                'param_title' => esc_html__('Text Block Settings'),
                'desc'        => __('Load a text block.'),
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
                        'required' => array('title', 'not', ''),
                    ),
                    array(
                        'type'          => 'select',
                        'id'            => 'widget_heading_style',
                        'title'         => esc_html__('Widget Title Style',  $this -> text_domain),
                        'subtitle'      => esc_html__('Heading styles differ in font-size but may also come with a predefined color, size and font',  $this -> text_domain),
                        'options'       => array(
                            ''                  => esc_html__('None',  $this -> text_domain),
                            'heading-2xlarge'   => esc_html__('2XLarge',  $this -> text_domain),
                            'heading-xlarge'    => esc_html__('XLarge',  $this -> text_domain),
                            'heading-large'     => esc_html__('Large',  $this -> text_domain),
                            'heading-medium'    => esc_html__('Medium',  $this -> text_domain),
                            'heading-small'     => esc_html__('Small',  $this -> text_domain),
                            'h1'                => esc_html__('H1',  $this -> text_domain),
                            'h2'                => esc_html__('H2',  $this -> text_domain),
                            'h3'                => esc_html__('H3',  $this -> text_domain),
                            'h4'                => esc_html__('H4',  $this -> text_domain),
                            'h5'                => esc_html__('H5',  $this -> text_domain),
                            'h6'                => esc_html__('H6',  $this -> text_domain),
                        ),
                        'default'       => '',
                    ),
                    array(
                        'id'       => 'text',
                        'type'     => 'editor',
                        'title'    => __( 'Text', $this -> text_domain ),
                        'args'   => array(
                            'wpautop'  => false,
                        ),
                    ),
                )
            );
        }

        public function enqueue() {
            if (!wp_script_is('templaza-shortcode-text-js')) {
                wp_enqueue_script(
                    'templaza-shortcode-text-js',
                    \TemPlazaFramework\Functions::get_my_url() . '/shortcodes/text/text.js',
                    array( 'jquery', 'jquery-ui-tabs', 'wp-util', 'redux-js', TEMPLAZA_FRAMEWORK_NAME.'__js'),
                    time(),
                    'all'
                );
            }
        }
    }

}

?>