<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Enqueue;
use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_MetaBox')) {
    class TemplazaFramework_MetaBox{

        protected $cache        = array();
        protected $metaboxes    = array();

        /**
         * Framework
         *
         * @var object
         */
        protected $framework;

        /**
         * Post type registered
         *
         * @var object
         */
        protected $post_type;

        protected $text_domain;

        public $prefix  = 'tzfrm_metabox-';


        public function __construct($post_type, &$framework = null)
        {
            $this -> post_type      = $post_type;
            $this -> framework      = $framework;
            $this -> text_domain    = Functions::get_my_text_domain();

            if($this -> framework) {
                $this->framework->repeater_data = array();
            }

            if(is_admin()) {
                $this->metaboxes = $this->register();
                $this->metaboxes = apply_filters("templaza-framework/metabox/register", $this->metaboxes, $post_type);

                do_action('templaza-framework/metabox/'.$this -> get_meta_box_name().'/constructor');
            }

            $this -> hooks();
        }

        public function hooks(){

            add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 10, 2 );
            add_action( 'save_post', array( $this, 'save_meta_box' ), 20, 2 );

            if(method_exists($this, 'enqueue')){

                add_action('admin_enqueue_scripts', array($this, 'enqueue'));
            }

            add_action('admin_footer', array($this, 'template'));
        }

        public function add_meta_boxes($post_type){
            $this -> _load_meta_boxes($this -> metaboxes, $post_type);
        }
        protected function _load_meta_boxes($metaboxes, $post_type = null){
            if(count($metaboxes)){

//                // Init redux if it not exists
//                if($args   = $this -> post_type -> setting_args) {
//                    $opt_name   = $args['settings']['opt_name'];
//                    $redux  = \Redux::instance($opt_name);
//                    if(!property_exists($redux, 'core_instance')){
//                        \Redux::set_args($opt_name, $args);
//                        \Redux::init($opt_name);
//                        $redux  = \Redux::instance($opt_name);
//                    }
//                    if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
//                        $redux->_register_settings();
//                    }else{
//                        $redux -> options_class -> register();
//                    }
//
//                    $enqueue    = new Enqueue($redux);
//                    $enqueue -> framework_init();
//                }

                foreach($metaboxes as $k => $metabox){
                    $metabox    = apply_filters('templaza-framework/metabox/change', $metabox);
                    $metabox    = apply_filters("templaza-framework/metabox/{$metabox['id']}/change", $metabox);
                    $metabox_args['metabox']   = $metabox;

                    if($metabox == end($metaboxes)){
                        $metabox_args['last']   = true;
                    }

                    add_meta_box($this -> prefix.$metabox['id'], $metabox['title'], array($this, 'render'),
                        $metabox['post_types'],$metabox['position'], $metabox['priority'], $metabox_args);

                    add_filter('postbox_classes_'.$this -> post_type -> get_post_type().'_'.$metabox['id'],array($this, 'add_metabox_class'));
                }
            }
        }

        public function render($post, $metabox){
            $args   = $metabox['args'];

            $_metabox   = null;
            if(isset($args['metabox']) && $args['metabox']){
                $_metabox   = $args['metabox'];
            }

            if(!empty($_metabox) && isset($_metabox['sections']) && !empty($_metabox['sections'])) {
                $sections   = array();
                $sections   = apply_filters("templaza-framework/metabox/{$_metabox['id']}/sections/before", $sections, $_metabox);

                $sections = array_merge((array) $sections, (array) $_metabox['sections']);
                $sections   = apply_filters("templaza-framework/metabox/{$_metabox['id']}/sections/after", $sections, $_metabox);


                $setting_args                       = $this -> post_type -> setting_args;
                $setting_args                       = $setting_args[$this -> post_type -> get_post_type()];
                $redux_args                         = $setting_args;

                $redux_args['opt_name']             = $metabox['id'];
                $redux_args['menu_type']            = 'hidden';
                $redux_args['dev_mode']             = false;
                $redux_args['ajax_save']            = false;
                $redux_args['open_expanded']        = true;
                $redux_args['show_import_export']   = false;

                // Add id for section if it not exists;
                if(count($sections)){
                    foreach($sections as &$section){
                        if(!isset($section['id'])){
                            $section['id']  = uniqid();
                        }
                        if(!isset($section['title'])){
                            $section['title']  = '';
                        }
                    }
                }

                Redux::set_args($metabox['id'], $redux_args);
                Redux::set_sections($metabox['id'], $sections);

                Redux::init($metabox['id']);
                \Templaza_API::load_my_fields($metabox['id']);

                add_filter("redux/{$setting_args['opt_name']}/repeater", function($repeater_data) use($redux_args){
                    $repeater_data['opt_names'][]   = $redux_args['opt_name'];
                    return $repeater_data;
                });

                $redux  = \Redux::instance($metabox['id']);

                // Set options
                $redux -> options   = $this -> get_my_data($_metabox, $post);

                if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
                    $redux->_register_settings();
//                    $enqueue    = new Enqueue($redux);
//                    $enqueue -> init();
                }else{
                    $redux -> options_class -> register();
//                    $redux -> enqueue_class -> init();
                }
                $enqueue    = new Enqueue($redux);
                $enqueue -> framework_init();

                ?>
                <?php

                echo '<div class="redux-container templaza-framework-options">';
                echo '<div class="redux-main">';
                foreach ($redux -> sections as $k => $section) {

                    $section['class'] = isset($section['class']) ? ' ' . $section['class'] : '';
                    echo '<div id="metabox_'.$metabox['id'].'_' . $k . '_section_group' . '" class="redux-group-tab' . esc_attr($section['class']) . '" data-rel="metabox_'.$metabox['id'].'_' . $k . '">';

                    do_action("redux/page/{$redux->args['opt_name']}/section/before", $section);
                    do_settings_sections( $redux->args['opt_name'] . $k . '_section_group' );
                    do_action("redux/page/{$redux->args['opt_name']}/section/after", $section);

                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
            }else{
                $this -> render_fields($post, $metabox);
            }
        }

        public function add_metabox_class($classes){
            $classes[]  = 'tzfrm-metabox tzfrm-metabox-'.$this -> get_meta_box_name();
            return $classes;
        }

        public function get_meta_box_name(){

            $store_id   = __METHOD__;
            $store_id   = md5($store_id);

            if(isset($this -> cache[$store_id])){
                return $this -> cache[$store_id];
            }

            $class_name = get_class($this);
            $class_name = preg_replace('/^'.__CLASS__.'_/i', '', $class_name);
            $class_name = strtolower($class_name);

            $this -> cache[$store_id]   = $class_name;

            return $class_name;
        }

        // Register meta box
        public function register(){return array();}

        /*
         * Render meta box's fields from file when section of meta box doesn't exists in registration
         * @param object $post
         * @param array $metabox
         * */
        public function render_fields($post, $metabox){
            $metabox_name   = $this -> get_meta_box_name();

            $theme_file     = TEMPLAZA_FRAMEWORK_THEME_PATH_METABOXES.'/'.$metabox_name.'/tmpl/'.$metabox_name.'.php';
            if(file_exists($theme_file)){
                $file   = $theme_file;
            }else {
                $file = TEMPLAZA_FRAMEWORK_METABOXES_PATH . '/' . $metabox_name . '/tmpl/' . $metabox_name . '.php';
            }
            if(file_exists($file)){
                require $file;
            }
        }

        /*
         * Add html template in script tag from file
         * */
        public function template(){
            $metabox_name   = $this -> get_meta_box_name();
            $theme_file     = TEMPLAZA_FRAMEWORK_THEME_PATH_METABOXES.'/'.$metabox_name.'/tmpl/'.$metabox_name.'.tpl.php';
            if(file_exists($theme_file)){
                $file   = $theme_file;
            }else {
                $file = TEMPLAZA_FRAMEWORK_METABOXES_PATH . '/' . $metabox_name . '/tmpl/' . $metabox_name . '.tpl.php';
            }
            if(file_exists($file)){
                require_once $file;
            }
        }

        /*
         * Get post meta data
         * @param array $metabox
         * @param object $post
         * */
        public function get_my_data($metabox, $post){
            $data   = array();
            if($post && !$post -> ID){
                return $data;
            }

            $post_types     = $metabox['post_types'];
            $curpost_type   = $this ->post_type -> get_current_screen_post_type();
            if((!is_array($post_types) && $curpost_type != $post_types) ||
                (is_array($post_types) && !in_array( $curpost_type, $post_types))){
                return $data;
            }

            if(isset($metabox['store_each']) && $metabox['store_each']){
                if(isset($metabox['sections']) && $metabox['sections'] && count($metabox['sections'])){
                    foreach($metabox['sections'] as $section){
                        if(isset($section['fields']) && $section['fields'] && count($section['fields'])){
                            foreach($section['fields'] as $field){
                                $pdata  = get_post_meta($post -> ID, $field['id'], true);
                                if(method_exists($this, 'prepare_field_value')){
                                    $pdata = $this -> prepare_field_value($pdata, $field['id'], $post);
                                }
                                $pdata = apply_filters("templaza-framework/metabox/{$metabox['id']}/prepare_field_value", $pdata, $field['id'], $post);
                                if(!empty($pdata)) {
                                    $data[$field['id']] = $pdata;
                                }
                            }
                        }
                    }
                }
            }else {
                $key    = $metabox['id'];
                $data   = get_post_meta($post->ID, $key, true);
            }
            return (array) $data;
        }

        /*
         * Check meta box permission to store
         * @param int/string $post_id
         * @params object $post
         * */
        public function can_save($post_id, $post){
            // Check if user has permissions to save data.
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return false;
            }

            // Check if not an autosave.
            if ( wp_is_post_autosave( $post_id ) ) {
                return false;
            }

            // Check if not a revision.
            if ( wp_is_post_revision( $post_id ) ) {
                return false;
            }

            return true;
        }

        /*
         * * Store meta box params
         * @param int/string $post_id
         * @params object $post
         * */
        public function save_meta_box( $post_id, $post ) {
            // Check if user has permissions to save data.
            if ( ! $this -> can_save($post_id, $post) ) {
                return;
            }

            $metaboxes  = $this -> metaboxes;
            if(count($metaboxes)){
                foreach ($metaboxes as $metabox){
                    $mt_key  = $this -> prefix.$metabox['id'];
                    if ( isset( $_POST[$mt_key] ) ) {
                        $options    = $_POST[$mt_key];
                        if(isset($metabox['store_each']) && $metabox['store_each']){
                            foreach ($options as $key => $option){
                                if(method_exists($this, 'prepare_field_value_update')){
                                    $option = $this -> prepare_field_value_update($option, $key, $post_id, $post);
                                }
                                $option = apply_filters("templaza-framework/metabox/{$metabox['id']}/prepare_field_value_update", $option, $key, $post_id, $post);

                                $result = false;
                                if(method_exists($this, 'before_update_field_value')){
                                    $result = $this -> before_update_field_value($result, $option, $key, $post_id, $post);
                                }
                                $result = apply_filters("templaza-framework/metabox/{$metabox['id']}/before_update_field_value", $result, $option, $key, $post_id, $post);

                                if($result){
                                    continue;
                                }
                                update_post_meta($post_id, $key, $option);
                            }
                        }else {
                            if(method_exists($this, 'prepare_field_value_update')){
                                $options = $this -> prepare_field_value_update($options, $mt_key, $post_id, $post);
                            }
                            $options = apply_filters("templaza-framework/metabox/{$metabox['id']}/prepare_field_value_update", $options, $mt_key, $post_id, $post);

                            $result = false;
                            if(method_exists($this, 'before_update_field_value')){
                                $result = $this -> before_update_field_value($result, $options, $mt_key, $post_id, $post);
                            }
                            $result = apply_filters("templaza-framework/metabox/{$metabox['id']}/before_update_field_value", $result, $options, $mt_key, $post_id, $post);

                            if($result){
                                continue;
                            }

                            update_post_meta($post_id, $mt_key, $options);
                        }
                    }
                }
            }
        }
    }
}