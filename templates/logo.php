<?php

// No direct access.
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options        = Functions::get_theme_options();

// Logo Alt Text
$blog_title = get_bloginfo();
$tag_line   = get_bloginfo('description');

// Getting params from template
$logo_type                  = isset($options['logo-type'])?$options['logo-type']:'image'; // Logo Type
$header_mode                = isset($options['header-mode'])?$options['header-mode']:'horizontal';
$header_stacked_menu_mode   = isset($options['header-stacked-menu-mode'])?$options['header-stacked-menu-mode']:'center';

if (!$logo_type) {
    $logo_text    = isset($options['logo-text'])?$options['logo-text']:$blog_title;
    $tag_line    = isset($options['tag-line'])?$options['tag-line']:$tag_line;
} else {
    // Logo file
    $default_logo       = isset($options['default-logo'])?$options['default-logo']:false;
    $mobile_logo        = isset($options['mobile-logo'])?$options['mobile-logo']:false;
    $sticky_header_logo= isset($options['sticky-logo'])?$options['sticky-logo']:false;
}
$class = ['templaza-logo', 'templaza-logo-' . $logo_type, 'd-flex align-items-center'];
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
      <?php if (!empty($default_logo) && !empty($default_logo['url'])) { ?>
         <img src="<?php echo $default_logo['url']; ?>" alt="<?php echo $blog_title; ?>" class="templaza-logo-default" />
      <?php } ?>
      <?php if (!empty($mobile_logo) && !empty($mobile_logo['url'])) { ?>
         <img src="<?php echo $mobile_logo['url']; ?>" alt="<?php echo $blog_title; ?>" class="templaza-logo-mobile" />
      <?php } ?>
      <?php if (!empty($sticky_header_logo) && !empty($sticky_header_logo['url'])) { ?>
         <img src="<?php echo $sticky_header_logo['url']; ?>" alt="<?php echo $blog_title; ?>" class="templaza-logo-sticky" />
      <?php } ?>
   </a>
   <!-- image logo ends -->
<?php endif; ?>
<!-- </div> -->
<!-- logo ends -->