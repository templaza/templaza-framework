<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options        = Functions::get_theme_options();
$text_domain    = Functions::get_my_text_domain();
$contact_details= isset($options['contact-detail'])?(bool) $options['contact-detail']:true;

if (!$contact_details) {
    return;
}
$phone              = isset($options['contact-phone-number'])?$options['contact-phone-number']:'';
$mobile             = isset($options['contact-mobile-number'])?$options['contact-mobile-number']:'';
$email              = isset($options['contact-email-address'])?$options['contact-email-address']:'';
$openhours          = isset($options['contact-open-hours'])?$options['contact-open-hours']:'';
$address            = isset($options['contact-address'])?$options['contact-address']:'';
$contact_display    = isset($options['contact-display']) && (bool) $options['contact-display']?'icons':'text';

if (!empty($address) || !empty($phone) || !empty($mobile) || !empty($email) || !empty($openhours)) {
?>
<div<?php echo isset($atts['tz_id'])?' id="'.$atts['tz_id'].'"':''; ?> class="templaza-contact-info <?php
echo isset($atts['tz_class'])?trim($atts['tz_class']):''; ?>">
    <?php if (!empty($address)) { ?>
        <span class="d-inline-block">
         <?php if ($contact_display == "icons") : ?>
             <i class="fas fa-map-marker-alt mr-1"></i>
         <?php endif; ?>
            <?php if ($contact_display == "text") : ?>
                <?php echo __('Address', $text_domain); ?>:
            <?php endif; ?>
            <?php echo $address; ?>
      </span>
    <?php } ?>

    <?php if (!empty($phone)) { ?>
        <span class="d-inline-block">
         <?php if ($contact_display == "icons") : ?>
             <i class="fas fa-phone fa-rotate-90 mr-1"></i>
         <?php endif; ?>
            <?php if ($contact_display == "text") : ?>
                <?php echo __('Phone', $text_domain); ?>:
            <?php endif; ?>
         <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
      </span>
    <?php } ?>

    <?php if (!empty($mobile)) { ?>
        <span class="d-inline-block">
         <?php if ($contact_display == "icons") : ?>
             <i class="fas fa-mobile-alt mr-1"></i>
         <?php endif; ?>
            <?php if ($contact_display == "text") : ?>
                <?php echo __('Mobile', $text_domain); ?>:
            <?php endif; ?>
         <a href="tel:<?php echo $mobile; ?>"><?php echo $mobile; ?></a>
      </span>
    <?php } ?>

    <?php if (!empty($email)) { ?>
        <span class="d-inline-block">
         <?php if ($contact_display == "icons") : ?>
             <i class="far fa-envelope mr-1"></i>
         <?php endif; ?>
            <?php if ($contact_display == "text") : ?>
                <?php echo __('Email', $text_domain); ?>:
            <?php endif; ?>
         <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
      </span>
    <?php } ?>

    <?php if (!empty($openhours)) { ?>
        <span class="d-inline-block">
         <?php if ($contact_display == "icons") : ?>
             <i class="far fa-clock mr-1"></i>
         <?php endif; ?>
            <?php if ($contact_display == "text") : ?>:
                <?php echo __('Open Hours', $text_domain); ?>
            <?php endif; ?>
            <?php echo $openhours; ?>
      </span>
    <?php } ?>
</div>
<?php } ?>