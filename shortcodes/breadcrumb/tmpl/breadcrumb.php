<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

extract(shortcode_atts(array(
    'tz_id'  => '',
    'tz_class'  => '',
    'enable_breadcrumb_single'    => false,
), $atts));

if (is_single() && $enable_breadcrumb_single == false){
    return;
}
$tz_class = '';
?>
<div <?php echo isset($atts['tz_id'])?' id="'.$atts['tz_id'].'"':''; ?> class="<?php
echo isset($atts['tz_class'])?trim($atts['tz_class']):''; ?>">
<?php
get_template_part( 'template-parts/breadcrumb' );
?>
</div>