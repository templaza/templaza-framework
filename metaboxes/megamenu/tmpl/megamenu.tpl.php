<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Enqueue;
use TemPlazaFramework\Functions;

$opt_name                           = 'megamenu__layout';
$sections                           = $this -> layout_fields;

$setting_args                       = $this -> post_type -> setting_args;
$setting_args                       = $setting_args[$this -> post_type -> get_post_type()];
$redux_args                         = $setting_args;

$redux_args['opt_name']             = $opt_name;
$redux_args['menu_type']            = 'hidden';
$redux_args['dev_mode']             = false;
$redux_args['ajax_save']            = false;
$redux_args['open_expanded']        = true;
$redux_args['show_import_export']   = false;
//var_dump($setting_args);
//var_dump($layout_fields);
\Templaza_API::load_my_fields($opt_name);

Redux::set_args($opt_name, $redux_args);
Redux::set_sections($opt_name, $sections);
Redux::init($opt_name);

add_filter("redux/{$opt_name}/repeater", function($repeater_data) use($redux_args){
    $repeater_data['opt_names'][]   = $redux_args['opt_name'];
    return $repeater_data;
});
$redux  = \Redux::instance($opt_name );
//// Set options
//$redux -> options   = array();
//$redux->_register_settings();
//
$enqueue    = new Enqueue($redux);
$enqueue -> init();
?>

<script type="text/html" id="tmpl-templaza-metabox-megamenu-template">
    <div class="redux-container templaza-framework-options">
        <div class="fl_column-container">
            <?php
//            echo $this -> template_html;
            foreach ($redux -> sections as $k => $section) {

                $section['class'] = isset($section['class']) ? ' ' . $section['class'] : '';

                echo '<div id="metabox_'.$redux_args['opt_name'].'_' . $k . '_section_group' . '" class="redux-group-tab' . esc_attr($section['class']) . '" data-rel="metabox_'.$redux_args['opt_name'].'_' . $k . '">';

                do_action("redux/page/{$redux->args['opt_name']}/section/before", $section);
                do_settings_sections( $redux->args['opt_name'] . $k . '_section_group' );
                do_action("redux/page/{$redux->args['opt_name']}/section/after", $section);

                echo '</div>';
            }
                ?>
        </div>
    </div>
</script>

