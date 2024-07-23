<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

if(isset($this -> field) && !empty($this -> field)){
    $content_id = $this -> field['id'].'__content';
    ?>
    <textarea class="uk-hidden" name="<?php echo esc_attr($this -> field['name']);?>" id="<?php echo esc_attr($this -> field['id']);
    ?>"><?php echo is_array($this -> value)?esc_attr(wp_json_encode($this -> value)):esc_attr($this -> value); ?></textarea>
    <div class="field-<?php echo esc_attr($this -> type); ?>__list<?php echo $this -> field_style == 'inline'?' tzfrm-field-inline':'';
    ?> uk-position-relative" id="<?php echo esc_attr($content_id); ?>"></div>

    <a href="#" class="add-more button button-primary" data-content="#<?php echo esc_attr($content_id);
    ?>"><i class="far fa-plus-square"></i> <?php echo esc_html__('Add Color', 'templaza-framework'); ?></a>

<?php } ?>
