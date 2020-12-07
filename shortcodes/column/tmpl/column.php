<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

extract($atts);

//if(!empty($_tz_content)){
?>
<div<?php echo isset($tz_id)?' id="'.$tz_id.'"':''; ?> class="<?php
echo isset($tz_class)?$tz_class:''?>"><?php echo !empty($content)?$content:''; ?></div>
<?php //} ?>