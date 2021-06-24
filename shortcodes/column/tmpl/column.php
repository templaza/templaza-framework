<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

extract($atts);

if ( ! is_active_sidebar( 'sidebar-main' ) ) {
    $col_none = 'templaza-sidebar-no-content ';
}else{
    $col_none ='';
}
?>
<div<?php echo isset($tz_id)?' id="'.$tz_id.'"':''; ?> class="<?php echo $col_none;
echo isset($tz_class)?$tz_class:''?>">
    <?php echo !empty($content)?$content:''; ?></div>
<?php //} ?>