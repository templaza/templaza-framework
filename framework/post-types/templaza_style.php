<?php

namespace TemPlazaFramework\Post_Type;

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Admin_Functions;
use TemPlazaFramework\Core\Fields;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Menu_Admin;
use TemPlazaFramework\Post_Type;
use TemPlazaFramework\Enqueue;
use TemPlazaFramework\Post_TypeFunctions;

if(!class_exists('TemPlazaFramework\Post_Type\Templaza_Style')){
    class Templaza_Style extends Post_Type{
        public $setting_args;

        protected $metaboxes    = array();
        // phpcs:disable WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents, WordPress.DB.PreparedSQL.NotPrepared, WordPress.WP.AlternativeFunctions.unlink_unlink, WordPress.WP.AlternativeFunctions.file_system_operations_mkdir, WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents, WordPress.WP.AlternativeFunctions.rename_rename, WordPress.Security.NonceVerification.Recommended,  	WordPress.WP.AlternativeFunctions.json_encode_json_encode, WordPress.DB.PreparedSQL.InterpolatedNotPrepared, WordPress.Security.NonceVerification.Missing,  WordPress.DB.SlowDBQuery.slow_db_query_meta_query

        public function register()
        {
            // phpcs:disable WordPress.WP.I18n.NonSingularStringLiteralText
            $theme  = $this -> theme;
            $labels = array(
                'name'               => esc_attr_x( $theme->get('Name').' Templates', 'templaza-framework', 'templaza-framework' ),
                'singular_name'      => esc_attr_x( $theme->get('Name').' Templates', 'templaza-framework', 'templaza-framework' ),
                'menu_name'          => esc_attr_x( $theme->get('Name').' Options', 'templaza-framework', 'templaza-framework' ),
                'name_admin_bar'     => esc_attr_x( $theme->get('Name').' Options', 'templaza-framework', 'templaza-framework' ),
                'add_new'            => _x( 'Add New', 'templaza-framework', 'templaza-framework' ),
                'add_new_item'       => __( 'Add New template', 'templaza-framework'),
                'new_item'           => __( 'New template', 'templaza-framework' ),
                'edit_item'          => __( 'Edit template', 'templaza-framework'),
                'view_item'          => __( 'View template', 'templaza-framework' ),
                'all_items'          => __( 'Templates', 'templaza-framework' ),
                'search_items'       => __( 'Search templates', 'templaza-framework' ),
                'parent_item_colon'  => __( 'Parent templates:', 'templaza-framework' ),
                'not_found'          => __( 'No templates found.', 'templaza-framework' ),
                'not_found_in_trash' => __( 'No templates found in Trash.', 'templaza-framework' )
            );

            $args = array(
                'labels'             => $labels,
                'description'        => __( 'Description.', 'templaza-framework' ),
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
                $global_args    = $this -> framework -> get_arguments();
                $opt_name       = $global_args['opt_name'].'-templaza_style';
                add_action('wp_ajax_redux_link_options-'.$opt_name, array($this, 'link_options'));
                add_action('wp_ajax_nopriv_redux_link_options-'.$opt_name, array($this, 'link_options'));
                add_action('wp_ajax_redux_download_options-'.$opt_name, array($this, 'download_options'));
                add_action('wp_ajax_nopriv_redux_download_options-'.$opt_name, array($this, 'download_options'));

                add_action('in_admin_header', array($this, 'remove_admin_notices'), 1000);

                add_action('templaza-framework/post_type/registered', array($this, 'post_type_registered'));

                // Change post count in list page
                add_action( 'views_edit-'.$this -> get_post_type(), array($this, 'custom_view_count') );
            }
        }

        public function get_options_by_post_id($style_id){
            if($style_id){
                $file_id    = get_post_meta($style_id, '_templaza_style', true);
                $theme_name = get_post_meta($style_id, '_templaza_style_theme', true);
                if($file_id){
                    require_once ( ABSPATH . '/wp-admin/includes/file.php' );
                    global $wp_filesystem;
                    WP_Filesystem();
                    $file   = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION.'/'.$file_id.'.json';
                    if(file_exists($file)){
                        $options    = $wp_filesystem -> get_contents($file);
                        $options    = json_decode($options, true);
                        return $options;
                    }

                }
            }
            return array();
        }

        public function download_options() {
            $global_args    = $this -> framework -> get_arguments();
            $opt_name       = $global_args['opt_name'].'-templaza_style';
            if ( ! isset( $_GET['secret'] ) || md5( md5( \Redux_Functions_Ex::hash_key() ) . '-'
                    . $opt_name ) !== $_GET['secret'] ) { // phpcs:ignore WordPress.Security.NonceVerification
                wp_die( esc_html__('Invalid Secret for options use', 'templaza-framework') );
                exit;
            }

            $options    = array();

            if(isset($_GET['post_id']) && !empty($_GET['post_id'])){
                $style_id   = $_GET['post_id'];
                $options    = $this ->get_options_by_post_id($style_id);
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


        /**
         * Import link options.
         */
        public function link_options() {
            $global_args    = $this -> framework -> get_arguments();
            $opt_name       = $global_args['opt_name'].'-templaza_style';

            if ( ! isset( $_GET['secret'] ) || md5( md5( \Redux_Functions_Ex::hash_key() ) . '-' . $opt_name) !== $_GET['secret'] ) { // phpcs:ignore WordPress.Security.NonceVerification
                wp_die( 'Invalid Secret for options use' );
                exit;
            }

            $var    = array();
            if(isset($_GET['post_id']) && !empty($_GET['post_id'])){
                $style_id   = $_GET['post_id'];
                $var    = $this ->get_options_by_post_id($style_id);
            }
            $var['redux-backup'] = 1;

            if ( isset( $var['REDUX_imported'] ) ) {
                unset( $var['REDUX_imported'] );
            }

            echo wp_json_encode( $var );

            die();
        }

        public function remove_admin_notices(){
            if(is_admin() && $this ->my_post_type_exists()) {
                remove_all_actions('admin_notices');
                remove_all_actions('all_admin_notices');
            }
        }

        public function post_type_registered(){
            global $pagenow;

            add_action( 'templaza-framework/framework/hooks', array( $this, 'register_sidebar' ) );

            $this -> _init_arguments();

            $slugs              = Menu_Admin::get_submenu_slugs();
            $post_type          = $this -> get_post_type();
            $current_post_type  = $this -> get_current_screen_post_type();
            $tzfrm_post_types   = Post_TypeFunctions::getPostTypes();

            if(($current_post_type == 'templaza_style') || in_array($current_post_type, $tzfrm_post_types)
                || ($pagenow == 'nav-menus.php' || ($pagenow == 'admin.php' && isset($_GET['page'])
                        && (in_array($_GET['page'], $slugs) || $_GET['page'] == $this -> setting_args[$post_type]['opt_name'])))){
                $this -> init_main_options();
            }

            if($this -> my_post_type_exists()) {

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

                add_action( 'pre_post_update', array( $this, 'pre_post_update' ), 10, 2 );
//                add_filter( 'wp_insert_post_data', array( $this, 'wp_insert_post_data' ), 10, 2 );

                // Create duplicate action
                add_filter('post_row_actions', array($this, 'duplicate_post_link'), 10, 2);

                // Duplicate action store
                add_action( 'admin_action_'.$post_type.'_duplicate', array($this, 'post_type_duplicate') );

                // Delete post action
                add_action( 'before_delete_post', array($this, 'delete_post_config') );

                // Remove templates post attributes
                add_filter("theme_{$post_type}_templates", array($this, 'remove_templates'));

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

                if(!$this ->my_post_type_exists()) {
                    wp_add_inline_script('redux-js', '
                    jQuery(document).ready(function($){
                        let templaza_frameworkBlockLoadedInterval = setInterval(function() {
                            if (!$(".postbox .redux-field-container").is(":hidden")) {
                                //Actual functions goes here
                                $.redux.initFields();
                                clearInterval( templaza_frameworkBlockLoadedInterval );
                            }
                        }, 500);
                    });');
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
                    'name' => __("TemPlaza Framework Widgets", 'templaza-framework'),
                    /* translators: %s - Supported. */
                    'description'   => sprintf(__("This is where TemPlaza Framework stores widgets that you have added to layout or sub menus using layout or mega menu builder. You can edit existing widgets here, but new widgets must be added through layout or mega menu interface (under %s or Appearance > Menus).", 'templaza-framework'), $my_args['page_title'])
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
            $args['save_defaults']  = false;
            $args['hide_save']      = true;
            $args['menu_type']      = 'hidden';
            $args['hide_reset']     = true;
            $args['show_presets']   = true;

            $args['display_name']   = __('Template Settings', 'templaza-framework');

            // Get option values from file and load to fields
            add_filter("pre_option_{$args['opt_name']}", function($options){
                if($this -> my_post_type_exists() && isset($_GET['post']) && $_GET['post']
                    && isset($_GET['action']) && $_GET['action'] == 'edit'){
                    $post_id    = $_GET['post'];
                    $pID = get_post_meta($post_id, '_' . $this -> get_post_type(), true);

                    if ($pID) {
                        // Option file path from uploads folder
                        $file   = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION.'/'.$pID.'.json';

                        // Option file path from theme if uploads folder not exists config file
                        $file   = !file_exists($file)?TEMPLAZA_FRAMEWORK_THEME_PATH_THEME_OPTION .'/'
                            . $pID . '.json':$file;

                        if (file_exists($file)) {

                            $options = file_get_contents($file);

                            $options = json_decode($options, true);
                        }
                    }
                }

                return $options;
            });

            $this -> setting_args[$this -> get_post_type()]   = $args;
        }

        public function init_main_options(){

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

                        if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
                            $redux->_register_settings();
//                            $enqueue    = new Enqueue($redux);
//                            $enqueue -> init();
                        }else{
                            $redux -> options_class -> register();
//                            $redux -> enqueue_class -> init();
                        }

                        $enqueue    = new Enqueue($redux);
                        $enqueue -> framework_init();

                        ob_start();
                        if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
                            $redux->generate_panel();
                        }else{
                            $redux -> render_class -> generate_panel();
                        }
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
            $theme_name = \get_post_meta($postid, '_'.$this -> get_post_type().'_theme', true);
            $file_name  = \get_post_meta($postid, '_'.$this -> get_post_type(), true);

            require_once ( ABSPATH . '/wp-admin/includes/file.php' );
            global $wp_filesystem;
            WP_Filesystem();
            $file   = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION.'/'.$file_name.'.json';

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
            $nonce_action   = isset( $_GET['action'] ) ? $_GET['action'] : '';;

            // Check if nonce is valid.
            if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
                wp_die('Security issue occure, Please try again!.');
            }
            $post_id    = isset($_GET['post'])?$_GET['post']:0;
            if(!$post_id){
                wp_die(esc_html__('Post or Page creation failed, could not find original post:', 'templaza-framework') . esc_html($post_id));
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
//                    'post_status'    => 'draft',
                    'post_status'    => 'publish',
                    'post_title'     => Admin_Functions::unique_post_title($post->post_title, $post -> ID, $post -> post_status, $post -> post_type, $post ->post_parent),
                    'post_type'      => $post->post_type,
                    'to_ping'        => $post->to_ping,
                    'menu_order'     => $post->menu_order
                );
                $clone_post_id      = wp_insert_post( $args );
                $clone_post_name    = '';

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
                // phpcs:disable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
                $post_meta_data = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
                if (count($post_meta_data)!=0) {

                    $theme_name     = '';
                    $source_name    = '';

                    $clone_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
                    foreach ($post_meta_data as $meta_data) {
                        $meta_key = sanitize_text_field($meta_data->meta_key);
                        $meta_value = addslashes($meta_data->meta_value);

                        if($meta_key == '_'.$post_type.'_theme'){
                            $theme_name = $meta_value;
                        }
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

                    $theme_base_path    = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION;
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

        public function enqueue(){
            parent::enqueue();

            if($this -> my_post_type_exists()) {
                // Remove auto save
                wp_dequeue_script('autosave');
            }

            wp_register_style(TEMPLAZA_FRAMEWORK_NAME.'__css-metabox',
                Functions::get_my_frame_url().'/assets/css/metabox.css',array(),Functions::get_my_version());
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
                if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
                    $redux->_register_settings();
                    $redux->generate_panel();
                }else{
                    $redux -> options_class -> register();
                    $redux -> render_class->generate_panel();
                }
            }
        }

        public function pre_post_update($post_id, $data){
            // Remove old file if slug changed when update
            if($post_id && ($pre_post = get_post($post_id))){
                if(isset($pre_post -> post_name) && !empty($pre_post -> post_name)
                    && isset($data['post_name']) && !empty($data['post_name'])
                    && $pre_post -> post_name !== $data['post_name']){
                    $old_file   = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION.'/'.$pre_post -> post_name.'.json';
                    if(file_exists($old_file)){
                        unlink($old_file);
                    }
                }
            }
        }

        public function save_main_options($post_id, $post){

            // Store main config to json file
            $setting_args = $this -> setting_args[$this -> get_post_type()];
            $main_param_name = $setting_args['opt_name'];

            if(isset($_POST[$main_param_name])) {
                global $wp_filesystem;
                WP_Filesystem();

                $data   = wp_unslash($_POST[$main_param_name]);

                if(count($data) && !empty($post -> post_name )){
                    $folder     = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION;

                    if(!is_dir($folder)){
                        mkdir($folder, FS_CHMOD_DIR, true);
                    }

                    $file_by_id = $folder . '/' . $post_id . '.json';

                    $file       = $folder . '/' . $post -> post_name . '.json';

                    // Rename option file by post id to post name (slug)
                    if(file_exists($file_by_id)){
                        rename($file_by_id, $file);
                    }

                    // Check import
                    if ( isset( $data['import_link'] ) && '' !== $data['import_link'] && ! ! wp_http_validate_url( $data['import_link'] ) ) {
                        $import           = wp_remote_retrieve_body( wp_remote_get( $data['import_link'] ) );
                        $data = json_decode( $import, true );
                    }
                    if ( isset( $data['import_code'] ) && '' !== $data['import_code'] ) {
                        $data = json_decode( $data['import_code'], true );
                    }

                    // Create config file
                    file_put_contents($file, json_encode($data));

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

                    $mtname = str_replace(array('_', '-'), ' ',$file_name);
                    $mtname = !empty($mtname)?ucwords($mtname):$mtname;
                    $mtname = !empty($mtname)?str_replace(' ', '_', $mtname):$mtname;

                    $class_name = 'TemplazaFramework_MetaBox_'.$mtname;
                    if(class_exists($class_name)){
                        if(!isset($this -> metaboxes[$mtname])){
                            $this -> metaboxes[$mtname] = new $class_name($this, $this -> framework);
                        }
                    }

                    $is_last    = ($folder == end($folders));
                    if($is_last){
                        do_action('templaza-framework/post-type/metabox/last/loaded', $this, $path);
                    }

                    do_action('templaza-framework/post-type/metabox/loaded', $this, $path);
                }
            }
            do_action('templaza-framework/post-type/'.$this -> get_post_type().'/metaboxes/loaded',$this, $path);
            do_action('templaza-framework/post-type/metaboxes/loaded',$this, $path);
        }

        public function custom_view_count($views){
            $args = array(
                'post_type'=> $this -> get_post_type(),
                'posts_per_page'    => -1,
                'meta_query' => array(
                    array(
                        'key'     => '_'.$this -> get_post_type().'_theme',
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