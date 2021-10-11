<?php

/**
 * Plugin Name: Gutenberg Examples Basic
 * Plugin URI: https://github.com/WordPress/gutenberg-examples
 * Description: This is a plugin demonstrating how to register new blocks for the Gutenberg editor.
 * Version: 1.1.0
 * Author: the Gutenberg Team
 *
 * @package gutenberg-examples
 */

defined( 'ABSPATH' ) || exit;

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_Gutenberg_Sample')) {
    class TemplazaFramework_Gutenberg_Sample extends TemplazaFramework_GutenbergBlock{
        /**
         * Register a block type
         * If title don't register the block type will get title from block name automatically
         * See https://developer.wordpress.org/reference/classes/wp_block_type/__construct/
         * for information on accepted arguments.
        */
        public function register(){
            return array(
                'icon' =>  'universal-access-alt',
                'category'=> 'design',
                'keywords'=> ['Test', 'Gutenberg'],
                'style' => 'templaza-gutenberg-'.$this -> get_name(),
                'script' => 'templaza-gutenberg-'.$this -> get_name(),
                'editor_style' => 'templaza-gutenberg-'.$this -> get_name().'-editor',
                'editor_script' => 'templaza-gutenberg-'.$this -> get_name().'-editor',
                'attributes' => array(
                    'images' => array(
                        'type' => 'array'
                    ),
                    'colorControl' => array(
                        'type'      => 'string',
                        'default'   => "#FF7F50",
                    )
                ),
                'example' => [ // <== THIS ONE
                    'attributes' => [
                        'colorControl' => '#FF7F50'
                    ]
                ]
            );
        }

        public function enqueue(){
            wp_register_script(
                'templaza-gutenberg-'.$this -> get_name().'-editor',
                plugins_url( 'editor.js', __FILE__ ),
                array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'underscore' ),
                filemtime( plugin_dir_path( __FILE__ ).'editor.js' )
            );
            wp_register_script(
                'templaza-gutenberg-'.$this -> get_name(),
                plugins_url( 'sample.js', __FILE__ ),
                array(  ),
                filemtime( plugin_dir_path( __FILE__ ).$this -> get_name() . '.js' )
            );

            wp_register_style(
                'templaza-gutenberg-'.$this -> get_name().'-editor',
                plugins_url( 'editor.css', __FILE__ ),
                array( 'wp-edit-blocks' ),
                filemtime( plugin_dir_path( __FILE__ ) . 'editor.css' )
            );

            wp_register_style(
                'templaza-gutenberg-'.$this -> get_name(),
                plugins_url( 'style.css', __FILE__ ),
                array( ),
                filemtime( plugin_dir_path( __FILE__ ) . 'style.css' )
            );
        }
    }

}