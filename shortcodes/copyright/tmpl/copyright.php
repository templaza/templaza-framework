<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options    = Functions::get_theme_options();

$enable_footer         = isset($options['enable-footer'])?filter_var($options['enable-footer'], FILTER_VALIDATE_BOOLEAN):false;
if ($enable_footer) {
    $footer_copyright         = isset($options['footer-copyright'])?$options['footer-copyright']:'';
    // values to find & replace
    $year       = get_the_date('Y');
    $site_title = get_bloginfo('name');
    $find       = array('{year}', '{sitetitle}');
    $replace    = array($year, $site_title);
    $footertext = str_replace($find, $replace, $footer_copyright);

}

if(isset($footertext)){
?>
<div<?php echo isset($atts['tz_id'])?' id="'.$atts['tz_id'].'"':''; ?> class="<?php
echo isset($atts['tz_class'])?trim($atts['tz_class']):''; ?>"><?php echo $footertext; ?></div>
<?php } ?>