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

if(!class_exists('TemPlazaFramework\Post_Type\Templaza_Header')) {
    class Templaza_Header extends Configuration
    {
        public function register()
        {
            $theme  = $this -> theme;
            $labels = array(
                'name'               => _x( $theme->get('Name').' Headers', 'templaza-framework', $this -> text_domain ),
                'singular_name'      => _x( $theme->get('Name').' Headers', 'templaza-framework', $this -> text_domain ),
                'menu_name'          => _x( $theme->get('Name').' Options', 'templaza-framework', $this -> text_domain ),
                'name_admin_bar'     => _x( $theme->get('Name').' Options', 'templaza-framework', $this -> text_domain ),
                'add_new'            => _x( 'Add New', 'templaza-framework', $this -> text_domain ),
                'add_new_item'       => __( 'Add New header', $this -> text_domain),
                'new_item'           => __( 'New header', $this -> text_domain ),
                'edit_item'          => __( 'Edit header', $this -> text_domain),
                'view_item'          => __( 'View header', $this -> text_domain ),
                'all_items'          => __( 'Headers', $this -> text_domain ),
                'search_items'       => __( 'Search headers', $this -> text_domain ),
                'parent_item_colon'  => __( 'Parent headers:', $this -> text_domain ),
                'not_found'          => __( 'No headers found.', $this -> text_domain ),
                'not_found_in_trash' => __( 'No headers found in Trash.', $this -> text_domain )
            );

            $args = array(
                'labels'             => $labels,
                'description'        => __( 'Description.', $this -> text_domain ),
                'public'             => false,
                'publicly_queryable' => false,
                'show_ui'            => true,
                'show_in_menu'       => TEMPLAZA_FRAMEWORK,
                'query_var'          => false,
                'rewrite'            => array( 'slug' => 'templaza-header' ),
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

            if(!empty($args)) {
                $args['show_presets']       = true;
                $args['preset_post_type']   = $this->get_post_type();
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