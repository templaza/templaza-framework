<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options    = Functions::get_theme_options();

$enable_footer         = isset($options['enable-footer'])?(bool) $options['enable-footer']:false;
if ($enable_footer) {
$footer_copyright         = isset($options['footer-copyright'])?$options['footer-copyright']:'';
// values to find & replace
$year       = get_the_date('Y');
$site_title = get_bloginfo('name');
$find       = array('{year}', '{sitetitle}');
$replace    = array($year, $site_title);
$footertext = str_replace($find, $replace, $footer_copyright);

}
//if()
?>
<div id="templaza-footer" class="templaza-footer"><?php echo $footertext; ?></div>