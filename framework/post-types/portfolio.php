<?php
  /*
  *	---------------------------------------------------------------------
  *	This file create and contains the portfolio post_type meta elements
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

if(!class_exists('TemPlazaFramework\Post_Type\Portfolio')){
    class Portfolio extends Post_Type{

        public function hooks()
        {
            parent::hooks();

//            add_action('templaza-framework/post_type/'.$this -> get_post_type().'/registered', array($this, 'register_taxonomy'));
        }

        public function register()
        {
            $labels = array(
                'name'               => esc_html_x('Portfolio', 'Portfolio General Name', 'templaza-elements'),
                'singular_name'      => esc_html_x('Portfolio Item', 'Portfolio Singular Name', 'templaza-elements'),
                'add_new'            => esc_html_x('Add New', 'Add New Portfolio Name', 'templaza-elements'),
                'add_new_item'       => esc_html__('Add New Portfolio', 'templaza-elements'),
                'all_items'          => esc_html__( 'All Portfolios', 'templaza-elements'),
                'edit_item'          => esc_html__('Edit Portfolio', 'templaza-elements'),
                'new_item'           => esc_html__('New Portfolio', 'templaza-elements'),
                'view_item'          => esc_html__('View Portfolio', 'templaza-elements'),
                'search_items'       => esc_html__('Search Portfolio', 'templaza-elements'),
                'not_found'          => esc_html__('Nothing found', 'templaza-elements'),
                'not_found_in_trash' => esc_html__('Nothing found in Trash', 'templaza-elements'),
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
                'rewrite'            => array('slug' => 'portfolio', 'with_front' => false ),
                'has_archive' => true
            );
            return $args;
        }
        public function register_post_type(){

            $tz_theme_support = get_theme_support('templaza-post-type');
            $tz_theme_support = $tz_theme_support?(array)$tz_theme_support:array();
            $tz_theme_support = count($tz_theme_support)?$tz_theme_support[0]:$tz_theme_support;

            if(!in_array($this -> get_post_type(), $tz_theme_support)){
                return;
            }

            parent::register_post_type();

            $this -> register_taxonomy();
        }

        public function register_taxonomy(){
            register_taxonomy(
                "portfolio-category", array( "portfolio" ), array(
                "hierarchical"   => true,
                "show_in_rest"   => true,
                'show_admin_column'          => true,
                "label"          => esc_html__("Portfolio Categories",'templaza-elements'),
                "singular_label" => esc_html__("Portfolio Categories",'templaza-elements'),
                "rewrite"        => true ));
            register_taxonomy_for_object_type('portfolio-category', 'portfolio');

            // function tags
            register_taxonomy(
                "portfolio_tag",array("portfolio"), array(
                    "hierarchical"   => '',
                    "show_in_rest"   => true,
                    'show_admin_column'          => true,
                    "label"          => esc_html__("Portfolio Tags",'templaza-elements'),
                    "singular_label" => esc_html__("Portfolio Tags",'templaza-elements'),
                    "rewrite"        => ''
                )
            );
            register_taxonomy_for_object_type('portfolio_tag','portfolio');
        }
    }
}
