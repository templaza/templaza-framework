<?php

namespace TemPlazaFramework\Admin\Controller;

defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

use Elementor\Core\App\Modules\ImportExport\Import;
use Elementor\Core\Kits\Manager;
use Elementor\Plugin;
use PHPMailer\PHPMailer\Exception;
use TemPlazaFramework\Admin\Application;
use TemPlazaFramework\Controller\BaseController;
use TemPlazaFramework\Helpers\Files;
use TemPlazaFramework\Helpers\HelperLicense;
use TemPlazaFramework\Helpers\Info;
use TemPlazaFramework\Admin_Functions;
use TemPlazaFramework\Admin\Admin_Page_Function;
use um\core\Validation;

if(!class_exists('TemPlazaFramework\Admin\Controller\ImporterController')){
    class ImporterController extends BaseController{

        protected $info;
        protected $item;
        protected $product_code;
        protected $imported_key;
        protected $theme_demo_datas;

        protected $pagehook         = TEMPLAZA_FRAMEWORK_NAME.'__admin-importer';
        protected $plugins          = array();
        protected $api  = TEMPLAZA_FRAMEWORK_INSTALLATION_API_DOMAIN;


        public function __construct(array $config = array())
        {
            parent::__construct($config);
            // phpcs:disable  WordPress.Security.NonceVerification.Missing
            if(isset($_POST['action']) && $_POST['action'] == 'tzinst_import_demo_data'
                && !defined('WP_LOAD_IMPORTERS')) {
                define('WP_LOAD_IMPORTERS', true);
            }

            $this -> info   = new Info();

            if(!HelperLicense::is_authorised($this -> theme_name)){
                $app    = Application::get_instance();
                /* translators: %s - Activated. */
                $app -> enqueue_message(sprintf(esc_html__(
                    'Theme %1$s not Activated! To install any of the demo content sites below you must <a href="%2$s">Activate theme</a>',
                    'templaza-framework'), esc_html(wp_get_theme()->get('Name')),
                    esc_url(admin_url('admin.php?page='.TEMPLAZA_FRAMEWORK.'#tzinst-license')) ), 'message');
            }

            $this -> imported_key   = '_'.TEMPLAZA_FRAMEWORK.'_'.$this -> theme_name.'__demo_imported';

            $this -> system_requirement_notice();
        }

        public function get_theme_demo_datas(){

            $results    = $this -> get('theme_demo_datas', array());
            return $results;
        }

        public function get_all_plugins(){
            $results    = $this -> get_theme_demo_datas();

            if($results && count($results)){
                foreach($results as $item){
                    if(isset($item['plugins']) && $item['plugins']){
                        foreach($item['plugins'] as $plugin){
                            if(!isset($this -> plugins[$plugin['slug']])){
                                $this -> plugins[$plugin['slug']]   = $plugin;
                            }
                        }
                    }
                }
            }

            return $this -> plugins;
        }

        public function tzinst_plugin_action(){
            add_action('wp_ajax_tzinst_plugin_action', array($this, 'ajax_plugin_action'));
            add_action('wp_ajax_nopriv_tzinst_plugin_action', array($this, 'ajax_plugin_action'));
        }
        public function tzinst_import_demo_data(){
            add_action('wp_ajax_tzinst_import_demo_data', array($this, 'ajax_import_demo_data'));
            add_action('wp_ajax_nopriv_tzinst_import_demo_data', array($this, 'ajax_import_demo_data'));
        }

        public function enable_tgmpa(){
            return true;
        }

        protected $imported = array();

        public function ajax_plugin_action(){
            if ( current_user_can( 'switch_themes' ) ) {
                $prefix = TEMPLAZA_FRAMEWORK;
//                if ( isset( $_GET[$prefix.'_activate'] ) && 'activate-plugin' === $_GET[$prefix.'_activate'] ) {

                check_admin_referer( TEMPLAZA_FRAMEWORK_NAME.'-action','_nonce' );

                if(!isset($_GET['plugin']) && !$_GET['plugin']){
                    echo '<div data-tzinst-install-plugin-message>';
                    wp_send_json(array(
                        'success' => false,
                        'installed' => false,
                        'activated' => false,
                        'message' => __('Not found plugin', 'templaza-framework')
                    ));
                    echo '</div>';
                    exit();
                }

                $_plugin    = $_GET['plugin'];
                $plugins    = $this -> get_all_plugins();
                $plugin     = $plugins[$_plugin];
                $failed     = isset($_GET['failed']) && $_GET['failed']?$_GET['failed']:array();
                $passed     = isset($_GET['passed']) && $_GET['passed']?$_GET['passed']:array();

                $resultJSON = array(
                    'success'   => false,
                    'update'    => false,
                    'install'   => false,
                    'activate'  => false,
                    'activated' => false
                );

                $tgmConfig  = array(
                    'id'            => 'templaza-framework',
                    'has_notices'   => true,
                    'is_automatic'  => true,
                    'strings'       => array(
                        /* translators: %s - Plugin. */
                        'updating'              => __( 'Updating Plugin: %s', 'templaza-framework' ),/* translators: %s - Plugin. */
                        'plugin_updated'      => _n_noop( 'Plugin "%s" updated successfully.',/* translators: %s - Plugin. */
                            'Plugins "%s" updated successfully.', 'templaza-framework' ),/* translators: %s - Plugin. */
                        'plugin_activated'      => _n_noop( 'Plugin "%s" activated successfully.',/* translators: %s - Plugin. */
                            'Plugins "%s" activated successfully.', 'templaza-framework' ),/* translators: %s - Plugin. */
                        'plugin_update_error'   => _n_noop('Can not update plugin "%s". Please check it again!',
                            'Can not update plugins "%s". Please check it again!', 'templaza-framework'),/* translators: %s - Plugin. */
                        'plugin_install_error'  => _n_noop('Can not install plugin "%s". Please check it again!',/* translators: %s - Plugin. */
                            'Can not install plugins "%s". Please check it again!', 'templaza-framework'),/* translators: %s - Plugin. */
                        'plugin_activate_error' => _n_noop( 'Can not activate plugin "%s".',/* translators: %s - Plugin. */
                            'Can not activate plugins "%s".', 'templaza-framework' ),/* translators: %s - Plugin. */
                        'complete'              => __( 'All plugins installed and activated successfully. %1$s',  'templaza-framework' ),/* translators: %s - Plugin. */
                    )
                );
                if(isset($_GET['tgmpa-update']) && 'update-plugin' === $_GET['tgmpa-update']){
                    $tgmConfig['is_automatic']  = false;
                }

                tgmpa( $plugins, $tgmConfig);

                $tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );

                // Unfortunately 'output buffering' doesn't work here as eventually 'wp_ob_end_flush_all' function is called.
                $tgmpa_instance->install_plugins_page();

                echo '<div data-tzinst-install-plugin-message>';
                if(isset($_GET['tgmpa-install']) && 'install-plugin' === $_GET['tgmpa-install']){
                    // Install Plugin
                    if ($tgmpa_instance->is_plugin_installed($_plugin)) {
                        if($tgmConfig['is_automatic'] && $tgmpa_instance -> is_plugin_active($_plugin)){
                            $resultJSON['success']   = true;
                            $resultJSON['activated'] = true; /* Enable text actived */
                        }else{
                            $resultJSON['success']   = true;
                            $resultJSON['activate']  = true; /* Enable text activate */
                        }

                        $install                 = isset($passed['install']) && $passed['install']?$passed['install']:array();
                        $install[]               = $plugin['name'];
                        $passed['install']       = $install;
                        $msgCount                = count($install);
                        $pluginNames             = $msgCount?implode(", ", $install):$plugin['name'];
                        $message                 = translate_nooped_plural($tgmConfig['strings']['plugin_updated'],$msgCount, 'templaza-framework');

                        $resultJSON['passed']    = $passed;
                        $resultJSON['message']   = sprintf($message, $pluginNames);
                    }else {
                        $install                 = isset($failed['install']) && $failed['install']?$failed['install']:array();
                        $install[]               = $plugin['name'];
                        $failed['install']       = $install;
                        $msgCount                = count($install);
                        $pluginNames             = $msgCount?implode(", ", $install):$plugin['name'];
                        $message                 = translate_nooped_plural($tgmConfig['strings']['plugin_install_error'],$msgCount, 'templaza-framework');

                        $resultJSON['success']   = false;
                        $resultJSON['install']   = true; /* Enable text install */
                        $resultJSON['failed']    = $failed;
//                           $resultJSON['message']   = sprintf($message, $pluginNames);
                    }
                }elseif(isset($_GET['tgmpa-update']) && 'update-plugin' === $_GET['tgmpa-update']){
                    // Update Plugin
                    $installedVersion    = $tgmpa_instance->get_installed_version($_plugin);
                    if(version_compare($installedVersion, $plugin['version'], '=')){
                        if($tgmpa_instance -> is_plugin_active($_plugin)){
                            $resultJSON['success']   = true;
                            $resultJSON['activated'] = true; /* Enable text activated */
                        }else{
                            $resultJSON['success']   = true;
                            $resultJSON['activate']  = true; /* Enable text activate */
                        }

                        $update                  = isset($passed['update']) && $passed['update']?$passed['update']:array();
                        $update[]                = $plugin['name'];
                        $passed['update']        = $update;
                        $msgCount                = count($update);
                        $pluginNames             = $msgCount?implode(", ", $update):$plugin['name'];
                        $message                 = translate_nooped_plural($tgmConfig['strings']['plugin_updated'],$msgCount, 'templaza-framework');

                        $resultJSON['passed']    = $passed;
                        $resultJSON['message']   = sprintf($message, $pluginNames);
                    }else{
                        $update                  = isset($failed['update']) && $failed['update']?$failed['update']:array();
                        $update[]                = $plugin['name'];
                        $failed['update']       = $update;
                        $msgCount                = count($update);
                        $pluginNames             = $msgCount?implode(", ", $update):$plugin['name'];
                        $message                 = translate_nooped_plural($tgmConfig['strings']['plugin_update_error'],$msgCount, 'templaza-framework');

                        $resultJSON['success']   = false;
                        $resultJSON['update']    = true; /* Enable text update */
                        $resultJSON['failed']    = $failed;
                        $resultJSON['message']   = sprintf($message, $pluginNames);
                    }
                }elseif(isset($_GET['tgmpa-activate']) && 'activate-plugin' === $_GET['tgmpa-activate']){
                    // Activate Plugin
                    if($tgmpa_instance -> is_plugin_active($_plugin)){
                        $activate                = isset($passed['activate']) && $passed['activate']?$passed['activate']:array();
                        $activate[]              = $plugin['name'];
                        $passed['activate']      = $activate;
                        $msgCount                = count($activate);
                        $pluginNames             = $msgCount?implode(", ", $activate):$plugin['name'];
                        $message                 = translate_nooped_plural($tgmConfig['strings']['plugin_activated'],$msgCount, 'templaza-framework');

                        $resultJSON['success']   = true;
                        $resultJSON['activated'] = true; /* Enable text activated */
                        $resultJSON['passed']    = $passed;
                        $resultJSON['message']   = sprintf($message, $pluginNames);
                    }else{
                        $activate                = isset($failed['activate']) && $failed['activate']?$failed['activate']:array();
                        $activate[]              = $plugin['name'];
                        $failed['activate']      = $activate;
                        $msgCount                = count($activate);
                        $pluginNames             = $msgCount?implode(", ", $activate):$plugin['name'];
                        $message                 = translate_nooped_plural($tgmConfig['strings']['plugin_activate_error'],$msgCount, 'templaza-framework');

                        $resultJSON['success']   = true;
                        $resultJSON['activate']  = true; /* Enable text activate */
                        $resultJSON['failed']    = $failed;
                        $resultJSON['message']   = sprintf($message, $pluginNames);
                    }
                }

                if(count($resultJSON)){
                    wp_send_json($resultJSON);
                }
                echo '</div>';
                exit();
//                }
            }
        }

        public function get_pack_by_slug($slug){
            if(!$slug){
                return false;
            }

            $storeId    = __METHOD__;
            $storeId   .= ':'.$slug;
            $storeId    = md5($storeId);

            if(isset($this -> cache[$storeId])){
                return $this -> cache[$storeId];
            }

            $packs  = $this -> get_theme_demo_datas();

            if(!count($packs)){
                return false;
            }

            foreach($packs as $key => $value){
                if(!is_numeric($key) && $key == $slug){
                    $this -> cache[$storeId]    = $value;
                    return $value;
                }elseif(isset($value['slug']) && $value['slug'] == $slug){
                    $this -> cache[$storeId]    = $value;
                    return $value;
                }
            }
            return false;
        }

        public function ajax_import_demo_data(){
            if ( current_user_can( 'switch_themes' ) ) {
                // phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
                check_admin_referer( TEMPLAZA_FRAMEWORK_NAME.'-demo-ajax','security');

//                if ( function_exists( 'ini_get' ) ) {
//                    if ( 300 < ini_get( 'max_execution_time' ) ) {
//                        set_time_limit( 300 );
//                    }
//                    if ( 512 < intval( ini_get( 'memory_limit' ) ) ) {
//                        wp_raise_memory_limit();
//                    }
//                }
//                wp_cache_flush();

                $prefix = TEMPLAZA_FRAMEWORK;

                $theme          = $this -> theme_name;

                // Check license
                if(!HelperLicense::is_authorised($theme)){
                    $this -> info -> set_message(esc_html__('You have not a valid license.', 'templaza-framework'), true);
                    echo $this -> info -> output(true);
                    die();
                }
                $purchase_code  = HelperLicense::get_purchase_code($theme);

                $step           = isset($_POST['step'])?$_POST['step']:1;
                $url            = $this -> api.'/index.php?option=com_tz_membership';
                $page           = $_POST['page'];
                $pack_type      = $_POST['pack_type'];
                $action         = $_POST['action'];
                $file_name      = isset($_POST['file_name']) && $_POST['file_name']?$_POST['file_name']:'';
                $files          = isset($_POST['files']) && $_POST['files']?$_POST['files']:'';
                $demo_type      = isset($_POST['demo_type']) && $_POST['demo_type']?$_POST['demo_type']:'';
                $demo_title     = isset($_POST['demo_title']) && $_POST['demo_title']?$_POST['demo_title']:'';
                $demo_key       = isset($_POST['demo_key']) && $_POST['demo_key']?$_POST['demo_key']:'';
                $produce        = $_POST['pack'];
                $pack_main      = isset($_POST['pack_main'])?$_POST['pack_main']:'';
                $security       = $_POST['security'];
                $action_import  = isset($_POST['action_import'])?$_POST['action_import']:null;


                \WP_Filesystem();
                global $wp_filesystem;
                // phpcs:disable WordPress.WP.AlternativeFunctions.unlink_unlink, WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents

                $upgrade_folder = $wp_filesystem-> wp_content_dir() . 'uploads/tzinst-demo-datas';

                $filePath   = $upgrade_folder.'/'.$produce.'_'.$pack_type.'.zip';

                if($action_import && $action_import == 'download'){

                    if($step == 1 && file_exists($filePath)){
                        unlink($filePath);
                    }

                    $postdata =array(
                        'task'          => 'download.package',
                        'produce'       => $produce,
                        'purchase_code' => $purchase_code,
                        'step'          => $step,
                        'type'          => $pack_type,
                        'domain'        => get_site_url()
                    );

//                    $url   = 'http://joomla.templaza.com/templazaplus/index.php?option=com_tz_membership';
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
                        $this -> info -> set_message(esc_html($response -> get_error_message()), true);
                    }else{
                        $header = $response['headers']; // array of http header lines
                        $body = $response['body']; // use the content

                        if($header['content-type'] == 'application/json'){
                            $body   = json_decode($body);
                            if($body -> code == 400 && $body -> success == false){
                                $this -> info -> set_message(esc_html($body -> message), true);
                                echo $this -> info -> output(true);
                                die();
                            }
                        }

                        if(!is_dir($upgrade_folder)){
                            wp_mkdir_p($upgrade_folder);
                        }

                        // Put multiple parts of package files to one file
                        file_put_contents($filePath, $body, FILE_APPEND);

                        $total_files_part   = (isset($header['files-part-count']) && $header['files-part-count'])?(int)$header['files-part-count']:1;

                        if($total_files_part > 1 && $step < $total_files_part){
                            /* translators: %s - Download. */
                            $this -> info -> set_message(sprintf(esc_html__('Download file part %d completed',
                                'templaza-framework'), esc_html($step)), false);
                        }else {
                            $folder_path = $upgrade_folder . '/' . $produce . '_' . $pack_type;
                            unzip_file($filePath, $folder_path);
                            $this -> info -> set_message(esc_html__('Download file completed', 'templaza-framework'), false);
                        }

                        $next_step  = array(
                            'action'    => $action,
                            'page'      => $page,
                            'security'  => $security,
                            'pack'      => $produce,
                            'pack_type' => $pack_type
                        );
                        if($pack_main){
                            $next_step['pack_main']  = $pack_main;
                        }
                        if($demo_title){
                            $next_step['demo_title']  = $demo_title;
                        }
                        if($demo_type){
                            $next_step['demo_type']  = $demo_type;
                        }
                        if($file_name){
                            $next_step['file_name']  = $file_name;
                        }
                        if($demo_key){
                            $next_step['demo_key']  = $demo_key;
                        }
                        if(isset($header['files-part-count']) && $header['files-part-count']) {
                            $next_step['total_step'] = (int)$header['files-part-count'];
                        }

                        if($step < $header['files-part-count']){
                            $next_step['step']              = $step + 1;
                            $next_step['action_import']     = $action_import;
                        }
                        $this -> info -> set('nextstep', $next_step);
                    }
                }else{

                    // Extract file and import
                    if(file_exists($filePath)){

                        try {

                            set_time_limit( 0 );

//                            $next_step  = $this -> info -> get('nextstep');
//
//                            if(!isset($next_step['substeps']) || empty($next_step['substeps'])) {
                            $folder_path = $upgrade_folder . '/' . $produce . '_' . $pack_type;
//                                unzip_file($filePath, $folder_path);
//                            }

                            switch ($demo_type) {
                                default:
                                case 'classic':
                                    $this -> import_content($folder_path, $file_name);
                                    break;
                                case 'revslider':
                                    $result = $this -> import_revslider($folder_path, $file_name);
                                    break;
                                case 'option-tree':
                                    $this -> import_theme_options($folder_path, $file_name);
                                    break;
                                case 'widget':
                                case 'widget-importer':
                                    $this -> import_widgets($folder_path, $file_name);
                                    break;
                                case 'woocommerce':
                                    $this -> import_woocommerce($folder_path, $file_name);
                                    break;
                                case 'megamenu':
                                    $this -> import_maxmegamenu($folder_path, $file_name, $demo_key);
                                    break;
                                case 'redux-framework':
                                    $this -> import_redux_framework($folder_path, $file_name);
                                    break;
                                case 'elementor':
                                    $this -> import_elementor($folder_path, $file_name);
                                    break;
                                case 'wpforms':
                                    $this -> import_wpforms($folder_path, $file_name);
                                    break;
                                case 'package':
                                case 'package_theme':
                                case 'theme_package':

                                    $result = $this -> install_theme_package($folder_path, $file_name);

                                    if($result){
                                        update_option('_'.TEMPLAZA_FRAMEWORK.'_'.$theme.'_package_theme', array(
                                            'package'           => $pack_type,
                                            'parent_package'    => $produce,
                                            'parent_theme'  => $theme
                                        ));
                                    }

                                    break;
                            }

                            // Import error
                            if(isset($result) && !$result){
                                // Remove package import folder.
                                $wp_filesystem -> delete($folder_path, true, 'd');

                                // Remove package import file
                                $wp_filesystem->delete($filePath);

                                echo $this -> info -> output(false);
                                die();
                            }

                            $itmImportLast   = $_POST['demo_item_last'];

                            if($itmImportLast && $itmImportLast == 1){

                                $pack_slug  = $pack_main?$pack_main:$produce;
                                $pack       = $this -> get_pack_by_slug($pack_slug);

                                // Set front page (the page will be active of demo import version)
                                if($pack && isset($pack['front_page']) && $pack['front_page']) {
                                    $frontTitle    = isset($pack['front_page_title'])?$pack['front_page_title']:$pack['title'];
                                    $homepage 	= get_page_by_title( $frontTitle );

                                    if( isset($homepage->ID)) {
                                        update_option('show_on_front', 'page');
                                        update_option('page_on_front',  $homepage->ID); // Front Page
                                    }

                                }

                                // Set location for menu
                                if($pack && isset($pack['menu_locations']) && count($pack['menu_locations'])){
                                    $locations  = get_theme_mod( 'nav_menu_locations' );
                                    foreach($pack['menu_locations'] as $location){
                                        if($menu = wp_get_nav_menu_object($location['title'])){
                                            $locations[$location['location']]   = $menu -> term_id;
                                        }
                                    }
                                    if(is_array($locations) && count($locations)){
                                        set_theme_mod( 'nav_menu_locations', $locations );
                                    }
                                }
                            }


//                            // Added from version 1.1.2
//                            $next_step  = $this -> info -> get('nextstep');
//                            if(!isset($next_step['substeps']) || empty($next_step['substeps'])) {
//
//                                // Remove package import folder when import successfully.
//                                $wp_filesystem -> delete($folder_path, true, 'd');
//
//                            }



                            if(!$this -> info -> get('nextstep')) {

                                if($itmImportLast < 2){

                                    // Remove package import folder when import successfully.
                                    $wp_filesystem->delete($folder_path, true, 'd');

                                    // Remove package import file
                                    $wp_filesystem->delete($filePath);

                                    $this->info->set_message(esc_html__('Imported demo content successfully.', 'templaza-framework'), false);

                                    // Store the demo import type
                                    //'_tzinst_demo_imported'
//                                $optionName = $this -> imported_key;

                                    $pack_slug = $pack_main ? $pack_main : $produce;
                                    $options = get_option($this->imported_key, array());
                                    if (!isset($options['pack'])) {
                                        $options['pack'] = array();
                                    }
                                    if (!is_array($options['pack'])) {
                                        $options['pack'] = (array)$options['pack'];
                                    }
                                    if (!in_array($pack_slug, $options['pack'])) {
                                        $options['pack'][] = $pack_slug;
                                    }

                                    update_option($this->imported_key, $options);
                                }
                                else{
                                    /* translators: %s - Imported. */
                                    $this->info->set_message(sprintf(esc_html__('Imported %s successfully.',
                                        'templaza-framework'), esc_html($demo_title)), false);
                                }

                            }
                            else {
                                $next_step  = $this -> info -> get('nextstep');
                                if(isset($next_step['substeps']) && !empty($next_step['substeps'])) {
                                    $substeps   = $next_step['substeps'];
                                    $cur_substep    = array_shift($substeps);
                                    /* translators: %s - Imported. */
                                    $this->info->set_message(sprintf(esc_html__('Imported substep: %s successfully.',
                                        'templaza-framework'), esc_html($cur_substep)), false);
                                }else{
                                    /* translators: %s - Imported. */
                                    $this->info->set_message(sprintf(esc_html__('Imported %s successfully.',
                                        'templaza-framework'), esc_html($demo_title)), false);
                                }
                            }
                        }catch (\Exception $e){
                            $this -> info -> set_message(esc_html__('Error: ','templaza-framework').$e -> getCode().' '
                                .$e -> getMessage(), true);
                        }
                    }
                    else{
                        $this -> info -> set_message(esc_html__('Not found file to import. Please contact us to support it.',
                            'templaza-framework'), true);
                    }
                }

                echo $this -> info -> output(true);

                die();
            }
        }

        /* Check system requirement */
        public function system_requirement_notice(){
            $pass   = Admin_Functions::check_system_requirement();

            if(!$pass){
                $app    = Application::get_instance();
                ob_start();

                $file   = Admin_Page_Function::get_template_directory().'/sysinfo_notice.php';

                if(file_exists($file)){
                    require_once $file;
                }
                $message    = ob_get_contents();
                ob_end_clean();

                $app -> enqueue_message($message, 'error', array('show_close_button' => false));
            }
        }

        protected function import_content($folder_path, $filename = '',  $file_filter = '.xml|.zip'){

            require_once TEMPLAZA_FRAMEWORK_LIBRARY_PATH.'/importer/class-templaza-importer.php';

            if ( ! class_exists( 'TemplazaFramework_Importer' ) ) {
                $class_wp_importer = TEMPLAZA_FRAMEWORK_LIBRARY_PATH.'/importer/class-templaza-importer.php';
                if ( file_exists( $class_wp_importer ) )
                    require_once $class_wp_importer;
            }

            if(!class_exists('TemplazaFramework_Importer')){
                $this -> info -> set_message(esc_html__('The class TemplazaFramework_WXR_Importer not found.',
                    'templaza-framework'), true);
                echo $this -> info -> output(true);
                die();
            }

            try {
                $fetch_remote_file = strpos($file_filter, '.zip') !== false ? false : true;

                // Has zip file in package
                $has_zip = Files::get_files_of_folder($folder_path, '.zip');

                $zip_file = '';
                if ($has_zip && !empty($has_zip)) {
                    // Get each zip file
                    $zip_file = $this->get_substeps($folder_path, $filename, '.zip');
                }

                if (!empty($zip_file)) {
                    $uploads = wp_upload_dir();

                    $zip_file = $folder_path . '/' . $zip_file;

                    // Extract media.zip file
                    $unziped = unzip_file($zip_file, $uploads['basedir']);
                    if ($unziped) {
                        $file_filter = preg_replace('/\|\.zip/', '', $file_filter);
                        unlink($zip_file);
                    }

                    $nextstep = $this->_get_substeps($folder_path, $filename, $file_filter);

                    // Add prepare theme option step if theme option files exists
                    if(($theme_option_dir = TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION) && is_dir($theme_option_dir)){
                        // Check theme options file extracted
                        $_files  = Files::get_files_of_folder($theme_option_dir, '.json',true, true);
                        if(!empty($_files)){
                            array_unshift($nextstep['substeps'], 'prepare-theme-option');
                            $nextstep['total_step']+=1;
                        }
                    }

                    $this->info->set('nextstep', $nextstep);

                    $this->info->set_message(esc_html__('Unzipped media files successfully.', 'templaza-framework'), false);

                    echo $this->info->output(true);
                    die();
                } else {
                    $file_filter = preg_replace('/\|\.zip/', '', $file_filter);
                }

                $_file = $this->get_substeps($folder_path, $filename, $file_filter);
                if(!empty($_file) && $_file == 'prepare-theme-option'){
                    if($this -> prepare_theme_options_file(TEMPLAZA_FRAMEWORK_THEME_PATH_TEMPLATE_OPTION)){

                        $this->info->set_message(esc_html__('Prepared theme options successfully', 'templaza-framework'), false);

                        echo $this->info->output(true);
                        die();
                    }
                }

//                $_file = $this->get_substeps($folder_path, $filename, $file_filter);

                if(!$_file){
                    $demo_title = isset($_POST['demo_title'])?$_POST['demo_title']:'';
                    $demo_title = !empty($demo_title)?$demo_title:$_POST['pack_type'];
                    /* translators: %s - Not found. */
                    $this -> info -> set_message(sprintf(esc_html__('Not found compatible files of "%s". Please contact us to support it.',
                        'templaza-framework'), esc_html($demo_title)), true);
                    echo $this -> info -> output(true);
                    die();
                }

                if(!isset($_POST['import_id'])){
                    /**
                     * Create import file by post with post type is attachment
                     *
                     */
                    $upload = wp_upload_dir();

                    global $wpdb;
                    $query = "SELECT ID FROM $wpdb->posts AS p";
                    $query .= "  INNER JOIN $wpdb->postmeta AS pm ON pm.post_id = p.ID";
                    $query .= "  AND pm.meta_key=%s";
                    $query .= "  WHERE 1=1";
                    $query .= ' AND p.post_title = %s';
                    $query .= ' AND p.post_content = %s';
                    $query .= ' AND p.post_type = %s';
                    $query .= ' AND p.post_status = %s';
                    $query .= ' AND pm.meta_value = %s';

                    $import_file_sub    = $_POST['pack'] . '_' . $_POST['pack_type'];
                    $import_file_url    = $upload['baseurl'].'/tzinst-demo-datas/'.$import_file_sub.'/'.$_file;

                    $args  = array(
                        '_templaza-framework__context',
                        $_file,
                        $import_file_url,
                        'attachment',
                        'private',
                        'import-content'
                    );
                    // phpcs:disable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.PreparedSQL.NotPrepared

                    $post_import_id   = (int) $wpdb->get_var( $wpdb->prepare( $query, $args ) );

                    if(!$post_import_id) {
                        // Construct the attachment array.
                        $attachment = array(
                            'post_title' => $_file,
                            'post_content' => $import_file_url,
                            'guid' => $import_file_url,
                            'context' => 'import',
                            'post_status' => 'private',
                            'meta_input' => array(
                                '_templaza-framework__context' => 'import-content'
                            ),
                        );

                        // Save the data.
                        $post_import_id = wp_insert_attachment($attachment, 'tzinst-demo-datas/'.$import_file_sub.'/' . $_file);

                    }

                    if($post_import_id){
                        $nextstep   = $this->_get_substeps($folder_path, $filename, $file_filter);

                        /**
                         * Must this option data: import_id to some plugin (woocomerce,...) run with import hook
                         * Special With woocommerce to import Product Attributes
                         * @param string import
                         * @param int import_id
                         * */
                        $nextstep['import']     = 'wordpress';
                        $nextstep['import_id']  = $post_import_id;

                        $this->info->set('nextstep', $nextstep);
                        /* translators: %s - Not found. */
                        $this->info->set_message(sprintf(esc_html__('Start Import %s.', 'templaza-framework'), esc_html($nextstep['demo_title'])), false);

                        echo $this->info->output(true);
                        die();
                    }
                }else{
                    $post_import_id = isset($_POST['import_id'])?$_POST['import_id']:0;
                }

                // Replace demo url to client url
                add_action('import_post_meta', function ($post_id, $key, $value) {
                    $config = $this->get_theme_demo_datas();
                    if (isset($config['source_url']) && preg_match('#' . $config['source_url'] . '#is', $value)) {
                        $value = preg_replace('#' . $config['source_url'] . '#is', get_home_url(), $value);
                        update_post_meta($post_id, $key, $value);
                    }
                }, 10, 3);

                $importer = new \TemplazaFramework_Importer(array(
                    'fetch_remote_file' => $fetch_remote_file,
                ));

                ob_start();
                $importer->import($folder_path . '/' . $_file);
                $result = ob_get_contents();
                ob_end_clean();

                $deleted = false;
                if ($result) {
                    $deleted = unlink($folder_path . '/' . $_file);
                    if($post_import_id){
                        wp_delete_post($post_import_id);
                    }
                }

                if($deleted){
                    $_file   = $this -> get_substeps($folder_path, $filename, $file_filter);
                    $nextstep = $this-> info -> get('nextstep');

                    if(isset($nextstep['substeps']) && !empty($nextstep['substeps'])) {
                        /* translators: %s - Imported. */
                        $this->info->set_message(sprintf(esc_html__('Imported %s successfully', 'templaza-framework'), esc_html($_file)), false);

                        echo $this->info->output(true);
                        die();
                    }else{
                        $this -> info -> remove('nextstep');
                        return true;
                    }
                }
            }catch (\Exception $e){
                $this -> info -> set_message($e -> getMessage(), true);
                echo $this -> info -> output(true);
                die();
            }

            return true;
        }

        protected function prepare_theme_options_file($folder_path, $file_filter = '.json'){

            if(!is_dir($folder_path)){
                return false;
            }

            $files  = Files::get_files_of_folder($folder_path, $file_filter,true, true);

            if(!empty($files)){
                foreach($files as $file){
                    $this -> prepare_image_url_from_file($file);
                }
            }
            return true;
        }

        protected function prepare_image_url_from_file($file){
//            $pattern = "/((https?|ftp|gopher|telnet|file|notes|ms-help):((\/\/)|(\\\\))+[\w\d:#@%\/;$()~_?\+-=\\\.&]*\.(jpg|jpeg|webp|ico|png|gif|tif|exf|svg|wfm))/ims";
            // phpcs:disable WordPress.WP.AlternativeFunctions.file_system_operations_fopen, WordPress.WP.AlternativeFunctions.file_system_operations_fread, WordPress.WP.AlternativeFunctions.file_system_operations_fwrite, WordPress.WP.AlternativeFunctions.file_system_operations_fclose
            $pattern = "/(((https?|ftp|gopher|telnet|file|notes|ms-help):((\/\/)|(\\\\))+[\w\d:#@%\/;$()~_?\+-=\\\.&]*)(\/wp-content\\\\\/uploads.*?)\.(jpg|jpeg|webp|ico|png|gif|tif|exf|svg|wfm))/ims";
            $fh = fopen($file, 'r');

            $content = fread($fh,filesize($file));
            $content = preg_replace($pattern, addcslashes(get_site_url(), '/') . '$7.$8', $content);
            $fh = fopen($file, 'w');
            fwrite($fh, $content);
            fclose($fh);
        }

        protected function import_revslider($folder_path, $filename = '',  $file_filter = '.zip'){

            if(!class_exists('RevSliderSliderImport') && !class_exists('RevSlider')){
                $this -> info -> set_message(esc_html__('Class RevSlider not found. Please install the revslider plugin to continue import it.',
                    'templaza-framework'), true);
                echo $this -> info -> output();
                die();
            }

            if(class_exists('RevSliderSliderImport')){
                $importer   = new \RevSliderSliderImport();
            }else{
                $importer = new \RevSlider();
            }

            if($file = $this->get_substeps($folder_path, $filename, $file_filter)){
                list($_filename, $fileExt) = explode('.', $file);
            }else{
                $_filename      = basename($folder_path);
                $folder_path    = preg_replace('#/'.$_filename.'$#', '', $folder_path);
                $fileExt        = 'zip';
                $file           =   $_filename.'.'.$fileExt;
            }

            if(class_exists('RevSliderSliderImport') && method_exists($importer, 'import_slider')){
                $result = $importer -> import_slider(true, $folder_path . '/' . $file);
            }else {
                $result = $importer->importSliderFromPost(true, false, $folder_path . '/' . $file);
            }

            if($result && $result['success'] == true){
                /* translators: %s - Data. */
                $this -> info -> set_message(sprintf(esc_html__('Data %s of Revolution Slider successfully.'), esc_html($_filename)), false);
                return $result['success'];
            }elseif($result && !$result['success'] && isset($result['error'])){
                /* translators: %s - Error. */
                $this -> info -> set_message(sprintf(esc_html__('Error import data of Revolution Slider: %s'), esc_html($result['error'])), true);
            }
            return false;
        }

        protected function import_theme_options($folder_path, $filename = '',  $file_filter = '.txt|.json'){

            /* needed option tree file for operatiob */
            include_once( WP_PLUGIN_DIR . '/option-tree/includes/ot-functions-admin.php' );

            if(!function_exists('ot_stripslashes')){
                $this -> info -> set_message(esc_html__('Function ot_stripslashes not exists. Please install and active plugin optionTree to continue import it.'), true);
                echo $this -> info ->output(true);
                die();
            }
            // phpcs:disable WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents,

            if($file = $this->get_substeps($folder_path, $filename, $file_filter)){
                list($_filename, $fileExt) = explode('.', $file);
            }

            $options    = file_get_contents($folder_path.'/'.$file);

            $options    = $fileExt == 'txt'?unserialize($options):json_decode($options);

            /* get settings array */
            $settings = get_option( 'option_tree_settings', array());

            /* has options */
            if(!$options){
                return false;
            }

            /* validate options */
            if ( is_array($settings) && count( $settings ) ) {

                foreach( $settings['settings'] as $setting ) {

                    $settingId  = $setting['id'];
                    if(is_array($options)){
                        if ( isset( $options[$settingId] ) ) {
                            $content = ot_stripslashes( $options[$settingId] );
                            $options[$settingId] = ot_validate_setting( $content, $setting['type'], $settingId );
                        }
                    }elseif(isset($options -> $settingId)){
                        $content = ot_stripslashes( $options -> $settingId );
                        $options[$options -> $settingId] = ot_validate_setting( $content, $setting['type'], $options -> $settingId );
                    }

                }

            }

            /* update the option tree array */
            update_option('option_tree', $options);

            return true;
        }

        protected function import_widgets($folder_path, $filename = '',  $file_filter = '.wie|.json') {
            /* needed option tree file for operatiob */
            include_once( TEMPLAZA_FRAMEWORK_LIBRARY_PATH . '/importer/class-widget-importer.php' );

            if(!class_exists('Plzinst_Widget_Importer')){
                $this -> info -> set_message(esc_html__('Class Plzinst_Widget_Importer not exists.'), false);
                echo $this -> info ->output(true);
                die();
            }
            $widget_importer    = new \Plzinst_Widget_Importer();

            $file   = $this -> get_substeps($folder_path, $filename, $file_filter);

            $options    = file_get_contents($folder_path.'/'.$file);
            $options    = json_decode($options);

            $results    = $widget_importer -> wie_import_data($options);
            if(!count($results)){
                $this -> info -> set_message(esc_html__('Can not import widgets.'), false);
                echo $this -> info -> output(true);
                die();
            }
        }

        protected function import_woocommerce($folder_path, $filename = '', $file_filter = '.xml|.json' ){

            // Import WooCommerce if WooCommerce Exists.
            if (!class_exists( 'WooCommerce' )) {
                $this -> info -> set_message(esc_html__('Please install and active the woocommerce plugin to continue import it.',
                    'templaza-framework'), true);
                echo $this -> info -> output();
                die();
            }
            $this -> import_content($folder_path);

            // Get json settings file
            $file   = $this -> get_substeps($folder_path, $filename, '.json');

            $settings   = file_get_contents($folder_path.'/'.$file);
            $settings   = json_decode($settings);
            // phpcs:disable WordPress.WP.DeprecatedFunctions.get_page_by_titleFound

            foreach ( $settings as $woo_page_name => $woo_page_title ) {
                $woopage = get_page_by_title( $woo_page_title );
                if ( isset( $woopage ) && $woopage->ID ) {
                    update_option( $woo_page_name, $woopage->ID );
                }
            }

            // We no longer need to install pages.
            delete_option( '_wc_needs_pages' );
            delete_transient( '_wc_activation_redirect' );
        }

        protected function import_maxmegamenu($folder_path, $filename = '', $demo_key = null, $file_filter = '.json|.txt' ){

            list($_filename, $fileExt)   = explode('.', $filename);

            if (!class_exists( 'Mega_Menu_Themes' ) && !class_exists( 'Mega_Menu_Settings' )) {
                $this -> info -> set_message(esc_html__('Please install and active the Mega Menu plugin to continue import it.',
                    'templaza-framework'), true);
                echo $this -> info -> output();
                die();
            }

            $file   = $this -> get_substeps($folder_path, $filename, $file_filter);

            if(!$file){
                $this -> info -> set_message(esc_html__('File not found.', 'templaza-framework'), true);
                echo $this -> info -> output();
                die();
            }

            $import  = file_get_contents($folder_path.'/'.$file);
            if($import){
                if(class_exists('Mega_Menu_Themes')){
                    $megamenu = new \Mega_Menu_Themes();
                }else {
                    $megamenu = new \Mega_Menu_Settings();
                }

                $import = json_decode( stripslashes( $import ), true );

                $saved_themes = max_mega_menu_get_themes();

                $next_id = $megamenu->get_next_theme_id();

                $import['title'] = $import['title'] . " " . __(' - Imported', 'templaza-framework');

                $new_theme_id = "custom_theme_" . $next_id;

                $saved_themes[ $new_theme_id ] = $import;

                max_mega_menu_save_themes( $saved_themes );

                if($demo_key != null) {
                    $produce        = $_POST['pack'];
                    $pack_main      = $_POST['pack_main'];
                    $pack   = $pack_main?$pack_main:$produce;

                    $packDatas  = $this -> get_pack_by_slug($pack);
                    $demoDatas      = $packDatas['demo-datas'];
                    $demo_options   = $demoDatas[$demo_key];

                    if($demo_options && count($demo_options) && isset($demo_options['options'])){
                        $demo_options           = $demo_options['options'];
                        $demo_options['theme']   = $new_theme_id;
                        $megamenuOption = get_option('megamenu_settings', array());

                        if(isset($demo_options['theme_location'])){
                            $theme_location = $demo_options['theme_location'];
                            unset($demo_options['theme_location']);

                            if(count($demo_options)) {
                                if(!count($megamenuOption)){
                                    $megamenuOption[$theme_location]    = array();
                                }
                                foreach($demo_options as $key => $value) {
                                    $megamenuOption[$theme_location][$key]  = $value;
                                }
                            }
                        }
                        if(count($megamenuOption)){
                            update_option('megamenu_settings', $megamenuOption);

                            // Generate mega menu style css
                            if(class_exists('Mega_Menu_Style_Manager')){
                                $megamenuStyle  = new \Mega_Menu_Style_Manager();
                                $megamenuStyle -> delete_cache();
                            }
                        }
                    }
                }
                return true;
            }

            $this -> info -> set_message(esc_html__('Can not import mega menu. Please check it again', 'templaza-framework'), true);
            echo $this -> info -> output();
            die();
        }

        protected function import_redux_framework($folder_path, $filename = '',  $file_filter = '.txt|.json'){

            $values = array();
            $theme  = wp_get_theme();
            if($file = $this->get_substeps($folder_path, $filename, $file_filter)){
                list($_filename, $fileExt) = explode('.', $file);
            }
            $settings = get_option( $theme -> get_template().'_options-transients', array());

            $options    = file_get_contents($folder_path.'/'.$file);

            $options    = $fileExt == 'txt'?unserialize($options):json_decode($options,true);

            $values = $options;

            /* has options */
            if(!$options){
                return false;
            }

            /* update the redux option array */
            update_option($theme -> get_template().'_options', $values);

            return true;
        }


        protected function import_elementor($folder_path, $filename = '',  $file_filter = '.json|.zip'){

            if(!class_exists('Elementor\App\Modules\ImportExport\Processes\Import') &&
                !class_exists('Elementor\Core\App\Modules\ImportExport\Import')){
                $this -> info -> set_message(esc_html__('Class Import not found. Please install the elementor plugin to continue import it.',
                    'templaza-framework'), true);
                echo $this -> info -> output();
                die();
            }

            $result = true;

            // Has zip file in package
            $has_zip    = Files::get_files_of_folder($folder_path, '.zip');

            if($has_zip){
                if($file = $this->get_substeps($folder_path, $filename, $file_filter)){
                    $exp    = explode('.', $file);
                    $_filename  = $exp[0];
                    $fileExt  = end($exp);
                }else{
                    $_filename      = basename($folder_path);
                    $folder_path    = preg_replace('#/'.$_filename.'$#', '', $folder_path);
                    $fileExt        = 'zip';
                    $file           =   $_filename.'.'.$fileExt;
                }

                if($fileExt == 'zip'){
                    $filePath   = $folder_path.'/'.$file;

                    /* Old code used for Elementor version < 3.8.0
                    $sub_folder_path    = $folder_path.'/'.$_filename;
                    $unziped    = unzip_file($filePath, $sub_folder_path);
                    if($unziped){
                        unlink($filePath);
                    }

                    // Import elementor kit
                    $result = $this -> _import_elementor_kit($sub_folder_path);
                    */

                    // Import elementor kit
                    $result = $this -> _import_elementor_kit($filePath);

                }elseif($fileExt == 'json'){

                    // Import elementor settings
                    $filePath   = $folder_path.'/'.$file;
                    $settings   = file_get_contents($filePath);
                    $settings   = is_string($settings)?json_decode($settings, true):$settings;

                    if(!empty($settings) && count($settings)){
                        foreach ($settings as $name => $value){
                            update_option($name, $value);
                        }
                    }
                }
            }else{
                // Import elementor kit
                $result = $this -> _import_elementor_kit($folder_path);
            }

            return $result;
        }

        protected function _import_elementor_kit($folder_path){
            if(!class_exists('Elementor\App\Modules\ImportExport\Processes\Import') &&
                !class_exists('Elementor\Core\App\Modules\ImportExport\Import')){
                return false;
            }

            $importer_opt   = array(
                'stage'                 => 2,
                'include'               => ['templates', 'content','settings'],
                'overrideConditions'    => [],
                'session'               => $folder_path.'/',
                'directory'             => $folder_path.'/',
            );

            /*
             * Create default kit
             * Recreate default kit (only when default kit does not exist).
             * */
            $kit = Plugin::$instance->kits_manager->get_active_kit();
            if ( !$kit->get_id() ) {
                $created_default_kit = Plugin::$instance->kits_manager->create_default();

                if ($created_default_kit) {
                    update_option(Manager::OPTION_ACTIVE, $created_default_kit);
                }
            }

            $importer_opt['post_id']    = $kit -> get_id();

            if(class_exists('Elementor\App\Modules\ImportExport\Processes\Import')){
                $importer   = new \Elementor\App\Modules\ImportExport\Processes\Import($folder_path, $importer_opt);
                $importer -> register_default_runners();
            }else{
                $importer   = new \Elementor\Core\App\Modules\ImportExport\Import($importer_opt);
            }

            // Import
            $el_result = $importer -> run();

            return $el_result;
        }


        /**
         * Import wpforms data
         * @param string $folder_path
         * @param string $filename
         * @param string $file_filter
         * */
        protected function import_wpforms($folder_path, $filename = '',  $file_filter = '.json'){

            $file       = $this -> get_substeps($folder_path, $filename, $file_filter);

            $file_path  = $folder_path.'/'.$file;

            if(!$file || !file_exists($file_path)){
                $this -> info -> set_message(esc_html__('File not found.', 'templaza-framework'), true);
                echo $this -> info -> output();
                die();
            }

            $forms    = json_decode( file_get_contents( $file_path ) , true );

            if(!$forms){
                $this -> info -> set_message(esc_html__('Forms not found.', 'templaza-framework'), true);
                echo $this -> info -> output();
                die();
            }

            foreach ( $forms as $form ) {
                $title  = ! empty( $form['settings']['form_title'] ) ? $form['settings']['form_title'] : '';
                $desc   = ! empty( $form['settings']['form_desc'] ) ? $form['settings']['form_desc'] : '';
                $new_id = wp_insert_post(
                    [
                        'post_title'   => $title,
                        'post_status'  => 'publish',
                        'post_type'    => 'wpforms',
                        'post_excerpt' => $desc,
                    ]
                );

                if ( $new_id ) {
                    $form['id'] = $new_id;

                    wp_update_post(
                        [
                            'ID'           => $new_id,
                            'post_content' => wpforms_encode( $form ),
                        ]
                    );
                }
            }
            return true;
        }

        protected function install_theme_package($folder_path, $filename = ''){

            $result = false;
            $theme  = $this -> theme_name;

            $theme_pack = wp_get_theme($theme, $folder_path);

            if($theme_pack && !is_wp_error($theme_pack)
                && $theme_pack -> get('Version')){

                // Install theme downloaded
                $overwrite  = 'update-theme';
                $skin       = new \WP_Ajax_Upgrader_Skin();
                $upgrader   = new \Theme_Upgrader($skin);

//                $result = $upgrader->install( $file_path, array( 'overwrite_package' => $overwrite ) );

                $destination    = get_theme_root();

                $package = array(
                    'source'            => $folder_path,
                    'destination'       => $destination,
                    'clear_working'     => true,
                    'clear_destination' => $overwrite,
                    'hook_extra'        => array(
                        'type'   => 'theme',
                        'action' => 'install',
                    ),
                );

                $install_result = $upgrader -> install_package($package);

                if(!is_wp_error($install_result)){
                    $result = true;
                }

            }else{
                $this->info->set_message(esc_html__('Can not install theme package!',
                    'templaza-framework'), true);
            }

            return $result;
        }

        protected function _get_substeps($folder_path, $filename = '', $file_filter = '.'){
            $_files  = array();
            if(!$filename){
                $_files  = Files::get_files_of_folder($folder_path, $file_filter);
            }else {
                $_files[]    = $filename;
            }

            $page           = $_POST['page'];
            $pack_type      = $_POST['pack_type'];
            $action         = $_POST['action'];
            $demo_type      = isset($_POST['demo_type']) && $_POST['demo_type']?$_POST['demo_type']:'';
            $demo_title     = isset($_POST['demo_title']) && $_POST['demo_title']?$_POST['demo_title']:'';
            $demo_key       = isset($_POST['demo_key']) && $_POST['demo_key']?$_POST['demo_key']:'';
            $produce        = $_POST['pack'];
            $security       = $_POST['security'];

            $next_step  = array(
                'action'    => $action,
                'page'      => $page,
                'security'  => $security,
                'pack'      => $produce,
                'pack_type' => $pack_type,
            );

            if($demo_title){
                $next_step['demo_title'] = $demo_title;
            }
            if($demo_type){
                $next_step['demo_type'] = $demo_type;
            }
            if($demo_key){
                $next_step['demo_key'] = $demo_key;
            }

            $substeps      = isset($_POST['substeps']) && $_POST['substeps']?$_POST['substeps']:$_files;

//            if(!$substeps || ($substeps && !count($substeps))){
//                return array();
//            }

//            $current_step               = array_shift($substeps);
            $next_step['substeps']      = $substeps;
            $next_step['total_step']    = count($substeps);

//            if($next_step && count($next_step) && $next_step['total_step']) {
//                $this -> info -> set('nextstep', $next_step);
//            }

            return $next_step;
        }

        protected function get_substeps($folder_path, $filename = '', $file_filter = '.'){
            $_files  = array();
            if(!$filename){
                $_files  = Files::get_files_of_folder($folder_path, $file_filter);
            }else {
                $_files[]    = $filename;
            }

            if(!count($_files)){
                $this -> info -> set_message(esc_html__('Files not found.', 'templaza-framework'), true);
                return false;
            }

//            $substeps      = isset($_POST['substeps']) && $_POST['substeps']?$_POST['substeps']:$_files;
//
//            if(!$substeps || ($substeps && !count($substeps))){
//                return array();
//            }
//
//            $page           = $_POST['page'];
//            $pack_type      = $_POST['pack_type'];
//            $action         = $_POST['action'];
//            $demo_type      = isset($_POST['demo_type']) && $_POST['demo_type']?$_POST['demo_type']:'';
//            $demo_title     = isset($_POST['demo_title']) && $_POST['demo_title']?$_POST['demo_title']:'';
//            $demo_key       = isset($_POST['demo_key']) && $_POST['demo_key']?$_POST['demo_key']:'';
//            $produce        = $_POST['pack'];
//            $security       = $_POST['security'];
//
//            $next_step  = array(
//                'action'    => $action,
//                'page'      => $page,
//                'security'  => $security,
//                'pack'      => $produce,
//                'pack_type' => $pack_type,
//            );
//
//            if($demo_title){
//                $next_step['demo_title'] = $demo_title;
//            }
//            if($demo_type){
//                $next_step['demo_type'] = $demo_type;
//            }
//            if($demo_key){
//                $next_step['demo_key'] = $demo_key;
//            }
//
//            $current_step               = array_shift($substeps);
//            $next_step['substeps']      = $substeps;
//            $next_step['total_step']    = count($substeps);
//
//            if($next_step && count($next_step) && $next_step['total_step']) {
//                $this -> info -> set('nextstep', $next_step);
//            }
//
//            return $current_step;

            $next_step  = $this -> _get_substeps($folder_path, $filename, $file_filter);

            if(!$next_step || ($next_step && !count($next_step))){
                return array();
            }

            $itmImportLast  = $_POST['demo_item_last'];
            $current_step   = array_shift($next_step['substeps']);

//            $next_step['total_substep']    = count($next_step['substeps']);
//            if($itmImportLast < 2) {
            $next_step['total_step'] = count($next_step['substeps']);
//            }
//            var_dump($next_step);
//            die(__METHOD__);

            if($next_step && count($next_step) && $next_step['total_step']) {
                $this -> info -> set('nextstep', $next_step);
            }

            return $current_step;
        }

    }
}