<?php

namespace TemPlazaFramework;

use TemPlazaFramework\Core\Fields;

defined('TEMPLAZA_FRAMEWORK') or exit();

if(!class_exists('TemPlazaFramework\Post_Type')){
    class Post_Type{
        protected $theme;
        protected $framework;
        protected $text_domain;

        protected $cache    = array();

        public function __construct($framework = null)
        {
            $this -> framework  = $framework;
            $this -> theme      = \wp_get_theme();
            $this -> text_domain= Functions::get_my_text_domain();

            if(method_exists($this, 'hooks')){
                $this -> hooks();
            }

            $this -> register_post_type();

            if(method_exists($this, 'init')){
                $this -> init();
            }

//            if(method_exists($this, 'hooks')){
//                $this -> hooks();
//            }
        }

        public function register_post_type(){

            $post_type  = $this->get_post_type();

            if(!post_type_exists($post_type)){
                // Register post type to wordpress
                if(method_exists($this, 'register')) {
                    \register_post_type($this->get_post_type(), $this->register());

                    if($this -> my_post_type_exists()){
                        do_action('templaza-framework/post_type/'.$post_type.'/registered', $post_type, $this);
                    }
                    do_action('templaza-framework/post_type/registered', $post_type, $this);
                }
            }
        }

        public function hooks(){
            $post_type  = $this->get_post_type();

//            add_filter('admin_body_class', array($this, 'admin_body_class'));

            if($this ->my_post_type_exists()){
                if(method_exists($this,'parse_query')) {
                    add_filter('parse_query', array($this, 'parse_query'));
                }
            }
            if(method_exists($this, 'enqueue')){
                add_action('admin_enqueue_scripts', array($this, 'enqueue'));
            }
        }


//        public function post_type_registered($post_type, $framework){
//            add_filter('admin_body_class', array($this, 'admin_body_class'));
//        }

//        public function admin_body_class($body_class){
//            global $typenow;
//
//            if($typenow == $this -> get_post_type()){
//                $body_class .= ' templaza-framework__body ';
//            }
//            return $body_class;
//        }

        // Register arguments for post type
//        public function register(){return array();}

        // Get post type name by class name
        public function get_post_type(){
            $store_id   = __METHOD__;
            $store_id   = md5($store_id);

            if(isset($this -> cache[$store_id])){
                return $this -> cache[$store_id];
            }

            $class_name = get_class($this);
            $class_name = preg_replace('#^'.addslashes(__CLASS__).'\\\\#i', '', $class_name);
            $class_name = strtolower($class_name);

            $this -> cache[$store_id]   = $class_name;

            return $class_name;
        }

        public function get_current_screen_post_type() {

            global $post, $typenow, $current_screen;

            if ($post && $post->post_type) return $post->post_type;

            elseif($typenow) return $typenow;

            elseif($current_screen && $current_screen->post_type) return $current_screen->post_type;

            elseif(isset($_REQUEST['post']) && \get_post_type($_REQUEST['post'])) return \get_post_type($_REQUEST['post']);
            elseif(isset($_REQUEST['post_type'])) return sanitize_key($_REQUEST['post_type']);

            return null;

        }

        public function my_post_type_exists(){
            $post_type  = $this -> get_post_type();
            if(post_type_exists($this -> get_post_type()) && $this -> get_current_screen_post_type() == $post_type) {
                return true;
            }
            return false;
        }

        public function enqueue(){
            wp_enqueue_style(TEMPLAZA_FRAMEWORK_NAME.'__css-core');
            wp_enqueue_style(TEMPLAZA_FRAMEWORK_NAME.'__css');
            wp_enqueue_script(TEMPLAZA_FRAMEWORK_NAME.'__js');
        }
    }
}