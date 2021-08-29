<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_WP_Menu')){
    class TemplazaFramework_ShortCode_WP_Menu extends TemplazaFramework_ShortCode {

        private $wp_menu_shortcode_atts = array();

        public function __construct($field_parent = array(), $value = '', $parent = '')
        {
            $this -> hooks();

            parent::__construct($field_parent, $value, $parent);
        }

        public function hooks(){
            add_action('templaza-framework/shortcode/'.$this -> get_shortcode_name().'/before_do_shortcode', array($this, 'before_do_shortcode'));
            add_action('templaza-framework/shortcode/'.$this -> get_shortcode_name().'/after_do_shortcode', array($this, 'after_do_shortcode'));

//            add_filter('nav_menu_css_class', array($this, 'nav_menu_css_class'));
//            add_filter('nav_menu_submenu_css_class', array($this, 'nav_menu_submenu_css_class'));
//            add_filter( 'templaza-framework/walker/megamenu/after_megamenu_the_title', array($this, 'after_megamenu_the_title'), 10, 4);
//            add_filter('templaza-framework/walker/megamenu/wp_nav_menu_submenu_attribute', array($this, 'wp_nav_menu_submenu_attribute'), 10, 2);
//            add_filter( 'templaza-framework/walker/megamenu/megamenu_nav_menu_item_id', array($this, 'wp_menu_shortcode_megamenu_nav_menu_item_id'));
//
//            add_filter('widget_nav_menu_args', array($this, 'widget_nav_menu_args'), 10, 4);
        }

        public function register(){
            return array(
                'id'          => 'wp_menu',
                'icon'        => 'el el-lines',
                'title'       => __('WP Menu', $this -> text_domain),
                'param_title' => esc_html__('WP Menu Settings', $this -> text_domain),
                'desc'        => __('Load a WP Menu.', $this -> text_domain),
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
                        'id'       => 'nav_menu',
                        'type'     => 'select',
                        'data'     => 'menus',
                        'title'    => __( 'Menu', $this -> text_domain ),
                        'subtitle' => __( 'Select menu.', $this -> text_domain ),
                    ),
                    array(
                        'id'       => 'enable_submenu',
                        'type'     => 'switch',
                        'title'    => esc_html__('Enable SubMenu', $this -> text_domain),
                        'default'  => '1',
//                        'required' => array('nav_menu', 'not', ''),
                    ),
                    array(
                        'id'       => 'style',
                        'type'     => 'select',
                        'title'    => esc_html__('Style', $this -> text_domain),
                        'subtitle' => esc_html__('Select Style from the list', $this -> text_domain),
                        'options'  => array(
                            'horizontal'    => esc_html__('Horizontal', $this -> text_domain),
                            'vertical'      => esc_html__('Vertical', $this -> text_domain),
                            'ui_accordion'  => esc_html__('UI Accordion', $this -> text_domain),
                        ),
                        'default'  => 'horizontal',
//                        'required' => array('enable_submenu', '=', '1'),
                    ),
                )
            );
        }

        public function before_do_shortcode($atts){
            $this -> wp_menu_shortcode_atts = $atts;

            add_filter('nav_menu_css_class', array($this, 'nav_menu_css_class'));
            add_filter('nav_menu_submenu_css_class', array($this, 'nav_menu_submenu_css_class'));
            add_filter( 'templaza-framework/walker/megamenu/after_megamenu_the_title', array($this, 'after_megamenu_the_title'), 10, 4);
            add_filter('templaza-framework/walker/megamenu/wp_nav_menu_submenu_attribute', array($this, 'wp_nav_menu_submenu_attribute'), 10, 2);
            add_filter( 'templaza-framework/walker/megamenu/megamenu_nav_menu_item_id', array($this, 'wp_menu_shortcode_megamenu_nav_menu_item_id'));

            add_filter('widget_nav_menu_args', array($this, 'widget_nav_menu_args'), 10, 4);
        }

        public function after_do_shortcode($atts){
            if(isset($atts['style']) && $atts['style'] == 'ui_accordion') {
                remove_filter('nav_menu_submenu_css_class', array($this, 'nav_menu_css_class'));
                remove_filter('nav_menu_submenu_css_class', array($this, 'nav_menu_submenu_css_class'));
                remove_filter( 'templaza-framework/walker/megamenu/megamenu_nav_menu_item_id', array($this, 'wp_menu_shortcode_megamenu_nav_menu_item_id'));
            }
            remove_filter('templaza-framework/walker/megamenu/after_megamenu_the_title', array($this, 'after_megamenu_the_title'));
            remove_filter('widget_nav_menu_args', array($this, 'widget_nav_menu_args'));
        }

        public function after_megamenu_the_title($after_title, $item, $attributes, $args){
            $class  = isset($attributes['class'])?$attributes['class']:'';
            if(isset($args['templaza_wp_menu_shortcode_after_title'])
                && !empty($args['templaza_wp_menu_shortcode_after_title']) && strpos($class, 'has-children') != false){
                $after_title    .= $args['templaza_wp_menu_shortcode_after_title'];
            }
            return $after_title;
        }
        public function widget_nav_menu_args($nav_menu_args, $nav_menu, $args){
            $atts           = $this -> wp_menu_shortcode_atts;
            $style          = isset($atts['style'])?$atts['style']:'';
            $menu_class     = $style?'menu tz-menu-'.$style:'menu tz-menu-horizontal';
            $enable_submenu = (isset($atts['enable_submenu']) && $atts['enable_submenu'])?filter_var($atts['enable_submenu'], FILTER_VALIDATE_BOOLEAN):true;

            if(!$enable_submenu){
                $nav_menu_args['depth']  = 1;
            }

            $nav_menu_args['menu_class']         = $menu_class;
            $nav_menu_args['container_class']    = 'widget-content';

            if(isset($args['items_wrap'])){
                $nav_menu_args['items_wrap']    = $args['items_wrap'];
            }

            if($style == 'ui_accordion'){
                if(isset($args['templaza_wp_menu_shortcode_after_title'])){
                    $nav_menu_args['templaza_wp_menu_shortcode_after_title']    = $args['templaza_wp_menu_shortcode_after_title'];
                }
                if(isset($args['templaza_wp_menu_shortcode_submenu_attributes'])){
                    $nav_menu_args['templaza_wp_menu_shortcode_submenu_attributes']    = $args['templaza_wp_menu_shortcode_submenu_attributes'];
                }
                $nav_menu_args['items_wrap'] = !empty($nav_menu_args['items_wrap'])?$nav_menu_args['items_wrap']:'<ul id="%1$s" class="%2$s" data-uk-nav>%3$s</ul>';
            }

            return $nav_menu_args;
        }

        public function nav_menu_css_class($classes){
            $atts           = $this -> wp_menu_shortcode_atts;
            $style          = isset($atts['style'])?$atts['style']:'';

            if($style == 'ui_accordion') {
                if(in_array('menu-item-has-children', $classes)){
                    $classes[]  = 'uk-parent';
                }
                if(in_array('current-menu-parent', $classes)){
                    $classes[]  = 'uk-open';
                }
                if(in_array('current-menu-item', $classes)){
                    $classes[]  = 'uk-active';
                }
            }

            return $classes;
        }

        public function wp_nav_menu_submenu_attribute($attributes, $args){
            $atts           = $this -> wp_menu_shortcode_atts;
            $style          = isset($atts['style'])?$atts['style']:'';

            if($style == 'ui_accordion'){
                $attributes['data-uk-nav']  = 'toggle: > a > .nav-item-caret';
                $args   = (array) $args;
                if(isset($args['templaza_wp_menu_shortcode_submenu_attributes'])){
                    $_wp_atts   = $args['templaza_wp_menu_shortcode_submenu_attributes'];
                    if(isset($_wp_atts['data-uk-nav'])){
                        $attributes['data-uk-nav'] = $_wp_atts['data-uk-nav'];
                    }
                }
            }

            return $attributes;
        }

        public function nav_menu_submenu_css_class($classes){
            $atts           = $this -> wp_menu_shortcode_atts;
            $style          = isset($atts['style'])?$atts['style']:'';

            if($style == 'ui_accordion') {
                $classes[] = 'uk-nav-sub';
            }
            return $classes;
        }

        public function wp_menu_shortcode_megamenu_nav_menu_item_id($id){
            $atts           = $this -> wp_menu_shortcode_atts;
            $style          = isset($atts['style'])?$atts['style']:'';

            if($style == 'ui_accordion') {
                $id = '';
            }
            return $id;
        }
    }

}

?>