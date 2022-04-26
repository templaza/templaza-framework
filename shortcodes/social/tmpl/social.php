<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options        = Functions::get_theme_options();

$social_profiles    = isset($options['social'])?$options['social']:'';
if(isset($atts['text_align'])){
    if($atts['text_align'] == 'center'){
        $atts['tz_class'] .= ' uk-flex-center';
    }
}
if(!empty($social_profiles)){
    $social_profiles    = json_decode($social_profiles);
    $style              = isset($options['social-style']) ? $options['social-style'] : 'inherit';
    $social_gap         = isset($options['social-gap']) ? 'uk-grid-' . $options['social-gap'] : '';
?>

<ul<?php echo isset($atts['tz_id'])?' id="'.$atts['tz_id'].'"':''; ?> class="uk-child-width-auto <?php echo $social_gap; ?> <?php
echo isset($atts['tz_class'])?trim($atts['tz_class']):''; ?>" data-uk-grid>
   <?php
   foreach ($social_profiles as $social_profile) {
       $social_profile_link = $social_profile->link;
       if(isset($social_profile -> id)){
          switch ($social_profile->id) {
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
      }
      echo '<li><a style="color:' . ($style == 'inherit' ? 'inherit;' : $social_profile->color .' !important;')
          . '" href="' . $social_profile_link . '" target="_blank" rel="noopener"><i class="'
          . $social_profile->icon . '"></i></a></li>';
   }
   ?>
</ul>
<?php } ?>