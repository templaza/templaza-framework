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
    $contact_login            = isset($options['contact-login'])?$options['contact-login']:'';
    $contact_location_icon    = isset($options['contact-location-icon'])?$options['contact-location-icon']:'';
    $contact_email_icon       = isset($options['contact-email-icon'])?$options['contact-email-icon']:'';
    $contact_phone_icon       = isset($options['contact-phone-icon'])?$options['contact-phone-icon']:'';
    $contact_login_icon       = isset($options['contact-login-icon'])?$options['contact-login-icon']:'';


}

if(!empty($contact_location) || !empty($contact_email)  || !empty($contact_phone ) || !empty($contact_phone)){
?>
<div<?php echo isset($atts['tz_id'])?' id="'.$atts['tz_id'].'"':''; ?> class="<?php
echo isset($atts['tz_class'])?trim($atts['tz_class']):''; ?>">
    <?php
    if(!empty($contact_location)){
        ?>
        <span class="contact-location">
            <?php if($contact_location_icon){ ?>
            <i class="<?php echo esc_attr($contact_location_icon);?>"></i>
        <?php } echo esc_attr($contact_location);?>
        </span>
        <?php
    }
    if(!empty($contact_email)){
        ?>
        <span class="contact-email">
        <?php if($contact_email_icon){ ?>
            <i class="<?php echo esc_attr($contact_email_icon);?>"></i>
            <?php } ?>
        <a href="mailto:<?php echo esc_attr($contact_email);?>"><?php echo esc_attr($contact_email);?></a>
        </span>
        <?php
    }
    if(!empty($contact_phone)){
        ?>
        <span class="contact-phone">
        <?php if($contact_phone_icon){ ?>
            <i class="<?php echo esc_attr($contact_phone_icon);?>"></i>
        <?php } ?>
        <a href="tel:<?php echo esc_attr($contact_phone);?>"><?php echo esc_attr($contact_phone);?></a>
        </span>
        <?php
    }
    if(!empty($contact_login)){
        ?>
        <span class="contact-login">
        <?php if($contact_login_icon){ ?>
            <i class="<?php echo esc_attr($contact_login_icon);?>"></i>
        <?php } ?>
        <a href="<?php echo esc_url(admin_url());?>"><?php echo esc_attr($contact_login);?></a>
        </span>
        <?php
    }
     ?>
</div>
<?php } ?>