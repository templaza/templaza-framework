<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Enqueue;
use TemPlazaFramework\Functions;

$redux  = $this -> redux;
//$redux  = \Redux::instance($this -> opt_name);
//var_dump($this -> template_html); die();
if($redux){
$enqueue    = new Enqueue($redux);
$enqueue -> init();

//$redux -> _register_settings();
?>

<script type="text/html" id="tmpl-templaza-metabox-megamenu-template">
    <div class="templaza-mega-menu-options">
<!--        <div class="redux-main">-->
        <div class="fl_column-container">
            <?php
            ob_start();
            $redux -> generate_panel();
            $content = ob_get_contents();
            ob_end_clean();
//            $content    = $this -> template_html;
//            var_dump($content); die();
            if(preg_match('/(<sc)(ript\s+type=[\'|"]text\/javascript[\'|"]?)(>)/', $content, $match)){
                $content    = preg_replace('/(<sc)(ript\s+type=[\'|"]text\/javascript[\'|"]>)/', '<# print(\'$1\' + \'$2\');#>', $content);
                $content = preg_replace('/(<\/sc)(ript>)/','<# print(\'$1\'+\'$2\');#>', $content);
            }
            echo $content;


//            foreach ($redux -> sections as $k => $section) {
//
//                $section['class'] = isset($section['class']) ? ' ' . $section['class'] : '';
//
//                echo '<div id="metabox_'.$redux_args['opt_name'].'_' . $k . '_section_group' . '" class="redux-group-tab' . esc_attr($section['class']) . '" data-rel="metabox_'.$redux_args['opt_name'].'_' . $k . '">';
//
//                do_action("redux/page/{$redux->args['opt_name']}/section/before", $section);
//                do_settings_sections( $redux->args['opt_name'] . $k . '_section_group' );
//                do_action("redux/page/{$redux->args['opt_name']}/section/after", $section);
//
//                echo '</div>';
//            }
                ?>
        </div>
<!--        </div>-->
    </div>
</script>

<?php } ?>