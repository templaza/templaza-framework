<?php
defined( 'ABSPATH' ) || exit;

use TemPlazaFramework\Admin\Admin_Page_Function;
use TemPlazaFramework\Helpers\HelperLicense;

$config = $this -> theme_config_registered;

$license    = HelperLicense::get_license($this -> theme_name);

if($license && isset($license['purchase_code']) && $license['purchase_code']){
?>
    <h2><?php echo esc_html__('License Information', 'templaza-framework'); ?></h2>
    <div class="uk-grid-small uk-padding-small uk-padding-remove-horizontal" data-uk-grid>
        <div class="uk-width-1-4@m uk-width-1-1"><?php echo __('Buyer:', 'templaza-framework');?></div>
        <div class="uk-width-3-4@m uk-width-1-1"><?php echo $license['buyer']; ?></div>
        <div class="uk-width-1-4@m uk-width-1-1"><?php echo __('Domain:', 'templaza-framework');?></div>
        <div class="uk-width-3-4@m uk-width-1-1"><?php echo $license['domain']; ?></div>
        <div class="uk-width-1-4@m uk-width-1-1"><?php echo __('Purchase Code:', 'templaza-framework');?></div>
        <div class="uk-width-3-4@m uk-width-1-1"><?php echo $license['purchase_code']; ?></div>
        <div class="uk-width-1-4@m uk-width-1-1"><?php echo __('License Type:', 'templaza-framework');?></div>
        <div class="uk-width-3-4@m uk-width-1-1"><?php echo $license['license_type']; ?></div>
        <div class="uk-width-1-4@m uk-width-1-1"><?php echo __('Support Expire Date:', 'templaza-framework');?></div>
        <div class="uk-width-3-4@m uk-width-1-1"><?php echo $license['supported_until']; ?>
            <?php if(HelperLicense::has_expired($this -> theme_name)){ ?>
                <span class="uk-label uk-label-danger expired"><?php
                    echo __('Your support is expired!', 'templaza-framework');?></span>
            <?php }else{ ?>
            <span class="uk-label uk-label-success"><?php
                echo sprintf(__('Supported %s left', 'templaza-framework'),
                    Admin_Page_Function::generate_date_number_to_string(strtotime($license['supported_until']) -time(), true)); ?></span>
            <?php } ?>
        </div>
        <div class="uk-width-1-1 uk-margin-medium-top">
            <a href="javascript:" class="uk-button uk-button-primary uk-border-pill delete-template-activation" data-tzinst-reactivate-license><?php
                echo __('Reactivate your license', 'templaza-framework'); ?></a>
            <a href="javascript:" class="uk-button uk-button-danger uk-border-pill delete-template-activation uk-margin-small-left" data-tzinst-delete-license><?php
                echo __('Delete', 'templaza-framework'); ?></a>
        </div>
    </div>
<?php }else{ ?>
    <h2><?php
        echo esc_html__('Theme Activation', 'templaza-framework'); ?></h2>
    <p><?php echo __('Theme activation process is automatic, you don\'t need to enter purchase code manually. Follow these steps to activate the theme', 'templaza-framework'); ?></p>

    <a href="javascript:" class="uk-button uk-button-danger uk-border-pill" data-tzinst-active-license><?php
        echo esc_html__('Active Product', 'templaza-framework'); ?></a>
    <div class="uk-grid-small uk-margin-medium-top" data-uk-grid>
        <div class="uk-width-1-2@m uk-width-1-1">
            <span class="uk-border-circle uk-badge step-num wx-46 hx-46">1</span>
            <span><?php echo esc_html__('Click Activate Product button', 'templaza-framework'); ?></span>
        </div>
        <div class="uk-width-1-2@m uk-width-1-1">
            <span class="uk-border-circle uk-badge step-num wx-46 hx-46">2</span>
            <span><?php echo esc_html__('You will be asked to login with your Envato account (used to purchase this theme) to authorize theme purchase code', 'templaza-framework'); ?></span>
        </div>
        <div class="uk-width-1-2@m uk-width-1-1">
            <span class="uk-border-circle uk-badge step-num wx-46 hx-46">3</span>
            <span><?php echo esc_html__('Choose one of valid purchase codes from the list and click Proceed', 'templaza-framework'); ?></span>
        </div>
        <div class="uk-width-1-2@m uk-width-1-1">
            <span class="uk-border-circle uk-badge uk-label-success step-num wx-46 hx-46"><span class="dashicons dashicons-yes"></span></span>
            <span><?php echo esc_html__('Product is activated and you can get latest updates!', 'templaza-framework'); ?></span>
        </div>
    </div>
<?php
}
?>
