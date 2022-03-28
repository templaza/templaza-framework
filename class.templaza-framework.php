<?php

namespace TemPlazaFramework;

defined( 'ABSPATH' ) || exit;

use TemPlazaFramework\Core\Framework;
use TemPlazaFramework\Functions;
use ScssPhp\ScssPhp\Formatter\Compressed;
use TemPlazaFramework\Templates;

class TemPlazaFrameWork{

    public $text_domain;

    private $widgets;
    protected $theme_options;
    protected $theme_support;
    protected static $instance;
    protected $template_init = array();

    private $gutenberg_blocks   = array();

    public static function instance(){

        if(static::$instance){
            return static::$instance;
        }

        require_once dirname(__FILE__).'/includes/autoloader.php';

        $instance   = new TemPlazaFrameWork();

        $instance -> text_domain    = Functions::get_my_text_domain();

        $instance -> hooks();

        $instance -> load_gutenberg_blocks();

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

        // Register widgets
        add_action( 'widgets_init', array( $this, 'register_widgets' ) );

        do_action( 'templaza-framework/plugin/hooks', $this );
    }

    public function load_gutenberg_blocks(){
        $theme_path  = TEMPLAZA_FRAMEWORK_THEME_PATH_GUTENBERG_BLOCK;

        $core_path  = TEMPLAZA_FRAMEWORK_PATH.'/gutenberg-blocks';


        if(!is_dir($core_path) && !is_dir($theme_path)){
            return;
        }

        $folders        = glob($core_path.'/*', GLOB_ONLYDIR);
        $theme_folders  = glob($theme_path.'/*', GLOB_ONLYDIR);

        if((empty($folders) || (!empty($folders) && !count($folders))) &&
            (empty($theme_folders) || (!empty($theme_folders) && !count($theme_folders)))){
            return;
        }

        if(count($theme_folders)) {
            $folders = array_merge($folders, $theme_folders);
        }

        if(!empty($folders) && count($folders)){
            foreach ($folders as $folder){
                $block  = basename($folder);

                $block_path = $folder.'/'.$block.'.php';

                if(!file_exists($block_path)){
                    continue;
                }

                if(file_exists($block_path)){
                    require $block_path;
                }

                $block  = str_replace('-', '_', $block);
                $class  = 'TemplazaFramework_Gutenberg_'.ucfirst($block);

                if(class_exists($class) && !isset($this -> gutenberg_blocks[$class])){
                    $this -> gutenberg_blocks[$class]   = new $class();
                }
            }
        }
    }

    public function register_widgets(){

        $theme_path  = TEMPLAZA_FRAMEWORK_THEME_PATH.'/widgets';

        $core_path  = TEMPLAZA_FRAMEWORK_PATH.'/widgets';


        if(!is_dir($core_path) && !is_dir($theme_path)){
            return;
        }

        $folders        = glob($core_path.'/*', GLOB_ONLYDIR);
        $theme_folders  = glob($theme_path.'/*', GLOB_ONLYDIR);

        if((empty($folders) || (!empty($folders) && !count($folders))) &&
            (empty($theme_folders) || (!empty($theme_folders) && !count($theme_folders)))){
            return;
        }

        if(!empty($theme_folders) && count($theme_folders)) {
            $folders = array_merge($folders, $theme_folders);
        }

        if(!empty($folders) && count($folders)){
            foreach ($folders as $folder){
                $file_name  = basename($folder);
                $wd_name     = $file_name;

                $path = $folder.'/'.$wd_name.'.php';

                if(!file_exists($path)){
                    continue;
                }

                if(file_exists($path)){
                    require $path;
                }

                $wd_name = str_replace(array('_', '-'), ' ',$wd_name);
                $wd_name = !empty($wd_name)?ucwords($wd_name):$wd_name;
                $wd_name = !empty($wd_name)?str_replace(' ', '_', $wd_name):$wd_name;
                $class  = 'TemplazaFramework_Widget_'.$wd_name;

                if(class_exists($class) && !isset($this -> widgets[$class])){
                    $widget_obj = new $class();
                    register_widget( $widget_obj );
                    $this -> widgets[$file_name] = $widget_obj;
                }
            }
        }
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

        $this -> init_template();
        Templates::load_my_layout('head');

        // Include preloader css
        $theme          = wp_get_theme();
        $theme_css_uri  = Functions::get_my_theme_css_uri();
        $preloader_css  = Templates::get_style('preloader', 'preloader');
        $widget_css     = Templates::get_style('widget', 'widget');

        wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm-preloader', $theme_css_uri.'/'.$preloader_css);
        wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm-widget', $theme_css_uri.'/'.$widget_css);

        if($google_link = Fonts::make_google_web_font_link()){
            wp_enqueue_style('templaza-google-font', $google_link);
        }

        $options    = Functions::get_global_settings();
        $dev_mode   = isset($options['dev-mode'])?filter_var($options['dev-mode'], FILTER_VALIDATE_BOOLEAN):false;

        $css_path   = \get_template_directory().'/assets/css';
        $scss_path  = TEMPLAZA_FRAMEWORK_THEME_SCSS_PATH;
        $scss_path  = is_dir($scss_path)?$scss_path:TEMPLAZA_FRAMEWORK_SCSS_PATH;
        $trans_name = 'templaza-'.$theme -> get_template().'-transients';
        $transient  = get_option($trans_name, array());

        if($dev_mode){
            $cur_sass_name = Templates::get_sass_name_hash();
            if(!isset($transient['sass_code']) || (isset($transient['sass_code']) && !empty($transient['sass_code'])
                && $cur_sass_name != $transient['sass_code'])){
                $transient['sass_code']    = $cur_sass_name;
                Templates::compileSass($scss_path, $css_path, 'style.scss', 'style.css', false);
                Templates::compileSass($scss_path, $css_path, 'style.scss', 'style.min.css', true);
                update_option($trans_name, $transient);
            }
        }

        if(!file_exists($css_path.'/style.min.css') || !file_exists($css_path.'/style.css')) {
            $cur_sass_name = Templates::get_sass_name_hash();
            $transient['sass_code']    = $cur_sass_name;
            if(!file_exists($css_path.'/style.css')) {
                Templates::compileSass($scss_path, $css_path, 'style.scss', 'style.css', false);
            }
            if(!file_exists($css_path.'/style.min.css')) {
                Templates::compileSass($scss_path, $css_path, 'style.scss', 'style.min.css', true);
            }
            update_option($trans_name, $transient);
        }

        $style_file = 'style.css';
        if(file_exists($css_path.'/style.min.css')){
            $style_file = 'style.min.css';
        }

        if(file_exists($css_path.'/'.$style_file)) {
            wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME . '__tzfrm',
                get_template_directory_uri() . '/assets/css/'.$style_file, array(), $theme->get('Version'));
        }

        $inline_css = Templates::get_inline_styles();

        wp_add_inline_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm', $inline_css);

//        $this -> woo_enqueue_scripts();

        do_action('templaza-framework/plugin/enqueue_scripts', $this);
    }

    protected function woo_enqueue_scripts(){

        wp_register_script( 'templaza-woo-notify', Functions::get_my_url(). '/assets/js/woo/notify.min.js', array(), '1.0.0', true );
        wp_register_script( 'templaza-woo-swiper', Functions::get_my_url() . '/assets/js/woo/swiper.min.js', array( 'jquery' ), '5.3.8', true );

        wp_register_script( 'templaza-woo-viewport', Functions::get_my_url() . '/assets/js/woo/isInViewport.min.js', array('jquery'),false,true );
        wp_enqueue_script( 'templaza-woo-viewport' );
        wp_register_script( 'templaza-woo-catalog', Functions::get_my_url() . '/assets/js/woo/woo-catalog.js', array('jquery'),false,true );
        wp_enqueue_script( 'templaza-woo-catalog' );

        $admin_url = admin_url('admin-ajax.php');
        $agruco_ajax_url = array('url' => $admin_url);
        wp_localize_script('agruco-scripts', 'agruco_ajax_url', $agruco_ajax_url);

        wp_enqueue_script( 'templaza-woo-scripts', Functions::get_my_url() . '/assets/js/woo/woo-scripts.js', array(
            'jquery',
            'templaza-woo-viewport',
            'templaza-woo-swiper',
            'templaza-woo-notify',
            'imagesloaded',
        ), false, true );

        $templaza_data = array(
            'direction'            => is_rtl() ? 'true' : 'false',
            'ajax_url'             => class_exists( 'WC_AJAX' ) ? \WC_AJAX::get_endpoint( '%%endpoint%%' ) : '',
            'nonce'                => wp_create_nonce( '_templaza_nonce' ),
            'search_content_type'  => get_option( 'header_search_type' ),
            'header_search_number' => get_option( 'header_search_number' ),
            'header_ajax_search'   => intval( get_option( 'header_search_ajax' ) ),
            'sticky_header'        => intval( get_option( 'header_sticky' ) ),
            'mobile_landscape'     => get_option( 'mobile_landscape_product_columns' ),
            'mobile_portrait'      => get_option( 'mobile_portrait_product_columns' ),
            'popup'                => get_option( 'newsletter_popup_enable' ),
            'popup_frequency'      => get_option( 'newsletter_popup_frequency' ),
            'popup_visible'        => get_option( 'newsletter_popup_visible' ),
            'popup_visible_delay'  => get_option( 'newsletter_popup_visible_delay' ),
        );

        $templaza_data = apply_filters( 'templaza_wp_script_data', $templaza_data );

        wp_localize_script(
            'templaza-woo-scripts', 'templazaData', $templaza_data
        );
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

            $this -> load_template();

//            if(file_exists(TEMPLAZA_FRAMEWORK_INCLUDES_PATH.'/helpers/woocommerce/woocommerce-load.php')) {
//                require_once TEMPLAZA_FRAMEWORK_INCLUDES_PATH . '/helpers/woocommerce/woocommerce-load.php';
//            }
        }
    }

    public function load_my_header(){
        Templates::load_my_layout('colors');
        Templates::load_my_header();
    }
    public function theme_body_main($theme_file_name){
        if($theme_file_name) {
            add_filter('templaza-framework/shortcode/content_area/theme_file', function($file_name)use($theme_file_name){
                $file_name  = !empty($theme_file_name)?$theme_file_name:$file_name;
                return $file_name;
            });
        }
        $this -> display_body();
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

        add_filter('templaza-framework/shortcode/content_area/theme_html', function($html) use ( $theme_file){
            if(!is_file($theme_file)){
                // Check file exists in sub folder
                $path       = Templates::load_my_layout('theme_pages.'.$theme_file.'.'.get_post_type(), false);

                if(!$path){
                    $path   = Templates::load_my_layout('theme_pages.'.$theme_file, false);
                }
            }else{
                $path   = $theme_file;
            }

            ob_start();
            require $path;
            $html    = ob_get_contents();
            ob_end_clean();

            return $html;
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

    protected function init_template(){
        ob_start();
        $this -> load_my_header();
        $this -> template_init['header']    = ob_get_contents();
        ob_end_clean();
        ob_start();
        Templates::load_my_layout('body', true, false);
        $this -> template_init['body']    = ob_get_contents();
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

    public function display_body(){
        if(isset($this -> template_init['body'])){
            echo $this -> template_init['body'];
        }
    }

    public function display_footer(){
        if(isset($this -> template_init['footer'])){
            echo $this -> template_init['footer'];
        }
    }

    protected function load_template(){
        add_action('wp_body_open', array($this, 'display_header'));
        /*add_action('templaza-framework_theme_body', array($this, 'theme_body_main'));*/
        add_action('templaza-framework_theme_body', array($this, 'display_body'));
        add_action('wp_footer', array($this, 'display_footer'));
    }

}