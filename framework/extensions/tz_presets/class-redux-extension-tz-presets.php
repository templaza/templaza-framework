<?php
/**
 * Redux Import/Export Extention Class
 *
 * @class   Redux_Extension_Import_Export
 * @version 4.0.0
 * @package Redux Framework
 */

defined( 'ABSPATH' ) || exit;

use TemPlazaFramework\Functions;

// Don't duplicate me!
if ( ! class_exists( 'Redux_Extension_TZ_Presets', false ) ) {

	/**
	 * Main ReduxFramework import_export extension class
	 *
	 * @since       3.1.6
	 */
	class Redux_Extension_TZ_Presets extends Redux_Extension_Abstract {

		/**
		 * Ext version.
		 *
		 * @var string
		 */
		public static $version = '1.0';

		/**
		 * Is field bit.
		 *
		 * @var bool
		 */
		public $is_field = false;

		private $text_domain = 'templaza-framework';


        private $preset_path;

		/**
		 * Class Constructor. Defines the args for the extions class
		 *
		 * @param object $parent ReduxFramework object.
		 *
		 * @return      void
		 * @since       1.0.0
		 * @access      public
		 */
		public function __construct( $parent ) {
			parent::__construct( $parent, __FILE__ );

			$this -> text_domain    = Functions::get_my_text_domain();

            $this -> preset_path    = TEMPLAZA_FRAMEWORK_THEME_PATH.'/presets';

			$this -> hooks();

			$this->add_field( 'tz_presets' );

            $this->is_field = Redux_Helpers::is_field_in_use( $parent, 'tz_presets' );

            if ( ! $this->is_field && is_admin() && isset($this->parent->args['show_presets']) && $this->parent->args['show_presets'] ) {
                $this->add_section();
            }


//			$this->add_field( 'import_export' );

//			add_action( 'wp_ajax_redux_download_options-' . $this->parent->args['opt_name'], array( $this, 'download_options' ) );
//			add_action( 'wp_ajax_nopriv_redux_download_options-' . $this->parent->args['opt_name'], array( $this, 'download_options' ) );
//
//			// phpcs:ignore WordPress.NamingConventions.ValidHookName
//			do_action( 'redux/options/' . $this->parent->args['opt_name'] . '/import', array( $this, 'remove_cookie' ) );
//
//			$this->is_field = Redux_Helpers::is_field_in_use( $parent, 'import_export' );
//
//			if ( ! $this->is_field && $this->parent->args['show_import_export'] ) {
//				$this->add_section();
//			}
//
//			add_filter( 'upload_mimes', array( $this, 'custom_upload_mimes' ) );
		}

		private function hooks(){
		    add_action('wp_ajax_templaza_framework_load_presets-'. $this->parent->args['opt_name'], array($this, 'load_presets'));
		    add_action('wp_ajax_nopriv_templaza_framework_load_presets-'. $this->parent->args['opt_name'], array($this, 'load_presets'));
		    add_action('wp_ajax_templaza_framework_remove_presets-'. $this->parent->args['opt_name'], array($this, 'remove_presets'));
		    add_action('wp_ajax_nopriv_templaza_framework_remove_presets-'. $this->parent->args['opt_name'], array($this, 'remove_presets'));
		    add_action('wp_ajax_templaza_framework_save_presets-'. $this->parent->args['opt_name'], array($this, 'save_presets'));
		    add_action('wp_ajax_nopriv_templaza_framework_save_presets-'. $this->parent->args['opt_name'], array($this, 'save_presets'));
        }

        private function get_preset_path(){

            $preset_path = $this->preset_path;

            $page       = isset($_REQUEST['page']) && !empty($_REQUEST['page'])?$_REQUEST['page']:false;
            $post_type  = isset($_REQUEST['post_type']) && !empty($_REQUEST['post_type'])?$_REQUEST['post_type']:false;

            if(isset($post_type) && !empty($post_type)){
                if($post_type != 'templaza_style'){
                    $preset_path .= '/' . $post_type;
                }
            }elseif($page){
                if($page == Functions::get_theme_option_name().'_options'){
                    $preset_path    .= '/settings';
                }else{
                    $page_name      = preg_replace('/^'.TEMPLAZA_FRAMEWORK.'/', '', $page);
                    $preset_path    .= '/'.$page_name;
                }
            }

            return $preset_path;
        }

        public function load_presets()
        {
            $preset_path = $this->get_preset_path();

            $name       = isset($_REQUEST['name']) && !empty($_REQUEST['name'])?$_REQUEST['name']:false;

            $file   = $preset_path.'/'.$name.'.json';

            if(!file_exists($file)){
                wp_send_json_error(array('message' => __('Preset file not found', $this -> text_domain)));
                wp_die();
            }

            $preset = file_get_contents($file);
            if($preset && !empty($preset)){
                $preset     = is_string($preset)?json_decode($preset, true):$preset;
                $dest_file  = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION;

                $page       = isset($_REQUEST['page']) && !empty($_REQUEST['page'])?$_REQUEST['page']:false;
                $post_id    = isset($_REQUEST['post_id']) && !empty($_REQUEST['post_id'])?$_REQUEST['post_id']:false;
                $post_type  = isset($_REQUEST['post_type']) && !empty($_REQUEST['post_type'])?$_REQUEST['post_type']:false;

                if($post_type && $post_type == 'templaza_style'){
                    if($post_id){
                        $slug   = get_post_meta($post_id, '_templaza_style', true);

                        $dest_file  .= '/'.$slug.'.json';
                    }
                }elseif($page && $page == Functions::get_theme_option_name().'_options'){
                    $dest_file  .= '/settings/setting.json';
                }

                if(file_exists($dest_file)){
                    file_put_contents($dest_file, json_encode($preset['preset']));

                    wp_send_json_success(array('message' => __('Preset loaded', $this -> text_domain)));
                    wp_die();
                }
            }

            wp_send_json_error(array('message' => __('Preset not loaded', $this -> text_domain)));
            wp_die();
        }

        public function remove_presets()
        {
            $preset_path = $this->get_preset_path();

            $name       = isset($_REQUEST['name']) && !empty($_REQUEST['name'])?$_REQUEST['name']:false;

            $file   = $preset_path.'/'.$name.'.json';

            if(!file_exists($file)){
                wp_send_json_error(array('message' => __('Preset file not found', $this -> text_domain)));
                wp_die();
            }

            unlink($file);

            wp_send_json_success(array('message' => __('Preset removed', $this -> text_domain)));
            wp_die();
        }

        public function save_presets(){

            $source_file    = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION;
            $preset_path    = $this -> get_preset_path();

		    if(!is_dir($preset_path)){
                require_once(ABSPATH . '/wp-admin/includes/file.php');
		        mkdir($preset_path, FS_CHMOD_DIR, true);
            }

            $title      = isset($_REQUEST['title']) && !empty($_REQUEST['title'])?$_REQUEST['title']:'';
            $preset     = isset($_REQUEST['preset']) && !empty($_REQUEST['preset'])?$_REQUEST['preset']:'';
            $desc       = isset($_REQUEST['description']) && !empty($_REQUEST['description'])?$_REQUEST['description']:'';

//            $source_file_name   = '';
//
//            if(isset($post_type) && !empty($post_type)){
//                if($post_type == 'templaza_style'){
//                    if($post_id){
//                        $source_file_name   = get_post_meta($post_id, '_templaza_style', true).'.json';
//                    }
//                }else {
//                    $preset_path .= '/' . $post_type;
//                }
//            }elseif($page){
//                if($page == Functions::get_theme_option_name().'_options'){
//                    $preset_path    .= '/settings';
//                    $source_file_name   = 'setting.json';
//                }else{
//                    $page_name      = preg_replace('/^'.TEMPLAZA_FRAMEWORK.'/', '', $page);
//                    $preset_path    .= '/'.$page_name;
//                    $source_file_name   = $page_name.'.json';
//                }
//            }
//
//            if(!file_exists($source_file.'/'.$source_file_name)){
//                wp_send_json_error(array('message' => __('Config file not found.', $this -> text_domain)));
//                wp_die();
//            }
//
//            $preset = file_get_contents($source_file);

		    $title_slug  = sanitize_title($title);
		    $file_name  = $title_slug;
            $file_path  = $preset_path.'/'.$file_name;
            $file_name    = uniqid($title_slug.'-');

            while(file_exists($file_path.'/'.$file_name.'.json')){
                $file_name = uniqid($title_slug.'-');
            }
            $file_name  .= '.json';


            $file_path  = $preset_path.'/'.$file_name;

            $preset = is_string($preset)?json_decode(stripslashes($preset)):$preset;

            $data   = array(
                'title'         => $title,
                'description'   => $desc,
                'preset'        => $preset
            );

            file_put_contents($file_path, json_encode($data), FS_CHMOD_FILE);

            wp_send_json_success(array('message' => __('Preset saved', $this -> text_domain)));

            wp_die();
        }

		/**
		 * Add section to panel.
		 */
		public function add_section() {
			$this->parent->sections[] = array(
				'id'         => 'presets_section',
				'title'      => esc_html__( 'Presets', $this -> text_domain ),
				'heading'    => '',
				'icon'       => 'fas fa-rocket',
				'customizer' => false,
				'fields'     => array(
					array(
						'id'         => 'presets',
						'type'       => 'tz_presets',
						'full_width' => true,
					),
				),
			);
		}
	}
}
