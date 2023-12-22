<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

use TemPlazaFramework\Functions;

if($redux = $this -> redux){
?>
<script type="text/html" id="tmpl-tzfrm-field-<?php echo $this -> type; ?>-template__field-<?php echo $this->field['id']; ?>">
    <?php
    foreach ($redux -> sections as $k => $section) {
        ?>
        <div class="uk-card uk-card-body uk-card-default uk-box-shadow-small uk-card-small uk-margin-bottom uk-flex uk-flex-middle field-<?php
            echo $this -> type; ?>__item">
            <?php
            $section['class'] = isset($section['class']) ? ' ' . $section['class'] : '';

            do_action("redux/page/{$redux->args['opt_name']}/section/before", $section);
            do_settings_sections( $redux->args['opt_name'] . $k . '_section_group' );
            do_action("redux/page/{$redux->args['opt_name']}/section/after", $section);
            ?>
            <div class="uk-flex-middle uk-margin-left uk-button-group action">
                <a href="javascript:" class="uk-button uk-button-default uk-button-small move-option" data-uk-tooltip="<?php
                    esc_attr_e('Drag to move', 'templaza-framework'); ?>">
                    <span data-uk-icon="icon: more-vertical; ratio: 0.7"></span>
                </a>
                <a href="javascript:" class="uk-button uk-button-default uk-button-small remove-option" data-uk-tooltip="<?php
                esc_attr_e('Delete color', 'templaza-framework'); ?>">
                    <span data-uk-icon="icon: minus-circle; ratio: 0.7" class="uk-icon"></span>
                </a>
            </div>
        </div>
    <?php } ?>
</script>
<?php } ?>