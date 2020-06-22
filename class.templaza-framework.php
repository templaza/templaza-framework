<?php

namespace TemPlazaFramework;

defined( 'ABSPATH' ) || exit;

require_once dirname(__FILE__).'/includes/defines.php';
require_once dirname(__FILE__).'/includes/functions.php';
require_once dirname(__FILE__).'/includes/menu.php';
require_once dirname(__FILE__).'/includes/templates.php';

use Cassandra\Value;
use TemPlazaFramework\Core\Framework;
use TemPlazaFramework\Functions;
use ScssPhp\ScssPhp\Formatter\Compressed;
use TemPlazaFramework\Templates;

class TemPlazaFrameWork{

    protected $theme_options;
    protected static $instance;
    public $text_domain;

    public static function instance(){
        if(static::$instance){
            return static::$instance;
        }

        $instance   = new TemPlazaFrameWork();

        $instance -> text_domain    = Functions::get_my_text_domain();

        $instance -> hooks();
        static::$instance   = $instance;
        return $instance;
    }

    public function hooks(){

        add_action('init', array($this, 'default_menu_locations'));
//        add_action('widgets_init', array($this, 'default_sidebars'));
        add_action('wp_loaded', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
//        add_action('wp_enqueue_scripts', array($this, 'enqueue_style'));

        do_action( 'templaza-framework/plugin/hooks', $this );
    }

    public function enqueue_scripts(){

        $theme_css_uri = Functions::get_my_theme_css_uri();
        if($custom_compiled_css = Templates::get_style_name(TEMPLAZA_FRAMEWORK_THEME_PATH, true)){
            wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm-custom', $theme_css_uri.'/'.$custom_compiled_css);
        }
        $compiled_css           = Templates::get_style_name(TEMPLAZA_FRAMEWORK_THEME_PATH);
        wp_enqueue_style(TEMPLAZA_FRAMEWORK_THEME_DIR_NAME.'__tzfrm', $theme_css_uri.'/'.$compiled_css);
//        wp_enqueue_style('templaza-css');

//        wp_add_inline_style(basename(TEMPLATEPATH).'__tzfrm', '.templaza-container{color: #fff;}');
//        wp_enqueue_script( 'templaza-js__templazadrop', Functions::get_my_url().'/assets/js/vendor/jquery.templazadrop.js', array( 'jquery' ) );
        wp_enqueue_script( 'templaza-js__templazamobilemenu', Functions::get_my_url().'/assets/js/vendor/jquery.templazamegamenu.js', array( 'jquery' ) );
        wp_enqueue_script( 'templaza-js__templazamobilemenu', Functions::get_my_url().'/assets/js/vendor/jquery.templazamobilemenu.js', array( 'jquery' ) );
        wp_enqueue_script( 'templaza-js__offcanvas', Functions::get_my_url().'/assets/js/vendor/jquery.offcanvas.js', array( 'jquery' ) );
        wp_enqueue_script( 'templaza-js__main', Functions::get_my_url().'/assets/js/main.js', array( 'jquery' ) );

        Templates::load_css_file();

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
        if(is_admin()){
            if(!class_exists('TemPlazaFrameWork\Core\Framework')) {
                require_once TEMPLAZA_FRAMEWORK_CORE_PATH . '/framework.php';
            }
            $core   = new Framework();
            $core -> init();

            do_action( 'templaza-framework/plugin/admin_init', $this, $core );

        }else{
//            $theme_css_uri = Functions::get_my_theme_css_uri();
            if(!defined('TEMPLAZA_FRAMEWORK_THEME_DIR_NAME')) {
                define('TEMPLAZA_FRAMEWORK_THEME_DIR_NAME', basename(TEMPLATEPATH));
            }

            if(!is_dir(TEMPLAZA_FRAMEWORK_THEME_PATH)){
                return;
            }

            $this -> theme_options  = Functions::get_theme_options();
            $this -> load_template();

//            if($custom_compiled_css = Templates::get_style_name(TEMPLAZA_FRAMEWORK_THEME_PATH, true)){
//                wp_enqueue_style(basename(TEMPLATEPATH).'__tzfrm-custom', $theme_css_uri.'/'.$custom_compiled_css);
//            }
//            $compiled_css           = Templates::get_style_name(TEMPLAZA_FRAMEWORK_THEME_PATH);
//            wp_enqueue_style(basename(TEMPLATEPATH).'__tzfrm', $theme_css_uri.'/'.$compiled_css);
        }

        do_action( 'templaza-framework/plugin/init', $this);
    }

    public function load_my_header(){

        Templates::load_my_layout('colors');
        Templates::load_my_header();
    }

    public function load_my_footer(){
        Templates::load_my_footer();
    }

    protected function load_template(){
        ob_start();
        $this -> load_my_header();
        $header = ob_get_contents();
        ob_end_clean();

//        var_dump($header);
        //die();
        add_action('wp_body_open', function()use($header){
            echo $header;
        });
//        add_action('wp_body_open', array($this, 'load_my_header'));
        add_action('wp_footer', array($this, 'load_my_footer'));
//        add_action('templaza-framework__header', array($this, 'load_my_header'));
//        add_action('templaza-framework__footer', array($this, 'load_my_footer'));
    }

}