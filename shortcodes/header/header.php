<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Header')){
    class TemplazaFramework_ShortCode_Header extends TemplazaFramework_ShortCode {

        private $header_shortcode_name  = '';
        private $header_shortcode_atts  = array();

        public function __construct($field_parent = array(), $value = '', $parent = '')
        {
            $this -> hooks();

            parent::__construct($field_parent, $value, $parent);
        }

        public function hooks(){
            add_action('templaza-framework/shortcode/'.$this -> get_shortcode_name().'/before_do_shortcode', array($this, 'before_do_shortcode'), 10, 2);
            add_action('templaza-framework/shortcode/'.$this -> get_shortcode_name().'/after_do_shortcode', array($this, 'after_do_shortcode'));

            add_filter('templaza-framework/layout/generate/shortcode/'.$this -> get_shortcode_name().'/after_generate_shortcode',
                array($this, 'after_generate_shortcode'));

        }

        public function before_do_shortcode($atts){
            $this -> header_shortcode_atts = $atts;

            add_filter('templaza-framework/walker/megamenu/wp_nav_menu_submenu_attribute',
                array($this, 'wp_nav_menu_submenu_attribute'));

            add_filter( 'templaza-framework/walker/megamenu/after_megamenu_the_title', array($this, 'after_megamenu_the_title'), 10, 4);
            add_filter('wp_nav_menu_args', array($this, 'wp_nav_menu_args'));
            add_filter('nav_menu_css_class', array($this, 'nav_menu_css_class'));
            add_filter('nav_menu_submenu_css_class', array($this, 'nav_menu_submenu_css_class'));
        }

        public function after_do_shortcode($atts){

            remove_filter('templaza-framework/walker/megamenu/wp_nav_menu_submenu_attribute',
                array($this, 'wp_nav_menu_submenu_attribute'));

            remove_filter('nav_menu_css_class', array($this, 'nav_menu_css_class'));
            remove_filter('nav_menu_submenu_css_class', array($this, 'nav_menu_submenu_css_class'));

            remove_filter('wp_nav_menu_args', array($this, 'wp_nav_menu_args'));
            remove_filter('templaza-framework/walker/megamenu/after_megamenu_the_title', array($this, 'after_megamenu_the_title'));
        }

        public function wp_nav_menu_args($nav_menu_args){
//            $options            = Functions::get_theme_options();
            $options            = Functions::get_header_options();
            $mode               = isset($options['header-mode'])?$options['header-mode']:'horizontal';

            if($mode == 'sidebar'){
                $nav_menu_args['items_wrap'] = '<ul id="%1$s" class="%2$s" data-uk-nav="toggle: > a > .nav-item-caret">%3$s</ul>';
            }

            return $nav_menu_args;
        }

        public function wp_nav_menu_submenu_attribute($attributes){
//            $options            = Functions::get_theme_options();
            $options            = Functions::get_header_options();
            $mode               = isset($options['header-mode'])?$options['header-mode']:'horizontal';

            if($mode == 'sidebar'){
                $attributes['data-uk-nav']  = 'toggle: > a > .nav-item-caret';
            }

            return $attributes;
        }

        public function nav_menu_submenu_css_class($classes){
//            $options            = Functions::get_theme_options();
            $options            = Functions::get_header_options();
            $mode               = isset($options['header-mode'])?$options['header-mode']:'horizontal';

            if($mode == 'sidebar') {
                $classes[] = 'uk-nav-sub uk-display-block';
            }
            return $classes;
        }


        public function nav_menu_css_class($classes){
//            $options            = Functions::get_theme_options();
            $options            = Functions::get_header_options();
            $mode               = isset($options['header-mode'])?$options['header-mode']:'horizontal';

            if($mode == 'sidebar') {
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

        public function after_megamenu_the_title($after_title, $item, $attributes, $args){
            $class  = isset($attributes['class'])?$attributes['class']:'';
            if(strpos($class, 'has-children') != false){
                $after_title    = '<i class="uk-float-right nav-item-caret"></i>';
            }
            return $after_title;
        }

        public function after_generate_shortcode($shortcode){

            $options        = Functions::get_theme_options();
            $header         = isset($options['enable-header'])?filter_var($options['enable-header'], FILTER_VALIDATE_BOOLEAN):true;

            if(!$header){
                return '';
            }

            return $shortcode;
        }

        public function register(){
            return array(
                'id'          => 'header',
                'icon'        => 'el el-tasks',
                'title'       => __('Header'),
                'param_title' => __('Header settings'),
                'desc'        => __('Load a header.'),
                'admin_label' => true,
                'params'      => array()
            );
        }

        public function prepare_params($params, $element, $parent_el){
            $params = parent::prepare_params($params, $element, $parent_el);

            $header_slug    = Functions::get_header_id();
            if(!empty($header_slug)) {
                $params['tz_class'] .= ' templaza-header__' . $header_slug;
            }

            return $params;
        }
    }

}

?>