<?php

namespace TemPlazaFramework;

use TemPlazaFramework\Core\Fields;

defined('TEMPLAZA_FRAMEWORK') or exit();

if(!class_exists('TemPlazaFramework\Configuration')){
    class Configuration extends Post_Type {

        protected $base_path_option;
        protected $opt_name;
        protected $setting_args;
        protected $meta_key;
        protected $meta_key_theme;

        protected $redux_script_loaded = false;

        public function __construct($framework = null)
        {
            $this -> opt_name  = $this -> get_post_type();

            if(!empty($framework)){
                $global_args    = $framework -> get_arguments();

                if(!empty($global_args) && isset($global_args['opt_name'])){
                    $this -> opt_name   = $global_args['opt_name'].'-'.$this -> get_post_type();
                }
            }

            $this -> base_path_option  = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION. '/'.$this -> get_post_type();

            $this -> meta_key       = '_'.$this -> get_post_type();
            $this -> meta_key_theme = '_'.$this -> get_post_type().'__theme';

            parent::__construct($framework);
        }

        public function hooks()
        {
            parent::hooks();

            // Remove all admin notices
            if(\is_user_logged_in()) {
                $global_args    = $this -> framework -> get_arguments();
                $post_type      = $this -> get_post_type();
                $opt_name       = $this -> opt_name;

                add_action('in_admin_header', array($this, 'remove_admin_notices'), 1000);

                add_action('edit_form_after_title', array($this, 'generate_redux_options'));
                add_action( 'save_post_'.$post_type, array( $this, 'save_redux_options' ), 10, 2 );

                // Create duplicate action
                add_filter('post_row_actions', array($this, 'duplicate_post_link'), 10, 2);

                // Duplicate action store
                add_action( 'admin_action_'.$post_type.'_duplicate', array($this, 'post_type_duplicate') );

                // Delete post action
                add_action( 'before_delete_post', array($this, 'delete_post_config') );

                // Change post count in list page
                add_action( 'views_edit-'.$post_type, array($this, 'custom_view_count') );

                // Manage post type header column list hook
                if(method_exists($this, 'manage_edit_columns')){
                    remove_filter('manage_'.$this ->get_post_type().'_posts_columns', array($this, 'manage_edit_columns'));
                    add_filter('manage_'.$this ->get_post_type().'_posts_columns', array($this, 'manage_edit_columns'),10);
                }
                // Manage post type content column list hook
                if(method_exists($this, 'manage_custom_column')) {
                    remove_action('manage_' . $this->get_post_type() . '_posts_custom_column', array($this, 'manage_custom_column'));
                    add_action('manage_' . $this->get_post_type() . '_posts_custom_column', array($this, 'manage_custom_column'), 10, 2);
                }

                if($this ->my_post_type_exists()){
                    if(method_exists($this,'parse_query')) {
                        add_filter('parse_query', array($this, 'parse_query'));
                    }
                }

                add_action('wp_ajax_redux_link_options-'.$opt_name, array($this, 'link_options'));
                add_action('wp_ajax_nopriv_redux_link_options-'.$opt_name, array($this, 'link_options'));
                add_action('wp_ajax_redux_download_options-'.$opt_name, array($this, 'download_options'));
                add_action('wp_ajax_nopriv_redux_download_options-'.$opt_name, array($this, 'download_options'));

                // After registered post type
                add_action('templaza-framework/post_type/registered', array($this, 'post_type_registered'));

                // Fix issue init field required option
                add_action('templaza-framework/post-type/metabox/last/loaded', array($this, 'metabox_last_loaded'));
            }
        }


        /**
         * Function to Fix issue init field required option
         * */
        public function metabox_last_loaded(){
            $args       = $this -> setting_args[$this -> get_post_type()];
            $opt_name   = $args['opt_name'];
            $redux  = \Redux::instance($opt_name);

            if($redux && isset($redux -> enqueue_class) && !$this -> redux_script_loaded) {
                $redux->enqueue_class->init();
                $this -> redux_script_loaded    = true;
            }
        }

        /**
         * Import link options.
         */
        public function link_options() {
            $opt_name       = $this -> opt_name;

            if ( ! isset( $_GET['secret'] ) || md5( md5( \Redux_Functions_Ex::hash_key() ) . '-' . $opt_name) !== $_GET['secret'] ) { // phpcs:ignore WordPress.Security.NonceVerification
                wp_die( 'Invalid Secret for options use' );
                exit;
            }

            $var    = array();
            if(isset($_GET['post_id']) && !empty($_GET['post_id'])){
                $style_id   = $_GET['post_id'];
                $var    = Functions::get_theme_option_by_id($style_id, $this -> get_post_type());
            }
            $var['redux-backup'] = 1;

            if ( isset( $var['REDUX_imported'] ) ) {
                unset( $var['REDUX_imported'] );
            }

            echo wp_json_encode( $var );

            die();
        }

        /**
         * Export post type options
         * */
        public function download_options(){

            $opt_name   = $this -> opt_name;
            if ( ! isset( $_GET['secret'] ) || md5( md5( \Redux_Functions_Ex::hash_key() ) . '-'
                    . $opt_name ) !== $_GET['secret'] ) { // phpcs:ignore WordPress.Security.NonceVerification
                wp_die( __('Invalid Secret for options use', 'templaza-framework') );
                exit;
            }

            $options    = array();

            if(isset($_GET['post_id']) && !empty($_GET['post_id'])){
                $style_id   = $_GET['post_id'];
                $options    = Functions::get_theme_option_by_id($style_id, $this -> get_post_type());
            }

            $backup_options                 = $options;
            $backup_options['redux-backup'] = 1;

            if ( isset( $backup_options['REDUX_imported'] ) ) {
                unset( $backup_options['REDUX_imported'] );
            }

            // No need to escape this, as it's been properly escaped previously and through json_encode.
            $content = wp_json_encode( $backup_options );

            if ( isset( $_GET['action'] ) && 'redux_download_options-' . $opt_name === $_GET['action'] ) { // phpcs:ignore WordPress.Security.NonceVerification
                header( 'Content-Description: File Transfer' );
                header( 'Content-type: application/txt' );
                header( 'Content-Disposition: attachment; filename="redux_options_"' . $opt_name . '_backup_' . gmdate( 'd-m-Y' ) . '.json' );
                header( 'Content-Transfer-Encoding: binary' );
                header( 'Expires: 0' );
                header( 'Cache-Control: must-revalidate' );
                header( 'Pragma: public' );

                echo( $content ); // phpcs:ignore WordPress.Security.EscapeOutput

                exit;
            } else {
                header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
                header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . 'GMT' );
                header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
                header( 'Cache-Control: no-store, no-cache, must-revalidate' );
                header( 'Cache-Control: post-check=0, pre-check=0', false );
                header( 'Pragma: no-cache' );

                // Can't include the type. Thanks old Firefox and IE. BAH.
                // header('Content-type: application/json');.
                echo( $content ); // phpcs:ignore WordPress.Security.EscapeOutput

                exit;
            }
        }

        public function register_redux_arguments(){
            $post_type      = $this -> get_post_type();

            $global_args    = $this -> framework -> get_arguments();
            $global_args['post_type']   = $post_type;
            $global_args['hide_expand']  = true;

            $args                   = $global_args;
            $args['opt_name']       = $this -> opt_name;
            $args['dev_mode']       = false;
            $args['database']       = '';
            $args['ajax_save']      = false;
            $args['save_defaults']  = false;
            $args['hide_save']      = true;
            $args['menu_type']      = 'hidden';
            $args['hide_reset']     = true;
//            $args['open_expanded']  = true;
            $args['show_presets']   = false;
            $args['show_import_export']   = false;

            $args['display_name']   = __('Template Settings', 'templaza-framework');

            return $args;
        }

        protected function __init_redux_arguments() {
            $post_type      = $this -> get_post_type();

            if(isset($this -> setting_args[$post_type])){
                return $this -> setting_args[$post_type] ;
            }

            // Get option values from file and load to fields
            add_filter("pre_option_{$this -> opt_name}", function($options){
                if($this -> my_post_type_exists() && isset($_GET['post']) && $_GET['post']
                    && isset($_GET['action']) && $_GET['action'] == 'edit'){

                    $post_id    = $_GET['post'];
                    $pID = get_post_meta($post_id, '_' . $this -> get_post_type(), true);


                    if ($pID) {

                        // Option file path from uploads folder
                        $file   = $this -> base_path_option.'/'.$pID.'.json';

                        // Option file path from theme if uploads folder not exists config file
                        $file   = !file_exists($file)?TEMPLAZA_FRAMEWORK_THEME_PATH_THEME_OPTION
                            .'/'.$this -> get_post_type().'/'. $pID . '.json':$file;

                        if (file_exists($file)) {
                            $options = file_get_contents($file);

                            $options = json_decode($options, true);
                        }
                    }
                }

                return $options;
            });

            $this -> setting_args[$post_type] = $this -> register_redux_arguments();
        }

        /**
         * Post type registered function
         * */
        public function post_type_registered(){
            global $pagenow;

            $post_type          = $this -> get_post_type();
            $current_post_type  = $this -> get_current_screen_post_type();

            $this -> __init_redux_arguments();

            if($current_post_type == $post_type){
                $this -> init_redux_options();
            }

            if($this -> my_post_type_exists()) {

                $opt_name = $this->setting_args ? $this->setting_args[$post_type]['opt_name'] : '';

                add_filter('redux/' . $opt_name . '/panel/template/header.tpl.php', function ($path) {
                    return TEMPLAZA_FRAMEWORK_CORE_TEMPLATE . '/redux-panel/header.tpl.php';
                });
                add_filter('redux/' . $opt_name . '/panel/template/container.tpl.php', function ($path) {
                    return TEMPLAZA_FRAMEWORK_CORE_TEMPLATE . '/redux-panel/container.tpl.php';
                });
                add_filter('redux/' . $opt_name . '/panel/template/header-stickybar.tpl.php', function ($path) {
                    return TEMPLAZA_FRAMEWORK_CORE_TEMPLATE . '/redux-panel/header-stickybar.tpl.php';
                });
                add_filter('redux/' . $opt_name . '/panel/template/footer.tpl.php', function ($path) {
                    return TEMPLAZA_FRAMEWORK_CORE_TEMPLATE . '/redux-panel/footer.tpl.php';
                });
            }

            add_action('admin_footer', function(){
                $redux  = \Redux::instance($this -> setting_args[$this -> get_post_type()]['opt_name']);
                if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
                    if($redux && method_exists($redux, '_enqueue')) {
                        $redux->_enqueue();
                    }
                }else{
                    if($redux && isset($redux->enqueue_class) && $redux->enqueue_class) {
                        $redux->enqueue_class->init();
                    }
                }
            }, 99);
        }

        /**
         * Remove wp admin notices
         * */
        public function remove_admin_notices(){
            if(is_admin() && $this ->my_post_type_exists()) {
                remove_all_actions('admin_notices');
                remove_all_actions('all_admin_notices');
            }
        }

        /**
         * Init redux options
         * */
        public function init_redux_options(){
            global $pagenow;

            $_pagenow   = isset($_GET['page']) && $_GET['page']?$_GET['page']:'';

            // If page url param is settings don't load fields below
            if($_pagenow == 'tzfrm_options' || $pagenow == 'edit.php'){
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

                    if(($redux  = \Redux::instance($opt_name))
                        && $this -> get_current_screen_post_type() == $this -> get_post_type()) {
                        $redux -> transients    = count($redux -> transients)?$redux -> transients:array('changed_values' => '');

                        \Templaza_API::load_my_fields($opt_name);

                        if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
                            $redux->_register_settings();

                            $enqueue    = new Enqueue($redux);
                            $enqueue -> init();
                        }else{
                            $redux -> options_class -> register();
//                            $redux -> enqueue_class -> init();
                        }
                    }
                }
            }
        }

        /**
         * Generate redux options html for this post type
         * @param WP_Post $post Post object
         * */
        public function generate_redux_options($post){

            $post_type  = $this -> get_post_type();

            if($post_type !== $this -> get_current_screen_post_type()){
                return;
            }

            $opt_name   = $this -> opt_name;

            if($redux  = \Redux::instance($opt_name)) {
                if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
                    $redux->_register_settings();
                    $redux->generate_panel();
                }elseif(isset($redux -> options_class)){
                    $redux -> options_class -> register();
                    $redux -> render_class->generate_panel();
                }
            }
        }

        /**
         * Save options to file
         * @param int $post_id An optionial of post id
         * @param WP_Post $post Post object
         * */
        public function save_redux_options($post_id, $post){

            // Store main config to json file
            $setting_args = $this -> setting_args[$this -> get_post_type()];
            $main_param_name = $setting_args['opt_name'];

            if(isset($_POST[$main_param_name])) {
                global $wp_filesystem;
                WP_Filesystem();

                $data   = wp_unslash($_POST[$main_param_name]);

                if(count($data) && !empty($post -> post_name )){
                    $folder     = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION. '/'.$this -> get_post_type();

                    if(isset($this -> base_path_option) && !empty($this -> base_path_option)){
                        $folder = $this -> base_path_option;
                    }

                    if(!is_dir($folder)){
                        mkdir($folder, FS_CHMOD_DIR, true);
                    }

                    $file_by_id = $folder .'/' . $post_id . '.json';

                    $file       = $folder .'/' . $post -> post_name . '.json';

                    $old_slugs   = get_post_meta($post_id, '_wp_old_slug');
                    if(!empty($old_slugs) && !in_array($post -> post_name, $old_slugs)){
                        foreach ($old_slugs as $old_slug){
                            // Rename old slug file to new slug file
                            if(file_exists($folder.'/'.$old_slug.'.json') && !file_exists($folder.'/'.$post -> post_name.'.json')){
                                rename($folder.'/'.$old_slug.'.json', $folder.'/'.$post -> post_name.'.json');
                            }elseif(file_exists($folder.'/'.$old_slug.'.json')){
                                // Remove old file
                                unlink($folder.'/'.$old_slug.'.json');
                            }
                        }
                    }

                    // Rename option file by post id to post name (slug)
                    if(file_exists($file_by_id)){
                        rename($file_by_id, $file);
                    }

                    // Check import
                    if (( isset( $data['import_link'] ) && '' !== $data['import_link']
                            && ! ! wp_http_validate_url( $data['import_link'] ) ) ||
                        ( isset( $data['import_code'] ) && '' !== $data['import_code'] )) {
                        $data_import    = array();
                        if ( isset( $data['import_link'] ) && '' !== $data['import_link'] && ! ! wp_http_validate_url( $data['import_link'] ) ) {
                            $import           = wp_remote_retrieve_body( wp_remote_get( $data['import_link'] ) );
                            $data_import = json_decode( $import, true );
                        }
                        if ( isset( $data['import_code'] ) && '' !== $data['import_code'] ) {
                            $data_import = json_decode( $data['import_code'], true );
                        }

                        if(!empty($data_import)) {
                            // Remove other value with field names have not registered
                            $data_import    = !empty($data) ? array_intersect_key($data_import, $data) : $data_import;
                            $data           = array_merge($data, $data_import);
                        }
                    }

                    // Create config file
                    file_put_contents($file, json_encode($data));

                    update_post_meta( $post_id, $this -> meta_key, $post -> post_name );

                    // Store theme name
                    update_post_meta( $post_id, $this -> meta_key_theme, basename(get_template_directory()) );
                }
            }
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
                    .$nonce.'" title="" rel="permalink">'.esc_html__('Duplicate', 'templaza-framework').'</a>';
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
            $file_name  = \get_post_meta($postid, $this -> meta_key, true);

            require_once ( ABSPATH . '/wp-admin/includes/file.php' );
            global $wp_filesystem;
            WP_Filesystem();
            $file   = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION.'/'.$this -> get_post_type()
                .'/'.$file_name.'.json';

            if(file_exists($file)){
                $wp_filesystem -> delete($file);
            }
        }

        /*
         * Add duplicate post link
         * */
        public function post_type_duplicate(){
            $post_type      = $this -> get_post_type();
            $nonce_name     = isset( $_GET['_wpnonce'] ) ? $_GET['_wpnonce'] : '';
            $nonce_action   = isset( $_GET['action'] ) ? $_GET['action'] : '';;

            // Check if nonce is valid.
            if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
                wp_die('Security issue occure, Please try again!.');
            }
            $post_id    = isset($_GET['post'])?$_GET['post']:0;
            if(!$post_id){
                wp_die(__('Post or Page creation failed, could not find original post:', 'templaza-framework') . $post_id);
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
                    'post_status'    => 'publish',
                    'post_title'     => Admin_Functions::unique_post_title($post->post_title, $post -> ID, $post -> post_status, $post -> post_type, $post ->post_parent),
                    'post_type'      => $post->post_type,
                    'to_ping'        => $post->to_ping,
                    'menu_order'     => $post->menu_order
                );
                $clone_post_id      = wp_insert_post( $args );

                $taxonomies = get_object_taxonomies($post->post_type);
                if (!empty($taxonomies) && is_array($taxonomies)){
                    foreach ($taxonomies as $taxonomy) {
                        $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
                        wp_set_object_terms($clone_post_id, $post_terms, $taxonomy, false);
                    }
                }

                $clone_post = get_post($clone_post_id);
                $clone_post_name    = $clone_post -> post_name;

                $clone_post_name    = !empty($clone_post_name)?$clone_post_name:$clone_post_id;

                $post_meta_data = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta"
                    ." WHERE post_id=$post_id"
                    ." AND (meta_key='".$this -> meta_key."' OR meta_key='".$this -> meta_key_theme."')");
                if (count($post_meta_data)!=0) {
                    $source_name    = '';

                    $clone_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
                    foreach ($post_meta_data as $meta_data) {
                        $meta_key = sanitize_text_field($meta_data->meta_key);
                        $meta_value = addslashes($meta_data->meta_value);

                        if($meta_key == '_'.$post_type){
                            $source_name    = $meta_value;
                            $meta_value     = $clone_post_name;
                        }

                        $clone_query_select[]= "SELECT $clone_post_id, '$meta_key', '$meta_value'";

                    }
                    $clone_query.= implode(" UNION ALL ", $clone_query_select);

                    $wpdb->query($clone_query);

                    // Duplicate options file
                    require_once ( ABSPATH . '/wp-admin/includes/file.php' );
                    global $wp_filesystem;
                    WP_Filesystem();

                    $theme_base_path    = $this -> base_path_option;
                    $source_file   = $theme_base_path.'/'.$source_name.'.json';
                    if(file_exists($source_file)){
                        $new_file   = $theme_base_path.'/'.$clone_post_name.'.json';
                        $wp_filesystem -> copy($source_file, $new_file, true);
                    }

                }
                do_action("templaza-framework/post-type/{$post_type}/duplicate", $clone_post_id, $post_id);
                wp_redirect(admin_url('edit.php?post_type='.$post_type));
                exit;
            }
        }

        /**
         * Modify query of post type (added filter by theme name for list page).
         */
        public function parse_query($query){
            global $pagenow, $post_type;
            if(is_admin() && is_main_query() && $pagenow == 'edit.php'){
                if(isset($query -> query_vars['post_type'])
                    && $query -> query_vars['post_type'] == $this -> get_post_type()) {
                    $meta_query = (array) $query -> get('meta_query');
                    $meta_query = array_merge($meta_query, array(
                        array(
                            'key' => '_' . $query->query_vars['post_type'] . '__theme',
                            'value' => get_template(), // This cannot be empty because of a bug in WordPress
                            'compare' => '='
                        )
                    ));
                    $query->set('meta_query', $meta_query);
                }
                $query->query_vars['post__in']  = array();
            }
            return $query;
        }

        public function custom_view_count($views){
            $args = array(
                'post_type'=> $this -> get_post_type(),
                'posts_per_page'    => -1,
                'meta_query' => array(
                    array(
                        'key'     => $this -> meta_key_theme,
                        'value'   => get_template(),
                    )
                ),
            );

            if(isset($views['all'])) {
                $query = new \WP_Query($args);
                $total = $query->found_posts;
                $views['all'] = preg_replace('/\(.+\)/U', '(' . $total . ')', $views['all']);
            }

            if(isset($views['publish'])) {
                wp_reset_query();
                $args['post_status'] = 'publish';
                $query = new \WP_Query($args);
                $publish = $query->found_posts;
                $views['publish'] = preg_replace('/\(.+\)/U', '(' . $publish . ')', $views['publish']);
            }

            if(isset($views['draft'])) {
                wp_reset_query();
                $args['post_status']    = 'draft';
                $query = new \WP_Query($args);
                $draft = $query->found_posts;
                $views['draft'] = preg_replace('/\(.+\)/U', '(' . $draft . ')', $views['draft']);
            }

            if(isset($views['trash'])) {
                wp_reset_query();
                $args['post_status']    = 'trash';
                $query = new \WP_Query($args);
                $trash = $query->found_posts;
                $views['trash'] = preg_replace('/\(.+\)/U', '(' . $trash . ')', $views['trash']);
            }

            return $views;
        }
    }
}