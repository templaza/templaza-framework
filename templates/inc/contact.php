<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options    = Functions::get_theme_options();

$enable_contact         = isset($options['enable-contact'])?filter_var($options['enable-contact'], FILTER_VALIDATE_BOOLEAN):false;
if ($enable_contact) {
    $enable_contact_location  = isset($options['enable-contact-location'])?filter_var($options['enable-contact-location'], FILTER_VALIDATE_BOOLEAN):true;
    $contact_location         = $enable_contact_location && isset($options['contact-location'])?$options['contact-location']:'';
    $contact_location_icon    = $enable_contact_location && isset($options['contact-location-icon'])?$options['contact-location-icon']:'';

    $enable_contact_email     = isset($options['enable-contact-email'])?filter_var($options['enable-contact-email'], FILTER_VALIDATE_BOOLEAN):true;
    $contact_email            = $enable_contact_email && isset($options['contact-email'])?$options['contact-email']:'';
    $contact_email_icon       = $enable_contact_email && isset($options['contact-email-icon'])?$options['contact-email-icon']:'';

    $enable_contact_phone     = isset($options['enable-contact-phone'])?filter_var($options['enable-contact-phone'], FILTER_VALIDATE_BOOLEAN):true;
    $contact_phone            = $enable_contact_phone && isset($options['contact-phone'])?$options['contact-phone']:'';
    $contact_phone_icon       = $enable_contact_phone && isset($options['contact-phone-icon'])?$options['contact-phone-icon']:'';

    $enable_contact_login     = isset($options['enable-contact-login'])?filter_var($options['enable-contact-login'], FILTER_VALIDATE_BOOLEAN):true;
    $contact_login            = $enable_contact_login && isset($options['contact-login'])?$options['contact-login']:'';
    $contact_login_icon       = $enable_contact_login && isset($options['contact-login-icon'])?$options['contact-login-icon']:'';

    $enable_contact_register  = isset($options['enable-contact-register'])?filter_var($options['enable-contact-register'], FILTER_VALIDATE_BOOLEAN):true;
    $contact_register         = $enable_contact_register && isset($options['contact-register'])?$options['contact-register']:'';
    $contact_register_icon    = $enable_contact_register && isset($options['contact-register-icon'])?$options['contact-register-icon']:'';


}

if(!empty($contact_location) || !empty($contact_email)  || !empty($contact_phone ) || !empty($contact_login)){
?>
<div class="tz-header-contact">
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
    if(!empty($contact_email)){
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
        <a href="tel:<?php echo str_replace(array( '(', ')',' ' ),'', esc_attr($contact_phone));?>"><?php
            echo esc_attr($contact_phone);?></a>
        </span>
        <?php
    }
    if(!empty($contact_login)){
        ?>
        <span class="contact-login">
        <?php if($contact_login_icon){ ?>
            <i class="contact-icon <?php echo esc_attr($contact_login_icon);?>"></i>
        <?php } ?>
        <a href="<?php echo esc_url(admin_url());?>"><?php echo esc_attr($contact_login);?></a>
        </span>
        <?php
    }
    if(!empty($contact_register)){
        ?>
        <span class="contact-register">
        <?php if($contact_register_icon){ ?>
            <i class="contact-icon <?php echo esc_attr($contact_register_icon);?>"></i>
        <?php } ?>
        <a href="<?php echo esc_url(admin_url());?>"><?php echo esc_attr($contact_register);?></a>
        </span>
        <?php
    }
     ?>
</div>
<?php } ?>