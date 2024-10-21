<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

extract($atts);

$use_sticky     = isset($use_sticky)?filter_var($use_sticky, FILTER_VALIDATE_BOOLEAN):false;
$_sticky_option = array();
$_sticky        = '';

if($use_sticky){
    if(isset($sticky_position) && !empty($sticky_position)) {
        $_sticky_option[] = 'position: '.$sticky_position;
    }
    if(isset($sticky_start) && !empty($sticky_start)) {
        $_sticky_option[] = 'start: '.$sticky_start;
    }
    if(isset($sticky_end) && !empty($sticky_end)) {
        $_sticky_option[] = 'end: '.$sticky_end;
    }
    if(isset($sticky_offset) && !empty($sticky_offset)) {
        $_sticky_option[] = 'offset: '.$sticky_offset;
    }
    if(isset($sticky_overflow_flip) && !empty($sticky_overflow_flip)) {
        $_sticky_option[] = 'overflow-flip: true';
    }
    if(isset($sticky_animation) && !empty($sticky_animation)) {
        $_sticky_option[] = 'animation: '.$sticky_animation;
    }
    if(isset($sticky_cls_active) && !empty($sticky_cls_active)) {
        $_sticky_option[] = 'cls-active: '.$sticky_cls_active;
    }
    if(isset($sticky_cls_inactive) && !empty($sticky_cls_inactive)) {
        $_sticky_option[] = 'cls-inactive: '.$sticky_cls_inactive;
    }
    if(isset($sticky_show_on_up) && !empty($sticky_show_on_up)) {
        $_sticky_option[] = 'show-on-up: true';
    }
    if(isset($sticky_media) && !empty($sticky_media)) {
        $_sticky_option[] = 'media: '.$sticky_media;
    }
    if(isset($sticky_target_offset) && !empty($sticky_target_offset)) {
        $_sticky_option[] = 'target-offset: '.$sticky_target_offset;
    }

    $_sticky    = ' data-uk-sticky';
    if(!empty($_sticky_option)){
        $_sticky    .= '="'.join(';', $_sticky_option).'"';
    }
}
// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
?>
<div<?php echo isset($tz_id)?' id="'.esc_attr($tz_id).'"':''; ?> class="<?php
echo isset($tz_class)?esc_attr($tz_class):''?>">
    <?php if(!empty($_sticky_option)){?>
    <div <?php echo $_sticky;?>>
    <?php } ?>
    <?php echo !empty($content)?$content:''; ?>
    <?php if(!empty($_sticky_option)){ ?>
    </div>
    <?php } ?>
</div>