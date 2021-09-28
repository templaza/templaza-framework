<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

$allow_copy = isset($this -> field['allow_copy'])?filter_var($this -> field['allow_copy'], FILTER_VALIDATE_BOOLEAN):false;
$allow_copy = $allow_copy?'true':'false';

if($allow_copy){
?>
    <div class="uk-clearfix uk-margin-bottom">
        <div class="uk-button-group uk-float-right">
            <button type="button" class="uk-button uk-button-default uk-button-small js-copy-layout"><?php echo __('Copy', $this -> text_domain); ?></button>
            <button type="button" class="uk-button uk-button-default uk-button-small js-paste-layout"><?php echo __('Paste', $this -> text_domain); ?></button>
        </div>
    </div>
<?php } ?>
<textarea class="hide" name="<?php echo $this -> field['name'];?>" id="<?php echo $this -> field['id'];
?>"><?php echo $this -> value; ?></textarea>
<div class="field-tz_layout-content"></div>

<div>
    <?php
    $text   = 'Add Section';
    if(isset($this -> parent -> args['shortcode_section']) && !$this -> parent -> args['shortcode_section']){
        $text   = 'Add Row';
    }
    ?>
    <a href="#" class="fl_add-element-not-empty-button"><i class="far fa-plus-square"></i> <?php echo __($text, $this -> text_domain); ?></a>
</div>
