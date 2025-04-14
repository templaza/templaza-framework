<?php
  /*
  *	---------------------------------------------------------------------
  *	This file create and contains the restaurant post_type meta elements
  *	---------------------------------------------------------------------
  */

namespace TemPlazaFramework\Post_Type;

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Admin_Functions;
use TemPlazaFramework\Core\Fields;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Menu_Admin;
use TemPlazaFramework\Post_Type;
use TemPlazaFramework\Enqueue;
use TemPlazaFramework\Post_TypeFunctions;

if(!class_exists('TemPlazaFramework\Post_Type\Restaurant')){
    class Restaurant extends Post_Type{

        public function hooks()
        {
            parent::hooks();

//            add_action('templaza-framework/post_type/'.$this -> get_post_type().'/registered', array($this, 'register_taxonomy'));
        }

        public function register()
        {
            $labels = array(
                'name'               => esc_html_x('Restaurant', 'Restaurant General Name', 'templaza-framework'),
                'singular_name'      => esc_html_x('Restaurant Item', 'Restaurant Singular Name', 'templaza-framework'),
                'add_new'            => esc_html_x('Add New', 'Add New Restaurant Name', 'templaza-framework'),
                'add_new_item'       => esc_html__('Add New Restaurant', 'templaza-framework'),
                'all_items'          => esc_html__( 'All Restaurants', 'templaza-framework'),
                'edit_item'          => esc_html__('Edit Restaurant', 'templaza-framework'),
                'new_item'           => esc_html__('New Restaurant', 'templaza-framework'),
                'view_item'          => esc_html__('View Restaurant', 'templaza-framework'),
                'search_items'       => esc_html__('Search Restaurant', 'templaza-framework'),
                'not_found'          => esc_html__('Nothing found', 'templaza-framework'),
                'not_found_in_trash' => esc_html__('Nothing found in Trash', 'templaza-framework'),
                'parent_item_colon'  => ''
            );
            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'query_var'          => true,
                'show_in_rest'       => true,
                'capability_type'    => 'post',
                'menu_icon'     => 'dashicons-food',
                'hierarchical'       => true,
                'menu_position'      => 5,
                'supports'           => array('title', 'editor','author','excerpt', 'thumbnail','comments'), //'editor', 'excerpt', 'comments',
                'rewrite'            => array('slug' => 'restaurant', 'with_front' => true ),
                'has_archive' => true
            );
            return $args;
        }
        public function register_post_type(){

            $tz_theme_support = get_theme_support('templaza-post-type');
            $tz_theme_support = $tz_theme_support?(array)$tz_theme_support:array();
            $tz_theme_support = count($tz_theme_support)?$tz_theme_support[0]:$tz_theme_support;

            if(!post_type_exists($this -> get_post_type()) && !in_array($this -> get_post_type(), $tz_theme_support)){
                return;
            }

            parent::register_post_type();

            $this -> register_taxonomy();
        }

        public function register_taxonomy(){
            register_taxonomy(
                "restaurant-category", array( $this -> get_post_type() ), array(
                "hierarchical"   => true,
                "show_in_rest"   => true,
                'show_admin_column'          => true,
                "label"          => esc_html__("Restaurant Categories",'templaza-framework'),
                "singular_label" => esc_html__("Restaurant Categories",'templaza-framework'),
                "rewrite"        => true ));
            register_taxonomy_for_object_type('restaurant-category', $this -> get_post_type());

            // function tags
            register_taxonomy(
                "restaurant_tag",array($this -> get_post_type()), array(
                    "hierarchical"   => '',
                    "show_in_rest"   => true,
                    'show_admin_column'          => true,
                    "label"          => esc_html__("Restaurant Tags",'templaza-framework'),
                    "singular_label" => esc_html__("Restaurant Tags",'templaza-framework'),
                    "rewrite"        => ''
                )
            );
            register_taxonomy_for_object_type('restaurant_tag', $this -> get_post_type());
        }
    }
}
