<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Fonts;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options        = Functions::get_theme_options();

$social_profiles    = isset($options['social'])?$options['social']:'';

if(!empty($social_profiles)){
    $social_profiles    = json_decode($social_profiles);
    $style              = isset($options['social-style']) ? $options['social-style'] : 'inherit';
    $social_gap         = isset($options['social-gap']) ? 'uk-grid-' . $options['social-gap'] : '';

    $social_font_style  = isset($options['social-icon-font']) && !empty($options['social-icon-font']) ? $options['social-icon-font'] : array();
    $social_icon_color  = isset($options['social-icon-color']) && !empty($options['social-icon-color']) ? $options['social-icon-color'] : '';
    $social_color_hover = isset($options['social-icon-color-hover']) && !empty($options['social-icon-color-hover']) ? $options['social-icon-color-hover'] : '';

    // Add social font style to css
    $social_css = Fonts::make_css_style($social_font_style, '.templaza-header .tz-header-social a');
    Templates::add_inline_styles($social_css);

    if(!empty($social_icon_color)){
        Templates::add_inline_style('.templaza-header .tz-header-social a{color: '.$social_icon_color.'}');
    }
    if(!empty($social_color_hover)){
        Templates::add_inline_style('.templaza-header .tz-header-social a:hover{color: '.$social_icon_color.'}');
    }
?>

<ul class=" tz-header-social uk-child-width-auto <?php echo $social_gap; ?> " data-uk-grid>
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
      echo '<li><a style="' . ($style == 'inherit' ? '' : 'color:'.$social_profile->color .' !important;')
          . '" href="' . $social_profile_link . '" target="_blank" rel="noopener"><i class="'
          . $social_profile->icon . '"></i></a></li>';
   }
   ?>
</ul>
<?php } ?>