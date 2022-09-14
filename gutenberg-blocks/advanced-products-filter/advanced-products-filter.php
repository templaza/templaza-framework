<?php
defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

use TemPlazaFramework\Functions;
use Advanced_Product\Helper\AP_Custom_Field_Helper;

if(!class_exists('TemplazaFramework_Gutenberg_Advanced_Products_Filter')) {
    class TemplazaFramework_Gutenberg_Advanced_Products_Filter extends TemplazaFramework_GutenbergBlock{
        public function __construct()
        {
            if(!class_exists('Advanced_Product\Helper\AP_Custom_Field_Helper')
                && is_plugin_active('advanced-product/advanced-product.php')){
                if(file_exists(plugin_dir_path(TEMPLAZA_FRAMEWORK_PATH).'advanced-product/includes/autoloader.php')) {
                    require_once(plugin_dir_path(TEMPLAZA_FRAMEWORK_PATH) . 'advanced-product/includes/autoloader.php');
                }
            }
            parent::__construct();

        }

        public function hooks()
        {
            if(!class_exists('Advanced_Product\Helper\AP_Custom_Field_Helper')){
                return;
            }

            parent::hooks(); // TODO: Change the autogenerated stub

            add_action( 'enqueue_block_editor_assets', array($this, 'gutenberg_enqueue') );
        }

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
                wp_set_script_translations('tz-gutenberg-'.$this -> get_name(), 'templaza-framework');
            }
        }

        function gutenberg_enqueue() {
            $field_options  = array();
            if(!class_exists('Advanced_Product\Helper\AP_Custom_Field_Helper')){
                return $field_options;
            }
            $custom_fields = AP_Custom_Field_Helper::get_custom_fields();
            if(!empty($custom_fields) && count($custom_fields)){
                foreach ($custom_fields as $field){
                    $f_attr             = AP_Custom_Field_Helper::get_custom_field_option_by_id($field -> ID, array(
                        'exclude_core_field' => false));
                    $key    = $field -> ID;
                    if(!empty($f_attr)) {
                        $key = isset($f_attr['_name']) ? $f_attr['_name'] : (isset($f_attr['name'])?$f_attr['name']:$key);
                    }
                    $field_options[] = array(
                        'label' => $field->post_title,
                        'value' => $key
                    );
                }
            }

            if(!empty($field_options) && count($field_options)){
                wp_localize_script('templaza-framework-advanced-products-filter-editor-script',
                    'tz_gt_advanced_products_filter', array('custom_fields_options' => $field_options)
                );
            }
        }

        public function get_folder_name()
        {
            return basename(__DIR__);
        }
    }

}