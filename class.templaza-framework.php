<?php

namespace TemPlazaFramework;

defined( 'ABSPATH' ) || exit;

use Cassandra\Value;
use TemPlazaFramework\Core\Framework;
use TemPlazaFramework\Functions;
use ScssPhp\ScssPhp\Formatter\Compressed;
use TemPlazaFramework\Templates;

class TemPlazaFrameWork{

    protected $theme_options;
    protected static $instance;
    public $text_domain;

    protected $theme_support;

    public static function instance(){

        if(static::$instance){
            return static::$instance;
        }

        require_once dirname(__FILE__).'/includes/autoloader.php';

        $instance   = new TemPlazaFrameWork();

        $instance -> text_domain    = Functions::get_my_text_domain();

        $instance -> hooks();

        static::$instance   = $instance;
        return $instance;
    }

    public function hooks(){

        add_action('after_setup_theme', array($this, 'default_menu_locations'), 99999);
        add_action('init', array($this, 'init'), 99999);

        add_action('init', array($this, 'frontend_init'), 99999);

        add_action('template_include', array($this, 'template_include'), 999999);
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 99999);

        add_filter('register_sidebar_defaults', array($this, 'modify_sidebar'), 9999);

        do_action( 'templaza-framework/plugin/hooks', $this );
    }

    public function modify_sidebar($defaults){
        if(!current_theme_supports('templaza-framework', true, false)){
            return $defaults;
        }
        ob_start();
        Templates::load_my_layout('sidebar.before_title', true, false);
        $before_title   = ob_get_contents();
        ob_end_clean();

        ob_start();
        Templates::load_my_layout('sidebar.after_title', true, false);
        $after_title   = ob_get_contents();
        ob_end_clean();

        ob_start();
        Templates::load_my_layout('sidebar.before_widget', true, false);
        $before_widget   = ob_get_contents();
        ob_end_clean();

        ob_start();
        Templates::load_my_layout('sidebar.after_widget', true, false);
        $after_widget   = ob_get_contents();
        ob_end_clean();

        $sidebar_args = array(
            'before_title'  => $before_title,
            'after_title'   => $after_title,
            'before_widget' => $before_widget,
            'after_widget'  => $after_widget,
        );

        $defaults    = wp_parse_args($sidebar_args, $defaults);

        $defaults    = apply_filters( 'templaza-framework/sidebar/register_sidebar_defaults', $defaults );

        return $defaults;
    }

    public function enqueue_scripts(){
        if(!current_theme_supports('templaza-framework')){
            return;
        }

        // Include preloader css
        $theme_css_uri = Functions::get_my_theme_css_uri();
        $preloader_css           = Templates::get_style('preloader', 'preloader');

        wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm-preloader', $theme_css_uri.'/'.$preloader_css);

        Templates::load_my_layout('head');

        do_action('templaza-framework/plugin/enqueue_scripts', $this);
    }

    public function default_menu_locations(){

//        if(!$_wp_registered_nav_menus) {
        // Register menu locations
        $locations = array(
            'header' => __('Header Menu', $this->text_domain),
            'primary' => __('Primary Menu', $this->text_domain),
            'footer' => __('Footer Menu', $this->text_domain),
        );
        register_nav_menus($locations);
//        }
    }

    public function init(){
        global $_wp_theme_features;

        if(!current_theme_supports('templaza-framework')){
            return;
        }

        if(!class_exists('TemPlazaFrameWork\Core\Framework')) {
            require_once TEMPLAZA_FRAMEWORK_CORE_PATH . '/framework.php';
        }
        $core   = new Framework();

        do_action( 'templaza-framework/plugin/admin_init', $this, $core );
    }

    public function frontend_init(){
        if(!is_admin()){

            if(!current_theme_supports('templaza-framework')){
                return;
            }

            $this -> theme_options  = Functions::get_theme_options();

            $this -> load_template();
        }
    }

    public function load_my_header(){
        Templates::load_my_layout('colors');
        Templates::load_my_header();
    }
    public function load_my_body($theme_file_name){
        if($theme_file_name) {
            add_filter('templaza-framework/shortcode/content_area/theme_file', function($file_name)use($theme_file_name){
                $file_name  = !empty($theme_file_name)?$theme_file_name:$file_name;
                return $file_name;
            });
        }
        Templates::load_my_layout('body');
    }

    public function load_my_footer(){
        Templates::load_my_footer();
        Templates::load_my_layout('typography');
        if($google_link = Fonts::make_google_web_font_link()){
            wp_enqueue_style('templaza-google-font', $google_link);
        }

        $theme_css_uri = Functions::get_my_theme_css_uri();
        if($custom_compiled_css = Templates::get_style_name(TEMPLAZA_FRAMEWORK_THEME_PATH, true)){
            wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm-custom', $theme_css_uri.'/'.$custom_compiled_css);
        }
        $compiled_css           = Templates::get_style_name(TEMPLAZA_FRAMEWORK_THEME_PATH);
        wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm', $theme_css_uri.'/'.$compiled_css);

        Templates::load_css_file();
    }

    public function template_include($template){
        if ( is_embed() ) {
            return $template;
        }

        if(!current_theme_supports('templaza-framework')){
            return $template;
        }

        $base_path  = TEMPLAZA_FRAMEWORK_TEMPLATE_PATH;
        $theme_path = get_template_directory();
        $main_file  = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE.'/main.php';

        $theme_file = $template;

        // Check file is the main in theme
        // Example: theme_name/single.php
        if(strpos($template, $theme_path.'/'.basename($template)) !== false){
            $theme_file = basename($theme_file);
            $theme_file = preg_replace('/\.php$/i', '', $theme_file);
        }

        add_filter('templaza-framework_theme_file', function($file) use($theme_file){
            if(!is_file($theme_file)){
                // Check file exists in sub folder
                $path       = Templates::load_my_layout('theme_pages.'.$theme_file.'.'.get_post_type(), false);

                if(!$path){
                    $path   = Templates::load_my_layout('theme_pages.'.$theme_file, false);
                }

                if(!file_exists($path)){
                    return $file;
                }
            }

            $file = !empty($theme_file) ? $theme_file : $file;

            return $file;
        });

        if (file_exists($main_file)) {
            return $main_file;
        }
        $main_file = $base_path . '/main.php';
        if (file_exists($main_file)) {
            return $main_file;
        }
        return $template;
    }

    protected function load_template(){

        add_action('wp_body_open', function(){
            $this -> load_my_header();
        });

        add_action('templaza-framework_theme_body', array($this, 'load_my_body'));

//        add_action('wp_body_open', array($this, 'load_my_header'));
        add_action('wp_footer', array($this, 'load_my_footer'));
//        add_action('templaza-framework__header', array($this, 'load_my_header'));
//        add_action('templaza-framework__footer', array($this, 'load_my_footer'));
    }

}