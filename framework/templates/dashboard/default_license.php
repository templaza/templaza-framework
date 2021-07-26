<?php
defined( 'ABSPATH' ) || exit;

use TemPlazaFramework\Admin\Admin_Page_Function;
use TemPlazaFramework\Helpers\HelperLicense;

$config = $this -> theme_config_registered;

$license    = HelperLicense::get_license($this -> theme_name);
//var_dump($license);
//var_dump(HelperLicense::get_option_name($this -> theme_name));
//var_dump(get_option(HelperLicense::get_option_name($this -> theme_name)));
//var_dump($this -> theme_name);
//die();
//$key        = HelperLicense::get_secret_key($this -> theme_name);

if($license && isset($license['purchase_code']) && $license['purchase_code']){
?>
<h6 class="border-bottom border-gray pb-2 mb-3"><?php echo esc_html__('License Information', $this -> text_domain); ?></h6>
        <div class="row">
            <div class="col-md-3 font-weight-600 pt-2 pb-2"><?php echo __('Buyer:', $this -> text_domain);?></div>
            <div class="col-md-9 pt-2 pb-2"><?php echo $license['buyer']; ?></div>
            <div class="col-md-3 font-weight-600 pb-2"><?php echo __('Domain:', $this -> text_domain);?></div>
            <div class="col-md-9 pb-2"><?php echo $license['domain']; ?></div>
            <div class="col-md-3 font-weight-600 pb-2"><?php echo __('Purchase Code:', $this -> text_domain);?></div>
            <div class="col-md-9 pb-2"><?php echo $license['purchase_code']; ?></div>
            <div class="col-md-3 font-weight-600 pb-2"><?php echo __('License Type:', $this -> text_domain);?></div>
            <div class="col-md-9 pb-2"><?php echo $license['license_type']; ?></div>
            <div class="col-md-3 font-weight-600 pb-2"><?php echo __('Purchase Date:', $this -> text_domain);?></div>
            <div class="col-md-9 pb-2"><?php echo $license['purchase_date']; ?></div>
            <div class="col-md-3 font-weight-600 pb-2"><?php echo __('Support Expire Date:', $this -> text_domain);?></div>
            <div class="col-md-9 pb-2"><?php echo $license['supported_until']; ?>
                <?php if(HelperLicense::has_expired($this -> theme_name)){ ?>
                <span class="badge badge-danger expired"><?php
                    echo __('Your support is expired!', $this -> text_domain);?></span>
                <?php }else{ ?>
                <span class="badge badge-success"><?php
                    echo sprintf(__('Supported %s left', $this -> text_domain),
                        Admin_Page_Function::generate_date_number_to_string(strtotime($license['supported_until']) -time(), true)); ?></span></div>
                <?php } ?>
            <div class="col-md-12 pt-3">
                <a href="javascript:" class="btn btn-primary delete-template-activation" data-tzinst-reactivate-license><span class="dashicons dashicons-update"></span> <?php
                    echo __('Reactivate your license', $this -> text_domain); ?></a>
                <a href="javascript:" class="btn btn-danger delete-template-activation" data-tzinst-delete-license><span class="dashicons dashicons-no"></span> <?php
                    echo __('Delete', $this -> text_domain); ?></a>
            </div>
        </div>
<?php }else{ ?>
    <h6 class="border-bottom border-gray pb-3 mb-4"><?php
        echo esc_html__('Theme Activation', $this -> text_domain); ?></h6>
    <p><?php echo __('Theme activation process is automatic, you don\'t need to enter purchase code manually. Follow these steps to activate the theme', $this -> text_domain); ?></p>

    <a href="javascript:" class="btn btn-warning btn-lg mb-3" data-tzinst-active-license><?php
        echo esc_html__('Active Product', $this -> text_domain); ?></a>
    <div class="row">
        <div class="col-md-6">
            <div class="d-flex align-items-center mt-4">
                <span class="bg-secondary rounded-circle mr-3 wx-46 hx-46 text-white d-flex align-items-center justify-content-center step-num">1</span>
                <span class="flex-1"><?php echo esc_html__('Click Activate Product button', $this -> text_domain); ?></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex align-items-center mt-4">
                <span class="bg-secondary rounded-circle mr-3 wx-46 hx-46 text-white d-flex align-items-center justify-content-center step-num">2</span>
                <span class="flex-1"><?php
                    echo esc_html__('You will be asked to login with your Envato account (used to purchase this theme) to authorize theme purchase code', $this -> text_domain);
                    ?></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex align-items-center mt-4">
                <span class="bg-secondary rounded-circle mr-3 wx-46 hx-46 text-white d-flex align-items-center justify-content-center step-num">3</span>
                <span class="flex-1"><?php echo esc_html__('Choose one of valid purchase codes from the list and click Proceed', $this -> text_domain); ?></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex align-items-center mt-4">
                <span class="bg-success rounded-circle mr-3 wx-46 hx-46 text-white d-flex align-items-center justify-content-center step-num"><span class="dashicons dashicons-yes"></span></span>
                <span class="flex-1"><?php echo esc_html__('Product is activated and you can get latest updates!', $this -> text_domain); ?></span>
            </div>
        </div>
    </div>
<?php
//    update_option(HelperLicense::get_option_name($this -> theme_name), array('secret_key' => $key));
}

//add_action('tzinst_enqueue_admin_scripts', function() use($config, $key){
//    wp_localize_script('tzinst-admin-js__main', 'tzinst_license_ajax', array(
//
//        'license_active' => array(
//            // Request product activation
//            'action'            => 'activate-product',
//            // Jollyany API site url to go for activation
//            'api'                   => TEMPLAZA_FRAMEWORK_INSTALLATION_API_DOMAIN,
//            // Envato Itemid
//            'envatoid'              => $config['envatoid'],
//            // Theme name on TemPlaza
//            'productname'           => $config['productname'],
//            'url'                   => get_home_url(),
//            'callback_url'          => menu_page_url(TEMPLAZA_FRAMEWORK.'-'.$this -> get_name(), false).'&action=activation&key='.$key,
//        ),
//        'loading_class_icon'    => 'spinner-border spinner-border-sm',
//        'page'                  => TEMPLAZA_FRAMEWORK.'-'.$this -> get_name(),
//        'admin_ajax_url'        => admin_url('admin-ajax.php'),
//        'admin_url'             => admin_url('admin.php'),
//        'strings'               =>  array(
//            'theme_active_title'    => sprintf(__('%s &ndash; Theme Activation', $this -> text_domain),$config['productname'] ),
//            'delete_question'       => __('Are you sure you want to delete template activation?', $this -> text_domain),
//            'browser_warning'       => __('Your browser is blocking popups, activation process cannot continue!', $this -> text_domain),
//            'loading'               => __('Please wait&hellip;', $this -> text_domain),
//            'loading_desc'          => __('You will be redirected to Envato website in few seconds', $this -> text_domain)
//        )
//    ));
//});
?>
