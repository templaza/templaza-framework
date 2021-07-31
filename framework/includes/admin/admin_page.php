<?php

namespace TemPlazaFramework\Admin;

defined( 'ABSPATH' ) || exit;

use \TemPlazaFramework\Functions;
use \TemPlazaFramework\Admin\Admin_Page_Function;
use TemPlazaFramework\Controller\BaseController;
use TemPlazaFramework\Helpers\HelperLicense;
use TemPlazaFramework\Menu_Admin;

if(!class_exists('TemPlazaFramework\Admin\Admin_Page')){


    class Admin_Page extends Admin_Page_Function{

        protected $type;
        protected $sections;
        protected $page_slug;
        protected $controller;
        protected $theme_name;
        protected $text_domain;
        protected $theme_config_registered;

        protected $main_slug            = TEMPLAZA_FRAMEWORK;
        protected $pageHooks            = array();
        protected $theme_demo_datas     = array();

        public function __construct()
        {
            $this -> text_domain        = Functions::get_my_text_domain();
            $this -> page_slug          = TEMPLAZA_FRAMEWORK;
//            $this -> page_slug          = TEMPLAZA_FRAMEWORK;
            $this -> theme_name         = get_template();
            $theme_imports  = apply_filters('templaza-framework-importer', array());

            if($theme_imports && count($theme_imports) && isset($theme_imports['demo-imports'])) {
                $this->theme_demo_datas = $theme_imports['demo-imports'];
                unset($theme_imports['demo-imports']);
                $this -> theme_config_registered   = $theme_imports;
            }

//            if($this -> theme_demo_datas && count($this -> theme_demo_datas)){

                $page = $this -> _get_page();
//                var_dump($page); die();

                if(strpos($page, TEMPLAZA_FRAMEWORK) !== false) {
                    if(!session_id()) {
                        session_start();
                    }
                    remove_all_actions( 'admin_notices' );
                    $action = $this -> _get_action();

                    $this -> controller = BaseController::getInstance('',
                        array(
                            'basePath'                  => TEMPLAZA_FRAMEWORK_CORE_INCLUDES_PATH.'/admin',
                            'theme_name'                => $this -> theme_name,
                            'theme_config_registered'   => $this -> theme_config_registered
                        )
                    );
                    $this -> controller -> set('theme_demo_datas', $this -> theme_demo_datas);

                    if($action){
                        $this -> controller -> execute($action);
                    }
//                }
                add_action('after_switch_theme', array($this, 'plugin_redirect'));
            }
        }

        public function plugin_redirect(){
            if($this -> theme_demo_datas && count($this -> theme_demo_datas)){
                wp_redirect(admin_url('admin.php?page='.TEMPLAZA_FRAMEWORK));
            }
        }

        public function init(){

            add_action('admin_menu', array($this, 'register_admin_menu'));
            /* Add admin menu */
            if($this -> theme_demo_datas && count($this -> theme_demo_datas)) {

                $page   = $this -> _get_page();
                $action = $this -> _get_action();

                // Create secret key to activate license
                if($page == TEMPLAZA_FRAMEWORK && $action != 'activation'
                    && !HelperLicense::is_authorised($this -> theme_name)){
                    $option_name    = HelperLicense::get_option_name($this -> theme_name);
                    $options        = get_option($option_name, array());

                    $options['secret_key']  = HelperLicense::generate_secret_key($this -> theme_name);
                    update_option($option_name, $options);
                }

                add_action('wp_ajax_tzinst-heartbeat', array($this, 'heartbeat'));

                /* Admin Init */
                $this -> admin_init();
            }
        }

        public function admin_init(){
//            add_action('admin_enqueue_scripts', array($this, 'installation_enqueue_scripts'));

            if(HelperLicense::is_authorised($this -> theme_name)) {
                add_action('admin_enqueue_scripts', array($this, 'global_admin_enqueue_scripts'));

                /* Admin Init */
                add_action('admin_notices', array($this, 'heartbeat_notice'));
            }
        }

        public function global_admin_enqueue_scripts(){

            $react      = '<a href="admin.php?page=tzinst-dashboard" class="button-primary">'
                .__('Reactivate license', $this -> text_domain).'</a>';


            wp_enqueue_script('tzinst-admin-js__hearbeat',
                Functions::get_my_frame_url().'/assets/js/heartbeat.js',
                array(), Functions::get_my_version());
            wp_register_script( 'tzinst-admin-js__hearbeat', '' );
            wp_localize_script('tzinst-admin-js__hearbeat', 'tzinst_heartbeat_ajax', array(
                'page' => TEMPLAZA_FRAMEWORK.'-dashboard',
                'heartbeat_action' => TEMPLAZA_FRAMEWORK.'-heartbeat',
                'heartbeat_nonce' => esc_attr( wp_create_nonce(TEMPLAZA_FRAMEWORK.'-heartbeat')),
                'admin_ajax_url' => admin_url('admin-ajax.php'),
                'l10nStrings' => array(
                    'reactivate' => $react,
                )
            ));

//            /* Add style */
//            wp_enqueue_style('tzinst-admin-css__hearbeat',
//                Functions::get_my_frame_url().'/assets/css/heartbeat.css',
//                array(), Functions::get_my_version());
        }

        public function heartbeat_notice(){
            echo '<div id="setting-error-tzinst_heartbeat_domain_notice" class="hide-if-no-js"></div>';
        }

        protected function __heartbeat_response(){
            $storeId    = __METHOD__;
            $storeId   .= ':'.$this -> theme_name;
            $storeId   .= ':'.get_site_url();
            $storeId    = md5($storeId);

            if(isset(self::$cache[$storeId])){
                return self::$cache[$storeId];
            }

            $license    = HelperLicense::get_license($this -> theme_name);

            $headers = array(
                'Content-type' => 'application/x-www-form-urlencoded',
            );

            $url    = TEMPLAZA_FRAMEWORK_INSTALLATION_API_DOMAIN;
            $postdata =array(
                'option'            => 'com_tz_envato_license',
                'task'              => 'licenses.verify',
                'purchase_code'     => $license['purchase_code'],
                'purchase_date'     => $license['purchase_date'],
                'supported_until'   => $license['supported_until'],
                'domain'            => get_site_url(),
            );

            $response = wp_remote_post(
                $url,
                array(
                    'method' => 'POST',
                    'redirection' => 5,
                    'httpversion' => '1.0',
                    'blocking' => true,
                    'timeout' => 30,
                    'sslverify'=> false,
                    'headers' => $headers,
                    'body' => $postdata,
                    'cookies' => array()
                )
            );

            if($response){
                self::$cache[$storeId]    = $response;
                return $response;
            }

            return false;
        }

        public function heartbeat(){

            check_admin_referer( TEMPLAZA_FRAMEWORK.'-heartbeat','_nonce' );

            $result     = array(
                'auth_check'    => false,
                'server_time'   => time()
            );

            $response   = $this -> __heartbeat_response();

            if(is_wp_error($response)){
                $result['message']  = $response -> get_error_message();
            }else{

                $data   = json_decode($response['body']);

                $options        = array();
                $option_name    = HelperLicense::get_option_name($this -> theme_name);

                if($option_name) {
                    $options = get_option($option_name, array());
                }

                if($response['response']['code'] == 200 && $data && $data ->purchase_code){
                    if(count($options)) {
                        $options['domain_valid'] = true;
                        update_option($option_name, $options);

                        $result['auth_check']  = true;
                    }
                }else{
                    if(count($options)) {
                        $options['domain_valid'] = false;
                        update_option($option_name, $options);
                        $result['auth_check']  = false;

                        $authMsg    = '<strong>'.sprintf(__('Welcome to %s', $this -> text_domain),  wp_get_theme()->get('Name')).'</strong>';
                        $authMsg   .= __(' - Your license under this domain is invalid. Please reactivate your license to verify your domain again.', $this -> text_domain);
                        if($themeConfig = $this -> theme_config_registered){
                            if(isset($themeConfig['envato_url']) && $themeConfig['envato_url']){
                                $authMsg    .= ' <a href="'.$themeConfig['envato_url'].'" target="_blank" rel="nofollow">';
                            }
                            $authMsg    .= __('Or purchase a new license for your domain', $this -> text_domain);
                            if(isset($themeConfig['envato_url']) && $themeConfig['envato_url']){
                                $authMsg    .= '</a>';
                            }
                        }

                        $result['message']   = $authMsg;
                    }
                }

//                status_header($response['response']['code']);
            }

            wp_send_json($result);
            exit();

//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_URL,$url);
//
//            $headers = [
////                'Content-type' => 'application/json',
//                'Content-type' => 'application/x-www-form-urlencoded',
//            ];
//
//
//            curl_setopt($ch, CURLOPT_POST, 1);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
//
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//            curl_setopt($ch, CURLOPT_POSTREDIR, 3);
//
//            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
//
//            $apiData   =  curl_exec ($ch);
//            if (curl_errno($ch)) {
//                var_dump(curl_error($ch));
//            }
//
//            curl_close ($ch);
        }

        public function enqueue_admin_scripts(){


//            var_dump(HelperLicense::get_secret_key($this -> theme_name));
//
//            die(__METHOD__);

//            /* Add bootstrap */
//            wp_enqueue_script('tzinst-admin-js__bootstrap',
//                self::get_plugin_url().'/vendor/bootstrap4.3.1/js/bootstrap.min.js',
//                array(), self::get_plugin_version());

            wp_enqueue_script('templaza-framework-installation',
                Functions::get_my_frame_url().'/assets/js/installation.js',
                array(), Functions::get_my_version());

            wp_localize_script('templaza-framework-installation', 'templazaInstallationSettings', array(
                'page' => $this -> _get_page(),
                'demoImportNonce' => esc_attr( wp_create_nonce( TEMPLAZA_FRAMEWORK_NAME.'-demo-ajax' ) ),
                'l10nStrings' => array(
                    'update' => __('Update', $this -> text_domain),
                    'install' => __('Install', $this -> text_domain),
                    'activate' => __('Activate', $this -> text_domain),
                    'activated' => __('Activated', $this -> text_domain),
                    'plugin_install_failed' => __( 'Plugin install failed. Please try again.', $this -> text_domain),
                )
            ));

//            wp_enqueue_style('tzinst__admin-bootstrap',
//                self::get_plugin_url().'/vendor/bootstrap4.3.1/css/bootstrap.min.css',
//                array(), self::get_plugin_version());
//
//            /* Add style */
//            wp_enqueue_style('tzinst__admin-style',
//                self::get_plugin_url().'/admin/assets/css/style.css',
//                array(), self::get_plugin_version());
            do_action('tzinst_enqueue_admin_scripts');
        }

        public function register_admin_menu(){
//            $this -> pageHooks[$this -> page_slug] = add_menu_page(
//                __('Plazart Installation', $this -> text_domain),
//                __('Plazart Installation', $this -> text_domain),
//                'manage_options',
//                $this -> page_slug,
//                array($this, 'render'),
//                'dashicons-download'
//            );


//            add_filter(  TEMPLAZA_FRAMEWORK_NAME.'_admin_sections', array( $this, 'add_section_dashboard' ), 60);
//            add_filter(  TEMPLAZA_FRAMEWORK_NAME.'_admin_sections', array( $this, 'add_section_importer' ), 60);


            Menu_Admin::add_submenu_section(TEMPLAZA_FRAMEWORK, array(
                'label'             => esc_html__('Dashboard', $this->text_domain),
                'description'       => '',
                'add_admin_menu'    => true,
                'callback'          => array($this, 'render')
            ), null);

            if($this -> theme_demo_datas && count($this -> theme_demo_datas)) {
                Menu_Admin::add_submenu_section('importer', array(
                    'label' => esc_html__('Demo Importer', $this->text_domain),
                    'description' => '',
                    'add_admin_menu' => true,
                    'callback' => array($this, 'render')
                ));
            }

	        Menu_Admin::add_submenu_section('support', array(
		        'label' => esc_html__('Support', $this->text_domain),
		        'description' => '',
		        'add_admin_menu' => true,
		        'callback' => array($this, 'render')
	        ));

            $this -> add_submenus();
        }

//        public function add_section_dashboard( $sections){
//            if( !empty( $sections['dashboard'] ) ){
//                $sections['dashboard']['callback']       = array($this, 'render');
//                $sections['dashboard']['add_admin_menu'] = true;
//            }else {
//                $sections['dashboard'] = array(
//                    'label' => esc_html__('Dashboard', $this->text_domain),
//                    'description' => '',
//                    'url' => 'admin.php?page='.$this ->page_slug.'-dashboard',
//                    'add_admin_menu' => true,
//                    'callback' => array($this, 'render')
//                );
//            }
//
//            return $sections;
//        }
//        public function add_section_importer( $sections){
//            if($this -> theme_demo_datas && count($this -> theme_demo_datas)){
//                if( !empty( $sections['importer'] ) ){
//                    $sections['importer']['callback']       = array($this, 'render');
//                    $sections['importer']['add_admin_menu'] = true;
//                }else {
//                    $sections['importer'] = array(
//                        'label' => esc_html__('Demo Importer', $this->text_domain),
//                        'description' => '',
//                        'url' => 'admin.php?page='.$this ->page_slug.'-importer',
//                        'add_admin_menu' => true,
//                        'callback' => array($this, 'render')
//                    );
//                }
//            }
//
//            return $sections;
//        }

        public function get_sections(){
            if( empty( $this->sections ) ){
                $this -> sections   = Menu_Admin::get_menu_sections();
                $this -> sections   = apply_filters( TEMPLAZA_FRAMEWORK_NAME.'_admin_sections', $this -> sections );
            }

            return $this->sections;
        }

        protected function _get_page(){
            return (isset($_GET['page']) && $_GET['page'])?$_GET['page']:((isset($_POST['page']) && $_POST['page'])?$_POST['page']:'');
        }
        protected function _get_action(){
            return (isset($_GET['action']) && $_GET['action'])?$_GET['action']:((isset($_POST['action']) && $_POST['action'])?$_POST['action']:'');
        }

        protected function add_submenus(){

            $sections  = $this->get_sections();

            if( empty( $sections ) ){
                return;
            }

            $position   = 1;
            foreach ( $sections as $section_id => $section ) {
                if( ! empty( $section['add_admin_menu'] ) && $section['add_admin_menu'] ){

                    $section_slug   = isset($section['slug'])?$section['slug']:$this -> main_slug.'-'.$section_id;
                    if($section_id == 'dashboard'){
                        $section_slug   = $this -> page_slug;
                    }
                    $this -> pageHooks[$section_slug] = add_submenu_page(
                            $this->page_slug,
                            $section['label'],
                            $section['label'],
                            'manage_options'
                            , $section_slug,
                            $section['callback'],
                            $position
                        );
                    $position++;

                }
            }

            remove_submenu_page(
                $this -> page_slug,
                $this -> page_slug
            );
        }

        protected function get_current_page($page_id = ''){
            $page   = self::get_page_type();
            $sec    = Menu_Admin::get_nav_tabs();
            $page   = in_array( $page, array_keys( $sec ) ) ? $page : array_keys( $sec )[0];

            if( empty( $page_id ) ){
                return $page;
            } else {
                return $page === $page;
            }
        }

        protected function the_header( ){
            $file   = self::get_template_directory().'/header.php';

            if(file_exists($file)){
                require_once $file;
            }
        }
        protected function the_notices( ){
            $file   = self::get_template_directory().'/notices.php';

            if(file_exists($file)){
                do_action(TEMPLAZA_FRAMEWORK_NAME.'_admin_notices');
                require_once $file;
            }
        }

        protected function the_nav(){
            $nav_tabs = Menu_admin::get_nav_tabs();
            if( empty( $nav_tabs ) ){
                return;
            }
            $file   = self::get_template_directory().'/nav.php';

            if(file_exists($file)){
                require_once $file;
            }
        }
        protected function the_content( $type = '' ){

            $type       = !empty($type)?$type:$this -> get_current_page();
            $sections   = $this->get_sections();
            if( empty( $sections ) ){
                return;
            }

            do_action( TEMPLAZA_FRAMEWORK_NAME.'_admin_before_welcome_section_content', $type, $sections );


            $controller = $this -> controller;
            $controller -> display();

            do_action( TEMPLAZA_FRAMEWORK_NAME.'_admin_after_welcome_section_content', $type, $sections );
        }

        protected function the_footer(){

//            $file   = self::get_template_directory().'/footer.php';
            $file   = self::get_template_directory().'/footer.php';

            if(file_exists($file)){
                require_once $file;
            }

            $this -> enqueue_admin_scripts();
        }


        public function render(){
            $file   = self::get_template_directory().'/render.php';

            if(file_exists($file)){
                require_once $file;
            }
        }
    }
}