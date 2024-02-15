<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

if(isset($this -> field) && !empty($this -> field)){
    $content_id = $this -> field['id'].'__content';
    ?>
    <textarea class="uk-hidden" name="<?php echo $this -> field['name'];?>" id="<?php echo $this -> field['id'];
    ?>"><?php echo is_array($this -> value)?json_encode($this -> value):$this -> value; ?></textarea>
    <div class="field-<?php echo $this -> type; ?>__list<?php echo $this -> field_style == 'inline'?' tzfrm-field-inline':'';
    ?> uk-position-relative" id="<?php echo $content_id; ?>"></div>

    <a href="#" class="add-more button button-primary" data-content="#<?php echo $content_id;
    ?>"><i class="far fa-plus-square"></i> <?php echo __('Add Color', 'templaza-framework'); ?></a>

<?php } ?>
