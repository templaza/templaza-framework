<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

extract($atts);

//if(!empty($content)){
?>
<div<?php echo isset($tz_id)?' id="'.$tz_id.'"':''; ?> class="row<?php echo isset($tz_class)?' '.$tz_class:'';
?>"><?php echo $content; ?></div>
<?php //} ?>