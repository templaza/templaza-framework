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
        private $preset_path;
        private $preset_opt_name;
		public $is_field = false;

		/**
		 * Class Constructor. Defines the args for the extions class
		 *
		 * @param object $parent ReduxFramework object.
		 *
		 * @return      void
		 * @since       1.0.0
		 * @access      public
		 */
		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		public function __construct( $parent ) {
			parent::__construct( $parent, __FILE__ );

            $this -> preset_opt_name    = 'presets__opt_name';
            $this -> preset_path        = TEMPLAZA_FRAMEWORK_THEME_PATH.'/presets';

			$this -> hooks();

			$this->add_field( 'tz_presets' );

            $this->is_field = Redux_Helpers::is_field_in_use( $parent, 'tz_presets' );

            if ( ! $this->is_field && is_admin() && isset($this->parent->args['show_presets']) && $this->parent->args['show_presets'] ) {
//                if(isset($parent -> args['preset_post_type']) && !empty($parent -> args['preset_post_type'])){
//                    $this -> preset_path    .= '/'.$parent -> args['preset_post_type'];
//                }
                $this->add_section();
            }
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

            global $pagenow;
            $preset_path = $this->preset_path;

            $page       = isset($_REQUEST['page']) && !empty($_REQUEST['page'])?$_REQUEST['page']:false;
            $post_id  = isset($_REQUEST['post']) && !empty($_REQUEST['post'])?$_REQUEST['post']:0;
            $post_type  = isset($_REQUEST['post_type']) && !empty($_REQUEST['post_type'])?$_REQUEST['post_type']:false;

            if($pagenow == 'post.php' && empty($post_type) && $post_id){
                $post_type  = get_post_type($post_id);
            }

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
                wp_send_json_error(array('message' => __('Preset file not found', 'templaza-framework')));
                wp_die();
            }
            // phpcs:disable WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents, WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents, WordPress.WP.AlternativeFunctions.json_encode_json_encode

            $preset = file_get_contents($file);
            if($preset && !empty($preset)){
                $preset     = is_string($preset)?json_decode($preset, true):$preset;
                $dest_file  = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION;

                $page       = isset($_REQUEST['page']) && !empty($_REQUEST['page'])?$_REQUEST['page']:false;
                $post_id    = isset($_REQUEST['post_id']) && !empty($_REQUEST['post_id'])?$_REQUEST['post_id']:false;
                $post_type  = isset($_REQUEST['post_type']) && !empty($_REQUEST['post_type'])?$_REQUEST['post_type']:false;
                if($post_type){
                    if($post_type != 'templaza_style'){
                        $dest_file  .= '/'.$post_type;
                    }
                    if($post_id){
                        $slug = get_post_meta($post_id, '_'.$post_type, true);

                        $dest_file  .= '/'.$slug.'.json';
                    }
                }elseif($page && $page == Functions::get_theme_option_name().'_options'){
                    $dest_file  .= '/settings/setting.json';
                }

                if(!file_exists($dest_file)){
                    /* translators: %s - message. */
                    wp_send_json_error(array('message' => sprintf(__('Preset not loaded: File %s not found', 'templaza-framework'), esc_html($dest_file))));
                    wp_die();
                }

                file_put_contents($dest_file, json_encode($preset['preset']));

                wp_send_json_success(array('message' => __('Preset loaded', 'templaza-framework')));
                wp_die();
            }

            wp_send_json_error(array('message' => __('Preset not loaded', 'templaza-framework')));
            wp_die();
        }

        public function remove_presets()
        {
            $preset_path = $this->get_preset_path();

            $name       = isset($_REQUEST['name']) && !empty($_REQUEST['name'])?$_REQUEST['name']:false;
            $post_type  = isset($_REQUEST['post_type']) && !empty($_REQUEST['post_type'])?$_REQUEST['post_type']:'';

            $file   = $preset_path.'/'.$name.'.json';

            if(!file_exists($file)){
                /* translators: %s - message. */
                wp_send_json_error(array('message' => (sprintf(__('Preset file %s not found','templaza-framework'), esc_html($file)))));
                wp_die();
            }

            $preset_data    = file_get_contents($file);
            $preset_data    = !empty($preset_data)?json_decode($preset_data, true):array();

            // Remove image if it exists
            // phpcs:disable WordPress.WP.AlternativeFunctions.unlink_unlink, WordPress.WP.AlternativeFunctions.file_system_operations_mkdir
            $image  = isset($preset_data['image'])?$preset_data['image']:'';
            if(!empty($image)){
                $image_path = TEMPLAZA_FRAMEWORK_THEME_PATH.'/images/presets'.(!empty($post_type)?'/'.$post_type:'')
                    .'/'.$image;

                if(file_exists($image_path)){
                    unlink($image_path);
                }
            }

            unlink($file);

            wp_send_json_success(array('message' => __('Preset removed', 'templaza-framework')));
            wp_die();
        }

        public function save_presets(){

            $source_file    = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION;
            $preset_path    = $this -> get_preset_path();
            // phpcs:disable WordPress.WP.AlternativeFunctions.file_system_operations_mkdir, WordPress.WP.AlternativeFunctions.unlink_unlink , WordPress.Security.NonceVerification.Recommended

		    if(!is_dir($preset_path)){
                require_once(ABSPATH . '/wp-admin/includes/file.php');
		        mkdir($preset_path, FS_CHMOD_DIR, true);
            }

		    $preset_data = isset($_REQUEST['preset_data'])?$_REQUEST['preset_data']:array();

		    if(empty($preset_data)){
                wp_send_json_error(array('message' => esc_html__('Save preset error: Please enter value!')));
                wp_die();
            }

            $title      = isset($preset_data['title']) && !empty($preset_data['title'])?$preset_data['title']:'';
            $image      = isset($preset_data['image']) && !empty($preset_data['image'])?$preset_data['image']:'';
            $preset     = isset($_REQUEST['preset']) && !empty($_REQUEST['preset'])?$_REQUEST['preset']:'';
            $desc       = isset($preset_data['description']) && !empty($preset_data['description'])?$preset_data['description']:'';

		    $title_slug = sanitize_title($title);
		    $file_name  = $title_slug;
            $file_path  = $preset_path.'/'.$file_name;
            $file_name    = uniqid($title_slug.'-');


            while(file_exists($file_path.'/'.$file_name.'.json')){
                $file_name = uniqid($title_slug.'-');
            }

            $file_path  = $preset_path.'/'.$file_name.'.json';

            $preset = is_string($preset)?json_decode(stripslashes($preset)):$preset;

            $data   = array(
                'title'         => $title,
                'description'   => $desc,
                'preset'        => $preset
            );

            // Upload image to theme
            if(isset($image['url']) && !empty($image['url'])){
                $image_name = basename($image['url']);

                $temp       = explode('.', $image_name);
                $img_ext    = end($temp);

                $post_type  = isset($_REQUEST['post_type']) && !empty($_REQUEST['post_type'])?$_REQUEST['post_type']:false;
                $dest_path  = TEMPLAZA_FRAMEWORK_THEME_PATH.'/images/presets'.($post_type?'/'.$post_type:'');

                if(!is_dir($dest_path)){
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    mkdir($dest_path, FS_CHMOD_DIR, true);
                }

                $img_name   = $file_name.'.'.$img_ext;

                $dest_path  .= '/'.$img_name;

                if(file_exists($dest_path)){
                    unlink($dest_path);
                }

                if(!copy($image['url'], $dest_path)){
                    wp_send_json_error(array('message' => __('Preset saved error: Can not copy image!', 'templaza-framework')));
                    wp_die();
                }

                $data['image']  = $img_name;
            }

            $result = file_put_contents($file_path, json_encode($data), FS_CHMOD_FILE);

            if(!$result){
                wp_send_json_error(array('message' => __('Preset saved error: Can not save preset data!', 'templaza-framework')));
                wp_die();
            }

            wp_send_json_success(array('message' => __('Preset saved successfully!', 'templaza-framework')));
            wp_die();
        }

		/**
		 * Add section to panel.
		 */
		public function add_section() {
			$this->parent->sections[] = array(
				'id'         => 'presets_section',
				'title'      => esc_html__( 'Presets', 'templaza-framework' ),
				'heading'    => '',
				'icon'       => 'fas fa-rocket',
				'customizer' => false,
				'fields'     => array(
					array(
						'id'            => 'presets',
						'type'          => 'tz_presets',
						'full_width'    => true,
                        'preset_path'   => $this -> get_preset_path(),
                        'fields'        => array(
                            array(
                                'id'            => 'title',
                                'type'          => 'text',
                                'full_width'    => true,
                                'validate'      => 'not_empty',
                                'title'         => esc_html__('Title', 'templaza-framework'),
                                'placeholder'   => esc_html__('Some text...', 'templaza-framework')
                            ),
                            array(
                                'id'    => 'image',
                                'type'  => 'media',
                                'title' => esc_html__('Image', 'templaza-framework'),
                                'full_width'    => true,
                            ),
                            array(
                                'id'    => 'description',
                                'type'  => 'textarea',
                                'title' => esc_html__('Description', 'templaza-framework'),
                                'full_width'    => true,
                            )
                        )
					),
				),
			);
		}
	}
}
