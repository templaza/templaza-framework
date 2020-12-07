<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

extract($atts);

//$_tz_content    = do_shortcode($content);
//$_tz_content    = trim($_tz_content);
//if(!empty($_tz_content)){
?>
<div<?php echo isset($tz_id)?' id="'.$tz_id.'"':''; ?> class="row<?php echo isset($tz_class)?' '.$tz_class:'';
?>"><?php echo $content; ?></div>
<?php //} ?>