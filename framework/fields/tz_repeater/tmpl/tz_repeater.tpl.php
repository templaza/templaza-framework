<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

use TemPlazaFramework\Functions;

//var_dump($this -> redux);
if($redux = $this -> redux){

?>

<script type="text/html" id="tmpl-tzfrm-field-tz_repeater-template__field-<?php echo $this->field['id']; ?>">
    <?php
    foreach ($redux -> sections as $k => $section) {
        echo '<div class="field-tz_repeater-accordion-group">';
            echo '<fieldset class="redux-field">';
                echo '<h3><span class="title">'.esc_html__('New Option', $this -> text_domain).'</span></h3>';
                echo '<div>';

                $section['class'] = isset($section['class']) ? ' ' . $section['class'] : '';

                do_action("redux/page/{$redux->args['opt_name']}/section/before", $section);
                do_settings_sections( $redux->args['opt_name'] . $k . '_section_group' );
                do_action("redux/page/{$redux->args['opt_name']}/section/after", $section);

                    echo '<a href="#" class="button button-danger button-micro remove-option" style="float:right;">'
                        .'<i class="far fa-trash-alt"></i> '.esc_html__('Delete', $this -> text_domain).'</a>';
                echo '</div>';
            echo '</fieldset>';
        echo '</div>';
    }
    ?>
</script>
<?php } ?>