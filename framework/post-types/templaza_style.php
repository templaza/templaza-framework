<?php

namespace TemPlazaFramework\Post_Type;

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Admin_Functions;
use TemPlazaFramework\Core\Fields;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Post_Type;
use TemPlazaFramework\Enqueue;

if(!class_exists('TemPlazaFramework\Post_Type\Templaza_Style')){
    class Templaza_Style extends Post_Type{
        public $setting_args;

        public function register()
        {
            $theme  = $this -> theme;
            $labels = array(
                'name'               => _x( $theme->get('Name').' Templates', 'templaza-framework', $this -> text_domain ),
                'singular_name'      => _x( $theme->get('Name').' Templates', 'templaza-framework', $this -> text_domain ),
                'menu_name'          => _x( $theme->get('Name').' Options', 'templaza-framework', $this -> text_domain ),
                'name_admin_bar'     => _x( $theme->get('Name').' Options', 'templaza-framework', $this -> text_domain ),
                'add_new'            => _x( 'Add New', 'templaza-framework', $this -> text_domain ),
                'add_new_item'       => __( 'Add New template', $this -> text_domain),
                'new_item'           => __( 'New template', $this -> text_domain ),
                'edit_item'          => __( 'Edit template', $this -> text_domain),
                'view_item'          => __( 'View template', $this -> text_domain ),
                'all_items'          => __( 'All templates', $this -> text_domain ),
                'search_items'       => __( 'Search templates', $this -> text_domain ),
                'parent_item_colon'  => __( 'Parent templates:', $this -> text_domain ),
                'not_found'          => __( 'No templates found.', $this -> text_domain ),
                'not_found_in_trash' => __( 'No templates found in Trash.', $this -> text_domain )
            );

            $args = array(
                'labels'             => $labels,
                'description'        => __( 'Description.', $this -> text_domain ),
                'public'             => false,
                'publicly_queryable' => false,
                'show_ui'            => true,
//                'show_in_menu'       => true,
                'show_in_menu'       => TEMPLAZA_FRAMEWORK,
                'query_var'          => false,
                'rewrite'            => array( 'slug' => 'templaza-framework' ),
                'capability_type'    => 'post',
                'has_archive'        => false,
                'hierarchical'       => false,
                'menu_position'      => null,
                'supports'           => array( 'title' ),
                'menu_icon'          => 'dashicons-art'
            );
            return $args;
        }

        public function init()
        {
            // Load meta boxes
            require_once TEMPLAZA_FRAMEWORK_INCLUDES_PATH.'/metabox.php';

            // Require file from theme to override meta_box
            $theme_metabox_file = TEMPLAZA_FRAMEWORK_THEME_PATH_METABOXES.'/metabox.php';
            if(file_exists($theme_metabox_file)) {
                require_once $theme_metabox_file;
            }

            // Load all meta boxes from plugin
            $this -> load_metaboxes(TEMPLAZA_FRAMEWORK_METABOXES_PATH);
            // Load all meta boxes from theme
            $this -> load_metaboxes(TEMPLAZA_FRAMEWORK_THEME_PATH_METABOXES);

        }

        public function hooks()
        {
            parent::hooks();

            // Remove all admin notices
            if(\is_user_logged_in()) {
                add_action('in_admin_header', array($this, 'remove_admin_notices'), 1000);

                add_action('templaza-framework/post_type/registered', array($this, 'post_type_registered'));
            }
        }

        public function remove_admin_notices(){
            if(is_admin() && $this ->my_post_type_exists()) {
                remove_all_actions('admin_notices');
                remove_all_actions('all_admin_notices');
            }
        }

        public function post_type_registered(){

            add_action( 'templaza-framework/framework/hooks', array( $this, 'register_sidebar' ) );

            $this -> init_main_options();

            if($this -> my_post_type_exists()) {

                $post_type  = $this -> get_post_type();
                $opt_name   = $this ->setting_args?$this -> setting_args[$post_type]['opt_name']:'';

                add_filter( 'redux/'.$opt_name .'/panel/template/header.tpl.php' , function($path){
                    return TEMPLAZA_FRAMEWORK_CORE_TEMPLATE.'/redux-panel/header.tpl.php';
                });
                add_filter( 'redux/'.$opt_name .'/panel/template/header-stickybar.tpl.php' , function($path){
                    return TEMPLAZA_FRAMEWORK_CORE_TEMPLATE.'/redux-panel/header-stickybar.tpl.php';
                });
                add_filter( 'redux/'.$opt_name .'/panel/template/footer.tpl.php' , function($path){
                    return TEMPLAZA_FRAMEWORK_CORE_TEMPLATE.'/redux-panel/footer.tpl.php';
                });



                add_action('edit_form_after_title', array($this, 'generate_template_options'));
                add_action( 'save_post_'.$this -> get_post_type(), array( $this, 'save_main_options' ), 10, 2 );
//                add_action( 'save_post', array( $this, 'save_main_options' ), 10, 2 );

//                // Check post allow or deny when trash
//                add_filter('pre_trash_post', array($this, 'pre_trash_post'), 10, 2);

                // Create duplicate action
                add_filter('post_row_actions', array($this, 'duplicate_post_link'), 10, 2);

                // Duplicate action store
                add_action( 'admin_action_'.$post_type.'_duplicate', array($this, 'post_type_duplicate') );

                // Delete post action
                add_action( 'before_delete_post', array($this, 'delete_post_config') );

                // Remove templates post attributes
                add_filter("theme_{$post_type}_templates", array($this, 'remove_templates'));


//                add_action( 'wp_ajax_mm_edit_widget', array( $this, 'ajax_show_widget_form' ) );

            }
            add_action('admin_footer', function(){
                $t  = \Redux::instance($this -> setting_args[$this -> get_post_type()]['opt_name']);
                if($t && method_exists($t, '_enqueue')) {
                    $t->_enqueue();
                }
                if(!$this ->my_post_type_exists()) {
                    wp_add_inline_script('redux-js', '
                    (function($){ 
                        $(window).load(function(){
                            $.redux.initFields();
                        });
                    })(jQuery);');
                }
            }, 99);
        }


        /**
         * Create our own widget area to store all mega menu widgets.
         * All widgets from all menus are stored here, they are filtered later
         * to ensure the correct widgets show under the correct menu item.
         *
         * @since 1.0
         */
        public function register_sidebar() {
            $my_args = $this -> setting_args[$this -> get_post_type()];
            register_sidebar(
                array(
                    'id' => 'templaza-framework__sidebar',
                    'name' => __("TemPlaza Framework Widgets", $this -> text_domain),
                    'description'   => sprintf(__("This is where TemPlaza Framework stores widgets that you have added to layout or sub menus using layout or mega menu builder. You can edit existing widgets here, but new widgets must be added through layout or mega menu interface (under %s or Appearance > Menus).", $this -> text_domain), $my_args['page_title'])
                )
            );
        }

        protected function _init_arguments() {
            $theme                      = wp_get_theme(); // For use with some settings. Not necessary.
            $global_args                = $this -> framework -> get_arguments();
            $global_args['post_type']   = $this -> get_post_type();
            $global_args['hide_expand']  = false;

            \Redux::set_args($global_args['opt_name'], $global_args);

            $this -> setting_args['settings']   = $global_args;

            $args                   = $this -> setting_args['settings'];
            $args['opt_name']      .= '-' . $this->get_post_type();
            $args['dev_mode']       = false;
            $args['database']       = '';
            $args['ajax_save']      = false;
            $args['hide_save']      = true;
            $args['menu_type']      = 'hidden';
            $args['hide_reset']     = true;
//            $args['post_type']     = $this -> get_post_type();
//            $args['open_expanded']  = true;

//            $args['shortcode_section']    = true;
            $args['display_name']   = __('Template Settings', $this->text_domain);

            // Get option values from file and load to fields
            add_filter("pre_option_{$args['opt_name']}", function($options){
                if($this -> my_post_type_exists() && isset($_GET['post']) && $_GET['post']
                    && isset($_GET['action']) && $_GET['action'] == 'edit'){
                    $post_id    = $_GET['post'];
                    $pID = get_post_meta($post_id, '_' . $this -> get_post_type(), true);

                    if ($pID) {
                        $file = TEMPLAZA_FRAMEWORK_THEME_PATH . '/theme_options/' . $pID . '.json';
                        if (file_exists($file)) {
                            require_once(ABSPATH . '/wp-admin/includes/file.php');
                            global $wp_filesystem;
                            WP_Filesystem();

                            $options = $wp_filesystem->get_contents($file);

                            $options = json_decode($options, true);
                        }
                    }
                }

                return $options;
            });

            $this -> setting_args[$this -> get_post_type()]   = $args;
        }

        public function init_main_options(){

            $core_file     = TEMPLAZA_FRAMEWORK_OPTION_PATH.'/config.php';
            if(file_exists($core_file)){
                require_once $core_file;
            }
            $core_file     = TEMPLAZA_FRAMEWORK_THEME_PATH_OPTION.'/config.php';
            if(file_exists($core_file)){
                require_once $core_file;
            }

            $this -> _init_arguments();

            $_pagenow   = isset($_GET['page']) && $_GET['page']?$_GET['page']:'';

            // If page url param is settings don't load fields below
            if($_pagenow == 'tzfrm_options'){
                return;
            }

            if($sections = \Templaza_API::construct_sections($this -> get_post_type())) {

                if(count($sections)) {
                    $args       = $this -> setting_args[$this -> get_post_type()];
                    $opt_name   = $args['opt_name'];

                    \Redux::set_args($opt_name, $args);
                    \Redux::set_sections($opt_name, $sections);
                    $path = TEMPLAZA_FRAMEWORK_CORE_PATH . '/extensions/';
                    \Redux::set_extensions($opt_name, $path);
                    \Redux::init($opt_name);
                    $default_options    = \Redux::$options_defaults;

                    if(($redux  = \Redux::instance($opt_name))
                        && $this -> get_current_screen_post_type() == $this -> get_post_type()) {
                        $redux -> transients    = count($redux -> transients)?$redux -> transients:array('changed_values' => '');

                        \Templaza_API::load_my_fields($opt_name);

                        // Set options
                        $gb_options   = Functions::get_global_settings();
                        $redux->options = !empty($redux->options) ? $redux->options : array();
                        if(!isset($redux -> options['layout']) && !empty($gb_options) && isset($gb_options['layout'])) {
                            $redux->options['layout'] = $gb_options['layout'];
                        }

                        $redux->_register_settings();

                        $enqueue    = new Enqueue($redux);
                        $enqueue -> init();

                        ob_start();
                        $redux->generate_panel();
                        $content = ob_get_contents();
                        ob_end_clean();
                    }
                }
            }
        }

        public function remove_templates($post_templates){
            return array();
        }

        /*
         * Check post allow or deny trash
         * @param bool $check
         * @param object $post
         * */
        public function pre_trash_post($check, $post){

            if($post && $post -> post_type == $this -> get_post_type()) {

                $is_home = (bool) get_post_meta($post -> ID, 'home', true);

                if($is_home){
                    $check  = false;
                }
            }

            return $check;
        }
        /*
         * Add duplicate post link
         * @param array $actions
         * @param object $post
         * */
        public function duplicate_post_link($actions, $post){
            if(isset($actions['clone'])){
                unset($actions['clone']);
            }
            if ($post->post_type==$this -> get_post_type())
            {
                $action = $this -> get_post_type().'_duplicate';
                $nonce  = wp_create_nonce( $action );
                $actions['duplicate'] = '<a href="admin.php?action='.$action.'&post='.$post -> ID.'&_wpnonce='
                    .$nonce.'" title="" rel="permalink">'.esc_html__('Duplicate', $this -> text_domain).'</a>';
            }
            return $actions;
        }

        /*
         * Delete post config file from theme
         * @param string|int $postid
         * */
        public function delete_post_config($postid){
            // Get post type by post id
            $post_type = \get_post_type($postid);
            if($post_type != $this ->get_post_type()){
                return;
            }
            $theme_name = \get_post_meta($postid, '_'.$this -> get_post_type().'_theme', true);
            $file_name  = \get_post_meta($postid, '_'.$this -> get_post_type(), true);

            require_once ( ABSPATH . '/wp-admin/includes/file.php' );
            global $wp_filesystem;
            WP_Filesystem();
            $file    = dirname(get_template_directory()).'/'.$theme_name.'/'.TEMPLAZA_FRAMEWORK_NAME
                .'/theme_options/'.$file_name.'.json';

            if(file_exists($file)){
                $wp_filesystem -> delete($file);
            }
        }

        /*
         * Add duplicate post link
         * @param array $actions
         * @param object $post
         * */
        public function post_type_duplicate(){
            $post_type      = $this -> get_post_type();
            $nonce_name     = isset( $_GET['_wpnonce'] ) ? $_GET['_wpnonce'] : '';
//            $nonce_action   = $post_type.'_duplicate';
            $nonce_action   = isset( $_GET['action'] ) ? $_GET['action'] : '';;

            // Check if nonce is valid.
            if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
                wp_die('Security issue occure, Please try again!.');
            }
            $post_id    = isset($_GET['post'])?$_GET['post']:0;
            if(!$post_id){
                wp_die(__('Post or Page creation failed, could not find original post:', $this -> text_domain) . $post_id);
            }

            $post = get_post( $post_id );
            $current_user = wp_get_current_user();
            $post_author = $current_user->ID;

            if (isset( $post ) && $post != null) {
                global $wpdb;
                $args = array(
                    'comment_status' => $post->comment_status,
                    'ping_status'    => $post->ping_status,
                    'post_author'    => $post_author,
                    'post_content'   => $post->post_content,
                    'post_excerpt'   => $post->post_excerpt,
                    'post_name'      => $post->post_name,
                    'post_parent'    => $post->post_parent,
                    'post_password'  => $post->post_password,
                    'post_status'    => 'draft',
                    'post_title'     => $post->post_title,
                    'post_type'      => $post->post_type,
                    'to_ping'        => $post->to_ping,
                    'menu_order'     => $post->menu_order
                );
                $clone_post_id = wp_insert_post( $args );

//                $post_name  = wp_unique_post_slug($post -> post_name, $clone_post_id,
//                    $args['post_status'], $args['post_type'], $args['post_parent']);
////                var_dump($post_name); die();
//                wp_update_post(array('ID' => $clone_post_id, 'post_name' => $post_name));

                $taxonomies = get_object_taxonomies($post->post_type);
                if (!empty($taxonomies) && is_array($taxonomies)){
                    foreach ($taxonomies as $taxonomy) {
                        $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
                        wp_set_object_terms($clone_post_id, $post_terms, $taxonomy, false);
                    }
                }

                $post_meta_data = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
                if (count($post_meta_data)!=0) {

                    $theme_name         = '';
                    $file_option_name   = '';

                    $clone_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
                    foreach ($post_meta_data as $meta_data) {
                        $meta_key = sanitize_text_field($meta_data->meta_key);
                        $meta_value = addslashes($meta_data->meta_value);

                        if($meta_key == '_'.$post_type.'_theme'){
                            $theme_name = $meta_value;
                        }
                        if($meta_key == '_'.$post_type){
                            $file_option_name   = $meta_value;
                            $meta_value         = $clone_post_id;
                        }

                        $clone_query_select[]= "SELECT $clone_post_id, '$meta_key', '$meta_value'";

                    }
                    $clone_query.= implode(" UNION ALL ", $clone_query_select);
                    $wpdb->query($clone_query);

                    // Duplicate options file
                    require_once ( ABSPATH . '/wp-admin/includes/file.php' );
                    global $wp_filesystem;
                    WP_Filesystem();
                    $theme_base_path    = dirname(get_template_directory()).'/'.$theme_name.'/'.TEMPLAZA_FRAMEWORK_NAME
                        .'/theme_options';
                    $source_file   = $theme_base_path.'/'.$file_option_name.'.json';
                    if(file_exists($source_file)){
                        $new_file   = $theme_base_path.'/'.$clone_post_id.'.json';
                        $wp_filesystem -> copy($source_file, $new_file, true);
                    }

                }
                do_action("templaza-framework/post-type/{$post_type}/duplicate", $clone_post_id, $post_id);
                wp_redirect(admin_url('edit.php?post_type='.$post_type));
                exit;
            }
        }

        public function enqueue(){
            parent::enqueue();

            if($this -> my_post_type_exists()) {
                // Remove auto save
                wp_dequeue_script('autosave');
            }

            wp_register_style(TEMPLAZA_FRAMEWORK_NAME.'__css-metabox',
                Functions::get_my_frame_url().'/assets/css/metabox.css');
            wp_enqueue_style(TEMPLAZA_FRAMEWORK_NAME.'__css-metabox');
        }

        /**
         * Modify query of post type (added filter by theme name for list page).
         */
        public function parse_query($query ){
            if(isset($query -> query_vars['post_type']) && $query -> query_vars['post_type'] == $this -> get_post_type()) {
                $query->set('meta_query', array(
                    array(
                        'key' => '_' . $query->query_vars['post_type'] . '_theme',
                        'value' => basename(get_template_directory()), // This cannot be empty because of a bug in WordPress
                        'compare' => '='
                    )
                ));
            }
            $query->query_vars['post__in']  = array();
            return $query;
        }

        public function generate_template_options($post){

            $post_type  = $this -> get_post_type();
            $opt_name   = $this -> setting_args[$post_type]['opt_name'];

            if($redux  = \Redux::instance($opt_name)) {
                $redux->_register_settings();
                $redux->generate_panel();
            }
        }

        public function save_main_options($post_id, $post){

            // Store main config to json file
            $setting_args = $this -> setting_args[$this -> get_post_type()];
            $main_param_name = $setting_args['opt_name'];
//            $main_param_name = $this -> framework -> args['opt_name'];

            if(isset($_POST[$main_param_name])) {
                global $wp_filesystem;
                WP_Filesystem();

                $data   = wp_unslash($_POST[$main_param_name]);

                if(count($data)){
                    $folder     = TEMPLAZA_FRAMEWORK_THEME_PATH . '/theme_options';
                    $file_by_id = $folder . '/' . $post_id . '.json';
                    $file       = $folder . '/' . $post -> post_name . '.json';

                    if(!$wp_filesystem -> is_dir(TEMPLAZA_FRAMEWORK_THEME_PATH)){
                        $wp_filesystem -> mkdir(TEMPLAZA_FRAMEWORK_THEME_PATH);
                    }
                    if(!$wp_filesystem -> is_dir($folder)){
                        $wp_filesystem -> mkdir($folder);
                    }

                    // Rename option file by post id to post name (slug)
                    if(file_exists($file_by_id)){
                        rename($file_by_id, $file);
                    }

                    // Create config file
                    $wp_filesystem->put_contents($file, json_encode($data));

                    update_post_meta( $post_id, '_'.$this -> get_post_type(), $post -> post_name );

                    // Store theme name
                    update_post_meta( $post_id, '_'.$this -> get_post_type().'_theme', basename(get_template_directory()) );
                }
            }
        }

        public function load_metaboxes($path){
            if(!$path || ($path && !is_dir($path))){
                return false;
            }
            require_once ( ABSPATH . '/wp-admin/includes/file.php' );

            $folders  = \list_files($path, 1);
            if(count($folders)){
                foreach ($folders as $folder){
                    $file_name  = basename($folder);
                    $file       = $folder.$file_name.'.php';

                    if(file_exists($file)){
                        require_once $file;
                    }

                    $class_name = 'TemplazaFramework_MetaBox_'.ucfirst($file_name);
                    if(class_exists($class_name)){
                        new $class_name($this, $this -> framework);
                    }
                }
            }
        }
    }
}