<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

$allow_copy = isset($this -> field['allow_copy'])?filter_var($this -> field['allow_copy'], FILTER_VALIDATE_BOOLEAN):false;
//$allow_copy = $allow_copy?'true':'false';

if($allow_copy){
?>
    <div class="uk-clearfix uk-margin-bottom">
        <div class="uk-button-group uk-float-right">
            <button type="button" class="uk-button uk-button-default uk-button-small js-copy-layout"><?php echo esc_html__('Copy', 'templaza-framework'); ?></button>
            <button type="button" class="uk-button uk-button-default uk-button-small js-paste-layout"><?php echo esc_html__('Paste', 'templaza-framework'); ?></button>
        </div>
    </div>
<?php } ?>
<textarea class="hide" name="<?php echo esc_attr($this -> field['name']);?>" id="<?php echo esc_attr($this -> field['id']);
?>"><?php echo $this -> value; ?></textarea>
<div class="field-tz_layout-content"></div>

<div>
    <?php
    $text   = esc_html__('Add Section','templaza-framework');
    if(isset($this -> parent -> args['shortcode_section']) && !$this -> parent -> args['shortcode_section']){
        $text   = esc_html__('Add Row','templaza-framework');
    }

    $field   = isset($this -> field)?$this -> field:array();
    $one_row        = (isset($field['one_row']) && $field['one_row'])?filter_var($field['one_row'], FILTER_VALIDATE_BOOLEAN):false;
    if(!$one_row){
    ?>
    <a href="#" class="fl_add-element-not-empty-button"><i class="far fa-plus-square"></i> <?php echo esc_html($text); ?></a>
    <?php } ?>
</div>
