<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options    = Functions::get_theme_options();

$enable_footer         = isset($options['enable-footer'])?(bool) $options['enable-footer']:false;

$footer_sidebar = isset($options['footer-sidebar'])?$options['footer-sidebar']:'';

if ($footer_sidebar && is_active_sidebar($footer_sidebar)){
?>
<div id="templaza-footer-sidebar"><?php dynamic_sidebar($footer_sidebar); ?></div>
<?php
}
?>