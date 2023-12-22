<?php

// No direct access.
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use \TemPlazaFramework\CSS;

$gb_options                 = Functions::get_theme_options();
$options                    = Functions::get_header_options();

// Logo Alt Text
$blog_title = get_bloginfo();
$tag_line   = get_bloginfo('description');

// Getting params from template
$logo_type                  = isset($options['logo-type'])?$options['logo-type']:'image'; // Logo Type
$header_mode                = isset($options['header-mode'])?$options['header-mode']:'horizontal';
$header_stacked_menu_mode   = isset($options['header-stacked-menu-mode'])?$options['header-stacked-menu-mode']:'center';
$logo_size   = isset($options['logo_size'])?$options['logo_size']:'';
$logo_mobile_hide   = isset($options['mobile-logo-hide'])?filter_var($options['mobile-logo-hide'], FILTER_VALIDATE_BOOLEAN):false;
$logo_mobile_size   = isset($options['mobi_logo_size'])?$options['mobi_logo_size']:'';

if (!$logo_type) {
    $logo_text    = isset($options['logo-text'])?$options['logo-text']:$blog_title;
    $tag_line    = isset($options['tag-line'])?$options['tag-line']:$tag_line;
} else {
    // Logo file
    $default_logo       = isset($options['default-logo'])?$options['default-logo']:false;
    $mobile_logo        = isset($options['mobile-logo'])?$options['mobile-logo']:false;
    $sticky_header_logo= isset($options['sticky-logo'])?$options['sticky-logo']:false;
}
$class = ['templaza-logo', 'templaza-logo-' . $logo_type, 'uk-flex uk-flex-middle'];
$logo_css = '';
if(!empty($logo_size)){
    if(isset($logo_size['width']) && !empty($logo_size['width']) && strlen($logo_size['width'])>3){
        $logo_css .= 'width:'.$logo_size['width'].' !important;';
    }
    if(isset($logo_size['height']) && !empty($logo_size['height']) && strlen($logo_size['height'])>3){
        $logo_css .= 'height:'.$logo_size['height'].' !important;';
    }
}
if($logo_css){
    $logo_style = '.templaza-logo img, .templaza-logo svg{ ' . $logo_css . '}';
    Templates::add_inline_style($logo_style);
}
$logo_mobile_css = '';
if(!empty($logo_mobile_size)){
    if(isset($logo_mobile_size['width']) && !empty($logo_mobile_size['width']) && strlen($logo_mobile_size['width'])>3){
        $logo_mobile_css .= 'width:'.$logo_mobile_size['width'].' !important;';
    }
    if(isset($logo_mobile_size['height']) && !empty($logo_mobile_size['height']) && strlen($logo_mobile_size['height'])>3){
        $logo_mobile_css .= 'height:'.$logo_mobile_size['height'].' !important;';
    }
}
if($logo_mobile_css){
    $logo_mobile_style = '.templaza-logo img.templaza-logo-mobile, .templaza-logo svg.templaza-logo-mobile{ ' . $logo_mobile_css . '}';
    Templates::add_inline_style($logo_mobile_style,'mobile');
}
?>
<!-- logo starts -->
<!-- <div class="<?php /* echo implode(' ', $class); */ ?>"> -->
<?php if (!$logo_type): ?>
   <!-- text logo starts -->
   <?php
   $mr = ($header_mode == 'stacked' && ($header_stacked_menu_mode == 'seperated' || $header_stacked_menu_mode == 'center')) ? '' : ' mr-0 mr-lg-4';
   ?>
   <div class="<?php echo implode(' ', $class); ?> flex-column<?php echo $mr; ?>">
      <a class="site-title" href="<?php echo get_home_url(); ?>"><?php echo $logo_text; ?></a>
      <p class="site-tagline"><?php echo $tag_line; ?></p>
   </div>
   <!-- text logo ends -->
<?php endif; ?>
<?php if ($logo_type): ?>
   <!-- image logo starts -->
   <?php
   $mr = ($header_mode == 'stacked' && ($header_stacked_menu_mode == 'seperated' || $header_stacked_menu_mode == 'center')) ? '' : ' mr-0 mr-lg-4';
   ?>
   <a class="<?php echo implode(' ', $class); ?><?php echo $mr; ?>" href="<?php echo get_home_url(); ?>">
      <?php
      $logo_url = Functions::get_theme_default_logo_url('logo');
      if(!empty($default_logo) && isset($default_logo['url']) && !empty($default_logo['url'])
          && !Functions::is_external_url($default_logo['url'])){
          $logo_url = $default_logo['url'];
      }
      if(!empty($logo_url)){
          $log_svg              = '';
          if(Functions::file_ext_exists($logo_url, 'svg')){
              $log_svg  = ' data-uk-svg';
          }
          ?>
         <img src="<?php echo $logo_url; ?>" alt="<?php echo $blog_title; ?>" class="templaza-logo-default uk-preserve"<?php
         echo $log_svg; ?>/>
      <?php }
      if($logo_mobile_hide == false){
          $logo_mobile_url = Functions::get_theme_default_logo_url('logo_mobile');
          if(!empty($mobile_logo) && isset($mobile_logo['url']) && !empty($mobile_logo['url'])
              && !Functions::is_external_url($mobile_logo['url'])){
              $logo_mobile_url = $mobile_logo['url'];
          }
          if(empty($mobile_logo['url']) && !empty($default_logo) && !empty($default_logo['url'])){
              $logo_mobile_url = $default_logo['url'];
          }
          if(!empty($logo_mobile_url)){
              $log_svg              = '';
              if(Functions::file_ext_exists($logo_mobile_url, 'svg')){
                  $log_svg  = ' data-uk-svg';
              }
          ?>
         <img src="<?php echo $logo_mobile_url; ?>" alt="<?php echo $blog_title; ?>" class="templaza-logo-mobile uk-preserve"<?php
         echo $log_svg; ?>/>
      <?php }
      }
      $logo_url = Functions::get_theme_default_logo_url('logo_sticky');
      if(!empty($sticky_header_logo) && isset($sticky_header_logo['url']) && !empty($sticky_header_logo['url'])
          && !Functions::is_external_url($sticky_header_logo['url'])){
          $logo_url = $sticky_header_logo['url'];
      }
      if(!empty($logo_url)){
          $log_svg              = '';
          if(Functions::file_ext_exists($logo_url, 'svg')){
              $log_svg  = ' data-uk-svg';
          }
          ?>
         <img src="<?php echo $logo_url; ?>" alt="<?php echo $blog_title; ?>" class="templaza-logo-sticky uk-preserve"<?php
         echo $log_svg; ?>/>
      <?php } ?>
   </a>
   <!-- image logo ends -->
<?php endif; ?>
<!-- </div> -->
<!-- logo ends -->
