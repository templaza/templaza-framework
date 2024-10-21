<?php

//namespace TemPlazaFramework;

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

class TemplazaFramework_GutenbergBlock{

    protected $text_domain;

    public function __construct()
    {
        $this -> text_domain    = Functions::get_my_text_domain();
        $this -> hooks();
    }

    public function hooks(){

        if(method_exists($this, 'load_textdomain')) {
            add_action('init', array($this, 'load_textdomain'));
        }

        if(method_exists($this, 'register_block_type')) {
            add_action('init', array($this, 'register_block_type'));
        }
    }

    public function get_name(){
        $class_name = get_class($this);
        $name   = preg_replace('/^TemPlazaFramework_Gutenberg_/i', '', $class_name);
        return strtolower($name);
    }

    public function get_folder_name(){
        return $this -> get_name();
    }

    public function get_default_arguments(){
        $def_args   = array(
            'render_callback' => array($this, 'render')
        );
        $title              = str_replace('_', ' ', $this -> get_name());
        /* translators: %s - Installed. */
        $def_args['title']  = sprintf(__('Templaza: %s'), ucwords($title));

        return $def_args;
    }

    public function get_block_type(){
        return TEMPLAZA_FRAMEWORK.'/'.$this -> get_name();
    }

    /**
     * Register a block type
     * See https://developer.wordpress.org/reference/classes/wp_block_type/__construct/
     * for information on accepted arguments.
     */
    public function register(){
        return array();
    }

    public function render($attributes, $content){
        $file   = TEMPLAZA_FRAMEWORK_THEME_PATH_GUTENBERG_BLOCK.'/'.$this -> get_folder_name().'/tmpl/'.$this -> get_folder_name().'.php';
        if(!file_exists($file)){
            $file   = TEMPLAZA_FRAMEWORK_GUTENBERG_BLOCK_PATH.'/'.$this -> get_folder_name().'/tmpl/'.$this -> get_folder_name().'.php';
        }

        if(file_exists($file)){
            ob_start();
            require $file;
            $html   = ob_get_contents();
            ob_end_clean();
            return $html;
        }
        return '';
    }

    /**
     * Registers all block assets so that they can be enqueued through Gutenberg in
     * the corresponding context.
     *
     * Passes translations to JavaScript.
     */
    public function register_block_type(){

        if (!function_exists('register_block_type')) {
            // Gutenberg is not active.
            return;
        }

        if(method_exists($this, 'enqueue')){
            $this -> enqueue();
        }

        $args   = array_merge($this -> get_default_arguments(), $this -> register());

        register_block_type( $this -> get_block_type(), $args);

        if (function_exists('wp_set_script_translations')) {
            /**
             * May be extended to wp_set_script_translations( 'my-handle', 'my-domain',
             * plugin_dir_path( MY_PLUGIN ) . 'languages' ) ). For details see
             * https://make.wordpress.org/core/2018/11/09/new-javascript-i18n-support-in-wordpress/
             */
            wp_set_script_translations('tz-gutenberg-'.$this -> get_name(), 'templaza-framework');
        }
    }

    public function load_textdomain(){
        load_plugin_textdomain('templaza-framework', false, basename(__DIR__) . '/languages');
    }
}
