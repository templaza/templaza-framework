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
        add_action( 'enqueue_block_editor_assets', array($this,'tz_block_editor_styles'),99999 );

        add_action('template_include', array($this, 'template_include'), 999999);
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 99999);

        add_filter('register_sidebar_defaults', array($this, 'modify_sidebar'), 9999);

        add_action('after_switch_theme', array($this, 'set_default_settings'), 999);

//        add_action('template_redirect', array($this,'coming_soon_redirect'));

        do_action( 'templaza-framework/plugin/hooks', $this );
    }

//    //redirect non-users to the coming soon page
//    public function coming_soon_redirect()
//    {
//        global $pagenow;
//
//        if(!is_user_logged_in() && !is_page("login") && !is_page("coming-soon") && $pagenow != "wp-login.php")
//        {
//            var_dump('gdfjgk'); die();
////            wp_redirect(home_url("coming-soon"));
//            exit;
//        }
//    }

    public function set_default_settings(){
        if(!current_theme_supports('templaza-framework', true, false)){
            return;
        }

        $def_path       = TEMPLAZA_FRAMEWORK_THEME_PATH_THEME_OPTION.'/settings/default.json';

        if(!file_exists($def_path)) {
            $def_path = TEMPLAZA_FRAMEWORK_OPTION_PATH . '/settings/default.json';
        }

        if(!file_exists($def_path)){
            return;
        }

        $def_settings   = file_get_contents($def_path);

        if(empty($def_settings)){
            return;
        }

        $def_settings   = is_string($def_settings)?json_decode($def_settings, true):$def_settings;

        $setting_name   = Functions::get_theme_option_name();
        $settings       = get_option($setting_name, array());

        $new_settings   = Functions::merge_array($settings, $def_settings, true, true);

//        $source     = array('enable-header' => '1', 'enable-test' => '', 'abc' => '');
//        $def_s      = array('enable-header' => '', 'enable-test' => '1', 'layout' => 'layout_shortcode');
//        var_dump( Functions::merge_array($source, $def_s, true, true)); die();

        update_option($setting_name, $new_settings);

//        if(!empty($settings)){
//            return;
//        }
//
//        update_option($setting_name, $def_settings);
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

        Templates::load_my_layout('head');

        // Include preloader css
        $theme_css_uri  = Functions::get_my_theme_css_uri();
        $preloader_css  = Templates::get_style('preloader', 'preloader');
        $widget_css     = Templates::get_style('widget', 'widget');

        wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm-preloader', $theme_css_uri.'/'.$preloader_css);
        wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm-widget', $theme_css_uri.'/'.$widget_css);

        if($google_link = Fonts::make_google_web_font_link()){
            wp_enqueue_style('templaza-google-font', $google_link);
        }
        $theme_css_uri = Functions::get_my_theme_css_uri();
        if($custom_compiled_css = Templates::get_style_name(TEMPLAZA_FRAMEWORK_THEME_PATH, true)){
            wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm-custom', $theme_css_uri.'/'.$custom_compiled_css);
        }
        $compiled_css           = Templates::get_style_name(TEMPLAZA_FRAMEWORK_THEME_PATH);
        wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm', $theme_css_uri.'/'.$compiled_css);

        $inline_css = Templates::get_inline_styles();

        wp_add_inline_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm', $inline_css);

        do_action('templaza-framework/plugin/enqueue_scripts', $this);
    }
    public function tz_block_editor_styles(){
        if(!current_theme_supports('templaza-framework')){
            return;
        }
        $theme_css_uri = Functions::get_my_theme_css_uri();
        $editor_css           = Templates::get_style('editor-blocks', 'editor-blocks');
        wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm-editor-blocks', $theme_css_uri.'/'.$editor_css);

        do_action('templaza-framework/plugin/tz_block_editor_styles', $this);
    }

    public function default_menu_locations(){

        // Register menu locations
        $locations = array(
            'header' => __('Header Menu', $this->text_domain),
            'primary' => __('Primary Menu', $this->text_domain),
            'footer' => __('Footer Menu', $this->text_domain),
        );
        register_nav_menus($locations);
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

//            $this -> load_template();
            add_action('templaza-framework_theme_body', array($this, 'theme_body_main'));
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

        // Is coming soon page
        $options    = Functions::get_theme_options();

        $coming_soon_dev_mode   = isset($options['miscellaneous-development-mode'])?filter_var($options['miscellaneous-development-mode'], FILTER_VALIDATE_BOOLEAN):false;
        if($coming_soon_dev_mode){
            $theme_file = 'comingsoon';
        }

        // Is 404 page
        if(is_404() && $theme_file != '404'){
            $theme_file = '404';
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

    protected $template_init = array();

    protected function init_template(){
        ob_start();
        $this -> load_my_header();
        $this -> template_init['header']    = ob_get_contents();
        ob_end_clean();
        ob_start();
        $this -> load_my_footer();
        $this -> template_init['footer']    = ob_get_contents();
        ob_end_clean();

    }

    public function display_header(){
        if(isset($this -> template_init['header'])){
            echo $this -> template_init['header'];
        }
    }

    public function display_footer(){
        if(isset($this -> template_init['footer'])){
            echo $this -> template_init['footer'];
        }
    }

    public function theme_body_main($theme_file_name){
        $this -> init_template();
        if($theme_file_name) {
            add_filter('templaza-framework/shortcode/content_area/theme_file', function($file_name)use($theme_file_name){
                $file_name  = !empty($theme_file_name)?$theme_file_name:$file_name;
                return $file_name;
            });
        }

        add_action('wp_body_open', array($this, 'display_header'));
        add_action('wp_footer', array($this, 'display_footer'));

        Templates::load_my_layout('body');
    }

//    protected function load_template(){
////        add_action('wp_body_open', array($this, 'load_my_header'));
////        add_action('templaza-framework_theme_body', array($this, 'load_my_body'));
////        add_action('wp_footer', array($this, 'load_my_footer'));
//    }

}