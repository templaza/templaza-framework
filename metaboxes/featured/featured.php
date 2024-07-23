<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Post_TypeFunctions;

if(!class_exists('TemplazaFramework_MetaBox_Featured')){
    class TemplazaFramework_MetaBox_Featured extends TemplazaFramework_MetaBox{

        private $action_featured    = 'templaza__set_post_featured';
        private $tzfrm_post_types   = array();
        // phpcs:disable  WordPress.Security.NonceVerification.Recommended
        public function __construct($post_type, &$framework = null)
        {

            $options    = Functions::get_global_settings();

            $tzfrm_post_types   = isset($options['enable-featured-for-posttypes'])?$options['enable-featured-for-posttypes']:array();
            $this -> tzfrm_post_types   = $tzfrm_post_types;

            parent::__construct($post_type, $framework);
        }

        public function register(){
//            // Get all post types without templaza_style
//            $tzfrm_post_types  = Post_TypeFunctions::getPostTypes();
//
//            $options    = Functions::get_global_settings();
//
//            $tzfrm_post_types   = isset($options['enable-featured-for-posttypes'])?$options['enable-featured-for-posttypes']:array();

            $tzfrm_post_types   = $this -> tzfrm_post_types;

            $metaboxes[] = array(
                'id'            => 'templaza-options-featured',
                'title'         => __( 'Templaza Featured', 'templaza-framework' ),
                'post_types'    => $tzfrm_post_types,
                'position'      => 'side', // normal, advanced, side
                'priority'      => 'default', // high, core, default, low - Priorities of placement
                'store_each'    => true, // Store value of each fields to each post meta
                'sections'      => array(
                    array(
                        'fields' => array(
                            array(
                                'id'       => 'templaza-featured',
                                'type'     => 'switch',
                                'title'    => esc_html__('Featured', 'templaza-framework'),
                                'subtitle' => esc_html__('Enable this to make featured.', 'templaza-framework'),
                                'args'     => 'templaza_framework_get_templaza_style_by_slug',
                                'on'       => esc_html__('Yes', 'templaza-framework'),
                                'off'      => esc_html__('No', 'templaza-framework'),
                            ),
                        ),
                    ),
                ),
            );

            return $metaboxes;
        }

        public function hooks()
        {
            parent::hooks();

            if(is_user_logged_in() && is_admin()){
                // Add header column to post type list
//                if(method_exists($this,'post_type_table_head')) {
//                    add_filter('manage_'.$post_type.'_posts_columns', array($this, 'post_type_table_head'));
//                    add_filter('manage_post_posts_columns', array($this, 'post_type_table_head'));
//                }
//                if(method_exists($this,'post_type_table_content')) {
//                    add_filter('manage_post_posts_custom_column', array($this, 'post_type_table_content'), 10, 2);
//                }

//                if(method_exists($this,'custom_page_table_head')) {
//                    add_filter('manage_pages_columns', array($this, 'custom_page_table_head'));
//                }
//                if(method_exists($this,'custom_page_table_content')) {
//                    add_filter('manage_pages_custom_columns', array($this, 'custom_page_table_content'));
//                }
                if(method_exists($this,'custom_table_head')) {
//                    add_filter('manage_posts_columns', array($this, 'custom_table_head'), 10, 2);
                    add_filter('manage_posts_columns', array($this, 'custom_table_head'));
                    add_filter('manage_pages_columns', array($this, 'custom_table_head'));
                }
                if(method_exists($this,'custom_table_content')) {
                    add_action('manage_posts_custom_column', array($this, 'custom_table_content'), 10, 2);
                    add_filter('manage_pages_custom_column', array($this, 'custom_table_content'), 10, 2);
                }

//                // Ordering column
//                if(method_exists($this,'post_type_table_sorting')) {
//                    add_filter( 'manage_edit-'.$post_type.'_sortable_columns', array($this, 'post_type_table_sorting' ) );
//                }
//                // Order by column added
//                if(method_exists($this,'post_type_orderby')) {
//                    add_filter( 'request', array($this, 'post_type_orderby' ) );
//                }

//                // Duplicate post action
//                add_action("templaza-framework/post-type/{$post_type}/duplicate", array($this, 'post_duplicate'), 11, 2);

                // Set featured for post type
                add_action( 'admin_action_'.$this -> action_featured, array($this, 'post_type_set_featured') );

                add_filter('views_edit-post', array($this, 'add_views_link'));
                add_filter( 'parse_query', array( $this, 'custom_query_filtering' ) );

//                add_action('restrict_manage_posts','my_author_filter');
            }

        }

        public function add_views_link($views){
            $post_type = ( ( isset( $_GET['post_type'] ) && '' !== $_GET['post_type'] ) ? $_GET['post_type'] : 'post' );

            $count = $this->get_total_featured_count( $post_type );
            $class = ( isset( $_GET['templaza-featured'] ) && '1' === $_GET['templaza-featured'] ) ? 'current' : '';

            $args = array(
                'post_type'   => $post_type,
//                'post_status' => 'templaza-featured',
//                'featured'    => 1,
                'templaza-featured'    => 1,
            );

            $url = add_query_arg( $args, admin_url( 'edit.php' ) );

            $views['templaza-featured'] = '<a href="' . esc_url( $url ) . '" class="' . esc_attr( $class ) . '" >'
                . esc_html__( 'Templaza Featured', 'templaza-framework' )
                . '<span class="count">'
                . ' (' . $count . ') '
                . '</span>'
                . '</a>';

            return $views;
        }

        public function get_total_featured_count( $post_type ) {
            // phpcs:disable WordPress.DB.SlowDBQuery.slow_db_query_meta_key, WordPress.DB.SlowDBQuery.slow_db_query_meta_value
            $args = array(
                'post_type'      => $post_type,
                'posts_per_page' => -1,
                'meta_key'       => 'templaza-featured',
                'meta_value'     => 1,
                'post_status'    => array( 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash' ),
            );

            $postlist = get_posts( $args );

            return count( $postlist );
        }

        /**
         * Query filtering in the post listing.
         *
         * @since 1.0.0
         *
         * @param WP_Query $query Instance of WP_Query object.
         */
        public function custom_query_filtering( $query ) {
            global $pagenow;

            $qv = &$query->query_vars;
            // phpcs:disable WordPress.DB.SlowDBQuery.slow_db_query_meta_query
            if ( is_admin() && 'edit.php' === $pagenow ) {

                if ( ! isset( $qv['meta_query'] ) ) {
                    $qv['meta_query'] = array();
                }

////                if ( ! empty( $_GET['filter-ns-featured-posts'] ) ) {
////
////                    if ( 'yes' === $_GET['filter-ns-featured-posts'] ) {
////                        $qv['meta_query'][] = array(
////                            'key'     => '_is_ns_featured_post',
////                            'compare' => '=',
////                            'value'   => 'yes',
////                        );
////                    }
////
////                    if ( 'no' === $_GET['filter-ns-featured-posts'] ) {
////                        $qv['meta_query'][] = array(
////                            'key'     => '_is_ns_featured_post',
////                            'compare' => 'NOT EXISTS',
////                            'value'   => '',
////                        );
////                    }
////                }
//
                // For filter link.
//                if ( isset( $_GET['post_status'] ) && 'templaza-featured' === $_GET['post_status'] ) {
                    if ( isset( $_GET['templaza-featured'] ) && '1' === $_GET['templaza-featured'] ) {
                        $qv['meta_query'][] = array(
                            'key'     => 'templaza-featured',
                            'compare' => '=',
                            'value'   => 1,
                        );
                    }
//                }
            }
            return $query;
        }


        /*
         * Set home meta box field to 0
         * @param string|int $new_post_id
         * @param string|int $post_id
         * */
        public function post_duplicate($new_post_id, $post_id){
            update_post_meta($new_post_id, 'templaza-featured', get_post_meta($post_id,'templaza-featured', true));
        }

        /*
         * Add columns for header page in list page
         * @param array $columns
         * */
        public function custom_table_head($columns){
            global $post_type;

            $tzfrm_post_types   = $this -> tzfrm_post_types;

            if(in_array($post_type, $tzfrm_post_types)) {
                $columns['templaza-featured'] = esc_html__('Templaza Featured', 'templaza-framework');
            }
            return $columns;
        }

//        /*
//         * Add columns for header custom post type in list page
//         * @param array $columns
//         * */
//        public function custom_table_head($columns, $post_type){
//
//            $tzfrm_post_types   = $this -> tzfrm_post_types;
//
//            if(in_array($post_type, $tzfrm_post_types)) {
//                $columns['templaza-featured'] = esc_html__('Templaza Featured', 'templaza-framework');
//            }
//            return $columns;
//        }

        /*
         * Add columns for content custom post type in list page
         * @param string $column_name
         * @param string $post_id
         * */
        public function custom_table_content($column_name, $post_id ){
            $post_type  = get_post_type($post_id);
            $tzfrm_post_types   = $this -> tzfrm_post_types;
            // phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
            if(in_array($post_type, $tzfrm_post_types)){

                if ($column_name == 'templaza-featured') {

                    $action     = $this -> action_featured;
                    $nonce      = wp_create_nonce( $action );
                    $featured   = get_post_meta($post_id,'templaza-featured', true);

                    $args   = array(
                        'post'      => $post_id,
                        'action'    => $action,
                        'featured'  => ($featured?0:1),
                        '_wpnonce'  => $nonce,
                    );

                    if(!empty($_GET)){
                        $args   = array_merge($_GET, $args);
                    }

                    $href           = add_query_arg($args, admin_url('admin.php'));
    //                $href           = 'admin.php?action='.$action.'&featured='.($featured?0:1)
    //                    .'&post='.$post_id.'&_wpnonce='.$nonce;
                    echo '<a href="'.$href.'"'.($featured?' class="is-featured"':'').'>';
                    if($featured){
                        echo '<span class="dashicons dashicons-star-filled"></span>';
                    }else{
                        echo '<span class="dashicons dashicons-star-empty"></span>';
                    }
                    echo '</a>';
                }
            }
        }

//        /*
//         * Add columns for header custom post type in list page
//         * @param array $columns
//         * */
//        public function post_type_table_head($columns){
//            $columns['templaza-featured'] = esc_html__('Templaza Featured', 'templaza-framework');
//            return $columns;
//        }

//        /*
//         * Add columns for content custom post type in list page
//         * @param string $column_name
//         * @param string $post_id
//         * */
//        public function post_type_table_content($column_name, $post_id ){
//            if ($column_name == 'templaza-featured') {
//
//                $action     = $this -> action_featured;
//                $nonce      = wp_create_nonce( $action );
//                $featured   = get_post_meta($post_id,'templaza-featured', true);
//
//                $args   = array(
//                    'post'      => $post_id,
//                    'action'    => $action,
//                    'featured'  => ($featured?0:1),
//                    '_wpnonce'  => $nonce,
//                );
//
//                if(!empty($_GET)){
//                    $args   = array_merge($_GET, $args);
//                }
//
//                $href           = add_query_arg($args, admin_url('admin.php'));
////                $href           = 'admin.php?action='.$action.'&featured='.($featured?0:1)
////                    .'&post='.$post_id.'&_wpnonce='.$nonce;
//                echo '<a href="'.$href.'"'.($featured?' class="is-featured"':'').'>';
//                if($featured){
//                    echo '<span class="dashicons dashicons-star-filled"></span>';
//                }else{
//                    echo '<span class="dashicons dashicons-star-empty"></span>';
//                }
//                echo '</a>';
//            }
//        }

//        /*
//         * Sorting columns for custom post type in list page
//         * @param array $columns
//         * */
//        public function post_type_table_sorting($columns ){
//            $columns['home'] = 'home';
//            return $columns;
//        }
//
//        /*
//         * Order by query for custom post type in list page
//         * @param array $vars
//         * */
//        public function post_type_orderby( $vars ) {
//            if ( isset( $vars['orderby'] ) && 'home' == $vars['orderby'] ) {
//                $vars = array_merge( $vars, array(
//                    'meta_key' => 'home',
//                    'orderby' => 'meta_value'
//                ) );
//            }
//
//            return $vars;
//        }

        /*
         * Action set featured for post type in list page
         * */
        public function post_type_set_featured(){
            $nonce_name     = isset( $_GET['_wpnonce'] ) ? $_GET['_wpnonce'] : '';
            $nonce_action   = $this -> action_featured;

            // Check if nonce is valid.
            if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
                wp_die('Security issue occure, Please try again!.');
            }
            $post_id    = isset($_GET['post'])?$_GET['post']:0;
            if(!$post_id){
                wp_die(__('Post creation failed, could not find original post:', 'templaza-framework') . $post_id);
            }

            $featured   = isset($_REQUEST['featured'])?$_REQUEST['featured']:0;

            // Set post by post_id to featured
            update_post_meta($post_id, 'templaza-featured', $featured);

            $args   = array();

            if(!empty($_GET)){
                $args   = array_merge($_GET, $args);
            }

            if(isset($args['post'])){
                unset($args['post']);
            }
            if(isset($args['action'])){
                unset($args['action']);
            }
            if(isset($args['featured'])){
                unset($args['featured']);
            }
            if(isset($args['_wpnonce'])){
                unset($args['_wpnonce']);
            }

            $redirect   = add_query_arg($args, admin_url('edit.php'));

            wp_redirect($redirect);
            exit;
        }

//        public function save_meta_box($post_id, $post)
//        {
//            parent::save_meta_box($post_id, $post);
//
//            $mt_key  = $this -> prefix.'basic';
//            if ( isset( $_POST[$mt_key] ) ) {
//                $options    = $_POST[$mt_key];
//                if(isset($options['home']) && $options['home'] == 1){
//                    $this -> _disable_home_without_post_id($post_id);
//                }
//            }
//        }

    }
}