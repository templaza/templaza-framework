<?php

namespace TemPlazaFramework\Post_Type;

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Post_Type;

if(!class_exists('TemPlazaFramework\Post_Type\Templaza_Library')){
    class Templaza_Library extends Post_Type{
        public $setting_args;

        public function register()
        {
            $theme  = $this -> theme;
            $labels = array(
                'name'               => _x( 'Templaza Library', 'templaza-framework', 'templaza-framework' ),
                'singular_name'      => _x( 'Templaza Library', 'templaza-framework', 'templaza-framework' ),
                'menu_name'          => _x( 'Templaza Library', 'templaza-framework', 'templaza-framework' ),
                'name_admin_bar'     => _x( 'Templaza Libraries', 'templaza-framework', 'templaza-framework' ),
                'add_new'            => _x( 'Add New', 'templaza-framework', 'templaza-framework' ),
                'add_new_item'       => __( 'Add New template library', 'templaza-framework'),
                'new_item'           => __( 'New template', 'templaza-framework' ),
                'edit_item'          => __( 'Edit template', 'templaza-framework'),
                'view_item'          => __( 'View template', 'templaza-framework' ),
                'all_items'          => __( 'Templaza Libraries', 'templaza-framework' ),
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
//                'show_ui'            => true,
                'show_ui'            => false,
//                'show_in_menu'       => true,
                'show_in_menu'       => TEMPLAZA_FRAMEWORK,
                'query_var'          => false,
                'rewrite'            => array( 'slug' => 'templaza-framework-library' ),
                'capability_type'    => 'post',
                'has_archive'        => false,
                'hierarchical'       => false,
                'menu_position'      => null,
                'supports'           => array( 'title' ),
                'menu_icon'          => 'dashicons-art'
            );
            return $args;
        }

        public function hooks()
        {
            parent::hooks();

            add_action('wp_ajax_templaza-framework/field/tz_layout/action/save_section', array($this, 'save_field_section'));
            add_action('wp_ajax_templaza-framework/post_type/templaza_library/get_data', array($this, 'get_data'));
            add_action('wp_ajax_templaza-framework/post_type/templaza_library/remove_data', array($this, 'remove_data'));
        }

        public function get_data(){
            global $wpdb;

            $posts  = get_posts(array(
                'numberposts'      => -1,
                'post_type' => 'templaza_library'
            ));
            $data   = array();
            $data[] = array(
                'title'         => __('Blank Section', 'templaza-framework'),
                'author'        => __('Templaza Framework', 'templaza-framework'),
                'lib_data'      => '',
                'human_date'    => '',
                'human_modified_date' => '',
            );
            if(!empty($posts)){
                foreach($posts as $post){
                    $item   = array();

                    if(!$post -> ID){
                        continue;
                    }

                    $item['title']      = $post -> post_title;
                    $item['status']     = $post -> post_status;
                    $item['lib_id']     = $post -> ID;
                    $item['lib_id']     = $post -> ID;
                    $item['author']     = \get_the_author_meta( 'display_name' , $post -> post_author );

                    /* Source is: local or server */
                    $item['source']     = "local";
                    $item['thumbnail']  = false;
                    $item['lib_type']   = \get_post_meta($post -> ID, '_templaza_library_type', true);

                    $lib_data   = \get_post_meta($post -> ID, '_templaza_library_data', true);
                    $lib_data   = (!empty($lib_data) && is_string($lib_data))?json_decode($lib_data):$lib_data;

                    $item['lib_data']   = $lib_data;

                    $item['human_date']             = $post -> post_date;
                    $item['human_modified_date']    = $post -> post_modified;

                    if(count($item)) {
                        $data[] = $item;
                    }
                }
            }
            wp_reset_postdata();

            if(count($data)){
                \wp_send_json_success($data);
            }

            return false;
        }

        public function remove_data(){
            $lib_id      = isset($_REQUEST['lib_id'])?(int) $_REQUEST['lib_id']:0;
            if(!$lib_id){
                wp_send_json_error();
            }
            $result = wp_delete_post($lib_id);

            if($result){
                wp_send_json_success(__('Deleted post successfully', 'templaza-framework'));
            }

            wp_send_json_error(__('Can not delete post', 'templaza-framework'));
        }

        public function save_field_section(){

            $title      = isset($_REQUEST['title'])?sanitize_text_field($_REQUEST['title']):'';
            $alias      = !empty($title)?sanitize_title($title):'';
            $lib_type   = isset($_REQUEST['lib_type'])?sanitize_title($_REQUEST['lib_type']):'section';
            $section    = isset($_REQUEST['section'])?$_REQUEST['section']:'';

            if(empty($title) || empty($section)){
                wp_send_json_error();
            }

            $post_type  = 'templaza_library';
            $query = new \WP_Query([
                "post_type" => $post_type,
                "name" => $alias
            ]);

            $post   = $query->have_posts() ? reset($query->posts) : null;
            wp_reset_postdata();

            $data       = array(
                'post_title'    => $title,
                'post_status'   => 'publish',
                'post_type'     => $post_type,
            );

            if(!empty($post) && isset($post -> ID)){
                $data['ID'] = $post -> ID;
                // Update post
                $postId = \wp_update_post($data);
            }else {
                // Insert post
                $postId = \wp_insert_post($data);
            }

            if(!$postId){
                wp_send_json_error(__('Insert post error', 'templaza-framework'));
            }

            // Update postmeta library type is: section or page
            update_post_meta($postId, '_templaza_library_type', $lib_type);

            // Update postmeta library data
            $result = update_post_meta($postId, '_templaza_library_data', $section);

//            if(!$result){
//                wp_send_json_error(__('Update post meta error'));
//            }

            wp_send_json(array('success' => true, 'message' => __('Section Saved', 'templaza-framework')));
        }

        /* *
         *  Edit header column
         * */
        public function manage_edit_columns($columns){
            $new_columns            = array();
            $new_columns['cb']      = $columns['cb'];
            $new_columns['title']   = $columns['title'];

            $new_columns['lib_type']   = __('Type', 'templaza-framework');

            return array_merge($new_columns, $columns);
        }

        /* *
         *  Edit content column
         * */
        public function manage_custom_column($column, $post_id ){
            if($column == 'lib_type'){
                $lib_type   = get_post_meta($post_id, '_templaza_library_type', true);
                echo ucfirst($lib_type);
            }

            return $column;
        }

        public function enqueue(){
            parent::enqueue();

            if($this -> my_post_type_exists()) {
                // Remove auto save
                wp_dequeue_script('autosave');
            }
        }
    }
}