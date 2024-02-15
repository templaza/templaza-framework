<?php

namespace TemPlazaFramework\Admin\Controller;

defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

use Beta\Microsoft\Graph\Model\VersionAction;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Helpers\Info;
use TemPlazaFramework\Admin\Application;
use TemPlazaFramework\Helpers\HelperLicense;
use TemPlazaFramework\AdminHelper\ThemeHelper;
use TemPlazaFramework\Controller\BaseController;

if(!class_exists('TemPlazaFramework\Admin\Controller\Global_ColorsController')){
    class Global_ColorsController extends BaseController{

        protected $pagehook         = TEMPLAZA_FRAMEWORK_NAME.'__admin-theme';
        protected $imported_key;
        protected $plugins          = array();
        protected $theme_demo_datas;
        protected $api  = TEMPLAZA_FRAMEWORK_INSTALLATION_API_DOMAIN;
        protected $info;
        protected $framework = null;

        public function __construct(array $config = array())
        {
            parent::__construct($config);

            if(isset($config['framework'])) {
                $this -> framework = $config['framework'];
            }

            $this -> info   = new Info();
//
//            if(!HelperLicense::is_authorised($this -> theme_name)){
//                $app    = Application::get_instance();
//                $app -> enqueue_message(sprintf(__(
//                    'Theme %s not Activated! To install any of the demo content sites below you must <a href="%s">Activate theme</a>',
//                    'templaza-framework'), wp_get_theme()->get('Name'),
//                    admin_url('admin.php?page='.TEMPLAZA_FRAMEWORK) ), 'message');
//            }

            $this -> register_color();

            $this -> init_redux();

            $this -> hooks();
        }

        public function hooks(){
//            add_action('tzinst_enqueue_admin_scripts', array($this, 'enqueue_admin_scripts'));

//            $args       = $this -> get_arguments();
//            $opt_name   = $args['opt_name'];

//            remove_action('wp_ajax_' . $args['opt_name'] . '_ajax_save', array('Redux_AJAX_Save', 'save_color'));

//            add_action( 'wp_ajax_' . $opt_name . '_ajax_save', array( $this, 'save_color' ) );
            add_action('admin_footer', array($this, 'admin_footer'), 99);
        }
        public function global_colors_ajax_save(){
//            die(__FILE__);
        }

        public function register_color(){

            \Templaza_API::set_section('global_colors', array(
                'id'         => 'custom-color',
                'title'     => esc_html__('Custom Colors','templaza-framework'),
                'desc'      => esc_html__('Create theme colors','templaza-framework'),
                'icon'      => 'el-icon-brush',
                'fields'    => array(
                    array(
                        'id'        => 'custom_colors',
                        'type'      => 'tz_color_repeater',
                        'title'     => esc_html__('Custom Colors','templaza-framework'),
                    ),
                ),
            ));

        }

        public function init_redux(){

            if($sections = \Templaza_API::construct_sections($this -> get_name())) {

                $args       = $this -> get_arguments();
                $opt_name   = $args['opt_name'];
//                var_dump($opt_name);
//                var_dump($args);
//                die(__METHOD__);

//                add_filter('redux/' . $opt_name . '/panel/template/header.tpl.php', function ($path) {
//                    return TEMPLAZA_FRAMEWORK_CORE_TEMPLATE . '/redux-panel/header.tpl.php';
//                });
                add_filter('redux/' . $opt_name . '/panel/template/container.tpl.php', function ($path) {
                    return TEMPLAZA_FRAMEWORK_CORE_TEMPLATE . '/redux-panel/container.tpl.php';
                });
//                add_filter('redux/' . $opt_name . '/panel/template/header-stickybar.tpl.php', function ($path) {
//                    return TEMPLAZA_FRAMEWORK_CORE_TEMPLATE . '/redux-panel/header-stickybar.tpl.php';
//                });
                add_filter('redux/' . $opt_name . '/panel/template/footer.tpl.php', function ($path) {
                    return TEMPLAZA_FRAMEWORK_CORE_TEMPLATE . '/redux-panel/footer.tpl.php';
                });

                \Redux::set_args($opt_name, $args);
                \Redux::set_sections($opt_name, $sections);
                $path = TEMPLAZA_FRAMEWORK_CORE_PATH . '/extensions/';
                \Redux::set_extensions($opt_name, $path);

                \Templaza_API::load_my_fields($opt_name);
                \Redux::init($opt_name);
            }
        }

        public function get_arguments(){
            $opt_name   = $this -> get_name();
            $framework  = $this -> get('framework');
            $args       = $framework -> get_arguments();

            $args['opt_name'] = TEMPLAZA_FRAMEWORK_PREFIX.'_'.$opt_name;
//            $args['opt_name'] = $opt_name;
            $args['dev_mode'] = false;
            $args['display_name'] = __('Global Colors', 'templaza-framework');
            $args['menu_type'] = 'hidden';
            $args['hide_reset'] = true;
            $args['hide_expand'] = true;
//            $args['compiler']       = false;
            $args['show_presets'] = false;
            $args['show_import_export'] = true;

            return $args;
        }

//        public function display($view = '')
//        {
//            $this -> init_redux();
//
//            return parent::display($view); // TODO: Change the autogenerated stub
//        }

        public function tzfrm_save_global_colors(){
            die(__FILE__);
        }


        public function admin_footer(){
            $store_id   = __METHOD__;
            $store_id  .= '::'.$this -> get_name();
            $store_id   = md5($store_id);

            if(isset($this -> cache[$store_id])){
                return;
            }

            $args   = $this -> get_arguments();

            $redux  = \Redux::instance($args['opt_name']);
            if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
                if($redux && method_exists($redux, '_enqueue')) {
                    $redux->_enqueue();
                }
            }else{
                if($redux && isset($redux->enqueue_class) && $redux->enqueue_class) {
                    $redux->enqueue_class->init();
                }
            }

            $this -> cache[$store_id]   = true;

        }

//        public function enqueue_admin_scripts(){
//            wp_enqueue_script('templaza-framework-theme-install',
//                Functions::get_my_frame_url().'/assets/js/theme-install.js',
//                array(), Functions::get_my_version());
//
//            wp_localize_script('templaza-framework-theme-install','tzinst_theme_install',array(
//                'theme_install_nonce' => esc_attr( wp_create_nonce( TEMPLAZA_FRAMEWORK_NAME.'-theme-install-ajax' ) ),
//                'l10nStrings'   => array(
//                    'install_theme_question' => __('Are you sure you want to install & active this theme?', 'templaza-framework'),
//                )
//            ));
//        }

    }
}