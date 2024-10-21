<?php

namespace TemPlazaFramework\Admin\Controller;

defined( 'ABSPATH' ) || exit;

use TemPlazaFramework\Admin\Admin_Page_Function;
use TemPlazaFramework\Admin\Application;
use TemPlazaFramework\Admin_Functions;
use TemPlazaFramework\Controller\BaseController;
use TemPlazaFramework\Helpers\HelperLicense;

if(!class_exists('TemPlazaFramework\Admin\Controller\DashboardController')){
    class DashboardController extends BaseController{

        protected $pagehook     = TEMPLAZA_FRAMEWORK_NAME.'__admin-dashboard';

        public function __construct(array $config = array())
        {
            parent::__construct($config);

            $this -> hooks();

            $this -> system_requirement_notice();
        }

        public function hooks(){
            if(isset($this -> theme_config_registered) && !empty($this -> theme_config_registered)) {
                add_action('tzinst_enqueue_admin_scripts', array($this, 'enqueue_admin_scripts'));
            }
        }

        public function enqueue_admin_scripts(){

            $config = $this -> theme_config_registered;
            $key    = HelperLicense::get_secret_key($this -> theme_name);
            wp_localize_script('templaza-framework-installation', 'tzinst_license_ajax', array(
                'license_active' => array(
                    // Request product activation
                    'action'            => 'activate-product',
                    // Jollyany API site url to go for activation
                    'api'                   => TEMPLAZA_FRAMEWORK_INSTALLATION_API_DOMAIN,
                    // Envato Itemid
                    'envatoid'              => (isset($config['envatoid']) && !empty($config['envatoid']))?$config['envatoid']:0,
                    // Theme name on TemPlaza
                    'productname'           => (isset($config['productname']) && !empty($config['productname']))?$config['productname']:'',
                    'url'                   => \get_home_url(),
                    'callback_url'          => \menu_page_url(TEMPLAZA_FRAMEWORK, false).'&action=activation&key='.$key,
                ),
                'loading_class_icon'    => 'spinner-border spinner-border-sm',
                'page'                  => TEMPLAZA_FRAMEWORK.'-'.$this -> get_name(),
                'admin_ajax_url'        => \admin_url('admin-ajax.php'),
                'admin_url'             => \admin_url('admin.php'),
                'strings'               =>  array(
                    /* translators: %s - Theme Activation. */
                    'theme_active_title'    => sprintf(__('%s &ndash; Theme Activation', 'templaza-framework'),(isset($config['productname']) && !empty($config['productname']))?$config['productname']:'' ),
                    'delete_question'       => __('Are you sure you want to delete template activation?', 'templaza-framework'),
                    'browser_warning'       => __('Your browser is blocking popups, activation process cannot continue!', 'templaza-framework'),
                    'loading'               => __('Please wait&hellip;', 'templaza-framework'),
                    'loading_desc'          => __('You will be redirected to Envato website in few seconds', 'templaza-framework')
                )
            ));
        }

        public function display($view = '', $layout = '')
        {
            $result = parent::display($view, $layout);

            if(isset($this -> theme_config_registered) && !empty($this -> theme_config_registered)){
                $license    = HelperLicense::get_license($this -> theme_name);
                $key        = HelperLicense::get_secret_key($this -> theme_name);
                if(!$license || ($license && (!isset($license['purchase_code']) ||
                            (isset($license['purchase_code']) && !$license['purchase_code'])))) {
                    update_option(HelperLicense::get_option_name($this->theme_name), array('secret_key' => $key));
                }
            }

            return $result;
        }

        public function render_metabox($post, $metabox){
            $this -> load_template($metabox['args']);
        }

        public function activation(){
            $theme          = $this -> theme_name;
            $option_name    = HelperLicense::get_option_name($theme);
            $options        = \get_option($option_name);
            // phpcs:disable WordPress.Security.NonceVerification.Recommended, WordPress.Security.NonceVerification.Missing

            if($options && $options['secret_key'] == $_GET['key']) {
                $data = array(
                    'purchase_code'     => $_POST['purchase_code'],
                    'license_type'      => $_POST['license_type'],
                    'purchase_date'     => $_POST['purchase_date'],
                    'supported_until'   => $_POST['supported_until'],
                    'buyer'             => $_POST['buyer'],
                    'domain'            => $_POST['domain'],
                    'secret_key'        => $_GET['key']
                );

                update_option($option_name, $data);

                $app    = Application::get_instance();
                /* translators: %s - Congratulations. */
                $app -> enqueue_message(sprintf(esc_html__('Congratulations! %s
                    has been successfully activated and now you can get latest updates of the theme.',
                    'templaza-framework'),esc_html($_POST['buyer'])), 'success');
                echo '<script>window.close();</script>';
                wp_die();
            }
        }

        public function ajax_deactivate_license(){
            if(get_option(HelperLicense::get_option_name($this -> theme_name))){
                delete_option(HelperLicense::get_option_name($this -> theme_name));
            }
            // phpcs:disable WordPress.WP.AlternativeFunctions.json_encode_json_encode
            $app    = new Application();
            $app -> enqueue_message(__('The license deleted!', 'templaza-framework'), 'success');
            echo json_encode(array('success' => true, 'redirect' => admin_url('admin.php?page='
            .TEMPLAZA_FRAMEWORK.(($this -> get_name() != 'dashboard')?'_'.$this -> get_name():''))));
            wp_die();
        }

        public function get_system_info() {
            return Admin_Functions::get_system_info();
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
    }
}