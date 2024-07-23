<?php

namespace TemPlazaFramework\Admin\Controller;

defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

use TemPlazaFramework\Functions;
use TemPlazaFramework\Helpers\Info;
use TemPlazaFramework\Admin\Application;
use TemPlazaFramework\Helpers\HelperLicense;
use TemPlazaFramework\AdminHelper\ThemeHelper;
use TemPlazaFramework\Controller\BaseController;

if(!class_exists('TemPlazaFramework\Admin\Controller\ThemeController')){
    class ThemeController extends BaseController{

        protected $pagehook         = TEMPLAZA_FRAMEWORK_NAME.'__admin-theme';
        protected $imported_key;
        protected $plugins          = array();
        protected $theme_demo_datas;
        protected $api  = TEMPLAZA_FRAMEWORK_INSTALLATION_API_DOMAIN;
        protected $info;

        public function __construct(array $config = array())
        {
            parent::__construct($config);


            $this -> info   = new Info();

            if(!HelperLicense::is_authorised($this -> theme_name)){
                $app    = Application::get_instance();
                /* translators: %s - install. */
                $app -> enqueue_message(sprintf(esc_html__(
                    'Theme %1$s not Activated! To install any of the demo content sites below you must <a href="%2$s">Activate theme</a>',
                    'templaza-framework'), esc_html(wp_get_theme()->get('Name')),
                    esc_url(admin_url('admin.php?page='.TEMPLAZA_FRAMEWORK)) ), 'message');
            }

//            $this -> imported_key   = '_'.TEMPLAZA_FRAMEWORK.'_'.$this -> theme_name.'__demo_imported';


            $this -> hooks();
        }

        public function hooks(){
            add_action('tzinst_enqueue_admin_scripts', array($this, 'enqueue_admin_scripts'));
        }

        public function tzinst_theme_install(){
            add_action('wp_ajax_tzinst_theme_install', array($this, 'ajax_theme_install'));
            add_action('wp_ajax_nopriv_tzinst_theme_install', array($this, 'ajax_ajax_theme_install'));
        }

        public function ajax_theme_install(){

            if ( !current_user_can( 'switch_themes' ) ) {
                return;
            }
            // phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped

            check_admin_referer(TEMPLAZA_FRAMEWORK_NAME . '-theme-install-ajax', 'security');

            $theme          = $this -> theme_name;

            // Check license
            if(!HelperLicense::is_authorised($theme)){
                $this -> info -> set_message(esc_html__('You have not a valid license.', 'templaza-framework'), true);
                echo $this -> info -> output(true);
                die();
            }

            $page           = $_POST['page'];
            $action         = $_POST['action'];
            $security       = $_POST['security'];
            $step           = isset($_POST['step'])?$_POST['step']:1;

            $url            = $this -> api.'/index.php?option=com_tz_membership';
            $produce        = isset($_POST['pack']) && $_POST['pack']?$_POST['pack']:'';
            $pack           = isset($_POST['pack_type']) && $_POST['pack_type']?$_POST['pack_type']:'';
            $theme_title    = isset($_POST['theme_title']) && $_POST['theme_title']?$_POST['theme_title']:'';

            \WP_Filesystem();
            global $wp_filesystem;

            $upgrade_folder = $wp_filesystem-> wp_content_dir() . 'uploads/tzinst-theme-install';

            $filePath   = $upgrade_folder.'/'.$produce.'_'.$pack.'.zip';
            // phpcs:disable WordPress.WP.AlternativeFunctions.unlink_unlink

            if($step == 1 && file_exists($filePath)){
                unlink($filePath);
            }

            $purchase_code  = HelperLicense::get_purchase_code($theme);

            $postdata =array(
                'option'        => 'com_tz_membership',
                'task'          => 'download.package',
                'produce'       => $produce,
                'purchase_code' => $purchase_code,
                'step'          => $step,
                'type'          => $pack,
                'domain'        => get_site_url()
            );

            $app        = Application::get_instance();
            $redirect   = admin_url('admin.php?page='
                .TEMPLAZA_FRAMEWORK.(($this -> get_name() != 'dashboard')?'_'.$this -> get_name():''));

            // Bump the max execution time because not using built in php zip libs are slow
            @set_time_limit(ini_get('max_execution_time'));

            // Get package file from server with post data
            $response = wp_remote_post(
                $url,
                array(
                    'method' => 'POST',
//                            'timeout'  => 300,
                    'timeout' => 45,
                    'body' => $postdata
                )
            );

            if(is_wp_error($response)){
                $app -> enqueue_message($response -> get_error_message(), 'error');

                $this -> info -> set_message($response -> get_error_message(), true);
                $this -> info -> set('redirect', $redirect);
            }else {

                $body   = $response['body']; // use the content
                $header = $response['headers']; // array of http header lines

                if ($header['content-type'] == 'application/json') {
                    $body = json_decode($body);
                    if ($body->code == 400 && $body->success == false) {
                        $app -> enqueue_message(esc_html($body->message), 'error');

                        $this->info->set_message(esc_html($body->message), true);
                        $this -> info -> set('redirect', $redirect);

                        echo $this->info->output(true);
                        die();
                    }
                }

                if (!is_dir($upgrade_folder)) {
                    wp_mkdir_p($upgrade_folder);
                }

                $total_files_part   = (isset($header['files-part-count']) && $header['files-part-count'])?(int)$header['files-part-count']:1;

                // Put multiple parts of package files to one file
                // phpcs:disable WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents
                file_put_contents($filePath, $body, FILE_APPEND);

                if($total_files_part > 1 && $step < $total_files_part){
                    /* translators: %s - Download. */
                    $this -> info -> set_message(sprintf(esc_html__('Download file part %d completed',
                        'templaza-framework'), esc_html($step)), false);

                    if($total_files_part > 1) {
                        $next_step  = array(
                            'action'    => $action,
                            'page'      => $page,
                            'security'  => $security,
                            'pack'      => $produce,
                            'pack_type' => $pack
                        );
                        $next_step['total_step'] = (int)$header['files-part-count'];
                        if($step < $header['files-part-count']){
                            $next_step['step']              = $step + 1;
                        }
                        $this -> info -> set('nextstep', $next_step);
                    }
                }
                else {
                    // Install theme downloaded
                    $overwrite  = 'update-theme';
                    $skin     = new \WP_Ajax_Upgrader_Skin();
                    $upgrader = new \Theme_Upgrader($skin);

                    $result = $upgrader->install( $filePath, array( 'overwrite_package' => $overwrite ) );

                    // Switch theme
                    if($result){

                        $curtheme   = wp_get_theme();
                        $curtheme_name  = $curtheme -> get_stylesheet();
                        $theme      = $upgrader ->theme_info();
                        $new_theme  = $theme -> get_stylesheet();
                        $lic        = HelperLicense::get_license($curtheme_name);
                        $new_lic    = HelperLicense::get_license($new_theme);

                        // Copy current license for new theme
                        if($lic && !empty($lic['purchase_code']) && (!$new_lic || !$new_lic['purchase_code'])) {
                            if($new_lic) {
                                $lic['secret_key'] = $new_lic['secret_key'];
                            }

                            update_option(HelperLicense::get_option_name($new_theme), $lic);
                        }

                        // Activate theme
                        switch_theme( $new_theme );

                        $app -> enqueue_message(esc_html__('Downloaded and installed theme successfully', 'templaza-framework'), 'success');

                        $this -> info -> set_message(esc_html__('Downloaded and installed theme successfully', 'templaza-framework'), false);
                        $this -> info -> set('redirect', admin_url('admin.php?page='.TEMPLAZA_FRAMEWORK));
                    }

                }
            }

            ob_clean();
            echo $this -> info -> output(true);
            wp_die();

        }

        public function enqueue_admin_scripts(){
            wp_enqueue_script('templaza-framework-theme-install',
                Functions::get_my_frame_url().'/assets/js/theme-install.js',
                array(), Functions::get_my_version(), false);

            wp_localize_script('templaza-framework-theme-install','tzinst_theme_install',array(
                'theme_install_nonce' => esc_attr( wp_create_nonce( TEMPLAZA_FRAMEWORK_NAME.'-theme-install-ajax' ) ),
                'l10nStrings'   => array(
                    'install_theme_question' => __('Are you sure you want to install & active this theme?', 'templaza-framework'),
                )
            ));
        }

        /*
         * Get themes list from server
        */
        protected function getThemes(){

            return ThemeHelper::getThemesPackage();

//            return ThemeHelper::getThemesSupported('autoshowroom',
//                array('api_domain' => 'http://joomla.templaza.com/templazaplus'));

//            $curtheme   = wp_get_theme();
//            $theme      = $this -> theme_name;
////            $url        = $this -> api.'/index.php';
////            $url        = $this -> api;
//            $url        = 'http://joomla.templaza.com/templazaplus/index.php';
////            $url        = 'http://joomla.templaza.com/templazaplus';
//            $app        = Application::get_instance();
//
//            $purchase_code  = HelperLicense::get_purchase_code($curtheme -> get_template());
//
//            if(!$purchase_code){
//                return false;
//            }
//
//            $remoteData = array(
//                'option'    => 'com_tz_membership',
//                'view'      => 'products',
//                'format'    => 'list',
////                'produce'   => 'wp_'.$curtheme -> get_template(),
//                'produce'   => 'wp_autoshowroom', // Testing
//                'purchase_code' => $purchase_code,
//            );
//            // Get package file from server with post data
////            $response = wp_remote_get(
//            $response = wp_remote_post(
//                $url,
//                array(
//                    'method' => 'GET',
////                    'method' => 'GET',
////                            'timeout'  => 300,
//                    'timeout' => 45,
//                    'body' => $remoteData
//                )
//            );
//
//            if(is_wp_error($response)){
//
//                $app -> enqueue_message(esc_html__($response -> get_error_message(),
//                    'templaza-framework'), 'error');
//
//                return false;
//            }
//
//            if(isset($response['response']['code']) && $response['response']['code'] != 200){
//                $app -> enqueue_message(__('Could not connected to our server to get themes list', 'templaza-framework'), 'warning');
//                return false;
//            }
//
//            $body   = wp_remote_retrieve_body($response); // use the content
//            $header = wp_remote_retrieve_headers($response); // array of http header lines
//
//            if ($header['content-type'] == 'application/json') {
//                $body = json_decode($body, true);
////                if (isset($body -> code)$body->code == 400 && $body->success == false) {
////                    $app -> enqueue_message(__($body->message, 'templaza-framework'), 'error');
////                    return false;
////                }
//            }
//
//            if(!isset($body['products'])){
//                return false;
//            }
//
//            return $body['products'];
        }

    }
}