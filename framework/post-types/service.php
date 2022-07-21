<?php
  /*
  *	---------------------------------------------------------------------
  *	This file create and contains the service post_type meta elements
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

if(!class_exists('TemPlazaFramework\Post_Type\Service')){
    class Service extends Post_Type{

        public function hooks()
        {
            parent::hooks();

//            add_action('templaza-framework/post_type/'.$this -> get_post_type().'/registered', array($this, 'register_taxonomy'));
        }

        public function register()
        {
            $labels = array(
                'name'               => esc_html_x('Service', 'Service General Name', $this -> text_domain),
                'singular_name'      => esc_html_x('Service Item', 'Service Singular Name', $this -> text_domain),
                'add_new'            => esc_html_x('Add New', 'Add New Service Name', $this -> text_domain),
                'add_new_item'       => esc_html__('Add New Service', $this -> text_domain),
                'all_items'          => esc_html__( 'All Services', $this -> text_domain),
                'edit_item'          => esc_html__('Edit Service', $this -> text_domain),
                'new_item'           => esc_html__('New Service', $this -> text_domain),
                'view_item'          => esc_html__('View Service', $this -> text_domain),
                'search_items'       => esc_html__('Search Service', $this -> text_domain),
                'not_found'          => esc_html__('Nothing found', $this -> text_domain),
                'not_found_in_trash' => esc_html__('Nothing found in Trash', $this -> text_domain),
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
                'hierarchical'       => true,
                'menu_position'      => 5,
                'supports'           => array('title', 'editor','author','excerpt', 'thumbnail','comments'), //'editor', 'excerpt', 'comments',
                'rewrite'            => array('slug' => 'service', 'with_front' => true ),
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
                "service-category", array( $this -> get_post_type() ), array(
                "hierarchical"   => true,
                "show_in_rest"   => true,
                'show_admin_column'          => true,
                "label"          => esc_html__("Service Categories",$this -> text_domain),
                "singular_label" => esc_html__("Service Categories",$this -> text_domain),
                "rewrite"        => true ));
            register_taxonomy_for_object_type('service-category', $this -> get_post_type());

            // function tags
            register_taxonomy(
                "service_tag",array($this -> get_post_type()), array(
                    "hierarchical"   => '',
                    "show_in_rest"   => true,
                    'show_admin_column'          => true,
                    "label"          => esc_html__("Service Tags",$this -> text_domain),
                    "singular_label" => esc_html__("Service Tags",$this -> text_domain),
                    "rewrite"        => ''
                )
            );
            register_taxonomy_for_object_type('service_tag', $this -> get_post_type());
        }
    }
}
