<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options    = Functions::get_theme_options();

$enable_contact         = isset($options['enable-contact'])?filter_var($options['enable-contact'], FILTER_VALIDATE_BOOLEAN):false;
if ($enable_contact) {
    $contact_location         = isset($options['contact-location'])?$options['contact-location']:'';
    $contact_email            = isset($options['contact-email'])?$options['contact-email']:'';
    $contact_phone            = isset($options['contact-phone'])?$options['contact-phone']:'';
    $contact_enable_login     = isset($options['enable-contact-login'])?filter_var($options['enable-contact-login'], FILTER_VALIDATE_BOOLEAN):false;
    $contact_login            = isset($options['contact-login'])?$options['contact-login']:'';
    $contact_location_icon    = isset($options['contact-location-icon'])?$options['contact-location-icon']:'';
    $contact_enable_email     = isset($options['enable-contact-email'])?filter_var($options['enable-contact-email'], FILTER_VALIDATE_BOOLEAN):false;
    $contact_email_icon       = isset($options['contact-email-icon'])?$options['contact-email-icon']:'';
    $contact_phone_icon       = isset($options['contact-phone-icon'])?$options['contact-phone-icon']:'';
    $contact_login_icon       = isset($options['contact-login-icon'])?$options['contact-login-icon']:'';
    $contact_login_url        = isset($options['contact-login-url'])?$options['contact-login-url']:'';
    $contact_login_url_custom = isset($options['contact-login-custom-url'])?$options['contact-login-custom-url']:'';
    $welcome_text             = isset($options['contact-login-welcome'])?$options['contact-login-welcome']:'';

    $enable_contact_register  = isset($options['enable-contact-register'])?filter_var($options['enable-contact-register'], FILTER_VALIDATE_BOOLEAN):true;
    $contact_register         = $enable_contact_register && isset($options['contact-register'])?$options['contact-register']:'';
    $contact_register_icon    = $enable_contact_register && isset($options['contact-register-icon'])?$options['contact-register-icon']:'';
    $contact_register_url        = isset($options['contact-register-url'])?$options['contact-register-url']:'';
    $contact_register_url_custom = isset($options['contact-register-custom-url'])?$options['contact-register-custom-url']:'';
}

if(!empty($contact_location) || !empty($contact_email)  || !empty($contact_phone ) || !empty($contact_phone)){
?>
<div<?php echo isset($atts['tz_id'])?' id="'.esc_attr($atts['tz_id']).'"':''; ?> class="<?php
echo isset($atts['tz_class'])?esc_attr(trim($atts['tz_class'])):''; ?>">
    <?php
    if(!empty($contact_location)){
        ?>
        <span class="contact-location">
            <?php if($contact_location_icon){ ?>
            <i class="contact-icon <?php echo esc_attr($contact_location_icon);?>"></i>
        <?php } echo esc_attr($contact_location);?>
        </span>
        <?php
    }
    if($contact_enable_email){
        ?>
        <span class="contact-email">
        <?php if($contact_email_icon){ ?>
            <i class="contact-icon <?php echo esc_attr($contact_email_icon);?>"></i>
            <?php } ?>
        <a href="mailto:<?php echo esc_attr($contact_email);?>"><?php echo esc_attr($contact_email);?></a>
        </span>
        <?php
    }
    if(!empty($contact_phone)){
        ?>
        <span class="contact-phone">
        <?php if($contact_phone_icon){ ?>
            <i class="contact-icon <?php echo esc_attr($contact_phone_icon);?>"></i>
        <?php } ?>
        <a href="tel:<?php echo esc_attr(str_replace(array( '(', ')',' ' ),'', esc_attr($contact_phone)));?>"><?php
            echo esc_attr($contact_phone);?></a>
        </span>
        <?php
    }

    if($contact_enable_login){
        if ( is_user_logged_in() ) {
            $current_user = wp_get_current_user();
            ?>
            <span class="contact-login">
                <a href="javascript:">
                    <?php if($contact_login_icon){ ?>
                        <i class="contact-icon <?php echo esc_attr($contact_login_icon);?>"></i>
                    <?php }
                    echo esc_html($welcome_text.' ');
                    echo esc_html( $current_user->display_name );
                    ?>
                </a>
            </span>
        <?php } else {
            ?>
            <span class="contact-login">
            <?php if($contact_login_icon){ ?>
                <i class="contact-icon <?php echo esc_attr($contact_login_icon);?>"></i>
            <?php } ?>
                <?php
                if($contact_login_url == 'custom'){
                    ?>
                    <a href="<?php echo esc_url($contact_login_url_custom);?>"><?php echo esc_attr($contact_login);?></a>
                    <?php
                }else{
                    ?>
                    <a href="<?php echo esc_url(admin_url());?>"><?php echo esc_attr($contact_login);?></a>
                <?php } ?>
            </span>
            <?php
        }
    }
    if($enable_contact_register){
        if ( is_user_logged_in() ) {

        }else{
            ?>
            <span class="contact-register">
                <?php if($contact_register_icon){ ?>
                    <i class="contact-icon <?php echo esc_attr($contact_register_icon);?>"></i>
                <?php } ?>
                    <?php
                    if($contact_register_url == 'custom'){
                        ?>
                        <a href="<?php echo esc_url($contact_register_url_custom);?>"><?php echo esc_attr($contact_register);?></a>
                        <?php
                    }else{
                        ?>
                        <a href="<?php echo esc_url(site_url('/wp-login.php?action=register&redirect_to=' . get_permalink()));?>"><?php echo esc_attr($contact_register);?></a>
                    <?php } ?>
                </span>
            <?php
        }
    }
    ?>
</div>
<?php } ?>