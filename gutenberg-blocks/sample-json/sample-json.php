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

if(!class_exists('TemplazaFramework_Gutenberg_Sample_JSON')) {
    class TemplazaFramework_Gutenberg_Sample_JSON extends TemplazaFramework_GutenbergBlock{

        /**
         * Registers all block assets so that they can be enqueued through Gutenberg in
         * the corresponding context.
         *
         * Passes translations to JavaScript.
         * Registers a block type from the metadata stored in the block.json file.
         * See https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/
         * for information of json file.
         */
        public function register_block_type(){

            if (!function_exists('register_block_type')) {
                // Gutenberg is not active.
                return;
            }

            $registered = register_block_type( __DIR__, array(
                'render_callback' => array($this, 'render'),
            ));

            if (function_exists('wp_set_script_translations')) {
                /**
                 * May be extended to wp_set_script_translations( 'my-handle', 'my-domain',
                 * plugin_dir_path( MY_PLUGIN ) . 'languages' ) ). For details see
                 * https://make.wordpress.org/core/2018/11/09/new-javascript-i18n-support-in-wordpress/
                 */
                wp_set_script_translations('tz-gutenberg-'.$this -> get_name(), $this -> text_domain);
            }
        }
    }

}