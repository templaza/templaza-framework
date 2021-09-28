<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

if(isset($this -> field) && !empty($this -> field)){
    $content_id = $this -> field['id'].'__content';
?>
    <textarea class="hide" name="<?php echo $this -> field['name'];?>" id="<?php echo $this -> field['id'];
    ?>"><?php echo $this -> value; ?></textarea>
    <div class="field-tz_repeater-accordion" id="<?php echo $content_id; ?>"></div>

    <a href="#" class="add-more button button-primary" data-content="#<?php echo $content_id; ?>"><i class="far fa-plus-square"></i> <?php echo __('Add More', $this -> text_domain); ?></a>

<?php } ?>