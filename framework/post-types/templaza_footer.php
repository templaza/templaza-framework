<?php

namespace TemPlazaFramework\Post_Type;

use TemPlazaFramework\Configuration;

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Admin_Functions;
use TemPlazaFramework\Core\Fields;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Menu_Admin;
use TemPlazaFramework\Post_Type;
use TemPlazaFramework\Enqueue;
use TemPlazaFramework\Post_TypeFunctions;

if(!class_exists('TemPlazaFramework\Post_Type\Templaza_Footer')) {
    class Templaza_Footer extends Configuration
    {
        public function register()
        {
            $theme  = $this -> theme;
            $labels = array(
                'name'               => _x( $theme->get('Name').' Footers', 'templaza-framework', 'templaza-framework' ),
                'singular_name'      => _x( $theme->get('Name').' Footers', 'templaza-framework', 'templaza-framework' ),
                'menu_name'          => _x( $theme->get('Name').' Options', 'templaza-framework', 'templaza-framework' ),
                'name_admin_bar'     => _x( $theme->get('Name').' Options', 'templaza-framework', 'templaza-framework' ),
                'add_new'            => _x( 'Add New', 'templaza-framework', 'templaza-framework' ),
                'add_new_item'       => __( 'Add New footer', 'templaza-framework'),
                'new_item'           => __( 'New footer', 'templaza-framework' ),
                'edit_item'          => __( 'Edit footer', 'templaza-framework'),
                'view_item'          => __( 'View footer', 'templaza-framework' ),
                'all_items'          => __( 'Footers', 'templaza-framework' ),
                'search_items'       => __( 'Search footers', 'templaza-framework' ),
                'parent_item_colon'  => __( 'Parent footers:', 'templaza-framework' ),
                'not_found'          => __( 'No footers found.', 'templaza-framework' ),
                'not_found_in_trash' => __( 'No footers found in Trash.', 'templaza-framework' )
            );

            $args = array(
                'labels'             => $labels,
                'description'        => __( 'Description.', 'templaza-framework' ),
                'public'             => false,
                'publicly_queryable' => false,
                'show_ui'            => true,
                'show_in_menu'       => TEMPLAZA_FRAMEWORK,
                'query_var'          => false,
                'rewrite'            => array( 'slug' => 'templaza-footer' ),
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

            add_action( 'pre_post_update', array( $this, 'pre_post_update' ), 10, 2 );
        }

        public function register_redux_arguments(){
            $args   = parent::register_redux_arguments();

            if(!empty($args)){
                // If this post type has only layout, layout will be display full box
//                $args['open_expanded']      = true;
                $args['show_presets']       = true;
                $args['preset_post_type']   = $this -> get_post_type();
                $args['show_import_export'] = true;
            }

            return $args;
        }

        /**
         *
         * */
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
    }
}