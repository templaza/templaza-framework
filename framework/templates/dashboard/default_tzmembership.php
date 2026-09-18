<?php
defined( 'ABSPATH' ) || exit;

use TemPlazaFramework\Admin\Admin_Page_Function;
use TemPlazaFramework\Helpers\HelperLicense;

$config = $this -> theme_config_registered;

$license    = HelperLicense::get_license($this -> theme_name);

if($license && isset($license['purchase_code']) && $license['purchase_code'] && $license['license_type']=='tz_membership' && $license['purchase_code'] !='developer'){
?>
    <h2><?php echo esc_html__('License Information', 'templaza-framework'); ?></h2>
    <div class="uk-grid-small uk-padding-small uk-padding-remove-horizontal" data-uk-grid>
        <?php if(isset($license['buyer'])){ ?>
        <div class="uk-width-1-4@m uk-width-1-1"><?php echo esc_html__('Buyer:', 'templaza-framework');?></div>
        <div class="uk-width-3-4@m uk-width-1-1"><?php echo esc_html($license['buyer']); ?></div>
        <?php } ?>
        <?php if(isset($license['domain'])){ ?>
        <div class="uk-width-1-4@m uk-width-1-1"><?php echo esc_html__('Domain:', 'templaza-framework');?></div>
        <div class="uk-width-3-4@m uk-width-1-1"><?php echo esc_html($license['domain']); ?></div>
        <?php } ?>
        <?php if(isset($license['purchase_code'])){ ?>
        <div class="uk-width-1-4@m uk-width-1-1"><?php echo esc_html__('Purchase Code:', 'templaza-framework');?></div>
        <div class="uk-width-3-4@m uk-width-1-1"><?php echo esc_html($license['purchase_code']); ?></div>
        <?php } ?>
        <?php if(isset($license['license_type'])){ ?>
        <div class="uk-width-1-4@m uk-width-1-1"><?php echo esc_html__('License Type:', 'templaza-framework');?></div>
        <div class="uk-width-3-4@m uk-width-1-1"><?php echo esc_html($license['license_type']); ?></div>
        <?php } ?>
        <?php if(isset($license['supported_until'])){ ?>
        <div class="uk-width-1-4@m uk-width-1-1"><?php echo esc_html__('Support Expire Date:', 'templaza-framework');?></div>
        <div class="uk-width-3-4@m uk-width-1-1"><?php echo esc_html($license['supported_until']); ?>

            <?php if(HelperLicense::has_expired($this -> theme_name)){ ?>
                <span class="uk-label uk-label-danger expired"><?php
                    echo esc_html__('Your support is expired!', 'templaza-framework');?></span>
            <?php }else{ ?>
            <span class="uk-label uk-label-success"><?php
                /* translators: %s - Supported. */
                echo sprintf(esc_html__('Supported %s left', 'templaza-framework'),
                    esc_html(Admin_Page_Function::generate_date_number_to_string(strtotime($license['supported_until']) -time(), true))); ?></span>
            <?php } ?>
        </div>
        <?php } ?>
        <div class="uk-width-1-1 uk-margin-medium-top">
            <a href="javascript:" class="uk-button uk-button-primary uk-border-pill delete-template-activation" data-tzinst-reactivate-license><?php
                echo esc_html__('Reactivate your license', 'templaza-framework'); ?></a>
            <a href="javascript:" class="uk-button uk-button-danger uk-border-pill delete-template-activation uk-margin-small-left" data-tzinst-delete-license><?php
                echo esc_html__('Delete', 'templaza-framework'); ?></a>
        </div>
    </div>
<?php }elseif($license && isset($license['purchase_code']) && $license['purchase_code'] && $license['license_type']=='tz_membership' && $license['purchase_code'] =='developer'){
    ?>
    <h2><?php echo esc_html__('License Information', 'templaza-framework'); ?></h2>
    <div class="uk-grid-small uk-padding-small uk-padding-remove-horizontal" data-uk-grid>
        <div class="uk-width-1-4@m uk-width-1-1"><?php echo esc_html__('Buyer:', 'templaza-framework');?></div>
        <div class="uk-width-3-4@m uk-width-1-1"><?php echo esc_html__('TemPlaza', 'templaza-framework'); ?></div>
        <div class="uk-width-1-4@m uk-width-1-1"><?php echo esc_html__('Domain:', 'templaza-framework');?></div>
        <div class="uk-width-3-4@m uk-width-1-1"><?php echo esc_html__('templaza.com', 'templaza-framework'); ?></div>
        <div class="uk-width-1-4@m uk-width-1-1"><?php echo esc_html__('Purchase Code:', 'templaza-framework');?></div>
        <div class="uk-width-3-4@m uk-width-1-1"><?php echo esc_html__('TemPlaza Developer', 'templaza-framework'); ?></div>
        <div class="uk-width-1-4@m uk-width-1-1"><?php echo esc_html__('License Type:', 'templaza-framework');?></div>
        <div class="uk-width-3-4@m uk-width-1-1"><?php echo esc_html__('Developer', 'templaza-framework'); ?></div>

        <div class="uk-width-1-1 uk-margin-medium-top">
            <a href="javascript:" class="uk-button uk-button-primary uk-border-pill delete-template-activation" data-tzinst-reactivate-license><?php
                echo esc_html__('Reactivate your license', 'templaza-framework'); ?></a>
            <a href="javascript:" class="uk-button uk-button-danger uk-border-pill delete-template-activation uk-margin-small-left" data-tzinst-delete-license><?php
                echo esc_html__('Delete', 'templaza-framework'); ?></a>
        </div>
    </div>
    <?php
}
else{ ?>
    <h2><?php
        echo esc_html__('TemPlaza License ', 'templaza-framework'); ?></h2>
    <p><?php echo __('Enter your license key from templaza.com. <a href="https://www.templaza.com/license-manager.html" target="_blank">How to get your license key from TemPlaza</a> ', 'templaza-framework'); ?></p>

    <div class="uk-grid-small uk-margin-small-top" data-uk-grid>

        <div class=" uk-width-1-1">
            <form>
                <input class="uk-input uk-form-large templaza_license" placeholder="License Key" type="text">
            </form>
        </div>
        <div class="uk-width-1-1 uk-margin-top">
            <span class="uk-border-circle uk-badge step-num wx-46 hx-46">1</span>
            <span><?php echo esc_html__('Login from TemPlaza.com', 'templaza-framework'); ?></span>
        </div>
        <div class="uk-width-1-1">
            <span class="uk-border-circle uk-badge step-num wx-46 hx-46">2</span>
            <span><?php echo esc_html__('Go to your license manager', 'templaza-framework'); ?></span>
        </div>

        <div class="uk-width-1-1">
            <span class="uk-border-circle uk-badge step-num wx-46 hx-46">3</span>
            <span><?php echo esc_html__('Click Domain Verified and add your domain', 'templaza-framework'); ?></span>
        </div>
        <a href="javascript:" class="uk-button uk-button-danger uk-border-pill btn-active-license-templaza" data-tzinst-active-license-templaza><?php
            echo esc_html__('Active Product', 'templaza-framework'); ?></a>
        <br>
        <div class="uk-alert-success uk-hidden" data-uk-alert>
            <a href class="uk-alert-close" data-uk-close></a>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
        </div>
        <div class="uk-alert-danger uk-hidden" data-uk-alert>
            <a href class="uk-alert-close" data-uk-close></a>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
        </div>

    </div>

<?php
}
?>
