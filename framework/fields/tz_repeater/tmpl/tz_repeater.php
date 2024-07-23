<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

if(isset($this -> field) && !empty($this -> field)){
    $content_id = $this -> field['id'].'__content';
?>
    <textarea class="hide" name="<?php echo esc_attr($this -> field['name']);?>" id="<?php echo esc_attr($this -> field['id']);
    ?>"><?php echo esc_attr($this -> value); ?></textarea>
    <div class="field-tz_repeater-accordion" id="<?php echo esc_attr($content_id); ?>"></div>

    <a href="#" class="add-more button button-primary" data-content="#<?php echo esc_attr($content_id); ?>"><i class="far fa-plus-square"></i> <?php echo esc_html__('Add More', 'templaza-framework'); ?></a>

<?php } ?>