<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

use TemPlazaFramework\Functions;

//var_dump($this -> redux);
if($redux = $this -> redux){
//    $redux -> generate_panel();

?>

<script type="text/html" id="tmpl-tzfrm-field-tz_loop-template__field-<?php echo $this->field['id']; ?>">
    <?php
    $has_group  = (isset($this -> field['group_fields']) && count($this -> field['group_fields']))?true:false;
    foreach ($redux -> sections as $k => $section) {
        echo '<div class="field-tz_loop-accordion-group"'
            .($has_group?' data-group-field="{{{data.group}}}" data-group-field-title="{{{data.group_title}}}"':'').'>';
            echo '<fieldset class="redux-field">';
                echo '<h3><span class="field-icon fas fa-map-marker-alt"></span><span class="title">{{{data.group_title}}}</span></h3>';
                echo '<div>';

                $section['class'] = isset($section['class']) ? ' ' . $section['class'] : '';

                do_action("redux/page/{$redux->args['opt_name']}/section/before", $section);
                do_settings_sections( $redux->args['opt_name'] . $k . '_section_group' );
                do_action("redux/page/{$redux->args['opt_name']}/section/after", $section);
                echo '</div>';
            echo '</fieldset>';
        echo '</div>';
    }
    ?>
</script>
<?php } ?>