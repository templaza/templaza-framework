<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options        = Functions::get_theme_options();

$social_profiles    = isset($options['social'])?$options['social']:'';
if(!empty($social_profiles)){
    $social_profiles = json_decode($social_profiles);
    $style    = isset($options['social-style'])?$options['social-style']:'inherit';
?>

<ul<?php echo isset($atts['tz_id'])?' id="'.$atts['tz_id'].'"':''; ?> class="nav navVerticalView <?php
echo isset($atts['tz_class'])?trim($atts['tz_class']):''; ?>">
   <?php
   foreach ($social_profiles as $social_profile) {
      switch (isset($social_profile -> id) && $social_profile->id) {
         case 'whatsapp':
            $social_profile_link = 'https://wa.me/' . $social_profile->link;
            break;
         case 'telegram':
            $social_profile_link = 'https://t.me/' . $social_profile->link;
            break;
         case 'skype':
            $social_profile_link = 'skype:' . $social_profile->link . '?chat';
            break;
         default:
            $social_profile_link = $social_profile->link;
            break;
      }
      echo '<li><a style="color:' . ($style == 'inherit' ? 'inherit;' : $social_profile->color .' !important;')
          . '" href="' . $social_profile_link . '" target="_blank" rel="noopener"><i class="'
          . $social_profile->icon . '"></i></a></li>';
   }
   ?>
</ul>
<?php } ?>